<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reviews_user extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
		$this->auth->restrict('Reviews.User.View');
		$this->load->library('form_validation');
		$this->load->model('reviews_model', null, true);
		$this->lang->load('reviews');
			
	}

	//--------------------------------------------------------------------



	/*
	 Method: index()

	*/
	public function index()
	{
		Template::set('toolbar_title', 'Reviews/user');
		Template::render();
	}

	//--------------------------------------------------------------------

	public function rating($video_id)
	{
		$viewed_video=$this->session->userdata['viewed_videos'];
		$data['video_id']=$video_id;
		$data['post_button_class'] = (in_array($video_id, $viewed_video['previous'])||in_array($video_id, $viewed_video['new']))?'':'disabled';
		$this->load->view('rating',$data);
	}

	/*public function rating_ajax()
	 {//incline js, for submit button and displaying stars
	return $this->load->view('rating.js.php',null,true);
	}*/

	public function review_submit()
	{
		$this->auth->restrict('Reviews.User.Create');
			
		$review = $this->input->post('review');
		$comment = $this->input->post('comment');
		//need a better validation function
		if(isset($review['score']) && isset($review['ans']) && isset($review['vid']))
		{
			$ts = time();
			//todo
			$cid = '1';
			//TODO: check if comment is modified, add cid to $review
			//echo '0';
			$action = $this->session->session_set_review($review);
			if($action == 'insert')
			{
				$insert =  array('reviews_video_id'=>$review['vid'],'reviews_user_id'=>$this->auth->user_id(),'reviews_answers'=>json_encode($review['ans']),'reviews_rating'=>$review['score'],'reviews_comment_id'=>isset($cid)?$cid:null,'reviews_last_update'=>$ts);
				$this->reviews_model->insert($insert);
				$this->load->model('user_information/user_information_model')->add_points($this->auth->user_id(),$review['vid']);
			}
			elseif($action == 'update')
			{
				$where = array('reviews_video_id'=>$review['vid'],'reviews_user_id'=>$this->auth->user_id());
				$update = array('reviews_answers'=>json_encode($review['ans']),'reviews_rating'=>$review['score'],'reviews_last_update'=>$ts);
				if(isset($cid)) $update['reviews_comment_id'] = $cid;
				$this->reviews_model->update_where($where, $update);
			}
			echo true;
		}
		else echo 'Please comnplete all fields.';
	}

	private function has_reviewed($vid = 0)
	{
		$reviews = $this->session->userdata('reviewed_videos');
		foreach ($reviews['new'] as $row)
		{
			if($row['video_id'] == $vid)
				return TRUE;
		}
		foreach ($reviews['re_previous'] as $row)
		{
			if($row['video_id'] == $vid)
				return TRUE;
		}
		return FALSE;
	}

}