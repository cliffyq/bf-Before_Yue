<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Video_model extends BF_Model {
		
		protected $table		= "video";
		protected $key			= "id";
		protected $soft_deletes	= false;
		protected $date_format	= "datetime";
		protected $set_created	= true;
		protected $set_modified = true;
		protected $created_field = "created_on";
		protected $modified_field = "modified_on";
		
		public function get_company_name($id='')
		{
			if ($this->_function_check($id) === FALSE)
			{
				return FALSE;
			}
			$company_id = $this->get_field($id,'video_company_id');
			$query = $this->db->get_where('bf_company', array('id' => $company_id), 1);
			if ($query && $query->num_rows() > 0)
			{
				return $query->row()->company_name;
			}
			
			return FALSE;
		}
		
		public function get_company($vid)
		{
			$row=$this->find_by('id',$vid);
			if ($row ===false) return false;
			$company=$this->load->model('company/company_model')->find_by('id',$row->video_company_id);
			if(strpos($company->company_url, 'http://')===false)
			{
				$company->company_url='http://'. $company->company_url;
			}
			return $company;
		}
		
		
		public function video_chart($option='viewcount',$time_filter="all",$limit = 0, $offset = 0)
		{
			$return = array('rows'=>array(),'row_count'=>0);
			
			if ($time_filter=='all') $time=0;
			
			else
			$time=strtotime("today-1".$time_filter);
			// orderby viewcount, other options should use DB query.
			//$query=$this->db->get_where($this->table,array('created_on >'=>$time));
			//$results = $query->result_array();
			
			$results=$this->find_all(1);
			if(!empty($results))
			{
				//$query=$this->find_all_by('created_on <',$time);
				//$results = $query->result_array();
				foreach ($results as $key=>&$result)
				{
					$result['viewcount']=$this->load->model('video_view_history/video_view_history_model')->get_view_count($result['id'],$time);
					$viewcount[$key]=$result['viewcount'];
					$return['row_count']++;
				}
				array_multisort($viewcount,SORT_DESC,$results);
				//$residue = $return['row_count'] - $offset*$limit;
				//$residue = $limit>$residue? $residue:$limit;
				$return['rows']=array_slice($results,$offset,$limit);
				
				return $return;
			}
			else
			return $return;
			
			
		}
		
		
		
	}
