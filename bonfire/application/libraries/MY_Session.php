<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Session extends CI_Session
{
	public $CI;

	function __construct($config = array())
	{
		parent::__construct($config);
	}

	function session_load_prev_reviews($uid)
	{
		$this->CI->load->model('reviews/reviews_model');
		$previous = $this->CI->reviews_model->get_reviews($uid);
		$reviewed = array('previous'=>$previous,'new'=>array());
		$reviewed_json = json_encode($reviewed);
		$this->set_userdata('reviewed',$reviewed_json);
	}

	function session_set_review($arr)
	{
		if(!$this->CI->auth->has_permission('Reviews.Remember')) return false;
		$arr['ts'] = time();
		$reviewed = json_decode($this->userdata('reviewed'), true);
		if(isset($reviewed['new']))
		{
			foreach($reviewed['new'] as $k=>$v)
			{
				if ($v['vid']==$arr['vid'])
				{
					$arr['update'] = 1;
					$reviewed['new'][$k] = $arr;
					$this->set_userdata('reviewed',json_encode($reviewed));
					return 'update';
				}
					
			}
		}
		if(isset($reviewed['previous']))
		{
			foreach($reviewed['previous'] as $k=>$v)
			{
				if ($v['vid']==$arr['vid'])
				{
					$arr['update'] = 1;
					$reviewed['new'][] = $arr;
					unset($reviewed['previous'][$k]);
					$this->set_userdata('reviewed',json_encode($reviewed));
					return 'update';
				}
			}
		}
			
		$reviewed['new'][] = $arr;
		$this->set_userdata('reviewed',json_encode($reviewed));
		return 'insert';
	}

	//return previous review or false if not found
	function session_get_review_by_vid($vid)
	{
		$reviewed = $this->userdata('reviewed');
		if ($reviewed !== false){
			$reviews = json_decode($reviewed, true);
			if(isset($reviews['new']))
			{
				foreach ($reviews['new'] as $row)
				{
					if($row['vid'] == $vid)
					{
						return $row;
					}
				}
			}
			if(isset($reviews['previous']))
			{
				foreach ($reviews['previous'] as $row)
				{
					if($row['vid'] == $vid)
					{
						return $row;
					}
				}
			}

		}
		return false;
	}
	/*
	 function session_store_reviews()
	 {
	$update = array();
	$insert = array();
	$reviewed_json = $this->userdata('reviewed');
	$reviewed = json_decode($reviewed_json,true);
	if(empty($reviewed['new'])) return;
	$uid = $this->userdata('user_id');
	$this->CI->load->model('reviews/reviews_model');
	foreach($reviewed['new'] as $v)
	{
	if(isset($v['update']))
	{//update here because update_batch doesn't allow multiple where
	$where = array('reviews_video_id'=>$v['vid'],'reviews_user_id'=>$uid);
	$update = array('reviews_answers'=>json_encode($v['ans']),'reviews_rating'=>$v['score'],'reviews_last_update'=>$v['ts']);
	if(isset($v['cid'])) $update['reviews_comment_id'] = $v['cid'];
	$r = $this->CI->reviews_model->update_where($where, $update);
	}

	else
		$insert[] = array('reviews_video_id'=>$v['vid'],'reviews_user_id'=>$uid,'reviews_answers'=>json_encode($v['ans']),'reviews_rating'=>$v['score'],'reviews_comment_id'=>isset($v['cid'])?$v['cid']:null,'reviews_last_update'=>$v['ts']);
	}
	if(!empty($insert))
		$this->CI->reviews_model->insert_batch($insert);
	}*/
	function session_load_viewed_videos($uid)
	{
		$this->CI->load->model('video_view_history/video_view_history_model');
		$previous = $this->CI->video_view_history_model->get_viewed_videos($uid);
		$viewed_videos = array('previous'=>$previous,'new'=>array());
		$viewed_videos_json = json_encode($viewed_videos);
		$this->set_userdata('viewed_videos',$viewed_videos_json);
	}

	function session_set_viewed_video($vid)
	{
		if(!$this->CI->auth->has_permission('Video_View_History.Remember')) return false;
		$viewed_videos = json_decode($this->userdata('viewed_videos'), true);
		if(isset($viewed_videos['new']))
		{
			foreach($viewed_videos['new'] as $v)
			{
				if ($v == $vid)
				{
					return false;
				}
			}
		}
		if(isset($viewed_videos['previous']))
		{
			foreach($viewed_videos['previous'] as $v)
			{
				if ($v == $vid)
				{
					return false;
				}
			}
		}
		$viewed_videos['new'][] = $vid;
		$this->set_userdata('viewed_videos',json_encode($viewed_videos));
		return true;
	}

	//return previous viewed video or false if not found
	function session_get_viewed_video($vid)
	{
		$viewed_videos_json = $this->userdata('viewed_videos');
		if ($viewed_videos_json !== false ){
			$viewed_videos = json_decode($viewed_videos_json, true);
			if(isset($viewed_videos['new']))
			{
				foreach ($viewed_videos['new'] as $row)
				{
					if($row == $vid)
					{
						return $row;
					}
				}
			}
			if(isset($viewed_videos['previous']))
			{
				foreach ($viewed_videos['previous'] as $row)
				{
					if($row == $vid)
					{
						return $row;
					}
				}
			}

		}
		return false;
	}
	//   Don't use this funciton right now,  information is storeed in database directly  immediately
	function session_store_viewed_videos()
	{
			
		$data = array();
		$viewed_videos_json = $this->userdata('viewed_videos');
		$viewed_videos = json_decode($viewed_videos_json,true);
		if(empty($viewed_videos['new'])) return;
		$uid = $this->userdata('user_id');
		$this->CI->load->model('video_view_history/video_view_history_model');
		foreach($viewed_videos['new'] as $v)
		{
			$data[] = array('video_view_history_video_id'=>$v['vid'],'video_view_history_user_id'=>$uid,'video_view_history_ip'=>$this->CI->input->ip_address(),'video_view_history_created_on'=>$v['ts']);
		}
		if(!empty($data))
			$this->CI->video_view_history_model->insert_batch($data);
	}
}