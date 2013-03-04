<!--
	<form>
	<input type="text" class="input" placeholder="Username or Email">
	<table>
	<tbody>
	<td>
	
	<input type="password" class="input span11" placeholder="Password">
	</td>
	<td>
	<button type="submit" class="btn btn-primary pull-right">Sign in</button>
	</td>
	</tbody>
	</table>
	<label class="checkbox">
	<input type="checkbox"> Remember me
	</label>
	
	
	</form>
-->
<?php echo form_open('login', array('autocomplete' => 'off')); ?>
<input
	type="text" name="login" id="login_value"
	value="<?php echo set_value('login'); ?>" tabindex="1"
	placeholder="<?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('bf_username') .'/'. lang('bf_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>" />
<table id='home_login'>
	<tbody>
		<td><input class="span11" type="password" name="password"
			id="password" value="" tabindex="2"
			placeholder="<?php echo lang('bf_password'); ?>" />
		</td>
		<td><input class="btn btn-primary" type="submit" name="submit"
			id="submit" value="Sign in" tabindex="5" />
		</td>
	</tbody>
</table>
</br>
<?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
<label class="checkbox" for="remember_me"> <input type="checkbox"
	name="remember_me" id="remember_me" value="1" tabindex="3" /> <span
	class="inline-help"><?php echo lang('us_remember_note'); ?> </span>
</label>
<?php endif; ?>

<?php echo form_close(); ?>