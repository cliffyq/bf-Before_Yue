
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($video) ) {
    $video = (array)$video;
}
$id = isset($video['id']) ? $video['id'] : '';
?>
<div class="admin-box">
    <h3>Video</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('video_title') ? 'error' : ''; ?>">
            <?php echo form_label('title'. lang('bf_form_label_required'), 'video_title', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_title" type="text" name="video_title" maxlength="50" value="<?php echo set_value('video_title', isset($video['video_title']) ? $video['video_title'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_title'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('video_company_id') ? 'error' : ''; ?>">
            <?php echo form_label('company_id'. lang('bf_form_label_required'), 'video_company_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_company_id" type="text" name="video_company_id" maxlength="6" value="<?php echo set_value('video_company_id', isset($video['video_company_id']) ? $video['video_company_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_company_id'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('video_description') ? 'error' : ''; ?>">
            <?php echo form_label('description', 'video_description', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_description" type="text" name="video_description" maxlength="140" value="<?php echo set_value('video_description', isset($video['video_description']) ? $video['video_description'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_description'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('video_length') ? 'error' : ''; ?>">
            <?php echo form_label('length', 'video_length', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_length" type="text" name="video_length" maxlength="4" value="<?php echo set_value('video_length', isset($video['video_length']) ? $video['video_length'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_length'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('video_path') ? 'error' : ''; ?>">
            <?php echo form_label('path', 'video_path', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_path" type="text" name="video_path" maxlength="255" value="<?php echo set_value('video_path', isset($video['video_path']) ? $video['video_path'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_path'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create Video" />
            or <?php echo anchor(SITE_AREA .'/developer/video', lang('video_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
