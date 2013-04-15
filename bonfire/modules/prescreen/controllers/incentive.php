
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
		strpos($this->uri->uri_string(),'company/company_company/video_charts')===false ?  console::log('f') :console::log('active');
		//console::log($this->uri->uri_string());
		$result=strpos("abcde",'bc');
		console::log($result);
		//console::log(substr_compare("abcde", "bc", 3, 2)); // 0
		
	}
	
	public function pathinfo_test(){
		$types='jpg|png';
		$this->load->library('form_validation');
	//	$this->form_validation->
		$type = explode('|', $types);
		$types=pathinfo('www.aaa',PATHINFO_EXTENSION);
		console::log(PATHINFO_EXTENSION);
		console::log($type);
	}
	
	public function delete_image(){
		$this->load->model('incentive/incentive_model');
		/*
		$data=$this->incentive_model->find_by('incentive_company_id',1,'and','1');
		console::log($data);
		//$path=$this->load->module('incentive/commonauth')->get_incentive_image($data->incentive_image_path);
		$data['incentive_image_path']=$this->load->module('incentive/commonauth')->get_incentive_image($data['incentive_image_path']);
	//	console::log($path);
		if(isset($data['incentive_image_path'])&& ($data['incentive_image_path']!=NULL))
			console::log('got');
		else
			console::log('error');
		//unlink('./'.$path);
		 * 
		 */
		//$this->load->helper('file');
		$data=$this->incentive_model->find(17,1);
		console::log($data);
		if(!isset($data['incentive_image_path'])&& ($data['incentive_image_path']==NULL)) return FALSE;
		$delete_file=$this->load->module('incentive/commonauth')->get_incentive_image($data['incentive_image_path']);
		console::log($delete_file);
		if($delete_file==NULL) console::log('do delete');
		else console::log('F');
		
		
	}
	
	public function judgement($data)
	{
		if($data==0)
			return 0;
		
	}
	
	public function return_value($data)
	{
		$value=$this->judgement($data);
		console::log($value);
	}
	
	public function sort_test()
	{
		$id=1;
		$result=$this->load->model('incentive/incentive_model');
		$this->incentive_model->order_by('incentive_amount_purchased','desc');
		$result=$this->incentive_model->find_all_by('incentive_company_id',$id);
		console::log($result);
	}
	
	public function encoding()
	{
		$strs =array('what'.time(),'this'.time(),'ever'.time()) ;
		$strs[3]='what'.time();
		$data['incentive_name']='new';
		$this->load->helper('base64');
		$file_name=urlsafe_b64encode(hash('crc32b', $data['incentive_name'].time()));
		console::log($file_name);
	}
	
	
}