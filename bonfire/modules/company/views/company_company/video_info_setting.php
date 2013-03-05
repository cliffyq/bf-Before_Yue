<div class="info_video_general">
	<?php if(isset($error)):?>
	<h2>
		<?= $error ?>
	</h2>
	<?php elseif(isset($video_info)):
			if($video_info->ajax == 0): ?>
				<h2>Edit Video</h2>
			<?php endif ?>
			
		<?php $attributes = array('id' => 'video_upadte', 'class' => "form-horizontal", 'method' => "POST");
		 echo form_open_multipart('company/company_company/video_info_updating/'.$video_info->id.'/'.$video_info->video_path, $attributes) ?>		
						<div class="control-group">
						 	<label class="control-label">Video</label>
							<div class="video_box_settings controls" >
			<video style="width: 100%"
				src="<?=site_url('upload/video').'/'.$video_info->video_path.'video.mp4';?>"
				controls></video>
							</div>
						</div>
						
						<div class="control-group">
						 	<label class="control-label">Title</label>
							<div class="controls">
								 <input id="video_upload" type="text" name = "video_title" class="video_info_elements" value="<?=$video_info->video_title?>">
							</div>
						</div>
						
						<div class="control-group">
						 	<label class="control-label">Description</label>
							<div class="controls">
								 <textarea id="video_upload" name="video_description" class="video_info_elements" type="text" ><?=$video_info->video_description?></textarea>
							</div>
						</div>
						
						<div class="control-group">
						 	<label class="control-label">Thumbnail</label>
							<div class="controls">
								 <input class="thumbnail_choice" type="hidden" name="video_thumbnail" value="1" style="width:0px; height:0px">
								 
								 <img style="width:130px" class="thumbnail_img" src="http://i00.i.aliimg.com/photo/v12/430742126/inflatable_water_game_water_amusement_park_water.summ.jpg"></img>
								 <img style="width:130px" src="http://i00.i.aliimg.com/photo/v12/430742126/inflatable_water_game_water_amusement_park_water.summ.jpg"></img>
								 <img style="width:130px" src="http://i00.i.aliimg.com/photo/v12/430742126/inflatable_water_game_water_amusement_park_water.summ.jpg"></img>
							</div>
						</div>
						
						<div class="control-group">
						 	<label class="control-label">Tags</label>
							<div class="controls">
								 <input type="text" value="" name="video_tags" class="video_info_elements">
							</div>
						</div>
						
						<div class="control-group">
							<div class="controls">
								 <input class="btn btn-primary  change_submit" type="submit" name="submit" id="submit" value="save changes">
								 <?php if($video_info->ajax == 0): ?>
								 	<a class="btn offset1" href="<?=site_url('company/company_company/video_manager')?>">cancel</a>
								 <?php else: ?>
								 	<a class="btn btn-danger offset1" href="<?=site_url('company/company_company/video_deleting').'/'.$video_info->id.'/'.$video_info->video_path?>">cancel upload</a>
								 <?php endif ?>
							</div>
						</div>
						
		<?php echo form_close(); ?>
	<?php endif ?>
</div>
