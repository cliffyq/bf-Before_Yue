<div class="admin-box">
	<h3>video view history</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<?php if ($this->auth->has_permission('Video_view_history.User.Delete') && isset($records) && is_array($records) && count($records)) : ?>
				<th class="column-check"><input class="check-all" type="checkbox" />
				</th>
				<?php endif;?>

				<th>video_id</th>

				<th>ip</th>
				<th>created_on</th>
			</tr>
		</thead>
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<tfoot>

		</tfoot>
		<?php endif; ?>
		<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
			<tr>
				<?php if ($this->auth->has_permission('Video_view_history.User.Delete')) : ?>
				<td><input type="checkbox" name="checked[]"
					value="<?php echo $record->id ?>" /></td>
				<?php endif;?>

				<?php if ($this->auth->has_permission('Video_view_history.User.Edit')) : ?>
				<td><?php echo anchor('/user/view/'. $record->video_view_history_video_id, '<i class="icon-pencil">&nbsp;</i>' .  $record->video_view_history_video_id) ?>
				</td>
				<?php else: ?>
				<td><?php echo $record->video_view_history_video_id ?></td>
				<?php endif; ?>

				<td><?php echo $record->video_view_history_ip?></td>
				<td><?php echo $record->video_view_history_created_on?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="5">No records found that match your selection.</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<?php echo form_close(); ?>
</div>
