<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * This controller contains the functions related to Product management
 * @author Teamtweaks
 *
 */

class Producttemplate extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('cookie','date','form'));
        $this->load->library(array('encrypt','form_validation','session'));
        $this->load->model('product_model');
    }
    
    /**
     *
     * This function loads the product list page
     */
    public function index()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            redirect('crmadmin/product/display_product_list');
        }
    }
    
    /**
     *
     * This function loads the selling product list page
     */
    public function display_product_list()
    {
        //echo $this->checkLogin('CA'); die;
        if ($this->checkLogin('CA') == '') {
            //echo '<pre>'.'hello'; print_r($_POST); die;
            redirect('deals_crm');
        } else {
            $this->data['urlState'] = $urlState = $this->uri->segment(4);
                        
            if ($this->session->userdata('ror_crm_session_admin_type') == 'main') {
                //echo '<pre>'.'hi'; print_r($_POST); die;
                if ($urlState == 'all') {
                    $table = RESERVED_INFO;
                    $whereCnd = array('p.sold_admin_name' => $this->session->userdata('ror_crm_session_admin_name'));
                } elseif ($urlState == 'completed') {
                    $table = RESERVED_INFO;
                    $whereCnd = array('ps.invoice_status'=>'complete','p.sold_admin_name' => $this->session->userdata('ror_crm_session_admin_name'));
                } elseif ($urlState == 'cancelled') {
                    $table = CANCELLED;
                    $whereCnd = array();
                } else {
                    $table = RESERVED_INFO;
                    $whereCnd = array('pa.state'=>$urlState,'p.sold_admin_name' => $this->session->userdata('ror_crm_session_admin_name'));
                }
            } else {
                //echo '<pre>'.'bye'; print_r($_POST); die;
                //echo 'siva'; die;
                if ($urlState == 'all') {
                    $table = RESERVED_INFO;
                    $whereCnd = array();
                } elseif ($urlState == 'completed') {
                    $table = RESERVED_INFO;
                    $whereCnd = array('ps.invoice_status'=>'complete');
                } elseif ($urlState == 'cancelled') {
                    $table = CANCELLED;
                    $whereCnd = array();
                } else {
                    $table = RESERVED_INFO;
                    $whereCnd = array('pa.state'=>$urlState);
                }
            }
            if ($this->session->userdata('fieldType')!='' && $this->session->userdata('fieldVal')!='') {
                $newCnd = array($this->session->userdata('fieldType') => $this->session->userdata('fieldVal'));
                $admindata = array('fieldType' => '','fieldVal' => '');
                $this->session->unset_userdata($admindata);
            }
                        
            //$whereCond = ' and '.$fieldType.' like  "%'.trim(addslashes($fieldVal)).'%"';
                        
            $this->data['heading'] = 'Property List';
            $this->data['productList'] = $this->product_model->view_product_details1($table, $whereCnd, $newCnd);
            //echo "<pre>"; print_r($this->data['productList']->result()); die;
            $this->load->view('crmadmin/product/display_product_list', $this->data);
        }
    }
    
    public function display_property_popup()
    {
        $id = $this->uri->segment(4);
        $this->data['display'] = $this->uri->segment(5);
        $this->data['uri6'] = $this->uri->segment(6);
        $detailsSold= $this->product_model->get_all_details(RESERVED_INFO, array('id'=>$id));
        if ($detailsSold->num_rows() == 0) {
            $buyerDetails = $this->product_model->get_all_details(CANCELLED, array('id'=>$id));
        } else {
            $buyerDetails = $detailsSold;
        }
        //echo '<pre>'; print_r($buyerDetails->result_array());die;
                
        $this->data['buyer_info'] = $buyerDetails;
        $sortArr1 = array('field'=>'id','type'=>'desc');
        $sortArr = array($sortArr1);
        $this->data['admin_notes'] = $this->product_model->get_all_details(NOTES, array('reserved_id' => $id), $sortArr);
        $this->data['admin_status'] = $this->product_model->get_all_details(STATUS, array('reserved_id' => $id));
        $this->data['popup_img'] = $this->product_model->get_all_details('notes_image', array('reserved_id' => $id));
        $this->data['resCode'] = $this->product_model->get_all_details(ATTRIBUTE, array('status' => 'Active'));
        $this->data['RentalState'] = $this->product_model->get_all_details(STATE_TAX, array('status'=>'Active'));
            
        $this->load->view('crmadmin/product/display_product_list_general', $this->data);
    }
        
    public function reserved_product_details()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $condition	=	array('id' => $this->uri->segment(4, 0));
            $this->data['heading'] = 'Reserved Property Information';
            $this->data['productList'] = $this->product_model->get_all_details(RESERVED_INFO, $condition);
            //print_r($this->data['productList']->result());die;
            $PropertyList=$this->data['productList'];
            $this->data['productListPopUp']='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gain Turnkey Property</title>
</head>
<body style="background:#FFFFFF; width:100%; margin:0; padding:0;">
	<table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px;">
		<tr style="background:#3e3d3f; height:50px; width:100%;">
    		<td></td>
        </tr>
        <tr style="background:#c4c4c4; height:85px; width:100%;">
        	<td width="50%;"><img src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" width="350px" /><span style="float:right; margin:25px 0 0; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold">'.$PropertyList->row()->prop_address.'</span></td>
        </tr>
    </table>		
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px;">
    	<tr>
        	<td  height="30" align="center" style="float:left; text-align:center; color:#008904; width:100%; margin:35px 0 10px 0; font-family:Arial, Helvetica, sans-serif;  font-size:18px; font-weight:bold">Property Reservation Confirmation</td>
        </tr>
        <tr>
        	<td style="float:left; text-align:center; color:#333; width:100%; margin:25px 0 0; font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:normal">Congratulations! You have placed the following property Sold. Our staff is working diligently on your closing documents and trnasfer packet. Please bring this Hotsheet with you to your closing at th event.</td>
        </tr>
    </table>
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px;">
    	<tr style="margin:20px 0 40px; float:left;">
        	<td>
            	<img src="'.base_url().'images/product/'.$PropertyList->row()->image.'" width="300px" height="225px" />
            </td>
            <td>
            	<table cellpadding="0" cellspacing="0">
                	<tr>
                    	<td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; display: inline-block; margin:0 0 15px 10px;"><b>Property ID: '.$PropertyList->row()->rental_id.'</b></td>
                    </tr>
                   <tr>
                    	<td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;  display: inline-block; margin:0 0 15px 10px;"><b>'.$PropertyList->row()->prop_address.'</b></td>
                    </tr>
                    <!--<tr>
                    	<td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;  display: inline-block; margin:0 0 15px 10px;"><b>Buffalo, NY, 14211</b></td>
                    </tr>-->
                    <tr>
                    	<td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; display: inline-block; margin:0 0 15px 10px;"><b>Beds : '.$PropertyList->row()->bedrooms.'</b><b style="margin:0 0 0 100px">Baths : '.$PropertyList->row()->baths.'</b></td>
                    </tr>
                     <tr>
                    	<td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; display: inline-block; margin:0 0 15px 10px;"><b>Sq.Ft : '.$PropertyList->row()->sf_feet.'</b><b style="margin:0 0 0 77px">Lot Size : '.$PropertyList->row()->lot_size.'</b></td>
                    </tr>
                    <tr>
                    	<td height="25px" valign="top" style=" font-size:15px; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;" height="20px"><b style="margin:0 0 0 10px">Monthly Rental Amount : $ '.number_format($PropertyList->row()->monthly_rent, 0).'</b></td>

						
                    </tr>
					<tr>
					<td height="25px" valign="top" style=" font-size:15px; width=100% !important; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;" "><b style="margin:0 0 0 10px">Estimated Annual Tax: $ '.number_format($PropertyList->row()->property_tax, 0).'</b></td>
					</tr>
                </table>
            </td>
        </tr>
    </table>
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px;">
    	<tr style="margin:20px 0 40px; float:left;">
            <td>
			<h2 style="color:#008904;  font-size:18px; font-family:Arial, Helvetica, sans-serif; margin:15px 0 15px 0px;">Reservation Information</h2>
            	<span style="width:100%; display:inline-block; margin:0 0 15px; font-weight:bold; font-size:14px; font-family:Arial, Helvetica, sans-serif">Purchaser Name: '.ucfirst($PropertyList->row()->first_name).' '.ucfirst($PropertyList->row()->last_name).' </span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Name:'.$PropertyList->row()->entity_name.'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Address: '.$PropertyList->row()->address.'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">City: '.$PropertyList->row()->city.','.$PropertyList->row()->state.', '.$PropertyList->row()->postal_code.'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone: '.$PropertyList->row()->phone_no.'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email1: '.$PropertyList->row()->email.'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sales Price: '.number_format($PropertyList->row()->sales_price, 0).'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->cash_payment.''.$PropertyList->row()->check_payment.''.$PropertyList->row()->credit_payment.''.$PropertyList->row()->dot_payment.'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Note: '.$PropertyList->row()->note.'</span>
            </td>
            <td>
            	<span style="width:100%; display:inline-block; margin:0 0 15px; font-weight:bold; font-size:14px; font-family:Arial, Helvetica, sans-serif"></span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Type:'.$PropertyList->row()->resrv_type.'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif"></span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">State: '.$PropertyList->row()->state.'<b style="float:right; font-weight:bold">Zip: '.$PropertyList->row()->postal_code.'</b></span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone 2: '.$PropertyList->row()->phone_no1.'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email2: '.$PropertyList->row()->email1.'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: '.$PropertyList->row()->reserv_price.'</span>
                <span style="width:100%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->sales_cash.''.$PropertyList->row()->sales_cf.''.$PropertyList->row()->sales_cs.''.$PropertyList->row()->sales_fs.''.$PropertyList->row()->sales_sdira.'</span>
            </td>
        </tr>
    </table>   
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px;">
    	<tr>
        	<td style="font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:22px; text-align:center">
            	This Property reservation Confirmationis your receipt of your commitment to purchase the above referenced property. Due to the nature of the investors summit, and the overwhelming intrest the students have in purchasing the properties brought to the event by our preferred vendors, your possession of this document is evidence that the property has been removed from our active database and is no longer available for sale to other students. Our staff will contact you during the final two days of the event to arrange the production and execution of the final document for closing. Please keep this information for reference prior to closing.
            </td>
        </tr>
        <tr style="background:#3d3c3e; height:27px; margin:10px 0 20px; text-align:center;  width:100%; display:inline-block;">
        	<td style="text-align:center; display:inline-block; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin:6px 0 0;">'.$this->config->item('footer_content').'</td>
        </tr>
		<tr>
        	<td style="font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:22px; text-align:center">
            	<a href="'.base_url().'crmadmin/order/view_order/'.$PropertyList->row()->id.'">Download PDF</a>
            </td>
        </tr>
    </table> 
   
</body>
</html>';
                    
            $this->load->view('crmadmin/product/reserved_detail', $this->data);
        }
    }

    /**
     *
     * This function loads the affiliate product list page
     */
    public function display_user_product_list()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->data['heading'] = 'UnSold Property List';
            $this->data['productList'] = $this->product_model->view_product_details(' where property_status="UnSold" group by p.id order by p.created desc ');
            $this->data['confirm_code'] = $this->product_model->get_confirm_code();
            $this->data['product_image'] = $this->product_model->Display_product_image_details();
            $this->data['code'] = $this->data['confirm_code']->row();
            
            $this->load->view('crmadmin/product/display_user_product_list', $this->data);
        }
    }
    
    
    
    public function display_document()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->data['heading'] = 'Document';
                        
            $this->load->view('crmadmin/product/document', $this->data);
        }
    }
    
    
    
    
    /**
     *
     * This function loads the add new product form
     */
    public function add_product_form()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->data['heading'] = 'Add New Property';
            $this->data['Product_id'] = $this->uri->segment(4, 0);
            $this->data['categoryView'] = $this->product_model->view_category_details();
            //Rental Address
            $this->data['RentalCountry'] = $this->product_model->get_all_details(COUNTRY_LIST, array('status'=>'Active'));
            $this->data['RentalState'] = $this->product_model->get_all_details(STATE_TAX, array('status'=>'Active'));
            $this->data['RentalCity'] =  $this->product_model->get_all_details(CITY, array('status'=>'Active'));
            $this->data['Property_Type'] = $this->product_model->get_all_details(PRODUCT_ATTRIBUTE, array('status'=>'Active'));
            $this->data['Property_Sub_Type'] = $this->product_model->get_all_details('fc_subattribute', array('status'=>'Active'));
            
            
            $this->data['atrributeValue'] = $this->product_model->view_atrribute_details();
            $this->data['PrdattrVal'] = $this->product_model->view_product_atrribute_details();
            $this->data['LastInsertRentalId'] = $this->product_model->LastInsertRentalId();
            $getdelId=($this->data['LastInsertRentalId']->row()->LIid)+1;
            $conditiondel = array('PropId' => $getdelId);
            //$this->product_model->commonDelete(CALENDARBOOKING,$conditiondel);
            //print_r($this->data['LastInsertRentalId']->result());die;
            $this->load->view('crmadmin/product/add_product', $this->data);
        }
    }
    
    /**
     *
     * This function insert and edit product
     */
    public function insertEditProduct()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $headline = $this->input->post('headline');
            $property_id = $this->input->post('propertyID');
            $price = $this->input->post('event_price');
                
            if ($property_id == '') {
                $old_product_details = array();
                $condition = array('headline' => $headline);
                $soldmode='UnSold';
            } else {
                $old_product_details = $this->product_model->get_all_details(PRODUCT, array('id'=>$property_id));
                $condition = array('headline' => $headline,'id !=' => $property_id);
                $soldmode=$old_product_details->row()->property_status;
            }
                
                
                
            if ($property_id != '') {
                if ($this->input->post('property_status') == 'Active') {
                    $this->product_model->commonDelete(RESERVED_INFO, array('property_id' => $property_id));
                }
            }
        
        
            $price_range = '';
            if ($price>0 && $price<30000) {
                $price_range = '1-30000';
            } elseif ($price>30000 && $price<40000) {
                $price_range = '30000-40000';
            } elseif ($price>40000 && $price<50000) {
                $price_range = '40000-50000';
            } elseif ($price>50000 && $price<60000) {
                $price_range = '50000-60000';
            } elseif ($price>60000) {
                $price_range = '60000+';
            }
                
            $excludeArr = array('imgtitle','imgPriority','address','state', 'city','post_code','latitude','longitude','product_id','changeorder','propertyID', 'b1_firstname','b1_lastname', 'b2_firstname', 'b2_lastname', 'b_entityname', 'b_entitytype', 'b_address', 'b_city', 'b_state', 'b_zipcode', 'b_phone1', 'b_phone2', 'b_email1', 'b_email2', 'b_purchase_price', 'sale_date', 'reservedTime','googlelat','googlelng','q','output','Reload','submit_button');
                
            if ($this->input->post('status') != '') {
                $product_status = 'Publish';
            } else {
                $product_status = 'UnPublish';
            }
            
            
            $seourl = url_title($headline, '-', true);
            $checkSeo = $this->product_model->get_all_details(PRODUCT, array('seourl'=>$seourl,'id !='=>$property_id));
            $seo_count = 1;
            while ($checkSeo->num_rows()>0) {
                $seourl = $seourl.$seo_count;
                $seo_count++;
                $checkSeo = $this->product_model->get_all_details(PRODUCT, array('seourl'=>$seourl,'id !='=>$property_id));
            }
            
            $ImageName = '';
            
            $datestring = "%Y-%m-%d %H:%i:%s";
            $time = time();
            if ($property_id == '') {
                $inputArr = array('created' => mdate($datestring, $time),
                                          'seourl' => $seourl,
                                          'price_range'=> $price_range,
                                         
                                          'status' => 'Publish'
                                        );
            } else {
                $inputArr = array('modified' => mdate($datestring, $time),
                                          'seourl' => $seourl,
                                          'status' => $product_status,
                                          'price_range'=> $price_range,
                                        
                                        );
            }
                    
                    
                        
            //$config['encrypt_name'] = TRUE;
            //$config['overwrite'] = FALSE;
            /*	$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
                $config['upload_path'] = './images/product/';
                 $this->upload->initialize($config);
                $this->load->library('upload', $config);
                if ( $this->upload->do_multi_upload('product_image')){

                        $imgDetails = $this->upload->get_multi_upload_data();

                               foreach ($imgDetails as $fileDetails){
                                        $returnStr['image']['width'] = $fileDetails['image_width'];
                                    $returnStr['image']['height'] = $fileDetails['image_height'];
                                    $returnStr['image']['name'] = $fileDetails['file_name'];
                                    $this->imageResizeWithSpace(420, 320, $fileDetails['file_name'], './images/product/');
                                    @copy('./images/product/'.$fileDetails['file_name'], './images/product/thumb/'.$fileDetails['file_name']);
                                    $this->imageResizeWithSpace(250, 188, $fileDetails['file_name'], './images/product/thumb/');
                                       $ImageName .= $fileDetails['file_name'].',';
                                    }

                                    }
                */
            $logoDirectory ='./images/product';
            if (!is_dir($logoDirectory)) {
                mkdir($logoDirectory, 0777);
            }
            //$config['overwrite'] = FALSE;
            $config['remove_spaces'] = false;
            $config['upload_path'] = $logoDirectory;
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
                       
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
                       
            $file_element_name = 'product_image';
            $ImageName_orig_name ='';
            $ImageName_encrypt_name ='';
                       
            $file_element_name = 'product_image';
               
            $filePRoductUploadData = array();
            $setPriority = 0;
            $imgtitle = $this->input->post('imgtitle');
              
            if ($this->upload->do_multi_upload('product_image')) {
            }
            
            // echo "<pre>";print_r($_FILES['product_image']);die;
            $logoDetails = $this->upload->get_multi_upload_data();
            //$logoDetails = $_FILES['product_image'];

            
            
            if ($property_id != '') {
                $this->update_old_list_values($property_id, $list_val_arr, $old_product_details);
            }
            $dataArr = $inputArr;
            
            
            if ($property_id == '') {
                $condition = array();
                
                $this->product_model->commonInsertUpdate(PRODUCT, 'insert', $excludeArr, $dataArr, $condition);
                
                $property_id = $this->product_model->get_last_insert_id();
                
                $Attr_val_str = '';
                
                
                $this->setErrorMessage('success', 'Property added successfully');
                
            
                $this->update_price_range_in_table('add', $price_range, $property_id, $old_product_details);
                //echo '<pre>';
                //print_r($excludeArr);print_r($dataArr);print_r($condition);die;
                //echo $this->input->post('status');die;
                
                $inputArr1 = array(
                            'property_id' =>$property_id,
                            //'country' => $this->input->post('country'),
                            'state' => $this->input->post('state'),
                            'city' => $this->input->post('city'),
                            'post_code' => $this->input->post('post_code'),
                            'property_name' => $this->input->post('property_name'),
                            
                            
                            'address'=> $this->input->post('address'),
                            'latitude'=> $this->input->post('latitude'),
                            'longitude'=> $this->input->post('longitude')
                );
                $this->product_model->simple_insert(PRODUCT_ADDRESS, $inputArr1);
                
                
                $inputArr2=array();
                $inputArr2 = array(
                            'property_id' =>$property_id,
                            'feature' => $this->input->post('feature'),
                            'google_map' => $this->input->post('google_map'),
                            'add_feature' => $this->input->post('add_feature'),
                            'rentals_policy' => $this->input->post('rentals_policy'),
                            'trams_condition' => $this->input->post('trams_condition'),
                            'confirm_email' => $this->input->post('confirm_email'),
                            'order_email' => $this->input->post('order_email'),
                            'invoice_template'=> $this->input->post('invoice_template')
                );
                
        
                //Update user table count
                if ($this->checkLogin('U') != '') {
                    $user_details = $this->product_model->get_all_details(USERS, array('id'=>$this->checkLogin('U')));
                    if ($user_details->num_rows()==1) {
                        $prod_count = $user_details->row()->products;
                        $prod_count++;
                        $this->product_model->update_details(USERS, array('products'=>$prod_count), array('id'=>$this->checkLogin('U')));
                    }
                }
            } else {
                $condition = array('id'=>$property_id);
                $this->product_model->commonInsertUpdate(PRODUCT, 'update', $excludeArr, $dataArr, $condition);
                $this->product_model->saveResevedSettings();
                $this->product_model->saveSoldSettings();
                
                $condition1 = array('property_id'=>$property_id);
                $inputArr1 = array(
                            'property_id' =>$property_id,
                            'country' => $this->input->post('country'),
                            'state' => $this->input->post('state'),
                            'city' => $this->input->post('city'),
                            'post_code' => $this->input->post('post_code'),
                            'property_name' => $this->input->post('property_name'),
                            
                            'address'=> $this->input->post('address'),
                            'latitude'=> $this->input->post('latitude'),
                            'longitude'=> $this->input->post('longitude')
                );
                $this->product_model->update_details(PRODUCT_ADDRESS, $inputArr1, $condition1);
                
                $inputArr2=array();
                $inputArr2 = array(
                            'property_id' =>$property_id,
                            'feature' => $this->input->post('feature'),
                            'google_map' => $this->input->post('google_map'),
                            'add_feature' => $this->input->post('add_feature'),
                            'rentals_policy' => $this->input->post('rentals_policy'),
                            'trams_condition' => $this->input->post('trams_condition'),
                            'confirm_email' => $this->input->post('confirm_email'),
                            'order_email' => $this->input->post('order_email'),
                            'invoice_template'=> $this->input->post('invoice_template')
                );
                
                $this->product_model->update_details(PRODUCT_FEATURES, $inputArr2, $condition1);
                
                
                
                
                $this->setErrorMessage('success', 'Property updated successfully');
                $this->update_price_range_in_table('edit', $price_range, $property_id, $old_product_details);
            }
            
            
            //upload image the table
            foreach ($logoDetails as $fileVal) {
                if (!$this->imageResizeWithSpace(600, 600, $file_element_name[$setPriority], './images/product/')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $sliderUploadedData = array($this->upload->data());
                }
                                              
                $filePRoductUploadData = array('property_id'=>$property_id,'product_image'=>$fileVal['file_name']);
                       
                $this->product_model->simple_insert(PRODUCT_PHOTOS, $filePRoductUploadData);
                $setPriority = $setPriority + 1;
            }
            //Insert the Property package cost
            $inputArrRate=$this->input->post('PrCosting');
            $inputArrPrName=$this->input->post('PrName');
            $inputArrPrStartDate=$this->input->post('PrStartDate');
            $inputArrPrEndDate=$this->input->post('PrEndDate');
            $inputArrPrUnit=$this->input->post('PrUnit');
            $inputArrPrNightly=$this->input->post('Nightly');
            $inputArrPrWkndNight=$this->input->post('WkndNight');
            $inputArrPrWeekend=$this->input->post('Weekend');
            $inputArrPrWeekly=$this->input->post('Weekly');
            $inputArrPrMonthly=$this->input->post('Monthly');
            $inputArrPrEvent=$this->input->post('Event');
                
            if (count($inputArrPrName)>0) {
                for ($i=0;$i < count($inputArrPrName);$i++) {
                    if ($inputArrPrName[$i]!='') {
                        $inputArrRateVal = array(
                                        'property_id' =>$property_id,
                                        'PrName' => $inputArrPrName[$i],
                                        'PrStartDate' => $inputArrPrStartDate[$i],
                                        'PrEndDate' => $inputArrPrEndDate[$i],
                                        'Nightly' => $inputArrPrNightly[$i],
                                        'WkndNight' => $inputArrPrWkndNight[$i],
                                        'Weekend' => $inputArrPrWeekend[$i],
                                        'Weekly' => $inputArrPrWeekly[$i],
                                        'Monthly' => $inputArrPrMonthly[$i],
                                        'Event' => $inputArrPrEvent[$i]
                            );
                        $this->product_model->simple_insert(PRODUCT_PACKAGES, $inputArrRateVal);
                    }
                }
            }
            //Update the list table
            if (is_array($list_val_arr)) {
                foreach ($list_val_arr as $list_val_row) {
                    $list_val_details = $this->product_model->get_all_details(LIST_VALUES, array('id'=>$list_val_row));
                    if ($list_val_details->num_rows()==1) {
                        $product_count = $list_val_details->row()->product_count;
                        $products_in_this_list = $list_val_details->row()->products;
                        $products_in_this_list_arr = explode(',', $products_in_this_list);
                        if (!in_array($property_id, $products_in_this_list_arr)) {
                            array_push($products_in_this_list_arr, $property_id);
                            $product_count++;
                            $list_update_values = array(
                                'products'=>implode(',', $products_in_this_list_arr),
                                'product_count'=>$product_count
                            );
                            $list_update_condition = array('id'=>$list_val_row);
                            $this->product_model->update_details(LIST_VALUES, $list_update_values, $list_update_condition);
                        }
                    }
                }
            }
            
            if ($this->input->post('submit_button') == 'savencont') {
                $this->source_info_form($property_id);
            } else {
                redirect('crmadmin/product/display_product_list');
            }
            //if($soldmode=='Sold'){
            //	redirect('crmadmin/product/display_product_list');
            //}else{
                //redirect('crmadmin/product/display_user_product_list');
            //}
        }
    }
    
    
    /**
     *
     * Update the products_count and products in list_values table, when edit or delete products
     * @param Integer $property_id
     * @param Array $list_val_arr
     * @param Array $old_product_details
     */
     
    
        
        
    public function update_old_list_values($product_id, $list_val_arr, $old_product_details='')
    {
        if ($old_product_details == '' || count($old_product_details)==0) {
            $old_product_details = $this->product_model->get_all_details(PRODUCT, array('id'=>$product_id));
        }
        $old_product_list_values = array_filter(explode(',', $old_product_details->row()->list_value));
        if (count($old_product_list_values)>0) {
            if (!is_array($list_val_arr)) {
                $list_val_arr = array();
            }
            foreach ($old_product_list_values as $old_product_list_values_row) {
                if (!in_array($old_product_list_values_row, $list_val_arr)) {
                    $list_val_details = $this->product_model->get_all_details(LIST_VALUES, array('id'=>$old_product_list_values_row));
                    if ($list_val_details->num_rows()==1) {
                        $product_count = $list_val_details->row()->product_count;
                        $products_in_this_list = $list_val_details->row()->products;
                        $products_in_this_list_arr = array_filter(explode(',', $products_in_this_list));
                        if (in_array($product_id, $products_in_this_list_arr)) {
                            if (($key = array_search($product_id, $products_in_this_list_arr))!==false) {
                                unset($products_in_this_list_arr[$key]);
                            }
                            $product_count--;
                            $list_update_values = array(
                                'products'=>implode(',', $products_in_this_list_arr),
                                'product_count'=>$product_count
                            );
                            $list_update_condition = array('id'=>$old_product_list_values_row);
                            $this->product_model->update_details(LIST_VALUES, $list_update_values, $list_update_condition);
                        }
                    }
                }
            }
        }
        
        if ($old_product_details != '' && count($old_product_details)>0 && $old_product_details->num_rows()==1) {
        
        /*** Delete product id from lists which was created by users ***/
        
            $user_created_lists = $this->product_model->get_user_created_lists($old_product_details->row()->seller_product_id);
            if ($user_created_lists->num_rows()>0) {
                foreach ($user_created_lists->result() as $user_created_lists_row) {
                    $list_product_ids = array_filter(explode(',', $user_created_lists_row->product_id));
                    if (($key=array_search($old_product_details->row()->seller_product_id, $list_product_ids)) !== false) {
                        unset($list_product_ids[$key]);
                        $update_ids = array('product_id'=>implode(',', $list_product_ids));
                        $this->product_model->update_details(LISTS_DETAILS, $update_ids, array('id'=>$user_created_lists_row->id));
                    }
                }
            }
        
            /*** Delete product id from product likes table and decrease the user likes count ***/
        
            
            /*** Delete product id from activity, notification and product comment tables ***/
            
            $this->product_model->commonDelete(USER_ACTIVITY, array('activity_id'=>$old_product_details->row()->seller_product_id));
            $this->product_model->commonDelete(NOTIFICATIONS, array('activity_id'=>$old_product_details->row()->seller_product_id));
        }
    }
    
    public function update_price_range_in_table($mode='', $price_range='', $product_id='0', $old_product_details='')
    {
        $list_values = $this->product_model->get_all_details(LIST_VALUES, array('list_value'=>$price_range));
        if ($list_values->num_rows() == 1) {
            $products = explode(',', $list_values->row()->products);
            $product_count = $list_values->row()->product_count;
            if ($mode == 'add') {
                if (!in_array($product_id, $products)) {
                    array_push($products, $product_id);
                    $product_count++;
                }
            } elseif ($mode == 'edit') {
                $old_price_range = '';
                if ($old_product_details!='' && count($old_product_details)>0 && $old_product_details->num_rows()==1) {
                    $old_price_range = $old_product_details->row()->price_range;
                }
                if ($old_price_range != '' && $old_price_range != $price_range) {
                    $old_list_values = $this->product_model->get_all_details(LIST_VALUES, array('list_value'=>$old_price_range));
                    if ($old_list_values->num_rows() == 1) {
                        $old_products = explode(',', $old_list_values->row()->products);
                        $old_product_count = $old_list_values->row()->product_count;
                        if (in_array($product_id, $old_products)) {
                            if (($key=array_search($product_id, $old_products)) !== false) {
                                unset($old_products[$key]);
                                $old_product_count--;
                                $updateArr = array('products'=>implode(',', $old_products),'product_count'=>$old_product_count);
                                $updateCondition = array('list_value'=>$old_price_range);
                                $this->product_model->update_details(LIST_VALUES, $updateArr, $updateCondition);
                            }
                        }
                    }
                    if (!in_array($product_id, $products)) {
                        array_push($products, $product_id);
                        $product_count++;
                    }
                } elseif ($old_price_range != '' && $old_price_range == $price_range) {
                    if (!in_array($product_id, $products)) {
                        array_push($products, $product_id);
                        $product_count++;
                    }
                }
            }
            $updateArr = array('products'=>implode(',', $products),'product_count'=>$product_count);
            $updateCondition = array('list_value'=>$price_range);
            $this->product_model->update_details(LIST_VALUES, $updateArr, $updateCondition);
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
        $productImage = explode(',', $this->session->userdata('product_image_'.$ingIDD));
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
            if ($empImg<2) {
                echo json_encode("No");
                exit();
            }
            $this->session->unset_userdata('product_image_'.$ingIDD);
            $resultVar = $this->setPictureProducts($productImage, $this->input->post('position'));
            $insertArrayItems = trim(implode(',', $resultVar)); //need validation here...because the array key changed here
            
            $this->session->set_userdata(array('product_image_'.$ingIDD => $insertArrayItems));
            $dataArr = array('image' => $insertArrayItems);
            $condition = array('id' => $ingIDD);
            $this->product_model->update_details(PRODUCT, $dataArr, $condition);
            echo json_encode($insertArrayItems);
        }
    }
    
    
    /**
     *
     * Ajax function for delete the product Package
     */
    public function DeletePackageProducts()
    {
        $ingIDD = $this->input->post('imgId');
        $currentPage = $this->input->post('cpage');
        $condition = array('id' => $ingIDD);
        $this->product_model->commonDelete(PRODUCT_PACKAGES, $condition);
        echo $result=1;
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
        echo $result=1;
    }
    
    public function DeleteFiles()
    {
        $delid = $this->uri->segment(5);
        $lasturi = $this->uri->segment(4);
        $id = $this->uri->segment(6);
        $type = $this->uri->segment(7);
        $imgname = $this->uri->segment(8);
        $condition = array('id' => $delid);
        $this->product_model->commonDelete('notes_image', $condition);
        unlink('./images/crm-popup-images/'.$imgname);
        redirect(base_url().'crmadmin/product/display_product_list/'.$lasturi.'/'.$id.'/'.$type);
    }
    
    
    /**
     *
     * Ajax function for chhange the product featured/unfeatured
     */
    public function ChangeFeaturedProducts()
    {
        $ingIDD = $this->input->post('imgId');
        $FtrId = $this->input->post('FtrId');
        $currentPage = $this->input->post('cpage');
        $dataArr = array('featured' => $FtrId);
        $condition = array('id' => $ingIDD);
        $this->product_model->update_details(PRODUCT, $dataArr, $condition);
        echo $result=$FtrId;
    }
    
    /**
     *
     * This function loads the edit product form
     */
    public function edit_product_form()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->data['heading'] = 'Edit Property';
            $product_id = $this->uri->segment(4, 0);
            
            $condition = array('id' => $product_id);
            $this->data['product_details'] = $this->product_model->view_product1($product_id);
            
            //print_r($this->data['product_details']->row());
            //die;
            
            if ($this->data['product_details']->num_rows() == 1) {
                $userid = $this->data['product_details']->row()->user_id;
                $this->data['userDetails'] = $this->product_model->get_all_details(USERS, array('id'=>$userid));
                $this->data['categoryView'] = $this->product_model->get_category_details($this->data['product_details']->row()->category_id);
                $this->data['atrributeValue'] = $this->product_model->view_atrribute_details();
                $this->data['SubPrdVal'] = $this->product_model->view_subproduct_details($product_id);
                $this->data['PrdattrVal'] = $this->product_model->view_product_atrribute_details();
                $sortArr1 = array('field'=>'imgPriority','type'=>'ASC');
                $this->data['product_image'] = $this->product_model->get_all_details_product(PRODUCT_PHOTOS, array('property_id'=>$this->data['product_details']->row()->id), $sortArr1);
                //	echo $this->db->last_query();die;
                $this->data['Property_Type'] = $this->product_model->get_all_details(PRODUCT_ATTRIBUTE, array('status'=>'Active'));
                $this->data['Property_Sub_Type'] = $this->product_model->get_all_details('fc_subattribute', array('status'=>'Active'));
                /*$this->data['Rate_Package'] = $this->product_model->get_all_details(PRODUCT_RATE_PACKAGE,array('status'=>'Active'));
                $this->data['Product_Rate_Package'] = $this->product_model->get_all_details(PRODUCT_PACKAGES,array('product_id'=>$this->data['product_details']->row()->id));*/
                $this->data['RentalCountry'] = $this->product_model->get_all_details(COUNTRY_LIST, array('status'=>'Active'));
                $this->data['RentalState'] = $this->product_model->get_all_details(STATE_TAX, array('status'=>'Active'));
                $this->data['RentalCity'] =  $this->product_model->get_all_details(CITY, array('status'=>'Active'));
                
                
                
                
                $this->load->library('googlemaps');
                $config['center'] = $this->data['product_details']->row()->latitude.','.$this->data['product_details']->row()->longitude;
                $config['zoom'] = 'auto';
                $this->googlemaps->initialize($config);
                $marker = array();
                $marker['position'] =$this->data['product_details']->row()->latitude.','.$this->data['product_details']->row()->longitude;
                $marker['draggable'] = true;
                $marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
                $this->googlemaps->add_marker($marker);
                $this->data['map']= $this->googlemaps->create_map();
                
                
                //echo '<pre>'; print_r($this->data['SubPrdVal']->result()); die;
                $this->load->view('crmadmin/product/edit_product', $this->data);
            } else {
                redirect('deals_crm');
            }
        }
    }
    
    /* Ajax update for edit product */
    public function ajaxProductAttributeUpdate()
    {
        $conditons = array('pid'=>$this->input->post('attId'));
        $dataArr = array('attr_id'=>$this->input->post('attname'),'attr_price'=>$this->input->post('attval'));
        $subproductDetails = $this->product_model->edit_subproduct_update($dataArr, $conditons);
    }
    
    /**
     *
     * This function change the selling product status
     */
    public function change_product_status()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $mode = $this->uri->segment(4, 0);
            $product_id = $this->uri->segment(5, 0);
            $status = ($mode == '0')?'UnPublish':'Publish';
            $newdata = array('status' => $status);
            $condition = array('id' => $product_id);
            $this->product_model->update_details(PRODUCT, $newdata, $condition);
            $this->setErrorMessage('success', 'Property Status Changed Successfully');
            redirect('crmadmin/product/display_product_list');
        }
    }
    
    public function change_product_sold_status()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $mode = $this->input->post('mode');
            $product_id = $this->input->post('id');
            $status = ($mode == '0')?'Unsold':'Sold';
            $newdata = array('property_status' => $status);
            $condition = array('id' => $product_id);
            $this->product_model->update_details(PRODUCT, $newdata, $condition);
            $this->setErrorMessage('success', 'Property Status Changed Successfully');
            echo '1';
            //redirect('crmadmin/product/display_product_list');
        }
    }
    
    /**
     *
     * This function change the affiliate product status
     */
    public function change_user_product_status()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $mode = $this->uri->segment(4, 0);
            $product_id = $this->uri->segment(5, 0);
            $status = ($mode == '0')?'UnPublish':'Publish';
            $newdata = array('status' => $status);
            $condition = array('id' => $product_id);
            $this->product_model->update_details(PRODUCT, $newdata, $condition);
            $this->setErrorMessage('success', 'Rental Status Changed Successfully');
            redirect('crmadmin/product/display_user_product_list');
        }
    }
    
    /**
     *
     * This function loads the product view page
     */
    public function view_product()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->data['heading'] = 'View Property';
            $product_id = $this->uri->segment(4, 0);
            $condition = array('id' => $product_id);
            $sortArr1 = array('field'=>'imgPriority','type'=>'ASC');
            //$this->data['product_details'] = $this->product_model->get_all_details(PRODUCT,$condition);
            $this->data['product_details'] = $this->product_model->view_product1($product_id);
            if ($this->data['product_details']->num_rows() == 1) {
                $this->data['catList'] = $this->product_model->get_cat_list($this->data['product_details']->row()->category_id);
                $this->data['RentalCountry'] = $this->product_model->get_all_details(COUNTRY_LIST, array('status'=>'Active'));
                $this->data['RentalState'] = $this->product_model->get_all_details(STATE_TAX, array('status'=>'Active'));
                $this->data['RentalCity'] =  $this->product_model->get_all_details(CITY, array('status'=>'Active'));
                $this->data['product_image'] = $this->product_model->get_all_details(PRODUCT_PHOTOS, array('property_id'=>$this->data['product_details']->row()->id), $sortArr1);
                //$this->data['Product_Rate_Package'] = $this->product_model->get_all_details(PRODUCT_PACKAGES,array('product_id'=>$this->data['product_details']->row()->id));
                $this->data['listNameCnt'] = $this->product_model->get_all_details(ATTRIBUTE, array('status'=>'Active'));
                $this->data['listValueCnt'] = $this->product_model->get_all_details(LIST_VALUES, array('status'=>'Active'));
                $this->data['ReservedDetails'] =  $this->product_model->get_all_details(RESERVED_INFO, array('property_id'=>$this->data['product_details']->row()->id));
                $this->data['product_source_details'] = $this->product_model->get_all_details(SOURCE_INFO, array('property_id'=>$this->data['product_details']->row()->id));
                
                $sourceData = $this->data['product_source_details']->row()->datavalues;
                $this->data['source_info'] = unserialize(stripslashes($sourceData));
                $list_valueArr=explode(',', $this->data['product_details']->row()->list_value);
                $listIdArr=array();
                foreach ($this->data['listValueCnt']->result_array() as $listCountryValue) {
                    $listIdArr[]=$listCountryValue['list_id'];
                }
                if ($this->data['listNameCnt']->num_rows() > 0) {
                    foreach ($this->data['listNameCnt']->result_array() as $listCountryName) {
                        $this->data['listCountryValue'] .='<br /><span class="cat1"><!-- <input name="list_name[]" class="checkbox" type="checkbox" value="'.$listCountryName['id'].'" tabindex="7"> --><strong>'.ucfirst($listCountryName['attribute_name']).' &nbsp;</strong></span><br />';
                        foreach ($this->data['listValueCnt']->result_array() as $listCountryValue) {
                            if ($listCountryValue['list_id']==$listCountryName['id']) {
                                if (in_array($listCountryValue['id'], $list_valueArr)) {
                                    $checkStr = 'checked="checked"';
                                } else {
                                    $checkStr = '';
                                }
                                $this->data['listCountryValue'] .='
								<div style="float:left; margin-left:10px;">
								<span>
								<input name="list_value[]" disabled="disabled"  class="checkbox" '.$checkStr.' type="checkbox" value="'.$listCountryValue['id'].'" tabindex="7">
								<label class="choice">'.ucfirst($listCountryValue['list_value']).'</label></span></div>';
                            }
                        }
                    }
                }
                
                $this->load->library('googlemaps');
                $config['center'] = $this->data['product_details']->row()->latitude.','.$this->data['product_details']->row()->longitude;
                $config['zoom'] = 'auto';
                $this->googlemaps->initialize($config);
                $marker = array();
                $marker['position'] =$this->data['product_details']->row()->latitude.','.$this->data['product_details']->row()->longitude;
                $marker['draggable'] = true;
                $marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
                $this->googlemaps->add_marker($marker);
                $this->data['map']= $this->googlemaps->create_map();
            
                $this->load->view('crmadmin/product/view_product', $this->data);
            } else {
                redirect('deals_crm');
            }
        }
    }
    
    public function source_info_form($id)
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->data['propertyID'] = $id;
            $this->data['source'] = $this->product_model->get_all_details(SOURCE_INFO, array('property_id'=>$id));
            $this->data['propertyaddress'] = $this->product_model->get_all_details(PRODUCT_ADDRESS, array('property_id' => $id));
            $this->data['ReservedDetails'] =  $this->product_model->get_all_details(RESERVED_INFO, array('property_id'=>$id));
            if ($this->data['source']->num_rows() == 0) {
                $this->data['heading'] = 'Add Source Info';
                $this->load->view('crmadmin/product/add_source_info', $this->data);
            } elseif ($this->data['source']->num_rows() == 1) {
                $this->data['heading'] = 'Edit Source Info';
                $condition = array('property_id'=>$id);
                //$this->data['product_source_details'] = $this->product_model->get_all_details(SOURCE_INFO,$condition);
                            
                            
                $get_source_info = $this->product_model->get_all_details(SOURCE_INFO, $condition);
                $data = $get_source_info->row()->datavalues;
                $this->data['source_info'] = unserialize(stripslashes($data));
                $this->load->view('crmadmin/product/edit_source_info', $this->data);
            } else {
                $this->setErrorMessage('error', 'Details not found');
                redirect(base_url().'crmadmin/product/display_product_list');
            }
        }
    }
        
    public function edit_source_info_form()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->data['heading'] = 'Edit Source Info';
            $product_id = $this->uri->segment(4, 0);
            $condition = array('property_id' => $product_id);
            $this->data['propertyID'] = $this->product_model->get_all_details(PRODUCT, array('id'=>$product_id));
            $this->data['propertyaddress'] = $this->product_model->get_all_details(PRODUCT_ADDRESS, array('property_id' => $product_id));
                    
            $this->data['product_source_details'] = $this->product_model->get_all_details(SOURCE_INFO, $condition);
            if ($this->data['product_source_details']->num_rows() == 1) {
                $get_source_info = $this->product_model->get_all_details(SOURCE_INFO, $condition);
                $data = $get_source_info->row()->datavalues;
                $this->data['source_info'] = unserialize(stripslashes($data));
                                    
                $this->load->view('crmadmin/product/edit_source_info', $this->data);
            } elseif ($this->data['product_source_details']->num_rows() == 0) {
                $this->load->view('crmadmin/product/edit_source_info', $this->data);
            } else {
                $this->setErrorMessage('error', 'Details not found');
                redirect(base_url().'crmadmin/product/display_product_list');
            }
        }
    }
        
    public function add_source_info()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $value = $this->input->post();

            $data = serialize($value);
            $condition = array('property_id'=>$this->input->post('id'));
            $id = $this->input->post('id');
            $rows = $this->product_model->get_all_details(SOURCE_INFO, $condition);
            if ($rows->num_rows() == 1) {
                $this->product_model->update_details(SOURCE_INFO, array('datavalues'=>$data), $condition);
                $this->setErrorMessage('success', 'Property source info details updated successfully');
            } elseif ($rows->num_rows() == 0) {
                $this->product_model->simple_insert(SOURCE_INFO, array('datavalues'=>$data,'property_id'=>$id));
                $this->setErrorMessage('success', 'Property source info details added successfully');
            }
            redirect(base_url().'crmadmin/product/display_product_list');
        }
    }
    
    public function edit_source_info()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $value = $this->input->post();
                    
            $data = serialize($value);
            $condition = array('property_id'=>$this->input->post('id'));
            $id = $this->input->post('id');
            $rows = $this->product_model->get_all_details(SOURCE_INFO, $condition);
            if ($rows->num_rows() == 1) {
                $this->product_model->update_details(SOURCE_INFO, array('datavalues'=>$data), $condition);
                $this->setErrorMessage('success', 'Property source info details updated successfully');
            } elseif ($rows->num_rows() == 0) {
                $this->product_model->simple_insert(SOURCE_INFO, array('datavalues'=>$data,'property_id'=>$id));
                $this->setErrorMessage('success', 'Property source info details added successfully');
            }
                    
            redirect(base_url().'crmadmin/product/display_product_list');
        }
    }
        
    
    /**
     *
     * This function delete the selling product record from db
     */
    public function delete_product()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $product_id = $this->uri->segment(4, 0);
            $condition = array('id' => $product_id);
            $prdId = array('property_id' => $product_id);
            $old_product_details = $this->product_model->get_all_details(PRODUCT, array('id'=>$product_id));
            $this->update_old_list_values($product_id, array(), $old_product_details);
            $this->update_user_product_count($old_product_details);
            $this->product_model->commonDelete(PRODUCT, $condition);
            $this->product_model->commonDelete(PRODUCT_ADDRESS, $prdId);
            $this->product_model->commonDelete(PRODUCT_FEATURES, $prdId);
            $this->product_model->commonDelete(PRODUCT_PHOTOS, $prdId);
            //$this->product_model->commonDelete(CONTACT,array('rental_id' => $product_id));
            $this->product_model->commonDelete(SUBPRODUCT, array('product_id' => $product_id));
            $this->setErrorMessage('success', 'Rental deleted successfully');
            redirect('crmadmin/product/display_product_list');
        }
    }
    
    /**
     *
     * This function delete the affiliate product record from db
     */
    public function delete_user_product()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $product_id = $this->uri->segment(4, 0);
            $condition = array('id' => $product_id);
            $prdId = array('property_id' => $product_id);
            $old_product_details = $this->product_model->get_all_details(PRODUCT, array('id'=>$product_id));
            $this->update_old_list_values($product_id, array(), $old_product_details);
            $this->update_user_product_count($old_product_details);
            $this->product_model->commonDelete(PRODUCT, $condition);
            $this->product_model->commonDelete(PRODUCT_ADDRESS, $prdId);
            $this->product_model->commonDelete(PRODUCT_FEATURES, $prdId);
            $this->product_model->commonDelete(PRODUCT_PHOTOS, $prdId);
            //$this->product_model->commonDelete(CONTACT,array('rental_id' => $product_id));
            $this->product_model->commonDelete(SUBPRODUCT, array('product_id' => $product_id));
            $this->setErrorMessage('success', 'Rental deleted successfully');
            redirect('crmadmin/product/display_user_product_list');
        }
    }
    
    public function update_user_likes($product_id='0')
    {
        $like_list = $this->product_model->get_like_user_full_details($product_id);
        if ($like_list->num_rows()>0) {
            foreach ($like_list->result() as $like_list_row) {
                $likes_count = $like_list_row->likes;
                $likes_count--;
                if ($likes_count<0) {
                    $likes_count=0;
                }
                $this->product_model->update_details(USERS, array('likes'=>$likes_count), array('id'=>$like_list_row->id));
            }
            $this->product_model->commonDelete(PRODUCT_LIKES, array('product_id'=>$product_id));
        }
    }
    
    public function update_user_created_lists($pid='0')
    {
        $user_created_lists = $this->product_model->get_user_created_lists($pid);
        if ($user_created_lists->num_rows()>0) {
            foreach ($user_created_lists->result() as $user_created_lists_row) {
                $list_product_ids = array_filter(explode(',', $user_created_lists_row->product_id));
                if (($key=array_search($pid, $list_product_ids)) !== false) {
                    unset($list_product_ids[$key]);
                    $update_ids = array('product_id'=>implode(',', $list_product_ids));
                    $this->product_model->update_details(LISTS_DETAILS, $update_ids, array('id'=>$user_created_lists_row->id));
                }
            }
        }
    }
    
    public function update_user_product_count($old_product_details)
    {
        if ($old_product_details!='' && count($old_product_details)>0 && $old_product_details->num_rows()==1) {
            if ($old_product_details->row()->user_id > 0) {
                $user_details = $this->product_model->get_all_details(USERS, array('id'=>$old_product_details->row()->user_id));
                if ($user_details->num_rows()==1) {
                    $prod_count = $user_details->row()->products;
                    $prod_count--;
                    if ($prod_count<0) {
                        $prod_count = 0;
                    }
                    $this->product_model->update_details(USERS, array('products'=>$prod_count), array('id'=>$old_product_details->row()->user_id));
                }
            }
        }
    }
    
    /**
     *
     * This function change the selling product status, delete the selling product record
     */
    public function change_product_status_global()
    {
        if ($_POST['checkboxID']!='') {
            if ($_POST['checkboxID']=='0') {
                redirect('crmadmin/product/add_product_form/0');
            } else {
                redirect('crmadmin/product/add_product_form/'.$_POST['checkboxID']);
            }
        } else {
            if (count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != '') {
                $data =  $_POST['checkbox_id'];
                if (strtolower($_POST['statusMode']) == 'delete') {
                    for ($i=0;$i<count($data);$i++) {
                        if ($data[$i] == 'on') {
                            unset($data[$i]);
                        }
                    }
                    foreach ($data as $product_id) {
                        if ($product_id!='') {
                            $old_product_details = $this->product_model->get_all_details(PRODUCT, array('id'=>$product_id));
                            $this->update_old_list_values($product_id, array(), $old_product_details);
                            $this->update_user_product_count($old_product_details);
                        }
                    }
                }
                $this->product_model->activeInactiveCommon(PRODUCT, 'id');
                if (strtolower($_POST['statusMode']) == 'delete') {
                    $this->setErrorMessage('success', 'Property records deleted successfully');
                } else {
                    $this->setErrorMessage('success', 'Property records status changed successfully');
                }
                redirect('crmadmin/product/display_product_list');
            }
        }
    }
    
    /**
     *
     * This function change the affiliate product status, delete the affiliate product record
     */
    public function change_user_product_status_global()
    {
        if (count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != '') {
            $data =  $_POST['checkbox_id'];
            if (strtolower($_POST['statusMode']) == 'delete') {
                for ($i=0;$i<count($data);$i++) {
                    if ($data[$i] == 'on') {
                        unset($data[$i]);
                    }
                }
                foreach ($data as $product_id) {
                    if ($product_id!='') {
                        $old_product_details = $this->product_model->get_all_details(USER_PRODUCTS, array('seller_product_id'=>$product_id));
                        $this->update_user_created_lists($product_id);
                        //$this->update_user_likes($product_id);
                        //$this->update_user_product_count($old_product_details);
                        $this->product_model->commonDelete(USER_ACTIVITY, array('activity_id'=>$product_id));
                        $this->product_model->commonDelete(NOTIFICATIONS, array('activity_id'=>$product_id));
                        $this->product_model->commonDelete(PRODUCT_COMMENTS, array('product_id'=>$product_id));
                        $this->product_model->commonDelete(SUBPRODUCT, array('product_id'=>$product_id));
                        $this->product_model->commonDelete(PRODUCT, array('id'=>$product_id));
                    }
                }
            }
            $this->product_model->activeInactiveCommon(PRODUCT, 'id');
            if (strtolower($_POST['statusMode']) == 'delete') {
                $this->setErrorMessage('success', 'Rental records deleted successfully');
            } else {
                $this->setErrorMessage('success', 'Rental records status changed successfully');
            }
            redirect('crmadmin/product/display_user_product_list');
        }
    }
    
    public function loadListValues()
    {
        $returnStr['listCnt'] = '<option value="">--Select--</option>';
        $lid = $this->input->post('lid');
        $lvID = $this->input->post('lvID');
        if ($lid != '') {
            $listValues = $this->product_model->get_all_details(LIST_VALUES, array('list_id'=>$lid));
            if ($listValues->num_rows()>0) {
                foreach ($listValues->result() as $listRow) {
                    $selStr = '';
                    if ($listRow->id == $lvID) {
                        $selStr = 'selected="selected"';
                    }
                    $returnStr['listCnt'] .= '<option '.$selStr.' value="'.$listRow->id.'">'.$listRow->list_value.'</option>';
                }
            } else {
                $returnStr['listCountryCnt'] .= '<option value="">---Select---</option>';
            }
        }
        echo json_encode($returnStr);
    }
    
    public function loadCountryListValues()
    {
        $returnStr['listCountryCnt'] = '<select class="chzn-select required" name="state" tabindex="-1" style="width: 375px;" onchange="javascript:loadStateListValues(this)"  data-placeholder="Please select the state name">';
        $lid = $this->input->post('lid');
        $lvID = $this->input->post('lvID');
        if ($lid != '') {
            $listValues = $this->product_model->get_all_details(STATE_TAX, array('countryid'=>$lid));
            if ($listValues->num_rows()>0) {
                foreach ($listValues->result() as $listRow) {
                    $selStr = '';
                    if ($listRow->id == $lvID) {
                        $selStr = 'selected="selected"';
                    }
                    $returnStr['listCountryCnt'] .= '<option '.$selStr.' value="'.$listRow->id.'">'.$listRow->name.'</option>';
                }
            } else {
                $returnStr['listCountryCnt'] .= '<option value="">---Select---</option>';
            }
        }
        $returnStr['listCountryCnt'] .= '</select>';
        
        
        echo json_encode($returnStr);
    }
    
    public function loadStateListValues()
    {
        $returnStr['listCountryCnt'] = '<select class="chzn-select required" name="city" tabindex="-1" style="width: 375px;" data-placeholder="Please select the city name">';
        $lid = $this->input->post('lid');
        $lvID = $this->input->post('lvID');
        if ($lid != '') {
            $listValues = $this->product_model->get_all_details(CITY, array('stateid'=>$lid));
            if ($listValues->num_rows()>0) {
                foreach ($listValues->result() as $listRow) {
                    $selStr = '';
                    if ($listRow->id == $lvID) {
                        $selStr = 'selected="selected"';
                    }
                    $returnStr['listCountryCnt'] .= '<option '.$selStr.' value="'.$listRow->id.'">'.$listRow->name.'</option>';
                }
            } else {
                $returnStr['listCountryCnt'] .= '<option value="">---Select---</option>';
            }
        }
        $returnStr['listCountryCnt'] .= '</select>';
        
        
        echo json_encode($returnStr);
    }
    
    public function changePosition()
    {
        if ($this->checkLogin('CA') != '') {
            $catID = $this->input->post('catID');
            $pos = $this->input->post('pos');
            $this->product_model->update_details(PRODUCT, array('order'=>$pos), array('id'=>$catID));
        }
    }
    
    
    public function changeImagePosition()
    {
        if ($this->checkLogin('CA') != '') {
            $catID = $this->input->post('catID');
            $pos = $this->input->post('pos');
            $this->product_model->update_details(PRODUCT_PHOTOS, array('imgPriority'=>$pos), array('id'=>$catID));
        }
    }
    
    public function changeImagetitle()
    {
        if ($this->checkLogin('CA') != '') {
            $catID = $this->input->post('catID');
            $title = $this->input->post('title');
            $this->product_model->update_details(PRODUCT_PHOTOS, array('imgtitle'=>$title), array('id'=>$catID));
        }
    }
    
    /**
     *
     * This function loads the contact dashboard
     */
    public function display_rental_dashboard()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->data['heading'] = 'Property Dashboard';
            $this->data['ProductList'] = $this->product_model->get_contactAll_details();
            $this->data['TopRenterList'] = $this->product_model->get_contactAllSeller_details();
    
            
            
            $this->load->view('crmadmin/product/display_rental_dashboard', $this->data);
        }
    }
    
    /**
     *
     * This function loads the Calendar view page
     */
    public function view_calendar()
    {
        if ($this->checkLogin('CA') == '') {
            redirect('deals_crm');
        } else {
            $this->data['heading'] = 'View Calendar';
            $user_id = $this->uri->segment(4, 0);
            $deal_id = $this->uri->segment(5, 0);
            $this->data['ViewList']=array('rental_id'=>$user_id);
            //$this->data['ViewList'] = $this->product_model->view_orders($user_id,$deal_id);
            $this->load->view('crmadmin/product/view_calendar', $this->data);
        }
    }
    
    public function GetDays($sStartDate, $sEndDate)
    {
        // Firstly, format the provided dates.
        // This function works best with YYYY-MM-DD
        // but other date formats will work thanks
        // to strtotime().
        $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));
        $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));
      
        // Start the variable off with the start date
        $aDays[] = $sStartDate;
      
        // Set a 'temp' variable, sCurrentDate, with
        // the start date - before beginning the loop
        $sCurrentDate = $sStartDate;
      
        // While the current date is less than the end date
        while ($sCurrentDate < $sEndDate) {
            // Add a day to the current date
            $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));
      
            // Add this new day to the aDays array
            $aDays[] = $sCurrentDate;
        }
      
        // Once the loop has finished, return the
        // array of days.
        return $aDays;
    }

    public function viewCalendar($id ='')
    {
        $idArr = array('id'=>$id);
        //print_r($idArr); die;
        $data['idArr'] = $idArr;
        $this->load->view('crmadmin/product/viewcalendar', $data);
    }
    
    public function pdf_report()
    {
        $this->load->helper(array('Pdf_create'));   //  Load helper
            $data = file_get_contents(site_url('crmadmin/product/display_product_list')); // Pass the url of html report
            create_pdf($data); //Create pdf
    }
        
    public function dragimageuploadedit()
    {
        $this->data['id'] =  $this->uri->segment(4, 0);
        $this->load->view('crmadmin/product/dragndrop', $this->data);
    }
        
    public function dragupload()
    {
        $this->load->view('crmadmin/product/upload');
    }
        
    public function dragimageuploadinsert()
    {
        $this->load->view('crmadmin/product/dragndrop');
    }
        
    public function popup_drag()
    {
        $id['type'] = $this->uri->segment(4);
        $id['reserved_id'] = $this->uri->segment(5);
        $id['sixuri'] = $this->uri->segment(6);
        $this->load->view('crmadmin/product/dragndrop1', $id);
    }
        
    public function get_sub_type_details()
    {
        $typeId = $this->input->post('typeId');
        //echo $typeId; die;
        $get_sub_types = $this->product_model->get_all_details(PRODUCT_SUBATTRIBUTE, array('attr_id' => $typeId));
            
        echo '<div class="form_grid_12">
                  <label class="field_title" for="property_sub_type">Property Sub Type</label>
                  <div class="form_input">
             <select id="property_sub_type" name="property_sub_type">
                  	<option value="0" selected="selected">Select</option>';
        foreach ($get_sub_types->result() as $typeVals) {
            echo '<option value="'.$typeVals->id.'">'.$typeVals->subattr_name.'</option>';
        }
        echo '</select>
			   </div>
                </div>';
    }
    
    public function edit_sub_type_details()
    {
        $typeId = $this->input->post('typeId');
        $productID = $this->input->post('prodId');
            
        $prodDet = 	$this->product_model->get_all_details(PRODUCT, array('id' => $productID));
        $get_sub_types = $this->product_model->get_all_details(PRODUCT_SUBATTRIBUTE, array('attr_id' => $typeId));
            
        echo '<div class="form_grid_12">
                  <label class="field_title" for="property_sub_type">Property Sub Type</label>
                  <div class="form_input">
             <select id="property_sub_type" name="property_sub_type">
                  	<option value="0" selected="selected">Select</option>';
        foreach ($get_sub_types->result() as $typeVals) {
            echo '<option value="'.$typeVals->id.'"';
            if ($prodDet->row()->property_sub_type == $typeVals->id) {
                echo ' '.'selected="selected"';
            }
            echo '>'.$typeVals->subattr_name.'</option>';
        }
        echo '</select>
			   </div>
                </div>';
    }
    
    public function tessadfasf()
    {
        $imageName = @implode(',', $this->input->post('imgUpload'));
        
        
        $imageNameNew = @explode(',', $imageName);
        
        $s=0;
        foreach ($this->input->post('imgUploadUrl') as $imgUrl) {

                //echo '<br>'.$imgUrl.$imageNameNew[$s];
            copy($imgUrl, './images/product/'.$imageNameNew[$s]);
            unlink('server/php/files/'.$imageNameNew[$s]);
            unlink('server/php/files/thumbnail/'.$imageNameNew[$s]);
            $s++;
        }
        
        //echo $imageName;
        
        //echo '<pre>'; print_r($_POST); die;
        
        

        $id = $this->input->post('id');
        if ($id != '') {
            foreach ($imageNameNew as $name) {
                $this->product_model->simple_insert(PRODUCT_PHOTOS, array('product_image' => $name,'status' => 'Active', 'property_id' => $id)) ;
                $this->db->last_query();
            }
        } else {
            $this->product_model->simple_insert(PRODUCT, array('option' => 'dummy'));
            $id = $this->product_model->get_last_insert_id();
            $this->product_model->simple_insert(PRODUCT_ADDRESS, array('property_id' => $id));
            foreach ($imageNameNew as $name) {
                $this->product_model->simple_insert(PRODUCT_PHOTOS, array('product_image' => $name,'status' => 'Active', 'property_id' => $id)) ;
                $this->db->last_query();
            }
        }
        
        redirect(base_url().'crmadmin/product/edit_product_form/'.$id);
    }
    
    public function popup_upload()
    {
        $imageName = @implode(',', $this->input->post('imgUpload'));
        
        $imageNameNew = @explode(',', $imageName);
        
        //echo '<pre>'; print_r($imageName);
        //echo '<pre>'; print_r($imageNameNew);
        
        $s=0;
        foreach ($this->input->post('imgUploadUrl') as $imgUrl) {
            $imginfo = pathinfo($imgUrl);
            $ext = $imginfo['extension'];
            $str = $imginfo['filename'];
                
            $TempNames = url_title($str, '-', true);
            //echo $TempNames;
            $ImageNameseourl[] = $newImgNames = $TempNames.'.'.$ext;
            //echo '<br>'.$imgUrl.$imageNameNew[$s];
            //echo $newImgNames;die;
            @copy($imgUrl, './images/crm-popup-images/'.$newImgNames);
            unlink('server/php/files/'.$imageNameNew[$s]);
            unlink('server/php/files/thumbnail/'.$imageNameNew[$s]);
                
            $dir = "server/php/files/";//dir absolute path
            foreach (glob($dir."*.*") as $file) {
                unlink($file);
            }
                
            $dir1 = "server/php/files/thumbnail/";//dir absolute path
            foreach (glob($dir1."*.*") as $file1) {
                unlink($file1);
            }
                
            $s++;
        }
        
        //echo $imageName;
        //echo '<pre>'; print_r($ImageNameseourl);

        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $lasturi = $this->input->post('uri6');
        $admin_name = $this->session->userdata('ror_crm_session_admin_name');
        foreach ($ImageNameseourl as $name) {
            $this->product_model->simple_insert('notes_image', array($type => $name, 'reserved_id' => $id, 'admin_name' => $admin_name)) ;
            //$this->db->last_query();
        }
        /*echo '<script>history.go(-1);</script>';*/
        //$dd['value'] = 'ty';
        
        redirect(base_url().'crmadmin/product/display_product_list/'.$lasturi.'/'.$id.'/'.$type);
        
        //redirect(base_url().'crmadmin/product/display_product_list/all');
    }
    
    public function genereal_note()
    {
        $notes = $this->input->post('notes');
        $field = $this->input->post('field');
        $data = array($field => $notes,
                          'reserved_id' => $this->input->post('reserd_id'),
                          'admin_name' => $this->input->post('admin_name')
                          );
        $this->product_model->simple_insert(NOTES, $data);
        echo "success";
    }
    
    public function general_popup_save_options()
    {
        if ($this->input->post('cash_payment')) {
            $cash = 'Cash';
        } else {
            $cash =  '';
        }
            
        if ($this->input->post('check_payment')) {
            $check = 'Check';
        } else {
            $check = '';
        }
            
        if ($this->input->post('credit_payment')) {
            $credit ='Credit Card';
        } else {
            $credit = '';
        }
                
                
        if ($this->input->post('sales_cash')) {
            $sl_cash = 'Cash Purchase';
        } else {
            $sl_cash =  '';
        }
            
        if ($this->input->post('sales_cf')) {
            $sl_casfin = 'Cash And Finance';
        } else {
            $sl_casfin = '';
        }
            
        if ($this->input->post('sales_sdira')) {
            $sl_sdira ='SDIRA';
        } else {
            $sl_sdira = '';
        }
                
        if ($this->input->post('sales_fs')) {
            $sl_finsd ='FINANCE And SDIRA';
        } else {
            $sl_finsd = '';
        }
                
        if ($this->input->post('sales_sl')) {
            $sl_sdllc ='SDIRA LLC';
        } else {
            $sl_sdllc = '';
        }
                            
        $data = array('cash_payment' => $cash,
                          'check_payment' => $check,
                          'credit_payment' => $credit,
                          'sales_cash'	=>	$sl_cash,
                          'sales_cf'	=>	$sl_casfin,
                          'sales_sdira'	=>	$sl_sdira,
                          'sales_fs'	=>	$sl_finsd,
                          'sales_sl'	=>	$sl_sdllc,
                          );
                
        $this->product_model->commonInsertUpdate(RESERVED_INFO, 'update', array('reserd_id','cash_payment','check_payment','credit_payment'), $data, array('id' => $this->input->post('reserd_id')));
        redirect(base_url().'crmadmin/product/display_product_list/all');
    }
        
    public function popup_save_options()
    {
        $rowid = $this->input->post('popup_id');
        if ($this->input->post('invoice_status') == 'complete') {
            $this->sendCompleteMailAdmin($this->input->post('reserved_id'));
        }
                        
        if ($rowid == '') {
            $this->product_model->commonInsertUpdate(STATUS, 'insert', array('popup_id'), array());
        } else {
            $this->product_model->commonInsertUpdate(STATUS, 'update', array('popup_id'), array(), array('id' => $rowid));
        }
                    
        echo "success";
        //redirect(base_url().'crmadmin/product/display_product_list/all');
    }
        
    public function sendCompleteMailAdmin($rsd_id='')
    {
        $condition = array('id'=>$rsd_id);
        $details = $this->product_model->get_all_details(RESERVED_INFO, $condition);
        $newsid='15';
        $template_values=$this->product_model->get_newsletter_template_details($newsid);
        
        $subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
        $adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'], 'prop_address'=> $details->row()->prop_address);
        extract($adminnewstemplateArr);
        //$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
        $header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
        
        $message .= '<!DOCTYPE HTML>
						<html>
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<meta name="viewport" content="width=device-width"/><body>';
        include('./newsletter/registeration'.$newsid.'.php');
            
        $message .= '</body>
						</html>';
        
        if ($template_values['sender_name']=='' && $template_values['sender_email']=='') {
            $sender_email=$this->data['siteContactMail'];
            $sender_name=$this->data['siteTitle'];
        } else {
            $sender_name=$template_values['sender_name'];
            $sender_email=$template_values['sender_email'];
        }

        $email_values = array('mail_type'=>'html',
                                'from_mail_id'=>$sender_email,
                                'mail_name'=>$sender_name,
                                'to_mail_id'=>'info@gainturnkeyproperty.com',
                                'subject_message'=>$template_values['news_subject'],
                                'body_messages'=>$message
                                );
        $email_send_to_common = $this->product_model->common_email_send($email_values);
        //echo "<pre>"; print_r($email_values); die;
    }
        
    public function product_list_search()
    {
        $admindata = array('displaySearchedResult' => '','fieldType' => '','fieldVal' => '');
        $this->session->unset_userdata($admindata);
            
        if ($this->input->post('searchByField') == 'Search') {
            if ($this->input->post('fieldVal') !='Search Text') {
                $admindata1 = array('fieldType' => $this->input->post('fieldType'),'fieldVal' => $this->input->post('fieldVal'));
                $this->session->set_userdata($admindata1);
            } else {
                $this->setErrorMessage('success', 'Please type the search keyword');
            }
            redirect($this->input->post('sCurrentURL'))	;
        }
    }
        
    public function cancelProperty()
    {
        $id = $this->input->post('id');
        $reservedDetails = $this->product_model->get_all_details(RESERVED_INFO, array('id' => $id));
        $this->product_model->simple_insert(CANCELLED, $reservedDetails->row_array());
        $this->product_model->commonDelete(RESERVED_INFO, array('id'=>$id));
        $this->product_model->update_details(PRODUCT, array('property_status' => 'Active'), array('id' => $reservedDetails->row()->property_id));
    }
        
    public function downloadPDF()
    {
        $rsdId = $this->uri->segment(4);
        $popupText = $this->product_model->get_all_details(STATUS, array('reserved_id' => $rsdId));
        $invoiceId = $this->product_model->get_all_details(WANTS_DETAILS, array('id' => '1'));
        $count = $invoiceId->row()->user_id;
        $count = $count+1;
        $this->product_model->update_details(WANTS_DETAILS, array('user_id' => $count), array('id' => '1'));
        $propId = $this->product_model->get_all_details(RESERVED_INFO, array('id' => $rsdId));
        $id = $propId->row()->property_id;
        $address = $this->product_model->get_all_details(PRODUCT_ADDRESS, array('property_id' => $id));
        $sourceInfo = $this->product_model->get_all_details(SOURCE_INFO, array('property_id' => $id));
        $data = $sourceInfo->row()->datavalues;
        $values = unserialize(stripslashes($data));
        //echo $values['b1_firstname']; die;
                            
        $this->data['ViewList']='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gain Turnkey Property</title>
</head>
<body style="background:#FFFFFF; width:100%; margin:0; padding:0;">
<div style="width:50%; margin:0px; padding:0px;">


	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px; margin-top:-45px; border-top:1px solid #3b5e91;">
		
		<tr style="background:#ccd8ea; height:65px; width:100%;">
    		<td style=" width:80%;"><h1 style=" font-size:13px; margin:0px 0px 0px 100px; text-align:center; text-transform:uppercase; letter-spacing:3px;">***Historical***</h1></td>
			<td style=" width:20%;"><h2 style=" font-size:22px; margin:0px 20px; text-align:right; color:#3b5e91;">Invoice</h2></td>
        </tr>
    </table>	
	
		
 
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;  margin-top: 20px;" >
		 <tr>
			<td width="80%">&nbsp;</td>
			<td width="20%">
				<table border="0" width="250" align="right" cellpadding="0" cellspacing="0" style="max-width: 300px;" >
					  <tr style="margin-bottom:5px;">
						<td style="text-align:right;" >Page &nbsp;</td>
						<td style="margin-left: 5px;">1/1</td>
					  </tr>
					  <tr style="margin-bottom:5px;">
						<td style="text-align:right;">Invoice &nbsp;</td>
						<td style="margin-left: 5px;">RR'.$count.'</td>
					  </tr>
					  <tr style="margin-bottom:5px;">
						<td style="text-align:right;">Date &nbsp;</td>
						<td style="margin-left: 5px;">'.date('m-d-Y').'</td>
					  </tr>
					  <tr height="30px">
						<td>&nbsp;</td>
					  </tr>
					  
				  </table>
			</td>
		  </tr>
	 </table>



 
 	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;  margin-top: 30px;" >
		 <tr>
			
			<td width="80%">
				<table border="0" width="130" align="left" cellpadding="0" cellspacing="0" style="max-width: 200px;" >
					  <tr style="margin-bottom:5px;">
						<td style="text-align:center;" >Gain Turnkey Property, LLC</td>
					  </tr>
					  <tr style="margin-bottom:5px;">
						<td style="text-align:center;">3566 E. Amber Lane</td>
					  </tr>
					  <tr style="margin-bottom:5px;">
						<td style="text-align:center;">Gilbert, Arizona 85296</td>
					  </tr>
				  </table>
			</td>
			<td width="20%">&nbsp;</td>
		  </tr>
	 </table>
 
 
 
 	
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;  margin-top: 30px;">
      <tr>
        <td width="50%">
        	<table width="100%" border="0">
                  <tr>
                    <td><strong>Bill To :</strong></td>
                    <td>
                        <ul style="list-style-type:none; margin-top:50px; padding: 0px; font-size: 13px;">
                            <li>'.ucwords($values['s_companyname']).'</li>
                            <li>'.$values['s_address'].'</li>
                            <li>'.$values['s_state'].' '.$values['s_zipcode'].'</li>
                        </ul>
                    </td>
                  </tr>
            </table>
        </td>
        <td width="50%">
        	<table width="100%" border="0">
                  <tr>
                    <td><strong>Ship To:</strong></td>
                    <td>
						<ul style="list-style-type:none; margin-top:50px; padding: 0px; font-size: 13px;">
                            <li>'.ucwords($values['s_companyname']).'</li>
                            <li>'.$values['s_address'].'</li>
                            <li>'.$values['s_state'].' '.$values['s_zipcode'].'</li>
                        </ul>
					</td>
                  </tr>
            </table>
        </td>
      </tr>
    </table>
 
 
 
 	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;  margin-top: 30px;">
	  <tr>
		<td><strong>MEMO:</strong> <span>'.ucwords($propId->row()->first_name).' '.ucwords($propId->row()->last_name).', <span style="font-size:13px;"> '.$address->row()->address.', '.ucwords($address->row()->city).', '.ucwords(str_replace("-", " ", $address->row()->state)).'</span></span></td>
	  </tr>
	</table>



	<table  border="1" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;  margin-top:10px; font-size:12px; border-color:#3b5e91;">
	  <tr style="background:#c6d4e8;">
		<th scope="col" >Purchase Order No.</th>
		<th scope="col" >Customer ID</th>
		<th scope="col" >Salesperson ID</th>
		<th scope="col" >Shipping Method</th>
		<th scope="col" >Payment Terms</th>
		<th scope="col" >Req Ship Date</th>
		<th scope="col" >Master No.</th>
	  </tr>
	  <tr >
		<td style="font-size:12px; text-align:center; height:15px; ">&nbsp;</td>
		<td style="font-size:12px; text-align:center;"><span style="font-size:10px;">'.ucwords($values['s_companyname']).'</span></td>
		<td style="font-size:12px; text-align:center;">&nbsp;</td>
		<td style="font-size:12px; text-align:center;">&nbsp;</td>
		<td style="font-size:12px; text-align:center;">&nbsp;</td>
		<td style="font-size:12px; text-align:center;"><span>'.date('m-d-Y').'</span></td>
		<td style="font-size:12px; text-align:center;">&nbsp;</td>
	  </tr>
    </table>



	<table  border="1" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px; font-size:12px; border-color:#3b5e91;">
	  <tr style="background:#c6d4e8;" >
		<th scope="col" >Ordered</th>
		<th scope="col" >Shipped</th>
		<th scope="col" >B/O</th>
		<th scope="col" >Item Number</th>
		<th scope="col" >Description</th>
		<th scope="col" >Discount</th>
		<th scope="col" >Unit Price</th>
		<th scope="col" >Ext. Price</th>
	  </tr>
	  <tr >
		<td style="font-size:12px; text-align:right; height:15px;padding-right:5px; ">1</td>
		<td style="font-size:12px; text-align:right;padding-right:5px;">1</td>
		<td style="font-size:12px; text-align:right; padding-right:5px;">0</td>
		<td style="font-size:12px; text-align:center;">MKTINGFEE</td>
		<td style="font-size:12px; text-align:center;">MARKETING FEE</td>
		<td style="font-size:12px; text-align:right; padding-right:5px;">$0.00000</td>
		<td style="font-size:12px; text-align:center;">&nbsp;</td>
		<td style="font-size:12px; text-align:center;"> $ <span>'.number_format($popupText->row()->ror_iv_fee, 2).'</span></td>
	  </tr>
    </table>

 
 
	
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;  margin-top: 20px;" >
			 <tr>
				<td width="70%">&nbsp;</td>
				<td width="30%">
					<table border="0" width="250" align="right" cellpadding="0" cellspacing="0" style="max-width: 300px;" >
						  <tr style="margin-bottom:5px;">
							<td style="text-align:right;" >Subtotal&nbsp;</td>
							<td style="margin-left: 5px; text-align:right;"> $ <span>'.number_format($popupText->row()->ror_iv_fee, 2).'</span></td>
						  </tr>
						  <tr style="margin-bottom:5px;">
							<td style="text-align:right;">Misc &nbsp;</td>
							<td style="margin-left: 5px; text-align:right; ">$ 0.00</td>
						  </tr>
						  <tr style="margin-bottom:5px;">
							<td style="text-align:right;">Tax &nbsp;</td>
							<td style="margin-left: 5px; text-align:right;">$ 0.00</td>
						  </tr>
						   <tr style="margin-bottom:5px;">
							<td style="text-align:right;">Freight &nbsp;</td>
							<td style="margin-left: 5px; text-align:right;">$ 0.00</td>
						  </tr>
						   <tr style="margin-bottom:5px;">
							<td style="text-align:right;">Trade Discount &nbsp;</td>
							<td style="margin-left: 5px; text-align:right;">$ 0.00</td>
						  </tr>
						   <tr style="margin-bottom:5px;">
							<td style="text-align:right; ">Total &nbsp;</td>
							<td style="margin-left: 5px; text-align:right;"> $ <span>'.number_format($popupText->row()->ror_iv_fee, 2).'</span></td>
						  </tr>
						  <tr height="30px">
							<td>&nbsp;</td>
						  </tr>
					  </table>
					  
				</td>
			  </tr>
	 </table> 
	 
	 <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;  margin-top: 50px; clear:both;">
		   <tr>
			<td>&nbsp;</td>
		  </tr>
	 </table>

 
 	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;  margin-top: 20px; clear:both;">
	  
	   <tr>
			<td>&nbsp;</td>
	  </tr>
	  <tr>
			<td><strong>WIRING INSTRUCTIONS:</strong></td>
	  </tr>
	</table>

 
		<table border="0" width="330" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px; margin-left:170px;  margin-top: 20px; clear:both; ">
		  <tr>
			<td>Company Name:</td>
			<td>Gain Turnkey Property, LLC</td>
		  </tr>
		  <tr>
			<td>Account:</td>
			<td>8175953226</td>
		  </tr>
		  <tr>
			<td>Wire Routing:</td>
			<td>121000248</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr style="margin-top:30px!important;">
			<td valign="top">Company Address:</td>
			<td valign="middle" style="margin-top:30px;">3566 E. Amber Lane Gilbert, AZ 85296</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr style="margin-top:30px;">
			<td valign="top">Bank Address:</td>
			<td valign="middle" style="margin-top:30px;">Wellsfargo Bank N.A.  420 Montgomery Street San Francisco, CA 94104</td>
		  </tr>
	</table>

 
 
 
 
 
   </div>
   
 
</body>
</html>';
            
        $this->data['propertyAddres'] = 'invoice_RR'.$count;
            
        
            
            
        $this->load->view('crmadmin/product/view_orders', $this->data);
    }
        
    public function saveMarketingFee()
    {
        $this->product_model->update_details(STATUS, array('ror_iv_fee' => $this->input->post('fee')), array('id' => $this->input->post('id')));
    }
}
/* End of file product.php */
/* Location: ./application/controllers/crmadmin/product.php */
