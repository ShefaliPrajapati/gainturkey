<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all db functions related to report management
 * @author Teamtweaks
 *
 */
class Report_model extends My_Model
{
    public function view_admin_name($condition)
    {
        $select_qry = "select * from " . RESERVED_INFO . "" . $condition;
        $adminList = $this->ExecuteQuery($select_qry);
        return $adminList;
    }
}

?>
