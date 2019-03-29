<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to admin management
 * @author Teamtweaks
 *
 */
class Admin_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function add_edit_subadmin($dataArr='',$condition=''){
		if ($condition['id'] != ''){
			$this->db->where($condition);
			$this->db->update(ADMIN,$dataArr);
		}else {
			$this->db->insert(ADMIN,$dataArr);
		}
	}
	
	/**
    * 
    * This function save the admin details in a file
    */
   public function saveAdminSettings(){
		$getAdminSettingsDetails = $this->getAdminSettings();
		$config = '<?php ';
		foreach($getAdminSettingsDetails->row() as $key => $val){
			$value = addslashes($val);
			$config .= "\n\$config['$key'] = '$value'; ";
		}
		$config .= "\n\$config['base_url'] = '".base_url()."'; ";
		$config .= ' ?>';
		$file = 'commonsettings/fc_admin_settings.php';
		file_put_contents($file, $config);
   }
   
    public function pr_saveAdminSettings(){
		$getAdminSettingsDetails = $this->getAdminSettings();
		$config = '<?php ';
		foreach($getAdminSettingsDetails->row() as $key => $val){
			$value = addslashes($val);
			$config .= "\n\$config['$key'] = '$value'; ";
		}
		$config .= "\n\$config['base_url'] = '".base_url()."'; ";
		$config .= ' ?>';
		//$new_URL = 'http://192.168.1.253/sivaprakash/preigrentals/';
		$new_URL = 'http://projects.teamtweaks.com/preigrentals/';
		//$new_URL = 'http://preigrentals.com/';
		$file = $new_URL.'commonsettings/fc_admin_settings.php';
		//echo $file; die;
		file_put_contents($file, $config);
   }
   
   public function pr_getAdminSettings(){
		$this->db->select('*');
		$this->db->where(ADMIN.'.id','1');
		$this->db->from(ADMIN_SETTINGS_PR);
		$this->db->join(ADMIN,ADMIN.'.id = '.ADMIN_SETTINGS_PR.'.id');
		
		$result = $this->db->get();
		unset($result->row()->admin_password);
		return $result;
	}
}