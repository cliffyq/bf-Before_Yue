<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
			
		$this->auth->restrict('Video_Question.User.View');
		$this->load->model('video_question_model', null, true);
		$this->lang->load('video_question');
			
		Template::set_block('sub_nav', 'user/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
	 Method: index()

	Displays a list of form data.
	*/
	public function index()
	{
	}


}