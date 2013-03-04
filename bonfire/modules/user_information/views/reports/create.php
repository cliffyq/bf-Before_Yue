
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors :</h4>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($user_information) ) {
    $user_information = (array)$user_information;
}
$id = isset($user_information['id']) ? $user_information['id'] : '';
?>
<div class="admin-box">
	<h3>user information</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>
		<div
			class="control-group <?php echo form_error('user_information_user_id') ? 'error' : ''; ?>">
			<?php echo form_label('user_id', 'user_information_user_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="user_information_user_id" type="text"
					name="user_information_user_id" maxlength="11"
					value="<?php echo set_value('user_information_user_id', isset($user_information['user_information_user_id']) ? $user_information['user_information_user_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('user_information_user_id'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('user_information_current_points') ? 'error' : ''; ?>">
			<?php echo form_label('current_points', 'user_information_current_points', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="user_information_current_points" type="text"
					name="user_information_current_points" maxlength="11"
					value="<?php echo set_value('user_information_current_points', isset($user_information['user_information_current_points']) ? $user_information['user_information_current_points'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('user_information_current_points'); ?>
				</span>
			</div>


		</div>



		<div class="form-actions">
			<br /> <input type="submit" name="save" class="btn btn-primary"
				value="Create user information" /> or
			<?php echo anchor(SITE_AREA .'/reports/user_information', lang('user_information_cancel'), 'class="btn btn-warning"'); ?>

		</div>
	</fieldset>
	<?php echo form_close(); ?>


</div>
