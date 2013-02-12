<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class company extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('User_Info.Company.View');
		$this->load->model('user_info_model', null, true);
		$this->lang->load('user_info');
		
		Template::set_block('sub_nav', 'company/_sub_nav');
	}

	//--------------------------------------------------------------------

	//--------------------------------------------------------------------



}