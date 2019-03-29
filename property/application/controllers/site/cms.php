<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * CMS related functions
 * @author Teamtweaks
 *
 */
class Cms extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie', 'date', 'form', 'email'));
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model(array('product_model', 'admin_model', 'cms_model'));
        if ($_SESSION['sMainCategories'] == '') {
            $sortArr1 = array('field' => 'cat_position', 'type' => 'asc');
            $sortArr = array($sortArr1);
            $_SESSION['sMainCategories'] = $this->product_model->get_all_details(CATEGORY, array('rootID' => '0', 'status' => 'Active'), $sortArr);
        }
        $this->data['mainCategories'] = $_SESSION['sMainCategories'];

        if ($_SESSION['sColorLists'] == '') {
            $_SESSION['sColorLists'] = $this->product_model->get_all_details(LIST_VALUES, array('list_id' => '1'));
        }
        $this->data['mainColorLists'] = $_SESSION['sColorLists'];
        $this->data['SliderDisplay'] = $this->product_model->get_all_details(SLIDER, array('status' => 'Active'));
        $this->data['loginCheck'] = $this->checkLogin('U');
    }

    public function index() {
        $seourl = $this->uri->segment(2);
        $pageDetails = $this->product_model->get_all_details(CMS, array('seourl' => $seourl, 'status' => 'Publish', 'site' => 'main'));
        $this->data['menuActive'] = $pageDetails->row()->seourl;
        if ($pageDetails->num_rows() == 0) {
            show_404();
        } else {
            if ($pageDetails->row()->meta_title != '') {
                $this->data['heading'] = $pageDetails->row()->meta_title;
                $this->data['meta_title'] = $pageDetails->row()->meta_title;
            }
            if ($pageDetails->row()->meta_tag != '') {
                $this->data['meta_keyword'] = $pageDetails->row()->meta_tag;
            }
            if ($pageDetails->row()->meta_description != '') {
                $this->data['meta_description'] = $pageDetails->row()->meta_description;
            }
            $this->data['heading'] = $pageDetails->row()->meta_title;
            $this->data['pageDetails'] = $pageDetails;
            $this->data['admin_settings'] = $this->admin_model->getAdminSettings();
            $condition = array('site' => 'main');
            $this->data['cmsList'] = $this->cms_model->get_all_details(CMS, $condition);
            $this->load->view('site/cms/display_cms', $this->data);
        }
    }

    public function contact_view() {
        $this->data['heading'] = 'Contact Us';

        $this->data['menuActive'] = 'contact';
        /* $this->data['pageDetails'] = $pageDetails;
          $this->data['admin_settings'] = $this->admin_model->getAdminSettings();
          $this->data['cmsList'] = $this->cms_model->get_all_details(CMS,$condition); */
        $this->load->view('site/cms/display_contact', $this->data);
    }
    public function news(){
        $this->data['heading']='News';
        $this->data['menuActive']='news';
        $this->data['arr_news']=$this->cms_model->get_all_details(news, $condition);
        $this->load->view('site/cms/display_news',$this->data);
    }

    public function page_by_id() {
        $cid = $this->uri->segment(2);
        $pageDetails = $this->product_model->get_all_details(CMS, array('id' => $cid, 'status' => 'Publish', 'site' => 'main'));
        if ($pageDetails->num_rows() == 0) {
            show_404();
        } else {
            if ($pageDetails->row()->meta_title != '') {
                $this->data['heading'] = $pageDetails->row()->meta_title;
                $this->data['meta_title'] = $pageDetails->row()->meta_title;
            }
            if ($pageDetails->row()->meta_tag != '') {
                $this->data['meta_keyword'] = $pageDetails->row()->meta_tag;
            }
            if ($pageDetails->row()->meta_description != '') {
                $this->data['meta_description'] = $pageDetails->row()->meta_description;
            }
            $this->data['heading'] = $pageDetails->row()->meta_title;
            $this->data['pageDetails'] = $pageDetails;
            $this->load->view('site/cms/display_cms', $this->data);
        }
    }

}

/*End of file cms.php */
/* Location: ./application/controllers/site/product.php */