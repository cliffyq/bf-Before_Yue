<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_video_question_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
			array('name' => 'Video_Question.Commonauth.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Commonauth.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Commonauth.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Commonauth.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Company.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Company.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Company.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Company.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.User.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.User.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.User.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.User.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Content.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Content.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Content.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Content.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Reports.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Reports.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Reports.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Reports.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Settings.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Settings.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Settings.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Settings.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Developer.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Developer.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Developer.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Video_Question.Developer.Delete', 'description' => '', 'status' => 'active',),
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