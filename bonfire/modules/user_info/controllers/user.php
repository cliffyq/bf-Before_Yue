<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('User_Info.User.View');
		$this->load->model('user_info_model', null, true);
		$this->lang->load('user_info');

		Template::set_block('sub_nav', 'user/_sub_nav');
	}

	//--------------------------------------------------------------------



	//--------------------------------------------------------------------
}