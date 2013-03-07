
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class incentive extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();
			
		$this->load->library('form_validation');
		$this->load->model('prescreen_model', null, true);
		$this->lang->load('prescreen');
			
	}
	
	public function index(){
		Template::render();
	}
	
	public function v_divider(){
		Template::set_theme('two column','junk');
		Template::render();
	}
	
	
	
}