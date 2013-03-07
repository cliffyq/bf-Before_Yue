<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
			
	}

	public function  index()
	{
			
		Template:: render();
			
	}

	public function method()
	{
		$record_id = $this->input->post('p');
		//$record_id = $p['record_id'];
		//$record_id = $_POST['record_id];
		echo 'v';
		//echo $record_id['record_id'];
		//set the record ID
		//load the database library to connect to your database
		$this->load->module('comment');
		//inside your system/application/models folder, create a model based on the procedure
		//outlined in the CI documentation
		//$records = $this->comment_model->find_all_by($record_id);
		//$records = $this->comment_model->find_all();
		$records['records'] = $this->comment_model->find_all_by('comment_user',$record_id);
		//$records['records'] = $this->comment_model->find_all();
		//get the record from the database
		//Template::set('records',$records);
		//Template:: render();
		$this->load->view('method',$records);
	}
	public function echos()
	{
		//$data['post1'] = $this->input->post('p');
		$data['post1'] = $_POST;
		$data['get1']=$this->input->get();
		//echo $data['post1'];
		$a=array();
		$a[0] = 'something';
		/*if(isset($_POST))
			{
		$data['post'] =$_POST['record_id'];
			
		//$data['post'] =$a;
		}
		else*/
		/*if(isset($_POST))
			$data['post'] = $_POST;
		else
			$data['post'] = $a;*/
		$this->load->view('echos',$data);
		//Template::set('data',$data);
		//Template:: render();
	}

	public function New_test($id)
	{
		//$id='111';
		Template::set('id',$id);
		Assets::clear_cache();
		Assets::add_module_css('video','video-js.css');
		Assets::add_module_js('video','video.js');
		Assets::add_module_js('ajax','jquerycookie.js');
		Assets::add_module_js('ajax','ajax.js');
		Template:: render();
			

			
	}

	public function reload()
	{
			
		//$src['src']=$this->input->post('url');
		$src['src']=$_POST['url'];
		$this->load->view('reload',$src);
			
	}

}