<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**  
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Manager extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('manager_model');
		if ($this->checkPrivileges('manager',$this->privStatus) == FALSE){
			redirect('admin_ror');
		}
    }
    
    /**
     * 
     * This function loads the users list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			redirect('admin/manager/display_manager_list');
		}
	}
	
	/**
	 * 
	 * This function loads the users list page
	 */
	public function display_manager_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Manager List';
			$condition = array();
			$this->data['managerList'] = $this->manager_model->get_all_details(MANAGER_INFO,$condition);
			$this->load->view('admin/manager/display_manager',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new user form
	 */
	public function add_manager_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Add New Manager';
			$this->load->view('admin/manager/add_manager',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditManager(){ //echo "problem"; die;
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			
			//echo '<pre>'; print_r($_POST); die;
				
			$manager_id = $this->input->post('manager_id');
			
			$excludeArr = array("manager_id","status");
			
			if ($this->input->post('status') != ''){
				$manager_status = 'Active';
			}else {
				$manager_status = 'Inactive';
			}
			$inputArr = array('status' => $manager_status);
			
			$condition = array('id' => $manager_id);
			if ($manager_id == ''){
				$this->manager_model->commonInsertUpdate(MANAGER_INFO,'insert',$excludeArr,$inputArr,$condition);
				$this->setErrorMessage('success','Manager info added successfully');
			}else {
			
			
				$this->manager_model->commonInsertUpdate(MANAGER_INFO,'update',$excludeArr,$inputArr,$condition);
				$this->setErrorMessage('success','Manager info updated successfully');
			}
			redirect('admin/manager/display_manager_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_manager_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Edit Manager';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['manager_details'] = $this->manager_model->get_all_details(MANAGER_INFO,$condition);
			if ($this->data['manager_details']->num_rows() == 1){
				$this->load->view('admin/manager/edit_manager',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_manager_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->manager_model->update_details(MANAGER_INFO,$newdata,$condition);
			$this->setErrorMessage('success','Manager Status Changed Successfully');
			redirect('admin/manager/display_manager_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_manager(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'View Manager';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['manager_details'] = $this->manager_model->get_all_details(MANAGER_INFO,$condition);
			if ($this->data['manager_details']->num_rows() == 1){
				$this->load->view('admin/manager/view_manager',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_manager(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->manager_model->commonDelete(MANAGER_INFO,$condition);
			$this->setErrorMessage('success','Manager deleted successfully');
			redirect('admin/manager/display_manager_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_manager_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->manager_model->activeInactiveCommon(MANAGER_INFO,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Manager deleted successfully');
			}else {
				$this->setErrorMessage('success','Manager status changed successfully');
			}
			redirect('admin/manager/display_manager_list');
		}
	}
	
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	function Get_Manager_Check()
		{
			$semail = $this->input->post('semail');
			$secretCode = $this->manager_model->get_all_details(MANAGER_INFO,array('m_email' => $semail));
			echo $secretCode->num_rows();
		}
	
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */