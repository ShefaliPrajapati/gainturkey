<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to sub-admin management
 * @author Teamtweaks
 *
 */
class State_model extends My_Model
{
	public function add_edit_state($dataArr='',$condition=''){
		if ($condition['id'] != ''){
			$this->db->where($condition);
			$this->db->update(STATE_TAX,$dataArr);
		}else {
			$this->db->insert(STATE_TAX,$dataArr);
		}
	}
}