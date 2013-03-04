<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Answer.Settings.View');
		$this->load->model('answer_model', null, true);
		$this->lang->load('answer');

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
					$result = $this->answer_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('answer_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('answer_delete_failure') . $this->answer_model->error, 'error');
				}
			}
		}

		$records = $this->answer_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage answer');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a answer object.
	*/
	public function create()
	{
		$this->auth->restrict('Answer.Settings.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_answer())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('answer_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'answer');

				Template::set_message(lang('answer_create_success'), 'success');
				Template::redirect(SITE_AREA .'/settings/answer');
			}
			else
			{
				Template::set_message(lang('answer_create_failure') . $this->answer_model->error, 'error');
			}
		}
		Assets::add_module_js('answer', 'answer.js');

		Template::set('toolbar_title', lang('answer_create') . ' answer');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of answer data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('answer_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/answer');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Answer.Settings.Edit');

			if ($this->save_answer('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('answer_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'answer');

				Template::set_message(lang('answer_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('answer_edit_failure') . $this->answer_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Answer.Settings.Delete');

			if ($this->answer_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('answer_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'answer');

				Template::set_message(lang('answer_delete_success'), 'success');

				redirect(SITE_AREA .'/settings/answer');
			} else
			{
				Template::set_message(lang('answer_delete_failure') . $this->answer_model->error, 'error');
			}
		}
		Template::set('answer', $this->answer_model->find($id));
		Assets::add_module_js('answer', 'answer.js');

		Template::set('toolbar_title', lang('answer_edit') . ' answer');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_answer()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_answer($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('answer_content','content','max_length[255]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['answer_content']        = $this->input->post('answer_content');

		if ($type == 'insert')
		{
			$id = $this->answer_model->insert($data);

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
			$return = $this->answer_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}