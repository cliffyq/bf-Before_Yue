<div class="accordion" id="reviews_user_review_panel">
	<button id="reviews_user_review_panel_toggle_review_btn" type="button"
		class="btn" data-toggle="collapse"
		data-target="#reviews_user_review_panel_content">
		<?=$button_text?>
	</button>
	<div id="reviews_user_review_panel_content"
		class="collapse <?php if(!$has_reviewed) echo 'in';?>">
		<form id="reviews_user_review_panel_ajax">
			<fieldset>
				<div id="reviews_user_review_panel_rating_section">
					<label for="reviews_user_review_panel_stars">Rating:</label>
					<div id="reviews_user_review_panel_stars"></div>
					<div id="reviews_user_review_panel_hint"></div>
				</div>

				<ul id="reviews_user_review_panel_question_section">
					<?php foreach($questions as $kq=>$v):?>
					<li id="reviews_user_review_panel_question_<?=$kq+1?>_area"><label
						for="reviews_user_review_panel_question_<?=$kq+1?>">Question <?=$kq+1?>:
					</label>
						<div id="reviews_user_review_panel_question_<?=$kq+1?>">
							<?= $v['question'] ?>
						</div>
						<div id="reviews_user_review_panel_question_<?=$kq+1?>_answers"
							qid="<?=$v['q_id']?>">
							<?php foreach ($v['answer'] as $a_id=>$a): ?>
							<input type='radio' name='question_<?=$kq+1?>'
							<?php if($has_reviewed || !$is_logged_in) echo 'disabled';?>
								value=<?=$a_id?>
								<?php if(isset($prev_answers[$v['q_id']]) && $prev_answers[$v['q_id']] == $a_id) echo 'checked'?> />
							<?=$a?>
							<?php endforeach?>
						</div>
					</li>
					<?php endforeach?>
				</ul>
				<div id="reviews_user_review_panel_comment_section">
					<textarea
					<?php if(!$has_reviewed) echo 'placeholder="Your Comments Here:"';?>
					<?php if($has_reviewed || !$is_logged_in) echo 'readonly';?>></textarea>
				</div>
				<input type="hidden" name="score"
					id="reviews_user_review_panel_score"
					value="<?php if (isset($score)) echo $score; else echo 0;?>" /> <input
					type="hidden" name="video_id"
					id="reviews_user_review_panel_review_video_id"
					value="<?php if(isset($vid)) echo $vid ?>" />
				<?php if(!$has_reviewed && $is_logged_in):?>
				<div class="form-actions">
					<input id="reviews_user_review_panel_submit_button" type="submit"
						name="save" class="btn btn-primary" value="Submit Review" />
				</div>
				<?php endif; ?>
			</fieldset>
		</form>
	</div>
</div>
