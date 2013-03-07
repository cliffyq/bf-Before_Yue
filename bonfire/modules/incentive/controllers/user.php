<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
			
		$this->auth->restrict('Incentive.User.View');
		$this->load->model('incentive_model', null, true);
		$this->lang->load('incentive');
			
		Template::set_block('sub_nav', 'user/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
	 Method: index()

	Displays a list of form data.
	*/
	public function index()
	{
		$records=array();
		if($records = $this->incentive_model->find_all(1))
		{
			foreach ($records as $k=>$v)
			{
				$records[$k]['company']=$this->incentive_model->get_company($v['incentive_company_id']);
			}
		}

			
			
		assets::add_module_js('incentive','jquery.confirm-1.3.js');
		assets::add_js($this->load->view('inline_js/confirm.js.php',null,true),'inline');
		Template::set_theme('Two');
		Template::set('records',$records);
		Template::set('toolbar_title','Incentive');
		Template::render();
	}

	public function  charity()
	{

		if (isset($_POST['points']))
		{
			$uid=$this->auth->user_id();
			$points=$_POST['points'];
			if($this->load->model('user_information/user_information_model')->reduce_points($uid,$points) !== -1)
			{

				$user = $this->user_information_model->find_by('user_information_user_id',$uid);
				echo  $user->user_information_current_points;
			}
			else
				echo false;
		}
		else
		{
			$records= $this->load->model('company/company_model')->find_all_by('company_industry_id',9);

			$current_points=$this->load->model('user_information/user_information_model')->find_user_information_by_uid($this->auth->user_id());

			assets::add_module_js('incentive','jquery.confirm-1.3.js');
			assets::add_js($this->load->view('inline_js/charity.js.php',null,true),'inline');
			Template::set('records',$records);
			Template::set('toolbar_title','Incentive');
			Template::set_theme('Two');
			Template::render();
		}
	}

	//--------------------------------------------------------------------

	public function purchase($incentive_id)
	{
		$uid=$this->auth->user_id();
		$points=$this->incentive_model->get_points($incentive_id);
		if($this->load->model('user_information/user_information_model')->reduce_points($uid,$points) !== -1)
		{

			$history=array('purchase_history_user_id'=>$uid,'purchase_history_incentive_id'=>$incentive_id);
			$this->load->model('purchase_history/purchase_history_model')->insert($history);
			$user = $this->user_information_model->find_by('user_information_user_id',$uid);
			echo  $user->user_information_current_points;
		}
		else
			echo false;
			
	}


}