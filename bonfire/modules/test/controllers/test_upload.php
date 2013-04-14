<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class test_upload extends Admin_Controller {
		
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
		
		public function delete()
		{
			rmdir('./upload/video/Nike/aaaaa/');
			
		}
	}

	