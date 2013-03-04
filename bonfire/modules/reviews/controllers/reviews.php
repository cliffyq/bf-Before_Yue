<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reviews extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
			
		$this->load->library('form_validation');
		$this->load->model('reviews_model', null, true);
		$this->lang->load('reviews');
			
	}

	//--------------------------------------------------------------------



	/*
	 Method: index()

	Displays a list of form data.
	*/
	public function index()
	{
			
		$records = $this->reviews_model->find_all();
			
		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------

	public function avg_rating($vid)
	{
			
		$data['avg'] = $this->reviews_model->average_rating($vid);
		Assets::add_module_js('reviews','jquery.raty.js');
		Assets::add_js($this->load->view('inline_js/avg_rating.js.php',null,true),'inline');
		return $this->load->view('avg_rating',$data, true);
	}

	public function _review_panel($vid)
	{
		if (empty($vid))
		{
			Template::set_message('No video id', 'error');
			show_404();
		}
		$data['vid'] = $vid;
		$previous_review = $this->session->session_get_review_by_vid($vid);
		if($previous_review !== false)
		{
			$data['score'] = $previous_review['score'];
			$qid_list = array_keys($previous_review['ans']);
			$data['questions'] = $this->load->model('video_question/video_question_model')->get_video_questions($vid,$qid_list);
			$data['prev_answers'] = $previous_review['ans'];
			//load accordion
			$data['class_collapse'] = 'in';
			$data['button_text'] = 'Show Review';
			$data['has_reviewed'] = true;
		}
		else
		{
			$data['questions'] = $this->load->model('video_question/video_question_model')->get_video_questions($vid);
			$data['button_text'] = 'Hide Review';
			$data['has_reviewed'] = false;
		}
		$data['is_logged_in'] = $this->auth->is_logged_in();
		$data['questions'] = $this->load->model('video_question/video_question_model')->get_video_questions($vid);
		Assets::add_module_js('reviews','jquery.raty.js');
		Assets::add_js($this->load->view('inline_js/rating.js.php',null,true),'inline');
		Assets::add_js($this->load->view('inline_js/review_collapse.js.php',null,true),'inline');
		return $this->load->view('_review_panel',$data, true);
	}
}