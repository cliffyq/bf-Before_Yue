<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user_information extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('user_information_model', null, true);
		$this->lang->load('user_information');

	}

	//--------------------------------------------------------------------



	/*
		Method: index()

	Displays a list of form data.
	*/
	public function index()
	{

		$records = $this->user_information_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------
	public  function get_current_points()
	{
		$row =$this->user_information_model->find_user_information_by_uid($this->auth->user_id());
		$data['your_current_points']=$row;
		$this->load->view('get_current_points',$data);
		/*
		 if($this->input->is_ajax_request())
		 {
		Template::set('records',$row);
		Template::render();
		}
		else
			return $row->user_information_current_points;
		*/

	}



}