<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
	}

	//--------------------------------------------------------------------



	/*
	 Method: index()

	Displays a list of form data.
	*/
	public function index()
	{
		$src['src']=$_POST["url"];
		/*echo'
			<video id="video_3" class="video-js vjs-default-skin" controls preload="none" width="640" height="385"
		data-setup="{}">
		<source src='.$src.' type="video/mp4" />
		</video>';
		*/
			
		$this->load->view('ajax/reload_video',$src);
	}





}