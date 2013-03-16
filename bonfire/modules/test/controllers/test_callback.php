<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class test_callback extends Admin_Controller {
		
		public function __construct()
		{
			parent::__construct();
			
			
		}
		
		
		public function index()
		{
			Assets::add_js($this->load->view('inline_js/callback.js.php',null,true),'inline');
			template::set_theme('test_upload');
			template::render();
		}
		
		public function call()
		{
			$this->load->model('question/question_model');
			$this->load->model('answer/answer_model');
			$this->load->model('video_question/video_question_model');
			$question_results = $this->question_model->find_all();				
			foreach ($question_results as $question_result){
				$answer_result = $this->answer_model->find_by('id',$question_result->question_answer_id);
				if($answer_result)
				$question_result->question_answer_contents = json_decode($answer_result->answer_content);
				foreach($question_result->question_answer_contents as $answer_content){
					console::log($answer_content);
				}
				//console::log($question_result);
			}			 
			//console::log("result: ".$result);
		}
		
		public function response()
		{
			for($count = 1;$count<=4; $count++){
				$result[$count]= $this->input->post('answer1_'.$count);
			}
			console::log(json_encode($result));
			template::render();
		}
		
	}
