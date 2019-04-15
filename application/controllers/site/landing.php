<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * Landing page functions
 * @author Teamtweaks
 *
 */
class Landing extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('cookie', 'date', 'form', 'email', 'html'));
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model('product_model');

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

        $this->data['loginCheck'] = $this->checkLogin('U');
        //		echo $this->session->userdata('fc_session_user_id');die;
        $this->data['SliderDisplay'] = $this->product_model->get_all_details(SLIDER, array('status' => 'Active', 'site' => 'main'));
        $this->data['likedProducts'] = array();
    }

    /**
     *
     *
     */
    public function index()
    {
        $this->data['heading'] = '';
        $this->data['totalProducts'] = $this->product_model->get_total_records(PRODUCT);
        //$this->data['FeaturedProducts'] = $this->product_model->get_all_details(PRODUCT,array('status'=>'Publish','featured' =>'Yes'));

        $this->data['FeaturedProducts'] = $this->product_model->view_product_details(' where p.property_status="Active" and p.featured="Yes" and p.display_main="yes" group by p.id order by p.event_price asc');

        $this->data['product_image'] = $this->product_model->Display_product_image_details();


        $this->data['videolist'] = $this->product_model->get_all_details(VIDEO, array('status' => 'Active'));
        //echo "<pre>"; print_r($this->data['videolist']->result()); die;
        $this->data['HomePageContentLeft'] = $this->product_model->get_all_details(CMS, array('seourl' => 'turn-key-real-estate', 'site' => 'main'));

        $this->data['HomePageContentRight'] = $this->product_model->get_all_details(CMS, array('seourl' => 'cash-flowing', 'site' => 'main'));
        $this->data['menuactcat'] = '0';
        $this->data['menuact'] = 'viewall';
        $this->load->view('site/landing/landing', $this->data);
    }

    public function home()
    {
        $this->data['heading'] = '';
        $this->data['totalProducts'] = $this->product_model->get_total_records(PRODUCT);


        $this->data['FeaturedProducts'] = $this->product_model->view_product_details(' where p.property_status="Active" and p.featured="Yes" and p.display_main="yes" group by p.id order by p.event_price asc');

        $this->data['product_image'] = $this->product_model->Display_product_image_details();


        $this->data['videolist'] = $this->product_model->get_all_details(VIDEO, array('status' => 'Active'));
        //echo "<pre>"; print_r($this->data['videolist']->result()); die;
        $this->data['HomePageContentLeft'] = $this->product_model->get_all_details(CMS, array('seourl' => 'turn-key-real-estate', 'site' => 'main'));

        $this->data['HomePageContentRight'] = $this->product_model->get_all_details(CMS, array('seourl' => 'cash-flowing', 'site' => 'main'));
        $this->data['menuactcat'] = '0';
        $this->data['menuact'] = 'viewall';
        $this->load->view('home', $this->data);
    }
}

/* End of file landing.php */
/* Location: ./application/controllers/site/landing.php */
