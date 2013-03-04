<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class commonauth extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('User_Info.Commonauth.View');
		$this->load->model('user_info_model', null, true);
		$this->lang->load('user_info');

		Template::set_block('sub_nav', 'commonauth/_sub_nav');
	}

	//--------------------------------------------------------------------



	//--------------------------------------------------------------------



}