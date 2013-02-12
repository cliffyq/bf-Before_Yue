<?php
	Assets::add_css( array(
	'bootstrap.css',
	'bootstrap-responsive.css',
	));
	
	if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])) {
		Assets::add_js($this->load->view('ui/shortcut_keys', $shortcut_data, true), 'inline');
	}
	
?>
<!doctype html>
<html lang="en">
	<head> 
		<meta charset="utf-8">
		<title><?php echo isset($toolbar_title) ? $toolbar_title .' : ' : ''; ?> <?php echo $this->settings_lib->item('site.title') ?></title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<meta name="robots" content="noindex" />
		<?php echo Assets::css(null, true); ?>
		
		<script src="<?php echo Template::theme_url('js/modernizr-2.5.3.js'); ?>"></script>
	</head>
	
	<body class="desktop">	
		<div class="navbar">
			<div class="navbar-inner">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</a>
				<div class="nav-collapse collapse">
					<!-- .nav, .navbar-search, .navbar-form, etc -->
					<ul class="dropdown-menu">
						<li><a href="#">Link</a></li>
					</ul>
					
				</div>
				<a class="brand" href="#">Title</a>
				<ul class="nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">Link</a></li>
					<li class="divider-vertical"></li>
					<li><a href="#">Link</a></li>
					
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Account
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#">Link</a></li>
						</ul>
					</li>
					
					
				</ul>
			</div>
		</div>
		
		
		<div class="container-fluid body">
			<div class ="row-fluid">
				<div class="span4">
					<div>
						<form>
							<input type="text" class="input" placeholder="Username or Email">
							<table>
							<tbody>
							<td>
					
								<input type="password" class="input span11" placeholder="Password">
							</td>
							<td>
								<button type="submit" class="btn btn-primary pull-right">Sign in</button>
							</td>
							</tbody>
							</table>
							<label class="checkbox">
								<input type="checkbox"> Remember me
							</label>
							
							
						</form>
					</div>
					<div>
						<form>
							<fieldset>
								<legend>Rate & bank </legend>
								<label>Label name</label>
								<input type="text" placeholder="Username">
								<input type="text" placeholder="Email">
								<input type="text" placeholder="Password">
								</br>
								<button type="submit" class="btn btn-primary btn-large">Sign up </button>
							</fieldset>
						</form>
					</div>
				</div><!-- span4 -->
				
				<div class="span8">
					
					<h1>Video</h1> 
					<p>some video</p>
					
					<div><?php echo $video_panel ?></div>
				</div><!-- span 8-->
			</div><!--row fluid-->
		</div><!-- container end -->
	</body>	
	<footer>
	</footer>						