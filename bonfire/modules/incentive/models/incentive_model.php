<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Incentive_model extends BF_Model {

	protected $table		= "incentive";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = true;
	protected $created_field = "created_on";
	protected $modified_field = "modified_on";
		
		
		
		
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
		
	public function upload_incentive($data){
		if(!is_array($data)||empty($data))
			return false;
			
		$company=$this->load->model('company/company_model')->find_by('company_userid',$this->auth->user_id());
		if ($company ===false) return false;
		$this->load->helper('base64');
		$file_name=urlsafe_b64encode(hash('crc32b', $data['incentive_name'].time()));
		$path='./'.INCENTIVE_PATH.'/'.$company->company_name.'/';
		$this->load->helper('upload_helper');
		$fdata = my_upload('incentive_image',$file_name,$path,'incentive');
		if(isset($fdata['error'])||!isset($fdata['upload_data']) || $fdata['upload_data'] == NULL){
				
			return FALSE;
		}
			
		$data['incentive_company_id'] = $company->id;
		$data['incentive_image_path'] = $company->company_name."/".$file_name;
		
		return $data;
		
	}
	
	/**
	 * sort the incentives of company by given condition
	 * 
	 * @param string $company_id  
	 * @param string $field
	 * @param string $order
	 * @param number $return_type  Choose the type of return type. 0 - Object, 1 - Array
	 * @return boolean | mixed An array of objects representing the results, or FALSE on failure or empty set.
	 */
	
	public function get_company_incentive_sorted_by($company_id=NULL,$field='created_on', $order='desc',$return_type = 1)
	{
		//$this->incentive_model->find_all_by('incentive_company_id',$company->id);
		
		if(empty($company_id)) return FALSE;
		$this->db->where('incentive_company_id', $company_id);
		$this->order_by($field,$order);
		$this->set_selects();
		$query=$this->db->get($this->table);
		
		if ($query && $query->num_rows() > 0)
		{
			if($return_type == 0)
			{
				return $query->row();
			}
			else
			{
				//return $query->row_result();
				return $query->row_array();
			}
		}

		return FALSE;
		
		//$this->order_by($field,$order);
		
	}
	
	
}
