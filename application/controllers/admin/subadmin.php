<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to sub-admin management 
 * @author Teamtweaks
 *
 */

class Subadmin extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('subadmin_model');
		if ($this->checkPrivileges('subadmin',$this->privStatus) == FALSE){
			redirect('admin_ror');
		}
    }
    
	/**
	 * 
	 * This function loads the subadmin users list
	 */
	public function display_sub_admin(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Sub Admin Users List';
			$condition = array('login_type' => 'main');
			$this->data['admin_users'] = $this->subadmin_model->get_all_details(SUBADMIN,$condition);
			$this->load->view('admin/subadmin/display_subadmin',$this->data);
		}
	}
	
	/**
	 * 
	 * This function change the subadmin user status
	 */
	public function change_subadmin_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$mode = $this->uri->segment(4,0);
			$adminid = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $adminid);
			$this->subadmin_model->update_details(SUBADMIN,$newdata,$condition);
			$this->setErrorMessage('success','Sub Admin Status Changed Successfully');
			redirect('admin/subadmin/display_sub_admin');
		}
	}
	
	/**
	 * 
	 * This function loads the add subadmin form 
	 */
	public function add_sub_admin_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Add Subadmin';
			$condition = array();
			$this->load->view('admin/subadmin/add_subadmin',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a subadmin and his privileges
	 */
	public function insertEditSubadmin(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$subadminid = $this->input->post('subadminid');
			$admin_name = $this->input->post('admin_name');
			$admin_password = md5($this->input->post('admin_password'));
			$email = $this->input->post('email');
			if ($subadminid == ''){
				$condition = array('email' => $email);
				$duplicate_admin= $this->subadmin_model->get_all_details(ADMIN,$condition);
				if ($duplicate_admin->num_rows() > 0){
					$this->setErrorMessage('error','Admin email already exists');
					redirect('admin/subadmin/add_sub_admin_form');
				}else {
					$duplicate_email = $this->subadmin_model->get_all_details(SUBADMIN,$condition);
					if ($duplicate_email->num_rows() > 0){
						$this->setErrorMessage('error','Sub Admin email already exists');
						redirect('admin/subadmin/add_sub_admin_form');
					}else {
						$condition = array('admin_name' => $admin_name);
						$duplicate_adminname = $this->subadmin_model->get_all_details(ADMIN,$condition);
						if ($duplicate_adminname->num_rows() > 0){
							$this->setErrorMessage('error','Admin name already exists');
							redirect('admin/subadmin/add_sub_admin_form');
						}else {
							$duplicate_name = $this->subadmin_model->get_all_details(SUBADMIN,$condition);
							if ($duplicate_name->num_rows() > 0){
								$this->setErrorMessage('error','Sub Admin name already exists');
								redirect('admin/subadmin/add_sub_admin_form');
							}
						}
					}
				}
			}
			
			//print_r($excludeArr); die;
			
			$excludeArr = array("email","subadminid","admin_name","admin_password","contact",'code','user','propertytype','property','newsletter','location','pages','slider','videos','seatingchart','sourcer','manager','consultant','brochure');	
			// $excludeArr = array("email","subadminid","admin_name","admin_password","contact",'code','user','propertytype','newsletter','location','pages','slider','videos','property','seatingchart','sourcer','manager','consultant','brochure');
			$privArr = array();
			
			foreach ($this->input->post() as $key => $val){
				if (in_array($key, $excludeArr)){
					$privArr[$key] = $val;
				}
			}
			
			$inputArr = array('privileges' => serialize($privArr));
			$datestring = "%Y-%m-%d";
			$time = time();
			if ($subadminid == ''){
				$admindata = array(
					'admin_name'	=>	$admin_name,
					'admin_password'	=>	$admin_password,
					'email'	=>	$email,
					'created'	=>	mdate($datestring,$time),
					'modified'	=>	mdate($datestring,$time),
					'admin_type'	=>	'sub',
					'is_verified'	=>	'Yes',
					'status'	=>	'Active'
				);
			} else {
				$admindata = array('modified' =>	mdate($datestring,$time));
			}
			$dataArr = array_merge($admindata,$inputArr);
			$condition = array('id' => $subadminid);
			$this->subadmin_model->add_edit_subadmin($dataArr,$condition);
			//echo $this->db->last_query(); die;
			if ($subadminid == ''){
				$this->setErrorMessage('success','Subadmin added successfully');
			}else {
				$this->setErrorMessage('success','Subadmin updated successfully');
			}
			redirect('admin/subadmin/display_sub_admin');
		}
	}
	
	/**
	 * 
	 * This function loads the edit subadmin form
	 */
	public function edit_subadmin_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Edit Subadmin';
			$adminid = $this->uri->segment(4,0);
			$condition = array('id' => $adminid);
			$this->data['admin_details'] = $this->subadmin_model->get_all_details(SUBADMIN,$condition);
			if ($this->data['admin_details']->num_rows() == 1){
				$this->data['privArr'] = unserialize($this->data['admin_details']->row()->privileges);
				if (!is_array($this->data['privArr'])){
					$this->data['privArr'] = array();
				}
				$this->load->view('admin/subadmin/edit_subadmin',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function loads the subadmin view page
	 */
	public function view_subadmin(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'View Subadmin';
			$adminid = $this->uri->segment(4,0);
			$condition = array('id' => $adminid);
			$this->data['admin_details'] = $this->subadmin_model->get_all_details(SUBADMIN,$condition);
			if ($this->data['admin_details']->num_rows() == 1){
				$this->data['privArr'] = unserialize($this->data['admin_details']->row()->privileges);
				if (!is_array($this->data['privArr'])){
					$this->data['privArr'] = array();
				}
				$this->load->view('admin/subadmin/view_subadmin',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the subadmin record from db
	 */
	public function delete_subadmin(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$subadmin_id = $this->uri->segment(4,0);
			$condition = array('id' => $subadmin_id);
			$this->subadmin_model->commonDelete(SUBADMIN,$condition);
			$this->setErrorMessage('success','Subadmin deleted successfully');
			redirect('admin/subadmin/display_sub_admin');
		}
	}
	
	/**
	 * 
	 * This function change the subadmin status, delete the subadmin record
	 */
	public function change_subadmin_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->subadmin_model->activeInactiveCommon(SUBADMIN,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Subadmin records deleted successfully');
			}else {
				$this->setErrorMessage('success','Subadmin records status changed successfully');
			}
			redirect('admin/subadmin/display_sub_admin');
		}
	}
	
	
	/**
	 * 
	 * This function loads the reset password subadmin form
	 */
	public function edit_reset_pwd_subadmin_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Reset Subadmin Password';
			$adminid = $this->uri->segment(4,0);
			$condition = array('id' => $adminid);
			$this->data['admin_details'] = $this->subadmin_model->get_all_details(SUBADMIN,$condition);
			if ($this->data['admin_details']->num_rows() == 1){
			 
				$this->data['privArr'] = unserialize($this->data['admin_details']->row()->privileges);
				if (!is_array($this->data['privArr'])){
					$this->data['privArr'] = array();
				}
				$this->load->view('admin/subadmin/reset_subadmin_pwd',$this->data);
			}else {
				redirect('admin/subadmin/display_sub_admin');
			}
		}
	}
	
	
	/**
	 * 
	 * This function loads the reset password subadmin form
	 */
	public function edit_save_pwd_subadmin_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
		//	echo "<pre>";print_r($_POST);die;
			
			$dataArr = array('admin_password'=>md5($this->input->post('admin_password')));
			$condition = array('id' => $this->input->post('subadmin_id'));
			$this->subadmin_model->add_edit_subadmin($dataArr,$condition);			
			$this->setErrorMessage('success','Subadmin updated successfully');			
			redirect('admin/subadmin/display_sub_admin');
		}
	}
}

/* End of file subadmin.php */
/* Location: ./application/controllers/admin/subadmin.php */