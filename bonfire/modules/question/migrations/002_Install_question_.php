<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_question_ extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
				),
				'question_content' => array(
						'type' => 'VARCHAR',
						'constraint' => 140,

				),
				'question_answer_id' => array(
						'type' => 'INT',
						'constraint' => 11,

				),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('question_');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('question_');

	}

	//--------------------------------------------------------------------

}