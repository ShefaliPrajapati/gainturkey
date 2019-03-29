<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Review extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('review_model');
		if ($this->checkPrivileges('testimonials',$this->privStatus) == FALSE){
			redirect('admin_ror');
		}
    }
    
    /**
     * 
     * This function loads the testimonials list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			redirect('admin/review/display_review_list');
		}
	}
	
	/**
	 * 
	 * This function loads the testimonials list page
	 */
	public function display_review_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Review List';
			$condition = array();
			$this->data['reviewList'] = $this->review_model->get_all_review_details();
//print_r($this->data['testimonialsList']);
		
			$this->load->view('admin/review/display_review',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the testimonials dashboard
	 */
	public function display_testimonials_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Testimonials Dashboard';
			$condition = array();
			$grouptestimonials=array('c.renter_id');
			$grouporder=array('u.testimonials_count'=>'DESC');
			
			$this->data['testimonialsList'] = $this->review_model->get_testimonialsAll_details($grouptestimonials,$grouporder);
			$grouptestimonials=array('c.rental_id');
			$grouporder=array('p.testimonials_count'=>'DESC');
			$this->data['TopRentalList'] = $this->review_model->get_testimonialsAll_details($grouptestimonials,$grouporder);
			
	
			
			
			$this->load->view('admin/testimonials/display_testimonials_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new testimonials form
	 */
	public function add_testimonials_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Add New Contact';
			$this->load->view('admin/testimonials/add_testimonials',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditTestimonials(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$testimonials_id = $this->input->post('testimonials_id');
			$testimonials_name = $this->input->post('title');
			$seourl = url_title($testimonials_name, '-', TRUE);
			if ($testimonials_id == ''){
				$condition = array('title' => $testimonials_name);
				$duplicate_name = $this->review_model->get_all_details(TESTIMONIALS,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','Testimonial name already exists');
					redirect('admin/testimonials/add_testimonials_form');
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
				$this->review_model->commonInsertUpdate(TESTIMONIALS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Testimonial added successfully');
			}else {
				
				$this->review_model->commonInsertUpdate(TESTIMONIALS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Testimonial updated successfully');
			}
			redirect('admin/testimonials/display_testimonials_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_testimonials_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Edit Contact';
			$testimonials_id = $this->uri->segment(4,0);
			$condition = array('id' => $testimonials_id);
			$this->data['testimonials_details'] = $this->review_model->get_all_details(TESTIMONIALS,$condition);
			if ($this->data['testimonials_details']->num_rows() == 1){
				$this->load->view('admin/testimonials/edit_testimonials',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 
	 change_testimonials_status_global
	 */
	public function change_review_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->review_model->update_details(REVIEW,$newdata,$condition);
			$this->setErrorMessage('success','Contact Status Changed Successfully');
			redirect('admin/review/display_review_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_review(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'View Review';
			$review_id = $this->uri->segment(4,0);
			$this->data['review_details'] = $this->review_model->get_review_details($review_id);
			if ($this->data['review_details']->num_rows() == 1){
				$this->load->view('admin/review/view_review',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_review(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$id = $this->uri->segment(4,0);
			$condition = array('id' => $id);
			$this->review_model->commonDelete(REVIEW,$condition);
			$this->setErrorMessage('success','Review deleted successfully');
			redirect('admin/review/display_review_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_review_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->review_model->activeInactiveCommon(REVIEW,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Review records deleted successfully');
			}else {
				$this->setErrorMessage('success','Review records status changed successfully');
			}
			redirect('admin/review/display_review_list');
		}
	}
}

/* End of file testimonials.php */
/* Contact: ./application/controllers/admin/testimonials.php */