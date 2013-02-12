<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_purchase_history extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'purchase_history_user_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'purchase_history_incentive_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'created_on' => array(
				'type' => 'datetime',
				'default' => '0000-00-00 00:00:00',
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('purchase_history');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('purchase_history');

	}

	//--------------------------------------------------------------------

}