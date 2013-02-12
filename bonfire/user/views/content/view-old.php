  <h3><?php echo $video_records->video_title ?> </h3>
  
  <video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264"
      poster="http://video-js.zencoder.com/oceans-clip.png"
      data-setup="{}">
	
	<source src=<?=base_url().VIDEO_UPLOAD_PATH.$video_records->video_path."video.mp4" ?> type='video/mp4' />
    
	<!--
	<source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' />
    <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
    <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
	-->
    <track kind="captions" src="captions.vtt" srclang="en" label="English" />
  </video>

  
  
  <p>you can comment here only if u fully watched this video</P>
 
  
<fieldset>		
	<form>
	<p>
		<input type="text" id="comment" size="60"/>
	<p>
	
	<p>
		<input type="text" id="username" size="60"/>
		username
	<p>
	
	<button type="button" id="post" class="no" >comment</button>
	<div id="message"></div>
</fieldset>

     <div id="content"></div>
  
  
	<h3>comment</h3>
	<?php echo form_open($this->uri->uri_string()); ?>z
		<table class="table table-striped">
			<thead>
				<tr>
					
					<th>user</th>
					<th>content</th>
					<th>reply to</th>
					<th>Created</th>
					<th>Modified</th>
				</tr>
			</thead>
			<?php if (isset($comment_records) && is_array($comment_records) && count($comment_records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Comment.Content.Delete')) : ?>
				<tr>
					<td colspan="8">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('comment_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($comment_records) && is_array($comment_records) && count($comment_records)) : ?>
			<?php foreach ($comment_records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Comment.Content.Delete')) : ?>
					
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Comment.Content.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/content/comment/edit/'. $record->id, '<i class="icon-pencil">&nbsp;</i>' .  $record->comment_user) ?></td>
				<?php else: ?>
				<td><?php echo $record->comment_user ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->comment_content?></td>
				<td><?php echo $record->comment_reply_to?></td>
				<td><?php echo $record->created_on?></td>
				<td><?php echo $record->modified_on?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="8">No comment_records found that match your selection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
  