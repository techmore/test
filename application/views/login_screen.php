
<div id="container">

    <header>

        <h1 class="logotxt">EOP ASSIST <?php echo(VERSION); ?></h1>

    </header>
    <main>
        <fieldset id="signin_menu">

            <p class="logintxttop">Thank you for using the U.S. Department of Education’s and its Readiness and Emergency Management for Schools (REMS) Technical Assistance (TA) Center’s free and Web-accessible software application for public and nonpublic schools to create and update high-quality school emergency operations plans (EOPs). Supporting resources for using EOP ASSIST can be found on the <a href="https://rems.ed.gov" target="_blank" title="REMS TA Center Website">REMS TA Center Website</a>.<br><br>For more information about or to receive technical support using EOP ASSIST, please contact the REMS TA Center at <a href="mailto:info@remstacenter.org" title="info@remstacenter.org">info@remstacenter.org</a> or via our toll-free telephone number, 1-855-781-REMS [7367]. Our hours of operation are Monday through Friday, 9:00 a.m. to 5:00 p.m., Eastern Time.

            </p>

            <?php
                echo form_open('login/validate', array('class'=>'login_form', 'id'=>'login_form'));
            ?>


            <?php if($this->session->flashdata('error')): ?>
                <div class="notify notify-red"><span class="symbol icon-error"></span> &nbsp; <?php echo ($this->session->flashdata('error')); ?> </div>
            <?php endif; ?>
            <br/>

            <div class="fields">
                <p>
                    <!-- user id -->
                <div class="group">
                    <?php
                    $userNameInput = array(
                        'name'      =>  'username',
                        'id'        =>  'username',
                        'value'     =>  '',
                        'required'  =>  'required',
                        'onfocus'   =>  '',
                        'style'     =>  "color:#055eaa",
                        'minlength' =>  '3',
                        'aria-required' => 'true',
                        'aria-invalid'  => 'false',
                        'aria-label'    => 'User ID',
                        'class'         => 'valid'
                    );
                    echo form_input($userNameInput);
                    ?>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label for="username"><i class="material-icons person">person</i> User ID *</label>
                </div>
                <!-- ./user id -->
                </p>
                <p>

                    <!-- password -->
                <div class="group">
                    <?php
                    $userPasswordInput = array(
                        'name'      =>  'password',
                        'id'        =>  'password',
                        'value'     =>  '',
                        'required'  =>  'required',
                        'minlength' =>  '6',
                        'onfocus'   =>  '',
                        'style'     =>  "color:#055eaa",
                        'aria-required' => 'true',
                        'aria-invalid'  => 'false',
                        'class'         => 'valid'
                    );
                    echo form_password($userPasswordInput);
                    ?>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label for="password"><i class='material-icons lock'>lock</i> Password *</label>
                </div>

                <!-- ./password -->
                <!--<div style="float:right;">p strength</div>-->
                </p>

                <p>
                    <button class="login_buttons" type="submit" name="submit" value="Sign in"> Sign in </button>
                    <button class="login_buttons" type="reset" name="reset"  value="Clear" style="width:111px;"> Clear </button>
                </p>

                <!-- Changed because they were not tabbable -->
                <!--<p class="remember">
                    <input class="signin_submit" name="submit" value="Sign in" role="button"     type="submit">
                    <input class="signin_submit" name="reset" value="Clear"    role="button"     type="reset">
                </p>
                -->
            </div>



            <div class="contactme">
                <div class="ptop"><p>Forgot User ID and/or Password? Please contact your Administrator:</p></div>
                <div class="pleft">
                    <p><?php echo($program_administrator['contact_name']); ?> </p>
                    <p><?php echo($program_administrator['contact_title']); ?> </p>
                    <p><?php echo($program_administrator['contact_agency']); ?></p>
                    <p><?php echo(phone_number_format($program_administrator['contact_phone'])); ?> </p>
                    <p><?php echo($program_administrator['contact_email']); ?> </p>
                </div>
            </div>
                <div id="extraContent"></div>

                <!--  <p class="forgot"><a href="#" id="forgotUserIdLink">Forgot your User ID?</a> | <a href="#" id="forgotPasswordLink" >Forgot your password?</a> |-->
                <!--<a href="#" id="signupLink">Sign up</a>-->
                <div id="forgotPasswordDiv"></div>

                <!--<p style="color:#59B;font-weight: bolder"><font color="red">*</font> Required Field</p>-->

                <div id="requestNewAccessDiv"></div>
            <?php echo form_close(); ?>

            <div class="logintxtbtm">
            <p>The U.S. Department of Education contracted for final products and deliverables that were developed under the GS-00F-115CA contract with Synergy Enterprises, Inc., and the contract stipulates that the U.S. Department of Education is the sole owner of EOP ASSIST.</p><p>
                EOP ASSIST is being made available to the public pursuant to the following conditions.   The U.S. Department of Education is making the software available to the public and grants the public the worldwide, non-exclusive, royalty-free right to use and distribute the software created pursuant to the GS-00F-115CA contract, for only non-commercial and educational purposes.  This license does not include the right to modify the code of the software tool or create derivative works therefrom.  If you have any questions regarding whether a proposed use is allowable under this license, or want to request a particular use, please contact the REMS TA Center at 1-855-781-REMS [7367] or <a href="mailto:info@remstacenter.org"> info@remstacenter.org</a>.</p><p>
                THE U.S. DEPARTMENT OF EDUCATION IS PROVIDING THE SOFTWARE AS IT IS, AND MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND CONCERNING THE WORK—EXPRESS, IMPLIED, STATUTORY OR OTHERWISE, INCLUDING WITHOUT LIMITATION WARRANTIES OF TITLE, MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, OR THE PRESENCE OR ABSENCE OF LATENT OR OTHER DEFECTS, ACCURACY, OR THE PRESENCE OR ABSENCE OF ERRORS, WHETHER OR NOT DISCOVERABLE, ALL TO THE GREATEST EXTENT PERMISSIBLE UNDER FEDERAL LAW.
            </p>
                <section class="logos">
                    <a href="http://www.ed.gov/" target="_blank" title="Department of Education"><img class="DOEDlogo" alt="Logo of the Department of Education" src="<?php echo base_url(); ?>assets/img/DOElogo.png"></a>
                    <a href="http://rems.ed.gov/" target="_blank" title="Readiness and Emergency Management for Schools"><img alt="Logo of the Readiness and Emergency Management for Schools" class="REMSlogo" src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png"></a>
                </section>


        </fieldset>
    </main>

    <footer>
        <p class="DOEcr"><?php echo(date('Y')); ?> &copy; U.S. Department of Education</p>
    </footer>
</div>
