<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
			
		$this->auth->restrict('Company.Content.View');
		$this->load->model('company_model', null, true);
		$this->lang->load('company');
			
		Template::set_block('sub_nav', 'content/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
	 Method: index()

	Displays a list of form data.
	*/
	public function index()
	{
			
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->company_model->delete($pid);
				}
					
				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('company_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('company_delete_failure') . $this->company_model->error, 'error');
				}
			}
		}
			
		$records = $this->company_model->find_all();
			
		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Company');
		Template::set_theme('Two');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
	 Method: create()

	Creates a Company object.
	*/
	public function create()
	{
		$this->auth->restrict('Company.Content.Create');
			
		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_company())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('company_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'company');
					
				Template::set_message(lang('company_create_success'), 'success');
				Template::redirect(SITE_AREA .'/content/company');
			}
			else
			{
				Template::set_message(lang('company_create_failure') . $this->company_model->error, 'error');
			}
		}
		Assets::add_module_js('company', 'company.js');
			
		Template::set('toolbar_title', lang('company_create') . ' Company');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
	 Method: edit()

	Allows editing of Company data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);
			
		if (empty($id))
		{
			Template::set_message(lang('company_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/company');
		}
			
		if (isset($_POST['save']))
		{
			$this->auth->restrict('Company.Content.Edit');

			if ($this->save_company('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('company_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'company');
					
				Template::set_message(lang('company_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('company_edit_failure') . $this->company_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Company.Content.Delete');

			if ($this->company_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('company_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'company');
					
				Template::set_message(lang('company_delete_success'), 'success');
					
				redirect(SITE_AREA .'/content/company');
			} else
			{
				Template::set_message(lang('company_delete_failure') . $this->company_model->error, 'error');
			}
		}
		Template::set('company', $this->company_model->find($id));
		Assets::add_module_js('company', 'company.js');
			
		Template::set('toolbar_title', lang('company_edit') . ' Company');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
	 Method: save_company()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_company($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}
			
			
		$this->form_validation->set_rules('company_name','Company Name','max_length[100]');
		//$this->form_validation->set_rules('company_logo','Company logo','max_length[255]');
		$this->form_validation->set_rules('company_url','Company url','max_length[255]');
		$this->form_validation->set_rules('company_industry_id','Industry ID','max_length[3]');
		$this->form_validation->set_rules('company_description','Company description','max_length[1000]');
			
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
			
		// make sure we only pass in the fields we want
			
		$data = array();
		$data['company_name']        = $this->input->post('company_name');
		//$data['company_logo']        = $this->input->post('company_logo');
		$data['company_url']        = $this->input->post('company_url');
		$data['company_industry_id']        = $this->input->post('company_industry_id');
		$data['company_description']        = $this->input->post('company_description');
			
		if ($type == 'insert')
		{
			$return = $this->company_model->create_company($data);
			/* 				$path = url_title($data['company_name'],'underscore').'/';
				$fdata = $this->_upload_logo('company_logo',$path);
			if(isset($fdata['error'])||!isset($fdata['upload_data']) || $fdata['upload_data'] == NULL){

			return FALSE;
			}
			$data['company_logo'] = $path;
			$id = $this->company_model->insert($data);
			if (!is_numeric($id)) return FALSE;
			$return = $id; */

		}
		else if ($type == 'update')
		{
			if($this->input->post('company_logo')) {
				$path = $this->company_model->get_field($id, 'company_logo');
				$fdata = $this->_upload_logo('company_logo',$path);
				if(isset($fdata['error'])||!isset($fdata['upload_data']) || $fdata['upload_data'] == NULL){

					$this->error='upload error';

					return FALSE;
				}
			}

			$return = $this->company_model->update($id, $data);
		}
			
		return $return;
	}

	//--------------------------------------------------------------------
	//upload logo, $field_name = form input name, $path = path relative to the LOGO_PATH
	public function _upload_logo($field_name,$path){
			
		$this->config->load('upload');
		$preference['upload_path'] = './'.LOGO_PATH.$path;
		$preference['allowed_types'] = $this->config->item('allowed_types');
		$preference['max_size'] = $this->config->item('max_size');
		$preference['file_name'] = $this->config->item('file_name');
		if(!is_dir($preference['upload_path']))
		{
			mkdir($preference['upload_path'],0777,true);
		}
		$this->load->library('upload',$preference);
		$this->error='';
		if ( ! $this->upload->do_upload($field_name))
		{
			$data['error'] = $this->upload->display_errors();
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
		return $data;
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

}