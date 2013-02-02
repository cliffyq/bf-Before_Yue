<section id="register" class="main_content">
	<div class="page-header">
		<h2><?php echo 'Sign Up'; ?></h2>
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
		<div class="span8 offset2">
			<div class="alert alert-info fade in">
				<a data-dismiss="alert" class="close">&times;</a>
				<h4 class="alert-heading"><?php echo lang('bf_required_note'); ?></h4>
				<?php if (isset($password_hints) ) echo $password_hints; ?>
			</div>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			
			<?php echo form_open('register', array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
			
			
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
					<input rel="tooltip" title="at least 8 characters" class="span4" type="password" name="password" id="password" value="" placeholder="<?php echo lang('bf_password'); ?>" required="required" />
				</div>
			</div>
			
			<div class="control-group <?php echo iif( form_error('pass_confirm') , 'error'); ?>">
				<label class="control-label required" for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
				<div class="controls">
					<input class="span4" type="password" name="pass_confirm" id="pass_confirm" value="" placeholder="<?php echo lang('bf_password_confirm'); ?>" required="required" />
				</div>
			</div>
			
			
			
			<div class="control-group">
				<label class="control-label required" for="birth_month"><?php echo lang('bf_birth_month'); ?></label>
				<div class="controls">
					<input id="birth_month" name="birth_month" class="span4" data-date-format="yyyy-mm" data-date-viewmode="2" data-date-minviewmode="1" value="<?php echo set_value('birth_month') ?>" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label required" for="zipcode"><?php echo lang('bf_zipcode'); ?></label>
				<div class="controls">
					<input value="<?php echo set_value('zipcode') ?>" class="span4" placeholder="<?php echo lang('bf_zipcode');?>" id="zipcode" name="zipcode"
					value="" pattern="[0-9]{5}" maxlength="5" required="required"  /> 
				</div>
			</div>
			<div class="control-group">
				<label class="control-label required" for="race"><?php echo lang('bf_race'); ?></label>
				<div class="controls"> 
					<select id="race" class="span4" name="race" value="<?php echo set_value('race') ?>">
						<option value="">Please Select:</option>
						<option value="White">White</option>
						<option value="Black or African American">Black or African American</option>
						<option value="American Indian or Alaskan Native">American Indian or Alaskan Native</option>
						<option value="Hispanic or Latino">Hispanic or Latino</option>
						<option value="Asian or Pacific Islander">Asian or Pacific Islander</option>
						<option value="Other">Other</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label required" for="education"><?php echo lang('bf_education'); ?></label>
				<div class="controls">
					<select id="education" class="span4" name="education">
						<option value="">Please Select:</option>
						<option value="PHD">PHD</option>
						<option value="Master">Master</option>
						<option value="Bachelor">Bachelor</option>
						<option value="College">College</option>
						<option value="High School">High School</option>
					</select> 
				</div>
			</div>
			<div class="control-group">
				<label class="control-label required" for="first_name"><?php echo lang('bf_full_name'); ?></label>
				<div class="controls"> 
					<input value="<?php echo set_value('first_name') ?>"  type="text"  class="input-medium inline" placeholder="<?php echo lang('bf_first_name'); ?>" id="first_name"
					name="first_name" value="" pattern="[a-z A-Z]{1,25}" maxlength="25"
					required="required" /> 
					<input value="<?php echo set_value('last_name') ?>"
					type="text" placeholder="<?php echo lang('bf_last_name'); ?>" id="last_name" name="last_name"
					value="" pattern="[a-z A-Z]{1,25}" maxlength="25" class="input-medium inline" 
					required="required" /> 
				</div>
			</div>
			<div class="control-group">
				<label class="control-label required" ><?php echo lang('bf_gender'); ?></label>
				<div class="controls row-fluid">
					<label class="radio inline" for="gender_f" >
						<input
					type="radio" id="gender_f" name="gender" value="0" /> <?php echo lang('bf_female'); ?></label>
					<label class="radio inline" for="gender_m" >
						<input
					type="radio" id="gender_m" name="gender" value="1"/> <?php echo lang('bf_male'); ?></label>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span8 offset2">
					<div class="alert alert-info additional_info">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<h4 class="alert-heading">Below are additional informations.</h4>
						You will get extra reward if you complete these fields.
					</div>
				</div>
			</div>
			<?php echo form_dropdown('company_industry_id', $industry_dropdown,'',lang('bf_company_industry_id'),'required',$industry_dropdown_class);?>
			
			<div class="control-group">
				<label class="control-label" for="occupation_id"><?php echo lang('bf_occupation'); ?></label>
				<div class="controls">
					<select id="occupation_id" class="span4" name="occupation_id">
						<option value="">Please Select:</option>
						<option value="1">Manager</option>
						<option value="2">Student</option>
						<option value="3">Teacher</option>
						<option value="4">Other</option>
					</select> 
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" ><?php echo lang('bf_veteran'); ?></label>
				<div class="controls row-fluid">
					<label class="radio inline" for="veteran_y" >
						<input
					type="radio" id="veteran_y" name="veteran" value="1" /> Yes</label>
					<label class="radio inline" for="veteran_n" >
						<input
					type="radio" id="veteran_n" name="veteran" value="0"/> No</label>
				</div>
			</div>
			
			<div class="control-group">
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


