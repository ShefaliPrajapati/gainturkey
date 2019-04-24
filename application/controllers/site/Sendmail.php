<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * CMS related functions
 * @author Teamtweaks
 *
 */
class Sendmail extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie', 'date', 'form', 'email'));
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model(array('product_model', 'admin_model', 'cms_model'));
    }

    
    public function mail(){
        $email_values = array('mail_type' => 'html',
            'from_mail_id' => 'dev.innovegic@gmail.com',
            'mail_name' => 'Shailesh',
            'to_mail_id' => 'testshailesh1@gmail.com',
            'subject_message' => 'test Mail For SMTP'.date('d-m-Y h:i:s'),
            'body_messages' => 'Test'.date('d-m-Y h:i:s')
        );
        $email_send_to_common = $this->product_model->common_email_send($email_values);
        echo $this->email->print_debugger();die;
        var_dump($email_send_to_common);exit;
    }

    public function sentEmail() {
        $this->load->library('Utility');
        $this->load->library('email');
        $data ['username'] = 'Shailesh vanaliya';
        $data ['message'] = 'Test TestTestTest';
        $data ['from_title'] = 'Verify user email address';
        $data ['subject'] = 'Verify user email address';
        $data ["to"] = 'testshailesh1@gmail.com';
        $mailSend = $this->utility->sendMailSMTP($data);
        print_r($mailSend);exit;
    }

}
// User for tesing purpose only.
/*End of file cms.php */
/* Location: ./application/controllers/site/product.php */