<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<?php $_title =""; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Use Scenario-Based Planning</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step4_2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>

<div class="col-half left">
    <p>Your  team&rsquo;s first task in developing <a href="#" class="bt" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">courses of action</a> is  to use scenario-based planning to imagine the different ways that a threat or  hazard may unfold, and how your school and community partners should address  those threats and hazards&mdash;with <a href="#" class="bt" title="Functions are activities that apply to more than one threat or hazard.">functions</a> or  threat- or hazard-specific procedures. High-quality courses of action account  for all possible ways that an emergency can unfold, including all settings and  times. As such, your team should use scenarios to envision all of the variables  that may impact how a threat or hazard unfolds.</p>
    <p>For  example, imagine that there is a chemical spill near your school. How might the  response measures change if this chemical spill happens at 7 a.m., 1 p.m., or  10 p.m.? Will a school&rsquo;s response differ based on the time of day and the  persons who are in the building? How might the response measures differ if the  chemical spill occurs outside of the school cafeteria, just before lunch? What  if the spill contaminates the heating, ventilation, and air conditioning system  before the start of the school day?</p>
    To  use scenario-based planning, planning teams are recommended to take the  following steps:
    </p><p>

        <blockquote>
            <p><strong>1. Depict  a scenario involving a selected threat or hazard</strong>. </p>
            <p><strong>2. Determine  the amount of time available to respond to the threat or hazard in your  scenario.</strong> This time will vary based on the type of threat or  hazard and the particular scenario.</p>
            <p><strong>3. Identify decision points.</strong> Decision points indicate the place in time, as threats or hazards unfold, when  leaders anticipate making decisions about a course of action. </p>
            <p><strong>4. Develop courses of action.</strong> Use  the scenario, available response time, and decision points to determine  appropriate courses of action. Additional information about developing courses  of action is included on the next page.</p>
        </blockquote>
    </p>
</div><!-- /col-half --><!-- /col-half -->

<?php endif; ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title =""; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Use Scenario-Based Planning</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step4_2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>

<div class="col-half left">
    <p>This approach helps planning teams imagine the different ways a threat or hazard may unfold, and how your schools and community partners should address those threats and hazards—with&nbsp;<a href="#" title="Functions are activities that apply to more than one threat or hazard.">functions</a>&nbsp;or threat- or hazard-specific procedures. High-quality <a href="#" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">courses of action</a><u> </u>account for all possible ways that an emergency can unfold, including all settings and times. Using scenarios will help your team envision all the variables that may impact how a threat or hazard unfolds.</p>
<p>For example, imagine that a chemical spill happens near a school in your district. How might the response measures change if this chemical spill happens at 7 a.m., 1 p.m., or 10 p.m.? Will the school&rsquo;s response differ based on the time of day and the persons who are in the building? How might the response differ if the chemical spill occurs outside the school cafeteria, just before lunch? What if the spill contaminates the heating, ventilation, and air conditioning system before the start of the school day?</p><p>

        <blockquote>
            <p><strong>1. Depict a scenario involving a selected threat or hazard</strong>. Create a potential scenario based on the threats and hazards identified and prioritized in Step 2.</p>
            <p><strong>2. Determine the amount of time available to respond to the threat or hazard in your scenario.</strong>&nbsp;This time will vary based on the type of threat or hazard and the particular scenario.</p>
            <p><strong>3. Identify decision points.</strong> Decision points indicate the place in time, as threats or hazards unfold, when leaders anticipate making decisions about a course of action.. </p>
            <p><strong>4. Develop courses of action.</strong> Use the scenario, available response time, and decision points to determine appropriate courses of action. See the next page for additional information about developing courses of action.</p>
        </blockquote>
    </p>
</div><!-- /col-half --><!-- /col-half -->

<?php endif; ?>


<script type='text/javascript'>

    var selectedId;

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step4/3')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step4/1')); ?>"); //Previous


    }); // End $(document).ready function

</script>
