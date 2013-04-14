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
		$this -> config -> load('upload');
		$exts = explode("|", $this -> config -> item('allowed_types'));
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
	

	
}
