<div class="admin-box">
	<h3>addresses</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Addresses.Settings.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
			<th>zip</th>
			<th>city</th>
			<th>state</th>
			<th>latitude</th>
			<th>longitude</th>
			<th>timezone</th>
			<th>dst</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Addresses.Settings.Delete')) : ?>
				<tr>
					<td colspan="8">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('addresses_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Addresses.Settings.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Addresses.Settings.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/settings/addresses/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->addresses_zip) ?></td>
						<?php else: ?>
						<td><?php echo $record->addresses_zip ?></td>
								<?php endif; ?>
								
				<td><?php echo $record->addresses_city?></td>
				<td><?php echo $record->addresses_state?></td>
				<td><?php echo $record->addresses_latitude?></td>
				<td><?php echo $record->addresses_longitude?></td>
				<td><?php echo $record->addresses_timezone?></td>
				<td><?php echo $record->addresses_dst?></td>
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