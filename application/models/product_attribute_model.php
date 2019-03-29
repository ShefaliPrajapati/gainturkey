<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to attribute management
 * @author Teamtweaks
 *
 */
class Product_attribute_model extends My_Model
{
	
	public function add_attribute($dataArr=''){
			$this->db->insert(PRODUCT_ATTRIBUTE,$dataArr);
	}


	public function edit_attribute($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(PRODUCT_ATTRIBUTE,$dataArr);
	}
	
	
	public function view_attribute($condition=''){
			return $this->db->get_where(PRODUCT_ATTRIBUTE,$condition);
			
	}
	public function view_subattribute($condition=''){
			return $this->db->get_where(PRODUCT_SUBATTRIBUTE,$condition);
			
	}
	
	public function view_attribute_details(){
	
		$select_qry = "select * from ".PRODUCT_ATTRIBUTE."";
		$attributeList = $this->ExecuteQuery($select_qry);
		return $attributeList;
			
	}
	
	public function view_subattribute_details(){
	
			$this->db->select('p.*,pa.attr_name');
			$this->db->from(PRODUCT_SUBATTRIBUTE.' as p');
			$this->db->join(PRODUCT_ATTRIBUTE.' as pa',"pa.id=p.attr_id","LEFT");
			$result = $this->db->get();
			return $result;
			
	}
	
}

?>