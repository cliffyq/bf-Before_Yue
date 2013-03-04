<div class="video_card">
	<?php echo anchor('/user/view/'.$video['id'], '<img src="http://i4.ytimg.com/vi/kffacxfA7G4/mqdefault.jpg">')?>

	<div class='position'>
		<?php echo $video['position'] ?>
	</div>


	<div class='video_data'>
		<?php echo anchor('/user/view/'. $video['id'], $video['video_title'],'class="video_title"') ?>
		<div class='metadata'>
			<div class="viewcount">
				Viewed Count:
				<?php echo $video['viewcount'] ?>
			</div>

			<div class="company ellipsis">
				Company: <img
					src="<?php echo modules::run('company/company_company/get_logo', $company->company_logo)?>"
					alt="Company logo" height="20px" class="logo" />
				<?php echo anchor_popup($company->company_url, $company->company_name) ?>
			</div>

		</div>
	</div>


</div>
