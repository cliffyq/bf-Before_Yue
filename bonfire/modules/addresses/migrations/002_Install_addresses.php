<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

		class Migration_Install_addresses extends Migration {

				public function up()
				{
				$prefix = $this->db->dbprefix;

				$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
						),
			'addresses_zip' => array(
					'type' => 'VARCHAR',
							'constraint' => 5,
			
			),
			'addresses_city' => array(
					'type' => 'VARCHAR',
							'constraint' => 100,
			
			),
			'addresses_state' => array(
					'type' => 'VARCHAR',
							'constraint' => 2,
			
			),
			'addresses_latitude' => array(
					'type' => 'FLOAT',
							'constraint' => 9,6,
			
			),
			'addresses_longitude' => array(
					'type' => 'FLOAT',
							'constraint' => 9,6,
			
			),
			'addresses_timezone' => array(
					'type' => 'SMALLINT',
							'constraint' => 2,
			
			),
			'addresses_dst' => array(
					'type' => 'TINYINT',
							'constraint' => 1,
			
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
				$this->dbforge->create_table('addresses');

}

						//--------------------------------------------------------------------

						public function down()
						{
						$prefix = $this->db->dbprefix;

						$this->dbforge->drop_table('addresses');

}

								//--------------------------------------------------------------------

}