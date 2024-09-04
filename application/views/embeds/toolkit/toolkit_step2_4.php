<div id="toolkitStep2_4" style="display:none">
    <h3 class="clicker resources guidanceimg">Guidance</h3>
    <UL class="reveal">
        <UL>
            <LI><A href="http://rems.ed.gov/K12PPStep02.aspx" target="_blank">At-a-Glance Guidance </A></LI>
            <LI><A href="http://rems.ed.gov/docs/REMS_K-12_Guide_508.pdf" target="_blank">Pages 7-12 in the Guide</A></LI>
            <?php if($guidanceGrp && is_array($guidanceGrp)):?>
                <?php foreach($guidanceGrp as $guidanceResource): ?>
                    <li><a target="_blank" href="<?php echo($guidanceResource['url']);?>" ><?php echo($guidanceResource['name']); ?></a> </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </UL>
    </UL>

    <h3 class="clicker resources resourceimg">Resources</h3>
    <ul class="reveal">
        <UL>
             <LI><A href="http://rems.ed.gov/K12PPStep02.aspx" target="_blank">Related Resources for Step 2 on the REMS Website</A></LI>
            <?php if($resourceGrp && is_array($resourceGrp)):?>
                <?php foreach($resourceGrp as $resourceResource): ?>
                    <li><p><a target="_blank" href="<?php echo($resourceResource['url']);?>" ><?php echo($resourceResource['name']); ?></a> </p></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </UL>
    </UL>

    <h3 class="clicker resources exampleimg">Examples</h3>
    <ul class="reveal">
        <UL>
            <LI><A href="http://rems.ed.gov/ToolBox.aspx" target="_blank">Assessment Checklists/Worksheets in REMS  Tool Box</A></LI>
            <LI><A href="<?php echo(base_url());?>assets/resources/sample_risk_vulnerability_assessment.xlsx" target="_blank">Risk Assessment Matrix</A></LI>
                <li><a href="http://rems.ed.gov/ResourceSubmission/ResourceSubmissions.aspx" target="_blank"> Submit your example to the REMS Tool Box</a></li>
            <?php if($examplesGrp && is_array($examplesGrp)):?>
                <?php foreach($examplesGrp as $examplesResource): ?>
                    <li><p><a href="<?php echo($examplesResource['url']);?>" target="_blank"><?php echo($examplesResource['name']); ?></a> </p></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </UL>
    </UL>
</div>
