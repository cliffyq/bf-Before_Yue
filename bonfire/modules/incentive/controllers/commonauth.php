<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class commonauth extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		//$this->auth->restrict('Incentive.Commonauth.View');
		$this->load->model('incentive_model', null, true);
		$this->lang->load('incentive');
		
		Template::set_theme('two_column','junk');
		//Template::set_block('sub_nav', 'commonauth/_sub_nav');
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
		Template::set('toolbar_title', 'Manage incentive');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

	Creates a incentive object.
	*/
	public function create()
	{
		$this->auth->restrict('Incentive.Commonauth.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_incentive())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('incentive_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'incentive');

				Template::set_message(lang('incentive_create_success'), 'success');
				Template::redirect(SITE_AREA .'/commonauth/incentive');
			}
			else
			{
				Template::set_message(lang('incentive_create_failure') . $this->incentive_model->error, 'error');
			}
		}
		Assets::add_module_js('incentive', 'incentive.js');

		Template::set('toolbar_title', lang('incentive_create') . ' incentive');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of incentive data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('incentive_invalid_id'), 'error');
			redirect(SITE_AREA .'/commonauth/incentive');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Incentive.Commonauth.Edit');

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
			$this->auth->restrict('Incentive.Commonauth.Delete');

			if ($this->incentive_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('incentive_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'incentive');

				Template::set_message(lang('incentive_delete_success'), 'success');

				redirect(SITE_AREA .'/commonauth/incentive');
			} else
			{
				Template::set_message(lang('incentive_delete_failure') . $this->incentive_model->error, 'error');
			}
		}
		Template::set('incentive', $this->incentive_model->find($id));
		Assets::add_module_js('incentive', 'incentive.js');

		Template::set('toolbar_title', lang('incentive_edit') . ' incentive');
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


		$this->form_validation->set_rules('incentive_company_id','company_id','max_length[11]');
		$this->form_validation->set_rules('incentive_name','name','max_length[25]');
		$this->form_validation->set_rules('incentive_description','description','max_length[140]');
		$this->form_validation->set_rules('incentive_price','price','max_length[11]');
		$this->form_validation->set_rules('incentive_category_id','category_id','max_length[11]');

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
		$data['incentive_category_id']        = $this->input->post('incentive_category_id');

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
	
	public function get_incentive_image($path,$option=NULL)
	{
		
			$config = read_config('upload', TRUE, 'incentive');
			$exts = explode("|",$config['allowed_types']);
			foreach ($exts as $ext) {
				$img = INCENTIVE_PATH . $path.'.'.$ext;
				//console::log($img);
				if (file_exists("./" . $img))
					if($option=='url')
					return base_url() . $img;
					else
					return $img;
			}
			return '';
		
	}

	//--------------------------------------------------------------------



}