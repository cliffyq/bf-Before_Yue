<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_user_information_ extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
				),
				'user_information_user_id' => array(
						'type' => 'INT',
						'constraint' => 11,

				),
				'user_information_current_points' => array(
						'type' => 'INT',
						'constraint' => 11,

				),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('user_information_');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('user_information_');

	}

	//--------------------------------------------------------------------

}