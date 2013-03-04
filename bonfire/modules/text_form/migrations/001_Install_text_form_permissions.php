<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_text_form_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
			array('name' => 'Text_form.Commonauth.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Commonauth.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Commonauth.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Commonauth.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Company.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Company.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Company.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Company.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.User.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.User.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.User.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.User.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Content.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Content.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Content.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Content.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Reports.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Reports.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Reports.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Reports.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Settings.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Settings.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Settings.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Settings.Delete', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Developer.View', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Developer.Create', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Developer.Edit', 'description' => '', 'status' => 'active',),
			array('name' => 'Text_form.Developer.Delete', 'description' => '', 'status' => 'active',),
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