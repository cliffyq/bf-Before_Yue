<div class="logo_div span3">
	<a href=#>
		<img src="../assets/images/homepage/Logo.png"/>
	</a>
</div>
<div class="span2 pull-right">
<?php if (isset($current_user->email)) : ?>
	<div class="btn-group">
	<a class="offset1 btn get_in_btn" href="../prescreen/bootstrap/general_page" class="btn">
		Get In
	</a>
	</div>
<?php else :?>
	<div class="btn-group">
	<button class="offset1 btn dropdown-toggle login_btn" data-toggle="dropdown" href="#">
		Sign In
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu drop_down_login" >
		<?php echo form_open('login', array('autocomplete' => 'off')); ?>
		<li><input type="text" name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" placeholder="<?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('bf_username') .'/'. lang('bf_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>" /></li>
		<li><input class="" type="password" name="password" id="password" value="" tabindex="2" placeholder="<?php echo lang('bf_password'); ?>" /></li>	
		
		<?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
		<li>
		<label class="checkbox" for="remember_me">
			<input type="checkbox" name="remember_me" id="remember_me" value="1" tabindex="3" />
			<span class="inline-help"><?php echo lang('us_remember_note'); ?></span>
		</label>
		</li>
		<?php endif; ?>
		<li><input class="btn btn-primary" type="submit" name="submit" id="submit" value="Sign in" tabindex="5" /></li>
		<?php echo form_close(); ?>
	</ul>
	</div>
	<?php endif;?>

</div>
