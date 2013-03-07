<div class="admin-box">
	<h3>Company</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<?php if ($this->auth->has_permission('Company.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
				<th class="column-check"><input class="check-all" type="checkbox" />
				</th>
				<?php endif;?>

				<th>Company Name</th>
				<th>Company logo</th>
				<th>Company url</th>
				<th>Industry ID</th>
				<th>Company description</th>
			</tr>
		</thead>
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<tfoot>
			<?php if ($this->auth->has_permission('Company.Content.Delete')) : ?>
			<tr>
				<td colspan="6"><?php echo lang('bf_with_selected') ?> <input
					type="submit" name="delete" id="delete-me" class="btn btn-danger"
					value="<?php echo lang('bf_action_delete') ?>"
					onclick="return confirm('<?php echo lang('company_delete_confirm'); ?>')">
				</td>
			</tr>
			<?php endif;?>
		</tfoot>
		<?php endif; ?>
		<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
			<tr>
				<?php if ($this->auth->has_permission('Company.Content.Delete')) : ?>
				<td><input type="checkbox" name="checked[]"
					value="<?php echo $record->id ?>" /></td>
				<?php endif;?>

				<?php if ($this->auth->has_permission('Company.Content.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/content/company/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->company_name) ?>
				</td>
				<?php else: ?>
				<td><?php echo $record->company_name ?></td>
				<?php endif; ?>


				<td><img
					src="<?php echo modules::run('company/company_company/get_logo', $record->company_logo)?>"
					alt="Company logo" height="30" class="logo" /></td>
				<td><?php echo $record->company_url?></td>
				<td><?php echo $record->company_industry_id?></td>
				<td><?php echo $record->company_description?></td>
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
