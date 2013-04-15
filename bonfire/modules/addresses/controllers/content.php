<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


		public function __construct()
		{
		parent::__construct();

		$this->auth->restrict('Addresses.Content.View');
			$this->load->model('addresses_model', null, true);
		$this->lang->load('addresses');
		
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
			$result = $this->addresses_model->delete($pid);
}

					if ($result)
					{
					Template::set_message(count($checked) .' '. lang('addresses_delete_success'), 'success');
}
							else
							{
							Template::set_message(lang('addresses_delete_failure') . $this->addresses_model->error, 'error');
}
}
}

									$records = $this->addresses_model->find_all();

											Template::set('records', $records);
		Template::set('toolbar_title', 'Manage addresses');
				Template::render();
}

				//--------------------------------------------------------------------


				
		/*
		Method: create()

		Creates a addresses object.
				*/
				public function create()
				{
				$this->auth->restrict('Addresses.Content.Create');
				
			if ($this->input->post('save'))
			{
			if ($insert_id = $this->save_addresses())
			{
					// Log the activity
					$this->activity_model->log_activity($this->current_user->id, lang('addresses_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'addresses');

							Template::set_message(lang('addresses_create_success'), 'success');
									Template::redirect(SITE_AREA .'/content/addresses');
}
											else
											{
											Template::set_message(lang('addresses_create_failure') . $this->addresses_model->error, 'error');
}
}
		Assets::add_module_js('addresses', 'addresses.js');

				Template::set('toolbar_title', lang('addresses_create') . ' addresses');
						Template::render();
}

						//--------------------------------------------------------------------


						
		/*
		Method: edit()

		Allows editing of addresses data.
				*/
				public function edit()
				{
				$id = $this->uri->segment(5);

				if (empty($id))
				{
				Template::set_message(lang('addresses_invalid_id'), 'error');
						redirect(SITE_AREA .'/content/addresses');
}
								
			if (isset($_POST['save']))
			{
			$this->auth->restrict('Addresses.Content.Edit');

			if ($this->save_addresses('update', $id))
			{
					// Log the activity
					$this->activity_model->log_activity($this->current_user->id, lang('addresses_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'addresses');

							Template::set_message(lang('addresses_edit_success'), 'success');
}
									else
									{
									Template::set_message(lang('addresses_edit_failure') . $this->addresses_model->error, 'error');
}
}
				else if (isset($_POST['delete']))
				{
				$this->auth->restrict('Addresses.Content.Delete');

				if ($this->addresses_model->delete($id))
				{
						// Log the activity
						$this->activity_model->log_activity($this->current_user->id, lang('addresses_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'addresses');

								Template::set_message(lang('addresses_delete_success'), 'success');

										redirect(SITE_AREA .'/content/addresses');
	} else
	{
												Template::set_message(lang('addresses_delete_failure') . $this->addresses_model->error, 'error');
	}
	}
			Template::set('addresses', $this->addresses_model->find($id));
		Assets::add_module_js('addresses', 'addresses.js');

				Template::set('toolbar_title', lang('addresses_edit') . ' addresses');
						Template::render();
}

						//--------------------------------------------------------------------


							//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_addresses()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_addresses($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
				$this->form_validation->set_rules('addresses_zip','zip','max_length[5]');
				$this->form_validation->set_rules('addresses_city','city','max_length[100]');
				$this->form_validation->set_rules('addresses_state','state','max_length[2]');
				$this->form_validation->set_rules('addresses_latitude','latitude','max_length[10]');
				$this->form_validation->set_rules('addresses_longitude','longitude','max_length[10]');
				$this->form_validation->set_rules('addresses_timezone','timezone','max_length[2]');
				$this->form_validation->set_rules('addresses_dst','dst','max_length[1]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
			$data = array();
		$data['addresses_zip']        = $this->input->post('addresses_zip');
		$data['addresses_city']        = $this->input->post('addresses_city');
		$data['addresses_state']        = $this->input->post('addresses_state');
		$data['addresses_latitude']        = $this->input->post('addresses_latitude');
		$data['addresses_longitude']        = $this->input->post('addresses_longitude');
		$data['addresses_timezone']        = $this->input->post('addresses_timezone');
		$data['addresses_dst']        = $this->input->post('addresses_dst');

		if ($type == 'insert')
		{
			$id = $this->addresses_model->insert($data);

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
			$return = $this->addresses_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}