<div>
	<h1 class="page-header">Comment</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>

<table class="table table-striped table-bordered">
	<thead>


		<th>Comment User ID</th>
		<th>Username</th>
		<th>IP</th>
		<th>Reply to</th>
		<th>Parent User</th>
		<th>Video ID</th>
		<th>Content</th>
		<th>Created</th>
		<th>Modified</th>

	</thead>
	<tbody>

		<?php foreach ($records as $record) : ?>
		<?php $record = (array)$record;?>
		<tr>
			<?php foreach($record as $field => $value) : ?>

			<?php if ($field != 'id') : ?>
			<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('comment_true') : lang('comment_false')) : $value; ?>
			</td>
			<?php endif; ?>

			<?php endforeach; ?>

		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>