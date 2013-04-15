<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class company extends Admin_Controller {


	public function __construct() {
		parent::__construct();

		$this -> load -> library('form_validation');
		$this -> load -> model('company/company_model', null, true);
		$this -> load -> model('video_model', null, true);
		$this -> lang -> load('video');
	}
	
	public function upload_video() {
		
		
		Assets::add_module_js('company', 'jquery.form.js');
		Assets::add_js($this -> load -> view('inline_js/upload_video_ajax.js.php', null, true), 'inline');
		Assets::add_js($this -> load -> view('inline_js/set_video_info.js.php', null, true), 'inline');
		//Assets::add_js($this->load->view('inline_js/test_upload.js.php',null,true),'inline');
		template::set_theme('two_column');
		template::render();
	}
	
	public function video_transport() {
		$this -> load -> model('video/video_model');
		if ($this -> input -> is_ajax_request()) {
			$result = $this -> video_model -> save_video();
			$id = explode('<', $result, 1);
			if(!$id[0]) {
				echo 'error';
				return false;
			}else
			//echo '46';
			echo $id[0];
			die();
			return false;
		}
	}
	
	
	public function set_video_info($video_id = false) {

		if ($video_id === false) {
			template::set('msg', 'error');
			template::set_theme('two_column');
			template::set_view('company/operation_status');
			template::render();
			return;
		}

		$this -> load -> model('video/video_model');

		$result = $this -> video_model -> find_by('id', $video_id);
		//console::log($result);
		$video_company = false;
		if ($result !== false) {
			$video_company = $result -> video_company_id;
			//	console::log('company: '.$video_company);
		}

		$user_id = $this -> auth -> user_id();
		$company_object = $this -> company_model -> find_by('company_userid', $user_id);
		if(!$company_object) {
			template::set('msg', 'error');
			template::set_theme('two_column');
			template::set_view('company/operation_status');
			template::render();
			return false;
		}
		$user_company = $company_object->id;
		//console::log('company id: '.$user_company);
		if ($video_company !== $user_company) {//check if user has the correct company of video
			template::set('msg', 'error');
			Template::set_theme('two_column');
			template::set_view('company/operation_status');
			return;
		} else {
			//console::log(is_dir());
			/*
			if(!is_dir(!$result->video_path)){
				template::set('msg', 'error');
				template::set_theme('two_column');
				template::set_view('company/operation_status');
				template::render();
				return false;
			}*/
			$this->load->model('question/question_model');
			$this->load->model('answer/answer_model');
			$this->load->model('video_question/video_question_model');
					
			$question_results = $this->question_model->find_all();
			foreach ($question_results as $question_result){
				$answer_result = $this->answer_model->find_by('id',$question_result->question_answer_id);
				if($answer_result)
				$question_result->question_answer_contents = json_decode($answer_result->answer_content);
				/*
				foreach($question_result->question_answer_contents as $answer_content){
					console::log($answer_content);
				}*/
				//console::log($question_result);
			}	
			
			//console::log($question_results);
			$result->questions = $question_results;
			//console::log($result->questions);
			
			/*initialize question info*/
			$result -> ajax = 0;
			$selected_questions = false;
			$question_number = 2; 
			
			if (!$this -> input -> is_ajax_request()) {//if video is an old one
				Template::set_theme('two_column');
				$this->load->model("video_question/video_question_model");
				$selected_questions=$this->video_question_model->find_all_by('video_question_video_id',$video_id);
				//console::log($selected_questions);
				$question_number = count($selected_questions);
				//console::log($question_number);
				//console::log(array_keys($selected_questions));
				
			} else {//if video is newly uploaded
				$result -> ajax = 1;
			}
			
			
		/*	
			foreach($selected_questions as $index=>$selected_question){
				console::log($index);
				console::log($selected_question);
			}
		*/	
			$result->selected_questions = $selected_questions;
			$result->question_number = $question_number;
			//$path = base_url().'upload/video/'.$result->video_path;
			//
			
			$result->thumbnail = false;
			console::log("path: ".'./upload/video/'.$result->video_path.'thumbnail.jpg');
			if(file_exists('./upload/video/'.$result->video_path.'thumbnail.jpg'))
			$result->thumbnail = base_url().'upload/video/'.$result->video_path.'thumbnail.jpg';
			
			
			console::log($result);
			template::set('video_info', $result);
		}
		Assets::add_js($this -> load -> view('inline_js/set_video_info.js.php', null, true), 'inline');
		template::render();

	}
	
	public function check_video_company($video_id){
		$result = $this->video_model->find_by('id', $video_id);
		if(!$result)
			return false;
		$user_id = $this -> auth -> user_id();
		$company_object = $this -> company_model -> find_by('company_userid', $user_id);
		if(!$company_object)
			return false;
		if($result->video_company_id !== $company_object->id)
			return false;
		return $result;
	}
	
	public function update_video_info($video_id = false) {
		$result = $this -> check_video_company($video_id);

		template::set_theme('two_column');
		if ($result !== false || $this -> input -> post() !== false) {
			$video_data = array('video_title' => $this -> input -> post('video_title'), 'video_description' => $this -> input -> post('video_description'), );
			$this -> load -> model('video/video_model');
			$this -> video_model -> update($video_id, $video_data);
			template::set('msg', 'ok');
		} else {template::set('msg', 'error');
		}
		console::log($this->input->post());
		$thumbnail = $this->input->post('video_thumbnail');
		if($thumbnail['size']){
			//console::log("hehe");
			$path = $result->video_path;
			console::log($path);
			$info = $this->company_model->_upload_thumbnail('video_thumbnail', $path);
			console::log($info);
		}
		
		//initiation, might need helper in future
		$this->load->model('question/question_model');
		$this->load->model('answer/answer_model');
		$this->load->model('video_question/video_question_model');
		$this->db->where('video_question_video_id', $video_id);//delete old records
		$result = $this->db->delete('bf_video_question'); 
		
		for($question_count=1; $question_count<=2; $question_count++){
			
			if(!$this->input->post('question_type_'.$question_count)){
				if (!$this->input->post('question'.$question_count)) return false;
				$video_question_data = array('video_question_video_id'=>$video_id,'video_question_question_id'=>$this->input->post('question'.$question_count));
				$this->video_question_model->insert($video_question_data);
				console::log($video_question_data);
				
			}else{
				//group answer data
				for($answer_count=1; $answer_count<=4; $answer_count++){
					$answer_array[$answer_count] = $this->input->post('answer'.$question_count.'_'.$answer_count);
				}
				
				
				$answer_result = $this->answer_model->find_by('answer_content',json_encode($answer_array));//check if answer already exists
				if($answer_result)
					$answer_id = $answer_result->id;
				else{
					$answer_data = array('answer_content'=>json_encode($answer_array));
					$answer_id = $this->answer_model->insert($answer_data);
				}
				
				$question_result = $this->question_model->find_by('question_content',$this->input->post('question_type_'.$question_count));
				if($question_result)
					$question_id = $question_result->id;
				else{
					$question_content = $this->check_question($this->input->post('question_type_'.$question_count));
					$question_data = array("question_content"=>$question_content, "question_answer_id"=>$answer_id);
					$question_id = $this->question_model->insert($question_data);
				}
				
				$video_question_data = array('video_question_video_id'=>$video_id,'video_question_question_id'=>$question_id);
				$video_question_id = $this->video_question_model->insert($video_question_data);
				
				//console::log('answer_id: '.$answer_id);
				//console::log($answer_data);
			}
		}
		
		//console::log($this->input->post('question_type_'.$i));
		
		
		
		
		
		template::set_view('company/operation_status');
		template::render();
	}

	private function check_question($question_content){
		$last = $question_content[strlen($question_content)-1];
		if($last != '?'){
			$question_content .='?';
		}
		return $question_content;
	}

	

	public function video_manager(){
		$user_id = $this -> auth -> user_id();
		$company_object = $this -> company_model -> find_by('company_userid', $user_id);
		if(!$company_object) {
			template::set('msg', 'error');
			template::set_theme('two_column');
			template::set_view('company/operation_status');
			template::render();
			return false;
		}
		$user_company_id = $company_object->id;
		
		$this -> load -> model('video/video_model');
		$results = $this->video_model->find_all_by('video_company_id', $user_company_id);
		console::log($results);
		if($results){
			foreach ($results as $result){
				$result->thumbnail = $this->_get_thumbnail($result->video_path);
			}
		}
		template::set_theme('two_column');
		template::set('videos', $results);
		template::render();
	}

	public function _get_thumbnail($video_path){
		if(file_exists('./'.VIDEO_UPLOAD_PATH.$video_path.'thumbnail.jpg'))
			return base_url().VIDEO_UPLOAD_PATH.$video_path.'thumbnail.jpg';
		else
			return "";
	}


	
 	public function delete_video($video_id = false) {
		console::log("wtf");
		$video_object = $this->video_model -> find_by('id', $video_id);
		if ($video_object == false)
			template::set('msg', 'error');
		else {
			template::set('msg', 'ok');
			console::log($video_object);
			$path = $video_object->video_path;
			$this->delete_file($path);
			// $this -> load -> model('video/video_model');
			$this -> video_model -> delete($video_id);
			// $path = $company_name . '/' . $video_path . '/';
			$result = $this -> delete_file($path);
			// console::log($result);
			// delete_files($path);
			// console::log(site_url('upload/video') . '/' . $company_name . '/' . $video_path);
			// template::set('msg', 'ok');
		}

		template::set_theme('two_column');
		template::set_view('company/operation_status');
		template::render();
	} 

	private function delete_file($path) {
		//need to check dir
		console::log($path);
		$this -> config -> load('upload_video');
		$preference = read_config('upload_video', TRUE, 'company');
		$preference['upload_path'] = './' . VIDEO_UPLOAD_PATH . $path;
		$dirname = $preference['upload_path'];
		//$folder_handler = dir($dirname);
		//console::log($dirname);
		$this->load->helper('file');
		$dirname = substr($dirname, 0, -1);
		delete_files($dirname);
		// if (!(($files = @scandir($dir)) && count($files) <= 2)){
			// while ($file = $folder_handler -> read()) {
				// if ($file == "." || $file == "..")
					// continue;
					// unlink($dirname . $file);
			// }
			// $folder_handler -> close();
		// }
		console::log($dirname);
		if (is_dir($dirname)) {
			rmdir($dirname);
		}
		//return $dirname;
	}
	
}