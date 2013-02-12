<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Question_model extends BF_Model {
		
		protected $table		= "question_";
		protected $key			= "id";
		protected $soft_deletes	= false;
		protected $date_format	= "datetime";
		protected $set_created	= false;
		protected $set_modified = false;
	
		public function get_question($q_id)
		{
			$question=$this->find($q_id);
			if ( $question === false) return false;
			$return['question']=$question->question_content;
			
			$this->load->model('answer/answer_model',null,true);
			$answer=$this->answer_model->find($question->question_answer_id);
			if($answer === false) return false;
			$json_ans=$answer->answer_content;
			$return['answer'] = json_decode($json_ans,true);
			$return['q_id']=$q_id;
			return $return;
		}
	}
