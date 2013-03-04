<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_purchase_history_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
			array('name' => 'Purchase_history.Commonauth.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Commonauth.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Commonauth.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Commonauth.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Company.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Company.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Company.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Company.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.User.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.User.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.User.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.User.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Content.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Content.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Content.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Content.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Reports.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Reports.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Reports.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Reports.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Settings.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Settings.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Settings.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Settings.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Developer.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Developer.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Developer.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Purchase_history.Developer.Delete', 'description' => '', 'status' => 'active',),
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