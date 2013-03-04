<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class test extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('company_model', null, true);
		$this->lang->load('company');

	}

	//--------------------------------------------------------------------



	/*
		Method: index()

	Displays a list of form data.
	*/
	public function index()
	{

		$records = $this->company_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	public function company_register()
	{

		Template::render();
	}

	public function receiver()
	{
		$message = $this->input->post('industry');
		print_r($message);
	}


}