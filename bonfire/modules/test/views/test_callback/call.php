<?php $attributes = array('id' => 'call', 'class' => "form-horizontal", 'method' => "POST");
		 echo form_open_multipart('test/test_callback/response/', $attributes)?>
<select name="quesion" id="question">
	<option value="" ></option>
	<option value="haha" >hehe</option>	
	<option value="" <?='selected'?> >wtf</option>
</select>
<br>
<textarea name="question" class="QnA"></textarea><br>
<input name="answer1_1" class="QnA"><br>
<input name="answer1_2" class="QnA"><br>
<input name="answer1_3" class="QnA"><br>
<input name="answer1_4" class="QnA"><br>


<input type="submit" id="my_submit" value="submit">
<?php echo form_close(); ?>

