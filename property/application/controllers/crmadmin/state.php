<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to sub-admin management 
 * @author Teamtweaks
 *
 */

class State extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('state_model');
    }
    
	/**
	 * 
	 * This function loads the state users list
	 */
	public function display_state(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'State List';
			$condition = array('countryid' => '215');
			$this->data['admin_users'] = $this->state_model->get_all_details(STATE_TAX,$condition);
			$this->load->view('crmadmin/state/display_state',$this->data);
		}
	}
	
	/**
	 * 
	 * This function change the state user status
	 */
	public function change_state_status(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$mode = $this->uri->segment(4,0);
			$adminid = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $adminid);
			$this->state_model->update_details(STATE_TAX,$newdata,$condition);
			$this->setErrorMessage('success','State Status Changed Successfully');
			redirect('crmadmin/state/display_state');
		}
	}
	
	/**
	 * 
	 * This function loads the add state form 
	 */
	public function add_state_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Add State';
			$condition = array();
			$this->load->view('crmadmin/state/add_state',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a state and his privileges
	 */
	public function insertEditState(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$stateid = $this->input->post('stateid');
			$admin_name = $this->input->post('admin_name');
			$admin_password = md5($this->input->post('admin_password'));
			$email = $this->input->post('email');
			if ($stateid == ''){
				$condition = array('email' => $email);
				$duplicate_admin= $this->state_model->get_all_details(ADMIN,$condition);
				if ($duplicate_admin->num_rows() > 0){
					$this->setErrorMessage('error','Admin email already exists');
					redirect('crmadmin/state/add_state_form');
				}else {
					$duplicate_email = $this->state_model->get_all_details(STATE_TAX,$condition);
					if ($duplicate_email->num_rows() > 0){
						$this->setErrorMessage('error','State email already exists');
						redirect('crmadmin/state/add_state_form');
					}else {
						$condition = array('admin_name' => $admin_name);
						$duplicate_adminname = $this->state_model->get_all_details(ADMIN,$condition);
						if ($duplicate_adminname->num_rows() > 0){
							$this->setErrorMessage('error','State name already exists');
							redirect('crmadmin/state/add_state_form');
						}else {
							$duplicate_name = $this->state_model->get_all_details(STATE_TAX,$condition);
							if ($duplicate_name->num_rows() > 0){
								$this->setErrorMessage('error','State name already exists');
								redirect('crmadmin/state/add_state_form');
							}
						}
					}
				}
			}
			$excludeArr = array("email","stateid","admin_name","admin_password");
			$privArr = array();
			foreach ($this->input->post() as $key => $val){
				if (!in_array($key, $excludeArr)){
					$privArr[$key] = $val;
				}
			}
			$inputArr = array('crm_privileges' => serialize($privArr));
			$datestring = "%Y-%m-%d";
			$time = time();
			if ($stateid == ''){
				$admindata = array(
					'admin_name'		=>	$admin_name,
					'admin_password'	=>	$admin_password,
					'email'				=>	$email,
					'created'			=>	mdate($datestring,$time),
					'modified'			=>	mdate($datestring,$time),
					'admin_type'		=>	'sub',
					'is_verified'		=>	'Yes',
					'status'			=>	'Active',
					'login_type'		=>	'crm'
				);
			}else {
				$admindata = array('modified' =>	mdate($datestring,$time));
			}
			$dataArr = array_merge($admindata,$inputArr);
			$condition = array('id' => $stateid);
			$this->state_model->add_edit_state($dataArr,$condition);
			if ($stateid == ''){
				$this->setErrorMessage('success','State added successfully');
			}else {
				$this->setErrorMessage('success','State updated successfully');
			}
			redirect('crmadmin/state/display_state');
		}
	}
	
	/**
	 * 
	 * This function loads the edit state form
	 */
	public function edit_state_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Edit State';
			$adminid = $this->uri->segment(4,0);
			$condition = array('id' => $adminid);
			$this->data['admin_details'] = $this->state_model->get_all_details(STATE_TAX,$condition);
			if ($this->data['admin_details']->num_rows() == 1){
				$this->data['privArr'] = unserialize($this->data['admin_details']->row()->crm_privileges);
				if (!is_array($this->data['privArr'])){
					$this->data['privArr'] = array();
				}
				$this->load->view('crmadmin/state/edit_state',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function loads the state view page
	 */
	public function view_state(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'View State';
			$adminid = $this->uri->segment(4,0);
			$condition = array('id' => $adminid);
			$this->data['admin_details'] = $this->state_model->get_all_details(STATE_TAX,$condition);
			if ($this->data['admin_details']->num_rows() == 1){
				$this->data['privArr'] = unserialize($this->data['admin_details']->row()->crm_privileges);
				if (!is_array($this->data['privArr'])){
					$this->data['privArr'] = array();
				}
				$this->load->view('crmadmin/state/view_state',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the state record from db
	 */
	public function delete_state(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$state_id = $this->uri->segment(4,0);
			$condition = array('id' => $state_id);
			$this->state_model->commonDelete(STATE_TAX,$condition);
			$this->setErrorMessage('success','State deleted successfully');
			redirect('crmadmin/state/display_state');
		}
	}
	
	/**
	 * 
	 * This function change the state status, delete the state record
	 */
	public function change_state_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->state_model->activeInactiveCommon(STATE_TAX,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','State records deleted successfully');
			}else {
				$this->setErrorMessage('success','State records status changed successfully');
			}
			redirect('crmadmin/state/display_state');
		}
	}
}

/* End of file state.php */
/* Location: ./application/controllers/crmadmin/state.php */