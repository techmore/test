<?php
echo form_open('app/install', array('class'=>'contacts_form', 'id'=>'contacts_form'));
?>
    <h3 class="title">Identify Program Administrator</h3>
<p>
    This person will be responsible for resetting passwords for all users who access this installed version of EOP ASSIST and his/her contact information below will appear on the Login page. This person should have management capabilities and be a representative of the agency that has installed the software application. This person can, but does not have to, be different than the Super Administrator.
</p>

    <p>
        <label><span class="inputlabel">Name</span> <span class="required">*</span> </label><br>
        <?php
            $usernameInput = array(
                'name'      =>  'contact_name',
                'id'        =>  'contact_name',
                'value'     =>  '',
                'required'  =>  'required',
                'minlength'  =>  '3'
            );
        echo form_input($usernameInput);
        ?>
        Please write in the name of the assigned Program Administrator.
    </p>

    <p>
        <label><span class="inputlabel">Title</span> <span class="required">*</span> </label><br>
        <?php
        $usernameInput = array(
            'name'      =>  'contact_title',
            'id'        =>  'contact_title',
            'value'     =>  '',
            'required'  =>  'required',
            'minlength'  =>  '3'
        );
        echo form_input($usernameInput);
        ?>
        Please write in the title of the assigned Program Administrator.
    </p>

    <p>
        <label><span class="inputlabel">Agency</span> <span class="required">*</span> </label><br>
        <?php
        $usernameInput = array(
            'name'      =>  'contact_agency',
            'id'        =>  'contact_agency',
            'value'     =>  '',
            'required'  =>  'required',
            'minlength'  =>  '3'
        );
        echo form_input($usernameInput);
        ?>
        Please write in the state, territory, region, school district, school, or institution name of the assigned Program Administrator.
    </p>
    <p>
        <label><span class="inputlabel">Phone Number</span> <span class="required">*</span> </label><br>
        <?php
        $usernameInput = array(
            'name'      =>  'contact_phone',
            'id'        =>  'contact_phone',
            'value'     =>  '',
            'required'  =>  'required',
            'minlength'  =>  '3'
        );
        echo form_input($usernameInput);
        ?>
        Please write in the phone number of the assigned Program Administrator.
    </p>

    <p>
        <label><span class="inputlabel">Email Address</span> <span class="required">*</span> </label><br>
        <?php
        $userEmailInput = array(
            'name'      =>  'contact_email',
            'id'        =>  'contact_email',
            'value'     =>  '',
            'required'  =>  'required',
            'type'      =>  'email'
        );
        echo form_input($userEmailInput);
        ?>
        Please write in the email address of the assigned Program Administrator.
    </p>

    <p>
        Please ensure that the assigned Program Administrator is aware of his/her responsibilities and has access to the EOP ASSIST User Manual.
    </p>
    <p>
        <?php
        $attributes = array(
            'name'  =>  'contact_submit',
            'value' =>  'Save and Continue',
            'class' =>  'signin_submit',
            'id'    =>  'contact_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
    </p>

<?php
echo form_close();
?>