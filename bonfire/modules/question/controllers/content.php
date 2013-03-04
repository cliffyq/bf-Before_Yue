<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Question.Content.View');
		$this->load->model('question_model', null, true);
		$this->lang->load('question');

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
					$result = $this->question_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('question_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('question_delete_failure') . $this->question_model->error, 'error');
				}
			}
		}

		$records = $this->question_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage question');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a question object.
	*/
	public function create()
	{
		$this->auth->restrict('Question.Content.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_question())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('question_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'question');

				Template::set_message(lang('question_create_success'), 'success');
				Template::redirect(SITE_AREA .'/content/question');
			}
			else
			{
				Template::set_message(lang('question_create_failure') . $this->question_model->error, 'error');
			}
		}
		Assets::add_module_js('question', 'question.js');

		Template::set('toolbar_title', lang('question_create') . ' question');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of question data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('question_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/question');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Question.Content.Edit');

			if ($this->save_question('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('question_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'question');

				Template::set_message(lang('question_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('question_edit_failure') . $this->question_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Question.Content.Delete');

			if ($this->question_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('question_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'question');

				Template::set_message(lang('question_delete_success'), 'success');

				redirect(SITE_AREA .'/content/question');
			} else
			{
				Template::set_message(lang('question_delete_failure') . $this->question_model->error, 'error');
			}
		}
		Template::set('question', $this->question_model->find($id));
		Assets::add_module_js('question', 'question.js');

		Template::set('toolbar_title', lang('question_edit') . ' question');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_question()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_question($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('question_content','content','max_length[140]');
		$this->form_validation->set_rules('question_answer_id','answer_id','max_length[11]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['question_content']        = $this->input->post('question_content');
		$data['question_answer_id']        = $this->input->post('question_answer_id');

		if ($type == 'insert')
		{
			$id = $this->question_model->insert($data);

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
			$return = $this->question_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}