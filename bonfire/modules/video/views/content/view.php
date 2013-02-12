

	
	<video id='video_show' vid='<?=$vid?>' class='<?=$video_class?>' controls preload='none' width='640' height='264'
	poster=''
	data-setup='{}'>
		
		<source src=<?php echo base_url().VIDEO_UPLOAD_PATH.$records->video_path.'video.mp4' ?> type='video/mp4' />
		<track kind='captions' src='captions.vtt' srclang='en' label='English' />
	</video>


