<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class video_view_history extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
			
		$this->load->library('form_validation');
		$this->load->model('video_view_history_model', null, true);
		$this->lang->load('video_view_history');
			
	}

	//--------------------------------------------------------------------

	/*
	 Method: index()

	Displays a list of form data.
	*/
	public function index()
	{
	}

	//--------------------------------------------------------------------

	public function add_viewed_video()
	{
		$vid = $this->input->get('vid');
		if($vid === false) return;
		if($this->auth->has_permission('Video_View_History.Remember'))
			$this->session->session_set_viewed_video($vid);
		$data=array('video_view_history_video_id'=>$vid,'video_view_history_user_id'=>$this->auth->user_id(),'video_view_history_ip'=>$this->input->ip_address(),'video_view_history_created_on'=>time());
		$this->video_view_history_model->insert($data);
	}
}