<section id="register_additional_info">
	<div class="page-header">
		<h1><?php echo 'Additional Info'; ?></h1>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			<?php echo form_open('additional_info', array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
		
			<div class="control-group">
				<label class="control-label required" for="industry_id"><?php echo lang('bf_industry'); ?></label>
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
			
			<div class="control-group">
				<label class="control-label required" for="occupation"><?php echo lang('bf_occupation'); ?></label>
				<div class="controls">
					<select id="occupation" class="span4" name="industry">
							<option value="">Please Select:</option>
							<option value="1">Manager</option>
							<option value="2">Student</option>
							<option value="3">Teacher</option>
							<option value="4">Other</option>
					</select> 
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label required" ><?php echo lang('bf_veteran'); ?></label>
				<div class="controls row-fluid">
					<label class="checkbox inline" for="veteran" >
						<input type="checkbox" id="" name="" value="" />
					</label>
				</div>
			</div>
			
			<div class="control-group">
				<div class="controls">
					<div class="span7 row-fluid">
						<div class = "span2">	
							<input class="btn btn-primary" type="submit" name="submit" id="submit" value="<?php echo lang('bf_submit'); ?>"  />
						</div>
						<div class = "span2">
							<input class="btn" type = "submit" name="skip" id="skip" value="<?php echo lang('bf_skip'); ?>" />
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</section>