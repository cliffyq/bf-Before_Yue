<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Reviews.Reports.View');
		$this->load->model('reviews_model', null, true);
		$this->lang->load('reviews');
		
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
					$result = $this->reviews_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('reviews_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('reviews_delete_failure') . $this->reviews_model->error, 'error');
				}
			}
		}

		$records = $this->reviews_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Reviews');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Reviews object.
	*/
	public function create()
	{
		$this->auth->restrict('Reviews.Reports.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_reviews())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('reviews_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'reviews');

				Template::set_message(lang('reviews_create_success'), 'success');
				Template::redirect(SITE_AREA .'/reports/reviews');
			}
			else
			{
				Template::set_message(lang('reviews_create_failure') . $this->reviews_model->error, 'error');
			}
		}
		Assets::add_module_js('reviews', 'reviews.js');

		Template::set('toolbar_title', lang('reviews_create') . ' Reviews');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Reviews data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('reviews_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/reviews');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Reviews.Reports.Edit');

			if ($this->save_reviews('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('reviews_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'reviews');

				Template::set_message(lang('reviews_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('reviews_edit_failure') . $this->reviews_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Reviews.Reports.Delete');

			if ($this->reviews_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('reviews_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'reviews');

				Template::set_message(lang('reviews_delete_success'), 'success');

				redirect(SITE_AREA .'/reports/reviews');
			} else
			{
				Template::set_message(lang('reviews_delete_failure') . $this->reviews_model->error, 'error');
			}
		}
		Template::set('reviews', $this->reviews_model->find($id));
		Assets::add_module_js('reviews', 'reviews.js');

		Template::set('toolbar_title', lang('reviews_edit') . ' Reviews');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_reviews()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_reviews($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('reviews_video_id','Video ID','max_length[11]');
		$this->form_validation->set_rules('reviews_user_id','User ID','max_length[20]');
		$this->form_validation->set_rules('reviews_answers','Answers','max_length[50]');
		$this->form_validation->set_rules('reviews_rating','Rating','max_length[1]');
		$this->form_validation->set_rules('reviews_comment_id','Comment ID','max_length[11]');
		$this->form_validation->set_rules('reviews_last_update','Last Update','');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['reviews_video_id']        = $this->input->post('reviews_video_id');
		$data['reviews_user_id']        = $this->input->post('reviews_user_id');
		$data['reviews_answers']        = $this->input->post('reviews_answers');
		$data['reviews_rating']        = $this->input->post('reviews_rating');
		$data['reviews_comment_id']        = $this->input->post('reviews_comment_id');
		$data['reviews_last_update']        = $this->input->post('reviews_last_update');

		if ($type == 'insert')
		{
			$id = $this->reviews_model->insert($data);

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
			$return = $this->reviews_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}