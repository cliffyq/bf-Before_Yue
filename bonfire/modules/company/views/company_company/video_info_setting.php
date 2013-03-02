<div class="info_video_general">
	<?php if(isset($error)):?>
		<h2><?= $error ?></h2>
	<?php elseif(isset($video_info)):
			if($video_info->ajax == 0): ?>
				<h2>Video Info Settings</h2>
			<?php endif ?>
		<?php $attributes = array('id' => 'video_upadte', 'class' => "form-horizontal", 'method' => "POST");
		 echo form_open_multipart('company/company_company/video_info_updating/'.$video_info->id.'/'.$video_info->video_path, $attributes) ?>		
						<div class="control-group">
						 	<label class="control-label">Title</label>
							<div class="controls">
								 <input id="video_upload" type="text" name = "video_title" class="span6" value="<?=$video_info->video_title?>">
							</div>
						</div>
						
						<div class="control-group">
						 	<label class="control-label">Description</label>
							<div class="controls">
								 <textarea id="video_upload" name="video_description" class="span6" type="text" ><?=$video_info->video_description?></textarea>
							</div>
						</div>
						
						<div class="control-group">
						 	<label class="control-label">Thumbnail</label>
							<div class="controls">
								 <img></img>
								 <img></img>
								 <img></img>
							</div>
						</div>
						
						<div class="control-group">
						 	<label class="control-label">Tags</label>
							<div class="controls">
								 <input type="text" value="" name="video_tags" class="span6">
							</div>
						</div>
						
						<div class="control-group">
							<div class="controls">
								 <input class="btn btn-primary  change_submit" type="submit" name="submit" id="submit" value="save changes">
								 <a class="btn" >cancel</a>
								 <a class="btn btn-danger offset1" href="<?=site_url('company/company_company/video_deleting').'/'.$video_info->id?>">delete this video</a>
							</div>
						</div>
						
		<?php echo form_close(); ?>
	<?php endif ?>
</div>