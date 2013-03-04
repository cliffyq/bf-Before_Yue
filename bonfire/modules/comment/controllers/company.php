<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class company extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Comment.Company.View');
		$this->load->model('comment_model', null, true);
		$this->lang->load('comment');

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
					$result = $this->comment_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('comment_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('comment_delete_failure') . $this->comment_model->error, 'error');
				}
			}
		}

		$records = $this->comment_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Comment');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a Comment object.
	*/
	public function create()
	{
		$this->auth->restrict('Comment.Company.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_comment())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('comment_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'comment');

				Template::set_message(lang('comment_create_success'), 'success');
				Template::redirect(SITE_AREA .'/company/comment');
			}
			else
			{
				Template::set_message(lang('comment_create_failure') . $this->comment_model->error, 'error');
			}
		}
		Assets::add_module_js('comment', 'comment.js');

		Template::set('toolbar_title', lang('comment_create') . ' Comment');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of Comment data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('comment_invalid_id'), 'error');
			redirect(SITE_AREA .'/company/comment');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Comment.Company.Edit');

			if ($this->save_comment('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('comment_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'comment');

				Template::set_message(lang('comment_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('comment_edit_failure') . $this->comment_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Comment.Company.Delete');

			if ($this->comment_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('comment_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'comment');

				Template::set_message(lang('comment_delete_success'), 'success');

				redirect(SITE_AREA .'/company/comment');
			} else
			{
				Template::set_message(lang('comment_delete_failure') . $this->comment_model->error, 'error');
			}
		}
		Template::set('comment', $this->comment_model->find($id));
		Assets::add_module_js('comment', 'comment.js');

		Template::set('toolbar_title', lang('comment_edit') . ' Comment');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_comment()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_comment($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('comment_user_id','Comment User ID','max_length[20]');
		$this->form_validation->set_rules('comment_user','Username','max_length[50]');
		$this->form_validation->set_rules('comment_ip','IP','max_length[15]');
		$this->form_validation->set_rules('comment_reply_to','Reply to','max_length[11]');
		$this->form_validation->set_rules('comment_parent_user','Parent User','max_length[50]');
		$this->form_validation->set_rules('comment_video_id','Video ID','max_length[11]');
		$this->form_validation->set_rules('comment_content','Content','max_length[500]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['comment_user_id']        = $this->input->post('comment_user_id');
		$data['comment_user']        = $this->input->post('comment_user');
		$data['comment_ip']        = $this->input->post('comment_ip');
		$data['comment_reply_to']        = $this->input->post('comment_reply_to');
		$data['comment_parent_user']        = $this->input->post('comment_parent_user');
		$data['comment_video_id']        = $this->input->post('comment_video_id');
		$data['comment_content']        = $this->input->post('comment_content');

		if ($type == 'insert')
		{
			$id = $this->comment_model->insert($data);

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
			$return = $this->comment_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}