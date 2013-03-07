<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Industry.Developer.View');
		$this->load->model('industry_model', null, true);
		$this->lang->load('industry');

		Template::set_block('sub_nav', 'developer/_sub_nav');
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
					$result = $this->industry_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('industry_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('industry_delete_failure') . $this->industry_model->error, 'error');
				}
			}
		}

		$records = $this->industry_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Industry');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a Industry object.
	*/
	public function create()
	{
		$this->auth->restrict('Industry.Developer.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_industry())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('industry_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'industry');

				Template::set_message(lang('industry_create_success'), 'success');
				Template::redirect(SITE_AREA .'/developer/industry');
			}
			else
			{
				Template::set_message(lang('industry_create_failure') . $this->industry_model->error, 'error');
			}
		}
		Assets::add_module_js('industry', 'industry.js');

		Template::set('toolbar_title', lang('industry_create') . ' Industry');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of Industry data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('industry_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/industry');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Industry.Developer.Edit');

			if ($this->save_industry('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('industry_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'industry');

				Template::set_message(lang('industry_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('industry_edit_failure') . $this->industry_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Industry.Developer.Delete');

			if ($this->industry_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('industry_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'industry');

				Template::set_message(lang('industry_delete_success'), 'success');

				redirect(SITE_AREA .'/developer/industry');
			} else
			{
				Template::set_message(lang('industry_delete_failure') . $this->industry_model->error, 'error');
			}
		}
		Template::set('industry', $this->industry_model->find($id));
		Assets::add_module_js('industry', 'industry.js');

		Template::set('toolbar_title', lang('industry_edit') . ' Industry');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_industry()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_industry($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('industry_industry_name','Industry','required|max_length[40]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['industry_industry_name']        = $this->input->post('industry_industry_name');

		if ($type == 'insert')
		{
			$id = $this->industry_model->insert($data);

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
			$return = $this->industry_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}