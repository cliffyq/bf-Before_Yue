<div class="update_status">
	<br>
	<?php if ($msg == "error"): ?>
	<img class="status_img"
		src="<?php echo site_url('bonfire/themes/two column/images/update_failed').'.png'?>">
	<h4>Wrong data, operation failed!</h4>
	<?php else :?>
	<img class="status_img"
		src="<?php echo site_url('bonfire/themes/two column/images/update_success').'.png'?>">
	<h4>Operation successfully completed!</h4>
<<<<<<< HEAD
	<?php endif ?>
	<a class="btn btn-primary" href="<?=site_url()?>">back to homepage</a>
=======
<?php endif ?>
<a class="btn btn-primary" href="<?=site_url('company/company_company/video_manager')?>">back video manager</a>
>>>>>>> 33d6210e26b8d81c5853fc7f1e3fcbcbcd6f0bde

</div>
