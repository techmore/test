<?php
/**
 * ajax view lists available Threats and Hazards in a table form
 * variable returned by controller: $thData
 * 
 */


if(isset($thData) && is_array($thData) && count($thData)>0) {

    $stateEntities      = array();
    $districtEntities   = array();
    $schoolEntities     = array();

// Break the entities into groups depending on mandate
    foreach($thData as $key=>$entity){
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

    $sharing_labels = array('state'=>'State', 'district'=>'District', 'school'=>'');

    $bpath = base_url();

    ?>

    <?php foreach($groupedEntities as $groupName => $entityGroup): ?>
        <?php if($entityGroup && count($entityGroup)>0): ?>
            <hr class="<?=($groupName=='state')? 'stateHR' : (($groupName=='district')? 'districtHR' : 'schoolHR')?>" />
            <?php if($groupName=='state') : ?>      <h2 id="stateTableTitle">   State Master List of Threats and Hazards</h2> <?php endif; ?>
            <?php if($groupName=='district') : ?>   <h2 id="districtTableTitle">School District Master List of Threats and Hazards</h2> <?php endif; ?>
            <?php if($groupName=='school') : ?>     <h2 id="schoolTableTitle">  School Customized List of Threats and Hazards</h2> <?php endif; ?>
            <table class="results threats-hazards <?=($groupName=='state')? 'stateTable' : (($groupName=='district')? 'districtTable' : 'schoolTable')?>">
                <thead>
                    <tr>
                        <th scope="col">Threats and Hazards</th>
                        <th scope="col">
                            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL):?>
                                Applicable to
                            <?php else: ?>
                                Created by
                            <?php endif; ?>
                        </th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <?php foreach ($entityGroup as $key => $value): ?>

                    <tr>
                        <td><span class="thName"><?php echo $value['name']; ?></span></td>
                        <td>
                            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL){
                                echo (($value['mandate']=='state') ? 'All School EOPs in State' : 'Only Sample School EOP for State Team');
                            }else{
                                echo("<span style='text-transform: capitalize'>".$value['mandate']."</span>");
                            }
                            ?>
                        </td>
                        <td style="text-align:center;">
                            <?php if($value['mandate'] == 'state' && $this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL){

                                echo ("<a href='' class='editThLink' id='{$value['id']}' data-name='{$value['name']}' data-mandate='{$value['mandate']}' data-table-group='{$value['mandate']}' > Edit <img class='editIcon' src='{$bpath}assets/img/edit_icon.png' alt='Edit Icon'/>");
                            ?>

                                <a href="" class="deleteThLink"  data-id="<?php echo $value['id'];?>"

                                    <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL || $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
                                        data-mandate="<?php echo $value['mandate']; ?>"
                                    <?php endif; ?>
                                   data-table-group="<?php echo $value['mandate']; ?>"
                                >
                                    Delete <img class="deleteIcon" src="<?php echo(base_url()); ?>assets/img/delete.png" alt="Delete icon" />
                                </a>
                            <?php



                            }
                            elseif($value['mandate'] == 'state' && $this->session->userdata['role']['level'] > STATE_ADMIN_LEVEL){

                                if($value['copy'] == YES){
                                    ?>
                                    <script>
                                        $('#<?php echo($value['ref_key']); ?>').hide();
                                    </script>
                                <?php

                                }else{
                                    if($this->session->userdata['role']['level']>=DISTRICT_ADMIN_LEVEL && isset($this->session->userdata['loaded_school'])) {
                                        echo("<a href='{$bpath}plan/copy/{$value['id']}' id='{$value['ref_key']}'> Copy</a>");
                                    }elseif($this->session->userdata['role']['level']==STATE_ADMIN_LEVEL){
                                        echo("<a href='{$bpath}plan/copy/{$value['id']}' id='{$value['ref_key']}'> Copy</a>");
                                    }
                                }

                            }elseif($value['mandate'] == 'district' && $this->session->userdata['role']['level'] > DISTRICT_ADMIN_LEVEL){
                                $bpath = base_url();
                                if($value['copy'] == YES){
                                    ?>
                                    <script>
                                        $('#<?php echo($value['ref_key']); ?>').hide();
                                    </script>
                                    <?php
                                    echo ("<a href='' class='editThLink' id='{$value['id']}' data-name='{$value['name']}' data-mandate='{$value['mandate']}' data-table-group='{$value['mandate']}'> Edit <img class='editIcon' src='{$bpath}assets/img/edit_icon.png' alt='edit icon'/>");
                                }else{
                                    echo ("<a href='{$bpath}plan/copy/{$value['id']}' id='{$value['ref_key']}'> Copy</a>");
                                }
                            }else{
                                 if($this->session->userdata['role']['read_only']=='n'): ?>
                                    <div style="text-align:center;">
                                        <script>
                                            $('#<?php echo($value['ref_key']); ?>').hide();
                                        </script>
                                        <a href="" class="editThLink"
                                            id="<?php echo $value['id'];?>"
                                            data-name="<?php echo $value['name']; ?>"
                                            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL || $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
                                                data-mandate="<?php echo $value['mandate']; ?>"
                                            <?php endif; ?>
                                            data-table-group="<?php echo $value['mandate']; ?>"
                                        >
                                            Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon"/>
                                        </a>

                                        &nbsp;&nbsp;
                                        <a href="" class="deleteThLink"
                                           data-id="<?php echo $value['id'];?>"

                                            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL || $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
                                                data-mandate="<?php echo $value['mandate']; ?>"
                                            <?php endif; ?>
                                           data-table-group="<?php echo $value['mandate']; ?>"
                                        >
                                            Delete <img class="deleteIcon" src="<?php echo(base_url()); ?>assets/img/delete.png" alt="Delete Icon"/>
                                        </a>

                                    </div>
                                <?php
                                 endif;
                            }
                            ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endforeach; ?>

    <div id="update-th-dialog" title="Edit Threat or Hazard">
        <?php $this->load->view('forms/update_th'); ?>
    </div>

    <div id="delete_th-dialog" title="Delete Threat &amp; Hazard">
        <p style="margin-top:20px;"><strong>Are you sure you want to delete this threat or hazard? </strong> <br /><br />Please note that all information associated with this threat or hazard will be permanently deleted.</p>
    </div>

<?php
}
?>
<script>
    $(document).ready(function(){

        var selectedTHName;
        var thNames = ["" <?php foreach ($thData as $value): echo(",\"".$value['name']."\""); endforeach;?>];

        $("#update-th-dialog").dialog({
            resizable:      false,
            minHeight:      200,
            minWidth:       500,
            width:          '50%',
            modal:          true,
            autoOpen:       false,
            dialogClass:    'eopDialog',
            buttons: {
                "Save": function(){

                    $("#updateThForm").submit();

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

        $("#updateThForm").validate({

            rules: {
                updatetxtname:{
                    notIn: function(){ return thNames; }
                }
            }
        });

        $.validator.addMethod("notIn", function(value, element, params) {
            if(value != selectedTHName){
                return ! (params.indexOf(value) > -1);
            }else{
                return true;
            }

        }, "A Thread or hazard with this name already exists."
        );


        $('.editThLink').click(function(){

            selectedId = $(this).attr('id');
            selectedTHName = $(this).attr('data-name');

            $('#updateid').val(selectedId);
            $('#updatetxtname').val($(this).attr('data-name'));
            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL): ?>
                if($(this).attr('data-mandate') == 'state') {

                    $('#updatecheckbox_th_mandate').prop("checked", true);
                }else{
                    $('#updatecheckbox_th_mandate').prop("checked", false);
                }
            <?php endif; ?>
            <?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
                if($(this).attr('data-mandate') == 'district') {

                    $('#updatecheckbox_th_mandate').prop("checked", true);
                }else{
                    $('#updatecheckbox_th_mandate').prop("checked", false);
                }
            <?php endif; ?>
            $("#update-th-dialog").dialog('option', 'dialogClass', 'eopDialog '+$(this).attr('data-table-group')+'Dialog');
            $("#update-th-dialog").dialog('open');
            return false;
        });


        $('.deleteThLink').click(function(){
            selectedId = $(this).attr('data-id');

            deleteTHDialog.dialog('option', 'dialogClass', 'eopDialog '+$(this).attr('data-table-group')+'Dialog');
            deleteTHDialog.dialog('open');

            return false;

        });

        var deleteTHDialog = $( "#delete_th-dialog" ).dialog({
            autoOpen: false,
            modal: true,
            resizable:  false,
            width: '40%',
            dialogClass:    'eopDialog',
            buttons: {
                "Delete": function(){
                    var form_data = {
                        ajax:       '1',
                        id:    selectedId
                    };
                    $.ajax({
                        url: "<?php echo base_url('plan/delete/entity/th'); ?>",
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

    });

</script>