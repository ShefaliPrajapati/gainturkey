<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Contact_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function UpdateActiveStatus($table='',$data=''){
		$query =  $this->db->get_where($table,$data);
		return $result = $query->result_array();
	}
	
	function Display_ContactInfo($condition='')
	{
		$this->db->select('c.*,p.headline,u.first_name,u.user_name');
		$this->db->from(CONTACT.' as c');
		$this->db->join(PRODUCT.' as p',"c.rental_id=p.id","LEFT");
		$this->db->join(USERS.' as u',"c.renter_id=u.id","LEFT");
		if(!empty($condition)){
			$this->db->where('p.id',$condition);
			$this->db->order_by('c.id','desc');
		}else{
			$this->db->where('c.id !=','');
			$this->db->order_by('c.id','desc');
		}
		//$this->db->where('p.status','Publish');
		return $query = $this->db->get();
		//echo $this->db->last_query();
	//	return $result =$query->result_array();
		//echo "<pre>";print_r($result);die;
	}
	
	
	function insert_contact_info($inputArr=''){
	
		$dataArr = array(
			'firstname'		=>	$this->input->post('first_name'),
			'lastname'		=>	$this->input->post('last_name'),
			'adults'		=>	$this->input->post('Adult'),
			'children'		=>	$this->input->post('Children'),
			'email'			=>	$this->input->post('email_address'),
			'mobile_no'		=>	$this->input->post('ph_no'),
			'message'		=>	$this->input->post('Message'),
			'arrival_date'	=>	$this->input->post('Arr_date'),
			'departure_date' =>  $this->input->post('Dep_date'),
			'renter_id'		=>	$this->input->post('renter_id'),
			'rental_id'		=>	$this->input->post('rental_id'),
			'customer_id'	=>	$this->input->post('customer_id')
		);
		$finalArr = array_merge($dataArr,$inputArr);
		$Query = $this->db->insert(CONTACT,$finalArr);
		
		return $Query;
	}
	
	function comment_reply($cmt_id='')
		{ 
			$this->db->select('r.*,c.renter_id,c.customer_id,c.rental_id,u.first_name');
			$this->db->from(REPLIES.' as r');
			$this->db->join(CONTACT.' as c',"r.comment_id=c.id","LEFT");
			$this->db->join(USERS.' as u',"u.id=r.user_id","LEFT");
			$this->db->where($cmt_id);
			$this->db->order_by('r.dateAdded','desc');
			return $query = $this->db->get();
		//	$this->db->get();
		//echo $this->db->last_query();die;
		//echo "<pre>";print_r($result);die;
		}
	
}