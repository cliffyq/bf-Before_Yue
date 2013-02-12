<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_pre_screen extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'prescreen_content' => array(
				'type' => 'VARCHAR',
				'constraint' => 30,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('pre_screen');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('pre_screen');

	}

	//--------------------------------------------------------------------

}