<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Order management 
 * @author Teamtweaks
 *
 */ 

class Order extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('order_model');
		if ($this->checkPrivileges('order',$this->privStatus) == FALSE){
			redirect('deals_crm');
		}
    }
    
    /**
     * 
     * This function loads the order list page
     */
   	public function index(){	
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			redirect('crmadmin/order/display_order_list');
		}
	}
	
	/**
	 * 
	 * This function loads the order list page
	 */
	public function display_order_paid(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Order List';
			$this->data['orderList'] = $this->order_model->view_order_details('Paid');
			$this->load->view('crmadmin/order/display_orders',$this->data);
		}
	}
	
	public function display_order_pending(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Order List';
			$this->data['orderList'] = $this->order_model->view_order_details('Pending');
			$this->load->view('crmadmin/order/display_orders_pending',$this->data);
		}
	}
	
	public function subviewDetails(){
	
		echo $this->input->post('dealId');
	
	}
	
	
	/**
	 * 
	 * This function loads the order view page
	 */
	public function view_order(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'View Order';
			$user_id = $this->uri->segment(4,0);
			$deal_id = $this->uri->segment(5,0);
			//$this->data['ViewList'] = $this->order_model->view_orders($user_id,$deal_id);
			$condition	=	array('id' => $this->uri->segment(4,0));
			$this->data['productList'] = $this->product_model->get_all_details(RESERVED_INFO,$condition);
			
					//print_r($this->data['productList']->result());die;
					$PropertyList=$this->data['productList'];
					$this->data['ViewList']='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Return On Rentals</title>
</head>
<body style="background:#FFFFFF; width:100%; margin:0; padding:0;">
<div style="width:50%; margin:0px; padding:0px;">
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;">
		<tr style="background:#3e3d3f; height:50px; width:100%;">
    		<td></td>
        </tr>
        <tr style="background:#c4c4c4; height:85px; width:100%;">
        	<td width="20%;"><img src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" /></td>
			<td width="20%;" align="right">
			<span style="float:right; margin:10px 10px 0 0px; font-family:Arial, Helvetica, sans-serif; text-aling:left;  font-size:15px; font-weight:bold">'.$PropertyList->row()->prop_address.'</span></td>
        </tr>
    </table>		
    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">
    	<tr>
        	<td  height="30" align="center" style="float:left; text-align:center; color:#008904; width:100%; margin:35px 0 10px 0; font-family:Arial, Helvetica, sans-serif;  font-size:18px; font-weight:bold">Property Reservation Confirmation</td>
        </tr>
        <tr>
        	<td  height="50"style=" text-align:center; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; overflow:hidden;">Congratulations! You have placed the following property Sold. Our staff is working diligently on your closing documents and trnasfer packet. Please bring this Hotsheet with you to your closing at th event.</td>
        </tr>
    </table>
    <table border="0" width="500" align="center" cellpadding="0" cellspacing="0" >
    	<tr style="margin:20px 0 20px; ">
        	<td  width="250">
            	<img src="'.base_url().'images/product/'.$PropertyList->row()->image.'" style="width:300px!important; height:225px;  border-radius:6px !important;" />
            </td>
            <td>
            	<table cellpadding="0" cellspacing="0"  width="240" align="left">
                	<tr>
                    	<td style=" font-size:14px; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif; " height="25px" valign="top"><b>Property ID: '.$PropertyList->row()->rental_id.'</b></td>
                    </tr>
                   <tr>
                    	<td style=" font-size:14px;  margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;" height="25px" valign="top"><b>'.$PropertyList->row()->prop_address.'</b></td>
                    </tr>
                  <!--  <tr>
                    	<td style=" font-size:14px;  margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;" height="25px" valign="top"><b>Buffalo, NY, 14211</b></td>
                    </tr>-->
                    <tr>
                    	<td style=" font-size:14px; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;" height="25px" valign="top"><b>Beds : '.$PropertyList->row()->bedrooms.'</b></td>
						<td align="right" width="30%" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left;" height="25px" valign="top">
						<b style="margin:0 0 0 0px" height="30px">Baths : '.$PropertyList->row()->baths.'</b></td>
                    </tr>
                     <tr>
                    	<td style=" font-size:14px; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;" height="25px" valign="top">
						<b>Sq.Ft : '.$PropertyList->row()->sq_feet.'</b></td>
						<td align="right" width="30%" height="25px"  style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left;" height="20px" valign="top" >
						<b style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px;" >Lot Size : '.$PropertyList->row()->lot_size.'</b>
						
						</td>
                    </tr>
                   <tr>
                    	<td height="25px" valign="top" style=" font-size:14px; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;" height="20px"><b style="margin:0 0 0 0px">Monthly Rental Amount : $ '.number_format($PropertyList->row()->monthly_rent,0).'</b></td>

						
                    </tr>
					<tr>
					<td height="25px" valign="top" style=" font-size:14px; width=100% !important; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;" "><b style="margin:0 0 0 0px">Estimated Annual Tax: $ '.number_format($PropertyList->row()->property_tax,0).'</b></td>
					</tr>
                </table>
            </td>
        </tr>
    </table>


    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">
    	<tr style="margin:0px 0 8px; float:left;">
            <td width="250px;" style=" float:left; ">
			<h2 style="color:#008904;  font-size:18px; font-family:Arial, Helvetica, sans-serif; margin:15px 0 15px 0px;">Reservation Information</h2>
            	<span style="width:70%; display:inline-block; margin:0 0 15px; font-weight:bold; font-size:14px; font-family:Arial, Helvetica, sans-serif">Purchaser Name: '.ucfirst($PropertyList->row()->first_name).' '.ucfirst($PropertyList->row()->last_name).' </span>
				<div style="clear:both;"></div>
                <span style="width:70%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Name:'.$PropertyList->row()->entity_name.'</span>
				<div style="clear:both;"></div>
                <span style="width:70%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Address: '.$PropertyList->row()->address.'</span>
				<div style="clear:both;"></div>
                <span style="width:70%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">City: '.$PropertyList->row()->city.','.$PropertyList->row()->state.', '.$PropertyList->row()->postal_code.'</span>
				<div style="clear:both;"></div>
                <span style="width:70%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone: '.$PropertyList->row()->phone_no.'</span>
				<div style="clear:both;"></div>
                <span style="width:70%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email1: '.$PropertyList->row()->email.'</span>
				<div style="clear:both;"></div>
                <span style="width:70%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sales Price: $ '.number_format($PropertyList->row()->sales_price,0).'</span>
				<div style="clear:both;"></div>
                <span style="width:70%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->cash_payment.''.$PropertyList->row()->check_payment.''.$PropertyList->row()->credit_payment.''.$PropertyList->row()->dot_payment.'</span>
					<div style="clear:both;"></div>
                <span style="width:70%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Note:'.$PropertyList->row()->note.'</span>
            </td>
            <td width="250px;" style=" float:left;">
            	<span style="width:50%; display:inline-block; margin:0 0 15px; font-weight:bold; font-size:14px; font-family:Arial, Helvetica, sans-serif"></span>
				<div style="clear:both;"></div>
                <span style="width:50%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Type:'.$PropertyList->row()->resrv_type.'</span>
				<div style="clear:both;"></div>
                <span style="width:50%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif"></span>
				<div style="clear:both;"></div>
				<br />

                <span style="width:40%; float:left; font-weight:bold; margin:0px 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">State: '.$PropertyList->row()->state.'</span>
				 <span style="width:40%; float:left; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">
Zip: '.$PropertyList->row()->postal_code.'</span>
				<div style="clear:both;"></div>
				<span style="width:50%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif"></span>
				<div style="clear:both;"></div>
                <span style="width:50%; display:inline-block; font-weight:bold; margin:0px 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone 2: '.$PropertyList->row()->phone_no1.'</span>
				<div style="clear:both;"></div>
                <span style="width:50%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email2: '.$PropertyList->row()->email1.'</span>
				<div style="clear:both;"></div>
                <span style="width:50%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $ '.number_format($PropertyList->row()->reserv_price,0).'</span>
				<div style="clear:both;"></div>
                <span style="width:50%; display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->sales_cash.''.$PropertyList->row()->sales_cf.''.$PropertyList->row()->sales_cs.''.$PropertyList->row()->sales_fs.''.$PropertyList->row()->sales_sdira.'</span>
            </td>
        </tr>
    </table>   
     <table border="0" width="550" cellpadding="0" cellspacing="0" style="max-width:550px;">
    	<tr>
        	<td style=" font-size:14px;  line-height:22px; text-align:center; font-family:Arial, Helvetica, sans-serif" width="550" height="40" >
            	This Property reservation Confirmation is your receipt of your commitment to purchase the above referenced property. Due to the nature of the investors summit, and the overwhelming intrest the students have in purchasing the properties brought to the event by our preferred vendors, your possession of this document is evidence that the property has been removed from our active database and is no longer available for sale to other students. Our staff will contact you during the final two days of the event to arrange the production and execution of the final document for closing. Please keep this information for reference prior to closing.
            </td>
        </tr>
        <tr style="background:#3d3c3e; height:27px; margin:10px; width:100%;"  height="20px">
        	<td width="550" style="text-align:center;  color:#FFF;  font-size:11px; margin:6px 0 0px;">'.$this->config->item('footer_content').'</td>
        </tr>
    </table> 
   </div>
</body>
</html>
';
			
	$this->data['propertyAddres'] = url_title($PropertyList->row()->prop_address, '-', TRUE);		
			
			
			
			
			
			
			
			
			
			$this->load->view('crmadmin/order/view_orders',$this->data);
		}
	}
	
	/**
	 * 
	 * This function delete the order record from db
	 */
	public function delete_order(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$order_id = $this->uri->segment(4,0);
			$condition = array('id' => $order_id);
			$old_order_details = $this->order_model->get_all_details(PRODUCT,array('id'=>$order_id));
			$this->update_old_list_values($order_id,array(),$old_order_details);
			$this->update_user_order_count($old_order_details);
			$this->order_model->commonDelete(PRODUCT,$condition);
			$this->setErrorMessage('success','Order deleted successfully');
			redirect('crmadmin/order/display_order_list');
		}
	}
	
	public function order_review(){
		if ($this->checkLogin('CA')==''){
			show_404();
		}else {
			$dealCode = $this->uri->segment(2,0);
			//$order_details = $this->order_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid'));
			
				$this->db->select('p.*,pAr.attr_name');
				$this->db->from(PAYMENT.' as p');
				$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = p.attribute_values','left');
				$this->db->where('p.status = "Paid" and p.dealCodeNumber = "'.$dealCode.'"');
				$order_details = $this->db->get();
			
			
			if ($order_details->num_rows()==0){
				show_404();
			}else {
				foreach ($order_details->result() as $order_details_row){
					$this->data['prod_details'][$order_details_row->product_id] = $this->order_model->get_all_details(PRODUCT,array('id'=>$order_details_row->product_id));
				}
				$this->data['order_details'] = $order_details;
				$this->data['heading'] = 'View Order Comments';
				$sortArr1 = array('field'=>'date','type'=>'desc');
				$sortArr = array($sortArr1);
				$this->data['order_comments'] = $this->order_model->get_all_details(REVIEW_COMMENTS,array('deal_code'=>$dealCode),$sortArr);
				$this->load->view('crmadmin/order/display_order_reviews',$this->data);
			}
		}
	}
	

	public function post_order_comment(){
		if ($this->checkLogin('CA') != ''){
			$this->order_model->commonInsertUpdate(REVIEW_COMMENTS,'insert',array(),array(),'');
		}
	}
	
}

/* End of file order.php */
/* Location: ./application/controllers/crmadmin/order.php */