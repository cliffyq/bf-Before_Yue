
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors :</h4>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($video_question) ) {
    $video_question = (array)$video_question;
}
$id = isset($video_question['id']) ? $video_question['id'] : '';
?>
<div class="admin-box">
	<h3>Video Question</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>
		<div
			class="control-group <?php echo form_error('video_question_video_id') ? 'error' : ''; ?>">
			<?php echo form_label('Video ID', 'video_question_video_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="video_question_video_id" type="text"
					name="video_question_video_id" maxlength="11"
					value="<?php echo set_value('video_question_video_id', isset($video_question['video_question_video_id']) ? $video_question['video_question_video_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('video_question_video_id'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('video_question_question_id') ? 'error' : ''; ?>">
			<?php echo form_label('Question ID', 'video_question_question_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="video_question_question_id" type="text"
					name="video_question_question_id" maxlength="11"
					value="<?php echo set_value('video_question_question_id', isset($video_question['video_question_question_id']) ? $video_question['video_question_question_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('video_question_question_id'); ?>
				</span>
			</div>


		</div>



		<div class="form-actions">
			<br /> <input type="submit" name="save" class="btn btn-primary"
				value="Create Video Question" /> or
			<?php echo anchor(SITE_AREA .'/commonauth/video_question', lang('video_question_cancel'), 'class="btn btn-warning"'); ?>

		</div>
	</fieldset>
	<?php echo form_close(); ?>


</div>
