	<div id="upload">
		<?php
		$attributes = array('id' => 'test_upload');
		echo form_open_multipart('test/test_upload', $attributes);
		//echo form_upload('userfile');
		//echo form_submit('upload', 'Upload');?>
		 <span class="btn btn-success btn-wrap">
		 	<i class="icon-arrow-up"></i>
		 	<span>upload</span>
		 	<input id="video_upload" type="file" name="userfile" class="btn-input" style="width:100%;">
		 </span>
		
		<?php echo form_close();?>		
	</div>
	<div class="progress"> 
	    <span class="bar"></span><span class="percent">0%</span > 
	</div>
	<div class="set_video_info"></div>
