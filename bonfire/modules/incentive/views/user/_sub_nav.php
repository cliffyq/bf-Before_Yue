<ul class="nav nav-pills">
	<li><?php echo modules::run('user_information/get_current_points')?>
	</li>
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/user/incentive') ?>"
		id="shop">Shop</a>
	</li>
	<li
	<?php echo $this->uri->segment(4) == 'charity' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/user/incentive/charity') ?>"
		id="charity">Charity</a>
	</li>
</ul>
