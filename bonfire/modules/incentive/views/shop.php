<div class="admin-box">
	<h3>incentive</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ( isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>company_id</th>
					<th>name</th>
					<th>description</th>
					<th>price</th>
					<th>category_id</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<tr>
					<td colspan="6">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="purchase" id="purchase-me" class="btn btn" value="purchase" onclick="return confirm('<?php echo lang('incentive_purchase_confirm'); ?>')">
					</td>
				</tr>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
				<td><input type="checkbox" name="checked[]" value="<?php echo $record->id ?>" /></td>
				<td><?php echo $record->incentive_company_id ?></td>
				<td><?php echo $record->incentive_name?></td>
				<td><?php echo $record->incentive_description?></td>
				<td><?php echo $record->incentive_price?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="6">No records found that match your selection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>