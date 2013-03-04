<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Video_stats
{
	protected $ci;
	private static $stats = array('1211');
	public function __construct()
	{
			
		$this->ci =& get_instance();
			
	}

	public static function update($user_id = '')
	{
		self::$stats[] = array('uid'=>$user_id);
	}

	public static function get_stats()
	{
		return self::$stats;
	}
}