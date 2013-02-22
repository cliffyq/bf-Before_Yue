<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class comment extends Front_Controller {
		
		//--------------------------------------------------------------------
		
		
		public function __construct()
		{
			parent::__construct();
			
			$this->load->library('form_validation');
			$this->load->model('comment_model', null, true);
			$this->lang->load('comment');
			
		}
		
		//--------------------------------------------------------------------
		
		
		
		/*
			Method: index()
			
			Displays a list of form data.
		*/
		public function index()
		{
			
			$records = $this->comment_model->find_all();
			
			Template::set('records', $records);
			Template::render();
		}
		
		//--------------------------------------------------------------------
		public function comment_panel ($vid = false, $per_page = 10, $offset = 0)
		{
			
			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'comment/comment_panel/'.$vid.'/'.$per_page.'/';
			$config['per_page'] = $per_page;
			$config['uri_segment'] = 5;
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li>';			
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$result = $this->comment_model->get_comment_pag($vid, $config['per_page'], $this->uri->segment($config['uri_segment']));
			$data['rows'] = $result['rows'];
			
			
			$config['total_rows'] = $result['row_count'];
			$this->pagination->initialize($config);
			$data['pagination_links'] = $this->pagination->create_links();
			$data['vid'] = $vid;
			
			$max = count($data['rows']) ;    //calculate the # of fetched items			
			for($i = 0; $i < $max; $i++){
				
				$data['rows'][$i]['created_on'] = $this->convert_time($data['rows'][$i]['created_on']);
			}
//			console::log(print_r($data['rows'],true));
			// load the view
			Assets::add_js($this->load->view('inline_js/pag_ajax.js.php',null,true),'inline');			
			
			if ($this->input->is_ajax_request()) {
				Template::set('rows',$data['rows']);
				Template::set('pagination_links',$data['pagination_links']);
				Template::set('vid',$data['vid']);
				Template::set_view($view = 'comment_panel_ajax');
				Template::render();
				
			   // $this->load->view('comment_user/comment_panel_ajax',$data);
			  // echo 'sdfsf';
			}
			else{
				return $this->load->view('comment_panel', $data, true);
				//Template::set($data);
				//Template::render();
			}
			//			return $this->load->view('comment_user/comment_panel', $data, true);
		}
		
		function convert_time($date){ 
			$time = strtotime($date); 
			$now = time(); 
			$ago = $now - $time; 
			if($ago < 60){ 
				$when = round($ago); 
				$s = ($when == 1)?"second":"seconds"; 
				return "$when $s ago"; 
				}elseif($ago < 3600){ 
				$when = round($ago / 60); 
				$m = ($when == 1)?"minute":"minutes"; 
				return "$when $m ago"; 
				}elseif($ago >= 3600 && $ago < 86400){ 
				$when = round($ago / 60 / 60); 
				$h = ($when == 1)?"hour":"hours"; 
				return "$when $h ago"; 
				}elseif($ago >= 86400 && $ago < 2629743.83){ 
				$when = round($ago / 60 / 60 / 24); 
				$d = ($when == 1)?"day":"days"; 
				return "$when $d ago"; 
				}elseif($ago >= 2629743.83 && $ago < 31556926){ 
				$when = round($ago / 60 / 60 / 24 / 30.4375); 
				$m = ($when == 1)?"month":"months"; 
				return "$when $m ago"; 
				}else{ 
				$when = round($ago / 60 / 60 / 24 / 365); 
				$y = ($when == 1)?"year":"years"; 
				return "$when $y ago"; 
			} 
		} 
		
		function load_parent_ajax ($vid, $comment_id){
			$result = $this->comment_model->get_parent_comment($comment_id);
			$data['rows'] = $result['rows'];
			$data['rows'][0]['created_on'] = $this->convert_time($data['rows'][0]['created_on']);
			$data['vid'] = $vid;
			
			Assets::add_js($this->load->view('inline_js/pag_ajax.js.php',null,true),'inline');		
			
			if ($this->input->is_ajax_request()){
				Template::set('rows',$data['rows']);
				Template::set('vid',$data['vid']);
				Template::set_view($view = 'load_parent_ajax');
				Template::render();
			}
		}
		//--------------------------------------------------------------------
		
		
		public function com_insert()
		{
		    $vid     =  $this->input->post('video_id');
			$content =  $this->input->post('comment_content');
			$reply_to = $this->input->post('reply_to');
			$parent_user = $this->input->post('parent_user');
			if(!$this->auth->is_logged_in())
			{
				echo 'Please log in to post your comment.';
			}
			elseif($vid !== false && $content !== false && $reply_to !== false)
			{
				$data = array();
				$data['comment_user_id']		 = $this->auth->user_id();
				$data['comment_user']        = $this->auth->identity();				
				$data['comment_ip']       	 = $this->input->ip_address();
				$data['comment_reply_to']    = $reply_to;
				$data['comment_parent_user'] = $parent_user;
				$data['comment_video_id']    = $vid;
				$data['comment_content']     = $content;
				if($this->comment_model->insert($data))
					echo true;
				else 
					echo "Submit failed. Please try again.";
			}
			else echo "Oops, something's wrong :(";			
		}
		
	}							