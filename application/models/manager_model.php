<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to Manager management
 * @author Teamtweaks
 *
 */
class Manager_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/** 
    * 
    * Getting Users details
    * @param String $condition
    */
   public function get_manager_details($condition=''){
   		$Query = " select * from ".MANAGER_INFO." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
}