
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($company) ) {
    $company = (array)$company;
}
$id = isset($company['id']) ? $company['id'] : '';
?>
<div class="admin-box">
    <h3>Company</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('company_name') ? 'error' : ''; ?>">
            <?php echo form_label('Company Name', 'company_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="company_name" type="text" name="company_name" maxlength="100" value="<?php echo set_value('company_name', isset($company['company_name']) ? $company['company_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('company_name'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('company_logo') ? 'error' : ''; ?>">
            <?php echo form_label('Company logo', 'company_logo', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="company_logo" type="text" name="company_logo" maxlength="255" value="<?php echo set_value('company_logo', isset($company['company_logo']) ? $company['company_logo'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('company_logo'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('company_url') ? 'error' : ''; ?>">
            <?php echo form_label('Company url', 'company_url', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="company_url" type="text" name="company_url" maxlength="255" value="<?php echo set_value('company_url', isset($company['company_url']) ? $company['company_url'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('company_url'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('company_industry_id') ? 'error' : ''; ?>">
            <?php echo form_label('Industry ID', 'company_industry_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="company_industry_id" type="text" name="company_industry_id" maxlength="3" value="<?php echo set_value('company_industry_id', isset($company['company_industry_id']) ? $company['company_industry_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('company_industry_id'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('company_description') ? 'error' : ''; ?>">
            <?php echo form_label('Company description', 'company_description', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="company_description" type="text" name="company_description" maxlength="1000" value="<?php echo set_value('company_description', isset($company['company_description']) ? $company['company_description'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('company_description'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Edit Company" />
            or <?php echo anchor(SITE_AREA .'/developer/company', lang('company_cancel'), 'class="btn btn-warning"'); ?>
            

    <?php if ($this->auth->has_permission('Company.Developer.Delete')) : ?>

            or <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php echo lang('company_delete_confirm'); ?>')">
            <i class="icon-trash icon-white">&nbsp;</i>&nbsp;<?php echo lang('company_delete_record'); ?>
            </button>

    <?php endif; ?>


        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
