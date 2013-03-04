<div>
	<h1 class="page-header">question</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>

<table class="table table-striped table-bordered">
	<thead>


		<th>content</th>
		<th>answer_id</th>

	</thead>
	<tbody>

		<?php foreach ($records as $record) : ?>
		<?php $record = (array)$record;?>
		<tr>
			<?php foreach($record as $field => $value) : ?>

			<?php if ($field != 'id') : ?>
			<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('question_true') : lang('question_false')) : $value; ?>
			</td>
			<?php endif; ?>

			<?php endforeach; ?>

		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>