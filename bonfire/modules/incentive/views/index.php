<div>
	<h1 class="page-header">Incentive</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>

	<table class="table table-striped table-bordered">
		<thead>

			
			<th>company_id</th>
			<th>name</th>
			<th>description</th>
			<th>price</th>
			<th>image_path</th>
			<th>amount_left</th>
			<th>amount_total</th>
			<th>Created</th>
			<th>Modified</th>

		</thead>
		<tbody>

		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<tr>
			<?php foreach($record as $field => $value) : ?>

				<?php if ($field != 'id') : ?>
					<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('incentive_true') : lang('incentive_false')) : $value; ?></td>
				<?php endif; ?>

			<?php endforeach; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>