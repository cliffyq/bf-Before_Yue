
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($video_extra_information) ) {
    $video_extra_information = (array)$video_extra_information;
}
$id = isset($video_extra_information['id']) ? $video_extra_information['id'] : '';
?>
<div class="admin-box">
    <h3>video extra information</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('video_extra_information_video_id') ? 'error' : ''; ?>">
            <?php echo form_label('video_id', 'video_extra_information_video_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_extra_information_video_id" type="text" name="video_extra_information_video_id" maxlength="11" value="<?php echo set_value('video_extra_information_video_id', isset($video_extra_information['video_extra_information_video_id']) ? $video_extra_information['video_extra_information_video_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_extra_information_video_id'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('video_extra_information_points') ? 'error' : ''; ?>">
            <?php echo form_label('points', 'video_extra_information_points', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_extra_information_points" type="text" name="video_extra_information_points" maxlength="11" value="<?php echo set_value('video_extra_information_points', isset($video_extra_information['video_extra_information_points']) ? $video_extra_information['video_extra_information_points'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_extra_information_points'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create video extra information" />
            or <?php echo anchor(SITE_AREA .'/developer/video_extra_information', lang('video_extra_information_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
