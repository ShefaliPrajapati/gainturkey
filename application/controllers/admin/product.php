<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Product management 
 * @author Teamtweaks
 *
 */
class Product extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie', 'date', 'form'));
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model('product_model');
        if ($this->checkPrivileges('property', $this->privStatus) == FALSE) {
            redirect('admin_ror');
        }
    }

    /**
     * 
     * This function loads the product list page
     */
    public function index() {

        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            redirect('admin/product/display_product_list');
        }
    }

    /**
     * 
     * This function loads the selling product list page
     */
    public function display_product_list() {

        //$this->product_model->update_propertystatus();

        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $adminName = $this->session->userdata('fc_session_admin_name');
            $this->data['heading'] = 'Property List';
            if ($this->session->userdata('fc_session_admin_name') == $this->config->item('admin_name') || $this->session->userdata('fc_session_admin_name') == 'tcadmin' || $this->session->userdata('fc_session_admin_name') == 'garilynn') {
                $this->data['productList'] = $this->product_model->view_product_details_admin_ror(' group by p.id order by p.created desc ');
            } else {
                $this->data['productList'] = $this->product_model->view_product_details_admin_ror('and p.user_id=' . $this->checkLogin('A') . ' group by p.id order by p.created desc ');
				
            }

            $createrArr = array();
            if ($this->data['productList']->num_rows() > 0) {
                foreach ($this->data['productList']->result() as $prd) {
                    if ($prd->user_id != 0) {
                        $creater_name = '';
                        $creater = $this->product_model->get_all_details(SUBADMIN, array('id' => $prd->user_id));
                        if ($creater->num_rows() > 0) {
                            $creater_name = $creater->row()->admin_name;
                        }
                        $createrArr[$prd->id] = array('creater_id' => $prd->user_id, 'creater_name' => $creater_name);
                    } else {
                        $createrArr[$prd->id] = array('creater_id' => 0, 'creater_name' => $this->config->item('admin_name'));
                    }
                }
            }

            $this->data['createrArr'] = $createrArr;
            #echo '<pre>'; print_r($this->data['createrArr']); die;
            #echo '<pre>'; print_r($this->data['productList']->result_array()); die;
            //$this->data['productList1'] = $this->product_model->view_product_details(' WHERE pr.sold_admin_name = "'.$adminName.'" group by p.id order by p.created desc ');
            $this->data['confirm_code'] = $this->product_model->get_confirm_code();
            $this->data['product_image'] = $this->product_model->Display_product_image_details();
            $this->data['code'] = $this->data['confirm_code']->row();
            $this->load->view('admin/product/display_product_list', $this->data);
        }
    }
     
     public function reserved_product_details()
        {
            if ($this->checkLogin('A') == '')
                {
                    redirect('admin_ror');
                }
            else
                {
                    $condition  =   array('id' => $this->uri->segment(4,0));
                    $this->data['heading'] = 'Reserved Property Information';
                    $this->data['productList'] = $this->product_model->get_all_details(RESERVED_INFO,$condition);
                    //print_r($this->data['productList']->result());die;
                    $PropertyList=$this->data['productList'];
                    
                    if($PropertyList->row()->image!=''){
                        $imgName = $PropertyList->row()->image;
                    }else{
                        $imgName = 'no-image.jpg';
                    }
                    $this->data['productListPopUp']='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Return On Rentals</title>
</head>
<body style="background:#FFFFFF; width:100%; margin:0; padding:0;">
    <div id="printthis" style="margin:0px auto; width:64%;">
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px; ">
        
        <tr style="background:#c4c4c4; height:85px; width:50%;">
            <td width="10%;"><img src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
            </td>
            <td  width="13%;" style="vertical-align:top; text-align:right;">
            <span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100%!important; vertical-align:top; text-align:right;">'.$PropertyList->row()->prop_address.'</span>
            </td>
        </tr>
    </table>        
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px; margin:15px 0 10px 0;">
        <tr>
            <td  height="30" align="center" style="float:left; text-align:center; color:#008904; width:100%;  font-family:Arial, Helvetica, sans-serif;  font-size:23px; font-weight:bold">Property Reservation Confirmation</td>
        </tr>
        <tr>
            <td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">Congratulations! You have successfully placed this property under reserve for purchase. Our staff is working diligently on your closing documents and transfer packet. Please bring this hotsheet with you to your closing at the event.</td>
        </tr>
    </table>
    <table border="0" width="700" align="center" cellpadding="0" cellspacing="0" >
    
        <tr style="margin:20px 0 20px;">
        
            <td  width="250">
                <img src="'.base_url().'images/product/'.$imgName.'" style="width:250px !important; height:190px; " />
            </td>
            
            <td>
            
                <table cellpadding="0" cellspacing="0"  width="350" align="left" style="margin-left:125px;">
                
                    <tr style="margin:5px 0 15px 0px; line-height:26px;" >
                        <td colspan="2" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property ID: '.$PropertyList->row()->rental_id.'</b></td>
                    </tr>
                    
                    
                   <tr style="margin:5px 0 15px 0px; line-height:26px;">
                        <td colspan="2" style=" font-size:14px;  margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property Address: '.$PropertyList->row()->prop_address.'</b></td>
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


    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px;">
    
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
            
            <td><span style="float:left; font-weight:bold; margin:0px 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">State: '.str_replace('-',' ',$PropertyList->row()->state).'</span></td>
            
            <td><span style="float:left; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Zip: '.$PropertyList->row()->postal_code.'</span></td>
            
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
                 $this->data['productListPopUp'] .= '
           
                <td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Adjustment: $'.number_format($PropertyList->row()->adjustment,0).'</span></td>
            
           ';
            }
            else
            {
                 $this->data['productListPopUp'] .= ' <td colspan="2">&nbsp;</td>';
            }
           $this->data['productListPopUp'] .= ' </tr>
           
           
           <tr>
           
            <td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $'.number_format($PropertyList->row()->reserv_price,0).'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</span></td>
           
           </tr>
           
           
           <tr>
           
            <td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type:  '.$PropertyList->row()->sales_cash.' '.$PropertyList->row()->sales_cf.' '.$PropertyList->row()->sales_cs.' '.$PropertyList->row()->sales_fs.' '.$PropertyList->row()->sales_sdira.' '.$PropertyList->row()->sales_sl.'</span></td>';
            
            if($PropertyList->row()->sales_sdira !='' || $PropertyList->row()->sales_sl !=''){
            $this->data['productListPopUp'] .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Custodian name: '.$PropertyList->row()->cust_name.'</span></td>';
           }else{
            $this->data['productListPopUp'] .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">&nbsp;</span></td>';
           
           }
 $this->data['productListPopUp'] .= '</tr>
           
           
            <tr>
           
            <td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Note: '.$PropertyList->row()->note.'</span></td>';
            
            if($PropertyList->row()->sales_sdira !='' || $PropertyList->row()->sales_sl !=''){
            $this->data['productListPopUp'] .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Account number: '.$PropertyList->row()->account_no.'</span></td>';
            }else{
            $this->data['productListPopUp'] .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">&nbsp;</span></td>';
            } 
            
           $this->data['productListPopUp'] .= '</tr>
            
    </table>   
    
    <table border="0" width="750" cellpadding="0" cellspacing="0" style="max-width:750px;">
        <tr>
            <td colspan="3" style=" font-size:14px;  line-height:19px; margin-bottom:5px; text-align:left; font-family:Arial, Helvetica, sans-serif" width="550" >
                This Property reservation Confirmation is your receipt of your commitment to purchase the above referenced property. Due to the nature of the investors summit, and the overwhelming intrest the students have in purchasing the properties brought to the event by our preferred vendors, your possession of this document is evidence that the property has been removed from our active database and is no longer available for sale to other students. Our staff will contact you during the final two days of the event to arrange the production and execution of the final document for closing. Please keep this information for reference prior to closing.
            </td>
        </tr>
        
        
        <tr style="background:#bebebe; height:27px; margin:35px 10px 10px 10px; width:100%;" >
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 10px;">'.$this->config->item('footer_content').'</td>
            <td width="25%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 3px;">All Rights Reserved</td>
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 10px 3px 3px;">Unauthorized Use or Duplication is Prohibited</td>
        </tr>
    </table> 
    
   </div>
   <div style="margin-top:50px;"></div>
   <div style="margin:0px auto; width:64%;">
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px;">
        
        <tr style="background:#c4c4c4; height:85px; width:50%;">
            <td width="10%;"><img style="float:left;" src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
            </td>
            <td  width="13%;" style="vertical-align:top; text-align:right;">
            <span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100% !important; vertical-align:top; text-align:right;">INTENT to PURCHASE AGREEMENT</span>
            </td>
        </tr>
    </table>        
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px; margin:15px 0 10px 0;">
        <tr>
            <td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">This letter sets forth some of the basic terms under which Seller and Purchaser would be interested in entering into a Real Estate Purchase Agreement.  It serves as a letter of intent (“Letter”) from <b>'.$PropertyList->row()->entity_name.'</b> ("Purchaser") through and dated <b>'.date('m-d-Y', strtotime($PropertyList->row()->dateAdded)).'</b>, in which Purchaser has set forth its interest in acquiring the subject Property.  Nevertheless, please be advised that this letter is not contractually binding on the parties and is only an expression of the basic terms and conditions to be incorporated in a formal written agreement. </td>
        </tr>
    </table>
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" >
        <tr style="margin:20px 0 20px;">
            <td cellpadding="0" cellspacing="0" width="250" align="left">
                <table>
                    <tr>
                        <td><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PROPERTY: </span></td>
                        <td>'.$PropertyList->row()->prop_address.'</td>
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
                        
                        <td>'.$PropertyList->row()->city.', '.str_replace('-',' ',$PropertyList->row()->state).', '.$PropertyList->row()->postal_code.'</td>
                    
                    </tr>
                </table>
            
            </td>
            
        </tr>
    </table>

    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px;">
    
        <tr>
            <td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PAYMENT METHOD: </strong>'.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</td>
            
        </tr>

         <tr>
        
            <td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASE PRICE: </strong>$'.number_format($PropertyList->row()->sales_price,0).'</td>
            
        </tr>';
           if($PropertyList->row()->adjustment !='')
            {
                 $this->data['productListPopUp'] .= '<tr>
           
            <td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">ADJUSTMENT: </strong>$'.number_format($PropertyList->row()->adjustment,0).'</td>
           
           </tr>';
            }
           $this->data['productListPopUp'] .= '
        
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
                            <td valign="bottom" style="vertical-align:bottom; line-height:20px; "><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                        </tr>
                       <tr>
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
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
                            <td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Cash</strong></td>
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Check</strong></td>
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Credit Card</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
               <tr>
                <td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">CREDIT CARD AUTHORIZATION</strong></td>
            </tr>
             <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="30%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name on Card:</strong><span style="font-size:13px; color:#F00; width:50%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                            <td width="15%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Card Type:</strong><span style="font-size:13px; color:#F00; width:40%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                             <td width="25%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Amount: $</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td width="30%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Card Number:</strong><span style="font-size:13px; color:#F00; width:50%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                            <td width="15%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Exp. Date:</strong><span style="font-size:13px; color:#F00; width:40%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                             <td width="25%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Verification Code:</strong><span style="font-size:13px; color:#F00; width:57%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                        </tr>
                     </table>
                </td>
            </tr>
         <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td width="32%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Authorized Signature:</strong><span style="font-size:13px; color:#F00; width:100px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                        <td width="50%">
                            <table width="100%">
                                <tr>
                                    <td><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Today’s Date: </strong></td>
                                    <td><span style="font-size:13px; color:#F00; width:50px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span><span style="font-size:13px; display:inline-block;  font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">/</span></td>
                                    <td><span style="font-size:13px; color:#F00; width:50px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span><span style="font-size:13px; display:inline-block;  font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">/</span></td>
                                    <td><span style="font-size:13px; color:#F00; width:100px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
         </tr> 
         <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:22px; text-align:center; width=100%;" colspan="3">
                <a href="'.base_url().'admin/order/view_order/'.$PropertyList->row()->id.'">Download PDF</a>
            </td>
        </tr>
         </table>
         </div>
</body>
</html>';
                    
                    $this->load->view('admin/product/reserved_detail',$this->data);
                }
        }





    public function display_user_product_list() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'UnSold Property List';
            $this->data['productList'] = $this->product_model->view_product_details(' where property_status="UnSold" group by p.id order by p.created desc ');
            $this->data['confirm_code'] = $this->product_model->get_confirm_code();
            $this->data['product_image'] = $this->product_model->Display_product_image_details();
            $this->data['code'] = $this->data['confirm_code']->row();

            $this->load->view('admin/product/display_user_product_list', $this->data);
        }
    }

    /**
     * 
     * This function loads the add new product form
     */
    public function add_product_form() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'Add New Property';
            $this->data['Product_id'] = $this->uri->segment(4, 0);
            $this->data['categoryView'] = $this->product_model->view_category_details();
            //Rental Address
            $this->data['RentalCountry'] = $this->product_model->get_all_details(COUNTRY_LIST, array('status' => 'Active'));
            $this->data['RentalState'] = $this->product_model->get_all_details(STATE_TAX, array('status' => 'Active'));
            $this->data['RentalCity'] = $this->product_model->get_all_details(CITY, array('status' => 'Active'));
            $this->data['Property_Type'] = $this->product_model->get_all_details(PRODUCT_ATTRIBUTE, array('status' => 'Active'));
            $this->data['Property_Sub_Type'] = $this->product_model->get_all_details('fc_subattribute', array('status' => 'Active'));


            $this->data['atrributeValue'] = $this->product_model->view_atrribute_details();
            $this->data['PrdattrVal'] = $this->product_model->view_product_atrribute_details();
            $this->data['LastInsertRentalId'] = $this->product_model->LastInsertRentalId();
            $getdelId = ($this->data['LastInsertRentalId']->row()->LIid) + 1;
            $conditiondel = array('PropId' => $getdelId);
            //$this->product_model->commonDelete(CALENDARBOOKING,$conditiondel);
            //print_r($this->data['LastInsertRentalId']->result());die;
            $this->load->view('admin/product/add_product', $this->data);
        }
    }

    /**
     * 
     * This function insert and edit product
    //  */
    // public function insertEditProduct() {
      
    //             redirect('admin/product/display_product_list');
            
    // }
    public function insertEditProduct()
        {
            if ($this->checkLogin('A') == '')
                    redirect('admin_ror');
            else
                {
                    $headline = $this->input->post('headline');
                    $property_id = $this->input->post('propertyID');
                    $price = $this->input->post('event_price');
                
                if($property_id == '')
                    {
                        $old_product_details = array();
                        $condition = array('headline' => $headline);
                        $soldmode='UnSold';
                    }
                else
                    {
                        $old_product_details = $this->product_model->get_all_details(PRODUCT,array('id'=>$property_id));
                        $condition = array('headline' => $headline,'id !=' => $property_id);
                        $soldmode=$old_product_details->row()->property_status;
                    }
                
                
                
                if($property_id != '')
                    {
                        if($this->input->post('property_status') == 'Active')
                            {
                                $this->product_model->commonDelete(RESERVED_INFO,array('property_id' => $property_id));
                            }
                    }
        
        
                $price_range = '';
                if ($price>0 && $price<30000)
                    $price_range = '1-30000';
                    
                else if ($price>30000 && $price<40000)
                    $price_range = '30000-40000';
                    
                else if ($price>40000 && $price<50000)
                    $price_range = '40000-50000';
                    
                else if ($price>50000 && $price<60000)
                    $price_range = '50000-60000';
                    
                else if ($price>60000)
                    $price_range = '60000+';
                
                $excludeArr = array('imgtitle', 'imgPriority', 'address', 'state', 'city', 'post_code', 'latitude', 'longitude', 'product_id', 'changeorder', 'propertyID', 'b1_firstname', 'b1_lastname', 'b2_firstname', 'b2_lastname', 'b_entityname', 'b_entitytype', 'b_address', 'b_city', 'b_state', 'b_zipcode', 'b_phone1', 'b_phone2', 'b_email1', 'b_email2', 'b_purchase_price', 'sale_date', 'reservedTime', 'googlelat', 'googlelng', 'q', 'output', 'Reload', 'submit_button', 'display', 'comp_prop_address', 'comp_purchase_price', 'comp_date_sold', 'comp_type_deal', 'comp_beds', 'comp_baths', 'comp_id', 'modified');
                
                if($this->input->post('status') != '')
                    $product_status = 'Publish';
            
                else
                    $product_status = 'UnPublish';
            
                $display_main = 'no';
                $display_sub = 'no';
                if($this->input->post('display') == 'main')
                    {
                        $display_main = 'yes';
                    }
                else if($this->input->post('display') == 'sub')
                    {
                        $display_sub = 'yes';
                    }
                else if($this->input->post('display') == 'both')
                    {
                        $display_main = 'yes';
                        $display_sub = 'yes';
                    }
                    
                $seourl = url_title($headline, '-', TRUE);
                $checkSeo = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl,'id !='=>$property_id));
                $seo_count = 1;
                while ($checkSeo->num_rows()>0)
                    {
                        $seourl = $seourl.$seo_count;
                        $seo_count++;
                        $checkSeo = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl,'id !='=>$property_id));
                    }   
            
                $ImageName = '';
            
                $datestring = "%Y-%m-%d %H:%i:%s";
                $time = time();
                if ($property_id == '')
                    {
                        $inputArr = array('created' => mdate($datestring,$time),
                                          'seourl' => $seourl,
                                          'price_range'=> $price_range,
                                          'display_main' => $display_main,
                                          'display_sub' => $display_sub,
                                          'status' => 'Publish'
                                        );
                    }
                else
                    {
                        $inputArr = array('modified' => mdate($datestring,$time),
                                          'seourl' => $seourl,
                                          'status' => $product_status,
                                          'display_main' => $display_main,
                                          'display_sub' => $display_sub,
                                          'price_range'=> $price_range,
                                        
                                        );
                    }
                    
                    
                        
            //$config['encrypt_name'] = TRUE;
            //$config['overwrite'] = FALSE;
        /*  $config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
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
                       if(!is_dir($logoDirectory))
                            {
                               mkdir($logoDirectory,0777);
                            }
                       //$config['overwrite'] = FALSE;
                       $config['remove_spaces'] = FALSE;
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
              
               if ( $this->upload->do_multi_upload('product_image'))
         {
            
            
            }
            
                // echo "<pre>";print_r($_FILES['product_image']);die; 
                $logoDetails = $this->upload->get_multi_upload_data();
                //$logoDetails = $_FILES['product_image'];

            
            
            if ($property_id != ''){
                $this->update_old_list_values($property_id,$list_val_arr,$old_product_details);
            }
            $dataArr = $inputArr;
            
            
            if ($property_id == ''){
                $condition = array();
                
                $this->product_model->commonInsertUpdate(PRODUCT,'insert',$excludeArr,$dataArr,$condition);
                
                $property_id = $this->product_model->get_last_insert_id();
                
                $Attr_val_str = '';
                
                
                $this->setErrorMessage('success','Property added successfully');
                
            
                $this->update_price_range_in_table('add',$price_range,$property_id,$old_product_details);
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
                $this->product_model->simple_insert(PRODUCT_ADDRESS,$inputArr1);
                
                
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

                $compCount = count($this->input->post('comp_prop_address'));
                //die;
                $comp_address = $this->input->post('comp_prop_address');
                $comp_price = $this->input->post('comp_purchase_price');
                $comp_date = $this->input->post('comp_date_sold');
                $comp_deal = $this->input->post('comp_type_deal');
                $comp_beds = $this->input->post('comp_beds');
                $comp_baths = $this->input->post('comp_baths');
                $comp_id = $this->input->post('comp_id');

                for ($i = 0; $i < $compCount; $i++) {

                    if ($comp_address[$i] != '') {

                        $inputArrComp = array('property_id' => $property_id, 'comp_prop_address' => $comp_address[$i], 'comp_purchase_price' => $comp_price[$i], 'comp_date_sold' => $comp_date[$i], 'comp_type_deal' => $comp_deal[$i], 'no_of_beds' => $comp_beds[$i], 'no_of_baths' => $comp_baths[$i], 'dateAdded' => date('Y-m-d H:i:s'));

                        $this->product_model->simple_insert(RENTALCOMPS, $inputArrComp);
                    }
                }
                
        
                //Update user table count
            if ($this->checkLogin('U') != ''){
                $user_details = $this->product_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
                if ($user_details->num_rows()==1){
                    $prod_count = $user_details->row()->products;
                    $prod_count++;
                    $this->product_model->update_details(USERS,array('products'=>$prod_count),array('id'=>$this->checkLogin('U')));
                }
            }
                
                
            }else {
                $compCount = count($this->input->post('comp_prop_address'));
                //die;
                $comp_address = $this->input->post('comp_prop_address');
                $comp_price = $this->input->post('comp_purchase_price');
                $comp_date = $this->input->post('comp_date_sold');
                $comp_deal = $this->input->post('comp_type_deal');
                $comp_beds = $this->input->post('comp_beds');
                $comp_baths = $this->input->post('comp_baths');
                $comp_id = $this->input->post('comp_id');

                for ($i = 0; $i < $compCount; $i++) {

                    if ($comp_address[$i] != '') {

                        $inputArrComp = array('property_id' => $this->input->post('propertyID'), 'comp_prop_address' => $comp_address[$i], 'comp_purchase_price' => $comp_price[$i], 'comp_date_sold' => $comp_date[$i], 'comp_type_deal' => $comp_deal[$i], 'no_of_beds' => $comp_beds[$i], 'no_of_baths' => $comp_baths[$i], 'dateAdded' => date('Y-m-d H:i:s'));

                        //echo '<pre>'; print_r($inputArrComp); 
                        if ($comp_id[$i] != '') {
                            $this->product_model->update_details(RENTALCOMPS, $inputArrComp, array('id' => $comp_id[$i]));
                        } else {
                            $this->product_model->simple_insert(RENTALCOMPS, $inputArrComp);
                        }
                    }
                }

                    
                 
                $condition = array('id'=>$property_id);
                $this->product_model->commonInsertUpdate(PRODUCT,'update',$excludeArr,$dataArr,$condition);
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
                $this->product_model->update_details(PRODUCT_ADDRESS,$inputArr1,$condition1);
                
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
                
                $this->product_model->update_details(PRODUCT_FEATURES,$inputArr2,$condition1);
                
                
                
                
                $this->setErrorMessage('success','Property updated successfully');
                $this->update_price_range_in_table('edit',$price_range,$property_id,$old_product_details);
            }
            
            
            //upload image the table
            foreach($logoDetails as $fileVal)
               {
                       if (!$this->imageResizeWithSpace(600, 600, $file_element_name[$setPriority], './images/product/'))
                       {
                       
                               $error = array('error' => $this->upload->display_errors());
                       }
                       else
                       {
                               $sliderUploadedData = array($this->upload->data());
                               
                               
                       }
                                              
                       $filePRoductUploadData = array('property_id'=>$property_id,'product_image'=>$fileVal['file_name']);
                       
                       $this->product_model->simple_insert(PRODUCT_PHOTOS,$filePRoductUploadData);                                        
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
                
                if(count($inputArrPrName)>0){
                    for($i=0;$i < count($inputArrPrName);$i++){
                        if($inputArrPrName[$i]!=''){
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
                            $this->product_model->simple_insert(PRODUCT_PACKAGES,$inputArrRateVal);
                        }
                    }
                } 
            //Update the list table
            if (is_array($list_val_arr)){
                foreach ($list_val_arr as $list_val_row){
                    $list_val_details = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$list_val_row));
                    if ($list_val_details->num_rows()==1){
                        $product_count = $list_val_details->row()->product_count;
                        $products_in_this_list = $list_val_details->row()->products;
                        $products_in_this_list_arr = explode(',', $products_in_this_list);
                        if (!in_array($property_id, $products_in_this_list_arr)){
                            array_push($products_in_this_list_arr, $property_id);
                            $product_count++;
                            $list_update_values = array(
                                'products'=>implode(',', $products_in_this_list_arr),
                                'product_count'=>$product_count
                            );
                            $list_update_condition = array('id'=>$list_val_row);
                            $this->product_model->update_details(LIST_VALUES,$list_update_values,$list_update_condition);
                        }
                    }
                }
            }
            
            if($this->input->post('submit_button') == 'savencont')
                $this->source_info_form($property_id);
            else
                redirect('admin/product/display_product_list');
            //if($soldmode=='Sold'){
            //  redirect('admin/product/display_product_list');
            //}else{ 
                //redirect('admin/product/display_user_product_list');
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
    public function update_old_list_values($product_id, $list_val_arr, $old_product_details = '') {
        if ($old_product_details == '' || count($old_product_details) == 0) {
            $old_product_details = $this->product_model->get_all_details(PRODUCT, array('id' => $product_id));
        }
        $old_product_list_values = array_filter(explode(',', $old_product_details->row()->list_value));
        if (count($old_product_list_values) > 0) {
            if (!is_array($list_val_arr)) {
                $list_val_arr = array();
            }
            foreach ($old_product_list_values as $old_product_list_values_row) {
                if (!in_array($old_product_list_values_row, $list_val_arr)) {
                    $list_val_details = $this->product_model->get_all_details(LIST_VALUES, array('id' => $old_product_list_values_row));
                    if ($list_val_details->num_rows() == 1) {
                        $product_count = $list_val_details->row()->product_count;
                        $products_in_this_list = $list_val_details->row()->products;
                        $products_in_this_list_arr = array_filter(explode(',', $products_in_this_list));
                        if (in_array($product_id, $products_in_this_list_arr)) {
                            if (($key = array_search($product_id, $products_in_this_list_arr)) !== false) {
                                unset($products_in_this_list_arr[$key]);
                            }
                            $product_count--;
                            $list_update_values = array(
                                'products' => implode(',', $products_in_this_list_arr),
                                'product_count' => $product_count
                            );
                            $list_update_condition = array('id' => $old_product_list_values_row);
                            $this->product_model->update_details(LIST_VALUES, $list_update_values, $list_update_condition);
                        }
                    }
                }
            }
        }

        if ($old_product_details != '' && count($old_product_details) > 0 && $old_product_details->num_rows() == 1) {

            /*             * * Delete product id from lists which was created by users ** */

            $user_created_lists = $this->product_model->get_user_created_lists($old_product_details->row()->seller_product_id);
            if ($user_created_lists->num_rows() > 0) {
                foreach ($user_created_lists->result() as $user_created_lists_row) {
                    $list_product_ids = array_filter(explode(',', $user_created_lists_row->product_id));
                    if (($key = array_search($old_product_details->row()->seller_product_id, $list_product_ids)) !== false) {
                        unset($list_product_ids[$key]);
                        $update_ids = array('product_id' => implode(',', $list_product_ids));
                        $this->product_model->update_details(LISTS_DETAILS, $update_ids, array('id' => $user_created_lists_row->id));
                    }
                }
            }

            /*             * * Delete product id from product likes table and decrease the user likes count ** */


            /*             * * Delete product id from activity, notification and product comment tables ** */

            $this->product_model->commonDelete(USER_ACTIVITY, array('activity_id' => $old_product_details->row()->seller_product_id));
            $this->product_model->commonDelete(NOTIFICATIONS, array('activity_id' => $old_product_details->row()->seller_product_id));
        }
    }

    public function update_price_range_in_table($mode = '', $price_range = '', $product_id = '0', $old_product_details = '') {
        $list_values = $this->product_model->get_all_details(LIST_VALUES, array('list_value' => $price_range));
        if ($list_values->num_rows() == 1) {
            $products = explode(',', $list_values->row()->products);
            $product_count = $list_values->row()->product_count;
            if ($mode == 'add') {
                if (!in_array($product_id, $products)) {
                    array_push($products, $product_id);
                    $product_count++;
                }
            } else if ($mode == 'edit') {
                $old_price_range = '';
                if ($old_product_details != '' && count($old_product_details) > 0 && $old_product_details->num_rows() == 1) {
                    $old_price_range = $old_product_details->row()->price_range;
                }
                if ($old_price_range != '' && $old_price_range != $price_range) {
                    $old_list_values = $this->product_model->get_all_details(LIST_VALUES, array('list_value' => $old_price_range));
                    if ($old_list_values->num_rows() == 1) {
                        $old_products = explode(',', $old_list_values->row()->products);
                        $old_product_count = $old_list_values->row()->product_count;
                        if (in_array($product_id, $old_products)) {
                            if (($key = array_search($product_id, $old_products)) !== false) {
                                unset($old_products[$key]);
                                $old_product_count--;
                                $updateArr = array('products' => implode(',', $old_products), 'product_count' => $old_product_count);
                                $updateCondition = array('list_value' => $old_price_range);
                                $this->product_model->update_details(LIST_VALUES, $updateArr, $updateCondition);
                            }
                        }
                    }
                    if (!in_array($product_id, $products)) {
                        array_push($products, $product_id);
                        $product_count++;
                    }
                } else if ($old_price_range != '' && $old_price_range == $price_range) {
                    if (!in_array($product_id, $products)) {
                        array_push($products, $product_id);
                        $product_count++;
                    }
                }
            }
            $updateArr = array('products' => implode(',', $products), 'product_count' => $product_count);
            $updateCondition = array('list_value' => $price_range);
            $this->product_model->update_details(LIST_VALUES, $updateArr, $updateCondition);
        }
    }

   public function DeletePackageProducts() {
        $ingIDD = $this->input->post('imgId');
        $currentPage = $this->input->post('cpage');
        $condition = array('id' => $ingIDD);
        $this->product_model->commonDelete(PRODUCT_PACKAGES, $condition);
        echo $result = 1;
    }

    /**
     * 
     * Ajax function for delete the product Package
     */
    public function DeleteCompsProducts() {
        $ingIDD = $this->input->post('compId');
        $currentPage = $this->input->post('cpage');
        $condition = array('id' => $ingIDD);
        $this->product_model->commonDelete(RENTALCOMPS, $condition);
        echo $result = 1;
    }

    /**
     * 
     * Ajax function for delete the product image
     */
    public function DeleteImageProducts() {
        $ingIDD = $this->input->post('imgId');
        $currentPage = $this->input->post('cpage');
        $condition = array('id' => $ingIDD);
        $this->product_model->commonDelete(PRODUCT_PHOTOS, $condition);
        echo $result = 1;
    }

    /**
     * 
     * Ajax function for chhange the product featured/unfeatured
     */
    public function ChangeFeaturedProducts() {
        $ingIDD = $this->input->post('imgId');
        $FtrId = $this->input->post('FtrId');
        $currentPage = $this->input->post('cpage');
        $dataArr = array('featured' => $FtrId);
        $condition = array('id' => $ingIDD);
        $this->product_model->update_details(PRODUCT, $dataArr, $condition);
        echo $result = $FtrId;
    }

    /**
     * 
     * This function loads the edit product form
     */
    public function edit_product_form() {

        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'Edit Property';
            $product_id = $this->uri->segment(4, 0);

            $condition = array('id' => $product_id);
            $this->data['product_details'] = $this->product_model->view_product1($product_id);

            // print_r($this->data['product_details']->row());
            // die;

            if ($this->data['product_details']->num_rows() == 1) {
                $userid = $this->data['product_details']->row()->user_id;
                $this->data['userDetails'] = $this->product_model->get_all_details(USERS, array('id' => $userid));
                $this->data['categoryView'] = $this->product_model->get_category_details($this->data['product_details']->row()->category_id);
                $this->data['atrributeValue'] = $this->product_model->view_atrribute_details();
                $this->data['SubPrdVal'] = $this->product_model->view_subproduct_details($product_id);
                $this->data['PrdattrVal'] = $this->product_model->view_product_atrribute_details();
                $sortArr1 = array('field' => 'imgPriority', 'type' => 'ASC');
                $this->data['product_image'] = $this->product_model->get_all_details_product(PRODUCT_PHOTOS, array('property_id' => $this->data['product_details']->row()->id), $sortArr1);
                //	echo $this->db->last_query();die;
                $this->data['Property_Type'] = $this->product_model->get_all_details(PRODUCT_ATTRIBUTE, array('status' => 'Active'));
                $this->data['Property_Sub_Type'] = $this->product_model->get_all_details('fc_subattribute', array('status' => 'Active'));
                /* $this->data['Rate_Package'] = $this->product_model->get_all_details(PRODUCT_RATE_PACKAGE,array('status'=>'Active'));
                  $this->data['Product_Rate_Package'] = $this->product_model->get_all_details(PRODUCT_PACKAGES,array('product_id'=>$this->data['product_details']->row()->id)); */
                $this->data['RentalCountry'] = $this->product_model->get_all_details(COUNTRY_LIST, array('status' => 'Active'));
                $this->data['RentalState'] = $this->product_model->get_all_details(STATE_TAX, array('status' => 'Active'));
                $this->data['RentalCity'] = $this->product_model->get_all_details(CITY, array('status' => 'Active'));

                $this->data['CompDetails'] = $this->product_model->get_all_details(RENTALCOMPS, array('property_id' => $product_id));

                $adminStatuPopup = $this->product_model->admin_popup_status_view($product_id);
                if ($adminStatuPopup != '') {
                    $this->data['AdminPopStatus'] = $adminStatuPopup;
                } else {
                    $this->data['AdminPopStatus'] = 0;
                }

                $this->load->library('googlemaps');
                $config['center'] = $this->data['product_details']->row()->latitude . ',' . $this->data['product_details']->row()->longitude;
                $config['zoom'] = 'auto';
                $this->googlemaps->initialize($config);
                $marker = array();
                $marker['position'] = $this->data['product_details']->row()->latitude . ',' . $this->data['product_details']->row()->longitude;
                $marker['draggable'] = true;
                $marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
                $this->googlemaps->add_marker($marker);
                $this->data['map'] = $this->googlemaps->create_map();


                // echo '<pre>'; print_r($this->data['SubPrdVal']->result()); die;
                $this->load->view('admin/product/edit_product', $this->data);
            } else {
                redirect('admin_ror');
            }
        }
    }

    /* Ajax update for edit product */

    public function ajaxProductAttributeUpdate() {

        $conditons = array('pid' => $this->input->post('attId'));
        $dataArr = array('attr_id' => $this->input->post('attname'), 'attr_price' => $this->input->post('attval'));
        $subproductDetails = $this->product_model->edit_subproduct_update($dataArr, $conditons);

    }

    /**
     * 
     * This function change the selling product status
     */
    public function change_product_status() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $mode = $this->uri->segment(4, 0);
            $product_id = $this->uri->segment(5, 0);
            $status = ($mode == '0') ? 'UnPublish' : 'Publish';
            $newdata = array('status' => $status);
            $condition = array('id' => $product_id);
            $this->product_model->update_details(PRODUCT, $newdata, $condition);
            $this->setErrorMessage('success', 'Property Status Changed Successfully');
            redirect('admin/product/display_product_list');

        }
    }

    public function change_product_sold_status() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            
            $mode = $this->input->post('mode');
            $product_id = $this->input->post('id');
            $status = ($mode == '0') ? 'Unsold' : 'Sold';
            $newdata = array('property_status' => $status);
            $condition = array('id' => $product_id);
            $this->product_model->update_details(PRODUCT, $newdata, $condition);
            $this->setErrorMessage('success', 'Property Status Changed Successfully');
            echo '1';
            
            // redirect('admin/product/display_product_list');
        }
    }

    /**
     * 
     * This function change the affiliate product status
     */
    public function change_user_product_status() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $mode = $this->uri->segment(4, 0);
            $product_id = $this->uri->segment(5, 0);
            $status = ($mode == '0') ? 'UnPublish' : 'Publish';
            $newdata = array('status' => $status);
            $condition = array('id' => $product_id);
            $this->product_model->update_details(PRODUCT, $newdata, $condition);
            $this->setErrorMessage('success', 'Rental Status Changed Successfully');
            redirect('admin/product/display_user_product_list');
        }
    }

    /**
     * 
     * This function loads the product view page
     */
    public function view_product() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'View Property';
            $product_id = $this->uri->segment(4, 0);
            $condition = array('id' => $product_id);
            $sortArr1 = array('field' => 'imgPriority', 'type' => 'ASC');
            //$this->data['product_details'] = $this->product_model->get_all_details(PRODUCT,$condition);
            $this->data['product_details'] = $this->product_model->view_product1($product_id);
            if ($this->data['product_details']->num_rows() == 1) {
                $this->data['catList'] = $this->product_model->get_cat_list($this->data['product_details']->row()->category_id);
                $this->data['RentalCountry'] = $this->product_model->get_all_details(COUNTRY_LIST, array('status' => 'Active'));
                $this->data['RentalState'] = $this->product_model->get_all_details(STATE_TAX, array('status' => 'Active'));
                $this->data['RentalCity'] = $this->product_model->get_all_details(CITY, array('status' => 'Active'));
                $this->data['product_image'] = $this->product_model->get_all_details(PRODUCT_PHOTOS, array('property_id' => $this->data['product_details']->row()->id), $sortArr1);
                //$this->data['Product_Rate_Package'] = $this->product_model->get_all_details(PRODUCT_PACKAGES,array('product_id'=>$this->data['product_details']->row()->id));
                $this->data['listNameCnt'] = $this->product_model->get_all_details(ATTRIBUTE, array('status' => 'Active'));
                $this->data['listValueCnt'] = $this->product_model->get_all_details(LIST_VALUES, array('status' => 'Active'));
                $this->data['ReservedDetails'] = $this->product_model->get_all_details(RESERVED_INFO, array('property_id' => $this->data['product_details']->row()->id));
                $this->data['product_source_details'] = $this->product_model->get_all_details(SOURCE_INFO, array('property_id' => $this->data['product_details']->row()->id));

                $sourceData = $this->data['product_source_details']->row()->datavalues;
                $this->data['source_info'] = unserialize(stripslashes($sourceData));
                $list_valueArr = explode(',', $this->data['product_details']->row()->list_value);
                $listIdArr = array();
                foreach ($this->data['listValueCnt']->result_array() as $listCountryValue) {
                    $listIdArr[] = $listCountryValue['list_id'];
                }
                if ($this->data['listNameCnt']->num_rows() > 0) {
                    foreach ($this->data['listNameCnt']->result_array() as $listCountryName) {
                        $this->data['listCountryValue'] .='<br /><span class="cat1"><!-- <input name="list_name[]" class="checkbox" type="checkbox" value="' . $listCountryName['id'] . '" tabindex="7"> --><strong>' . ucfirst($listCountryName['attribute_name']) . ' &nbsp;</strong></span><br />';
                        foreach ($this->data['listValueCnt']->result_array() as $listCountryValue) {
                            if ($listCountryValue['list_id'] == $listCountryName['id']) {
                                if (in_array($listCountryValue['id'], $list_valueArr)) {
                                    $checkStr = 'checked="checked"';
                                } else {
                                    $checkStr = '';
                                }
                                $this->data['listCountryValue'] .='
								<div style="float:left; margin-left:10px;">
								<span>
								<input name="list_value[]" disabled="disabled"  class="checkbox" ' . $checkStr . ' type="checkbox" value="' . $listCountryValue['id'] . '" tabindex="7">
								<label class="choice">' . ucfirst($listCountryValue['list_value']) . '</label></span></div>';
                            }
                        }
                    }
                }

                $this->load->library('googlemaps');
                $config['center'] = $this->data['product_details']->row()->latitude . ',' . $this->data['product_details']->row()->longitude;
                $config['zoom'] = 'auto';
                $this->googlemaps->initialize($config);
                $marker = array();
                $marker['position'] = $this->data['product_details']->row()->latitude . ',' . $this->data['product_details']->row()->longitude;
                $marker['draggable'] = true;
                $marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
                $this->googlemaps->add_marker($marker);
                $this->data['map'] = $this->googlemaps->create_map();

                $this->load->view('admin/product/view_product', $this->data);
            } else {
                redirect('admin_ror');
            }
        }
    }

    public function source_info_form($id) {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['propertyID'] = $id;
            $this->data['source'] = $this->product_model->get_all_details(SOURCE_INFO, array('property_id' => $id));
            $this->data['propertyaddress'] = $this->product_model->get_all_details(PRODUCT_ADDRESS, array('property_id' => $id));
            $this->data['ReservedDetails'] = $this->product_model->get_all_details(RESERVED_INFO, array('property_id' => $id));
            if ($this->data['source']->num_rows() == 0) {
                $this->data['heading'] = 'Add Source Info';
                $this->data['SourcerDetails'] = $this->product_model->get_all_details(SOURCER_INFO, array('status' => 'Active'));
                $this->data['ManagerDetails'] = $this->product_model->get_all_details(MANAGER_INFO, array('status' => 'Active'));
                $this->load->view('admin/product/add_source_info', $this->data);
            } else if ($this->data['source']->num_rows() == 1) {
                $this->data['heading'] = 'Edit Source Info';
                $this->data['SourcerDetails'] = $this->product_model->get_all_details(SOURCER_INFO, array('status' => 'Active'));
                $this->data['ManagerDetails'] = $this->product_model->get_all_details(MANAGER_INFO, array('status' => 'Active'));
                $condition = array('property_id' => $id);
                //$this->data['product_source_details'] = $this->product_model->get_all_details(SOURCE_INFO,$condition);


                $get_source_info = $this->product_model->get_all_details(SOURCE_INFO, $condition);
                $data = $get_source_info->row()->datavalues;
                $this->data['source_info'] = unserialize(stripslashes($data));
                $this->load->view('admin/product/edit_source_info', $this->data);
            } else {
                $this->setErrorMessage('error', 'Details not found');
                redirect(base_url() . 'admin/product/display_product_list');
            }
        }
    }

    public function edit_source_info_form() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'Edit Source Info';
            $product_id = $this->uri->segment(4, 0);
            $condition = array('property_id' => $product_id);
            $this->data['propertyID'] = $this->product_model->get_all_details(PRODUCT, array('id' => $product_id));
            $this->data['propertyaddress'] = $this->product_model->get_all_details(PRODUCT_ADDRESS, array('property_id' => $product_id));

            $this->data['product_source_details'] = $this->product_model->get_all_details(SOURCE_INFO, $condition);
            if ($this->data['product_source_details']->num_rows() == 1) {
                $get_source_info = $this->product_model->get_all_details(SOURCE_INFO, $condition);
                $data = $get_source_info->row()->datavalues;
                $this->data['source_info'] = unserialize(stripslashes($data));

                $this->load->view('admin/product/edit_source_info', $this->data);
            } else if ($this->data['product_source_details']->num_rows() == 0) {

                $this->load->view('admin/product/edit_source_info', $this->data);
            } else {
                $this->setErrorMessage('error', 'Details not found');
                redirect(base_url() . 'admin/product/display_product_list');
            }
        }
    }

    public function add_source_info() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $value = $this->input->post();

            $data = serialize($value);
            $condition = array('property_id' => $this->input->post('id'));
            $id = $this->input->post('id');

            
            $this->setErrorMessage('success', 'Property source info details added successfully');

            redirect(base_url() . 'admin/product/display_product_list');
        }
    }

    public function edit_source_info() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $value = $this->input->post();
            $data = serialize($value);
            $condition = array('property_id' => $this->input->post('id'));
            $id = $this->input->post('id');
            $rows = $this->product_model->get_all_details(SOURCE_INFO, $condition);
            if ($rows->num_rows() == 1) {
                $this->setErrorMessage('success', 'Property source info details updated successfully');
            } else if ($rows->num_rows() == 0) {
                $this->setErrorMessage('success', 'Property source info details added successfully');
            }
            redirect(base_url() . 'admin/product/display_product_list');
        }
    }

    /**
     * 
     * This function delete the selling product record from db
     */
    public function delete_product() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $product_id = $this->uri->segment(4, 0);
            $condition = array('id' => $product_id);
            $prdId = array('property_id' => $product_id);
            $old_product_details = $this->product_model->get_all_details(PRODUCT, array('id' => $product_id));
            $this->update_old_list_values($product_id, array(), $old_product_details);
            $this->update_user_product_count($old_product_details);
            $this->product_model->commonDelete(PRODUCT, $condition);
            $this->product_model->commonDelete(PRODUCT_ADDRESS, $prdId);
            $this->product_model->commonDelete(PRODUCT_FEATURES, $prdId);
            $this->product_model->commonDelete(PRODUCT_PHOTOS, $prdId);
            //$this->product_model->commonDelete(CONTACT,array('rental_id' => $product_id));
            $this->product_model->commonDelete(SUBPRODUCT, array('product_id' => $product_id));
            $this->setErrorMessage('success', 'Rental deleted successfully');
            redirect('admin/product/display_product_list');
        }
    }

    /**
     * 
     * This function delete the affiliate product record from db
     */
    public function delete_user_product() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $product_id = $this->uri->segment(4, 0);
            $condition = array('id' => $product_id);
            $prdId = array('property_id' => $product_id);
            $old_product_details = $this->product_model->get_all_details(PRODUCT, array('id' => $product_id));
            $this->update_old_list_values($product_id, array(), $old_product_details);
            $this->update_user_product_count($old_product_details);
            $this->product_model->commonDelete(PRODUCT, $condition);
            $this->product_model->commonDelete(PRODUCT_ADDRESS, $prdId);
            $this->product_model->commonDelete(PRODUCT_FEATURES, $prdId);
            $this->product_model->commonDelete(PRODUCT_PHOTOS, $prdId);
            //$this->product_model->commonDelete(CONTACT,array('rental_id' => $product_id));
            $this->product_model->commonDelete(SUBPRODUCT, array('product_id' => $product_id));
            $this->setErrorMessage('success', 'Rental deleted successfully');
            redirect('admin/product/display_user_product_list');
        }
    }

    public function update_user_likes($product_id = '0') {
        $like_list = $this->product_model->get_like_user_full_details($product_id);
        if ($like_list->num_rows() > 0) {
            foreach ($like_list->result() as $like_list_row) {
                $likes_count = $like_list_row->likes;
                $likes_count--;
                if ($likes_count < 0)
                    $likes_count = 0;
                $this->product_model->update_details(USERS, array('likes' => $likes_count), array('id' => $like_list_row->id));
            }
            $this->product_model->commonDelete(PRODUCT_LIKES, array('product_id' => $product_id));
        }
    }

    public function update_user_created_lists($pid = '0') {
        $user_created_lists = $this->product_model->get_user_created_lists($pid);
        if ($user_created_lists->num_rows() > 0) {
            foreach ($user_created_lists->result() as $user_created_lists_row) {
                $list_product_ids = array_filter(explode(',', $user_created_lists_row->product_id));
                if (($key = array_search($pid, $list_product_ids)) !== false) {
                    unset($list_product_ids[$key]);
                    $update_ids = array('product_id' => implode(',', $list_product_ids));
                    $this->product_model->update_details(LISTS_DETAILS, $update_ids, array('id' => $user_created_lists_row->id));
                }
            }
        }
    }

    public function update_user_product_count($old_product_details) {
        if ($old_product_details != '' && count($old_product_details) > 0 && $old_product_details->num_rows() == 1) {
            if ($old_product_details->row()->user_id > 0) {
                $user_details = $this->product_model->get_all_details(USERS, array('id' => $old_product_details->row()->user_id));
                if ($user_details->num_rows() == 1) {
                    $prod_count = $user_details->row()->products;
                    $prod_count--;
                    if ($prod_count < 0) {
                        $prod_count = 0;
                    }
                    $this->product_model->update_details(USERS, array('products' => $prod_count), array('id' => $old_product_details->row()->user_id));
                }
            }
        }
    }

    /**
     * 
     * This function change the selling product status, delete the selling product record
     */
    public function change_product_status_global() {

        if ($_POST['checkboxID'] != '') {

            if ($_POST['checkboxID'] == '0') {
                redirect('admin/product/add_product_form/0');
            } else {
                redirect('admin/product/add_product_form/' . $_POST['checkboxID']);
            }
        } else {
            if (count($_POST['checkbox_id']) > 0 && $_POST['statusMode'] != '') {
                $data = $_POST['checkbox_id'];
                if (strtolower($_POST['statusMode']) == 'delete') {
                    for ($i = 0; $i < count($data); $i++) {
                        if ($data[$i] == 'on') {
                            unset($data[$i]);
                        }
                    }
                    foreach ($data as $product_id) {
                        if ($product_id != '') {
                            $old_product_details = $this->product_model->get_all_details(PRODUCT, array('id' => $product_id));
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
                redirect('admin/product/display_product_list');
            }
        }
    }

    /**
     * 
     * This function change the affiliate product status, delete the affiliate product record
     */
    public function change_user_product_status_global() {

        if (count($_POST['checkbox_id']) > 0 && $_POST['statusMode'] != '') {
            $data = $_POST['checkbox_id'];
            if (strtolower($_POST['statusMode']) == 'delete') {
                for ($i = 0; $i < count($data); $i++) {
                    if ($data[$i] == 'on') {
                        unset($data[$i]);
                    }
                }
                foreach ($data as $product_id) {
                    if ($product_id != '') {
                        $old_product_details = $this->product_model->get_all_details(USER_PRODUCTS, array('seller_product_id' => $product_id));
                        $this->update_user_created_lists($product_id);
                        //$this->update_user_likes($product_id);
                        //$this->update_user_product_count($old_product_details);
                        $this->product_model->commonDelete(USER_ACTIVITY, array('activity_id' => $product_id));
                        $this->product_model->commonDelete(NOTIFICATIONS, array('activity_id' => $product_id));
                        $this->product_model->commonDelete(PRODUCT_COMMENTS, array('product_id' => $product_id));
                        $this->product_model->commonDelete(SUBPRODUCT, array('product_id' => $product_id));
                        $this->product_model->commonDelete(PRODUCT, array('id' => $product_id));
                    }
                }
            }
            $this->product_model->activeInactiveCommon(PRODUCT, 'id');
            if (strtolower($_POST['statusMode']) == 'delete') {
                $this->setErrorMessage('success', 'Rental records deleted successfully');
            } else {
                $this->setErrorMessage('success', 'Rental records status changed successfully');
            }
            redirect('admin/product/display_user_product_list');
        }
    }

    public function loadListValues() {
        $returnStr['listCnt'] = '<option value="">--Select--</option>';
        $lid = $this->input->post('lid');
        $lvID = $this->input->post('lvID');
        if ($lid != '') {
            $listValues = $this->product_model->get_all_details(LIST_VALUES, array('list_id' => $lid));
            if ($listValues->num_rows() > 0) {
                foreach ($listValues->result() as $listRow) {
                    $selStr = '';
                    if ($listRow->id == $lvID) {
                        $selStr = 'selected="selected"';
                    }
                    $returnStr['listCnt'] .= '<option ' . $selStr . ' value="' . $listRow->id . '">' . $listRow->list_value . '</option>';
                }
            } else {
                $returnStr['listCountryCnt'] .= '<option value="">---Select---</option>';
            }
        }
        echo json_encode($returnStr);
    }

    public function loadCountryListValues() {
        $returnStr['listCountryCnt'] = '<select class="chzn-select required" name="state" tabindex="-1" style="width: 375px;" onchange="javascript:loadStateListValues(this)"  data-placeholder="Please select the state name">';
        $lid = $this->input->post('lid');
        $lvID = $this->input->post('lvID');
        if ($lid != '') {
            $listValues = $this->product_model->get_all_details(STATE_TAX, array('countryid' => $lid));
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

    public function loadStateListValues() {
        $returnStr['listCountryCnt'] = '<select class="chzn-select required" name="city" tabindex="-1" style="width: 375px;" data-placeholder="Please select the city name">';
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

    public function changePosition() {
        if ($this->checkLogin('A') != '') {
            $catID = $this->input->post('catID');
            $pos = $this->input->post('pos');
            $this->product_model->update_details(PRODUCT, array('order' => $pos), array('id' => $catID));
        }
    }

    public function changeImagePosition() {
        if ($this->checkLogin('A') != '') {
            $catID = $this->input->post('catID');
            $pos = $this->input->post('pos');
            $this->product_model->update_details(PRODUCT_PHOTOS, array('imgPriority' => $pos), array('id' => $catID));
        }
    }

    public function changeImagetitle() {
        if ($this->checkLogin('A') != '') {
            $catID = $this->input->post('catID');
            $title = $this->input->post('title');
            $this->product_model->update_details(PRODUCT_PHOTOS, array('imgtitle' => $title), array('id' => $catID));
        }
    }

    /**
     * 
     * This function loads the contact dashboard
     */
    public function display_rental_dashboard() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'Property Dashboard';
            $this->data['ProductList'] = $this->product_model->get_contactAll_details();
            $this->data['TopRenterList'] = $this->product_model->get_contactAllSeller_details();



            $this->load->view('admin/product/display_rental_dashboard', $this->data);
        }
    }

    /**
     * 
     * This function loads the Calendar view page
     */
    public function view_calendar() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'View Calendar';
            $user_id = $this->uri->segment(4, 0);
            $deal_id = $this->uri->segment(5, 0);
            $this->data['ViewList'] = array('rental_id' => $user_id);
            //$this->data['ViewList'] = $this->product_model->view_orders($user_id,$deal_id);
            $this->load->view('admin/product/view_calendar', $this->data);
        }
    }

    public function GetDays($sStartDate, $sEndDate) {
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

    function viewCalendar($id = '') {

        $idArr = array('id' => $id);
        //print_r($idArr); die;
        $data['idArr'] = $idArr;
        $this->load->view('admin/product/viewcalendar', $data);
    }

    public function pdf_report() {
        $this->load->helper(array('Pdf_create'));   //  Load helper
        $data = file_get_contents(site_url('admin/product/display_product_list')); // Pass the url of html report
        create_pdf($data); //Create pdf
    }

    public function dragimageuploadedit() {
        $this->data['id'] = $this->uri->segment(4, 0);
        $this->load->view('admin/product/dragndrop', $this->data);
    }

    public function dragupload() {

        $this->load->view('admin/product/upload');
    }

    public function dragimageuploadinsert() {

        $this->load->view('admin/product/dragndrop');
    }

    public function get_sub_type_details() {
        $typeId = $this->input->post('typeId');
        //echo $typeId; die;
        $get_sub_types = $this->product_model->get_all_details(PRODUCT_SUBATTRIBUTE, array('attr_id' => $typeId));

        echo '<div class="form_grid_12">
                  <label class="field_title" for="property_sub_type">Property Sub Type</label>
                  <div class="form_input">
             <select id="property_sub_type" name="property_sub_type">
                  	<option value="0" selected="selected">Select</option>';
        foreach ($get_sub_types->result() as $typeVals) {
            echo '<option value="' . $typeVals->id . '">' . $typeVals->subattr_name . '</option>';
        }
        echo '</select>
			   </div>
                </div>';
    }

    public function prop_id_check_dub() {
        $propId = $this->input->post('propId');

        $this->db->select('property_id');
        $this->db->from(PRODUCT);
        $this->db->where('property_id', $propId);
        $PrdtDets = $this->db->get();

        if ($PrdtDets->num_rows() > 0) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function edit_sub_type_details() {
        $typeId = $this->input->post('typeId');
        $productID = $this->input->post('prodId');

        $prodDet = $this->product_model->get_all_details(PRODUCT, array('id' => $productID));
        $get_sub_types = $this->product_model->get_all_details(PRODUCT_SUBATTRIBUTE, array('attr_id' => $typeId));

        echo '<div class="form_grid_12">
                  <label class="field_title" for="property_sub_type">Property Sub Type</label>
                  <div class="form_input">
             <select id="property_sub_type" name="property_sub_type">
                  	<option value="0" selected="selected">Select</option>';
        foreach ($get_sub_types->result() as $typeVals) {

            echo '<option value="' . $typeVals->id . '"';
            if ($prodDet->row()->property_sub_type == $typeVals->id) {
                echo ' ' . 'selected="selected"';
            }
            echo '>' . $typeVals->subattr_name . '</option>';
        }
        echo '</select>
			   </div>
                </div>';
    }

    function tessadfasf() {
		
        $imageName = @implode(',', $this->input->post('imgUpload'));


        $imageNameNew = @explode(',', $imageName);

        $s = 0;
        foreach ($this->input->post('imgUploadUrl') as $imgUrl) {

            $imagPath  = getcwd().'/images/product/';
            $savepath  = getcwd().'/images/product/thumb/';

            copy($imgUrl, $imagPath. $imageNameNew[$s]);
            unlink('server/php/files/' . $imageNameNew[$s]);
            unlink('server/php/files/thumbnail/' . $imageNameNew[$s]);
            $fileName = $imageNameNew[$s];
            @copy($imagPath . $fileName, $savepath . $fileName);
            $target_file = $imagPath . $fileName;
            $size = getimagesize($target_file);
            $w = $size['width'];
            $h = $size['height'];
            $option = $this->getImageShape($w, $h, $target_file);
            $resizeObj = new Resizeimage($target_file);
            $resizeObj->resizeImage(250, 162, $option);
            $resizeObj->saveImage($savepath . $fileName, 100);
            $this->ImageCompress($imagPath . $fileName, $imagPath . $fileName);
            $this->ImageCompress($savepath . $fileName, $savepath . $fileName);

            $s++;
        }

        //echo $imageName; 
        //echo '<pre>'; print_r($_POST); die;



        $id = $this->input->post('id');
        if ($id != '') {
            foreach ($imageNameNew as $name) {
                $this->product_model->simple_insert(PRODUCT_PHOTOS, array('product_image' => $name, 'status' => 'Active', 'property_id' => $id));
                $this->db->last_query();
            }
        } else {
            if ($this->session->userdata('fc_session_admin_name') == $this->config->item('admin_name')) {
                $user_id = 0;
            } else {
                $user_id = $this->checkLogin('A');
            }

            $this->product_model->simple_insert(PRODUCT, array('user_id' => $user_id, 'option' => 'dummy'));
            $id = $this->product_model->get_last_insert_id();
            $this->product_model->simple_insert(PRODUCT_ADDRESS, array('property_id' => $id));
            foreach ($imageNameNew as $name) {
                $this->product_model->simple_insert(PRODUCT_PHOTOS, array('product_image' => $name, 'status' => 'Active', 'property_id' => $id));
                $this->db->last_query();
            }
        }

        redirect(base_url() . 'admin/product/edit_product_form/' . $id);
    }

    function Get_sourcer_value() {
        $semail = $this->input->post('semail');
        $secretCode = $this->product_model->get_all_details(SOURCER_INFO, array('s_email' => $semail));
        if ($secretCode->num_rows() == 1) {
            $returnStr['s_first_name'] = $secretCode->row()->s_first_name;
            $returnStr['s_last_name'] = $secretCode->row()->s_last_name;
            $returnStr['s_company_name'] = $secretCode->row()->s_company_name;
            $returnStr['s_email'] = $secretCode->row()->s_email;
            $returnStr['s_address'] = $secretCode->row()->s_address;
            $returnStr['s_city'] = $secretCode->row()->s_city;
            $returnStr['s_state'] = $secretCode->row()->s_state;
            $returnStr['s_zipcode'] = $secretCode->row()->s_zipcode;
            $returnStr['s_contact_1'] = $secretCode->row()->s_contact_1;
            $returnStr['s_contact_2'] = $secretCode->row()->s_contact_2;
            $returnStr['s_phone_1'] = $secretCode->row()->s_phone_1;
            $returnStr['s_phone_2'] = $secretCode->row()->s_phone_2;
            $returnStr['s_fax'] = $secretCode->row()->s_fax;
            $returnStr['s_price'] = $secretCode->row()->s_price;
        }
        echo json_encode($returnStr);
    }

    function Get_manager_value() {
        $memail = $this->input->post('memail');
        $secretCode = $this->product_model->get_all_details(MANAGER_INFO, array('m_email' => $memail));
        if ($secretCode->num_rows() == 1) {
            $returnStr['m_name'] = $secretCode->row()->m_name;
            $returnStr['m_address'] = $secretCode->row()->m_address;
            $returnStr['m_city'] = $secretCode->row()->m_city;
            $returnStr['m_state'] = $secretCode->row()->m_state;
            $returnStr['m_zipcode'] = $secretCode->row()->m_zipcode;
            $returnStr['m_contact_1'] = $secretCode->row()->m_contact_1;
            $returnStr['m_contact_2'] = $secretCode->row()->m_contact_2;
            $returnStr['m_phone_1'] = $secretCode->row()->m_phone_1;
            $returnStr['m_phone_2'] = $secretCode->row()->m_phone_2;
            $returnStr['m_fax'] = $secretCode->row()->m_fax;
            $returnStr['m_tenant_name'] = $secretCode->row()->m_tenant_name;
            $returnStr['m_lease_term'] = $secretCode->row()->m_lease_term;
            $returnStr['m_section'] = $secretCode->row()->m_section;
            $returnStr['m_fee'] = $secretCode->row()->m_fee;
        }
        echo json_encode($returnStr);
    }

    public function download_images() {
        $propertyId = $this->uri->segment(4);

        $sortArr1 = array('field' => 'imgPriority', 'type' => 'ASC');
        $product_image = $this->product_model->get_all_details_product(PRODUCT_PHOTOS, array('property_id' => $propertyId), $sortArr1);

        mkdir('zip-image/' . $propertyId, 0777);

        foreach ($product_image->result() as $ProImag) {
            $name = $ProImag->product_image;
            @copy('./images/product/' . $ProImag->product_image, './zip-image/' . $propertyId . '/' . $ProImag->product_image);
        }

        exec("zip -r zip-image/ror-images-" . $propertyId . ".zip zip-image/" . $propertyId . "/");

        foreach ($product_image->result() as $ProImag) {
            @unlink('zip-image/' . $propertyId . '/' . $ProImag->product_image);
        }

        if (rmdir('zip-image/' . $propertyId)) {
            //echo "deleted";die;   
        }

        redirect('zip-image/ror-images-' . $propertyId . '.zip');
        exit();
        /*
          $this->load->library('zip');
          $data = file_get_contents(base_url().'images/product/'.$ProImag->product_image);
          $this->zip->add_data($name, $data);
          $this->zip->download('ror-images-'.$propertyId.'.zip'); */
    }

    function loadmoreImages() {
        //echo '<pre>'; print_r($_POST);die;

        $limit = 10;
        $start = ($this->input->post('PgId') * 10);

        $this->db->select('*');
        $this->db->from(PRODUCT_PHOTOS);
        $this->db->where('property_id = ' . $this->input->post('PrdId'));
        $this->db->order_by("imgPriority", "ASC");
        $this->db->limit($limit, $start);
        $prdImg = $this->db->get();

        //echo '<pre>'; print_r($prdImg->result());die;
        $trImg = '';
        foreach ($prdImg->result() as $ProImag) {

            $trImg.= '<tr id="img_' . $ProImag->id . '">
                <td class="center tr_select "><input type="text" name="imgtitle[]"  onChange="javascript:ChangeImagetitle(this,' . $ProImag->id . ');" value="' . $ProImag->imgtitle . '" /></td>
				<td class="center"><img src="' . base_url() . 'images/product/' . $ProImag->product_image . '"  width="200px" /></td>
				<td class="center"><div id="imgmsg_' . $ProImag->id . '"></div><span><input type="text" style="width: 15%;" name="changeorder[]" onChange="javascript:ChangeImagePriority(this,' . $ProImag->id . ');" value="' . $ProImag->imgPriority . '" size="3" /></span></td>
                <td class="center"><ul class="action_list" style="background:none;border-top:none;">
                 <li style="width:100%;"><a class="p_del tipTop" href="javascript:void(0)" onClick="DeletePictureProducts(' . $ProImag->id . ');" title="Delete this  image">Remove</a></li></ul></td>
                 </tr>';
        }
        echo $trImg;
    }

    public function image_resize_script() {
        $basePath = base_url();
        $imagPath = 'images/product/';
        $savepath = 'images/product/thumb/';
        $s = 1;
        if ($handle = opendir($imagPath)) {
            while (false !== ($fileName = readdir($handle))) {
                echo '<br>' . $s . '--' . $fileName;
                if (strlen($fileName) > 3 && $fileName != 'Thumbs.db') {
                    $newFiles = explode('.', $fileName);
                    @copy($imagPath . $fileName, $savepath . $fileName);
                    $target_file = 'images/product/' . $fileName;
                    list($w, $h) = getimagesize($target_file);
                    $option = $this->getImageShape($w, $h, $target_file);
                    $resizeObj = new Resizeimage($target_file);
                    $resizeObj->resizeImage(250, 162, $option);
                    $resizeObj->saveImage('images/product/thumb/' . $fileName, 100);
                    $this->ImageCompress($imagPath . $fileName, $imagPath . $fileName);
                    $this->ImageCompress($savepath . $fileName, $savepath . $fileName);
                    $s++;
                }
            }
            closedir($handle);
        }
    }

}

/* End of file product.php */
/* Location: ./application/controllers/admin/product.php */
