<div id="comment_panel" class='span7'>
	<div id="video_comment" class='row'>
		<textarea class="video_comment_content"></textarea>
		<button id=<?php echo $vid ?> class="btn video_comment_post hidden">post</button>
	</div>

	<!--example id='comment_content_pagination_view_ajax_paging'-->
	<div id='comment_section' class='row'>
		<ul class='media-list'>
			<?php foreach($rows as $row): ?>
			<li class='media comment_reply_effct'>
				<div id='comment_body' class='media-body row'>
					<div id='content' class='span5'>
						<div id='comment_text' dir="Itr">
							<p>
								<?php echo $row['comment_content']; ?>
							</p>
						</div>
						<span><a><?php echo $row['comment_user'] ; ?> </a> </span>
						<?php
						if ($row['comment_reply_to'] != 0){
									echo "<span>in reply to "."<a>".$row['comment_parent_user']."</a><a parent_id = ".$row['comment_reply_to']." video_id = ".$vid." class = 'show_parent'> (Show original comment) </a></span>";
								}
								?>
						<span id='time'><a><?php echo $row['created_on']; ?> </a> </span>
					</div>
					<div id='comment_action' class='hidden span1'>
						<span><button id=<?php echo $row['id'] ?>
								class='btn reply_action pull-right'>reply</button> </span>
					</div>
				</div>

				<div id='reply_part' class='hidden'>
					<textarea class='reply_input'></textarea>
					<button
						id=<?php echo $row['id'].'/'.$vid.'/'.$row['comment_user'] ?>
						class='btn reply_post'>post</button>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div id="comment_content_pagination_view_ajax_paging"
		class='pagination pagination-mini'>
		<?php echo $pagination_links; ?>
	</div>
</div>
