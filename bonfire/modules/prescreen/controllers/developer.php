<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Prescreen.Developer.View');
		$this->load->model('prescreen_model', null, true);
		$this->lang->load('prescreen');
		
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
					$result = $this->prescreen_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('prescreen_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('prescreen_delete_failure') . $this->prescreen_model->error, 'error');
				}
			}
		}

		$records = $this->prescreen_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage prescreen');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a prescreen object.
	*/
	public function create()
	{
		$this->auth->restrict('Prescreen.Developer.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_prescreen())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('prescreen_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'prescreen');

				Template::set_message(lang('prescreen_create_success'), 'success');
				Template::redirect(SITE_AREA .'/developer/prescreen');
			}
			else
			{
				Template::set_message(lang('prescreen_create_failure') . $this->prescreen_model->error, 'error');
			}
		}
		Assets::add_module_js('prescreen', 'prescreen.js');

		Template::set('toolbar_title', lang('prescreen_create') . ' prescreen');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of prescreen data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('prescreen_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/prescreen');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Prescreen.Developer.Edit');

			if ($this->save_prescreen('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('prescreen_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'prescreen');

				Template::set_message(lang('prescreen_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('prescreen_edit_failure') . $this->prescreen_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Prescreen.Developer.Delete');

			if ($this->prescreen_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('prescreen_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'prescreen');

				Template::set_message(lang('prescreen_delete_success'), 'success');

				redirect(SITE_AREA .'/developer/prescreen');
			} else
			{
				Template::set_message(lang('prescreen_delete_failure') . $this->prescreen_model->error, 'error');
			}
		}
		Template::set('prescreen', $this->prescreen_model->find($id));
		Assets::add_module_js('prescreen', 'prescreen.js');

		Template::set('toolbar_title', lang('prescreen_edit') . ' prescreen');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_prescreen()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_prescreen($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('prescreen_content','content','max_length[30]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['prescreen_content']        = $this->input->post('prescreen_content');

		if ($type == 'insert')
		{
			$id = $this->prescreen_model->insert($data);

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
			$return = $this->prescreen_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}