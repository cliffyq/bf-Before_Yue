<section id="register">
	<div class="page-header">
		<h1><?php echo 'Sign Up'; ?></h1>
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
		<div class="span10 offset2">
			<div class="alert alert-info fade in">
				<a data-dismiss="alert" class="close">&times;</a>
				<h4 class="alert-heading"><?php echo lang('bf_required_note'); ?></h4>
				<?php if (isset($password_hints) ) echo $password_hints; ?>
			</div>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			
			<?php echo form_open('company/test/receiver', array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
			
			
			<div class="control-group <?php echo iif( form_error('email') , 'error'); ?>">
				<label class="control-label required" for="email"><?php echo lang('bf_email'); ?></label>
				<div class="controls">
					<input class="span4" type="text" name="email" id="email"  value="<?php echo set_value('email'); ?>"  placeholder="<?php echo lang('bf_email'); ?>" required="required" />
				</div>
			</div>
			
			<?php if ( $this->settings_lib->item('auth.login_type') !== 'email' OR $this->settings_lib->item('auth.use_usernames') == 1): ?>
			
			<div class="control-group <?php echo iif( form_error('username') , 'error'); ?>">
				<label class="control-label required" for="username"><?php echo lang('bf_username'); ?></label>
				<div class="controls">
					<input class="span4" type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="<?php echo lang('bf_username'); ?>" required="required" />
				</div>
			</div>
			
			<?php endif; ?>
			
			<div class="control-group <?php echo iif( form_error('password') , 'error'); ?>">
				<label class="control-label required" for="password"><?php echo lang('bf_password'); ?></label>
				<div class="controls">
					<input class="span4" type="password" name="password" id="password" value="" placeholder="<?php echo lang('bf_password'); ?>" required="required" />
				</div>
			</div>
			
			<div class="control-group <?php echo iif( form_error('pass_confirm') , 'error'); ?>">
				<label class="control-label required" for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
				<div class="controls">
					<input class="span4" type="password" name="pass_confirm" id="pass_confirm" value="" placeholder="<?php echo lang('bf_password_confirm'); ?>" required="required" />
				</div>
			</div>
			
			
			
			
 

			
			<div class="control-group">
				<label class="control-label" for="industry_id"><?php echo lang('bf_industry'); ?></label>
				<div class="controls">
					<select id="industry" class="span4" name="industry">
						<option value="">Please Select:</option>
						<option value="1">Business</option>
						<option value="2">Education</option>
						<option value="3">Sports</option>
						<option value="4">Other</option>
					</select> 
				</div>
			</div>
		
			
			
			<div class = "control-group">
				<div class = "controls">	
					<input class="btn btn-primary" type="submit" name="submit" id="submit" value="<?php echo lang('bf_submit'); ?>"  />
				</div>
			</div>
			
			<?php echo form_close(); ?>
			
			<p style="text-align: center">
				<?php echo lang('us_already_registered'); ?> <?php echo anchor('/login', lang('bf_action_login')); ?>
			</p>
			
		</div>
	</div>
</section>


