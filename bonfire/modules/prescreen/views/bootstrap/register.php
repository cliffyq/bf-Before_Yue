<?php echo form_open('register', array('autocomplete' => 'off')); ?>
<fieldset>
	<legend>Rate & bank </legend>
	<input type="text" placeholder="Username"> <input type="text"
		placeholder="Email"> <input type="text" placeholder="Password"> </br>
	<button type="submit" class="btn btn-primary btn-large">Sign up</button>
</fieldset>
<?php echo form_close(); ?>