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
	
	public function create_incentive($data){
		if(!is_array($data)||empty($data))
			return false;
		
		$company=$this->load->model('company/company_model')->find_by('company_userid',$this->auth->user_id());
		if ($company ===false) return false;
		$file_name=$data['incentive_name'].time();
		$path='./'.INCENTIVE_PATH.'/'.$company->company_name.'/';
		$this->load->helper('upload_helper');
		$fdata = my_upload('incentive_image',$file_name,$path,'incentive');
		if(isset($fdata['error'])||!isset($fdata['upload_data']) || $fdata['upload_data'] == NULL){
		
			return FALSE;
		}
		
		$data['incentive_company_id'] = $company->id;
		$data['incentive_image_path'] ='/'.$company->company_name."/".$file_name;
		$id = $this->insert($data);
		if (!is_numeric($id)) return FALSE;
		return $id;
	}
}
