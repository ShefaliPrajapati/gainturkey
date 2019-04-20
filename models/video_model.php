<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Video_model extends My_Model
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
    public function get_video_details($condition = '')
    {
        $Query = " select * from " . VIDEO . " " . $condition;
        return $this->ExecuteQuery($Query);
    }
}
