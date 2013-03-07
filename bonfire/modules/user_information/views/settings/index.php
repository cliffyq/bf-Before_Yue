<div class="admin-box">
	<h3>user information</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<?php if ($this->auth->has_permission('User_information.Settings.Delete') && isset($records) && is_array($records) && count($records)) : ?>
				<th class="column-check"><input class="check-all" type="checkbox" />
				</th>
				<?php endif;?>

				<th>user_id</th>
				<th>current_points</th>
			</tr>
		</thead>
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<tfoot>
			<?php if ($this->auth->has_permission('User_information.Settings.Delete')) : ?>
			<tr>
				<td colspan="3"><?php echo lang('bf_with_selected') ?> <input
					type="submit" name="delete" id="delete-me" class="btn btn-danger"
					value="<?php echo lang('bf_action_delete') ?>"
					onclick="return confirm('<?php echo lang('user_information_delete_confirm'); ?>')">
				</td>
			</tr>
			<?php endif;?>
		</tfoot>
		<?php endif; ?>
		<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
			<tr>
				<?php if ($this->auth->has_permission('User_information.Settings.Delete')) : ?>
				<td><input type="checkbox" name="checked[]"
					value="<?php echo $record->id ?>" /></td>
				<?php endif;?>

				<?php if ($this->auth->has_permission('User_information.Settings.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/settings/user_information/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->user_information_user_id) ?>
				</td>
				<?php else: ?>
				<td><?php echo $record->user_information_user_id ?></td>
				<?php endif; ?>

				<td><?php echo $record->user_information_current_points?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="3">No records found that match your selection.</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<?php echo form_close(); ?>
</div>
