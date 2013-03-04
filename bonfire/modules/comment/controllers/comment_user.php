<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class comment_user extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
		//$this->auth->restrict('Comment.User.View');
		$this->load->library('form_validation');
		$this->load->model('comment_model', null, true);
		$this->lang->load('comment');
			
	}

	//--------------------------------------------------------------------



	/*
	 Method: index()

	*/
	public function index()
	{
		Template::set('toolbar_title', 'comment/user');
		Template::render();
	}

	//--------------------------------------------------------------------
	/*
		public function ajax_call (){
	if (isset($_POST['ajax'])){
	$vid = $this->input->post('video_id');
	$per_page = $this->input->post('per_page');
	$offset = $this->input->post('offset');
	//				echo $vid.$per_page.$offset;
	$comment_panel = $this->comment_panel ($vid, $per_page, $offset);
	//				Template::set('comment_panel',$comment_view);
	//				Template::render();

	$this->load->view('comment_user/comment_panel_ajax', $comment_panel);
	}
	}
	*/
}
