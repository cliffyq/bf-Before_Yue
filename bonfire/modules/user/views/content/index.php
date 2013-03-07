<div class="admin-box">
	<h3>Video</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
	<table class="table table-striped">
		<thead>
			<tr>

				<th>title</th>
				<th>company name</th>
				<th>description</th>
				<th>length</th>
				<th>Created</th>
				<th>Modified</th>
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
				<?php if ($this->auth->has_permission('Video.Content.View')) : ?>
				<td><?php echo anchor('/userview/view/'.$record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->video_title) ?>
				</td>
				<?php else: ?>
				<td><?php echo $record->video_title ?></td>
				<?php endif; ?>

				<td><?php echo $record->video_company_id?></td>
				<td><?php echo $record->video_description?></td>
				<td><?php echo $record->video_length?></td>
				<td><?php echo $record->created_on?></td>
				<td><?php echo $record->modified_on?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="8">No records found that match your selection.</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<?php echo form_close(); ?>
</div>
c
