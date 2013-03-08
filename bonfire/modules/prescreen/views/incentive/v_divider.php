
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($incentive) ) {
    $incentive = (array)$incentive;
}
$id = isset($incentive['id']) ? $incentive['id'] : '';
?>
<div class="admin-box">
    <h2>Upload New Incentive</h2>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

 <fieldset>
   
        <div class="control-group hidden <?php echo form_error('incentive_company_id') ? 'error' : ''; ?>">
            <?php echo form_label('company_id', 'incentive_company_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="incentive_company_id" type="text" name="incentive_company_id" maxlength="11" value="<?php echo set_value('incentive_company_id', isset($incentive['incentive_company_id']) ? $incentive['incentive_company_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('incentive_company_id'); ?></span>
        </div>
        

        </div>
        
        <div class="row-fluid">
        <div class=span4>
        </div><!-- span4 -->
        <div class=span8>
         <div class="trying"  style="border-left: 1px solid #333;">
    
         <div class="control-group"  style="margin-left: 20px;<?php echo form_error('incentive_name') ? 'error' : ''; ?>">
            <?php echo form_label('Name', 'incentive_name' ); ?>
            <div >
        <input id="incentive_name" type="text" name="incentive_name" maxlength="25" value="<?php echo set_value('incentive_name', isset($incentive['incentive_name']) ? $incentive['incentive_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('incentive_name'); ?></span>
        </div>


        </div>

    
        </div><!-- trying -->
        
       
        </div><!-- span8 -->
        </div><!-- row -->
        
         <div class="row-fluid">
        <div class=span4>
        <p>Enter incentive information</p>
        </div><!-- span4 -->
        <div class=span8>
           <div class="trying"  style="border-left: 1px solid #333;">
    
         <div class="control-group"  style="margin-left: 20px;<?php echo form_error('incentive_description') ? 'error' : ''; ?>">
            <?php echo form_label('Description', 'incentive_description' ); ?>
            <div >
        <textarea id="incentive_description" type="text" name="incentive_description" maxlength="140" value="<?php echo set_value('incentive_description', isset($incentive['incentive_description']) ? $incentive['incentive_description'] : ''); ?>"> </textarea>
        <span class="help-inline"><?php echo form_error('incentive_description'); ?></span>
        </div>


        </div>
        </div><!-- span8 -->
        </div><!-- row -->
        
         <div class="row-fluid">
        <div class=span4>
        </div><!-- span4 -->
        <div class=span8>
         <div class="trying"  style="border-left: 1px solid #333;">
    
         <div class="control-group"  style="margin-left: 20px;<?php echo form_error('incentive_category_id') ? 'error' : ''; ?>">
            <?php echo form_label('Category', 'incentive_category_id' ); ?>
            <div >
        <textarea id="incentive_category_id" type="text" name="incentive_category_id" maxlength="11" value="<?php echo set_value('incentive_category_id', isset($incentive['incentive_category_id']) ? $incentive['incentive_category_id'] : ''); ?>"></textarea>
        <span class="help-inline"><?php echo form_error('incentive_category_id'); ?></span>
        </div>


        </div>
        </div><!-- trying -->
       
        </div><!-- span8 -->
        </div><!-- row -->
        
         <div class="row-fluid">
        <div class=span4>
           <p>Enter incentive pricing</p>
        </div><!-- span4 -->
        <div class=span8>
        
         <div class="trying"  style="border-left: 1px solid #333;">
    
         <div class="control-group"  style="margin-left: 20px; <?php echo form_error('incentive_price') ? 'error' : ''; ?>">
            <?php echo form_label('Incentive Price', 'incentive_price' ); ?>
            <div >
        <input id="incentive_price" type="text" name="incentive_price" maxlength="11" value="<?php echo set_value('incentive_price', isset($incentive['incentive_price']) ? $incentive['incentive_price'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('incentive_price'); ?></span>
        </div>


        </div>
        </div><!-- trying -->
        </div><!-- span8 -->
        </div><!-- row -->
        
       
     
        
      
       


        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Save and Make Available " />
           
            
        </div>

        </fieldset>


    <?php echo form_close(); ?>


</div><!--admin box  -->
