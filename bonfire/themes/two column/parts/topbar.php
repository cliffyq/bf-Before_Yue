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
			<div class="">
				
				<ul class="nav pull-right">
					
					<?php if (isset($current_user->email)) : ?>
					<!--user menu-->
					<li class="">
						
						<button class="btn  dropdown-toggle" data-toggle="dropdown" href="<?php echo site_url(SITE_AREA .'/settings/users/edit') ?>" id="tb_email" class="btn dark" title="<?php echo lang('bf_user_settings') ?>">
							<?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?>
							<span class="caret"></span>
						</button>
						<!-- Change **light** to **dark** to match colors 
						<a class="btn dropdown-toggle light" data-toggle="dropdown" href="#"><span class="caret"></span></a>-->
						<ul class="dropdown-menu toolbar-profile">
							<li>
								<div class="inner">
									<!--<div class="toolbar-profile-img">   --------------wrong image address, need to be corrected
										<?php// echo gravatar_link($current_user->email, 96, null, $current_user->display_name) ?>
									</div> -->
									<div class="toolbar-profile-img">
										<img src=<?= base_url();?>/bonfire/themes/two%20column/images/user.png  height='100px'/>
									</div> 
									
									<div class="toolbar-profile-info">
										<p><b><?php echo $current_user->display_name ?></b><br/>
											<?php e($current_user->email) ?>
											<br/>
										</p>
										<a href="<?php echo site_url(SITE_AREA .'/settings/users/edit') ?>"><?php echo lang('bf_user_settings')?></a>
										<a href="<?php echo site_url('logout'); ?>"><?php echo lang('bf_action_logout')?></a>
									</div>
								</div>
							</li>
						</ul>
					</li>
					
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
							<input class="btn btn-primary" onClick="location.href='<?php echo site_url('/register')?>';" name="button2" type="button" id="button2" value="Register" />
							
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
			<div class="input-append input-prepend offset9 top_search_panel">
					<input type="text" placeholder="Search All"><button type="submit" class="btn" ><i class="icon-search"></i></button>
			</div>
		</div>	<!-- /.container -->
	</div>	<!-- /.navbar-inner -->
</div>	<!-- /.navbar -->
<!-- End of Navbar Template -->

