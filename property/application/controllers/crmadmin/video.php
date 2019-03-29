<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**  
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Video extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('video_model');
		if ($this->checkPrivileges('videos',$this->privStatus) == FALSE){
			redirect('deals_crm');
		}
    }
    
    /**
     * 
     * This function loads the users list page
     */
   	public function index(){	
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			redirect('crmadmin/video/display_video_list');
		}
	}
	
	/**
	 * 
	 * This function loads the users list page
	 */
	public function display_video_list(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'video List';
			$condition = array();
			$this->data['videoList'] = $this->video_model->get_all_details(VIDEO,$condition);
			$this->load->view('crmadmin/video/display_videolist',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the users dashboard
	 */
	public function display_user_dashboard(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'videos Dashboard';
			$condition = 'order by `created` desc';
			$this->data['usersList'] = $this->video_model->get_video_details($condition);
			$this->load->view('crmadmin/video/display_video_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new user form
	 */
	public function add_video_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Add New video';
			$this->load->view('crmadmin/video/add_video',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditVideo(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$video_id = $this->input->post('video_id');
			$video_name = $this->input->post('video_name');
			$video_title = $this->input->post('video_title');
			if ($video_id == ''){
				$condition = array('video_name' => $video_name);
				$duplicate_name = $this->video_model->get_all_details(VIDEO,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','video name already exists');
					redirect('crmadmin/video/add_video_form');
				}
			}
			$excludeArr = array("video_id","image","status");
			
			if ($this->input->post('status') != ''){
				$video_status = 'Active';
			}else {
				$video_status = 'Inactive';
			}
			$inputArr = array('status' => $video_status);
			
			$datestring = "%Y-%m-%d";
			$time = time();
			//$config['encrypt_name'] = TRUE;
			 if(!is_dir($logoDirectory))
                       {
                               mkdir($logoDirectory,0777);
                       }
			$config['overwrite'] = FALSE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
		    $config['max_size'] = 2000;
		    $config['upload_path'] = './images/video';
			 $this->upload->initialize($config);
		   $this->load->library('upload', $config);
			$this->upload->do_upload('image');
			$imgDetails = $this->upload->data();
		    $inputArr['image'] = $imgDetails['file_name'];
	
			$condition = array('id' => $video_id);
			if ($video_id == ''){
				$this->video_model->commonInsertUpdate(VIDEO,'insert',$excludeArr,$inputArr,$condition);
				$this->setErrorMessage('success','video added successfully');
			}else {
			
			
				$this->video_model->commonInsertUpdate(VIDEO,'update',$excludeArr,$inputArr,$condition);
				$this->setErrorMessage('success','video updated successfully');
			}
			redirect('crmadmin/video/display_video_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_video_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Edit video';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['video_details'] = $this->video_model->get_all_details(VIDEO,$condition);
			if ($this->data['video_details']->num_rows() == 1){
				$this->load->view('crmadmin/video/edit_video',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_video_status(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->video_model->update_details(VIDEO,$newdata,$condition);
			$this->setErrorMessage('success','video Status Changed Successfully');
			redirect('crmadmin/video/display_video_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_video(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'View video';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['video_details'] = $this->video_model->get_all_details(VIDEO,$condition);
			if ($this->data['video_details']->num_rows() == 1){
				$this->load->view('crmadmin/video/view_video',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_video(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->video_model->commonDelete(VIDEO,$condition);
			$this->setErrorMessage('success','video deleted successfully');
			redirect('crmadmin/video/display_video_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_video_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->video_model->activeInactiveCommon(VIDEO,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','video deleted successfully');
			}else {
				$this->setErrorMessage('success','video status changed successfully');
			}
			redirect('crmadmin/video/display_video_list');
		}
	}
}

/* End of file users.php */
/* Location: ./application/controllers/crmadmin/users.php */