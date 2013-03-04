<div class="upload_video_general">
	<div class='row-fluid'> 
		<h2 style="">Upload Videos</h2>
	</div>
	<!--row-fluid-->
	
		
		<div class="row-fluid">
			<div class="span12">
				
					<?php $attributes = array('id' => 'video_upload', 'class' => "form-horizontal");
						echo form_open_multipart('company/company_company/video_transport', $attributes);?>
						<div class="control-group video_choosing">
						 	<label class="control-label ">choose your media</label>
							<div class="controls upload_button">
					<span class="btn btn-success btn-wrap"> <i class="icon-arrow-up"></i>
						<span>select a local video to upload</span> <input
						id="video_upload" type="file" name="userfile" class="btn-input"
						style="width: 100%;">
								</span>
								<p>Types allowed: mp4, ogv, webm, wma, avi.</p>
							</div>
						</div>
						
						<div class="control-group progress_bar hidden">
							<label class="control-label">uploading progress</label>
							<div class="controls">
								<div class="progress" style="width:500px; margin-top:5px"> 
								    <span class="bar"></span><span class="percent">0%</span > 
								</div>
							</div>
						</div>
					<?php echo form_close();?>		

				<div class="video_info_setting">
					<div class="loading_div hidden">
						<img class="status_img span1" src="<?php echo site_url('bonfire/themes/two column/images/ajax-loader').'.gif'?>" style="width: 32px; text-align: center; margin-bottom: 10px;">
						<h6 style="padding-top: 15px">loading...</h6>
					</div>
				</div>
			</div>
		</div>
</div>
