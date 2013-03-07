<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/settings/video_question') ?>"
		id="list"><?php echo lang('video_question_list'); ?> </a>
	</li>
	<?php if ($this->auth->has_permission('Video_Question.Settings.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/settings/video_question/create') ?>"
		id="create_new"><?php echo lang('video_question_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
