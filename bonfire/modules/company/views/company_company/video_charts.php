<div class="container-fluid chart_general main_content" >
	
	<div class='chart_title_general'> 
		
		<h2 style="center">Charts</h2>
		
	</div>
	
	<div class='chart_body_general'>
		<div class='sort_selection'>
			
			
			
			<div class="btn-group ">
				<button class="btn  dropdown-toggle" data-toggle="dropdown"><?php echo $selection['sort']['text'] ?><span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><?php echo anchor(site_url('company/company_company/video_charts/viewcount/'.$selection['timefilter']['data']),'Most viewed')?></li>
				</ul>
			</div>
			
			<div class="btn-group time ">
				<button class="btn  dropdown-toggle" data-toggle="dropdown"><?php echo $selection['timefilter']['text'] ?> <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><?php echo anchor(site_url('company/company_company/video_charts/'.$selection['sort']['data'].'/day'),'Today')?></li>
					<li><?php echo anchor(site_url('company/company_company/video_charts/'.$selection['sort']['data'].'/week'),'This week')?></li>
					<li><?php echo anchor(site_url('company/company_company/video_charts/'.$selection['sort']['data'].'/month'),'This month')?></li>
					<li><?php echo anchor(site_url('company/company_company/video_charts/'.$selection['sort']['data'].'/all'),'All')?></li>
				
				</ul>
		</div>
			
			
			
			
		</div><!--sort selection-->
		<div class="chart_content_genernal">
			<div class = "row-fluid video_list" >
			<?php if (isset($video_cards) && is_array($video_cards) && count($video_cards)) : ?>
				<?php foreach($video_cards as $key=>$video_card): ?>
				<div class= 'span4 <?php echo $key%3?'':'first' ?>'>
					<?php echo $video_card;?>
					
				</div>		
				<?php endforeach; ?>
			</div><!--Video list-->
			
			<div id="video_chart_pagination_view_ajax_paging" class = 'pagination pagination-mini'>
				<?php echo $pagination_links; ?>
			</div>
			<?php else: ?>
				
					No records found that match your selection.
				
			<?php endif; ?>
		</div><!--chart_content-->
	</div><!--chart_body-->
	
	
</div><!--container-fluid-->