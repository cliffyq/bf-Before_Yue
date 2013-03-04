<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_video extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
				),
				'video_title' => array(
						'type' => 'VARCHAR',
						'constraint' => 50,

				),
				'video_company_id' => array(
						'type' => 'MEDIUMINT',
						'constraint' => 6,

				),
				'video_description' => array(
						'type' => 'VARCHAR',
						'constraint' => 140,

				),
				'video_length' => array(
						'type' => 'SMALLINT',
						'constraint' => 4,

				),
				'video_path' => array(
						'type' => 'VARCHAR',
						'constraint' => 255,

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
		$this->dbforge->create_table('video');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('video');

	}

	//--------------------------------------------------------------------

}