<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**  
 * 
 * This controller contains the functions related to consultant management 
 * @author Teamtweaks
 *
 */

class Consultant extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('consultant_model');
		if ($this->checkPrivileges('consultant',$this->privStatus) == FALSE){
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
			redirect('admin/consultant/display_consultant_list');
		}
	}
	
	/**
	 * 
	 * This function loads the users list page
	 */
	public function display_consultant_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Initial List';
			$condition = array();
			$this->data['consultantList'] = $this->consultant_model->get_all_details(SEATING_INITIALS,$condition);
			$this->load->view('admin/consultant/display_consultantlist',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the users dashboard
	 */
	public function display_user_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Initial Dashboard';
			$condition = 'order by `created` desc';
			$this->data['usersList'] = $this->consultant_model->get_consultant_details($condition);
			$this->load->view('admin/consultant/display_consultant_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new user form
	 */
	public function add_consultant_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Add New Initial';
			$this->load->view('admin/consultant/add_consultant',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditConsultant(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$consultant_id = $this->input->post('consultant_id');
			$consultant_name = $this->input->post('client_initial');
			
			if ($consultant_id == ''){
				$condition = array('client_initial' => $consultant_name);
				$duplicate_name = $this->consultant_model->get_all_details(SEATING_INITIALS,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','Client Initial already exists');
					redirect('admin/consultant/add_consultant_form');
				}
			}
			$excludeArr = array("consultant_id","image","status");
			
			if ($this->input->post('status') != ''){
				$consultant_status = 'Active';
			}else {
				$consultant_status = 'Inactive';
			}
			$inputArr = array('status' => $consultant_status);
			
			$datestring = "%Y-%m-%d";
			$time = time();
			$condition = array('id' => $consultant_id);
			if ($consultant_id == ''){
				$this->consultant_model->commonInsertUpdate(SEATING_INITIALS,'insert',$excludeArr,$inputArr,$condition);
				$this->setErrorMessage('success','Initial added successfully');
			}else {
			
			
				$this->consultant_model->commonInsertUpdate(SEATING_INITIALS,'update',$excludeArr,$inputArr,$condition);
				$this->setErrorMessage('success','Initial updated successfully');
			}
			redirect('admin/consultant/display_consultant_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_consultant_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Edit consultant';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['consultant_details'] = $this->consultant_model->get_all_details(SEATING_INITIALS,$condition);
			if ($this->data['consultant_details']->num_rows() == 1){
				$this->load->view('admin/consultant/edit_consultant',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_consultant_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->consultant_model->update_details(SEATING_INITIALS,$newdata,$condition);
			$this->setErrorMessage('success','consultant Status Changed Successfully');
			redirect('admin/consultant/display_consultant_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_consultant(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'View Initial';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['consultant_details'] = $this->consultant_model->get_all_details(SEATING_INITIALS,$condition);
			if ($this->data['consultant_details']->num_rows() == 1){
				$this->load->view('admin/consultant/view_consultant',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_consultant(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->consultant_model->commonDelete(SEATING_INITIALS,$condition);
			$this->setErrorMessage('success','Initial deleted successfully');
			redirect('admin/consultant/display_consultant_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_consultant_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->consultant_model->activeInactiveCommon(SEATING_INITIALS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Initial deleted successfully');
			}else {
				$this->setErrorMessage('success','Initial status changed successfully');
			}
			redirect('admin/consultant/display_consultant_list');
		}
	}
	/**
	 * 
	 * This function checks the initial color is available or not
	 */
	public function checkColor(){
		$color=$this->input->post('color');
		$condition = array('color'=>$color);
		$consultant_chk = $this->consultant_model->get_all_details(SEATING_INITIALS,$condition);
		if($consultant_chk->num_rows()>0){
			echo 'unavailable';
		}else{
			echo 'availabe';
		}
	}
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */