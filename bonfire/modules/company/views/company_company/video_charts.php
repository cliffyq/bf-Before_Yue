<div class="container-fluid chart_general main_content" >
	
	<div class='row-fluid chart_title_general'> 
		<div class='span6'>
			<div class="input-append video_chart_search">
					<input type="text" placeholder="Search All"><button type="submit" class="btn" ><i class="icon-search"></i></button>
			</div>
		</div><!--span6-->
		<div class='span6'>
			<h2 class='pull-right'>Charts</h2>
		</div><!--span6-->
	</div><!--row-fluid-->
	<div class='chart_body_general'>
		<div class='row sort_selection' >
			<div class='span5' style="height:0px">	
				
				
				
				<div class="btn-group">
					<button class="btn  dropdown-toggle" data-toggle="dropdown">Most Viewed <span class="caret"></span></button>
					<ul class="dropdown-menu">
						
					</ul>
				</div>
				
			
				<div class="btn-group time">
					<button class="btn  dropdown-toggle" data-toggle="dropdown">All time <span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#">This Month</a></li>
						<li><a href="#">This Week</a></li>
						<li><a href="#">Today</a></li>
					</ul>
				</div>
				
				
				
			</div>
		</div><!--video selection-->
		<div class="chart_content_genernal">
			<div class = "row video_list" >
				<?php foreach($video_cards as $video_card): ?>
				<div class= 'span4'>
					<?php echo $video_card;?>
					
				</div>		
				<?php endforeach; ?>
			</div><!--Video list-->
			<div id="video_chart_pagination_view_ajax_paging" class = 'pagination pagination-mini'>
				<?php echo $pagination_links; ?>
			</div>
		</div><!--chart_content-->
	</div><!--chart_body-->
	
	
</div><!--container-fluid-->