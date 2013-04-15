<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_history_model extends BF_Model {

	protected $table		= "purchase_history";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = false;
	protected $created_field = "created_on";

	//fields:gender,birth_month,birth_year,race,education,zipcode,time,ip
	public function get_purchase_history($incentive_id)
	{
		$this->load->model('addresses/addresses_model');
		$this->load->helper('date');
		$return = array();
		$this->load->model('user_info/user_info_model', null, true);
		$purchase_histories = $this->find_all_by('purchase_history_incentive_id', $incentive_id, 'and', 1);
		if($purchase_histories === false) return false;
		foreach($purchase_histories as $k=>$v)
		{
			$user_info = $this->user_info_model->get_user_info($v['purchase_history_user_id']);
			if($user_info!==false)
			{
				$return[$k]['User Gender'] = $user_info['user_info_gender']==1?'M':'F';
				$return[$k]['User DOB'] = $user_info['user_info_birth_month'].'/'.$user_info['user_info_birth_year'];
				$return[$k]['User Age'] = get_age($user_info['user_info_birth_year'],$user_info['user_info_birth_month']);
				$return[$k]['User Race'] = $user_info['user_info_race'];
				$return[$k]['User Education Level'] = $user_info['user_info_education'];
				$return[$k]['User Zipcode'] = $user_info['user_info_zipcode'];
				$addr = $this->addresses_model->find_by('addresses_zip',$user_info['user_info_zipcode']);
				$return[$k]['User City'] = is_object($addr)?$addr->addresses_city:"";
				$return[$k]['User State'] = is_object($addr)?$addr->addresses_state:"";
				$return[$k]['User Industry'] = $user_info['user_info_industry_id'];
				$return[$k]['User Veteran'] = $user_info['user_info_veteran'];
			}
			else
			{
				$return[$k]['User Gender'] = '';
				$return[$k]['User DOB'] = '';
				$return[$k]['User Age'] ='';
				$return[$k]['User Race'] = '';
				$return[$k]['User Education Level'] = '';
				$return[$k]['User Zipcode'] = '';
				$return[$k]['User City'] = '';
				$return[$k]['User State'] = '';
				$return[$k]['User Industry'] = '';
				$return[$k]['User Veteran'] = '';
			}
			//$return[$k]['Purchase Time'] = $v['created_on'];
			$return[$k]['Purchase Time'] = date("Y-m-d h:j:s", strtotime($v['created_on']));
		}
		// Console::log(print_r($return,true));
		return $return;
	}
}