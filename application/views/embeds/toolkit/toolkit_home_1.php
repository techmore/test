<h3 class="guidance">Guidance</h3>
<div>
    <ul>
        <li> <p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf" ><i>Guide for Developing High-Quality School Emergency Operations Plans (School Guide</i>)</a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf" ><i>The Role of Districts in Developing High-Quality School Emergency Operations Plans (District Guide</i>)</a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/K12GuideForDevelHQSchool.aspx" >At a Glance Version of the <i>School Guide</i> </a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/DistrictGuideAtAGlance.aspx" >At a Glance Version of the <i>District Guide</i> </a></p></li>
        <?php if($guidanceGrp && is_array($guidanceGrp)):?>
            <?php foreach($guidanceGrp as $guidanceResource): ?>
                <li><a target="_blank" href="<?php echo($guidanceResource['url']);?>" ><?php echo($guidanceResource['name']); ?></a> </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>

<h3 class="resources">Resources</h3>
<div>
    <ul>
        <li> <p><a target="_blank" href="https://rems.ed.gov/webinarDetail?id=69">School EOP Planning 101: Creating High-Quality School Emergency Operations Plans That Address All Threats, Hazards, Settings, and Times Webinar</a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/webinarDetail?id=48">Overview of the <i>School Guide</i> Webinar </a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/webinarDetail?id=62">New Resource Review: <i>District Guide</i> Webinar </a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/trainings/course_k12.aspx">K-12 Online Courses </a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/VirtualTBRs">Developing EOPs K-12 101 Virtual Training by Request </a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/TA_TrainingsByRequest.aspx">Developing EOPs K-12 101 Live Training by Request </a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/stateresources.aspx">State-by-State Requirements for School EOPs </a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/docs/Glossary%20of%20Key%20Terms%208.8.2014.pdf">Glossary of Key Terms </a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/docs/Guide_for_Developing_High-Quality_School_Emergency_Operations_Plans-Resources07172013R.pdf"><i>School Guide</i> Resource List  </a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/docs/DistrictGuide_Resources_508C.pdf"><i>District Guide</i> Resource List </a></p></li>
        <li> <p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Resource_Basic_Leadership.aspx">Enhancing School Safety Leadership Capabilities </a></p></li>
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
        <li> <p> <a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d1&ForumID=1">  Developing High-Quality EOPs for Schools CoP Forum  </a></p> </li>
        <li> <p> <a target="_blank" href="https://rems.ed.gov/COP/Account/Login.aspx?ReturnUrl=%2fCOP%2fREMSCOPforum%2ftopics.aspx%3fForumID%3d160&ForumID=160">  The Role of Districts in Developing School EOPs CoP Forum  </a></p> </li>
        <li> <p> <a target="_blank" href="https://rems.ed.gov/ToolboxSubmission"> Submit your example to the Tool Box   </a></p> </li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>