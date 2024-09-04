<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<?php $_title =""; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Review, Approve, and Share the Plan</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step5_5"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>


<div class="col-half left">
    <p>Congratulations!  Your planning team has just finished the first draft of your school EOP. The  content of your plan is now viewable using the <a href="<?php echo base_url(); ?>report" id="reportManagementLink1">My EOP</a> export feature and is  ready for your planning team&rsquo;s review. </p>
    <p>To  review your draft plan, please take the following steps:</p>

    <blockquote>
        <p>1.Visit <a href="<?php echo base_url(); ?>report" id="reportManagementLink2">My EOP</a> and then export your plan to Microsoft Word.</p>
        <p>2. Invite  the rest of the planning team and other stakeholders to conduct a review of the  EOP for plan content and writing conventions. This <a href="<?php echo base_url(); ?>assets/resources/EOP_Review_Checklist.pdf" target="_blank" >checklist</a> may  prove useful for this review.</p>
        <p>3. Revise  the plan accordingly. Substantive revisions should be made into the Step 5  fields in the Planning Process, rather than directly in the Word document. Only  small formatting adjustments should be made directly into the Word document.</p>
        <p>4. Save  an electronic copy of the revised plan in a secure location. </p>
    </blockquote>

    <ol>
    </ol>
    <p>After  your planning team has reviewed and finalized the plan, the team should present  it to the appropriate leadership to obtain official approval. The planning team  should then share the plan with <a href="#" class="bt" title="Such as first responders or local emergency management staff.">community partners</a> and <a href="#" class="bt" title="Including relevant district, local, regional, and/or state agencies with which the plan will be coordinated.">other stakeholders</a> with a role in the plan, including other organizations that may use the school  building(s). Planning teams may want to share only certain parts of the plans,  or modified plans, with some stakeholders.<br />
        <br />
        Schools  should be careful to protect the plan from those who are not authorized to have  it, and should consider how they will secure documents shared electronically. Law enforcement agencies and first responders have a secured, Web-accessible  site available to house copies of plans, building schematics, phone contact  sheets, and other important details that round out planning. Schools must  comply with state and local open records laws in storing and protecting the  plan.</p>
</div>

<?php endif; ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title =""; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Review the Plan for Quality and Approve and Share the Plan</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step5_5"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>


<div class="col-half left">
	<p>Now your team will help schools review their plans. First, develop a framework for reviewing and approving plans. This framework should describe the district personnel responsible and the process for reviewing plans, as well as the criteria that will be used. This <a href="<?php echo base_url(); ?>assets/resources/EOP_Review_Checklist.pdf" target="_blank" >checklist</a> contains sample criteria for determining if a plan is high quality.</p>
    <p>As you develop policies and procedures for reviewing school EOPs, consider which district personnel will conduct the reviews; when this will be completed; what the process will be; which laws from the Federal, State, and local levels must be considered; and which tools, rubrics, or assessments will be used. Also consider the criteria for high-quality plans and how to train school core planning teams on such criteria. Furthermore, consider which community partners, representing which roles, will review and evaluate school EOPs.</p>
	
	<p>To review draft plans, please take the following four steps:</p>

    <blockquote>
        <p>1. <strong>Visit</strong> <a href="<?php echo base_url(); ?>report" id="reportManagementLink">My EOP</a> and export the desired plan to Microsoft Word.</p>
        <p>2. Invite the rest of the team and other stakeholders to <strong>conduct a review of the EOP</strong> for plan content and writing conventions. This <a href="<?php echo base_url(); ?>assets/resources/EOP_Review_Checklist.pdf" target="_blank" >checklist</a> may prove useful for this review.</p>
        <p>3. <strong>Revise  the plan accordingly</strong>. Substantive revisions should be made into the Step 5 fields in the Planning Process, rather than directly in the Word document. Only small formatting adjustments should be made directly into the Word document.</p>
        <p>4. <strong>Save  an electronic copy</strong> of the revised plan in a secure location. </p>
    </blockquote>

    <ol>
    </ol>
    <p>After the plan has been reviewed and revised, it is ready for approval and sharing. Your role is to develop a framework for officially approving school EOPs and working with schools to share their plans. Recipients should include&nbsp;<a href="#" class="bt" title="Such as first responders or local emergency management staff.">community partners</a>&nbsp;with a responsibility in the plan and&nbsp;<a href="#" class="bt" title="Including relevant district, local, regional, and/or state agencies with which the plan will be coordinated.">other stakeholders</a>&nbsp;with a role in the plan, including other organizations that may use the school building(s). Planning teams may want to share only certain parts of the plans, or modified plans, with some stakeholders.</p>
<p>District and schools should be careful to protect the plans from those who are not authorized to have them, and should consider how they will secure documents shared electronically. Law enforcement agencies and first responders have a secured, Web-accessible site available to house copies of plans, building schematics, phone contact sheets, and other important details that round out planning. In turn, schools must also comply with State and local open records laws in storing and protecting their plans.</p>
<p>Finally, decide which individuals/entities will receive copies of approved school EOPs. Also consider how sharing details (e.g., with whom, when, how) will be documented and which laws from the Federal, State, and local levels must be followed during the approval and sharing processes.</p>
</div>

<?php endif; ?>


<script type='text/javascript'>

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step6/1')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step5/4')); ?>"); //Previous

    }); // End $(document).ready function


</script>
