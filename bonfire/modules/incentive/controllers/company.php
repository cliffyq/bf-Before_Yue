<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class company extends  Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		//$this->auth->restrict('Incentive.Company.View');
		$this->load->model('incentive_model', null, true);
		$this->lang->load('incentive');

		Template::set_theme('two_column','junk');
		//Template::set_block('sub_nav', 'company/_sub_nav');

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
					if($this->delete_incentive_image($pid)) $result = $this->incentive_model->delete($pid);
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

		$company=$this->load->model('company/company_model')->find_by('company_userid',$this->auth->user_id());
		//There should be a function to check $company
		$records = $this->incentive_model->find_all_by('incentive_company_id',$company->id);

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
		//$this->auth->restrict('Incentive.Company.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_incentive())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('incentive_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'incentive');

				Template::set_message(lang('incentive_create_success'), 'success');
				Template::redirect('incentive/company/incentive_list');
			}
			else
			{
				Template::set_message(lang('incentive_create_failure') . $this->incentive_model->error, 'error');
			}
		}
		//	Assets::add_module_js('incentive', 'jquery.form.js');
		//	Assets::add_module_js('incentive', 'incentive.js');

		Assets::add_module_css('incentive','create_incentive.css');
		Assets::add_js($this->load->view('inline_js/upload_image_ajax.js.php',null,true),'inline');
		//Template::set('toolbar_title', lang('incentive_create') . ' incentive');
		//Template::set_theme('two_column','junk');

		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

	Allows editing of incentive data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(4);

		if (empty($id))
		{
			Template::set_message(lang('incentive_invalid_id'), 'error');
			redirect(SITE_AREA .'/company/incentive');
		}

		if (isset($_POST['save']))
		{
			//$this->auth->restrict('Incentive.Company.Edit');

			if ($this->save_incentive('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('incentive_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'incentive');

				Template::set_message(lang('incentive_edit_success'), 'success');
				redirect('incentive/company/incentive_list');
			}
			else
			{
				Template::set_message(lang('incentive_edit_failure') . $this->incentive_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			//$this->auth->restrict('Incentive.Company.Delete');

			if ($this->incentive_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('incentive_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'incentive');

				Template::set_message(lang('incentive_delete_success'), 'success');

				redirect('incentive/company_incentive_list');
			} else
			{
				Template::set_message(lang('incentive_delete_failure') . $this->incentive_model->error, 'error');
			}
		}



		Assets::add_js($this->load->view('inline_js/upload_image_ajax.js.php',null,true),'inline');
		Assets::add_module_css('incentive','create_incentive.css');

		$record=$this->incentive_model->find($id);
		console::log($record->incentive_image_path);
		$record->incentive_image_path=$this->load->module('incentive/commonauth')->get_incentive_image($record->incentive_image_path,'url');
		Template::set('incentive',$record);
		console::log($record->incentive_image_path);
		//Template::set('toolbar_title', lang('incentive_edit') . ' incentive');

		Template::render();
	}

	public function incentive_list($sort_option='Rencently_Added')
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
					if($this->delete_incentive_image($pid)) $result = $this->incentive_model->delete($pid);
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

		$company=$this->load->model('company/company_model')->find_by('company_userid',$this->auth->user_id());
		//There should be a function to check $company
		switch($sort_option)
		{
			case 'Rencently_Added': $field='created_on';$order='desc';$sort_option='Recently Added';break;
			case 'Most_Purchased': $field='incentive_amount_purchased';$order='desc';$sort_option='Most Purchased';break;
			case 'Least_Purchased': $field='incentive_amount_purchased';$order='asc';$sort_option='Least Purchased';break;
		}


		$this->incentive_model->order_by($field,$order);
		$records = $this->incentive_model->find_all_by('incentive_company_id',$company->id);
		//console::log($records[0]->incentive_image_path);
		if(isset($records)&&is_array($records)&&$records!=FALSE)
		{
			foreach($records as $record)
			{
				//console::log($record->incentive_image_path);
				$record->incentive_image_path=$this->load->module('incentive/commonauth')->get_incentive_image($record->incentive_image_path,'url');
				//console::log($record->incentive_image_path);
			}
		}
		//Assets::add_module_css('incentive','incentive.css');
		Assets::add_module_css('incentive','create_incentive.css');
		Template::set('records', $records);
		Template::set('sort_option',$sort_option);
		//	Template::set('toolbar_title', 'Manage incentive');
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


		//$this->form_validation->set_rules('incentive_company_id','company_id','max_length[11]|required');
		$this->form_validation->set_rules('incentive_name','name','max_length[25]|required');
		$this->form_validation->set_rules('incentive_description','description','max_length[140]');
		$this->form_validation->set_rules('incentive_price','price','max_length[11]|required|is_natural');
		$this->form_validation->set_rules('incentive_amount_left','Amount','max_length[11]|required|is_natural');
		if ($type == 'insert')	$this->form_validation->set_rules('incentive_image','Incentive image','file_required|file_allowed_type[image]');
		else
		{
			$incentive_image=$this->input->post('incentive_image');
			if($incentive_image['size']!==0)  $this->form_validation->set_rules('incentive_image','Incentive image','file_allowed_type[image]');
		}
			
		//$this->form_validation->set_rules('incentive_category_id','category_id','max_length[11]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want

		$data = array();
		/*
		 $company=$this->load->model('company/company_model')->find_by('company_userid',$this->auth->user_id());
		if ($company ===false) return false;
		$data['incentive_company_id']        = $company->id;
		*/
		$data['incentive_name']        = $this->input->post('incentive_name');
		$data['incentive_description']        = $this->input->post('incentive_description');
		$data['incentive_price']        = $this->input->post('incentive_price');
		$data['incentive_amount_left']        = $this->input->post('incentive_amount_left');

		//$data['incentive_category_id']        = $this->input->post('incentive_category_id');

		if ($type == 'insert')
		{
			$data['incentive_amount_purchased']        = 0;
			if($data = $this->incentive_model->upload_incentive($data))
			{
				/*
				 $path = './'.INCENTIVE_PATH;
				$this->load->helper('upload_helper');
				$fdata = my_upload('incentive_image',$path,'incentive');
					
				if(isset($fdata['error'])||!isset($fdata['upload_data']) || $fdata['upload_data'] == NULL){
					
				return FALSE;
				}
					
				//$data['company_logo'] = $path;
			 */
				console::log($data);
				$id = $this->incentive_model->insert($data);

				if (is_numeric($id))
				{
					$return = $id;
				} else
				{
					$return = FALSE;
				}
			}
			else
			{
				Template::set_message('There was a problem uploading the image');
				console::log('error');
				return FALSE;
			}

		}
		else if ($type == 'update')
		{

			$incentive_image=$this->input->post('incentive_image');
			if($incentive_image['size']!==0)
			{
				//if(!$this->delete_incentive_image($id))	return FALSE;
				$this->delete_incentive_image($id);
				$data = $this->incentive_model->upload_incentive($data);
			}


			/*
			 if(isset($data['incentive_image_path'])&& ($data['incentive_image_path']!=NULL))
				$delete_file=$this->load->module('incentive/commonauth')->get_incentive_image($data['incentive_image_path']);
			else
				console::log('error');
			*/

			$return = $this->incentive_model->update($id, $data);
		}

		return $return;
	}

	private function delete_incentive_image($id)
	{
		//$this->load->helper('file');
		$data=$this->incentive_model->find($id,1);
		if(!isset($data['incentive_image_path'])&& ($data['incentive_image_path']==NULL)) return FALSE;
		$delete_file=$this->load->module('incentive/commonauth')->get_incentive_image($data['incentive_image_path']);
		if($delete_file==NULL) return FALSE;
		return unlink($delete_file);
	}

	//--------------------------------------------------------------------



}