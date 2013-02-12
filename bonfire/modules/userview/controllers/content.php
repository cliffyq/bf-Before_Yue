<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class content extends Admin_Controller {
		
		//--------------------------------------------------------------------
		
		
		public function __construct()
		{
			parent::__construct();
			
			$this->auth->restrict('Userview.Content.View');
			//$this->load->model('userview_model', null, true);
			
			$this->load->module('comment');
			$this->load->module('video');
			
			//$this->lang->load('userview');
			Template::set_block('sub_nav', 'content/_sub_nav');
		}
		
		//--------------------------------------------------------------------
		
		
		
		/*
			Method: index()
			
			Displays a list of form data.
		*/
		public function index()
		{
			$this->load->module('video');
			
			
			$records = $this->video->get_data();
			
			Template::set('records', $records);
			Template::set('toolbar_title', 'Userview');
			Template::render();
		}
		
		public function view()
		{
			
			
			$id = $this->uri->segment(5);
			
			
			//video part
			
			if (empty($id))
			{
				Template::set_message(lang('video_invalid_id'), 'error');
				redirect(SITE_AREA .'/content/userview');
			}
			
			
			$video_records = $this->video_model->find($id);
			
			
			//comment part
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
			
			
			
			//$video_id=  'comment_video_id ='.$id;
			$comment_records = $this->comment_model->find_all_by('comment_video_id ='.$id);
			//$comment_records = $this->comment_model->find_all_by('comment_video_id = 1');
			
			
			
			Assets::clear_cache();
			Assets::add_module_css('video','video-js.css');
			Assets::add_module_js('video','video.js');
			Assets::add_js($this->load->view('content/videofunction',null,true),'inline');
			
			Template::set('comment_records', $comment_records);
			Template::set('video_records', $video_records);
			
			Template::set('toolbar_title', 'Userview');
			Template::set('id',$id);
			
			Template:: render();
			
			
			
			
		}
		
		public function create()
		{
			$this->auth->restrict('Comment.Content.Create');
			$id = $this->uri->segment(5);
			
			$this->form_validation->set_rules('comment_content','content','required|max_length[300]');
			
			if ($this->form_validation->run() === FALSE)
			{
				return FALSE;
			}
			$data = array();
			$data['comment_user']        = $this->auth->identity();
			$data['comment_content']        = $this->input->post('comment_content');
			$data['comment_ip']        = $_SERVER["REMOTE_ADDR"];
			$data['comment_reply_to']        = '1';
			$data['comment_video_id']        = $this->uri->segment(5);
			
			
			if ($insert_id = $this->comment_model->insert($data))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('comment_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'comment');
				
				Template::set_message(lang('comment_create_success'), 'success');
				Template::redirect(SITE_AREA .'/content/comment');
			}
			else
			{
				Template::set_message(lang('comment_create_failure') . $this->comment_model->error, 'error');
			}
			
			$comment_records = $this->comment_model->find_all();
			Template::set('comment_records', $comment_records);
			Template::render();
		}
		
		//--------------------------------------------------------------------
		public function save_data()
		{
			$records['records'] = $this->comment_model->find_all();
			$this->load->view('content/save_data',$records);
			
		}
		
		public function test_theme()
		{
			Assets::add_js($this->load->module('reviews')->rating_ajax(),'inline');
			Template::render();
		}
		
		
		
	}		