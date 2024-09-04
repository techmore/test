<?php
$entities = $page_vars['entities'];
$EOP_ctype = $EOP_type="internal";
$files = $page_vars['files'];

if(!empty($page_vars['EOP_type'])){
    $EOP_type = $page_vars['EOP_type'];
}

if(!empty($page_vars['EOP_ctype'])){
    $EOP_ctype = $page_vars['EOP_ctype'];
}
?>
<?php
if((null != $this->session->flashdata('error'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-red">
            <span class="symbol icon-error"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('error'));?>
        </div>
    </div>

<?php endif; ?>

<?php
if((null != $this->session->flashdata('success'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-green">
            <span class="symbol icon-tick"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('success'));?>
        </div>
    </div>

<?php endif; ?>

<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<?php $_title =""; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Prepare the Draft EOP: Basic Plan</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step5_4"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>


<div class="col-half left">
    <p>Your planning team will begin developing a draft of the school EOP with the Basic Plan section. The Basic Plan section provides an overview of the school’s approach to emergency operations and often consists of several subsections, as listed below. You may manually create the Basic Plan section by selecting Create Basic Plan below. Then click the Add button for each of the subsections below and follow the directions for that subsection. If you are modifying previously saved subsections, please click the Edit button for the corresponding subsection.</p>
    <p>If your school or district already has an up-to-date Basic Plan section (provided as a Microsoft Word document),
        you may upload the Basic Plan into EOP ASSIST. To upload your Basic Plan section, select Use Uploaded Basic Plan
        below. Then click the Choose File button that appears and select the appropriate file. After the page is refreshed,
        your uploaded Basic Plan will be found in the first row of the table below. Only one uploaded Basic Plan section will
        be saved in EOP ASSIST at a time.<br />
    </p>
</div>

<?php endif; ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Develop the Basic Plan"; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Develop the Basic Plan</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step5_4"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>


<div class="col-half left">
    <p>The Basic Plan section provides an overview of the school&rsquo;s approach to operations before, during, and after an emergency and often consists of several subsections, as listed below. School planning teams are responsible for developing this section, which addresses overarching activities regardless of the threat, hazard, or function.</p>
<p>Your first task is to work with schools to create their plans for exercise programs, which may comprise seminars, workshops, tabletop exercises, drills, functional exercises, and/or full-scale exercises. School core planning teams should collaborate with community partners and local emergency management staff about exercise planning, implementation, and results reporting. Schools should also communicate key information (e.g., dates, locations, times) in advance to those involved or impacted. </p>
<p>You play an important role in selecting age-appropriate exercises if students are involved, and in selecting participants that reflect the area&rsquo;s cultural make-up when families and the community are involved. You may also help schools consider the costs and benefits of each exercise and any State or local requirements. Ultimately, schools should consider different and nonideal conditions when conducting exercises, and debrief and develop after-action reports when exercises are complete to evaluate results, identify gaps/shortfalls, and document lessons learned.</p>
<p>When developing policies and procedures, consider how an ideal exercise program is defined for the district; the time and resources needed for and the feasibility of conducting certain exercises; which community partners should be involved; and whether there are any local, State or Federal laws, requirements, or recommendations regarding the type and frequency of exercises.</p>
<p>Your second task is to work with schools to establish a process for reviewing and revising plans. Set requirements about the frequency of and process for EOP updates. Consider any State requirements, as well as <em>District Guide </em>recommendations that school EOPs should be updated every two years at a minimum. Together, districts and schools should periodically review and revise portions of the school EOPs. Consider having schools review and update sections or entire EOPs after actual emergencies; changes in policy, personnel, organizational structures, processes, facilities, or equipment; updates to planning guidance or standards; exercises; changes in the school, district, or surrounding community; identification of new threats or hazards; and ongoing assessments.</p>
</div>

<div class="col-half left">
	<h1>Develop the Basic Plan</h1>
<table class="thform"><tr><td><p>You may manually create the Basic Plan section by selecting Create Basic Plan below. Then click Add for each subsection below and follow the directions for that subsection. To modify previously saved subsections, click Edit for the corresponding subsection. If the school already has an up-to-date Basic Plan section (provided as a Microsoft Word document), you may upload the Basic Plan into EOP ASSIST. To upload your Basic Plan section, select Use Uploaded Basic Plan below. Then click the Choose File button that appears and select the appropriate file. After the page is refreshed, the uploaded Basic Plan will appear in the first row of the table below. Only one uploaded Basic Plan section will be saved in EOP ASSIST at a time.</p></td></tr></table>
</div>


<?php endif; ?>
<br style="clear:both;" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>

<?php if($this->session->userdata['role']['read_only']=='n'): ?>
    <div class="col-half left" style="margin: 20px;">
        <form>
        <input id="useInternal" type="checkbox" autocomplete="off" <?php echo(($EOP_type=='internal')? "checked disabled" : ""); ?> name="internalEOP" ><label for="useInternal">Create Basic Plan</label>
        <input id="useExternal" type="checkbox" autocomplete="off" <?php echo(($EOP_type=='external')? "checked disabled" : ""); ?> name="externalEOP"><label for="useExternal">Use Uploaded Basic Plan</label>
        </form>
    </div>
<?php endif; ?>




<?php if($EOP_type == 'external'): ?>

    <br style="clear:both;" />
    <div class="col-half">
<table class="resultsFinal">
    <tr>
        <th width="20%" scope="col" style="vertical-align: middle; horiz-align: center; text-align: center;"> Basic Plan </strong></th>
        <th width="80%" scope="col" style="vertical-align: middle; horiz-align: center; text-align: center;">Sections</th>
    </tr>
    <tr class="planOdd">
        <td style="vertical-align: middle;">1.0 Cover Page</td>
        <td align="middle">

            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
            <input id="useInternalCover" type="checkbox" autocomplete="off" <?php echo(($EOP_ctype=='internal')? "checked disabled" : ""); ?> name="internalcEOP" ><label for="useInternalCover">Create Cover Page</label>
            <input id="useExternalCover" type="checkbox" autocomplete="off" <?php echo(($EOP_ctype=='external')? "checked disabled" : ""); ?> name="externalcEOP"><label  for="useExternalCover">Use Uploaded Cover Page</label>
<br />
            <?php endif; ?>
            <?php if($EOP_ctype == 'external'): ?>
                <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                    <div>
                        <form enctype="multipart/form-data" id="uploadCoverForm" method="post" action="<?php echo base_url(); ?>report/upload">
                            <input type="file" name="userfile" id="userfile" required="required" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-doc, .doc, .docx" />
                            <input type="button" value="Start Upload" id="uploadCoverButton" />
                            <input type="hidden" name="docType" value="cover"/>
                        </form>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <?php
                $mode = 'add';
                $entityId=null;
                foreach($entities as $entity_key=>$entity){
                    if($entity['name']=='form1') {
                        foreach ($entity['children'] as $child_key => $child) {
                            foreach($child['fields'] as $field){
                                if(isset($field['body']) && !empty($field['body'])){
                                    $entityId = $entity['id'];
                                    $mode='edit';
                                    break 3;
                                }
                            }
                        }
                    }
                }
                ?>
                <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                    <?php if($mode=='add'): ?>
                        <a href="#" class="showAddForm" id="showForm1Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                    <?php else: ?>
                        <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm1Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if($mode=='add'): ?>
                        <span class="empty">No Data</span>
                    <?php else: ?>
                        <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm1Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form1Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td style="vertical-align: middle;">2.0 Uploaded Basic Plan</td>
        <td align="middle">
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <div>
                    <form enctype="multipart/form-data" id="uploadForm" method="post" action="<?php echo base_url(); ?>report/upload">
                        <input type="file" name="userfile" id="userfile" required="required" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document, .docx" />
                        <input type="button" value="Start Upload" id="uploadButton" />
                        <input type="hidden" name="docType" value="main"/>
                    </form>
                </div>
            <?php endif; ?>

            <div  id="filesTable"></div>
        </td>
    </tr>
    </table>
    </div>
<?php endif; ?>





<?php if($EOP_type=='internal'): ?>
    <br style="clear:both" />
    <div class="col-half">
    <table class="resultsFinal">
    <tr>
        <th scope="col" style="vertical-align: middle; horiz-align: center; text-align: center;">Basic Plan</strong></th>
        <th style="vertical-align: middle; horiz-align: center; text-align: center;">Sections</th>
    </tr>
    <tr class="planOdd">
        <td>1. Introductory Material</td>
        <td align="middle">

            <?php
                $mode = 'add';
                $entityId=null;
                foreach($entities as $entity_key=>$entity){
                    if($entity['name']=='form1') {
                        foreach ($entity['children'] as $child_key => $child) {
                            foreach($child['fields'] as $field){
                                if(isset($field['body']) && !empty($field['body'])){
                                    $entityId = $entity['id'];
                                    $mode='edit';
                                    break 3;
                                }
                            }
                        }
                    }
                }
            ?>
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#" class="showAddForm" id="showForm1Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm1Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
                <?php else: ?>
                    <?php if($mode=='add'): ?>
                        <span class="empty">No Data</span>
                    <?php else: ?>
                        <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm1Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                    <?php endif; ?>
            <?php endif; ?>





        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form1Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>2. Purpose, Scope, Situation Overview, and Assumptions</td>
        <td align="middle">

            <?php
            $mode = 'add';
            $entityId=null;
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form2') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $entityId = $entity['id'];
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#" class="showAddForm" id="showForm2Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm2Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm2Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form2Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planOdd">
        <td>3. Concept of Operations (CONOPS)</td>
        <td align="middle">

            <?php
            $mode = 'add';
            $entityId=null;
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form3') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $entityId = $entity['id'];
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#" class="showAddForm" id="showForm3Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm"  data-entity-id="<?php echo($entityId); ?>" id="editForm3Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm"  data-entity-id="<?php echo($entityId); ?>" id="viewForm3Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form3Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>4. Organization and Assignment of Responsibilities </td>
        <td align="middle">

            <?php
            $mode = 'add';
            $entityId=null;
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form4') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $entityId = $entity['id'];
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#" class="showAddForm" id="showForm4Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm4Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm4Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form4Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planOdd">
        <td>5. Direction, Control, and Coordination</td>
        <td align="middle">

            <?php
            $mode = 'add';
            $entityId=null;
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form5') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $entityId = $entity['id'];
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#" class="showAddForm" id="showForm5Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm5Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm5Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>

        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form5Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>6. Information Collection, Analysis, and Dissemination</td>
        <td align="middle">

            <?php
            $mode = 'add';
            $entityId=null;
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form6') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $entityId = $entity['id'];
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#" class="showAddForm" id="showForm6Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm6Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm6Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form6Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planOdd">
        <td>7. Training and Exercises </td>
        <td align="middle">

            <?php
            $mode = 'add';
            $entityId=null;
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form7') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $entityId = $entity['id'];
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#" class="showAddForm" id="showForm7Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm7Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm7Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form7Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>8. Administration, Finance, and Logistics </td>
        <td align="middle">

            <?php
            $mode = 'add';
            $entityId=null;
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form8') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $entityId = $entity['id'];
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#" class="showAddForm" id="showForm8Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm8Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm8Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form8Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planOdd">
        <td>9. Plan Development and Maintenance</td>
        <td align="middle">

            <?php
            $mode = 'add';
            $entityId=null;
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form9') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $entityId = $entity['id'];
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#" class="showAddForm" id="showForm9Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm9Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm9Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form9Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>10. Authorities and References</td>
        <td align="middle">

            <?php
            $mode = 'add';
            $entityId=null;
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form10') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $entityId = $entity['id'];
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#"class="showAddForm" id="showForm10Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm10Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm10Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>

        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form10Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planOdd">
        <td>11. Images</td>
        <td align="middle">

            <?php
            $mode = 'add';
            $entityId=null;
            foreach($entities as $entity_key=>$entity){
                if($entity['name']=='form11') {
                    foreach ($entity['children'] as $child_key => $child) {
                        foreach($child['fields'] as $field){
                            if(isset($field['body']) && !empty($field['body'])){
                                $entityId = $entity['id'];
                                $mode='edit';
                                break 3;
                            }
                        }
                    }
                }
            }
            ?>

            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#"class="showAddForm" id="showForm11Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm11Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm11Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>

        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form11Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
    <tr class="planEven">
        <td>12. Attachments</td>
        <td align="middle">

            <?php
            $mode = 'add';
            if($files && is_array($files) && count($files)>0){
                $mode = 'edit';
            }
            ?>

            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                <?php if($mode=='add'): ?>
                    <a href="#"class="showAddForm" id="showForm12Link">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                <?php else: ?>
                    <a href="#" class="showEditForm" data-entity-id="<?php echo($entityId); ?>" id="editForm12Link">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                <?php endif; ?>
            <?php else: ?>
                <?php if($mode=='add'): ?>
                    <span class="empty">No Data</span>
                <?php else: ?>
                    <a href="#" class="showViewForm" data-entity-id="<?php echo($entityId); ?>" id="viewForm12Link">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                <?php endif; ?>
            <?php endif; ?>

        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="form12Div" style="padding-right:15px;padding-left:15px"></div>
        </td>
    </tr>
</table></div>
<?php endif; ?>


<script type='text/javascript'>

    var selectedEntityId;

    $(document).ready(function() {


        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step5/5')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step5/3')); ?>"); //Previous

        if($("#useInternal").is(':checked')){
            $("#useExternal").attr('checked', false);
        }else if($("#useExternal").is(':checked')){
            $("#useInternal").attr('checked', false);
        }


        var formData = {
            ajax: 1
        };
        $.ajax({
            url:    '<?php echo(base_url('report/getUploads')); ?>',
            data:   formData,
            type:   'POST',
            async: false,
            success: function(response){
                try{
                    $("#filesTable").html(response);

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });



    }); // End $(document).ready function



    $(document).on("click", "#uploadButton", function(){

        $("#uploadForm").validate();

        var options = {
            cache: false,
            complete: function(response){
                var responseStr = response.responseText;
                $("#filesTable").html(responseStr);
            },
            error: function(){
                alert('Import failed! Check your connection and try again.');
            }
        };

        var uploadForm = $("#uploadForm");
        uploadForm.ajaxForm(options);

        uploadForm.submit();
    });

    $(document).on("click", "#uploadCoverButton", function(){

        $("#uploadCoverForm").validate();

        var options = {
            cache: false,
            complete: function(response){
                var responseStr = response.responseText;
                $("#filesTable").html(responseStr);
            },
            error: function(){
                alert('Import failed! Check your connection and try again.');
            }
        };

        var uploadForm = $("#uploadCoverForm");
        uploadForm.ajaxForm(options);

        uploadForm.submit();
    });

    $(document).on('change', '#useInternal', function(){
        if($(this).is(':checked')){

            var formData = {
                ajax: 1,
                option: 'internal',
                docType: 'main'
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/setEOP')); ?>',
                data:   formData,
                type:   'POST',
                async:  false,
                success: function(response){
                    try{
                        location.reload();

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
        }
    });

    $(document).on('change', '#useExternal', function(){
        if($(this).is(':checked')){

            var formData = {
                ajax: 1,
                option: 'external',
                docType: 'main'
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/setEOP')); ?>',
                data:   formData,
                type:   'POST',
                async:  false,
                success: function(response){
                    try{
                        //alert(response);
                        location.reload();

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
        }
    });

    $(document).on('change', '#useInternalCover', function(){
        if($(this).is(':checked')){

            var formData = {
                ajax: 1,
                option: 'internal',
                docType: 'cover'
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/setEOP')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        location.reload();

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
        }
    });

    $(document).on('change', '#useExternalCover', function(){
        if($(this).is(':checked')){

            var formData = {
                ajax: 1,
                option: 'external',
                docType: 'cover'
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/setEOP')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        //alert(response);
                        location.reload();

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
        }
    });

    $(document).on('click', '.showAddForm', function(){

        var clickedBtn = $(this).attr('id');

        switch(clickedBtn){
            case 'showForm1Link':
                openForm1('add');
                break;
            case 'showForm2Link':
                openForm2('add');
                break;
            case 'showForm3Link':
                openForm3('add');
                break;
            case 'showForm4Link':
                openForm4('add');
                break;
            case 'showForm5Link':
                openForm5('add');
                break;
            case 'showForm6Link':
                openForm6('add');
                break;
            case 'showForm7Link':
                openForm7('add');
                break;
            case 'showForm8Link':
                openForm8('add');
                break;
            case 'showForm9Link':
                openForm9('add');
                break;
            case 'showForm10Link':
                openForm10('add');
                break;
            case 'showForm11Link':
                openForm11('add');
                break;
            case 'showForm12Link':
                openForm12('add');
                break;
        }



    }); // End click event for add forms

    $(document).on('click', '.showEditForm', function(){
        var clickedBtn = $(this).attr('id');

        switch(clickedBtn){
            case 'editForm1Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm1('edit', selectedEntityId);
                break;
            case 'editForm2Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm2('edit', selectedEntityId);
                break;
            case 'editForm3Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm3('edit', selectedEntityId);
                break;
            case 'editForm4Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm4('edit', selectedEntityId);
                break;
            case 'editForm5Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm5('edit', selectedEntityId);
                break;
            case 'editForm6Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm6('edit', selectedEntityId);
                break;
            case 'editForm7Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm7('edit', selectedEntityId);
                break;
            case 'editForm8Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm8('edit', selectedEntityId);
                break;
            case 'editForm9Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm9('edit', selectedEntityId);
                break;
            case 'editForm10Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm10('edit', selectedEntityId);
                break;
            case 'editForm11Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm11('edit', selectedEntityId);
                break;
            case 'editForm12Link':
                openForm12('edit');
                break;

        }

    });

    $(document).on('click', '.showViewForm', function(){
        var clickedBtn = $(this).attr('id');

        switch(clickedBtn){
            case 'viewForm1Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm1('view', selectedEntityId)
                break;
            case 'viewForm2Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm2('view', selectedEntityId)
                break;
            case 'viewForm3Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm3('view', selectedEntityId)
                break;
            case 'viewForm4Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm4('view', selectedEntityId)
                break;
            case 'viewForm5Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm5('view', selectedEntityId)
                break;
            case 'viewForm6Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm6('view', selectedEntityId)
                break;
            case 'viewForm7Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm7('view', selectedEntityId)
                break;
            case 'viewForm8Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm8('view', selectedEntityId)
                break;
            case 'viewForm9Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm9('view', selectedEntityId)
                break;
            case 'viewForm10Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm10('view', selectedEntityId)
                break;
            case 'viewForm11Link':
                selectedEntityId = $(this).attr('data-entity-id');
                openForm11('view', selectedEntityId)
                break;
            case 'viewForm12Link':
                openForm12('view');
                break;

        }

    });

    function openForm1(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form1Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId,
            eopType:        '<?php echo($EOP_type); ?>'
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm1Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
    }

    function openForm2(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form2Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm2Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
    }

    function openForm3(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form3Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm3Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
    }

    function openForm4(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form4Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm4Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
    }

    function openForm5(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form5Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm5Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
    }

    function openForm6(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form6Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm6Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
    }

    function openForm7(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form7Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm7Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
    }

    function openForm8(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form8Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm8Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
    }

    function openForm9(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form9Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm9Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
    }

    function openForm10(mode, id){

        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form10Div");

        var formData ={
            ajax:           '1',
            action:         mode,
            entityId:       entityId
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm10Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
    }

    function openForm11(mode, id){
        var entityId = (typeof id === 'undefined') ? null : id;
        var divContainer = $("#form11Div");

        var formData = {
            ajax:       '1',
            action:     mode,
            entityId:   entityId
        };

        $.ajax({
            url:    '<?php echo(base_url('plan/loadForm11Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');
                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }
        });
    }

    function openForm12(mode){
        var divContainer = $("#form12Div");

        var formData = {
            ajax:       '1',
            action:     mode
        };

        $.ajax({
            url:    '<?php echo(base_url('files/loadForm12Ctls')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $(divContainer).html(response);
                    $('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');
                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }
        });
    }

</script>
