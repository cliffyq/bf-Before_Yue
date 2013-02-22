
<?php if (validation_errors()) : ?>
<div class="alert alert-block alert-error fade in ">
  <a class="close" data-dismiss="alert">&times;</a>
  <h4 class="alert-heading">Please fix the following errors :</h4>
 <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs
if( isset($user_info) ) {
    $user_info = (array)$user_info;
}
$id = isset($user_info['id']) ? $user_info['id'] : '';
?>
<div class="admin-box">
    <h3>User Info</h3>
<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <fieldset>
        <div class="control-group <?php echo form_error('user_info_user_id') ? 'error' : ''; ?>">
            <?php echo form_label('User ID', 'user_info_user_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_user_id" type="text" name="user_info_user_id" maxlength="11" value="<?php echo set_value('user_info_user_id', isset($user_info['user_info_user_id']) ? $user_info['user_info_user_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_user_id'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_first_name') ? 'error' : ''; ?>">
            <?php echo form_label('First Name'. lang('bf_form_label_required'), 'user_info_first_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_first_name" type="text" name="user_info_first_name" maxlength="25" value="<?php echo set_value('user_info_first_name', isset($user_info['user_info_first_name']) ? $user_info['user_info_first_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_first_name'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_last_name') ? 'error' : ''; ?>">
            <?php echo form_label('Last Name'. lang('bf_form_label_required'), 'user_info_last_name', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_last_name" type="text" name="user_info_last_name" maxlength="25" value="<?php echo set_value('user_info_last_name', isset($user_info['user_info_last_name']) ? $user_info['user_info_last_name'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_last_name'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_gender') ? 'error' : ''; ?>">
            <?php echo form_label('Gender'. lang('bf_form_label_required'), 'user_info_gender', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_gender" type="text" name="user_info_gender" maxlength="1" value="<?php echo set_value('user_info_gender', isset($user_info['user_info_gender']) ? $user_info['user_info_gender'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_gender'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_birth_month') ? 'error' : ''; ?>">
            <?php echo form_label('Birth Month', 'user_info_birth_month', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_birth_month" type="text" name="user_info_birth_month" maxlength="2" value="<?php echo set_value('user_info_birth_month', isset($user_info['user_info_birth_month']) ? $user_info['user_info_birth_month'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_birth_month'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_birth_year') ? 'error' : ''; ?>">
            <?php echo form_label('Birth Year', 'user_info_birth_year', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_birth_year" type="text" name="user_info_birth_year" maxlength="4" value="<?php echo set_value('user_info_birth_year', isset($user_info['user_info_birth_year']) ? $user_info['user_info_birth_year'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_birth_year'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_race') ? 'error' : ''; ?>">
            <?php echo form_label('Race', 'user_info_race', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_race" type="text" name="user_info_race" maxlength="30" value="<?php echo set_value('user_info_race', isset($user_info['user_info_race']) ? $user_info['user_info_race'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_race'); ?></span>
        </div>


        </div>
        


        </div>
        <div class="control-group <?php echo form_error('user_info_tutorial_flag') ? 'error' : ''; ?>">
            <?php echo form_label('Tutorial Flag', 'user_info_tutorial_flag', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_tutorial_flag" type="text" name="user_info_tutorial_flag" maxlength="1" value="<?php echo set_value('user_info_tutorial_flag', isset($user_info['user_info_tutorial_flag']) ? $user_info['user_info_tutorial_flag'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_tutorial_flag'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_education') ? 'error' : ''; ?>">
            <?php echo form_label('Education', 'user_info_education', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_education" type="text" name="user_info_education" maxlength="20" value="<?php echo set_value('user_info_education', isset($user_info['user_info_education']) ? $user_info['user_info_education'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_education'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_veteran') ? 'error' : ''; ?>">
            <?php echo form_label('Veteran', 'user_info_veteran', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_veteran" type="text" name="user_info_veteran" maxlength="1" value="<?php echo set_value('user_info_veteran', isset($user_info['user_info_veteran']) ? $user_info['user_info_veteran'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_veteran'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_zipcode') ? 'error' : ''; ?>">
            <?php echo form_label('Zipcode', 'user_info_zipcode', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_zipcode" type="text" name="user_info_zipcode" maxlength="5" value="<?php echo set_value('user_info_zipcode', isset($user_info['user_info_zipcode']) ? $user_info['user_info_zipcode'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_zipcode'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_industry_id') ? 'error' : ''; ?>">
            <?php echo form_label('Industry ID', 'user_info_industry_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_industry_id" type="text" name="user_info_industry_id" maxlength="3" value="<?php echo set_value('user_info_industry_id', isset($user_info['user_info_industry_id']) ? $user_info['user_info_industry_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_industry_id'); ?></span>
        </div>


        </div>
        <div class="control-group <?php echo form_error('user_info_occupation_id') ? 'error' : ''; ?>">
            <?php echo form_label('Occupation ID', 'user_info_occupation_id', array('class' => "control-label") ); ?>
            <div class='controls'>
        <input id="user_info_occupation_id" type="text" name="user_info_occupation_id" maxlength="3" value="<?php echo set_value('user_info_occupation_id', isset($user_info['user_info_occupation_id']) ? $user_info['user_info_occupation_id'] : ''); ?>"  />
        <span class="help-inline"><?php echo form_error('user_info_occupation_id'); ?></span>
        </div>


        </div>



        <div class="form-actions">
            <br/>
            <input type="submit" name="save" class="btn btn-primary" value="Create User Info" />
            or <?php echo anchor(SITE_AREA .'/company/user_info', lang('user_info_cancel'), 'class="btn btn-warning"'); ?>
            
        </div>
    </fieldset>
    <?php echo form_close(); ?>


</div>
