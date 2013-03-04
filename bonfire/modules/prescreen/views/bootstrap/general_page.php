<?php
Assets::add_css( array(
'bootstrap.css',
'bootstrap-responsive.css',
));

if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])) {
	Assets::add_js($this->load->view('ui/shortcut_keys', $shortcut_data, true), 'inline');
}

?>


<div class="container-fluid">

	<div class="span8">

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
	<div class="span4">
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
