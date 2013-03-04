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
		//$this->load->module('test/content');
		//$data = $this->content->send_data();
		//Template:: set('record',$data);
			
		$id= 5;
		Template:: set('id',$id);
		Template:: render();
	}



	//--------------------------------------------------------------------

}

