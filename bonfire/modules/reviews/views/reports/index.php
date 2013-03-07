<div class="admin-box">
	<h3>Reviews</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<?php if ($this->auth->has_permission('Reviews.Reports.Delete') && isset($records) && is_array($records) && count($records)) : ?>
				<th class="column-check"><input class="check-all" type="checkbox" />
				</th>
				<?php endif;?>

				<th>Video ID</th>
				<th>User ID</th>
				<th>Answers</th>
				<th>Rating</th>
				<th>Comment ID</th>
				<th>Last Update</th>
			</tr>
		</thead>
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<tfoot>
			<?php if ($this->auth->has_permission('Reviews.Reports.Delete')) : ?>
			<tr>
				<td colspan="7"><?php echo lang('bf_with_selected') ?> <input
					type="submit" name="delete" id="delete-me" class="btn btn-danger"
					value="<?php echo lang('bf_action_delete') ?>"
					onclick="return confirm('<?php echo lang('reviews_delete_confirm'); ?>')">
				</td>
			</tr>
			<?php endif;?>
		</tfoot>
		<?php endif; ?>
		<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
			<tr>
				<?php if ($this->auth->has_permission('Reviews.Reports.Delete')) : ?>
				<td><input type="checkbox" name="checked[]"
					value="<?php echo $record->id ?>" /></td>
				<?php endif;?>

				<?php if ($this->auth->has_permission('Reviews.Reports.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/reports/reviews/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->reviews_video_id) ?>
				</td>
				<?php else: ?>
				<td><?php echo $record->reviews_video_id ?></td>
				<?php endif; ?>

				<td><?php echo $record->reviews_user_id?></td>
				<td><?php echo $record->reviews_answers?></td>
				<td><?php echo $record->reviews_rating?></td>
				<td><?php echo $record->reviews_comment_id?></td>
				<td><?php echo $record->reviews_last_update?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="7">No records found that match your selection.</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<?php echo form_close(); ?>
</div>
