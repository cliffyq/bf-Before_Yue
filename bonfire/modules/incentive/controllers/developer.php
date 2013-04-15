<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Incentive.Developer.View');
		$this->load->model('incentive_model', null, true);
		$this->lang->load('incentive');

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
					$result = $this->incentive_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('incentive_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('incentive_delete_failure') . $this->incentive_model->error, 'error');
				}
			}
		}

		$records = $this->incentive_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Incentive');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a Incentive object.
	*/
	public function create()
	{
		$this->auth->restrict('Incentive.Developer.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_incentive())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('incentive_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'incentive');

				Template::set_message(lang('incentive_create_success'), 'success');
				Template::redirect(SITE_AREA .'/developer/incentive');
			}
			else
			{
				Template::set_message(lang('incentive_create_failure') . $this->incentive_model->error, 'error');
			}
		}
		Assets::add_module_js('incentive', 'incentive.js');

		Template::set('toolbar_title', lang('incentive_create') . ' Incentive');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of Incentive data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('incentive_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/incentive');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Incentive.Developer.Edit');

			if ($this->save_incentive('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('incentive_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'incentive');

				Template::set_message(lang('incentive_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('incentive_edit_failure') . $this->incentive_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Incentive.Developer.Delete');

			if ($this->incentive_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('incentive_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'incentive');

				Template::set_message(lang('incentive_delete_success'), 'success');

				redirect(SITE_AREA .'/developer/incentive');
			} else
			{
				Template::set_message(lang('incentive_delete_failure') . $this->incentive_model->error, 'error');
			}
		}
		Template::set('incentive', $this->incentive_model->find($id));
		Assets::add_module_js('incentive', 'incentive.js');

		Template::set('toolbar_title', lang('incentive_edit') . ' Incentive');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_incentive()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_incentive($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('incentive_company_id','company_id','required|max_length[11]');
		$this->form_validation->set_rules('incentive_name','name','required|max_length[25]');
		$this->form_validation->set_rules('incentive_description','description','max_length[140]');
		$this->form_validation->set_rules('incentive_price','price','required|max_length[11]');
		$this->form_validation->set_rules('incentive_image_path','image_path','required|max_length[255]');
		$this->form_validation->set_rules('incentive_amount_left','amount_left','required|max_length[11]');
		$this->form_validation->set_rules('incentive_amount_total','amount_total','required|max_length[11]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['incentive_company_id']        = $this->input->post('incentive_company_id');
		$data['incentive_name']        = $this->input->post('incentive_name');
		$data['incentive_description']        = $this->input->post('incentive_description');
		$data['incentive_price']        = $this->input->post('incentive_price');
		$data['incentive_image_path']        = $this->input->post('incentive_image_path');
		$data['incentive_amount_left']        = $this->input->post('incentive_amount_left');
		$data['incentive_amount_total']        = $this->input->post('incentive_amount_total');

		if ($type == 'insert')
		{
			$id = $this->incentive_model->insert($data);

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
			$return = $this->incentive_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}