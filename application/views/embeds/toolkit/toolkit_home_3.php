<h3 class="guidance"> Guidance</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PlanningPrinciples.aspx"> Planning Principles At a Glance in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/DistrictGuideAtAGlance.aspx"> The Planning Process At a Glance in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PPStep05.aspx"> School EOP Format At a Glance in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Use.aspx"> School and District EOP Format At a Glance in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf"> Pages 4-5 and 18 in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf"> Pages 5-7 and 45 in the <i>District Guide</i> </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/Volume5Issue2.pdf"> Principles for Creating a High-Quality School EOP </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/Volume5Issue4.pdf"> K-12 Six-Step Planning Process </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/TrainingPackage.aspx"> Specialized Training Package </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/trainings/course_k12.aspx"> K-12 Online Courses   </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/webinarDetail?id=69"> School EOP Planning 101: Creating High-Quality School Emergency Operations Plans That Address All Threats, Hazards, Settings, and Times Webinar </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/DevelopingHigh-QualitySchool.aspx"> Developing High-Quality School EOPs: An Overview Webinar </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_AFN.aspx"> Ensuring Access and Functional Needs Are Met Before, During, and After Emergency Incidents  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_All_Setting.aspx"> Planning for Emergency Incidents That Can Happen in All Settings and During All Times </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_Community.aspx"> Working With the Whole Community to Manage Emergency Incidents That May Impact Education Agencies </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d101&ForumID=101"> Access and Functional Needs CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d1&ForumID=1"> Developing High-Quality EOPs for Schools CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d160&ForumID=160"> The Role of Districts in Developing School EOPs CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolboxSubmission"> Submit your example to the Tool Box  </a></p></li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>