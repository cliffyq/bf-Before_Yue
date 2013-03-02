<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class company_company extends Admin_Controller {
		
		//--------------------------------------------------------------------
		
		
		public function __construct()
		{
			parent::__construct();
			
			$this->load->library('form_validation');
			$this->load->model('company_model', null, true);
			$this->lang->load('company');

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
		public function get_logo($path)
		{
			$this->config->load('upload');
			$exts = explode("|",$this->config->item('allowed_types'));
			foreach ($exts as $ext)
			{
				$img = LOGO_PATH.$path."logo.".$ext;
				if(file_exists("./".$img))
				return base_url().$img;
			}
			return '';
		}
		
		public function company_admin($company_id)
		{		
			$company_data = $this->company_model->find_by('id', $company_id, 'and', 1);
			Template::set('company_data', $company_data);
			Template::set_theme('Two');
			Template::render();			
		}
		public function company_list()
		{
			$records = $this->company_model->find_all();
			Template::set('records', $records);
			console::log(print_r($records,true));
			//Template::set('toolbar_title', 'Manage Company');
			Template::set_theme('Two');
			Template::render();
		}
		public function video_list($company_id = 3)
		{
			$this->load->model('video/video_model', null, true);
			$videos = $this->video_model->find_all_by('video_company_id', $company_id, 'and', 1);			
			if($videos !== false){
				Template::set('videos', $videos);
				Template::set_theme('Two');
				Template::render();
			}		
			else{
			}
		}
		
		
		public function video_report($video_id)
		{
			Assets::add_js($this->load->view('inline_js/report.js.php',null,true),'inline');
			$video_info = $this->company_model->get_video_info($video_id);
			$view_histories = $this->company_model->get_view_history($video_id);
			$review_histories = $this->company_model->get_review_history($video_id);
			console::log(print_r($review_histories,true));
			Template::set('video_info', $video_info);
			Template::set('view_histories', $view_histories);
			Template::set('review_histories', $review_histories);	
			Template::set_theme('Two');
			Template::render();
		}
		
		public function export_csv($export_type,$video_id)
		{
			$this->load->helper('download');
			$info = $this->company_model->get_video_info($video_id);
			if($export_type == 'view')
			$results = $this->company_model->get_view_history($video_id);
			if($export_type == 'review')
			$results = $this->company_model->get_review_history($video_id);
			if($results === false||$info===false) return false;
			$csv = '';
			//$infoheaderDisplayed = false;
			$csv.=$this->echocsv(array_keys($info));  
			$csv.=$this->echocsv($info);  
			$headerDisplayed = false;
			foreach ( $results as $data ) {
				// Add a header row if it hasn't been added yet
				if ( !$headerDisplayed ) {
					// Use the keys from $data as the titles
					$csv.=$this->echocsv(array_keys($data));  
					$headerDisplayed = true;
				}
				// Put the data into the stream
				$csv.=$this->echocsv($data);  
			}
			$name = $export_type.'_report_'.date("m-d-Y_His").'.csv';
			force_download($name, $csv);
		}
		public function echocsv($fields)
		{
			$return='';
			$separator = '';
			foreach ($fields as $field) {
				if (preg_match('/\\r|\\n|,|"/', $field)) {
					$field = '"' . str_replace('"', '""', $field) . '"';
				}
				$return.= $separator . $field;
				$separator = ',';
			}
			$return.= "\r\n";
			return $return;
		}
		public function video_uploading()
		{
			
			Assets::add_js($this->load->view('inline_js/upload_video_ajax.js.php',null,true),'inline');
			//Assets::add_js($this->load->view('inline_js/test_upload.js.php',null,true),'inline');		
			template::set_theme('two column');
			template::render();
		}
		
		
		
		public function video_transport()
		{
			$this->load->model('video/video_model');
			if ($this->input->is_ajax_request()){
				$id = $this->video_model->video_saving();
				echo $id;
			}
		}
		

		
		
		public function video_info_setting($video_id=false)
		{
			
			if($video_id == false){
				echo 'error!';
			}
			else{
						
				$this->load->model('video/video_model');
				
				$result = $this->video_model->find_by('id', $video_id);
				//console::log($result);
				$video_company = false;
				if ($result !== false){
					$video_company = $result->video_company_id;
				//	console::log('company: '.$video_company);
				}
					
				$user_id = $this->auth->user_id();
				$user_company = $this->company_model->find_by('company_userid', $user_id)->id;
				//console::log('company id: '.$user_company);
				if($video_company !== $user_company){//check if user has the correct company of video
					template::set('error', "Wrong company, don't be a cheater!");
					Template::set_theme('two column');
				}
				else {
					$result->ajax = 0;
					if(!$this->input->is_ajax_request()){
						Assets::add_js($this->load->view('inline_js/set_video_info.js.php',null,true),'inline');
						Template::set_theme('two column');
					}
					else{
						$result->ajax = 1;
						
					}
					template::set('video_info', $result);
				}
				template::render();
			}
			
		}			
	
		public function video_info_updating($video_id, $company_name, $video_path)
		{
			$this->load->model('video/video_model');
			
			$path = $company_name.'/'.$video_path.'/';
			$user_id = $this->auth->user_id();
			$user_company = $this->company_model->find_by('company_userid', $user_id)->id;
			//check if this video belongs to this user
			$result = $this->video_model->find_all_by( array('id'=>$video_id, 'video_company_id'=>$user_company, 'video_path'=>$path) );
			console::log($result);
			template::set_theme('two column');
			if($result !== false && $this->input->post()!==false){
				$video_data = array(
					'video_title' => $this->input->post('video_title'),
					'video_description' => $this->input->post('video_description'),				
				);
				$this->video_model->update($video_id, $video_data);
				template::set('msg', 'ok');
			}
			else{template::set('msg', 'error');}
			console::log($this->input->post());
			template::render();
		}
	
	
	
	}
	
