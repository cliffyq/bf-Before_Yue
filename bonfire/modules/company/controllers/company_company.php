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
		Template::set_theme('two_column');
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
		
		Template::render();
	}

	private function check_user_company($user_id)
	{

		$company_object = $this -> company_model -> find_by('company_userid', $user_id);
		if (!$company_object)
			return false;
		return $company_object;	
			}


	public function edit_company_info() {
		
		if (isset($_POST['save'])){
		$user_id = $this -> auth -> user_id();
			$company_object = $this->check_user_company($user_id);
			
		console::log($this->input->post());
			$company_info = $this->input->post('company_logo');
		
			if($company_info['size'] != 0){
				$this->company_model->_upload_logo('company_logo', $company_object->company_logo);
				}
			$company_id = $company_object->id;
			$company_info = array('company_name'=>$this->input->post('company_name'),
								  'company_url'=>$this->input->post('company_url'),
								  'company_description'=>$this->input->post('company_description'),
								  'company_industry_id'=>$this->input->post('company_industry_id')
								);
			$this->company_model->update($company_id, $company_info);
				
				}
				
				
		$user_id = $this -> auth -> user_id();
		$company_object = $this->check_user_company($user_id);
				
		if(!$company_object)
			redirect(site_url());
		
		template::set('company_info', $company_object);
		$path = $company_object->company_logo;
		$company_object->company_logo = modules::run('company/company/get_logo', $path);
		//console::log($company_object);
		
		$this->load->model('industry/industry_model');
		$industry_records = $this->industry_model->find_all();
		console::log($company_object);
		console::log($industry_records);
		
		template::set('industry_records', $industry_records);
		
		Assets::add_js($this -> load -> view('inline_js/set_company_info.js.php', null, true), 'inline');
			template::set_theme('two_column');
		template::set_view('company_company/edit_company_info');
			template::render();
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

		Template::render();
			
			
			
			
		//Template::Render();
	}
}
