<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_incentive_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
		array('name' => 'Incentive.Commonauth.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Commonauth.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Commonauth.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Commonauth.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Company.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Company.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Company.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Company.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.User.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.User.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.User.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.User.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Content.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Content.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Content.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Content.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Reports.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Reports.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Reports.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Reports.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Settings.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Settings.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Settings.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Settings.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Developer.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Developer.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Developer.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Incentive.Developer.Delete', 'description' => '', 'status' => 'active',),
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