<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_incentive extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'incentive_company_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'incentive_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 25,
				
			),
			'incentive_description' => array(
				'type' => 'VARCHAR',
				'constraint' => 140,
				
			),
			'incentive_price' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'incentive_category_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('incentive');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('incentive');

	}

	//--------------------------------------------------------------------

}