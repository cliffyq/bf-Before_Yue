<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class call extends Admin_Controller {

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
		//$data =$this->load->module('test/content')->send_data();
		//$data =$this->load->module('video')->video_ajax();
		//$data='123';
		//$this->load->module('test/content');
		$data = $this->content->send_data();
		//Template:: set('record',$this->load->module('video')->video_ajax());
			
		//$pages =$this->load->module('video')->view(46);
			
		//Template:: set('pages',$pages);
		$id= 5;
		Template:: set('id',$id);
		Template:: render();
	}



	//--------------------------------------------------------------------

}

