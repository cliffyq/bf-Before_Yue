<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Video_view_history_model extends BF_Model {
		
		protected $table		= "video_view_history";
		protected $key			= "id";
		protected $soft_deletes	= false;
		protected $date_format	= "datetime";
		protected $set_created	= false;
		protected $set_modified = false;
		
		public function get_viewed_videos($uid)
		{
			
			$arr=array();
			$viewed_videos=$this->find_all_by('video_view_history_user_id',$uid);
			if  ( $viewed_videos !== false )
			{
				foreach ($viewed_videos as $row)
				{  
					$arr[]=$row->video_view_history_video_id;
				}
				$arr=array_unique($arr);
			}					
			return  $arr;
		}
		
		public function load_viewed_videos($payload)
		{
			if(!$this->auth->has_permission('Video_View_History.Remember',$payload['role_id'])) return false;
			$previous = $this->get_viewed_videos($payload['user_id']);
			$viewed_videos = array('previous'=>$previous,'new'=>array());
			$viewed_videos_json = json_encode($viewed_videos);
			$this->session->set_userdata('viewed_videos',$viewed_videos_json);		
		}
		public function get_view_count($vid,$time=0)
		{
			$request=array('video_view_history_video_id ='=>$vid,'video_view_history_created_on >'=>$time);
			return $this->count_by($request);
		}
		
	}
