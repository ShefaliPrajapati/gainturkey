<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to news management
 * @author Teamtweaks
 *
 */
class News extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie', 'date', 'form'));
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model('news_model');
        if ($this->checkPrivileges('news', $this->privStatus) == FALSE) {
            redirect('admin_ror');
        }
    }

    /**
     * 
     * This function loads the news list page
     */
    public function newsList() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'News List';
            $condition = array();
            $this->data['newsList'] = $this->news_model->get_all_details(news, $condition);
            $this->load->view('admin/news/list', $this->data);
        }
    }

    /**
     * 
     * This function loads the add new News form
     */
    public function add_news_form() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'Add New News';
            $this->load->view('admin/news/add', $this->data);
        }
    }

    /**
     * 
     * This function insert and edit a news
     */
    public function insertEditNews() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $news_id = $this->input->post('news_id');
            $newstitle = $this->input->post('newstitle');
            $newsdescription = $this->input->post('newsdescription');

            if ($this->input->post('status') != '') {
                $slider_status = 'Active';
            } else {
                $slider_status = 'Inactive';
            }
            $inputArr = array(
                'status' => $slider_status,
                'news_title' => $newstitle,
                'news_description' => $newsdescription
            );

            $config['overwrite'] = FALSE;
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['upload_path'] = './images/news';
            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('newsimage')) {
                $imgDetails = $this->upload->data();
                $inputArr['news_image'] = $imgDetails['file_name'];
            }
            $condition = array('news_id' => $news_id);
            if ($news_id == '') {
                $this->news_model->insertNews(news, 'insert', $inputArr, $condition);
                $this->setErrorMessage('success', 'News added successfully');
            } else {


                $this->news_model->insertNews(news, 'update', $inputArr, $condition);
                $this->setErrorMessage('success', 'News updated successfully');
            }
            redirect('admin/news/newsList');
        }
    }

    /**
     * 
     * This function loads the edit news form
     */
    public function edit_news_form() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'Edit News';
            $news_id = $this->uri->segment(4, 0);
            $condition = array('news_id' => $news_id);
            $this->data['news_details'] = $this->news_model->get_all_details(news, $condition);
            if ($this->data['news_details']->num_rows() == 1) {
                $this->load->view('admin/news/edit', $this->data);
            } else {
                redirect('admin_ror');
            }
        }
    }
    /**
     * 
     * This function loads the view news form
     */
    public function view_news() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'View News';
            $news_id = $this->uri->segment(4, 0);
            $condition = array('news_id' => $news_id);
            $this->data['news_details'] = $this->news_model->get_all_details(news, $condition);
            if ($this->data['news_details']->num_rows() == 1) {
                $this->load->view('admin/news/view', $this->data);
            } else {
                redirect('admin_ror');
            }
        }
    }
    /**
     * 
     * This function loads the delete news 
     */
    public function delete_news() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $news_id = $this->uri->segment(4, 0);
            $condition = array('news_id' => $news_id);
            $this->news_model->commonDelete(news, $condition);
            $this->setErrorMessage('success', 'News deleted successfully');
            redirect('admin/news/newsList');
        }
    }

    /**
     * 
     * This function change the news status
     */
    public function change_news_status() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $mode = $this->uri->segment(4, 0);
            $news_id = $this->uri->segment(5, 0);
            $status = ($mode == '0') ? 'Inactive' : 'Active';
            $newdata = array('status' => $status);
            $condition = array('news_id' => $news_id);
            $this->news_model->update_details(news, $newdata, $condition);
            $this->setErrorMessage('success', 'News Status Changed Successfully');
            redirect('admin/news/newsList');
        }
    }

    /**
     * 
     * This function change the user status, delete the news record
     */
    public function change_news_status_global() {
        if (count($_POST['checkbox_id']) > 0 && $_POST['statusMode'] != '') {
            $this->news_model->activeInactiveCommon(news, 'news_id');
            if (strtolower($_POST['statusMode']) == 'delete') {
                $this->setErrorMessage('success', 'News deleted successfully');
            } else {
                $this->setErrorMessage('success', 'News status changed successfully');
            }
            redirect('admin/news/newsList');
        }
    }

}
