<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/content/video_question') ?>" id="list"><?php echo lang('video_question_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Video_Question.Content.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/content/video_question/create') ?>" id="create_new"><?php echo lang('video_question_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>