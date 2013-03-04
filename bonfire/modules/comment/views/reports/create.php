
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors :</h4>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($comment) ) {
    $comment = (array)$comment;
}
$id = isset($comment['id']) ? $comment['id'] : '';
?>
<div class="admin-box">
	<h3>Comment</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>
		<div
			class="control-group <?php echo form_error('comment_user_id') ? 'error' : ''; ?>">
			<?php echo form_label('Comment User ID', 'comment_user_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="comment_user_id" type="text" name="comment_user_id"
					maxlength="20"
					value="<?php echo set_value('comment_user_id', isset($comment['comment_user_id']) ? $comment['comment_user_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('comment_user_id'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('comment_user') ? 'error' : ''; ?>">
			<?php echo form_label('Username', 'comment_user', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="comment_user" type="text" name="comment_user"
					maxlength="50"
					value="<?php echo set_value('comment_user', isset($comment['comment_user']) ? $comment['comment_user'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('comment_user'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('comment_ip') ? 'error' : ''; ?>">
			<?php echo form_label('IP', 'comment_ip', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="comment_ip" type="text" name="comment_ip" maxlength="15"
					value="<?php echo set_value('comment_ip', isset($comment['comment_ip']) ? $comment['comment_ip'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('comment_ip'); ?> </span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('comment_reply_to') ? 'error' : ''; ?>">
			<?php echo form_label('Reply to', 'comment_reply_to', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="comment_reply_to" type="text" name="comment_reply_to"
					maxlength="11"
					value="<?php echo set_value('comment_reply_to', isset($comment['comment_reply_to']) ? $comment['comment_reply_to'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('comment_reply_to'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('comment_parent_user') ? 'error' : ''; ?>">
			<?php echo form_label('Parent User', 'comment_parent_user', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="comment_parent_user" type="text"
					name="comment_parent_user" maxlength="50"
					value="<?php echo set_value('comment_parent_user', isset($comment['comment_parent_user']) ? $comment['comment_parent_user'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('comment_parent_user'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('comment_video_id') ? 'error' : ''; ?>">
			<?php echo form_label('Video ID', 'comment_video_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="comment_video_id" type="text" name="comment_video_id"
					maxlength="11"
					value="<?php echo set_value('comment_video_id', isset($comment['comment_video_id']) ? $comment['comment_video_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('comment_video_id'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('comment_content') ? 'error' : ''; ?>">
			<?php echo form_label('Content', 'comment_content', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="comment_content" type="text" name="comment_content"
					maxlength="500"
					value="<?php echo set_value('comment_content', isset($comment['comment_content']) ? $comment['comment_content'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('comment_content'); ?>
				</span>
			</div>


		</div>



		<div class="form-actions">
			<br /> <input type="submit" name="save" class="btn btn-primary"
				value="Create Comment" /> or
			<?php echo anchor(SITE_AREA .'/reports/comment', lang('comment_cancel'), 'class="btn btn-warning"'); ?>

		</div>
	</fieldset>
	<?php echo form_close(); ?>


</div>
