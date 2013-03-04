<div id="video_report_info" class="video_report_info">
	<h3>
		Title:
		<?= $video_info['title'] ?>
	</h3>
	<h3>
		Description:
		<?= $video_info['description'] ?>
	</h3>
	<h3>
		View Count:
		<?= $video_info['view_count'] ?>
	</h3>
	<h3>
		Average Rating:
		<?= $video_info['average_rating']?>
	</h3>
</div>
<div class="reports">
	<div class='admin-box view_history'>
		<h3>
			View History:
			<?php $record_count = count($view_histories);
			if ($record_count==0) echo 'No record';
			else if ($record_count == 1) echo ' 1 record';
			else echo ' '.$record_count.' records' ?>
			<a
				href="<?=base_url()?>company/company_company/export_csv/view/<?=$video_info['id']?>"
				class="pull-right btn btn-primary">Download Report</a>
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
						<th>User Zipcode</th>
						<th>User IP</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($view_histories as $view_history) : ?>
					<tr>
						<td><?= isset($view_history['gender'])?$view_history['gender']:''?>
						</td>
						<td><?= isset($view_history['birth_month'])?$view_history['birth_month']:''?>
						</td>
						<td><?= isset($view_history['birth_year'])?$view_history['birth_year']:''?>
						</td>
						<td><?= isset($view_history['race'])?$view_history['race']:''?></td>
						<td><?= isset($view_history['education'])?$view_history['education']:''?>
						</td>
						<td><?= isset($view_history['zipcode'])?$view_history['zipcode']:''?>
						</td>
						<td><?= $view_history['ip']?></td>
						<td><?= $view_history['time']?></td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="admin-box review_history">

		<h3>
			Review History:
			<?php $record_count = count($review_histories);
			if ($record_count==0) echo 'No record';
			else if ($record_count == 1) echo ' 1 record';
		else echo ' '.$record_count.' records' ?>
			<a
				href="<?=base_url()?>company/company_company/export_csv/review/<?=$video_info['id']?>"
				class="pull-right btn btn-primary">Download Report</a>
		</h3>
		<?php if(isset($review_histories) && !empty($review_histories)) :?>
		<div class="table-report">
			<table class='table table-striped'>
				<thead>
					<tr>
						<th>User Gender</th>
						<th>User Birth Month</th>
						<th>User Birth Year</th>
						<th>User Race</th>
						<th>User Education</th>
						<th>User Zipcode</th>
						<th>Questions & Answers</th>
						<th>Rating</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($review_histories as $review_history) : ?>
					<tr>
						<td><?= isset($review_history['gender'])?$review_history['gender']:''?>
						</td>
						<td><?= isset($review_history['birth_month'])?$review_history['birth_month']:''?>
						</td>
						<td><?= isset($review_history['birth_year'])?$review_history['birth_year']:''?>
						</td>
						<td><?= isset($review_history['race'])?$review_history['race']:''?>
						</td>
						<td><?= isset($review_history['education'])?$review_history['education']:''?>
						</td>
						<td><?= isset($review_history['zipcode'])?$review_history['zipcode']:''?>
						</td>
						<td><?= $review_history['questions & answers'] ?></td>
						<td><?= $review_history['rating'] ?></td>
						<td><?= $review_history['time'] ?></td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>

</div>
