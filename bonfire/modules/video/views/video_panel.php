<div id='video_video_panel'>
	<div id='video_title'>
		<h2><?= $title ?></h2>
	</div>
	Test:<?php echo $average_rating ?>
	<div id='video_video_panel_company'>
		<img src="<?php echo modules::run('company/company_company/get_logo', $company->company_logo)?>" alt="Company logo" height="30" class = "logo"/><?php echo anchor_popup($company->company_url, $company->company_name) ?> 
	</div>
	<div id='video_video_panel_view'>
		<?php echo $video ?>
	</div>
	<div id='video_video_panel_rating'>
	<div class = ""><label for = "video_video_panel_rating">Average Rating:</label></div>
	<?php echo $average_rating ?>
	</div>
	<div id='video_video_panel_count'>
		<label for = "video_video_panel_count">Viewed Count: </label>
		<?php echo $count ?>
	</div>
	<div id='video_video_panel_points_earned'>
		<label for = "video_video_panel_count">Points earned: </label>
		<?php echo $points_earned ?>
	</div>
	
</div>

