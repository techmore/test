<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Overview of Step 3: Determine Goals and Objectives</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_1"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Now  that your planning team has a comprehensive, yet prioritized list of threats  or hazards, Step 3 will prompt your team to select which threats or hazards  will be included in the EOP, and then to develop <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a> and <a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>  for  addressing those selected threats or hazards. </p>
    <p><strong>Select Threats and Hazards to Address in  the School EOP </strong></p>
    <p>Your  team&rsquo;s first task is to review the prioritized list of threats or hazards from  Step 2 and to select which of those threats or hazards will be addressed in  the school EOP. </p>
    <p><strong>Develop Goals and Objectives for Threats  or Hazards </strong></p>
    <p>Next,  your planning team will develop three goals (before, during, and after) to  address each selected threat or hazard, and then develop corresponding  objectives for each goal.&nbsp;Some goals and objectives apply to multiple  threats or hazards and are therefore considered cross-cutting functions. During  the process of developing goals and objectives for threats or hazards, your  team will also need to identify which goals and objectives are functions and  which are not. </p>
    <p><strong>Develop Goals and Objectives for  Functions</strong></p>
    <p>After  identifying cross-cutting functions, your team will develop goals and objectives  for each function. </p>
    <p><strong>Outcome of Step 3</strong></p>
    <p>At the conclusion of Step 3, your planning team will have developed goals and objectives for each threat, hazard, and function. These goals and objectives will be carried forward to Step 4 and will be used as the basis for courses of action. Goals, objectives, and courses of action will ultimately form the functional annexes and threat- and hazard-specific annexes of the school EOP.</p>
</div><!-- /col-half --><!-- /col-half -->

<?php endif; ?>

<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Overview of Step 3: Help Schools Determine Goals and Objectives</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_1"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Now that you have helped schools create prioritized lists of threats or hazards for inclusion in their school EOPs, Step 3 will prompt your team to develop  <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a> and <a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>  for districtwide hazards and threats from the master list, a new master list of cross-cutting functions, <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a> and <a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a> for districtwide functions from the master list. </p>
    <p><strong>Select Threats and Hazards to Address in the School EOPs </strong></p>
    <p>Your team’s first task is to guide your school core planning teams in deciding which threats or hazards from Step 2 will be addressed in each school EOP. You will ensure that your schools address all possible threats and risks and not merely those identified as “high-risk” priorities. </p>
    <p><strong>Develop Goals and Objectives for Selected Threats and Hazards </strong></p>
    <p>Next, your team will develop three goals (before, during, and after) to address each threat and hazard included on the district’s master list, and then develop corresponding objectives for each goal. Some goals and objectives apply to multiple threats or hazards and are therefore considered cross-cutting functions. During the process of developing goals and objectives for districtwide threats or hazards, your team will also need to identify which goals and objectives are functions and which are not. </p>
    <p><strong>Identify Cross-Cutting Functions and Develop Goals and Objectives for Cross-Cutting Functions</strong></p>
    <p>You will compile a list of districtwide functions and develop policies and procedures for identifying cross-cutting functions. Then, your team will develop goals and objectives for each districtwide function. </p>
    <p><strong>Outcome of Step 3</strong></p>
    <p>At the conclusion of Step 3, your planning team will have developed a master list of goals and objectives for each districtwide threat, hazard, and function. These goals and objectives will be carried forward to Step 4 and used as the basis for courses of action. Goals, objectives, and courses of action will ultimately form the functional annexes and threat- and hazard-specific annexes of the school EOP.</p>
</div><!-- /col-half --><!-- /col-half -->

<?php endif; ?>
<script type='text/javascript'>
    $(document).ready(function() {


        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step3/2')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step2/3')); ?>"); //Previous


    }); // End $(document).ready function

</script>
