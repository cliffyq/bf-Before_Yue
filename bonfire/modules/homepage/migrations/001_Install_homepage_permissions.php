<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_homepage_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
		array('name' => 'Homepage.Content.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Content.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Content.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Content.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Reports.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Reports.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Reports.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Reports.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Settings.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Settings.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Settings.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Settings.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Developer.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Developer.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Developer.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Homepage.Developer.Delete', 'description' => '', 'status' => 'active',),
	);

	//--------------------------------------------------------------------

	public function up()
	{
		$prefix = $this->db->dbprefix;

		// permissions
		foreach ($this->permission_values as $permission_value)
		{
			$permissions_data = $permission_value;
			$this->db->insert("permissions", $permissions_data);
			$role_permissions_data = array('role_id' => '1', 'permission_id' => $this->db->insert_id(),);
			$this->db->insert("role_permissions", $role_permissions_data);
		}
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

        // permissions
		foreach ($this->permission_values as $permission_value)
		{
			$query = $this->db->select('permission_id')->get_where("permissions", array('name' => $permission_value['name'],));
			foreach ($query->result_array() as $row)
			{
				$permission_id = $row['permission_id'];
				$this->db->delete("role_permissions", array('permission_id' => $permission_id));
			}
			$this->db->delete("permissions", array('name' => $permission_value['name']));

		}
	}

	//--------------------------------------------------------------------

}