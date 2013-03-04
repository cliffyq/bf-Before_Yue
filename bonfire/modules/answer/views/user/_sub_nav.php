<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/user/answer') ?>" id="list"><?php echo lang('answer_list'); ?>
	</a>
	</li>
	<?php if ($this->auth->has_permission('Answer.User.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/user/answer/create') ?>"
		id="create_new"><?php echo lang('answer_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
