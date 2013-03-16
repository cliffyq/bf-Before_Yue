<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Company_auth extends Admin_Controller {
		
		public function __construct()
		{
			parent::__construct();	
		}
		
		
		public function index()
		{
			
			$this->load->model('Gallery_model');
			
			//if ($this->input->post('')) {
				//console::log($this->input->post());
				//$this->Gallery_model->do_upload();
			if ($this->input->is_ajax_request()){
				$dir = $this->Company_model->video_saving();
				echo $dir;
				//die();
			}
			//$data['images'] = $this->Gallery_model->get_images();
			else{
			Assets::add_js($this->load->view('inline_js/test_upload.js.php',null,true),'inline');		
			template::set_theme('two column');
			template::render();
			}
		}
		public function getcompany($vid,$return_type=0){
			$this->load->model('video/video_model');
			console::log(var_export($this->video_model->get_company($vid,$return_type),true));
		}
		public function permission($vid=false,$uid=false){
			console::log(var_export($this->load->module('company/company_company')->user_has_permision_to_video($vid,$uid),true));
		}
		public function set_info()
		{
			echo 'haha';
			
		}
	}

	