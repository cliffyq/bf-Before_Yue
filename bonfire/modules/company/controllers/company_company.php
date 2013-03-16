<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class company_company extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() {
		parent::__construct();

		$this -> load -> library('form_validation');
		$this -> load -> model('company_model', null, true);
		$this -> lang -> load('company');

	}

	//--------------------------------------------------------------------

	/*
	 Method: index()

	 Displays a list of form data.
	 */
	public function index() {

	}

	//--------------------------------------------------------------------
	public function get_logo($path) {
		$config = read_config('upload_logo', TRUE, 'company');
		$exts = explode("|",$config['allowed_types']);
		foreach ($exts as $ext) {
			$img = LOGO_PATH . $path . "logo." . $ext;
			if (file_exists("./" . $img))
				return base_url() . $img;
		}
		return '';
	}

	public function company_admin($company_id) {
		$company_data = $this -> company_model -> find_by('id', $company_id, 'and', 1);
		Template::set('company_data', $company_data);
		Template::set_theme('Two');
		Template::render();
	}

	public function company_list() {
		$records = $this -> company_model -> find_all();
		Template::set('records', $records);
		console::log(print_r($records, true));
		//Template::set('toolbar_title', 'Manage Company');
			Template::set_theme('two_column');
		Template::render();
	}

	public function video_list($company_id = 3) {
		$this -> load -> model('video/video_model', null, true);
		$videos = $this -> video_model -> find_all_by('video_company_id', $company_id, 'and', 1);
		if ($videos !== false) {
			Template::set('videos', $videos);
			Template::set_theme('Two');
			Template::render();
		} else {
		}
	}

	public function video_report($video_id) {
		Assets::add_js($this -> load -> view('inline_js/report.js.php', null, true), 'inline');
		$video_info = $this -> company_model -> get_video_info($video_id);
		$view_histories = $this -> company_model -> get_view_history($video_id);
		$review_histories = $this -> company_model -> get_review_history($video_id);
		console::log(print_r($review_histories, true));
		Template::set('video_info', $video_info);
		Template::set('view_histories', $view_histories);
		Template::set('review_histories', $review_histories);
		Template::set_theme('Two');
		Template::render();
	}

	public function export_csv($export_type, $video_id) {
		$this -> load -> helper('download');
		$info = $this -> company_model -> get_video_info($video_id);
		if ($export_type == 'view')
			$results = $this -> company_model -> get_view_history($video_id);
		if ($export_type == 'review')
			$results = $this -> company_model -> get_review_history($video_id);
		if ($results === false || $info === false)
			return false;
		$csv = '';
		//$infoheaderDisplayed = false;
		$csv .= $this -> echocsv(array_keys($info));
		$csv .= $this -> echocsv($info);
		$headerDisplayed = false;
		foreach ($results as $data) {
			// Add a header row if it hasn't been added yet
			if (!$headerDisplayed) {
				// Use the keys from $data as the titles
				$csv .= $this -> echocsv(array_keys($data));
				$headerDisplayed = true;
			}
			// Put the data into the stream
			$csv .= $this -> echocsv($data);
		}
		$name = $export_type . '_report_' . date("m-d-Y_His") . '.csv';
		force_download($name, $csv);
	}

	public function echocsv($fields) {
		$return = '';
		$separator = '';
		foreach ($fields as $field) {
			if (preg_match('/\\r|\\n|,|"/', $field)) {
				$field = '"' . str_replace('"', '""', $field) . '"';
			}
			$return .= $separator . $field;
			$separator = ',';
		}
		$return .= "\r\n";
		return $return;
	}

	public function video_uploading() {
		
		
		
		Assets::add_module_js('company', 'jquery.form.js');
		Assets::add_js($this -> load -> view('inline_js/upload_video_ajax.js.php', null, true), 'inline');
		//Assets::add_js($this->load->view('inline_js/test_upload.js.php',null,true),'inline');
		template::set_theme('two_column');
		template::render();
	}

	public function video_transport() {
		$this -> load -> model('video/video_model');
		if ($this -> input -> is_ajax_request()) {
			$id = $this -> video_model -> video_saving();
			if(!$id) {
				echo 'error';
			}else
			echo $id;
		}
	}

	public function video_info_setting($video_id = false) {

//		$company_result	
		if ($video_id === false) {
			template::set('msg', 'error');
			template::set_theme('two_column');
			template::set_view('company_company/operation_status');
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
			template::set_view('company_company/operation_status');
			template::render();
			return false;
		}
		$user_company = $company_object->id;
		//console::log('company id: '.$user_company);
		if ($video_company !== $user_company) {//check if user has the correct company of video
			template::set('msg', 'error');
			Template::set_theme('two_column');
			template::set_view('company_company/operation_status');
			return;
		} else {
			//console::log(is_dir());
			/*
			if(!is_dir(!$result->video_path)){
				template::set('msg', 'error');
				template::set_theme('two_column');
				template::set_view('company_company/operation_status');
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
				console::log($selected_questions);
				$question_number = count($selected_questions);
				console::log($question_number);
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
			console::log($result);
			Assets::add_js($this -> load -> view('inline_js/set_video_info.js.php', null, true), 'inline');
			template::set('video_info', $result);
		}
		template::render();

	}

	
	//check if a user has permission to access the specified video
	public function user_has_permision_to_video($vid=false,$uid=false)
	{
		if($vid===false) return false;
		if($uid===false) $uid = $this -> auth -> user_id();
	
		$this -> load -> model('video/video_model');

		$company = $this -> video_model -> get_company($vid);
		if ($company === false) return false;
		return $company->company_userid == $uid;
	}
	
	
	public function video_info_updating($video_id = false, $company_name = false, $video_path = false) {
		$result = $this -> video_company_checking($video_id, $company_name, $video_path);

		template::set_theme('two_column');
		if ($result !== false || $this -> input -> post() !== false) {
			$video_data = array('video_title' => $this -> input -> post('video_title'), 'video_description' => $this -> input -> post('video_description'), );
			$this -> load -> model('video/video_model');
			$this -> video_model -> update($video_id, $video_data);
			template::set('msg', 'ok');
		} else {template::set('msg', 'error');
		}
		console::log($this->input->post());
		
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
					$question_data = array("question_content"=>$this->input->post('question_type_'.$question_count), "question_answer_id"=>$answer_id);
					$question_id = $this->question_model->insert($question_data);
				}
				
				$video_question_data = array('video_question_video_id'=>$video_id,'video_question_question_id'=>$question_id);
				$video_question_id = $this->video_question_model->insert($video_question_data);
				
				//console::log('answer_id: '.$answer_id);
				//console::log($answer_data);
			}
		}
		
		//console::log($this->input->post('question_type_'.$i));
		
		
		
		
		
		template::set_view('company_company/operation_status');
		template::render();
	}

	private function video_company_checking($video_id = false, $company_name = false, $video_path = false) {//check whether the video belongs to this company
		$this -> load -> model('video/video_model');
		$user_company = false;
		$path = $company_name . '/' . $video_path . '/';
		$user_id = $this -> auth -> user_id();
		$company_object = $this -> company_model -> find_by('company_userid', $user_id);
		if($company_object != false){
			$user_company = $company_object->id;
		}
		//check if this video belongs to this user
		$result = $this -> video_model -> find_all_by(array('id' => $video_id, 'video_company_id' => $user_company, 'video_path' => $path));
		return $result;
	}

	public function video_manager(){
		$user_id = $this -> auth -> user_id();
		$company_object = $this -> company_model -> find_by('company_userid', $user_id);
		if(!$company_object) {
			template::set('msg', 'error');
			template::set_theme('two_column');
			template::set_view('company_company/operation_status');
			template::render();
			return false;
		}
		$user_company_id = $company_object->id;
		
		$this -> load -> model('video/video_model');
		$results = $this->video_model->find_all_by('video_company_id', $user_company_id);
		//console::log($results);
		template::set_theme('two_column');
		template::set('videos', $results);
		template::render();
	}


	public function video_deleting($video_id = false, $company_name = false, $video_path = false) {
		$result = $this -> video_company_checking($video_id, $company_name, $video_path);
		if ($result !== false || $this -> input -> post() !== false) {
			$this -> load -> model('video/video_model');
			$this -> video_model -> delete($video_id);
			$path = $company_name . '/' . $video_path . '/';
			$this -> file_deleting($path);
			console::log(site_url('upload/video') . '/' . $company_name . '/' . $video_path);
			template::set('msg', 'ok');
		} else {template::set('msg', 'error');
		}

		Template::set_theme('two_column');
		template::set_view('company_company/operation_status');
		template::render();
	}

	private function file_deleting($path) {
		if(!is_dir($path))
		return false;
		$this -> config -> load('upload_video');
		$preference = read_config('upload_video', TRUE, 'company');
		$preference['upload_path'] = './' . VIDEO_UPLOAD_PATH . $path;
		$dirname = $preference['upload_path'];
		$folder_handler = dir($dirname);
		if (!(($files = @scandir($dir)) && count($files) <= 2)){
		while ($file = $folder_handler -> read()) {
			if ($file == "." || $file == "..")
				continue;
			unlink($dirname . $file);
		}
		$folder_handler -> close();
		}
		rmdir($dirname);
	}

	public function video_charts($sort_option = "viewcount",$time_filter='all',$per_page = 6, $offset = 0)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'company/company_company/video_charts/'.$sort_option.'/'.$time_filter.'/'.$per_page.'/';
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 7;
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
			
		switch($sort_option)
		{
				case 'viewcount': $selection['sort']['text']='Most Viewed';break;
				case 'toprated': $selection['sort']['text']='Top Rated';break;
		}
		$selection['sort']['data']=$sort_option;
			
			
		switch($time_filter)
		{
			case 'day': $selection['timefilter']['text']='Today';break;
			case 'week': $selection['timefilter']['text']='This Week';break;
			case 'month': $selection['timefilter']['text']='This Month';break;
			case 'all': $selection['timefilter']['text']='All';break;
		}
		$selection['timefilter']['data']=$time_filter;
			
			
		$this->pagination->initialize($config);
			
		$this->load->model('video/video_model', null, true);
		$video_cards = $this->video_model->video_chart($sort_option,$time_filter,$config['per_page'], $this->uri->segment($config['uri_segment']));
		//$data['rows'] = $video_cards['rows'];
		$config['total_rows'] = $video_cards['row_count'];
			//console::log($video_cards);
			
			
		$this->pagination->initialize($config);
		$video_cards['pagination_links'] = $this->pagination->create_links();
		Assets::add_js($this->load->view('inline_js/video_charts_pag_ajax.js.php',null,true),'inline');
		$videos=array();
		foreach($video_cards['rows'] as $key=>$video_card)
			//console::log($video_card);
		{
			$videos[$key]=$this->load->module('video')->video_card($video_card,$key+$offset);
			//console::log($video_card);
		}
		Template::set('video_cards',$videos);
		Template::set('selection',$selection);
			
		// Template::set('rows',$video_cards['rows']);
		Template::set('pagination_links',$video_cards['pagination_links']);
		Assets::add_module_css('company','video_charts.css');
			
		if ($this->input->is_ajax_request()) {

			Template::set_view('company_company/video_charts_ajax');
			Template::render();

			//template::redirect('/');
	}
		else

			Template::set_theme('two_column');
		Template::render();
			
			
			
			
		//Template::Render();
	}
}
