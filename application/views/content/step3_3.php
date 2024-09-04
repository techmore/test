
<?php
//$entities = $page_vars['entities'];


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
<?php $_title ="Add/Edit Goals and Objectives for Threats and Hazards"; ?>


<div id="topcontain">
    <div id="titlearea">
        <h1>Develop Goals and Objectives for Threats and Hazards</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_3"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Next,  your team should develop&nbsp;three goals&nbsp;and&nbsp;corresponding objectives&nbsp;for  each of your selected threats and hazards. The three goals should  indicate&nbsp;the desired outcome&nbsp;(1)&nbsp;before, (2) during, and (3)  after&nbsp;a threat or hazard has unfolded at your school. For each of your  goals, please provide corresponding objectives&mdash;or specific, measurable  actions&mdash;to achieve these goals. Often, planners will need to  identify&nbsp;multiple objectives in support of a single goal.&nbsp;The goals  and objectives developed in this step will be carried forward to the next step  in the planning process&mdash;Step 4&mdash;which will prompt your planning team to develop <a href="#" class="bt" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">courses of action</a> for  accomplishing the goals and objectives established here. Ultimately, the goals,  objectives, and courses of action developed for each threat or hazard will  form the Threat- or Hazard-Specific Annexes section of your school EOP. &nbsp;</p>
    <p>As  your team develops goals and objectives for threats or hazards, you should  find that some of your goals and objectives apply to more than one threat or  hazard. For example, a goal addressing the threat or hazard of a fire might be  to provide necessary medical attention to those in need. Providing medical  attention is a goal that could also apply to tornadoes, explosions,  contaminated food outbreaks, or <em>active  shooter situations</em>. These  cross-cutting goals and objectives are known as functions. Examples of functions  include the following: evacuation; lockdown; shelter-in-place; accounting for  all persons; communications and warning; family reunification; continuity of  operations; recovery; public health, medical, and mental health; and security. While  developing goals and objectives, your team will be prompted to identify which  of those goals and objectives are considered functions. The functions that your  team identifies here will eventually become Functional Annexes in your school  EOP.</p>

    <p>Please use the table below to develop <a href="#" class="bt" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a> and <a href="#" class="bt" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a> for each selected threat and hazard, and to identify which of those goals and objectives are cross-cutting <a href="#" class="bt" title="Functions are activities that apply to more than one threat or hazard.">functions</a>. If a threat or hazard is not displayed below, please return to the previous page to ensure that it is selected for inclusion in the school EOP.</p>
    <p>Begin by clicking the Add button for the respective threat or hazard. Then, type your goals and objectives into the designated fields. Use the Add More button if your team needs to develop multiple objectives in support of a single goal. Then, for each goal and objective, use the Function drop-down menu to select the corresponding function. Recommended functions are preloaded as menu options; however, your team may add new functions to the menu as well. The menu option &ldquo;None&rdquo; signifies that the goal or objective only applies to the threat or hazard, and is not a cross-cutting function. After completing all fields and selecting the appropriate menu options for the selected threat or hazard, click the Save button. Repeat this process for the remaining threats and hazards.</p>
    <p> If your team wishes to edit goals, objectives, and functions that were previously entered, please click the Edit button for the respective threat or hazard. Pre-populated fields and drop-down menus will appear with previously saved information. After editing any of the available fields, click the Update button. Repeat this process, as needed.</p>
</div><!-- /col-half --><!-- /col-half -->
<?php endif; ?>

<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Identify Goals and Objectives for Selected Threats and Hazards"; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Develop Goals and Objectives for Selected Threats and Hazards</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_3"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Next, your team should develop&nbsp;a master list of&nbsp;<a href="<?php echo(base_url('plan/step3/1')); ?>" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a>&nbsp;and&nbsp;<a href="<?php echo(base_url('plan/step3/1')); ?>" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>&nbsp;for each threat and hazard included on the district list. Your broad view about how your schools should address districtwide threats and hazards and your understanding of their context will guide school planning. Develop at least three goals for a districtwide threat or hazard to indicate&nbsp;the desired outcomes&nbsp;(1)&nbsp;before, (2) during, and (3) after&nbsp;a threat or hazard has unfolded at one of your schools. For each districtwide goal, provide corresponding districtwide objectives—or specific, measurable actions—to achieve these goals. Often, planners will need to identify&nbsp;multiple objectives in support of a single goal.&nbsp;The master list of goals and objectives developed in this step will carry forward to the next step in the planning process—Step 4—and will prompt school planning teams to develop&nbsp;<a href="<?php echo(base_url('plan/step3/3')); ?>" title="Courses of action are the specific procedures used to accomplish goals and objectives. They address the what, who, when, where, why, and how for each threat, hazard, and function.">courses of action</a>&nbsp;for accomplishing the goals and objectives. The goals, objectives, and courses of action developed for each threat or hazard will form the Threat- or Hazard-Specific Annexes section of the school EOP.</p>
<p>As your team develops districtwide&nbsp;<a href="<?php echo(base_url('plan/step3/1')); ?>" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a>&nbsp;and&nbsp;<a href="<?php echo(base_url('plan/step3/1')); ?>" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>&nbsp;for districtwide threats or hazards, you should find that some goals and objectives apply to more than one threat or hazard. For example, a goal for addressing a fire threat or hazard might be to provide medical attention to those in need. Providing medical attention could also apply to tornadoes, explosions, contaminated food outbreaks, or active shooter situations. These cross-cutting goals and objectives are known as&nbsp;<a href="<?php echo(base_url('plan/step3/3')); ?>" title="Functions are activities that apply to more than one threat or hazard.">functions</a>. Examples of functions include the following: evacuation; lockdown; shelter-in-place; accounting for all persons; communications and warning; family reunification; continuity of operations; recovery; public health, medical, and mental health; and security. While developing districtwide goals and objectives, your team will be prompted to identify which of the goals and objectives are considered functions. The functions that your team identifies here will eventually become Functional Annexes in your schools&rsquo; EOPs.</p>
<p>When creating policies and procedures for developing goals and objectives for selected threats and hazards, consider relevant Federal, State, and local laws that might govern this task. Also consider the degree to which you will work with representatives from school core planning teams and what lessons learned, guidance, and recommendations from the Federal, State, and local levels will be used to develop districtwide goals and objectives.</p>
</div><!-- /col-half --><!-- /col-half -->
<?php endif; ?>

<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css"/>
    <h1><?php echo($_title); ?></h1>
	
	<?php if($this->session->userdata['role']['level']==DISTRICT_ADMIN_LEVEL): ?>
	
        <table class="thform">
            <tr>
                <td>
                    <p>Develop&nbsp;<a href="<?php echo(base_url('plan/step3/3')); ?>" title="Goals are broad, general statements that indicate the desired outcome in response to a threat or hazard.">goals</a>&nbsp;and&nbsp;<a href="<?php echo(base_url('plan/step3/3')); ?>" title="Objectives are specific, measurable actions that are necessary to achieve the goals.">objectives</a>&nbsp;for each selected threat and hazard and identify which ones are cross-cutting&nbsp;<a href="<?php echo(base_url('plan/step3/3')); ?>" title="Functions are activities that apply to more than one threat or hazard.">functions</a>. If a threat or hazard is not displayed below, return to the previous page to ensure that it is selected for inclusion in the school EOP.</p>
                    <p>Click Add for the chosen threat or hazard. Type your goals and objectives into the designated fields. Use the Add More button if your team needs to develop multiple objectives in support of a single goal. For each goal and objective, use the Function drop-down menu to select the corresponding function. Recommended functions are preloaded as menu options; however, your team may add new functions to the menu. The menu option &ldquo;None&rdquo; signifies that the goal or objective applies only to the threat or hazard, and is not cross-cutting. After completing all fields and selecting the appropriate menu options for the selected threat or hazard, click Save. Repeat this process for the remaining threats and hazards.</p>
                    <p>If your team wishes to edit goals, objectives, and functions that were previously entered, click Edit for the chosen threat or hazard. Pre-populated fields and drop-down menus will appear with previously saved information. After editing any of the available fields, click Update. Repeat this process as needed.</p>
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
                <?php if($groupName=='state') : ?>      <h2 id="stateTableTitle">   State Master List of Threats and Hazards</h2> <?php endif; ?>
                <?php if($groupName=='district') : ?>   <h2 id="districtTableTitle">School District Master List of Threats and Hazards</h2> <?php endif; ?>
                <?php if($groupName=='school') : ?>     <h2 id="schoolTableTitle">  School Customized List of Threats and Hazards</h2> <?php endif; ?>
                <table class="results threats-hazards <?=($groupName=='state')? 'stateTable' : (($groupName=='district')? 'districtTable' : 'schoolTable')?>">
                    <tr>
                        <th scope="col">Threats and Hazards</th>
                        <th scope="col">
                            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL):?>
                                Applicable to
                            <?php else: ?>
                                Developed by
                            <?php endif; ?>
                        </th>
                        <th scope="col">Goals and Objectives</th>
                    </tr>

                    <?php foreach($entityGroup as $key=>$value): ?>

                        <?php if(isset($value['fields']) && count($value['fields'])>0): ?>
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
                                <?php if($value['description'] == 'live' && !empty($value['description'])): ?>
                                    <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                                            <?php  if($value['mandate'] == 'state' && $this->session->userdata['role']['level'] > STATE_ADMIN_LEVEL): ?>
                                                <?php if($value['copy']==YES): ?>
                                                    <a href="#" data-id="<?php echo $value['id'];?>" class="editFieldsLink" data-mandate="<?=$value['mandate']; ?>">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                                                    <?php else: ?>
                                                        <a href="#" data-id="<?php echo $value['id'];?>" class="viewFieldsLink" data-mandate="<?=$value['mandate']; ?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon" /></a>
                                                <?php endif; ?>
                                            <?php elseif($value['mandate'] == 'district' && $this->session->userdata['role']['level'] > DISTRICT_ADMIN_LEVEL) : ?>
                                                <?php if($value['copy']==YES): ?>
                                                    <a href="#" data-id="<?php echo $value['id'];?>" class="editFieldsLink" data-mandate="<?=$value['mandate']; ?>">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                                                    <?php else: ?>
                                                        <a href="#" data-id="<?php echo $value['id'];?>" class="viewFieldsLink" data-mandate="<?=$value['mandate']; ?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <a href="#" data-id="<?php echo $value['id'];?>"      class="editFieldsLink" data-mandate="<?=$value['mandate']; ?>">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/></a>
                                            <?php endif; ?>
                                    <?php else: ?>
                                            <a href="#" data-id="<?php echo $value['id'];?>" class="viewFieldsLink" data-mandate="<?=$value['mandate']; ?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                                    <?php endif; ?>
                                <?php else: ?>
                                        <a href="#" data-id="<?php echo $value['id'];?>" class="viewFieldsLink" data-mandate="<?=$value['mandate']; ?>">View <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/view_icon.png" alt="view icon"/></a>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <tr style="display:none">
                                <td colspan="3">
                                    <div class="fieldsContainer" title="Add/Edit Goals and Objectives for Threats and Hazards" id="container-<?php echo $value['id'];?>"></div>
                                </td>
                            </tr>
                        <?php else: ?>
                                        <?php if($value['description'] == 'live' && !empty($value['description'])): ?>
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
                                                    <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                                                        <?php  if($value['mandate'] == 'state' && $this->session->userdata['role']['level'] > STATE_ADMIN_LEVEL): ?>
                                                            <?php if($value['copy']==YES): ?>
                                                                <a href="#" id="<?php echo $value['id'];?>" class="addFieldsLink" data-mandate="<?=$value['mandate']; ?>">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                                                                <?php else: ?>
                                                                    No data to view
                                                            <?php endif; ?>
                                                        <?php elseif($value['mandate'] == 'district' && $this->session->userdata['role']['level'] > DISTRICT_ADMIN_LEVEL) : ?>
                                                            <?php if($value['copy']==YES): ?>
                                                                <a href="#" id="<?php echo $value['id'];?>" class="addFieldsLink" data-mandate="<?=$value['mandate']; ?>">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                                                                <?php else: ?>
                                                                    No data to view
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <a href="#" id="<?php echo $value['id'];?>" class="addFieldsLink" data-mandate="<?=$value['mandate']; ?>">Add <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/add_icon.png" alt="add icon"/></a>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                            No data to view
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr style="display:none">
                                                <td colspan="3" >
                                                    <div class="fieldsContainer" title="Add/Edit Goals and Objectives for Threats and Hazards" id="container-<?php echo $value['id'];?>"></div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                        <?php endif; ?>

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

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step3/4')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step3/2')); ?>"); //Previous



        /*** ADD EDIT VIEW ***/
        $(".addFieldsLink").click(function(){

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
                url:    '<?php echo(base_url('plan/loadTHCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        //$('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

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

            selectedId = $(this).attr('data-id');

            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);
            var mandate = $(this).attr('data-mandate');


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'edit'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadTHCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        //$('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                        var divDialog = $(divContainer).dialog({
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

            $(divContainer).html('');
            return false;
        });


        $(".viewFieldsLink").click(function(){

            selectedId = $(this).attr('data-id');
            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);
            var mandate = $(this).attr('data-mandate');


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'view'

            };
            $.ajax({
                url:    '<?php echo(base_url('plan/loadTHCtls')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $(divContainer).html(response);
                        //$('html, body').animate({ scrollTop: $(divContainer).offset().top }, 'slow');

                        var divDialog = $(divContainer).dialog({
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
                    g3fnDataNew: g3fnDataNew

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
                            alert('Problem saving data: ' + err);
                        }
                    }

                });

                var divContainer = $("#container-"+selectedId);
                divContainer.html('');
                divContainer.dialog("close");

                return false;
            }
        }

        function cancelDialog(){

            selectedId = $('#entity_identifier').val();

            var divContainer = $("#container-"+selectedId);
            divContainer.html('');
            divContainer.dialog("close");

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