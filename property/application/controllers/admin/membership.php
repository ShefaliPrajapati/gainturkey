<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * 
 * This controller contains the functions related to membership subscriptions
 * @author Teamtweaks
 *
 */ 

class Membership extends MY_Controller {

	function __construct(){
	//echo 'dsfgd';die;
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model');
		$this->load->model('membership_model');
		if ($this->checkPrivileges('product',$this->privStatus) == FALSE){
			redirect('admin_ror');
		}
    }
    
    /**
     * 
     * This function loads the membership page
     */
   	public function index(){	

		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			redirect('admin/membership/display_membership');
		}
	}
	
	
	/**
	 * 
	 * This function loads the fancybox dashboard
	 */
	public function display_membership_dashboard(){

		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Membership Dashboard';
			$condition = 'order by `created` desc';
			//$this->data['MembershipList'] = $this->membership_model->get_fancybox_details($condition);
			$this->data['MembershipCount'] = $this->membership_model->get_subscription_count();
			$this->data['MembershipList'] = $this->membership_model->get_subscription_details();			
			//echo '<pre>';print_r($this->data['MembershipList']->result());die;
			$this->load->view('admin/membership/display_membership_dashboard',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the membership List
	 */
	public function membership_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Membership Subscribed List';
			$this->data['MembershipList'] = $this->membership_model->get_subscription_list_details();	
			$this->load->view('admin/membership/membership_llist',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the membership page
	 */
	public function display_membership(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Membership';
			$sortArr1 = array('field'=>'created','type'=>'desc');
			$sortArr = array($sortArr1);
			$this->data['productList'] = $this->product_model->get_all_details(FANCYYBOX,array(),$sortArr);

	//		echo "<pre>";print_r($this->data['productList']->result());die;
			$this->load->view('admin/membership/display_membership',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new membership form
	 */
	public function add_membership_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Add New Membership';
			$this->data['categoryView'] = $this->product_model->view_category_details();
			$this->load->view('admin/membership/add_membership',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit fancyy
	 */
	 public function insertEditProduct(){
	 if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$product_name = $this->input->post('name');
			$product_id = $this->input->post('productID');
			$product_data=array();
			if ($product_id == ''){
				$condition = array('name' => $product_name);
			}else {
				$condition = array('name' => $product_name,'id !=' => $product_id);
			}
			$duplicate_name = $this->product_model->get_all_details(FANCYYBOX,$condition);
			
			if ($duplicate_name->num_rows() > 0){
				$this->setErrorMessage('error','Name already exists');
				echo "<script>window.history.go(-1)</script>";exit();
			}
			
			$excludeArr = array("gateway_tbl_length","imaged","productID","changeorder","status","category_id","attribute_name","attribute_val","attribute_weight","attribute_price","product_image","userID","free_date","valide","price_range","price");
			
			if ($this->input->post('status') != ''){
				$product_status = 'Publish';
			}else {
				$product_status = 'UnPublish';
			}
			
			$seourl = url_title($product_name, '-', TRUE);
			
			
			
			if($this->input->post('valide')=='valide'){
			$valideType='Valid';
			$priceVal=$this->input->post('price');
			
			}else{
			$valideType='Free';
			$priceVal='0.00';
			}
			
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			if ($product_id == ''){
				$inputArr = array(
							'seourl' => $seourl,
							'price' =>$priceVal,
							'option_type' => $valideType,
							'status' => $product_status
							
				);
			}else {
				$inputArr = array(
							'modified' => mdate($datestring,$time),
							'price' =>$priceVal,
							'option_type' => $valideType,
							'seourl' => $seourl,
							'status' => $product_status
							
				);
			}
			
			
			$dataArr = array_merge($inputArr,$product_data);
			if ($product_id == ''){
				$condition = array();
				$this->product_model->commonInsertUpdate(FANCYYBOX,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Membership added successfully');
				$product_id = $this->product_model->get_last_insert_id();
//				$this->update_price_range_in_table('add',$price_range,$product_id,$old_product_details);
			}else {
				$condition = array('id'=>$product_id);
				$this->product_model->commonInsertUpdate(FANCYYBOX,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Membership updated successfully');
//				$this->update_price_range_in_table('edit',$price_range,$product_id,$old_product_details);
			}
			
			redirect('admin/membership/display_membership');
		
		}
	 
	 }
	 
	 
	public function insertEditProduct1(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$product_name = $this->input->post('name');
			$product_id = $this->input->post('productID');
			if ($product_name == ''){
				$this->setErrorMessage('error','Name required');
				echo "<script>window.history.go(-1)</script>";exit();
			}
			/*$price = $this->input->post('price');
			if ($price == ''){
				$this->setErrorMessage('error','Price required');
				echo "<script>window.history.go(-1)</script>";exit();
			}else if ($price <= 0){
				$this->setErrorMessage('error','Price must be greater than zero');
				echo "<script>window.history.go(-1)</script>";exit();
			}*/
			if ($product_id == ''){
				$condition = array('name' => $product_name);
			}else {
				$condition = array('name' => $product_name,'id !=' => $product_id);
			}
			$duplicate_name = $this->product_model->get_all_details(FANCYYBOX,$condition);
			if ($duplicate_name->num_rows() > 0){
				$this->setErrorMessage('error','Name already exists');
				echo "<script>window.history.go(-1)</script>";exit();
			}
			$price_range = '';
			if ($price>0 && $price<21){
				$price_range = '1-20';
			}else if ($price>20 && $price<101){
				$price_range = '21-100';
			}else if ($price>100 && $price<201){
				$price_range = '101-200';
			}else if ($price>200 && $price<501){
				$price_range = '201-500';
			}else if ($price>500){
				$price_range = '501+';
			}
			$excludeArr = array("gateway_tbl_length","imaged","productID","changeorder","status","category_id","attribute_name","attribute_val","attribute_weight","attribute_price","product_image","userID");
			
			if ($this->input->post('status') != ''){
				$product_status = 'Publish';
			}else {
				$product_status = 'UnPublish';
			}
			
			$seourl = url_title($product_name, '-', TRUE);
			if ($this->input->post('category_id') != ''){
				$category_id = implode(',', $this->input->post('category_id'));
			}else {
				$category_id = '';
			}
			$ImageName = '';
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			if ($product_id == ''){
				$inputArr = array(
							'seourl' => $seourl,
							'category_id' => $category_id,
							'status' => $product_status,
							'price_range'=> $price_range
				);
			}else {
				$inputArr = array(
							'modified' => mdate($datestring,$time),
							'seourl' => $seourl,
							'category_id' => $category_id,
							'status' => $product_status,
							'price_range'=> $price_range
				);
			}
			$config['overwrite'] = FALSE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
		    $config['max_size'] = 2000;
	    	$config['upload_path'] = './images/fancyybox';
		    $this->load->library('upload', $config);
		    if ( $this->upload->do_multi_upload('product_image')){
		    	$logoDetails = $this->upload->get_multi_upload_data();
			    foreach ($logoDetails as $fileDetails){
		    		$ImageName .= $fileDetails['file_name'].',';
		    	}
			}
			if ($product_id == ''){
				$product_data = array( 'image' => $ImageName);	
			}else {
				$existingImage = $this->input->post('imaged');
			 
				$newPOsitionArr = $this->input->post('changeorder');
				$imagePOsit = array();
				 
				for($p=0;$p<sizeof($existingImage);$p++) {
					$imagePOsit[$newPOsitionArr[$p]] = $existingImage[$p];
				}
		
				ksort($imagePOsit);
				foreach ($imagePOsit as $keysss => $vald) {
				 $imgArraypos[]=$vald;
				}
				$imagArraypo0 = @implode(",",$imgArraypos);
				$allImages = $imagArraypo0.','.$ImageName;
				
				$product_data = array( 'image' => $allImages);
			}
			$dataArr = array_merge($inputArr,$product_data);
			if ($product_id == ''){
				$condition = array();
				$this->product_model->commonInsertUpdate(FANCYYBOX,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Membership added successfully');
				$product_id = $this->product_model->get_last_insert_id();
//				$this->update_price_range_in_table('add',$price_range,$product_id,$old_product_details);
			}else {
				$condition = array('id'=>$product_id);
				$this->product_model->commonInsertUpdate(FANCYYBOX,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Membership updated successfully');
//				$this->update_price_range_in_table('edit',$price_range,$product_id,$old_product_details);
			}
			
			redirect('admin/membership/display_membership');
		}
	}
	
	
	
	/**
	 * 
	 * Ajax function for delete the product pictures
	 */
	public function editPictureProducts(){
		$ingIDD = $this->input->post('imgId');
		$currentPage = $this->input->post('cpage');
		$id = $this->input->post('val');
		$productImage = explode(',',$this->session->userdata('product_image_'.$ingIDD));
		if(count($productImage) < 2) {
			echo json_encode("No");exit();
		} else {
			$empImg = 0;
			foreach ($productImage as $product) {
				if ($product != ''){
					$empImg++;
				}
			}
			if ($empImg<2){
				echo json_encode("No");exit();
			}
			$this->session->unset_userdata('product_image_'.$ingIDD);
			$resultVar = $this->setPictureProducts($productImage,$this->input->post('position'));
			$insertArrayItems = trim(implode(',',$resultVar)); //need validation here...because the array key changed here
			
			$this->session->set_userdata(array('product_image_'.$ingIDD => $insertArrayItems));	
			$dataArr = array('image' => $insertArrayItems);
			$condition = array('id' => $ingIDD);
			$this->product_model->update_details(PRODUCT,$dataArr,$condition);
			echo json_encode($insertArrayItems);
		}
	}
	
	/**
	 * 
	 * This function loads the edit product form
	 */
	public function edit_membership_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Edit Membership';
			$product_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_id);
			$this->data['product_details'] = $this->product_model->get_all_details(FANCYYBOX,$condition);
			if ($this->data['product_details']->num_rows() == 1){
				$this->data['categoryView'] = $this->product_model->get_category_details($this->data['product_details']->row()->category_id);
				$this->load->view('admin/membership/edit_product',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function change the membership status
	 */
	public function change_product_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$mode = $this->uri->segment(4,0);
			$product_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'UnPublish':'Publish';
			$newdata = array('status' => $status);
			$condition = array('id' => $product_id);
			$this->product_model->update_details(FANCYYBOX,$newdata,$condition);
			$this->setErrorMessage('success','Membership Status Changed Successfully');
			redirect('admin/membership/display_membership');
		}
	}
	
	/**
	 * 
	 * This function loads the membership view page
	 */
	public function view_membership(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'View Membership';
			$product_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_id);
			$this->data['product_details'] = $product_details = $this->product_model->get_all_details(FANCYYBOX,$condition);
			if ($this->data['product_details']->num_rows() == 1){
				$this->data['catList'] = $this->product_model->get_cat_list($product_details->row()->category_id);
				$this->load->view('admin/membership/view_product',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the product record from db
	 */
	public function delete_product(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$product_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_id);
			$old_product_details = $this->product_model->get_all_details(FANCYYBOX,array('id'=>$product_id));
			$this->product_model->commonDelete(FANCYYBOX,$condition);
			$this->setErrorMessage('success','Membership deleted successfully');
			redirect('admin/membership/display_membership');
		}
	}
	
	public function update_user_product_count($old_product_details){
		if (is_array($old_product_details) && count($old_product_details)>0 && $old_product_details->num_rows==1){		
			if ($old_product_details->row()->user_id > 0){
				$user_details = $this->product_model->get_all_details(USERS,array('id'=>$old_product_details->row()->user_id));
				if ($user_details->num_rows()==1){
					$prod_count = $user_details->row()->products;
					$prod_count--;
					if ($prod_count<0){
						$prod_count = 0;
					}
					$this->product_model->update_details(USERS,array('products'=>$prod_count),array('id'=>$old_product_details->row()->user_id));
				}
			}
		}
	}
	
	/**
	 * 
	 * This function change the product status, delete the product record
	 */
	public function change_product_status_global(){
	
			if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
				$this->product_model->activeInactiveCommon(FANCYYBOX,'id');
				if (strtolower($_POST['statusMode']) == 'delete'){
					$this->setErrorMessage('success','Membership records deleted successfully');
				}else {
					$this->setErrorMessage('success','Membership records status changed successfully');
				}
				redirect('admin/membership/display_membership');
			}
	}
	
	public function loadListValues(){
		$returnStr['listCnt'] = '<option value="">--Select--</option>';
		$lid = $this->input->post('lid');
		$lvID = $this->input->post('lvID');
		if ($lid != ''){
			$listValues = $this->product_model->get_all_details(LIST_VALUES,array('list_id'=>$lid));
			if ($listValues->num_rows()>0){
				foreach ($listValues->result() as $listRow){
					$selStr = '';
					if ($listRow->id == $lvID){
						$selStr = 'selected="selected"';
					}
					$returnStr['listCnt'] .= '<option '.$selStr.' value="'.$listRow->id.'">'.$listRow->list_value.'</option>';
				}
			}
		}
		echo json_encode($returnStr);
	}
}

/* End of file membership.php */
/* Location: ./application/controllers/admin/membership.php */