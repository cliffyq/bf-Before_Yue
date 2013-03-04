<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/company/question') ?>"
		id="list"><?php echo lang('question_list'); ?> </a>
	</li>
	<?php if ($this->auth->has_permission('Question.Company.Create')) : ?>
	<li
	<?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
		<a
		href="<?php echo site_url(SITE_AREA .'/company/question/create') ?>"
		id="create_new"><?php echo lang('question_new'); ?> </a>
	</li>
	<?php endif; ?>
</ul>
