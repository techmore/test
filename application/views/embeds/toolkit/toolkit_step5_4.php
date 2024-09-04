<h3 class="guidance"> Guidance</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PPStep05.aspx"> The Basic Plan At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PPStep05.aspx"> Step 5 At a Glance in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step5_Task1.aspx"> Develop the Basic Plan in the <i>District Guide</i>   </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf"> Pages 17-19 and 23-28 in the <i>School Guide</i>  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf"> Pages 39-43 in the <i>District Guide</i> </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_EOP.aspx"> Using a Six-Step Planning Process to Support EOP Development </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Resource_Basic_Leadership.aspx"> Enhancing School Safety Leadership Capabilities </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_Collaboration.aspx"> Enhancing Collaboration With Key Community Partners to Support Emergency Planning </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/TrainingPackage.aspx"> Developing and Enhancing Memoranda of Understanding (MOUs) With Your Community Partners Training Module </a></p></li>
        <li><p><a target="_blank" href="https://www.fema.gov/sites/default/files/2020-06/fema-plan-integration_7-1-2015.pdf"> Plan Integration: Linking Local Planning Efforts  </a></p></li>
        <li><p><a target="_blank" href="https://www.fema.gov/emergency-managers/nims/components"> Resource Management and Mutual Aid </a></p></li>
        <li><p><a target="_blank" href="https://www.ready.gov/alerts"> Emergency Alerts </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/NOAA_NewsletterV2I4.pdf"> All-Hazards NOAA Weather Radio Network </a></p></li>
        <li><p><a target="_blank" href="https://transition.fcc.gov/pshs/docs/clearinghouse/DHS-MemorandumOfUnderstanding.pdf"> Writing Guide for a Memorandum of Understanding (MOU)  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_All_Hazard.aspx"> Using an All-Hazards Approach When Planning for Emergency Incidents </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_AFN.aspx"> Ensuring Access and Functional Needs Are Met Before, During, and After Emergency Incidents </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_All_Setting.aspx"> Planning for Emergency Incidents That Can Happen in All Settings and During All Times </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/webinarDetail?id=56"> Integrating Drills and Exercises Into Overall School Emergency Management Planning Webinar </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolBox.aspx"> Examples of Plan Sections in the Tool Box </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d117&ForumID=117"> Managing Donations and Volunteers CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolboxSubmission"> Submit your example to the Tool Box  </a></p></li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>