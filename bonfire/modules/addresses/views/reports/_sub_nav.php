<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/addresses') ?>" id="list"><?php echo lang('addresses_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Addresses.Reports.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/reports/addresses/create') ?>" id="create_new"><?php echo lang('addresses_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>