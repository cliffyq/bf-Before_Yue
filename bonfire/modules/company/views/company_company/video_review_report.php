<div class='admin-box'>
	<h3>Rating History</h3>
	<?php if(isset($video_ratings)) :?>


	<table class='table table-striped'>
		<thead>
			<tr>
				<th>user ID</th>
				<th>Questions</th>
				<th>Answers</th>
				<th>rating</th>
				<th>time</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($video_ratings as $video_rating) : ?>
			<tr>
				<td><?= $video_rating['reviews_user_id'] ?></td>
				<td><?php for($i=0; $i<$question_count; $i++) : ?>
					<div>
						<?= $video_rating['Q'.$i]?>
					</div> <?php endfor; ?>
				</td>
				<td><?php for($i=0; $i<$question_count; $i++) : ?>
					<div>
						<?= $video_rating['A'.$i]?>
					</div> <?php endfor; ?>
				</td>
				<td><?= $video_rating['reviews_rating'] ?></td>
				<td><?= $video_rating['reviews_last_update'] ?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<h2>No ratings yet.</h2>
			<?php endif; ?>
		</tbody>
	</table>
</div>
