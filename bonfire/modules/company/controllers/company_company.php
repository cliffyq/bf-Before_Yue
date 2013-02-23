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
				Template::set_theme('Two column');
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
			
			Template::set_theme('two column');
			Template::render();
			
			
			
			
			//Template::Render();
		}
	}			



