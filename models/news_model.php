<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all db functions related to news management
 * @author Teamtweaks
 *
 */
class News_model extends My_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getNewsDetails($talble_name = '', $condition = '')
    {
        $this->db->select('*');
        $this->db->from($talble_name);
        if ($condition != '') {
            $this->db->where('news_id', $condition);
        }
        $result = $this->db->get();
        return $result->result_array();
    }

    public function insertNews($table_name, $mode, $data, $condition)
    {
        if ($mode == "insert") {
            $this->db->insert($table_name, $data);
        } else {
            $this->db->where($condition);
            $this->db->update($table_name, $data);
        }
    }
}
