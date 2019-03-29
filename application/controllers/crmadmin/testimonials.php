<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Testimonials extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('testimonials_model');
		if ($this->checkPrivileges('testimonials',$this->privStatus) == FALSE){
			redirect('deals_crm');
		}
    }
    
    /**
     * 
     * This function loads the testimonials list page
     */
   	public function index(){	
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			redirect('crmadmin/testimonials/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the testimonials list page
	 */
	public function display_testimonials_list(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Testimonials List';
			$condition = array();
			$this->data['testimonialsList'] = $this->testimonials_model->get_all_details(TESTIMONIALS,$condition);
//print_r($this->data['testimonialsList']);
		
			$this->load->view('crmadmin/testimonials/display_testimonials',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the testimonials dashboard
	 */
	public function display_testimonials_dashboard(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Testimonials Dashboard';
			$condition = array();
			$grouptestimonials=array('c.renter_id');
			$grouporder=array('u.testimonials_count'=>'DESC');
			
			$this->data['testimonialsList'] = $this->testimonials_model->get_testimonialsAll_details($grouptestimonials,$grouporder);
			$grouptestimonials=array('c.rental_id');
			$grouporder=array('p.testimonials_count'=>'DESC');
			$this->data['TopRentalList'] = $this->testimonials_model->get_testimonialsAll_details($grouptestimonials,$grouporder);
			
	
			
			
			$this->load->view('crmadmin/testimonials/display_testimonials_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new testimonials form
	 */
	public function add_testimonials_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Add New Contact';
			$this->load->view('crmadmin/testimonials/add_testimonials',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditTestimonials(){
	
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$testimonials_id = $this->input->post('testimonials_id');
			$testimonials_name = $this->input->post('title');
			$seourl = url_title($testimonials_name, '-', TRUE);
			if ($testimonials_id == ''){
				$condition = array('title' => $testimonials_name);
				$duplicate_name = $this->testimonials_model->get_all_details(TESTIMONIALS,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','Testimonial name already exists');
					redirect('crmadmin/testimonials/add_testimonials_form');
				}
			}
			$excludeArr = array("testimonials_id");
			
			
			$testimonials_data=array();
			
			$inputArr = array();
			$datestring = "%Y-%m-%d %H:%M:%S";
			$time = time();
			if ($testimonials_id == ''){
				$testimonials_data = array(
					'dateAdded'	=>	mdate($datestring,$time),
				);
			}
			$dataArr = array_merge($inputArr,$testimonials_data);
			$condition = array('id' => $testimonials_id);
			if ($testimonials_id == ''){
				$this->testimonials_model->commonInsertUpdate(TESTIMONIALS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Testimonial added successfully');
			}else {
				
				$this->testimonials_model->commonInsertUpdate(TESTIMONIALS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Testimonial updated successfully');
			}
			redirect('crmadmin/testimonials/display_testimonials_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_testimonials_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'Edit Contact';
			$testimonials_id = $this->uri->segment(4,0);
			$condition = array('id' => $testimonials_id);
			$this->data['testimonials_details'] = $this->testimonials_model->get_all_details(TESTIMONIALS,$condition);
			if ($this->data['testimonials_details']->num_rows() == 1){
				$this->load->view('crmadmin/testimonials/edit_testimonials',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 
	 change_testimonials_status_global
	 */
	public function change_testimonials_status(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->testimonials_model->update_details(TESTIMONIALS,$newdata,$condition);
			$this->setErrorMessage('success','Contact Status Changed Successfully');
			redirect('crmadmin/testimonials/display_testimonials_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_testimonials(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->data['heading'] = 'View Contact';
			$testimonials_id = $this->uri->segment(4,0);
			$condition = array('id' => $testimonials_id);
			$this->data['testimonials_details'] = $this->testimonials_model->get_all_details(TESTIMONIALS,$condition);
			if ($this->data['testimonials_details']->num_rows() == 1){
				$this->load->view('crmadmin/testimonials/view_testimonials',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_testimonials(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$testimonials_id = $this->uri->segment(4,0);
			$condition = array('id' => $testimonials_id);
			$this->testimonials_model->commonDelete(TESTIMONIALS,$condition);
			$this->setErrorMessage('success','Contact deleted successfully');
			redirect('crmadmin/testimonials/display_testimonials_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_testimonials_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->testimonials_model->activeInactiveCommon(TESTIMONIALS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Testimonials records deleted successfully');
			}else {
				$this->setErrorMessage('success','Testimonials records status changed successfully');
			}
			redirect('crmadmin/testimonials/display_testimonials_list');
		}
	}
}

/* End of file testimonials.php */
/* Contact: ./application/controllers/crmadmin/testimonials.php */