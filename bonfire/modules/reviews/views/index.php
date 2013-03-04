<div>
	<h1 class="page-header">Reviews</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>

<table class="table table-striped table-bordered">
	<thead>


		<th>Video ID</th>
		<th>User ID</th>
		<th>Answers</th>
		<th>Rating</th>
		<th>Comment ID</th>
		<th>Last Update</th>

	</thead>
	<tbody>

		<?php foreach ($records as $record) : ?>
		<?php $record = (array)$record;?>
		<tr>
			<?php foreach($record as $field => $value) : ?>

			<?php if ($field != 'id') : ?>
			<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('reviews_true') : lang('reviews_false')) : $value; ?>
			</td>
			<?php endif; ?>

			<?php endforeach; ?>

		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>