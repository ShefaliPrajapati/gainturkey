<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * Contact page functions
 * @author Teamtweaks
 *
 */
class Contact extends MY_Controller
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
        $this->data['SliderDisplay'] = $this->product_model->get_all_details(SLIDER, array('status' => 'Active'));
        //		echo $this->session->userdata('fc_session_user_id');die;
        $this->data['likedProducts'] = array();
        if ($this->data['loginCheck'] != '') {
            $this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES, array('user_id' => $this->checkLogin('U')));
        }
    }
    
    /**
     *
     *
     */
    public function index()
    {
        $this->data['heading'] = 'Dashboard';
        $this->data['totalProducts'] = $this->product_model->get_total_records(PRODUCT);

        $this->data['FeaturedProducts'] = $this->product_model->Display_product_featured_details();
        $this->data['CityDetails'] = $this->product_model->Display_Product_City_details();
        $this->data['productDetails'] = $this->product_model->view_product_details(" where p.status='Publish' and p.quantity > 0 and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0 order by p.created desc limit 39");
        $this->load->view('site/landing/landing', $this->data);
    }


    /**
     *
     * Loading display owners inquiries detail page
     */
    public function display_inquiries_detail($productId = '')
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'Inquiry Management';
            $condition = array('id' => $this->checkLogin('U'));
            $sort = array('field' => 'id', 'type' => 'desc');
            $user = $this->product_model->get_all_details(USERS, $condition);


            if ($productId == '') {
                if ($user->row()->group == 'Seller') {
                    $this->data['InquirieDisplay'] = $this->product_model->get_all_details(CONTACT, array('status' => 'Active', 'renter_id' => $this->checkLogin('U')), array($sort));
                    $this->data['Group'] = 'seller';
                } else {
                    $this->data['InquirieDisplay'] = $this->product_model->get_all_details(CONTACT, array('status' => 'Active', 'customer_id' => $this->checkLogin('U')), array($sort));
                }
            } else {
                if ($user->row()->group == 'Seller') {
                    $this->data['InquirieDisplay'] = $this->product_model->get_all_details(CONTACT, array('status' => 'Active', 'renter_id' => $this->checkLogin('U'), 'rental_id' => $productId), array($sort));
                    $this->data['Group'] = 'seller';
                } else {
                    $this->data['InquirieDisplay'] = $this->product_model->get_all_details(CONTACT, array('status' => 'Active', 'customer_id' => $this->checkLogin('U')), array($sort));
                }
            }
            $this->data['ProductDisplay'] = $this->product_model->get_selected_fields_records('product_name,id', PRODUCT, array('status' => 'Publish'));
            $this->load->view('site/user/view_inquiries', $this->data);
        }
    }

    /**
     *
     * Loading display owners login detail page
     */
    public function admin_settings()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'Owner Settings';
            $this->data['AdminDisplay'] = $this->product_model->get_all_details(USERS, array('status' => 'Active', 'id' => $this->checkLogin('U')));
            $this->load->view('site/user/view_owner', $this->data);
        }
    }

    /**
     *
     * Loading delete owners inquiries detail page
     */
    public function Delete_inquiry_details()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $enqid = $this->input->post('inqID');
            $condition = array('id' => $enqid);
            $this->product_model->commonDelete(CONTACT, $condition);
            echo $success = 'Contact deleted successfully';
        }
    }

    /**
     *
     * Loading display owners inquiries detail page
     */
    public function view_inquiry_details($enqid)
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'View Inquiry Details';
            $user = $this->product_model->get_all_details(USERS, array('id' => $this->checkLogin('U')));
            $this->load->model('contact_model');
            if ($user->row()->group == 'Seller') {
                $this->data['InquirieDisplay'] = $this->contact_model->get_all_details(CONTACT, array('status' => 'Active', 'renter_id' => $this->checkLogin('U'), 'id' => $enqid));
                $this->data['replies'] = $this->contact_model->comment_reply(array('comment_id' => $this->data['InquirieDisplay']->row()->id));
                $this->data['commenter'] = $this->contact_model->get_all_details(USERS, array('id' => $this->data['replies']->row()->user_id));
            } else {
                $this->data['InquirieDisplay'] = $this->contact_model->get_all_details(CONTACT, array('status' => 'Active', 'customer_id' => $this->checkLogin('U'), 'id' => $enqid));
                $this->data['replies'] = $this->contact_model->comment_reply(array('comment_id' => $this->data['InquirieDisplay']->row()->id));
                $this->data['commenter'] = $this->contact_model->get_all_details(USERS, array('id' => $this->data['replies']->row()->user_id));
            }
            $this->data['ProductDisplay'] = $this->product_model->get_selected_fields_records('product_name,id', PRODUCT, array('status' => 'Publish', 'id' => $this->data['InquirieDisplay']->row()->rental_id));
            $this->load->view('site/owner/popup', $this->data);
        }
    }

    public function edit_inquiry_details($enqid)
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'Edit Inquiry Details';
            $user = $this->product_model->get_all_details(USERS, array('id' => $this->checkLogin('U')));
            $this->load->model('contact_model');
            if ($user->row()->group == 'Seller') {
                $this->data['InquirieDisplay'] = $this->contact_model->get_all_details(CONTACT, array('status' => 'Active', 'renter_id' => $this->checkLogin('U'), 'id' => $enqid));
                $this->data['replies'] = $this->contact_model->comment_reply(array('comment_id' => $this->data['InquirieDisplay']->row()->id));
                $this->data['commenter'] = $this->contact_model->get_all_details(USERS, array('id' => $this->data['replies']->row()->user_id));
            } else {
                $this->data['InquirieDisplay'] = $this->contact_model->get_all_details(CONTACT, array('status' => 'Active', 'customer_id' => $this->checkLogin('U'), 'id' => $enqid));
                $this->data['replies'] = $this->contact_model->comment_reply(array('comment_id' => $this->data['InquirieDisplay']->row()->id));
                $this->data['commenter'] = $this->contact_model->get_all_details(USERS, array('id' => $this->data['replies']->row()->user_id));
            }
            $this->data['ProductDisplay'] = $this->product_model->get_selected_fields_records('product_name,id', PRODUCT, array('status' => 'Publish', 'id' => $this->data['InquirieDisplay']->row()->rental_id));
            $this->load->view('site/owner/edit_inquiry', $this->data);
        }
    }

    /**
     *
     * Loading display owners inquiries detail page
     */
    public function view_review_details()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $enqid = $this->input->post('inqID');
            $this->data['heading'] = 'View Review Details';
            $this->data['InquirieDisplay'] = $this->product_model->get_all_details(REVIEW, array('id' => $enqid));
            $this->data['ProductDisplay'] = $this->product_model->get_selected_fields_records('product_name,id', PRODUCT, array('id' => $this->data['InquirieDisplay']->row()->product_id));
            $this->data['userDetail'] = $this->product_model->get_all_details(USERS, array('id' => $this->checkLogin('U')));
            if ($this->data['userDetail']->row()->group == 'Seller') {
                $this->load->view('site/owner/review_popup', $this->data);
            } else {
                $this->load->view('site/owner/review_popup_user', $this->data);
            }
        }
    }

    public function review_reply()
    {
        //$dataArr=
        $condition = array('id' => $this->input->post('id'));
        $dataArr = array('owner_reply' => $this->input->post('reply'));
        $this->product_model->update_details(REVIEW, $dataArr, $condition);
        $this->SetErrorMessage('success', 'Your reply added successfully');
        echo "<script>window.history.go(-1)</script>";
    }

    public function inquiry_reply()
    {
        //$dataArr=

        $dataArr = array('reply' => $this->input->post('reply'), 'comment_id' => $this->input->post('id'), 'user_id' => $this->checkLogin('U'));
        $this->product_model->simple_insert(REPLIES, $dataArr, $condition);
        $this->SetErrorMessage('success', 'Your reply added successfully');
        echo "<script>window.history.go(-1)</script>";
    }

    public function contact_owner()
    {
        $GetUId = $this->checkLogin('U');
        if ($GetUId == '0') {
            $GetUId = 'ram';
        }
        if ($GetUId == $this->input->post('renter_id')) {
            $this->setErrorMessage('error', 'You cannot add comment for your own product');
            redirect(dashboard);
        } else {
            $data = array('customer_id' => $GetUId);
            $this->load->model('contact_model');
            $cont_own = $this->contact_model->insert_contact_info($data);
            $user_details = $this->product_model->get_all_details(USERS, array('id' => $this->input->post('renter_id')));
            if ($user_details->num_rows() == 1) {
                $cont_count = $user_details->row()->contact_count;
                $cont_count++;
            }

            $condition = array('id' => $this->input->post('renter_id'));
            $this->product_model->update_details(USERS, array('contact_count' => $cont_count), $condition);

            $productDetails = $this->product_model->get_all_details(PRODUCT, array('id' => $this->input->post('rental_id')));
            $pro_cont_count = $productDetails->row()->contact_count;
            $pro_cont_count++;

            $condition1 = array('id' => $this->input->post('rental_id'));

            $this->product_model->update_details(PRODUCT, array('contact_count' => $pro_cont_count), $condition1);
            $Renter_details = $this->contact_model->get_all_details(USERS, $condition);
            $Rental_details = $this->contact_model->get_all_details(PRODUCT, $condition1);
            //---------------email to user---------------------------
            $newsid = '1';
            $template_values = $this->contact_model->get_newsletter_template_details($newsid);

            $cfmurl = base_url() . 'site/user/confirm_register/' . $uid . "/" . $randStr . "/confirmation";
            $subject = 'From: ' . $this->config->item('email_title') . ' - ' . $template_values['news_subject'];

            $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>' . $template_values['news_subject'] . '</title>
			<body>' . $template_values['news_descrip'] . '</body>
			</html>';

            if ($template_values['sender_name'] == '' && $template_values['sender_email'] == '') {
                $sender_email = $this->data['siteContactMail'];
                $sender_name = $this->data['siteTitle'];
            } else {
                $sender_name = $template_values['sender_name'];
                $sender_email = $template_values['sender_email'];
            }

            $message = str_replace('{$ph_no}', $this->input->post('ph_no'), $message);
            $message = str_replace('{$email_address}', $this->input->post('email_address'), $message);
            $message = str_replace('{$adults}', $this->input->post('adults'), $message);
            $message = str_replace('{$children}', $this->input->post('children'), $message);
            $message = str_replace('{$first_name}', $this->input->post('first_name'), $message);
            $message = str_replace('{$last_name}', $this->input->post('last_name'), $message);
            $message = str_replace('{$enter_fname}', $Renter_details->row()->first_name, $message);
            $message = str_replace('{$enter_lname}', $Renter_details->row()->last_name, $message);
            $message = str_replace('{$rental_name}', $Renter_details->row()->product_name, $message);
            $message = str_replace('{$rental_id}', $this->input->post('renter_id'), $message);
            $message = str_replace('{$Arr_date}', $this->input->post('Arr_date'), $message);
            $message = str_replace('{$Dep_date}', $this->input->post('Dep_date'), $message);
            $message = str_replace('{$Message}', $this->data['userDetails']->row()->user_name, $message);
            $message = str_replace('{$email_title}', $sender_name, $message);
            $message = str_replace('{$meta_title}', $sender_name, $message);
            $message = str_replace('{base_url()}images/logo/{$logo}', base_url() . 'images/logo/logo.png', $message);
            $message = str_replace('{base_url()}', base_url(), $message);

            $email_values = array('mail_type' => 'html',
                'from_mail_id' => $sender_email,
                'mail_name' => $sender_name,
                'to_mail_id' => $this->input->post('email_address'),
                'subject_message' => $template_values['news_subject'],
                'body_messages' => $message
            );
            $email_send_to_common = $this->contact_model->common_email_send($email_values);


            //email to admin
            $newsid = '9';
            $template_values = $this->contact_model->get_newsletter_template_details($newsid);

            $cfmurl = base_url() . 'site/user/confirm_register/' . $uid . "/" . $randStr . "/confirmation";
            $subject = 'From: ' . $this->config->item('email_title') . ' - ' . $template_values['news_subject'];

            //					$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> base_url().'images/logo/logo.png','first_name'=>$this->input->post('first_name'),'last_name'=>$this->input->post('last_name'),'adults'=>$this->input->post('adults'),'children'=>$this->input->post('children'),'email_address'=>$this->input->post('email_address'),'ph_no'=>$this->input->post('ph_no'),'Message'=>$this->input->post('Message'),'Arr_date'=>$this->input->post('Arr_date'),'Dep_date'=>$this->input->post('Dep_date'),'renter_id'=>$this->input->post('renter_id'),'rental_id'=>$this->input->post('rental_id'),'renter_fname'=>$Renter_details->row()->first_name,'renter_lname'=>$Renter_details->row()->last_name,'rental_name'=>$Rental_details->row()->product_name);
            //					extract($adminnewstemplateArr);

            $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title><body>'.$template_values['news_descrip'].'</body>
			</html>';

            if ($template_values['sender_name'] == '' && $template_values['sender_email'] == '') {
                $sender_email = $this->data['siteContactMail'];
                $sender_name = $this->data['siteTitle'];
            } else {
                $sender_name = $template_values['sender_name'];
                $sender_email = $template_values['sender_email'];
            }

            $message = str_replace('{$rental_id}', $this->input->post('rental_id'), $message);
            $message = str_replace('{$Arr_date}', $this->input->post('Arr_date'), $message);
            $message = str_replace('{$Dep_date}', $this->input->post('Dep_date'), $message);
            $message = str_replace('{$Message}', $this->input->post('Message'), $message);
            $message = str_replace('{$email_title}', $sender_name, $message);
            $message = str_replace('{$meta_title}', $sender_name, $message);
            $message = str_replace('{base_url()}images/logo/{$logo}', base_url() . 'images/logo/logo.png', $message);

            $email_values2 = array('mail_type' => 'html',
                'from_mail_id' => $sender_email,
                'mail_name' => $sender_email,
                'to_mail_id' => $this->input->post('email_address'),
                'subject_message' => $template_values['news_subject'],
                'body_messages' => $message
            );

            $email_send_to_common1 = $this->contact_model->common_email_send($email_values2);


            //Email to owner

            if ($this->input->post('renter_id') > 0) {
                $email_values3 = array('mail_type' => 'html',
                    'from_mail_id' => $sender_email,
                    'mail_name' => $sender_name,
                    'to_mail_id' => $this->input->post('RenterEmail'),
                    'subject_message' => $template_values['news_subject'],
                    'body_messages' => $message
                );
                $email_send_to_common2 = $this->contact_model->common_email_send($email_values3);
            }

            $this->setErrorMessage('success', 'Contact details sent to owner');
            redirect(base_url());
        }
    }

    public function contact_booking()
    {
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $productId = $this->input->post('rental_id');
            $arrival = $this->input->post('arrival_date');
            $depature = $this->input->post('depature_date');
            $dates = $this->getDatesFromRange($arrival, $depature);

            $this->load->model('contact_model');
            foreach ($dates as $date) {
                $dataArr = array('PropId' => $productId,
                    'id_state' => 1,
                    'id_item' => 1,
                    'the_date' => $date
                );
                $this->contact_model->simple_insert(CALENDARBOOKING, $dataArr);
            }
            $this->product_model->update_details(CONTACT, array('inquired_status' => 'Booked'), array('id' => $this->input->post('cntId')));

            $condition = array('id' => $this->input->post('renter_id'));
            $condition1 = array('id' => $this->input->post('rental_id'));
            $Renter_details = $this->contact_model->get_all_details(USERS, $condition);
            $Rental_details = $this->contact_model->get_all_details(PRODUCT, $condition1);
            //---------------email to user---------------------------
            //$newsid='1';
            $template_values = $this->contact_model->get_newsletter_template_details($newsid);

            $cfmurl = base_url() . 'site/user/confirm_register/' . $uid . "/" . $randStr . "/confirmation";
            $subject = 'From: ' . $this->config->item('email_title') . ' - ' . $template_values['news_subject'];
            $adminnewstemplateArr = array('email_title' => $this->config->item('email_title'), 'logo' => base_url() . 'images/logo/logo.png', 'first_name' => $this->input->post('first_name'), 'last_name' => $this->input->post('last_name'), 'adults' => $this->input->post('adults'), 'children' => $this->input->post('children'), 'email_address' => $this->input->post('email_address'), 'ph_no' => $this->input->post('ph_no'), 'Message' => $this->input->post('Message'), 'Arr_date' => $this->input->post('Arr_date'), 'Dep_date' => $this->input->post('Dep_date'), 'renter_id' => $this->input->post('renter_id'), 'rental_id' => $this->input->post('rental_id'), 'renter_fname' => $Renter_details->row()->first_name, 'renter_lname' => $Renter_details->row()->last_name, 'rental_name' => $Rental_details->row()->product_name);
            extract($adminnewstemplateArr);
            //$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
            $header .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";

            $message .= '<!DOCTYPE HTML>
						<html>
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<meta name="viewport" content="width=device-width"/><body>';
            $message .= 'Your inquiry for the rental <b>' . $Rental_details->row()->product_name . '</b> is booked <br>';
            $message .= 'Arrival date: ' . $arrival . '<br> Depature date: ' . $depature;
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
                'to_mail_id' => $this->input->post('email_address'),
                'subject_message' => $template_values['news_subject'],
                'body_messages' => $message
            );
            $email_send_to_common = $this->contact_model->common_email_send($email_values);

            //print_r($email_values); die;

            /***************************************************************/

            $this->setErrorMessage("success", "Rental booked");
            redirect(base_url() . "view_inquiries");
        }
    }

    public function getDatesFromRange($start, $end)
    {
        $dates = array($start);
        while (end($dates) < $end) {
            $dates[] = date('Y-m-d', strtotime(end($dates) . ' +1 day'));
        }

        return $dates;
    }
}

/* End of file landing.php */
/* Location: ./application/controllers/site/landing.php */
