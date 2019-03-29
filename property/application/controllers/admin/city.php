<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * 
 * This controller contains the functions related to city management 
 * @author Teamtweaks
 *
 */

class City extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('city_model');
		if ($this->checkPrivileges('city',$this->privStatus) == FALSE){
			redirect('admin_ror');
		}
    }
    
    /**
     * 
     * This function loads the city list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			redirect('admin/city/display_city_list');
		}
	}
	
	/**
	 * 
	 * This function loads the city list page
	 */
	public function display_city_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'City List';
			$condition = array();
			$this->data['cityList'] = $this->city_model->get_all_details(CITY,$condition);
			$condition1 = array('id' => $this->data['cityList']->row()->stateid);
			$this->data['StateList'] = $this->city_model->get_all_details(STATE_TAX,$condition);
			$this->load->view('admin/city/display_city',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the city list page
	 */
	public function display_city_statelist(){ 
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'State city List';
			$statecity_id = $this->uri->segment(4,0);
			$condition = array('country_id' => $statecity_id);
			$this->data['cityList'] = $this->city_model->get_all_details(CITY,$condition);
			$this->load->view('admin/city/display_city',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function loads the add new city form
	 */
	public function add_city_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Add New city';
			$this->data['stateDisplay'] = $this->city_model->SelectAllCountry();
			$this->load->view('admin/city/add_city',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a city
	 */
	public function insertEditcity(){
	//print_r($_FILES);die;
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$city_id = $this->input->post('city_id');
			$city_name = $this->input->post('name');
			$seourl = url_title($city_name, '-', TRUE);
			if ($city_id == ''){
				$condition = array('name' => $city_name);
				$duplicate_name = $this->city_model->get_all_details(CITY,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','City name already exists');
					redirect('admin/city/add_city_form');
				}
			}
			$excludeArr = array("city_id","status","citylogo","citythumb");
			$inputArr['seourl']= $seourl;
			if ($this->input->post('status') != ''){
				$city_status = 'Active';
			}else {
				$city_status = 'InActive';
			}
			$city_data=array();
			$inputArr['status']= $city_status;
			/*$datestring = "%Y-%m-%d %H:%M:%S";
			$time = time();
			if ($city_id == ''){
				$city_data = array(
					'dateAdded'	=>	mdate($datestring,$time),
				);
			}*/
			     $logoDirectory ='./images/city';
			     if(!is_dir($logoDirectory))
                 {
                     mkdir($logoDirectory,0777);
                  }
		    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
			    //$config['max_size'] = 50000;
			    $config['remove_spaces'] = FALSE;
				$config['upload_path'] = $logoDirectory;
			    $this->upload->initialize($config);
				$this->load->library('upload', $config);
				
				 //var_dump(is_dir('./dummy'));  die;
				if ($this->upload->do_upload('citylogo')){
			    	$logoDetails = $this->upload->data();
					$logoDetails['file_name'];
			    	$inputArr['citylogo'] = $logoDetails['file_name'];
				}
				$error = array('error' => $this->upload->display_errors());
				//print_r($error); die;
				if ( $this->upload->do_upload('citythumb')){
					$feviconDetails = $this->upload->data();
			    	$inputArr['citythumb'] = $feviconDetails['file_name'];
				}
			$dataArr = array_merge($inputArr,$city_data);

			$condition = array('id' => $city_id);
			if ($city_id == ''){
				$this->city_model->commonInsertUpdate(CITY,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','City added successfully');
			}else {
				$this->city_model->commonInsertUpdate(CITY,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','City updated successfully');
			}
			redirect('admin/city/display_city_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit city form
	 */
	public function edit_city_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'Edit city';
			$city_id = $this->uri->segment(4,0);
			$condition = array('id' => $city_id);
			$this->data['stateDisplay'] = $this->city_model->SelectAllCountry();
			$this->data['city_details'] = $this->city_model->get_all_details(CITY,$condition);
			if ($this->data['city_details']->num_rows() == 1){
			
				$this->load->view('admin/city/edit_city',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function change the city status
	 */
	public function change_city_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->city_model->update_details(CITY,$newdata,$condition);
			$this->setErrorMessage('success','City Status Changed Successfully');
			redirect('admin/city/display_city_list');
		}
	}
	
	/**
	 * 
	 * This function loads the city view page
	 */
	public function view_city(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$this->data['heading'] = 'View city';
			$city_id = $this->uri->segment(4,0);
			$condition = array('id' => $city_id);
			$this->data['stateDisplay'] = $this->city_model->SelectAllCountry();
			$this->data['city_details'] = $this->city_model->get_all_details(CITY,$condition);
			if ($this->data['city_details']->num_rows() == 1){
				$this->load->view('admin/city/view_city',$this->data);
			}else {
				redirect('admin_ror');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the city record from db
	 */
	public function delete_city(){
		if ($this->checkLogin('A') == ''){
			redirect('admin_ror');
		}else {
			$city_id = $this->uri->segment(4,0);
			$condition = array('id' => $city_id);
			$this->city_model->commonDelete(CITY,$condition);
			$this->setErrorMessage('success','City deleted successfully');
			redirect('admin/city/display_city_list');
		}
	}
	
}

/* End of file city.php */
/* city: ./application/controllers/admin/city.php */