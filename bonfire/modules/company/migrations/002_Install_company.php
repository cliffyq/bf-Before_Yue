<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_company extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
				),
				'company_name' => array(
						'type' => 'VARCHAR',
						'constraint' => 100,

				),
				'company_logo' => array(
						'type' => 'VARCHAR',
						'constraint' => 255,

				),
				'company_url' => array(
						'type' => 'VARCHAR',
						'constraint' => 255,

				),
				'company_industry_id' => array(
						'type' => 'TINYINT',
						'constraint' => 3,

				),
				'company_description' => array(
						'type' => 'VARCHAR',
						'constraint' => 1000,

				),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('company');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('company');

	}

	//--------------------------------------------------------------------

}