<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reviews_model extends BF_Model {

	protected $table		= "reviews";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;


	public function get_reviews($user_id)
	{
		$return = array();
		$query= $this->find_all_by('reviews_user_id',$user_id);
		if ($query !==  FALSE)
		{
			foreach ($query as $row)
			{
				$return[]= array('score'=> $row->reviews_rating, 'vid'=>$row->reviews_video_id ,'ans'=>json_decode($row->reviews_answers,true));
			}
		}
		return $return;
	}

	public function has_viewed($video_id,$user_id)
	{
		$this->load->model('video_view_history/video_view_history_model');
		return $this->video_view_history_model->find_by(array('video_view_history_video_id ' => $video_id, 'video_view_history_user_id' => $user_id))===false?false:true;
	}

	public function average_rating($vid)
	{
		$arr=array();
		$obj=$this->find_all_by('reviews_video_id',$vid);
		if($obj === false) return false;
		foreach ($obj as $v)
		{
			$arr[]= $v->reviews_rating;
		}
		if(empty($arr)) return false;
		$rating= round(array_sum($arr)/count($arr),2);
		return $rating;
	}

	public function load_prev_reviews($payload)
	{
		if(!$this->auth->has_permission('Reviews.Remember',$payload['role_id'])) return false;
		$previous = $this->get_reviews($payload['user_id']);
		$reviewed = array('previous'=>$previous,'new'=>array());
		$reviewed_json = json_encode($reviewed);
		$this->session->set_userdata('reviewed',$reviewed_json);
	}
}
