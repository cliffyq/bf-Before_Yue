<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Video_extra_information_model extends BF_Model {

	protected $table		= "video_extra_information_";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = true;
	protected $created_field = "created_on";
	protected $modified_field = "modified_on";
}
