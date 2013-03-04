<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/commonauth/video_extra_information') ?>"
		id="list"><?php echo lang('video_extra_information_list'); ?> </a>
	</li>
	<?php if ($this->auth->has_permission('Video_extra_information.Commonauth.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/commonauth/video_extra_information/create') ?>"
		id="create_new"><?php echo lang('video_extra_information_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
