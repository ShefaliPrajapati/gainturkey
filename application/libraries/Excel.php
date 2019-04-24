<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  ======================================= 
 *  Author     : Web Preparations Team
 *  License    : Protected 
 *  Email      : admin@webpreparations.com 
 * 
 *  ======================================= 
 */
require_once APPPATH . "/third_party/PHPExcel.php";
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
?>