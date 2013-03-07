
<h1>
	<?php echo modules::run('user_information/get_current_points')?>
</h1>

<div class="admin-box">
	<h3>
		Purchase history
		<?php echo anchor(SITE_AREA .'/user/incentive/', 'purchase more','class="btn btn-primary pull-right"') ?>

	</h3>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>purchased item</th>
				<th>company</th>
				<th>description</th>
				<th>price</th>
				<th>purchased time</th>
			</tr>
		</thead>

		<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record['incentive']['incentive_name']?></td>
				<td><img
					src="<?php echo modules::run('company/company_company/get_logo', $record['incentive']['company']->company_logo)?>"
					alt="Company logo" height="30" class="logo" /> <?php echo anchor_popup($record['incentive']['company']->company_url, $record['incentive']['company']->company_name) ?>
				</td>
				<td><?php echo $record['incentive']['incentive_description']?></td>
				<td><?php echo $record['incentive']['incentive_price']?></td>
				<td><?php echo $record['created_on']?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="4">No records found that match your selection.</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<?php echo form_close(); ?>
</div>
