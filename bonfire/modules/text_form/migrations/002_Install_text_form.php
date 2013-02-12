<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_text_form extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'text_form_edu' => array(
				'type' => 'CHAR',
				'constraint' => 'phd', 'master', 'undergraduate',
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('text_form');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('text_form');

	}

	//--------------------------------------------------------------------

}