
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</label>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($incentive) ) {
    $incentive = (array)$incentive;
}
$id = isset($incentive['id']) ? $incentive['id'] : '';
?>
<div class="create_incentive_form">
    <h2 >Upload New Incentive</h2>
<?php echo form_open_multipart($this->uri->uri_string(), array('id'=>'incentive_form','class'=>"form-horizontal")); ?>

 <fieldset>
   
        
        <div class="row-fluid">
        <div class=span4>
        </div><!-- span4 -->
        <div class=span8>
         <div class="incentive_rightpart">
    
         <div class="incentive_control_group"  ;<?php echo form_error('incentive_name') ? 'error' : ''; ?>">
            <?php echo form_label('Name', 'incentive_name' ); ?>
        <div >
        <input id="incentive_name" type="text" name="incentive_name" maxlength="25" value="<?php echo set_value('incentive_name', isset($incentive['incentive_name']) ? $incentive['incentive_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('incentive_name'); ?></span>
        </div>
        </div>

    
        </div><!-- right -->
        
       
        </div><!-- span8 -->
        </div><!-- row -->
        
         <div class="row-fluid">
        <div class=span4>
        <div class='incentive_leftpart'>
        <label>Enter incentive information</label>
        </div><!-- left -->
        </div><!-- span4 -->
        <div class=span8>
           <div class="incentive_rightpart"  >
    
         <div class="incentive_control_group"  <?php echo form_error('incentive_description') ? 'error' : ''; ?>">
            <?php echo form_label('Description', 'incentive_description' ); ?>
            <div >
        <textarea id="incentive_description" type="text" name="incentive_description" maxlength="140" value="<?php echo set_value('incentive_description', isset($incentive['incentive_description']) ? $incentive['incentive_description'] : ''); ?>"> </textarea>
        <span class="help-inline"><?php echo form_error('incentive_description'); ?></span>
        </div>


        </div><!-- incentive_control_group -->
        </div><!-- right -->
        </div><!-- span8 -->
        </div><!-- row -->
        
         <div class="row-fluid">
        <div class=span4>
        </div><!-- span4 -->
        <div class=span8>
         <div class="incentive_rightpart" >
    
         <div class="incentive_control_group" <?php echo form_error('incentive_category_id') ? 'error' : ''; ?>">
            <?php echo form_label('Category', 'incentive_category_id' ); ?>
            <div >
        <textarea id="incentive_category_id" type="text" name="incentive_category_id" maxlength="11" value="<?php echo set_value('incentive_category_id', isset($incentive['incentive_category_id']) ? $incentive['incentive_category_id'] : ''); ?>"></textarea>
        <span class="help-inline"><?php echo form_error('incentive_category_id'); ?></span>
        </div>


        </div>
        </div><!-- rightpart -->
       
        </div><!-- span8 -->
        </div><!-- row -->
        
        
          <div class="row-fluid">
        <div class=span4>
        <div class='incentive_leftpart' >
       	<div class="incentive_upload">
        <span class='btn btn-wrap btn-info' >
        	<span>Incentive Image</span>
        	<input id="incentive_image" type="file" name="incentive_image" class="btn-input" style='width:100%'/>  	 
        </span> 
        <label> Click here to Upload </label>      
        </div>  
         </div><!-- left -->  
        </div><!-- span4 -->
        <div class=span8>
         <div class="incentive_rightpart"  >
    
         <div class="incentive_control_group"  <?php echo form_error('incentive_category_id') ? 'error' : ''; ?>">
            <?php echo form_label('Image', 'incentive_category_id' ); ?>
        <div class='incentive_preview_image'>
       	<img id="incentive_preview_image" src="" alt="your image" />
        <span class="help-inline"><?php echo form_error('incentive_category_id'); ?></span>
        </div>


        </div>
        </div><!-- rightpart -->
       
        </div><!-- span8 -->
        </div><!-- row -->
        
        <div class="row-fluid">
        	<div class=span4>
        		<div class='incentive_leftpart'>
           			<label>Enter incentive pricing</label>
        		</div><!-- left -->
        	</div><!-- span4 -->
        
        	<div class=span8>
        
         		<div class="incentive_rightpart"  >
    
         			<div class="incentive_control_group"  <?php echo form_error('incentive_price') ? 'error' : ''; ?>">
            				<?php echo form_label('Incentive Price', 'incentive_price' ); ?>
            			<div >
        					<input id="incentive_price" type="text" name="incentive_price" maxlength="11" value="<?php echo set_value('incentive_price', isset($incentive['incentive_price']) ? $incentive['incentive_price'] : ''); ?>"  />
        					<span class="help-inline"><?php echo form_error('incentive_price'); ?></span>
        				</div>
        			</div>
        		</div><!-- incentive_rightpart -->
        	</div><!-- span8 -->
        </div><!-- row -->
        
        <div class="form-actions">
            
            <input type="submit" name="save" class="btn btn-primary" value="Save and Make Available " />
           
            
        </div>

        </fieldset>


    <?php echo form_close(); ?>


</div><!--admin box  -->
