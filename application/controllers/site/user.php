<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * User related functions
 * @author Teamtweaks
 *
 */

class User extends MY_Controller
{
    public function __construct()
    {
        //echo "<pre>";print_r($_REQUEST);echo "</pre>";// die;
        parent::__construct();
        $this->load->helper(array('cookie','date','form','email','url'));
        $this->load->library(array('encrypt','form_validation','session'));
        $this->load->model(array('user_model','product_model'));
        if ($_SESSION['sMainCategories'] == '') {
            $sortArr1 = array('field'=>'cat_position','type'=>'asc');
            $sortArr = array($sortArr1);
            $_SESSION['sMainCategories'] = $this->product_model->get_all_details(CATEGORY, array('rootID'=>'0','status'=>'Active'), $sortArr);
        }
        $this->data['mainCategories'] = $_SESSION['sMainCategories'];
        $this->data['SliderDisplay'] = $this->product_model->get_all_details(SLIDER, array('status'=>'Active'));
        if ($_SESSION['sColorLists'] == '') {
            $_SESSION['sColorLists'] = $this->user_model->get_all_details(LIST_VALUES, array('list_id'=>'1'));
        }
        $this->data['mainColorLists'] = $_SESSION['sColorLists'];
        
        $this->data['loginCheck'] = $this->checkLogin('U');
        //echo $this->session->userdata('fc_session_user_name'); die;
    }
    
    /**
     *
     * Function for quick signup
     */
    public function quickSignup()
    {
        $email = $this->input->post('email');
        $returnStr['success'] = '0';
        if (valid_email($email)) {
            $condition = array('email'=>$email);
            $duplicateMail = $this->user_model->get_all_details(USERS, $condition);
            if ($duplicateMail->num_rows()>0) {
                $returnStr['msg'] = 'Email id already exists';
            } else {
                $fullname = substr($email, 0, strpos($email, '@'));
                $checkAvail = $this->user_model->get_all_details(USERS, array('user_name'=>$fullname));
                if ($checkAvail->num_rows()>0) {
                    $avail = false;
                } else {
                    $avail = true;
                    $username = $fullname;
                }
                while (!$avail) {
                    $username = $fullname.rand(1111, 999999);
                    $checkAvail = $this->user_model->get_all_details(USERS, array('user_name'=>$username));
                    if ($checkAvail->num_rows()>0) {
                        $avail = false;
                    } else {
                        $avail = true;
                    }
                }
                if ($avail) {
                    $pwd = $this->get_rand_str('6');
                    $this->user_model->insertUserQuick($fullname, $username, $email, $pwd);
                    $this->session->set_userdata('quick_user_name', $username);
                    $returnStr['msg'] = 'Successfully registered';
                    $returnStr['full_name'] = $fullname;
                    $returnStr['user_name'] = $username;
                    $returnStr['password'] = $pwd;
                    $returnStr['email'] = $email;
                    $returnStr['success'] = '1';
                }
            }
        } else {
            $returnStr['msg'] = "Invalid email id";
        }
        echo json_encode($returnStr);
    }
    
    public function display_user_profile()
    {
        if ($this->checkLogin('U')!= '') {
            $userProfileDetails = $this->user_model->get_all_details(USERS, array('id'=>$this->checkLogin('U'),'status'=>'Active'));
            $this->data['UserDetails'] = $userProfileDetails;
            $this->data['orderList'] = $this->user_model->get_resevation_Details($userProfileDetails->row()->email);
            $this->data['signDetailsGroup'] = $this->user_model->get_signature_Details_group($this->checkLogin('U'));
            $this->data['signDetails'] = $this->user_model->get_signature_Details($this->checkLogin('U'));
            
            //$this->data['orderList'] = $this->user_model->get_resevation_Details($this->checkLogin('U'));
            
            //echo '<pre>';print_r($this->data['signDetailsGroup']->result());die;
            $this->load->view('site/user/display_user_details', $this->data);
        } else {
            $this->setErrorMessage('error', 'User details not available');
            redirect(base_url());
        }
    }

    public function display_signaturepad()
    {
        $this->data['userId'] = $userId = $this->checkLogin('U');
        if ($userId!= '') {
            $newName = $userId.'_signature';
            $newInit = $userId.'_initial';
            
            $dateName = './Signature/'.$newName.'_date.png';
            $signName = './Signature/'.$newName.'_sign.png';
            $fullSign = './Signature/'.$newName.'.png';
            
            $dateNameInit = './Signature/'.$newInit.'_date.png';
            $signNameInit = './Signature/'.$newInit.'_initial.png';
            $fullSignInit = './Signature/'.$newInit.'.png';
            
            @unlink($dateName);
            @unlink($signName);
            @unlink($fullSign);
            @unlink($dateNameInit);
            @unlink($signNameInit);
            @unlink($fullSignInit);
            
            
            //$userProfileDetails = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U'),'status'=>'Active'));
            //$this->data['UserDetails'] = $userProfileDetails;
            //$this->data['orderList'] = $this->user_model->get_resevation_Details($userProfileDetails->row()->email);
            //$this->data['orderList'] = $this->user_model->get_resevation_Details($this->checkLogin('U'));
            
            //echo '<pre>';print_r($this->data['orderList']->result());die;
            
            $this->load->view('site/user/display_signaturepad', $this->data);
        } else {
            $this->setErrorMessage('error', 'User details not available');
            redirect(base_url());
        }
    }

    public function viewagreement()
    {
        $this->data['userId'] = $userId = $this->checkLogin('U');
        if ($userId!= '') {
            $signDetails = $this->user_model->get_all_details(SIGNTEMPLATE, array('id'=>$this->uri->segment(2)));
            //echo '<pre>';print_r($signDetails->result());die;
            $intiname = $signDetails->row()->initial_name;
            $this->data['signDetails'] = $signDetails;
            /*$signval = '<div style="background-color:#FFFF00; width:200px; padding:5px;"><img src="'.base_url().'Signature/'.$userId.'_signature.png" ></div>';
            $contents = $signDetails->row()->description;
            $contents = str_replace('{$INITIAL}','<div style="background-color:#FFFF00; display:inline; padding:5px;">'.$intiname.'</div>',$contents);
            $contents = str_replace('{$SIGNATURE}',$signval,$contents);
            $this->data['contents'] = $contents;*/
            
            //$this->load->view('site/user/display_agreement',$this->data);
            $this->load->view('site/user/display_view_agreement', $this->data);
        } else {
            $this->setErrorMessage('error', 'User details not available');
            redirect(base_url());
        }
    }
    
    public function previewagreementview()
    {
        error_reporting(-1);
        
        //echo '<pre>'; print_r($_POST); die;
        
        $this->data['userId'] = $userId = $this->checkLogin('U');
        if ($userId!= '') {
            $base64_str = substr($this->input->post('pricevalue'), strpos($this->input->post('pricevalue'), ",")+1);
            $decoded = base64_decode($base64_str);
            $length = 20;
            $characters = '0123456789abcdefghiljklmnopqrstuvwxyz';
            $string = '';
            for ($p = 0; $p < $length; $p++) {
                $string .= $characters[mt_rand(0, strlen($characters))];
            }
                
            $invoice  = $string.'.jpg';
            $result = file_put_contents('./images/productimages/'.$invoice, $decoded);
            //echo '<pre>'; print_r($_POST);
            //echo 'invoice'.$invoice; die;
            
            $signDetails = $this->user_model->get_all_details(SIGNTEMPLATE, array('id'=>$this->input->post('templateID')));
            //echo '<pre>';print_r($signDetails->result());die;
            $pg_count = $signDetails->row()->pageCount;
            
            //$invoice = $this->input->post('pricevalue');
            
            $dir = getcwd()."./preview-images/";//dir absolute path
            $interval = strtotime('-24 hours');//files older than 24hours
            foreach (glob($dir."*.*") as $file) {
                if (filemtime($file) <= $interval) {
                    unlink($file);
                }
            }
            //sleep(2000);
            
            
            $newCnt = $pg_count - 1;
            for ($i=0;$i < $pg_count;$i++) {
                $imgName = $i.'-'.$invoice;
                $file_to_save = './preview-images/'.$imgName;
                @copy('./images/productimages/'.$invoice, $file_to_save);
                if ($newCnt == $i) {
                    $this->ImageResizeWithCrop(1022, 1220, $imgName, './preview-images/', 1223*$i);
                } else {
                    $this->ImageResizeWithCrop(1022, 1224, $imgName, './preview-images/', 1224*$i);
                }
                $imgArrName[] = $imgName;
            }
            $NewImgName = @implode(',', $imgArrName);
            
            $this->user_model->update_details(SIGNTEMPLATE, array('preview_images'=>$NewImgName,'image_name'=>$invoice), array('id'=>$this->input->post('sign_id')));
            
            $this->setErrorMessage('success', 'Signature Submitted Successfully');
            //echo '<pre>Image Name'; print_r($NewImgName); die;
            redirect('previewagreement/'.$this->input->post('sign_id').'/'.$this->input->post('url_val'));
        } else {
            $this->setErrorMessage('error', 'User details not available. Please Login');
            redirect(base_url());
        }
    }
    
    public function previewagreement()
    {
        $this->data['userId'] = $userId = $this->checkLogin('U');
        if ($userId!= '') {
            $signId = $this->uri->segment(2);
            $urlval = $this->uri->segment(3);
        
            $this->data['PreviewOptions'] = $this->user_model->get_all_details(SIGNTEMPLATE, array('id'=>$signId));
            //echo '<pre>'; print_r($this->data['PreviewOptions']->result()); die;
        
            $this->load->view('site/user/display_preview_agreement', $this->data);
        } else {
            $this->setErrorMessage('error', 'User details not available. Please Login');
            redirect(base_url());
        }
    }
    
    public function confirmagreement()
    {
        //error_reporting(-1);
        $this->data['userId'] = $userId = $this->checkLogin('U');
        if ($userId!= '') {
            $signId = $this->uri->segment(2);
            $urlval = $this->uri->segment(3);
                
            $signDetails = $this->user_model->get_all_details(SIGNTEMPLATE, array('id'=>$signId));
            
            $intiname = $signDetails->row()->initial_name;
            
            $this->user_model->update_details(SIGNTEMPLATE, array('sign_status'=>'success'), array('id'=>$signId));
            
            $newTemp = @explode(',', $signDetails->row()->preview_images);
            $invoice = 'return_on_rentals_agreement_'.$signId.'_'.$urlval.'.pdf';
            
            /*			unset($createdPdf);
                        $createdPdf = '';
            
                        $createdPdf .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Return On Rentals</title>
            </head>
            <body style="background:#FFFFFF; width:100%; margin:0; padding:0;">';
            for($i=0;$i<count($newTemp);$i++){
                $createdPdf .= '<div style="width:50%; margin:0px; padding:0px;"><img src="'.base_url().'preview-images/'.$newTemp[$i].'" alt="'.$newTemp[$i].'" width="800" /></div>';
                if(count($newTemp)-1 != $i){
                    $createdPdf .= '<div style="page-break-before: always;"></div>';
                }
            }
            $createdPdf .='</body></html>';
            
            
            
                    /*unset($pdfPath);
                    $finalPDF = $createdPdf;
                     $tempFile = time().'.html';
                     $pdfPath = base_url().'images/crm-popup-images/'.$tempFile;
                      $file_to_save = './images/crm-popup-images/'.$tempFile;
                      file_put_contents($file_to_save, $finalPDF);
                    echo '<img src="images/ajax-loader/ajax-loader(4).gif" alt="Loading...">';
            
                    sleep(5);
            
                ini_set('display_errors','off');
                require_once("pdfdownload/dompdf_config.inc.php");
               //$orientation = 'portrait';
               //$paper = 'letter';
            // return_on_rentals_101-Floss-Avenue-Buffalo-NY-14211_3223
            
              $dompdf = new DOMPDF();
              //$dompdf->load_html(file_get_contents($pdfPath));
              $dompdf->load_html($createdPdf);
              //$dompdf->set_paper($paper,$orientation);
              $dompdf->render();
              $invoice = 'return_on_rentals_agreement_'.$signId.'_'.$urlval.'.pdf';
            
              $output = $dompdf->output();
              $file_to_save = './images/crm-popup-images/'.$invoice;
             // file_put_contents($file_to_save, $output);
              file_put_contents($file_to_save, $output);
             // echo $createdPdf; die;
              // $invoice = $signDetails->row()->image_name;*/
  
  
            if ($signDetails->row()->pa=='pa') {
                $notcolumn = 'pa';
            } elseif ($signDetails->row()->loan=='loan') {
                $notcolumn = 'loan';
            } elseif ($signDetails->row()->doi=='doi') {
                $notcolumn = 'doi';
            }
  
            $this->user_model->update_details(SIGNTEMPLATE, array($notcolumn.'_signed'=>'Yes','download_name'=>$invoice), array('id'=>$signId));
            $this->user_model->simple_insert(NOTESIMAGE, array('reserved_id'=>$signDetails->row()->reserve_id,$notcolumn=>$invoice,'admin_name'=>'admin'));
  
            if ($signDetails->row()->pa!='') {
                $Agree = 'Purchase Agreement';
            } elseif ($signDetails->row()->laon!='') {
                $Agree = 'Closing Docs';
            } elseif ($signDetails->row()->doi!='') {
                $Agree = 'DOI and RBP';
            }
  
            //---------------email to Admin---------------------------
        
            $subject = 'From: '.$this->config->item('email_title').' - A '.$Agree.' has been completed';
        
            $header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
                    
            $message .= '<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width"/><title>Signature Agreement</title></head><body>';
            $message .= '<div style="width:692px;background:#FFFFFF; margin:0 auto;">
<div style="width:100%;background:#454B56; float:left; margin:0 auto;">
    <div style="padding:20px 0 10px 15px;float:left; width:50%;"><a href="'.base_url().'" target="_blank" id="logo"><img src="'.$baseUrl.'images/logo/'.$this->data['logo'].'" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'"></a></div>
	
</div>			
<!--END OF LOGO-->
    
 <!--start of deal-->
    <div style="width:650px;background:#FFFFFF;float:left; padding:20px; border:1px solid #45454a; ">';
        
        
                
            $message .= 'We would like to notify you that the '.$Agree.' for the below property has been signed, completed and uploaded to the deals_crm database. <br><br>';
        
            $message .= 'Property Address : <b>'.$signDetails->row()->prop_address.'</b><br>';
        
            $message .= '<a href="'.base_url().'images/crm-popup-images/'.$invoice.'" target="_blank" style="background: none repeat scroll 0 0 #ff0000; border-radius: 7px; color: #000000; float: none !important; font-size: 14px; line-height: 18px; margin: 10px 10px 10px 250px; padding: 8px; text-align: center; vertical-align: middle; text-decoration:none;"><b>View Documents</b></a>';
            $message .= '<br><br>Thank You</div></body></html>';
            //$UserDetails->row()->email

            $sender_email=$this->data['siteContactMail'];
            $sender_name=$this->data['siteTitle'];
            
            $toemail ='info@gainturnkeyproperty.com';
            
            $email_values = array('mail_type'=>'html',
                                'from_mail_id'=>$sender_email,
                                'mail_name'=>$sender_name,
                                'to_mail_id'=>$toemail,
                                'subject_message'=>$subject,
                                'body_messages'=>$message
                                );
            $email_send_to_common = $this->product_model->common_email_send($email_values);
            
  
            //echo '<pre>'; print_r($email_values); die;
            // $dompdf->stream($invoice);
            $this->setErrorMessage('success', 'Signature Submitted Successfully');
        
            //$this->session->set_userdata('SignID',$signId);
            //$this->session->set_userdata('UrlID',$urlval);
        
        
            $newDirName = 'temp'.$signId;
            $file_to_save = 'images/crm-popup-images/'.$invoice;
            mkdir($newDirName, 0777);
            $newTemp = @explode(',', $signDetails->row()->preview_images);
    
            for ($i=0;$i<count($newTemp);$i++) {
                @copy('preview-images/'.$newTemp[$i], $newDirName.'/'.$newTemp[$i]);
            }
            //echo "convert ".$newDirName."/*.jpg $file_to_save";die;
            exec("convert ".$newDirName."/*.jpg $file_to_save");
    
    
            for ($i=0;$i<count($newTemp);$i++) {
                @unlink($newDirName.'/'.$newTemp[$i]);
            }
    
            //echo $newDirName;die;
            //rmdir($newDirName);
    
            if (rmdir($newDirName)) {
                //echo "deleted";die;
            }
        
            //echo anchor(base_url().'viewconfirmation/'.$signId.'/'.$urlval.'', 'View Confirmation', array('target' => '_blank'));
        
            $urlLinker = base_url().'my_account';
            //header("Location:".$urlLinker);
            //redirect($urlLinker);
            echo '<script>window.location.href = "'.$urlLinker.'";</script>';
            exit;
        //redirect('my_account');
        } else {
            $this->setErrorMessage('error', 'User details not available');
            redirect(base_url());
        }
    }
    
    public function viewconfirmation()
    {
        //error_reporting(-1);
        $this->data['userId'] = $userId = $this->checkLogin('U');
        if ($userId!= '') {
            $signId = $this->uri->segment(2);
            $urlval = $this->uri->segment(3);
                
            $signDetails = $this->user_model->get_all_details(SIGNTEMPLATE, array('id'=>$signId));
            
            $intiname = $signDetails->row()->initial_name;
            

            $invoice = 'return_on_rentals_agreement_'.$signId.'_'.$urlval.'.pdf';
    
            $this->data['signDetails'] = $signDetails;
            $this->data['createdPdf'] = $createdPdf;
            $this->data['invoicename'] = $invoice;
    
            $newDirName = 'temp'.$signId;
            $file_to_save = 'images/crm-popup-images/'.$invoice;
            mkdir($newDirName, 0777);
            $newTemp = @explode(',', $signDetails->row()->preview_images);
    
            for ($i=0;$i<count($newTemp);$i++) {
                @copy('preview-images/'.$newTemp[$i], $newDirName.'/'.$newTemp[$i]);
            }
            //echo "convert ".$newDirName."/*.jpg $file_to_save";die;
            exec("convert ".$newDirName."/*.jpg $file_to_save");
    
    
            for ($i=0;$i<count($newTemp);$i++) {
                @unlink($newDirName.'/'.$newTemp[$i]);
            }
    
            //echo $newDirName;die;
            //rmdir($newDirName);
    
            if (rmdir($newDirName)) {
                //echo "deleted";die;
            }
    
    
    
            echo '<script>window.close();</script>';
            die;
            //echo "hi";die;
            ///die;
            $this->load->view('site/user/view_confirmation', $this->data);
        } else {
            $this->setErrorMessage('error', 'User details not available');
            redirect(base_url());
        }
    }
    
    public function signedagreement()
    {
        $this->data['userId'] = $userId = $this->checkLogin('U');
        if ($userId!= '') {
            $signId = $this->uri->segment(2);
            $urlval = $this->uri->segment(3);
                
            $this->data['signDetails'] = $this->user_model->get_all_details(SIGNTEMPLATE, array('id'=>$signId));
            //echo '<pre>';print_r($signDetails->result());die;
            
            $this->load->view('site/user/display_signed_agreement', $this->data);
        } else {
            $this->setErrorMessage('error', 'User details not available');
            redirect(base_url());
        }
    }

    public function intialsave()
    {
        $this->user_model->update_details(SIGNTEMPLATE, array('initial_name'=>$this->input->post('intiailName')), array('id'=>$this->input->post('stid')));
        echo 'success';
    }

    /**
     * Function for quick signup update
     */
    public function quickSignupUpdate()
    {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $returnStr['success'] = '0';
        $condition = array('user_name'=>$username,'email !='=>$email);
        $duplicateName = $this->user_model->get_all_details(USERS, $condition);
        if ($duplicateName->num_rows()>0) {
            $returnStr['msg'] = 'Username already exists';
        } else {
            $pwd = $this->input->post('password');
            $fullname = $this->input->post('fullname');
            $this->user_model->updateUserQuick($fullname, $username, $email, $pwd);
            $this->session->set_userdata('quick_user_name', $username);
            $returnStr['msg'] = 'Successfully registered';
            $returnStr['success'] = '1';
        }
        echo json_encode($returnStr);
    }
    
    public function send_quick_register_mail()
    {
        if ($this->checkLogin('U') != '') {
            redirect(base_url());
        } else {
            $quick_user_name = $this->session->userdata('quick_user_name');
            if ($quick_user_name == '') {
                redirect(base_url());
            } else {
                $condition = array('user_name'=>$quick_user_name);
                $userDetails = $this->user_model->get_all_details(USERS, $condition);
                if ($userDetails->num_rows() == 1) {
                    $this->send_confirm_mail($userDetails);
                    $this->login_after_signup($userDetails);
                    $this->session->set_userdata('quick_user_name', '');
                    if ($userDetails->row()->is_brand == 'yes') {
                        redirect(base_url().'create-brand');
                    } else {
                        redirect(base_url().'onboarding');
                    }
                } else {
                    redirect(base_url());
                }
            }
        }
    }
    
    public function registerUser(){
        $username = $this->input->post('user_name');
        $email = $this->input->post('email');
        if (valid_email($email)) {
            $condition = array('user_name'=>$username);
            $duplicateName = $this->user_model->get_all_details(USERS, $condition);
            if ($duplicateName->num_rows()>0) {
                $this->setErrorMessage('error', 'User name already exists');
                redirect('signup');
            } else {
                $condition = array('email'=>$email);
                $duplicateMail = $this->user_model->get_all_details(USERS, $condition);
                $duplicateAdminMail = $this->user_model->get_all_details(ADMIN, $condition);
                $duplicateSubAdminMail = $this->user_model->get_all_details(SUBADMIN, $condition);
                            
                if ($duplicateMail->num_rows()>0) {
                    $this->setErrorMessage('error', 'Email id already exists');
                    redirect('signup');
                } elseif ($duplicateAdminMail->num_rows()>0) {
                    $this->setErrorMessage('error', 'Email id already exists');
                    redirect('signup');
                } elseif ($duplicateSubAdminMail->num_rows()>0) {
                    $this->setErrorMessage('error', 'Email id already exists');
                    redirect('signup');
                } else {
                    $dataArr = array('first_name'	=>		$this->input->post('first_name'),
                        'last_name'		=>		$this->input->post('last_name'),
                        'user_name'		=>		$username,
                        'email'			=>		$email,
                        'password'		=>		md5($this->input->post('password')),
                        'address'		=>		$this->input->post('address'),
                        'address1'		=>		$this->input->post('address1'),
                        'city'			=>		$this->input->post('city'),
                        'state'			=>		$this->input->post('state'),
                        'country'		=>		$this->input->post('country'),
                        'postal_code'	=>		$this->input->post('post'),
                        'phone_no'		=>		$this->input->post('ph_no'),
                        'how_know'		=>		$this->input->post('how_heared'),
                        'status'		=>		'Active',
                        'is_verified'	=>		'No'
                        );
                    $this->user_model->simple_insert(USERS, $dataArr);
                    $this->session->set_userdata('fc_session_user_name', $username);
                    $this->setErrorMessage('success', 'Congratulations!  You are now registered in our website.  Please check for our Welcome Email to complete your registration.');
                    $details = $this->user_model->get_all_details(USERS, $condition);
                    if ($details->num_rows() == 1) {
                        $this->send_confirm_mail($details);
                        $this->send_admin_mail_userdetails($details);
                    }
                    redirect(base_url().'site/user/verify_email/'.$details->row()->id);
                }
            }
        } else {
            $this->setErrorMessage('error', 'Invalid email id');
            redirect('signup');
        }
    }
    
    public function signin_registerUser()
    {
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $username = $this->input->post('user_name');
        $email = $this->input->post('email');
        $pwd = $this->input->post('password');
        $news_sscr = $this->input->post('signup_news');
        $returnStr['success'] = '0';
        if (valid_email($email)) {
            $condition = array('user_name'=>$username);
            $duplicateName = $this->user_model->get_all_details(USERS, $condition);
            if ($duplicateName->num_rows()>0) {
                $this->setErrorMessage('error', 'User name already exists');
                redirect('signin');
            } else {
                $condition = array('email'=>$email);
                $duplicateMail = $this->user_model->get_all_details(USERS, $condition);
                if ($duplicateMail->num_rows()>0) {
                    $this->setErrorMessage('error', 'Email id already exists');
                    redirect('signin');
                } else {
                    if ($news_sscr =='on') {
                        $this->load->model('newsletter_model');
                        $this->newsletter_model->direct_add_subscriber($email);
                    }
                    $this->user_model->insertUserQuick($first_name, $last_name, $username, $email, $pwd, $news_sscr);
                    $this->session->set_userdata('quick_user_name', $username);
                    $this->setErrorMessage('error', 'Successfully registered');
                    $details = $this->user_model->get_all_details(USERS, $condition);
                    if ($details->num_rows() == 1) {
                        $this->send_confirm_mail($details);
                    }
                    redirect(base_url().'pages/user-registration-confirmation');
                }
            }
        } else {
            $this->setErrorMessage('error', 'Invalid email id');
            redirect('signin');
        }
    }  
    
    public function verify_email($uid){
        $signId = $this->uri->segment(2);
        $urlval = $this->uri->segment(3);
        $condition = array('id'=>$uid);
        $checkUser = $this->user_model->get_all_details(USERS, $condition);
        if ($checkUser->num_rows() == 1) {
            if ($checkUser->row()->is_verified == 'Yes') {
                $this->setErrorMessage('error', 'You already verified your email');
                redirect(base_url().'signin');
            }
        } 
        $this->data = array();
        $this->load->view('site/user/verify_email', $this->data);
    }
    
    public function registerOwner($payment='')
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('ph_no', 'Phone Number', 'required');
        $this->form_validation->set_rules('checkbox', 'Check Box', 'required');
        
        if ($this->form_validation->run() === false) {
            $this->setErrorMessage('error', 'Please enter the mandatory fields');
            redirect(list_your_property);
        } else {
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $email = $this->input->post('email_address');
            $pass = md5($this->input->post('password'));
            $phone = $this->input->post('ph_no');
            $about = $this->input->post('about');
            $renter = $this->input->post('renter');
            $membership = $this->input->post('membership');
            $price = $this->input->post('price');

            $returnStr['success'] = '0';
            if (valid_email($email)) {
                $condition = array('email'=>$email,'group'=>'Seller');
                $duplicateName = $this->user_model->get_all_details(USERS, $condition);
                if ($duplicateName->num_rows()>0) {
                    $must = array('status'=>'Publish');
                    $this->data['subscription'] = $this->user_model->get_all_details(FANCYYBOX, $must);
                    $this->data['user'] = $duplicateName->row()->id;
                    $this->load->view('site/user/continue_page', $this->data);
                            
                            
                //	$this->setErrorMessage('error','Email exists');
                        //	redirect('list_your_property');
                } else {
                    if ($price!=0) {
                        redirect(base_url('payment_details/'.$price));
                    }
                    /*if($payment=='approved')
                    {*/
                    $result = $this->user_model->ownerinsert($first_name, $last_name, $email, $pass, $phone, $about, $renter, $membership, $price);
                    $this->session->set_userdata('quick_user_name', $last_name);
                    $this->setErrorMessage('success', 'Successfully registered, please activate your account');
                    $details = $this->user_model->get_all_details(USERS, $condition);
                    if ($details->num_rows() == 1) {
                        //$this->send_confirm_mail($details);
                        //echo "Please wait until your account is approved";
                        $this->SetErrorMessage('success', 'Your request received, please wait for approval');
                        $must = array('status'=>'Publish');
                        $this->data['subscription'] = $this->user_model->get_all_details(FANCYYBOX, $must);
                        $this->data['user'] = $details->row()->id;
                        $this->load->view('site/user/continue_page', $this->data);
                    }
                    //redirect('cont_page',$details->row()->id);
                }
                /*}
                else
                {
                echo "Payment Not Approved"; die;
                //redirect('list_your_property');
                }*/
            } else {
                $this->setErrorMessage('error', 'Invalid email id');
                redirect('list_your_property');
            }
        }
    }
    
    public function continue_page($id='')
    {
        $this->data['user'] = $this->checkLogin('U');
        $condition = array('status'=>'Publish');
        $this->data['subscription'] = $this->user_model->get_all_details(FANCYYBOX, $condition);
        $this->load->view('site/user/continue_page', $this->data);
    }

    public function user_cum_owner()
    {
        $userid = $this->uri->segment(2);
        $subscriptionId = $this->uri->segment(3);
        $condition = array('id'=>$userid);
        $condition1 = array('id'=>$subscriptionId);
        $subscription = $this->user_model->get_all_details(FANCYYBOX, $condition1);
        $price = $subscription->row()->price;
        $membership = $subscription->row()->name;
        $this->data['subscription'] = $subscription;
        $purchase_count = $subscription->row()->purchased;
        $purchase_count++;
        $dataArr = array('group'=>'Seller','is_verified'=>'No','membership'=>$membership,'price'=>$price);
        $details = $this->user_model->get_all_details(USERS, $condition);
            
        $this->user_model->update_details(FANCYYBOX, array('purchased'=>$purchase_count), $condition1);
        $this->user_model->update_details(USERS, $dataArr, $condition);
        $this->SetErrorMessage('success', 'Your request received please wait for admin approval');
        //redirect(base_url());
            
        $uid = $details->row()->id;
        $email = $details->row()->email;
        $randStr = $this->get_rand_str('10');
        $conditionc = array('id'=>$uid);
        $dataArrc = array('verify_code'=>$randStr);
        $this->user_model->update_details(USERS, $dataArrc, $conditionc);
            
        $newsid='7';
        $template_values=$this->user_model->get_newsletter_template_details($newsid);
            
        $cfmurl = base_url().'site/user/confirm_register/'.$uid."/".$randStr."/confirmation";
        $subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];

        $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>'.$template_values['news_descrip'].'</body>
			</html>';

        if ($template_values['sender_name']=='' && $template_values['sender_email']=='') {
            $sender_email=$this->config->item('site_contact_mail');
            $sender_name=$this->config->item('email_title');
        } else {
            $sender_name=$template_values['sender_name'];
            $sender_email=$template_values['sender_email'];
        }

        $message = str_replace('{$cfmurl}', $cfmurl, $message);
        $message = str_replace('{$email_title}', $sender_name, $message);
        $message = str_replace('{$meta_title}', $sender_name, $message);
        $message = str_replace('{base_url()}images/logo/{$logo}', $this->data['logo'], $message);
        $message = str_replace('{base_url()}', base_url(), $message);

        $email_values = array('mail_type'=>'html',
            'from_mail_id'=>$sender_email,
            'mail_name'=>$sender_name,
            'to_mail_id'=>$email,
            'subject_message'=>$subject,
            'body_messages'=>$message
        );

        $email_send_to_common = $this->product_model->common_email_send($email_values);

        redirect(base_url().'pages/confirmation-page');
    }
    
    public function payment_details_form()
    {
        $this->load->model(array('city_model','country_model'));
        $this->data['country'] = $this->country_model->AllCountry();
        $this->data['stateDisplay'] = $this->city_model->SelectAllCountry();
        $this->load->view('site/product/payment_details', $this->data);
    }

    public function payment_details_value()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('card_type', 'Card', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('card_no', 'Card Number', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('expire_month', 'Expiry Month', 'required');
        $this->form_validation->set_rules('expire_year', 'Expire Year', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('pin_code', 'Pin Code', 'required');
        $this->form_validation->set_rules('security_code', 'Security Code', 'required');
        if ($this->form_validation->run() === false) {
            $this->setErrorMessage('error', 'Please Enter the details marked with star');
            redirect(payment_details);
        } else {
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $card = $this->input->post('card_type');
            $address = $this->input->post('address');
            $card_no = $this->input->post('card_no');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $month = $this->input->post('expire_month');
            $year = $this->input->post('expire_year');
            $city = $this->input->post('city');
            $pin = $this->input->post('pin_code');
            $security_code = $this->input->post('security_code');
            
            if ($payment=='success') {
                $payment='approved';
            } else {
                $payment='not approved';
            }
            $this->registerOwner($payment);
        }
    }
    
    public function resend_confirm_mail()
    {
        $mail = $this->input->post('mail');
        if ($mail == '') {
            echo '0';
        } else {
            $condition = array('email'=>$mail);
            $userDetails = $this->user_model->get_all_details(USERS, $condition);
            $this->send_confirm_mail($userDetails);
            echo '1';
        }
    }
    
    public function send_email_confirmation()
    {
        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U') == '') {
            $returnStr['message'] = 'Login required';
        } else {
            $this->send_confirm_mail($this->data['userDetails']);
            $returnStr['status_code'] = 1;
        }
        echo json_encode($returnStr);
    }
    
    public function send_confirm_mail($userDetails='')
    {
        $uid = $userDetails->row()->id;
        $email = $userDetails->row()->email;
        $randStr = $this->get_rand_str('10');
        $condition = array('id'=>$uid);
        $dataArr = array('verify_code'=>$randStr);
        $this->user_model->update_details(USERS, $dataArr, $condition);
        $newsid='3';
        $template_values=$this->user_model->get_newsletter_template_details($newsid);
        
        $cfmurl = base_url().'site/user/confirm_register/'.$uid."/".$randStr."/confirmation";
        $subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];

        $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>'.$template_values['news_descrip'].'</body>
			</html>';

        if ($template_values['sender_name']=='' && $template_values['sender_email']=='') {
            $sender_email=$this->config->item('site_contact_mail');
            $sender_name=$this->config->item('email_title');
        } else {
            $sender_name=$template_values['sender_name'];
            $sender_email=$template_values['sender_email'];
        }

        $message = str_replace('{$cfmurl}', $cfmurl, $message);
        $message = str_replace('{$email_title}', $sender_name, $message);
        $message = str_replace('{$meta_title}', $sender_name, $message);
        $message = str_replace('{base_url()}images/logo/{$logo}', $this->data['logo'], $message);
        $message = str_replace('{base_url()}', base_url(), $message);

        $email_values = array('mail_type'=>'html',
                            'from_mail_id'=>$sender_email,
                            'mail_name'=>$sender_name,
                            'to_mail_id'=>$email,
                            'subject_message'=>$subject,
                            'body_messages'=>$message
                            );

        $this->product_model->common_email_send($email_values);
    }
    
    public function send_admin_mail_userdetails($userDetails='')
    {
        $uid = $userDetails->row()->id;
        $email = $userDetails->row()->email;
        
        $condition = array('id'=>$uid);
        //$dataArr = array('verify_code'=>$randStr);
        //$this->user_model->update_details(USERS,$dataArr,$condition);
        $newsid='18';
        $template_values=$this->user_model->get_newsletter_template_details($newsid);
        
        
        $subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
        $adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),
                                    'logo'=> $this->data['logo'],
                                    'First_Name'=>$userDetails->row()->first_name,
                                    'Last_Name' =>$userDetails->row()->last_name,
                                    'User_Name' =>$userDetails->row()->user_name,
                                    'Email' =>$userDetails->row()->email,
                                    'Address' => $userDetails->row()->address,
                                    'City' => $userDetails->row()->city,
                                    'State' =>str_replace('-', ' ', $userDetails->row()->state),
                                    'Country'=>$userDetails->row()->country,
                                    'Post_Code'=>$userDetails->row()->postal_code,
                                    'Phone'=>$userDetails->row()->phone_no
                                    );
        extract($adminnewstemplateArr);
        //$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
        $header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
        
        $message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
        include('./newsletter/registeration'.$newsid.'.php');
        
        $message .= '</body>
			</html>';
        
        if ($template_values['sender_name']=='' && $template_values['sender_email']=='') {
            $sender_email=$this->data['siteContactMail'];
            $sender_name=$this->data['siteTitle'];
        } else {
            $sender_name=$template_values['sender_name'];
            $sender_email=$template_values['sender_email'];
        }

        $email_values = array('mail_type'=>'html',
                            'from_mail_id'=>$sender_email,
                            'mail_name'=>$sender_name,
                            'to_mail_id'=>$this->data['adminEmail'],
                            'subject_message'=>$template_values['news_subject'],
                            'body_messages'=>$message
                            );
        $email_send_to_common = $this->product_model->common_email_send($email_values);
    }
    
    public function signup_form()
    {
        if ($this->checkLogin('U') != '') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'Sign up';
            $this->data['signup'] = $this->product_model->get_all_details(CMS, array('seourl'=>'signup-content','site'=>'main'));
            $this->load->view('site/user/signup', $this->data);
        }
    }

    public function signin_form()
    {
        if ($this->checkLogin('U') != '') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'Login';
            
            $this->load->view('site/user/signin', $this->data);
        }
    }

    /**
     *
     * Loading login page
     */
    public function login_form()
    {
        if ($this->checkLogin('U')!='') {
            redirect(base_url());
        } else {
            $this->data['next'] = $this->input->get('next');
            //echo $this->data['next'];die;
            $this->data['heading'] = 'Sign in';
            $this->load->view('site/user/login.php', $this->data);
        }
    }
    
    public function login_user()
    {
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $next = $this->input->post('next');
        if ($this->form_validation->run() === false) {
            $this->setErrorMessage('error', 'Email and password fields required');
            redirect('login?next='.urlencode($next));
        } else {
            $email = $this->input->post('email');
            $pwd = md5($this->input->post('password'));
            $condition = array('email'=>$email,'password'=>$pwd,'status'=>'Active', 'group'=>'User');
            $checkUser = $this->user_model->get_all_details(USERS, $condition);
            if ($checkUser->num_rows() == 1) {
                $userdata = array(
                                'fc_session_user_id' => $checkUser->row()->id,
                                'session_first_name' => $checkUser->row()->first_name,
                                'fc_session_group'		 => $checkUser->row()->group,
                                'fc_session_user_email' => $checkUser->row()->email
                            );
                //echo "<pre>";print_r($userdata);
                $this->session->set_userdata($userdata);
                //				echo $this->session->userdata('fc_session_user_id');die;
                $datestring = "%Y-%m-%d %h:%i:%s";
                $time = time();
                $newdata = array(
                   'last_login_date' => mdate($datestring, $time),
                   'last_login_ip' => $this->input->ip_address()
                );
                $condition = array('id' => $checkUser->row()->id);
                $this->user_model->update_details(USERS, $newdata, $condition);
                
                $this->user_model->updategiftcard(GIFTCARDS_TEMP, $this->checkLogin('T'), $checkUser->row()->id);
                  
                $this->setErrorMessage('success', 'Thank you for your login.');
                //				$this->session->set_flashdata('loadAfterLog', '1');
                //print_r($this->session->userdata('fc_session_user_id'));

                redirect(base_url());
            } else {
                $this->setErrorMessage('error', 'Invalid login details');
                redirect('signup');
            }
        }
    }

    public function signin_login_user()
    {
        $email = $this->input->post('email');
        $pwd = md5($this->input->post('password'));
        $condition = array('email'=>$email,'password'=>$pwd,'status'=>'Active', 'is_verified' => 'Yes');
        $condition1 = array('email'=>$email,'admin_password'=>$pwd,'status'=>'Active', 'is_verified' => 'Yes');
        //echo "<pre>"; print_r($condition1); die;
        $checkUser = $this->user_model->get_all_details(USERS, $condition);

        if ($checkUser->num_rows() == 1) {
            $userdata = array(
                                    'fc_session_user_id' => $checkUser->row()->id,
                                    'fc_session_user_name' => $checkUser->row()->user_name,
                                    'fc_session_user_email' => $checkUser->row()->email,
                                    'fc_session_group' => $checkUser->row()->group
                                );
            $this->session->set_userdata($userdata);
            $datestring = "%Y-%m-%d %h:%i:%s";
            $time = time();
            $newdata = array(
                                   'last_login_date' => mdate($datestring, $time),
                                       'last_login_ip' => $this->input->ip_address()
                                    );
            $condition = array('id' => $checkUser->row()->id);
            $this->user_model->update_details(USERS, $newdata, $condition);
            $this->setErrorMessage('success', 'Thank you for your login.');
            $this->load->model('product_model');
            $this->product_model->saveSoldSettings();
            redirect(base_url('listing/viewall/0'));
        } else {
            $checkUser = $this->user_model->get_all_details(SUBADMIN, $condition1);
            if ($checkUser->num_rows() == 1) {
                $userdata = array(
                                    'fc_session_user_id' => $checkUser->row()->id,
                                    'fc_session_user_name' => $checkUser->row()->admin_name,
                                    'fc_session_user_email' => $checkUser->row()->email,
                                    'fc_session_group' => 'Admin'
                                );
                $this->session->set_userdata($userdata);
                $datestring = "%Y-%m-%d %h:%i:%s";
                $time = time();
                $newdata = array(
                                   'last_login_date' => mdate($datestring, $time),
                                       'last_login_ip' => $this->input->ip_address()
                                    );
                $condition = array('id' => $checkUser->row()->id);
                $this->user_model->update_details(SUBADMIN, $newdata, $condition);
                $this->setErrorMessage('success', 'Thank you for your login.');
                $this->load->model('product_model');
                $this->product_model->saveSoldSettings();
                redirect(base_url('listing/viewall/0'));
            } else {
                $this->setErrorMessage('error', 'Invalid login details');
                redirect('signin');
            }
        }
    }

    public function login_after_signup($userDetails='')
    {
        if ($userDetails->num_rows() == '1') {
            if ($userDetails->result()->status == 'Active') {
                $userdata = array(
                            'fc_session_user_id' => $userDetails->row()->id,
                            'fc_session_user_name' => $userDetails->row()->user_name,
                            'fc_session_user_email' => $userDetails->row()->email,
                            'fc_session_group' => $userDetails->row()->group
                        );
                $this->session->set_userdata($userdata);
                $datestring = "%Y-%m-%d %h:%i:%s";
                $time = time();
                $newdata = array(
               'last_login_date' => mdate($datestring, $time),
               'last_login_ip' => $this->input->ip_address()
            );
                $condition = array('id' => $userDetails->row()->id);
                $this->user_model->update_details(USERS, $newdata, $condition);
            
                $this->user_model->updategiftcard(GIFTCARDS_TEMP, $this->checkLogin('T'), $userDetails->row()->id);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    public function dashboard()
    {
        if ($this->checkLogin('U')=='') {
            $this->setErrorMessage('error', 'No direct access allowed');
            redirect(base_url());
        } else {
            $condition = array('id'=>$this->checkLogin('U'));
            $this->data['userDetails'] = $this->user_model->get_all_details(USERS, $condition);
            $this->data['heading'] = 'Dashboard';
            $this->data['user_count'] = $this->data['userDetails'];
            $this->data['InquirieDisplay'] = $this->product_model->get_usercount_details(CONTACT, array('status'=>'Active','renter_id'=>$this->checkLogin('U')));
            $this->load->view('site/user/dashboard', $this->data);
        }
    }

    public function EditUserLoginDetails()
    {
        $excludeArr=array('signin');
        $condition = array('id' => $this->checkLogin('U'));
        $dataArr=array();
                 
                
        $logoDirectory ='./images/users';
        if (!is_dir($logoDirectory)) {
            mkdir($logoDirectory, 0777);
        }
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        //$config['max_size'] = 50000;
        $config['remove_spaces'] = false;
        $config['upload_path'] = $logoDirectory;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
                
        //var_dump(is_dir('./dummy'));  die;
                 
        if ($this->upload->do_upload('user_image')) {
            $logoDetails = $this->upload->data();
            $logoDetails['file_name'];
            $dataArr['thumbnail'] = $logoDetails['file_name'];
        }
                              
        $filePRoductUploadData = array();
        $setPriority = 0;
        // $imgtitle = $this->input->post('user_image');
        //$dataArr = array_merge($inputArr,$city_data);
                
        $this->user_model->commonInsertUpdate1(USERS, 'update', $excludeArr, $dataArr, $condition);
        $this->setErrorMessage('success', 'Owner details updated successfully');
        redirect(dashboard);
    }
    
    public function confirm_register()
    {
        $uid = $this->uri->segment(4, 0);
        $code = $this->uri->segment(5, 0);
        $mode = $this->uri->segment(6, 0);
        if ($mode=='confirmation') {
            $condition = array('verify_code'=>$code,'id'=>$uid);
            $checkUser = $this->user_model->get_all_details(USERS, $condition);
            if ($checkUser->num_rows() == 1) {
                if ($checkUser->row()->is_verified == 'Yes') {
                    $this->setErrorMessage('error', 'You already verified your email');
                    redirect(base_url().'signin');
                }
                $conditionArr = array('id'=>$uid,'verify_code'=>$code);
                $dataArr = array('is_verified'=>'Yes');
                $this->user_model->update_details(USERS, $dataArr, $condition);
                $this->setErrorMessage('success', 'Great going ! Your mail ID has been verified');
                //$this->login_after_signup($checkUser);
                redirect(base_url().'signin');
            } else {
                $this->setErrorMessage('error', 'Invalid confirmation link');
                redirect(base_url());
            }
        } else {
            $this->setErrorMessage('error', 'Invalid confirmation link');
            redirect(base_url());
        }
    }
    
    public function EditSiteUserLoginDetails()
    {
        $excludeArr=array('signin');
        $condition = array('id' => $this->checkLogin('U'));
        $dataArr=array();
                

                
        /*$logoDirectory ='./images/users';
        if(!is_dir($logoDirectory))
        {
            mkdir($logoDirectory,0777);
         }
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['remove_spaces'] = FALSE;
                $config['upload_path'] = $logoDirectory;
                $this->upload->initialize($config);
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('user_image')){
           $logoDetails = $this->upload->data();
           $logoDetails['file_name'];
           $dataArr['thumbnail'] = $logoDetails['file_name'];
                }*/
               
        // $filePRoductUploadData = array();
        //  $setPriority = 0;
        //$imgtitle = $this->input->post('usre_image');
               
                
        $this->user_model->commonInsertUpdate(USERS, 'update', $excludeArr, $dataArr, $condition);
        $this->setErrorMessage('success', 'User details updated successfully');
        redirect('my_account');
    }
    
    public function logout_user()
    {
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        $newdata = array(
               'last_logout_date' => mdate($datestring, $time)
        );
        $condition = array('id' => $this->checkLogin('U'));
        $conditionad = array('email' => $this->session->userdata('fc_session_user_email'));
        $reservationdetails = $this->user_model->get_all_details(SUBADMIN, $conditionad);
        if ($reservationdetails->row()->reservation == 'Yes') {
            $this->user_model->update_details(SUBADMIN, array('reservation'=>'No'), $conditionad);
            $this->user_model->update_details(PRODUCT, array('property_status'=>'Active'), array('id'=>$reservationdetails->row()->property_id));
            $this->load->model('product_model');
            $this->product_model->saveResevedSettings();
        }
        $this->user_model->update_details(USERS, $newdata, $condition);
        $userdata = array(
                        'fc_session_user_id'=>'',
                        'fc_session_user_name'=>'',
                        'fc_session_user_email'=>'',
                        'fc_session_temp_id'=>'',
                        'quick_user_name' => ''
                    );
        $this->session->unset_userdata($userdata);
        
        $this->load->helper('cookie');
        //setcookie ("endtimer", "", time()- 3600);
        //setcookie ("differenceTime", "", time()- 3600);
        //unset($_COOKIE['differenceTime']);
        //unset($_COOKIE['endtimer']);
        
        unset($_SESSION['differenceTime']);
        unset($_SESSION['endtimer']);
        unset($_SESSION['reservation']);
        
        
        unset($_SESSION['rfname']);
        unset($_SESSION['rlname']);
        unset($_SESSION['rename']);
        unset($_SESSION['rtype']);
        unset($_SESSION['raddress']);
        unset($_SESSION['rcountry']);
        unset($_SESSION['rstate']);
        unset($_SESSION['rcity']);
        unset($_SESSION['rzip']);
        unset($_SESSION['rphno']);
        unset($_SESSION['rphno1']);
        unset($_SESSION['remail']);
        unset($_SESSION['remail1']);
        unset($_SESSION['rreservprice']);
        unset($_SESSION['rnote']);
                
        unset($_SESSION['rcashpt']);
        unset($_SESSION['rcheckpt']);
        unset($_SESSION['rcreditpt']);
        unset($_SESSION['rdotpt']);
        unset($_SESSION['rsalescash']);
        unset($_SESSION['rsalescf']);
        unset($_SESSION['rsalescs']);
        unset($_SESSION['rsalessdira']);
        unset($_SESSION['rsalesfs']);
                
                
        @session_start();
        unset($_SESSION['token']);
        $twitter_return_values = array('tw_status'=>'',
                                        'tw_access_token'=>''
                                        );
        
        $this->session->unset_userdata($twitter_return_values);
        $this->load->model('product_model');
        $this->product_model->saveResevedSettings();
        
        $this->setErrorMessage('success', 'Successfully logout from your account');
        redirect(base_url());
    }
    
    public function forgot_password_form()
    {
        $this->data['heading'] = 'Forgot Password';
        $this->load->view('site/user/forgot_password', $this->data);
    }
    
    public function forgot_password_user()
    {
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        if ($this->form_validation->run() === false) {
            $this->setErrorMessage('error', 'Email address required');
            redirect('forgot-password');
        } else {
            $email = $this->input->post('email');
            if (valid_email($email)) {
                $condition = array('email'=>$email);
                $checkUser = $this->user_model->get_all_details(USERS, $condition);
                if ($checkUser->num_rows() == '1') {
                    if ($checkUser->row()->status == 'Active') {
                        $pwd = $this->get_rand_str('6');
                        $newdata = array('password' => md5($pwd));
                        $condition = array('email' => $email);
                        $this->user_model->update_details(USERS, $newdata, $condition);
                        $this->send_user_password($pwd, $checkUser);
                        $this->setErrorMessage('success', 'New password sent to your mail');
                        redirect('signin');
                    } else {
                        $this->setErrorMessage('error', 'Your Account has been Inactivated. Please Contact Admin to activate your account.');
                        redirect('forgot-password');
                    }
                } else {
                    $this->setErrorMessage('error', 'Your email id not matched in our records');
                    redirect('forgot-password');
                }
            } else {
                $this->setErrorMessage('error', 'Email id not valid');
                redirect('forgot-password');
            }
        }
    }
    
    public function send_user_password($pwd='', $query)
    {
        $group = $query->row()->group;
        if ($group == 'User') {
            $newsid='5';
        } else {
            $newsid='11';
        }
        $template_values=$this->user_model->get_newsletter_template_details($newsid);

        $subject = 'From: '.$template_values['news_title'].' - '.$template_values['news_subject'];

        $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title>
			<body>'.$template_values['news_descrip'].'</body>
			</html>';

        if ($template_values['sender_name']=='' && $template_values['sender_email']=='') {
            $sender_email=$this->config->item('site_contact_mail');
            $sender_name=$this->config->item('email_title');
        } else {
            $sender_name=$template_values['sender_name'];
            $sender_email=$template_values['sender_email'];
        }

        $message = str_replace('{$pwd}', $pwd, $message);
        $message = str_replace('{$email_title}', $sender_name, $message);
        $message = str_replace('{$meta_title}', $sender_name, $message);
        $message = str_replace('{base_url()}images/logo/{$logo}', $this->data['logo'], $message);

        $email_values = array('mail_type'=>'html',
                            'from_mail_id'=>$sender_email,
                            'mail_name'=>$sender_name,
                            'to_mail_id'=>$query->row()->email,
                            'subject_message'=> $subject,
                            'body_messages'=>$message
                            );

        $email_send_to_common = $this->product_model->common_email_send($email_values);

        return $email_send_to_common;
    }

    public function display_user_profilddde()
    {
        $username =  urldecode($this->uri->segment(2, 0));
        /*if ($username == 'administrator'){
            $this->data['heading'] = $username;
            $this->load->view('site/user/display_admin_profile');
        }else {*/
        $userProfileDetails = $this->user_model->get_all_details(USERS, array('id'=>$username,'status'=>'Active'));
        if ($userProfileDetails->num_rows()==1) {
            $this->data['heading'] = 'Admin Settings';
            $this->data['AdminDisplay'] = $userProfileDetails;
            if ($userProfileDetails->row()->group == 'Seller') {
                $this->load->view('site/user/view_owner', $this->data);
            } else {
                $this->data['heading'] = 'User Settings';
                $this->data['AdminDisplay'] = $userProfileDetails;
                $this->load->view('site/user/view_user', $this->data);
            }
        } else {
            $this->setErrorMessage('error', 'User details not available');
            redirect(base_url());
        }
        /*}*/
    }

    public function display_user_added()
    {
        $username =  urldecode($this->uri->segment(2, 0));
        $userProfileDetails = $this->user_model->get_all_details(USERS, array('user_name'=>$username));
        if ($userProfileDetails->num_rows()==1) {
            if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')) {
                $this->load->view('site/user/display_user_profile_private', $this->data);
            } else {
                $this->data['heading'] = $username;
                $this->data['userProfileDetails'] = $userProfileDetails;
                $this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
                $this->data['addedProductDetails'] = $this->product_model->view_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"');
                $this->data['notSellProducts'] = $this->product_model->view_notsell_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"');
                $this->load->view('site/user/display_user_added', $this->data);
            }
        } else {
            redirect(base_url());
        }
    }
    
    public function display_user_lists()
    {
        $username =  urldecode($this->uri->segment(2, 0));
        $userProfileDetails = $this->user_model->get_all_details(USERS, array('user_name'=>$username));
        if ($userProfileDetails->num_rows()==1) {
            if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')) {
                $this->load->view('site/user/display_user_profile_private', $this->data);
            } else {
                $this->data['heading'] = $username;
                $this->data['userProfileDetails'] = $userProfileDetails;
                $this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
                $this->data['listDetails'] = $this->product_model->get_all_details(LISTS_DETAILS, array('user_id'=>$userProfileDetails->row()->id));
                if ($this->data['listDetails']->num_rows()>0) {
                    foreach ($this->data['listDetails']->result() as $listDetailsRow) {
                        $this->data['listImg'][$listDetailsRow->id] = '';
                        if ($listDetailsRow->product_id != '') {
                            $pidArr = array_filter(explode(',', $listDetailsRow->product_id));
                            
                            $productDetails = '';
                            if (count($pidArr)>0) {
                                foreach ($pidArr as $pidRow) {
                                    if ($pidRow!='') {
                                        $productDetails = $this->product_model->get_all_details(PRODUCT, array('seller_product_id'=>$pidRow,'status'=>'Publish'));
                                        if ($productDetails->num_rows()==0) {
                                            $productDetails = $this->product_model->get_all_details(USER_PRODUCTS, array('seller_product_id'=>$pidRow,'status'=>'Publish'));
                                        }
                                        if ($productDetails->num_rows()==1) {
                                            break;
                                        }
                                    }
                                }
                            }
                            if ($productDetails != '' && $productDetails->num_rows()==1) {
                                $this->data['listImg'][$listDetailsRow->id] = $productDetails->row()->image;
                            }
                        }
                    }
                }
                $this->load->view('site/user/display_user_lists', $this->data);
            }
        } else {
            redirect(base_url());
        }
    }
    
    public function display_user_wants()
    {
        $username =  urldecode($this->uri->segment(2, 0));
        $userProfileDetails = $this->user_model->get_all_details(USERS, array('user_name'=>$username));
        if ($userProfileDetails->num_rows()==1) {
            if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')) {
                $this->load->view('site/user/display_user_profile_private', $this->data);
            } else {
                $this->data['heading'] = $username;
                $this->data['userProfileDetails'] = $userProfileDetails;
                $this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
                $wantList = $this->user_model->get_all_details(WANTS_DETAILS, array('user_id'=>$userProfileDetails->row()->id));
                $this->data['wantProductDetails'] = $this->product_model->get_wants_product($wantList);
                $this->data['notSellProducts'] = $this->product_model->get_notsell_wants_product($wantList);
                $this->load->view('site/user/display_user_wants', $this->data);
            }
        } else {
            redirect(base_url());
        }
    }
    
    public function display_user_owns()
    {
        $username =  urldecode($this->uri->segment(2, 0));
        $userProfileDetails = $this->user_model->get_all_details(USERS, array('user_name'=>$username));
        if ($userProfileDetails->num_rows()==1) {
            if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')) {
                $this->load->view('site/user/display_user_profile_private', $this->data);
            } else {
                $this->data['heading'] = $username;
                $this->data['userProfileDetails'] = $userProfileDetails;
                $this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
                $productIdsArr = array_filter(explode(',', $userProfileDetails->row()->own_products));
                $productIds = '';
                if (count($productIdsArr)>0) {
                    foreach ($productIdsArr as $pidRow) {
                        if ($pidRow != '') {
                            $productIds .= $pidRow.',';
                        }
                    }
                    $productIds = substr($productIds, 0, -1);
                }
                if ($productIds != '') {
                    $this->data['ownsProductDetails'] = $this->product_model->view_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"');
                    $this->data['notSellProducts'] = $this->product_model->view_notsell_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"');
                } else {
                    $this->data['addedProductDetails'] = '';
                    $this->data['notSellProducts'] = '';
                }
                $this->load->view('site/user/display_user_owns', $this->data);
            }
        } else {
            redirect(base_url());
        }
    }
    
    public function display_user_following()
    {
        $username =  urldecode($this->uri->segment(2, 0));
        $userProfileDetails = $this->user_model->get_all_details(USERS, array('user_name'=>$username));
        if ($userProfileDetails->num_rows()==1) {
            if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')) {
                $this->load->view('site/user/display_user_profile_private', $this->data);
            } else {
                $this->data['heading'] = $username;
                $this->data['userProfileDetails'] = $userProfileDetails;
                $this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
                $fieldsArr = array('*');
                $searchName = 'id';
                $searchArr = explode(',', $userProfileDetails->row()->following);
                $joinArr = array();
                $sortArr = array();
                $limit = '';
                $this->data['followingUserDetails'] = $followingUserDetails = $this->product_model->get_fields_from_many(USERS, $fieldsArr, $searchName, $searchArr, $joinArr, $sortArr, $limit);
                if ($followingUserDetails->num_rows()>0) {
                    foreach ($followingUserDetails->result() as $followingUserRow) {
                        $this->data['followingUserLikeDetails'][$followingUserRow->id] = $this->user_model->get_userlike_products($followingUserRow->id);
                    }
                }
                $this->load->view('site/user/display_user_following', $this->data);
            }
        } else {
            redirect(base_url());
        }
    }
    
    public function display_user_followers()
    {
        $username =  urldecode($this->uri->segment(2, 0));
        $userProfileDetails = $this->user_model->get_all_details(USERS, array('user_name'=>$username));
        if ($userProfileDetails->num_rows()==1) {
            if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')) {
                $this->load->view('site/user/display_user_profile_private', $this->data);
            } else {
                $this->data['heading'] = $username;
                $this->data['userProfileDetails'] = $userProfileDetails;
                $this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
                $fieldsArr = array('*');
                $searchName = 'id';
                $searchArr = explode(',', $userProfileDetails->row()->followers);
                $joinArr = array();
                $sortArr = array();
                $limit = '';
                $this->data['followingUserDetails'] = $followingUserDetails = $this->product_model->get_fields_from_many(USERS, $fieldsArr, $searchName, $searchArr, $joinArr, $sortArr, $limit);
                if ($followingUserDetails->num_rows()>0) {
                    foreach ($followingUserDetails->result() as $followingUserRow) {
                        $this->data['followingUserLikeDetails'][$followingUserRow->id] = $this->user_model->get_userlike_products($followingUserRow->id);
                    }
                }
                $this->load->view('site/user/display_user_followers', $this->data);
            }
        } else {
            redirect(base_url());
        }
    }
    
    public function add_list_when_fancyy()
    {
        $returnStr['status_code'] = 0;
        $returnStr['listCnt'] = '';
        $returnStr['wanted'] = 0;
        $uniqueListNames = array();
        if ($this->checkLogin('U') == '') {
            $returnStr['message'] = 'Login required';
        } else {
            $tid = $this->input->post('tid');
            $firstCatName = '';
            $firstCatDetails = '';
            $count = 1;
            
            //Adding lists which was not already created from product categories
            $productDetails = $this->user_model->get_all_details(PRODUCT, array('seller_product_id'=>$tid));
            if ($productDetails->num_rows()==0) {
                $productDetails = $this->user_model->get_all_details(USER_PRODUCTS, array('seller_product_id'=>$tid));
            }
            if ($productDetails->num_rows()==1) {
                $productCatArr = explode(',', $productDetails->row()->category_id);
                if (count($productCatArr)>0) {
                    $productCatNameArr = array();
                    foreach ($productCatArr as $productCatID) {
                        if ($productCatID != '') {
                            $productCatDetails = $this->user_model->get_all_details(CATEGORY, array('id'=>$productCatID));
                            if ($productCatDetails->num_rows()==1) {
                                if ($count == 1) {
                                    $firstCatName = $productCatDetails->row()->cat_name;
                                }
                                $listConditionArr = array('name'=>$productCatDetails->row()->cat_name,'user_id'=>$this->checkLogin('U'));
                                $listCheck = $this->user_model->get_all_details(LISTS_DETAILS, $listConditionArr);
                                if ($count == 1) {
                                    $firstCatDetails = $listCheck;
                                }
                                if ($listCheck->num_rows()==0) {
                                    $this->user_model->simple_insert(LISTS_DETAILS, $listConditionArr);
                                    $userDetails = $this->user_model->get_all_details(USERS, array('id'=>$this->checkLogin('U')));
                                    $listCount = $userDetails->row()->lists;
                                    if ($listCount<0 || $listCount == '') {
                                        $listCount = 0;
                                    }
                                    $listCount++;
                                    $this->user_model->update_details(USERS, array('lists'=>$listCount), array('id'=>$this->checkLogin('U')));
                                }
                                $count++;
                            }
                        }
                    }
                }
            }
            
            //Check the product id in list table
            $checkListsArr = $this->user_model->get_list_details($tid, $this->checkLogin('U'));
            
            if ($checkListsArr->num_rows() == 0) {
                
                //Add the product id under the first category name
                if ($firstCatName!='') {
                    $listConditionArr = array('name'=>$firstCatName,'user_id'=>$this->checkLogin('U'));
                    if ($firstCatDetails == '' || $firstCatDetails->num_rows() == 0) {
                        $dataArr = array('product_id'=>$tid);
                    } else {
                        $productRowArr = explode(',', $firstCatDetails->row()->product_id);
                        $productRowArr[] = $tid;
                        $newProductRowArr = implode(',', $productRowArr);
                        $dataArr = array('product_id'=>$newProductRowArr);
                    }
                    $this->user_model->update_details(LISTS_DETAILS, $dataArr, $listConditionArr);
                    $listCntDetails = $this->user_model->get_all_details(LISTS_DETAILS, $listConditionArr);
                    if ($listCntDetails->num_rows()==1) {
                        array_push($uniqueListNames, $listCntDetails->row()->id);
                        $returnStr['listCnt'] .= '<li class="selected"><label for="'.$listCntDetails->row()->id.'"><input type="checkbox" checked="checked" id="'.$listCntDetails->row()->id.'" name="'.$listCntDetails->row()->id.'">'.$listCntDetails->row()->name.'</label></li>';
                    }
                }
            } else {
                
                //Get all the lists which contain this product
                foreach ($checkListsArr->result() as $checkListsRow) {
                    array_push($uniqueListNames, $checkListsRow->id);
                    $returnStr['listCnt'] .= '<li class="selected"><label for="'.$checkListsRow->id.'"><input type="checkbox" checked="checked" id="'.$checkListsRow->id.'" name="'.$checkListsRow->id.'">'.$checkListsRow->name.'</label></li>';
                }
            }
            $all_lists = $this->user_model->get_all_details(LISTS_DETAILS, array('user_id'=>$this->checkLogin('U')));
            if ($all_lists->num_rows()>0) {
                foreach ($all_lists->result() as $all_lists_row) {
                    if (!in_array($all_lists_row->id, $uniqueListNames)) {
                        $returnStr['listCnt'] .= '<li><label for="'.$all_lists_row->id.'"><input type="checkbox" id="'.$all_lists_row->id.'" name="'.$all_lists_row->id.'">'.$all_lists_row->name.'</label></li>';
                    }
                }
            }
            
            //Check the product wanted status
            $wantedProducts = $this->user_model->get_all_details(WANTS_DETAILS, array('user_id'=>$this->checkLogin('U')));
            if ($wantedProducts->num_rows()==1) {
                $wantedProductsArr = explode(',', $wantedProducts->row()->product_id);
                if (in_array($tid, $wantedProductsArr)) {
                    $returnStr['wanted'] = 1;
                }
            }
            $returnStr['status_code'] = 1;
        }
        echo json_encode($returnStr);
    }
    
    public function add_item_to_lists()
    {
        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U')=='') {
            $returnStr['message'] = 'You must login';
        } else {
            $tid = $this->input->post('tid');
            $lid = $this->input->post('list_ids');
            $listDetails = $this->user_model->get_all_details(LISTS_DETAILS, array('id'=>$lid));
            if ($listDetails->num_rows()==1) {
                $product_ids = explode(',', $listDetails->row()->product_id);
                if (!in_array($tid, $product_ids)) {
                    array_push($product_ids, $tid);
                }
                $new_product_ids = implode(',', $product_ids);
                $this->user_model->update_details(LISTS_DETAILS, array('product_id'=>$new_product_ids), array('id'=>$lid));
                $returnStr['status_code'] = 1;
            }
        }
        echo json_encode($returnStr);
    }
    
    public function remove_item_from_lists()
    {
        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U')=='') {
            $returnStr['message'] = 'You must login';
        } else {
            $tid = $this->input->post('tid');
            $lid = $this->input->post('list_ids');
            $listDetails = $this->user_model->get_all_details(LISTS_DETAILS, array('id'=>$lid));
            if ($listDetails->num_rows()==1) {
                $product_ids = explode(',', $listDetails->row()->product_id);
                if (in_array($tid, $product_ids)) {
                    if (($key = array_search($tid, $product_ids)) !== false) {
                        unset($product_ids[$key]);
                    }
                }
                $new_product_ids = implode(',', $product_ids);
                $this->user_model->update_details(LISTS_DETAILS, array('product_id'=>$new_product_ids), array('id'=>$lid));
                $returnStr['status_code'] = 1;
            }
        }
        echo json_encode($returnStr);
    }
    
    public function add_want_tag()
    {
        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U')=='') {
            $returnStr['message'] = 'You must login';
        } else {
            $tid = $this->input->post('thing_id');
            $wantDetails = $this->user_model->get_all_details(WANTS_DETAILS, array('user_id'=>$this->checkLogin('U')));
            if ($wantDetails->num_rows()==1) {
                $product_ids = explode(',', $wantDetails->row()->product_id);
                if (!in_array($tid, $product_ids)) {
                    array_push($product_ids, $tid);
                }
                $new_product_ids = implode(',', $product_ids);
                $this->user_model->update_details(WANTS_DETAILS, array('product_id'=>$new_product_ids), array('user_id'=>$this->checkLogin('U')));
            } else {
                $dataArr = array('user_id'=>$this->checkLogin('U'),'product_id'=>$tid);
                $this->user_model->simple_insert(WANTS_DETAILS, $dataArr);
            }
            $wantCount = $this->data['userDetails']->row()->want_count;
            if ($wantCount<=0 || $wantCount=='') {
                $wantCount = 0;
            }
            $wantCount++;
            $dataArr = array('want_count'=>$wantCount);
            $ownProducts = explode(',', $this->data['userDetails']->row()->own_products);
            if (in_array($tid, $ownProducts)) {
                if (($key = array_search($tid, $ownProducts)) !== false) {
                    unset($ownProducts[$key]);
                }
                $ownCount = $this->data['userDetails']->row()->own_count;
                $ownCount--;
                $dataArr['own_count'] = $ownCount;
                $dataArr['own_products'] = implode(',', $ownProducts);
            }
            $this->user_model->update_details(USERS, $dataArr, array('id'=>$this->checkLogin('U')));
            $returnStr['status_code'] = 1;
        }
        echo json_encode($returnStr);
    }
    
    public function delete_want_tag()
    {
        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U')=='') {
            $returnStr['message'] = 'You must login';
        } else {
            $tid = $this->input->post('thing_id');
            $wantDetails = $this->user_model->get_all_details(WANTS_DETAILS, array('user_id'=>$this->checkLogin('U')));
            if ($wantDetails->num_rows()==1) {
                $product_ids = explode(',', $wantDetails->row()->product_id);
                if (in_array($tid, $product_ids)) {
                    if (($key = array_search($tid, $product_ids)) !== false) {
                        unset($product_ids[$key]);
                    }
                }
                $new_product_ids = implode(',', $product_ids);
                $this->user_model->update_details(WANTS_DETAILS, array('product_id'=>$new_product_ids), array('user_id'=>$this->checkLogin('U')));
                $wantCount = $this->data['userDetails']->row()->want_count;
                if ($wantCount<=0 || $wantCount=='') {
                    $wantCount = 1;
                }
                $wantCount--;
                $this->user_model->update_details(USERS, array('want_count'=>$wantCount), array('id'=>$this->checkLogin('U')));
                $returnStr['status_code'] = 1;
            }
        }
        echo json_encode($returnStr);
    }
    
    public function create_list()
    {
        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U')=='') {
            $returnStr['message'] = 'You must login';
        } else {
            $tid = $this->input->post('tid');
            $list_name = $this->input->post('list_name');
            $category_id = $this->input->post('category_id');
            $checkList = $this->user_model->get_all_details(LISTS_DETAILS, array('name'=>$list_name,'user_id'=>$this->checkLogin('U')));
            if ($checkList->num_rows() == 0) {
                $dataArr = array('user_id'=>$this->checkLogin('U'),'name'=>$list_name,'product_id'=>$tid);
                if ($category_id != '') {
                    $dataArr['category_id'] = $category_id;
                }
                $this->user_model->simple_insert(LISTS_DETAILS, $dataArr);
                $userDetails = $this->user_model->get_all_details(USERS, array('id'=>$this->checkLogin('U')));
                $listCount = $userDetails->row()->lists;
                if ($listCount<0 || $listCount == '') {
                    $listCount = 0;
                }
                $listCount++;
                $this->user_model->update_details(USERS, array('lists'=>$listCount), array('id'=>$this->checkLogin('U')));
                $returnStr['list_id'] = $this->user_model->get_last_insert_id();
                $returnStr['new_list'] = 1;
            } else {
                $productArr = explode(',', $checkList->row()->product_id);
                if (!in_array($tid, $productArr)) {
                    array_push($productArr, $tid);
                }
                $product_id = implode(',', $productArr);
                $dataArr = array('product_id'=>$product_id);
                if ($category_id != '') {
                    $dataArr['category_id'] = $category_id;
                }
                $this->user_model->update_details(LISTS_DETAILS, $dataArr, array('user_id'=>$this->checkLogin('U'),'name'=>$list_name));
                $returnStr['list_id'] = $checkList->row()->id;
                $returnStr['new_list'] = 0;
            }
            $returnStr['status_code'] = 1;
        }
        echo json_encode($returnStr);
    }
    
    public function search_users()
    {
        $search_key = $this->input->post('term');
        $returnStr = array();
        if ($search_key != '') {
            $userList = $this->user_model->get_search_user_list($search_key, $this->checkLogin('U'));
            if ($userList->num_rows()>0) {
                $i=0;
                foreach ($userList->result() as $userRow) {
                    $userArr['id'] = $userRow->id;
                    $userArr['fullname'] = $userRow->full_name;
                    $userArr['username'] = $userRow->user_name;
                    if ($userRow->thumbnail != '') {
                        $userArr['image_url'] = 'images/users/'.$userRow->thumbnail;
                    } else {
                        $userArr['image_url'] = 'images/users/user-thumb1.png';
                    }
                    array_push($returnStr, $userArr);
                    $i++;
                }
            }
        }
        echo json_encode($returnStr);
    }
    
    public function seller_signin_form()
    {
        /*	if ($this->checkLogin('U')==''){
                redirect(base_url());
            }else{
                $email=$this->input->post('email');
                $password=md5($this->input->post('password'));*/
        $this->data['heading'] = 'Owner Signin';
        $this->load->view('site/user/owner_signin', $this->data);
        /*}*/
    }

    public function seller_signin()
    {
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() === false) {
            $this->setErrorMessage('error', 'Email and password fields required');
            redirect(owner_signin);
        } else {
            $email = $this->input->post('email');
            $pwd = md5($this->input->post('password'));
            $remember = $this->input->post('remember');
            $condition = array('email'=>$email,'password'=>$pwd,'status'=>'Active', 'group'=>'Seller', 'approved'=>'yes');
            
            $checkUser = $this->user_model->get_all_details(USERS, $condition);
            if ($checkUser->num_rows() == '1') {
                $userdata = array(
                                'fc_session_user_id' => $checkUser->row()->id,
                                'fc_session_user_name' => $checkUser->row()->first_name,
                                'fc_session_group' 	=> $checkUser->row()->group,
                                'fc_session_user_email' => $checkUser->row()->email
                            );
                //				echo "<pre>";print_r($userdata);
                $this->session->set_userdata($userdata);
                //				echo $this->session->userdata('fc_session_user_id');die;
                $datestring = "%Y-%m-%d %h:%i:%s";
                $time = time();
                $newdata = array(
                   'last_login_date' => mdate($datestring, $time),
                   'last_login_ip' => $this->input->ip_address()
                );
                $condition = array('id' => $checkUser->row()->id);
                $this->user_model->update_details(USERS, $newdata, $condition);
                /*if ($remember != ''){
                    $userid = $this->encrypt->encode($checkUser->row()->id);
                    $cookie = array(
                        'name'   => 'fc_admin_session',
                        'value'  => $userid,
                        'expire' => 86400,
                        'secure' => FALSE
                    );
                    $this->input->set_cookie($cookie);
                }*/
                
                $this->setErrorMessage('success', 'Thank you for your login.');
                //				$this->session->set_flashdata('loadAfterLog', '1');
                redirect(base_url('dashboard'));
            } else {
                $this->setErrorMessage('error', 'Invalid login details');
                redirect('owner_signin');
            }
        }
    }

    public function create_brand_form()
    {
        if ($this->checkLogin('U')=='') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'Seller Signup';
            $this->load->view('site/user/seller_register', $this->data);
        }
    }

    public function seller_signup_form()
    {
        if ($this->checkLogin('U') != '') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'Sign up';
            $this->load->view('site/user/owner_signup.php', $this->data);
        }
    }

    /*	public function registerOwner(){
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $username = $this->input->post('user_name');
            $email = $this->input->post('email');
            $pwd = $this->input->post('password');
            $checkbox = $this->input->post('checkbox');
            $brand = 'no';
            $returnStr['success'] = '0';
    
           if (valid_email($email)){
                $condition = array('user_name'=>$username);
                $duplicateName = $this->user_model->get_all_details(USERS,$condition);
                if ($duplicateName->num_rows()>0){
                    $this->setErrorMessage('error','User name already exists');
                    redirect('signup');
                }else {
                    $condition = array('email'=>$email);
                    $duplicateMail = $this->user_model->get_all_details(USERS,$condition);
                    if ($duplicateMail->num_rows()>0){
                        $this->setErrorMessage('error','Email id already exists');
                        redirect('signup');
                    }else {
                        $this->user_model->insertOwnerQuick($first_name,$last_name,$username,$email,$pwd,$brand);
                        $this->session->set_userdata('quick_user_name',$username);
                        $this->session->set_userdata('user_type','Seller');
                        $this->setErrorMessage('success','Successfully registered');
                        redirect(base_url('dashboard'));
                    }
                }
            }else {
                $this->setErrorMessage('error','Invalid email id');
                redirect('owner');
            }
        }*/

    public function seller_signup()
    {
        if ($this->checkLogin('U')=='') {
            redirect(base_url());
        } else {
            if ($this->data['userDetails']->row()->is_verified == 'No') {
                $this->setErrorMessage('error', 'Please confirm your email first');
                redirect('create-brand');
            /*				echo "<script>window.history.go(-1)</script>";*/
            } else {
                $dataArr = array(
                    'request_status'	=>	'Pending'
                );
                $this->user_model->commonInsertUpdate(USERS, 'update', array(), $dataArr, array('id'=>$this->checkLogin('U')));
                $this->setErrorMessage('success', 'Welcome onboard ! Our team is evaluating your request. We will contact you shortly');
                redirect(base_url());
            }
        }
    }
    
    public function find_friends_twitter()
    {
        $returnStr['status_code'] = 1;
        $returnStr['url'] = 'http://twitter.com';
        $returnStr['message'] = $this->input->post('location');
        echo json_encode($returnStr);
    }
    
    public function view_purchase()
    {
        if ($this->checkLogin('U') == '') {
            show_404();
        } else {
            $uid = $this->uri->segment(2, 0);
            $dealCode = $this->uri->segment(3, 0);
            if ($uid != $this->checkLogin('U')) {
                show_404();
            } else {
                $purchaseList = $this->user_model->get_purchase_list($uid, $dealCode);
                $invoice = $this->get_invoice($purchaseList);
                echo $invoice;
            }
        }
    }

    public function view_order()
    {
        if ($this->checkLogin('U') == '') {
            show_404();
        } else {
            $uid = $this->uri->segment(2, 0);
            $dealCode = $this->uri->segment(3, 0);
            if ($uid != $this->checkLogin('U')) {
                show_404();
            } else {
                $orderList = $this->user_model->get_order_list($uid, $dealCode);
                $invoice = $this->get_invoice($orderList);
                echo $invoice;
            }
        }
    }
    
    public function get_invoice($PrdList)
    {
        $shipAddRess = $this->user_model->get_all_details(SHIPPING_ADDRESS, array( 'id' => $PrdList->row()->shippingid ));
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>Product Order Confirmation</title>
<body>
<div style="width:1012px;background:#FFFFFF; margin:0 auto;">
<div style="width:100%;background:#454B56; float:left; margin:0 auto;">
    <div style="padding:20px 0 10px 15px;float:left; width:50%;"><a href="'.base_url().'" target="_blank" id="logo"><img src="'.$baseUrl.'images/logo/'.$this->data['logo'].'" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'"></a></div>
	
</div>			
<!--END OF LOGO-->
    
 <!--start of deal-->
    <div style="width:970px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">
    
	<div style=" float:right; width:35%; margin-bottom:20px; margin-right:7px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
			  <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Id</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">#'.$PrdList->row()->dealCodeNumber.'</span></td>
              </tr>
              <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Date</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.date("F j, Y g:i a", strtotime($PrdList->row()->created)).'</span></td>
              </tr>
			 
              </table>
        	</div>
		
    <div style="float:left; width:100%;">
	
    <div style="width:49%; float:left; border:1px solid #cccccc; margin-right:10px;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Shipping Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($shipAddRess->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address1).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($shipAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($shipAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes(str_replace('-', ' ', $shipAddRess->row()->state)).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($shipAddRess->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($shipAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
     </div>
    
    <div style="width:49%; float:left; border:1px solid #cccccc;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.7%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#000305;">Billing Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($PrdList->row()->full_name).'</td></tr>
                    <tr><td>Address</td><td>:</td><td>'.stripslashes($PrdList->row()->address).'</td></tr>
					<tr><td>Address 2</td><td>:</td><td>'.stripslashes($PrdList->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($PrdList->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($PrdList->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($PrdList->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($PrdList->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($PrdList->row()->phone_no).'</td></tr>
            	</table>
            </div>
    </div>
</div> 
	   
<div style="float:left; width:100%; margin-right:3%; margin-top:10px; font-size:14px; font-weight:normal; line-height:28px;  font-family:Arial, Helvetica, sans-serif; color:#000; overflow:hidden;">   
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece; width:99.5%;">
        <tr bgcolor="#f3f3f3">
        	<td width="17%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Bag Items</span></td>
            <td width="43%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
            <td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>
            <td width="14%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
            <td width="15%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
         </tr>';
            
        $disTotal =0;
        $grantTotal = 0;
        foreach ($PrdList->result() as $cartRow) {
            $InvImg = @explode(',', $cartRow->image);
            $unitPrice = ($cartRow->price*(0.01*$cartRow->product_tax_cost))+$cartRow->product_shipping_cost+$cartRow->price;
            $uTot = $unitPrice*$cartRow->quantity;
            $message.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATH.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice, 2, '.', '').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot, 2, '.', '').'</span></td>
        </tr>';
            $grantTotal = $grantTotal + $uTot;
        }
        $private_total = $grantTotal - $PrdList->row()->discountAmount;
        $private_total = $private_total + $PrdList->row()->tax  + $PrdList->row()->shippingcost;
                 
        $message.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
        if ($PrdList->row()->note !='') {
            $message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
        }
            
        if ($PrdList->row()->order_gift == 1) {
            $message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
        }
            
        $message.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal, '2', '.', '').'</span></td>
            </tr>
			<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Discount Amount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount, '2', '.', '').'</span></td>
            </tr>
		<tr bgcolor="#f3f3f3">
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->shippingcost, 2, '.', '').'</span></td>
              </tr>
			  <tr>
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax, 2, '.', '').'</span></td>
              </tr>
			  <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total, '2', '.', '').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
		
            
            <div style="width:27.4%; margin-right:5px; float:right;">
            
           
            </div>
        
        <div style="clear:both"></div>
        
    </div>
    </div></body></html>';
        return $message;
    }
    
    public function change_order_status()
    {
        if ($this->checkLogin('U') == '') {
            show_404();
        } else {
            $uid = $this->input->post('seller');
            if ($uid != $this->checkLogin('U')) {
                show_404();
            } else {
                $returnStr['status_code'] = 0;
                $dealCode = $this->input->post('dealCode');
                $status = $this->input->post('value');
                $dataArr = array('shipping_status'=>$status);
                $conditionArr = array('dealCodeNumber'=>$dealCode,'sell_id'=>$uid);
                $this->user_model->update_details(PAYMENT, $dataArr, $conditionArr);
                $returnStr['status_code'] = 1;
                echo json_encode($returnStr);
            }
        }
    }
    
    public function display_user_lists_home()
    {
        $lid = $this->uri->segment('4', '0');
        $uname = $this->uri->segment('2', '0');
        $this->data['user_profile_details'] = $userProfileDetails = $this->user_model->get_all_details(USERS, array('user_name'=>$uname));
        if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')) {
            $this->load->view('site/user/display_user_profile_private', $this->data);
        } else {
            $this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS, array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
            if ($this->data['list_details']->num_rows()==0) {
                show_404();
            } else {
                $searchArr = array_filter(explode(',', $list_details->row()->product_id));
                if (count($searchArr)>0) {
                    $fieldsArr = array(PRODUCT.'.*',USERS.'.user_name',USERS.'.full_name');
                    $condition = array(PRODUCT.'.status'=>'Publish');
                    $joinArr1 = array('table'=>USERS,'on'=>USERS.'.id='.PRODUCT.'.user_id','type'=>'');
                    $joinArr = array($joinArr1);
                    $this->data['product_details'] = $product_details = $this->product_model->get_fields_from_many(PRODUCT, $fieldsArr, PRODUCT.'.seller_product_id', $searchArr, $joinArr, '', '', $condition);
                    $this->data['totalProducts'] = count($searchArr);
                    $fieldsArr = array(USER_PRODUCTS.'.*',USERS.'.user_name',USERS.'.full_name');
                    $condition = array(USER_PRODUCTS.'.status'=>'Publish');
                    $joinArr1 = array('table'=>USERS,'on'=>USERS.'.id='.USER_PRODUCTS.'.user_id','type'=>'');
                    $joinArr = array($joinArr1);
                    $this->data['notsell_product_details'] = $this->product_model->get_fields_from_many(USER_PRODUCTS, $fieldsArr, USER_PRODUCTS.'.seller_product_id', $searchArr, $joinArr, '', '', $condition);
                } else {
                    $this->data['notsell_product_details'] = '';
                    $this->data['product_details'] = '';
                    $this->data['totalProducts'] = 0;
                }
                $this->load->view('site/user/user_list_home', $this->data);
            }
        }
    }
    
    public function display_user_lists_followers()
    {
        $lid = $this->uri->segment('4', '0');
        $uname = $this->uri->segment('2', '0');
        $this->data['user_profile_details'] = $userProfileDetails = $this->user_model->get_all_details(USERS, array('user_name'=>$uname));
        if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')) {
            $this->load->view('site/user/display_user_profile_private', $this->data);
        } else {
            $this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS, array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
            if ($this->data['list_details']->num_rows()==0) {
                show_404();
            } else {
                $fieldsArr = '*';
                $searchArr = explode(',', $list_details->row()->followers);
                $this->data['user_details'] = $user_details = $this->product_model->get_fields_from_many(USERS, $fieldsArr, 'id', $searchArr);
                if ($user_details->num_rows()>0) {
                    foreach ($user_details->result() as $userRow) {
                        $fieldsArr = array(PRODUCT_LIKES.'.*',PRODUCT.'.product_name',PRODUCT.'.image',PRODUCT.'.id as PID');
                        $searchArr = array($userRow->id);
                        $joinArr1 = array('table'=>PRODUCT,'on'=>PRODUCT_LIKES.'.product_id='.PRODUCT.'.seller_product_id','type'=>'');
                        $joinArr = array($joinArr1);
                        $sortArr1 = array('field'=>PRODUCT.'.created','type'=>'desc');
                        $sortArr = array($sortArr1);
                        $this->data['product_details'][$userRow->id] = $this->product_model->get_fields_from_many(PRODUCT_LIKES, $fieldsArr, PRODUCT_LIKES.'.user_id', $searchArr, $joinArr, $sortArr, '5');
                    }
                }
                $fieldsArr = array(PRODUCT.'.*',USERS.'.user_name',USERS.'.full_name');
                $searchArr = array_filter(explode(',', $list_details->row()->product_id));
                if (count($searchArr)>0) {
                    $this->data['totalProducts'] = count($searchArr);
                } else {
                    $this->data['totalProducts'] = 0;
                }
                
                $this->load->view('site/user/user_list_followers', $this->data);
            }
        }
    }
    
    public function follow_list()
    {
        $returnStr['status_code'] = 0;
        $lid = $this->input->post('lid');
        if ($this->checkLogin('U') != '') {
            $listDetails = $this->product_model->get_all_details(LISTS_DETAILS, array('id'=>$lid));
            $followersArr = explode(',', $listDetails->row()->followers);
            $followersCount = $listDetails->row()->followers_count;
            $oldDetails = explode(',', $this->data['userDetails']->row()->following_user_lists);
            if (!in_array($lid, $oldDetails)) {
                array_push($oldDetails, $lid);
            }
            if (!in_array($this->checkLogin('U'), $followersArr)) {
                array_push($followersArr, $this->checkLogin('U'));
                $followersCount++;
            }
            $this->product_model->update_details(USERS, array('following_user_lists'=>implode(',', $oldDetails)), array('id'=>$this->checkLogin('U')));
            $this->product_model->update_details(LISTS_DETAILS, array('followers'=>implode(',', $followersArr),'followers_count'=>$followersCount), array('id'=>$lid));
            $returnStr['status_code'] = 1;
        }
        echo json_encode($returnStr);
    }
    
    public function unfollow_list()
    {
        $returnStr['status_code'] = 0;
        $lid = $this->input->post('lid');
        if ($this->checkLogin('U') != '') {
            $listDetails = $this->product_model->get_all_details(LISTS_DETAILS, array('id'=>$lid));
            $followersArr = explode(',', $listDetails->row()->followers);
            $followersCount = $listDetails->row()->followers_count;
            $oldDetails = explode(',', $this->data['userDetails']->row()->following_user_lists);
            if (in_array($lid, $oldDetails)) {
                if ($key = array_search($lid, $oldDetails) !== false) {
                    unset($oldDetails[$key]);
                }
            }
            if (in_array($this->checkLogin('U'), $followersArr)) {
                if ($key = array_search($this->checkLogin('U'), $followersArr) !== false) {
                    unset($followersArr[$key]);
                }
                $followersCount--;
            }
            $this->product_model->update_details(USERS, array('following_user_lists'=>implode(',', $oldDetails)), array('id'=>$this->checkLogin('U')));
            $this->product_model->update_details(LISTS_DETAILS, array('followers'=>implode(',', $followersArr),'followers_count'=>$followersCount), array('id'=>$lid));
            $returnStr['status_code'] = 1;
        }
        echo json_encode($returnStr);
    }
    
    public function edit_user_lists()
    {
        if ($this->checkLogin('U') == '') {
            redirect('login');
        } else {
            $lid = $this->uri->segment('4', '0');
            $uname = $this->uri->segment('2', '0');
            if ($uname != $this->data['userDetails']->row()->user_name) {
                show_404();
            } else {
                $this->data['user_profile_details'] = $this->user_model->get_all_details(USERS, array('user_name'=>$uname));
                $this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS, array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
                if ($this->data['list_details']->num_rows()==0) {
                    show_404();
                } else {
                    $this->data['list_category_details'] = $this->user_model->get_all_details(CATEGORY, array('id'=>$this->data['list_details']->row()->category_id));
                    $this->data['heading'] = 'Edit List';
                    $this->load->view('site/user/edit_user_list', $this->data);
                }
            }
        }
    }
    
    public function edit_user_list_details()
    {
        if ($this->checkLogin('U') == '') {
            redirect('login');
        } else {
            $lid = $this->input->post('lid');
            $uid = $this->input->post('uid');
            if ($uid != $this->checkLogin('U')) {
                show_404();
            } else {
                $list_title = $this->input->post('setting-title');
                $catID = $this->input->post('category');
                $duplicateCheck = $this->user_model->get_all_details(LISTS_DETAILS, array('user_id'=>$uid,'id !='=>$lid,'name'=>$list_title));
                if ($duplicateCheck->num_rows()>0) {
                    $this->setErrorMessage('error', 'List title already exists');
                    echo '<script>window.history.go(-1);</script>';
                } else {
                    if ($catID == '') {
                        $catID = 0;
                    }
                    $this->user_model->update_details(LISTS_DETAILS, array('name'=>$list_title,'category_id'=>$catID), array('id'=>$lid,'user_id'=>$uid));
                    $this->setErrorMessage('success', 'List updated successfully');
                    echo '<script>window.history.go(-1);</script>';
                }
            }
        }
    }
    
    public function delete_user_list()
    {
        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U')=='') {
            $returnStr['message'] = 'Login required';
        } else {
            $lid = $this->input->post('lid');
            $uid = $this->input->post('uid');
            if ($uid != $this->checkLogin('U')) {
                $returnStr['message'] = 'You can\'t delete other\'s list';
            } else {
                $list_details = $this->user_model->get_all_details(LISTS_DETAILS, array('id'=>$lid,'user_id'=>$uid));
                if ($list_details->num_rows() == 1) {
                    $followers_id = $list_details->row()->followers;
                    if ($followers_id != '') {
                        $searchArr = array_filter(explode(',', $followers_id));
                        $fieldsArr = array('following_user_lists','id');
                        $followersArr = $this->user_model->get_fields_from_many(USERS, $fieldsArr, 'id', $searchArr);
                        if ($followersArr->num_rows()>0) {
                            foreach ($followersArr->result() as $followersRow) {
                                $listArr = array_filter(explode(',', $followersRow->following_user_lists));
                                if (in_array($lid, $listArr)) {
                                    if (($key = array_search($lid, $listArr)) != false) {
                                        unset($listArr[$key]);
                                        $this->user_model->update_details(USERS, array('following_user_lists'=>implode(',', $listArr)), array('id'=>$followersRow->id));
                                    }
                                }
                            }
                        }
                    }
                    $this->user_model->commonDelete(LISTS_DETAILS, array('id'=>$lid,'user_id'=>$this->checkLogin('U')));
                    $listCount = $this->data['userDetails']->row()->lists;
                    $listCount--;
                    if ($listCount == '' || $listCount < 0) {
                        $listCount = 0;
                    }
                    $this->user_model->update_details(USERS, array('lists'=>$listCount), array('id'=>$this->checkLogin('U')));
                    $returnStr['url'] = base_url().'user/'.$this->data['userDetails']->row()->user_name.'/lists';
                    $this->setErrorMessage('success', 'List deleted successfully');
                    $returnStr['status_code'] = 1;
                } else {
                    $returnStr['message'] = 'List not available';
                }
            }
        }
        echo json_encode($returnStr);
    }
    
    public function image_crop()
    {
        if ($this->checkLogin('U') == '') {
            redirect('login');
        } else {
            $uid = $this->uri->segment(2, 0);
            if ($uid != $this->checkLogin('U')) {
                show_404();
            } else {
                $this->data['heading'] = 'Cropping Image';
                $this->load->view('site/user/crop_image', $this->data);
            }
        }
    }
    
    public function image_crop_process()
    {
        if ($this->checkLogin('U') == '') {
            redirect('login');
        } else {
            $targ_w = $targ_h = 240;
            $jpeg_quality = 90;
        
            $src = 'images/users/'.$this->data['userDetails']->row()->thumbnail;
            $ext = substr($src, strpos($src, '.')+1);
            if ($ext == 'png') {
                $jpgImg = imagecreatefrompng($src);
                imagejpeg($jpgImg, $src, 90);
            }
            $img_r = imagecreatefromjpeg($src);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
            
            //			list($width, $height) = getimagesize($src);
        
            imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x1'], $_POST['y1'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);
            //		imagecopyresized($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
            //		imagecopyresized($dst_r, $img_r,0,0, $_POST['x1'],$_POST['y1'], $_POST['x2'],$_POST['y2'],1024,980);
            //			header('Content-type: image/jpeg');
            imagejpeg($dst_r, 'images/users/'.$this->data['userDetails']->row()->thumbnail);
            $this->setErrorMessage('success', 'Profile photo changed successfully');
            redirect('user/'.$this->data['userDetails']->row()->user_name);
            exit;
        }
    }
    
    public function send_noty_mail($followUserDetails=array())
    {
        if (count($followUserDetails)>0) {
            $emailNoty = explode(',', $followUserDetails[0]['email_notifications']);
            if (in_array('following', $emailNoty)) {
                $newsid='7';
                $template_values=$this->user_model->get_newsletter_template_details($newsid);

                $cfmurl = base_url().'site/user/confirm_register/'.$uid."/".$randStr."/confirmation";
                $subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];

                $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>'.$template_values['news_descrip'].'</body>
			</html>';

                if ($template_values['sender_name']=='' && $template_values['sender_email']=='') {
                    $sender_email=$this->config->item('site_contact_mail');
                    $sender_name=$this->config->item('email_title');
                } else {
                    $sender_name=$template_values['sender_name'];
                    $sender_email=$template_values['sender_email'];
                }

                $message = str_replace('{$cfmurl}', $cfmurl, $message);
                $message = str_replace('{$email_title}', $sender_name, $message);
                $message = str_replace('{$meta_title}', $sender_name, $message);
                $message = str_replace('{base_url()}images/logo/{$logo}', $this->data['logo'], $message);
                $message = str_replace('{base_url()}', base_url(), $message);

                $email_values = array('mail_type'=>'html',
                                    'from_mail_id'=>$sender_email,
                                    'mail_name'=>$sender_name,
                                    'to_mail_id'=>$followUserDetails[0]['email'],
                                    'subject_message'=>$subject,
                                    'body_messages'=>$message
                                    );
                $email_send_to_common = $this->product_model->common_email_send($email_values);
            }
        }
    }
    
    public function send_noty_mails($followUserDetails=array())
    {
        if (count($followUserDetails)>0) {
            $emailNoty = explode(',', $followUserDetails->email_notifications);
            if (in_array('following', $emailNoty)) {
                $newsid='9';
                $template_values=$this->product_model->get_newsletter_template_details($newsid);
                $adminnewstemplateArr=array('logo'=> $this->data['logo'],
                    'meta_title'=>$this->config->item('meta_title'),
                    'full_name'=>$followUserDetails[0]['full_name'],
                    'cfull_name'=>$this->data['userDetails']->row()->full_name,
                    'user_name'=>$this->data['userDetails']->row()->user_name);
                extract($adminnewstemplateArr);
                $subject = 'From: '.$template_values['news_title'].' - '.$template_values['news_subject'];

                $message = '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title><body>'.$template_values['news_descrip'].'</body>
			</html>';
            
                if ($template_values['sender_name']=='' && $template_values['sender_email']=='') {
                    $sender_email=$this->data['siteContactMail'];
                    $sender_name=$this->data['siteTitle'];
                } else {
                    $sender_name=$template_values['sender_name'];
                    $sender_email=$template_values['sender_email'];
                }

                $message = str_replace('{$rental_id}', $this->data['userDetails']->row()->user_name, $message);
                $message = str_replace('{$Arr_date}', $this->data['userDetails']->row()->user_name, $message);
                $message = str_replace('{$Dep_date}', $this->data['userDetails']->row()->user_name, $message);
                $message = str_replace('{$Message}', $this->data['userDetails']->row()->user_name, $message);
                $message = str_replace('{$email_title}', $sender_name, $message);
                $message = str_replace('{$meta_title}', $sender_name, $message);
                $message = str_replace('{base_url()}images/logo/{$logo}', $this->data['logo'], $message);

                $email_values = array('mail_type'=>'html',
                                    'from_mail_id'=>$sender_email,
                                    'mail_name'=>$sender_name,
                                    'to_mail_id'=>$followUserDetails->email,
                                    'subject_message'=>$subject,
                                    'body_messages'=>$message
                                    );

                $email_send_to_common = $this->product_model->common_email_send($email_values);
            }
        }
    }
    
    public function order_review()
    {
        if ($this->checkLogin('U')=='') {
            show_404();
        } else {
            $uid = $this->uri->segment(2, 0);
            $sid = $this->uri->segment(3, 0);
            $dealCode = $this->uri->segment(4, 0);
            if ($uid == $this->checkLogin('U')) {
                $view_mode = 'user';
            } elseif ($sid == $this->checkLogin('U')) {
                $view_mode = 'seller';
            } else {
                $view_mode = '';
            }
            if ($view_mode == '') {
                show_404();
            } else {
                if ($view_mode == 'seller') {
                    $order_details = $this->user_model->get_all_details(PAYMENT, array('dealCodeNumber'=>$dealCode,'status'=>'Paid','sell_id'=>$sid));
                } else {
                    $order_details = $this->user_model->get_all_details(PAYMENT, array('dealCodeNumber'=>$dealCode,'status'=>'Paid'));
                }
                if ($order_details->num_rows()==0) {
                    show_404();
                } else {
                    if ($view_mode == 'user') {
                        $this->data['user_details'] = $this->data['userDetails'];
                        $this->data['seller_details'] = $this->user_model->get_all_details(USERS, array('id'=>$sid));
                    } elseif ($view_mode == 'seller') {
                        $this->data['user_details'] = $this->user_model->get_all_details(USERS, array('id'=>$uid));
                        $this->data['seller_details'] = $this->data['userDetails'];
                    }
                    foreach ($order_details->result() as $order_details_row) {
                        $this->data['prod_details'][$order_details_row->product_id] = $this->user_model->get_all_details(PRODUCT, array('id'=>$order_details_row->product_id));
                    }
                    $this->data['view_mode'] = $view_mode;
                    $this->data['order_details'] = $order_details;
                    $sortArr1 = array('field'=>'date','type'=>'desc');
                    $sortArr = array($sortArr1);
                    $this->data['order_comments'] = $this->user_model->get_all_details(REVIEW_COMMENTS, array('deal_code'=>$dealCode), $sortArr);
                    $this->load->view('site/user/display_order_reviews', $this->data);
                }
            }
        }
    }
    
    public function changeOwnpasswordForm()
    {
        if ($this->checkLogin('U')=='') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'Change Password';
            $this->data['AdminDisplay'] = $this->product_model->get_all_details(USERS, array('status'=>'Active','id'=>$this->checkLogin('U')));
            $this->load->view('site/user/changeownpassword', $this->data);
        }
    }
        
    public function changeOwnpassword()
    {
        if ($this->input->post('pass_inDb')!= md5($this->input->post('old_password'))) {
            $this->setErrorMessage('error', 'Current password entred is wrong');
            redirect(base_url('my_account'));
        } else {
            $excludeArr=array('signin','old_password','repeat_password','pass_inDb');
            $condition = array('id' => $this->checkLogin('U'));
            $password = md5($this->input->post("password"));
            $dataArr=array('password'=>$password);
            $this->user_model->commonInsertUpdate(USERS, 'update', $excludeArr, $dataArr, $condition);
            $this->setErrorMessage('success', 'Password changed successfully');
            redirect(base_url('my_account'));
        }
    }
         
    public function post_order_comment()
    {
        if ($this->checkLogin('U') != '') {
            $this->user_model->commonInsertUpdate(REVIEW_COMMENTS, 'insert', array(), array(), '');
        }
    }
    
    public function change_received_status()
    {
        if ($this->checkLogin('U')!='') {
            $status = $this->input->post('status');
            $rid = $this->input->post('rid');
            $this->user_model->update_details(PAYMENT, array('received_status'=>$status), array('id'=>$rid));
        }
    }

    public function list_property()
    {
        $this->load->model('product_model');
        $sortArr1 = array('field'=>'created','type'=>'desc');
        $sortArr = array($sortArr1);
        $this->data['productList'] = $this->product_model->get_all_details(FANCYYBOX, array(), $sortArr);
        $this->load->view('site/product/list_your_property', $this->data);
    }

    public function popup()
    {
        $this->load->view('site/owner/popup');
    }

    public function news_letter()
    {
        $email = $this->input->post('newsletter');
        
        $condition = array('subscrip_mail'=>$email);
        $duplicateName = $this->user_model->get_all_details(SUBSCRIBERS_LIST, $condition);
        if ($duplicateName->num_rows()>0) {
            $this->setErrorMessage('error', 'Email exists');
            redirect($this->uri->segment());
        }
        $this->load->model('newsletter_model');
        $this->newsletter_model->add_subscriber();
        $this->setErrorMessage('error', 'You have been successfully subscribed to the news letter');
        redirect($this->uri->segment());
    }

    /*View User Details*/
    public function view_user_details()
    {
        if ($this->checkLogin('U')=='') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'User Settings';
            $this->data['AdminDisplay'] = $this->product_model->get_all_details(USERS, array('status'=>'Active','id'=>$this->checkLogin('U')));
            $this->load->view('site/user/view_user', $this->data);
        }
    }
    
    /*View RESERVED User Details*/
    public function view_orders()
    {
        if ($this->checkLogin('U')=='') {
            redirect(base_url());
        } else {
            //echo $this->uri->segment(2,0);
                    
            $condition	=	array('id' => $this->uri->segment(2, 0));
            $this->data['heading'] = 'Reserved Property Information';
            $this->data['productList'] = $this->product_model->get_all_details(RESERVED_INFO, $condition);
            $propAddress = $this->user_model->get_all_details(PRODUCT_ADDRESS, array('property_id'=> $this->data['productList']->row()->property_id));
            //print_r($this->data['productList']->result());die;
            $PropertyList=$this->data['productList'];
                    
            if ($PropertyList->row()->image!='') {
                $imgName = $PropertyList->row()->image;
            } else {
                $imgName = 'no-image.jpg';
            }
                    
            $this->data['productListPopUp']='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gain Turnkey Property</title>
</head>
<body style="background:#FFFFFF; width:100%; margin:0; padding:0;">
<div style="width:50%; margin:0px; padding:0px;">
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left;" src="'.$_SERVER['DOCUMENT_ROOT'].'/images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100%!important; vertical-align:top; text-align:right;">'.$propAddress->row()->address.', '.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px; margin:0 0 0 0;">
    	<tr>
        	<td  height="30" align="center" style="float:left; text-align:center; color:#008904; width:100%;  font-family:Arial, Helvetica, sans-serif;  font-size:23px; font-weight:bold">Property Reservation Confirmation</td>
        </tr>
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">Congratulations! You have successfully placed this property under reserve for purchase. Our staff is working diligently on your closing documents and transfer packet. Please bring this hotsheet with you to your closing at the event.</td>
        </tr>
    </table>
    <table border="0" width="500" align="center" cellpadding="0" cellspacing="0" >
    
    	<tr style="margin:20px 0 20px;">
        
        	<td  width="200">
            	<img src="'.$_SERVER['DOCUMENT_ROOT'].'/images/product/'.$imgName.'" style="width:250px !important; height:190px;  " />
            </td>
            
            <td width="300">
            
            	<table cellpadding="0" cellspacing="0"  width="100%" align="left">
                
                	<tr style="margin:5px 0 15px 0px; line-height:26px;" >
                    	<td colspan="2" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property ID: '.$PropertyList->row()->rental_id.'</b></td>
                    </tr>
                    
                    
                   <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td colspan="2" style=" font-size:14px;  margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property Address: '.$propAddress->row()->address.'<br>'.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</b></td>
                    </tr>
                    
                    
                    <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td width="60%" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Beds : '.$PropertyList->row()->bedrooms.'</b></td>
						<td width="35%" align="right" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left;" valign="top">
						<b style="margin:0 0 0 0px" height="30px">Baths : '.$PropertyList->row()->baths.'</b></td>
                    </tr>
                    
                    
                     <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top">
						<b>Sq.Ft : '.$PropertyList->row()->sq_feet.'</b></td>
                        
						<td align="right" valign="top" width="30%" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:left;"  >
                        
						<b style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px;" >Lot Size : '.$PropertyList->row()->lot_size.'</b> </td>
                        
                    </tr>
                    
                    
                    <tr style="margin:5px 0 15px 0px; line-height:28px;">
                    
                    	<td colspan="2" valign="top" style=" font-size:14px; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"> <b>Monthly Rental Amount : $'.number_format($PropertyList->row()->monthly_rent, 0).'</b></br> </td>
                        <br />

						
                    </tr>
                    
                    
					<tr style="margin:5px 0 15px 0px; line-height:28px;">
                    
					<td colspan="2" valign="top" style=" font-size:14px; width=100% !important; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"> <b>Estimated Annual Tax: $'.number_format($PropertyList->row()->property_tax, 0).' </b> </td>
					</tr>
                    
                </table>
                
            </td>
            
        </tr>
    </table>


    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">
    
    	<tr>
        
        	<td colspan="3"><h2 style="color:#008904;  font-size:23px; font-family:Arial, Helvetica, sans-serif; margin:15px 0 15px 0px;">Reservation Information</h2></td>
            
        </tr>
        
    	<tr>
        
            <td colspan="3"><span style="width:40%; display:inline-block; margin:0 0 15px; font-weight:bold; font-size:14px; font-family:Arial, Helvetica, sans-serif">Purchaser Name: '.ucfirst($PropertyList->row()->first_name).' '.ucfirst($PropertyList->row()->last_name).' </span></td>
            
           
           </tr>
           
           <tr>
           
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Name: '.$PropertyList->row()->entity_name.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Type: '.$PropertyList->row()->resrv_type.'</span></td>
           
           </tr>
           
           <tr>
           
           	<td colspan="3"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Address: '.$PropertyList->row()->address.'</span></td>
            
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">City: '.$PropertyList->row()->city.'</span></td>
            
            <td><span style=" display:inline-block; float:left; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">State: '.str_replace('-', ' ', $PropertyList->row()->state).'</span></td>
            
            <td><span style=" display:inline-block; float:left; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Zip: '.$PropertyList->row()->postal_code.'</span></td>
            
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone: '.$PropertyList->row()->phone_no.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0px 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone 2: '.$PropertyList->row()->phone_no1.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email1: '.$PropertyList->row()->email.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email2: '.$PropertyList->row()->email1.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sales Price: $'.number_format($PropertyList->row()->sales_price, 0).'</span></td>
            
            
           ';
            if ($PropertyList->row()->adjustment !='') {
                $this->data['productListPopUp'] .= '<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Adjustment : $'.number_format($PropertyList->row()->adjustment, 0).'</span></td></tr> 
           
           <tr>
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Net Purchase Price: $'.number_format($PropertyList->row()->net_purchase_price, 0).'</span></td>		   
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $'.number_format($PropertyList->row()->reserv_price, 0).'</span></td>
			</tr>
			<tr>
            <td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</span></td>
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->sales_cash.' '.$PropertyList->row()->sales_cf.' '.$PropertyList->row()->sales_cs.' '.$PropertyList->row()->sales_fs.' '.$PropertyList->row()->sales_sdira.' '.$PropertyList->row()->sales_sl.'</span></td></tr>';
            } else {
                $this->data['productListPopUp'] .= '<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $'.number_format($PropertyList->row()->reserv_price, 0).'</span></td>
			</tr>
			<tr>
            <td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</span></td>
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->sales_cash.' '.$PropertyList->row()->sales_cf.' '.$PropertyList->row()->sales_cs.' '.$PropertyList->row()->sales_fs.' '.$PropertyList->row()->sales_sdira.' '.$PropertyList->row()->sales_sl.'</span></td></tr>';
            }

            if ($PropertyList->row()->sales_sdira!='' || $PropertyList->row()->sales_sl !='') {
                $this->data['productListPopUp'] .= '<tr><td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Custodian name: '.$PropertyList->row()->cust_name.'</span></td></tr>';
            } else {
                $this->data['productListPopUp'] .= '<tr><td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">&nbsp;</span></td></tr>';
            }
           
            $this->data['productListPopUp'] .= '
		   
            <tr>
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Note: '.$PropertyList->row()->note.'</span></td>';
            if ($PropertyList->row()->sales_sdira!='' || $PropertyList->row()->sales_sl !='') {
                $this->data['productListPopUp'] .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Account number: '.$PropertyList->row()->account_no.'</span></td>';
            } else {
                $this->data['productListPopUp'] .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">&nbsp;</span></td>';
            }
           
            $this->data['productListPopUp'] .= '</tr>
            
    </table>   
    
    <table border="0" width="550" cellpadding="0" cellspacing="0" style="max-width:550px;">
    	<tr>
        	<td colspan="3" style=" font-size:14px;  line-height:19px; margin-bottom:5px; text-align:left; font-family:Arial, Helvetica, sans-serif" width="550" >
            	This Property reservation Confirmation is your receipt of your commitment to purchase the above referenced property. Due to the nature of the investors summit, and the overwhelming intrest the students have in purchasing the properties brought to the event by our preferred vendors, your possession of this document is evidence that the property has been removed from our active database and is no longer available for sale to other students. Our staff will contact you during the final two days of the event to arrange the production and execution of the final document for closing. Please keep this information for reference prior to closing.
            </td>
        </tr>
        
        
        <tr style="background:#bebebe; height:27px; margin:35px 10px 10px 10px; width:100%;" >
        	<td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 10px;">'.$this->config->item('footer_content').'</td>
            <td width="25%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 50px;">All Rights Reserved</td>
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 10px 3px 3px;">Unauthorized Use or Duplication is Prohibited</td>
        </tr>
    </table> 
    
   </div>
   
   
<div style="width:50%; margin:0px; padding:0px;">
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left;" src="'.$_SERVER['DOCUMENT_ROOT'].'/images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100% !important; vertical-align:top; text-align:right;">INTENT to PURCHASE AGREEMENT</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px; margin:15px 0 10px 0;">
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">This letter sets forth some of the basic terms under which Seller and Purchaser would be interested in entering into a Real Estate Purchase Agreement.  It serves as a letter of intent (“Letter”) from '.$PropertyList->row()->entity_name.' ("Purchaser") through and dated '.date('m-d-Y', strtotime($PropertyList->row()->dateAdded)).', in which Purchaser has set forth its interest in acquiring the subject Property. </td>
        </tr>
    </table>
    
    <table border="0" width="500" align="center" cellpadding="0" cellspacing="0" >
    
    	<tr style="margin:20px 0 20px;">
        
        	<td cellpadding="0" cellspacing="0" width="250" align="left">
            
            	<table>
                
                	<tr>
                    
                    	<td valign="top"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PROPERTY: </span></td>
                        
                        <td valign="middle">'.$propAddress->row()->address.'<br>'.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</td>
                    
                    </tr>
                   
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td><small style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#333;">(herinafter, the “Property”)</small></td>
                    
                    </tr>
                     <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td><small style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#333;">&nbsp;</small></td>
                    
                    </tr>
                     
                	
                
                </table>
            
            </td>
            
            <td cellpadding="0" cellspacing="0" width="250" align="left">
            
            	<table>
                
                	<tr>
                    
                    	<td><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PURCHASER: </span></td>
                        
                        <td>'.ucwords($PropertyList->row()->entity_name).'</td>
                    
                    </tr>
                    
                	<tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.ucwords($PropertyList->row()->first_name).' '.ucwords($PropertyList->row()->last_name).'</td>
                    
                    </tr>
                    
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.$PropertyList->row()->address.'</td>
                    
                    </tr>
                    
                    
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.$PropertyList->row()->city.', '.str_replace('-', ' ', $PropertyList->row()->state).' '.$PropertyList->row()->postal_code.'</td>
                    
                    </tr>
                
                
                </table>
            
            </td>
            
        </tr>
    </table>


    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">
    
    	<tr>
        
        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PAYMENT METHOD: </strong>'.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</td>
            
        </tr>
        

        
        
         <tr>
        
        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASE PRICE: </strong>$'.number_format($PropertyList->row()->sales_price, 0).'</td>
            
        </tr></table>';
            if ($PropertyList->row()->adjustment !='') {
                $this->data['productListPopUp'] .= ' <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">
				 <tr>
           	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">ADJUSTMENT: </strong>$'.number_format($PropertyList->row()->adjustment, 0).'</td>
           	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">NET PURCHASE PRICE: </strong>$'.number_format($PropertyList->row()->net_purchase_price, 0).'</td>
            
           
           </tr></table>';
            }
            $this->data['productListPopUp'] .= '
 <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">
        <tr>
        
        	<td style="line-height:35px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">RESERVATION FEE DEPOSIT: </strong>'.number_format($PropertyList->row()->reserv_price, 0).' dollars ($)</td>
            
        </tr>
        
        
        <tr>
        
        	<td><p style="font-weight:normal; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">(”Reservation Fee”) shall be held by seller in good faith. Seller will not cash or charge the reservation fee, unless the buyer cancels the transaction. If buyer cancels transaction, seller will cash or charge the reservation fee and retain the fee as lost opportunity cost. Otherwise, buyer will fund the property in full, including closing costs, and upon completion of transaction the reservation fee will be permanently disposed of and never be processed.</p></td>
            
        </tr>
      
        <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CONTRACT:</strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Upon the mutual execution of this Letter, Seller will promptly prepare a Purchase and Sale Agreement and Seller shall make a good faith effort to deliver said Purchase and Sale Agreement to Purchaser within seven (7) days from the effective date of the LOI. </span></td>
            
        </tr>
        
          <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CLOSING: </strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Closing shall occur on a date mutually acceptable to purchaser and to be outlined in the Purchase Agreement. </span></td>
            
          </tr>
          
          
          <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CONFIDENTIALITY:</strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Seller, Purchaser, and their agents shall maintain the confidentiality of the parties, terms, and conditions of this letter and the negotiations that may follow, if any, from this date forth.  The above items are the general business terms and conditions to be covered in the Purchase and Sale Agreement, which would be submitted to the Seller.  Additional remaining terms of the Purchase and Sale Agreement will be negotiated and must be acceptable to both Purchaser and Seller.</span></td>
            
          </tr>
          
           <!--<tr>
        
        	<td style="text-align:center;"><span style="font-size:10px; width:100%; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; line-height:20px;">This letter is not intended to be a binding contract.</span></td>
            
           </tr>-->
           
           
           
           <tr>
        
        	<td><span style="font-size:11px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal; line-height:20px;">Buyer hereby agrees to the terms and conditions of the letter.</span></td>
            
           </tr>
           
           
           <tr>
        
        		<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td width="45%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name: </strong>'.$PropertyList->row()->first_name.' '.$PropertyList->row()->last_name.'</td>
                            
                            
                            <td width="45%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name: </strong></td>
                        
                        </tr>
                        
                       <tr>
                        
                        	<td valign="bottom" style="vertical-align:bottom; line-height:20px; "><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                        
                       <tr>
                        
                        	<td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                    
                    
                    </table>
                
                
                </td>
            
           </tr>
           
            
            <tr>
        
        		<td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
            
        	</tr>
            
            
            
             <tr>
        
        		<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td width="25%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Address: </strong>'.$PropertyList->row()->address.'</td>
                            
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">City: </strong>'.$PropertyList->row()->city.'</td>
                            
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">State: </strong>'.str_replace('-', ' ', $PropertyList->row()->state).'</td>
                            
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Zip Code: </strong>'.$PropertyList->row()->postal_code.'</td>
                        
                        
                        </tr>
                        
                        
                        <tr>
                        
                        	<td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Phone Number: </strong>'.$PropertyList->row()->phone_no.'</td>
                            
                            <td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Phone Number: </strong>'.$PropertyList->row()->phone_no1.'</td>
                        
                        </tr>
                        
                        <tr>
                        
                        	<td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Email: </strong>'.$PropertyList->row()->email.'</td>
                            
                            <td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Email: </strong>'.$PropertyList->row()->email1.'</td>
                        
                        </tr>
                    </table>
                
                </td>
        
        	</tr>

            
            <tr>
        
        		<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
                            
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Cash</strong></td>
                            
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Check</strong></td>
                            
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Credit Card</strong></td>
                        
                        
                        </tr>
                    
                    
                    </table>
                
                
                </td>
            
        	</tr>
            
        
        	   <tr>
        
        		<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">CREDIT CARD AUTHORIZATION</strong></td>
            
        	</tr>
            
            
             <tr>
            
            	<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td width="40%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; width:40%">Name on Card:</strong><span style="font-size:13px; color:#F00; width:52%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:65px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            <td width="27%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Card Type:</strong><span style="font-size:13px; color:#F00; width:58%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                             <td width="33%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Amount: $</strong><span style="font-size:13px; color:#F00; width:58%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                        
                        
                        <tr>
                        
                        	<td width="48%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; width:40%">Card Number:</strong><span style="font-size:13px; color:#F00; width:53%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:70px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            <td width="27%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Exp. Date:</strong><span style="font-size:13px; color:#F00; width:60%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                             <td width="21%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Verification Code:</strong><span style="font-size:13px; color:#F00; width:39%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                        
                        
                    </table>
                
               </td>
            
            
            </tr>
        
        
         <tr>
         
         	<td>
            
            	<table width="100%">
                
                	<tr>
                    
                   	  <td width="50%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Authorized Signature:</strong><span style="font-size:13px; color:#F00; width:170px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        <td width="60%">
                        
                        	<table width="100%">
                            
                            	<tr>
                                
                                	<td width="26%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Today’s Date: </strong></td>
                                    
                                    <td width="17%"><span style="font-size:13px; color:#F00; width:62px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:0px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span><span style="font-size:13px; display:inline-block;  font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">/</span></td>
                                    
                                    <td width="20%"><span style="font-size:13px; color:#F00; width:75px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:0px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span><span style="font-size:13px; display:inline-block;  font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">/</span></td>
                                    
                                    <td width="34%"><span style="font-size:13px; color:#F00; width:110px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:0px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                                
                                
                                </tr>
                            
                            </table>
                        
                        
                        </td>
                    
                    </tr>
                
                
                
                </table>
            
            
            </td>
         
         </tr>
            
    </table>   
    
   </div>
   
</body>
</html>';

            $propertyAddres = url_title($PropertyList->row()->prop_address, '-', true);

            ini_set('display_errors', 'off');
  
            require_once("pdfdownload/dompdf_config.inc.php");
            $html = $this->data['productListPopUp'];
            $orientation = 'portrait';
            $paper = 'letter';
            // return_on_rentals_101-Floss-Avenue-Buffalo-NY-14211_3223
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);

            $dompdf->set_paper($paper, $orientation);
            $dompdf->render();
            $invoice = 'return_on_rentals_'.$propertyAddres.'.pdf';
            $dompdf->stream($invoice);


   


            //redirect('my_account');
            //$this->load->view('site/user/view_user',$this->data);
        }
    }

    public function reservation_conform()
    {
        $baseUrl = base_url();
        $proID = $this->uri->segment(2);
        $this->setErrorMessage('success', 'Reservation completed successfully');
            
        $this->data['productList'] = $this->product_model->get_all_details(RESERVED_INFO, array('id'=>$proID));
            
        //print_r($this->data['productList']->result());die;
        $PropertyList=$this->data['productList'];
                    
        if ($PropertyList->row()->image!='') {
            $imgName = $PropertyList->row()->image;
        } else {
            $imgName = 'no-image.jpg';
        }

                    
        $propAddress = $this->user_model->get_all_details(PRODUCT_ADDRESS, array('property_id'=> $PropertyList->row()->property_id));
        $CompDets = $this->user_model->get_all_details(RENTALCOMPS, array('property_id'=> $PropertyList->row()->property_id));

        $this->data['reservedPDF']='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gain Turnkey Property</title>
</head>
<body style="background:#FFFFFF; width:100%; margin:0; padding:0;">
<div id="printthis">
	<div style="margin:0px auto; width:64%;">
	<table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px; ">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left;" src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100%!important; vertical-align:top; text-align:right;">'.$propAddress->row()->address.'<br>'.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px; margin:15px 0 10px 0;">
    	<tr>
        	<td  height="30" align="center" style="float:left; text-align:center; color:#008904; width:100%;  font-family:Arial, Helvetica, sans-serif;  font-size:23px; font-weight:bold">Property Reservation Confirmation</td>
        </tr>
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">Congratulations! You have successfully placed this property under reserve for purchase. Our staff is working diligently on your closing documents and transfer packet. Please bring this hotsheet with you to your closing at the event.</td>
        </tr>
    </table>
    <table border="0" width="700" align="center" cellpadding="0" cellspacing="0" >
    
    	<tr style="margin:20px 0 20px;">
        
        	<td  width="250">
            	<img src="'.base_url().'images/product/thumb/'.$imgName.'" style="width:250px !important; height:190px;  " />
            </td>
            
            <td>
            
            	<table cellpadding="0" cellspacing="0"  width="350" align="left" style="margin-left:125px;">
                
                	<tr style="margin:5px 0 15px 0px; line-height:26px;" >
                    	<td colspan="2" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property ID: '.$PropertyList->row()->rental_id.'</b></td>
                    </tr>
                    
                    
                   <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td colspan="2" style=" font-size:14px;  margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property Address: '.$propAddress->row()->address.', '.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</b></td>
                    </tr>
                    
                    
                    <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td width="60%" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Beds : '.$PropertyList->row()->bedrooms.'</b></td>
						<td width="35%" align="right" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left;" valign="top"><b style="margin:0 0 0 0px" height="30px">Baths : '.$PropertyList->row()->baths.'</b></td>
                    </tr>
                    
                    
                     <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top">
						<b>Sq.Ft : '.$PropertyList->row()->sq_feet.'</b></td>
                        
						<td align="right" valign="top" width="30%" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:left;"  >
                        
						<b style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px;" >Lot Size : '.$PropertyList->row()->lot_size.'</b> </td>
                        
                    </tr>
                    
                    
                    <tr style="margin:5px 0 15px 0px; line-height:28px;">
                    
                    	<td colspan="2" valign="top" style=" font-size:14px; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"> <b>Monthly Rental Amount : $'.number_format($PropertyList->row()->monthly_rent, 0).'</b></br> </td>
                        <br />

						
                    </tr>
                    
                    
					<tr style="margin:5px 0 15px 0px; line-height:28px;">
                    
					<td colspan="2" valign="top" style=" font-size:14px; width=100% !important; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"> <b>Estimated Annual Tax: $'.number_format($PropertyList->row()->property_tax, 0).' </b> </td>
					</tr>
                    
                </table>
                
            </td>
            
        </tr>
    </table>


    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px;">
    
    	<tr>
        
        	<td colspan="3"><h2 style="color:#008904;  font-size:23px; font-family:Arial, Helvetica, sans-serif; margin:15px 0 15px 0px;">Reservation Information</h2></td>
            
        </tr>
        
    	<tr>
        
            <td colspan="3"><span style="width:40%; display:inline-block; margin:0 0 15px; font-weight:bold; font-size:14px; font-family:Arial, Helvetica, sans-serif">Purchaser Name: '.ucfirst($PropertyList->row()->first_name).' '.ucfirst($PropertyList->row()->last_name).' </span></td>
            
           
           </tr>
           
           <tr>
           
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Name: '.$PropertyList->row()->entity_name.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Type: '.$PropertyList->row()->resrv_type.'</span></td>
           
           </tr>
           
           <tr>
           
           	<td colspan="3"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Address: '.$PropertyList->row()->address.'</span></td>
            
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">City: '.$PropertyList->row()->city.'</span></td>
            
            <td><span style="float:left; font-weight:bold; margin:0px 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">State: '.str_replace('-', ' ', $PropertyList->row()->state).'</span></td>
            
            <td><span style="float:left; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Zip: '.$PropertyList->row()->postal_code.'</span></td>
            
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone: '.$PropertyList->row()->phone_no.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0px 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone 2: '.$PropertyList->row()->phone_no1.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email1: '.$PropertyList->row()->email.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email2: '.$PropertyList->row()->email1.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sales Price: $'.number_format($PropertyList->row()->sales_price, 0).'</span></td>
            
            ';
        if ($PropertyList->row()->adjustment !='') {
            $this->data['reservedPDF'] .= '
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Adjustment : $'.number_format($PropertyList->row()->adjustment, 0).'</span></td>
			</tr>
			<tr>
			<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Net Purchase Price : $'.number_format($PropertyList->row()->net_purchase_price, 0).'</span></td>
			<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $'.number_format($PropertyList->row()->reserv_price, 0).'</span></td>
			</tr>
			<tr>
			<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</span></td>
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->sales_cash.' '.$PropertyList->row()->sales_cf.' '.$PropertyList->row()->sales_cs.' '.$PropertyList->row()->sales_fs.' '.$PropertyList->row()->sales_sdira.' '.$PropertyList->row()->sales_sl.' '.$PropertyList->row()->sales_sl_fs.'</span></td>
			</tr>';
        } else {
            $this->data['reservedPDF'] .= '
			<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $'.number_format($PropertyList->row()->reserv_price, 0).'</span></td>
			</tr>
			<tr>
			<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</span></td>
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->sales_cash.' '.$PropertyList->row()->sales_cf.' '.$PropertyList->row()->sales_cs.' '.$PropertyList->row()->sales_fs.' '.$PropertyList->row()->sales_sdira.' '.$PropertyList->row()->sales_sl.' '.$PropertyList->row()->sales_sl_fs.'</span></td>
			</tr>';
        }

        if ($PropertyList->row()->sales_sdira!='' || $PropertyList->row()->sales_sl !='' || $PropertyList->row()->sales_sl_fs !='') {
            $this->data['reservedPDF'] .= '<tr><td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Custodian name: '.$PropertyList->row()->cust_name.'</span></td></tr>';
        } else {
            $this->data['reservedPDF'] .= '<tr><td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">&nbsp;</span></td></tr>';
        }
            
        $this->data['reservedPDF'] .= '<tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Note: '.$PropertyList->row()->note.'</span></td>';
            
        if ($PropertyList->row()->sales_sdira!='' || $PropertyList->row()->sales_sl !='' || $PropertyList->row()->sales_sl_fs !='') {
            $this->data['reservedPDF'] .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Account number: '.$PropertyList->row()->account_no.'</span></td>';
        } else {
            $this->data['reservedPDF'] .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">&nbsp;</span></td>';
        }
    
        $this->data['reservedPDF'] .= '</tr>
    </table>   
    
    <table border="0" width="750" cellpadding="0" cellspacing="0" style="max-width:750px;">
    	<tr>
        	<td colspan="3" style=" font-size:14px;  line-height:19px; margin-bottom:5px; text-align:left; font-family:Arial, Helvetica, sans-serif" width="550" >
            	This Property reservation Confirmation is your receipt of your commitment to purchase the above referenced property. Due to the nature of the investors summit, and the overwhelming intrest the students have in purchasing the properties brought to the event by our preferred vendors, your possession of this document is evidence that the property has been removed from our active database and is no longer available for sale to other students. Our staff will contact you during the final two days of the event to arrange the production and execution of the final document for closing. Please keep this information for reference prior to closing.
            </td>
        </tr>
        
        
        <tr style="background:#bebebe; height:27px; margin:35px 10px 10px 10px; width:100%;" >
        	<td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 10px;">'.$this->config->item('footer_content').'</td>
            <td width="25%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 3px;">All Rights Reserved</td>
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 10px 3px 3px;">Unauthorized Use or Duplication is Prohibited</td>
        </tr>
		</table> 
    </div>
   		<div style="margin-top:250px;"></div>
	<div style="margin:0px auto; width:64%;">
	<table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px;">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left;" src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100% !important; vertical-align:top; text-align:right;">INTENT to PURCHASE AGREEMENT</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px; margin:15px 0 10px 0;">
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">This letter sets forth some of the basic terms under which Seller and Purchaser would be interested in entering into a Real Estate Purchase Agreement.  It serves as a letter of intent (“Letter”) from '.$PropertyList->row()->entity_name.' ("Purchaser") through and dated '.date('m-d-Y', strtotime($PropertyList->row()->dateAdded)).', in which Purchaser has set forth its interest in acquiring the subject Property.</td>
        </tr>
    </table>
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" >
    	<tr style="margin:20px 0 20px;">
        	<td cellpadding="0" cellspacing="0" width="250" align="left">
            	<table>
                	<tr>
                    	<td><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PROPERTY: </span></td>
                        <td>'.$propAddress->row()->address.'</td>
                    </tr>
					<tr>
                    	<td>&nbsp;</td>
                        <td>'.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</td>
                    </tr>
                	<tr>
                    	<td>&nbsp;</td>
                        <td><small style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#333;">(herinafter, the “Property”)</small></td>
                    </tr>
                     <tr>
                    	<td>&nbsp;</td>
                        <td><small style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#333;">&nbsp;</small></td>
                    </tr>
                </table>
            </td>
            <td cellpadding="0" cellspacing="0" width="250" align="left">
            
            	<table>
                
                	<tr>
                    
                    	<td><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PURCHASER: </span></td>
                        
                        <td>'.ucwords($PropertyList->row()->entity_name).'</td>
                    
                    </tr>
                    
                	<tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.ucwords($PropertyList->row()->first_name).' '.ucwords($PropertyList->row()->last_name).'</td>


                    
                    </tr>
                    
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.$PropertyList->row()->address.'</td>
                    
                    </tr>
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.$PropertyList->row()->city.', '.str_replace('-', ' ', $PropertyList->row()->state).' '.$PropertyList->row()->postal_code.'</td>
                    
                    </tr>
                </table>
            
            </td>
            
        </tr>
    </table>

    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px;">
    
    	<tr>
        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PAYMENT METHOD: </strong>'.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</td>
            
        </tr>

         <tr>
        
        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASE PRICE: </strong>$'.number_format($PropertyList->row()->sales_price, 0).'</td>
            
        </tr></table>';
        if ($PropertyList->row()->adjustment !='') {
            $this->data['reservedPDF'] .= '<table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px;">
				 <tr>
           
           	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">ADJUSTMENT: </strong>$'.number_format($PropertyList->row()->adjustment, 0).'</td>

           	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">NET PURCHASE PRICE: </strong>$'.number_format($PropertyList->row()->net_purchase_price, 0).'</td>
           </tr></table>';
        }
        $this->data['reservedPDF'] .= '
        <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px;">
        <tr>
        
        	<td style="line-height:35px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">RESERVATION FEE DEPOSIT: </strong>'.number_format($PropertyList->row()->reserv_price, 0).' dollars ($)</td>
            
        </tr>
        
        <tr>
        
        	<td><p style="font-weight:normal; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">(”Reservation Fee”) shall be held by seller in good faith. Seller will not cash or charge the reservation fee, unless the buyer cancels the transaction. If buyer cancels transaction, seller will cash or charge the reservation fee and retain the fee as lost opportunity cost. Otherwise, buyer will fund the property in full, including closing costs, and upon completion of transaction the reservation fee will be permanently disposed of and never be processed.</p></td>
            
        </tr>
      
        <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CONTRACT:</strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Upon the mutual execution of this Letter, Seller will promptly prepare a Purchase and Sale Agreement and Seller shall make a good faith effort to deliver said Purchase and Sale Agreement to Purchaser within seven (7) days from the effective date of the LOI. </span></td>
            
        </tr>
          <tr>
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CLOSING: </strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Closing shall occur on a date mutually acceptable to purchaser and to be outlined in the Purchase Agreement. </span></td>
            
          </tr>
          <tr>
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CONFIDENTIALITY:</strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Seller, Purchaser, and their agents shall maintain the confidentiality of the parties, terms, and conditions of this letter and the negotiations that may follow, if any, from this date forth.  The above items are the general business terms and conditions to be covered in the Purchase and Sale Agreement, which would be submitted to the Seller.  Additional remaining terms of the Purchase and Sale Agreement will be negotiated and must be acceptable to both Purchaser and Seller.</span></td>
            
          </tr>
          
           <!--<tr>
        
        	<td style="text-align:center;"><span style="font-size:10px; width:100%; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; line-height:20px;">This letter is not intended to be a binding contract.</span></td>
            
           </tr>-->
           
           <tr>
        
        	<td><span style="font-size:11px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal; line-height:20px;">Buyer hereby agrees to the terms and conditions of the letter.</span></td>
            
           </tr>
           
           <tr>
        		<td>
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td width="45%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name: </strong>'.$PropertyList->row()->first_name.' '.$PropertyList->row()->last_name.'</td>
                            
                            
                            <td width="45%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name: </strong></td>
                        
                        </tr>
                        
                       <tr>
                        
                        	<td valign="bottom" style="vertical-align:bottom; line-height:20px; "><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                            
                            
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                        
                       <tr>
                        
                        	<td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                            
                            
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                    
                    </table>
                </td>
           </tr>
            <tr>        
        		<td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
        	</tr>
             <tr>
        		<td>
                	<table width="100%">
                    	<tr>
                        	<td width="25%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Address: </strong>'.$PropertyList->row()->address.'</td>
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">City: </strong>'.$PropertyList->row()->city.'</td>
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">State: </strong>'.str_replace('-', ' ', $PropertyList->row()->state).'</td>
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Zip Code: </strong>'.$PropertyList->row()->postal_code.'</td>
                        </tr>
                        <tr>
                        	<td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Phone Number: </strong>'.$PropertyList->row()->phone_no.'</td>
                            <td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Phone Number: </strong>'.$PropertyList->row()->phone_no1.'</td>
                        </tr>
                        <tr>
                        	<td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Email: </strong>'.$PropertyList->row()->email.'</td>
                            <td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Email: </strong>'.$PropertyList->row()->email1.'</td>
                        </tr>
                    </table>
                </td>
        	</tr>
            <tr>
        		<td>
                	<table width="100%">
                    	<tr>
                        	<td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Cash</strong></td>
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Check</strong></td>
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Credit Card</strong></td>
                        </tr>
                    </table>
                </td>
        	</tr>
        	   <tr>
        		<td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">CREDIT CARD AUTHORIZATION</strong></td>
        	</tr>
             <tr>
            	<td>
                	<table width="100%">
                    	<tbody><tr>
                        	<td width="40%" style="line-height:20px;"><strong style="font-weight: normal; font-family: Arial,Helvetica,sans-serif; font-size: 13px; color: rgb(0, 0, 0); width: 40%; float: left;">Name on Card:</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; margin-left: 10px; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 53%;">&nbsp;</span></td>
                            <td width="27%" style="line-height:20px;"><strong style="font-weight: normal; font-family: Arial,Helvetica,sans-serif; font-size: 13px; color: rgb(0, 0, 0);">Card Type:</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; margin-left: 10px; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 60%;">&nbsp;</span></td>
                             <td width="33%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Amount: $</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; margin-left: 10px; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 61%;">&nbsp;</span></td>
                        </tr>
                        <tr>
                        	<td width="48%" style="line-height:20px;"><strong style="font-weight: normal; font-family: Arial,Helvetica,sans-serif; font-size: 13px; color: rgb(0, 0, 0); float: left; width: 40%;">Card Number:</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; margin-left: 10px; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 54%;">&nbsp;</span></td>
                            <td width="27%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Exp. Date:</strong><span style="font-size:13px; color:#F00; width:60%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                             <td width="21%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Verification Code:</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; margin-left: 10px; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 39%;">&nbsp;</span></td>
                        </tr>
                     </tbody></table>
                </td>
            </tr>
</table>
</td>
            </tr>
        <tr>
         	<td>
            	<table width="100%">
                	<tbody><tr>
                    	<td width="45%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Authorized Signature:</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 192px; margin-left: 12px;">&nbsp;</span></td>
                        <td width="50%">
                        <table width="101%">
                            	<tbody><tr>
                                	<td width="26%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Today’s Date: </strong></td>
                                    <td width="21%"><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 67px;">&nbsp;</span><span style="font-size: 13px; display: inline-block; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px;">/</span></td>
                                    <td width="24%"><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; margin-left: -12px; width: 79px;">&nbsp;</span><span style="font-size: 13px; display: inline-block; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; margin-left: 2px;">/</span></td>
                                    <td width="50%"><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 127px; margin-left: -24px;">&nbsp;</span></td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </table>
            </td>
         </tr> 
         </table>
		 
		 <table border="0" width="750" cellpadding="0" cellspacing="0" style="max-width:750px;">
		 <tr style="background:#bebebe; height:27px; margin:35px 10px 10px 10px; width:100%;" >
        	<td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 10px;">'.$this->config->item('footer_content').'</td>
            <td width="25%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 3px;">All Rights Reserved</td>
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 10px 3px 3px;">Unauthorized Use or Duplication is Prohibited</td>
        </tr>
		</table> 
    </div>
   		<div style="margin-top:50px;"></div>
	<div style="margin:0px auto; width:64%;">
	<table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px;">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left; " src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100% !important; vertical-align:top; text-align:right;">Comps</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px; margin:15px 0 10px 0;">
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">This letter sets forth some of the basic terms under which Seller and Purchaser would be interested in entering into a Real Estate Purchase Agreement.  It serves as a letter of intent (“Letter”) from '.$PropertyList->row()->entity_name.' ("Purchaser") through and dated '.date('m-d-Y', strtotime($PropertyList->row()->dateAdded)).', in which Purchaser has set forth its interest in acquiring the subject Property.  </td>
        </tr>
    </table>  

         </div>
         </div>
         <table width="100%">
		  <tr>
        	<td style="font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:22px; text-align:center;" colspan="3"><br>
            	<a href="'.base_url().'site/user/view_order111/'.$PropertyList->row()->id.'"><button>Download PDF</button></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="print_btn" style="display: none;" onClick="printthis(); return false;">Print this page</button>
            </td>
        </tr>
      </table>
		 
         </div>
         </div>
         <table width="100%">
		  <tr>
        	<td style="font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:22px; text-align:center;" colspan="3"><br>
            	<a href="'.base_url().'site/user/view_order111/'.$PropertyList->row()->id.'"><button>Download PDF</button></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="print_btn" style="display: none;" onClick="printthis(); return false;">Print this page</button>
            </td>
        </tr>
      </table>
    
  

</body>
</html>
</body>
</html>';


                    
                    
        $this->data['productListPopUp']='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gain Turnkey Property</title>
</head>
<body style="background:#FFFFFF; width:100%; margin:0; padding:0;">
<div id="printthis">
	<div style="margin:0px auto; width:64%;">
	<table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px; ">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left;" src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100%!important; vertical-align:top; text-align:right;">'.$propAddress->row()->address.', '.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px; margin:15px 0 10px 0;">
    	<tr>
        	<td  height="30" align="center" style="float:left; text-align:center; color:#008904; width:100%;  font-family:Arial, Helvetica, sans-serif;  font-size:23px; font-weight:bold">Property Reservation Confirmation</td>
        </tr>
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">Congratulations! You have successfully placed this property under reserve for purchase. Our staff is working diligently on your closing documents and transfer packet. Please bring this hotsheet with you to your closing at the event.</td>
        </tr>
    </table>
    <table border="0" width="700" align="center" cellpadding="0" cellspacing="0" >
    
    	<tr style="margin:20px 0 20px;">
        
        	<td  width="250">
            	<img src="'.base_url().'images/product/thumb/'.$imgName.'" style="width:250px !important; height:190px;  " />
            </td>
            
            <td>
            
            	<table cellpadding="0" cellspacing="0"  width="350" align="left" style="margin-left:30px;">
                
                	<tr style="margin:5px 0 15px 0px; line-height:26px;" >
                    	<td colspan="2" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property ID: '.$PropertyList->row()->rental_id.'</b></td>
                    </tr>
                    
                    
                   <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td colspan="2" style=" font-size:14px;  margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property Address: '.$propAddress->row()->address.'<br>'.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</b></td>
                    </tr>
                    
                    
                    <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td width="60%" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Beds : '.$PropertyList->row()->bedrooms.'</b></td>
						<td width="35%" align="right" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left;" valign="top"><b style="margin:0 0 0 0px" height="30px">Baths : '.$PropertyList->row()->baths.'</b></td>
                    </tr>
                    
                    
                     <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top">
						<b>Sq.Ft : '.$PropertyList->row()->sq_feet.'</b></td>
                        
						<td align="right" valign="top" width="30%" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:left;"  >
                        
						<b style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px;" >Lot Size : '.$PropertyList->row()->lot_size.'</b> </td>
                        
                    </tr>
                    
                    
                    <tr style="margin:5px 0 15px 0px; line-height:28px;">
                    
                    	<td colspan="2" valign="top" style=" font-size:14px; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"> <b>Monthly Rental Amount : $'.number_format($PropertyList->row()->monthly_rent, 0).'</b></br> </td>
                        <br />

						
                    </tr>
                    
                    
					<tr style="margin:5px 0 15px 0px; line-height:28px;">
                    
					<td colspan="2" valign="top" style=" font-size:14px; width=100% !important; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"> <b>Estimated Annual Tax: $'.number_format($PropertyList->row()->property_tax, 0).' </b> </td>
					</tr>
                    
                </table>
                
            </td>
            
        </tr>
    </table>


    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px;">
    
    	<tr>
        
        	<td colspan="3"><h2 style="color:#008904;  font-size:23px; font-family:Arial, Helvetica, sans-serif; margin:15px 0 15px 0px;">Reservation Information</h2></td>
            
        </tr>
        
    	<tr>
        
            <td colspan="3"><span style="width:40%; display:inline-block; margin:0 0 15px; font-weight:bold; font-size:14px; font-family:Arial, Helvetica, sans-serif">Purchaser Name: '.ucfirst($PropertyList->row()->first_name).' '.ucfirst($PropertyList->row()->last_name).' </span></td>
            
           
           </tr>
           
           <tr>
           
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Name: '.$PropertyList->row()->entity_name.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Type: '.$PropertyList->row()->resrv_type.'</span></td>
           
           </tr>
           
           <tr>
           
           	<td colspan="3"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Address: '.$PropertyList->row()->address.'</span></td>
            
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">City: '.$PropertyList->row()->city.'</span></td>
            
            <td><span style="float:left; font-weight:bold; margin:0px 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">State: '.str_replace('-', ' ', $PropertyList->row()->state).'</span></td>
            
            <td><span style="float:left; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Zip: '.$PropertyList->row()->postal_code.'</span></td>
            
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone: '.$PropertyList->row()->phone_no.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0px 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone 2: '.$PropertyList->row()->phone_no1.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email1: '.$PropertyList->row()->email.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email2: '.$PropertyList->row()->email1.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sales Price: $'.number_format($PropertyList->row()->sales_price, 0).'</span></td>
         ';
        if ($PropertyList->row()->adjustment !='') {
            $this->data['productListPopUp'] .= '<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Adjustment : $'.number_format($PropertyList->row()->adjustment, 0).'</span></td></tr>
			 <tr>
			 <td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Net Purchase Price : $'.number_format($PropertyList->row()->net_purchase_price, 0).'</span></td>
			 <td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $'.number_format($PropertyList->row()->reserv_price, 0).'</span></td>
			 </tr>
			 <tr>
            <td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</span></td>
           <td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->sales_cash.' '.$PropertyList->row()->sales_cf.' '.$PropertyList->row()->sales_cs.' '.$PropertyList->row()->sales_fs.' '.$PropertyList->row()->sales_sdira.' '.$PropertyList->row()->sales_sl.' '.$PropertyList->row()->sales_sl_fs.'</span></td>
			</tr>';
        } else {
            $this->data['productListPopUp'] .= '<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $'.number_format($PropertyList->row()->reserv_price, 0).'</span></td>
			 </tr>
			 <tr>
            <td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</span></td>
           <td><span style="display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->sales_cash.' '.$PropertyList->row()->sales_cf.' '.$PropertyList->row()->sales_cs.' '.$PropertyList->row()->sales_fs.' '.$PropertyList->row()->sales_sdira.' '.$PropertyList->row()->sales_sl.' '.$PropertyList->row()->sales_sl_fs.'</span></td>
			</tr>';
        }

           
        if ($PropertyList->row()->sales_sdira!='' || $PropertyList->row()->sales_sl!='' || $PropertyList->row()->sales_sl_fs!='') {
            $this->data['productListPopUp'] .= '<tr><td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Custodian name: '.$PropertyList->row()->cust_name.'</span></td></tr>';
        } else {
            $this->data['productListPopUp'] .= '<tr><td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">&nbsp;</span></td></tr>';
        }
            
        $this->data['productListPopUp'] .= '
            <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Note: '.$PropertyList->row()->note.'</span></td>';
            
        if ($PropertyList->row()->sales_sdira!='' || $PropertyList->row()->sales_sl!='' || $PropertyList->row()->sales_sl_fs!='') {
            $this->data['productListPopUp'] .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Account number: '.$PropertyList->row()->account_no.'</span></td>';
        } else {
            $this->data['productListPopUp'] .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">&nbsp;</span></td>';
        }
            
        $this->data['productListPopUp'] .= '</tr>
    </table>   
    
    <table border="0" width="750" cellpadding="0" cellspacing="0" style="max-width:750px;">
    	<tr>
        	<td colspan="3" style=" font-size:14px;  line-height:19px; margin-bottom:5px; text-align:left; font-family:Arial, Helvetica, sans-serif" width="550" >
            	This Property reservation Confirmation is your receipt of your commitment to purchase the above referenced property. Due to the nature of the investors summit, and the overwhelming intrest the students have in purchasing the properties brought to the event by our preferred vendors, your possession of this document is evidence that the property has been removed from our active database and is no longer available for sale to other students. Our staff will contact you during the final two days of the event to arrange the production and execution of the final document for closing. Please keep this information for reference prior to closing.
            </td>
        </tr>
        
        
        <tr style="background:#bebebe; height:27px; margin:35px 10px 10px 10px; width:100%;" >
        	<td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 10px;">'.$this->config->item('footer_content').'</td>
            <td width="25%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 3px;">All Rights Reserved</td>
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 10px 3px 3px;">Unauthorized Use or Duplication is Prohibited</td>
        </tr>
		</table> 
    </div>
   		<div style="margin-top:200px;"></div>
	<div style="margin:0px auto; width:64%;">
	<table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px;">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left;" src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100% !important; vertical-align:top; text-align:right;">INTENT to PURCHASE AGREEMENT</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px; margin:15px 0 10px 0;">
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">This letter sets forth some of the basic terms under which Seller and Purchaser would be interested in entering into a Real Estate Purchase Agreement.  It serves as a letter of intent (“Letter”) from '.$PropertyList->row()->entity_name.' ("Purchaser") through and dated '.date('m-d-Y', strtotime($PropertyList->row()->dateAdded)).', in which Purchaser has set forth its interest in acquiring the subject Property. </td>
        </tr>
    </table>
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" >
    	<tr style="margin:20px 0 20px;">
        	<td cellpadding="0" cellspacing="0" width="250" align="left">
            	<table>
				
                	<tr>
                    	<td><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PROPERTY: </span></td>
                        <td>'.$propAddress->row()->address.'</td>
                    </tr>
					<tr>
                    	<td>&nbsp;</td>
                        <td>'.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</td>
                    </tr>
                	<tr>
                    	<td>&nbsp;</td>
                        <td><small style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#333;">(herinafter, the “Property”)</small></td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                        <td><small style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#333;">&nbsp;</small></td>
                    </tr>
					
                </table>
            </td>
            <td cellpadding="0" cellspacing="0" width="250" align="left">
            
            	<table>
                
                	<tr>
                    
                    	<td><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PURCHASER: </span></td>
                        
                        <td>'.ucwords($PropertyList->row()->entity_name).'</td>
                    
                    </tr>
                    
                	<tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.ucwords($PropertyList->row()->first_name).' '.ucwords($PropertyList->row()->last_name).'</td>

                    
                    </tr>
                    
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.$PropertyList->row()->address.'</td>
                    
                    </tr>
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.$PropertyList->row()->city.', '.str_replace('-', ' ', $PropertyList->row()->state).' '.$PropertyList->row()->postal_code.'</td>
                    
                    </tr>
                </table>
            
            </td>
            
        </tr>
    </table>

    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px;">
    
    	<tr>
        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PAYMENT METHOD: </strong>'.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</td>
            
        </tr>

         <tr>
        
        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASE PRICE: </strong>$'.number_format($PropertyList->row()->sales_price, 0).'</td>
            
        </tr></table>';
        if ($PropertyList->row()->adjustment !='') {
            $this->data['productListPopUp'] .= '<table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px;">
				 <tr>
           	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">ADJUSTMENT: </strong>$'.number_format($PropertyList->row()->adjustment, 0).'</td>
           	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">NET PURCHASE PRICE: </strong>$'.number_format($PropertyList->row()->net_purchase_price, 0).'</td>
           </tr></table>';
        }
        $this->data['productListPopUp'] .= '
       <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px;">
        <tr>
        
        	<td style="line-height:35px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">RESERVATION FEE DEPOSIT: </strong>'.number_format($PropertyList->row()->reserv_price, 0).' dollars ($)</td>
            
        </tr>
        
        <tr>
        
        	<td><p style="font-weight:normal; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">(”Reservation Fee”) shall be held by seller in good faith. Seller will not cash or charge the reservation fee, unless the buyer cancels the transaction. If buyer cancels transaction, seller will cash or charge the reservation fee and retain the fee as lost opportunity cost. Otherwise, buyer will fund the property in full, including closing costs, and upon completion of transaction the reservation fee will be permanently disposed of and never be processed.</p></td>
            
        </tr>
      
        <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CONTRACT:</strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Upon the mutual execution of this Letter, Seller will promptly prepare a Purchase and Sale Agreement and Seller shall make a good faith effort to deliver said Purchase and Sale Agreement to Purchaser within seven (7) days from the effective date of the LOI. </span></td>
            
        </tr>
          <tr>
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CLOSING: </strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Closing shall occur on a date mutually acceptable to purchaser and to be outlined in the Purchase Agreement. </span></td>
            
          </tr>
          <tr>
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CONFIDENTIALITY:</strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Seller, Purchaser, and their agents shall maintain the confidentiality of the parties, terms, and conditions of this letter and the negotiations that may follow, if any, from this date forth.  The above items are the general business terms and conditions to be covered in the Purchase and Sale Agreement, which would be submitted to the Seller.  Additional remaining terms of the Purchase and Sale Agreement will be negotiated and must be acceptable to both Purchaser and Seller.</span></td>
          </tr>
           <!--<tr>
        	<td style="text-align:center;"><span style="font-size:10px; width:100%; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; line-height:20px;">This letter is not intended to be a binding contract.</span></td>
           </tr>-->
           <tr>
        	<td><span style="font-size:11px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal; line-height:20px;">Buyer hereby agrees to the terms and conditions of the letter.</span></td>
           </tr>
           <tr>
        		<td>
                	<table width="100%">
                    	<tr>
                        	<td width="45%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name: </strong>'.$PropertyList->row()->first_name.' '.$PropertyList->row()->last_name.'</td>
                            <td width="45%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name: </strong></td>
                        </tr>
                       <tr>
                        	<td valign="bottom" style="vertical-align:bottom; line-height:20px; "><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                        </tr>
                       <tr>
                        	<td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                        </tr>
                    </table>
                </td>
           </tr>
            <tr>        
        		<td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
        	</tr>
             <tr>
        		<td>
                	<table width="100%">
                    	<tr>
                        	<td width="25%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Address: </strong>'.$PropertyList->row()->address.'</td>
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">City: </strong>'.$PropertyList->row()->city.'</td>
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">State: </strong>'.str_replace('-', ' ', $PropertyList->row()->state).'</td>
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Zip Code: </strong>'.$PropertyList->row()->postal_code.'</td>
                        </tr>
                        <tr>
                        	<td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Phone Number: </strong>'.$PropertyList->row()->phone_no.'</td>
                            <td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Phone Number: </strong>'.$PropertyList->row()->phone_no1.'</td>
                        </tr>
                        <tr>
                        	<td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Email: </strong>'.$PropertyList->row()->email.'</td>
                            <td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Email: </strong>'.$PropertyList->row()->email1.'</td>
                        </tr>
                    </table>
                </td>
        	</tr>
            <tr>
        		<td>
                	<table width="100%">
                    	<tr>
                        	<td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Cash</strong></td>
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Check</strong></td>
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Credit Card</strong></td>
                        </tr>
                    </table>
                </td>
        	</tr>
        	   <tr>
        		<td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">CREDIT CARD AUTHORIZATION</strong></td>
        	</tr>
             <tr>
            	<td>
<table width="100%">
	<tr>
            	<td>
                	<table width="100%">
                    	<tbody><tr>
                        	<td width="40%" style="line-height:20px;"><strong style="font-weight: normal; font-family: Arial,Helvetica,sans-serif; font-size: 13px; color: rgb(0, 0, 0); width: 40%; float: left;">Name on Card:</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; margin-left: 10px; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 53%;">&nbsp;</span></td>
                            <td width="27%" style="line-height:20px;"><strong style="font-weight: normal; font-family: Arial,Helvetica,sans-serif; font-size: 13px; color: rgb(0, 0, 0);">Card Type:</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; margin-left: 10px; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 60%;">&nbsp;</span></td>
                             <td width="33%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Amount: $</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; margin-left: 10px; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 61%;">&nbsp;</span></td>
                        </tr>
                        <tr>
                        	<td width="48%" style="line-height:20px;"><strong style="font-weight: normal; font-family: Arial,Helvetica,sans-serif; font-size: 13px; color: rgb(0, 0, 0); float: left; width: 40%;">Card Number:</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; margin-left: 10px; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 54%;">&nbsp;</span></td>
                            <td width="27%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Exp. Date:</strong><span style="font-size:13px; color:#F00; width:60%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:static; top:15px;">&nbsp;</span></td>
                             <td width="21%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Verification Code:</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; margin-left: 10px; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 39%;">&nbsp;</span></td>
                        </tr>
                     </tbody></table>
                </td>
            </tr>
</table>
</td>
            </tr>
        <tr>
         	<td>
            	<table width="100%">
                	<tbody><tr>
                    	<td width="45%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Authorized Signature:</strong><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 192px; margin-left: 12px;">&nbsp;</span></td>
                        <td width="50%">
                        <table width="101%">
                            	<tbody><tr>
                                	<td width="26%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Today’s Date: </strong></td>
                                    <td width="21%"><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 67px;">&nbsp;</span><span style="font-size: 13px; display: inline-block; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px;">/</span></td>
                                    <td width="24%"><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; margin-left: -12px; width: 79px;">&nbsp;</span><span style="font-size: 13px; display: inline-block; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; margin-left: 2px;">/</span></td>
                                    <td width="50%"><span style="font-size: 13px; color: rgb(255, 0, 0); display: inline-block; border-bottom: 1px solid rgb(0, 0, 0); vertical-align: bottom; font-family: Arial,Helvetica,sans-serif; font-weight: normal; position: static; top: 15px; width: 127px; margin-left: -24px;">&nbsp;</span></td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </td>
         </tr>';
        if ($CompDets->num_rows() > 0) {
            $this->data['productListPopUp'] .= '</table>
		 <table border="0" width="750" cellpadding="0" cellspacing="0" style="max-width:750px;">
		 <tr style="background:#bebebe; height:27px; margin:35px 10px 10px 10px; width:100%;" >
        	<td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 10px;">'.$this->config->item('footer_content').'</td>
            <td width="25%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 3px;">All Rights Reserved</td>
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 10px 3px 3px;">Unauthorized Use or Duplication is Prohibited</td>
        </tr>
		</table> 
    </div>';
    
    
            $this->data['productListPopUp'] .= '<div style="margin-top:50px;"></div>
	<div style="margin:0px auto; width:64%;">
	<table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width: 750px;">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left;" src="'.base_url().'images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100% !important; vertical-align:top; text-align:right;">Comps</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="750" align="center" cellpadding="0" cellspacing="0" style="max-width:750px; margin:15px 0 10px 0;">

<tr style="line-height:26px;">
	<td width="30%"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">Property Address</span></td>
    <td width="15%" align="center"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">Purchase Price</span></td>
    <td width="12%" align="center"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">Date Sold</span></td>
    <td width="15%" align="center"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">Type of Deal</span></td>
    <td width="12%" align="center"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">No of Beds</span></td>
    <td width="11%" align="center"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">No of Baths</span></td>
</tr>';
            foreach ($CompDets->result() as $compDets) {
                $this->data['productListPopUp'] .= '
<tr style="line-height:26px;">
		<td><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->comp_prop_address.'</span></td>
		<td align="center"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">$'.$compDets->comp_purchase_price.'</span></td>
        <td align="center"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->comp_date_sold.'</span></td>
        <td align="center"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->comp_type_deal.'</span></td>
        <td align="center"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->no_of_beds.'</span></td>
        <td align="center"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->no_of_baths.'</span></td>
</tr>';
            }
            $this->data['productListPopUp'] .= '</table>  
 <table border="0" width="750" cellpadding="0" cellspacing="0" style="max-width:750px;">
		 <tr style="background:#bebebe; height:27px; margin:35px 10px 10px 10px; width:100%;" >
        	<td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 10px;">'.$this->config->item('footer_content').'</td>
            <td width="25%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 3px;">All Rights Reserved</td>
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 10px 3px 3px;">Unauthorized Use or Duplication is Prohibited</td>
        </tr>
		</table> 
         </div>';
        }
        $this->data['productListPopUp'] .= '</div>
         <table width="100%" class="buttons-of-print">
		  <tr>
        	<td style="font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:22px; text-align:center;" colspan="3"><br>
            	<a href="'.base_url().'site/user/view_order111/'.$PropertyList->row()->id.'"><button>Download PDF</button></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button onClick="printthis(); return false;">Print this page</button>
            </td>
        </tr>
      </table>';
    


        $this->data['productListPopUp'] .= '</body>
</html>
</body>
</html>';
        $this->load->view('site/product/reservation_conform', $this->data);
    }
    
    /**
     *
     * This function loads the order view page
     */
    public function view_order111()
    {
        $baseUrl = base_url();
        if ($this->checkLogin('U') == '') {
            redirect(base_url());
        } else {
            $this->data['heading'] = 'View Order';
            $user_id = $this->uri->segment(4, 0);
            $deal_id = $this->uri->segment(5, 0);
            //$this->data['ViewList'] = $this->order_model->view_orders($user_id,$deal_id);
            $condition	=	array('id' => $this->uri->segment(4, 0));
            $this->data['productList'] = $this->user_model->get_all_details(RESERVED_INFO, $condition);
            $propAddress = $this->user_model->get_all_details(PRODUCT_ADDRESS, array('property_id'=> $this->data['productList']->row()->property_id));
            //print_r($this->data['productList']->result());die;
            $CompDets = $this->user_model->get_all_details(RENTALCOMPS, array('property_id'=> $this->data['productList']->row()->property_id));
            
            $PropertyList=$this->data['productList'];
                    
            if ($PropertyList->row()->image!='') {
                $imgName = $PropertyList->row()->image;
            } else {
                $imgName = 'no-image.jpg';
            }



            $msgprop='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gain Turnkey Property</title>
</head>
<body style="background:#FFFFFF; width:100%; margin:0; padding:0;">
<div style="width:50%; margin:0px; padding:0px;">
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left;" src="'.$_SERVER['DOCUMENT_ROOT'].'/images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100%!important; vertical-align:top; text-align:right;">'.$propAddress->row()->address.', '.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px; margin:0 0 0 0;">
    	<tr>
        	<td  height="30" align="center" style="float:left; text-align:center; color:#008904; width:100%;  font-family:Arial, Helvetica, sans-serif;  font-size:23px; font-weight:bold">Property Reservation Confirmation</td>
        </tr>
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:16px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">Congratulations! You have successfully placed this property under reserve for purchase. Our staff is working diligently on your closing documents and transfer packet. Please bring this hotsheet with you to your closing at the event.</td>
        </tr>
    </table>
    <table border="0" width="500" align="center" cellpadding="0" cellspacing="0" >
    
    	<tr style="margin:20px 0 20px;">
        
        	<td  width="200">
            	<img src="'.$_SERVER['DOCUMENT_ROOT'].'/images/product/'.$imgName.'" style="width:250px !important; height:190px;  " />
            </td>
            
            <td width="300">
            
            	<table cellpadding="0" cellspacing="0"  width="100%" align="left">
                
                	<tr style="margin:5px 0 15px 0px; line-height:26px;" >
                    	<td colspan="2" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property ID: '.$PropertyList->row()->rental_id.'</b></td>
                    </tr>
                    
                    
                   <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td colspan="2" style=" font-size:14px;  margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Property Address: '.$propAddress->row()->address.'<br>'.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</b></td>
                    </tr>
                    
                    
                    <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td width="60%" style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top"><b>Beds : '.$PropertyList->row()->bedrooms.'</b></td>
						<td width="35%" align="right" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left;" valign="top">
						<b style="margin:0 0 0 0px" height="30px">Baths : '.$PropertyList->row()->baths.'</b></td>
                    </tr>
                    
                    
                     <tr style="margin:5px 0 15px 0px; line-height:26px;">
                    	<td style=" font-size:14px; margin:10px 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"  valign="top">
						<b>Sq.Ft : '.$PropertyList->row()->sq_feet.'</b></td>
                        
						<td align="right" valign="top" width="30%" style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:left;"  >
                        
						<b style="margin:0 0 0 0px;color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:12px;" >Lot Size : '.$PropertyList->row()->lot_size.'</b> </td>
                        
                    </tr>
                    
                    
                    <tr style="margin:5px 0 15px 0px; line-height:28px;">
                    
                    	<td colspan="2" valign="top" style=" font-size:14px; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"> <b>Monthly Rental Amount : $'.number_format($PropertyList->row()->monthly_rent, 0).'</b></br> </td>
                        <br />

						
                    </tr>
                    
                    
					<tr style="margin:5px 0 15px 0px; line-height:28px;">
                    
					<td colspan="2" valign="top" style=" font-size:14px; width=100% !important; margin:0 0 15px 0px; color:#000000; font-family:Arial, Helvetica, sans-serif;"> <b>Estimated Annual Tax: $'.number_format($PropertyList->row()->property_tax, 0).' </b> </td>
					</tr>
                    
                </table>
                
            </td>
            
        </tr>
    </table>


    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">
    
    	<tr>
        
        	<td colspan="3"><h2 style="color:#008904;  font-size:23px; font-family:Arial, Helvetica, sans-serif; margin:15px 0 14px 0px;">Reservation Information</h2></td>
            
        </tr>
        
    	<tr>
        
            <td colspan="3"><span style="width:40%; display:inline-block; margin:0 0 14px; font-weight:bold; font-size:14px; font-family:Arial, Helvetica, sans-serif">Purchaser Name: '.ucfirst($PropertyList->row()->first_name).' '.ucfirst($PropertyList->row()->last_name).' </span></td>
            
           
           </tr>
           
           <tr>
           
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Name: '.$PropertyList->row()->entity_name.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Entity Type: '.$PropertyList->row()->resrv_type.'</span></td>
           
           </tr>
           
           <tr>
           
           	<td colspan="3"><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Address: '.$PropertyList->row()->address.'</span></td>
            
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">City: '.$PropertyList->row()->city.'</span></td>
            
            <td><span style=" display:inline-block; float:left; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">State: '.str_replace('-', ' ', $PropertyList->row()->state).'</span></td>
            
            <td><span style=" display:inline-block; float:left; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Zip: '.$PropertyList->row()->postal_code.'</span></td>
            
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone: '.$PropertyList->row()->phone_no.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0px 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Phone 2: '.$PropertyList->row()->phone_no1.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email1: '.$PropertyList->row()->email.'</span></td>
            
            <td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Email2: '.$PropertyList->row()->email1.'</span></td>
           
           </tr>
           
           
           <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sales Price: $'.number_format($PropertyList->row()->sales_price, 0).'</span></td>
            
            
           
          ';
            if ($PropertyList->row()->adjustment !='') {
                $msgprop .= '<td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Adjustment: $'.number_format($PropertyList->row()->adjustment, 0).'</span></td></tr>
           <tr>
           <td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Net Purchase Price: $'.number_format($PropertyList->row()->net_purchase_price, 0).'</span></td>
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $'.number_format($PropertyList->row()->reserv_price, 0).'</span></td>
            </tr>
           <tr>
            <td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</span></td>
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->sales_cash.' '.$PropertyList->row()->sales_cf.' '.$PropertyList->row()->sales_cs.' '.$PropertyList->row()->sales_fs.' '.$PropertyList->row()->sales_sdira.' '.$PropertyList->row()->sales_sl.' '.$PropertyList->row()->sales_sl_fs.'</span></td>
			</tr>';
            } else {
                $msgprop .= '
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Reservation Fee: $'.number_format($PropertyList->row()->reserv_price, 0).'</span></td>
            </tr>
           <tr>
            <td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">In form Of: '.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</span></td>
           	<td><span style="display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Sale Type: '.$PropertyList->row()->sales_cash.' '.$PropertyList->row()->sales_cf.' '.$PropertyList->row()->sales_cs.' '.$PropertyList->row()->sales_fs.' '.$PropertyList->row()->sales_sdira.' '.$PropertyList->row()->sales_sl.' '.$PropertyList->row()->sales_sl_fs.'</span></td>
			</tr>';
            }

            
            if ($PropertyList->row()->sales_sdira!='' || $PropertyList->row()->sales_sl!='' || $PropertyList->row()->sales_sl_fs!='') {
                $msgprop .= '<tr><td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 15px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Custodian name: '.$PropertyList->row()->cust_name.'</span></td></tr>';
            } else {
                $msgprop .= '<tr><td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">&nbsp;</span></td></tr>';
            }
            $msgprop .= '
            <tr>
           
           	<td><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Note: '.$PropertyList->row()->note.'</span></td>';
            
            if ($PropertyList->row()->sales_sdira!='' || $PropertyList->row()->sales_sl!='' || $PropertyList->row()->sales_sl_fs!='') {
                $msgprop .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">Account number: '.$PropertyList->row()->account_no.'</span></td>';
            } else {
                $msgprop .= '<td colspan="2"><span style=" display:inline-block; font-weight:bold; margin:0 0 14px;  font-size:14px; font-family:Arial, Helvetica, sans-serif">&nbsp;</span></td>';
            }
            $msgprop .= '</tr>
            
    </table>   
    
    <table border="0" width="550" cellpadding="0" cellspacing="0" style="max-width:550px;">
    	<tr>
        	<td colspan="3" style=" font-size:14px;  line-height:16px; margin-bottom:5px; text-align:left; font-family:Arial, Helvetica, sans-serif" width="550" >
            	This Property reservation Confirmation is your receipt of your commitment to purchase the above referenced property. Due to the nature of the investors summit, and the overwhelming intrest the students have in purchasing the properties brought to the event by our preferred vendors, your possession of this document is evidence that the property has been removed from our active database and is no longer available for sale to other students. Our staff will contact you during the final two days of the event to arrange the production and execution of the final document for closing. Please keep this information for reference prior to closing.
            </td>
        </tr>
        
        
        <tr style="background:#bebebe; height:27px; margin:35px 10px 10px 10px; width:100%;" >
        	<td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 10px;">'.$this->config->item('footer_content').'</td>
            <td width="25%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 50px;">All Rights Reserved</td>
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 10px 3px 3px;">Unauthorized Use or Duplication is Prohibited</td>
        </tr>
    </table> 
    
   </div>
   
   
<div style="width:50%; margin:0px; padding:0px;">
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;">
		
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left; " src="'.$_SERVER['DOCUMENT_ROOT'].'/images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100% !important; vertical-align:top; text-align:right;">INTENT to PURCHASE AGREEMENT</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px; margin:15px 0 10px 0;">
        <tr>
        	<td  height="50" style=" text-align:left; color:#333; width:100%; margin:10px 0 15px 15px;  font-size:14px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; overflow:hidden;">This letter sets forth some of the basic terms under which Seller and Purchaser would be interested in entering into a Real Estate Purchase Agreement.  It serves as a letter of intent (“Letter”) from '.$PropertyList->row()->entity_name.' ("Purchaser") through and dated '.date('m-d-Y', strtotime($PropertyList->row()->dateAdded)).', in which Purchaser has set forth its interest in acquiring the subject Property.  </td>
        </tr>
    </table>
    
    <table border="0" width="500" align="center" cellpadding="0" cellspacing="0" >
    
    	<tr style="margin:20px 0 20px;">
        
        	<td cellpadding="0" cellspacing="0" width="250" align="left">
            
            	<table>
                
                	<tr>
                    
                    	<td valign="top"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PROPERTY: </span></td>
                        
                        <td valign="middle">'.$propAddress->row()->address.'<br>'.ucwords($propAddress->row()->city).', '.ucwords(str_replace('-', ' ', $propAddress->row()->state)).' '.$propAddress->row()->post_code.'</td>
                    
                    </tr>
                   
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td><small style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#333;">(herinafter, the “Property”)</small></td>
                    
                    </tr>
                     <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td><small style="font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#333;">&nbsp;</small></td>
                    
                    </tr>
                     
                	
                
                </table>
            
            </td>
            
            <td cellpadding="0" cellspacing="0" width="250" align="left">
            
            	<table>
                
                	<tr>
                    
                    	<td><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PURCHASER: </span></td>
                        
                        <td>'.ucwords($PropertyList->row()->entity_name).'</td>
                    
                    </tr>
                    
                	<tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.ucwords($PropertyList->row()->first_name).' '.ucwords($PropertyList->row()->last_name).'</td>
                    
                    </tr>
                    
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.$PropertyList->row()->address.'</td>
                    
                    </tr>
                    
                    
                    <tr>
                    
                    	<td>&nbsp;</td>
                        
                        <td>'.$PropertyList->row()->city.', '.str_replace('-', ' ', $PropertyList->row()->state).' '.$PropertyList->row()->postal_code.'</td>
                    
                    </tr>
                
                
                </table>
            
            </td>
            
        </tr>
    </table>


    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">
    
    	<tr>
        
        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">PAYMENT METHOD: </strong>'.$PropertyList->row()->cash_payment.' '.$PropertyList->row()->check_payment.' '.$PropertyList->row()->credit_payment.' '.$PropertyList->row()->dot_payment.'</td>
            
        </tr>
        

        
        
         <tr>
        
        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASE PRICE: </strong>$'.number_format($PropertyList->row()->sales_price, 0).'</td>
            
        </tr></table>';
            if ($PropertyList->row()->adjustment !='') {
                $msgprop .= '<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;"><tr>
           	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">ADJUSTMENT: </strong>$'.number_format($PropertyList->row()->adjustment, 0).'</td>
           	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">NET PURCHASE PRICE: </strong>$'.number_format($PropertyList->row()->net_purchase_price, 0).'</td>
           </tr></table>';
            }
            $msgprop .= '
        <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px;">

        
        
        <tr>
        
        	<td style="line-height:35px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">RESERVATION FEE DEPOSIT: </strong>'.number_format($PropertyList->row()->reserv_price, 0).' dollars ($)</td>
            
        </tr>
        
        
        <tr>
        
        	<td><p style="font-weight:normal; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">(”Reservation Fee”) shall be held by seller in good faith. Seller will not cash or charge the reservation fee, unless the buyer cancels the transaction. If buyer cancels transaction, seller will cash or charge the reservation fee and retain the fee as lost opportunity cost. Otherwise, buyer will fund the property in full, including closing costs, and upon completion of transaction the reservation fee will be permanently disposed of and never be processed.</p></td>
            
        </tr>
      
        <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CONTRACT:</strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Upon the mutual execution of this Letter, Seller will promptly prepare a Purchase and Sale Agreement and Seller shall make a good faith effort to deliver said Purchase and Sale Agreement to Purchaser within seven (7) days from the effective date of the LOI. </span></td>
            
        </tr>
        
          <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CLOSING: </strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Closing shall occur on a date mutually acceptable to purchaser and to be outlined in the Purchase Agreement. </span></td>
            
          </tr>
          
          
          <tr>
        
        	<td><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#000000;">CONFIDENTIALITY:</strong><span style="font-size:10px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">Seller, Purchaser, and their agents shall maintain the confidentiality of the parties, terms, and conditions of this letter and the negotiations that may follow, if any, from this date forth.  The above items are the general business terms and conditions to be covered in the Purchase and Sale Agreement, which would be submitted to the Seller.  Additional remaining terms of the Purchase and Sale Agreement will be negotiated and must be acceptable to both Purchaser and Seller.</span></td>
            
          </tr>
          
           <!--<tr>
        
        	<td style="text-align:center;"><span style="font-size:10px; width:100%; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; line-height:20px;">This letter is not intended to be a binding contract.</span></td>
            
           </tr>-->
           
           
           
           <tr>
        
        	<td><span style="font-size:11px; color:#000; font-family:Arial, Helvetica, sans-serif; font-weight:normal; line-height:20px;">Buyer hereby agrees to the terms and conditions of the letter.</span></td>
            
           </tr>
           
           
           <tr>
        
        		<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td width="45%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name: </strong>'.$PropertyList->row()->first_name.' '.$PropertyList->row()->last_name.'</td>
                            
                            
                            <td width="45%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Name: </strong></td>
                        
                        </tr>
                        
                       <tr>
                        
                        	<td valign="bottom" style="vertical-align:bottom; line-height:20px; "><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Signature:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                        
                       <tr>
                        
                        	<td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            
                            <td style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Date:</strong><span style="font-size:13px; color:#F00; width:71%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:38px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                    
                    
                    </table>
                
                
                </td>
            
           </tr>
           
            
            <tr>
        
        		<td style="line-height:25px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
            
        	</tr>
            
            
            
             <tr>
        
        		<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td width="25%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Address: </strong>'.$PropertyList->row()->address.'</td>
                            
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">City: </strong>'.$PropertyList->row()->city.'</td>
                            
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">State: </strong>'.str_replace('-', ' ', $PropertyList->row()->state).'</td>
                            
                            <td width="20%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Zip Code: </strong>'.$PropertyList->row()->postal_code.'</td>
                        
                        
                        </tr>
                        
                        
                        <tr>
                        
                        	<td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Phone Number: </strong>'.$PropertyList->row()->phone_no.'</td>
                            
                            <td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Phone Number: </strong>'.$PropertyList->row()->phone_no1.'</td>
                        
                        </tr>
                        
                        <tr>
                        
                        	<td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Email: </strong>'.$PropertyList->row()->email.'</td>
                            
                            <td colspan="2" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Email: </strong>'.$PropertyList->row()->email1.'</td>
                        
                        </tr>
                    </table>
                
                </td>
        
        	</tr>

            
            <tr>
        
        		<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">PURCHASER INFORMATION</strong></td>
                            
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Cash</strong></td>
                            
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Check</strong></td>
                            
                            <td><span style="border:1px solid #000; display:inline-block; width:15px; height:15px;">&nbsp;</span><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000; padding:0px 8px;">Credit Card</strong></td>
                        
                        
                        </tr>
                    
                    
                    </table>
                
                
                </td>
            
        	</tr>
            
        
        	   <tr>
        
        		<td style="line-height:30px;"><strong style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000;">CREDIT CARD AUTHORIZATION</strong></td>
            
        	</tr>
            
            
             <tr>
            
            	<td>
                
                	<table width="100%">
                    
                    	<tr>
                        
                        	<td width="40%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; width:40%">Name on Card:</strong><span style="font-size:13px; color:#F00; width:52%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:65px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            <td width="27%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Card Type:</strong><span style="font-size:13px; color:#F00; width:58%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                             <td width="33%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Amount: $</strong><span style="font-size:13px; color:#F00; width:58%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                        
                        
                        <tr>
                        
                        	<td width="48%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; width:40%">Card Number:</strong><span style="font-size:13px; color:#F00; width:53%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:70px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                            <td width="27%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Exp. Date:</strong><span style="font-size:13px; color:#F00; width:60%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                            
                             <td width="21%" style="line-height:20px;"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">Verification Code:</strong><span style="font-size:13px; color:#F00; width:39%; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        </tr>
                        
                        
                    </table>
                
               </td>
            
            
            </tr>
        
        
         <tr>
         
         	<td>
            
            	<table width="100%">
                
                	<tr>
                    
                   	  <td width="50%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Authorized Signature:</strong><span style="font-size:13px; color:#F00; width:170px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:10px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                        
                        <td width="60%">
                        
                        	<table width="100%">
                            
                            	<tr>
                                
                                	<td width="26%"><strong style="font-weight:normal; font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000000;">Today’s Date: </strong></td>
                                    
                                    <td width="17%"><span style="font-size:13px; color:#F00; width:62px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:0px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span><span style="font-size:13px; display:inline-block;  font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">/</span></td>
                                    
                                    <td width="20%"><span style="font-size:13px; color:#F00; width:75px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:0px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span><span style="font-size:13px; display:inline-block;  font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">/</span></td>
                                    
                                    <td width="34%"><span style="font-size:13px; color:#F00; width:110px; display:inline-block; border-bottom:1px solid #000; vertical-align:bottom; margin-left:0px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; position:relative; top:15px;">&nbsp;</span></td>
                                
                                
                                </tr>
                            
                            </table>
                        
                        
                        </td>
                    
                    </tr>
                
                
                
                </table>
            
            
            </td>
         
         </tr>
            
    </table>  
    </div>';
    
            if ($CompDets->num_rows() > 0) {
                $msgprop .= '
	 <div style="width:50%; margin:0px; padding:0px;">
	<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;">
        <tr style="background:#c4c4c4; height:85px; width:50%;">
        	<td width="10%;"><img style="float:left; " src="'.$_SERVER['DOCUMENT_ROOT'].'/images/logo/'.$this->config->item('logo_image').'" alt="'.$this->config->item('meta_title').'" />
			</td>
			<td  width="13%;" style="vertical-align:top; text-align:right;">
			<span style="float:right;  margin:0px 0 0 0px !important; font-family:Arial, Helvetica, sans-serif;  font-size:16px; font-weight:bold; width:100% !important; vertical-align:top; text-align:right;">Comps</span>
			</td>
        </tr>
    </table>		
    <table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width:550px; margin:15px 0 10px 0;">

<tr style="line-height:26px;">
	<td width="30%"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">Property Address</span></td>
    <td width="15%" align="center"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">Purchase Price</span></td>
    <td width="12%" align="center"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">Date Sold</span></td>
    <td width="15%" align="center"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">Type of Deal</span></td>
    <td width="12%" align="center"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">No of Beds</span></td>
    <td width="11%" align="center"><span style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">No of Baths</span></td>
</tr>';
                foreach ($CompDets->result() as $compDets) {
                    $msgprop .= '
<tr style="line-height:26px;">
		<td><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->comp_prop_address.'</span></td>
		<td align="center"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->comp_purchase_price.'</span></td>
        <td align="center"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->comp_date_sold.'</span></td>
        <td align="center"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->comp_type_deal.'</span></td>
        <td align="center"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->no_of_beds.'</span></td>
        <td align="center"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000000;">'.$compDets->no_of_baths.'</span></td>
</tr>';
                }
                $msgprop .= '</table>  
 <table border="0" width="550" cellpadding="0" cellspacing="0" style="max-width:550px;">
		 <tr style="background:#bebebe; height:27px; margin:35px 10px 10px 10px; width:100%;" >
        	<td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 10px;">'.$this->config->item('footer_content').'</td>
            <td width="25%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 0px 3px 3px;">All Rights Reserved</td>
            <td width="35%" style="text-align:left;  color:#000;  font-size:11px; margin:6px 0 0px; font-family:Arial, Helvetica, sans-serif; padding:3px 10px 3px 3px;">Unauthorized Use or Duplication is Prohibited</td>
        </tr>
		</table> 
         </div>
         </div>
        ';
            }

            $msgprop .= '
</body>
</html>';
            $this->data['ViewList'] = $msgprop;
            $this->data['propertyAddres'] = url_title($PropertyList->row()->prop_address, '-', true);
            
        
            
            
            $this->load->view('site/product/view_orders', $this->data);
        }
    }
}
