<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class homepage extends Front_Controller {
		
		//--------------------------------------------------------------------
		
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('form');
		}
		
		public function index()
		{
			if($this->auth->is_logged_in())
			Template::redirect('/company/company_company/video_charts');
			$center_block_part=$this->load->module('preview/homepage')->center_block_part();
			$header_block_part=$this->load->module('preview/homepage')->header_block_part();
			$footer_block_part=$this->load->module('preview/homepage')->footer_block_part();

			
			
			Template::set_theme('main','junk');
			Assets::clear_cache();
			Assets::add_module_js('preview', 'preview.js');
			Assets::add_module_js('preview', 'jquery.aw-showcase.js');
			Assets::add_js($this->load->view('inline_js/showcase.js.php',null,true),'inline');
			Assets::add_js($this->load->view('inline_js/homepage_control.js.php',null,true),'inline');
			//			Template::set('login_part',$login_part);
			//			Template::set('register_part',$register_part);
			Template::set('center_block_part',$center_block_part);
			Template::set('header_block_part',$header_block_part);
			Template::set('footer_block_part',$footer_block_part);
			//			Template::set('little_block_parts',$little_block_parts);
			Template::set_view('/homepage/index');
			Template::render();		    
		}
		/*	
			public function login_part()
			{
			return $this->load->view('bootstrap/login',null,true);
			}
			
			public function register_part()
			{
			return  $this->load->view('bootstrap/register',null,true);
			}
		*/	
		
		public function header_block_part()
		{

			return $this->load->view('homepage/header_block', null, true);
		}
		
		public function center_block_part()
		{
		    return $this->load->view('homepage/center_block', null, true);
			//			return $this->load->view('homepage/index',null, true);
			//$this->load->view('homepage/center_block',null);
			//Template::render();
		}
		
		
		
		public function footer_block_part()
		{
			return $this->load->view('homepage/footer_block', null, true);
		}
	}	