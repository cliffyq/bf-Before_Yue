<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class test extends Front_Controller {
		
		//--------------------------------------------------------------------
		
		
		public function __construct()
		{
			parent::__construct();
			$this->load->module('comment');
			
		}
		
		//--------------------------------------------------------------------
		
		
		
		/*
			Method: index()
			
			Displays a list of form data.
		*/
		public function index()
		{
			//$this->session->set_userdata('count',1);
			//$this->video_stats->update('aaa');
			//print_r($this->video_stats->get_stats());
			Template::set_theme('main','junk');
			Template::render();
			/*
				$viewed=$this->session->userdata['reviewed'];
				if ($this->load->module('reviews')->has_reviewed(47))
				{ echo  "Yes";}
			*/
		}
		
		public function haha()
		{
			//$this->session->set_userdata('count',1);
			//$this->video_stats->update('aaa');
			//print_r($this->video_stats->get_stats());
			Template::set_theme('main','junk');
			Template::render();
			/*
				$viewed=$this->session->userdata['reviewed'];
				if ($this->load->module('reviews')->has_reviewed(47))
				{ echo  "Yes";}
			*/
		}

		
		
	}
	
