<section id="register_additional_info">
	<div class="page-header">
		<h1>
			<?php echo 'Additional Info'; ?>
		</h1>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<?php echo form_open('users/test/additional_info', array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>

			<div class="control-group">
				<label class="control-label required" for="industry_id"><?php echo lang('bf_industry'); ?>
				</label>
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
				<label class="control-label required"><?php echo lang('bf_veteran'); ?>
				</label>
				<div class="controls row-fluid">
					<label class="checkbox inline" for="veteran"> <input
						type="checkbox" id="" name="" value="" />
					</label>
				</div>
			</div>
			<div class="control-group offset1">
				<label class="control-label required" for="first_name"><?php echo lang('bf_full_name'); ?>
				</label>
				<div class="controls">
					<input value="<?php echo set_value('first_name') ?>" type="text"
						class="input-medium inline" placeholder="First name"
						id="first_name" name="first_name" value=""
						pattern="[a-z A-Z]{1,25}" maxlength="25" /> <input
						value="<?php echo set_value('last_name') ?>" type="text"
						placeholder="Last name" id="last_name" name="last_name" value=""
						pattern="[a-z A-Z]{1,25}" maxlength="25"
						class="input-medium inline" />
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<div class="span7 row-fluid">
						<div class="span2">
							<input class="btn btn-primary" type="submit" name="submit"
								id="submit" value="<?php echo lang('bf_submit'); ?>" />
						</div>
						<div class="span2">
							<input class="btn" type="submit" name="skip" id="skip"
								value="<?php echo lang('bf_skip'); ?>" />
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
