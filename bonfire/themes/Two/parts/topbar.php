<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">

		<div class="container">
			<!-- .btn-navbar is used as the toggle for collapsible content -->
			<a class="btn btn-navbar" data-toggle="collapse"
				data-target=".nav-collapse"> <span class="icon-bar"></span> <span
				class="icon-bar"></span> <span class="icon-bar"></span>
			</a> <a href="<?php site_url('/'); ?>"
				title="<?php e($this->settings_lib->item('site.title')); ?>"
				class="logo"> </a>
			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">

					<?php //style="height:40px" ?>
					<?php if (isset($current_user->email)) : ?>
					<li><a class="header-link"
						href="<?php echo site_url('register');?>"> <?php echo lang('bf_action_register') ?>
					</a>
					</li>
					<li><a class="header-link" href="<?php echo site_url('login');?>"
						class="login-btn"> <?php echo lang('bf_action_login') ?>
					</a>
					</li>
					<?php else :  ?>

					<li><a class="header-link"
						href="<?php echo site_url('register');?>"> <?php echo lang('bf_action_register') ?>
					</a>
					</li>
					<li><a class="header-link" href="<?php echo site_url('login');?>"
						class="login-btn"> <?php echo lang('bf_action_login') ?>
					</a>
					</li>

					<?php endif; ?>
				</ul>

			</div>
			<!--/.nav-collapse -->
		</div>
		<!-- /.container -->
	</div>
	<!-- /.navbar-inner -->
</div>
<!-- /.navbar -->
<!-- End of Navbar Template -->

