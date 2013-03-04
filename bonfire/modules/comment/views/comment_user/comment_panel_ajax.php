
<div id="video_comment">
	<textarea class="video_comment_content"></textarea>
	<button id=<?php echo $vid ?> class="video_comment_post">post</button>
</div>

<!--example id='comment_content_pagination_view_ajax_paging'-->
<div id='comment_section'>
	<?php foreach($rows as $row): ?>
	<ul>
		<li class='comment_reply_effct'>
			<div id='comment_body'>
				<div id='comment_text' dir="Itr">
					<p>
						<?php echo $row['comment_content']; ?>
					
					
					<p>
				
				</div>
				<span><a><?php echo $row['comment_user'] ; ?> </a> </span>
				<?php
				if ($row['comment_reply_to'] != 0){
								echo "<span>in reply to "."<a>".$row['comment_parent_user']."</a><a parent_id = ".$row['comment_reply_to']." video_id = ".$vid." class = 'show_parent'> (Show original comment) </a></span>";
							}
							?>
				<span id='time'><a><?php echo $row['created_on']; ?> </a> </span>
			</div>
			<div id='comment_action' class='hidden'>
				<span><button id=<?php echo $row['id'] ?> class='reply_action'>reply</button>
				</span>
			</div>
			<div id='reply_part' class='hidden'>
				<textarea class='reply_input'></textarea>
				<button
					id=<?php echo $row['id'].'/'.$vid.'/'.$row['comment_user'] ?>
					class='reply_post'>post</button>
			</div>
		</li>
	</ul>
	<?php endforeach; ?>

</div>
<div id="comment_content_pagination_view_ajax_paging" class='ajaxify'>
	<?php echo $pagination_links; ?>
</div>
