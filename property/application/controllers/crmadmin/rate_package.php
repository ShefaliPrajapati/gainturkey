<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */
//echo 'sdfsdf';die;
class Rate_package extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model');
		if ($this->checkPrivileges('rate_package',$this->privStatus) == FALSE){
			redirect('deals_crm');
		}
    }
    
    /**
     * 
     * This function loads the package list page
     */
	 
   	public function index(){	
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			redirect('crmadmin/rate_package/display_user_list');
		}
	}

	/**
	 * 
	 * This function loads the package list page
	 */
	public function display_package_list(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Rental Rate Package List';
			$condition = array();
			$this->data['packageList'] = $this->product_model->get_all_details(PRODUCT_RATE_PACKAGE,$condition);
		
			$this->load->view('crmadmin/rate_package/display_package',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the package dashboard
	 */
	public function display_package_dashboard(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Rental Rate Package Dashboard';
			$condition = array();
			$grouppackage=array('c.renter_id');
			$grouporder=array('u.package_count'=>'DESC');
			
			$this->data['packageList'] = $this->product_model->get_packageAll_details($grouppackage,$grouporder);
			$grouppackage=array('c.rental_id');
			$grouporder=array('p.package_count'=>'DESC');
			$this->data['TopRentalList'] = $this->product_model->get_packageAll_details($grouppackage,$grouporder);
			
	
			
			
			$this->load->view('crmadmin/rate_package/display_package_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new package form
	 */
	public function add_package_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Add New Rental Rate Package';
			$this->load->view('crmadmin/rate_package/add_package',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditPackage(){
	
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$package_id = $this->input->post('id');
			$package_name = $this->input->post('name');
			$seourl = url_title($package_name, '-', TRUE);
			if ($package_id == ''){
				$condition = array('name' => $package_name);
				$duplicate_name = $this->product_model->get_all_details(PRODUCT_RATE_PACKAGE,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','Contact name already exists');
					redirect('crmadmin/rate_package/add_package_form');
				}
			}
			$excludeArr = array("package_id","status");
			
			if ($this->input->post('status') != ''){
				$package_status = 'Active';
			}else {
				$package_status = 'InActive';
			}
			$package_data=array();
			
			$inputArr = array('status' => $package_status);
			/*$datestring = "%Y-%m-%d %H:%M:%S";
			$time = time();
			if ($package_id == ''){
				$package_data = array(
					'dateAdded'	=>	mdate($datestring,$time),
				);
			}*/
			$dataArr = array_merge($inputArr,$package_data);
			$condition = array('id' => $package_id);
			if ($package_id == ''){
				$this->product_model->commonInsertUpdate(PRODUCT_RATE_PACKAGE,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Rental Rate Package added successfully');
			}else {
				/*if($package_status=='Active'){
				$dataArr1=array('status'=>'InActive');
				$conditionArr=array('id !='=>$package_id);
				$this->product_model-> update_details(PRODUCT_RATE_PACKAGE,$dataArr1,$conditionArr);
				}*/
				$this->product_model->commonInsertUpdate(PRODUCT_RATE_PACKAGE,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Rental Rate Package updated successfully');
			}
			redirect('crmadmin/rate_package/display_package_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_package_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Edit Rental Rate Package';
			$package_id = $this->uri->segment(4,0);
			$condition = array('id' => $package_id);
			$this->data['package_details'] = $this->product_model->get_all_details(PRODUCT_RATE_PACKAGE,$condition);
			if ($this->data['package_details']->num_rows() == 1){
				$this->load->view('crmadmin/rate_package/edit_package',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_package_status(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->product_model->update_details(PRODUCT_RATE_PACKAGE,$newdata,$condition);
			$this->setErrorMessage('success','Rental Rate Package Status Changed Successfully');
			redirect('crmadmin/rate_package/display_package_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_package(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'View Rental Rate Package';
			$package_id = $this->uri->segment(4,0);
			$condition = array('id' => $package_id);
			$this->data['package_details'] = $this->product_model->get_all_details(PRODUCT_RATE_PACKAGE,$condition);
			if ($this->data['package_details']->num_rows() == 1){
				$this->load->view('crmadmin/rate_package/view_package',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_package(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$package_id = $this->uri->segment(4,0);
			$condition = array('id' => $package_id);
			$this->product_model->commonDelete(PRODUCT_RATE_PACKAGE,$condition);
			$this->setErrorMessage('success','Rental Rate Package deleted successfully');
			redirect('crmadmin/rate_package/display_package_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_package_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->product_model->activeInactiveCommon(PRODUCT_RATE_PACKAGE,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Rental Rate Package records deleted successfully');
			}else {
				$this->setErrorMessage('success','Rental Rate Package records status changed successfully');
			}
			redirect('crmadmin/rate_package/display_package_list');
		}
	}
}

/* End of file package.php */
/* Rental Rate Package: ./application/controllers/crmadmin/rate_package.php */