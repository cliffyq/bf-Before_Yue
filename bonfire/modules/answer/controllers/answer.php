<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class answer extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('answer_model', null, true);
		$this->lang->load('answer');

	}

	//--------------------------------------------------------------------



	/*
		Method: index()

	Displays a list of form data.
	*/
	public function index()
	{

		$records = $this->answer_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------




}