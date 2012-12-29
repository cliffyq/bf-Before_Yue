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
		
		//fields:gender,birth_month,birth_year,race,education,occupation,zipcode,time,ip
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
					$return[$k]['occupation'] = $user_info['user_info_occupation_id'];
				}
				else
				{
					$return[$k]['gender'] = '';
					$return[$k]['birth_month'] = '';
					$return[$k]['birth_year'] = '';
					$return[$k]['race'] = '';
					$return[$k]['education'] = '';
					$return[$k]['zipcode'] = '';
					$return[$k]['occupation'] = '';
				}
				$return[$k]['time'] = date("Y-m-d h:j:s", $v['video_view_history_created_on']);
				$return[$k]['ip'] = $v['video_view_history_ip'];
			}
			// Console::log(print_r($return,true));
			return $return;
		}
		
	}
