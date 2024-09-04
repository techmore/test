<?php
echo form_open('app/install', array('class'=>'admin_account_form', 'id'=>'admin_account_form'));
?>
    <h3 class="title">Set Up Super Administrator</h3>
<p>
    This is EOP ASSIST’s overall administrator, who is responsible for setting up the application for other users and for managing the database. As such, the Super Administrator has all management functionality of the application and should be used by IT personnel.
</p>

    <p>
        <label><span class="inputlabel">User ID</span> <span class="required">*</span> </label><br>
        <?php
            $usernameInput = array(
                'name'      =>  'user_name',
                'id'        =>  'user_name',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '3'
            );
        echo form_input($usernameInput);
        ?>
        Please create a user ID that will be used to log in to EOP ASSIST as the Super Administrator.
    </p>
    <p>
        <label><span class="inputlabel">State</span> <span class="required">*</span> </label><br>
        <?php
            $this->load->helper('state');
            echo state_dropdown('state', 'AL', 'host_state');
        ?>
        Select the state.
    </p>
    <p>
        <label><span class="inputlabel"> Password</span> <span class="required">*</span> </label><br>
        <?php
            $userPasswordInput = array(
                'name'      =>  'user_password',
                'id'        =>  'user_password',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '6'
            );
            echo form_password($userPasswordInput);
        ?>
        Please create a password that will be used to log in to EOP ASSIST as the Super Administrator.
    </p>
    <p>
        <label><span class="inputlabel">Confirm Password</span> <span class="required">*</span> </label><br>
        <?php
        $userPasswordConfInput = array(
            'name'      =>  'user_password_conf',
            'id'        =>  'user_password_conf',
            'value'     =>  '',
            'required'  =>  'required',
            'minlength'  =>  '6'
        );
        echo form_password($userPasswordConfInput);
        ?>
        Please confirm the password that will be used to log in to EOP ASSIST as the Super Administrator.
    </p>
    <?php if($this->session->userdata('pref_hosting_level')=='district'): ?>
    <p>
        <label><span class="inputlabel">Institution Name</span> <span class="required">*</span> </label><br>
        <?php
        $districtInput = array(
            'name'      =>  'district_name',
            'id'        =>  'district_name',
            'value'     =>  '',
            'required'  =>  'required',
            'minlength'  =>  '3'
        );
        echo form_input($districtInput);
        ?>
        Please write in your state, territory, region, or agency name.
    </p>
    <?php endif; ?>
    <p>
        <label><span class="inputlabel">Email</span> <span class="required">*</span> </label><br>
        <?php
        $userEmailInput = array(
            'name'      =>  'user_email',
            'id'        =>  'user_email',
            'value'     =>  '',
            'required'  =>  'required',
            'type'      =>  'email'
        );
        echo form_input($userEmailInput);
        ?>
        Please write in your email address.<br /><br/>
        Please share these login credentials with at least two other representatives from your institution.
    </p>
    <p>
        <?php
        $attributes = array(
            'name'  =>  'admin_account_submit',
            'value' =>  'Save and Continue',
            'class' =>  'signin_submit',
            'id'    =>  'admin_account_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
    </p>

<?php
echo form_close();
?>