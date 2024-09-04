<h3 class="guidance"> Guidance</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PPStep01.aspx"> Step 1 At a Glance in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step1_Task1.aspx"> Form a Core Planning Team in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf"> Page 6 in the <i>School Guide</i>  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf"> Pages 12-15 in the <i>District Guide</i> </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_Collaboration.aspx"> Enhancing Collaboration With Key Community Partners to Support Emergency Planning  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/TrainingPackage.aspx"> Developing and Enhancing Memoranda of Understanding (MOUs) With Your Community Partners Training Module  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Resource_Basic_Leadership.aspx"> Enhancing School Safety Leadership Capabilities </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resource_Plan_Basic_EOP.aspx"> Using a Six-Step Planning Process to Support EOP Development </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/webinarDetail?id=37"> Developing High-Quality School EOPs: A Collaborative Process Webinar </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/HH_Vol3Issue1.pdf"> Engaging Students in Emergency Management </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/HH_Vol2Issue8.pdf"> Establishing and Developing Strategic Partnerships With Media Representatives  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/HH_Vol2Issue7.pdf"> Families as Partners in School Emergency Management </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/HH_Vol2Issue5.pdf"> Engaging Administrators in School Emergency Management </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/TapIn2CmunityPartnrs4ERMgmt.pdf"> Tapping Into Nontraditional Community Partners for Emergency Management  </a></p></li>
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
        <li><p><a target="_blank" href="http://phpdev02.seiservices.com/EOPAssist_R3/assets/resources/Examples_of_Planning_Team_Members.pdf"> Examples of Planning Team Members </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolboxSubmission"> Submit your example to the Tool Box  </a></p></li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>