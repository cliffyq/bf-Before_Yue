<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/user_info') ?>" id="list"><?php echo lang('user_info_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('User_Info.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/user_info/create') ?>" id="create_new"><?php echo lang('user_info_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>