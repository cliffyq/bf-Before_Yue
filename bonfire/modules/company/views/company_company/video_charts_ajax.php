
<div class="row-fluid video_list">

	<?php foreach($video_cards as $key=>$video_card): ?>
	<div class='span4 <?php echo $key%3?'':'first' ?>'>
		<?php echo $video_card;?>

	</div>
	<?php endforeach; ?>
</div>
<!--Video list-->

<div id="video_chart_pagination_view_ajax_paging"
	class='pagination pagination-mini'>
	<?php echo $pagination_links; ?>
</div>

