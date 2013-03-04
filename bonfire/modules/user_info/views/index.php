<div>
	<h1 class="page-header">User Info</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>

<table class="table table-striped table-bordered">
	<thead>


		<th>User ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Gender</th>
		<th>Birth Month</th>
		<th>Birth Year</th>
		<th>Race</th>

		<th>Tutorial Flag</th>
		<th>Education</th>
		<th>Veteran</th>
		<th>Zipcode</th>
		<th>Industry ID</th>

	</thead>
	<tbody>

		<?php foreach ($records as $record) : ?>
		<?php $record = (array)$record;?>
		<tr>
			<?php foreach($record as $field => $value) : ?>

			<?php if ($field != 'id') : ?>
			<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('user_info_true') : lang('user_info_false')) : $value; ?>
			</td>
			<?php endif; ?>

			<?php endforeach; ?>

		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>