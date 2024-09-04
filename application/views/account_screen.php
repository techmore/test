<?php
/**
 * Account View
 * This view is responsible for helping users manage or update their account information, users will be able to:
 *  1- Change their email addresses
 *  2- Change their phone or contact information
 *  3- Change their First and Last names
 *  4- Change their passwords
 *  5- Change their usernames
 *
 */
?>
<?php if((null != $this->session->flashdata('error'))): ?>
    <div id="errorDiv">
        <div class="notify notify-red">
            <span class="symbol icon-error"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('error'));?>
        </div>
    </div>

<?php endif; ?>

<?php
if((null != $this->session->flashdata('success'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-green">
            <span class="symbol icon-tick"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('success'));?>
        </div>
    </div>

<?php endif; ?>



<div class="boxed-group left">
    <h2>My Account</h2>
    <div class="boxed-group-inner">
    
        <ul>
            <li><a href="<?php echo base_url(); ?>user/profile" id="profile-link" class="">My Profile</a> </li>
            <li><a href="<?php echo base_url(); ?>user/profile" id="password-link" class="">Change Password</a> </li>
        </ul>
    </div>
</div>
<div class="boxed-group right">
    <h2 id="pane-title">My Profile</h2>
    <div class="boxed-group-inner clearfix" >
        
        <div class="padded-content" id="profile-pane" style="display:none;">
            <?php echo form_open('user/update', array('class'=>'account_form', 'id'=>'account_form')); ?>

            <input type="hidden" name="form_name" id="user_id_update" value="account_form">
            <p>
            <label for="fname">First Name</label>
            <br/>
            <?php
                $inputAttributes = array(
                    'name'      => 'fname',
                    'id'        =>  'fname',
                    'required'  =>  'required',
                    'minlength'  =>  '3',
                    'size'      =>   '55',
                    'value'     =>      $user[0]['first_name']
                );
                echo form_input($inputAttributes);
                ?>
            </p>
            <p>
                <label for="last_name">Last Name</label>
                <br/>
                 <?php
                $inputAttributes = array(
                    'name'      =>  'last_name',
                    'id'        =>  'last_name',
                    'required'  =>  'required',
                    'minlength'  =>  '3',
                    'size'      =>  '55',
                    'value'     =>      $user[0]['last_name']
                );
                echo form_input($inputAttributes);
                ?>
            </p>
            <p>
                <label for="phone">Phone</label>
                <br/>
                 <?php
                $inputAttributes = array(
                    'name'      =>  'phone',
                    'id'        =>  'phone',
                    'size'      =>  '55',
                    'value'     =>    $user[0]['phone']
                );
                echo form_input($inputAttributes);
                ?>
            </p>
            <p>
                <label for="email">Email</label>
                <br/>
                <?php
                    $inputAttributes = array(
                        'name'      =>  'email',
                        'id'        =>  'email',
                        'required'  =>  'required',
                        'minlength' =>  '3',
                        'type'      =>  'email',
                        'size'      =>  '55',
                        'value'     =>  $user[0]['email'],
                        'disabled'  => 'disabled'
                    );
                    echo form_input($inputAttributes);
                ?>
            </p>
            <p>
                <label for="username">User ID</label>
                <br/>
                                <?php
                $inputAttributes = array(
                    'name'      =>  'username',
                    'id'        =>  'username',
                    'required'  =>  'required',
                    'minlength' =>  '2',
                    'size'      =>  '55',
                    'value'     =>  $user[0]['username'],
                    'disabled'  =>  'disabled'
                );
                echo form_input($inputAttributes);
                ?>
            </p>
            <p>
                <label for="userrole">Role</label>
                <br/>
                <?php
                $inputAttributes = array(
                    'name'      =>  'userrole',
                    'id'        =>  'userrole',
                    'required'  =>  'required',
                    'minlength' =>  '2',
                    'size'      =>  '55',
                    'value'     =>  $user[0]['role'],
                    'disabled'  =>  'disabled'
                );
                echo form_input($inputAttributes);
                ?>
            </p>

            <?php if($role['level']==3): ?>
            <p>
                <label for="userdistrict">District</label>
                <br/>
                <input id="userdistrict" type="text" value="<?php echo($user[0]['district']); ?>" disabled="disabled" size= "55" />
            </p>
            <?php endif; ?>

            <?php if($role['level']>3): ?>
            <p>
                <label for="userschool">School</label>
                <br/>
                <input id="userschool" type="text" value="<?php echo($user[0]['school']); ?>" disabled="disabled" size= "55" />
            </p>
            <?php endif; ?>
            <p>
                <?php
                $attributes = array(
                    'name'  =>  'form_submit',
                    'value' =>  'Update Profile',
                    'id'    =>  'form_submit_btn',
                    'style' =>  ''
                );
                ?>
                <?php echo form_submit($attributes); ?>

                <?php
                $attributes = array(
                    'name'  =>  'form_reset',
                    'value' =>  'Cancel',
                    'id'    =>  'form_reset_btn',
                    'style' =>  ''
                );
                ?>
                <?php echo form_reset($attributes); ?>
            </p>
            <?php echo form_close(); ?>
        </div>




        <div class="padded-content" id="password-pane" style="display:none;">
            <?php echo form_open('user/update', array('class'=>'account_form', 'id'=>'pwd_form')); ?>

            <input type="hidden" name="form_name" id="user_id_update_pwd" value="pwd_form">
            <p >
                <label for="user_password_current">Current Password</label>
                <br/>
                <?php
                $userPasswordInput = array(
                    'name'      =>  'user_password_current',
                    'id'        =>  'user_password_current',
                    'value'     =>  '',
                    'required'  =>  'required',
                    'minlength'  =>  '6',
                    'size'      =>  '70'
                );
                echo form_password($userPasswordInput);
                ?>
            </p>
            <br class="clearfix" style="clear:both;"/>
          

            <p>
                <label for="user_password_reset">New Password</label>
                <br/>
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
                <label for="user_password_conf_reset">Confirm Password</label>
                  <br/>
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
            <p>
                <?php
                $attributes = array(
                    'name'  =>  'pwd_form_submit',
                    'value' =>  'Reset Password',
                    'id'    =>  'pwd_form_submit',
                    'style' =>  ''
                );
                ?>
                <?php echo form_submit($attributes); ?>
            </p>

            <?php echo form_close(); ?>
        </div>
        
    </div> 
</div>

<script type="text/javascript">

$(document).ready(function(){

    $("#profile-pane").show();
    $("#profile-link").addClass("current");
    lockControls();

    /*$("#profile-link").on('click', function(){
        $("#profile-pane").show();
        $("#password-pane").hide();

        $("#password-link").removeClass("current");
        $("#profile-link").addClass("current");

        lockControls();

        return false;
    });*/



    $("#password-link").on('click', function(){
        $("#profile-pane").hide();
        $("#password-pane").show();
        $("#pane-title").html("Change Password");

        $("#password-link").addClass("current");
        $("#profile-link").removeClass("current");
        return false;
    });

    $("#form_submit_btn").on("click", function(){

        if($(this).val().toLowerCase()=="update profile"){
            $(this).val("Save Changes");
            unlockControls();
            return false;
        }
        else if($(this).val().toLowerCase()=="save changes"){
            return true;
        }
    });

    $("#form_reset_btn").on("click", function(){

        $("#form_submit_btn").val("Update Profile");
        lockControls();
    });

    function lockControls(){

        $("#fname")     .attr("disabled", "disabled");
        $("#last_name") .attr("disabled", "disabled");
        $("#phone")     .attr("disabled", "disabled");
        $("#email")     .attr("disabled", "disabled");
        $("#username")     .attr("disabled", "disabled");

    }

    function unlockControls(){

        $("#fname")     .removeAttr('disabled');
        $("#last_name") .removeAttr('disabled');
        $("#phone")     .removeAttr("disabled");
        $("#email")     .removeAttr("disabled");
        $("#username")     .removeAttr("disabled");

    }

    $("#account_form").validate({
        rules:{
            phone:{
                    phoneUS2: true
                },
            username:{
                required: true,
                minlength:3,
                remote:{
                    url: "<?php echo(base_url('user/checkusernameUpdate')); ?>",
                    type: "POST",
                    data:{
                        username: function(){
                            var user = $("#username").val();
                            return user;
                        },
                        ajax: '1',
                        id: '<?php echo($user[0]['user_id']); ?>'
                    }

                }
            },
            email:{
                remote:{
                    url: "<?php echo(base_url('user/checkuseremailUpdate')); ?>",
                    type: "POST",
                    data:{
                        email: function(){
                            return $("#email").val();
                        },
                        ajax: '1',
                        id: '<?php echo($user[0]['user_id']); ?>'
                    }

                }
            }
        },
        messages:{
            username:{
                remote: "Username has already been used!"
            },
            email:{
                remote: "Email has already been used!"
            }
        }
    });

    $("#pwd_form").validate({
        rules: {
                user_password_reset: "required",
                user_password_conf_reset: {
                    equalTo: "#user_password_reset"
                }
            }
    });
});
</script>
