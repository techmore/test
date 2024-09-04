<?php
$entities = $page_vars['entities'];
$userRoleLevel = $this->session->userdata['role']['level'];

function isEditable($function, $roleLevel){
    $ret = false;

    if($roleLevel > DISTRICT_ADMIN_LEVEL){
        if( ($function['mandate'] == 'school' && $function['description']=='live') ||
            ($function['mandate'] == 'school' && $function['owner_role_level'] > DISTRICT_ADMIN_LEVEL) ||
            ($function['copy']==YES)){
            $ret = true;
        }
    }

    if($roleLevel == DISTRICT_ADMIN_LEVEL){
        if( ($function['mandate'] == 'district' && !$function['parent']) ||
            ($function['mandate'] == 'school' && !$function['parent'] && $function['owner_role_level']== DISTRICT_ADMIN_LEVEL) ||
            ($function['copy']==YES)){
            $ret = true;
        }
    }

    if($roleLevel == STATE_ADMIN_LEVEL){
        if( ($function['mandate'] == 'state' && !$function['parent']) ||
            ($function['mandate'] == 'school' && !$function['parent'] && $function['owner_role_level']== STATE_ADMIN_LEVEL)){
            $ret = true;
        }
    }

    return $ret;

}

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
<?php $_title ="Add/Edit Goals and Objectives for Functions"; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Develop Goals and Objectives for Functions</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_4"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>

<div class="col-half left">
    <p>After  identifying functions, the planning team should develop three&nbsp;goals&nbsp;and corresponding&nbsp;objectives&nbsp;for each function. As  with the goals already identified for threats and hazards, the three goals  should indicate the desired outcome for (1) before, (2) during, and (3) after  the function has been executed. The goals and objectives developed for these  functions will be carried forward to the next step in the planning process&mdash;Step  4&mdash;which will prompt your planning team to develop courses of action for  accomplishing the goals and objectives established here. Ultimately, the goals,  objectives, and courses of action developed for each function will form the  Functional Annexes section of your school EOP. &nbsp;</p>
    <p>Please use the table below to develop <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a> and <a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a> for each <a href="#" class="bt" title="Functions are activities that apply to more than one threat or hazard.">function</a>. If a function is not displayed below, then it has not been identified as a cross-cutting function on the previous page.</p>
    <p>Begin by clicking the Add button for the respective function, which will display empty fields. Then, type your goals and objectives into the designated fields. Use the Add More button, if your team needs to develop multiple objectives in support of a single goal. After completing all fields for the selected function, click the Save button. Repeat this process for the remaining functions.</p>
    <p>If your team wishes to edit goals and objectives that were previously entered, please click the Edit button for the respective function. Pre-populated fields will appear with previously saved information. After editing any of the available fields, click the Update button. Repeat this process, as needed.</p>
</div>

<?php endif; ?>

<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Identify Cross-Cutting Functions"; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Identify Cross-Cutting Functions and Develop Goals and Objectives for Cross-Cutting Functions</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_4"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>The cross-cutting functions that appeared in the goals and objectives in your master list of hazards and threats have been compiled on this page. Continue to add to the list of cross-cutting functions according to Federal, State, and local policies. The functions your team identifies here will eventually become Functional Annexes in your schools&rsquo; EOPs.</p>
<p>When developing policies and procedures related to identifying cross-cutting functions, consider which functions are most likely to support more than one type of emergency incident and which should be addressed by schools at a minimum. Also consider how often the list of functions should be updated based on recommendations, priorities, and lessons learned from the Federal, State, and local levels.</p>
<p>After identifying functions, your team should develop&nbsp;a master list of <a href="<?php echo(base_url('plan/step3/4')); ?>" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a>&nbsp;and&nbsp;<a href="<?php echo(base_url('plan/step3/4')); ?>" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>&nbsp;for each <a href="<?php echo(base_url('plan/step3/4')); ?>" title="Functions are activities that apply to more than one threat or hazard.">function</a><u> </u>included on the district list. Develop at least three&nbsp;goals&nbsp;and corresponding&nbsp;objectives&nbsp;for each districtwide function. As with the districtwide goals you identified for districtwide threats and hazards, the three goals should indicate the desired outcomes for (1) before, (2) during, and (3) after the function has been executed. The master list of goals and objectives for these functions will be carried forward to the next step in the planning process—Step 4—which will prompt your planning team to develop courses of action for accomplishing the goals and objectives. Ultimately, the goals, objectives, and courses of action developed for each function will form the Functional Annexes section of your schools&rsquo; EOPs.</p>
<p>When creating policies and procedures for developing goals and objectives for functions, consider applicable Federal, State, and local laws that might govern this task. Also consider the degree to which you will work with representatives from school core planning teams and what lessons learned, guidance, and recommendations from the Federal, State, and local levels will be used to develop districtwide goals and objectives.</p>
</div>

<?php endif; ?>
<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>

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

    <h1><?php echo($_title); ?></h1>
    <?php $this->load->view("forms/fn.php"); ?>
	
	<?php if($this->session->userdata['role']['level']==DISTRICT_ADMIN_LEVEL): ?>
	
	<h1>Identify Goals and Objectives for Cross-Cutting Functions</h1>
	<table class="thform">
		<tr><td>
			<p>Develop&nbsp;<a href="#" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a>&nbsp;and&nbsp;<a href="#" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>&nbsp;for each&nbsp;<a href="#" title="Functions are activities that apply to more than one threat or hazard.">function</a>. If a function is not displayed below, then it has not been identified as a cross-cutting function on the previous page.</p>
<p>Click Add for the chosen function, which will display empty fields. Type your goals and objectives into the designated fields. Use the Add More button if your team needs to develop multiple objectives in support of a single goal. After completing all fields for the selected function, click Save. Repeat this process for the remaining functions.</p>
<p>To edit existing goals and objectives, click Edit for the chosen function. Pre-populated fields will appear with previously saved information. After editing, click Update. Repeat this process as needed.</p>
		</td></tr></table>
	<p>&nbsp;</p>
	
	<?php endif; ?>
    


    <div id="goalFirstDivToRefresh">

        <?php foreach($groupedEntities as $groupName => $entityGroup): ?>

            <?php if($entityGroup && count($entityGroup)>0): ?>
                <hr class="<?=($groupName=='state')? 'stateHR' : (($groupName=='district')? 'districtHR' : 'schoolHR')?>" />
                <?php if($groupName=='state') : ?>      <h2 id="stateTableTitle">   State Master List of Cross Cutting Functions</h2> <?php endif; ?>
                <?php if($groupName=='district') : ?>   <h2 id="districtTableTitle">School District Master List of Cross Cutting Functions</h2> <?php endif; ?>
                <?php if($groupName=='school') : ?>     <h2 id="schoolTableTitle">  School Customized List of Cross Cutting Functions</h2> <?php endif; ?>
                <table class="results <?=($groupName=='state')? 'stateTable' : (($groupName=='district')? 'districtTable' : 'schoolTable')?>">
                    <tr>
                        <th scope="col" style="width:50%">Functions</th>
                        <th scope="col" style="width:25%">
                            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL):?>
                                Applicable to
                            <?php else: ?>
                                Developed by
                            <?php endif; ?>
                        </th>
                        <th scope="col" style="width:25%">Goals and Objectives</th>
                    </tr>

                    <?php foreach($entityGroup as $key=>$value): ?>
                        <tr>
                            <td>
                                <?php echo $value['name']; ?> &nbsp;

                                <?php if(isEditable($value, $userRoleLevel)): ?>
                                    <script>
                                        $('#<?php echo($value['ref_key']); ?>').hide();
                                    </script>
                                    <a class="update_fn" id="<?php echo($value['id']); ?>" data-name="<?php echo($value['name']); ?>" data-mandate="<?php echo($value['mandate']); ?>" href="#">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon" /></a> |
                                    <a href="#" data-id="<?php echo $value['id'];?>" class="deleteFnLink" data-mandate="<?=$value['mandate']?>"> Delete <img class="deleteIcon" src="<?php echo(base_url()); ?>assets/img/delete.png" alt="delete icon"/></a>

                                    <div title="Edit Function Name" class="updateFunctionContainer" id="updateFunctionContainer<?php echo($value['id']); ?>">
                                        <?php $this->load->view("forms/update_fn.php"); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if(($value['mandate']=='state' || $value['mandate']=='district') && $value['copy']==NO): ?>
                                    &nbsp;
                                    <a href='<?php echo(base_url());?>plan/copy/<?php echo($value['id']); ?>' id='<?php echo $value['ref_key']; ?>'> Copy</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL){
                                    echo (($value['mandate']=='state') ? 'All School EOPs in State' : 'Only Sample School EOP for State Team');
                                }else{
                                    echo("<span style='text-transform: capitalize'>".$value['mandate']."</span>");
                                }
                                ?>
                            </td>
                            <td align="center">
                                <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                                    <?php if(isset($value['children']) && count($value['children'])>0): ?>
                                        <?php if(
                                                    ($value['mandate'] == 'state' && $this->session->userdata['role']['level'] > STATE_ADMIN_LEVEL) ||
                                                    ($value['mandate'] == 'district' && $this->session->userdata['role']['level'] > DISTRICT_ADMIN_LEVEL)
                                                ): ?>
                                            <?php if($value['copy']==YES): ?>
                                                <a href="#" id="<?php echo $value['id'];?>" class="editFieldsLink" data-mandate="<?=$value['mandate']?>">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                                            <?php else: ?>
                                                    <a href="#" id="<?php echo $value['id'];?>" class="viewFieldsLink" data-mandate="<?=$value['mandate']?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                                            <?php endif; ?>

                                            <?php else: ?>
                                                <a href="#" id="<?php echo $value['id'];?>" class="editFieldsLink" data-mandate="<?=$value['mandate']?>">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                                        <?php endif; ?>

                                    <?php else: ?>
                                        <?php if(
                                                    ($value['mandate'] == 'state' && $this->session->userdata['role']['level'] > STATE_ADMIN_LEVEL) ||
                                                    ($value['mandate'] == 'district' && $this->session->userdata['role']['level'] > DISTRICT_ADMIN_LEVEL)
                                                ): ?>
                                            <?php if($value['copy']==YES): ?>
                                                <a href="#" id="<?php echo $value['id'];?>" class="addFieldsLink" data-title="<?=$value['name']?>" data-mandate="<?=$value['mandate']?>">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                                                <?php else: ?>
                                                    <span class="empty">No Data</span>
                                            <?php endif; ?>
                                            <?php else: ?>
                                                <a href="#" id="<?php echo $value['id'];?>" class="addFieldsLink" data-title="<?=$value['name']?>" data-mandate="<?=$value['mandate']?>">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if(isset($value['children']) && count($value['children'])>0): ?>
                                    <a href="#" id="<?php echo $value['id'];?>" class="viewFieldsLink" data-mandate="<?=$value['mandate']?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                                    <?php else: ?>
                                        <span class="empty">No Data</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr style="display:none;">
                            <td colspan="3">
                                <div class="fieldsContainer" title="Identify Goals and Objectives for Cross-Cutting Functions" id="container-<?php echo $value['id'];?>"></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>


</div>


<div id="delete_fn-dialog" title="Delete Function">
    <p style="margin-top:20px;"><strong>Are you sure you want to delete this function? </strong> <br /><br />Please note that all information associated with this function will be permanently deleted.</p>
</div>

<style>
    .updateFunctionContainer{
        display: none;
    }
</style>
<script type='text/javascript'>

    var selectedId;
    var fnNames = ["" <?php foreach($entities as $value): echo(",\"".$value['name']."\""); endforeach; ?>];

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step4/1')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step3/3')); ?>"); //Previous

        $("#rightArrowButton").click(function(){


        });

        $('.deleteFnLink').click(function(){
            selectedId = $(this).attr('data-id');

            deleteFnDialog.dialog('option', 'dialogClass', 'eopDialog '+$(this).attr('data-mandate')+'Dialog');
            deleteFnDialog.dialog('open');

            return false;

        });

        var deleteFnDialog = $( "#delete_fn-dialog" ).dialog({
            autoOpen: false,
            modal: true,
            resizable:  false,
            width: '40%',
            dialogClass: 'eopDialog',
            buttons: {
                "Delete": function(){
                    var form_data = {
                        ajax:       '1',
                        id:    selectedId
                    };
                    $.ajax({
                        url: "<?php echo base_url('plan/delete/entity/fn'); ?>",
                        type: 'POST',
                        data: form_data,
                        success: function(response){
                            var res = JSON.parse(response);
                            if(res.deleted==true){
                                //alert('deleted');
                                location.reload();
                            }
                            else{
                                location.reload();
                                //alert('delete failed');
                            }
                        }
                    });

                    $(this).dialog('close');
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            },
            show:           {
                effect:     'scale',
                duration: 300
            }
        });
        //$("#btnAddFunction").prop('disabled',false);

        /***** ADD EDIT VIEW *******/
        $(".addFieldsLink").click(function(){

             selectedId = $(this).attr('id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);
            var mandate = $(this).attr('data-mandate');
            var title = $(this).attr('data-title');


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'add'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadFNCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        $("#fnTitle").html(title);
                        $("td.goal_title").addClass(mandate+"Table");
                        /*$('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');*/

                        var divDialog = $(divContainer).dialog({
                            resizable:      false,
                            minWidth:       500,
                            width:          '80%',
                            modal:          true,
                            autoOpen:       false,
                            dialogClass:    'eopDialog',
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

        $(".editFieldsLink").click(function(){

            selectedId = $(this).attr('id');

            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);
            var mandate = $(this).attr('data-mandate');


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'edit'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadFNCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        /*$('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');*/

                        var divDialog = $(divContainer).dialog({
                            resizable:      false,
                            minWidth:       500,
                            width:          '80%',
                            modal:          true,
                            autoOpen:       false,
                            dialogClass:    'eopDialog',
                            buttons: {
                                "Update": function(){

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

            return false;
        });

        $(".viewFieldsLink").click(function(){

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
                url:    '<?php echo(base_url('plan/loadFNCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        /*$('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');*/

                        var divDialog = $(divContainer).dialog({
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

            return false;
        });

        function saveData(){

            <?php for($i=1; $i<=3; $i++): ?>

            //New Data
                var g<?php echo($i);?>ObjData = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                    return [$(value).val()];
                });
            <?php endfor; ?>

            selectedId = $('#entity_identifier').val();
            var mode = $('#action_identifier').val();
            var g1TxtCtl = $('#g1txt');
            var g2TxtCtl = $('#g2txt');
            var g3TxtCtl = $('#g3txt');


            var formData = {
                ajax:       '1',
                id:         selectedId,
                mode:     mode,
                action:     'save',
                g1ObjData:  g1ObjData,
                g2ObjData:  g2ObjData,
                g3ObjData:  g3ObjData,
                g1:         g1TxtCtl.val(),
                g2:         g2TxtCtl.val(),
                g3:         g3TxtCtl.val()
            };
            $.ajax({
                url:    '<?php echo(base_url('plan/manageFNGoals')); ?>',
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

            var divContainer = $("#container-"+selectedId);
            divContainer.html('');
            divContainer.dialog("close");
            divContainer.dialog("destroy");

            return false;
        }

        function updateData(){

            <?php for($i=1; $i<=3; $i++): ?>


            var g<?php echo($i);?>ObjData = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                return [$(value).val()];
            });
            var g<?php echo($i);?>ObjDataIds = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                return [$(value).attr('data-id')];
            });
            var g<?php echo($i);?>ObjFieldIds = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
                return [$(value).attr('data-field-id')];
            });

            //New Data
            var g<?php echo($i);?>ObjDataNew = $.map($(".g<?php echo($i);?>ObjNew"), function(value, index) {
                return [$(value).val()];
            });
            <?php endfor; ?>

            selectedId = $('#entity_identifier').val();
            var mode = $('#action_identifier').val();
            var g1TxtCtl = $('#txtg1');
            var g2TxtCtl = $('#txtg2');
            var g3TxtCtl = $('#txtg3');

            var formData = {
                ajax:       '1',
                id:         selectedId,
                mode:     mode,
                action:     'update',
                g1ObjDataNew:  g1ObjDataNew,
                g2ObjDataNew:  g2ObjDataNew,
                g3ObjDataNew:  g3ObjDataNew,

                g1:         g1TxtCtl.val(),
                g2:         g2TxtCtl.val(),
                g3:         g3TxtCtl.val(),

                g1Id:       g1TxtCtl.attr('data-id'),
                g2Id:       g2TxtCtl.attr('data-id'),
                g3Id:       g3TxtCtl.attr('data-id'),

                g1FieldId:  g1TxtCtl.attr('data-field-id'),
                g2FieldId:  g2TxtCtl.attr('data-field-id'),
                g3FieldId:  g3TxtCtl.attr('data-field-id'),

                g1ObjData:  g1ObjData,
                g2ObjData:  g2ObjData,
                g3ObjData:  g3ObjData,

                g1ObjIds:   g1ObjDataIds,
                g2ObjIds:   g2ObjDataIds,
                g3ObjIds:   g3ObjDataIds,

                g1ObjFieldIds: g1ObjFieldIds,
                g2ObjFieldIds: g2ObjFieldIds,
                g3ObjFieldIds: g3ObjFieldIds

            };

            $.ajax({
                url:    '<?php echo(base_url('plan/manageFNGoals')); ?>',
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

            var divContainer = $("#container-"+selectedId);
            divContainer.html('');
            divContainer.dialog("close");
            divContainer.dialog("destroy");

            return false;
        }

        function cancelDialog(){

            selectedId = $('#entity_identifier').val();

            var divContainer = $("#container-"+selectedId);
            divContainer.html('');
            divContainer.dialog("close");
            divContainer.dialog("destroy");

            return false;
        }

        /**
         * Validate FN Form Management
         */
        $("#fnManagementForm").validate({
            rules:{
                txtfn:{
                    notIn: function(){ return fnNames; }
                }
            }
        });


        $.validator.addMethod("notIn", function(value, element, params) {
                return ! (params.indexOf(value) > -1);
            }, "A function with that name already exists!"
        );
        
        
        /*
        $(document).on('click', '#btnAddFunction', function(e){

            $('#addFunctionContainer').slideToggle("slow", function(){
                $('#btnAddFunction').prop('disabled', true);
                $('#btnfnreset').click(function(e){
                    $('#addFunctionContainer').hide();
                    $('#btnAddFunction').prop('disabled', false);
                });
            });

        });
        */

        $(document).on('click', '.update_fn', function(e){
            var selectedFunctionId      = $(e.target).attr('id');
            var selectedFunctionName    = $(e.target).attr('data-name');
            var selectedFunctionMandate = $(e.target).attr('data-mandate');
            var fnUpdateContainer = $("#updateFunctionContainer"+selectedFunctionId);

            <?php $checkbox_value = ($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL) ? 'state' : 'district'; ?>

            $("#updateFunctionContainer"+selectedFunctionId+" form.updatefnManagementForm input[name='id']").val(selectedFunctionId);
            $("#updateFunctionContainer"+selectedFunctionId+" .updatetxtfn").val(selectedFunctionName);

            if(selectedFunctionMandate !='school'){
                $("#updateFunctionContainer"+selectedFunctionId+" form.updatefnManagementForm input[name='checkbox_update_fn_mandate']").val(selectedFunctionMandate);
                $("#updateFunctionContainer"+selectedFunctionId+" form.updatefnManagementForm input[name='checkbox_update_fn_mandate']").prop('checked', true);
            }else{
                $("#updateFunctionContainer"+selectedFunctionId+" form.updatefnManagementForm input[name='checkbox_update_fn_mandate']").val('<?php echo($checkbox_value); ?>');
                $("#updateFunctionContainer"+selectedFunctionId+" form.updatefnManagementForm input[name='checkbox_update_fn_mandate']").prop('checked', false);
            }


            //$("#updateFunctionContainer"+selectedFunctionId).show();

            var editFnNameDialog = fnUpdateContainer.dialog({
                autoOpen: false,
                modal: true,
                resizable:  false,
                width: '40%',
                dialogClass: 'eopDialog',
                buttons: {
                    Save: function(){

                        $("#updateFunctionContainer"+selectedFunctionId +" form.updatefnManagementForm").submit();

                    },
                    Reset: function(){
                        $("#updateFunctionContainer"+selectedFunctionId +" form.updatefnManagementForm").trigger('reset');
                        return true;
                    },
                    Cancel: function() {
                        $( this ).dialog( "close" );
                        $(this).dialog('destroy');
                    }
                },
                show:           {
                    effect:     'scale',
                    duration: 300
                }
            });

            editFnNameDialog.dialog('option', 'dialogClass', 'eopDialog '+selectedFunctionMandate+'Dialog');
            editFnNameDialog.dialog('open');

            $("#updateFunctionContainer"+selectedFunctionId +" form.updatefnManagementForm").validate({
                rules:{
                    updatetxtfn:{
                        notIn: function(){
                            var invalidNames = fnNames.slice(0); // Makes a copy of the fnNames array and assigns to invalidNames
                            var index = invalidNames.indexOf(selectedFunctionName);
                            if(index > -1){
                                invalidNames.splice(index, 1);
                            }

                            return invalidNames;
                        }
                    }
                }
            });

            return false;
        });


    }); // End $(document).ready function

</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>
