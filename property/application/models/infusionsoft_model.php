<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all db functions related to infusionsoft management
 * @author Teamtweaks
 *
 */
class Infusionsoft_model extends My_Model
{
    public function add_infusionsoft_record($dataArr=''){
        $this->db->insert(INFUSIONSOFT,$dataArr);
    }

    public function edit_infusionsoft_record($dataArr='',$condition=''){
        $this->db->where($condition);
        $this->db->update(INFUSIONSOFT,$dataArr);
    }

    public function view_infusionsoft_record($condition=''){
        return $this->db->get_where(INFUSIONSOFT,$condition);
    }
}