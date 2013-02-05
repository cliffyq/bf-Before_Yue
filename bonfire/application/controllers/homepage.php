<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class homepage extends Front_Controller {
		
		//--------------------------------------------------------------------
		
		public function index()
		{
			Template::set_theme('main','junk');
			Template::render();
		}
	}		