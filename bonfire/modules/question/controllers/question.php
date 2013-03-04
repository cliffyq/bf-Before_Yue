<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class question extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('question_model', null, true);
		$this->lang->load('question');

	}

	//--------------------------------------------------------------------



	/*
		Method: index()

	Displays a list of form data.
	*/
	public function index()
	{

		$records = $this->question_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------


	//for debug
	public function  question_show($qid)
	{
		$records=$this->question_model->get_question($qid);
		Template:: set('question',$records);
		Template:: render();
	}

}