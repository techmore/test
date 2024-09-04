<?php

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
<?php $_title ="Edit Threat- and Hazard-Specific Annexes"; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Prepare the Draft EOP: Threat- and Hazard-Specific Annexes</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step5_2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>

<div class="col-half left">
    <p>Your  planning team already completed most of the work for the <a href="#" class="bt" title="The Threat- and Hazard-Specific Annexes section specifies the goals, objectives, and courses of action that a school will follow to address a particular type of threat or hazard (e.g., hurricane, active shooter). Threat- and hazard-specific annexes, like functional annexes, set forth how the school manages a function before, during, and after an emergency.">threat-and hazard-specific annexes</a> in  Step 3 and Step 4, when your team identified <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a>,<a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals."> objectives</a>, and <a href="#" class="bt" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">courses of action</a> for threats and hazards. At this stage, your team will be prompted to edit the  text already developed for each threat or hazard and then format accordingly for inclusion in the draft EOP.</p>
    <p>A  recommended format for presenting information in each of the annexes is as  follows:</p>
    <ul class="indented-40">

            <li>Title (the threat or hazard)</li>
            <li>Goal(s)</li>
            <li>Objective(s)</li>
            <li>Courses of Action (Describe the courses of  action you developed in Step 4 in the sequence in which they should occur.)</li>
        
    </ul>
    <p><br/>
        To edit and format the content for each of your annexes, please click on the corresponding Edit button. Revise the text as necessary in the designated fields. It is likely that some of your courses of action will reference cross-cutting functions. In those cases, it is recommended that you add a note that additional information on a particular function may be found in the corresponding Functional Annex. Click the Update button to create a coherent Threat- and Hazard-Specific Annex.</p>
</div>

<?php endif; ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Revise Threat- and Hazard-Specific Annexes"; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Revise the Formatted Draft: Threat- and Hazard-Specific Annexes</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step5_2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>

<div class="col-half left">
    <p>Most of the work for the&nbsp;<a href="#" class="bt" title="The Threat- and Hazard-Specific Annexes section specifies the goals, objectives, and courses of action that a school will follow to address a particular type of threat or hazard (e.g., hurricane, active shooter). Threat- and hazard-specific annexes, like ">threat-and hazard-specific annexes</a>&nbsp;was completed in Step 3 and Step 4, when your team identified districtwide&nbsp;<a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a> and<a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">&nbsp;objectives</a> for districtwide threats and hazards. At this stage, you will help school core planning teams revise the formatted threat- and hazard-specific annexes according to writing conventions. This may be completed by assisting with technical writing, contributing important information, and providing a list of points of contact for inclusion in the draft EOPs.</p>
<p>When developing policies and procedures, consider the extent to which you will provide assistance, training, guidance, feedback on early drafts, and districtwide plan content. Also consider how much you will help school core planning teams connect with and acquire stakeholder feedback on draft EOPs. Furthermore, consider the required accessible formats and languages in which the draft EOPs should be made available.</p>
</div>

<?php endif; ?>

<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>
    <h1><?php echo($_title); ?></h1>
	
	<?php if($this->session->userdata['role']['level']==DISTRICT_ADMIN_LEVEL): ?>
	<table class="thform"><tr><td><p>To edit and format the content for each annex, click on the corresponding Edit button. Revise the text as necessary in the designated fields. It is likely that some of your courses of action will reference crosscutting functions. In those cases, it is recommended that you add a note that additional information on a particular function may be found in the corresponding Functional Annex. Click the Update button to create a coherent Threat- and Hazard-Specific Annex.</p></td></tr></table>
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
                <?php if($groupName=='state') : ?>      <h2 id="stateTableTitle">   State Master List of Threats and Hazards</h2> <?php endif; ?>
                <?php if($groupName=='district') : ?>   <h2 id="districtTableTitle">School District Master List of Threats and Hazards</h2> <?php endif; ?>
                <?php if($groupName=='school') : ?>     <h2 id="schoolTableTitle">  School Customized List of Threats and Hazards</h2> <?php endif; ?>
                <table class="results <?=($groupName=='state')? 'stateTable' : (($groupName=='district')? 'districtTable' : 'schoolTable')?>">
                    <tr>
                        <th scope="col">Threats and Hazards</th>
                        <th scope="col">Annexes</th>
                    </tr>

                    <?php

                        $eligibleEntities = array();

                        foreach($entityGroup as $key=>$value){
                            foreach($value['children'] as $child){
                                if($child['type']=='g1' || $child['type']=='g2' || $child['type']=='g3'){
                                    foreach($child['children'] as $grandChild){
                                        if($grandChild['type']=='ca') {
                                            foreach ($grandChild['fields'] as $field) {
                                                if (isset($field['body']) && !empty($field['body'])) {
                                                    array_push($eligibleEntities, $value);
                                                    break 3;
                                                }
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
                            <td align="center">
                                <?php if($value['description'] == 'live' && !empty($value['description'])): ?>
                                    <?php if($this->session->userdata['role']['read_only']=='n') { ?>

                                        <?php if(
                                                    ($value['mandate'] == 'state' && $this->session->userdata['role']['level'] > STATE_ADMIN_LEVEL) ||
                                                    ($value['mandate'] == 'district' && $this->session->userdata['role']['level'] > DISTRICT_ADMIN_LEVEL)
                                                ): ?>
                                            <?php if($value['copy']==YES): ?>
                                                <a href="#" id="<?php echo($value['id']); ?>" class="editFieldsLink" data-mandate="<?=$value['mandate']; ?>">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                                                <?php else: ?>
                                                <a href="#" id="<?php echo $value['id'];?>" class="viewFieldsLink" data-mandate="<?=$value['mandate']; ?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                                            <?php endif; ?>

                                            <?php else: ?>
                                            <a href="#" id="<?php echo($value['id']); ?>" class="editFieldsLink" data-mandate="<?=$value['mandate']; ?>">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                                        <?php endif; ?>

                                    <?php
                                    }else{ ?>
                                        <a href="#" id="<?php echo $value['id'];?>" class="viewFieldsLink" data-mandate="<?=$value['mandate']; ?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                                    <?php } ?>
                                <?php else: ?>
                                    <a href="#" id="<?php echo $value['id'];?>" class="viewFieldsLink" data-mandate="<?=$value['mandate']; ?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="display: none;">
                                <div class="fieldsContainer" title="Edit Threat- and Hazard-Specific Annexes" id="container-<?php echo $value['id'];?>"></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<div id="new-fn-dialog" title="Create Custom Function">
    <?php $this->load->view('forms/function'); ?>
</div>



<script type='text/javascript'>

    var selectedId;

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step5/3')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step5/1')); ?>"); //Previous

        var divDialog = null;


        $(".editFieldsLink").click(function(){

            selectedId = $(this).attr('id');

            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);
            var mandate = $(this).attr('data-mandate');


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'edit',
                showActions: '1'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadTHCtls')); ?>',
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
                            dialogClass:    'eopDialog '+$(this).attr('data-mandate')+'Dialog',
                            buttons: {
                                "Save": function(){

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

        $(".viewFieldsLink").click(function(){

            selectedId = $(this).attr('id');

            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);
            var mandate = $(this).attr('data-mandate');


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'view',
                showActions: '1'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadTHCtls')); ?>',
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
                            dialogClass:    'eopDialog '+$(this).attr('data-mandate')+'Dialog',
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

            var validateError = false;
            var focusElement;

            <?php for($i=1; $i<=3; $i++): ?>
                var g<?php echo($i);?>ObjData = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                    return [$(value).val()];
                });
                var g<?php echo($i);?>ObjIds = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                    return [$(value).attr('data-id')];
                });
                var g<?php echo($i);?>ObjFieldIds = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                    return [$(value).attr('data-field-id')];
                });
                var g<?php echo($i);?>fnData = $.map($("select.g<?php echo($i);?>fn option:selected"), function(value, index) {
                    return [$(value).text().trim()];
                });
                var g<?php echo($i);?>fnVal = $.map($("select.g<?php echo($i);?>fn option:selected"), function(value, index) {
                    if($(value).val()) {
                        return [$(value).val()];
                    }else{
                        $(value).parent().addClass("error");
                        focusElement = $(value).parent();
                        validateError = true;
                        return;
                    }
                });

            //New Data
                var g<?php echo($i);?>fnDataNew = $.map($("select.g<?php echo($i);?>fnNew option:selected"), function(value, index) {
                    if($(value).val()) {
                        return [$(value).text().trim()];
                    }else{
                        $(value).parent().addClass("error");
                        focusElement = $(value).parent();
                        validateError = true;
                        return;
                    }
                });
                var g<?php echo($i);?>ObjDataNew = $.map($(".g<?php echo($i);?>ObjNew"), function(value, index) {
                    return [$(value).val()];
                });
            <?php endfor; ?>


            if( $('#slctg1fn').val()) {
                //Do nothing
            }
            else{

                $('#slctg1fn').addClass("error");
                focusElement = $('#slctg1fn');
                validateError = true;
            }

            if( $('#slctg2fn').val()){
                //Do nothing
            }
            else{
                $('#slctg2fn').addClass("error");
                focusElement = $('#slctg2fn');
                validateError = true;
            }

            if($('#slctg3fn').val()){
                //Do nothing
            } else{
                $('#slctg3fn').addClass("error");
                focusElement = $('#slctg3fn');
                validateError = true;
            }

            selectedId = $('#entity_identifier').val();
            var mode = $('#action_identifier').val();
            var g1TxtCtl = $('#txtg1');
            var g2TxtCtl = $('#txtg2');
            var g3TxtCtl = $('#txtg3');


            var g1Element       = $("#txtg1ca");
            var g2Element       = $("#txtg2ca");
            var g3Element       = $("#txtg3ca");

            var g1CAFieldId     = g1Element.attr("data-field-id");
            var g1CAData        = g1Element.val();

            var g2CAFieldId     = g2Element.attr("data-field-id");
            var g2CAData        = g2Element.val();

            var g3CAFieldId     = g3Element.attr("data-field-id");
            var g3CAData        = g3Element.val();

            if(validateError){
                alert('Please select a function');
                $(focusElement).focus();
                return false;
            }else {
                var formData = {
                    ajax: '1',
                    id: selectedId,
                    mode: mode,
                    action: 'save',
                    coursesOfActions: '1',
                    g1ObjData: g1ObjData,
                    g2ObjData: g2ObjData,
                    g3ObjData: g3ObjData,
                    g1ObjIds: g1ObjIds,
                    g2ObjIds: g2ObjIds,
                    g3ObjIds: g3ObjIds,
                    g1ObjFieldIds: g1ObjFieldIds,
                    g2ObjFieldIds: g2ObjFieldIds,
                    g3ObjFieldIds: g3ObjFieldIds,
                    g1Id: g1TxtCtl.attr('data-id'),
                    g2Id: g2TxtCtl.attr('data-id'),
                    g3Id: g3TxtCtl.attr('data-id'),
                    g1FieldId: g1TxtCtl.attr('data-field-id'),
                    g2FieldId: g2TxtCtl.attr('data-field-id'),
                    g3FieldId: g3TxtCtl.attr('data-field-id'),
                    g1: g1TxtCtl.val(),
                    g2: g2TxtCtl.val(),
                    g3: g3TxtCtl.val(),
                    fn1: $('#slctg1fn').val(),
                    fn2: $('#slctg2fn').val(),
                    fn3: $('#slctg3fn').val(),
                    fn1Txt: $('select#slctg1fn option:selected').text().trim(),
                    fn2Txt: $('select#slctg2fn option:selected').text().trim(),
                    fn3Txt: $('select#slctg3fn option:selected').text().trim(),
                    fn1Val: $('select#slctg1fn option:selected').val(),
                    fn2Val: $('select#slctg2fn option:selected').val(),
                    fn3Val: $('select#slctg3fn option:selected').val(),
                    g1fnData: g1fnData,
                    g2fnData: g2fnData,
                    g3fnData: g3fnData,
                    g1fnVal: g1fnVal,
                    g2fnVal: g2fnVal,
                    g3fnVal: g3fnVal,
                    g1ObjDataNew: g1ObjDataNew,
                    g2ObjDataNew: g2ObjDataNew,
                    g3ObjDataNew: g3ObjDataNew,
                    g1fnDataNew: g1fnDataNew,
                    g2fnDataNew: g2fnDataNew,
                    g3fnDataNew: g3fnDataNew,

                    g1CAFieldId: g1CAFieldId,
                    g1CAData: g1CAData,

                    g2CAFieldId: g2CAFieldId,
                    g2CAData: g2CAData,

                    g3CAFieldId: g3CAFieldId,
                    g3CAData: g3CAData

                };

                $.ajax({
                    url: '<?php echo(base_url('plan/manageTHGoals')); ?>',
                    data: formData,
                    type: 'POST',
                    success: function (response) {

                        try {
                            //alert(response);
                            location.reload();

                        } catch (err) {
                            alert('Problem loading controls ' + err);
                        }
                    }

                });

            }

            selectedId = $('#entity_identifier').val();

            divDialog.dialog("close");

            var divContainer = $("#container-"+selectedId);
            divContainer.html('');


            return false;
        }

        function cancelDialog(){

            selectedId = $('#entity_identifier').val();

            divDialog.dialog("close");

            var divContainer = $("#container-"+selectedId);
            divContainer.html('');


            return false;
        }

        $(document).on('change','select', function(){

            if($(this).val() !=""){
                $(this).removeClass('error');
            }

            if($("option:selected", this).text().trim().toLowerCase()=="other"){
                $("#new-fn-dialog").dialog('open');
                return false;
            }

        });

        $("#new-fn-dialog").dialog({
            resizable:      false,
            minHeight:      150,
            minWidth:       500,
            modal:          true,
            autoOpen:       false,
            show:           {
                effect:     'scale',
                duration: 200
            },
            buttons: {
                "Save": function(){
                    $("#newFnForm").submit();
                },
                Cancel: function() {
                    $("#newFnForm")[0].reset();
                    $( this ).dialog( "close" );
                }
            }
        });

        $("#newFnForm").validate({
            submitHandler: submit_fn_form
        });

        function submit_fn_form(){
            var form_data={
                ajax: '1',
                txtfn: $('#txtfn').val()
            };
            $.ajax({
                url: "<?php echo base_url('plan/addFn'); ?>",
                type: 'POST',
                data: form_data,
                success: function(response) {
                    try{

                        var functions = JSON.parse(response);

                        var functionElements = $("select:not(#slctsubdistrictselection)");
                        $.each(functionElements, function(key, value){

                            var selectedOption = $(value).val();

                            $(value).empty();

                            $.each(functions, function (k, v) {

                                if(selectedOption == v.id){
                                    $(value).append($("<option></option>")
                                        .attr("value", v.id)
                                        .attr("selected", "selected")
                                        .text(v.name));
                                }else{
                                    $(value).append($("<option></option>")
                                        .attr("value", v.id)
                                        .text(v.name));
                                }

                            });
                            //Add the last option "Other"
                            $(value).append($("<option></option>")
                                .attr("value", "other")
                                .text("Other"));
                        });


                    }catch(err){
                        alert('Error adding function '+err);
                    }
                }
            });

            $("#newFnForm")[0].reset();
            $("#new-fn-dialog").dialog("close");
            return false;
        }


    }); // End $(document).ready function

</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>
