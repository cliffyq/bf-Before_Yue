<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class company_personal_page extends Front_Controller {

	public function index(){
		Template::set_theme('main','junk');
		Template::set_view('/company_personal_page/cpp');
		Template::render();
	}

	public function create_thumnail(){
		$video = 'path/to/video.flv';
		$thumbnail = 'path/to/thumbnail.jpg';

		// shell command [highly simplified, please don't run it plain on your script!]
		shell_exec("ffmpeg -i $video -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $thumbnail 2>&1");
	}

}

