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
			redirect('admin_ror');
		}
    }
    
    /**
     * 
     * This function loads the order list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			redirect('admin/order/display_order_list');
		}
	}
	
	/**
	 * 
	 * This function loads the order list page
	 */
	public function display_order_paid(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Order List';
			$this->data['orderList'] = $this->order_model->view_order_details('Paid');
			$this->load->view('admin/order/display_orders',$this->data);
		}
	}
	
	public function display_order_pending(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Order List';
			$this->data['orderList'] = $this->order_model->view_order_details('Pending');
			$this->load->view('admin/order/display_orders_pending',$this->data);
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
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'View Order';
			$user_id = $this->uri->segment(4,0);
			$deal_id = $this->uri->segment(5,0);
			//$this->data['ViewList'] = $this->order_model->view_orders($user_id,$deal_id);
			$condition	=	array('id' => $this->uri->segment(4,0));
			$this->data['productList'] = $this->order_model->get_all_details(RESERVED_INFO,$condition);
			$propAddress = $this->order_model->get_all_details(PRODUCT_ADDRESS,array('property_id'=> $this->data['productList']->row()->property_id));
			
					//print_r($this->data['productList']->result());die;
					$PropertyList=$this->data['productList'];
					$this->data['ViewList']='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gain Turnkey Property</title>
</head>
<body style="background:#FFFFFF; width:100%; margin:0; padding:0;">
<div style="width:50%; margin:0px; padding:0px;">
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left;" src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100%!important; vertical-align:top; text-align:right;">'.$propAddress->row()->address.', '.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-',' ',$propAddress->row()->state)).' '.$propAddress->row()->post_code.'</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px; margin:0 0 0 0;">
    	<tr>
        	<td  height="30" align="center" style="float:left; text-align:center; color:#008904; width:100%;  font-family:Arial, Helvetica, sans-serif;  font-size:23px; font-weight:bold">Property Reservation Confirmation</td>
        </tr>
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">Congratulations! You have successfully placed this property under reserve for purchase. Our staff is working diligently on your closing documents and transfer packet. Please bring this hotsheet with you to your closing at the event.</td>
        </tr>
    </table>
    <table border="0" width="500" align="center" cellpadding="0" cellspacing="0" >
    
    	<tr style="margin:20px 0 20px;">
        
        	<td  width="200">
            	<img src="'.base_url().'images/product/'.$PropertyList->row()->image.'" style="width:250px !important; height:190px;  border-radius:6px !important;" />
            </td>
            
            <td width="300">
            
            	<table cellpadding="0" cellspacing="0"  width="100%" align="left">
                
                	<tr style="margin:5px 0 15px 0px; line-height:26px;" >
                    	<td colspan="2" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property ID: '.$PropertyList->row()->rental_id.'</b></td>
                    </tr>
                    
                    
                   <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td colspan="2" style=" font-size:14px;  margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property Address: '.$propAddress->row()->address.'<br>'.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-',' ',$propAddress->row()->state)).' '.$propAddress->row()->post_code.'</b></td>
                    </tr>
                    
                    
                    <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td width="60%" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Beds : '.$PropertyList->row()->bedrooms.'</b></td>
						<td width="35%" align="right" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left;" valign="top">
						<b style="margin:0 0 0 0px" height="30px">Baths : '.$PropertyList->row()->baths.'</b></td>
                    </tr>
                    
                    
                     <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top">
						<b>Sq.Ft : '.$PropertyList->row()->sq_feet.'</b></td>
                        
						<td align="right" valign="top" width="30%" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:left;"  >
                        
						<b style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px;" >Lot Size : '.$PropertyList->row()->lot_size.'</b> </td>
                        
                    </tr>
                    
                    
                    <tr style="margin:5px 0 15px 0px; line-height:28px;">
                    
                    	<td colspan="2" valign="top" style=" font-size:14px; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"> <b>Monthly Rental Amount : $'.number_format($PropertyList->row()->monthly_rent,0).'</b></br> </td>
                        <br />

						
                    </tr>
                    
                    
					<tr style="margin:5px 0 15px 0px; line-height:28px;">
                    
					<td colspan="2" valign="top" style=" font-size:14px; width=100% !important; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"> <b>Estimated Annual Tax: $'.number_format($PropertyList->row()->property_tax,0).' </b> </td>
					</tr>
                    
                </table>
                
            </td>
            
        </tr>
    </table>


    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">
    
    	<tr>
        
        	<td colspan="3"><h2 style="color:#008904;  font-size:23px; font-family:Arial, Helvetica, sans-serif; margin:15px 0 15px 0px;">Reservation Information</h2></td>
            
        </tr>
        
    	<tr>
        
            <td colspan="3"><span style="width:40%; display:inline-block; margin:0 0 15px; font-weight:bold; font-size:14px; font-family:Arial, Helvetica, sans-serif">Purchaser Name: '.ucfirst($PropertyList->row()->first_name).' '.ucfirst($PropertyList->row()->last_name).' </span></td>
            
           
           </tr>
           
           <tr>
           
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Name: '.$PropertyList->row()->entity_name.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Type: '.$PropertyList->row()->resrv_type.'</span></td>
           
           </tr>
           
           <tr>
           
           	<td colspan="3"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Address: '.$PropertyList->row()->address.'</span></td>
            
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">City: '.$PropertyList->row()->city.'</span></td>
            
            <td><span style=" display:inline-block; float:left; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">State: '.str_replace('-',' ',$PropertyList->row()->state).'</span></td>
            
            <td><span style=" display:inline-block; float:left; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Zip: '.$PropertyList->row()->postal_code.'</span></td>
            
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone: '.$PropertyList->row()->phone_no.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0px 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone 2: '.$PropertyList->row()->phone_no1.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email1: '.$PropertyList->row()->email.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email2: '.$PropertyList->row()->email1.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sales Price: $'.number_format($PropertyList->row()->sales_price,0).'</span></td>
            
            
           
           ';
		   if($PropertyList->row()->adjustment !='')
		   	{
				 $this->data['ViewList'] .= '
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Adjustment: $'.number_format($PropertyList->row()->adjustment,0).'</span></td>
            
          
           
          ';
			}
			else
			{
				$this->data['ViewList'] .= '<td colspan="2">&nbsp;</td>';
		     }
			 $this->data['ViewList'] .= ' </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $'.number_format($PropertyList->row()->reserv_price,0).'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->sales_cash.' '.$PropertyList->row()->sales_cf.' '.$PropertyList->row()->sales_cs.' '.$PropertyList->row()->sales_fs.' '.$PropertyList->row()->sales_sdira.' '.$PropertyList->row()->sales_sl.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Custodian name: '.$PropertyList->row()->cust_name.'</span></td>
           
           </tr>
           
           
            <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Note: '.$PropertyList->row()->note.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Account number: '.$PropertyList->row()->account_no.'</span></td>
           
           </tr>
            
    </table>   
    
    <table border="0" width="550" cellpadding="0" cellspacing="0" style="max-width:550px;">
    	<tr>
        	<td colspan="3" style=" font-size:14px;  line-height:19px; margin-bottom:5px; text-align:left; font-family:Arial, Helvetica, sans-serif" width="550" >
            	This Property reservation Confirmation is your receipt of your commitment to purchase the above referenced property. Due to the nature of the investors summit, and the overwhelming intrest the students have in purchasing the properties brought to the event by our preferred vendors, your possession of this document is evidence that the property has been removed from our active database and is no longer available for sale to other students. Our staff will contact you during the final two days of the event to arrange the production and execution of the final document for closing. Please keep this information for reference prior to closing.
            </td>
        </tr>
        
        
        <tr style="background:#bebebe; height:27px; margin:35px 10px 10px 10px; width:100%;" >
        	<td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 10px;">'.$this->config->item('footer_content').'</td>
            <td width="25%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 50px;">All Rights Reserved</td>
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 10px 3px 3px;">Unauthorized Use or Duplication is Prohibited</td>
        </tr>
    </table> 
    
   </div>
   
   
<div style="width:50%; margin:0px; padding:0px;">
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left;" src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100% !important; vertical-align:top; text-align:right;">INTENT to PURCHASE AGREEMENT</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px; margin:15px 0 10px 0;">
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">This letter sets forth some of the basic terms under which Seller and Purchaser would be interested in entering into a Real Estate Purchase Agreement.  It serves as a letter of intent (“Letter”) from '.$PropertyList->row()->entity_name.' ("Purchaser") through and dated '.date('m-d-Y', strtotime($PropertyList->row()->dateAdded)).', in which Purchaser has set forth its interest in acquiring the subject Property.  Nevertheless, please be advised that this letter is not contractually binding on the parties and is only an expression of the basic terms and conditions to be incorporated in a formal written agreement. </td>
        </tr>
    </table>
    
    <table border="0" width="500" align="center" cellpadding="0" cellspacing="0" >
    
    	<tr style="margin:20px 0 20px;">
        
        	<td cellpadding="0" cellspacing="0" width="250" align="left">
            
            	<table>
                
                	<tr>
                    
                    	<td valign="top"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PROPERTY: </span></td>
                        
                        <td valign="middle">'.$propAddress->row()->address.'<br>'.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-',' ',$propAddress->row()->state)).' '.$propAddress->row()->post_code.'</td>
                    
                    </tr>
                   
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td><small style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#333;">(herinafter, the “Property”)</small></td>
                    
                    </tr>
                     <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td><small style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#333;">&nbsp;</small></td>
                    
                    </tr>
                     
                	
                
                </table>
            
            </td>
            
            <td cellpadding="0" cellspacing="0" width="250" align="left">
            
            	<table>
                
                	<tr>
                    
                    	<td><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PURCHASER: </span></td>
                        
                        <td>'.ucwords($PropertyList->row()->entity_name).'</td>
                    
                    </tr>
                    
                	<tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.ucwords($PropertyList->row()->first_name).' '.ucwords($PropertyList->row()->last_name).'</td>
                    
                    </tr>
                    
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.$PropertyList->row()->address.'</td>
                    
                    </tr>
                    
                    
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.$PropertyList->row()->city.', '.str_replace('-',' ',$PropertyList->row()->state).' '.$PropertyList->row()->postal_code.'</td>
                    
                    </tr>
                
                
                </table>
            
            </td>
            
        </tr>
    </table>


    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">
    
    	<tr>
        
        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PAYMENT METHOD: </strong>'.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</td>
            
        </tr>
        

        
        
         <tr>
        
        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASE PRICE: </strong>$'.number_format($PropertyList->row()->sales_price,0).'</td>
            
        </tr>';
		   if($PropertyList->row()->adjustment !='')
		   	{
				 $this->data['ViewList'] .= '<tr>
           
           <td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">ADJUSTMENT: </strong>$'.number_format($PropertyList->row()->adjustment,0).'</td>
           
           </tr>';
			}
		   $this->data['ViewList'] .= '
        
        <tr>
        
        	<td style="line-height:35px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">RESERVATION FEE DEPOSIT: </strong>'.number_format($PropertyList->row()->reserv_price,0).' dollars ($)</td>
            
        </tr>
        
        
        <tr>
        
        	<td><p style="font-weight:normal; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">(”Reservation Fee”) shall be placed in escrow with the Real Estate Brokerage upon the execution of the Purchase Agreement (defined below), the Reservation Fee shall then become non-refundable.</p></td>
            
        </tr>
      
        <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CONTRACT:</strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Upon the mutual execution of this Letter, Seller will promptly prepare a Purchase and Sale Agreement and Seller shall make a good faith effort to deliver said Purchase and Sale Agreement to Purchaser within seven (7) days from the effective date of the LOI. </span></td>
            
        </tr>
        
          <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CLOSING: </strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Closing shall occur on a date mutually acceptable to purchaser and to be outlined in the Purchase Agreement. </span></td>
            
          </tr>
          
          
          <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CONFIDENTIALITY:</strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Seller, Purchaser, and their agents shall maintain the confidentiality of the parties, terms, and conditions of this letter and the negotiations that may follow, if any, from this date forth.  The above items are the general business terms and conditions to be covered in the Purchase and Sale Agreement, which would be submitted to the Seller.  Additional remaining terms of the Purchase and Sale Agreement will be negotiated and must be acceptable to both Purchaser and Seller.</span></td>
            
          </tr>
          
           <tr>
        
        	<td style="text-align:center;"><span style="font-size:10px; width:100%; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; line-height:20px;">This letter is not intended to be a binding contract.</span></td>
            
           </tr>
           
           
           
           <tr>
        
        	<td><span style="font-size:11px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal; line-height:20px;">Buyer hereby agrees to the terms and conditions of the letter.</span></td>
            
           </tr>
           
           
           <tr>
        
        		<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td width="45%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name: </strong>'.$PropertyList->row()->first_name.' '.$PropertyList->row()->last_name.'</td>
                            
                            
                            <td width="45%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name: </strong></td>
                        
                        </tr>
                        
                       <tr>
                        
                        	<td valign="bottom" style="vertical-align:bottom; line-height:20px; "><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                        
                       <tr>
                        
                        	<td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                    
                    
                    </table>
                
                
                </td>
            
           </tr>
           
            
            <tr>
        
        		<td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
            
        	</tr>
            
            
            
             <tr>
        
        		<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td width="25%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Address: </strong>'.$PropertyList->row()->address.'</td>
                            
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">City: </strong>'.$PropertyList->row()->city.'</td>
                            
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">State: </strong>'.str_replace('-',' ',$PropertyList->row()->state).'</td>
                            
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Zip Code: </strong>'.$PropertyList->row()->postal_code.'</td>
                        
                        
                        </tr>
                        
                        
                        <tr>
                        
                        	<td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Phone Number: </strong>'.$PropertyList->row()->phone_no.'</td>
                            
                            <td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Phone Number: </strong>'.$PropertyList->row()->phone_no1.'</td>
                        
                        </tr>
                        
                        <tr>
                        
                        	<td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Email: </strong>'.$PropertyList->row()->email.'</td>
                            
                            <td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Email: </strong>'.$PropertyList->row()->email1.'</td>
                        
                        </tr>
                    </table>
                
                </td>
        
        	</tr>

            
            <tr>
        
        		<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
                            
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Cash</strong></td>
                            
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Check</strong></td>
                            
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Credit Card</strong></td>
                        
                        
                        </tr>
                    
                    
                    </table>
                
                
                </td>
            
        	</tr>
            
        
        	   <tr>
        
        		<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">CREDIT CARD AUTHORIZATION</strong></td>
            
        	</tr>
            
            
             <tr>
            
            	<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td width="40%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; width:40%">Name on Card:</strong><span style="font-size:13px; color:#F00; width:52%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:65px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            <td width="27%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Card Type:</strong><span style="font-size:13px; color:#F00; width:58%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                             <td width="33%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Amount: $</strong><span style="font-size:13px; color:#F00; width:58%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                        
                        
                        <tr>
                        
                        	<td width="48%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; width:40%">Card Number:</strong><span style="font-size:13px; color:#F00; width:53%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:70px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            <td width="27%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Exp. Date:</strong><span style="font-size:13px; color:#F00; width:60%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                             <td width="21%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Verification Code:</strong><span style="font-size:13px; color:#F00; width:39%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                        
                        
                    </table>
                
               </td>
            
            
            </tr>
        
        
         <tr>
         
         	<td>
            
            	<table width="100%">
                
                	<tr>
                    
                   	  <td width="50%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Authorized Signature:</strong><span style="font-size:13px; color:#F00; width:170px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        <td width="60%">
                        
                        	<table width="100%">
                            
                            	<tr>
                                
                                	<td width="26%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Today’s Date: </strong></td>
                                    
                                    <td width="17%"><span style="font-size:13px; color:#F00; width:62px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:0px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span><span style="font-size:13px; display:inline-block;  font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">/</span></td>
                                    
                                    <td width="20%"><span style="font-size:13px; color:#F00; width:75px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:0px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span><span style="font-size:13px; display:inline-block;  font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">/</span></td>
                                    
                                    <td width="34%"><span style="font-size:13px; color:#F00; width:110px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:0px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                                
                                
                                </tr>
                            
                            </table>
                        
                        
                        </td>
                    
                    </tr>
                
                
                
                </table>
            
            
            </td>
         
         </tr>
            
    </table>   
    
   </div>
   
</body>
</html>';
			
	$this->data['propertyAddres'] = url_title($PropertyList->row()->prop_address, '-', TRUE);		
			
			
			
			
			
			
			
			
			
			$this->load->view('admin/order/view_orders',$this->data);
		}
	}
	
	/**
	 * 
	 * This function delete the order record from db
	 */
	public function delete_order(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$order_id = $this->uri->segment(4,0);
			$condition = array('id' => $order_id);
			$old_order_details = $this->order_model->get_all_details(PRODUCT,array('id'=>$order_id));
			$this->update_old_list_values($order_id,array(),$old_order_details);
			$this->update_user_order_count($old_order_details);
			$this->order_model->commonDelete(PRODUCT,$condition);
			$this->setErrorMessage('success','Order deleted successfully');
			redirect('admin/order/display_order_list');
		}
	}
	
	public function order_review(){
		if ($this->checkLogin('A')==''){
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
				$this->load->view('admin/order/display_order_reviews',$this->data);
			}
		}
	}
	

	public function post_order_comment(){
		if ($this->checkLogin('A') != ''){
			$this->order_model->commonInsertUpdate(REVIEW_COMMENTS,'insert',array(),array(),'');
		}
	}
	
}

/* End of file order.php */
/* Location: ./application/controllers/admin/order.php */
