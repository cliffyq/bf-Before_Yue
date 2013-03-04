<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/settings/company') ?>"
		id="list"><?php echo lang('company_list'); ?> </a>
	</li>
	<?php if ($this->auth->has_permission('Company.Settings.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/settings/company/create') ?>"
		id="create_new"><?php echo lang('company_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
