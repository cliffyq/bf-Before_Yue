<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/incentive') ?>"
		id="list"><?php echo lang('incentive_list'); ?> </a>
	</li>
	<?php if ($this->auth->has_permission('Incentive.Reports.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/reports/incentive/create') ?>"
		id="create_new"><?php echo lang('incentive_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
