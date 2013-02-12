<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_history_model extends BF_Model {

	protected $table		= "purchase_history";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = false;
	protected $created_field = "created_on";
}
