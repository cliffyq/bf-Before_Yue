<?php
class Ajax1 extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('news_model');
		//$this->load->helper('url');
			
	}

	function index()
	{
		$this->load->view('ajax1/index');
	}

	function method()
	{
		$data['results']=$this->input->post('key');
		//$data['results']= "WTF"  ;
		//echo $data['results'];
		$this->load->view('ajax1/record',$data);
	}
}