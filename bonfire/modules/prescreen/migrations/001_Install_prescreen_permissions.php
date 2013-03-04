<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_prescreen_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
			array('name' => 'Prescreen.Commonauth.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Commonauth.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Commonauth.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Commonauth.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Company.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Company.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Company.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Company.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.User.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.User.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.User.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.User.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Content.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Content.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Content.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Content.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Reports.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Reports.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Reports.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Reports.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Settings.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Settings.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Settings.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Settings.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Developer.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Developer.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Developer.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Prescreen.Developer.Delete', 'description' => '', 'status' => 'active',),
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