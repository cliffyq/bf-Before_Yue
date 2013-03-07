<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class video extends Front_Controller {
		
		//--------------------------------------------------------------------
		
		
		public function __construct()
		{
			parent::__construct();
			
			$this->load->library('form_validation');
			$this->load->model('video_model', null, true);
			$this->lang->load('video');
			
		}
		
		//--------------------------------------------------------------------
		
		
		
		/*
			Method: index()
			
			Displays a list of form data.
		*/
		public function index()
		{
			
			$records = $this->video_model->find_all();
			
			Template::set('records', $records);
			Template::render();
		}
		
		//--------------- user view -------------------------------------------
		
		public function view($vid)
		{
			Assets::add_module_css('video','video-js.css');
			Assets::add_module_js('video','video.js');
			Assets::add_js($this->load->view('inline_js/videofunction',null,TRUE),'inline');
			
			if (empty($vid))
			{
				Template::set_message(lang('video_invalid_id'), 'error');
				redirect(SITE_AREA .'/content/video');
			}
			
			if($data['records'] = $this->video_model->find($vid))
			{
				
				if($this->session->session_get_viewed_video($vid) !== false) 
				$data['video_class'] = 'video-js vjs-default-skin scrollable';
				else $data['video_class'] = 'video-js vjs-default-skin';
				$data['vid'] = $vid;
				
				return  $this->load->view('view',$data,true);
				//Template::set($data);
				//Template ::render();
			} 
			else
			return  false;
			
		}
		
		public function _video_panel($vid)
		{
			if (empty($vid))
			{
				Template::set_message(lang('video_invalid_id'), 'error');
				redirect(SITE_AREA .'/content/video');
			}
			
			$this->load->model('video_view_history/video_view_history_model', null, true);
			if($data['video']=$this->view($vid))
			{
				$data['count']=$this->video_view_history_model->get_view_count($vid);
				
				$data['company']=$this->video_model->get_company($vid);
				$video_info=$this->video_model->find_by('id', $vid, 'and', 1);
				//console::log(print_r($video_info, true));
				$data['title'] = $video_info['video_title'];
				$data['average_rating']=$this->load->module('reviews')->avg_rating($vid);
				
				$points_earned=$this->load->model('video_extra_information/video_extra_information_model')->find_by('video_extra_information_video_id',$vid);
				if($points_earned !== false)
				$data['points_earned']=$points_earned;
				else 
				$data['points_earned']->video_extra_information_points=0;
				return  $this->load->view('video_panel',$data,true);
			}
			else
			{
				Template::set_message(lang('video_invalid_id'), 'error');
				redirect('user');
			}
			//Template::set($data);
			//Template ::render();
		}
		
		public function video_card($video,$index)
		{
			$video['position']=$index+1;
			$data['video']=$video;
			//console::log($video);
			$data['company']=$this->video_model->get_company($video['id']);
			Assets::add_module_css('video','video_card.css');
			
			return  $this->load->view('video_card',$data,true);
			/*
			Template::set('company',$company);
			Template::set('video',$video);
			Template::render();
			*/
		}
		
		
}
