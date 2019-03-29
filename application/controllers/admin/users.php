<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */
class Users extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie', 'date', 'form'));
        $this->load->library(array('encrypt', 'form_validation'));
        $this->load->model('user_model');
        if ($this->checkPrivileges('user', $this->privStatus) == FALSE) {
            redirect('admin_ror');
        }
    }

    /**
     * 
     * This function loads the users list page
     */
    public function index() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            redirect('admin/users/display_user_list');
        }
    }

    /**
     * 
     * This function loads the users list page
     */
    public function display_user_list() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'Users List';
            $condition = array();
            $this->data['usersList'] = $this->user_model->get_all_details(USERS, $condition);
            $this->load->view('admin/users/display_userlist', $this->data);
        }
    }

    /**
     * 
     * This function loads the users dashboard
     */
    public function display_user_dashboard() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'Users Dashboard';
            $condition = 'order by `created` desc';
            $this->data['usersList'] = $this->user_model->get_users_details($condition);
            $this->load->view('admin/users/display_user_dashboard', $this->data);
        }
    }

    /**
     * 
     * This function loads the add new user form
     */
    public function add_user_form() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'Add New User';
            $this->load->view('admin/users/add_user', $this->data);
        }
    }

    /**
     * 
     * This function insert and edit a user
     */
    public function insertEditUser() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $user_id = $this->input->post('user_id');
            $user_name = $this->input->post('user_name');
            $password = md5($this->input->post('new_password'));
            $email = $this->input->post('email');
            if ($user_id == '') {
                $unameArr = $this->config->item('unameArr');
                if (!preg_match('/^\w{1,}$/', trim($user_name))) {
                    $this->setErrorMessage('error', 'User name not valid. Only alphanumeric allowed');
                    echo "<script>window.history.go(-1);</script>";
                    exit;
                }
                if (in_array($user_name, $unameArr)) {
                    $this->setErrorMessage('error', 'User name already exists');
                    echo "<script>window.history.go(-1);</script>";
                    exit;
                }

                $condition = array('email' => $email);
                $duplicate_mail = $this->user_model->get_all_details(USERS, $condition);
                if ($duplicate_mail->num_rows() > 0) {
                    $this->setErrorMessage('error', 'User email already exists');
                    redirect('admin/users/add_user_form');
                }
            }
            $excludeArr = array("user_id", "new_password", "confirm_password", "status");

            if ($this->input->post('group') != '') {
                $user_group = 'User';
            } else {
                $user_group = 'Admin';
            }

            if ($this->input->post('status') != '') {
                $user_status = 'Active';
            } else {
                $user_status = 'Inactive';
            }
            if ($this->input->post('user_id') == '') {
                $user_group = 'User';
            }
            $datestring = "%Y-%m-%d";
            $time = time();

            if ($user_group == 'User') {
                if ($user_id == '') {
                    $dataArr = array('first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'user_name' => $this->input->post('user_name'),
                        'email' => $this->input->post('email'),
                        'password' => $password,
                        'address' => $this->input->post('address1'),
                        'address1' => $this->input->post('address2'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'phone_no' => $this->input->post('phone_no'),
                        'is_verified' => 'No',
                        'group' => 'User',
                        'status' => $user_status,
                        'created' => mdate($datestring, $time)
                    );
                } else {
                    $dataArr = array('first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'user_name' => $this->input->post('user_name'),
                        'email' => $this->input->post('email'),
                        'phone_no' => $this->input->post('phone_no'),
                        'group' => $user_group,
                        'status' => $user_status,
                        'modified' => mdate($datestring, $time)
                    );
                }


                $condition = array('id' => $user_id);
                if ($user_id == '') {
                    $condition1 = array('email' => $this->input->post('email'));
                    $this->user_model->simple_insert(USERS, $dataArr);
                    $this->setErrorMessage('success', 'User added successfully');

                    $details = $this->user_model->get_all_details(USERS, $condition1);
                    if ($details->num_rows() == 1) {
                        $this->send_confirm_mail($details);
                    }
                } else {
                    $this->user_model->commonInsertUpdate(USERS, 'update', $excludeArr, $dataArr, $condition);
                    $this->setErrorMessage('success', 'User updated successfully');
                }
            } else {
                $deleteDetails = $this->user_model->get_all_details(USERS, array('id' => $user_id));
                if ($deleteDetails->num_rows() == 1) {
                    $this->user_model->commonDelete(USERS, array('id' => $user_id));
                }

                $dataArr = array('admin_name' => $this->input->post('user_name'),
                    'email' => $this->input->post('email'),
                    'admin_password' => $password,
                    'privileges' => 'a:5:{s:4:"user";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:8:"location";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:5:"pages";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:6:"slider";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}s:6:"videos";a:4:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}}',
                    'login_type' => 'main',
                    'is_verified' => 'Yes',
                    'admin_type' => 'sub',
                    'status' => 'Active',
                    'created' => mdate($datestring, $time)
                );

                $condition1 = array('email' => $this->input->post('email'));
                $this->user_model->simple_insert(SUBADMIN, $dataArr);
                $this->setErrorMessage('success', 'Successfully converted the User to SubAdmin');

                $details = $this->user_model->get_all_details(SUBADMIN, $condition1);
                if ($details->num_rows() == 1) {
                    $this->send_confirm_mail_admin($details, $pass);
                }
            }
            redirect('admin/users/display_user_list');
        }
    }

    /**
     * 
     * This function loads the edit user form
     */
    public function edit_user_form() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'Edit User';
            $user_id = $this->uri->segment(4, 0);
            $condition = array('id' => $user_id);
            $this->data['user_details'] = $this->user_model->get_all_details(USERS, $condition);
            if ($this->data['user_details']->num_rows() == 1) {
                $this->load->view('admin/users/edit_user', $this->data);
            } else {
                redirect('admin_ror');
            }
        }
    }

    /**
     * 
     * This function loads the edit user form
     */
    public function send_confirm_mail($userDetails = '') {

        $uid = $userDetails->row()->id;
        $email = $userDetails->row()->email;
        $randStr = $this->get_rand_str('10');
        $condition = array('id' => $uid);
        $dataArr = array('verify_code' => $randStr);
        $this->user_model->update_details(USERS, $dataArr, $condition);
        $newsid = '3';
        $template_values = $this->user_model->get_newsletter_template_details($newsid);

        $cfmurl = base_url() . 'site/user/confirm_register/' . $uid . "/" . $randStr . "/confirmation";
        $subject = 'From: ' . $this->config->item('email_title') . ' - ' . $template_values['news_subject'];
        $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo']);
        extract($adminnewstemplateArr);
        //$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
        $header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";

        $message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
        include('./newsletter/registeration' . $newsid . '.php');

        $message .= '</body>
			</html>';

        if ($template_values['sender_name'] == '' && $template_values['sender_email'] == '') {
            $sender_email = $this->data['siteContactMail'];
            $sender_name = $this->data['siteTitle'];
        } else {
            $sender_name = $template_values['sender_name'];
            $sender_email = $template_values['sender_email'];
        }

        $email_values = array('mail_type' => 'html',
            'from_mail_id' => $sender_email,
            'mail_name' => $sender_name,
            'to_mail_id' => $email,
            'subject_message' => $template_values['news_subject'],
            'body_messages' => $message
        );
        $email_send_to_common = $this->product_model->common_email_send($email_values);
        //echo "<pre>"; print_r($email_values); die;
    }

    public function send_confirm_mail_admin($userDetails = '') {
        $email = $userDetails->row()->email;
        $cfmurl = base_url() . 'admin_ror';
        $pass = $this->get_rand_str('10');
        $condition = array('email' => $email);
        $dataArr = array('admin_password' => md5($pass));
        $this->user_model->update_details(SUBADMIN, $dataArr, $condition);

        $newsid = '6';
        $template_values = $this->user_model->get_newsletter_template_details($newsid);

        $subject = 'From: ' . $this->config->item('email_title') . ' - ' . $template_values['news_subject'];
        $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo'], 'user_name' => $userDetails->row()->admin_name, 'password' => $pass, 'email' => $userDetails->row()->email);
        extract($adminnewstemplateArr);
        //$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
        $header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";

        $message .= '<!DOCTYPE HTML>
						<html>
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<meta name="viewport" content="width=device-width"/><body>';
        include('./newsletter/registeration' . $newsid . '.php');

        $message .= '</body>
						</html>';

        if ($template_values['sender_name'] == '' && $template_values['sender_email'] == '') {
            $sender_email = $this->data['siteContactMail'];
            $sender_name = $this->data['siteTitle'];
        } else {
            $sender_name = $template_values['sender_name'];
            $sender_email = $template_values['sender_email'];
        }

        $email_values = array('mail_type' => 'html',
            'from_mail_id' => $sender_email,
            'mail_name' => $sender_name,
            'to_mail_id' => $email,
            'subject_message' => $template_values['news_subject'],
            'body_messages' => $message
        );
        $email_send_to_common = $this->product_model->common_email_send($email_values);
        //echo "<pre>"; print_r($email_values); die;
    }

    /**
     * 
     * This function change the user status
     */
    public function change_user_status() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $mode = $this->uri->segment(4, 0);
            $user_id = $this->uri->segment(5, 0);
            $status = ($mode == '0') ? 'Inactive' : 'Active';
            $newdata = array('status' => $status);
            $condition = array('id' => $user_id);
            $this->user_model->update_details(USERS, $newdata, $condition);
            $this->setErrorMessage('success', 'User Status Changed Successfully');
            redirect('admin/users/display_user_list');
        }
    }

    /**
     * 
     * This function loads the user view page
     */
    public function view_user() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $this->data['heading'] = 'View User';
            $user_id = $this->uri->segment(4, 0);
            $condition = array('id' => $user_id);
            $this->data['user_details'] = $this->user_model->get_all_details(USERS, $condition);
            if ($this->data['user_details']->num_rows() == 1) {
                $this->load->view('admin/users/view_user', $this->data);
            } else {
                redirect('admin_ror');
            }
        }
    }

    /**
     * 
     * This function delete the user record from db
     */
    public function delete_user() {
        if ($this->checkLogin('A') == '') {
            redirect('admin_ror');
        } else {
            $user_id = $this->uri->segment(4, 0);
            $condition = array('id' => $user_id);
            $this->user_model->commonDelete(USERS, $condition);
            $this->setErrorMessage('success', 'User deleted successfully');
            redirect('admin/users/display_user_list');
        }
    }

    /**
     * 
     * This function change the user status, delete the user record
     */
    public function change_user_status_global() {
        if (count($_POST['checkbox_id']) > 0 && $_POST['statusMode'] != '') {
            if (strtolower($_POST['statusMode']) == 'resetpassword') {
                $id1 = $_POST['checkbox_id'];
                $id = $id1[0];
                $pass = $_POST['password_value'];
                $this->admin_reset_password($id, $pass);
            }

            $this->user_model->activeInactiveCommon(USERS, 'id');
            if (strtolower($_POST['statusMode']) == 'delete') {
                $this->setErrorMessage('success', 'User records deleted successfully');
            } else {
                $this->setErrorMessage('success', 'User records status changed successfully');
            }
            redirect('admin/users/display_user_list');
        }
    }

    public function admin_reset_password($id = '', $pass = '') {
        $Details = $this->user_model->get_all_details(USERS, array('id' => $id));
        if ($Details->num_rows() == 1) {
            $this->user_model->update_details(USERS, array('password' => md5($pass)), array('id' => $id));
            $this->send_user_password($pass, $Details);
            $this->setErrorMessage('success', 'Password reset successfully');
            redirect('admin/users/display_user_list');
        }
    }

    public function send_user_password($pwd = '', $query) {
        $group = $query->row()->group;
        $newsid = '11';
        $template_values = $this->user_model->get_newsletter_template_details($newsid);
        $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => $this->data['logo']);
        extract($adminnewstemplateArr);
        $subject = 'From: ' . $this->config->item('email_title') . ' - ' . $template_values['news_subject'];
        $message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>' . $template_values['news_subject'] . '</title>
			<body>';
        include('./newsletter/registeration' . $newsid . '.php');

        $message .= '</body>
			</html>';


        if ($template_values['sender_name'] == '' && $template_values['sender_email'] == '') {
            $sender_email = $this->config->item('site_contact_mail');
            $sender_name = $this->config->item('email_title');
        } else {
            $sender_name = $template_values['sender_name'];
            $sender_email = $template_values['sender_email'];
        }

        $email_values = array('mail_type' => 'html',
            'from_mail_id' => $sender_email,
            'mail_name' => $sender_name,
            'to_mail_id' => $query->row()->email,
            'subject_message' => 'Password Reset',
            'body_messages' => $message
        );
        $email_send_to_common = $this->product_model->common_email_send($email_values);

        /* 		echo $this->email->print_debugger();die;
         */
    }

    public function account_active_mail() {
        $uid = $this->uri->segment(4, 0);
        $condition = array('id' => $uid);
        $checkUser = $this->user_model->get_all_details(USERS, $condition);

        if ($checkUser->row()->is_verified == 'Yes') {
            $this->setErrorMessage('error', 'User already verified');
            redirect('admin/users/display_user_list');
        }
        $conditionArr = array('id' => $uid);
        $dataArr = array('is_verified' => 'Yes');
        $this->user_model->update_details(USERS, $dataArr, $condition);
        $this->setErrorMessage('success', 'Great going ! User mail ID has been verified');
        redirect('admin/users/display_user_list');
    }

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */