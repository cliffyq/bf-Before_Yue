<h1>Video Title: <?= $video_info['video_title'] ?></h1>
<h2 video_id = <?= $video_info['id'] ?>>ID: <?= $video_info['id'] ?></h2>
<h2>Video_description: <?= $video_info['video_description'] ?></h2>
<h3>Total Views: <?= $view_count ?><h3>
	<h3>Average Ratings: <?= $average_rating ?></h3>
		<div class="">
			<div class = 'admin-box'>
			<h3>View History
				<button export_type ="view" class = "export_form pull-right btn btn-primary">Export Form</button>
			</h3>			
			<?php if($video_histories == null) :?> 
				<h2>N/A</h2>
			<?php else: ?>
						<table class='table table-striped'>
							<thead>
								<tr>					
									<th>user Gender</th>
									<th>user IP</th>
									<th>time</th>			
								</tr>
							</thead>	
							<tbody>			
			<?php foreach ($video_histories as $video_history) : ?> 
								<tr>
									<td><?= isset($video_history['gender'])?$video_history['gender']:''?></td>
									<td><?= $video_history['video_view_history_ip']?></td>
									<td><?= $video_history['video_view_history_created_on']?></td>
								</tr>
			<?php endforeach; ?>
			<?php endif; ?>	
			</tbody>
			</table>
			</div>
			
			<div class = 'admin-box'>
			<h3>Review History
				<button export_type = "review" class = "export_form pull-right btn btn-primary">Export Form</button>
				</h3>	
					<?php if($video_ratings == null) :?> 
						<h2>N/A</h2>
					<?php else: ?>					
						<table class='table table-striped'>
							<thead>
								<tr>					
									<th>user ID</th>
									<th>Questions </th>
									<th>Answers </th>
									<th>rating </th>
									<th>time</th>			
								</tr>
							</thead>
							<tbody>	
					<?php foreach ($video_ratings as $video_rating) : ?> 							
								<tr>
									<td><?= $video_rating['reviews_user_id'] ?></td>
									<td>
										<?php for($i=0; $i<$question_count; $i++) : ?>
											<div><?= $video_rating['Q'.$i]?></div>
										<?php endfor; ?>
									</td>
									<td>
										<?php for($i=0; $i<$question_count; $i++) : ?>
											<div><?= $video_rating['A'.$i]?></div>
										<?php endfor; ?>
									</td>
									<td><?= $video_rating['reviews_rating'] ?></td>
									<td><?= $video_rating['reviews_last_update'] ?></td>
								</tr>			 
					<?php endforeach; ?> 
					<?php endif; ?>
						</tbody>
					</table>
					</div>		
</div>				