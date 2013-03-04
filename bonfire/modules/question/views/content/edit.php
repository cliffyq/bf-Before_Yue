
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors :</h4>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($question) ) {
    $question = (array)$question;
}
$id = isset($question['id']) ? $question['id'] : '';
?>
<div class="admin-box">
	<h3>question</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>
		<div
			class="control-group <?php echo form_error('question_content') ? 'error' : ''; ?>">
			<?php echo form_label('content', 'question_content', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="question_content" type="text" name="question_content"
					maxlength="140"
					value="<?php echo set_value('question_content', isset($question['question_content']) ? $question['question_content'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('question_content'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('question_answer_id') ? 'error' : ''; ?>">
			<?php echo form_label('answer_id', 'question_answer_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="question_answer_id" type="text" name="question_answer_id"
					maxlength="11"
					value="<?php echo set_value('question_answer_id', isset($question['question_answer_id']) ? $question['question_answer_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('question_answer_id'); ?>
				</span>
			</div>


		</div>



		<div class="form-actions">
			<br /> <input type="submit" name="save" class="btn btn-primary"
				value="Edit question" /> or
			<?php echo anchor(SITE_AREA .'/content/question', lang('question_cancel'), 'class="btn btn-warning"'); ?>


			<?php if ($this->auth->has_permission('Question.Content.Delete')) : ?>

			or
			<button type="submit" name="delete" class="btn btn-danger"
				id="delete-me"
				onclick="return confirm('<?php echo lang('question_delete_confirm'); ?>')">
				<i class="icon-trash icon-white">&nbsp;</i>&nbsp;
				<?php echo lang('question_delete_record'); ?>
			</button>

			<?php endif; ?>


		</div>
	</fieldset>
	<?php echo form_close(); ?>


</div>
