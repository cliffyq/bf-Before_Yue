<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('User_information.Developer.View');
		$this->load->model('user_information_model', null, true);
		$this->lang->load('user_information');

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
					$result = $this->user_information_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('user_information_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('user_information_delete_failure') . $this->user_information_model->error, 'error');
				}
			}
		}

		$records = $this->user_information_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage user information');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a user information object.
	*/
	public function create()
	{
		$this->auth->restrict('User_information.Developer.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_user_information())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('user_information_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'user_information');

				Template::set_message(lang('user_information_create_success'), 'success');
				Template::redirect(SITE_AREA .'/developer/user_information');
			}
			else
			{
				Template::set_message(lang('user_information_create_failure') . $this->user_information_model->error, 'error');
			}
		}
		Assets::add_module_js('user_information', 'user_information.js');

		Template::set('toolbar_title', lang('user_information_create') . ' user information');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of user information data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('user_information_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/user_information');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('User_information.Developer.Edit');

			if ($this->save_user_information('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('user_information_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'user_information');

				Template::set_message(lang('user_information_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('user_information_edit_failure') . $this->user_information_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('User_information.Developer.Delete');

			if ($this->user_information_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('user_information_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'user_information');

				Template::set_message(lang('user_information_delete_success'), 'success');

				redirect(SITE_AREA .'/developer/user_information');
			} else
			{
				Template::set_message(lang('user_information_delete_failure') . $this->user_information_model->error, 'error');
			}
		}
		Template::set('user_information', $this->user_information_model->find($id));
		Assets::add_module_js('user_information', 'user_information.js');

		Template::set('toolbar_title', lang('user_information_edit') . ' user information');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_user_information()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_user_information($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('user_information_user_id','user_id','max_length[11]');
		$this->form_validation->set_rules('user_information_current_points','current_points','max_length[11]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['user_information_user_id']        = $this->input->post('user_information_user_id');
		$data['user_information_current_points']        = $this->input->post('user_information_current_points');

		if ($type == 'insert')
		{
			$id = $this->user_information_model->insert($data);

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
			$return = $this->user_information_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}