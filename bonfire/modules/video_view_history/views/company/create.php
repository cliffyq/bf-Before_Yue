
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($video_view_history) ) {
    $video_view_history = (array)$video_view_history;
}
$id = isset($video_view_history['id']) ? $video_view_history['id'] : '';
?>
<div class="admin-box">
    <h3>video view history</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('video_view_history_video_id') ? 'error' : ''; ?>">
            <?php echo form_label('video_id', 'video_view_history_video_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_view_history_video_id" type="text" name="video_view_history_video_id" maxlength="11" value="<?php echo set_value('video_view_history_video_id', isset($video_view_history['video_view_history_video_id']) ? $video_view_history['video_view_history_video_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_view_history_video_id'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('video_view_history_user_id') ? 'error' : ''; ?>">
            <?php echo form_label('user_id', 'video_view_history_user_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_view_history_user_id" type="text" name="video_view_history_user_id" maxlength="20" value="<?php echo set_value('video_view_history_user_id', isset($video_view_history['video_view_history_user_id']) ? $video_view_history['video_view_history_user_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_view_history_user_id'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('video_view_history_ip') ? 'error' : ''; ?>">
            <?php echo form_label('ip', 'video_view_history_ip', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_view_history_ip" type="text" name="video_view_history_ip" maxlength="15" value="<?php echo set_value('video_view_history_ip', isset($video_view_history['video_view_history_ip']) ? $video_view_history['video_view_history_ip'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_view_history_ip'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('video_view_history_created_on') ? 'error' : ''; ?>">
            <?php echo form_label('created_on', 'video_view_history_created_on', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="video_view_history_created_on" type="text" name="video_view_history_created_on"  value="<?php echo set_value('video_view_history_created_on', isset($video_view_history['video_view_history_created_on']) ? $video_view_history['video_view_history_created_on'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('video_view_history_created_on'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create video view history" />
            or <?php echo anchor(SITE_AREA .'/company/video_view_history', lang('video_view_history_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
