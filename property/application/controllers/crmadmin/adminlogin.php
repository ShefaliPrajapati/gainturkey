<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to admin management and login, forgot password
 * @author Teamtweaks
 *
 */

class Adminlogin extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('admin_model');
    }
    
    /**
     * 
     * This function check the admin login session and load the templates
     * If session exists then load the dashboard
     * Otherwise load the login form
     */
   	public function index(){
		$this->data['heading'] = 'Dashboard';
		/*if ($this->checkLogin('CA') == ''){
			$this->check_admin_session();
		}*/
		if ($this->checkLogin('CA') == ''){
			$this->load->view('crmadmin/templates/login.php',$this->data);
		}else {
			
			/*//echo $this->uri->segment(2,0);
			//if($this->uri->segment(2,0) !=0 ){
				//$this->check_set_sidebar_session($this->uri->segment(2,0));
			//}
			//$this->load->view('crmadmin/templates/header.php',$this->data);
			//$this->load->view('crmadmin/adminsettings/dashboard.php',$this->data);
			//$this->load->view('crmadmin/templates/footer.php',$this->data);*/
			redirect('crmadmin/dashboard');
		}
	}
	
	/**
	 * 
	 * This function validate the admin login form
	 * If details are correct then load the dashboard
	 * Otherwise load the login form and show the error message
	 */
	public function admin_login(){
		clearstatcache();
		$admindata = array(
						'ror_crm_session_admin_id' => '',
						'ror_crm_session_admin_name' => '',
						'ror_crm_session_admin_email' => '',
						'ror_crm_session_admin_mode' => '',
						'ror_crm_session_admin_privileges' => '',
						'ror_crm_session_admin_type' => ''
					);
							
		$this->session->unset_userdata($admindata);
		$this->form_validation->set_rules('admin_name', 'Username', 'required');
		$this->form_validation->set_rules('admin_password', 'Password', 'required');
		if ($this->form_validation->run() === FALSE)
		{	
			$this->setErrorMessage('error','Invalid Login Details');
			redirect('deals_crm');
		}else {
			
			$name = $this->input->post('admin_name');
			$pwd = md5($this->input->post('admin_password'));
			
			$mode = SUBADMIN;
			if ($name == $this->config->item('admin_name')){
				$mode = ADMIN;
			}
			
			$condition = array('admin_name' => $name, 'admin_password' => $pwd, 'is_verified' => 'Yes', 'status' => 'Active');
			$query = $this->admin_model->get_all_details($mode,$condition);
			//echo '<pre>'; print_r($query->result_array()); die;
			if ($query->num_rows() > 0){
				
				$priv = unserialize($query->row()->crm_privileges);
				$_SESSION['crm']=$priv;
				$admindata = array(
								'ror_crm_session_admin_id' => trim($query->row()->id),
								'ror_crm_session_admin_name' => trim($query->row()->admin_name),
								'ror_crm_session_admin_email' => trim($query->row()->email),
								'ror_crm_session_admin_mode' => trim($mode),
								'ror_crm_session_admin_privileges' =>trim($priv),
								'ror_crm_session_admin_type' => trim($query->row()->login_type)
							);
				//echo '<pre>';print_r($admindata);die;

				$this->session->set_userdata($admindata);
				
				//print_r($this->session->userdata('ror_crm_session_admin_id'));die;
				
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$_SESSION['last_login_date']= mdate($datestring,$time);
				$newdata = array(
	               'last_login_date' => mdate($datestring,$time),
	               'last_login_ip' => $this->input->ip_address()
	            );
	            $condition = array('id' => $query->row()->id);
				$this->admin_model->update_details($mode,$newdata,$condition);
				
				
				//echo '<pre>'; print_r($_SERVER);
				//echo '<pre>'; print_r($_SESSION); 		
				
				/*if ($this->input->post('remember') != ''){
					$adminid = $this->encrypt->encode($query->row()->id);
					$cookie = array(
					    'name'   => 'ror_crm_admin_session',
					    'value'  => $adminid,
					    'expire' => 86400,
					    'secure' => FALSE
					);
					
					$this->input->set_cookie($cookie); 
				}*/
				
				$this->setErrorMessage('success','Login Success');
					//echo '<pre>'; print_r($this->session->all_userdata()); die;
					
				redirect('crmadmin/dashboard');
				//redirect('crmadmin/product/display_product_list/all');
			}else {
				$this->setErrorMessage('error','Invalid Login Details');
				redirect('deals_crm');
			}
			
		}
	}
	
	/**
	 * 
	 * This function remove all admin details from session and cookie and load the login form
	 */
	public function admin_logout(){
		
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time();
		$newdata = array(
               'last_logout_date' => mdate($datestring,$time)
            );
		$mode = SUBADMIN;
		if ($this->session->userdata('ror_crm_session_admin_name') == $this->config->item('admin_name')){
			$mode = ADMIN;
		}
        $condition = array('id' => $this->checkLogin('CA'));
		$this->admin_model->update_details($mode,$newdata,$condition);
		$admindata = array(
						'ror_crm_session_admin_id' => '',
						'ror_crm_session_admin_name' => '',
						'ror_crm_session_admin_email' => '',
						'ror_crm_session_admin_mode' => '',
						'ror_crm_session_admin_privileges' => '',
						'ror_crm_session_admin_type' => ''
					);
		$this->session->unset_userdata($admindata);
		/*$cookie = array(
		    'name'   => 'ror_crm_admin_session',
		    'value'  => '',
		    'expire' => -86400,
		    'secure' => FALSE
		);
		
		$this->input->set_cookie($cookie);*/
		 $this->session->session_destroy();
		clearstatcache();
		$this->setErrorMessage('success','Successfully logout from your account');
		redirect('deals_crm');
	}
	
	/**
	 * 
	 * This function loads the forgot password form
	 */
	public function admin_forgot_password_form()
	{
		if ($this->checkLogin('CA') == ''){
			$this->load->view('crmadmin/templates/forgot_password.php',$this->data);
		}else {
			$this->load->view('crmadmin/templates/header.php',$this->data);
			$this->load->view('crmadmin/adminsettings/dashboard.php',$this->data);
			$this->load->view('crmadmin/templates/footer.php',$this->data);
		}
	}
	
	/**
	 * 
	 * This function validate the forgot password form
	 * If email is correct then generate new password and send it to the email given
	 */
	public function admin_forgot_password(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('crmadmin/templates/forgot_password.php',$this->data);
		}else {
			$email = $this->input->post('email');
			$mode = SUBADMIN;
			if ($email == $this->config->item('email')){
				$mode = ADMIN;
			}
			$condition = array('email' => $email);
			$query = $this->admin_model->get_all_details($mode,$condition);
			if ($query->num_rows() == 1){
				$new_pwd = $this->get_rand_str('6');
				$newdata = array('admin_password' => md5($new_pwd));
				$condition = array('email' => $email);
				$this->admin_model->update_details($mode,$newdata,$condition);
				$this->send_admin_pwd($new_pwd,$query);
				$this->setErrorMessage('success','New password sent to your mail');
			}else {
				$this->setErrorMessage('error','Email id not matched in our records');
				redirect('crmadmin/adminlogin/admin_forgot_password_form');
			}
			redirect('deals_crm');
		}
	}
	
	/**
	 * 
	 * This function check the admin details in browser cookie
	 */
	public function check_admin_session(){
		$admin_session = $this->input->cookie('ror_crm_admin_session',FALSE);
		if ($admin_session != ''){
			$admin_id = $this->encrypt->decode($admin_session);
			$mode = $admin_session['ror_crm_session_admin_mode'];
			$condition = array('id' => $admin_id);
			$query = $this->admin_model->get_all_details($mode,$condition);
			if ($query->num_rows() == 1){
				$priv = unserialize($query->row()->crm_privileges);
				$admindata = array(
								'ror_crm_session_admin_id' => $query->row()->id,
								'ror_crm_session_admin_name' => $query->row()->admin_name,
								'ror_crm_session_admin_email' => $query->row()->email,
								'ror_crm_session_admin_mode' => $mode,
								'ror_crm_session_admin_privileges' => $priv
							);
				$this->session->set_userdata($admindata);
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$newdata = array(
	               'last_login_date' => mdate($datestring,$time),
	               'last_login_ip' => $this->input->ip_address()
	            );
				$condition = array('id' => $query->row()->id);
				$this->admin_model->update_details(ADMIN,$newdata,$condition);
				$adminid = $this->encrypt->encode($query->row()->id);
				/*$cookie = array(
				    'name'   => 'ror_crm_admin_session',
				    'value'  => $adminid,
				    'expire' => 86400,
				    'secure' => FALSE
				);
				
				$this->input->set_cookie($cookie); */
			}
		}
	}
	
	/**
	 * 
	 * This function send the new password to admin email
	 */
	public function send_admin_pwd($pwd='',$query){
		$newsid='4';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title')	.' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title>
			<body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->config->item('site_contact_mail');
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}
		
		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$query->row()->email,
							'subject_message'=>'Password Reset',
							'body_messages'=>$message
							);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
		
/*		echo $this->email->print_debugger();die;
*/	
	}
	
	/**
	 * 
	 * This function loads the change password form
	 */
	public function change_admin_password_form()
	{	
		$this->data['heading'] = 'Change Password';
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			$this->load->view('crmadmin/templates/header.php',$this->data);
			$this->load->view('crmadmin/adminsettings/changepassword.php',$this->data);
			$this->load->view('crmadmin/templates/footer.php',$this->data);
		}
	}
	
	/**
	 * 
	 * This function validate the change password form
	 * If details are correct then change the admin password
	 */
	public function change_admin_password(){
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('new_password', 'New Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Retype Password', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('crmadmin/templates/header.php',$this->data);
			$this->load->view('crmadmin/adminsettings/changepassword.php',$this->data);
			$this->load->view('crmadmin/templates/footer.php',$this->data);
		}else {
			$name = $this->session->userdata('ror_crm_session_admin_name');
			$pwd = md5($this->input->post('password'));
			$mode = SUBADMIN;
			if ($name == $this->config->item('admin_name')){
				$mode = ADMIN;
			}
			$condition = array('admin_name' => $name, 'admin_password' => $pwd, 'is_verified' => 'Yes', 'status' => 'Active');
			$query = $this->admin_model->get_all_details($mode,$condition);
			if ($query->num_rows() == 1){
				$new_pwd = $this->input->post('new_password');
				$newdata = array('admin_password' => md5($new_pwd));
				$condition = array('admin_name' => $name);
				$this->admin_model->update_details($mode,$newdata,$condition);
				$this->setErrorMessage('success','Password changed successfully');
			}else {
				$this->setErrorMessage('error','Invalid current password');
			}
			redirect('crmadmin/adminlogin/change_admin_password_form');
		}
	}
	
	/**
	 * 
	 * This function loads the admin users list
	 */
	public function display_admin_list(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			if ($this->checkPrivileges('admin','0') == TRUE){
				$this->data['heading'] = 'Admin Users List';
				$condition = array();
				$this->data['admin_users'] = $this->admin_model->get_all_details(ADMIN,$condition);
				$this->load->view('crmadmin/adminsettings/display_admin',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function change the admin user status
	 */
	public function change_admin_status(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			if ($this->checkPrivileges('admin','2') == TRUE){
				$mode = $this->uri->segment(4,0);
				$adminid = $this->uri->segment(5,0);
				$status = ($mode == '0')?'Inactive':'Active';
				$newdata = array('status' => $status);
				$condition = array('id' => $adminid);
				$this->admin_model->update_details(ADMIN,$newdata,$condition);
				$this->setErrorMessage('success','Admin User Status Changed Successfully');
				redirect('crmadmin/adminlogin/display_admin_list');
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function loads the admin settings form
	 */
	public function admin_global_settings_form(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			if ($this->checkPrivileges('admin','2') == TRUE){
				$this->data['heading'] = 'Admin Settings';
				$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
				$this->load->view('crmadmin/adminsettings/edit_admin_settings',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function validates the admin settings form
	 */
	public function admin_global_settings(){
		if (strpos(base_url(),'pleasureriver.com') === false){
			$form_mode = $this->input->post('form_mode');
			if ($form_mode == 'main_settings'){
				$datestring = "%Y-%m-%d";
				$time = time();
				$dataArr = array('modified'=>mdate($datestring,$time));
				$admin_name = $this->input->post('admin_name');
				$email = $this->input->post('email');
				$condition = array('admin_name' => $admin_name,'id !=' => '1');
				$duplicate_admin= $this->admin_model->get_all_details(ADMIN,$condition);
				if ($duplicate_admin->num_rows() > 0){
					$this->setErrorMessage('error','Admin name already exists');
					redirect('crmadmin/adminlogin/admin_global_settings_form');
				}else {
					$condition = array('admin_name' => $admin_name);
					$duplicate_sub_admin = $this->admin_model->get_all_details(SUBADMIN,$condition);
					if ($duplicate_sub_admin->num_rows() > 0){
						$this->setErrorMessage('error','Sub Admin name exists');
						redirect('crmadmin/adminlogin/admin_global_settings_form');
					}else {
						$condition = array('email' => $email,'id !=' => '1');
						$duplicate_admin_mail = $this->admin_model->get_all_details(ADMIN,$condition);
						if ($duplicate_admin_mail->num_rows() > 0){
							$this->setErrorMessage('error','Admin email already exists');
							redirect('crmadmin/adminlogin/admin_global_settings_form');
						}else {
							$condition = array('email' => $email);
							$duplicate_mail = $this->admin_model->get_all_details(SUBADMIN,$condition);
							if ($duplicate_mail->num_rows() > 0){
								$this->setErrorMessage('error','Sub Admin email exists');
								redirect('crmadmin/adminlogin/admin_global_settings_form');
							}
						}
					}
				}
				$condition = array('id'=>'1');
				$excludeArr = array('form_mode','logo_image','fevicon_image','site_contact_mail','site_contact_number','email_title','footer_content','booking_code','like_text','liked_text','unlike_text');
				$this->admin_model->commonInsertUpdate(ADMIN,'update',$excludeArr,$dataArr,$condition);
				$dataArr = array();
	//			$config['encrypt_name'] = TRUE;
				$config['overwrite'] = FALSE;
		    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
			    $config['max_size'] = 2000;
			    $config['upload_path'] = './images/logo';
			    $this->load->library('upload', $config);
				if ( $this->upload->do_upload('logo_image')){
			    	$logoDetails = $this->upload->data();
			    	$dataArr['logo_image'] = $logoDetails['file_name'];
				}
				if ( $this->upload->do_upload('fevicon_image')){
					$feviconDetails = $this->upload->data();
			    	$dataArr['fevicon_image'] = $feviconDetails['file_name'];
				}
				$excludeArr = array('form_mode','logo_image','fevicon_image','email','admin_name');
				$this->admin_model->commonInsertUpdate(ADMIN_SETTINGS,'update',$excludeArr,$dataArr,$condition);
				$this->admin_model->saveAdminSettings();
				$this->session->set_userdata('ror_crm_session_admin_name',$admin_name);
				$this->setErrorMessage('success','Admin details updated successfully');
				redirect('crmadmin/adminlogin/admin_global_settings_form');
			}else {
				$dataArr = array();
				$condition = array('id'=>'1');
				$excludeArr = array('form_mode');
				$this->admin_model->commonInsertUpdate(ADMIN_SETTINGS,'update',$excludeArr,$dataArr,$condition);
				$this->admin_model->saveAdminSettings();
				$this->setErrorMessage('success','Admin details updated successfully');
				redirect('crmadmin/adminlogin/admin_global_settings_form');
			}
		}else {
			$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
			redirect('crmadmin/adminlogin/admin_global_settings_form');
		}
	}
	
	
	/**
	 * 
	 * This function set the Sidebar Hide show 
	 */
	public function check_set_sidebar_session($id){
			$admindata = array('session_sidebar_id' => $id );
			$this->session->set_userdata($admindata);
	}
	
	/**
	 * 
	 * This function loads the smtp settings form
	 */
	public function admin_smtp_settings(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			if ($this->checkPrivileges('admin','2') == TRUE){
				$this->data['heading'] = 'SMTP Settings';
				$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
				$this->load->view('crmadmin/adminsettings/smtp_settings',$this->data);
			}else {
				redirect('deals_crm');
			}
		}
	}
	
	/**
	 * 
	 * This function save the smtp settings 
	 */
	public function save_smtp_settings(){
		if ($this->checkLogin('CA') == ''){
			redirect('deals_crm');
		}else {
			if (strpos(base_url(),'pleasureriver.com') === false){
				if ($this->checkPrivileges('admin','2') == TRUE){
				
				$smtp_settings_val = $this->input->post();
				$config = '<?php ';
				foreach($smtp_settings_val as $key => $val){
					$value = addslashes($val);
					$config .= "\n\$config['$key'] = '$value'; ";
				}
				$config .= "\n ?>";
				$file = 'fc_smtp_settings.php';
				file_put_contents($file, $config);
				$this->setErrorMessage('success','SMTP settings updated successfully');
				redirect('crmadmin/adminlogin/admin_smtp_settings');
				
				}else {
					redirect('deals_crm');
				}
			}else {
				$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
				redirect('crmadmin/adminlogin/admin_smtp_settings');
			}
		}
	}
	
	function downloadPopupUploadImage()
	{
		$imageUrl = $this->uri->segment(4); 
		$data = file_get_contents("images/crm-popup-images/".$imageUrl); // Read the file's contents
		$name = uniqid().$imageUrl;
		$this->load->helper('download');
		force_download($name, $data);
	}
	
	
	
}

/* End of file adminlogin.php */
/* Location: ./application/controllers/crmadmin/adminlogin.php */