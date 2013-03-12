
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class incentive extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
			
		$this->load->library('form_validation');
		$this->load->model('prescreen_model', null, true);
		$this->lang->load('prescreen');
			
	}
	
	public function index(){
		Template::render();
	}
	
	public function v_divider(){
		Template::set_theme('two column','junk');
		Template::render();
	}
	
	public function helper_using(){
		$this->load->helper('upload_helper');
		$data=test_method('hello');
		console::log($data);
	}
	
	public function preview_image(){
		
		Assets::add_module_js('prescreen','upload_incentive_image.js');
		Template::render();
	}
	
	public function path(){

		$company=$this->load->model('company/company_model')->find_by('company_userid',$this->auth->user_id());
		if ($company ===false) return false;
		$path='./'.INCENTIVE_PATH.'/'.$company->company_name;
		$file_name=time();
		console::log($file_name);
	}
	
	public function sider_active(){
		strpos($this->uri->uri_string().'alskdjfalj','prescreen/incentive/sider_active')===false ?  console::log('f') :console::log('active');
		//console::log($this->uri->uri_string());
		$result=strpos("abcde",'bc');
		console::log($result);
		//console::log(substr_compare("abcde", "bc", 3, 2)); // 0
		
	}
	
}