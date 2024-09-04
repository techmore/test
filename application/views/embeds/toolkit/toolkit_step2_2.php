<h3 class="guidance"> Guidance</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PPStep02.aspx"> Step 2 At a Glance in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step2_Task1.aspx"> Identify Threats and Hazards in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step2.aspx"> Step 2 At a Glance in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12SchoolClimateAndEmerg.aspx"> School Climate and Emergencies At a Glance  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12ThreatAssessmentTeams.aspx"> Threat Assessment Teams At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_BehavioralThreatAssessment.aspx"> Behavioral Threat Assessment At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf"> Pages 7-10, 53-56, and 62-63 in the <i>School Guide</i>  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf"> Pages 18-23 in the <i>District Guide</i> </a></p></li>
        <?php if($guidanceGrp && is_array($guidanceGrp)):?>
            <?php foreach($guidanceGrp as $guidanceResource): ?>
                <li><a target="_blank" href="<?php echo($guidanceResource['url']);?>" ><?php echo($guidanceResource['name']); ?></a> </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>

<h3 class="resources"> Resources</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_Assessment.aspx"> Conducting Assessments to Help Your Education Agency Understand the Situation and Enhance Emergency Planning </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_EOP.aspx"> Using a Six-Step Planning Process to Support EOP Development </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/SITEASSESS.aspx"> SITE ASSESS </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/VirtualTBRs"> Conducting K-12 Site Assessments With SITE ASSESS Virtual Training by Request  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/TA_TrainingsbyRequest.aspx"> Conducting K-12 Site Assessments With SITE ASSESS Live Training by Request </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/Culture_Climate_Assessments_Fact_Sheet_508C.pdf"> School Culture and Climate Assessments Fact Sheet </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/VirtualTBRs"> School Behavioral Threat Assessments: An Introduction Virtual Training by Request </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/TA_TrainingsByRequest.aspx"> School Behavioral Threat Assessments: An Introduction Live Training by Request </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/webinarDetail?id=26"> Forming a School Behavioral Threat Assessment Team Webinar </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/webinarDetail?id=25"> Use of Social Media in School Behavioral Threat Assessments Webinar </a></p></li>
        <li><p><a target="_blank" href="http://apps1.seiservices.com/remsemailblast/emailfiles/2020_05/REMS_2020_05_01.html"> Using Special Education Services Models to Enhance Threat Assessment </a></p></li>
        <li><p><a target="_blank" href="http://apps1.seiservices.com/remsemailblast/emailfiles/2019June/REMS_2019_06_28.html"> Using the Summer Months to Conduct Site Assessments </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_AFN.aspx"> Ensuring Access and Functional Needs Are Met Before, During, and After Emergency Incidents </a></p></li>
        <li><p><a target="_blank" href="https://service.govdelivery.com/accounts/USDHSFEMA/subscriber/new"> FEMA Email Updates </a></p></li>
        <?php if($resourceGrp && is_array($resourceGrp)):?>
            <?php foreach($resourceGrp as $resourceResource): ?>
                <li><p><a target="_blank" href="<?php echo($resourceResource['url']);?>" ><?php echo($resourceResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>

<h3 class="examples"> Examples</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="http://phpdev02.seiservices.com/EOPAssist_R3/assets/resources/examples_of_threats_and_hazards.pdf"> Examples of Threats and Hazards </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolBox.aspx"> Site Assessment, Culture and Climate Assessment, Behavioral Threat Assessment, and Capacity Assessment Materials in the Tool Box </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d26&ForumID=26"> Understanding Your Situation—Assessments That Work CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d100&ForumID=100"> Threat Assessment in Schools CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d130&ForumID=130"> SITE ASSESS Discussion CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolboxSubmission"> Submit your example to the Tool Box  </a></p></li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>