<h2>Edit Company Infomation</h2>
<?php $attributes = array('id' => 'edit_company_info', 'class' => "form-horizontal offset1");
						echo form_open_multipart('company/company_company/edit_company_info', $attributes);?>
						<div class="control-group video_choosing">
						 	<label class="control-label ">company name</label>
							<div class="controls">
								<input type="text" name="company_name" value="<?=$company_info->company_name?>"/>
							</div>
						</div>
						
						<div class="control-group video_choosing">
						 	<label class="control-label ">company logo</label>
							<div class="controls">
								<div style="width:200px">
									<img id="company_logo_image" src="<?php echo $company_info->company_logo?>" alt="your image" />
								</div>
								<br>
								<div>
									<span class='btn btn-wrap btn-info' >
										<span>change logo</span>
										<input id="company_logo" type="file" name="company_logo" class="btn-input" style='width:100%'/>  	 
									</span> 
								</div>	
							</div>
						</div>
						
						<div class="control-group video_choosing">
						 	<label class="control-label ">company url</label>
							<div class="controls">
								<input type="text" name="company_url" value="<?=$company_info->company_url?>"/>
							</div>
						</div>
						
						<div class="control-group video_choosing">
						 	<label class="control-label ">company description</label>
							<div class="controls">
								<input type="text" name="company_description" value="<?=$company_info->company_description?>"/>
							</div>
						</div>
						
						<div class="control-group video_choosing">
						 	<label class="control-label ">company industry</label>
							<div class="controls">
								<select name="company_industry_id">
									<?php foreach ($industry_records as $index => $industry_record) :?>
									<option 
										<?php 
											if ($index == $company_info->company_industry_id)
												echo "selected";
										?> value=<?=$index?>>
										<?=$industry_record->industry_industry_name?>
									</option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						
					<div class="controls">
						<?php 
						$submit = array('class' => 'btn btn-primary', 'value' => 'save changes', 'name' => 'save');
						echo form_submit($submit) ?>
					</div>
					<?php echo form_close();?>	
