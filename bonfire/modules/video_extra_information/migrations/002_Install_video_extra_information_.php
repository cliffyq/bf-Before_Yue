<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_video_extra_information_ extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
				),
				'video_extra_information_video_id' => array(
						'type' => 'INT',
						'constraint' => 11,

				),
				'video_extra_information_points' => array(
						'type' => 'INT',
						'constraint' => 11,

				),
				'created_on' => array(
						'type' => 'datetime',
						'default' => '0000-00-00 00:00:00',
				),
				'modified_on' => array(
						'type' => 'datetime',
						'default' => '0000-00-00 00:00:00',
				),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('video_extra_information_');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('video_extra_information_');

	}

	//--------------------------------------------------------------------

}