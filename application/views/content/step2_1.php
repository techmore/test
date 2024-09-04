<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Overview of Step 2: Understand the Situation</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step2_1"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Now that your school has a collaborative planning team, it is time to begin the process of developing your school&rsquo;s EOP. Step 2 will prompt your team to develop a comprehensive,
        yet prioritized list of <a href="<?php echo(base_url());?>assets/resources/examples_of_threats_and_hazards.pdf" target="_blank">threats and hazards</a> to be addressed in the school EOP.</p>
    <p><strong></strong></p>
    <p><strong>Develop a Comprehensive List of Possible Threats and Hazards Using a Variety of Data Sources</strong></p>
    <p>Your team&rsquo;s first task is to develop a comprehensive list of threats and hazards by consulting a variety of data sources, including: school and district assessment data; information from local, State, and Federal partners; and information from the school community. </p>
    <p><strong>Evaluate Risks and Vulnerabilities of Threats and Hazards and Then Prioritize</strong></p>
    <p>After your team develops a comprehensive list of possible threats and hazards, the team should evaluate the risk and vulnerability of each of the threats and hazards. This evaluation will help your planning team to prioritize and refine the list of threats and hazards that will be addressed in your school EOP. </p>
    <p><strong>Outcome of Step 2</strong></p>
    <p>At the conclusion of Step 2, your planning team should have a prioritized list of threats and hazards that will be carried forward to Step 3. In Step 3, your planning team will begin developing response measures to address those prioritized threats and hazards.</p>
</div><!-- /col-half --><!-- /col-half -->
<?php endif; ?>

<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Overview of Step 2: Help Schools Understand the Situation</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step2_1"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Now that you have helped schools form their core planning teams, and formed your district core planning team, it is time to start helping schools develop their school EOPs. Step 2 will prompt your team to identify the universe of possible <a href="<?php echo(base_url());?>assets/resources/examples_of_threats_and_hazards.pdf">threats and hazards</a> that schools in your district might face. After, your role is to support each school planning team to conduct assessments, evaluate the risks and vulnerabilities posed by threats and hazards, and prioritize threats and hazards.</p>
    
    <p><strong>Identify Threats and Hazards</strong></p>
    <p>Your team&rsquo;s first task is to develop a districtwide master list of threats and hazards by consulting a variety of data sources, including these: school assessments; information from local, State, and Federal partners; and information from the school community. To guide schools in identifying site-specific threats and hazards, your team will need to develop policies and procedures. In addition, your team will determine which assessments are optional or required and which tools to use, and will assist schools in conducting assessments.</p>
    <p><strong>Evaluate the Risks and Vulnerabilities Posed by Threats and Hazards and Prioritize Threats and Hazards</strong> <br>
      After your district team develops a comprehensive list of all possible threats and hazards, the school team should evaluate its risk and vulnerability for each threat and hazard that may be applicable or designated by your district as mandatory for inclusion in the school&rsquo;s EOP. This evaluation will help the school planning team to prioritize and refine the list of threats and hazards that will be addressed in the school EOP.</p>
    <p><strong>Outcome of Step 2</strong></p>
At the conclusion of Step 2, your planning team should have a districtwide master list of threats and hazards that may be customized and prioritized by each school. This list will be carried forward to Step 3, when your planning team will begin developing response measures to address those prioritized threats and hazards.</div><!-- /col-half --><!-- /col-half -->
<?php endif; ?>
<script type='text/javascript'>
    $(document).ready(function() {


        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step2/2')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step1/4')); ?>"); //Previous
    });

</script>
