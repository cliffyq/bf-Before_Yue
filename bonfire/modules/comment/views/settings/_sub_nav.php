<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/settings/comment') ?>"
		id="list"><?php echo lang('comment_list'); ?> </a>
	</li>
	<?php if ($this->auth->has_permission('Comment.Settings.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/settings/comment/create') ?>"
		id="create_new"><?php echo lang('comment_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
