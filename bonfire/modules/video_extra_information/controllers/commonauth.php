<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class commonauth extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Video_extra_information.Commonauth.View');
		$this->load->model('video_extra_information_model', null, true);
		$this->lang->load('video_extra_information');

		Template::set_block('sub_nav', 'commonauth/_sub_nav');
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
					$result = $this->video_extra_information_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('video_extra_information_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('video_extra_information_delete_failure') . $this->video_extra_information_model->error, 'error');
				}
			}
		}

		$records = $this->video_extra_information_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage video extra information');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a video extra information object.
	*/
	public function create()
	{
		$this->auth->restrict('Video_extra_information.Commonauth.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_video_extra_information())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_extra_information_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'video_extra_information');

				Template::set_message(lang('video_extra_information_create_success'), 'success');
				Template::redirect(SITE_AREA .'/commonauth/video_extra_information');
			}
			else
			{
				Template::set_message(lang('video_extra_information_create_failure') . $this->video_extra_information_model->error, 'error');
			}
		}
		Assets::add_module_js('video_extra_information', 'video_extra_information.js');

		Template::set('toolbar_title', lang('video_extra_information_create') . ' video extra information');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of video extra information data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('video_extra_information_invalid_id'), 'error');
			redirect(SITE_AREA .'/commonauth/video_extra_information');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Video_extra_information.Commonauth.Edit');

			if ($this->save_video_extra_information('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_extra_information_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'video_extra_information');

				Template::set_message(lang('video_extra_information_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('video_extra_information_edit_failure') . $this->video_extra_information_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Video_extra_information.Commonauth.Delete');

			if ($this->video_extra_information_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_extra_information_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'video_extra_information');

				Template::set_message(lang('video_extra_information_delete_success'), 'success');

				redirect(SITE_AREA .'/commonauth/video_extra_information');
			} else
			{
				Template::set_message(lang('video_extra_information_delete_failure') . $this->video_extra_information_model->error, 'error');
			}
		}
		Template::set('video_extra_information', $this->video_extra_information_model->find($id));
		Assets::add_module_js('video_extra_information', 'video_extra_information.js');

		Template::set('toolbar_title', lang('video_extra_information_edit') . ' video extra information');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_video_extra_information()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_video_extra_information($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('video_extra_information_video_id','video_id','max_length[11]');
		$this->form_validation->set_rules('video_extra_information_points','points','max_length[11]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['video_extra_information_video_id']        = $this->input->post('video_extra_information_video_id');
		$data['video_extra_information_points']        = $this->input->post('video_extra_information_points');

		if ($type == 'insert')
		{
			$id = $this->video_extra_information_model->insert($data);

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
			$return = $this->video_extra_information_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}