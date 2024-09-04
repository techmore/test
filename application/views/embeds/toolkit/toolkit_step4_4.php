<h3 class="guidance"> Guidance</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PPStep04.aspx"> Step 4 At a Glance in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step4_Task1.aspx"> Develop Courses of Action in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step4_Task2.aspx"> Select Preferred Courses of Action in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step4_Task3.aspx"> Finalize and Format the Functional and Threat- and Hazard-Specific Annexes in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12EvacAnnex.aspx"> Evacuation Annex At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12LockdownAnnex.aspx"> Lockdown Annex At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12SIPAnnex.aspx"> Shelter-in-Place Annex At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12AccountingFAPAnnex.aspx"> Accounting for All Persons Annex At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12ComAndWarningAnnex.aspx"> Communications and Warning Annex At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12FamilyRAnnex.aspx"> Family Reunification Annex At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12COOPAnnex.aspx"> Continuity of Operations Annex At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12RecoveryAnnex.aspx"> Recovery Annex At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PHMandMHAnnex.aspx"> Public Health, Medical, and Mental Health Annex At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12SecurityAnnex.aspx"> Security Annex At a Glance </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf"> Pages 16 and 28-35 in the <i>School Guide</i>  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf"> Pages 33-36 in the <i>District Guide</i> </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_EOP.aspx"> Using a Six-Step Planning Process and Scenario-Based Planning to Support EOP Development </a></p></li>
        <li><p><a target="_blank" href="https://www.fema.gov/sites/default/files/2020-04/CPG201Final20180525.pdf"> Pages 12-16 in Developing and Maintaining EOPs: Comprehensive Preparedness Guide (CPG) 101 </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_EM_Functions_AccountingforAllPersons.aspx"> Maximizing Your Education Agency’s Ability to Account for All Persons During and After an Incident </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ResourcesAlertsCommAndWarnings.aspx"> Managing Emergency Communications, Alerts, and Warnings/Notifications </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_EM%20Functions_COOP.aspx"> Ensuring Continuity of Operations and Learning During and After Emergency Incidents </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_EM%20Functions_Evacuation.aspx"> Ensuring the Safe Evacuation of All Students, Staff, and Visitors </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_EM%20Functions_Reunification.aspx"> Creating, Practicing, and Implementing Plans for Family Reunification Before, During, and After an Emergency </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_EM_Functions_Lockdown.aspx"> Adding Plans for Lockdown, Denying Entry and Closing Into School EOPs </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_EM%20Functions_Public_Medical_Mental.aspx"> Supporting Efforts to Create a Public Health, Medical, and Mental Health Annex as a Part of Your EOP </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_EM_Functions_Security.aspx"> Maximizing School Security as a Part of Emergency Management Planning </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_AFN.aspx"> Ensuring Access and Functional Needs Are Met Before, During, and After Emergency Incidents </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_All_Setting.aspx"> Planning for Emergency Incidents That Can Happen in All Settings and During All Times </a></p></li>
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
        <li><p><a target="_blank" href="http://phpdev02.seiservices.com/EOPAssist_R3/assets/resources/Example_of_a_Course_of_Action_Function.pdf"> An Example of a Course of Action Addressing the Function of Evacuation </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/LockdownSample.pdf"> Sample Lockdown Annex </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/ShelterInPlace.pdf"> Sample Shelter-in-Place Annex </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/FamilyReunificationSample.pdf"> Sample Family Reunification Annex </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolBox.aspx"> Procedures for Functions in the Tool Box </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d144&ForumID=144"> Evacuations CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d124&ForumID=124"> Recovery CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d147&ForumID=147"> Displaced Students CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d99&ForumID=99"> Continuity of Operations CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d108&ForumID=108"> Dealing With School Closures CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d23&ForumID=23"> Reunification CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d89&ForumID=89"> Emergency Management Assistance Teams for Recovery CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d109&ForumID=109"> Security Cameras & Surveillance Video CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ResourceSubmission/ResourceSubmissions.aspx"> Submit your example to the Tool Box  </a></p></li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>