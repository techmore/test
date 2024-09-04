<?php
/**
 *  Left and Right Sidebars embedded on all the pages
 */
?>
<?php
$idVal = null;
?>
<div class="sb-slidebar sb-left sb-style-push">
    <div id="close_slide">
        <ul class="ximg">
            <li class="sb-close"><img src="<?php echo base_url(); ?>assets/img/close.png" close="sb-close" class="closeimg" /></li>
        </ul>
    </div>
    <div id="slidecontent">


        <h3 class="clicker" id="gettingStartedMenuLink">Getting Started</h3>
        <ul class="reveal">
            <li  class="reveal"><a href="<?php echo base_url(); ?>home/step/1">Before Using EOP ASSIST</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>home/step/2">How Teams Can Use EOP ASSIST</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>home/step/3">Introduction to the Planning Process</a></li>
        </ul>


        <h3 class="clicker" id="stepOneMenuLink">Step 1</h3>
        <ul class="reveal">
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step1" id="step1_1MenuLink">Overview of Step 1: Form a Collaborative Planning Team</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step1/2" id="step1_2MenuLink">Identify a Core Planning Team</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step1/3" id="step1_3MenuLink">Form a Common Framework and Define and Assign Roles and Responsibilities</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step1/4" id="step1_4MenuLink">Determine a Regular Schedule of Meetings</a></li>
        </ul>
        <h3 class="clicker" id="stepTwoMenuLink">Step 2</h3>
        <ul class="reveal">
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step2" id="step2_1MenuLink">Overview of Step 2: Understand the Situation</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step2/2" id="step2_3MenuLink">Develop a Comprehensive List of Possible Threats and Hazards Using a Variety of Data Sources</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step2/3" id="step2_4MenuLink">Evaluate Risks and Vulnerabilities of Threats and Hazards and Then Prioritize</a></li>
        </ul>
        <h3 class="clicker" id="stepThreeMenuLink">Step 3</h3>
        <ul class="reveal">
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step3" id="step3_1MenuLink">Overview of Step 3: Determine Goals and Objectives</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step3/2" id="setp3_2MenuLink">Select Threats and Hazards to Address in the School EOP</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step3/3" id="step3_3MenuLink">Develop Goals and Objectives for Threats and Hazards</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step3/4" id="step3_4MenuLink">Develop Goals and Objectives for Functions</a></li>
        </ul>
        <h3 class="clicker" id="stepFourMenuLink">Step 4</h3>
        <ul class="reveal">
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step4" id="step4_1MenuLink">Overview of Step 4: Plan Development (Identify Courses of Action)</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step4/2" id="setp4_2MenuLink">Use Scenario-Based Planning</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step4/3" id="step4_3MenuLink">Develop Courses of Action for Threats and Hazards</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step4/4" id="step4_4MenuLink">Develop Courses of Action for Functions</a></li>
        </ul>
        <h3 class="clicker" id="stepFiveMenuLink">Step 5</h3>
        <ul class="reveal">
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step5" id="step5_1MenuLink">Overview of Step 5: Plan Preparation, Review, and Approval</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step5/2" id="step5_2MenuLink">Prepare the Draft EOP: Threat- and Hazard-Specific Annexes</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step5/3" id="step5_3MenuLink">Prepare the Draft EOP: Functional Annexes</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step5/4" id="step5_4MenuLink">Prepare the Draft EOP: Basic Plan</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step5/5" id="step5_5MenuLink">Review, Approve, and Share the Plan</a></li>
        </ul>
        <h3 class="clicker" id="stepSixMenuLink">Step 6</h3>
        <ul class="reveal">
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step6" id="step6_1MenuLink">Overview of Step 6: Plan Implementation and Maintenance</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step6/2" id="step6_2MenuLink">Train Stakeholders on the Plan</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step6/3" id="step6_3MenuLink">Exercise the Plan</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step6/4" id="step6_4MenuLink">Review, Revise, and Maintain the Plan</a></li>
            <li  class="reveal"><a href="<?php echo base_url(); ?>plan/step6/5" id="step6_5MenuLink">Thank You for Using EOP ASSIST</a></li>
        </ul>
    </div>
    <div class="savequit">
        <ul class="sq">
        </ul>
    </div>
</div>



<div class="sb-slidebar sb-right sb-style-push">
    <div id="close_slide2">
        <ul class="ximgl">
            <li class="sb-close"><img src="<?php echo base_url(); ?>assets/img/close.png" close="sb-close" class="closeimg" /></li>
        </ul>
    </div>

    <div class="rthead">
        <h3 class="rtheading">Resource Toolkit</h3>
    </div>
    <div id="slidecontent2" style="display: none">
       
        <?php require 'toolkit/toolkit_home_1.php';?>
        <?php require 'toolkit/toolkit_home_2.php';?>
        <?php require 'toolkit/toolkit_home_3.php';?>
        <?php require 'toolkit/toolkit_step1_1.php';?>
        <?php require 'toolkit/toolkit_step1_2.php';?>
        <?php require 'toolkit/toolkit_step1_3.php';?>
        <?php require 'toolkit/toolkit_step1_4.php';?>
        <?php require 'toolkit/toolkit_step2_1.php';?>
        <?php require 'toolkit/toolkit_step2_2.php';?>
        <?php require 'toolkit/toolkit_step2_3.php';?>
        <?php require 'toolkit/toolkit_step2_4.php';?>
        <?php require 'toolkit/toolkit_step3_1.php';?>
        <?php require 'toolkit/toolkit_step3_2.php';?>
        <?php require 'toolkit/toolkit_step3_3.php';?>
        <?php require 'toolkit/toolkit_step3_4.php';?>
        <?php require 'toolkit/toolkit_step4_1.php';?>
        <?php require 'toolkit/toolkit_step4_2.php';?>
        <?php require 'toolkit/toolkit_step4_3.php';?>
        <?php require 'toolkit/toolkit_step4_4.php';?>
        <?php require 'toolkit/toolkit_step5_1.php';?>
        <?php require 'toolkit/toolkit_step5_2.php';?>
        <?php require 'toolkit/toolkit_step5_3.php';?>
        <?php require 'toolkit/toolkit_step5_4.php';?>
        <?php require 'toolkit/toolkit_step5_5.php';?>
        <?php require 'toolkit/toolkit_step6_1.php';?>
        <?php require 'toolkit/toolkit_step6_2.php';?>
        <?php require 'toolkit/toolkit_step6_3.php';?>
        <?php require 'toolkit/toolkit_step6_4.php';?>
        <?php require 'toolkit/toolkit_step6_5.php';?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        jQuery.slidebars();

        $('li').click(function(){
            var idVal = $(this).attr('id');
            if(idVal != ""){
                if(idVal == 'intro1'){
                    $('#slidecontent2').show();
                    $('#toolkitIntroOne').show();
                }else if(idVal == 'intro2'){
                    $('#toolkitIntroOne').hide();
                    $('#slidecontent2').show();
                    $('#toolkitIntroTwo').show();
                }else if(idVal == 'intro3'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#slidecontent2').show();
                    $('#toolkitIntroThree').show();
                }else if(idVal == 'step1_1'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep1_1').show();
                }else if(idVal == 'step1_2'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep1_2').show();
                }else if(idVal == 'step1_3'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep1_3').show();
                }else if(idVal == 'step1_4'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep1_4').show();
                }else if(idVal == 'step2_1'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep2_1').show();
                }else if(idVal == 'step2_2'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep2_2').show();
                }else if(idVal == 'step2_3'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep2_3').show();
                }else if(idVal == 'step2_4'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep2_4').show();
                }else if(idVal == 'step3_1'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep3_1').show();
                }else if(idVal == 'step3_2'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep3_2').show();
                }else if(idVal == 'step3_3'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep3_3').show();
                }else if(idVal == 'step3_4'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep3_4').show();
                }else if(idVal == 'step4_1'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep4_1').show();
                }else if(idVal == 'step4_2'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep4_2').show();
                }else if(idVal == 'step4_3'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep4_3').show();
                }else if(idVal == 'step4_4'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep4_4').show();
                }else if(idVal == 'step5_1'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#toolkitStep4_4').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep5_1').show();
                }else if(idVal == 'step5_2'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#toolkitStep4_4').hide();
                    $('#toolkitStep5_1').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep5_2').show();
                }else if(idVal == 'step5_3'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#toolkitStep4_4').hide();
                    $('#toolkitStep5_1').hide();
                    $('#toolkitStep5_2').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep5_3').show();
                }else if(idVal == 'step5_4'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#toolkitStep4_4').hide();
                    $('#toolkitStep5_1').hide();
                    $('#toolkitStep5_2').hide();
                    $('#toolkitStep5_3').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep5_4').show();
                }else if(idVal == 'step5_5'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#toolkitStep4_4').hide();
                    $('#toolkitStep5_1').hide();
                    $('#toolkitStep5_2').hide();
                    $('#toolkitStep5_3').hide();
                    $('#toolkitStep5_4').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep5_5').show();
                }else if(idVal == 'step6_1'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#toolkitStep4_4').hide();
                    $('#toolkitStep5_1').hide();
                    $('#toolkitStep5_2').hide();
                    $('#toolkitStep5_3').hide();
                    $('#toolkitStep5_4').hide();
                    $('#toolkitStep5_5').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep6_1').show();
                }else if(idVal == 'step6_2'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#toolkitStep4_4').hide();
                    $('#toolkitStep5_1').hide();
                    $('#toolkitStep5_2').hide();
                    $('#toolkitStep5_3').hide();
                    $('#toolkitStep5_4').hide();
                    $('#toolkitStep5_5').hide();
                    $('#toolkitStep6_1').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep6_2').show();
                }else if(idVal == 'step6_3'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#toolkitStep4_4').hide();
                    $('#toolkitStep5_1').hide();
                    $('#toolkitStep5_2').hide();
                    $('#toolkitStep5_3').hide();
                    $('#toolkitStep5_4').hide();
                    $('#toolkitStep5_5').hide();
                    $('#toolkitStep6_1').hide();
                    $('#toolkitStep6_2').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep6_3').show();
                }else if(idVal == 'step6_4'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#toolkitStep4_4').hide();
                    $('#toolkitStep5_1').hide();
                    $('#toolkitStep5_2').hide();
                    $('#toolkitStep5_3').hide();
                    $('#toolkitStep5_4').hide();
                    $('#toolkitStep5_5').hide();
                    $('#toolkitStep6_1').hide();
                    $('#toolkitStep6_2').hide();
                    $('#toolkitStep6_3').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep6_4').show();
                }else if(idVal == 'step6_5'){
                    $('#toolkitIntroOne').hide();
                    $('#toolkitIntroTwo').hide();
                    $('#toolkitIntroThree').hide();
                    $('#toolkitStep1_1').hide();
                    $('#toolkitStep1_2').hide();
                    $('#toolkitStep1_3').hide();
                    $('#toolkitStep1_4').hide();
                    $('#toolkitStep2_1').hide();
                    $('#toolkitStep2_2').hide();
                    $('#toolkitStep2_3').hide();
                    $('#toolkitStep2_4').hide();
                    $('#toolkitStep3_1').hide();
                    $('#toolkitStep3_2').hide();
                    $('#toolkitStep3_3').hide();
                    $('#toolkitStep3_4').hide();
                    $('#toolkitStep4_1').hide();
                    $('#toolkitStep4_2').hide();
                    $('#toolkitStep4_3').hide();
                    $('#toolkitStep4_4').hide();
                    $('#toolkitStep5_1').hide();
                    $('#toolkitStep5_2').hide();
                    $('#toolkitStep5_3').hide();
                    $('#toolkitStep5_4').hide();
                    $('#toolkitStep5_5').hide();
                    $('#toolkitStep6_1').hide();
                    $('#toolkitStep6_2').hide();
                    $('#toolkitStep6_3').hide();
                    $('#toolkitStep6_4').hide();
                    $('#slidecontent2').show();
                    $('#toolkitStep6_5').show();
                }
            }
        });
    });//end document.ready function
</script>
