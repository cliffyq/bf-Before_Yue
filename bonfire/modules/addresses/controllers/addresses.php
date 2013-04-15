<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class addresses extends Front_Controller {

	//--------------------------------------------------------------------


		public function __construct()
		{
		parent::__construct();

		$this->load->library('form_validation');
			$this->load->model('addresses_model', null, true);
		$this->lang->load('addresses');
		
}

		//--------------------------------------------------------------------


		
		/*
		Method: index()

		Displays a list of form data.
		*/
		public function index()
		{
		
			$records = $this->addresses_model->find_all();

					Template::set('records', $records);
		Template::render();
}

		//--------------------------------------------------------------------


		

}