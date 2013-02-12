<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class content extends Admin_Controller {
		
		//--------------------------------------------------------------------
		
		
		public function __construct()
		{
			parent::__construct();
			
		}
		
		//--------------------------------------------------------------------
		
		
		
		/*
			Method: index()
			
			Displays a list of form data.
		*/
		public function index()
		{
			
		}
		
		public function send_data()
		{
		        $data= 'Got you';
                return  $data ;			
		}
		
		public function back($id)
		{
		
		    //Template::parse_views(TRUE);
			Template::render();
			//return $this->load->view('back',$id,TRUE);
		}
	}