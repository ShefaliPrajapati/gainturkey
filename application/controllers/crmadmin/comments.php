<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Tax management 
 * @author Teamtweaks
 *
 */

class Comments extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model');
		if ($this->checkPrivileges('product',$this->privStatus) == FALSE){
			redirect('deals_crm');
		}
    }
    
    /**
     * 
     * This function loads the Tax list page
     */
   	public function index(){	
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			redirect('crmadmin/product/view_product_comments');
		}
	}
	
	/**
	 * 
	 * This function loads the Tax list page
	 */
	public function view_product_comments(){
	
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			//$product_id = $this->uri->segment(4,0);
			$this->data['heading'] = 'Product Comments List';
			//$condition = array('product_id' => $product_id);
			$condition = array();
			//$this->data['commentsList'] = $this->product_model->get_all_details(PRODUCT_COMMENTS,$condition);
			$this->data['commentsList'] = $this->product_model->view_product_comments_details(' order by p.created desc');
			$this->load->view('crmadmin/product/display_product_comments_list',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the Tax list page
	 */
	public function display_tax_statelist(){ 
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'State Tax List';
			$statetax_id = $this->uri->segment(4,0);
			$condition = array('country_id' => $statetax_id);
			$this->data['taxList'] = $this->product_model->get_all_details(STATE_TAX,$condition);
			$this->load->view('crmadmin/tax/display_tax',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function loads the add new Tax form
	 */
	public function add_tax_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Add New Tax';
			$this->data['countryDisplay'] = $this->product_model->SelectAllCountry();
			$this->load->view('crmadmin/tax/add_tax',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a Tax
	 */
	public function insertEditTax(){
	
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$tax_id = $this->input->post('tax_id');
			$tax_name = $this->input->post('state_name');
			$seourl = url_title($tax_name, '-', TRUE);
			$GetCountry = array('id' => $this->input->post('country_id'));
			$GetCountryDetails = $this->product_model->get_all_details(LOCATION,$GetCountry);
			$inputArr = array('seourl'=>$seourl,'country_name' => $GetCountryDetails->row()->location_name,'country_code' => $GetCountryDetails->row()->iso_code2);
			if ($tax_id == ''){
				$condition = array('state_name' => $tax_name);
				$duplicate_name = $this->product_model->get_all_details(STATE_TAX,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','Tax name already exists');
					redirect('crmadmin/tax/add_tax_form');
				}
			}
			$excludeArr = array("tax_id","status");
			
			if ($this->input->post('status') != ''){
				$tax_status = 'Active';
			}else {
				$tax_status = 'InActive';
			}
			$tax_data=array();
			$inputArr['status']= $tax_status;
			$datestring = "%Y-%m-%d %H:%M:%S";
			$time = time();
			if ($tax_id == ''){
				$tax_data = array(
					'dateAdded'	=>	mdate($datestring,$time),
				);
			}
			$dataArr = array_merge($inputArr,$tax_data);
			$condition = array('id' => $tax_id);
			if ($tax_id == ''){
				$this->product_model->commonInsertUpdate(STATE_TAX,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Tax added successfully');
			}else {
				$this->product_model->commonInsertUpdate(STATE_TAX,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Tax updated successfully');
			}
			redirect('crmadmin/tax/display_tax_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit Tax form
	 */
	public function edit_tax_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Edit Tax';
			$tax_id = $this->uri->segment(4,0);
			$condition = array('id' => $tax_id);
			$this->data['countryDisplay'] = $this->product_model->SelectAllCountry();
			$this->data['tax_details'] = $this->product_model->get_all_details(STATE_TAX,$condition);
			if ($this->data['tax_details']->num_rows() == 1){
				$this->load->view('crmadmin/tax/edit_tax',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function change the Tax status
	 */
	public function change_product_comment_status(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$product_id = $this->uri->segment(6,0);
			$status = ($mode == '0')?'InActive':'Active';
			if($status=='Active'){
				$this->product_model->Update_Product_Comment_Count_Reduce($product_id);
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$createdTime = mdate($datestring,$time);
				$actArr = array(
					'activity'		=>	'comment',
					'activity_id'	=>	$product_id,
					'user_id'		=>	$this->uri->segment(7,0),
					'activity_ip'	=>	$this->input->ip_address(),
					'comment_id'	=>	$this->uri->segment(5,0),
					'created'		=>	$createdTime
				);
				$this->product_model->simple_insert(NOTIFICATIONS,$actArr);
			}else{
			$this->product_model->Update_Product_Comment_Count($product_id);
			
			}
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->product_model->update_details(PRODUCT_COMMENTS,$newdata,$condition);
			$this->send_comment_noty_mail($product_id,$this->uri->segment(5,0));
			$this->setErrorMessage('success','Comment Status Changed Successfully');
			redirect('crmadmin/comments/view_product_comments');
		}
	}
	
	public function send_comment_noty_mail($pid='0',$cid='0'){
		if ($pid!= '0' && $cid != '0'){
			$likeUserList = $this->product_model->get_like_user_full_details($pid);
			if ($likeUserList->num_rows()>0){
				$productUserDetails = $this->product_model->get_product_full_details($pid);
				$commentDetails = $this->product_model->view_product_comments_details('where c.id='.$cid);
				if ($productUserDetails->num_rows()>0 && $commentDetails->num_rows()==1){
					foreach ($likeUserList->result() as $likeUserListRow){
						$emailNoty = explode(',', $likeUserListRow->email_notifications);
						if (in_array('comments_on_fancyd', $emailNoty)){
							if ($productUserDetails->prodmode == 'seller'){
								$prodLink = base_url().'things/'.$productUserDetails->row()->id.'/'.url_title($productUserDetails->row()->product_name,'-');
							}else {
								$prodLink = base_url().'user/'.$productUserDetails->row()->user_name.'/things/'.$productUserDetails->row()->seller_product_id.'/'.url_title($productUserDetails->row()->product_name,'-');
							}
							$newsid='8';
                            $template_values=$this->product_model->get_newsletter_template_details($newsid);
                            $subject = 'From: '.$template_values['news_title'].' - '.$template_values['news_subject'];

                            $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title>
			<body>'.$template_values['news_descrip'].'</body>
			</html>';

                            if ($template_values['sender_name'] == '' && $template_values['sender_email'] == '') {
                                $sender_email = $this->data['siteContactMail'];
                                $sender_name = $this->data['siteTitle'];
                            } else {
                                $sender_name = $template_values['sender_name'];
                                $sender_email = $template_values['sender_email'];
                            }

                            $message = str_replace('{$full_name}', $likeUserListRow->full_name, $message);
                            $message = str_replace('{$cfull_name}', $commentDetails->row()->full_name, $message);
                            $message = str_replace('{$user_name}', $commentDetails->row()->user_name, $message);
                            $message = str_replace('{$prodLink}', $prodLink, $message);
                            $message = str_replace('{$product_name}', $productUserDetails->row()->product_name, $message);
                            $message = str_replace('{$email_title}', $sender_name, $message);
                            $message = str_replace('{$meta_title}', $sender_name, $message);
                            $message = str_replace('{base_url()}images/logo/{$logo}', $this->data['logo'], $message);

                            $email_values = array('mail_type'=>'html',
                                'from_mail_id'=>$sender_email,
                                'mail_name'=>$sender_name,
                                'to_mail_id'=>$likeUserListRow->email,
                                'subject_message'=>$subject,
                                'body_messages'=>$message
                            );

							$email_send_to_common = $this->product_model->common_email_send($email_values);
						}
					}
				}
			}
		}
	}
	
	/**
	 * 
	 * This function loads the Tax view page
	 */
	public function view_product_comment(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'View Comments';
			$tax_id = $this->uri->segment(4,0);
			$condition = array('id' => $tax_id);
			//$this->data['tax_details'] = $this->product_model->get_all_details(PRODUCT_COMMENTS,$condition);
			$this->data['tax_details'] = $this->product_model->view_product_comments_details('where c.id ='.$tax_id.' order by p.created desc');
			if ($this->data['tax_details']->num_rows() == 1){
				$this->load->view('crmadmin/product/view_comments',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the Tax record from db
	 */
	public function delete_product_comment(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$tax_id = $this->uri->segment(4,0);
			$product_id = $this->uri->segment(5,0);$statusVal = $this->uri->segment(6,0);
			$condition = array('id' => $tax_id);
			if($statusVal=='Active'){
			$this->product_model->Update_Product_Comment_Count_Reduce($product_id);
			}
			$this->product_model->commonDelete(PRODUCT_COMMENTS,$condition);
			$this->setErrorMessage('success','Comment deleted successfully');
			redirect('crmadmin/comments/view_product_comments');
		}
	}
	
	/**
	 * 
	 * This function change the Tax status, delete the Tax record
	 */
	public function change_product_comment_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->product_model->activeInactiveCommon(PRODUCT_COMMENTS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Comments deleted successfully');
			}else {
				$this->setErrorMessage('success','Comments status changed successfully');
			}
			redirect('crmadmin/comments/view_product_comments');
		}
	}
}

/* End of file Tax.php */
/* Tax: ./application/controllers/crmadmin/Tax.php */
