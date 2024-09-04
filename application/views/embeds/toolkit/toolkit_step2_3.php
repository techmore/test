<h3 class="guidance"> Guidance</h3>
<div>
    <ul>
        <li><p><a target="_blank" href="https://rems.ed.gov/K12PPStep02.aspx"> Step 2 At a Glance in the <i>School Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step2_Task2.aspx"> Evaluate the Risks and Vulnerabilities Posed by Threats and Hazards in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/District_Step2_Task3.aspx"> Prioritize Threats and Hazards in the <i>District Guide</i> </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/School_Guide_508C.pdf"> Pages 7-8 and 11-12 in the <i>School Guide</i>  </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/District_Guide_508C.pdf"> Pages 23-25 in the <i>District Guide</i> </a></p></li>
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
        <li><p><a target="_blank" href="https://rems.ed.gov/docs/repository/REMS_TA_Center_Sample_Risk_Assessment_Matrix.xlsx"> Sample Risk Assessment Matrix </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolBox.aspx"> Risk and Vulnerability Evaluation Materials in the Tool Box </a></p></li>
        <li><p><a target="_blank" href="https://rems.ed.gov/ToolboxSubmission"> Submit your example to the Tool Box  </a></p></li>
        <?php if($examplesGrp && is_array($examplesGrp)):?>
            <?php foreach($examplesGrp as $examplesResource): ?>
                <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>