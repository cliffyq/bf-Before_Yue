<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_question_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
			array('name' => 'Question.Commonauth.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Commonauth.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Commonauth.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Commonauth.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Company.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Company.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Company.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Company.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.User.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.User.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.User.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.User.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Content.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Content.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Content.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Content.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Reports.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Reports.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Reports.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Reports.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Settings.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Settings.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Settings.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Settings.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Developer.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Developer.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Developer.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Question.Developer.Delete', 'description' => '', 'status' => 'active',),
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