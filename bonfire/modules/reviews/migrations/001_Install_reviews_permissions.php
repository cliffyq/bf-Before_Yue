<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_reviews_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
			array('name' => 'Reviews.Commonauth.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Commonauth.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Commonauth.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Commonauth.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Company.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Company.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Company.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Company.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.User.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.User.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.User.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.User.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Content.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Content.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Content.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Content.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Reports.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Reports.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Reports.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Reports.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Settings.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Settings.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Settings.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Settings.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Developer.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Developer.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Developer.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Reviews.Developer.Delete', 'description' => '', 'status' => 'active',),
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