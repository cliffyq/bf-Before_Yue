<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_user_information_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
			array('name' => 'User_information.Commonauth.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Commonauth.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Commonauth.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Commonauth.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Company.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Company.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Company.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Company.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.User.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.User.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.User.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.User.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Content.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Content.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Content.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Content.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Reports.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Reports.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Reports.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Reports.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Settings.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Settings.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Settings.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Settings.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Developer.View', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Developer.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Developer.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'User_information.Developer.Delete', 'description' => '', 'status' => 'active',),
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