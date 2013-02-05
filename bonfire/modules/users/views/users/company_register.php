<section id="company-register" class="main_content">
	<div class="page-header">
		<h2><?php echo 'Company Registration'; ?></h2>
	</div>
	
	<?php if (auth_errors() || validation_errors()) : ?>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-error fade in">
				<a data-dismiss="alert" class="close">&times;</a>
				<?php echo auth_errors() . validation_errors(); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="row-fluid">
		<div class="span12">
			
			<?php echo form_open_multipart('register', array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
			
						<div class="control-group offset1">
				<label class="control-label required" for="company_name"><?php echo lang('bf_company_name'); ?></label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="company_name" id="company_name" required="required" />
				</div>
			</div>
			
			
			<div class="control-group offset1">
				<label class="control-label required" for="company_logo"><?php echo lang('bf_company_logo'); ?></label>
				<div class='controls'>
					<input  id="company_logo" type="file" name="company_logo" />
					<span class="help-inline"><?php echo form_error('company_logo'); ?></span>
				</div>
				
			</div>
			
			<div class="control-group offset1">
				<label class="control-label required" for="company_url"><?php echo lang('bf_company_url'); ?></label>
				<div class='controls'>
					<input id="company_url" class="input-xlarge" type="text" name="company_url" maxlength="255" value="<?php echo set_value('company_url', isset($company['company_url']) ? $company['company_url'] : ''); ?>"  />
					<span class="help-inline"><?php echo form_error('company_url'); ?></span>
				</div>
				
				
			</div>
			<?php echo form_dropdown('company_industry_id', $industry_dropdown,'',lang('bf_company_industry_id'),'offset1','required','class="input-xlarge additional_field"');?>
			<div class="control-group offset1">
				<label class="control-label required" for="company_description"><?php echo lang('bf_company_description'); ?></label>
				
				<div class='controls'>
					<input id="company_description" class="input-xlarge" type="text" name="company_description" maxlength="1000" value="<?php echo set_value('company_description', isset($company['company_description']) ? $company['company_description'] : ''); ?>"  />
					<span class="help-inline"><?php echo form_error('company_description'); ?></span>
				</div>
			</div>	
			<div class="control-group offset1 <?php echo iif( form_error('email') , 'error'); ?>">
				<label class="control-label required" for="email"><?php echo lang('bf_email'); ?></label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="email" id="email"  value="<?php echo set_value('email'); ?>" required="required" />
				</div>
			</div>
			
			<?php if ( $this->settings_lib->item('auth.login_type') !== 'email' OR $this->settings_lib->item('auth.use_usernames') == 1): ?>
			
			<div class="control-group offset1 <?php echo iif( form_error('username') , 'error'); ?>">
				<label class="control-label required" for="username"><?php echo lang('bf_username'); ?></label>
				<div class="controls">
					<input class="input-xlarge" type="text" name="username" id="username" value="<?php echo set_value('username') ?>"  required="required" />
				</div>
			</div>
			
			<?php endif; ?>
			
			<div class="control-group offset1 <?php echo iif( form_error('password') , 'error'); ?>">
				<label class="control-label required" for="password"><?php echo lang('bf_password'); ?></label>
				<div class="controls">
					<input rel="tooltip" title="8 or more characters" class="input-xlarge" type="password" name="password" id="password" value="" placeholder="8 or more characters" required="required" />
				</div>
			</div>
			
			<div class="control-group offset1 <?php echo iif( form_error('pass_confirm') , 'error'); ?>">
				<label class="control-label required" for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
				<div class="controls">
					<input class="input-xlarge" type="password" name="pass_confirm" id="pass_confirm" value="" required="required" />
				</div>
			</div>
			
			
			

			<div class="control-group offset1">
				<label class="control-label required" for="zipcode"><?php echo lang('bf_zipcode'); ?></label>
				<div class="controls">
					<input type="text" value="<?php echo set_value('zipcode') ?>" class="input-xlarge" id="zipcode" name="zipcode"
					value="" pattern="[0-9]{5}" maxlength="5" required="required"  /> 
				</div>
			</div>

			<div class="control-group offset1">
				<label class="control-label required" for="first_name"><?php echo lang('bf_full_name'); ?></label>
				<div class="controls"> 
					<input value="<?php echo set_value('first_name') ?>"  type="text"  class="input-medium inline" placeholder="First name" id="first_name"
					name="first_name" value="" pattern="[a-z A-Z]{1,25}" maxlength="25"
					required="required" /> 
					<input value="<?php echo set_value('last_name') ?>"
					type="text" placeholder="Last name" id="last_name" name="last_name"
					value="" pattern="[a-z A-Z]{1,25}" maxlength="25" class="input-medium inline" 
					required="required" /> 
				</div>
			</div>



			
			<div class="control-group offset1">
				<div class="controls">
					<input class="btn btn-primary" type="submit" name="submit" id="submit" value="<?php echo lang('us_register'); ?>"  />
				</div>
			</div>
			
			<?php echo form_close(); ?>
			
			<p style="text-align: center">
				<?php echo lang('us_already_registered'); ?> <?php echo anchor('/login', lang('bf_action_login')); ?>
			</p>
			
		</div>
	</div>
</section>


