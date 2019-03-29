<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to Sourcer management
 * @author Teamtweaks
 *
 */
class Sourcer_model extends My_Model
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
   public function get_sourcer_details($condition=''){
   		$Query = " select * from ".SOURCER_INFO." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
}