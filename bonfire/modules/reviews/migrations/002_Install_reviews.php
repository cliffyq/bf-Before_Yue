<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_reviews extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
				),
				'reviews_video_id' => array(
						'type' => 'INT',
						'constraint' => 11,

				),
				'reviews_user_id' => array(
						'type' => 'BIGINT',
						'constraint' => 20,

				),
				'reviews_answers' => array(
						'type' => 'VARCHAR',
						'constraint' => 50,

				),
				'reviews_rating' => array(
						'type' => 'TINYINT',
						'constraint' => 1,

				),
				'reviews_comment_id' => array(
						'type' => 'INT',
						'constraint' => 11,

				),
				'reviews_last_update' => array(
						'type' => 'TIMESTAMP',

				),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('reviews');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('reviews');

	}

	//--------------------------------------------------------------------

}