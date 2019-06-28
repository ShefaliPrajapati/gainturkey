<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * This model contains all db functions related to product management
 * @author Teamtweaks
 *
 */
class Product_model extends My_Model
{
    public function add_product($dataArr='')
    {
        $this->db->insert(PRODUCT, $dataArr);
    }
    
    public function add_subproduct_insert($dataArr='')
    {
        $this->db->insert(SUBPRODUCT, $dataArr);
    }


    public function edit_product($dataArr='', $condition='')
    {
        $this->db->where($condition);
        $this->db->update(PRODUCT, $dataArr);
        //echo $this->db->last_query();die;
    }
    
    public function edit_subproduct_update($dataArr='', $condition='')
    {
        $this->db->where($condition);
        $this->db->update(SUBPRODUCT, $dataArr);
    }
    
    //public  function update_propertystatus() {
    //echo "Hello From Amit....Update";
    //die;
    // global $db;
    // $query = "update fc_product inner join popup_status on fc_product.id=popup_status.reserved_id set property_status='Under Contract' WHERE closed_status='processing'";
    // $this->db->query($query);
    //}
    

    public function view_product($condition='')
    {
        return $this->db->get_where(PRODUCT, $condition);
    }
    
    public function add_review($dataArr='')
    {
        return $this->db->insert(REVIEW, $dataArr);
    }
    public function view_product_details_admin_ror($condition = '')
    {
        ini_set('mysql.connect_timeout', 3000);
        ini_set('default_socket_timeout', 3000);
        $select_qry = "select p.*,pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,pat.attr_name,pats.subattr_name,
		sa.user_name as sold_admin_name,
		pr.id as reserve_id, pr.dateAdded as reservedDate, pr.sold_admin_id, pr.sold_admin_name from ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.property_id=p.id
		LEFT JOIN ".CITY." ca on ca.id=pa.city
		LEFT JOIN ".STATE_TAX." st on st.id=pa.state
		LEFT JOIN ".PRODUCT_ATTRIBUTE." pat on pat.id=p.property_type
		LEFT JOIN ".PRODUCT_SUBATTRIBUTE." pats on pats.id = p.property_sub_type
		LEFT JOIN ".RESERVED_INFO." pr on pr.property_id=p.id
		LEFT JOIN ".USERS." sa on sa.id = pr.sold_admin_id where p.user_site_url=''".$condition;
        
        $productList = $this->ExecuteQuery($select_qry);
        return $productList;
        //echo $this->db->last_query(); die;
    }
    public function view_product_details($condition = '')
    {
        $select_qry = "select p.*,pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,pp.imgtitle,pp.imgPriority,pp.product_image,pat.attr_name,pats.subattr_name,
		sa.user_name as sold_admin_name,
		pr.id as reserve_id, pr.dateAdded as reservedDate, pr.sold_admin_id, pr.sold_admin_name from ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.property_id=p.id
		LEFT JOIN ".CITY." ca on ca.id=pa.city
		LEFT JOIN ".STATE_TAX." st on st.id=pa.state
		LEFT JOIN ".PRODUCT_ATTRIBUTE." pat on pat.id=p.property_type
		LEFT JOIN ".PRODUCT_SUBATTRIBUTE." pats on pats.id = p.property_sub_type
		LEFT JOIN ".RESERVED_INFO." pr on pr.property_id=p.id
		LEFT JOIN ".USERS." sa on sa.id = pr.sold_admin_id
		LEFT JOIN ".PRODUCT_PHOTOS." pp on pp.property_id=p.id ".$condition;
        
        $productList = $this->ExecuteQuery($select_qry);
        return $productList;
        //echo $this->db->last_query(); die;
    }
    
    public function view_product_details2($condition = '')
    {
        $select_qry = "select p.*,
		pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,
		sa.user_name as sold_admin_name,
		ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status, ps.closed_status, ps.hand_off_status,   ps.invoice_status, ps.entity_name as loi_entity_name, ps.reserved_id
		from ".RESERVED_INFO." p 
		LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.property_id=p.property_id
		LEFT JOIN ".CITY." ca on ca.id=pa.city
		LEFT JOIN ".STATE_TAX." st on st.id=pa.state
		LEFT JOIN ".USERS." sa on sa.id = p.sold_admin_id
		LEFT JOIN ".STATUS." ps on ps.reserved_id = p.id ".$condition;
        
        $productList = $this->ExecuteQuery($select_qry);
        //echo $this->db->last_query(); die;
        return $productList;
    }
    
    public function view_product_details1($table = '', $condition = '', $newcondi = '', $deals_prev='', $sourcer='')
    {
        $this->db->select('p.*,
				pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,sa.user_name as sold_admin_name,
				ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status,ps.closed_status, 				ps.hand_off_status, ps.invoice_status, ps.ror_iv_status, ps.gen_iv_status, ps.entity_name as  loi_entity_name,ps.reserved_id,ps.have_alert,ps.no_of_alert');
        
        $this->db->from($table.' as p');
        $this->db->join(PRODUCT_ADDRESS.' as pa', 'pa.property_id=p.property_id', 'left');
        $this->db->join(CITY.' as ca', 'ca.id=pa.city', 'left');
        $this->db->join(STATE_TAX.' as st', 'st.id=pa.state', 'left');
        $this->db->join(USERS.' as sa', 'sa.id=p.sold_admin_id', 'left');
        $this->db->join(STATUS.' as ps', 'ps.reserved_id=p.id', 'left');
        
        $this->db->where($condition);
        $this->db->where_in('p.sold_admin_name', $deals_prev);
        //$this->db->where_in('p.s_email',$sourcer);
        if ($newcondi != '') {
            $this->db->like($newcondi);
        }
        if ($this->uri->segment(4)=='completed') {
            $this->db->order_by('ps.completed_date', 'desc');
        } else {
            $this->db->order_by('p.dateAdded', 'desc');
        }
        $this->db->group_by('p.property_id');
        
        $productList = $this->db->get();
        //echo $this->db->last_query();die;
        return $productList;
    }
    public function get_deals_prev($condition)
    {
        $this->db->select('deals_prev');
        $this->db->from('fc_subadmin');
        $this->db->where('id', $condition);
        $result=$this->db->get();
        return $result->result_array();
    }
    public function get_sourcer($condition)
    {
        $this->db->select('sourcer_name');
        $this->db->from('fc_subadmin');
        $this->db->where('id', $condition);
        $result=$this->db->get();
        return $result->result_array();
    }
        
    public function view_product_details_cancel($table = '', $condition = '', $newcondi = '', $deals_prev=null, $sourcer= null)
    {
        $this->db->select('p.*,
				pa.latitude,pa.longitude,pa.city as cityname,pa.state as statename,pa.post_code,pa.address,sa.user_name as sold_admin_name,ps.articles_status, ps.loi_status, ps.pa_status, ps.loan_status, ps.doi_status, ps.insurance_status, ps.funded_status, ps.closed_status,ps.hand_off_status, ps.invoice_status, ps.ror_iv_status, ps.gen_iv_status, ps.entity_name as loi_entity_name, ps.reserved_id,ps.have_alert,ps.no_of_alert');
        
        $this->db->from($table.' as p');
        $this->db->join(PRODUCT_ADDRESS.' as pa', 'pa.property_id=p.property_id', 'left');
        $this->db->join(CITY.' as ca', 'ca.id=pa.city', 'left');
        $this->db->join(STATE_TAX.' as st', 'st.id=pa.state', 'left');
        $this->db->join(USERS.' as sa', 'sa.id=p.sold_admin_id', 'left');
        $this->db->join(STATUS.' as ps', 'ps.reserved_id=p.id', 'left');
        
        $this->db->where($condition);
        $this->db->where_in('p.sold_admin_name', $deals_prev);
        $this->db->where_in('p.s_email', $sourcer);
        if ($newcondi != '') {
            $this->db->like($newcondi);
        }
        $this->db->order_by('p.change_time', 'desc');
        $this->db->group_by('p.id');

        $productList = $this->db->get();
        //echo $this->db->last_query(); die;
        return $productList;
    }
    
    public function get_featured_details($pid='0')
    {
        $Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id=".$pid." and p.status='Publish'";
        $productList = $this->ExecuteQuery($Query);
        $productList->mode = 'sell_product';
        if ($productList->num_rows() != 1) {
            $Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p LEFT JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id=".$pid." and p.status='Publish'";
            $productList = $this->ExecuteQuery($Query);
            $productList->mode = 'user_product';
        }
        return $productList;
    }
    
    
    public function Display_product_featured_productval()
    {
        $Query = "SELECT p.product_name,p.price,p.id,p.seourl FROM ".PRODUCT." AS p
			WHERE p.featured = 'Featured' and p.status='Publish'
			ORDER BY p.id desc
			LIMIT 0 ,3";
        return  $this->ExecuteQuery($Query);
    }
    
    
    public function get_product_images($product_id_list = array(), $isLimitCond = '')
    {
        $this->db->select('product_id,product_image');
        $this->db->from(PRODUCT_PHOTOS);
        if (!empty($product_id_list)) {
            //echo "<pre>";print_r($product_id_list);die;
            $this->db->where_in('product_id', $product_id_list);
        }
        $this->db->order_by('imgPriority', 'ASC');
        if ($isLimitCond != '') {
            //$this->db->limit(1);
            $this->db->group_by('product_id');
        }
        $product_list_query = $this->db->get();
        return $product_list_result = $product_list_query->result_array();
    }
    
    
    
    public function get_wants_product($wantList)
    {
        $productList = '';
        if ($wantList->num_rows() == 1) {
            $productIds = array_filter(explode(',', $wantList->row()->product_id));
            $this->db->where_in('p.seller_product_id', $productIds);
            $this->db->where('p.status', 'Publish');
            $this->db->select('p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product');
            $this->db->from(PRODUCT.' as p');
            $this->db->join(USERS.' as u', 'u.id=p.user_id');
            $productList = $this->db->get();
        }
        return $productList;
    }
    
    public function get_notsell_wants_product($wantList)
    {
        $productList = '';
        if ($wantList->num_rows() == 1) {
            $productIds = array_filter(explode(',', $wantList->row()->product_id));
            $this->db->where_in('p.seller_product_id', $productIds);
            $this->db->where('p.status', 'Publish');
            $this->db->select('p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product');
            $this->db->from(USER_PRODUCTS.' as p');
            $this->db->join(USERS.' as u', 'u.id=p.user_id');
            $productList = $this->db->get();
        }
        return $productList;
    }
    
    public function view_notsell_product_details($condition = '')
    {
        $select_qry = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p LEFT JOIN ".USERS." u on u.id=p.user_id ".$condition;
        $productList = $this->ExecuteQuery($select_qry);
        return $productList;
    }
    
    public function view_atrribute_details()
    {
        $select_qry = "select * from ".ATTRIBUTE." where status='Active'";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    
    public function Rental_Count_Incre($uid)
    {
        $select_qry = "UPDATE ".USERS." SET products = (products)+1 where id='".$uid."'";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    
    public function Rental_Count_Decre($uid)
    {
        $select_qry = "UPDATE ".USERS." SET products = (products)-1 where id='".$uid."'";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    
    public function getRentalAttribute($uid)
    {
        $select_qry = "SELECT a.id,a.list_value,b.attribute_name FROM `fc_list_values` a JOIN `fc_attribute` b on a.list_id = b.id WHERE FIND_IN_SET('".$uid."', a.products)";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    
    public function Display_product_image_details()
    {
        $select_qry = "select property_id,product_image from ".PRODUCT_PHOTOS." group by property_id order by imgPriority desc";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    
    public function Display_Product_City_details()
    {
        $this->db->select('c.*');
        $this->db->from(CITY.' as c');
        $this->db->join(PRODUCT_ADDRESS.' as p', "p.city=c.id", "LEFT");
        $this->db->where('c.status', 'Active');
        $this->db->group_by('c.id');
        $this->db->order_by('c.name', 'ASC');
        //$this->db->order('p.status','Active');
        return $query = $this->db->get();
    }
    public function Display_product_featured_details()
    {
        $Query = "SELECT p.product_name, pa.product_image,p.price,p.id,p.seourl
			FROM ".PRODUCT." AS p
			LEFT JOIN ".PRODUCT_PHOTOS." pa on p.id=pa.product_id
			WHERE p.featured = 'Featured' and p.status='Publish'
			GROUP BY pa.product_id
			ORDER BY pa.id
			LIMIT 0 , 30";
        return $this->ExecuteQuery($Query);
    
    
    
        $select_qry = "select property_id,product_image from ".PRODUCT_PHOTOS." group by property_id order by imgPriority desc";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    
    
    public function Write_product_review_details($where)
    {
        $Query = "SELECT p.product_name,p.bedroom,p.sleeps,p.bathroom,p.user_id,
		pa.product_image,p.price,p.id,p.seourl,p.description,pad.address,pad.city,pad.state,pad.country,pad.no_of_star,s.name as StateName,
		cy.name as CountryName,
		c.name as CityName
			FROM ".PRODUCT." AS p
			LEFT JOIN ".PRODUCT_PHOTOS." pa on p.id=pa.product_id
			LEFT JOIN ".PRODUCT_ADDRESS." pad on p.id=pad.product_id
			
			LEFT JOIN ".CITY." c on c.id=pad.city
			LEFT JOIN ".LOCATIONS." cy on cy.id=pad.country
			LEFT JOIN ".STATE_TAX." s on pad.state=s.id
			WHERE p.status='Publish' ".$where."";
        return $this->ExecuteQuery($Query);
    }

    public function view_subproduct_details($prdId='')
    {
        $select_qry = "select * from ".SUBPRODUCT." where product_id = '".$prdId."'";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    
    public function view_subproduct_details_join($prdId='')
    {
        $select_qry = "select a.*,b.attr_name from ".SUBPRODUCT." a join ".PRODUCT_ATTRIBUTE." b on a.attr_id = b.id where a.product_id = '".$prdId."'";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    
    public function view_shopping_cart_subproduct_val($userid='', $prdId='')
    {
        $select_qry = "select quantity,attribute_values from ".SHOPPING_CART." where product_id = '".$prdId."' and user_id='".$userid."'";
        return $shopAttrList = $this->ExecuteQuery($select_qry);
    }
    
    public function view_product_atrribute_details()
    {
        $select_qry = "select * from ".PRODUCT_ATTRIBUTE." where status='Active'";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    
    public function view_category_details()
    {
        $select_qry = "select * from ".CATEGORY." where rootID=0";
        $categoryList = $this->ExecuteQuery($select_qry);
        $catView='';
        $Admpriv = 0;
        $SubPrivi = '';

        foreach ($categoryList->result() as $CatRow) {
            $catView .= $this->view_category_list($CatRow, '1');
            
            $sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";
            $SubList = $this->ExecuteQuery($sel_qry);
                
            foreach ($SubList->result() as $SubCatRow) {
                $catView .= $this->view_category_list($SubCatRow, '2');
                    
                $sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";
                $SubList1 = $this->ExecuteQuery($sel_qry1);
                    
                foreach ($SubList1->result() as $SubCatRow1) {
                    $catView .= $this->view_category_list($SubCatRow1, '3');
                    
                    $sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";
                    $SubList2 = $this->ExecuteQuery($sel_qry2);
        
                    foreach ($SubList2->result() as $SubCatRow2) {
                        $catView .= $this->view_category_list($SubCatRow2, '4');
                    }
                }
            }
        }
                    
        return $catView;
    }
    
    public function view_category_list($CatRow, $val)
    {
        $SubcatView ='';
        $SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
        return $SubcatView;
    }

    public function get_category_details($catList='')
    {
        $catListArr = explode(',', $catList);
        $select_qry = "select * from ".CATEGORY." where rootID=0";
        $categoryList = $this->ExecuteQuery($select_qry);
        $catView='';
        $Admpriv = 0;
        $SubPrivi = '';

        foreach ($categoryList->result() as $CatRow) {
            $catView .= $this->get_category_list($CatRow, '1', $catListArr);
            
            $sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";
            $SubList = $this->ExecuteQuery($sel_qry);
                
            foreach ($SubList->result() as $SubCatRow) {
                $catView .= $this->get_category_list($SubCatRow, '2', $catListArr);
                    
                $sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";
                $SubList1 = $this->ExecuteQuery($sel_qry1);
                    
                foreach ($SubList1->result() as $SubCatRow1) {
                    $catView .= $this->get_category_list($SubCatRow1, '3', $catListArr);
                    
                    $sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";
                    $SubList2 = $this->ExecuteQuery($sel_qry2);
        
                    foreach ($SubList2->result() as $SubCatRow2) {
                        $catView .= $this->get_category_list($SubCatRow2, '4', $catListArr);
                    }
                }
            }
        }
        return $catView;
    }
    
    public function get_category_list($CatRow, $val, $catListArr='')
    {
        $SubcatView ='';
        if (in_array($CatRow->id, $catListArr)) {
            $checkStr = 'checked="checked"';
        } else {
            $checkStr = '';
        }
        $SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" '.$checkStr.' class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
        return $SubcatView;
    }

    public function get_cat_list($ids='')
    {
        $this->db->where_in('id', explode(',', $ids));
        return $this->db->get(CATEGORY);
    }

    public function get_top_users_in_category($cat='')
    {
        $productArr = array();
        $userArr = array();
        $userCountArr = array();
        $condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' OR p.category_id='".$cat."' AND p.status = 'Publish'";
        $productDetails = $this->view_product_details($condition);
        if ($productDetails->num_rows()>0) {
            foreach ($productDetails->result() as $productRow) {
                if (!in_array($productRow->id, $productArr)) {
                    array_push($productArr, $productRow->id);
                    if ($productRow->user_id != '') {
                        if (!in_array($productRow->user_id, $userArr)) {
                            array_push($userArr, $productRow->user_id);
                            $userCountArr[$productRow->user_id] = 1;
                        } else {
                            $userCountArr[$productRow->user_id]++;
                        }
                    }
                }
            }
        }
        arsort($userCountArr);
        return $userCountArr;
    }
    
    public function get_recent_like_users($pid='', $limit='10', $sort='desc')
    {
        $Query = 'select pl.*, p.product_name, p.likes, u.full_name, u.user_name,u.thumbnail from '.PRODUCT_LIKES.' pl 
					JOIN '.PRODUCT.' p on p.seller_product_id=pl.product_id 
					JOIN '.USERS.' u on u.id=pl.user_id and u.status="Active"
					where pl.product_id="'.$pid.'" order by pl.id '.$sort.' limit '.$limit;
        return $this->ExecuteQuery($Query);
    }
    
    public function get_recent_user_likes($uid='', $pid='', $limit='3', $sort='desc')
    {
        $condition = '';
        if ($pid!='') {
            $condition = ' and pl.product_id != "'.$pid.'" ';
        }
        $Query = 'select pl.*,u.user_name,u.full_name,u.thumbnail,p.product_name,p.id as PID,p.created,p.sale_price,p.image from '.PRODUCT_LIKES.' pl
					JOIN '.USERS.' u on u.id=pl.user_id 
					JOIN '.PRODUCT.' p on p.seller_product_id=pl.product_id
					JOIN '.USERS.' u1 on u1.id=p.user_id and u1.group="Seller" and u1.status="Active"
					where pl.user_id = "'.$uid.'" '.$condition.' order by pl.id '.$sort.' limit '.$limit;
        return $this->ExecuteQuery($Query);
    }
    
    /*public function get_like_user_full_details($pid='0'){
        $Query = "select u.* from ".PRODUCT_LIKES.' p
                    JOIN '.USERS.' u on u.id=p.user_id
                    where p.property_id='.$pid;
        return $this->ExecuteQuery($Query);
    }*/
    
    public function getCategoryValues($selVal, $whereCond)
    {
        $sel = 'select '.$selVal.' from '.CATEGORY.' c LEFT JOIN '.CATEGORY.' sbc ON c.id = sbc.rootID '.$whereCond.' ';
        return $this->ExecuteQuery($sel);
    }
    
    public function getCategoryResults($selVal, $whereCond)
    {
        $sel = 'select '.$selVal.' from '.CATEGORY.' '.$whereCond.' ';
        return $this->ExecuteQuery($sel);
    }
    
    public function searchShopyByCategory($whereCond)
    {
        $sel = 'select p.* from '.PRODUCT.' p 
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
		 		'.$whereCond.' ';
        return $this->ExecuteQuery($sel);
    }
    
    public function add_user_product($uid='')
    {
        $seller_product_id = mktime();
        $checkId = $this->check_product_id($seller_product_id);
        while ($checkId->num_rows()>0) {
            $seller_product_id = mktime();
            $checkId = $this->check_product_id($seller_product_id);
        }
        $dataArr = array(
            'product_name'	=>	$this->input->post('name'),
            'seourl'		=>	url_title($this->input->post('name'), '-'),
            'web_link'		=>	$this->input->post('link'),
            'category_id'	=>	$this->input->post('category'),
            'excerpt'		=>	$this->input->post('note'),
            'image'			=>	$this->input->post('image'),
            'user_id'		=>	$uid,
            'seller_product_id' => $seller_product_id
        );
        $this->simple_insert(USER_PRODUCTS, $dataArr);
        return $seller_product_id;
    }
    
    public function check_product_id($pid='')
    {
        $checkId = $this->get_all_details(USER_PRODUCTS, array('seller_product_id'=>$pid));
        if ($checkId->num_rows()==0) {
            $checkId = $this->get_all_details(PRODUCT, array('seller_product_id'=>$pid));
        }
        return $checkId;
    }
    
    public function get_products_by_category($categoryid='', $sort='desc')
    {
        $Query = "select p.*,u.user_name,u.full_name,u.thumbnail from ".PRODUCT." p
			LEFT JOIN ".USERS." u on u.id=p.user_id
			where p.status='Publish' and FIND_IN_SET('".$categoryid."',p.category_id) order by p.`created` ".$sort;
        return $this->ExecuteQuery($Query);
    }
    
    public function view_product_comments_details($condition = '')
    {
        $select_qry = "select p.product_name,c.product_id,u.full_name,u.user_name,u.thumbnail,c.comments ,u.email,c.id,c.status,c.user_id as CUID
		from ".PRODUCT_COMMENTS." c 
		LEFT JOIN ".USERS." u on u.id=c.user_id 
		LEFT JOIN ".PRODUCT." p on p.seller_product_id=c.product_id ".$condition;
        $productComment = $this->ExecuteQuery($select_qry);
        return $productComment;
    }
    public function Update_Product_Comment_Count($product_id)
    {
        $Query = "UPDATE ".PRODUCT." SET comment_count=(comment_count + 1) WHERE seller_product_id='".$product_id."'";
        $this->ExecuteQuery($Query);
    }
    public function Update_Product_Comment_Count_Reduce($product_id)
    {
        $Query = "UPDATE ".PRODUCT." SET comment_count=(comment_count - 1) WHERE seller_product_id='".$product_id."'";
        return $this->ExecuteQuery($Query);
    }
    public function get_products_search_results($search_key='', $limit='5')
    {
        $Query = 'select p.* from '.PRODUCT.' p 
				LEFT JOIN '.USERS.' u on u.id=p.user_id
				where p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 and u.status="Active" and u.group="Seller"
				or p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 and p.user_id=0
				limit '.$limit;
        return $this->ExecuteQuery($Query);
    }
    public function get_user_search_results($search_key='', $limit='5')
    {
        $Query = 'select * from '.USERS.' where full_name like "%'.$search_key.'%" and status="Active" OR user_name like "%'.$search_key.'%" and status="Active" limit '.$limit;
        return $this->ExecuteQuery($Query);
    }
    
    public function get_product_full_details($pid='0')
    {
        $Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product,u.email,u.email_notifications,u.notifications from ".PRODUCT." p JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id='".$pid."'";
        $productDetails = $this->ExecuteQuery($Query);
        if ($productDetails->num_rows() == 0) {
            $Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product,u.email,u.email_notifications,u.notifications from ".USER_PRODUCTS." p JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id='".$pid."'";
            $productDetails = $this->ExecuteQuery($Query);
            $productDetails->prodmode = 'user';
        } else {
            $productDetails->prodmode = 'seller';
        }
        return $productDetails;
    }
    
    public function get_user_created_lists($pid='0')
    {
        $Query = "select * from ".LISTS_DETAILS." where FIND_IN_SET('".$pid."',product_id)";
        return $this->ExecuteQuery($Query);
    }
    
    
    public function view_product1($product_id='')
    {
        $this->db->select('p.*,
		pa.country as countryname,pa.state as statename,pa.city cityname,pa.post_code,pa.property_name,pa.address,pa.latitude,pa.longitude,
		pf.feature,pf.google_map,
		');
        $this->db->from(PRODUCT.' as p');
        $this->db->join(PRODUCT_ADDRESS.' as pa', "pa.property_id=p.id", "LEFT");
        $this->db->join(PRODUCT_FEATURES.' as pf', "pf.property_id=p.id", "LEFT");
        //$this->db->join(PRODUCT_BOOKING.' as pb',"pb.product_id=p.id","LEFT");
        $this->db->where('p.id', $product_id);
        $this->db->group_by('p.id', $product_id);
        //$this->db->where('p.status','Publish');
        return $query = $this->db->get();
        //	echo $this->db->last_query();
    //return $result =$query->result_array();
        //echo "<pre>";print_r($result);die;
    }
    
    
    public function get_contactAll_details()
    {
        $Query = "SELECT p.id, count( p.id ) AS productcount
			FROM ".PRODUCT." AS p
			GROUP BY p.id
			ORDER BY p.id
			LIMIT 0 , 30";
        return $this->ExecuteQuery($Query);
    }
    public function get_contactAllSeller_details()
    {
        $Query = "SELECT user_name,products
			FROM ".USERS." WHERE products <> 0
			ORDER BY products desc
			LIMIT 0 , 30";
        return $this->ExecuteQuery($Query);
    }
    /*********Edited by mano**********/
    /************Product Listing***************/
    public function view_product_details_site($condition = '')
    {
        $select_qry = "select p.product_name,p.product_title,p.id,p.seourl,p.price,p.price_range,p.description,p.user_id,p.list_name,p.list_value,p.comment_count,p.status,p.order,p.contact_count,p.featured,p.bedroom,p.sleeps,p.bathroom,
						u.full_name,u.id as userid,u.user_name,u.thumbnail,u.feature_product,
						pa.latitude,pa.longitude,pa.city,
						c.name as city_name,c.meta_title,c.meta_keyword,c.meta_description,c.seourl as cityurl,
						pp.product_image ,
						s.name as statename,s.meta_title as statemtitle,s.meta_keyword as statemkey,s.meta_description as statemdesc,s.seourl as stateurl
						from ".PRODUCT." p 
						LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.product_id=p.id
						LEFT JOIN ".CITY." c on c.id=pa.city
						LEFT JOIN ".STATE_TAX." s on s.id=pa.state
						LEFT JOIN ".PRODUCT_BOOKING." b on b.product_id=p.id
						LEFT JOIN ".PRODUCT_PHOTOS." pp on pp.product_id=p.id
						LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition;
        $productList = $this->ExecuteQuery($select_qry);
        //	echo $this->db->last_query(); die;
        return $productList;
    }
    
    /************Product Listing***************/
    public function view_product_details_sitemapview($condition = '')
    {
        $select_qry = "select p.*,
						u.full_name,u.id as userid,u.user_name,u.thumbnail,u.feature_product,
						pa.latitude,pa.longitude,pa.address,pa.post_code,
						c.name as city_name,
						s.name as statename,s.meta_title as statemtitle,s.meta_keyword as statemkey,s.meta_description as statemdesc,s.seourl as stateurl,
						pp.product_image from ".PRODUCT." p 
		LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.product_id=p.id
		LEFT JOIN ".CITY." c on c.id=pa.city
		LEFT JOIN ".STATE_TAX." s on s.id=pa.state
		LEFT JOIN ".PRODUCT_BOOKING." b on b.product_id=p.id
		LEFT JOIN ".PRODUCT_PHOTOS." pp on pp.product_id=p.id
		LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition;
        $productList = $this->ExecuteQuery($select_qry);
        //echo $this->db->last_query();
        //echo "<pre>";print_r($result); die;
        return $productList;
    }
    /*********Single Product details*********/
    public function view_product_details_site_one($where1, $where_or, $where2)
    {
        $this->db->select('p.*,
		pa.country,pa.state,pa.city,pa.post_code,pa.property_name,pa.holding_no,pa.no_of_star,pa.address,pa.latitude,pa.longitude,
		pf.feature,pf.google_map,pf.add_feature,pf.rentals_policy,pf.trams_condition,pf.confirm_email,pf.order_email,pf.invoice_template,
		pb.datefrom,pb.dateto,pb.expiredate,u.first_name,u.user_name,u.phone_no as phonenumber,u.group,u.s_phone_no,u.about,u.thumbnail,u.email as RenterEmail,
		c.name as CityName,c.seourl as CitySurl
		');
        $this->db->from(PRODUCT.' as p');
        $this->db->join(PRODUCT_ADDRESS.' as pa', "pa.product_id=p.id", "LEFT");
        $this->db->join(PRODUCT_FEATURES.' as pf', "pf.product_id=p.id", "LEFT");
        $this->db->join(PRODUCT_BOOKING.' as pb', "pb.product_id=p.id", "LEFT");
        $this->db->join(CITY.' as c', "c.id=pa.city", "LEFT");
        $this->db->join(USERS.' as u', "u.id=p.user_id", "LEFT");
        $this->db->where($where1);
        $this->db->or_where($where_or);
        $this->db->where($where2);
        //$this->db->where('p.status','Publish');
        return $query = $this->db->get();
        //echo $this->db->last_query();
    //	return $result =$query->result_array();
        //echo "<pre>";print_r($result);die;
    }
    /**********For getting image*******/
    public function get_images($product_id)
    {
        $this->db->from(PRODUCT_PHOTOS);
        $this->db->where('property_id', $product_id);
        $this->db->order_by('imgPriority', 'asc');
        return $query = $this->db->get();
        /*$Query = 'select * from '.PRODUCT_PHOTOS.' where property_id='.$product_id.' order by length (imgPriority) ASC';
        return $this->ExecuteQuery($Query);*/
    }
    
    
    public function view_cities($text)
    {
        $select_qry = "select * from ".USERS."  where email LIKE '%".$text."%'";
        $cityList = $this->ExecuteQuery($select_qry);
        return $cityList->result();
    }
    public function view_rental($text)
    {
        $select_qry = "select c.product_name from ".PRODUCT." c where c.product_name LIKE '%".$text."%'";
        $rentalList = $this->ExecuteQuery($select_qry);
        return $rentalList->result();
    }
    public function Display_product_image_details_all()
    {
        $select_qry = "select property_id,count(product_image) as count_image from ".PRODUCT_PHOTOS." group by property_id order by imgPriority asc";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    public function LastInsertRentalId()
    {
        $select_qry = "select MAX(id) as LIid from ".PRODUCT."";
        return $attList = $this->ExecuteQuery($select_qry);
    }
    /*******************/
    /************Product Listing Viswa***************/
    public function view_product_details_site_codei($condition = '', $rentalval = '')
    {
        $this->db->select('p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product,pa.latitude,pa.longitude');
        $this->db->from(PRODUCT.' as p');
        $this->db->join(PRODUCT_ADDRESS.' as pa', "pa.product_id=p.id", "LEFT");
        $this->db->join(CITY.' as c', "c.id=pa.city", "LEFT");
        $this->db->join(PRODUCT_BOOKING.' as pb', "pb.product_id=p.id", "LEFT");
        $this->db->join(STATE_TAX.' as s', "s.id=pa.state", "LEFT");
        $this->db->join(USERS.' as u', "u.id=p.user_id", "LEFT");
        $this->db->where('p.status ="Publish"');
        if ($_SESSION['searchCity'] !='' && $_SESSION['searchCity'] !='search' && $_SESSION['searchCity'] !='Browse All' && $_SESSION['searchCity'] !='state' && $rentalval=='') {
            $this->db->where('c.seourl ="'.$_SESSION['searchCity'].'"');
        }
        
        
        if ($condition  !='') {
            $this->db->where($condition);
              
            $this->db->order_by('p.price');
        }
        if ($rentalval!='') {
            $this->db->like('p.product_name', $rentalval);
        }
        
        return $query = $this->db->get();
        
        /*		$select_qry = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product,pa.latitude,pa.longitude,c.name as city_name from ".PRODUCT." p
                LEFT JOIN ".PRODUCT_ADDRESS." pa on pa.product_id=p.id
                LEFT JOIN ".CITY." c on c.id=pa.city
                LEFT JOIN ".PRODUCT_BOOKING." b on b.product_id=p.id
                LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition;
                $productList = $this->ExecuteQuery($select_qry);
        */
        //echo $this->db->last_query(); die;
    //	return $productList;
    }
    public function get_usercount_details($table='', $condition='', $sortArr='')
    {
        if ($sortArr != '' && is_array($sortArr)) {
            foreach ($sortArr as $sortRow) {
                if (is_array($sortRow)) {
                    $this->db->order_by($sortRow['field'], $sortRow['type']);
                }
            }
        }
        
        $this->db->group_by('email');
        return $this->db->get_where($table, $condition, $data);
    }

    public function user_count_less($table='', $condition='', $data)
    {
        $this->db->where($condition);
        return $this->db->update($table, $data);
    }
    
    public function get_confirm_code()
    {
        $this->db->select('booking_code');
        $this->db->from(ADMIN_SETTINGS);
        $result = $this->db->get();
        return $result;
        //echo $this->db->last_query(); die;
    }
    public function get_product_details()
    {
        $this->db->select('p.*,pa.address,pa.post_code,pa.city,pa.state,pa.latitude,pa.longitude,c.name as cityName, s.name as stateName,pi.product_image,pi.imgPriority');
        $this->db->from(PRODUCT.' as p');
        $this->db->join(PRODUCT_ADDRESS.' as pa', "pa.property_id=p.id", "LEFT");
        $this->db->join(CITY.' as c', "c.id=pa.city", "LEFT");
        $this->db->join(PRODUCT_PHOTOS.' as pi', "pi.property_id=p.id", "LEFT");
        $this->db->join(STATE_TAX.' as s', "s.id=pa.state", "LEFT");
            
        $this->db->where('p.property_status = "Active"');
        $this->db->group_by('p.id');
        $result = $this->db->get();
        return $result;
    }
        
    public function get_product_details_limit($MinPLimit='', $MaxPLimit='')
    {
        $this->db->select('p.*,pa.address,pa.post_code,pa.city,pa.state,pa.latitude,pa.longitude,c.name as cityName, s.name as stateName,pi.product_image,pi.imgPriority');
        $this->db->from(PRODUCT.' as p');
        $this->db->join(PRODUCT_ADDRESS.' as pa', "pa.property_id=p.id", "LEFT");
        $this->db->join(CITY.' as c', "c.id=pa.city", "LEFT");
        $this->db->join(PRODUCT_PHOTOS.' as pi', "pi.property_id=p.id", "LEFT");
        $this->db->join(STATE_TAX.' as s', "s.id=pa.state", "LEFT");
            
        $this->db->where('p.property_status = "Active"');
        $this->db->group_by('p.id');
        $this->db->limit($MaxPLimit, $MinPLimit);
        $result = $this->db->get();
        //echo $this->db->last_query();die;
            
        return $result;
    }
        
    public function get_product_details_Cat($condition='', $whereCantOrder='', $searchPerPage='', $paginationNo='')
    {
        
        //print_r($condition);die;
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $this->db->select('p.*,pa.address,pa.post_code,pa.city,pa.state,pa.latitude,pa.longitude,c.name as cityName, s.name as stateName,pi.product_image,pi.imgPriority');
        $this->db->from(PRODUCT.' as p');
        $this->db->join(PRODUCT_ADDRESS.' as pa', "pa.property_id=p.id", "LEFT");
        $this->db->join(CITY.' as c', "c.id=pa.city", "LEFT");
        $this->db->join(PRODUCT_PHOTOS.' as pi', "pi.property_id=p.id", "LEFT");
        $this->db->join(STATE_TAX.' as s', "s.id=pa.state", "LEFT");
            
        $this->db->where('p.property_status = "Active"');
        $this->db->where('p.display_main = "yes"');
        $this->db->where($condition);
            
        if ($whereCantOrder=='priceasc') {
            $this->db->order_by('p.event_price', 'ASC');
        } elseif ($whereCantOrder=='pricedesc') {
            $this->db->order_by('p.event_price', 'DESC');
        } else {
            $this->db->order_by($whereCantOrder, 'ASC');
        }
            
        $this->db->group_by('p.id');
        if ($searchPerPage != '') {
            $this->db->limit($searchPerPage, $paginationNo);
        }
        $result = $this->db->get();
        //echo $this->db->last_query();die;
            
        return $result;
    }
        
    /*public function get_sold_proptery_details($MinPLimit='',$MaxPLimit='')
        {
            $this->db->select('p.*,pa.address,pa.post_code,pa.city,pa.state,pa.latitude,pa.longitude,c.name as cityName, s.name as stateName,pi.product_image,pi.imgPriority');
            $this->db->from(PRODUCT.' as p');
            $this->db->join(PRODUCT_ADDRESS.' as pa',"pa.property_id=p.id","LEFT");
            $this->db->join(CITY.' as c',"c.id=pa.city","LEFT");
            $this->db->join(PRODUCT_PHOTOS.' as pi',"pi.property_id=p.id","LEFT");
            $this->db->join(STATE_TAX.' as s',"s.id=pa.state","LEFT");
            $this->db->where('p.property_status = "Sold"');
            $this->db->group_by('p.id');
            $this->db->limit($MaxPLimit,$MinPLimit);
            $result = $this->db->get();
            return $result;


        }*/
    public function get_sold_proptery_details($condition='', $whereCantOrder='', $searchPerPage='', $paginationNo='')
    {
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $this->db->select('p.*,pa.address,pa.post_code,pa.city,pa.state,pa.latitude,pa.longitude,c.name as cityName, s.name as stateName,pi.product_image,pi.imgPriority');
        $this->db->from(PRODUCT.' as p');
        $this->db->join(PRODUCT_ADDRESS.' as pa', "pa.property_id=p.id", "LEFT");
        $this->db->join(CITY.' as c', "c.id=pa.city", "LEFT");
        $this->db->join(PRODUCT_PHOTOS.' as pi', "pi.property_id=p.id", "LEFT");
        $this->db->join(STATE_TAX.' as s', "s.id=pa.state", "LEFT");
        $this->db->where('p.property_status = "Sold"');
        $this->db->where('p.display_main = "yes"');
            
        $this->db->where($condition);
            
        if ($whereCantOrder=='priceasc') {
            $this->db->order_by('p.event_price', 'ASC');
        } elseif ($whereCantOrder=='pricedesc') {
            $this->db->order_by('p.event_price', 'DESC');
        } else {
            $this->db->order_by($whereCantOrder, 'ASC');
        }
        //$this->db->order_by($whereCantOrder,'ASC');
        $this->db->group_by('p.id');
        if ($searchPerPage != '') {
            $this->db->limit($searchPerPage, $paginationNo);
        }
        $result = $this->db->get();
        //echo $this->db->last_query();die;
        return $result;
    }
        
        
    public function get_Featured_proptery_details($condition='', $whereCantOrder='', $searchPerPage='', $paginationNo='')
    {
        $this->db->select('p.*,pa.address,pa.post_code,pa.city,pa.state,pa.latitude,pa.longitude,c.name as cityName, s.name as stateName,pi.product_image,pi.imgPriority');
        $this->db->from(PRODUCT.' as p');
        $this->db->join(PRODUCT_ADDRESS.' as pa', "pa.property_id=p.id", "LEFT");
        $this->db->join(CITY.' as c', "c.id=pa.city", "LEFT");
        $this->db->join(PRODUCT_PHOTOS.' as pi', "pi.property_id=p.id", "LEFT");
        $this->db->join(STATE_TAX.' as s', "s.id=pa.state", "LEFT");
        $this->db->where('p.property_status = "Active"');
        $this->db->where('p.featured = "Yes"');
            
        $this->db->where($condition);
            
        if ($whereCantOrder=='priceasc') {
            $this->db->order_by('p.event_price', 'ASC');
        } elseif ($whereCantOrder=='pricedesc') {
            $this->db->order_by('p.event_price', 'DESC');
        } else {
            $this->db->order_by($whereCantOrder, 'ASC');
        }
        //$this->db->order_by($whereCantOrder,'ASC');
        $this->db->group_by('p.id');
        $this->db->limit(8, 0);
            
            
        $result = $this->db->get();
        //echo $this->db->last_query();die;
        return $result;
    }
        
        
        
    /**
    *
    * This function save the Reserved details in a file
    */
    public function saveResevedSettings()
    {
        $getResevationSettingsDetails = $this->getResevationSettings();
        if (sizeof($getResevationSettingsDetails->result())>0) {
            $iii='1';
            $config = "<?php \n\$config['id_reservation']='";
            foreach ($getResevationSettingsDetails->result() as $Rowval) {
                $productImages=$this->get_images($Rowval->id);
                if ($productImages->num_rows()>0) {
                    $product_image=$productImages->row()->product_image;
                } else {
                    $product_image='';
                }
                if ($iii==1) {
                    $config .= $Rowval->property_id.'#'.$product_image;
                #$config .= $Rowval->property_id.'#'.$Rowval->product_image;
                } else {
                    $config .= ",".$Rowval->property_id.'#'.$product_image;
                    #$config .= ",".$Rowval->property_id.'#'.$Rowval->product_image;
                }
                $iii++;
            }
            $config .= "'; ?>";
        }
        $file = 'commonsettings/fc_giftcard_settings.php';
        file_put_contents($file, $config);
    }
   
    public function saveSoldSettings()
    {
        $getSoldSettingsDetails = $this->getSoldSettings();
        #echo '<pre>';print_r($getSoldSettingsDetails->result()); die;
        if (sizeof($getSoldSettingsDetails->result())>0) {
            $iij='1';
            $config = "<?php \n\$config['id_sold']='";
            foreach ($getSoldSettingsDetails->result() as $Rowval) {
                $productImages=$this->get_images($Rowval->id);
                if ($productImages->num_rows()>0) {
                    $product_image=$productImages->row()->product_image;
                } else {
                    $product_image='';
                }
                if ($iij==1) {
                    $config .= $Rowval->property_id.'#'.$product_image;
                #$config .= $Rowval->property_id.'#'.$Rowval->product_image;
                } else {
                    $config .= ",".$Rowval->property_id.'#'.$product_image;
                    #$config .= ",".$Rowval->property_id.'#'.$Rowval->product_image;
                }
                $iij++;
            }
            $config .= "'; ?>";
        }
        $file = 'commonsettings/fc_giftcard_settings_sold.php';
        file_put_contents($file, $config);
    }
   
    public function sliderdetails()
    {
        $this->db->select('*');
        $this->db->from(SLIDER);
        $this->db->where('status', 'Active');
        $this->db->where_not_in('site', 'sub');
        $this->db->order_by('dateAdded', 'desc');
        $result = $this->db->get();
        return $result;
    }
    
    
    //Get User Information from user table //

    public function get_UserInformation()
    {
        $this->db->select('*');
        $this->db->from(USERS);
        $result = $this->db->get();
        return $result;
        //echo $this->db->last_query(); die;
    }
    
    public function admin_popup_status_view($pid = '')
    {
        $select_qry = "select b.admin_popup_status from ".RESERVED_INFO." a 
			JOIN ".STATUS." b on b.reserved_id=a.id where a.property_id	= ".$pid;
        $productList = $this->ExecuteQuery($select_qry);
        //echo $this->db->last_query(); die;
        return $productList->row()->admin_popup_status;
    }
    
    public function alert_full_info($reserved_id="")
    {
        $this->db->select('a.alert_person');
        $this->db->from(ALERT.' as a');
        $this->db->where('a.reserved_id', $reserved_id);
        $result = $this->db->get();
            
        $this->db->select('a.*,sa.admin_name as userName');
        $this->db->from(ALERT.' as a');
        if ($result->row()->alert_person == 1) {
            $this->db->join(ADMIN.' as sa', "sa.id=a.alert_person", "LEFT");
        } else {
            $this->db->join(SUBADMIN.' as sa', "sa.id=a.alert_person", "LEFT");
        }
        $this->db->where('a.reserved_id', $reserved_id);
        $this->db->order_by('a.alert_date', 'DESC');
        $result = $this->db->get();
        return $result;
    }
    public function alert_info($id="")
    {
        $this->db->select('a.*');
        $this->db->from(ALERT.' as a');
        $this->db->where('a.id', $id);
        $result = $this->db->get();
        return $result;
    }
    public function get_alarm_status($reserved_id="")
    {
        $alert_date=date("Y-m-d H:i:s");
        $this->db->select('COUNT(a.id) as counts');
        $this->db->from(ALERT.' as a');
        $this->db->where('a.reserved_id', $reserved_id);
        $this->db->where('a.alert_date <=', $alert_date);
        $this->db->where('a.alert_status !=', 'Completed');
        $result = $this->db->get();
        return $result->row()->counts;
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
}
