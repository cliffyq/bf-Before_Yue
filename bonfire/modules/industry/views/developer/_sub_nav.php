<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/developer/industry') ?>"
		id="list"><?php echo lang('industry_list'); ?> </a>
	</li>
	<?php if ($this->auth->has_permission('Industry.Developer.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/developer/industry/create') ?>"
		id="create_new"><?php echo lang('industry_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
