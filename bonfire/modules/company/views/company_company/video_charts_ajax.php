<div class = "row video_list" >
			<div class='span0'style="height:0px" ></div>
			<?php foreach($video_cards as $video_card): ?>
				<div class= 'span4'>
					<?php echo $video_card;?>

				</div>		
			<?php endforeach; ?>
		</div><!--Video list-->
		<div id="video_chart_pagination_view_ajax_paging" class = 'pagination pagination-mini'>
					<?php echo $pagination_links; ?>
		</div>