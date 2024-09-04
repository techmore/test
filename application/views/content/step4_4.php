<?php
$entities = $page_vars['entities'];

$stateEntities      = array();
$districtEntities   = array();
$schoolEntities     = array();

// Break the entities into groups depending on mandate
foreach($page_vars['entities'] as $key=>$entity){
    if($entity['mandate']=='state'){
        array_push($stateEntities, $entity);
    }elseif($entity['mandate']=='district'){
        array_push($districtEntities, $entity);
    }else{
        array_push($schoolEntities, $entity);
    }
}

$groupedEntities = array(
    'state'     => $stateEntities,
    'district'  => $districtEntities,
    'school'    => $schoolEntities
);

?>

<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Add/Edit Courses of Action for Functions"; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Develop Courses of Action for Functions</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step4_4"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>

<div class="col-half left">
    <p><a href="#" class="bt" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">Courses of action</a> should read as a specific set of steps or instructions that individuals with different  roles and responsibilities should take in order to accomplish established <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a> and <a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>. Courses  of action should provide answers to the following questions:</p>
    <blockquote>
        <ul class="indented-40">

                <li>What is the action?</li>
                <li>Who is responsible for the action?</li>
                <li>When does the action take place?</li>
                <li>How long does the action take, and how much  time is actually available?</li>
                <li>What has to happen before?</li>
                <li>What happens after?</li>
                <li>What resources are needed to perform the  action?</li>
                <li>How will this action affect specific  populations, such as individuals with disabilities and others with access and  functional needs who may require medication, wayfinding, evacuation or personal  assistance services, or who may experience severe anxiety during traumatic  events?</li>

        </ul>
    </blockquote>
    <p>It is now time to develop courses of action for the <a href="#" class="bt" title="Functions are activities that apply to more than one threat or hazard.">functions</a> that your planning team identified in Step 3. As your team may recall, Step 3 prompted your team to develop goals and objectives and then to categorize those as functions or as specific to the threat or hazard. The list of functions your team identified, and the goals and objectives supporting those functions, may be found below.</p>
    <p>Please click on the Add button for each function below. In the space indicated, write out courses of action that accomplish the goals and objectives that your team previously established. After completing the courses of action fields for the selected function, click the Save button. Repeat this process for the remaining functions.</p>
    <p>If your team has already developed courses of action for a function and wishes to modify the information, please click the Edit button for the respective function. Pre-populated fields will appear with previously saved information. After editing the available fields, click the Update button. Repeat this process, as needed.</p>
</div>

<?php endif; ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Develop Courses of Action for Functions"; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Develop Courses of Action for Functions</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step4_4"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>

<div class="col-half left">
    <p><a href="" class="bt" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">Courses of action</a>&nbsp;should present specific steps or instructions that individuals with different roles and responsibilities should take to accomplish established&nbsp;<a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a>&nbsp;and&nbsp;<a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>. Courses of action should answer the following questions:</p>
<blockquote>
    <ul class="indented-40">

    <li>What is the action?</li>
    <li>Who is responsible for the action?</li>
    <li>When does the action take place?</li>
    <li>How long does the action take, and how much time is actually available?</li>
    <li>What has to happen before?</li>
    <li>What happens after?</li>
    <li>What resources are needed to perform the action?</li>
    <li>How will this action affect specific populations, such as individuals from diverse religious, racial, and ethnic backgrounds; individuals with limited English proficiency; individuals with cognitive and/or physical disabilities; individuals with mental health needs; and individuals with disabilities and others with access and functional needs. What resources are best to support these individuals?</li>

</ul>
	</blockquote>

<p>Now you will support school core planning teams in developing customized, site-specific courses of action that address&nbsp;<a href="#" class="bt" title="Functions are activities that apply to more than one threat or hazard.">functions</a>. One strategy is to create a model set or minimum set of courses of action. You can provide information on the feasibility, capabilities, and limitations of these courses of action for your schools. Another strategy is to work directly with school core planning teams to ensure that courses of action are coordinated across the district. Finally, you can inform schools about the support, services, and functions the district will provide in certain scenarios.</p>
<p>As your district develops policies and procedures for developing courses of action, consider the degree to which you will provide guidance, training, support, and examples or minimum requirements to schools. Also consider how you will help ensure that there are enough site-specific details and that courses of action are coordinated across schools. Finally, consider to what extent you will prepare courses of action for the support, services, and functions the district will supply to schools in any given scenario. </p>
</div>

<?php endif; ?>

<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>
    <h1><?php echo($_title); ?></h1>
	
	<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
	<table class="thform">
		<tr>
			<td>
				<p>To add school-specific courses of action, click Add for each function below. In the space indicated, enter courses of action that accomplish the goals and objectives that your team or the school core planning team established. After completing the courses of action fields for the selected function, click Save. Repeat this process for the remaining functions.</p>
<p>To modify already developed courses of action, click Edit for the chosen function. Pre-populated fields will appear with previously saved information. After editing, click Update. Repeat this process as needed.</p>
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<?php endif; ?>

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


    <div id="goalFirstDivToRefresh">
        <?php foreach($groupedEntities as $groupName => $entityGroup): ?>
            <?php if($entityGroup && count($entityGroup)>0): ?>

                <hr class="<?=($groupName=='state')? 'stateHR' : (($groupName=='district')? 'districtHR' : 'schoolHR')?>" />
                <?php if($groupName=='state') : ?>      <h2 id="stateTableTitle">   State Master List of Functions</h2> <?php endif; ?>
                <?php if($groupName=='district') : ?>   <h2 id="districtTableTitle">School District Master List of Functions</h2> <?php endif; ?>
                <?php if($groupName=='school') : ?>     <h2 id="schoolTableTitle">  School Customized List of Functions</h2> <?php endif; ?>
                <table class="results threats-hazards <?=($groupName=='state')? 'stateTable' : (($groupName=='district')? 'districtTable' : 'schoolTable')?>">
                    <tr>
                        <th scope="col">Functions</th>
                        <th scope="col">
                            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL):?>
                                Applicable to
                            <?php else: ?>
                                Developed by
                            <?php endif; ?>
                        </th>
                        <th scope="col">Courses of Action</th>
                    </tr>
                    <?php

                    $eligibleEntities = array();

                    foreach($entityGroup as $key=>$value){
                        foreach($value['children'] as $child){
                            if($child['type']=='g1' || $child['type']=='g2' || $child['type']=='g3'){
                                foreach($child['children'] as $grandChild){
                                    foreach($grandChild['fields'] as $field){
                                        if(isset($field['body']) && !empty($field['body'])){
                                            array_push($eligibleEntities, $value);
                                            break 3;
                                        }
                                    }
                                }
                            }

                        }

                    }

                    ?>

                    <?php foreach($eligibleEntities as $key=>$value): ?>
                        <tr>
                            <td><?php echo $value['name']; ?></td>
                            <td>
                                <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL){
                                    echo (($value['mandate']=='state') ? 'All School EOPs in State' : 'Only Sample School EOP for State Team');
                                }else{
                                    echo("<span style='text-transform: capitalize'>".$value['mandate']."</span>");
                                }
                                ?>
                            </td>
                            <td align="center">

                                <?php
                                $mode = 'add';
                                ?>
                                <?php foreach($value['children'] as $child): ?>
                                    <?php if($child['type']=='g1' || $child['type']=='g2' || $child['type']=='g3'): ?>
                                        <?php foreach($child['children'] as $grandChild): ?>
                                            <?php if($grandChild['type']=="ca"): ?>
                                                <?php foreach($grandChild['fields'] as $field): ?>
                                                    <?php if(isset($field['body']) && !empty($field['body'])): ?>
                                                        <?php
                                                        //Change the mode variable to edit and exit from all the loops
                                                        $mode = 'edit';
                                                        break 3;
                                                        ?>
                                                    <?php else: ?>
                                                        <?php //Don't alter the $mode variable ?>
                                                    <?php endif;?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                                    <?php if($mode=='add'):?>
                                        <?php if(
                                                    ($value['mandate'] == 'state' && $this->session->userdata['role']['level'] > STATE_ADMIN_LEVEL) ||
                                                    ($value['mandate'] == 'district' && $this->session->userdata['role']['level'] > DISTRICT_ADMIN_LEVEL)
                                                ): ?>
                                            <?php if($value['copy']==YES): ?>
                                                <a href="#" id="<?php echo $value['id'];?>" class="addFnActionLink" data-mandate="<?=$value['mandate']?>">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                                                <?php else: ?>
                                                    <span class="empty">No Data</span>
                                            <?php endif; ?>

                                            <?php else: ?>
                                                <a href="#" id="<?php echo $value['id'];?>" class="addFnActionLink" data-mandate="<?=$value['mandate']?>">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                                        <?php endif; ?>

                                    <?php else: ?>
                                        <?php if(
                                                    ($value['mandate'] == 'state' && $this->session->userdata['role']['level'] > STATE_ADMIN_LEVEL) ||
                                                    ($value['mandate'] == 'district' && $this->session->userdata['role']['level'] > DISTRICT_ADMIN_LEVEL)
                                                ): ?>
                                            <?php if($value['copy']==YES): ?>
                                                <a href="#" id="<?php echo $value['id'];?>" class="editFnActionLink" data-mandate="<?=$value['mandate']?>">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                                                <?php else: ?>
                                                    <a href="#" id="<?php echo $value['id'];?>" class="viewFnActionLink" data-mandate="<?=$value['mandate']?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                                            <?php endif; ?>

                                            <?php else: ?>
                                                <a href="#" id="<?php echo $value['id'];?>" class="editFnActionLink" data-mandate="<?=$value['mandate']?>">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if($mode=='add'): ?>
                                        <span class="empty">No Data</span>
                                    <?php else: ?>
                                        <a href="#" id="<?php echo $value['id'];?>" class="viewFnActionLink" data-mandate="<?=$value['mandate']?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="display: none;">
                                <div class="fieldsContainer" title="Add/Edit Courses of Action for Functions" id="container-<?php echo $value['id'];?>"></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>



<script type='text/javascript'>

    var selectedId;

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step5/1')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step4/3')); ?>"); //Previous

        var divDialog = null;


        $(".addFnActionLink").click(function(){

            selectedId = $(this).attr('id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);
            var mandate = $(this).attr('data-mandate');


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'add'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadFNActionCtrls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        /*$('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');*/

                        divDialog = $(divContainer).dialog({
                            resizable:      false,
                            minWidth:       500,
                            width:          '80%',
                            modal:          true,
                            autoOpen:       false,
                            dialogClass:    'eopDialog',
                            buttons: {
                                Save: function(){

                                    saveData();
                                },
                                Cancel: function() {
                                    cancelDialog();
                                }
                            },
                            close: function(event, ui){
                                cancelDialog();
                            },
                            show:           {
                                effect:     'scale',
                                duration: 300
                            }
                        });

                        divDialog.dialog('option', 'dialogClass', 'eopDialog '+mandate+'Dialog');
                        divDialog.dialog('open');

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
        });

        $(".editFnActionLink").click(function(){

            selectedId = $(this).attr('id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);
            var mandate = $(this).attr('data-mandate');


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'update'
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadFNActionCtrls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        /*$('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');*/

                        divDialog = $(divContainer).dialog({
                            resizable:      false,
                            minWidth:       500,
                            width:          '80%',
                            modal:          true,
                            autoOpen:       false,
                            dialogClass:    'eopDialog',
                            buttons: {
                                Save: function(){

                                    updateData();
                                },
                                Cancel: function() {
                                    cancelDialog();
                                }
                            },
                            close: function(event, ui){
                                cancelDialog();
                            },
                            show:           {
                                effect:     'scale',
                                duration: 300
                            }
                        });

                        divDialog.dialog('option', 'dialogClass', 'eopDialog '+mandate+'Dialog');
                        divDialog.dialog('open');

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
        });

        $(".viewFnActionLink").click(function(){

            selectedId = $(this).attr('id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);
            var mandate = $(this).attr('data-mandate');


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'view'
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadFNActionCtrls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        /*$('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');*/

                        divDialog = $(divContainer).dialog({
                            resizable:      false,
                            minWidth:       500,
                            width:          '80%',
                            modal:          true,
                            autoOpen:       false,
                            dialogClass:    'eopDialog',
                            buttons: {

                                Cancel: function() {
                                    cancelDialog();
                                }
                            },
                            close: function(event, ui){
                                cancelDialog();
                            },
                            show:           {
                                effect:     'scale',
                                duration: 300
                            }
                        });

                        divDialog.dialog('option', 'dialogClass', 'eopDialog '+mandate+'Dialog');
                        divDialog.dialog('open');

                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
        });


        function saveData(){

            var g1Element       = $("#txtg1ca");
            var g2Element       = $("#txtg2ca");
            var g3Element       = $("#txtg3ca");

            var FNid            = $('#entity_identifier').val();
            var g1Id            = g1Element.attr("data-goal-id");
            var g1CAData        = g1Element.val();

            var g2Id            = g2Element.attr("data-goal-id");
            var g2CAData        = g2Element.val();

            var g3Id            = g3Element.attr("data-goal-id");
            var g3CAData        = g3Element.val();

            var mode = $('#action_identifier').val();

            var formData = {
                ajax:   '1',
                FNid:   FNid,
                mode:   mode,

                g1Id:       g1Id,
                g1CAData:   g1CAData,

                g2Id:       g2Id,
                g2CAData:   g2CAData,

                g3Id:       g3Id,
                g3CAData:   g3CAData
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/manageFNActions')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        //alert(response);
                        location.reload();
                    }catch(err){
                        alert('Problem loading controls '+err);
                    }
                }

            });

            selectedId = $('#entity_identifier').val();
            var divContainer = $("#container-"+selectedId);

            divDialog.dialog('close');

            divContainer.html('');

            return false;

        }


        function updateData(){
            var g1Element       = $("#txtg1ca");
            var g2Element       = $("#txtg2ca");
            var g3Element       = $("#txtg3ca");

            var FNid            = $('#entity_identifier').val();
            var g1Id            = g1Element.attr("data-goal-id");
            var g1FieldId       = g1Element.attr("data-field-id");
            var g1CAData        = g1Element.val();

            var g2Id            = g2Element.attr("data-goal-id");
            var g2FieldId       = g2Element.attr("data-field-id");
            var g2CAData        = g2Element.val();

            var g3Id            = g3Element.attr("data-goal-id");
            var g3FieldId       = g3Element.attr("data-field-id");
            var g3CAData        = g3Element.val();

            var mode = $('#action_identifier').val();

            var formData = {
                ajax:   '1',
                FNid:   FNid,
                mode:   mode,

                g1Id:       g1Id,
                g1FieldId:  g1FieldId,
                g1CAData:   g1CAData,

                g2Id:       g2Id,
                g2FieldId:  g2FieldId,
                g2CAData:   g2CAData,

                g3Id:       g3Id,
                g3FieldId:  g3FieldId,
                g3CAData:   g3CAData
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/manageFNActions')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        //alert(response);
                        location.reload();
                    }catch(err){
                        alert('Problem loading controls '+err);
                    }
                }

            });

            selectedId = $('#entity_identifier').val();
            var divContainer = $("#container-"+selectedId);

            divDialog.dialog('close');
            divDialog.dialog('destroy');

            divContainer.html('');

            return false;

        }

        function cancelDialog(){

            selectedId = $('#entity_identifier').val();
            var divContainer = $("#container-"+selectedId);

            divDialog.dialog('close');
            divDialog.dialog('destroy');

            divContainer.html('');

            return false;
        }

    }); // End $(document).ready function

</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>
