<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 *
 * This model contains all common db related functions
 * @author Teamtweaks
 *
 */
class My_Model extends CI_Model
{

    /**
     *
     * This function connect the database and load the functions from CI_Model
     */
    public function __construct()
    {
        parent::__construct();

        /* Multilanguage start */
        if ($this->uri->segment('1') != 'admin') {
            $selectedLanguage = $this->session->userdata('language_code');
            $defaultLanguage = 'en';
            $filePath = APPPATH . "language/" . $selectedLanguage . "/" . $selectedLanguage . "_lang.php";
            if ($selectedLanguage != '') {
                if (!(is_file($filePath))) {
                    $this->lang->load($defaultLanguage, $defaultLanguage);
                } else {
                    $this->lang->load($selectedLanguage, $selectedLanguage);
                }
            } else {
                $this->lang->load($defaultLanguage, $defaultLanguage);
            }
        }
        /* Multilanguage end */
    }

    /**
     *
     * This function returns the table contents based on data
     * @param String $table	->	Table name
     * @param Array $condition	->	Conditions
     * @param Array $sortArr	->	Sorting details
     *
     * return Array
     */
    public function get_all_details($table = '', $condition = '', $sortArr = '')
    {
        if ($sortArr != '' && is_array($sortArr)) {
            foreach ($sortArr as $sortRow) {
                if (is_array($sortRow)) {
                    $this->db->order_by($sortRow['field'], $sortRow['type']);
                }
            }
        }
        return $this->db->get_where($table, $condition);
    }

    public function reserved_details()
    {
        $this->db->select('id, property_status, reserved_time');
        $this->db->where('property_status', 'Reserved');
        $this->db->from(PRODUCT);
        $result = $this->db->get();
        return $result;
    }

    public function get_all_details_product($table = '', $condition = '', $sortArr = '')
    {
        if ($sortArr != '' && is_array($sortArr)) {
            foreach ($sortArr as $sortRow) {
                //echo "<pre>";print_r($sortArr);die;
                if (is_array($sortArr)) {
                    $this->db->order_by($sortArr['field'], $sortArr['type']);
                }
            }
        }
        return $this->db->get_where($table, $condition);
    }

    /**
     *
     * This function update the table contents based on params
     * @param String $table		->	Table name
     * @param Array $data		->	New data
     * @param Array $condition	->	Conditions
     */
    public function update_details($table = '', $data = '', $condition = '')
    {
        $this->db->where($condition);
        $this->db->update($table, $data);
        //echo $this->db->last_query(); die;
        //	return $result =$query->result_array();
        //echo "<pre>";print_r($result);die;
    }

    /**
     *
     * Simple function for inserting data into a table
     * @param String $table
     * @param Array $data
     * @return
     */
    public function simple_insert($table = '', $data = '')
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function simple_copy($tableone = '', $tabletwo = '', $condition = '')
    {
        $select_qry = "INSERT INTO " . $tableone . " SELECT * FROM " . $tabletwo . " WHERE " . $condition;
        $query = $this->ExecuteQuery($select_qry);
        return $query;
    }

    /**
     *
     * This function do all insert and edit operations
     * @param String $table		->	Table name
     * @param String $mode		->	insert, update
     * @param Array $excludeArr
     * @param Array $dataArr
     * @param Array $condition
     */
    public function commonInsertUpdate($table = '', $mode = '', $excludeArr = '', $dataArr = '', $condition = '')
    {
        $inputArr = array();
        foreach ($this->input->post() as $key => $val) {
            if (!in_array($key, $excludeArr)) {
                $inputArr[$key] = $val;
            }
        }
        $finalArr = array_merge($inputArr, $dataArr);
        if ($mode == 'insert') {
            return $this->db->insert($table, $finalArr);
        } elseif ($mode == 'update') {
            $this->db->where($condition);

            return $this->db->update($table, $finalArr);

            // echo $this->db->last_query();
            //	return $result =$query->result_array();
            //	echo "<pre>";print_r($result);die; print_r($excludeArr); die;
        }
    }

    public function commonInsertUpdate1($table = '', $mode = '', $excludeArr = '', $dataArr = '', $condition = '')
    {
        if ($this->input->post('password') == '') {
            $inputArr = array('first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone_no' => $this->input->post('phone_no'),
                'about' => $this->input->post('about')
            );
        } else {
            $inputArr = array('first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'password' => md5($this->input->post('password')),
                'email' => $this->input->post('email'),
                'phone_no' => $this->input->post('phone_no'),
                'about' => $this->input->post('about')
            );
        }

        $finalArr = array_merge($inputArr, $dataArr);
        if ($mode == 'insert') {
            return $this->db->insert($table, $finalArr);
        } elseif ($mode == 'update') {
            $this->db->where($condition);
            return $this->db->update($table, $finalArr);
        }
    }

    /**
     *
     * For getting last insert id
     */
    public function get_last_insert_id()
    {
        return $this->db->insert_id();
    }

    /**
     *
     * This function do the delete operation
     * @param String $table
     * @param Array $condition
     */
    public function commonDelete($table = '', $condition = '')
    {
        $this->db->delete($table, $condition);
    }

    /**
     *
     * This function return the admin settings details
     */
    public function getAdminSettings()
    {
        $this->db->select('*');
        $this->db->where(ADMIN . '.id', '1');
        $this->db->from(ADMIN_SETTINGS);
        $this->db->join(ADMIN, ADMIN . '.id = ' . ADMIN_SETTINGS . '.id');

        $result = $this->db->get();
        unset($result->row()->admin_password);
        return $result;
    }

    /**
     *
     * This function return the Resevation settings details
     */
    public function getResevationSettings()
    {
        $this->db->select('p.id,p.property_id,pi.product_image');
        $this->db->from(PRODUCT . ' as p');
        $this->db->join(PRODUCT_PHOTOS . ' as pi', "pi.property_id=p.id", "LEFT");
        $this->db->where('p.property_status = "Reserved"');
        $this->db->group_by('p.id');

        $result = $this->db->get();
        //echo $this->db->last_query();die;
        return $result;
    }

    public function changereservedaftertime()
    {
        $this->db->select('*');
        $this->db->from(PRODUCT);
        $this->db->where('property_status = "Reserved" and modified > NOW() + INTERVAL -10 MINUTE');

        $result = $this->db->get();
        //echo $this->db->last_query();die;
        return $result;
    }

    public function getSoldSettings()
    {
        $curTimeVal = date('Y-m-d H:i:s');

        $this->db->select('p.id,p.property_id,pi.product_image');
        $this->db->from(PRODUCT . ' as p');
        $this->db->join(PRODUCT_PHOTOS . ' as pi', "pi.property_id=p.id", "LEFT");
        $this->db->where('p.property_status = "Sold"');
        $this->db->where('p.property_display = "1"');
        //$this->db->where('DATE_ADD(p.modified,INTERVAL 5 MINUTE) < ', $curTimeVal , true);

        $this->db->group_by('p.id');
        $this->db->order_by('p.reserved_time', 'desc');
        $this->db->order_by('pi.imgPriority', 'asc');

        $result = $this->db->get();
        //echo '<pre>'; print_r($result->result());
        //echo $this->db->last_query();die;
        return $result;
    }

    public function getResevationSettingsOnce()
    {
        $curTimeVal = date('Y-m-d H:i:s');

        $this->db->select('p.id,p.property_id,pi.product_image');
        $this->db->from(PRODUCT . ' as p');
        $this->db->join(PRODUCT_PHOTOS . ' as pi', "pi.property_id=p.id", "LEFT");
        $this->db->where('p.property_status = "Reserved"');
        $this->db->where('DATE_ADD(reserved_time,INTERVAL 10 MINUTE) < ', $curTimeVal, true);
        $this->db->group_by('p.id');

        $result = $this->db->get();
        //echo $this->db->last_query();
        return $result;
    }

    public function getResevationSettingslogin()
    {
        $curTimeVal = date('Y-m-d H:i:s');
        $this->db->select('p.id,p.property_id,pi.product_image');
        $this->db->from(PRODUCT . ' as p');
        $this->db->join(PRODUCT_PHOTOS . ' as pi', "pi.property_id=p.id", "LEFT");
        $this->db->where('DATE_ADD(modified,INTERVAL 10 MINUTE) < ', $curTimeVal, true);
        $this->db->group_by('p.id');

        $result = $this->db->get();
        //echo $this->db->last_query();die;
        return $result;
    }

    /**
     *
     * This function change the status of records and delete the records
     * @param String $table
     * @param String $column
     */
    public function activeInactiveCommon($table = '', $column = '')
    {
        $data = $_POST['checkbox_id'];
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i] == 'on') {
                unset($data[$i]);
            }
        }
        $mode = $this->input->post('statusMode');
        $AdmEmail = strtolower($this->input->post('SubAdminEmail'));
        /* $getAdminSettingsDetails = $this->getAdminSettings();
          $config = '<?php ';
          foreach($getAdminSettingsDetails ->row() as $key => $val){
          $value = addslashes($val);
          $config .= "\n\$config['$key'] = '$value'; ";
          }
          $file = 'fc_admin_action_settings.php';
          file_put_contents($file, $config);
          sivaprakash@teamtweaks.com
         */


        $json_admin_action_value = file_get_contents('fc_admin_action_settings.php');
        if ($json_admin_action_value != '') {
            $json_admin_action_result = unserialize($json_admin_action_value);
        }

        foreach ($json_admin_action_result as $valds) {
            $json_admin_action_result_Arr[] = $valds;
        }

        if (sizeof($json_admin_action_result) > 29) {
            unset($json_admin_action_result_Arr[1]);
        }

        $json_admin_action_result_Arr[] = array($AdmEmail, $mode, $table, $data, date('Y-m-d H:i:s'), $_SERVER['REMOTE_ADDR']);


        $file = 'fc_admin_action_settings.php';
        file_put_contents($file, serialize($json_admin_action_result_Arr));


        $this->db->where_in($column, $data);
        if (strtolower($mode) == 'delete') {
            $this->db->delete($table);
        } else {
            $statusArr = array('status' => $mode);
            $this->db->update($table, $statusArr);
        }
    }

    /**
     *
     * Common function for selecting records from table
     * @param String $tableName
     * @param Array $paraArr
     */
    public function selectRecordsFromTable($tableName, $paraArr)
    {
        extract($paraArr);
        $this->db->select($selectValues);
        $this->db->from($tableName);

        if (!empty($whereCondition)) {
            $this->db->where($whereCondition);
        }

        if (!empty($sortArray)) {
            foreach ($sortArray as $key => $val) {
                $this->db->order_by($key, $val);
            }
        }

        if ($perpage != '') {
            $this->db->limit($perpage, $start);
        }

        if (!empty($likeQuery)) {
            $this->db->like($likeQuery);
        }

        $query = $this->db->get();
        return $result = $query->result_array();
    }

    /**
     *
     * Common function for executing mysql query
     * @param String $Query	->	Mysql Query
     */
    public function ExecuteQuery($Query)
    {
        ini_set('mysql.connect_timeout', 300);
        ini_set('default_socket_timeout', 300);
        $this->db->query('SET SQL_BIG_SELECTS=1');
        return $this->db->query($Query);
    }

    /**
     *
     * Category -> product count function
     * @param String $res	->product category colum values
     * @param String $id	->Category id
     */
    public function productPerCategory($res, $id)
    {
        $option_exp = "";

        echo '<pre>';
        $res->num_rows;
        print_r($res);
        die;

        for ($i = 0; $i <= count($res->num_rows); $i++) {
            $option_exp .= $res[$i]['category_id'] . ",";
        }

        $option_exploded = explode(',', $option_exp);
        $valid_option = array_filter($option_exploded);
        $occurences = array_count_values($valid_option);

        if ($occurences[$id] == '') {
            return '0';
        } else {
            return $occurences[$id];
        }
    }

    public function mini_cart_view($userid = '')
    {

        /*         * *****************************Get Language Files Start********************************************* */

        if ($this->lang->line('giftcard_price') != '') {
            $giftcard_price = stripslashes($this->lang->line('giftcard_price'));
        } else {
            $giftcard_price = "Price";
        }

        if ($this->lang->line('product_quantity') != '') {
            $product_quantity = stripslashes($this->lang->line('product_quantity'));
        } else {
            $product_quantity = "Quantity";
        }

        if ($this->lang->line('purchases_total') != '') {
            $purchases_total = stripslashes($this->lang->line('purchases_total'));
        } else {
            $purchases_total = "Total";
        }

        if ($this->lang->line('checkout_order') != '') {
            $checkout_order = stripslashes($this->lang->line('checkout_order'));
        } else {
            $checkout_order = "Order";
        }

        if ($this->lang->line('proceed_to_checkout') != '') {
            $lang_proceed = stripslashes($this->lang->line('proceed_to_checkout'));
        } else {
            $lang_proceed = "Proceed to Checkout";
        }

        if ($this->lang->line('items') != '') {
            $lang_items = stripslashes($this->lang->line('items'));
        } else {
            $lang_items = "items";
        }

        if ($this->lang->line('header_description') != '') {
            $lang_description = stripslashes($this->lang->line('header_description'));
        } else {
            $lang_description = "Description";
        }

        /*         * *****************************Get Language Files End********************************************* */

        $minCartVal = '';
        $GiftMiniValue = '';
        $CartMiniValue = '';
        $SubscribMiniValue = '';
        $minCartValLast = '';
        $giftMiniAmt = 0;
        $cartMiniAmt = 0;
        $SubcribMiniAmt = 0;
        $cartMiniQty = 0;

        $giftMiniSet = $this->minicart_model->get_all_details(GIFTCARDS_SETTINGS, array('id' => '1'));
        $giftMiniRes = $this->minicart_model->get_all_details(GIFTCARDS_TEMP, array('user_id' => $userid));
        $shipMiniVal = $this->minicart_model->get_all_details(SHIPPING_ADDRESS, array('user_id' => $userid));
        $SubcribeMiniRes = $this->minicart_model->get_all_details(FANCYYBOX_TEMP, array('user_id' => $userid));


        $this->db->select('a.*,b.seourl,b.image,b.id as prdid,c.attr_name');
        $this->db->from(SHOPPING_CART . ' as a');
        $this->db->join(PRODUCT . ' as b', 'b.id = a.product_id');
        $this->db->join(PRODUCT_ATTRIBUTE . ' as c', 'c.id = a.attribute_values', 'left');
        $this->db->where('a.user_id = ' . $userid);
        $cartMiniVal = $this->db->get();


        if ($cartMiniVal->num_rows() > 0) {
            $s = 0;
            foreach ($cartMiniVal->result() as $CartRow) {
                $newImg = @explode(',', $CartRow->image);

                if ($newImg[0] != '') {
                    $newImgpath = PRODUCTPATH . $newImg[0];
                } else {
                    $newImgpath = PRODUCTPATH . 'dummyProductImage.jpg';
                }

                $cartMiniAmt = $cartMiniAmt + $CartRow->indtotal;

                $CartMiniValue.= '<div id="cartMindivId_' . $s . '"><table><tbody><tr>
	       	<th class="info"><a href="things/' . $CartRow->prdid . '/' . $CartRow->seourl . '"><img src="images/site/blank.gif" style="background-image:url(' . $newImgpath . ')" alt="' . $CartRow->product_name . '"><strong>' . $CartRow->product_name . '</strong><br />';
                if ($CartRow->attr_name != '') {
                    $CartMiniValue.= $CartRow->attr_name;
                }

                $CartMiniValue.= '</a></th>
			<td class="qty">' . $CartRow->quantity . '</td>
            <td class="price">' . $this->data['currencySymbol'] . $CartRow->indtotal . '</td>
		</tr></tbody></table></div>';
                $cartMiniQty = $cartMiniQty + $CartRow->quantity;
                $s++;
            }
        }


        if ($SubcribeMiniRes->num_rows() > 0) {
            $s = 0;
            foreach ($SubcribeMiniRes->result() as $SubCribRow) {
                $SubscribMiniValue.= '<div id="SubcribtMinidivId_' . $s . '"><table><tbody><tr>
	        	<th class="info"><a href="fancybox/' . $SubCribRow->fancybox_id . '/' . $SubCribRow->seourl . '"><img src="images/site/blank.gif" style="background-image:url(' . FANCYBOXPATH . $SubCribRow->image . ')" alt="' . $SubCribRow->name . '"><strong>' . $SubCribRow->name . '</strong></a></th>
	            <td class="qty">1</td>
    	        <td class="price">' . $this->data['currencySymbol'] . number_format($SubCribRow->price, 2, '.', '') . '</td>
				</tr></tbody></table></div>';
                $SubcribMiniAmt = $SubcribMiniAmt + $SubCribRow->price;
                $s++;
            }
        }

        if ($giftMiniRes->num_rows() > 0) {
            $k = 0;
            foreach ($giftMiniRes->result() as $giftRow) {
                $GiftMiniValue.= '<div id="GiftMindivId_' . $k . '"><table><tbody><tr>
        	<th class="info"><a href="gift-cards"><img src="images/site/blank.gif" style="background-image:url(' . GIFTPATH . $giftMiniSet->row()->image . ')" alt="' . $giftMiniSet->row()->title . '"><strong>' . $giftMiniSet->row()->title . '</strong><br>' . $giftRow->recipient_name . '</a></th>
            <td class="qty">1</td>
            <td class="price">' . $this->data['currencySymbol'] . number_format($giftRow->price_value, 2, '.', '') . '</td>
		</tr></tbody></table></div>';
                $giftMiniAmt = $giftMiniAmt + $giftRow->price_value;
                $k++;
            }
        }

        $countMiniVal = $giftMiniRes->num_rows() + $cartMiniQty + $SubcribeMiniRes->num_rows();

        if ($countMiniVal == 0) {
            $cartMiniDisp = '<ul class="gnb-wrap"><li class="gnb" id="cart-new"><a href="cart" class="mn-cart"><span class="hide">cart</span> <em class="ic-cart"></em> <span>0 ' . $lang_items . '</span></a></li></ul>';
        } else {
            $minCartVal.= '<ul class="gnb-wrap"><li class="gnb" id="cart-new"><a href="cart" class="mn-cart"><span class="hide">cart</span> <em class="ic-cart"></em> <span id="Shop_MiniId_count">' . $countMiniVal . ' ' . $lang_items . '</span></a>
			<div style="display: none;" class="menu-contain-cart after" id="cart_popup">
			<table><thead><tr><th>' . $lang_description . '</th><td>' . $product_quantity . '</td><td class="price">' . $giftcard_price . '</td></tr></thead></table>';

            $totalMiniCartAmt = $giftMiniAmt + $cartMiniAmt + $SubcribMiniAmt;

            $minCartValLast.= '<div class="summary">
				<strong>' . $checkout_order . ' ' . $purchases_total . ': </strong>
				<span>' . $this->data['currencySymbol'] . number_format($totalMiniCartAmt, 2, '.', '') . '</span>
				</div><a href="cart/" class="more">' . $lang_proceed . '</a></div></li></ul>';

            $cartMiniDisp = $minCartVal . $CartMiniValue . $SubscribMiniValue . $GiftMiniValue . $minCartValLast;
        }
        return $cartMiniDisp;
    }

    /**
     *
     * Retrieve records using where_in
     * @param String $table
     * @param Array $fieldsArr
     * @param String $searchName
     * @param Array $searchArr
     * @param Array $joinArr
     * @param Array $sortArr
     * @param Integer $limit
     *
     * @return Array
     */
    public function get_fields_from_many($table = '', $fieldsArr = '', $searchName = '', $searchArr = '', $joinArr = '', $sortArr = '', $limit = '', $condition = '')
    {
        if ($searchArr != '' && count($searchArr) > 0 && $searchName != '') {
            $this->db->where_in($searchName, $searchArr);
        }
        if ($condition != '' && count($condition) > 0) {
            $this->db->where($condition);
        }
        $this->db->select($fieldsArr);
        $this->db->from($table);
        if ($joinArr != '' && is_array($joinArr)) {
            foreach ($joinArr as $joinRow) {
                if (is_array($joinRow)) {
                    $this->db->join($joinRow['table'], $joinRow['on'], $joinRow['type']);
                }
            }
        }
        if ($sortArr != '' && is_array($sortArr)) {
            foreach ($sortArr as $sortRow) {
                if (is_array($sortRow)) {
                    $this->db->order_by($sortRow['field'], $sortRow['type']);
                }
            }
        }
        if ($limit != '') {
            $this->db->limit($limit);
        }
        return $this->db->get();
    }

    public function get_total_records($table = '', $condition = '')
    {
        $Query = 'SELECT COUNT(*) as total FROM ' . $table . ' ' . $condition;
        return $this->ExecuteQuery($Query);
    }

    public function get_selected_fields_records($fields = '', $table = '', $condition = '')
    {
        $Query = 'SELECT ' . $fields . ' FROM ' . $table . ' ' . $condition;
        return $this->ExecuteQuery($Query);
    }

    public function common_email_send($eamil_vaues = array())
    {

        /* echo  'From : '.$eamil_vaues['from_mail_id'].' <'.$eamil_vaues['mail_name'].'><br/>'.
          'To   : '.$eamil_vaues['to_mail_id'].'<br/>'.
          'Subject : '.$eamil_vaues['subject_message'].'<br/>'.
          'Message : '.$eamil_vaues['body_messages'];die; */
        if (is_file('./fc_smtp_settings.php')) {
            include('fc_smtp_settings.php');
        }


        // Set SMTP Configuration

        if ($config['smtp_user'] != '' && $config['smtp_pass'] != '') {
            $emailConfig = array(
                'protocol' => 'smtp',
                'smtp_host' => $config['smtp_host'],
                'smtp_port' => $config['smtp_port'],
                'smtp_user' => $config['smtp_user'],
                'smtp_pass' => $config['smtp_pass'],
                'auth' => true,
            );
        }

        // Set your email information
        $from = array('email' => $eamil_vaues['from_mail_id'], 'name' => $eamil_vaues['mail_name']);
        $to = $eamil_vaues['to_mail_id'];
        $subject = $eamil_vaues['subject_message'];
        $message = stripslashes($eamil_vaues['body_messages']);
        // Load CodeIgniter Email library

        if ($config['smtp_user'] != '' && $config['smtp_pass'] != '') {
            $this->load->library('email', $emailConfig);
        } else {
            $this->load->library('email');
        }

        // Sometimes you have to set the new line character for better result

        $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->set_mailtype($eamil_vaues['mail_type']);
        $this->email->from('info@gainturnkeyproperty.com', $from['name']);
        $this->email->to($to);
        if ($eamil_vaues['cc_mail_id'] != '') {
            $this->email->cc($eamil_vaues['cc_mail_id']);
        }
        if ($eamil_vaues['bcc_mail_id'] != '') {
            $this->email->bcc($eamil_vaues['bcc_mail_id']);
        }
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent

        if (!$this->email->send()) {
            // Raise error message
            //show_error($this->email->print_debugger());
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            // Set email preferences
            $this->email->set_mailtype($eamil_vaues['mail_type']);
            $this->email->from($from['email'], $from['name']);
            $this->email->to($to);
            if ($eamil_vaues['cc_mail_id'] != '') {
                $this->email->cc($eamil_vaues['cc_mail_id']);
            }
            if ($eamil_vaues['bcc_mail_id'] != '') {
                $this->email->bcc($eamil_vaues['bcc_mail_id']);
            }

            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
        } else {
            // Show success notification or other things here
            //echo 'Success to send email';
            return 1;
        }
    }

    //get newsletter template
    public function get_newsletter_template_details($apiId = '')
    {
        $this->db->select('*');
        $this->db->from(NEWSLETTER);

        $this->db->where('id', $apiId);
        $this->db->where('status', 'Active');
        $query = $this->db->get()->result_array();


        $twitterQuery = "select * from " . NEWSLETTER . " where id=" . $apiId . " AND status='Active'";
        $twitterQueryDetails = mysql_query($twitterQuery);
        return $query[0];
    }
}
