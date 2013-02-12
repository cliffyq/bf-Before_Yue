<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_comment extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'comment_user_id' => array(
				'type' => 'BIGINT',
				'constraint' => 20,
				
			),
			'comment_user' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				
			),
			'comment_ip' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				
			),
			'comment_reply_to' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'comment_parent_user' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				
			),
			'comment_video_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'comment_content' => array(
				'type' => 'VARCHAR',
				'constraint' => 500,
				
			),
			'created_on' => array(
				'type' => 'datetime',
				'default' => '0000-00-00 00:00:00',
			),
			'modified_on' => array(
				'type' => 'datetime',
				'default' => '0000-00-00 00:00:00',
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('comment');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('comment');

	}

	//--------------------------------------------------------------------

}