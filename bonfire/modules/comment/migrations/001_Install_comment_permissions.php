<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_comment_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
			array('name' => 'Comment.Commonauth.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Commonauth.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Commonauth.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Commonauth.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Company.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Company.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Company.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Company.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.User.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.User.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.User.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.User.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Content.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Content.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Content.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Content.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Reports.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Reports.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Reports.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Reports.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Settings.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Settings.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Settings.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Settings.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Developer.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Developer.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Developer.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Comment.Developer.Delete', 'description' => '', 'status' => 'active',),
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