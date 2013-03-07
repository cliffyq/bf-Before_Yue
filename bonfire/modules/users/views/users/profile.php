<section id="profile">

	<div class="page-header">
		<h1>
			<?php echo lang('us_edit_profile'); ?>
		</h1>
	</div>

	<?php if (auth_errors() || validation_errors()) : ?>
	<div class="row-fluid">
		<div class="span8 offset2">
			<div class="alert alert-error fade in">
				<a data-dismiss="alert" class="close">&times;</a>
				<?php echo auth_errors() . validation_errors(); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if (isset($user) && $user->role_name == 'Banned') : ?>
	<div class="row-fluid">
		<div class="span8 offset2">
			<div data-dismiss="alert" class="alert alert-error fade in">
				<a data-dismiss="alert" class="close">&times;</a>
				<?php echo lang('us_banned_admin_note'); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="row-fluid">
		<div class="span8 offset2">
			<div class="alert alert-info fade in">
				<a data-dismiss="alert" class="close">&times;</a>
				<h4 class="alert-heading">
					<?php echo lang('bf_required_note'); ?>
				</h4>
				<?php if (isset($password_hints)):?>
				<?php echo $password_hints; ?>
				<?php endif;?>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">

			<?php echo form_open($this->uri->uri_string(), array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>



			<div
				class="control-group <?php echo iif( form_error('email') , 'error') ;?>">
				<label class="control-label required" for="email"><?php echo lang('bf_email'); ?>
				</label>
				<div class="controls">
					<input class="span6" type="text" id="email" name="email"
						value="<?php echo set_value('email', isset($user) ? $user->email : '') ?>" />
				</div>
			</div>

			<?php if ( settings_item('auth.login_type') !== 'email' OR settings_item('auth.use_usernames')) : ?>
			<div
				class="control-group <?php echo iif( form_error('username') , 'error') ;?>">
				<label class="control-label required" for="username"><?php echo lang('bf_username'); ?>
				</label>
				<div class="controls">
					<input class="span6" type="text" id="username" name="username"
						value="<?php echo set_value('username', isset($user) ? $user->username : '') ?>" />
				</div>
			</div>
			<?php endif; ?>

			<br />

			<div
				class="control-group <?php echo iif( form_error('password') , 'error') ;?>">
				<label class="control-label" for="password"><?php echo lang('bf_password'); ?>
				</label>
				<div class="controls">
					<input class="span6" type="password" id="password" name="password"
						value="" />
				</div>
			</div>

			<div
				class="control-group <?php echo iif( form_error('pass_confirm') , 'error') ;?>">
				<label class="control-label" for="pass_confirm"><?php echo lang('bf_password_confirm'); ?>
				</label>
				<div class="controls">
					<input class="span6" type="password" id="pass_confirm"
						name="pass_confirm" value="" />
				</div>
			</div>

			<?php
			// Allow modules to render custom fields
			Events::trigger('render_user_form', $user );
			?>

			<!-- Start User Meta -->
			<?php $this->load->view('users/user_meta', array('frontend_only' => TRUE));?>
			<!-- End of User Meta -->

			<!-- Start of Form Actions -->
			<div class="form-actions">
				<input type="submit" name="submit" class="btn btn-primary"
					value="<?php echo lang('bf_action_save') .' '. lang('bf_user') ?> " />
				<?php echo lang('bf_or') ?>
				<?php echo anchor('/', '<i class="icon-refresh icon-white">&nbsp;</i>&nbsp;' . lang('bf_action_cancel'), 'class="btn btn-warning"'); ?>
			</div>
			<!-- End of Form Actions -->

			<?php echo form_close(); ?>

		</div>
	</div>
</section>
