
<?php foreach ($records as $record) : ?>
<tr>
	<?php if ($this->auth->has_permission('Comment.Content.Delete')) : ?>
	<td><input type="checkbox" name="checked[]"
		value="<?php echo $record->id ?>" /></td>
	<?php endif;?>

	<?php if ($this->auth->has_permission('Comment.Content.Edit')) : ?>
	<td><?php echo anchor(SITE_AREA .'/content/comment/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->comment_user) ?>
	</td>
	<?php else: ?>
	<td><?php echo $record->comment_user ?></td>
	<?php endif; ?>
	<td><?php echo $record->comment_content?></td>
	<td><?php echo $record->comment_ip?></td>
	<td><?php echo $record->comment_reply_to?></td>
	<td><?php echo $record->comment_video_id?></td>
	<td><?php echo $record->created_on?></td>
	<td><?php echo $record->modified_on?></td>
	</br>
</tr>
<?php endforeach; ?>

