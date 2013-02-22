<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('User_Info.Settings.View');
		$this->load->model('user_info_model', null, true);
		$this->lang->load('user_info');
		
		Template::set_block('sub_nav', 'settings/_sub_nav');
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
					$result = $this->user_info_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('user_info_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('user_info_delete_failure') . $this->user_info_model->error, 'error');
				}
			}
		}

		$records = $this->user_info_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage User Info');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a User Info object.
	*/
	public function create()
	{
		$this->auth->restrict('User_Info.Settings.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_user_info())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('user_info_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'user_info');

				Template::set_message(lang('user_info_create_success'), 'success');
				Template::redirect(SITE_AREA .'/settings/user_info');
			}
			else
			{
				Template::set_message(lang('user_info_create_failure') . $this->user_info_model->error, 'error');
			}
		}
		Assets::add_module_js('user_info', 'user_info.js');

		Template::set('toolbar_title', lang('user_info_create') . ' User Info');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of User Info data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('user_info_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/user_info');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('User_Info.Settings.Edit');

			if ($this->save_user_info('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('user_info_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'user_info');

				Template::set_message(lang('user_info_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('user_info_edit_failure') . $this->user_info_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('User_Info.Settings.Delete');

			if ($this->user_info_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('user_info_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'user_info');

				Template::set_message(lang('user_info_delete_success'), 'success');

				redirect(SITE_AREA .'/settings/user_info');
			} else
			{
				Template::set_message(lang('user_info_delete_failure') . $this->user_info_model->error, 'error');
			}
		}
		Template::set('user_info', $this->user_info_model->find($id));
		Assets::add_module_js('user_info', 'user_info.js');

		Template::set('toolbar_title', lang('user_info_edit') . ' User Info');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_user_info()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_user_info($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('user_info_user_id','User ID','max_length[11]');
		$this->form_validation->set_rules('user_info_first_name','First Name','required|max_length[25]');
		$this->form_validation->set_rules('user_info_last_name','Last Name','required|max_length[25]');
		$this->form_validation->set_rules('user_info_gender','Gender','required|max_length[1]');
		$this->form_validation->set_rules('user_info_birth_month','Birth Month','max_length[2]');
		$this->form_validation->set_rules('user_info_birth_year','Birth Year','max_length[4]');
		$this->form_validation->set_rules('user_info_race','Race','max_length[30]');
		$this->form_validation->set_rules('user_info_tutorial_flag','Tutorial Flag','max_length[1]');
		$this->form_validation->set_rules('user_info_education','Education','max_length[20]');
		$this->form_validation->set_rules('user_info_veteran','Veteran','max_length[1]');
		$this->form_validation->set_rules('user_info_zipcode','Zipcode','max_length[5]');
		$this->form_validation->set_rules('user_info_industry_id','Industry ID','max_length[3]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['user_info_user_id']        = $this->input->post('user_info_user_id');
		$data['user_info_first_name']        = $this->input->post('user_info_first_name');
		$data['user_info_last_name']        = $this->input->post('user_info_last_name');
		$data['user_info_gender']        = $this->input->post('user_info_gender');
		$data['user_info_birth_month']        = $this->input->post('user_info_birth_month');
		$data['user_info_birth_year']        = $this->input->post('user_info_birth_year');
		$data['user_info_race']        = $this->input->post('user_info_race');
		$data['user_info_tutorial_flag']        = $this->input->post('user_info_tutorial_flag');
		$data['user_info_education']        = $this->input->post('user_info_education');
		$data['user_info_veteran']        = $this->input->post('user_info_veteran');
		$data['user_info_zipcode']        = $this->input->post('user_info_zipcode');
		$data['user_info_industry_id']        = $this->input->post('user_info_industry_id');

		if ($type == 'insert')
		{
			$id = $this->user_info_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->user_info_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}