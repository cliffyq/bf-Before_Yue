<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class info_test extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('user_info_model', null, true);
		$this->lang->load('user_info');

	}

	//--------------------------------------------------------------------
	public function register_basic_info()
	{
		$this->load->view('register_basic_info',null,true);
	}

	public function post_test() {
		if ($this->form_validation->run($this) !== FALSE){
			$data['rows']	= $this->input->post('user_info_first_name');
			Template::set('rows',$data['rows']);
			Template::set_view($view = 'show_info');
			Template::render();
		}

	}

}