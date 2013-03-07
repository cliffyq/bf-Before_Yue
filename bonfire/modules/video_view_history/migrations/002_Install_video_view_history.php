<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_video_view_history extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
				),
				'video_view_history_video_id' => array(
						'type' => 'INT',
						'constraint' => 11,

				),
				'video_view_history_user_id' => array(
						'type' => 'BIGINT',
						'constraint' => 20,

				),
				'video_view_history_ip' => array(
						'type' => 'VARCHAR',
						'constraint' => 15,

				),
				'video_view_history_created_on' => array(
						'type' => 'TIMESTAMP',

				),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('video_view_history');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('video_view_history');

	}

	//--------------------------------------------------------------------

}