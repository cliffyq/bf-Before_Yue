<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Text_form.Reports.View');
		$this->load->model('text_form_model', null, true);
		$this->lang->load('text_form');
		
		Template::set_block('sub_nav', 'reports/_sub_nav');
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
					$result = $this->text_form_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('text_form_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('text_form_delete_failure') . $this->text_form_model->error, 'error');
				}
			}
		}

		$records = $this->text_form_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage text form');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a text form object.
	*/
	public function create()
	{
		$this->auth->restrict('Text_form.Reports.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_text_form())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('text_form_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'text_form');

				Template::set_message(lang('text_form_create_success'), 'success');
				Template::redirect(SITE_AREA .'/reports/text_form');
			}
			else
			{
				Template::set_message(lang('text_form_create_failure') . $this->text_form_model->error, 'error');
			}
		}
		Assets::add_module_js('text_form', 'text_form.js');

		Template::set('toolbar_title', lang('text_form_create') . ' text form');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of text form data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('text_form_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/text_form');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Text_form.Reports.Edit');

			if ($this->save_text_form('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('text_form_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'text_form');

				Template::set_message(lang('text_form_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('text_form_edit_failure') . $this->text_form_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Text_form.Reports.Delete');

			if ($this->text_form_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('text_form_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'text_form');

				Template::set_message(lang('text_form_delete_success'), 'success');

				redirect(SITE_AREA .'/reports/text_form');
			} else
			{
				Template::set_message(lang('text_form_delete_failure') . $this->text_form_model->error, 'error');
			}
		}
		Template::set('text_form', $this->text_form_model->find($id));
		Assets::add_module_js('text_form', 'text_form.js');

		Template::set('toolbar_title', lang('text_form_edit') . ' text form');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_text_form()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_text_form($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('text_form_edu','edu','max_length['phd', 'master', 'undergraduate']');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['text_form_edu']        = $this->input->post('text_form_edu');

		if ($type == 'insert')
		{
			$id = $this->text_form_model->insert($data);

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
			$return = $this->text_form_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}