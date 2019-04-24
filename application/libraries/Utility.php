
<?php

class Utility
{
    
    /*
     * REFERENCE BY :
     * http://stackoverflow.com/questions/27633584/php-fatal-error-call-to-undefined-function-mcrypt-get-iv-size-in-appserv
     */
    public $skey = "SHAREMYPET_PRODUCT-CRTD16092016\0";
                    
    function encodeText($value, $removeTags = false)
    {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $val = $removeTags ? strip_tags($v) : $v;
                $val = addslashes($val);
                $value [$k] = $val;
            }
        }
        else {
            $value = $removeTags ? strip_tags($value) : $value;
            $value = addslashes($value);
        }
        return $value;
    }

    function decodeText($value, $htmlEntity = true)
    {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $val = stripslashes($v);
                $value [$k] = $htmlEntity ? htmlentities($val) : $val;
            }
        }
        elseif (is_object($value)) {
            foreach ($value as $k => $v) {
                $val = stripslashes($v);
                $value->$k = $htmlEntity ? htmlentities($val) : $val;
            }
        }
        else {
            $value = stripslashes($value);
            $value = $htmlEntity ? htmlentities($value) : $value;
        }
        return $value;
    }

    public function safe_b64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array(
            '+',
            '/',
            '='
        ), array(
            '-',
            '_',
            ''
        ), $data);
        return $data;
    }

    public function safe_b64decode($string)
    {
        $data = str_replace(array(
            '-',
            '_'
        ), array(
            '+',
            '/'
        ), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public function encode($value)
    {
        if (! $value) {
            return false;
        }
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext));
    }

    public function decode($value)
    {
        if (! $value) {
            return false;
        }
        $crypttext = $this->safe_b64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return (trim($decrypttext));
    }

    public function setFlashMessage($type, $message)
    {
        $CI = & get_instance();
        $template = '<div class="alert alert-' . $type . ' alert-dismissible text-center" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						   <span aria-hidden="true">&times;</span>
							</button>' . $message . '</div>';
        
        $CI->session->set_flashdata("myMessage", $template);
    }

    public function sendMailSMTP($data)
    {
        $CI = & get_instance();
        
        $config ['protocol'] = "smtp";
        $config ['smtp_host'] = SMTP_HOST;
        $config ['smtp_port'] = SMTP_PORT;
        $config ['smtp_user'] = SMTP_USER;
        $config ['smtp_pass'] = SMTP_PASS;
        
        $config ['smtp_timeout'] = 20;
        $config ['priority'] = 1;
        $config ['charset'] = 'utf-8';
        $config ['wordwrap'] = TRUE;
        $config ['crlf'] = "\r\n";
        $config ['newline'] = "\r\n";
        $config ['mailtype'] = "html";
        $config ['starttls']  = true;
                
        $message = $data ["message"];
        $CI->load->library('email', $config);
        $CI->email->initialize($config);
        $CI->email->clear(TRUE);
        $CI->email->to($data ["to"]);
        if(isset($data ['from'])){
            $CI->email->from($data ['from'],$data ['from_title']);
        }else{
            $CI->email->from($config ['smtp_user'], PROJECT_NAME);
        }
        if (isset($data ["bcc"])) {
            $CI->email->bcc($data ["bcc"]);
        }
        if(isset($data ["replyto"])){
            $CI->email->reply_to(REPLAY_EMAIL, $data ['from_title']);
        }
        $CI->email->subject($data ["subject"]);
        $CI->email->message($message);
       
        $response = $CI->email->send();
        return true;
        
        
//        $config['useragent'] = 'CodeIgniter';
//        $config['protocol'] = 'smtp';
//        $config['mailpath'] = '/usr/sbin/sendmail -bs';
//        $config['smtp_host'] = 'smtp.gmail.com';
//        $config['smtp_user'] = 'kartikdesai123@gmail.com';
//        $config['smtp_pass'] = 'Kartik@$23061990';
//        $config['smtp_port'] = 587; 
//        $config['smtp_timeout'] = 50;
//        $config['wordwrap'] = TRUE;
//        $config['wrapchars'] = 76;
//        $config['mailtype'] = 'html';
//        $config['charset'] = 'utf-8';
//        $config['smtp_crypto'] = 'tls';
//        $config['validate'] = FALSE;
//        $config['priority'] = 3;
//        $config['crlf'] = "\r\n";
//        $config['newline'] = "\r\n";
//        $config['bcc_batch_mode'] = FALSE;
//        $config['bcc_batch_size'] = 200;
//
//        $CI = & get_instance();
//        $message = $data ["message"];
//        $CI->load->library('email', $config);
//        $CI->email->initialize($config);
//        $CI->email->clear();
//        $CI->email->from($config ['smtp_user'], PROJECT_NAME);
//        $CI->email->to($data ["to"]);
//        if (isset($data ["bcc"])) {
//            $CI->email->bcc($data ["bcc"]);
//        }
//        $CI->email->reply_to($config ['smtp_user'], '<kartikdesai123@gmail.com>');
//        $CI->email->subject($data ["subject"]);
//        $CI->email->message($message);
//        $response = $CI->email->send();
//        if($response){
//            echo 's';
//        }else{
//            echo 'faul';
//        }
//        echo $CI->email->print_debugger();exit;
//        if (!$CI->email->send()) {
//           echo $errors = $CI->email->print_debugger();exit;
//            return false;
//        } else {
//            return true;
//        }
//        return TRUE;
    }
      
    /**
     * fbShareButton()
     * This function is used to facebook share button
     *
     * Developer - Pravin Dabhi
     * Datetime - 7-11-2016 03:44
     *
     * @param : $content: String content to share
     * @return : Google plus share button
     */
    public function fbShareButton($image = null, $title = null, $description = null, $url = null)
    {
        $description = urldecode($description);
        $description = str_replace([
            "</br>",
            "<br/>",
            "</p>"
        ], [
            "\r\n",
            "\r\n",
            "</p>\r\n"
        ], $description);
        $description = strip_tags($description);
        $description = urlencode($description);
        ?>
<a
	href="https://www.facebook.com/sharer/sharer.php?u=<?=$url?>&title=<?php echo trim($title); ?>
        		<?php if($image != ""){?>&picture=<?php echo $image; ?> <?php } ?>&description=<?php echo $description; ?>"
	onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
	target="_blank" title="Share on Facebook"><img
	src="<?php echo EXTERNAL_PATH ?>images/fb_share_s.png" /> </a>

<?php
    }

   
    
    
}

?>
