<div class="admin-box">
	<h3>Charity</h3>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Oganization</th>
					<th>description</th>
					<th>Donate</th>
				</tr>
			</thead>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
				<td><img src="<?php echo modules::run('company/get_logo', $record->company_logo)?>" alt="Company logo" height="30" class = "logo"/><?php echo anchor_popup($record->company_url, $record->company_name) ?></td>
				<td><?php echo $record->company_description?></td>
				<td><input id='incentive_user_charity_amount' value=''/>  <a href='charity' class='incentive_user_charity_submit'>donate</a></td>
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