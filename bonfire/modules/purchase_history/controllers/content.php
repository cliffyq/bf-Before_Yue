<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Purchase_history.Content.View');
		$this->load->model('purchase_history_model', null, true);
		$this->lang->load('purchase_history');

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
					$result = $this->purchase_history_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('purchase_history_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('purchase_history_delete_failure') . $this->purchase_history_model->error, 'error');
				}
			}
		}

		$records = $this->purchase_history_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Purchase history');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a Purchase history object.
	*/
	public function create()
	{
		$this->auth->restrict('Purchase_history.Content.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_purchase_history())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('purchase_history_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'purchase_history');

				Template::set_message(lang('purchase_history_create_success'), 'success');
				Template::redirect(SITE_AREA .'/content/purchase_history');
			}
			else
			{
				Template::set_message(lang('purchase_history_create_failure') . $this->purchase_history_model->error, 'error');
			}
		}
		Assets::add_module_js('purchase_history', 'purchase_history.js');

		Template::set('toolbar_title', lang('purchase_history_create') . ' Purchase history');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of Purchase history data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('purchase_history_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/purchase_history');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Purchase_history.Content.Edit');

			if ($this->save_purchase_history('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('purchase_history_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'purchase_history');

				Template::set_message(lang('purchase_history_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('purchase_history_edit_failure') . $this->purchase_history_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Purchase_history.Content.Delete');

			if ($this->purchase_history_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('purchase_history_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'purchase_history');

				Template::set_message(lang('purchase_history_delete_success'), 'success');

				redirect(SITE_AREA .'/content/purchase_history');
			} else
			{
				Template::set_message(lang('purchase_history_delete_failure') . $this->purchase_history_model->error, 'error');
			}
		}
		Template::set('purchase_history', $this->purchase_history_model->find($id));
		Assets::add_module_js('purchase_history', 'purchase_history.js');

		Template::set('toolbar_title', lang('purchase_history_edit') . ' Purchase history');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_purchase_history()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_purchase_history($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('purchase_history_user_id','user_id','max_length[11]');
		$this->form_validation->set_rules('purchase_history_incentive_id','incentive_id','max_length[11]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['purchase_history_user_id']        = $this->input->post('purchase_history_user_id');
		$data['purchase_history_incentive_id']        = $this->input->post('purchase_history_incentive_id');

		if ($type == 'insert')
		{
			$id = $this->purchase_history_model->insert($data);

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
			$return = $this->purchase_history_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}