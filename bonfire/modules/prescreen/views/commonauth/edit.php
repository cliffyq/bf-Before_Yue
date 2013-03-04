
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors :</h4>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($prescreen) ) {
    $prescreen = (array)$prescreen;
}
$id = isset($prescreen['id']) ? $prescreen['id'] : '';
?>
<div class="admin-box">
	<h3>prescreen</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>
		<div
			class="control-group <?php echo form_error('prescreen_content') ? 'error' : ''; ?>">
			<?php echo form_label('content', 'prescreen_content', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="prescreen_content" type="text" name="prescreen_content"
					maxlength="30"
					value="<?php echo set_value('prescreen_content', isset($prescreen['prescreen_content']) ? $prescreen['prescreen_content'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('prescreen_content'); ?>
				</span>
			</div>


		</div>



		<div class="form-actions">
			<br /> <input type="submit" name="save" class="btn btn-primary"
				value="Edit prescreen" /> or
			<?php echo anchor(SITE_AREA .'/commonauth/prescreen', lang('prescreen_cancel'), 'class="btn btn-warning"'); ?>


			<?php if ($this->auth->has_permission('Prescreen.Commonauth.Delete')) : ?>

			or
			<button type="submit" name="delete" class="btn btn-danger"
				id="delete-me"
				onclick="return confirm('<?php echo lang('prescreen_delete_confirm'); ?>')">
				<i class="icon-trash icon-white">&nbsp;</i>&nbsp;
				<?php echo lang('prescreen_delete_record'); ?>
			</button>

			<?php endif; ?>


		</div>
	</fieldset>
	<?php echo form_close(); ?>


</div>
