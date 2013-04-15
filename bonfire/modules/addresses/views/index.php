<div>
	<h1 class="page-header">addresses</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>

	<table class="table table-striped table-bordered">
		<thead>

			
			<th>zip</th>
			<th>city</th>
			<th>state</th>
			<th>latitude</th>
			<th>longitude</th>
			<th>timezone</th>
			<th>dst</th>

		</thead>
		<tbody>

		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<tr>
			<?php foreach($record as $field => $value) : ?>

				<?php if ($field != 'id') : ?>
					<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('addresses_true') : lang('addresses_false')) : $value; ?></td>
				<?php endif; ?>

			<?php endforeach; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>