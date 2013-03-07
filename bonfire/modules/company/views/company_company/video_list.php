<h1>Video List</h1>
<div>
	<p>click links below to view video reports</p>
</div>
<div class="video_list">
	<?php foreach($videos as $video): ?>
	<div>
		<a
			href="<?= base_url() ?>company/company_company/video_report/<?= $video['id'] ?>">
			<?php echo $video['video_title'];?>
		</a>
	</div>
	<?php endforeach; ?>
</div>
