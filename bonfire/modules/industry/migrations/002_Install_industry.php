<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_industry extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
				),
				'industry_industry_name' => array(
						'type' => 'VARCHAR',
						'constraint' => 40,

				),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('industry');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('industry');

	}

	//--------------------------------------------------------------------

}