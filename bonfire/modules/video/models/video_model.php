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
			
			$results=$this->find_all(1);
			
			if(!empty($results))
			{	
				//time filter
				if ($time_filter=='all') $time=0;
				else
				$time=strtotime("today-1".$time_filter);
				
				
				foreach ($results as $key=>&$result)
				{
					switch($option)
					{
						case 'viewcount': $result[$option]=$this->load->model('video_view_history/video_view_history_model')->get_view_count($result['id'],$time);break;
						case 'toprated': $result[$option]=$this->load->model('reviews/reviews_model')->average_rating($result['id'],$time);break;
					}
					
					$viewcount[$key]=$result[$option];
					$return['row_count']++;
					
				}
				
				
				array_multisort($viewcount,SORT_DESC,$results);
				
				$return['rows']=array_slice($results,$offset,$limit);
				
				return $return;
			}
			else
			return $return;
			
			
			}
		
		
		
	}
