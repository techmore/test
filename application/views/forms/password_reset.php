<?php
/**
 * Password Reset form
 */

echo form_open('user/resetpwd', array('class'=>'pwd_form', 'id'=>'pwd_form'));
?>
<fieldset>
    <input type="hidden" id="user_id_reset" value="" name="user_id_reset" />
   <!-- <legend>Account Information</legend>-->
    <p>
        <label>First Name:</label><span id="first_name"></span>
    </p>
    <p>
        <label>Last Name:</label><span id="last_name"></span>
    </p>
    <p>
        <label>User ID:</label><span id="user_name"></span>
    </p>

    <p>
        <label><span class="required">*</span> Enter New Password:</label>
         <?php
        $userPasswordInput = array(
            'name'      =>  'user_password_reset',
            'id'        =>  'user_password_reset',
            'value'     =>  '',
            'required'  =>  'required',
            'minlength'  =>  '6',
            'size'      =>  '40'
        );
        echo form_password($userPasswordInput);
        ?>
    </p>
    <p>
        <label><span class="required">*</span> Confirm Password: &nbsp;&nbsp;&nbsp;</label>
         <?php
            $userPasswordInput = array(
                'name'      =>  'user_password_conf_reset',
                'id'        =>  'user_password_conf_reset',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '6',
                'size'      =>  '40'
            );
            echo form_password($userPasswordInput);
        ?>
    </p>
</fieldset>
            <?php
/*            $attributes = array(
                'name'  =>  'reset_pwd',
                'value' =>  'Reset Password',
                'id'    =>  'reset_pwd',
                'style' =>  ''
            );
            */?><!--
            --><?php /*echo form_submit($attributes); */?>

<?php
echo form_close();
?>