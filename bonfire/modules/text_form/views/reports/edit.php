
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors :</h4>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($text_form) ) {
    $text_form = (array)$text_form;
}
$id = isset($text_form['id']) ? $text_form['id'] : '';
?>
<div class="admin-box">
	<h3>text form</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>


		<?php // Change the values in this array to populate your dropdown as required ?>

		<?php $options = array(
				'phd' => 'phd',
				'master' =>  'master',
				'undergraduate' =>  'undergraduate',
); ?>

		<?php echo form_dropdown('text_form_edu', $options, set_value('text_form_edu', isset($text_form['text_form_edu']) ? $text_form['text_form_edu'] : ''), 'edu')?>


		<div class="form-actions">
			<br /> <input type="submit" name="save" class="btn btn-primary"
				value="Edit text form" /> or
			<?php echo anchor(SITE_AREA .'/reports/text_form', lang('text_form_cancel'), 'class="btn btn-warning"'); ?>


			<?php if ($this->auth->has_permission('Text_form.Reports.Delete')) : ?>

			or
			<button type="submit" name="delete" class="btn btn-danger"
				id="delete-me"
				onclick="return confirm('<?php echo lang('text_form_delete_confirm'); ?>')">
				<i class="icon-trash icon-white">&nbsp;</i>&nbsp;
				<?php echo lang('text_form_delete_record'); ?>
			</button>

			<?php endif; ?>


		</div>
	</fieldset>
	<?php echo form_close(); ?>


</div>
