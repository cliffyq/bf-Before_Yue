<div class="admin-box">
	<h3>incentive shop</h3>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>company</th>
				<th>name</th>
				<th>description</th>
				<th>price</th>
				<th>purchase</th>
			</tr>
		</thead>
		<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
			<tr>
				<td><img
					src="<?php echo modules::run('company/company_company/get_logo', $record['company']->company_logo)?>"
					alt="Company logo" height="30" class="logo" /> <?php echo anchor_popup($record['company']->company_url, $record['company']->company_name) ?>
				</td>
				<td><?php echo $record['incentive_name']?></td>
				<td><?php echo $record['incentive_description']?></td>
				<td><?php echo $record['incentive_price']?></td>
				<td><?php echo anchor('/incentive/user/purchase/'.$record['id'],'purchase','class="incentive_user_purchase_confirm"')?>
				</td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="6">No records found that match your selection.</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
