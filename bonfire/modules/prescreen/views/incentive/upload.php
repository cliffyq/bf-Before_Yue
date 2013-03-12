
<div class="control-group <?php echo form_error('company_logo') ? 'error' : ''; ?>">
            <?php echo form_label('Upload logo'. lang('bf_form_label_required'), 'company_logo', array('class' => "control-label") ); ?>
            <div class='controls'>
				<input  id="company_logo" type="file" name="company_logo" />
				<span class="help-inline"><?php echo form_error('company_logo'); ?></span>
			</div>
			
		</div>