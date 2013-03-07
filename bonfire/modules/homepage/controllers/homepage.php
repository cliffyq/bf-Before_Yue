<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class homepage extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		/*
		 //			$login_part=$this->load->module('prescreen/bootstrap')->login_part();
		//			$register_part=$this->load->module('prescreen/bootstrap')->register_part();
		$center_block_part=$this->center_block_part();
		$little_block_parts=$this->little_block_parts();
			
			
			
		//          Template::set_theme('main','junk');
		//			Template::set('login_part',$login_part);
		//			Template::set('register_part',$register_part);
		Template::set('center_block_part',$center_block_part);
		Template::set('little_block_parts',$little_block_parts);
		*/
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
	public function center_block_part()
	{
		//		    return $this->load->view('homepage/center_block',null,true);
		$this->load->view('home/index',null);
		//$this->load->view('homepage/center_block',null);
		//Template::render();
	}
}