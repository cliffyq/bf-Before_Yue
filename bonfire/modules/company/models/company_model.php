<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Company_model extends BF_Model {
		
		protected $table		= "company";
		protected $key			= "id";
		protected $soft_deletes	= false;
		protected $date_format	= "datetime";
		protected $set_created	= false;
		protected $set_modified = false;
		
		//fields:title,description,length,upload_time,view_count,average_rating
		public function get_video_info($video_id)
		{
			$return=array();
			$this->load->model('video/video_model', null, true);
			$this->load->model('video_view_history/video_view_history_model', null, true);
			$this->load->model('reviews/reviews_model', null, true);
			$video_info = $this->video_model->find_by('id', $video_id, 'and', 1);
			if($video_info === false) return false;
			$return['id'] = $video_info['id'];
			$return['title'] = $video_info['video_title'];
			$return['description']= $video_info['video_description'];
			$return['length']= $video_info['video_length'];
			$return['upload_time']= $video_info['created_on'];
			$return['view_count'] = $this->video_view_history_model->get_view_count($video_id);
			$return['average_rating'] = $this->reviews_model->average_rating($video_id)===false?"n/a":$this->reviews_model->average_rating($video_id);
			// Console::log(print_r($return,true));
			return $return;
		}
		
		//fields:gender,birth_month,birth_year,race,education,zipcode,time,ip
		public function get_view_history($video_id)
		{
			$return = array();
			$this->load->model('video_view_history/video_view_history_model', null, true);
			$this->load->model('user_info/user_info_model', null, true);
			$video_histories = $this->video_view_history_model->find_all_by('video_view_history_video_id', $video_id, 'and', 1);
			if($video_histories === false) return false;
			foreach($video_histories as $k=>$v)
			{
				$user_info = $this->user_info_model->get_user_info($v['video_view_history_user_id']);
				if($user_info!==false)
				{
					$return[$k]['gender'] = $user_info['user_info_gender']==1?'M':'F';
					$return[$k]['birth_month'] = $user_info['user_info_birth_month'];
					$return[$k]['birth_year'] = $user_info['user_info_birth_year'];
					$return[$k]['race'] = $user_info['user_info_race'];
					$return[$k]['education'] = $user_info['user_info_education'];
					$return[$k]['zipcode'] = $user_info['user_info_zipcode'];
				}
				else
				{
					$return[$k]['gender'] = '';
					$return[$k]['birth_month'] = '';
					$return[$k]['birth_year'] = '';
					$return[$k]['race'] = '';
					$return[$k]['education'] = '';
					$return[$k]['zipcode'] = '';
				}
				$return[$k]['time'] = date("Y-m-d h:j:s", $v['video_view_history_created_on']);
				$return[$k]['ip'] = $v['video_view_history_ip'];
			}
			// Console::log(print_r($return,true));
			return $return;
		}
		
		public function get_review_history($video_id)
		{
			$return = array();
			$this->load->model('reviews/reviews_model', null, true);
			$this->load->model('question/question_model', null, true);
			$this->load->model('answer/answer_model', null, true);
			$this->load->model('user_info/user_info_model', null, true);
			$video_reviews = $this->reviews_model->find_all_by('reviews_video_id', $video_id, 'and', 1);
			if($video_reviews === false) return false;
			foreach($video_reviews as $k=>$v)
			{
				$user_info = $this->user_info_model->get_user_info($v['reviews_user_id']);
				if($user_info!==false)
				{
					$return[$k]['gender'] = $user_info['user_info_gender']==1?'M':'F';
					$return[$k]['birth_month'] = $user_info['user_info_birth_month'];
					$return[$k]['birth_year'] = $user_info['user_info_birth_year'];
					$return[$k]['race'] = $user_info['user_info_race'];
					$return[$k]['education'] = $user_info['user_info_education'];
					$return[$k]['zipcode'] = $user_info['user_info_zipcode'];
				}
				else
				{
					$return[$k]['gender'] = '';
					$return[$k]['birth_month'] = '';
					$return[$k]['birth_year'] = '';
					$return[$k]['race'] = '';
					$return[$k]['education'] = '';
					$return[$k]['zipcode'] = '';
				}
				$return[$k]['time'] = date("Y-m-d h:j:s", $v['reviews_last_update']);
				$return[$k]['rating'] = $v['reviews_rating'];
				//display answers and questions
				$return[$k]['questions & answers'] = '';
				$answer_temp = json_decode($v['reviews_answers'], true);
				$answer_keys = array_values ($answer_temp);
				$question_keys = array_keys ($answer_temp);
				foreach($question_keys as $j=>$v)
				{
					$question = $this->question_model->find_by('id', $v, 'and', 1);
					$question_value = $question['question_content'];
					$answer_id = $question['question_answer_id'];
					$answer = $this->answer_model->find_by('id', $answer_id, 'and', 1);
					$answer_array = json_decode($answer['answer_content'], true);
					$answer_value = $answer_array[$answer_keys[$j]];
					$q_and_a = 'Q'.($j+1).':"'.$question_value.'",A'.($j+1).':"'.$answer_value.'",';
					$return[$k]['questions & answers'] .= $q_and_a;
				}
				
			}
			return $return;
		}
		
		public function create_company($data,$logo_fieldname='company_logo')
		{
			if(!is_array($data)||empty($data))
			return false;
			$path = url_title($data['company_name'],'underscore').'/';
			$fdata = $this->_upload_logo($logo_fieldname,$path);
			if(isset($fdata['error'])||!isset($fdata['upload_data']) || $fdata['upload_data'] == NULL){
				
				return FALSE;
			}
			$data['company_logo'] = $path;
			$id = $this->insert($data);
			if (!is_numeric($id)) return FALSE;
			return $id;
		}
		
		
		//--------------------------------------------------------------------
		//upload logo, $field_name = form input name, $path = path relative to the LOGO_PATH
		public function _upload_logo($field_name,$path){                
			$preference = read_config('upload_logo', TRUE, 'company');
			$preference['upload_path'] = './'.LOGO_PATH.$path;
			if(!is_dir($preference['upload_path']))
			{
				mkdir($preference['upload_path'],0777,true);
			}
			$this->load->library('upload',$preference);
			$this->error='';
			
			$this->load->helper('file');
			delete_files($preference['upload_path'] = './'.LOGO_PATH.$path);
			
			if ( ! $this->upload->do_upload($field_name))
			{
				$data['error'] = $this->upload->display_errors();
			}
			else
			{
				
				$data = array('upload_data' => $this->upload->data());
			}
			return $data;
		}
		
		public function _upload_thumbnail($field_name,$path){
			$preference = read_config('upload_thumbnail', TRUE, 'company');
			$preference['upload_path'] = './'.VIDEO_UPLOAD_PATH.$path;
			// if(!is_dir($preference['upload_path']))
			// {
				// mkdir($preference['upload_path'],0777,true);
			// }
			$this->load->library('upload',$preference);
			$this->error='';
			
			$this->load->helper('file');
			//unlink;
			$files = glob($preference['upload_path'].'thumbnail'.".*");
			foreach ($files as $file) {
			  unlink($file);
			}
			
			if ( ! $this->upload->do_upload($field_name))
			{
				$data['error'] = $this->upload->display_errors();
			}
			else
			{
				
				$data = array('upload_data' => $this->upload->data());
			}
			return $data;
		}
		
		
		
		
	}
	
	
