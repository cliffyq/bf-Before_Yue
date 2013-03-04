
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors :</h4>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($reviews) ) {
    $reviews = (array)$reviews;
}
$id = isset($reviews['id']) ? $reviews['id'] : '';
?>
<div class="admin-box">
	<h3>Reviews</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>
		<div
			class="control-group <?php echo form_error('reviews_video_id') ? 'error' : ''; ?>">
			<?php echo form_label('Video ID', 'reviews_video_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="reviews_video_id" type="text" name="reviews_video_id"
					maxlength="11"
					value="<?php echo set_value('reviews_video_id', isset($reviews['reviews_video_id']) ? $reviews['reviews_video_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('reviews_video_id'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('reviews_user_id') ? 'error' : ''; ?>">
			<?php echo form_label('User ID', 'reviews_user_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="reviews_user_id" type="text" name="reviews_user_id"
					maxlength="20"
					value="<?php echo set_value('reviews_user_id', isset($reviews['reviews_user_id']) ? $reviews['reviews_user_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('reviews_user_id'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('reviews_answers') ? 'error' : ''; ?>">
			<?php echo form_label('Answers', 'reviews_answers', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="reviews_answers" type="text" name="reviews_answers"
					maxlength="50"
					value="<?php echo set_value('reviews_answers', isset($reviews['reviews_answers']) ? $reviews['reviews_answers'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('reviews_answers'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('reviews_rating') ? 'error' : ''; ?>">
			<?php echo form_label('Rating', 'reviews_rating', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="reviews_rating" type="text" name="reviews_rating"
					maxlength="1"
					value="<?php echo set_value('reviews_rating', isset($reviews['reviews_rating']) ? $reviews['reviews_rating'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('reviews_rating'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('reviews_comment_id') ? 'error' : ''; ?>">
			<?php echo form_label('Comment ID', 'reviews_comment_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="reviews_comment_id" type="text" name="reviews_comment_id"
					maxlength="11"
					value="<?php echo set_value('reviews_comment_id', isset($reviews['reviews_comment_id']) ? $reviews['reviews_comment_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('reviews_comment_id'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('reviews_last_update') ? 'error' : ''; ?>">
			<?php echo form_label('Last Update', 'reviews_last_update', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="reviews_last_update" type="text"
					name="reviews_last_update"
					value="<?php echo set_value('reviews_last_update', isset($reviews['reviews_last_update']) ? $reviews['reviews_last_update'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('reviews_last_update'); ?>
				</span>
			</div>


		</div>



		<div class="form-actions">
			<br /> <input type="submit" name="save" class="btn btn-primary"
				value="Create Reviews" /> or
			<?php echo anchor(SITE_AREA .'/content/reviews', lang('reviews_cancel'), 'class="btn btn-warning"'); ?>

		</div>
	</fieldset>
	<?php echo form_close(); ?>


</div>
