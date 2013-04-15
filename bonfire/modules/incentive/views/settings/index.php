<div class="admin-box">
	<h3>Incentive</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Incentive.Settings.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
			<th>company_id</th>
			<th>name</th>
			<th>description</th>
			<th>price</th>
			<th>image_path</th>
			<th>amount_left</th>
			<th>amount_total</th>
			<th>Created</th>
			<th>Modified</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Incentive.Settings.Delete')) : ?>
				<tr>
					<td colspan="10">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('incentive_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Incentive.Settings.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Incentive.Settings.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/settings/incentive/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->incentive_company_id) ?></td>
						<?php else: ?>
						<td><?php echo $record->incentive_company_id ?></td>
								<?php endif; ?>
								
				<td><?php echo $record->incentive_name?></td>
				<td><?php echo $record->incentive_description?></td>
				<td><?php echo $record->incentive_price?></td>
				<td><?php echo $record->incentive_image_path?></td>
				<td><?php echo $record->incentive_amount_left?></td>
				<td><?php echo $record->incentive_amount_total?></td>
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