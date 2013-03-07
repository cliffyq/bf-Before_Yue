<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class test_callback extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
			
			
	}


	public function index()
	{
		Assets::add_js($this->load->view('inline_js/callback.js.php',null,true),'inline');
		template::set_theme('test_upload');
		template::render();
	}

	public function speak()
	{
		echo 'aaa';
	}

}