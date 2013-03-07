<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/developer/reviews') ?>"
		id="list"><?php echo lang('reviews_list'); ?> </a>
	</li>
	<?php if ($this->auth->has_permission('Reviews.Developer.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/developer/reviews/create') ?>"
		id="create_new"><?php echo lang('reviews_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
