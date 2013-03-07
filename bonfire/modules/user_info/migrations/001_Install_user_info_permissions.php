<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_user_info_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
			array('name' => 'User_Info.Commonauth.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Commonauth.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Commonauth.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Commonauth.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Company.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Company.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Company.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Company.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.User.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.User.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.User.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.User.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Content.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Content.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Content.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Content.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Reports.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Reports.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Reports.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Reports.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Settings.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Settings.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Settings.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Settings.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Developer.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Developer.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Developer.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_Info.Developer.Delete', 'description' => '', 'status' => 'active',),
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