<div id="video_report_info" class="video_report_info">
	<h3>Title: <?= $video_info['title'] ?></h3>
	<h3>Description: <?= $video_info['description'] ?></h3>
	<h3>View Count: <?= $video_info['view_count'] ?></h3>
	<h3>Average Rating: <?= $video_info['average_rating']?></h3>
</div>
<div class="">
	<div class = 'admin-box'>
		<h3>View History
			<a href="<?=base_url()?>company/company_company/export_csv/view/<?=$video_info['id']?>" class="pull-right btn btn-primary">Download Report</a>
		</h3>			
		<?php if($view_histories === false) :?> 
		<h2>N/A</h2>
		<?php else: ?>
		<div class="table-report">
			<table class='table table-striped'>
				
				<thead>
					<tr>
						<th>User Gender</th>
						<th>User Birth Month</th>
						<th>User Birth Year</th>
						<th>User Race</th>
						<th>User Education</th>
						<th>User Occupation</th>
						<th>User Zipcode</th>
						<th>User IP</th>
						<th>Time</th>			
					</tr>
				</thead>	
				<tbody>			
					<?php foreach ($view_histories as $view_history) : ?> 
					<tr>
						<td><?= isset($view_history['gender'])?$view_history['gender']:''?></td>
						<td><?= isset($view_history['birth_month'])?$view_history['birth_month']:''?></td>
						<td><?= isset($view_history['birth_year'])?$view_history['birth_year']:''?></td>
						<td><?= isset($view_history['race'])?$view_history['race']:''?></td>
						<td><?= isset($view_history['education'])?$view_history['education']:''?></td>
						<td><?= isset($view_history['occupation'])?$view_history['occupation']:''?></td>
						<td><?= isset($view_history['zipcode'])?$view_history['zipcode']:''?></td>
						<td><?= $view_history['ip']?></td>
						<td><?= $view_history['time']?></td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>	
				</tbody>
			</table>
		</div></div>
		
</div>