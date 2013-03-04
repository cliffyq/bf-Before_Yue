
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors :</h4>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($purchase_history) ) {
    $purchase_history = (array)$purchase_history;
}
$id = isset($purchase_history['id']) ? $purchase_history['id'] : '';
?>
<div class="admin-box">
	<h3>Purchase history</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	<fieldset>
		<div
			class="control-group <?php echo form_error('purchase_history_user_id') ? 'error' : ''; ?>">
			<?php echo form_label('user_id', 'purchase_history_user_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="purchase_history_user_id" type="text"
					name="purchase_history_user_id" maxlength="11"
					value="<?php echo set_value('purchase_history_user_id', isset($purchase_history['purchase_history_user_id']) ? $purchase_history['purchase_history_user_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('purchase_history_user_id'); ?>
				</span>
			</div>


		</div>
		<div
			class="control-group <?php echo form_error('purchase_history_incentive_id') ? 'error' : ''; ?>">
			<?php echo form_label('incentive_id', 'purchase_history_incentive_id', array('class' => "control-label") ); ?>
			<div class='controls'>
				<input id="purchase_history_incentive_id" type="text"
					name="purchase_history_incentive_id" maxlength="11"
					value="<?php echo set_value('purchase_history_incentive_id', isset($purchase_history['purchase_history_incentive_id']) ? $purchase_history['purchase_history_incentive_id'] : ''); ?>" />
				<span class="help-inline"><?php echo form_error('purchase_history_incentive_id'); ?>
				</span>
			</div>


		</div>



		<div class="form-actions">
			<br /> <input type="submit" name="save" class="btn btn-primary"
				value="Create Purchase history" /> or
			<?php echo anchor(SITE_AREA .'/settings/purchase_history', lang('purchase_history_cancel'), 'class="btn btn-warning"'); ?>

		</div>
	</fieldset>
	<?php echo form_close(); ?>


</div>
