<div class="container-fluid upload_video_general main_content" >
	<div class='row-fluid chart_title_general'> 
		<h2 style="center">Upload Videos</h2>
	</div><!--row-fluid-->
	
	<div class='chart_body_general'>
		
		<div class="row-fluid">
			<div class="span12">
				<?php echo form_open_multipart('register', array('class' => "form-horizontal offset1", 'autocomplete' => 'off')); ?>
					<div class="video_basic_info">
						<div class="control-group">
							<label class="control-label required" name = "">Company Name:</label>
							<div class="controls">
								<label><?= $user_company_info['user_company_name']?></label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label required">Your media is saved in:</label>
							<div class="controls">
								<p><?= $user_company_info['video_path'] ?></p>
								
							</div>
							
						</div>
					</div>
					<div class="video_set_info">
						<div class="control-group">
							<label class="control-label required" for="email">Select media thumbnail:</label>
							<div class="controls">
							
							</div>
						</div>
						<div class="control-group">
							<label class="control-label required" for="email">Enter media information:</label>
							<div class="controls">
								<label>Title:</label>
								<input class="video_upload_title span6" type="text"></input>
								<label>Descripstion:</label>
								<textarea class="video_upload_information span6" type="text"></textarea> 
								<label>Tags:</label>
								<input class="video_upload_title span6" type="text"></input>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label required" for="email">Save your media:</label>
							<div class="controls">
								<button class="btn btn-primary">Save</button>
								<button class="btn ">Cancel</button>
							</div>
						</div>
					</div>
					
					
				<?php echo form_close(); ?>	
			</div>
		</div>
	</div>	
</div>