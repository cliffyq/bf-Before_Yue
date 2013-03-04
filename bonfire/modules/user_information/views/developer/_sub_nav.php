<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/developer/user_information') ?>"
		id="list"><?php echo lang('user_information_list'); ?> </a>
	</li>
	<?php if ($this->auth->has_permission('User_information.Developer.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/developer/user_information/create') ?>"
		id="create_new"><?php echo lang('user_information_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
