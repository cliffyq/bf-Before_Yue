<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/industry') ?>"
		id="list"><?php echo lang('industry_list'); ?> </a>
	</li>
	<?php if ($this->auth->has_permission('Industry.Reports.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/reports/industry/create') ?>"
		id="create_new"><?php echo lang('industry_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
