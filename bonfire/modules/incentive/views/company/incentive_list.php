
<div class="incentive_title">
	<h2>Incentive Manager</h2>
	<div class='incentive_subtitle'>
		<?php echo anchor(site_url('incentive/company/create'),'click here to upload a new incentive!')?>
	</div>
	<div class="btn-group ">
		<button class="btn  dropdown-toggle" data-toggle="dropdown">
			<?php echo $sort_option ?>
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><?php echo anchor(site_url('incentive/company/incentive_list/Rencently_Added'),'Recently Added')?>
			</li>
			<li><?php echo anchor(site_url('incentive/company/incentive_list/Most_Purchased'),'Most Purchased')?>
			</li>
			<li><?php echo anchor(site_url('incentive/company/incentive_list/Least_Purchased'),'Least Purchased')?>
			</li>
		</ul>
	</div>
</div>
<?php echo form_open($this->uri->uri_string()); ?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<?php if ($this->auth->has_permission('Incentive.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
			<th class="column-check"><input class="check-all" type="checkbox" />
			</th>
			<?php endif;?>
			<th>Incentive Image</th>
			<th>Name</th>
			<th>Price</th>
			<th>Category</th>
			<th>Published Date</th>
			<th>Amount Left/Purchased</th>
			<th>Operations</th>
		</tr>
	</thead>
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
	<tfoot>
		<?php if ($this->auth->has_permission('Incentive.Content.Delete')) : ?>
		<tr>
			<td colspan="10"><?php echo lang('bf_with_selected') ?> <input
				type="submit" name="delete" id="delete-me" class="btn btn-danger"
				value="<?php echo lang('bf_action_delete') ?>"
				onclick="return confirm('<?php echo lang('incentive_delete_confirm'); ?>')">
			</td>
		</tr>
		<?php endif;?>
	</tfoot>
	<?php endif; ?>
	<tbody>
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<?php foreach ($records as $record): ?>
		<tr>
			<?php if ($this->auth->has_permission('Incentive.Content.Delete')) : ?>
			<td><input type="checkbox" name="checked[]"
				value="<?php echo $record->id ?>" /></td>
			<?php endif;?>
			<td><img style="height: 50px"
				src="<?php echo $record->incentive_image_path ?>"
				alt="incentive image" class="incentive_image" /> <!-- need a get image function  -->
			</td>
			<td><?= $record->incentive_name ?></td>
			<td><?= $record->incentive_price ?></td>
			<td>Gift Card <!-- need a category pool  -->
			</td>
			<td><?= $record->created_on ?></td>
			<td><?= $record->incentive_amount_left ?>/<?= $record->incentive_amount_purchased ?>
			</td>
			<td><?php echo anchor('incentive/company/edit/'. $record->id,'edit', 'class="btn btn-info"') ?>
			</td>
		</tr>
		<?php endforeach;?>
		<?php else: ?>
		<tr>
			<td colspan="10">No records found that match your selection.</td>
		</tr>
		<?php endif; ?>
	</tbody>

</table>

<?php echo form_close(); ?>

