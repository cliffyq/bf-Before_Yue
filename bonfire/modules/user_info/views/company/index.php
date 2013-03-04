<div class="admin-box">
	<h3>User Info</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<?php if ($this->auth->has_permission('User_Info.Company.Delete') && isset($records) && is_array($records) && count($records)) : ?>
				<th class="column-check"><input class="check-all" type="checkbox" />
				</th>
				<?php endif;?>

				<th>User ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>Birth Month</th>
				<th>Birth Year</th>
				<th>Race</th>

				<th>Tutorial Flag</th>
				<th>Education</th>
				<th>Veteran</th>
				<th>Zipcode</th>
				<th>Industry ID</th>
			</tr>
		</thead>
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<tfoot>
			<?php if ($this->auth->has_permission('User_Info.Company.Delete')) : ?>
			<tr>
				<td colspan="15"><?php echo lang('bf_with_selected') ?> <input
					type="submit" name="delete" id="delete-me" class="btn btn-danger"
					value="<?php echo lang('bf_action_delete') ?>"
					onclick="return confirm('<?php echo lang('user_info_delete_confirm'); ?>')">
				</td>
			</tr>
			<?php endif;?>
		</tfoot>
		<?php endif; ?>
		<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
			<tr>
				<?php if ($this->auth->has_permission('User_Info.Company.Delete')) : ?>
				<td><input type="checkbox" name="checked[]"
					value="<?php echo $record->id ?>" /></td>
				<?php endif;?>

				<?php if ($this->auth->has_permission('User_Info.Company.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/company/user_info/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->user_info_user_id) ?>
				</td>
				<?php else: ?>
				<td><?php echo $record->user_info_user_id ?></td>
				<?php endif; ?>

				<td><?php echo $record->user_info_first_name?></td>
				<td><?php echo $record->user_info_last_name?></td>
				<td><?php echo $record->user_info_gender?></td>
				<td><?php echo $record->user_info_birth_month?></td>
				<td><?php echo $record->user_info_birth_year?></td>
				<td><?php echo $record->user_info_race?></td>
				<td><?php echo $record->user_info_tutorial_flag?></td>
				<td><?php echo $record->user_info_education?></td>
				<td><?php echo $record->user_info_veteran?></td>
				<td><?php echo $record->user_info_zipcode?></td>
				<td><?php echo $record->user_info_industry_id?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="15">No records found that match your selection.</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<?php echo form_close(); ?>
</div>
