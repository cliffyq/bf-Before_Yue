
		<?php if (validation_errors()) : ?>
		<div class="alert alert-block alert-error fade in ">
		<a class="close" data-dismiss="alert">&times;</a>
		<h4 class="alert-heading">Please fix the following errors :</h4>
		<?php echo validation_errors(); ?>
		</div>
		<?php endif; ?>
		<?php // Change the css classes to suit your needs
		if( isset($addresses) ) {
				$addresses = (array)$addresses;
}
						$id = isset($addresses['id']) ? $addresses['id'] : '';
								?>
		<div class="admin-box">
		<h3>addresses</h3>
				<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
				<fieldset>
				        <div class="control-group <?php echo form_error('addresses_zip') ? 'error' : ''; ?>">
            <?php echo form_label('zip', 'addresses_zip', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="addresses_zip" type="text" name="addresses_zip" maxlength="5" value="<?php echo set_value('addresses_zip', isset($addresses['addresses_zip']) ? $addresses['addresses_zip'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('addresses_zip'); ?></span>
        </div>


				</div>
        <div class="control-group <?php echo form_error('addresses_city') ? 'error' : ''; ?>">
            <?php echo form_label('city', 'addresses_city', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="addresses_city" type="text" name="addresses_city" maxlength="100" value="<?php echo set_value('addresses_city', isset($addresses['addresses_city']) ? $addresses['addresses_city'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('addresses_city'); ?></span>
        </div>


				</div>
        <div class="control-group <?php echo form_error('addresses_state') ? 'error' : ''; ?>">
            <?php echo form_label('state', 'addresses_state', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="addresses_state" type="text" name="addresses_state" maxlength="2" value="<?php echo set_value('addresses_state', isset($addresses['addresses_state']) ? $addresses['addresses_state'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('addresses_state'); ?></span>
        </div>


				</div>
        <div class="control-group <?php echo form_error('addresses_latitude') ? 'error' : ''; ?>">
            <?php echo form_label('latitude', 'addresses_latitude', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="addresses_latitude" type="text" name="addresses_latitude" maxlength="10" value="<?php echo set_value('addresses_latitude', isset($addresses['addresses_latitude']) ? $addresses['addresses_latitude'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('addresses_latitude'); ?></span>
        </div>


				</div>
        <div class="control-group <?php echo form_error('addresses_longitude') ? 'error' : ''; ?>">
            <?php echo form_label('longitude', 'addresses_longitude', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="addresses_longitude" type="text" name="addresses_longitude" maxlength="10" value="<?php echo set_value('addresses_longitude', isset($addresses['addresses_longitude']) ? $addresses['addresses_longitude'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('addresses_longitude'); ?></span>
        </div>


				</div>
        <div class="control-group <?php echo form_error('addresses_timezone') ? 'error' : ''; ?>">
            <?php echo form_label('timezone', 'addresses_timezone', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="addresses_timezone" type="text" name="addresses_timezone" maxlength="2" value="<?php echo set_value('addresses_timezone', isset($addresses['addresses_timezone']) ? $addresses['addresses_timezone'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('addresses_timezone'); ?></span>
        </div>


				</div>
        <div class="control-group <?php echo form_error('addresses_dst') ? 'error' : ''; ?>">
            <?php echo form_label('dst', 'addresses_dst', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="addresses_dst" type="text" name="addresses_dst" maxlength="1" value="<?php echo set_value('addresses_dst', isset($addresses['addresses_dst']) ? $addresses['addresses_dst'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('addresses_dst'); ?></span>
        </div>


				</div>



		<div class="form-actions">
		<br/>
		<input type="submit" name="save" class="btn btn-primary" value="Create addresses" />
				or <?php echo anchor(SITE_AREA .'/reports/addresses', lang('addresses_cancel'), 'class="btn btn-warning"'); ?>
						
								</div>
								</fieldset>
								<?php echo form_close(); ?>
								

</div>
