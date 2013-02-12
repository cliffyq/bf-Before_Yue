<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Incentive_model extends BF_Model {

	protected $table		= "incentive";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;
	
	public function get_points($incentive_id)
	{
		$row=$this->find($incentive_id);
		return  $row->incentive_price;		
		
	}
	
	public function get_company($company_id)
	{
		$company =$this->load->model('company/company_model')->find_by('id',$company_id);
		if ($company ===false) return false;
				if(strpos($company->company_url, 'http://')===false)
				{
				  $company->company_url='http://'. $company->company_url;
				}
				return $company;
	}
}
