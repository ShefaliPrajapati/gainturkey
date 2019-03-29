<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**  
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Sourcer extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('sourcer_model');
		if ($this->checkPrivileges('sourcer',$this->privStatus) == FALSE){
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
			redirect('admin/sourcer/display_sourcer_list');
		}
	}
	
	/**
	 * 
	 * This function loads the users list page
	 */
	public function display_sourcer_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Sourcer List';
			$condition = array();
			$this->data['sourcerList'] = $this->sourcer_model->get_all_details(SOURCER_INFO,$condition);
			$this->load->view('admin/sourcer/display_sourcer',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new user form
	 */
	public function add_sourcer_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Add New Sourcer';
			$this->load->view('admin/sourcer/add_sourcer',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditSourcer(){ //echo "problem"; die;
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			
			//echo '<pre>'; print_r($_POST); die;
				
			$sourcer_id = $this->input->post('sourcer_id');
			
			$excludeArr = array("sourcer_id","status");
			
			if ($this->input->post('status') != ''){
				$sourcer_status = 'Active';
			}else {
				$sourcer_status = 'Inactive';
			}
			$inputArr = array('status' => $sourcer_status);
			
			$condition = array('id' => $sourcer_id);
			if ($sourcer_id == ''){
				$this->sourcer_model->commonInsertUpdate(SOURCER_INFO,'insert',$excludeArr,$inputArr,$condition);
				$this->setErrorMessage('success','Sourcer info added successfully');
			}else {
			
			
				$this->sourcer_model->commonInsertUpdate(SOURCER_INFO,'update',$excludeArr,$inputArr,$condition);
				$this->setErrorMessage('success','Sourcer info updated successfully');
			}
			redirect('admin/sourcer/display_sourcer_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_sourcer_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Edit Sourcer';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['sourcer_details'] = $this->sourcer_model->get_all_details(SOURCER_INFO,$condition);
			if ($this->data['sourcer_details']->num_rows() == 1){
				$this->load->view('admin/sourcer/edit_sourcer',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_sourcer_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->sourcer_model->update_details(SOURCER_INFO,$newdata,$condition);
			$this->setErrorMessage('success','Sourcer Status Changed Successfully');
			redirect('admin/sourcer/display_sourcer_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_sourcer(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'View Sourcer';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['sourcer_details'] = $this->sourcer_model->get_all_details(SOURCER_INFO,$condition);
			if ($this->data['sourcer_details']->num_rows() == 1){
				$this->load->view('admin/sourcer/view_sourcer',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_sourcer(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->sourcer_model->commonDelete(SOURCER_INFO,$condition);
			$this->setErrorMessage('success','Sourcer deleted successfully');
			redirect('admin/sourcer/display_sourcer_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_sourcer_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->sourcer_model->activeInactiveCommon(SOURCER_INFO,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Sourcer deleted successfully');
			}else {
				$this->setErrorMessage('success','Sourcer status changed successfully');
			}
			redirect('admin/sourcer/display_sourcer_list');
		}
	}
	
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	function Get_Sourcer_Check()
		{
			$semail = $this->input->post('semail');
			$secretCode = $this->sourcer_model->get_all_details(SOURCER_INFO,array('s_email' => $semail));
			echo $secretCode->num_rows();
		}
	
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */