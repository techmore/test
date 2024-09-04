<?php

$step1 = ($this->session->userdata('pref_hosting_level')) ? $this->session->userdata('pref_hosting_level') : null;
$step2 = ($this->session->userdata('requirements_verified'))? $this->session->userdata('requirements_verified') : null;
$step3 = ($this->session->userdata('database_settings_set'))? $this->session->userdata('database_settings_set') : null;
$step4 = ($this->session->userdata('admin_account_set'))? $this->session->userdata('admin_account_set') : null;
$step5 = ($this->session->userdata('contacts_set'))? $this->session->userdata('contacts_set') : null;
$step6 = ($this->session->userdata('step_finished'))? $this->session->userdata('step_finished') : null;


//echo @$this->session->userdata['database']['hostname'];

?>
    <div id="left-pane" style="width:30%; float:left; display:block;">

        <ul class="task-list">
            <li id="step_hosting_level" class="<?php echo ($step=='hosting_level')? 'active': (is_null($step1)? '':'done'); ?>">
                Choose Hosting Level
            </li>
            <li id="step_verify_requirements" class="<?php echo ($step == 'verify_requirements')? 'active':(is_null($step2)? '':'done'); ?>">
                Verify System Requirements
            </li>
            <li id="step_database_settings" class="<?php echo ($step == 'database_settings')? 'active' : (is_null($step3) ? '' : 'done'); ?>">
                Set Up Database
            </li>
            <li id="step_admin_account" class="<?php echo ($step == 'admin_account')? 'active' : (is_null($step4) ? '' : 'done'); ?>">
                Set Up Super Administrator
            </li>
            <li id="step_contacts" class="<?php echo ($step == 'step_contacts')? 'active' : (is_null($step5) ? '' : 'done'); ?>">
                Identify Program Administrator
            </li>
            <li id="step_finished" class="<?php echo ($step == 'finished')? 'active' : (is_null($step6) ? '' : 'done'); ?>">
                Finalize Installation
            </li>
        </ul>
        <h3>
        <span style="color:red">* &nbsp;</span>
        <span style="color:#59B"><strong>Required Field</strong></span>
        </h3>
    </div><!-- ENd left-pane -->

    <div id="right-pane" style="width:70%; float:left; display:block;">
    <?php
        if($screen=='hosting_level'){
            include('embeds/hosting_level.php');
        }
    elseif($screen == 'verify_requirements'){
        include('embeds/verify_requirements.php');
    }
    elseif($screen=='database_settings'){
        include('embeds/database_settings.php');
    }
    elseif($screen=='admin_account'){
        include('embeds/admin_account.php');
    }
    elseif($screen=='contact_information'){
        include('embeds/contact_information.php');
    }
    elseif($screen=='finished'){
        include('embeds/finished.php');
    }
    ?>

    </div>


    <script type="text/javascript">
        $(document).ready(function(){
            $('#verify_requirements_form').submit(submit_verify_requirements_form);
        });

        $(document).on('submit', '#verify_requirements_form', function(){
            submit_verify_requirements_form();
        });

        $(document).on('submit', '#contacts_form', function(){
            var form_data = {
                contact_name            : $('#contact_name').val(),
                contact_title           : $('#contact_title').val(),
                contact_agency          : $('#contact_agency').val(),
                contact_phone           : $('#contact_phone').val(),
                contact_email           : $('#contact_email').val(),
                ajax                    : '1'
            };

            $.ajax({
                url: "<?php echo base_url('app/install'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {

                    $('#right-pane').html(response);

                    toggleMenu();
                }
            });

            return false;
        });


        $('#hosting_level_form').submit(function() {
            var selectedVal;
            var selectedOption = $("input[type='radio'][name='pref_hosting_level']:checked");
            if (selectedOption.length > 0) {
                selectedVal = selectedOption.val();
            }
            var form_data = {
                pref_hosting_level: selectedVal,
                ajax: '1'
            };

            $.ajax({
                url: "<?php echo base_url('app/install'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {

                    //alert(msg);
                    $('#right-pane').html(response);

                    toggleMenu();

                    $('#verify_requirements_form').submit(submit_verify_requirements_form);

                }
            });

            return false;
        });

        function toggleMenu(){
            var step1 = $('#step_hosting_level').removeClass();
            var step2 = $('#step_verify_requirements').removeClass();
            var step3 = $('#step_database_settings').removeClass();
            var step4 = $('#step_admin_account').removeClass();
            var step5 = $('#step_contacts').removeClass();
            var step6 = $('#step_finished').removeClass();

            var form_data = {
                ajax: '1'
            };

            $.ajax({
                url: "<?php echo base_url('app/getInstallProgress'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {

                   var steps = JSON.parse(response);
                    //alert(steps.current);

                    step1.addClass(steps.step1);
                    step2.addClass(steps.step2);
                    step3.addClass(steps.step3);
                    step4.addClass(steps.step4);
                    step5.addClass(steps.step5);
                    step6.addClass(steps.step6);
                    if(steps.current=="hosting_level")
                        $('#step_hosting_level').addClass('active');
                    if(steps.current=="verify_requirements")
                        $('#step_verify_requirements').addClass('active');
                    if(steps.current=="database_settings")
                        $('#step_database_settings').addClass('active');
                    if(steps.current=="admin_account")
                        $('#step_admin_account').addClass('active');
                    if(steps.current=="step_contacts")
                        $('#step_contacts').addClass('active');
                    if(steps.current=="finished")
                        $('#step_finished').addClass('active');


                }
            });

        }


        function submit_verify_requirements_form() {

            var form_data = {
                ajax: '1'
            };
            $.ajax({
                url: "<?php echo base_url('app/install'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {

                    //alert(msg);
                    $('#right-pane').html(response);

                    toggleMenu();

                    $("#database_settings_form").validate({
                        rules: {
                            database_password: "required",
                            database_password_conf: {
                                equalTo: "#database_password"
                            }
                        },
                        submitHandler: submit_database_settings_form
                    });

                }
            });

            return false;
        }

        function submit_database_settings_form() {
            var selectedDbVal;
            var selectedDbOption = $("input[type='radio'][name='database_type']:checked");
            if (selectedDbOption.length > 0) {
                selectedDbVal = selectedDbOption.val();
            }

            var form_data = {
                database_type           : selectedDbVal,
                host_name               : $('#host_name').val(),
                database_name           : $('#database_name').val(),
                database_username       : $('#database_username').val(),
                database_password       : $('#database_password').val(),
                ajax                    : '1'
            };

            $.ajax({
                url: "<?php echo base_url('app/install'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {

                    //alert(msg);
                    $('#right-pane').html(response);

                    toggleMenu();

                    $("#admin_account_form").validate({
                        rules: {
                            user_password: "required",
                            user_password_conf: {
                                equalTo: "#user_password"
                            }
                        },
                        submitHandler: submit_admin_account_form
                    });

                }
            });

            return false;
        }

        function submit_admin_account_form(){

            // TO use encodeURIComponent() only when we use a concocted string but as for now the formdata ensures
            // that jquery takes care of the encoding
            var form_data = {
                user_name               : $('#user_name').val(),
                user_email              : $('#user_email').val(),
                host_state              : $('#host_state').val(),
                district_name           : $('#district_name').val(),
                user_password           : $('#user_password').val(),
                ajax                    : '1'
            };

            $.ajax({
                url: "<?php echo base_url('app/install'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {

                    //alert(msg);
                    $('#right-pane').html(response);

                    toggleMenu();



                }
            });

            return false;

        }


        /**
         * JQuery form validation
         */
        jQuery.validator.setDefaults({
            //debug: true,
            //success: "valid"
        });

        $("#database_settings_form").validate({
            rules: {
                database_password: "required",
                database_password_conf: {
                    equalTo: "#database_password"
                }
            },
            submitHandler: submit_database_settings_form
        });

        $("#admin_account_form").validate({
            rules: {
                user_password: "required",
                user_password_conf: {
                    equalTo: "#user_password"
                }
            },
            submitHandler: submit_admin_account_form
        });

        $("#contacts_form").validate({
            rules: {
                contact_phone: {
                    phoneUS2: true
                }
            }
        });


    </script>