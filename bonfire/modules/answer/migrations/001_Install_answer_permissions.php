<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_answer_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
			array('name' => 'Answer.Commonauth.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Commonauth.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Commonauth.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Commonauth.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Company.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Company.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Company.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Company.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.User.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.User.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.User.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.User.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Content.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Content.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Content.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Content.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Reports.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Reports.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Reports.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Reports.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Settings.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Settings.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Settings.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Settings.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Developer.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Developer.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Developer.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Answer.Developer.Delete', 'description' => '', 'status' => 'active',),
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