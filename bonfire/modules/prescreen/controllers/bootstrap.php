<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class bootstrap extends Front_Controller {
		
		//--------------------------------------------------------------------
		
		
		public function __construct()
		{
			parent::__construct();
			
			$this->load->library('form_validation');
			$this->load->model('prescreen_model', null, true);
			$this->lang->load('prescreen');
			
		}
		
		public function topbar()
		{
			$data['video_panel']=$this->load->module('video')->view(47);
			$this->load->view('bootstrap/topbar',$data);
		}
		
		public function home()
		{
			
			$login_part=$this->load->module('prescreen/bootstrap')->login_part();
			$register_part=$this->load->module('prescreen/bootstrap')->register_part();
			$video_part=$this->load->module('prescreen/bootstrap')->video_part();
			
			
            //Template::set_theme('main','junk');
			Template::set('login_part',$login_part);
			Template::set('register_part',$register_part);
			Template::set('video_part',$video_part);
			Template::render();
		    
		}
		
		public function login_part()
		{
		    $this->load->view('bootstrap/login',null);
		}
		
			public function register_part()
		{
			return  $this->load->view('bootstrap/register',null,true);
		}
		
			public function video_part()
		{
		     return $this->load->module('video')->view(47);
		}
		
		public function general_page()
		{
			
			/*
			$video_part=$this->load->module('prescreen/bootstrap')->video_part();
			Template::set('video_part',$video_part);
			Template::set_theme('Two','junk');
			Template::render();
			*/
			
			$data['video_part']=$this->load->module('prescreen/bootstrap')->video_part();
			$this->load->view('bootstrap/general_page',$data);
			
		}
		
		public function public_page()
		{
			template::render();
		}
		
		public function videojs()
		{	
			$video=$this->load->module('video/view',47);
			Template::set('video',$video);
			template::render();
		}
	}	