<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_info_model extends BF_Model {

	protected $table		= "user_info";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;



	public function get_user_info($uid)
	{
		return $this->find_by('user_info_user_id', $uid, 'and', 1);
	}
}
