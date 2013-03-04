<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class themetest extends Admin_Controller {
		
		//--------------------------------------------------------------------
		
		
		public function __construct()
		{
			parent::__construct();
			
			$this->load->library('form_validation');
			$this->load->model('prescreen_model', null, true);
			$this->lang->load('prescreen');
			
		}
		
		
		public function topbug()
		{
			Template::set_theme('two column','junk');
			Template::render();
		}
		
		public function videojs()
		{
		   $video = $this->load->module('video')->view(47);
			template::set('videos',$video);
			Template::render();
		}
		
		public function foreachtest()
		{
			$A=array('a'=>array('1','2'),'b'=>array('3','4'));
			//$A=array('a'=>'o','b'=>'p');
			
			console::log($A);
			
			foreach ($A as &$aa)
			{
				
				$aa['c']='new';
			}
			
			//$A['c']='q';
			console::log($A);
			Template::render();
		}
		
		public function multisort()
		{
			$A=array('a'=>array('1','x'),'b'=>array('3','y'),'c'=>array('2','z'));
			console::log($A);
			foreach($A as $key=>$row)
			{
				$username[$key]=$row[0];
				$accuracy[$key]=$row[1];
			}
			
			array_multisort($accuracy,SORT_ASC,$A);
			console::log($A);
			template::render();
			
		}
		
		public function videosort()
		{
			$limit = 2; $offset = 1;
			$return = array('rows'=>array(),'row_count'=>0);
			
			// orderby viewcount, other options should use DB query.
			$results=$this->load->model('video/video_model')->find_all(1);
		
			foreach ($results as $key=>&$result)
			{
				$result['viewcount']=$this->load->model('video_view_history/video_view_history_model')->get_view_count($result['id']);
				$viewcount[$key]=$result['viewcount'];
				$return['row_count']++;
			}
			array_multisort($viewcount,SORT_DESC,$results);
			$return['rows']=array_slice($results,$offset*$limit,$limit);
			

			console::log($return);
		}
		
		public function dropdown()
		{
			Template::render();
		}
		public function span()
		{
			Template::render();
		}
		
		public function timetest()
		{
			$newdate="yesterday";
			$time= strtotime("yesterday");
			console::log($time);
			
			$time= strtotime("now");
			console::log($time);
			$date="day";
			$time=strtotime("today-1".$date);
			$old=$this->load->model('video/video_model')->find(47,1);
			console::log($time);
			console::log($old['created_on']);
			console::log($time>$old['created_on']?'1':'2');
		}
		
		public function toprated()
		{
			//$result=$this->load->model('reviews/reviews_model')->average_rating(47);
			$option='toprated';
			$results=$this->load->model('video/video_model')->find_all(1);
			foreach ($results as $key=>&$result)
		{
				$result[$option]=$this->load->model('reviews/reviews_model')->average_rating($result['id']);
				$viewcount[$key]=$result[$option];
			
		}
			console::log($results);
		}

		
		
}
