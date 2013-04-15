<div class="update_status" >
	<br>
<?php if ($msg == "error"): ?>
	<img class="status_img" src="<?php echo site_url('bonfire/themes/two_column/images/update_failed').'.png'?>" >
	<h4>Wrong data, operation failed!</h4>
<?php else :?>
	<img class="status_img" src="<?php echo site_url('bonfire/themes/two_column/images/update_success').'.png'?>">
	<h4>Operation successfully completed!</h4>
<?php endif ?>
<a class="btn btn-primary" href="<?=site_url('video/company/video_manager')?>">back video manager</a>

</div>
