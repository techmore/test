<h3 class="guidance"> Guidance</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf"> <i>School Guide</i>  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf"> <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12GuideForDevelHQSchool.aspx"> At a Glance Version of the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/DistrictGuideAtAGlance.aspx"> At a Glance Version of the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/ASMTrainingGuide.pdf"> A Training Guide for Administrators and Educators on Addressing Adult Sexual Misconduct in the School Setting </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ASMGuideAtAGlance.aspx"> At a Glance Version of the ASM Training Guide </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/REMSPublications.aspx"> Publications and Guidance Documents </a></p></li>

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
        <li><p><a target="_blank" href="https://rems.ed.gov/ResourcesToSupportEMP"> Topic-Specific Resources to Support Your Emergency Management Planning </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Default.aspx"> REMS TA Center Community of Practice </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/EMVirtualToolkitRegistration"> Emergency Management Virtual Toolkit </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/VirtualTBRs"> Virtual Trainings by Request </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/TA_TrainingsByRequest.aspx"> Live Trainings by Request  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/TA_Webinars.aspx"> Webinars </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/trainings/CoursesHome.aspx"> Online Courses </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/TrainingPackage.aspx"> Specialized Training Package </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/REMSPublications.aspx"> Publications and Guidance Documents </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolBox.aspx"> Tool Box </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/StateResources.aspx"> State Emergency Management Resources </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d85&ForumID=85"> Share your experience in the EOP ASSIST Discussion CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolboxSubmission"> Submit your example to the Tool Box  </a></p></li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>