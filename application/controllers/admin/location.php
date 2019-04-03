<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Location extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('location_model');
		if ($this->checkPrivileges('location',$this->privStatus) == FALSE){
			redirect('admin_ror');
		}
    }
    
    /**
     *
     * This function loads the location list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			redirect('admin/location/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the location list page
	 */
	public function display_location_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Location List';
			$condition = array();
			$this->data['locationList'] = $this->location_model->get_all_details(COUNTRY_LIST,$condition);
			$this->load->view('admin/location/display_location',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the Country list page
	 */
	public function display_country_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Country List';
			$condition = array();
			//$sortArr1 = array('field'=>'name','type'=>'asc');
			//$sortArr = array($sortArr1);
			$this->data['countryList'] = $this->location_model->get_all_details(LOCATIONS,$condition);
			$this->load->view('admin/location/display_country',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the location dashboard
	 */
	public function display_user_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Location Dashboard';
			$condition = 'order by `created` desc';
			$this->data['locationList'] = $this->user_model->get_location_details($condition);
			$this->load->view('admin/location/display_location_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new location form
	 */
	public function add_location_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Add New Location';
			$this->load->view('admin/location/add_location',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditLocation(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$location_id = $this->input->post('location_id');
			$location_name = $this->input->post('name');
			$seourl = url_title($location_name, '-', TRUE);
			if ($location_id == ''){
				$condition = array('name' => $name);
				$duplicate_name = $this->location_model->get_all_details(COUNTRY_LIST,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','Location name already exists');
					redirect('admin/location/add_location_form');
				}
			}
			$excludeArr = array("location_id","status","currency_default","currency_symbol","logo","thumb");
			
			if ($this->input->post('status') != ''){
				$location_status = 'Active';
			}else {
				$location_status = 'InActive';
			}
			
			if ($this->input->post('currency_default') != ''){
				$curency_default = 'Yes';
			}else {
				$curency_default = 'No';
			}
			
			$this->load->helper('text');
			$inputArr = array('status' => $location_status,'seourl'=>$seourl,'currency_default'=>$curency_default,'currency_symbol'=>$this->input->post('currency_symbol'));
			$location_data = array();	
				$config['overwrite'] = FALSE;
		    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
			    $config['max_size'] = 2000;
			    $config['upload_path'] = './images/location';
			    $this->load->library('upload', $config);
				if ( $this->upload->do_upload('logo')){
			    	$logoDetails = $this->upload->data();
					$logoDetails['file_name'];
			    	$inputArr['logo'] = $logoDetails['file_name'];
				}
				if ( $this->upload->do_upload('thumb')){
					$feviconDetails = $this->upload->data();
			    	$inputArr['thumb'] = $feviconDetails['file_name'];
				}
			
			$dataArr = array_merge($inputArr,$location_data);
			$condition = array('id' => $location_id);
			if ($location_id == ''){
				$this->location_model->commonInsertUpdate(COUNTRY_LIST,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Country added successfully');
			}else {
				//echo $curency_default;die;
				
				if($curency_default=='Yes'){
				//echo '<pre>';print_r($dataArr);die;
					$dataArr1=array('currency_default'=>'No');
					$this->location_model->update_details(COUNTRY_LIST,$dataArr1,array());
					//$conditionArr=array('id'=>$location_id);
					//$this->location_model->update_details(COUNTRY_LIST,$dataArr1,$conditionArr);
				}
				
//				$this->location_model->updateCurrencyDetails($excludeArr,$dataArr,$condition);
				$this->location_model->commonInsertUpdate(COUNTRY_LIST,'update',$excludeArr,$dataArr,$condition);
				$this->location_model->saveCurrencySettings();
				$this->setErrorMessage('success','Country updated successfully');
			}
			redirect('admin/location/display_location_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_location_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Edit Location';
			$location_id = $this->uri->segment(4,0);
			$condition = array('id' => $location_id);
			$this->data['location_details'] = $this->location_model->get_all_details(COUNTRY_LIST,$condition);
			if ($this->data['location_details']->num_rows() == 1){
				$this->load->view('admin/location/edit_location',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_location_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->location_model->update_details(COUNTRY_LIST,$newdata,$condition);
			$this->setErrorMessage('success','Location Status Changed Successfully');
			redirect('admin/location/display_location_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_location(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'View Location';
			$location_id = $this->uri->segment(4,0);
			$condition = array('id' => $location_id);
			$this->data['location_details'] = $this->location_model->get_all_details(COUNTRY_LIST,$condition);
			if ($this->data['location_details']->num_rows() == 1){
				$this->load->view('admin/location/view_location',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_location(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$location_id = $this->uri->segment(4,0);
			$condition = array('id' => $location_id);
			$this->location_model->commonDelete(LOCATIONS,$condition);
			$this->setErrorMessage('success','Location deleted successfully');
			redirect('admin/location/display_location_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_user_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->user_model->activeInactiveCommon(LOCATIONS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','User records deleted successfully');
			}else {
				$this->setErrorMessage('success','User records status changed successfully');
			}
			redirect('admin/location/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the Tax list page
	 */
	public function display_tax_statelist(){ 
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'State List';
			$statetax_id = $this->uri->segment(4,0);
			$condition = array('countryid' => $statetax_id);
			$condition1 = array('id' => $statetax_id);
			$this->data['CountryList'] = $this->location_model->get_all_details(COUNTRY_LIST,$condition1);
			$this->data['taxList'] = $this->location_model->get_all_details(STATE_TAX,$condition);
			$this->load->view('admin/location/display_tax',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new Tax form
	 */
	public function add_tax_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Add New State';
			$this->data['countryDisplay'] = $this->location_model->SelectAllCountry();
			$this->load->view('admin/location/add_tax',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a Tax
	 */
	public function insertEditTax(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$tax_id = $this->input->post('tax_id');
			$tax_name = $this->input->post('name');
			$seourl = url_title($tax_name, '-', TRUE);
			$GetCountry = array('id' => $this->input->post('country_id'));
			$GetCountryDetails = $this->location_model->get_all_details(COUNTRY_LIST,$GetCountry);
			$inputArr = array('seourl'=>$seourl);
			if ($tax_id == ''){
				$condition = array('name' => $tax_name);
				$duplicate_name = $this->location_model->get_all_details(STATE_TAX,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','State name already exists');
					redirect('admin/location/add_tax_form');
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
			
			$config['overwrite'] = FALSE;
		    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
			    $config['max_size'] = 2000;
			    $config['upload_path'] = './images/state';
			    $this->load->library('upload', $config);
				if ( $this->upload->do_upload('statelogo')){
			    	$logoDetails = $this->upload->data();
					$logoDetails['file_name'];
			    	$inputArr['statelogo'] = $logoDetails['file_name'];
				}
				if ( $this->upload->do_upload('statethumb')){
					$feviconDetails = $this->upload->data();
			    	$inputArr['statethumb'] = $feviconDetails['file_name'];
				}
		
			
			$dataArr = array_merge($inputArr,$tax_data);
			$condition = array('id' => $tax_id);
			if ($tax_id == ''){
				$this->location_model->commonInsertUpdate(STATE_TAX,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','State added successfully');
			}else {
				$this->location_model->commonInsertUpdate(STATE_TAX,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','State updated successfully');
			}
			//redirect('admin/location/display_tax_list');
			echo "<script>window.history.go(-2)</script>";exit();
		}
	}
	
	/**
	 * 
	 * This function loads the edit Tax form
	 */
	public function edit_tax_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Edit State';
			$tax_id = $this->uri->segment(4,0);
			$condition = array('id' => $tax_id);
			$this->data['countryDisplay'] = $this->location_model->SelectAllCountry();
			$this->data['tax_details'] = $this->location_model->get_all_details(STATE_TAX,$condition);
			if ($this->data['tax_details']->num_rows() == 1){
				$this->load->view('admin/location/edit_tax',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
		
	
	/**
	 * 
	 * This function change the Tax status
	 */
	public function change_tax_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->location_model->update_details(STATE_TAX,$newdata,$condition);
			$this->setErrorMessage('success','State Status Changed Successfully');
			//redirect('admin/location/display_tax_list');
			echo "<script>window.history.go(-1)</script>";exit();
		}
	}
	
	/**
	 * 
	 * This function loads the Tax view page
	 */
	public function view_tax(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'View State';
			$tax_id = $this->uri->segment(4,0);
			$condition = array('id' => $tax_id);
			
			$this->data['tax_details'] = $this->location_model->get_all_details(STATE_TAX,$condition);
			$condition1 = array('id' => $this->data['tax_details']->row()->countryid);
			$this->data['CountryList'] = $this->location_model->get_all_details(COUNTRY_LIST,$condition1);
			if ($this->data['tax_details']->num_rows() == 1){
				$this->load->view('admin/location/view_tax',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function loads the Tax list page
	 */
	public function display_tax_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'State List';
			$condition = array();
			$this->data['taxList'] = $this->location_model->get_all_details(STATE_TAX,$condition);
			$this->load->view('admin/location/display_tax',$this->data);
		}
	}
	
	/**
	 * 
	 * This function delete the Tax record from db
	 */
	public function delete_tax(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$tax_id = $this->uri->segment(4,0);
			$condition = array('id' => $tax_id);
			$this->location_model->commonDelete(STATE_TAX,$condition);
			$this->setErrorMessage('success','State deleted successfully');
			//redirect('admin/location/display_tax_list');
			echo "<script>window.history.go(-1)</script>";exit();
		}
	}
	
	
	
}

/* End of file location.php */
/* Location: ./application/controllers/admin/location.php */
