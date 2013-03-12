<div class="video_card">
		<?php echo anchor('/user/view/'.$video['id'], '<img src="http://i4.ytimg.com/vi/kffacxfA7G4/mqdefault.jpg">')?>

		<div class='position'><?php echo $video['position'] ?></div>


		<div class='video_data'>
			<?php echo anchor('/user/view/'. $video['id'], $video['video_title'],'class="video_title"') ?>
			<div class='metadata'>
			<div class="sort_option">
				<?php if(isset($video['viewcount'])) : ?>
				Viewed Count: <?php echo $video['viewcount']; ?>
				<?php elseif(isset($video['toprated'])): ?>
			<!--	<div id = "reviews_avg_rating">
					<div class = "" id="reviews_avg_rating_stars"><?=$video['toprated']?></div>
				</div>
			-->	
				Rating:<?php echo $video['toprated'] ?>
				<?php endif; ?> 
			
				
				</div>

				<div class="company ellipsis">
				 <img src="<?php echo modules::run('company/company_company/get_logo', $company->company_logo)?>" alt="Company logo" height="20px" class = "logo"/><?php echo anchor_popup($company->company_url, $company->company_name) ?> 
				</div>
				
			</div>
		</div>
	
	
</div>
