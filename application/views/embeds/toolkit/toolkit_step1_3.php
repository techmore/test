<h3 class="guidance"> Guidance</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PPStep01.aspx"> Step 1 At a Glance in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step1_Task2.aspx"> Develop a Common Framework in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step1_Task3.aspx"> Define and Assign Roles and Responsibilities in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf"> Page 6 in the <i>School Guide</i>  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf"> Pages 15-17 in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12NIMSImplementation.aspx"> National Incident Management System (NIMS)  </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_Collaboration.aspx"> Enhancing Collaboration With Key Community Partners to Support Emergency Planning </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/TrainingPackage.aspx"> Developing and Enhancing Memoranda of Understanding (MOUs) With Your Community Partners Training Module </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Resource_Basic_Leadership.aspx"> Enhancing School Safety Leadership Capabilities </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_EOP.aspx"> Using a Six-Step Planning Process to Support EOP Development </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Assessment/K-12/A_Demographic.aspx"> EOP ASSESS </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/NIMS_ComprehensiveGuidanceActivities_2009-2010.pdf"> Comprehensive NIMS Implementation Activities for Schools </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/NIMS_ImplementationActivitiesChecklist_2009-2010.pdf"> Checklist: NIMS Implementation Activities for Schools </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/NIMS_KeyPersonnelTraining_2009-2010.pdf"> Key Personnel and NIMS Training for Schools </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/NIMS_FAQ_2009-2010.pdf"> Frequently Asked Questions About NIMS Implementation Activities for Schools  </a></p></li>
        <li><p><a target="_blank" href="https://training.fema.gov/is/courseoverview.aspx?code=IS-100.c"> IS-100.C: Introduction to the Incident Command System Online Course </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/Glossary%20of%20Key%20Terms%208.8.2014.pdf"> Glossary of Key Terms </a></p></li>
        <li><p><a target="_blank" href="https://www.fema.gov/sites/default/files/2020-07/fema_nims_doctrine-2017.pdf"> Pages 61-71 of the National Incident Management System  </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolBox.aspx"> NIMS Implementation Materials in the Tool Box </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolboxSubmission"> Submit your example to the Tool Box  </a></p></li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>