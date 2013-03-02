<div class="upload_video_general">
	<div class='row-fluid'> 
		<h2 style="center">Upload Videos</h2>
	</div><!--row-fluid-->
	
		
		<div class="row-fluid">
			<div class="span12">
				
					<?php $attributes = array('id' => 'video_upload', 'class' => "form-horizontal");
						echo form_open_multipart('company/company_company/video_transport', $attributes);?>
						<div class="control-group ">
						 	<label class="control-label">choose your media</label>
							<div class="controls upload_button">
								<span class="btn btn-success btn-wrap">
								 	<i class="icon-arrow-up"></i>
								 	<span>select a local video to upload</span>
								 	<input id="video_upload" type="file" name="userfile" class="btn-input" style="width:100%;">
								</span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">progress</label>
							<div class="controls">
								<div class="progress" style="width:500px; margin-top:5px"> 
								    <span class="bar"></span><span class="percent">0%</span > 
								</div>
							</div>
						</div>
					<?php echo form_close();?>		

				<div class="video_info_setting">
					
				</div>
			</div>
		</div>
</div>