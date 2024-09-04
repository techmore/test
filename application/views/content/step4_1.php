<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<?php $_title =""; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Overview of Step 4: Plan Development (Identify Courses of Action)</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step4_1"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Now that your planning team has identified <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a>
        and <a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a> for addressing threats, hazards, and <a href="#" class="bt" title="Functions are activities that apply to more than one threat or hazard.">functions</a>, Step 4 will prompt your team to develop <a href="#" class="bt" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">courses of action</a>  for accomplishing those goals and objectives. Courses of action are the step-by-step procedures used to enact functions or manage threats and hazards.</p>
    <p><strong>Use Scenario-Based Planning</strong></p>
    <p>Your team&rsquo;s first task in developing courses of action is to use scenario-based planning to imagine the different ways that a threat or hazard may unfold, and the steps your school and community partners should take to address those threats and hazards&mdash;either with functions or with threat- and hazard-specific procedures. </p>
    <p><strong>Develop Courses of Action for Threats and Hazards</strong></p>
    <p>Next, using the scenarios that your planning team just imagined, your team will develop courses of action that clearly describe how your school and community partners will enact procedures  to address specific threats and hazards.</p>
    <p><strong>Develop Courses of Action for Functions</strong></p>
    <p>Likewise, your planning team will use the scenarios to develop courses of action that clearly describe how your school and community partners will enact different functions.</p>
    <p><strong>Outcome of Step 4</strong></p>
    <p>At the conclusion of Step 4, your planning team will have courses of action for each threat, hazard, and function. Along with the goals and objectives developed in Step 3, the courses of action will form the primary content in the Functional Annexes and Threat- and Hazard-Specific Annexes sections of your school EOP. In Step 5, your team will format the goals, objectives, and courses of action into actual sections of the school EOP.</p>
</div>
<?php endif; ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title =""; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Overview of Step 4: Help Schools Develop Plans (Identify Courses of Action)</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step4_1"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Now that your planning team has identified districtwide&nbsp;<a href="#" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a>&nbsp;and&nbsp;<a href="#" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>&nbsp;for addressing districtwide threats, hazards, and&nbsp;<a href="#" title="Functions are activities that apply to more than one threat or hazard.">functions</a>, Step 4 will prompt your team to support schools as they develop&nbsp;<a href="#" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">courses of action</a>&nbsp;for accomplishing the goals and objectives. Courses of action are the step-by-step procedures used to enact functions or manage threats and hazards.</p>
<p><strong>Use Scenario-Based Planning</strong> <br>
  This approach prompts planning teams to imagine the different ways that a threat or hazard may unfold, and the steps your schools and community partners should take to address those threats and hazards—either with functions or with threat- and hazard-specific procedures.</p>
<p><strong>Develop Courses of Action for Threats and Hazards</strong> <br>
  Your team&rsquo;s first task is to support schools in their development of customized, site-specific courses of action that address goals and objectives. Next, using the scenarios that were just imagined, your planning teams will develop courses of action that clearly describe how your schools and community partners will enact procedures to address specific threats and hazards.</p>
<p><strong>Develop Courses of Action for Functions</strong> <br>
  Likewise, planning teams will use the scenarios to develop courses of action that clearly describe how your schools and community partners will enact different functions.</p>
<p><strong>Outcome of Step 4</strong> <br>
  At the conclusion of Step 4, planning teams will have courses of action for each threat, hazard, and function. Along with the goals and objectives developed in Step 3, the courses of action will form the primary content in the Functional Annexes and Threat- and Hazard-Specific Annexes sections of your schools&rsquo; EOPs. In Step 5, your team will help schools format the goals, objectives, and courses of action into actual sections of the schools&rsquo; EOPs.</p>
</div>

<?php endif; ?>


<script type='text/javascript'>

    var selectedId;

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step4/2')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step3/4')); ?>"); //Previous


    }); // End $(document).ready function

</script>
