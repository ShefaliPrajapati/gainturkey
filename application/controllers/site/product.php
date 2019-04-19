<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * User related functions
 * @author Teamtweaks
 *
 */
class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('cookie', 'date', 'form', 'email', 'text', 'html'));
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model(array('product_model', 'user_model'));
        $this->load->library('pagination');
        if ($_SESSION['sMainCategories'] == '') {
            $sortArr1 = array('field' => 'cat_position', 'type' => 'asc');
            $sortArr = array($sortArr1);
            $_SESSION['sMainCategories'] = $this->product_model->get_all_details(CATEGORY, array('rootID' => '0', 'status' => 'Active'), $sortArr);
        }
        $this->data['mainCategories'] = $_SESSION['sMainCategories'];

        if ($_SESSION['sColorLists'] == '') {
            $_SESSION['sColorLists'] = $this->product_model->get_all_details(LIST_VALUES, array('list_id' => '1'));
        }
        $this->data['mainColorLists'] = $_SESSION['sColorLists'];
        $this->data['SliderDisplay'] = $this->product_model->get_all_details(SLIDER, array('status' => 'Active'));
        $this->data['loginCheck'] = $this->checkLogin('U');
        $this->data['likedProducts'] = array();
        if ($this->data['loginCheck'] != '') {
            $this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES, array('user_id' => $this->checkLogin('U')));
        }
    }

    public function onboarding()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $this->data['userDetails'] = $this->product_model->get_all_details(USERS, array('id' => $this->checkLogin('U')));
            if ($this->data['userDetails']->num_rows() == 1) {
                if ($this->data['mainCategories']->num_rows() > 0) {
                    foreach ($this->data['mainCategories']->result() as $cat) {
                        //						$condition = " where p.category_id like '".$cat->id.",%' OR p.category_id like '%,".$cat->id."' OR p.category_id like '%,".$cat->id.",%' OR p.category_id='".$cat->id."' order by p.created desc";
                        $condition = " where FIND_IN_SET('" . $cat->id . "',p.category_id) and p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0 and FIND_IN_SET('" . $cat->id . "',p.category_id) order by p.created desc";
                        $this->data['productDetails'][$cat->cat_name] = $this->product_model->view_product_details($condition);
                    }
                }
                $this->load->view('site/user/onboarding', $this->data);
            } else {
                redirect(base_url());
            }
        }
    }

    public function onboarding_get_products_categories()
    {
        $returnCnt = '<div id="onboarding-category-items"><ol class="stream vertical">';
        $left = $top = $count = 0;
        $width = 220;
        $productArr = array();
        $catID = explode(',', $this->input->get('categories'));
        if (count($catID) > 0) {
            foreach ($catID as $cat) {
                //				$condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' OR p.category_id='".$cat."' AND p.status = 'Publish'";
                $condition = " where FIND_IN_SET('" . $cat . "',p.category_id) and p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0 and FIND_IN_SET('" . $cat . "',p.category_id) order by p.created desc";
                $productDetails = $this->product_model->view_product_details($condition);
                if ($productDetails->num_rows() > 0) {
                    foreach ($productDetails->result() as $productRow) {
                        if (!in_array($productRow->id, $productArr)) {
                            array_push($productArr, $productRow->id);
                            $img = '';
                            $imgArr = explode(',', $productRow->image);
                            if (count($imgArr) > 0) {
                                foreach ($imgArr as $imgRow) {
                                    if ($imgRow != '') {
                                        $img = $imgRow;
                                        break;
                                    }
                                }
                            }
                            if ($img != '') {
                                $count++;
                                $leftPos = $count % 3;
                                $leftPos = ($leftPos == 0) ? 3 : $leftPos;
                                $leftPos--;
                                if ($count % 3 == 0) {
                                    $topPos = $count / 3;
                                } else {
                                    $topPos = ceil($count / 3);
                                }
                                $topPos--;
                                $leftVal = $leftPos * $width;
                                $topVal = $topPos * $width;
                                $returnCnt .='
									<li style="opacity: 1; top: ' . $topVal . 'px; left: ' . $leftVal . 'px;" class="start_marker_"><span class="pre hide"></span>
										<div class="figure-item">
											<a class="figure-img">
												<span style="background-image:url(\'' . base_url() . 'images/product/' . $img . '\')" class="figure">
													<em class="back"></em>
													<img height="200" data-height="640" data-width="640" src="' . base_url() . 'images/product/' . $img . '"/>
												</span>
											</a>
											<a tid="' . $productRow->seller_product_id . '" class="button fancy noedit" href="#"><span><i></i></span>' . LIKE_BUTTON . '</a>
										</div>
									</li>
								';
                            }
                        }
                    }
                }
            }
        }
        $returnCnt .= '
			</div>
		';
        echo $returnCnt;
    }

    public function onboarding_get_users_follow()
    {
        $catID = explode(',', $this->input->get('categories'));
        $productArr = array();
        $userArr = array();
        $userCountArr = array();
        $returnArr = array();

        /*         * **********Get Suggested Users List***************************** */

        $returnArr['suggested'] = '<ul class="suggest-list">';
        if (count($catID) > 0) {
            foreach ($catID as $cat) {
                //				$condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' OR p.category_id='".$cat."' AND p.status = 'Publish'";
                $condition = " where FIND_IN_SET('" . $cat . "',p.category_id) and p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0 and FIND_IN_SET('" . $cat . "',p.category_id)";
                $productDetails = $this->product_model->view_product_details($condition);
                if ($productDetails->num_rows() > 0) {
                    foreach ($productDetails->result() as $productRow) {
                        if (!in_array($productRow->id, $productArr)) {
                            array_push($productArr, $productRow->id);
                            if ($productRow->user_id != '') {
                                if (!in_array($productRow->user_id, $userArr)) {
                                    array_push($userArr, $productRow->user_id);
                                    $userCountArr[$productRow->user_id] = 1;
                                } else {
                                    $userCountArr[$productRow->user_id] ++;
                                }
                            }
                        }
                    }
                }
            }
        }
        arsort($userCountArr);
        $limitCount = 0;
        foreach ($userCountArr as $user_id => $products) {
            if ($user_id != '') {
                $condition = array('id' => $user_id, 'is_verified' => 'Yes', 'status' => 'Active');
                $userDetails = $this->product_model->get_all_details(USERS, $condition);
                if ($userDetails->num_rows() == 1) {
                    $condition = array('user_id' => $user_id, 'status' => 'Publish');
                    $userProductDetails = $this->product_model->get_all_details(PRODUCT, $condition);
                    if ($limitCount < 10) {
                        $userImg = $userDetails->row()->thumbnail;
                        if ($userImg == '') {
                            $userImg = 'user-thumb1.png';
                        }
                        $returnArr['suggested'] .= '
							<li><span class="vcard"><img src="' . base_url() . 'images/users/' . $userImg . '"></span>
							<b>' . $userDetails->row()->full_name . '</b><br>
							' . $userDetails->row()->followers_count . ' followers<br>
							' . $userProductDetails->num_rows() . ' things<br>
							<a uid="' . $user_id . '" class="follow-user-link" href="javascript:void(0)">Follow</a>
							<span class="category-thum">';
                        $plimit = 0;
                        if ($userProductDetails->num_rows() > 0) {
                            foreach ($userProductDetails->result() as $userProduct) {
                                if ($plimit > 3) {
                                    break;
                                }
                                $img = '';
                                $imgArr = explode(',', $userProduct->image);
                                if (count($imgArr) > 0) {
                                    foreach ($imgArr as $imgRow) {
                                        if ($imgRow != '') {
                                            $img = $imgRow;
                                            break;
                                        }
                                    }
                                }
                                if ($img != '') {
                                    $returnArr['suggested'] .='<img alt="' . $userProduct->product_name . '" src="' . base_url() . 'images/product/' . $img . '">';
                                    $plimit++;
                                }
                            }
                        }

                        $returnArr['suggested'] .='</span>
							</li>
						';
                        $limitCount++;
                    }
                }
            }
        }
        $returnArr['suggested'] .='</ul>';

        /*         * ******************************************************** */

        /*         * **************Get Top Users For All Categories********* */
        $returnArr['categories'] = '';
        if ($this->data['mainCategories']->num_rows() > 0) {
            foreach ($this->data['mainCategories']->result() as $catRow) {
                if ($catRow->id != '' && $catRow->cat_name != '') {
                    $returnArr['categories'] .= '
					<div style="display:none;" class="intxt ' . url_title($catRow->cat_name, '_', true) . '">
					<p class="stit"><span>' . $catRow->cat_name . '</span>
					<button class="btns-blue-embo btn-followall">Follow All</button></p>
					<ul class="suggest-list">';
                    $userCountArr = $this->product_model->get_top_users_in_category($catRow->id);
                    $limitCount = 0;
                    foreach ($userCountArr as $user_id => $products) {
                        if ($user_id != '') {
                            $condition = array('id' => $user_id, 'is_verified' => 'Yes', 'status' => 'Active');
                            $userDetails = $this->product_model->get_all_details(USERS, $condition);
                            if ($userDetails->num_rows() == 1) {
                                $condition = array('user_id' => $user_id, 'status' => 'Publish');
                                $userProductDetails = $this->product_model->get_all_details(PRODUCT, $condition);
                                if ($limitCount < 10) {
                                    $userImg = $userDetails->row()->thumbnail;
                                    if ($userImg == '') {
                                        $userImg = 'user-thumb1.png';
                                    }
                                    $returnArr['categories'] .= '
											<li><span class="vcard"><img src="' . base_url() . 'images/users/' . $userImg . '"></span>
											<b>' . $userDetails->row()->full_name . '</b><br>
											' . $userDetails->row()->followers_count . ' followers<br>
											' . $userProductDetails->num_rows() . ' things<br>
											<a uid="' . $user_id . '" class="follow-user-link" href="javascript:void(0)">Follow</a>
											<span class="category-thum">';
                                    $plimit = 0;
                                    if ($userProductDetails->num_rows() > 0) {
                                        foreach ($userProductDetails->result() as $userProduct) {
                                            if ($plimit > 3) {
                                                break;
                                            }
                                            $img = '';
                                            $imgArr = explode(',', $userProduct->image);
                                            if (count($imgArr) > 0) {
                                                foreach ($imgArr as $imgRow) {
                                                    if ($imgRow != '') {
                                                        $img = $imgRow;
                                                        break;
                                                    }
                                                }
                                            }
                                            if ($img != '') {
                                                $returnArr['categories'] .='<img alt="' . $userProduct->product_name . '" src="' . base_url() . 'images/product/' . $img . '">';
                                                $plimit++;
                                            }
                                        }
                                    }

                                    $returnArr['categories'] .='</span>
											</li>
										';
                                    $limitCount++;
                                }
                            }
                        }
                    }
                    $returnArr['categories'] .='</ul></div>';
                }
            }
        }

        /*         * ******************************************************* */

        echo json_encode($returnArr);
    }

    public function display_product_shuffle()
    {
        $productDetails = $this->product_model->view_product_details(' where p.quantity>0 and p.status="Publish" and u.group="Seller" and u.status="Active" or p.status="Publish" and p.quantity > 0 and p.user_id=0');
        if ($productDetails->num_rows() > 0) {
            $productId = array();
            foreach ($productDetails->result() as $productRow) {
                array_push($productId, $productRow->id);
            }
            array_filter($productId);
            shuffle($productId);
            $pid = $productId[0];
            $productName = '';
            foreach ($productDetails->result() as $productRow) {
                if ($productRow->id == $pid) {
                    $productName = $productRow->product_name;
                }
            }
            if ($productName == '') {
                redirect(base_url());
            } else {
                $link = 'things/' . $pid . '/' . url_title($productName, '-');
                redirect($link);
            }
        } else {
            redirect(base_url());
        }
    }

    /* 	public function display_product_detail(){
      $pid = $this->uri->segment(2,0);
      $limit = 0;
      $relatedArr = array();
      $relatedProdArr = array();
      //		$condition = " where p.id = '".$pid."' AND p.status = 'Publish'";
      $condition = "  where p.status='Publish' and u.status='Active' and p.id='".$pid."' or p.status='Publish' and p.quantity > 0 and p.user_id=0 and p.id='".$pid."'";
      $this->data['productDetails'] = $this->product_model->view_product_details($condition);
      if ($this->data['productDetails']->num_rows()==1){
      $this->data['productComment'] = $this->product_model->view_product_comments_details('where c.product_id='.$this->data['productDetails']->row()->seller_product_id.' order by c.dateAdded desc');

      $catArr = explode(',', $this->data['productDetails']->row()->category_id);
      if (count($catArr)>0){
      foreach ($catArr as $cat){
      if ($limit>2)break;
      if ($cat != ''){
      //						$condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' AND p.id != '".$pid."' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' AND p.id != '".$pid."' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' AND p.id != '".$pid."' OR p.category_id='".$cat."' AND p.status = 'Publish' AND p.id != '".$pid."'";
      $condition =' where FIND_IN_SET("'.$cat.'",p.category_id) and p.quantity>0 and p.status="Publish" and u.group="Seller" and u.status="Active" and p.id != "'.$pid.'" or p.status="Publish" and p.quantity > 0 and p.user_id=0 and FIND_IN_SET("'.$cat.'",p.category_id) and p.id != "'.$pid.'"';
      $relatedProductDetails = $this->product_model->view_product_details($condition);
      if ($relatedProductDetails->num_rows()>0){
      foreach ($relatedProductDetails->result() as $relatedProduct){
      if (!in_array($relatedProduct->id, $relatedArr)){
      array_push($relatedArr, $relatedProduct->id);
      $relatedProdArr[] = $relatedProduct;
      $limit++;
      }
      }
      }
      }
      }
      }
      }
      $this->data['relatedProductsArr'] = $relatedProdArr;
      $recentLikeArr = $this->product_model->get_recent_like_users($this->data['productDetails']->row()->seller_product_id);
      $recentUserLikes = array();
      if ($recentLikeArr->num_rows()>0){
      foreach ($recentLikeArr->result() as $recentLikeRow){
      if ($recentLikeRow->user_id != ''){
      $recentUserLikes[$recentLikeRow->user_id] = $this->product_model->get_recent_user_likes($recentLikeRow->user_id,$this->data['productDetails']->row()->seller_product_id);
      }
      }
      }
      $this->data['recentLikeArr'] = $recentLikeArr;
      $this->data['recentUserLikes'] = $recentUserLikes;
      if ($this->checkLogin('U') != ''){
      $this->data['userDetails'] = $this->product_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
      }else {
      $this->data['userDetails'] = array();
      }
      $this->data['heading'] = $this->data['productDetails']->row()->product_name;
      if ($this->data['productDetails']->row()->meta_title != ''){
      $this->data['meta_title'] = $this->data['productDetails']->row()->meta_title;
      }
      if ($this->data['productDetails']->row()->meta_keyword != ''){
      $this->data['meta_keyword'] = $this->data['productDetails']->row()->meta_keyword;
      }
      if ($this->data['productDetails']->row()->meta_description != ''){
      $this->data['meta_description'] = $this->data['productDetails']->row()->meta_description;
      }
      print_r($this->data['productDetails']->row());
      exit;
      $this->load->view('site/product/product_detail',$this->data);
      } */
    /*     * ****For Product detail page****** */

    public function display_product_detail($seourl)
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url(signin));
        } else {
            $where = array('property_status !=' => 'Staging', 'property_status !=' => 'Sold', 'id' => $seourl);
            $this->load->model('admin_model');
            $this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
            $this->data['productDetails'] = $this->product_model->get_all_details(PRODUCT, $where);
            $this->data['productImages'] = $this->product_model->get_images($this->data['productDetails']->row()->id);
            $this->data['productAddress'] = $propAddress = $this->product_model->get_all_details(PRODUCT_ADDRESS, array('property_id' => $this->data['productDetails']->row()->id));
            $this->data['ReservedDetails'] = $this->product_model->get_all_details(RESERVED_INFO, array('property_id' => $seourl));
            $this->data['PropertyType'] = $this->product_model->get_all_details(PRODUCT_ATTRIBUTE, array('status' => 'Active'));
            $this->data['PropertySubType'] = $this->product_model->get_all_details(PRODUCT_SUBATTRIBUTE, array('status' => 'Active'));
            $product_id = $this->data['productDetails']->row()->id;
            //echo '<pre>'; print_r($this->data['productAddress']->result_array()); die;
            // Get lat and long by address
            $address = $propAddress->row()->address . ',' . $propAddress->row()->city . ',' . str_replace('-', ' ', $propAddress->row()->state);
            // Google HQ
            $prepAddr = str_replace(' ', '+', $address);
            $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false&key=AIzaSyBpgNYux9tH88p-6PF36aq5k2EK9Qf3-Yg');
            $output = json_decode($geocode);
            $this->data['lat'] = $latitude = $output->results[0]->geometry->location->lat;
            $this->data['lng'] = $longitude = $output->results[0]->geometry->location->lng;



            if ($product_id == '') {
                $this->setErrorMessage('error', 'Product details not available');
                redirect(base_url());
            }
            $this->data['CompDetails'] = $this->product_model->get_all_details(RENTALCOMPS, array('property_id' => $product_id));
            $this->data['userDetails'] = $this->product_model->get_all_details(SUBADMIN, array('email' => $this->session->userdata('fc_session_user_email')));

            $this->data['heading'] = $this->data['productDetails']->row()->meta_title;

            if ($this->data['productDetails']->row()->meta_title != '') {
                $this->data['meta_title'] = $this->data['productDetails']->row()->meta_title;
            }
            if ($this->data['productDetails']->row()->meta_keyword != '') {
                $this->data['meta_keyword'] = $this->data['productDetails']->row()->meta_keyword;
            }
            if ($this->data['productDetails']->row()->meta_description != '') {
                $this->data['meta_description'] = $this->data['productDetails']->row()->meta_description;
            }
            //echo "<pre>"; print_r(get_defined_vars()); die;
            $this->load->view('site/product/details', $this->data);
        }
    }

    public function display_all_product()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url(signin));
        } else {
            /* if ($this->data['loginCheck'] == ''){
              $this->setErrorMessage('error','Product details not available');
              redirect(base_url());
              } */
            $userId = $this->checkLogin('U');
            $this->data['menuActive'] = 'property';
            $this->data['productDetails'] = $this->product_model->get_product_details();
            $this->data['userDetails'] = $this->product_model->get_all_details(USERS, array('id' => $userId));
            $this->load->view('site/product/listing', $this->data);
        }
    }

    public function Get_All_Property_List()
    {
        $PLimit = $this->uri->segment(4, 0);
        if ($PLimit == '') {
            $PLimit = '1';
        }
        $MinPLimit = ($PLimit * 20) - 20;
        $MaxPLimit = $PLimit * 20;
        $this->data['menuActive'] = 'property';
        $this->data['productDetails'] = $this->product_model->get_product_details_limit($MinPLimit, $MaxPLimit);
        //$this->data['productDetails'] = $this->product_model->get_sold_proptery_details();
        $this->data['PropertyList'] = '';
        if ($this->data['productDetails']->num_rows() > 0) {
            foreach ($this->data['productDetails']->result() as $row) {
                $this->data['PropertyList'].=' 
			  <li class="element subcat' . $row->property_sub_type . ' cat' . $row->property_type . '"  data-category="cat' . $row->property_type . '">';
                if ($row->featured == 'Yes') {
                    $this->data['PropertyList'].= '<div class="feature"><img src="images/site/feature.png" /></div>';
                }
                $this->data['PropertyList'].='<div class="img_content"><a href="' . base_url() . 'Property/' . $row->id . '"><img src="images/product/thumb/';
                $sortArr1 = array('field' => 'imgPriority', 'type' => 'ASC');
                $this->data['one_image'] = $this->product_model->get_all_details_product(PRODUCT_PHOTOS, array('property_id' => $row->id), $sortArr1);
                if ($this->data['one_image']->row()->product_image != '') {
                    $this->data['PropertyList'].='' . $this->data['one_image']->row()->product_image . '';
                } else {
                    $this->data['PropertyList'].='dummyProductImage.jpg';
                }
                $this->data['PropertyList'].='" /></a></div><div class="clear"></div>
            <p><b class="doller_user">$</b>' . number_format($row->event_price, 0) . '<span class="number"  style="display:none">' . $row->event_price . '</span></p><span class="name_con">' . $row->city . ',<span class="name">' . ucwords(str_replace('-', ' ', $row->state)) . '</span></span>
            <div class="clear"></div>
            <div class="rates_full_list"><span>';
                if ($row->financing == 'Yes' && $row->cash_only == 'Yes') {
                    $this->data['PropertyList'].='FINANCING  AVAILABLE';
                } elseif ($row->financing == 'Yes') {
                    $this->data['PropertyList'].= 'FINANCING  AVAILABLE';
                } elseif ($row->cash_only == 'Yes') {
                    $this->data['PropertyList'].= 'CASH ONLY';
                }
                $this->data['PropertyList'].='</span><a href="' . base_url() . 'Property/' . $row->id . '" class="detail_btn">Details</a></div>
            <div class="sub_title_list"><a href="' . base_url() . 'Property/' . $row->id . '">' . $row->bedrooms . ' Bedrooms + ' . $row->baths . ' Bathrooms <br /><span class="subtitle_id"> ID:' . $row->property_id . '</span></a></div>
        	</li>';
            }

            echo $this->data['PropertyList'];





            //$this->load->view('site/product/listing',$this->data);
        }
    }

    public function Get_All_Property_List_page()
    {
        $Catg = $this->uri->segment(4, 0);
        $SubCatg = $this->uri->segment(5, 0);
        $whereCantOrder = 'p.event_price';
        if ($SubCatg > 0 && $Catg != 'viewall') {
            $whereCant = array('property_type' => $Catg, 'property_sub_type' => $SubCatg);
        } elseif ($Catg == 'state') {
            $whereCant = array();
            $whereCantOrder = 'pa.state';
        } elseif ($Catg == 'priceasc') {
            $whereCant = array();
            $whereCantOrder = 'priceasc';
        } elseif ($Catg == 'pricedesc') {
            $whereCant = array();
            $whereCantOrder = 'pricedesc';
        } elseif ($Catg == 'viewall') {
            $whereCant = array();
        } else {
            $whereCant = array('property_type' => $Catg);
        }


        $searchPerPage = 20; //$this->config->item('site_pagination_per_page');
        $paginationNo = $this->uri->segment(6, 0);






        $get_product_pagination_count = $this->product_model->get_product_details_Cat($whereCant, $whereCantOrder);
        //$get_predesigned_product_list = $this->product_model->get_product_details_Cat($whereCant,$whereCantOrder,$searchPerPage,$paginationNo);
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['num_links'] = 1;
        //$config['base_url'] = base_url().'site/product/Get_All_Property_List_page/'.$Catg.'/'.$SubCatg;
        $config['base_url'] = base_url() . 'listing/' . $Catg . '/' . $SubCatg;
        $config['total_rows'] = $get_product_pagination_count->num_rows();
        $config["per_page"] = 20; //$this->config->item('site_pagination_per_page');
        $config["uri_segment"] = 6;
        $this->pagination->initialize($config);
        $paginationLink = $this->pagination->create_links();





        $this->data['menuActive'] = 'property';
        //$this->data['productDetails'] = $this->product_model->get_product_details_Cat($whereCant,$whereCantOrder);
        $this->data['productDetails'] = $this->product_model->get_product_details_Cat($whereCant, $whereCantOrder, $searchPerPage, $paginationNo);
        //echo $this->db->last_query();die;
        //$this->data['productDetails'] = $this->product_model->get_sold_proptery_details();
        $this->data['PropertyList'] = '';
        //$this->data['PropertyList']='<ul id="container" class="listing_page">';
        if ($this->data['productDetails']->num_rows() > 0) {
            $this->data['PropertyList'].='<div id="fulldiv_container" style="float:left; width:100%"><div class="pagination"><ul class="pagination-ul">' . $paginationLink . '</ul></div><div class="clear"></div><ul id="container" class="listing_page">';
            foreach ($this->data['productDetails']->result() as $row) {
                $this->data['PropertyList'].=' 
			  <li class="element subcat' . $row->property_sub_type . ' cat' . $row->property_type . '"  data-category="cat' . $row->property_type . '">';
                if ($row->featured == 'Yes') {
                    $this->data['PropertyList'].= '<div class="feature"><img src="images/site/feature.png" /></div>';
                }
                $this->data['PropertyList'].='<div class="img_content"><a href="' . base_url() . 'Property/' . $row->id . '"><img src="'.base_url().'/images/product/thumb/';
                $sortArr1 = array('field' => 'imgPriority', 'type' => 'ASC');
                $this->data['one_image'] = $this->product_model->get_all_details_product(PRODUCT_PHOTOS, array('property_id' => $row->id), $sortArr1);
                if ($this->data['one_image']->row()->product_image != '') {
                    $this->data['PropertyList'].='' . $this->data['one_image']->row()->product_image . '';
                } else {
                    $this->data['PropertyList'].='dummyProductImage.jpg';
                }
                $this->data['PropertyList'].='" /></a></div><div class="clear"></div>
            <p><b class="doller_user">$</b>' . number_format($row->event_price, 0) . '<span class="number"  style="display:none">' . $row->event_price . '</span></p><span class="name_con">' . $row->city . ',  <span class="name">' . ucwords(str_replace('-', ' ', $row->state)) . '</span></span>
            <div class="clear"></div>
            <div class="rates_full_list"><span>';
                if ($row->financing == 'Yes' && $row->cash_only == 'Yes') {
                    $this->data['PropertyList'].='FINANCING  AVAILABLE';
                } elseif ($row->financing == 'Yes') {
                    $this->data['PropertyList'].= 'FINANCING  AVAILABLE';
                } elseif ($row->cash_only == 'Yes') {
                    $this->data['PropertyList'].= 'CASH ONLY';
                }
                $this->data['PropertyList'].='</span><a href="' . base_url() . 'Property/' . $row->id . '" class="detail_btn">Details</a></div>
            <div class="sub_title_list"><a href="' . base_url() . 'Property/' . $row->id . '">' . $row->bedrooms . ' Bedrooms + ' . $row->baths . ' Bathrooms <br /><span class="subtitle_id"> ID: ' . $row->property_id . '</span></a></div>
        	</li>';
            }
            $this->data['PropertyList'].='</ul><div class="pagination"><ul class="pagination-ul">' . $paginationLink . '</ul></div><div class="clear"></div></div>';

            echo $this->data['PropertyList'];





        //$this->load->view('site/product/listing',$this->data);
        } else {
            echo $this->data['PropertyList'] = 'No result found...';
        }
    }

    public function Get_All_Property_List_page1()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url(signin));
        }

        $Catg = $this->uri->segment(2, 0);
        $SubCatg = $this->uri->segment(3, 0);

        $whereCantOrder = 'p.event_price';
        if ($SubCatg > 0 && $Catg != 'viewall') {
            $whereCant = array('property_type' => $Catg, 'property_sub_type' => $SubCatg);
        } elseif ($Catg == 'state') {
            $whereCant = array();
            $whereCantOrder = 'pa.state';
        } elseif ($Catg == 'price') {
            $whereCant = array();
            $whereCantOrder = 'p.event_price';
        } elseif ($Catg == 'priceasc') {
            $whereCant = array();
            $whereCantOrder = 'priceasc';
        } elseif ($Catg == 'pricedesc') {
            $whereCant = array();
            $whereCantOrder = 'pricedesc';
        } elseif ($Catg == 'viewall') {
            $whereCant = array();
        } else {
            $whereCant = array('property_type' => $Catg);
        }


        $searchPerPage = 20; //$this->config->item('site_pagination_per_page');
        $paginationNo = $this->uri->segment(4, 0);






        $get_product_pagination_count = $this->product_model->get_product_details_Cat($whereCant, $whereCantOrder);
        $get_predesigned_product_list = $this->product_model->get_product_details_Cat($whereCant, $whereCantOrder, $searchPerPage, $paginationNo);
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['num_links'] = 1;
        //$config['base_url'] = base_url().'site/product/Get_All_Property_List_page/'.$Catg.'/'.$SubCatg;
        $config['base_url'] = base_url() . 'listing/' . $Catg . '/' . $SubCatg;
        $config['total_rows'] = $get_product_pagination_count->num_rows();
        $config["per_page"] = 20; //$this->config->item('site_pagination_per_page');
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config);
        $this->data['paginationLink'] = $paginationLink = $this->pagination->create_links();





        $this->data['menuActive'] = 'property';
        //$this->data['productDetails'] = $this->product_model->get_product_details_Cat($whereCant,$whereCantOrder);
        $this->data['productDetails'] = $this->product_model->get_product_details_Cat($whereCant, $whereCantOrder, $searchPerPage, $paginationNo);
        //echo $this->db->last_query();die;
        //$this->data['productDetails'] = $this->product_model->get_sold_proptery_details();
        $this->data['PropertyList'] = '';
        if ($this->data['productDetails']->num_rows() > 0) {
            $this->data['PropertyList'].='<div id="fulldiv_container" style="float:left; width:100%"><div class="pagination"><ul class="pagination-ul">' . $paginationLink . '</ul></div><div class="clear"></div><ul id="container" class="listing_page">';
            foreach ($this->data['productDetails']->result() as $row) {
                $this->data['PropertyList'].=' 
			  <li class="element subcat' . $row->property_sub_type . ' cat' . $row->property_type . '"  data-category="cat' . $row->property_type . '">';
                if ($row->featured == 'Yes') {
                    $this->data['PropertyList'].= '<div class="feature"><img src="images/site/feature.png" /></div>';
                }
                $this->data['PropertyList'].='<div class="img_content"><a href="' . base_url() . 'Property/' . $row->id . '"><img src="images/product/thumb/';

                $sortArr1 = array('field' => 'imgPriority', 'type' => 'ASC');
                $this->data['one_image'] = $this->product_model->get_all_details_product(PRODUCT_PHOTOS, array('property_id' => $row->id), $sortArr1);
                if ($this->data['one_image']->row()->product_image != '') {
                    $this->data['PropertyList'].='' . $this->data['one_image']->row()->product_image . '';
                } else {
                    $this->data['PropertyList'].='dummyProductImage.jpg';
                }
                $this->data['PropertyList'].='" /></a></div><div class="clear"></div>
            <p><b class="doller_user">$</b>' . number_format($row->event_price, 0) . '<span class="number"  style="display:none">' . $row->event_price . '</span></p><span class="name_con">' . $row->city . ', <span class="name">' . ucwords(str_replace('-', ' ', $row->state)) . '</span></span>
            <div class="clear"></div>
            <div class="rates_full_list"><span>';
                if ($row->financing == 'Yes' && $row->cash_only == 'Yes') {
                    $this->data['PropertyList'].='FINANCING  AVAILABLE';
                } elseif ($row->financing == 'Yes') {
                    $this->data['PropertyList'].= 'FINANCING  AVAILABLE';
                } elseif ($row->cash_only == 'Yes') {
                    $this->data['PropertyList'].= 'CASH ONLY';
                }
                $this->data['PropertyList'].='</span><a href="' . base_url() . 'Property/' . $row->id . '" class="detail_btn">Details</a></div>
            <div class="sub_title_list"><a href="' . base_url() . 'Property/' . $row->id . '">' . $row->bedrooms . ' Bedrooms + ' . $row->baths . ' Bathrooms <br /><span class="subtitle_id"> ID:' . $row->property_id . '</span></a></div>
        	</li>';
            }
            $this->data['PropertyList'].='</ul><div class="pagination"><ul class="pagination-ul">' . $paginationLink . '</ul></div><div class="clear"></div></div>';

            $this->data['PropertyList'];





        //$this->load->view('site/product/listing',$this->data);
        } else {
            $this->data['PropertyList'] = 'No result found...';
        }
        $this->load->view('site/product/listing', $this->data);
    }

    public function display_all_sold_proptery_nonclickable()
    {
        redirect(base_url() . 'soldlisting/viewall/0/2');
    }

    public function display_all_sold_proptery()
    {
        $ChangeCAt = $Catg = $this->uri->segment(4, 0);
        $SubCatg = $this->uri->segment(5, 0);

        $whereCantOrder = 'p.event_price';
        if ($SubCatg > 0 && $Catg != 'viewall') {
            if ($ChangeCAt == 'priceasc' || $ChangeCAt == 'pricedesc') {
                $whereCant = array();
            } else {
                $whereCant = array('property_type' => $Catg, 'property_sub_type' => $SubCatg);
            }
        } elseif ($Catg == 'state') {
            $whereCant = array();
            $whereCantOrder = 'pa.state';
        } elseif ($Catg == 'priceasc') {
            $whereCant = array();
            $whereCantOrder = 'priceasc';
        } elseif ($Catg == 'pricedesc') {
            $whereCant = array();
            $whereCantOrder = 'pricedesc';
        } elseif ($Catg == 'viewall') {
            $whereCant = array();
        } else {
            if ($ChangeCAt == 'priceasc' || $ChangeCAt == 'pricedesc') {
                $whereCant = array('property_type' => 'price');
            } else {
                $whereCant = array('property_type' => $Catg);
            }
        }


        $searchPerPage = 20; //$this->config->item('site_pagination_per_page');
        $paginationNo = $this->uri->segment(6, 0);


        $get_product_pagination_count = $this->product_model->get_sold_proptery_details($whereCant, $whereCantOrder);
        //$get_predesigned_product_list = $this->product_model->get_sold_proptery_details($whereCant,$whereCantOrder,$searchPerPage,$paginationNo);
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['num_links'] = 1;
        //$config['base_url'] = base_url().'site/product/Get_All_Property_List_page/'.$Catg.'/'.$SubCatg;
        if ($ChangeCAt == 'priceasc' || $ChangeCAt == 'pricedesc') {
            $config['base_url'] = base_url() . 'soldlisting/price/' . $SubCatg;
        } elseif ($ChangeCAt == 'viewall') {
            $config['base_url'] = base_url() . 'soldlisting/viewall/0';
        } else {
            $config['base_url'] = base_url() . 'soldlisting/' . $Catg . '/' . $SubCatg;
        }



        $config['total_rows'] = $get_product_pagination_count->num_rows();
        $config["per_page"] = 20; //$this->config->item('site_pagination_per_page');
        $config["uri_segment"] = 6;
        $this->pagination->initialize($config);
        $paginationLink = $this->pagination->create_links();





        $this->data['menuActive'] = 'Sold Property';
        //$this->data['productDetails'] = $this->product_model->get_product_details_Cat($whereCant,$whereCantOrder);
        $this->data['productDetails'] = $this->product_model->get_sold_proptery_details($whereCant, $whereCantOrder, $searchPerPage, $paginationNo);
        //echo $this->db->last_query();die;
        //$this->data['productDetails'] = $this->product_model->get_sold_proptery_details();
        $this->data['PropertyList'] = '';
        $this->data['PropertyList'].='<div id="fulldiv_container" style="float:left; width:100%"><div class="pagination"><ul class="pagination-ul">' . $paginationLink . '</ul></div><div class="clear"></div><ul id="container" class="listing_page">';
        if ($this->data['productDetails']->num_rows() > 0) {
            //			$this->data['PropertyList']='<div style="float:right;">'.$paginationLink.'</div>';
            foreach ($this->data['productDetails']->result() as $row) {
                $this->data['PropertyList'].=' 
			  <li class="element subcat' . $row->property_sub_type . ' cat' . $row->property_type . '"  data-category="cat' . $row->property_type . '">';
                if ($row->featured == 'Yes') {
                    $this->data['PropertyList'].= '<div class="feature"><img src="images/site/feature.png" /></div>';
                }
                $this->data['PropertyList'].='<div class="img_content"><a><img src="'.base_url().'/images/product/';
                $sortArr1 = array('field' => 'imgPriority', 'type' => 'ASC');
                $this->data['one_image'] = $this->product_model->get_all_details_product(PRODUCT_PHOTOS, array('property_id' => $row->id), $sortArr1);
                if ($this->data['one_image']->row()->product_image != '') {
                    $this->data['PropertyList'].='' . $this->data['one_image']->row()->product_image . '';
                } else {
                    $this->data['PropertyList'].='no_image.jpg';
                }
                $this->data['PropertyList'].='" /></a></div><div class="clear"></div>
            <p><b class="doller_user">$</b>' . number_format($row->event_price, 0) . '<span class="number"  style="display:none">' . $row->event_price . '</span></p><span class="name_con">' . $row->city . ',<span class="name">' . ucwords(str_replace('-', ' ', $row->state)) . '</span></span>
            <div class="clear"></div>
            <div class="rates_full_list"><span>';
                if ($row->financing == 'Yes' && $row->cash_only == 'Yes') {
                    $this->data['PropertyList'].='FINANCING  AVAILABLE';
                } elseif ($row->financing == 'Yes') {
                    $this->data['PropertyList'].= 'FINANCING  AVAILABLE';
                } elseif ($row->cash_only == 'Yes') {
                    $this->data['PropertyList'].= 'CASH ONLY';
                }
                $this->data['PropertyList'].='</span><a class="detail_btn">Details</a></div>
            <div class="sub_title_list"><a>' . $row->bedrooms . ' Bedrooms + ' . $row->baths . ' Bathrooms </a></div>
        	</li>';
            }
            $this->data['PropertyList'].='</ul><div class="pagination"><ul class="pagination-ul">' . $paginationLink . '</ul></div><div class="clear"></div></div>';

            echo $this->data['PropertyList'];





        //$this->load->view('site/product/listing',$this->data);
        } else {
            echo $this->data['PropertyList'] = 'No result found...';
        }
    }

    public function display_all_sold_proptery_limit()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url(signin));
        }

        $ChangeCAt = $Catg = $this->uri->segment(2, 0);
        $SubCatg = $this->uri->segment(3, 0);

        $whereCantOrder = 'p.event_price';
        if ($SubCatg > 0 && $Catg != 'viewall') {
            if ($ChangeCAt == 'priceasc' || $ChangeCAt == 'pricedesc') {
                $whereCant = array();
            } else {
                $whereCant = array('property_type' => $Catg, 'property_sub_type' => $SubCatg);
            }
        } elseif ($Catg == 'state') {
            $whereCant = array();
            $whereCantOrder = 'pa.state';
        } elseif ($Catg == 'priceasc') {
            $whereCant = array();
            $whereCantOrder = 'priceasc';
        } elseif ($Catg == 'pricedesc') {
            $whereCant = array();
            $whereCantOrder = 'pricedesc';
        } elseif ($Catg == 'viewall') {
            $whereCant = array();
        } else {
            if ($ChangeCAt == 'priceasc' || $ChangeCAt == 'pricedesc') {
                $whereCant = array('property_type' => 'price');
            } else {
                $whereCant = array('property_type' => $Catg);
            }
        }


        $searchPerPage = 20; //$this->config->item('site_pagination_per_page');
        $paginationNo = $this->uri->segment(4, 0);






        $get_product_pagination_count = $this->product_model->get_sold_proptery_details($whereCant, $whereCantOrder);
        $get_predesigned_product_list = $this->product_model->get_sold_proptery_details($whereCant, $whereCantOrder, $searchPerPage, $paginationNo);
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['num_links'] = 1;
        //$config['base_url'] = base_url().'site/product/Get_All_Property_List_page/'.$Catg.'/'.$SubCatg;
        if ($ChangeCAt == 'priceasc' || $ChangeCAt == 'pricedesc') {
            $config['base_url'] = base_url() . 'soldlisting/price/' . $SubCatg;
        } elseif ($ChangeCAt == 'viewall') {
            $config['base_url'] = base_url() . 'soldlisting/viewall/0';
        } else {
            $config['base_url'] = base_url() . 'soldlisting/' . $Catg . '/' . $SubCatg;
        }




        $config['total_rows'] = $get_product_pagination_count->num_rows();
        $config["per_page"] = 20; //$this->config->item('site_pagination_per_page');
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config);
        $this->data['paginationLink'] = $paginationLink = $this->pagination->create_links();





        $this->data['menuActive'] = 'property';
        //$this->data['productDetails'] = $this->product_model->get_product_details_Cat($whereCant,$whereCantOrder);
        $this->data['productDetails'] = $this->product_model->get_sold_proptery_details($whereCant, $whereCantOrder, $searchPerPage, $paginationNo);
        //echo $this->db->last_query();die;
        //print_r($this->data['productDetails']).'Appu'; die;
        //echo $this->db->last_query().'Kiruba';die;
        //$this->data['productDetails'] = $this->product_model->get_sold_proptery_details();
        $this->data['PropertyList'] = '';

        if ($this->data['productDetails']->num_rows() > 0) {
            $this->data['PropertyList'].='<div id="fulldiv_container" style="float:left; width:100%"><div class="pagination"><ul class="pagination-ul">' . $paginationLink . '</ul></div><div class="clear"></div><ul id="container" class="listing_page">';
            foreach ($this->data['productDetails']->result() as $row) {
                $this->data['PropertyList'].=' 
			  <li class="element subcat' . $row->property_sub_type . ' cat' . $row->property_type . '"  data-category="cat' . $row->property_type . '">';
                if ($row->featured == 'Yes') {
                    $this->data['PropertyList'].= '<div class="feature"><img src="images/site/feature.png" /></div>';
                }
                $this->data['PropertyList'].='<div class="img_content"><a><img src="images/product/';
                $sortArr1 = array('field' => 'imgPriority', 'type' => 'ASC');
                $this->data['one_image'] = $this->product_model->get_all_details_product(PRODUCT_PHOTOS, array('property_id' => $row->id), $sortArr1);
                if ($this->data['one_image']->row()->product_image != '') {
                    $this->data['PropertyList'].='' . $this->data['one_image']->row()->product_image . '';
                } else {
                    $this->data['PropertyList'].='no_image.jpg';
                }
                $this->data['PropertyList'].='" /></a></div><div class="clear"></div>
            <p><b class="doller_user">$</b>' . number_format($row->event_price, 0) . '<span class="number"  style="display:none">' . $row->event_price . '</span></p><span class="name_con">' . $row->city . ',<span class="name">' . ucwords(str_replace('-', ' ', $row->state)) . '</span></span>
            <div class="clear"></div>
            <div class="rates_full_list"><span>';
                if ($row->financing == 'Yes' && $row->cash_only == 'Yes') {
                    $this->data['PropertyList'].='FINANCING  AVAILABLE';
                } elseif ($row->financing == 'Yes') {
                    $this->data['PropertyList'].= 'FINANCING  AVAILABLE';
                } elseif ($row->cash_only == 'Yes') {
                    $this->data['PropertyList'].= 'CASH ONLY';
                }
                $this->data['PropertyList'].='</span><a class="detail_btn">Details</a></div>
            <div class="sub_title_list"><a>' . $row->bedrooms . ' Bedrooms + ' . $row->baths . ' Bathrooms </a></div>
        	</li>';
            }
            $this->data['PropertyList'].='</ul><div class="pagination"><ul class="pagination-ul">' . $paginationLink . '</ul></div><div class="clear"></div></div>';

            $this->data['PropertyList'];





        //$this->load->view('site/product/listing',$this->data);
        } else {
            $this->data['PropertyList'] = 'No result found...';
        }
        $this->load->view('site/product/soldlisting', $this->data);
    }

    public function delete_featured_find()
    {
        $uid = $this->checkLogin('U');
        $dataArr = array('feature_product' => '');
        $condition = array('id' => $uid);
        $this->product_model->update_details(USERS, $dataArr, $condition);
        echo '1';
    }

    public function add_featured_find()
    {
        $pid = $this->input->post('tid');
        $uid = $this->checkLogin('U');
        $dataArr = array('feature_product' => $pid);
        $condition = array('id' => $uid);
        $this->product_model->update_details(USERS, $dataArr, $condition);
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        $createdTime = mdate($datestring, $time);
        $actArr = array(
            'activity' => 'featured',
            'activity_id' => $pid,
            'user_id' => $this->checkLogin('U'),
            'activity_ip' => $this->input->ip_address(),
            'created' => $createdTime
        );
        $this->product_model->simple_insert(NOTIFICATIONS, $actArr);
        $this->send_feature_noty_mail($pid);
        echo '1';
    }

    public function share_with_someone()
    {
        $returnStr['status_code'] = 0;
        $thing = array();
        $thing['url'] = $this->input->post('url');
        $thing['name'] = $this->input->post('name');
        $thing['id'] = $this->input->post('oid');
        $thing['refid'] = $this->input->post('email');
        $thing['refid'] = $this->input->post('ooid');
        $thing['msg'] = $this->input->post('message');
        $thing['uname'] = $this->input->post('uname');
        $thing['timage'] = base_url() . $this->input->post('timage');
        $email = $this->input->post('emails');
        $users = $this->input->post('users');
        if (valid_email($email)) {
            $this->send_thing_share_mail($thing, $email);
            $returnStr['status_code'] = 1;
        } else {
            $returnStr['message'] = 'Invalid email';
        }
        echo json_encode($returnStr);
    }

    public function send_thing_share_mail($thing = '', $email = '')
    {
        $newsid = '2';
        $template_values = $this->product_model->get_newsletter_template_details($newsid);
        $subject = 'From: ' . $template_values['news_title'] . ' - ' . $template_values['news_subject'];

        $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>'.$template_values['news_descrip'].'</body>
			</html>';

        if ($template_values['sender_name'] == '' && $template_values['sender_email'] == '') {
            $sender_email = $this->data['siteContactMail'];
            $sender_name = $this->data['siteTitle'];
        } else {
            $sender_name = $template_values['sender_name'];
            $sender_email = $template_values['sender_email'];
        }

        $message = str_replace('{$First_Name}', $thing['uname'], $message);
        $message = str_replace('{$Last_Name}', $thing['name'], $message);
        $message = str_replace('{$Email}', $this->config->item('email_title'), $message);
        $message = str_replace('{$Comment}', $thing['msg'], $message);
        $message = str_replace('{$email_title}', $sender_name, $message);
        $message = str_replace('{$meta_title}', $sender_name, $message);
        $message = str_replace('{base_url()}images/logo/{$logo}', $this->data['logo'], $message);
        $message = str_replace('{base_url()}', base_url(), $message);

        $email_values = array('mail_type' => 'html',
            'from_mail_id' => $sender_email,
            'mail_name' => $sender_name,
            'to_mail_id' => $this->config->item('site_contact_mail'),
            'subject_message' => $subject,
            'body_messages' => $message
        );

        $email_send_to_common = $this->product_model->common_email_send($email_values);

        /* 		echo $this->email->print_debugger();die;
         */
    }

    public function loadStateListValues()
    {
        $returnStr['listCountryCnt'] = '<select class="text_field required" name="city" tabindex="-1"  data-placeholder="Please select the city name">';
        $lid = $this->input->post('lid');
        $lvID = $this->input->post('lvID');
        if ($lid != '') {
            $listValues = $this->product_model->get_all_details(CITY, array('stateid' => $lid));
            if ($listValues->num_rows() > 0) {
                foreach ($listValues->result() as $listRow) {
                    $selStr = '';
                    if ($listRow->id == $lvID) {
                        $selStr = 'selected="selected"';
                    }
                    $returnStr['listCountryCnt'] .= '<option ' . $selStr . ' value="' . $listRow->id . '">' . $listRow->name . '</option>';
                }
            } else {
                $returnStr['listCountryCnt'] .= '<option value="">---Select---</option>';
            }
        }
        $returnStr['listCountryCnt'] .= '</select>';


        echo json_encode($returnStr);
    }

    public function add_have_tag()
    {
        $returnStr['status_code'] = 0;
        $tid = $this->input->post('thing_id');
        $uid = $this->checkLogin('U');
        if ($uid != '') {
            $ownArr = explode(',', $this->data['userDetails']->row()->own_products);
            $ownCount = $this->data['userDetails']->row()->own_count;
            if (!in_array($tid, $ownArr)) {
                array_push($ownArr, $tid);
                $ownCount++;
                $dataArr = array('own_products' => implode(',', $ownArr), 'own_count' => $ownCount);
                $wantProducts = $this->product_model->get_all_details(WANTS_DETAILS, array('user_id' => $this->checkLogin('U')));
                if ($wantProducts->num_rows() == 1) {
                    $wantProductsArr = explode(',', $wantProducts->row()->product_id);
                    if (in_array($tid, $wantProductsArr)) {
                        if (($key = array_search($tid, $wantProductsArr)) !== false) {
                            unset($wantProductsArr[$key]);
                        }
                        $wantsCount = $this->data['userDetails']->row()->want_count;
                        $wantsCount--;
                        $dataArr['want_count'] = $wantsCount;
                        $this->product_model->update_details(WANTS_DETAILS, array('product_id' => implode(',', $wantProductsArr)), array('user_id' => $uid));
                    }
                }
                $this->product_model->update_details(USERS, $dataArr, array('id' => $uid));
                $returnStr['status_code'] = 1;
            }
        }
        echo json_encode($returnStr);
    }

    public function delete_have_tag()
    {
        $returnStr['status_code'] = 0;
        $tid = $this->input->post('thing_id');
        $uid = $this->checkLogin('U');
        if ($uid != '') {
            $ownArr = explode(',', $this->data['userDetails']->row()->own_products);
            $ownCount = $this->data['userDetails']->row()->own_count;
            if (in_array($tid, $ownArr)) {
                if ($key = array_search($tid, $ownArr) !== false) {
                    unset($ownArr[$key]);
                    $ownCount--;
                }
                $this->product_model->update_details(USERS, array('own_products' => implode(',', $ownArr), 'own_count' => $ownCount), array('id' => $uid));
                $returnStr['status_code'] = 1;
            }
        }
        echo json_encode($returnStr);
    }

    public function upload_product_image()
    {
        $returnStr['status_code'] = 0;
        $config['overwrite'] = false;
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        //	    $config['max_size'] = 2000;
        $config['upload_path'] = './images/product';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('thefile')) {
            $imgDetails = $this->upload->data();
            $returnStr['image']['url'] = base_url() . 'images/product/' . $imgDetails['file_name'];
            $returnStr['image']['width'] = $imgDetails['image_width'];
            $returnStr['image']['height'] = $imgDetails['image_height'];
            $returnStr['image']['name'] = $imgDetails['file_name'];
            $this->imageResizeWithSpace(600, 600, $imgDetails['file_name'], './images/product/');
            $returnStr['status_code'] = 1;
        } else {
            $returnStr['message'] = 'Can\'t be upload';
        }
        echo json_encode($returnStr);
    }

    public function add_new_thing()
    {
        $returnStr['status_code'] = 0;
        $returnStr['message'] = '';
        if ($this->checkLogin('U') != '') {
            $pid = $this->product_model->add_user_product($this->checkLogin('U'));
            $returnStr['status_code'] = 1;
            $userDetails = $this->data['userDetails'];
            $total_added = $userDetails->row()->products;
            $total_added++;
            $this->product_model->update_details(USERS, array('products' => $total_added), array('id' => $this->checkLogin('U')));
            $returnStr['thing_url'] = 'user/' . $userDetails->row()->user_name . '/things/' . $pid . '/' . url_title($this->input->post('name'), '-');
        }
        echo json_encode($returnStr);
    }

    public function display_user_thing()
    {
        $uname = $this->uri->segment(2, 0);
        $pid = $this->uri->segment(4, 0);
        $this->data['productUserDetails'] = $this->product_model->get_all_details(USERS, array('user_name' => $uname));
        $this->data['productDetails'] = $this->product_model->get_all_details(USER_PRODUCTS, array('seller_product_id' => $pid, 'status' => 'Publish'));
        if ($this->data['productDetails']->num_rows() == 1) {
            $this->data['heading'] = $this->data['productDetails']->row()->product_name;
            $categoryArr = explode(',', $this->data['productDetails']->row()->category_id);
            $catID = 0;
            if (count($categoryArr) > 0) {
                foreach ($categoryArr as $catRow) {
                    if ($catRow != '') {
                        $catID = $catRow;
                        break;
                    }
                }
            }
            $this->data['relatedProductsArr'] = $this->product_model->get_products_by_category($catID);
            if ($this->data['productDetails']->row()->meta_title != '') {
                $this->data['meta_title'] = $this->data['productDetails']->row()->meta_title;
            }
            if ($this->data['productDetails']->row()->meta_keyword != '') {
                $this->data['meta_keyword'] = $this->data['productDetails']->row()->meta_keyword;
            }
            if ($this->data['productDetails']->row()->meta_description != '') {
                $this->data['meta_description'] = $this->data['productDetails']->row()->meta_description;
            }
            $this->load->view('site/product/display_user_product', $this->data);
        } else {
            $this->load->view('site/product/product_detail', $this->data);
            //			$this->setErrorMessage('error','Product details not available');
            //		redirect(base_url());
        }
    }

    public function sales_create()
    {
        if ($this->checkLogin('U') == '') {
            redirect('login');
        } else {
            $userType = $this->data['userDetails']->row()->group;
            if ($userType == 'Seller') {
                $pid = $this->input->get('ntid');
                $productDetails = $this->product_model->get_all_details(USER_PRODUCTS, array('seller_product_id' => $pid));
                if ($productDetails->num_rows() == 1) {
                    if ($productDetails->row()->user_id == $this->data['userDetails']->row()->id) {
                        $this->data['productDetails'] = $productDetails;
                        $this->data['editmode'] = '0';
                        $this->load->view('site/product/edit_seller_product', $this->data);
                    } else {
                        show_404();
                    }
                } else {
                    show_404();
                }
            } else {
                redirect('seller-signup');
            }
        }
    }

    /**
     *
     * Ajax function for delete the product pictures
     */
    public function editPictureProducts()
    {
        $ingIDD = $this->input->post('imgId');
        $currentPage = $this->input->post('cpage');
        $id = $this->input->post('val');
        $productImage = explode(',', $this->session->userdata('product_image_' . $ingIDD));
        if (count($productImage) < 2) {
            echo json_encode("No");
            exit();
        } else {
            $empImg = 0;
            foreach ($productImage as $product) {
                if ($product != '') {
                    $empImg++;
                }
            }
            if ($empImg < 2) {
                echo json_encode("No");
                exit();
            }
            $this->session->unset_userdata('product_image_' . $ingIDD);
            $resultVar = $this->setPictureProducts($productImage, $this->input->post('position'));
            $insertArrayItems = trim(implode(',', $resultVar)); //need validation here...because the array key changed here

            $this->session->set_userdata(array('product_image_' . $ingIDD => $insertArrayItems));
            $dataArr = array('image' => $insertArrayItems);
            $condition = array('id' => $ingIDD);
            $this->product_model->update_details(PRODUCT, $dataArr, $condition);
            echo json_encode($insertArrayItems);
        }
    }

    public function edit_product_detail()
    {
        if ($this->checkLogin('U') == '') {
            redirect('login');
        } else {
            $pid = $this->uri->segment(2, 0);
            $data->prop_addressprop_addressprop_addressiewMode = $this->uri->segment(4, 0);
            $productDetails = $this->product_model->get_all_details(USER_PRODUCTS, array('seller_product_id' => $pid));
            if ($productDetails->num_rows() == 1) {
                if ($productDetails->row()->user_id == $this->checkLogin('U')) {
                    $this->data['productDetails'] = $productDetails;
                    $this->load->view('site/product/edit_user_product', $this->data);
                } else {
                    show_404();
                }
            } else {
                $productDetails = $this->product_model->get_all_details(PRODUCT, array('seller_product_id' => $pid));
                $this->data['categoryView'] = $this->product_model->get_category_details($productDetails->row()->category_id);
                $this->data['atrributeValue'] = $this->product_model->view_atrribute_details();
                if ($productDetails->num_rows() == 1) {
                    if ($productDetails->row()->user_id == $this->checkLogin('U')) {
                        $this->data['productDetails'] = $productDetails;
                        $this->data['editmode'] = '1';
                        if ($data->first_namefirst_namefirst_nameiewMode == '') {
                            $this->load->view('site/product/edit_seller_product', $this->data);
                        } else {
                            $this->load->view('site/product/edit_seller_product_' . $data->last_namelast_namelast_nameiewMode, $this->data);
                        }
                    } else {
                        show_404();
                    }
                } else {
                    show_404();
                }
            }
        }
    }

    /* Edited by mano */

    public function index($city)
    {
        $_SESSION['searchCity'] = $city;
        $searchResult = explode('?', $_SERVER['REQUEST_URI']);
        $search = '(1=1';
        if (count($searchResult) > 1) {
            $search_var = $searchResult[1];
            $search_array = explode('&', $search_var);
            if ($search_array[0] == 'city=' && $search_array[1] == 'rentalid=') {
                $this->setErrorMessage('error', 'Empty searches are not allowed');
                redirect(base_url());
            }
            if (!empty($search_array)) {
                foreach ($search_array as $key => $data->entity_nameentity_nameentity_namealue) {
                    $data->resrv_typeresrv_typeresrv_typear = explode('=', $data->addressaddressaddressalue);

                    if ($data->citycitycityar[0] == 'p' && $data->statestatestatear[1] != '') {
                        $search .= ' and p.price_range="' . $data->countrycountrycountryar[1] . '" ';
                    }
                    if ($data->post_codepost_codepost_codear[0] == 'city' && $data->ph_noph_noph_noar[1] != '') {
                        $search .= ' and (c.name like "%' . $data->ph_no1ph_no1ph_no1ar[1] . '%" or c.name = "%' . $data->emailemailemailar[1] . '%") ';
                    }
                    if ($data->email1email1email1ar[0] == 'rentalid' && $data->sales_pricesales_pricesales_pricear[1] != '') {
                        $search .= ' and (p.id like "%' . $data->reserv_pricereserv_pricereserv_pricear[1] . '%" or p.id = "%' . $data->cash_paymentcash_paymentcash_paymentar[1] . '%") ';
                    }
                    if ($data->check_paymentcheck_paymentcheck_paymentar[0] == 'datefrom' && $data->credit_paymentcredit_paymentcredit_paymentar[1] != '') {
                        $search .= ' and b.datefrom > "' . $data->sales_cashsales_cashsales_cashar[1] . '"  ';
                    }
                    if ($data->sales_cfsales_cfsales_cfar[0] == 'expiredate' && $data->sales_fssales_fssales_fsar[1] != '') {
                        $search .= ' and b.expiredate < "' . $data->sales_slsales_slsales_slar[1] . '"  ';
                    }
                }
            }
        }
        if ($city != 'search' && $city != '') {
            $search .= ' and c.seourl = "' . $city . '"  ';
        }
        //echo $_SESSION['searchCity']; die;
        $search .= ' ) and ';

        $this->data['productList'] = $this->product_model->view_product_details_site('  where ' . $search . ' (u.group="Seller" and u.status="Active" or p.user_id=0 ) group by p.id order by p.created desc');

        $this->data['heading'] = $this->data['productList']->row()->city_name;
        if ($this->data['productList']->row()->meta_title != '') {
            $this->data['meta_title'] = $this->data['productList']->row()->meta_title;
        }
        if ($this->data['productList']->row()->meta_keyword != '') {
            $this->data['meta_keyword'] = $this->data['productList']->row()->meta_keyword;
        }
        if ($this->data['productList']->row()->meta_description != '') {
            $this->data['meta_description'] = $this->data['productList']->row()->meta_description;
        }

        $this->data['product_image'] = $this->product_model->Display_product_image_details();
        $this->data['image_count'] = $this->product_model->Display_product_image_details_all();
        $this->load->view('site/product/listing', $this->data);
    }

    public function BrowseAll()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $_SESSION['searchCity'] = 'Browse All';

            $this->data['productList'] = $this->product_model->view_product_details_site('  where ' . $search . ' (u.group="Seller" and u.status="Active" or p.user_id=0 ) group by p.id order by p.created desc');

            $this->data['heading'] = 'Browse all listings';


            $this->data['product_image'] = $this->product_model->Display_product_image_details();
            $this->data['image_count'] = $this->product_model->Display_product_image_details_all();
            $this->load->view('site/product/listing', $this->data);
        }
    }

    public function Get_All_Property_Feature_List_page()
    {
        $ChangeCAt = $Catg = $this->uri->segment(4, 0);
        $SubCatg = $this->uri->segment(5, 0);

        $whereCantOrder = 'p.event_price';
        if ($SubCatg > 0 && $Catg != 'viewall') {
            if ($ChangeCAt == 'asc' || $ChangeCAt == 'desc') {
                $whereCant = array();
            } else {
                $whereCant = array('property_type' => $Catg, 'property_sub_type' => $SubCatg);
            }
        } elseif ($Catg == 'state') {
            $whereCant = array();
            $whereCantOrder = 'pa.state';
        } elseif ($Catg == 'asc') {
            $whereCant = array();
            $whereCantOrder = 'priceasc';
        } elseif ($Catg == 'desc') {
            $whereCant = array();
            $whereCantOrder = 'pricedesc';
        } elseif ($Catg == 'viewall') {
            $whereCant = array();
        } else {
            if ($ChangeCAt == 'asc' || $ChangeCAt == 'desc') {
                $whereCant = array('property_type' => 'price');
            } else {
                $whereCant = array('property_type' => $Catg);
            }
        }



        $this->data['productDetails'] = $this->product_model->get_Featured_proptery_details($whereCant, $whereCantOrder);


        //print_r($this->data['productDetails']);




        $this->data['menuActive'] = 'property';
        //$this->data['productDetails'] = $this->product_model->get_product_details_Cat($whereCant,$whereCantOrder);
        //$this->data['productDetails'] =$this->product_model->view_product_details(' where p.property_status="Active" and p.featured="Yes" group by p.id order by p.event_price '.$Catg.'');
        //echo $this->db->last_query();die;
        //$this->data['productDetails'] = $this->product_model->get_sold_proptery_details();
        $this->data['PropertyList'] = '';
        //$this->data['PropertyList']='<ul id="container" class="listing_page">';
        if ($this->data['productDetails']->num_rows() > 0) {
            foreach ($this->data['productDetails']->result() as $row) {
                $this->data['PropertyList'].=' 
			  <li class="element subcat' . $row->property_sub_type . ' cat' . $row->property_type . '"  data-category="cat' . $row->property_type . '">';
                if ($row->featured == 'Yes') {
                    $this->data['PropertyList'].= '<div class="feature"><img src="images/site/feature.png" /></div>';
                }
                $this->data['PropertyList'].='<div class="img_content"><a href="' . base_url() . 'Property/' . $row->id . '"><img src="'.base_url().'/images/product/thumb/';
                if ($row->product_image != '') {
                    $this->data['PropertyList'].='' . $row->product_image . '';
                } else {
                    $this->data['PropertyList'].='dummyProductImage.jpg';
                }
                $this->data['PropertyList'].='" /></a></div><div class="clear"></div>
            <p>' . $row->city . ',  <span class="name">' . ucwords(str_replace('-', ' ', $row->state)) . '</span></p>
            <div class="clear"></div>
            <div class="rates_full"><b class="doller_user" style="font-size:16px">$</b><b style="font-size:16px">' . number_format($row->event_price, 0) . '</b><span class="number" style="margin-left:0px; display:none">' . $row->event_price . '</span><a href="';



                if ($loginCheck == '') {
                    $this->data['PropertyList'].='' . base_url() . 'signin';
                } else {
                    $this->data['PropertyList'].='' . base_url() . 'Property/' . $row->id . '/' . $row->property_id;
                }

                $this->data['PropertyList'].='" class="detail_btn ">Details</a></div>
			<div class="sub_title"><a href="';

                if ($loginCheck == '') {
                    $this->data['PropertyList'].='' . base_url() . 'signin';
                } else {
                    $this->data['PropertyList'].='' . base_url() . 'Property/' . $row->id . '/' . $row->property_id;
                }
                $this->data['PropertyList'].='">' . $row->bedrooms . 'Bedrooms + ' . $row->baths . ' Bathrooms </a></div>
      </li>';
            }
            //$this->data['PropertyList']='</ul>';
            //$this->data['PropertyList'].='<div style="float:right;">'.$paginationLink.'</div>';
            echo $this->data['PropertyList'];





        //$this->load->view('site/product/listing',$this->data);
        } else {
            echo $this->data['PropertyList'] = 'No result found...';
        }
    }

    public function StateRentalView($state)
    {
        //$_SESSION['searchCity']='';

        $search = "s.seourl ='" . $state . "'";
        $this->data['productList'] = $this->product_model->view_product_details_site('  where (' . $search . ') and (u.group="Seller" and u.status="Active" or p.user_id=0 ) group by p.id order by p.created desc');

        $_SESSION['searchCity'] = 'state';
        $this->data['heading'] = $this->data['productList']->row()->statemtitle;
        if ($this->data['productList']->row()->statemtitle != '') {
            $this->data['meta_title'] = $this->data['productList']->row()->statemtitle;
        }
        if ($this->data['productList']->row()->statemkey != '') {
            $this->data['meta_keyword'] = $this->data['productList']->row()->statemkey;
        }
        if ($this->data['productList']->row()->statemdesc != '') {
            $this->data['meta_description'] = $this->data['productList']->row()->statemdesc;
        }


        $this->data['product_image'] = $this->product_model->Display_product_image_details();
        $this->data['image_count'] = $this->product_model->Display_product_image_details_all();
        $this->load->view('site/product/listing', $this->data);
    }

    /* map view */

    public function mapview($city)
    {
        $this->data['Product_igggd'] = $this->uri->segment(3, 0);
        $this->data['statetag'] = $this->uri->segment(2, 0);

        $searchResult = explode('?', $_SERVER['REQUEST_URI']);


        $search = '(1=1';



        if (count($searchResult) > 1) {
            $search_var = $searchResult[1];
            $search_array = explode('&', $search_var);
            if (!empty($search_array)) {
                foreach ($search_array as $key => $data->sales_sdirasales_sdirasales_sdiraalue) {
                    $data->cust_namecust_namecust_namear = explode('=', $data->account_noaccount_noaccount_noalue);
                    if ($data->res_coderes_coderes_codear[0] == 'p' && $data->res_sourceres_sourceres_sourcear[1] != '') {
                        $search .= ' and p.price_range="' . $data->notenotenotear[1] . '" ';
                    }
                    if ($data->saleDatesaleDatesaleDatear[0] == 'city' && $data->soldAdminsoldAdminsoldAdminar[1] != '') {
                        $search .= ' and (c.name like "%' . $data->ar[1] . '%" or c.name = "%' . $data->ar[1] . '%") ';
                    }




                    if ($data->ar[0] == 'datefrom' && $data->ar[1] != '') {
                        $search .= ' and b.datefrom > "' . $data->ar[1] . '"  ';
                    }
                    if ($data->ar[0] == 'expiredate' && $data->ar[1] != '') {
                        $search .= ' and b.expiredate < "' . $data->ar[1] . '"  ';
                    }
                }
            }
        }
        if ($city != 'search' && $city != '' && $this->data['statetag'] != 'state' && $this->data['statetag'] != 'rental') {
            $search .= ' and c.seourl = "' . $city . '"  ';
        }

        if ($this->data['Product_igggd'] != '' && $this->data['statetag'] == 'state' && $this->data['statetag'] != 'rental') {
            $search .= ' and s.seourl = "' . $this->data['Product_igggd'] . '"  ';
        }
        if ($this->data['Product_igggd'] != '' && $this->data['statetag'] != 'state' && $this->data['statetag'] == 'rental') {
            $search .= ' and p.product_name like "' . $this->data['Product_igggd'] . '"  ';
        }
        $search .= ' ) and ';
        $this->data['heading'] = '';
        $this->data['productList'] = $this->product_model->view_product_details_sitemapview('  where ' . $search . ' (u.group="Seller" and u.status="Active" or p.user_id=0 ) group by p.id order by p.created desc');

        if ($this->data['Product_igggd'] != '' && $this->data['statetag'] == 'state') {
            $this->data['heading'] = $this->data['productList']->row()->statemtitle;
            if ($this->data['productList']->row()->statemtitle != '') {
                $this->data['meta_title'] = $this->data['productList']->row()->statemtitle;
            }
            if ($this->data['productList']->row()->statemkey != '') {
                $this->data['meta_keyword'] = $this->data['productList']->row()->statemkey;
            }
            if ($this->data['productList']->row()->statemdesc != '') {
                $this->data['meta_description'] = $this->data['productList']->row()->statemdesc;
            }
        } else {
            $this->data['heading'] = $this->data['productList']->row()->city_name;
            if ($this->data['productList']->row()->meta_title != '') {
                $this->data['meta_title'] = $this->data['productList']->row()->meta_title;
            }
            if ($this->data['productList']->row()->meta_keyword != '') {
                $this->data['meta_keyword'] = $this->data['productList']->row()->meta_keyword;
            }
            if ($this->data['productList']->row()->meta_description != '') {
                $this->data['meta_description'] = $this->data['productList']->row()->meta_description;
            }
        }

        $this->data['product_image'] = $this->product_model->Display_product_image_details();
        $this->data['image_count'] = $this->product_model->Display_product_image_details_all();
        $this->load->view('site/product/mapview', $this->data);
    }

    public function gen_search($rental)
    {
        $searchResult = explode('?', $_SERVER['REQUEST_URI']);
        if (count($searchResult) > 1) {
            $search_var = $searchResult[1];
            $search_array = explode('&', $search_var);
        }
        $res = explode('=', $search_array[0]);
        if ($res[1] != 'search' && $res[1] != '') {
            $this->data['heading'] = 'Search keyword is ' . trim(str_replace('+', ' ', $res[1]));
            $this->data['gensearch'] = 'search';
            $search = ' p.product_name like "%' . trim(str_replace('+', ' ', $res[1])) . '%"';
            $this->data['productList'] = $this->product_model->view_product_details_site('  where ' . $search . ' and p.status="Publish" group by p.id order by p.created desc');
        } else {
            $this->setErrorMessage('error', 'Empty searches are not allowed');
            redirect(base_url());
        }
        $this->data['product_image'] = $this->product_model->Display_product_image_details();
        $this->data['image_count'] = $this->product_model->Display_product_image_details_all();
        $this->load->view('site/product/listing', $this->data);
    }

    /*     * *********For autocomplete in landing************** */

    public function search_text()
    {
        $data = $this->input->post();
        $cities = $this->product_model->view_cities($data['text']);
        if (count($cities) > 0) {
            echo '<ul>';
            foreach ($cities as $city) {
                echo '<li class="for_auto_complete_text">' . $city->email . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<ul><li>No results found</li></ul>';
        }
        exit;
    }

    /*     * *********** */

    /*     * *********For autocomplete in header************** */

    public function general_search()
    {
        $data = $this->input->post();
        $rentals = $this->product_model->view_rental($data['text']);
        if (count($rentals) > 0) {
            echo '<ul>';
            foreach ($rentals as $rental) {
                echo '<li class="for_general_complete_text">' . $rental->product_name . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<ul><li>No results found</li></ul>';
        }
        exit;
    }

    /*     * *********** */


    /*     * ******Testimonial******** */

    public function testimonial()
    {
        $this->load->model('testimonials_model');
        $condition = array('status' => 'Active');
        $this->data['details'] = $this->testimonials_model->get_all_details(TESTIMONIALS, $condition);
        $this->load->view('site/testimonial/testimonials', $this->data);
    }

    /*     * ************** */

    public function view_calendar()
    {
        $user_id = $this->input->get('pid');
        $this->data['productList'] = $user_id;

        //$this->load->view('site/product/front_calendar',$this->data);



        echo '
        <link rel="stylesheet" type="text/css" href="' . base_url() . 'css/jquery.dop.FrontendBookingCalendarPRO.css" />

<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/style.css" />
<script type="text/JavaScript" src="' . base_url() . 'js/jquery-latest.js"></script>

<script type="text/JavaScript" src="' . base_url() . 'js/jquery.dop.FrontendBookingCalendarPRO.js"></script>

<script type="text/JavaScript">
            $(function(){

				$("#frontend").DOPFrontendBookingCalendarPRO({
		"ID": ' . $user_id . ',
		"DataURL": "' . base_url() . 'dopbcp/php-database/load.php"
	});
            });
        </script>
<div id="wrapper">
     <div id="frontend-container">
      <div id="frontend"></div>
  </div>
</div>
';
    }

    public function edit_calendar()
    {
        $user_id = $this->input->get('pid');
        $this->data['productList'] = $user_id;

        //$this->load->view('site/product/front_calendar',$this->data);


        /*
          echo '
          <link rel="stylesheet" type="text/css" href="'.base_url().'css/jquery.dop.BackendBookingCalendarPRO.css" />

          <link rel="stylesheet" type="text/css" href="'.base_url().'css/style.css" />
          <script type="text/JavaScript" src="'.base_url().'js/jquery-latest.js"></script>

          <script type="text/JavaScript" src="'.base_url().'js/jquery.dop.BackendBookingCalendarPRO.js"></script>

          <script type="text/JavaScript">
          $(function(){

          $("#backend").DOPBackendBookingCalendarPRO({
          "ID": '.$user_id.',
          "DataURL": "'.base_url().'dopbcp/php-database/load.php"
          });
          });
          </script>
          <div id="wrapper">
          <div id="backend-container">
          <div id="backend"></div>
          </div>
          </div>
          '; */


        echo '

<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/jquery.dop.BackendBookingCalendarPRO.css" />
<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/style.css" />
<script type="text/JavaScript" src="' . base_url() . 'js/jquery-latest.js"></script>
<script type="text/JavaScript" src="' . base_url() . 'js/jquery.dop.BackendBookingCalendarPRO.js"></script>

<script type="text/JavaScript">
            $(function(){
                $("#backend").DOPBackendBookingCalendarPRO({
				"ID": ' . $user_id . ',
		"DataURL": "' . base_url() . 'dopbcp/php-database/load.php",
       "SaveURL": "' . base_url() . 'dopbcp/php-database/save.php"
});


                $("#backend").DOPBackendBookingCalendarPRO({"DataURL": "dopbcp/php-database/load.php",
                                                            "SaveURL": "dopbcp/php-database/save.php"});

                $("#backend-refresh").click(function(){
                    $("#backend").DOPBackendBookingCalendarPRO({"Reinitialize": true});
              
                    $("#backend").DOPBackendBookingCalendarPRO({"Reinitialize": true,
                                                                "DataURL": "dopbcp/php-database/load.php",
                                                                "SaveURL": "dopbcp/php-database/save.php"});
                });
            });
        </script>
		
</head>
<body>
<div id="wrapper">
  <div id="backend-container">

    <div id="backend"></div>
  </div>
</div>
<b style="color:#FF0000">Note:</b> Choose the dates and select "available" from the status field, enter the "price" in price field and click submit to book the dates
';
    }

    public function dropSort()
    {
        //print_r($_POST); die;
        //echo $pid = $this->uri->segment(2,0);die;
        $rentalval = '';
        //echo $this->uri->segment(); die;
        //print_r($_SESSION['searchCity']);die;

        if ($_POST['searchstaterental'] == 'nostate' && $_POST['searchrental'] == '' && $_POST['cityurl'] != '' && $_POST['rental'] != '') {
            $rentalval = $_POST['rental'];
            $condi = array();
        } elseif ($_POST['searchstaterental'] != 'nostate') {
            $condi = array('s.seourl' => $_POST['searchstaterental']);
        } else {
            if ($_SESSION['searchCity'] == 'Browse All') {
                $condi = array();
            } else {
                $condi = array('pa.city' => $_POST['cityurl']);
            }
        }


        if ($_POST['price'] != '') {
            $cond0 = array('price_range' => $_POST['price']);
        } else {
            $cond0 = array();
        }
        if ($_POST['bed'] != '') {
            $cond1 = array('bedroom' => $_POST['bed']);
        } else {
            $cond1 = array();
        }
        if ($_POST['sleep'] != '') {
            $cond2 = array('sleeps' => $_POST['sleep']);
        } else {
            $cond2 = array();
        }
        if ($_POST['bath'] != '') {
            $cond3 = array('bathroom' => $_POST['bath']);
        } else {
            $cond3 = array();
        }

        if ($_POST['searchrental'] != '') {
            $cond4 = array('p.id' => $_POST['searchrental']);
        } else {
            $cond4 = array();
        }

        $cond = array_merge($cond0, $cond1, $cond2, $cond3, $condi, $cond4);
        /* elseif($_GET['type'] == 'bedroom'){
          $cond = 'where price_range = "'.$_GET['val'].'"';
          } */
        $productDetails = $this->product_model->view_product_details_site_codei($cond, $rentalval);
        //echo '<pre>';
        //print_r($productDetails); die;
        //echo $this->db->last_query(); die;
        $this->data['product_image'] = $product_image = $this->product_model->Display_product_image_details();
        $this->data['image_count'] = $image_count = $this->product_model->Display_product_image_details_all();

        $this->data['productList'] = $productList = $productDetails;

        $ajaxDisplay .='<ul id="results" class="unstyled">';
        $products = $productList->result();
        if (!empty($products)) {
            $imageTotalArray = $image_count->result_array();
            foreach ($products as $product) {
                $count = 0;
                foreach ($imageTotalArray as $imageOne) {
                    if ($imageOne['product_id'] == $product->id) {
                        $count = $imageOne['count_image'];
                    }
                }
                foreach ($product_image->result() as $productImag) {
                    if ($product->id == $productImag->product_id) {
                        $image = img(array('src' => base_url('images/product/' . $productImag->product_image), 'width' => '192', 'height' => '113'));
                    }
                }
                $ajaxDisplay .='<li class="search_result">
                        <div class="pop_image_small">
                            <a href="' . base_url('rental/' . $product->id) . '">                          
                                <div class="list-media-box">' . $image . '
                                  <div class="listing-count2 panel-background-dark-trans panel-border">' . $count . ' Photos</div>
                                </div>
                            </a>
                        </div>
                        <div class="room_right">
                        <h3 class="room_title overflow-ellipsis">
                            <a href="' . base_url('rental/' . $product->id) . '">' . stripslashes($product->product_name) . '</a>
                        </h3>
                        <ul class="reputation unstyled">
                                <li class="badge badge_type_reviews-bubble">
                                    <span class="badge_image">
                                        <span class="badge_text reviews-bubble">' . stripslashes($product->bedroom) . '</span>
                                    </span>
                                    <span class="badge_name">Bedrooms</span>
                                </li>
                                <li class="badge badge_type_reviews-bubble">
                                    <span class="badge_image">
                                        <span class="badge_text reviews-bubble">' . stripslashes($product->bathroom) . '</span>
                                    </span>
                                    <span class="badge_name">Bathrooms</span>
                                </li>
                                <li class="badge badge_type_reviews-bubble">
                                    <span class="badge_image">
                                        <span class="badge_text reviews-bubble">' . stripslashes($product->sleeps) . '</span>
                                    </span>
                                    <span class="badge_name">Sleeps</span>
                                </li>
                                
                        </ul>
                        <div class="price ">
                            <div class="price_data">$' . $product->price . '/Day</div>
                        </div>
                        <ul class="room_btn">
						 <li>' . anchor(base_url('rental/' . $product->id), 'Details', array('class' => 'submit_btn')) . '</li>
                            <li>' . anchor(base_url('rental/' . $product->id . '#features'), 'Review', array('class' => 'submit_btn')) . '</li>
                        </ul>
                        </div>
                    </li>';
            }
        } else {
            echo '<li><center>There is no rentals avaliable.</center></li>';
        }

        echo $ajaxDisplay .=' </ul>';
        //$this->load->view('site/product/listing',$this->data);
    }

    /*     * *********Write review product details page************** */

    public function write_review()
    {
        //echo 'hi'; die;
        $this->data['userDetails'] = 'no';
        if ($this->checkLogin('U') != '') {
            $condition = array('id' => $this->checkLogin('U'));
            $this->data['userDetails'] = $this->user_model->get_all_details(USERS, $condition);
        }
        $_SESSION['ReviewProductId'] = $pid = $this->uri->segment(2);

        $this->data['productDetails'] = $this->product_model->Write_product_review_details("and p.id='" . $pid . "'");
        $this->load->view('site/product/write_review', $this->data);
    }

    public function write_review1()
    {
        //echo 'hi'; die;
        $_SESSION['ReviewProductId'] = $pid = $this->uri->segment(1);
        $this->data['productDetails'] = $this->product_model->Write_product_review_details("and p.id='" . $pid . "'");
        $this->load->view('site/product/write_review1', $this->data);
    }

    public function add_review()
    {
        $dataArr = array('firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'status' => 'Active',
            'message' => $_POST['message']);
        //$insertquery = $this->product_model->add_review($dataArr);
        $this->product_model->commonInsertUpdate(CONTACT, 'insert', array('captcha_original', 'captcha_value', 'signin'), $dataArr, array(''));
        ///E$this->load->view('site/product/write_review',$this->data);
        $this->setErrorMessage('success', 'The form has been submitted successfully. One of our representatives will get back to you shortly.');
        $id = $this->product_model->get_last_insert_id();
        $contactDetails = $this->product_model->get_all_details(CONTACT, array('id' => $id));
        if ($contactDetails->num_rows() > 0) {
            $this->send_contact_mail($contactDetails);
        }
        redirect(base_url() . 'contact');
    }

    /* Ajax function for display review detail */

    public function display_review_detail()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'Review Management';
            $condition1 = array('id' => $this->checkLogin('U'), 'status' => 'Active');
            $sort = array('field' => 'id', 'type' => 'desc');
            $this->data['userDetail'] = $this->product_model->get_all_details(USERS, $condition1);
            if ($this->data['userDetail']->row()->group == 'Seller') {
                $condition = array('user_id' => $this->checkLogin('U'), 'status' => 'Active');
            } else {
                $condition = array('reviewer_id' => $this->checkLogin('U'), 'status' => 'Active');
            }
            $this->data['ReviewDisplay'] = $this->product_model->get_all_details(REVIEW, $condition, array($sort));
            $this->data['ProductDisplay'] = $this->product_model->get_selected_fields_records('product_name,id,user_id', PRODUCT, array('status' => 'Publish'));

            $this->load->view('site/user/view_review', $this->data);
        }
    }

    /**
     *
     * Ajax function for delete the product image
     */
    public function DeleteImageProducts()
    {
        $ingIDD = $this->input->post('imgId');
        $currentPage = $this->input->post('cpage');
        $condition = array('id' => $ingIDD);
        $this->product_model->commonDelete(PRODUCT_PHOTOS, $condition);
        echo $result = 1;
    }

    /**
     *
     * Ajax function for delete the product image
     */
    public function DeleteSiteProducts()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        }
        $userId = $this->checkLogin('U');
        $ingIDD = $this->input->post('imgId');
        $prdId = array('product_id' => $ingIDD);
        $currentPage = $this->input->post('cpage');
        $condition = array('id' => $ingIDD);
        $this->product_model->commonDelete(PRODUCT, $condition);
        $this->product_model->commonDelete(PRODUCT_ADDRESS, $prdId);
        $this->product_model->commonDelete(PRODUCT_BOOKING, $prdId);
        $this->product_model->commonDelete(REVIEW, $prdId);
        $this->product_model->commonDelete(PRODUCT_FEATURES, $prdId);
        $this->product_model->commonDelete(PRODUCT_PHOTOS, $prdId);
        $this->product_model->commonDelete(CONTACT, array('rental_id' => $ingIDD));
        $this->product_model->Rental_count_Decre($userId);

        echo $result = 1;
    }

    /**
     *
     * This function change the selling product status
     */
    public function ChangeStatus()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $ingIDD = $this->input->post('imgId');
            $Status = $this->input->post('cste');
            $currentPage = $this->input->post('cpage');
            $condition = array('id' => $ingIDD);

            $newdata = array('status' => $Status);
            $condition = array('id' => $ingIDD);
            $this->product_model->update_details(PRODUCT, $newdata, $condition);
            echo $result = 1;
        }
    }

    public function viewMemberCalendar($id = '')
    {
        if ($this->checkLogin('U') != '') {
            $propertyId = $this->uri->segment(4);
            $idArr = array('id' => $propertyId);
            //print_r($idArr); die;
            $this->data['idArr'] = $idArr;
            $this->load->view('site/product/dashboard_viewcalendar', $this->data);
        } else {
            redirect('signin');
        }
    }

    /* Property Manage start */

    public function titlecheck()
    {
        $title = $this->input->post('value');
        $condition = array('product_name' => $title);
        $dbvalue = $this->product_model->get_all_details(PRODUCT, $condition);
        if ($dbvalue->num_rows() > 0) {
            echo $result = 1;
        }
    }

    public function buy_property()
    {
        $code = $this->input->post('code');
        $secretCode = $this->product_model->get_all_details(ADMIN_SETTINGS, array('booking_code' => $code));
        if ($secretCode->num_rows() == 1) {
            redirect(listing);
        } else {
            $this->setErrorMessage('error', 'You have entred wrong reservation code');
            echo "<script>window.history.go(-1)</script>";
            exit();
        }
    }

    public function reservation_form($seourl)
    {
        if ($this->checkLogin('U')=='') {
            redirect(base_url(signin));
        } else {
            if ($_SESSION['differenceTime'] > 0) {
                $this->setErrorMessage('error', 'You already have a property in reservation');
                redirect(listing);
            } else {
                $where = array('id'=>$seourl);
                $this->data['productDetails'] = $this->product_model->get_all_details(PRODUCT, $where);
                
                $product_id = $this->data['productDetails']->row()->id;
                if ($product_id =='') {
                    $this->setErrorMessage('error', 'Product details not available');
                    redirect(base_url());
                }
                //echo '<pre>'; print_r($this->data['productDetails']->result());die;
                if ($this->data['productDetails']->row()->property_status == 'Active') {
                    $userId = $this->checkLogin('U');
                    $this->product_model->update_details(SUBADMIN, array('reservation' => 'Yes', 'property_id' => $seourl), array('id' => $userId));
                    $this->load->model('admin_model');
                    $this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
                    $this->data['UserList'] = $result = $this->admin_model->get_all_details(USERS, array('status'=>'Active','is_verified'=>'Yes'));
            
                    $this->data['productImages'] = $this->product_model->get_images($this->data['productDetails']->row()->id);
                    $this->data['productAddress'] = $this->product_model->get_all_details(PRODUCT_ADDRESS, array('property_id' => $this->data['productDetails']->row()->id));
                    
                    $this->data['reservationCode'] = $this->product_model->get_all_details(ATTRIBUTE, array('status' => 'Active'));
                        
                    
                    $resTime = time();
                    $this->product_model->update_details(PRODUCT, array('property_status'=>'Reserved'), $where);
                    $this->product_model->update_details(PRODUCT, array('reserved_time'=>$resTime), $where);
                
            
                    $this->load->helper('cookie');
            
                    unset($_SESSION['sCheckTimeReser']);
                    unset($_SESSION['sCheckTimeSold']);
                    if ($_SESSION['endtimer'] == '') {
                        //setcookie("differenceTime",'');
                        unset($_SESSION['differenceTime']);
                    } elseif ($_SESSION['endtimer'] < time()) {
                        unset($_SESSION['differenceTime']);
                        unset($_SESSION['endtimer']);
                    }
                    if ($_SESSION['differenceTime'] == '') {
                        $_SESSION['endtimer'] = time()+600;
                        $_SESSION['reservation'] = time()+600;
                        $_SESSION['differenceTime'] = 600;
                    } else {
                        $differenceTime = $_SESSION['endtimer'] - time();
                        $_SESSION['differenceTime'] = $differenceTime;
                    }
            
                    //echo $_SESSION['differenceTime']; die;
            
                    $this->data['heading'] = $this->data['productDetails']->row()->meta_title;
        
                    if ($this->data['productDetails']->row()->meta_title != '') {
                        $this->data['meta_title'] = $this->data['productDetails']->row()->meta_title;
                    }
                    if ($this->data['productDetails']->row()->meta_keyword != '') {
                        $this->data['meta_keyword'] = $this->data['productDetails']->row()->meta_keyword;
                    }
                    if ($this->data['productDetails']->row()->meta_description != '') {
                        $this->data['meta_description'] = $this->data['productDetails']->row()->meta_description;
                    }
            
                    //echo $this->db->last_query(); die;
            
                    $this->product_model->saveResevedSettings();
            
                    //print_r($_SESSION['differenceTime']);die;
                    //$this->load->view('site/product/details',$this->data);
                    //print_r($_COOKIE['differenceTime']); die;
                    $this->load->view('site/product/reservation', $this->data);
                } else {
                    //$this->setErrorMessage('error',"<div  style='display:none;'>  <div id='inline_reserved' style='background:#fff;'> <div class='property_view'> <p style='margin:27px 0 10px 0px;'>Property id(".echo $productDetails->row()->id.") is reserved</p>  </div> </div> </div>");
                    $this->setErrorMessage('error', 'The property '.$this->data['productDetails']->row()->property_id.' is Reserved');
                    redirect('listing');
                }
            }
        }
    }
    
    public function reservation_cont($seourl)
    {
        if ($this->checkLogin('U')=='') {
            redirect(base_url(signin));
        } else {
            $where = array('id'=>$seourl);
            $this->data['productDetails'] = $this->product_model->get_all_details(PRODUCT, $where);

            if ($_SESSION['reservation'] < time()) {
                $this->product_model->update_details(PRODUCT, array('property_status' => 'Active'), $where);
                    
                $this->product_model->commonDelete(RESERVED_INFO, array('property_id'=> $seourl));
                    
                $user = $this->checkLogin('U');
                $this->product_model->update_details(SUBADMIN, array('reservation' => 'No'), array('id' => $user));
                    
                unset($_SESSION['differenceTime']);
                unset($_SESSION['endtimer']);
                unset($_SESSION['reservation']);
                    
                $this->setErrorMessage('error', 'Your time has Expired Please reserve your property again.');
                $this->product_model->saveResevedSettings();
                redirect(base_url(). 'Property/'.$where['id'].'/'. $this->data['productDetails']->row()->property_id);
            }
            

            $userId = $this->checkLogin('U');
            $this->product_model->update_details(SUBADMIN, array('reservation' => 'Yes', 'property_id' => $seourl), array('id' => $userId));
            $this->load->model('admin_model');
            $this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
            $this->data['UserList'] = $result = $this->admin_model->get_all_details(SUBADMIN, array('status'=>'Active','is_verified'=>'Yes'));
            
            $this->data['productImages'] = $this->product_model->get_images($this->data['productDetails']->row()->id);
            $this->data['productAddress'] = $this->product_model->get_all_details(PRODUCT_ADDRESS, array('property_id' => $this->data['productDetails']->row()->id));
            
            $this->data['reservationCode'] = $this->product_model->get_all_details(ATTRIBUTE, array('status' => 'Active'));
            
            $product_id = $this->data['productDetails']->row()->id;
            if ($product_id =='') {
                $this->setErrorMessage('error', 'Product details not available');
                redirect(base_url());
            }
            
            
            
            if ($_SESSION['endtimer'] == '') {
                //setcookie("differenceTime",'');
                unset($_SESSION['differenceTime']);
            } elseif ($_SESSION['endtimer'] < time()) {
                unset($_SESSION['differenceTime']);
                unset($_SESSION['endtimer']);
            }
            if ($_SESSION['differenceTime'] == '') {
                $_SESSION['endtimer'] = time()+600;
                
                $_SESSION['differenceTime'] = 600;
            } else {
                $differenceTime = $_SESSION['endtimer'] - time();
                $_SESSION['differenceTime'] = $differenceTime;
            }
            
            
            
            
            
            
            $this->data['heading'] = $this->data['productDetails']->row()->meta_title;
        
            if ($this->data['productDetails']->row()->meta_title != '') {
                $this->data['meta_title'] = $this->data['productDetails']->row()->meta_title;
            }
            if ($this->data['productDetails']->row()->meta_keyword != '') {
                $this->data['meta_keyword'] = $this->data['productDetails']->row()->meta_keyword;
            }
            if ($this->data['productDetails']->row()->meta_description != '') {
                $this->data['meta_description'] = $this->data['productDetails']->row()->meta_description;
            }
            
            $dataArr=array('property_status'=>'Reserved');
            $condition=array('id'=>$seourl);
            
            $this->product_model->edit_product($dataArr, $condition);
            
            $this->product_model->saveResevedSettings();
            
            
            //$this->load->view('site/product/details',$this->data);
            //print_r($_COOKIE['differenceTime']); die;
            $this->load->view('site/product/reservation', $this->data);
            /*  }
            else
            {
                //$this->setErrorMessage('error',"<div  style='display:none;'>  <div id='inline_reserved' style='background:#fff;'> <div class='property_view'> <p style='margin:27px 0 10px 0px;'>Property id(".echo $productDetails->row()->id.") is reserved</p>  </div> </div> </div>");
                $this->setErrorMessage('error','The property '.$this->data['productDetails']->row()->property_id.' is Reserved');
                redirect(listing);
            }*/
        }
    }
    
    
    public function get_Resevation_Value()
    {
        $this->product_model->saveResevedSettings();
    }
    
    public function Get_Reservation_User()
    {
        $uid = $this->input->post('uid');
        $returnStr['success'] = '0';
        $secretCode = $this->product_model->get_all_details(USERS, array('email' => $uid));
        if ($secretCode->num_rows() == 1) {
            $returnStr['first_name'] = $secretCode->row()->first_name;
            $returnStr['last_name'] = $secretCode->row()->last_name;
            $returnStr['user_name'] = $secretCode->row()->user_name;
            $returnStr['email'] = $secretCode->row()->email;
                    
            $returnStr['address'] = $secretCode->row()->address;
            $returnStr['address1'] = $secretCode->row()->address1;
            $returnStr['city'] = $secretCode->row()->city;
            $returnStr['state'] = $secretCode->row()->state;
            $returnStr['country'] = $secretCode->row()->country;
            $returnStr['postal_code'] = $secretCode->row()->postal_code;
            $returnStr['phone_no'] = $secretCode->row()->phone_no;
            $returnStr['user_id'] = $secretCode->row()->id;
                    
            $returnStr['success'] = '1';
        } else {
            $returnStr['alert_msg'] = 'Email Id Does Not Exists.';
        }
        echo json_encode($returnStr);
    }
    public function ReservationForm_Submit()
    {
        $product_source_details = $this->product_model->get_all_details(SOURCE_INFO, array('property_id'=>$this->input->post('property_id')));
        $source_info = unserialize(stripslashes($product_source_details->row()->datavalues));
            
        $this->db->select('monthly_rent,annual_rent,hazard_ins,net_income,management_expenses,property_tax,utilities');
        $this->db->from(PRODUCT);
        $this->db->where('id = '.$this->input->post('property_id'));
        $PrdtDets = $this->db->get();
        //echo '<pre>'; print_r($PrdtDets->result());die;
            
        $datestring = "%Y-%m-%d %H:%i:%s";
        $time = time();
        $dataArr1=array('property_status'=>'Sold','property_display'=>'1','modified' => mdate($datestring, $time));
        $condition1=array('id'=>$_POST['property_id']);
        $id = $this->checkLogin('U');
        $this->product_model->edit_product($dataArr1, $condition1);
        $condition = array();
        $excludeArr = array('signin','SelectUser','password','conf_password','CheckBox_adjustment');
        $dataArr=array('user_id'=>$_POST['user_id'], 'sold_admin_id' => $this->checkLogin('U'), 'sold_admin_name' => $this->session->userdata('fc_session_user_name'),
                        's_firstname'=>$source_info['s_firstname'],'s_lastname'=>$source_info['s_lastname'],'s_companyname'=>$source_info['s_companyname'],
                        's_address'=>$source_info['s_address'],'s_city'=>$source_info['s_city'],'s_state'=>$source_info['s_state'],'s_zipcode'=>$source_info['s_zipcode'],
                        's_contact1'=>$source_info['s_contact1'],'s_contact2'=>$source_info['s_contact2'],'s_phone1'=>$source_info['s_phone1'],'s_phone2'=>$source_info['s_phone2'],
                        's_email'=>$source_info['s_email'],'p_manager_name'=>$source_info['m_name'],'p_manager_address'=>$source_info['m_address'],
                        'p_manager_city'=>$source_info['m_city'],'p_manager_state'=>$source_info['m_state'],'p_manager_zipcode'=>$source_info['m_zipcode'],
                        'p_manager_contact1'=>$source_info['m_contact1'],'p_manager_contact2'=>$source_info['m_contact2'],'p_manager_phone1'=>$source_info['m_phone1'],
                        'p_manager_phone2'=>$source_info['m_phone2'],'p_manager_email'=>$source_info['m_email'],'p_manager_fax'=>$source_info['m_fax'],
                        'p_tenant_name'=>$source_info['t_name'],'p_lease_term'=>$source_info['lease_term'],'p_section_8'=>$source_info['section8'],'p_manager_fee'=>$source_info['mfee'],   'pr_monthly_rent'=>$PrdtDets->row()->monthly_rent,'pr_annual_rent'=>$PrdtDets->row()->annual_rent,'pr_hazard_ins'=>$PrdtDets->row()->hazard_ins,'pr_net_income'=>$PrdtDets->row()->net_income,'pr_mgmt_expense'=>$PrdtDets->row()->management_expenses,'pr_property_tax'=>$PrdtDets->row()->property_tax,'pr_utilities'=>$PrdtDets->row()->utilities);
                        
        if ($this->input->post('net_purchase_price')=='') {
            $dataArr1=array('net_purchase_price'=>$_POST['sales_price']);
            $dataArr = array_merge($dataArr, $dataArr1);
        }
            
            
        $condition1 = array('email'=>$this->input->post('email'));
            
        $dataArrNewUSer=array('first_name'=>$this->input->post('first_name'),
                                'last_name'=>$this->input->post('last_name'),
                                'address'=>$this->input->post('address'),
                                'country'=>$this->input->post('country'),
                                'state'=>$this->input->post('state'),
                                'city'=>$this->input->post('city'),
                                'postal_code'=>$this->input->post('postal_code'),
                                'phone_no'=>$this->input->post('phone_no'),
                                'phone_no1'=>$this->input->post('phone_no1'),
                                'email'=>$this->input->post('email'),
                                'email1'=>$this->input->post('email1'));
            
        $users = $this->product_model->update_details(USERS, $dataArrNewUSer, $condition1);
        //echo $this->db->last_query();
        //echo '<pre>'; print_r($dataArrNewUSer); die;
            
        $condition1 = array('email'=>$this->input->post('email'));
        $user = $this->product_model->get_all_details(USERS, $condition1);
            

        $this->product_model->update_details(SUBADMIN, array('reservation'=>'No'), array('id'=>$id));
            
        $this->product_model->commonInsertUpdate(RESERVED_INFO, 'insert', $excludeArr, $dataArr, $condition);
        $proID= $this->product_model->get_last_insert_id();
        //$proID
        $this->product_model->simple_insert(STATUS, array('reserved_id'=>$proID));
            
        $this->product_model->saveResevedSettings();
        $this->product_model->saveSoldSettings();
        
        unset($_SESSION['differenceTime']);
        unset($_SESSION['endtimer']);
        unset($_SESSION['reservation']);
            
            
            
            
        unset($_SESSION['rfname']);
        unset($_SESSION['rlname']);
        unset($_SESSION['rename']);
        unset($_SESSION['rtype']);
        unset($_SESSION['raddress']);
        unset($_SESSION['rcountry']);
        unset($_SESSION['rstate']);
        unset($_SESSION['rcity']);
        unset($_SESSION['rzip']);
        unset($_SESSION['rphno']);
        unset($_SESSION['rphno1']);
        unset($_SESSION['remail']);
        unset($_SESSION['remail1']);
        unset($_SESSION['rreservprice']);
        unset($_SESSION['rnote']);
                
        unset($_SESSION['rcashpt']);
        unset($_SESSION['rcheckpt']);
        unset($_SESSION['rcreditpt']);
        unset($_SESSION['rdotpt']);
        unset($_SESSION['rsalescash']);
        unset($_SESSION['rsalescf']);
        unset($_SESSION['rsalescs']);
        unset($_SESSION['rsalessdira']);
        unset($_SESSION['rsalesfs']);
        unset($_SESSION['rsalessl']);
                
        unset($_SESSION['cust_name']);
        unset($_SESSION['acco_no']);
        unset($_SESSION['office_source']);
        unset($_SESSION['event_source']);
            
            
            
            
        
        $this->setErrorMessage('success', 'Congratulations! You have successful Reserved this property! Please have the property specialist print you out a copy of your Property Reservation Confirmation Hot Sheet.');
        /*echo '<form name="_xclick" id="_xclick" action="http://192.168.1.253/ramasamy/ReturnOnRentals/" target="_blank">
    <input type="submit" />
</form>
<script type="text/javascript">
    document.forms["_xclick"].submit();
</script>';*/
            
        $this->send_reservation_success_mail($proID);
        if ($user->num_rows() ==0) {
            $this->register_reserve_user($proID);
        } else {
            $this->product_model->update_details(RESERVED_INFO, array('user_id' => $user->row()->id), array('id' => $proID));
        }

        $this->session->set_userdata('proID', $proID);

        //$this->load->view('site/product/reservation_conform',$this->data);
        redirect(base_url('listing/viewall/0/2'));
        //redirect(base_url());
    }


    public function changetoActive()
    {
        $userID = $this->checkLogin('U');
        $id = $this->uri->segment(4, 0);
        $dataArr = array('property_status' => 'Active');
        $condition = array('id' => $id);
        $this->product_model->update_details(PRODUCT, $dataArr, $condition);
        $this->product_model->update_details(SUBADMIN, array('reservation' => 'No', 'property_id' => 0), array('id' => $userID));
        unset($_SESSION['differenceTime']);
        unset($_SESSION['endtimer']);
        unset($_SESSION['reservation']);

        unset($_SESSION['rfname']);
        unset($_SESSION['rlname']);
        unset($_SESSION['rename']);
        unset($_SESSION['rtype']);
        unset($_SESSION['raddress']);
        unset($_SESSION['rcountry']);
        unset($_SESSION['rstate']);
        unset($_SESSION['rcity']);
        unset($_SESSION['rzip']);
        unset($_SESSION['rphno']);
        unset($_SESSION['rphno1']);
        unset($_SESSION['remail']);
        unset($_SESSION['remail1']);
        unset($_SESSION['rreservprice']);
        unset($_SESSION['rnote']);

        unset($_SESSION['rcashpt']);
        unset($_SESSION['rcheckpt']);
        unset($_SESSION['rcreditpt']);
        unset($_SESSION['rdotpt']);
        unset($_SESSION['rsalescash']);
        unset($_SESSION['rsalescf']);
        unset($_SESSION['rsalescs']);
        unset($_SESSION['rsalessdira']);
        unset($_SESSION['rsalesfs']);
        unset($_SESSION['rsalessl']);

        unset($_SESSION['cust_name']);
        unset($_SESSION['acco_no']);
        unset($_SESSION['office_source']);
        unset($_SESSION['event_source']);


        $this->product_model->saveResevedSettings();
        $this->setErrorMessage('error', 'Your time has expired Please try again.');
        redirect('listing/viewall/0');
    }

    public function changetoReserverd()
    {
        $userID = $this->checkLogin('U');
        $id = $this->input->post('prdid');
        $dataArr = array('property_status' => 'Reserved');
        $condition = array('id' => $id);
        $this->product_model->update_details(PRODUCT, $dataArr, $condition);
        echo 'Success';
    }

    public function register_reserve_user($proID)
    {
        $email = $this->input->post('email');
        if (valid_email($email)) {
            $condition = array('email' => $email);
            $duplicateMail = $this->user_model->get_all_details(USERS, $condition);
            $duplicateAdminMail = $this->user_model->get_all_details(ADMIN, $condition);
            $duplicateSubAdminMail = $this->user_model->get_all_details(SUBADMIN, $condition);

            if ($duplicateMail->num_rows() > 0) {
                $this->product_model->update_details(RESERVED_INFO, array('user_id' => $duplicateMail->row()->id), array('id' => $proID));
                $this->setErrorMessage('error', 'Email id already exists');
                redirect('signup');
            } elseif ($duplicateAdminMail->num_rows() > 0) {
                $this->product_model->update_details(RESERVED_INFO, array('user_id' => $duplicateAdminMail->row()->id), array('id' => $proID));
                $this->setErrorMessage('error', 'Email id already exists');
                redirect('signup');
            } elseif ($duplicateSubAdminMail->num_rows() > 0) {
                $this->product_model->update_details(RESERVED_INFO, array('user_id' => $duplicateSubAdminMail->row()->id), array('id' => $proID));
                $this->setErrorMessage('error', 'Email id already exists');
                redirect('signup');
            } else {
                $dataArr = array('first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'user_name' => $this->input->post('first_name'),
                    'email' => $email,
                    'is_verified' => 'Yes',
                    'password' => md5($this->input->post('password')),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'country' => $this->input->post('country'),
                    'postal_code' => $this->input->post('postal_code'),
                    'phone_no' => $this->input->post('phone_no'),
                    'phone_no1' => $this->input->post('phone_no1'),
                    'email1' => $this->input->post('email1'),
                    'status' => 'Active'
                );
                $this->user_model->simple_insert(USERS, $dataArr);
                $userID = $this->product_model->get_last_insert_id();
                $this->product_model->update_details(RESERVED_INFO, array('user_id' => $userID), array('id' => $proID));
                //$this->session->set_userdata('fc_session_user_name',$username);

                $details = $this->user_model->get_all_details(USERS, $condition);
                if ($details->num_rows() == 1) {
                    $this->send_confirm_mail($details);
                }


                //redirect('reservation_conform/'.$proID);
            }
        } else {
            $this->setErrorMessage('error', 'Invalid email id');
            redirect('reservation/' . $proID);
        }
    }

    public function send_reservation_success_mail($rsrdId = '')
    {
        $Details = $this->product_model->get_all_details(RESERVED_INFO, array('id' => $rsrdId));
        $data = $Details->row();
        $newsid = '10';
        $template_values = $this->user_model->get_newsletter_template_details($newsid);

        $subject = 'From: ' . $template_values['news_title'] . ' - ' . $template_values['news_subject'];

        $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>'. $template_values['news_descrip'] .' </body>
			</html>';

        if ($template_values['sender_name']=='' && $template_values['sender_email']=='') {
            $sender_email=$this->config->item('site_contact_mail');
            $sender_name=$this->config->item('email_title');
        } else {
            $sender_name=$template_values['sender_name'];
            $sender_email=$template_values['sender_email'];
        }

        $message = str_replace('{$prop_address}', $data->prop_address, $message);
        $message = str_replace('{$first_name}', $data->first_name, $message);
        $message = str_replace('{$last_name}', $data->last_name, $message);
        $message = str_replace('{$entity_name}', $data->entity_name, $message);
        $message = str_replace('{$resrv_type}', $data->resrv_type, $message);
        $message = str_replace('{$address}', $data->address, $message);
        $message = str_replace('{$city}', $data->city, $message);
        $message = str_replace('{$state}', str_replace('-', ' ', $data->state), $message);
        $message = str_replace('{$country}', $data->country, $message);
        $message = str_replace('{$post_code}', $data->postal_code, $message);
        $message = str_replace('{$ph_no}', $data->phone_no, $message);
        $message = str_replace('{$ph_no1}', $data->phone_no1, $message);
        $message = str_replace('{$email}', $data->email, $message);
        $message = str_replace('{$email1}', $data->email1, $message);
        $message = str_replace('{$sales_price}', $data->sales_price, $message);
        $message = str_replace('{$reserv_price}', $data->reserv_price, $message);
        $message = str_replace('{$cash_payment}', $data->cash_payment, $message);
        $message = str_replace('{$check_payment}', $data->check_payment, $message);
        $message = str_replace('{$credit_payment}', $data->credit_payment, $message);
        $message = str_replace('{$sales_cash}', $data->sales_cash, $message);
        $message = str_replace('{$sales_cf}', $data->sales_cf, $message);
        $message = str_replace('{$sales_fs}', $data->sales_fs, $message);
        $message = str_replace('{$sales_sl}', $data->sales_sl, $message);
        $message = str_replace('{$sales_sdira}', $data->sales_sdira, $message);
        $message = str_replace('{$cust_name}', $data->cust_name, $message);
        $message = str_replace('{$account_no}', $data->account_no, $message);
        $message = str_replace('{$res_code}', $data->res_code, $message);
        $message = str_replace('{$res_source}', $data->res_source, $message);
        $message = str_replace('{$note}', $data->note, $message);
        $message = str_replace('{$saleDate}', $data->dateAdded, $message);
        $message = str_replace('{$soldAdmin}', $data->sold_admin_name, $message);
        $message = str_replace('{$email_title}', $sender_name, $message);
        $message = str_replace('{$meta_title}', $sender_name, $message);
        $message = str_replace('{base_url()}images/logo/{$logo}', $this->data['logo'], $message);
        $message = str_replace('{base_url()}', base_url(), $message);

        $sender_email = $this->data['siteContactMail'];
        $sender_name = $this->data['siteTitle'];

        $email_values = array('mail_type' => 'html',
            'from_mail_id' => $sender_email,
            'mail_name' => $sender_name,
            'to_mail_id' => $this->config->item('site_contact_mail'),
            'subject_message' => $subject,
            'body_messages' => $message
        );

        return $this->product_model->common_email_send($email_values);
    }

    public function send_confirm_mail($userDetails = '')
    {
        $uid = $userDetails->row()->id;
        $email = $userDetails->row()->email;
        $randStr = $this->get_rand_str('10');
        $condition = array('id' => $uid);
        $dataArr = array('verify_code' => $randStr);
        $this->user_model->update_details(USERS, $dataArr, $condition);
        $newsid = '3';
        $template_values = $this->user_model->get_newsletter_template_details($newsid);

        $cfmurl = base_url() . 'site/user/confirm_register/' . $uid . "/" . $randStr . "/confirmation";
        $subject = 'From: ' . $template_values['news_title'] . ' - ' . $template_values['news_subject'];

        $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>'.$template_values['news_descrip'].'</body>
			</html>';

        if ($template_values['sender_name']=='' && $template_values['sender_email']=='') {
            $sender_email=$this->config->item('site_contact_mail');
            $sender_name=$this->config->item('email_title');
        } else {
            $sender_name=$template_values['sender_name'];
            $sender_email=$template_values['sender_email'];
        }

        $message = str_replace('{$cfmurl}', $cfmurl, $message);
        $message = str_replace('{$email_title}', $sender_name, $message);
        $message = str_replace('{$meta_title}', $sender_name, $message);
        $message = str_replace('{base_url()}images/logo/{$logo}', $this->data['logo'], $message);
        $message = str_replace('{base_url()}', base_url(), $message);

        $email_values = array('mail_type' => 'html',
            'from_mail_id' => $sender_email,
            'mail_name' => $sender_name,
            'to_mail_id' => $email,
            'subject_message' => $subject,
            'body_messages' => $message
        );

        return $this->product_model->common_email_send($email_values);
    }

    public function send_contact_mail($contactDetails = '')
    {
        $uid = $contactDetails->row()->id;
        $email = $contactDetails->row()->email;

        $condition = array('id' => $uid);
        //$dataArr = array('verify_code'=>$randStr);
        //$this->user_model->update_details(USERS,$dataArr,$condition);
        $newsid = '2';
        $template_values = $this->user_model->get_newsletter_template_details($newsid);

        $subject = 'From: ' . $template_values['news_title'] . ' - ' . $template_values['news_subject'];

        $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>'.$template_values['news_descrip'].'</body>
			</html>';

        if ($template_values['sender_name'] == '' && $template_values['sender_email'] == '') {
            $sender_email = $this->data['siteContactMail'];
            $sender_name = $this->data['siteTitle'];
        } else {
            $sender_name = $template_values['sender_name'];
            $sender_email = $template_values['sender_email'];
        }

        $message = str_replace('{$First_Name}', $contactDetails->row()->firstname, $message);
        $message = str_replace('{$Last_Name}', $contactDetails->row()->lastname, $message);
        $message = str_replace('{$Email}', $contactDetails->row()->email, $message);
        $message = str_replace('{$Comment}', $contactDetails->row()->message, $message);
        $message = str_replace('{$email_title}', $sender_name, $message);
        $message = str_replace('{$meta_title}', $sender_name, $message);
        $message = str_replace('{base_url()}images/logo/{$logo}', $this->data['logo'], $message);
        $message = str_replace('{base_url()}', base_url(), $message);


        $email_values = array('mail_type' => 'html',
            'from_mail_id' => $sender_email,
            'mail_name' => $sender_name,
            'to_mail_id' => $this->config->item('site_contact_mail'),
            'subject_message' => $subject,
            'body_messages' => $message
        );

        return $email_send_to_common = $this->product_model->common_email_send($email_values);
    }

    public function calculator()
    {
        $this->load->view('site/product/calculator');
    }

    public function changetoactiveagain()
    {
        unset($_SESSION['reservation']);
    }

    public function ajaxreservedetailssave()
    {
        if ($_POST['fname']) {
            $_SESSION['rfname'] = $_POST['fname'];
        }
        if ($_POST['lname']) {
            $_SESSION['rlname'] = $_POST['lname'];
        }
        if ($_POST['ename']) {
            $_SESSION['rename'] = $_POST['ename'];
        }
        if ($_POST['reservtype']) {
            $_SESSION['rreservtype'] = $_POST['reservtype'];
        }
        if ($_POST['address']) {
            $_SESSION['raddress'] = $_POST['address'];
        }
        if ($_POST['country']) {
            $_SESSION['rcountry'] = $_POST['country'];
        }
        if ($_POST['state']) {
            $_SESSION['rstate'] = $_POST['state'];
        }
        if ($_POST['city']) {
            $_SESSION['rcity'] = $_POST['city'];
        }
        if ($_POST['zip']) {
            $_SESSION['rzip'] = $_POST['zip'];
        }
        if ($_POST['phno']) {
            $_SESSION['rphno'] = $_POST['phno'];
        }
        if ($_POST['phno1']) {
            $_SESSION['rphno1'] = $_POST['phno1'];
        }
        if ($_POST['email']) {
            $_SESSION['remail'] = $_POST['email'];
        }
        if ($_POST['email1']) {
            $_SESSION['remail1'] = $_POST['email1'];
        }
        if ($_POST['reservprice']) {
            $_SESSION['rreservprice'] = $_POST['reservprice'];
        }
        if ($_POST['note']) {
            $_SESSION['rnote'] = $_POST['note'];
        }
        if ($_POST['cashpt']) {
            $_SESSION['rcashpt'] = $_POST['cashpt'];
        }
        if ($_POST['checkpt']) {
            $_SESSION['rcheckpt'] = $_POST['checkpt'];
        }
        if ($_POST['creditpt']) {
            $_SESSION['rcreditpt'] = $_POST['creditpt'];
        }
        if ($_POST['dotpt']) {
            $_SESSION['rdotpt'] = $_POST['dotpt'];
        }
        if ($_POST['salescash']) {
            $_SESSION['rsalescash'] = $_POST['salescash'];
        }
        if ($_POST['salescf']) {
            $_SESSION['rsalescf'] = $_POST['salescf'];
        }
        if ($_POST['salescs']) {
            $_SESSION['rsalescs'] = $_POST['salescs'];
        }
        if ($_POST['salessdira']) {
            $_SESSION['rsalessdira'] = $_POST['salessdira'];
        }
        if ($_POST['salesfs']) {
            $_SESSION['rsalesfs'] = $_POST['salesfs'];
        }
        if ($_POST['salessl']) {
            $_SESSION['rsalessl'] = $_POST['salessl'];
        }
        if ($_POST['cu_name']) {
            $_SESSION['cust_name'] = $_POST['cu_name'];
        }
        if ($_POST['acc_no']) {
            $_SESSION['acco_no'] = $_POST['acc_no'];
        }
        if ($_POST['off_source']) {
            $_SESSION['office_source'] = $_POST['off_source'];
        }
        if ($_POST['eve_source']) {
            $_SESSION['event_source'] = $_POST['eve_source'];
        }
        //redirect(base_url().'Property/'.$this->input->post('propertyId'));
    }

    public function changereservationStatus()
    {
        $id = $this->checkLogin('U');
        $group = $this->product_model->get_all_details(USERS, array('id' => $id));
        if ($this->checkLogin('U') != '') {
            if ($_SESSION['sExistingBookingCount'] == 10) {
                unset($_SESSION['sExistingBooking']);
            }

            if ($_SESSION['sExistingBooking'] != 'Booked') {
                $_SESSION['sExistingBooking'] = 'Booked';
                $_SESSION['sExistingBookingCount'] = '0';
            }

            $reservedID = array_filter(explode(',', $this->config->item('id_reservation')));

            if (count($reservedID) > 0 && $_SESSION['sExistingBookingCount'] <= count($reservedID)) {
                foreach ($reservedID as $datas) {
                    $reservedimage = array_filter(explode('#', $datas));
                    $reservedID1 .= $reservedimage[0];
                    $reservedIDList .= $reservedimage[0];
                    $reservedID1Arr[] .= $reservedimage[0];
                    $reservedID1 .= $reservedimage[1];
                }

                if ($_SESSION['sExistingBookingCount'] == '0') {
                    $_SESSION['sExistingBooking'] = 'Booked';
                    $_SESSION['sExistingBookingCount'] = '0';
                }
                //$reservedIDResult = $this->product_model->getResevationSettingsOnce();


                if ($_SESSION['sExistingBooking'] == '') {
                    $_SESSION['sExistingBookingVal'] = $reservedID;
                }

                //if(count($reservedID) > 0){
                // foreach($reservedID as $reservedProp){
                $prodDisp = '';
                if ($reservedID[$_SESSION['sExistingBookingCount']] != '') {
                    $prodDisp.= '<div id="fadein-shownone-demo">';
                    $reservedimage = array_filter(explode('#', $reservedID[$_SESSION['sExistingBookingCount']]));
                    $prodDisp.= '<div class="innerfade fadein-shownone-fn front_popup_step_' . $_SESSION['sExistingBookingCount'] . '" id="fadein-' . $reservedimage[0] . '">';
                    if ($reservedimage[1] == '') {
                        $getimg = base_url() . 'images/product/dummyProductImage.jpg';
                    } else {
                        $getimg = base_url() . 'images/product/' . $reservedimage[1];
                    }
                    $prodDisp.= '<img src="' . $getimg . '" width="95" height="95" /><p class="front_popup_step_title"><em class="front_popup_step_ltalic">Property id : ' . $reservedimage[0] . '</em><strong class="front_popup_step_strong"> is</strong> <span class="front_popup_step_span"> reserved</span></p></div>';
                }
                $prodDisp.= '</div>';
            }
            $_SESSION['sExistingBookingCount'] = $_SESSION['sExistingBookingCount'] + 1;
            echo $prodDisp;
        }
        /*  <img src="'.echo base_url().'images/product/'. echo trim(stripslashes($featureRow->product_image)).'" /> */
    }

    public function changesoldStatus()
    {
        $id = $this->checkLogin('U');
        $group = $this->product_model->get_all_details(USERS, array('id' => $id));
        if ($this->checkLogin('U') != '') {
            $soldID = array_filter(explode(',', $this->config->item('id_sold')));



            #echo count($soldID);die;
            if ($_SESSION['sExistingSoldCount'] > count($soldID)) {
                //unset($_SESSION['sExistingSold']);
            }

            if ($_SESSION['sExistingSold'] != 'Sold') {
                $_SESSION['sExistingSold'] = 'Sold';
                $_SESSION['sExistingSoldCount'] = '0';
            }

            #echo '<br>'.$_SESSION['sExistingSoldCount'];

            if (count($soldID) > 0 && $_SESSION['sExistingSoldCount'] < count($soldID)) {
                foreach ($soldID as $datad) {
                    $soldimage = array_filter(explode('#', $datad));
                    $soldID1 .= $soldimage[0];
                    $soldIDList .= $soldimage[0];
                    $soldID1Arr[] .= $soldimage[0];
                    $soldID1 .= $soldimage[1];
                }

                if ($_SESSION['sExistingSoldCount'] == '0') {
                    $_SESSION['sExistingSold'] = 'Sold';
                    $_SESSION['sExistingSoldCount'] = '0';
                }

                if ($_SESSION['sExistingSold'] == '') {
                    $_SESSION['sExistingSoldVal'] = $soldID;
                }

                $chk = $this->product_model->get_all_details(PRODUCT, array('property_id' => $soldimage[0], 'property_display' => '1'));

                $prodDisp = '';
                if ($chk->num_rows() > 0) {
                    if ($soldID[$_SESSION['sExistingSoldCount']] != '') {
                        $prodDisp.= '<div id="fadein-shownone-demo1">';

                        $soldimage = array_filter(explode('#', $soldID[$_SESSION['sExistingSoldCount']]));
                        $this->product_model->update_details(PRODUCT, array('property_display' => '0'), array('property_id' => $soldimage[0]));
                        //echo $this->db->last_query();

                        $prodDisp.= '<div class="innerfade fadein-showold-st front_popup_step2_0" id="fadein1-' . $soldimage[0] . '">';

                        if ($soldimage[1] == '') {
                            $getimg = base_url() . 'images/product/dummyProductImage.jpg';
                        } else {
                            $getimg = base_url() . 'images/product/' . $soldimage[1];
                        }

                        $prodDisp.= '<img src="' . $getimg . '" width="95" height="95" /><p class="front_popup_step_title"><em class="front_popup_step_ltalic">Property id : ' . $soldimage[0] . '</em><strong class="front_popup_step_strong"> is</strong> <span class="front_popup_step_span"> sold</span></p></div>';
                    }
                    $prodDisp.= '</div>';
                }
            }

            $_SESSION['sExistingSoldCount'] = $_SESSION['sExistingSoldCount'] + 1;
            echo $prodDisp;
        }
    }

    public function changesoldStatus_old()
    {
        $id = $this->checkLogin('U');
        $group = $this->product_model->get_all_details(USERS, array('id' => $id));
        if ($this->checkLogin('U') != '') {
            if ($_SESSION['sExistingSoldCount'] == 10) {
                unset($_SESSION['sExistingSold']);
            }

            if ($_SESSION['sExistingSold'] != 'Sold') {
                $_SESSION['sExistingSold'] = 'Sold';
                $_SESSION['sExistingSoldCount'] = '0';
            }


            $soldID = array_filter(explode(',', $this->config->item('id_sold')));

            if (count($soldID) > 0 && $_SESSION['sExistingSoldCount'] <= count($soldID)) {
                foreach ($soldID as $datad) {
                    $soldimage = array_filter(explode('#', $datad));
                    $soldID1 .= $soldimage[0];
                    $soldIDList .= $soldimage[0];
                    $soldID1Arr[] .= $soldimage[0];
                    $soldID1 .= $soldimage[1];
                }

                if ($_SESSION['sExistingSoldCount'] == '0') {
                    $_SESSION['sExistingSold'] = 'Sold';
                    $_SESSION['sExistingSoldCount'] = '0';
                }


                if ($_SESSION['sExistingSold'] == '') {
                    $_SESSION['sExistingSoldVal'] = $soldID;
                }

                /* if($_SESSION['sCheckTimeSold'] < 4) {
                  $_SESSION['sCheckTimeSold'] = $_SESSION['sCheckTimeSold']+1;
                  //if(count($reservedID) > 0){
                  // foreach($reservedID as $reservedProp){

                  $ij=0; */
                $prodDisp = '';
                if ($soldID[$_SESSION['sExistingSoldCount']] != '') {
                    $prodDisp.= '<div id="fadein-shownone-demo1">';

                    /* foreach($soldID as $datad){
                      $ij++; */
                    $soldimage = array_filter(explode('#', $soldID[$_SESSION['sExistingSoldCount']]));

                    $prodDisp.= '<div class="innerfade fadein-showold-st front_popup_step2_' . $_SESSION['sExistingSoldCount'] . '" id="fadein1-' . $soldimage[0] . '">';

                    if ($soldimage[1] == '') {
                        $getimg = base_url() . 'images/product/dummyProductImage.jpg';
                    } else {
                        $getimg = base_url() . 'images/product/' . $soldimage[1];
                    }
                    $prodDisp.= '<img src="' . $getimg . '" width="95" height="95" /><p class="front_popup_step_title"><em class="front_popup_step_ltalic">Property id : ' . $soldimage[0] . '</em><strong class="front_popup_step_strong"> is</strong> <span class="front_popup_step_span"> sold</span></p></div>';
                }
                $prodDisp.= '</div>';
            }
            $_SESSION['sExistingSoldCount'] = $_SESSION['sExistingSoldCount'] + 1;
            echo $prodDisp;
        }
        /*  <img src="'.echo base_url().'images/product/'. echo trim(stripslashes($featureRow->product_image)).'" /> */
    }

    public function update_net_price_val()
    {
        echo '<br>Deals';

        $this->db->select('id,sales_price,adjustment');
        $this->db->from(RESERVED_INFO);
        $this->db->where('net_purchase_price', "");
        $netprice = $this->db->get();

        foreach ($netprice->result() as $netpce) {
            if ($netpce->adjustment != '') {
                $netprices = $netpce->sales_price - $netpce->adjustment;
            } else {
                $netprices = $netpce->sales_price;
            }
            $this->product_model->update_details(RESERVED_INFO, array('net_purchase_price' => $netprices), array('id' => $netpce->id));
            echo '<br>' . $this->db->last_query();
        }

        echo '<br>Cancelled';
        $this->db->select('id,sales_price,adjustment');
        $this->db->from(CANCELLED);
        $this->db->where('net_purchase_price', "");
        $netpriceCancel = $this->db->get();

        foreach ($netpriceCancel->result() as $netpce) {
            if ($netpce->adjustment != '') {
                $netprices = $netpce->sales_price - $netpce->adjustment;
            } else {
                $netprices = $netpce->sales_price;
            }
            $this->product_model->update_details(CANCELLED, array('net_purchase_price' => $netprices), array('id' => $netpce->id));
            echo '<br>' . $this->db->last_query();
        }

        echo '<br>Swapped';

        $this->db->select('id,sales_price,adjustment');
        $this->db->from(SWAPPED);
        $this->db->where('net_purchase_price', "");
        $netpriceSwap = $this->db->get();

        foreach ($netpriceSwap->result() as $netpce) {
            if ($netpce->adjustment != '') {
                $netprices = $netpce->sales_price - $netpce->adjustment;
            } else {
                $netprices = $netpce->sales_price;
            }
            $this->product_model->update_details(SWAPPED, array('net_purchase_price' => $netprices), array('id' => $netpce->id));
            echo '<br>' . $this->db->last_query();
        }
    }

    public function brochure_download()
    {
        //echo '<pre>'; print_r($_POST); die;
        $dataArr = array('property_id' => $this->input->post('bpropid'),
            'prop_row_id' => $this->input->post('b_row_id'),
            'businessname' => $this->input->post('bbname'),
            'fname' => $this->input->post('bfname'),
            'lname' => $this->input->post('blname'),
            'phoneno' => $this->input->post('bphoneno'),
            'sale_price' => $this->input->post('bsaleprice'),
            'description' => $this->input->post('bdescription'));
        $this->product_model->simple_insert(BROCHURE, $dataArr);
        $prDId = $this->db->insert_id();

        $this->setErrorMessage('success', 'Brochure Updated Successfully');
        redirect('brochure/' . $prDId);
    }
}

/*End of file product.php */
/* Location: ./application/controllers/site/product.php */
