<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Evaluate Risks and Vulnerabilities of Threats and Hazards and Then Prioritize</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step2_3"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>After  developing a comprehensive list of threats and hazards, and collecting  information about those threats
        and hazards, the planning team should  consolidate all of the information it has obtained into a format that is
        usable  for evaluating and comparing the risks posed by the identified threats and  hazards. This will allow the
        team to prioritize which threats or hazards it  will directly address in the plan. </p>
    <p>In order to evaluate the risk and  vulnerability of a particular threat or hazard, your team should depict
        scenarios  of each threat and hazard unfolding at your school, and then consider the risk  criteria of
        magnitude, duration, probability, and warning time associated with  the threat or hazard, as well as how
        different variables could affect the different  risk criteria. For example, consider how the warning time
        for a school fire might  differ if the cause of the fire is a wildfire spreading across a nearby forest versus
        an accidental explosion in a science lab? At this stage in the planning  process, it is suggested that your
        planning team err on the side of caution in  determining risk and identifying vulnerabilities. </p>
    <p>One way to evaluate risk is to use a mathematical approach that assigns index numbers (e.g., a 1-to-4 scale) for
        different categories of information used in the ranking scheme. Using this approach, the planning team may
        categorize threats and hazards as posing a relatively high, medium, or low risk. Click
        <a href="<?php echo base_url(); ?>assets/resources/sample_risk_vulnerability_assessment.xlsx" target="_blank">here</a>
        to use a sample of a risk and vulnerability assessment based on this approach.</p>
</div>

<?php endif; ?>

<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Evaluate the Risks and Vulnerabilities Posed by Threats and Hazards and Prioritize Threats and Hazards</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step2_3"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>After developing a districtwide master list of threats and hazards, and helping schools develop customized lists of threats and hazards, your next task is to guide schools in evaluating risks and vulnerabilities posed by the identified threats and hazards. This will allow teams to prioritize which threats or hazards to directly address in the plan. </p>
  <p>Scenario-based planning is one strategy for evaluating threats or hazards. Your district team should depict scenarios of each threat and hazard that could unfold at your schools, and then instruct schools on the risk criteria of magnitude, duration, probability, and warning time associated with the threat or hazard, as well as how different variables could affect the different risk criteria. For example, consider instructing schools on how the warning time for a school fire might differ if the cause of the alert is a wildfire spreading across a nearby forest versus an accidental explosion in a science lab. </p>
    
	<p>Another strategy for evaluating threats or hazards is a mathematical approach that assigns index numbers (e.g., a 1-to-4 scale) for different categories of information used in the ranking scheme. Using this approach, the planning team may categorize threats and hazards as posing a relatively high, medium, or low risk. Click <a href="<?php echo base_url(); ?>assets/resources/sample_risk_vulnerability_assessment.xlsx" target="_blank">here</a> to use a sample of a risk and vulnerability assessment based on this approach.</p>
	<p>As your district develops policies and procedures for evaluating risks and vulnerabilities for the identified threats and hazards, consider the degree to which you will support and/or train schools, contribute information and guidance on factors, and assume responsibility for the task. Furthermore, identify which strategy your district will use and determine whether all schools will use the same strategy. </p>
<p>Once the evaluation of risks and vulnerabilities is complete, your next task is to help schools prioritize threats and hazards. To accomplish this, help schools categorize each threat and hazard as relatively high, medium, or low risk. </p>
<p>Your team will need to create policies and procedures for prioritizing threats and hazards. Consider how &ldquo;high risk,&rdquo; &ldquo;medium risk,&rdquo; and &ldquo;low risk&rdquo; are defined and the implications of each category, as well as how and to what degree you will support and/or train schools. Furthermore, consider the responsibilities of schools and the district in prioritizing threats and hazards and the extent to which you will require that schools either address or categorize threats and hazards in a particular way. </p>
	
</div>

<?php endif; ?>
<script type='text/javascript'>
    $(document).ready(function() {


        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step3/1')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step2/2')); ?>"); //Previous


    }); // End $(document).ready function

</script>
