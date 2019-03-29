<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**  
 * 
 * This controller contains the functions related to brochure management 
 * @author Teamtweaks
 *
 */

class Brochure extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('brochure_model');
		if ($this->checkPrivileges('brochure',$this->privStatus) == FALSE){
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
			redirect('admin/brochure/display_brochure_list');
		}
	}
	
	/**
	 * 
	 * This function loads the users list page
	 */
	public function display_brochure_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Brochure List';
			$condition = array();
			$this->data['brochureList'] = $this->brochure_model->get_all_details(BROCHURE,$condition);
			$this->load->view('admin/brochure/display_brochurelist',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_brochure_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->brochure_model->update_details(BROCHURE,$newdata,$condition);
			$this->setErrorMessage('success','brochure Status Changed Successfully');
			redirect('admin/brochure/display_brochure_list');
		}
	}
	
	
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_brochure_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->brochure_model->activeInactiveCommon(BROCHURE,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Initial deleted successfully');
			}else {
				$this->setErrorMessage('success','Initial status changed successfully');
			}
			redirect('admin/brochure/display_brochure_list');
		}
	}
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */