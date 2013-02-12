<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Video_question_model extends BF_Model {
		
		protected $table		= "video_question";
		protected $key			= "id";
		protected $soft_deletes	= false;
		protected $date_format	= "datetime";
		protected $set_created	= false;
		protected $set_modified = false;
		
		//get the quiestions from video_questions table, you can also pass a second parameter(array) to specify the questions to be added.if there is an error, the default questions will be added
		public function get_video_questions($vid,$qid_array=false)
		{
			$return = array();
			if(!is_array($qid_array))
			{
				$qid_array = array();
				$result = $this->find_all_by('video_question_video_id', $vid, 'and');
				if($result !== false)
				{
					foreach($result as $row)
					{
						$qid_array[] = $row->video_question_question_id;
					}
				}				
			}
			if(!empty($qid_array))
			{
				foreach($qid_array as $qid)
				{
					$question = $this->load->model('question/question_model')->get_question($qid);
					if($question !== false)
					$return[] = $question;
				}
			}
			if(empty($return))
			{
				$config = module_config('video_question');
				foreach($config['default_questions'] as $qid)
				{
					$question = $this->load->model('question/question_model')->get_question($qid);
					if($question !== false)
					$return[] = $question;
				}
			}
			return $return; 
		}
	}
