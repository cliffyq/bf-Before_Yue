<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Addresses_model extends BF_Model {

	protected $table		= "addresses";
	protected $key			= "addresses_zip";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;
}
