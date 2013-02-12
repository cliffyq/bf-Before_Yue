
<video id='video_show' vid='<?=$vid?>' class='<?=$video_class?>' controls preload='none' width='100%' height='100%' poster=''data-setup='{}' wmode="transparent">
	
	<source src=<?php echo base_url().VIDEO_UPLOAD_PATH.$records->video_path.'video.mp4' ?> type='video/mp4' />
	<track kind='captions' src='captions.vtt' srclang='en' label='English' />
	<div>Overlay Div</div>
</video>


