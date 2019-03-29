<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to brochure management
 * @author Teamtweaks
 *
 */
class Brochure_model extends My_Model
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
   public function get_brochure_details($condition=''){
   		$Query = " select * from ".BROCHURE." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
}