<h3 class="guidance"> Guidance</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PPStep06.aspx"> Step 6 At a Glance in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step6_Task2.aspx"> Exercise the Plan At a Glance in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf"> Pages 21-22 in the <i>School Guide</i>  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf"> Pages 51-52 in the <i>District Guide</i> </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/TrainingPackage.aspx"> Emergency Exercises Package Training Module </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/webinarDetail?id=56"> Integrating Drills and Exercises Into Overall School Emergency Management Planning Webinar </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/ModifyingExercisesFactSheet_508C.pdf"> Modifying Education Agency Exercises and Drills in Response to the Pandemic: Protecting Students, Faculty, Staff, and the Whole School Community While Practicing Plans Fact Sheet </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/webinarDetail?id=68"> School EOP Planning 101: Modifying Exercises and Drills in Response to the Pandemic Webinar  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_EOP.aspx"> Using a Six-Step Planning Process to Support EOP Development </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/PrepareAthon.aspx"> America’s PrepareAthon! </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/shakeout.aspx"> Great ShakeOut Earthquake Drills </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/Emergency_NewsletterV2I3.pdf"> Emergency Exercises: An Effective Way to Validate School Safety Plans </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/HH_Vol2Issue4.pdf"> Planning and Conducting a Functional Exercise </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/After_ActionReports.pdf"> After-Action Reports: Capturing Lessons Learned and Identifying Areas for Improvement </a></p></li>
        <li><p><a target="_blank" href="https://preptoolkit.fema.gov/web/hseep-resources"> Homeland Security Exercise and Evaluation Program Resources </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_AFN.aspx"> Ensuring Access and Functional Needs Are Met Before, During, and After Emergency Incidents </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolBox.aspx"> Materials Supporting Exercises, Drills, Tabletop Exercises, and After-Action Reports in the Tool Box </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolboxSubmission"> Submit your example to the Tool Box  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d75&ForumID=75"> Exercises and Drills—Planning and Practice CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d105&ForumID=105"> Great ShakeOut Earthquake Drills CoP Forum </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d86&ForumID=86"> America’s PrepareAthon! CoP Forum </a></p></li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>