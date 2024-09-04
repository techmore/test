<?php
/**
 * Created by PhpStorm.
 * User: godfreymajwega
 * Date: 8/4/21
 * Time: 3:35 PM
 */
?>
<script>
    $(document).on('click', "#left_nav ul li", function(){
        if($(this).find("a").attr('href')){
            window.location.href = $(this).find("a").attr('href');
        }
    });

</script>
<div class="col-left">
    <div id="left_nav">
        <h3>GETTING STARTED</h3>
        <div>
            <ul>
                <li class="<?=($page=='home' && $step==1) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>home/step/1">Before Using EOP ASSIST</a></p></li>
                <li class="<?=($page=='home' && $step==2) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>home/step/2">How Teams Can Use EOP ASSIST</a></p></li>
                <li class="<?=($page=='home' && $step==3) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>home/step/3">Introduction to the Planning Process</a></p></li>
            </ul>
        </div>

        <h3>Step 1</h3>
        <div>
            <ul>
                <li class="<?=($page=='step1' && $step==1) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step1">Overview of Step 1: Form a Collaborative Planning Team</a></p></li>
                <li class="<?=($page=='step1' && $step==2) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step1/2" >Identify a Core Planning Team</a></p></li>
                <li class="<?=($page=='step1' && $step==3) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step1/3" >Form a Common Framework and Define and Assign Roles and Responsibilities</a></p></li>
                <li class="<?=($page=='step1' && $step==4) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step1/4" >Determine a Regular Schedule of Meetings</a></p></li>
            </ul>
        </div>

        <h3>Step 2</h3>
        <div>
            <ul>
                <li class="<?=($page=='step2' && $step==1) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step2" >Overview of Step 2: Understand the Situation</a></p></li>
                <li class="<?=($page=='step2' && $step==2) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step2/2" >Develop a Comprehensive List of Possible Threats and Hazards Using a Variety of Data Sources</a></p></li>
                <li class="<?=($page=='step2' && $step==3) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step2/3" >Evaluate Risks and Vulnerabilities of Threats and Hazards and Then Prioritize</a></p></li>
            </ul>
        </div>

        <h3>Step 3</h3>
        <div>
            <ul>
                <li class="<?=($page=='step3' && $step==1) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step3" >Overview of Step 3: Determine Goals and Objectives</a></p></li>
                <li class="<?=($page=='step3' && $step==2) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step3/2" >Select Threats and Hazards to Address in the School EOP</a></p></li>
                <li class="<?=($page=='step3' && $step==3) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step3/3" >Develop Goals and Objectives for Threats and Hazards</a></p></li>
                <li class="<?=($page=='step3' && $step==4) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step3/4" >Develop Goals and Objectives for Functions</a></p></li>
            </ul>
        </div>

        <h3>Step 4</h3>
        <div>
            <ul>
                <li class="<?=($page=='step4' && $step==1) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step4" >Overview of Step 4: Plan Development (Identify Courses of Action)</a></p></li>
                <li class="<?=($page=='step4' && $step==2) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step4/2" >Use Scenario-Based Planning</a></p></li>
                <li class="<?=($page=='step4' && $step==3) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step4/3" >Develop Courses of Action for Threats and Hazards</a></p></li>
                <li class="<?=($page=='step4' && $step==4) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step4/4" >Develop Courses of Action for Functions</a></p></li>

            </ul>
        </div>

        <h3>Step 5</h3>
        <div>
            <ul>
                <li class="<?=($page=='step5' && $step==1) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step5" >Overview of Step 5: Plan Preparation, Review, and Approval</a></p></li>
                <li class="<?=($page=='step5' && $step==2) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step5/2" >Prepare the Draft EOP: Threat- and Hazard-Specific Annexes</a></p></li>
                <li class="<?=($page=='step5' && $step==3) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step5/3" >Prepare the Draft EOP: Functional Annexes</a></p></li>
                <li class="<?=($page=='step5' && $step==4) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step5/4" >Prepare the Draft EOP: Basic Plan</a></p></li>
                <li class="<?=($page=='step5' && $step==5) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step5/5" >Review, Approve, and Share the Plan</a></p></li>
            </ul>
        </div>

        <h3>Step 6</h3>
        <div>
            <ul>
                <li class="<?=($page=='step6' && $step==1) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step6" >Overview of Step 6: Plan Implementation and Maintenance</a></p></li>
                <li class="<?=($page=='step6' && $step==2) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step6/2" >Train Stakeholders on the Plan</a></p></li>
                <li class="<?=($page=='step6' && $step==3) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step6/3" >Exercise the Plan</a></p></li>
                <li class="<?=($page=='step6' && $step==4) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step6/4" >Review, Revise, and Maintain the Plan</a></p></li>
                <li class="<?=($page=='step6' && $step==5) ? 'active' : ''?>"> <p><a href="<?php echo base_url(); ?>plan/step6/5" >Thank You for Using EOP ASSIST</a></p></li>
            </ul>
        </div>


        <div>&nbsp;</div>

    </div>
</div>