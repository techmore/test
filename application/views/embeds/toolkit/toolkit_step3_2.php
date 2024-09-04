<h3 class="guidance"> Guidance</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PPStep03.aspx"> Step 3 At a Glance in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step3_Task1.aspx"> Select Threats and Hazards to Address in School EOPs in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf"> Page 12 in the <i>School Guide</i>  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf"> Pages 26-27 in the <i>District Guide</i> </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_Hazards_Threats_Natural_Hazards.aspx"> Planning for Natural Hazards That May Impact Students, Staff, and Visitors </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_Hazards_Threats_Technological_Hazards.aspx"> Addressing Technological Hazards That May Impact Students, Staff, and Visitors </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_Hazards_Threats_Biological_Hazards.aspx"> Addressing Biological Hazards That May Impact Students, Staff, and Visitors </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/Resources_Hazards-Threats_Adversarial_Threats.aspx"> Addressing Adversarial and Human-Caused Threats That May Impact Students, Staff, and Visitors  </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolboxSubmission"> Submit your example to the Tool Box  </a></p></li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>