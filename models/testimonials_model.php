<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Testimonials_model extends My_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function UpdateActiveStatus($table = '', $data = '')
    {
        $query = $this->db->get_where($table, $data);
        return $result = $query->result_array();
    }

    function Display_ContactInfo($condition = '')
    {
        $this->db->select('c.*,p.product_name,u.full_name,u.user_name');
        $this->db->from(CONTACT . ' as c');
        $this->db->join(PRODUCT . ' as p', "c.rental_id=p.id", "LEFT");
        $this->db->join(USERS . ' as u', "c.renter_id=u.id", "LEFT");
        if (!empty($condition)) {
            $this->db->where('p.id', $condition);
            $this->db->order_by('c.id', 'desc');
        } else {
            $this->db->where('c.id !=', '');
            $this->db->order_by('c.id', 'desc');
        }
        //$this->db->where('p.status','Publish');
        return $query = $this->db->get();
        //echo $this->db->last_query();
        //	return $result =$query->result_array();
        //echo "<pre>";print_r($result);die;
    }

    function get_contactAll_details($contactgorup = '', $contactorder = '')
    {

        //echo "<pre>";print_r($contactorder);die;
        $this->db->select('c.*,p.product_name,u.full_name,u.user_name,u.contact_count,p.contact_count as rental_count');
        $this->db->from(CONTACT . ' as c');
        $this->db->join(PRODUCT . ' as p', "c.rental_id=p.id", "LEFT");
        $this->db->join(USERS . ' as u', "c.renter_id=u.id", "LEFT");
        $this->db->where('c.status', 'Active');
        $this->db->group_by($contactgorup);
        foreach ($contactorder as $conkey => $conVal) {
            $this->db->order_by($conkey, $conVal);
        }
        $this->db->limit('5');
        //$this->db->get();
        //echo $this->db->last_query();die;
        //echo "<pre>";print_r($result);die;
        return $query = $this->db->get();
    }

}
