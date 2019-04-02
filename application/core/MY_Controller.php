<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();
/**
 *
 * This controller contains the common functions
 * @author Teamtweaks
 *
 */
// echo date('Y-m-d H:i:s A').'<br>';
date_default_timezone_set("America/Los_Angeles");

// echo date('Y-m-d H:i:s A'); die;
class MY_Controller extends CI_Controller {

    public $privStatus;
    public $data = array();

    function __construct() {
        parent::__construct();
        ob_start();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->helper('url');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->load->library(array('session', 'upload', 'resizeimage'));
        $this->load->model('minicart_model');
        $this->load->model('product_model');


        /*
         * Connecting Database
         */
        $this->load->database();
        //$this->product_model->getSoldSettings();die;

        /*
         * Loading CMS Pages
         */

        if ($_SESSION['cmsPages'] == '') {
            $cmsPages = $this->db->query('select * from ' . CMS . ' where `status`="Publish" and `hidden_page`="No"');
            $_SESSION['cmsPages'] = $cmsPages->result_array();
        }
        $this->data['cmsPages'] = $_SESSION['cmsPages'];


        $BuyNowCmsPages = $this->db->query('select description from ' . CMS . ' where `id`="48"');
        $this->data['BuyNowPages'] = $BuyNowPages = $BuyNowCmsPages->result_array();
        //print_r($BuyNowPages);die;
        /*
         * Loading Property Type
         */

        $PropertyType = $this->db->query('select * from ' . PRODUCT_ATTRIBUTE . ' where `status`="Active"');
        $this->data['PropertyType'] = $PropertyType->result_array();

        /*
         * Loading Property Sub Type
         */

        $PropertySubType = $this->db->query('select * from ' . PRODUCT_SUBATTRIBUTE . ' where `status`="Active"');
        $this->data['PropertySubType'] = $PropertySubType->result_array();



        /*
         * Getting fancybox count
         */
        if ($_SESSION['fancyBoxCount'] == '') {
            $fancyBoxList = $this->db->query('select * from ' . FANCYYBOX . ' where `status`="Publish"');
            $_SESSION['fancyBoxCount'] = $fancyBoxList->num_rows();
        }
        $this->data['fancyBoxCount'] = $_SESSION['fancyBoxCount'];

        /*
         * Loading active languages
         */
        if ($_SESSION['activeLgs'] == '') {
            $activeLgsList = $this->db->query('select * from ' . LANGUAGES . ' where `status`="Active"');
            $_SESSION['activeLgs'] = $activeLgsList->result_array();
        }
        $this->data['activeLgs'] = $_SESSION['activeLgs'];

        $userId = $this->session->userdata('fc_session_user_id');
        if (isset($userId)) {
            $_SESSION['userdata'] = $this->session->userdata;
        }
        /*
         * Checking user language and loading user details
         */
        if ($this->checkLogin('U') != '') {
            $this->data['userDetails'] = $this->db->query('select * from ' . USERS . ' where `id`="' . $this->checkLogin('U') . '"');
            /* $selectedLangCode = $this->session->userdata('language_code');
              if ($this->data['userDetails']->row()->language != $selectedLangCode){
              $this->session->set_userdata('language_code',$this->data['userDetails']->row()->language);
              $this->session->keep_flashdata('sErrMSGType');
              $this->session->keep_flashdata('sErrMSG');
              redirect($this->uri->uri_string());
              } */
        }
        $this->data['base_url_image'] = $this->base_url_image();
        /*
         * Checking user language and loading user details
         */
        //$this->product_model->saveSoldSettings();
        $this->data['login_admin_name'] = $this->session->userdata('ror_crm_session_admin_name');
        $this->data['login_admin_name_ror'] = $this->session->userdata('fc_session_admin_name');

        $this->data['login_admin_type'] = $this->session->userdata('ror_crm_session_admin_type');
        $this->data['stateDetails'] = $this->product_model->get_all_details(STATE_TAX, array('countryid' => '215', 'status' => 'Active'));
        $this->data['codeDetails'] = $this->product_model->get_all_details(ATTRIBUTE, array('status' => 'Active'));
		$this->data['soldadminName']=$this->product_model->get_all_details(SUBADMIN,array('status' => 'Active'));
        $this->data['sourcerName']=$this->product_model->get_all_details(SOURCER_INFO,array('status' => 'Active'));
        //echo '<pre>'; print_r($_SESSION); die;
        if ($this->checkLogin('CA') != '') {
            $this->data['crm_privileges'] = $_SESSION['crm'];//$this->session->userdata('ror_crm_session_admin_privileges');
            $this->data['subAdminMail'] = $this->session->userdata('ror_crm_session_admin_email');
        } else {
            $this->data['privileges'] = $this->session->userdata('fc_session_admin_privileges');
            $this->data['subAdminMail'] = $this->session->userdata('fc_session_admin_email');
        }
        extract($crm_privileges);
        extract($privileges);

        if (substr($uriMethod, 0, 7) == 'display' || substr($uriMethod, 0, 4) == 'view' || $uriMethod == '0') {
            $this->privStatus = '0';
        } else if (substr($uriMethod, 0, 3) == 'add') {
            $this->privStatus = '1';
        } else if (substr($uriMethod, 0, 4) == 'edit' || substr($uriMethod, 0, 6) == 'insert' || substr($uriMethod, 0, 6) == 'change') {
            $this->privStatus = '2';
        } else if (substr($uriMethod, 0, 6) == 'delete') {
            $this->privStatus = '3';
        } else {
            $this->privStatus = '0';
        }
        $this->data['title'] = $this->config->item('meta_title');
        $this->data['heading'] = '';
        $this->data['flash_data'] = $this->session->flashdata('sErrMSG');
        $this->data['flash_data_type'] = $this->session->flashdata('sErrMSGType');
        $this->data['adminPrevArr'] = $this->config->item('adminPrev');
        $this->data['adminEmail'] = $this->config->item('email');
        $this->data['loginID'] = $this->session->userdata('fc_session_user_id');
        $this->data['allPrev'] = '0';
        $this->data['allPrevCrm'] = '0';
        $this->data['logo'] = $this->config->item('logo_image');
        $this->data['fevicon'] = $this->config->item('fevicon_image');
        $this->data['footer'] = $this->config->item('footer_content');
        $this->data['siteContactMail'] = $this->config->item('site_contact_mail');
        $this->data['WebsiteTitle'] = $this->config->item('email_title');
        $this->data['siteTitle'] = $this->config->item('email_title');
        $this->data['meta_title'] = $this->config->item('meta_title');
        $this->data['meta_keyword'] = $this->config->item('meta_keyword');
        $this->data['meta_description'] = $this->config->item('meta_description');
        $this->data['giftcard_status'] = $this->config->item('giftcard_status');
        $this->data['sidebar_id'] = $this->session->userdata('session_sidebar_id');
        if ($this->session->userdata('fc_session_admin_name') == $this->config->item('admin_name')) {
            $this->data['allPrev'] = '1';
        }
        if ($this->session->userdata('fc_session_admin_name') == 'tcadmin') {
            $this->data['allPrev'] = '1';
            $admindataTemp = array('fc_session_admin_privileges' => '');
            $this->session->set_userdata($admindataTemp);
        }
        if ($this->session->userdata('fc_session_admin_name') == 'camille') {
            $this->data['allPrev'] = '1';
            $admindataTemp = array('fc_session_admin_privileges' => '');
            $this->session->set_userdata($admindataTemp);
        }
        if ($this->session->userdata('fc_session_admin_name') == 'cassie') {
            $this->data['allPrev'] = '1';
            $admindataTemp = array('fc_session_admin_privileges' => '');
            $this->session->set_userdata($admindataTemp);
        }
        if ($this->session->userdata('fc_session_admin_name') == 'garilynn') {
            $this->data['allPrev'] = '1';
            $admindataTemp = array('fc_session_admin_privileges' => '');
            $this->session->set_userdata($admindataTemp);
        }
        if ($this->session->userdata('fc_session_admin_name') == 'rgarcia') {
            $this->data['allPrev'] = '1';
            $admindataTemp = array('fc_session_admin_privileges' => '');
            $this->session->set_userdata($admindataTemp);
        }
        if ($this->session->userdata('fc_session_admin_name') == 'cassica') {
            $this->data['allPrev'] = '1';
            $admindataTemp = array('fc_session_admin_privileges' => '');
            $this->session->set_userdata($admindataTemp);
        }

        if ($this->session->userdata('ror_crm_session_admin_name') == $this->config->item('admin_name')) {
            $this->data['allPrevCrm'] = '1';
        }
        if ($this->session->userdata('ror_crm_session_admin_name') == 'tcadmin') {
            $this->data['allPrevCrm'] = '1';
            $admindataTempCrm = array('ror_crm_session_admin_privileges' => '', 'ror_crm_session_admin_type' => '');
            $this->session->set_userdata($admindataTempCrm);
        }
        if ($this->session->userdata('ror_crm_session_admin_name') == 'camille') {
            $this->data['allPrevCrm'] = '1';
            $admindataTempCrm = array('ror_crm_session_admin_privileges' => '', 'ror_crm_session_admin_type' => '');
            $this->session->set_userdata($admindataTempCrm);
        }
        if ($this->session->userdata('ror_crm_session_admin_name') == 'cassie') {
            $this->data['allPrevCrm'] = '1';
            $admindataTempCrm = array('ror_crm_session_admin_privileges' => '', 'ror_crm_session_admin_type' => '');
            $this->session->set_userdata($admindataTempCrm);
        }
        if ($this->session->userdata('ror_crm_session_admin_name') == 'garilynn') {
            $this->data['allPrevCrm'] = '1';
            $admindataTempCrm = array('ror_crm_session_admin_privileges' => '', 'ror_crm_session_admin_type' => '');
            $this->session->set_userdata($admindataTempCrm);
        }
        if ($this->session->userdata('ror_crm_session_admin_name') == 'rgarcia') {
            $this->data['allPrevCrm'] = '1';
            $admindataTempCrm = array('ror_crm_session_admin_privileges' => '', 'ror_crm_session_admin_type' => '');
            $this->session->set_userdata($admindataTempCrm);
        }
        if ($this->session->userdata('ror_crm_session_admin_name') == 'cassica') {
            $this->data['allPrevCrm'] = '1';
            $admindataTempCrm = array('ror_crm_session_admin_privileges' => '', 'ror_crm_session_admin_type' => '');
            $this->session->set_userdata($admindataTempCrm);
        }

        $this->data['paypal_ipn_settings'] = unserialize($this->config->item('payment_0'));
        $this->data['paypal_credit_card_settings'] = unserialize($this->config->item('payment_1'));
        $this->data['authorize_net_settings'] = unserialize($this->config->item('payment_2'));
        $this->data['currencySymbol'] = $this->config->item('currency_currency_symbol');
//		$this->data['currencySymbol'] = html_entity_decode($this->config->item('currency_currency_symbol'));
        $this->data['currencyType'] = $this->config->item('currency_currency_type');
        $this->data['datestring'] = "%Y-%m-%d %h:%i:%s";
        if ($this->checkLogin('U') != '') {
            $this->data['common_user_id'] = $this->checkLogin('U');
        } elseif ($this->checkLogin('T') != '') {
            $this->data['common_user_id'] = $this->checkLogin('T');
        } else {
            $temp_id = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $this->session->set_userdata('fc_session_temp_id', $temp_id);
            $this->data['common_user_id'] = $temp_id;
        }
        $this->data['emailArr'] = $this->config->item('emailArr');
        $this->data['notyArr'] = $this->config->item('notyArr');

        $this->data['MiniCartViewSet'] = $this->minicart_model->mini_cart_view($this->data['common_user_id']);
        $this->data['reservedStatus'] = $this->product_model->get_all_details(PRODUCT, array('property_status' => 'Reserved'));

        /*
         * Like button texts
         */
        define(LIKE_BUTTON, $this->config->item('like_text'));
        define(LIKED_BUTTON, $this->config->item('liked_text'));
        define(UNLIKE_BUTTON, $this->config->item('unlike_text'));

        if ($_SESSION['authUrl'] == '') {
            //header( 'Location:http://192.168.1.253/fancyclone/');
        }


        /* Refereral Start */

        if ($this->input->get('ref') != '') {
            //echo $this->input->get('ref');
            $referenceName = $this->input->get('ref');
            $this->session->set_userdata('referenceName', $referenceName);
        }

        /* Refereral End */

        /* Reservation Cancel start */

        /* if($_SESSION['reservation'] < time())
          { echo $_SESSION['reservation']."<br>".time(); die; */
        $reservedProperty = $this->product_model->getResevationSettingsOnce();
        //$getSoldSettingsDetails = $this->product_model->saveSoldSettings();
        //echo '<pre>'; print_r($reservedProperty);  die;
        //$reservedProperty = $this->product_model->get_all_details(PRODUCT,array('property_status'=>'Reserved'));
        if ($reservedProperty->num_rows() > 0) {
            foreach ($reservedProperty->result() as $rows) {
                //echo '<pre>'; print_r($rows);	//echo $rows['property_id'];
                $this->product_model->update_details(PRODUCT, array('property_status' => 'Active'), array('property_id' => $rows->property_id));
                $this->product_model->saveResevedSettings();
            }
        }
        /* 	} */

        /* Reservation Cancel end */
        $check_reserved = $this->product_model->reserved_details();
        if ($check_reserved->num_rows() > 0) {
            foreach ($check_reserved as $detail) {
                $time = time() - 600;
                if ($detail->reserved_time < $time) {
                    $this->product_model->update_details(PRODUCT, array('property_status' => 'Active', 'reserved_time' => ''), array('id' => $detail->id));
                }
            }
        }

        $this->data['adminloginCheck'] = $this->checkLogin('A');
        //$this->data['adminloginCheck'] = $this->checkLogin('A');
        //echo "<pre>"; print_r(get_defined_vars()); die;
    }
    public function base_url_image(){


		//return 'http://192.168.1.253/sivaprakash/returnonrentals/';

		//return 'http://projects.teamtweaks.com/returnonrentals/';

		#return 'http://192.168.1.251:8081/jayaprakash/returnonrentals/';

		return 'http://productimages.live/';

	}
    /**
     *
     * This function return the session value based on param
     * @param $type
     */
    public function checkLogin($type = '') {
		//print_r($this->session->userdata('ror_crm_session_admin_id'));
        if ($type == 'A') {
            return $this->session->userdata('fc_session_admin_id');
        } else if ($type == 'N') {
            return $this->session->userdata('fc_session_admin_name');
        } elseif ($type == 'M') {
            return $this->session->userdata('fc_session_admin_email');
        } elseif ($type == 'P') {
            return $this->session->userdata('fc_session_admin_privileges');
        } elseif ($type == 'U') {
            return $this->session->userdata('fc_session_user_id');
        } elseif ($type == 'T') {
            return $this->session->userdata('fc_session_temp_id');
        } elseif ($type == 'CA') {
            //print_r($this->session->userdata('ror_crm_session_admin_id'));
            return $this->session->userdata('ror_crm_session_admin_id');
        } elseif ($type == 'CN') {
            return $this->session->userdata('ror_crm_session_admin_name');
        } elseif ($type == 'CM') {
            return $this->session->userdata('ror_crm_session_admin_email');
        } elseif ($type == 'CP') {
            return $this->session->userdata('ror_crm_session_admin_privileges');
        }
    }

    /**
     *
     * This function set the error message and type in session
     * @param string $type
     * @param string $msg
     */
    public function setErrorMessage($type = '', $msg = '')
    {
        ($type == 'success') ? $msgVal = 'message-green' : $msgVal = 'message-red';
        $this->session->set_flashdata('sErrMSGType', $msgVal);
        $this->session->set_flashdata('sErrMSG', $msg);
    }

    /**
     *
     * This function check the admin privileges
     * @param String $name	->	Management Name
     * @param Integer $right	->	0 for view, 1 for add, 2 for edit, 3 delete
     */
    public function checkPrivileges($name = '', $right = '')
    {
        $prev = '0';

        if ($this->checkLogin('CA') != '') {
            $crm_privileges = $this->session->userdata('ror_crm_session_admin_privileges');
            //print_r($crm_privileges);die;
            $userName = $this->session->userdata('ror_crm_session_admin_name');
            extract($crm_privileges);
        }

        if ($this->checkLogin('A') != '') {
            $privileges = $this->session->userdata('fc_session_admin_privileges');
            $userName = $this->session->userdata('fc_session_admin_name');
            extract($privileges);
        }


        if (isset(${$name}) && is_array(${$name}) && in_array($right, ${$name})) {
            $prev = '1';
        }
        $adminName = $this->config->item('admin_name');
        if ($userName == $adminName) {
            $prev = '1';
        }
        if ($userName == 'tcadmin' || $userName == 'rgarcia' || $userName == 'garilynn' || $userName == 'cassica') {
            $prev = '1';
        }
        if ($prev == '1') {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * Generate random string
     * @param Integer $length
     */
    public function get_rand_str($length = '6')
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /**
     *
     * Unsetting array element
     * @param Array $productImage
     * @param Integer $position
     */
    public function setPictureProducts($productImage, $position)
    {
        unset($productImage[$position]);
        return $productImage;
    }

    /**
     * Image resize
     * @param int $width
     * @param int $height
     * @param string $targetImage Name
     * @param string $savepath
     */
    public function ImageResizeWithCrop($width, $height, $thumbImage, $savePath, $newhgt)
    {
        $thumb_file = $savePath . $thumbImage;

        $newimgPath = base_url() . substr($savePath, 2) . $thumbImage;

        /* Get original image x y */
        list($w, $h) = getimagesize($thumb_file);
        $size = getimagesize($thumb_file);
        /* calculate new image size with ratio */
        $ratio = max($width / $w, $height / $h);
        $h = ceil($height / $ratio);
        $x = ($w - $width / $ratio) / 2;
        $w = ceil($width / $ratio);
        /* new file name */
        $path = $savePath . $thumbImage;
        /* read binary data from image file */

        $imgString = file_get_contents($newimgPath);
        /* create image from string */
        $image = imagecreatefromstring($imgString);
        $tmp = imagecreatetruecolor($width, $height);
        imagecopyresampled($tmp, $image, 0, 0, $x, $newhgt, $width, $height, $w, $h);

        /* Save image */
        switch ($size["mime"]) {
            case 'image/jpeg':
                imagejpeg($tmp, $path, 100);
                break;
            case 'image/png':
                imagepng($tmp, $path, 0);
                break;
            case 'image/gif':
                imagegif($tmp, $path);
                break;
            default:
                exit;
                break;
        }

        /* cleanup memory */
        imagedestroy($image);
        imagedestroy($tmp);
        return $path;
    }

    /* function getReservationID() {
      $reservedID = $this->config->item('id_reservation');
      $_SESSION['reservedIDssVal'] = $reservedID;
      } */

    /**
     * Image Compress
     * @param int $quality
     * @param string $source_url
     * @param string $destination_url
     */
    public function ImageCompress($source_url, $destination_url, $quality = 80)
    {
        $info = getimagesize($source_url);
        $savePath = $source_url;

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($savePath);
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($savePath);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($savePath);
        }
        ### Saving Image
        imagejpeg($image, $savePath, $quality);
    }

    /**
     * Get Image resolution type
     * @param string $destination_url
     */
    public function getImageShape($width, $height, $target_file)
    {
        list($w, $h) = getimagesize($target_file);
        if ($w == $width && $h == $height) {
            $option = "exact";
        } elseif ($w > $h) {
            $option = "landscape";
        } elseif ($w < $h) {
            $option = "portrait";
        } else {
            $option = "crop";
        }
        return $option;
    }

}
