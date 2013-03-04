<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class prescreen extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
			
		$this->load->library('form_validation');
		$this->load->model('prescreen_model', null, true);
		$this->lang->load('prescreen');
			
	}

	/*
	 Method: index()

	Displays a list of form data.
	*/
	public function index()
	{
			
		$records = $this->prescreen_model->find_all();
			
		Template::set('records', $records);
		Template::render();
	}

	//------------------------------------------session------------------------------------------------------
	// previous screen  for  My_session
	function session_load_viewed_videos()
	{
		$this->CI->load->model('video_view_history/video_view_history_model');
		$previous = $this->CI->video_view_history_model->get_viewed_videos($this->CI->auth->user_id());
		$viewed_videos = array('previous'=>$previous,'new'=>array());
		$viewed_videos_json = json_encode($viewed_videos);
		$this->set_userdata('viewed_videos',$viewed_videos_json);
	}

	function session_set_viewed_video($vid)
	{
			
		$viewed_videos = json_decode($this->userdata('viewed_videos'), true);
		if(isset($viewed_videos['new']))
		{
			foreach($viewed_videos['new'] as $v)
			{
				if ($v == $vid)
				{
					return false;
				}
			}
		}
		if(isset($viewed_videos['previous']))
		{
			foreach($viewed_videos['previous'] as $v)
			{
				if ($v == $vid)
				{
					return false;
				}
			}
		}
		$viewed_videos['new'][] = $vid;
		$this->set_userdata('viewed_videos',json_encode($viewed_videos));
		return true;
	}

	//return previous viewed video or false if not found
	function session_get_viewed_video($vid)
	{
		$viewed_videos_json = $this->userdata('viewed_videos');
		if ($viewed_videos_json !== false){
			$viewed_videos = json_decode($viewed_videos_json, true);
			foreach ($viewed_videos['new'] as $row)
			{
				if($row['vid'] == $vid)
				{
					return $row['vid'];
				}
			}
			foreach ($viewed_videos['previous'] as $row)
			{
				if($row == $vid)
				{
					return $row;
				}
			}
		}
		return false;
	}

	function session_store_viewed_videos()
	{
			
		$data = array();
		$viewed_videos_json = $this->userdata('viewed_videos');
		$viewed_videos = json_decode($viewed_videos_json,true);
		if(empty($viewed_videos['new'])) return;
		$uid = $this->userdata('user_id');
		$this->CI->load->model('video_view_history/video_view_history_model');
		foreach($viewed_videos['new'] as $v)
		{
			$data[] = array('video_view_history_video_id'=>$v['vid'],'video_view_history_user_id'=>$uid,'video_view_history_ip'=>$this->CI->input->ip_address(),'video_view_history_created_on'=>$v['ts']);
		}
		if(!empty($data))
			$this->CI->video_view_history_model->insert_batch($data);
	}

	public function test_session_viewed_video()
	{
		//------------set-----------
		//$this->session->session_set_viewed_video(47);
			
		//------------get---------------------
		/*
		 $viewed_video=$this->session->session_get_viewed_video($vid);
		if ($viewed_video)
		{
		console::log(print_r($viewed_video,true));

		}
		else
			console::log('sorry');
		*/
		//------------store---------------------
			
		$this->session->session_store_viewed_videos();
	}
	//------------------------------------------------video--------------------------------------------

	public function view($vid)
	{
			
		if (empty($vid))
		{
			Template::set_message(lang('video_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/video');
		}
			
		$this->load->model('video/video_model');
		$data['records'] = $this->video_model->find($vid);
			
		if($this->session->session_get_viewed_video($vid))
		{
			$data['video_class'] = 'video-js vjs-default-skin scrollable';
		}
		else
		{
			$data['video_class'] = 'video-js vjs-default-skin';
		}
		$data['vid'] = $vid;
			
		$this->load->view('content/view',$data);
			
	}

	//---------------------------------------test -------------------------------------------------------------

	public function test_array_unique()
	{
		$a=array(array('a'=>22,'b'=>22),array('a'=>11,'b'=>33),44);
		console:: log(print_r($a,true));
		$b=array_unique($a);
		console:: log(print_r($b,true));
			
	}

	public function ud()
	{
		print_r($this->session->userdata('viewed_videos'));
	}



	public function test_time()
	{
		console::log(print(time()));
		console::log(print(date('Y-m-d')));
	}

	public function test_foreach()
	{
		$vid=46;
		console ::log($vid);
		$viewed_videos = json_decode($this->session->userdata('viewed_videos'), true);
		if(isset($viewed_videos['new']))
		{
			foreach($viewed_videos['new'] as $v)
			{
				if ($v == $vid)
				{
					console::log ('has');
				}
				else
					console:: log('sorry');
			}
		}
			
	}

	public function  ajax_test()
	{
		Assets::add_js($this->load->view('inline',null,true),'inline');
		Template::render();
	}

	public function ajax_request()
	{
		Template::render();
	}

	public function  multi_call()
	{
		$data['first']=$this->first_call();
		$data['second']=$this->second_call();
		template::set($data);
		template::render();
	}

	public function  first_call()
	{
		$data['second']= $this->second_call();
		return $this->load->view('multi_call/first',$data,true);
	}

	public function  second_call()
	{
		return $this->load->view('multi_call/second',null,true);
	}

	public function  average()
	{
			
		$a=array();
		$obj=$this->load->model('reviews/reviews_model')->find_all_by('reviews_video_id',47);
		foreach ($obj  as $v)
		{
			$a[]= $v->reviews_rating;
		}
		console ::log(print_r($a));
		$s=array_sum($a);
		$c=count($a);
		$ave = (int)($s/$c);
		console ::log(print($ave));

	}
	public function test_str()
	{
		console::log('test');
		$a='abcde';
		if(strpos($a, 'http://')!==false)
		{
			console::log('Yeah');
		}
	}

	//--------------------------------------toggle--------------------------------------------------
	public function toggle()
	{
		Assets:: Add_js($this->load->view('toggle.js.php',null,true),'inline');
		Template::render();

	}
	//-----------------------------------incentive--------------------------------------------------
	public function show_points($id)
	{
			
		//$data=$this->load->model('incentive/incentive_model')->get_points($id);
		//$data=$this->load->model('user_information/user_information_model')->reduce_points(3,$id);
		$data=$this->load->model('user_information/user_information_model')->add_points(3,$id);
		if($data == -1)  print_r('You donnot have enough points');
		else
			print_r('your current points is '.$data);
			
	}

	public function reduce_points($points)
	{
		$data=$this->load->model('user_information/user_information_model')->reduce_points(3,$points);
		print_r($data);
		//Template::set('data',$data);
		//Template::render();
			
	}

	public function  confirm()
	{
		assets::add_module_js('incentive','jquery.confirm-1.3.js');
		assets::add_js($this->load->view('incentive/confirm.js.php',null,true),'inline');
		Template::render();
	}

	public function  show_current_points()
	{
		Template::render();
	}

	//------------------------------bootstrap----------------------------------------------------------

	public function fluid()
	{
		template::render();
	}

	public function  sub_nav()
	{
		Template::set('toolbar_title', 'New');
		Template::set_block('sub_nav','new_nav');
		Template::render();
			
	}



}