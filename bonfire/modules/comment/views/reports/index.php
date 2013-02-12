<div class="admin-box">
	<h3>Comment</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Comment.Reports.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Comment User ID</th>
					<th>Username</th>
					<th>IP</th>
					<th>Reply to</th>
					<th>Parent User</th>
					<th>Video ID</th>
					<th>Content</th>
					<th>Created</th>
					<th>Modified</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Comment.Reports.Delete')) : ?>
				<tr>
					<td colspan="10">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('comment_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Comment.Reports.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Comment.Reports.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/reports/comment/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->comment_user_id) ?></td>
				<?php else: ?>
				<td><?php echo $record->comment_user_id ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->comment_user?></td>
				<td><?php echo $record->comment_ip?></td>
				<td><?php echo $record->comment_reply_to?></td>
				<td><?php echo $record->comment_parent_user?></td>
				<td><?php echo $record->comment_video_id?></td>
				<td><?php echo $record->comment_content?></td>
				<td><?php echo $record->created_on?></td>
				<td><?php echo $record->modified_on?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="10">No records found that match your selection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>