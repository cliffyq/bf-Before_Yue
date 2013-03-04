<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Purchase_history.User.View');
		$this->load->model('purchase_history_model', null, true);
		$this->lang->load('purchase_history');

		Template::set_block('sub_nav', 'user/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

	Displays a list of form data.
	*/
	public function index()
	{


		if($records = $this->purchase_history_model->find_all_by('purchase_history_user_id',$this->auth->user_id(),'and',1))
		{
			foreach ($records as $k=>$v)
			{
				$records[$k]['incentive']=$this->load->model('incentive/incentive_model')->find($v['purchase_history_incentive_id'],1);
				$records[$k]['incentive']['company']=$this->incentive_model->get_company($records[$k]['incentive']['incentive_company_id']);
			}
		}
		Template::set('records', $records);
		Template::set_theme('Two column');
		Template::render();
	}

	//--------------------------------------------------------------------


}