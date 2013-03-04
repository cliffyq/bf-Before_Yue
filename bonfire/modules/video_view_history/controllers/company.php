<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class company extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Video_view_history.Company.View');
		$this->load->model('video_view_history_model', null, true);
		$this->lang->load('video_view_history');

		Template::set_block('sub_nav', 'company/_sub_nav');
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
					$result = $this->video_view_history_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('video_view_history_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('video_view_history_delete_failure') . $this->video_view_history_model->error, 'error');
				}
			}
		}

		$records = $this->video_view_history_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage video view history');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a video view history object.
	*/
	public function create()
	{
		$this->auth->restrict('Video_view_history.Company.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_video_view_history())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_view_history_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'video_view_history');

				Template::set_message(lang('video_view_history_create_success'), 'success');
				Template::redirect(SITE_AREA .'/company/video_view_history');
			}
			else
			{
				Template::set_message(lang('video_view_history_create_failure') . $this->video_view_history_model->error, 'error');
			}
		}
		Assets::add_module_js('video_view_history', 'video_view_history.js');

		Template::set('toolbar_title', lang('video_view_history_create') . ' video view history');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of video view history data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('video_view_history_invalid_id'), 'error');
			redirect(SITE_AREA .'/company/video_view_history');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Video_view_history.Company.Edit');

			if ($this->save_video_view_history('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_view_history_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'video_view_history');

				Template::set_message(lang('video_view_history_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('video_view_history_edit_failure') . $this->video_view_history_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Video_view_history.Company.Delete');

			if ($this->video_view_history_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_view_history_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'video_view_history');

				Template::set_message(lang('video_view_history_delete_success'), 'success');

				redirect(SITE_AREA .'/company/video_view_history');
			} else
			{
				Template::set_message(lang('video_view_history_delete_failure') . $this->video_view_history_model->error, 'error');
			}
		}
		Template::set('video_view_history', $this->video_view_history_model->find($id));
		Assets::add_module_js('video_view_history', 'video_view_history.js');

		Template::set('toolbar_title', lang('video_view_history_edit') . ' video view history');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_video_view_history()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_video_view_history($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('video_view_history_video_id','video_id','max_length[11]');
		$this->form_validation->set_rules('video_view_history_user_id','user_id','max_length[20]');
		$this->form_validation->set_rules('video_view_history_ip','ip','max_length[15]');
		$this->form_validation->set_rules('video_view_history_created_on','created_on','');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['video_view_history_video_id']        = $this->input->post('video_view_history_video_id');
		$data['video_view_history_user_id']        = $this->input->post('video_view_history_user_id');
		$data['video_view_history_ip']        = $this->input->post('video_view_history_ip');
		$data['video_view_history_created_on']        = $this->input->post('video_view_history_created_on');

		if ($type == 'insert')
		{
			$id = $this->video_view_history_model->insert($data);

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
			$return = $this->video_view_history_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}