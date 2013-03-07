<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Video.Content.View');
		$this->load->model('video_model', null, true);
		$this->lang->load('video');

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
					$result = $this->video_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('video_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('video_delete_failure') . $this->video_model->error, 'error');
				}
			}
		}

		$records = $this->video_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Video');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a Video object.
	*/
	public function create()
	{
		$this->auth->restrict('Video.Content.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_video())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'video');

				Template::set_message(lang('video_create_success'), 'success');
				Template::redirect(SITE_AREA .'/content/video');
			}
			else
			{
				Template::set_message(lang('video_create_failure') . $this->video_model->error, 'error');
			}
		}
		//Assets::add_module_js('video', 'video.js');

		Template::set('toolbar_title', lang('video_create') . ' Video');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of Video data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('video_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/video');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Video.Content.Edit');

			if ($this->save_video('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'video');

				Template::set_message(lang('video_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('video_edit_failure') . $this->video_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Video.Content.Delete');

			if ($this->video_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('video_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'video');

				Template::set_message(lang('video_delete_success'), 'success');

				redirect(SITE_AREA .'/content/video');
			} else
			{
				Template::set_message(lang('video_delete_failure') . $this->video_model->error, 'error');
			}
		}
		Template::set('video', $this->video_model->find($id));
		Assets::add_module_js('video', 'video.js');

		Template::set('toolbar_title', lang('video_edit') . ' Video');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_video()

	Does the actual validation and saving of form data.

	Parameters:
	$type	- Either "insert" or "update"
	$id		- The ID of the record to update. Not needed for inserts.

	Returns:
	An INT id for successful inserts. If updating, returns TRUE on success.
	Otherwise, returns FALSE.
	*/
	private function save_video($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}


		$this->form_validation->set_rules('video_title','title','required|max_length[50]');
		$this->form_validation->set_rules('video_company_id','company_id','required|max_length[6]');
		$this->form_validation->set_rules('video_description','description','max_length[140]');
		$this->form_validation->set_rules('video_length','length','max_length[4]');
		$this->form_validation->set_rules('video_path','path','required|max_length[255]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['video_title']        = $this->input->post('video_title');
		$data['video_company_id']        = $this->input->post('video_company_id');
		$data['video_description']        = $this->input->post('video_description');
		$data['video_length']        = $this->input->post('video_length');
		$data['video_path']        = $this->input->post('video_path');

		if ($type == 'insert')
		{
			$id = $this->video_model->insert($data);

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
			$return = $this->video_model->update($id, $data);
		}

		return $return;
	}

	//self_function

	public function view()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('video_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/video');
		}

		Assets::clear_cache();
		Assets::add_module_css('video','video-js.css');
		Assets::add_module_js('video','video.js');
		Assets::add_js($this->load->view('content/videofunction',null,true),'inline');

		$records = $this->video_model->find($id);
		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Video');


		Template:: render();



			
	}

	//--------------------------------------------------------------------



}