<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class User_information_model extends BF_Model {
		
		protected $table		= "user_information_";
		protected $key			= "id";
		protected $soft_deletes	= false;
		protected $date_format	= "datetime";
		protected $set_created	= false;
		protected $set_modified = false;
		
		public function  reduce_points($uid,$points)
		{ 	
			$row= $this->find_user_information_by_uid($uid,1);
			$current_points = $row ['user_information_current_points'];
			if ($current_points < $points ) return  -1 ;
			else
			{
				$row['user_information_current_points']=$current_points-$points;
				$where=array('user_information_user_id'=>$uid);
				$this->update_where($where,$row);
				return $row['user_information_current_points'];
			}
		}
		
		public function  add_points($uid,$vid)
		{
			
			$row= $this->find_user_information_by_uid($uid,1);
			$current_points = $row ['user_information_current_points'];
			$video_extra_info=$this->load->model('video_extra_information/video_extra_information_model')->find_by('video_extra_information_video_id',$vid);
		 	if ( $video_extra_info === false) return false;
			$points=$video_extra_info->video_extra_information_points;
			$row['user_information_current_points']=$current_points+$points;
			$where=array('user_information_user_id'=>$uid);
			$this->update_where($where,$row);
			return $row['user_information_current_points'];
		}
		
		public function  find_user_information_by_uid($uid,$return_type=0)
		{
			
			$row=$this->find_by('user_information_user_id',$uid,'and',$return_type);
			if ($row=== false)
			{ 
				$data=array('user_information_user_id'=>$uid,'user_information_current_points'=>0);
				$this->insert($data);
				$row=$this->find_by('user_information_user_id',$uid,'and',$return_type);
			}
			
			return $row;
		}
		
	}
