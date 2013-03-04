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



	public function find_max_id()
	{
		$this->db->select_max('id');
		return $this->find_all();
	}

	public function video_saving() {
		$path = $this->_set_video_path();
		$this->config->load('upload_video');
		$preference = read_config('upload_video', TRUE, 'company');
		$preference['upload_path'] = './'.VIDEO_UPLOAD_PATH.$path;
		//console::log($preference['upload_path']);
		$preference['allowed_types'] = $this->config->item('allowed_types');
		$preference['file_name'] = $this->config->item('file_name');
		if(!is_dir($preference['upload_path']))
		{
			mkdir($preference['upload_path'],0777,true);
		}
		$this->load->library('upload',$preference);
		$this->error='';
		//$file=$this->input->post('video_name');
		console::log('preference:'.print_r($preference,true));
		//console::log($video_file);
		//console::log($data);
		//if ( ! $this->upload->do_upload('video_file'))
		if ( ! $this->upload->do_upload())

		{
			$error = $this->upload->display_errors();
			//$status = 'error';
			//$error = $this->upload->display_errors('', '');
			rmdir($preference['upload_path']);
			//console::log($data);
			return $error;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->model('company/company_model');
			$user_id = $this->auth->user_id();
			$company_id = $this->company_model->find_by('company_userid', $user_id)->id;
			$video_data = array(
					'video_title' => 'need a title',
					'video_company_id' => $company_id,
					'video_description' => 'need a description',
					'video_length' => NULL,
					'video_path' => $path,

			);
			$id = $this->video_model->insert($video_data);
			return $id;
		}
	}

	private function _set_video_path()
	{
		$this->load->model('company/company_model');
		$this->load->helper('base64');
		$user_id = $this->auth->user_id();
		$company_dir = $this->company_model->find_by('company_userid',$user_id)->company_name;
		$time = new DateTime();
		$timestamp = $time->getTimestamp();
		$video_dir = urlsafe_b64encode(hash('crc32b',$timestamp));
		$path = $company_dir.'/'.$video_dir.'/';
		return $path;
		//$this->video_setting_info

	}
}
