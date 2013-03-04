<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_user_info extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
				),
				'user_info_user_id' => array(
						'type' => 'INT',
						'constraint' => 11,

				),
				'user_info_first_name' => array(
						'type' => 'CHAR',
						'constraint' => 25,

				),
				'user_info_last_name' => array(
						'type' => 'CHAR',
						'constraint' => 25,

				),
				'user_info_gender' => array(
						'type' => 'TINYINT',
						'constraint' => 1,

				),
				'user_info_birth_month' => array(
						'type' => 'INT',
						'constraint' => 2,

				),
				'user_info_birth_year' => array(
						'type' => 'INT',
						'constraint' => 4,

				),
				'user_info_race' => array(
						'type' => 'CHAR',
						'constraint' => 30,

				),
				'user_info_tutorial_flag' => array(
						'type' => 'TINYINT',
						'constraint' => 1,

				),
				'user_info_education' => array(
						'type' => 'CHAR',
						'constraint' => 20,

				),
				'user_info_veteran' => array(
						'type' => 'TINYINT',
						'constraint' => 1,

				),
				'user_info_zipcode' => array(
						'type' => 'INT',
						'constraint' => 5,

				),
				'user_info_industry_id' => array(
						'type' => 'TINYINT',
						'constraint' => 3,

				),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('user_info');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('user_info');

	}

	//--------------------------------------------------------------------

}