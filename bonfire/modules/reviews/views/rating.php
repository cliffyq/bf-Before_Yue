<form id='rating_ajax'>
<?php //echo form_open('reviews/submit'); ?>
</fieldset>
	<div id="stars"></div>
	<div id="hint"></div>
	<input type="hidden" name="score1" id="score" value="" />
	<input type="hidden"  name="video_id1" id="video_id" value=<?= $video_id ?> />
	<div class="form-actions">
		<input id='rating_submit' type="submit" name="save" class="<?=$post_button_class?>" value="Submit Rating" />
	</div>
</fieldset>
<?php //echo form_close(); ?>

</form>
