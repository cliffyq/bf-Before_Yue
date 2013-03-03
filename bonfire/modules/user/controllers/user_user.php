<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class user extends __Controller {

	//--------------------------------------------------------------------

	public function __construct() {
		parent::__construct();

		$this -> load -> library('form_validation');
		$this -> load -> model('company_model', null, true);
		$this -> lang -> load('company');
	}

	//--------------------------------------------------------------------

	/*
	 Method: index()

	 Displays a list of form data.
	 */
	public function index() {

	}

}
