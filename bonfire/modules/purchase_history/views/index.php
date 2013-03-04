<div>
	<h1 class="page-header">Purchase history</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>

<table class="table table-striped table-bordered">
	<thead>


		<th>user_id</th>
		<th>incentive_id</th>
		<th>Created</th>

	</thead>
	<tbody>

		<?php foreach ($records as $record) : ?>
		<?php $record = (array)$record;?>
		<tr>
			<?php foreach($record as $field => $value) : ?>

			<?php if ($field != 'id') : ?>
			<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('purchase_history_true') : lang('purchase_history_false')) : $value; ?>
			</td>
			<?php endif; ?>

			<?php endforeach; ?>

		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>