<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Video_Question.Developer.View');
		$this->load->model('video_question_model', null, true);
		$this->lang->load('video_question');

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
					$result = $this->video_question_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('video_question_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('video_question_delete_failure') . $this->video_question_model->error, 'error');
				}
			}
		}

		$records = $this->video_question_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Video Question');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a Video Question object.
	*/
	public function create()
	{
		$this->auth->restrict('Video_Question.Developer.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_video_question())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_question_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'video_question');

				Template::set_message(lang('video_question_create_success'), 'success');
				Template::redirect(SITE_AREA .'/developer/video_question');
			}
			else
			{
				Template::set_message(lang('video_question_create_failure') . $this->video_question_model->error, 'error');
			}
		}
		Assets::add_module_js('video_question', 'video_question.js');

		Template::set('toolbar_title', lang('video_question_create') . ' Video Question');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of Video Question data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('video_question_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/video_question');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Video_Question.Developer.Edit');

			if ($this->save_video_question('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_question_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'video_question');

				Template::set_message(lang('video_question_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('video_question_edit_failure') . $this->video_question_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Video_Question.Developer.Delete');

			if ($this->video_question_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_question_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'video_question');

				Template::set_message(lang('video_question_delete_success'), 'success');

				redirect(SITE_AREA .'/developer/video_question');
			} else
			{
				Template::set_message(lang('video_question_delete_failure') . $this->video_question_model->error, 'error');
			}
		}
		Template::set('video_question', $this->video_question_model->find($id));
		Assets::add_module_js('video_question', 'video_question.js');

		Template::set('toolbar_title', lang('video_question_edit') . ' Video Question');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_video_question()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_video_question($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('video_question_video_id','Video ID','max_length[11]');
		$this->form_validation->set_rules('video_question_question_id','Question ID','max_length[11]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['video_question_video_id']        = $this->input->post('video_question_video_id');
		$data['video_question_question_id']        = $this->input->post('video_question_question_id');

		if ($type == 'insert')
		{
			$id = $this->video_question_model->insert($data);

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
			$return = $this->video_question_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}