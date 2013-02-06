<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		
	    <div class="container">
			<!-- .btn-navbar is used as the toggle for collapsible content -->
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</a>
			<a href="<?=site_url('/');?>" class="logo"></a>
			</a>
			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
					
					<?php //style="height:40px" ?>
					<?php if (isset($current_user->email)) : ?>
						<a href="../prescreen/bootstrap/general_page">
							<button class="btn get_in_btn"  class="btn">
								Get In
							</button>
							<a href="<?php echo site_url('logout');?>">
								<button class="btn">
									<?php echo lang('bf_action_logout') ?>
								</button>
							</a>
						</a>

					<?php else :  ?>
					
					<li class="">
						
							<button class="dropdown-toggle btn" data-toggle="dropdown" href="#">
							<?php echo lang('bf_action_login') ?>
							</button>
							<ul class="dropdown-menu " style="text-align:center; Padding:10px">
								<?php echo form_open('login', array('autocomplete' => 'off')); ?>
									<input type="text" name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" placeholder="<?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('bf_username') .'/'. lang('bf_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>" />
									<input class="" type="password" name="password" id="password" value="" tabindex="2" placeholder="<?php echo lang('bf_password'); ?>" />		
									<?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
									<label class="checkbox" for="remember_me">
										<input type="checkbox" name="remember_me" id="remember_me" value="1" tabindex="3" />
										<span class="inline-help"><?php echo lang('us_remember_note'); ?></span>
									</label>
									<input class="btn btn-success" type="submit" name="submit" id="submit" value="Sign In" tabindex="5" />
									<input class="btn btn-primary" onClick="location.href='<?= site_url('/register')?>';" name="button2" type="button" id="button2" value="Register" />
		
									<?php endif; ?>
								<?php echo form_close(); ?>
							</ul>
						
					</li>
				<!--
					<li>
						<a class="header-link" href="<?php echo site_url('login');?>" class="login-btn">
						<?php //echo lang('bf_action_login') ?>
						</a>
					</li>
				-->	
					<?php endif; ?>
				</ul>
				
			</div><!--/.nav-collapse -->
		</div>	<!-- /.container -->
	</div>	<!-- /.navbar-inner -->
</div>	<!-- /.navbar -->
<!-- End of Navbar Template -->

