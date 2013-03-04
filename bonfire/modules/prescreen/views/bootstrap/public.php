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
<title><?php echo isset($toolbar_title) ? $toolbar_title .' : ' : ''; ?>
	<?php echo $this->settings_lib->item('site.title') ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="robots" content="noindex" />
<?php echo Assets::css(null, true); ?>

<script
	src="<?php echo Template::theme_url('js/modernizr-2.5.3.js'); ?>"></script>
</head>

<body class="desktop">
	<div class="navbar">
		<div class="navbar-inner">
			<a class="btn btn-navbar" data-toggle="collapse"
				data-target=".nav-collapse"> <span class="icon-bar"></span> <span
				class="icon-bar"></span> <span class="icon-bar"></span>
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


				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"> Account <b class="caret"></b>
				</a>
					<ul class="dropdown-menu">
						<li><a href="#">Link</a></li>
					</ul>
				</li>


			</ul>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span3">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
						<li class="nav-header">Video</li>
						<li class="active"><a href="#">Feature</a></li>
						<li><a href="#">Top</a></li>
						<li><a href="#">history</a></li>
						<li class="nav-header">Incentive</li>
						<li><a href="#">my bank</a></li>
						<li><a href="#">shop</a></li>
						<li><a href="#">charity</a></li>

						<li class="nav-header">Company</li>
						<li><a href="#">Link</a></li>
						<li><a href="#">Link</a></li>
						<li><a href="#">Link</a></li>
					</ul>
				</div>
				<!--/.well -->
			</div>
			<!--/span-->
			<div class="span6">

				<div class="hero-unit">
					<h1>Welcome</h1>
					<p>some cool stuff.</p>
					<p>
						<?php echo $video_part ?>
					</p>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<h4>wonderful</h4>
						<p>
							<?php echo $video_part ?>
						</p>
						<p>
							<a class="btn" href="../../user/view/47">Watch & Rate &raquo;</a>
						</p>
					</div>
					<!--/span-->
					<div class="span4">
						<h4>Heading</h4>
						<p>
							<?php echo $video_part ?>
						</p>
						<p>
							<a class="btn" href="../../user/view/47">Watch & Rate &raquo;</a>
						</p>
					</div>
					<!--/span-->
					<div class="span4">
						<h4>Heading</h4>
						<p>
							<?php echo $video_part ?>
						</p>
						<
						<p>
							<a class="btn" href="../../user/view/47">Watch & Rate &raquo;</a>
						</p>
					</div>
					<!--/span-->
				</div>
				<!--/row-->

			</div>
			<!--/span-->
			<div class="span3">
				<h2>related video</h2>
				<div class="row-fluid">
					<div class='span6'>
						<p>
							<?php echo $video_part ?>
						</p>
					</div>
					<div class='span6'>
						<a href="../../user/view/47">some discription. you can add some
							details</a>
					</div>
				</div>

				<div class="row-fluid">
					<div class='span6'>
						<p>
							<?php echo $video_part ?>
						</p>
					</div>
					<div class='span6'>
						<a href="../../user/view/47">some discription. you can add some
							details</a>
					</div>
				</div>

				<div class="row-fluid">
					<div class='span6'>
						<p>
							<?php echo $video_part ?>
						</p>
					</div>
					<div class='span6'>
						<a href="../../user/view/47">some discription. you can add some
							details</a>
					</div>
				</div>

				<div class="row-fluid">
					<div class='span6'>
						<p>
							<?php echo $video_part ?>
						</p>
					</div>
					<div class='span6'>
						<a href="../../user/view/47">some discription. you can add some
							details</a>
					</div>
				</div>


			</div>
			<!--a span3 -->
		</div>
		<!--/row-->



	</div>
	<!--container-->
</body>

<style scoped>
video {
	width: 100% !important;
	height: auto !important;
}
</style>