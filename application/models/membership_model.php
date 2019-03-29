<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * 
 * This model contains all db functions related to fancyy box
 * @author Teamtweaks
 *
 */
class Membership_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * Getting Fancybox card details
    * @param String $condition
    */
   public function get_fancybox_details($condition=''){
   		$Query = " select * from ".FANCYYBOX_USES." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
   
     
   public function get_subscription_details(){
   		$Query = " select first_name,membership,price,approved from ".USERS." LIMIT 0,10 ";
   		return $this->ExecuteQuery($Query);
   }
   
   public function get_subscription_list_details(){
   		$Query = " select * from ".USERS." WHERE approved = 'yes' ";
   		return $this->ExecuteQuery($Query);
   }
	public function get_subscription_count(){
   		$Query = " select membership,count(*) as totCount from ".USERS." WHERE membership!= '' and approved = 'yes' Group by membership order by created DESC  ";
   		return $this->ExecuteQuery($Query);
   }
   public function Subscriber_Count_Decre($uid){
		$select_qry = "UPDATE ".FANCYYBOX." SET purchased = (purchased)-1 where name='".$uid."'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
}