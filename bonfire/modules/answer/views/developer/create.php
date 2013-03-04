
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors :</h4>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($answer) ) {
    $answer = (array)$answer;
}
$id = isset($answer['id']) ? $answer['id'] : '';
?>
<div class="admin-box">
	<h3>answer</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>
		<div
			class="control-group <?php echo form_error('answer_content') ? 'error' : ''; ?>">
			<?php echo form_label('content', 'answer_content', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="answer_content" type="text" name="answer_content"
					maxlength="255"
					value="<?php echo set_value('answer_content', isset($answer['answer_content']) ? $answer['answer_content'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('answer_content'); ?>
				</span>
			</div>


		</div>



		<div class="form-actions">
			<br /> <input type="submit" name="save" class="btn btn-primary"
				value="Create answer" /> or
			<?php echo anchor(SITE_AREA .'/developer/answer', lang('answer_cancel'), 'class="btn btn-warning"'); ?>

		</div>
	</fieldset>
	<?php echo form_close(); ?>


</div>
