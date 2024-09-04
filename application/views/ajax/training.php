<?php
/**
 * ajax view, lists trainings in a table form
 * variable returned by controller: $trainingData
 */
$school_loaded = (isset($this->session->userdata['loaded_school']['id']) && null != $this->session->userdata['loaded_school']['id']) ? true : false;
$logged_in_role_level = $this->session->userdata['role']['level'];

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

<?php endif;

if(isset($trainingData) && is_array($trainingData) && count($trainingData)>0) {
    ?>
    <div id="export_list_button">
        <form action="<?php echo(base_url('report/export/trainings'));?>" target="_blank"><input type="button" value="Export" style="border: 1px solid #ddd;" /></form>
    </div>
    <?php if(!$school_loaded && $logged_in_role_level==DISTRICT_ADMIN_LEVEL): ?>

        <div class="col-half left">
            <div id="errorDiv">
                <div class="notify notify-yellow">
                    <span class="symbol icon-info"></span>&nbsp;&nbsp;  Showing all <strong>District</strong> provided trainings. <em>To view a specific school's trainings, select a school on the top main menu bar.</em>            </div>
            </div>
        </div>
    <?php endif; ?>

    <table class="teamresult" width="100%">
        <thead>
        <tr>
            <th>Title</th>
            <th>Topic</th>
            <th>Date</th>
            <th>Location</th>
            <th>Number of <br/> Participants</th>
            <?php if(!$school_loaded && $logged_in_role_level==DISTRICT_ADMIN_LEVEL): ?>
                <th>Number of <br/> Schools </th>
            <?php endif; ?>
            <?php if(!$school_loaded && $logged_in_role_level==STATE_ADMIN_LEVEL): ?>
                <th>Number of <br/> LEAs </th>
                <th>Number of <br/> Rural LEAs </th>
            <?php endif; ?>
            <th>Evaluation <br/>Score</th>
            <th>Attachment</th>
            <th colspan="2">
                <form action="<?php echo(base_url('report/export/trainings'));?>" target="_blank"><input type="button" value="Export List" style="border: 1px solid #ddd;" /></form>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($trainingData as $key => $value): ?>
            <?php
            $file_name='';
            $link = '';
            $fileData = json_decode($value['file'], true);
            if($fileData && is_array($fileData) && count($fileData)>0){
                $file_name = $fileData['file_name'];
                $link = base_url() . 'uploads/attachments/' . $file_name;
            }
            ?>
            <tr>
                <td><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><?php echo $value['name']; ?></div></td>
                <td><?php echo $value['topic']; ?></td>
                <td><?php echo $value['date']; ?></td>
                <td><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><?php echo $value['location']; ?></div></td>
                <td><div><?php echo $value['participants']; ?></div></td>
                <?php if(!$school_loaded && $logged_in_role_level==DISTRICT_ADMIN_LEVEL): ?>
                    <td>
                        <div>
                            <?php $_output = ($value['provider']=='district-provided') ? $value['schools'] : '<em style="color:#9e9e9e;">school-provided</em>'; ?>
                            <?php echo($_output); ?>
                        </div>
                    </td>
                <?php endif; ?>
                <?php if(!$school_loaded && $logged_in_role_level==STATE_ADMIN_LEVEL): ?>
                    <td><div><?php echo $value['leas']; ?></td>
                    <td><div><?php echo $value['rleas']; ?></td>
                <?php endif; ?>
                <td><div><?php echo $value['score']; ?></div></td>

                <td>
                    <?php if($link): ?>
                        <a href="<?php echo $link; ?>" target="_blank" title="Download attachment" class="link-icon"> Download </a>
                    <?php endif; ?>
                </td>
                <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                    <td width="8%" align="middle">
                        <a href="" class="trainingEditLink"
                           id="<?php echo $value['id']; ?>"
                           data-name="<?php echo $value['name']; ?>"
                           data-topic="<?php echo $value['topic']; ?>"
                           data-location="<?php echo $value['location']; ?>"
                           data-format="<?php echo $value['format']; ?>"
                           data-personnel="<?php echo $value['personnel']; ?>"
                           data-score="<?php echo $value['score']; ?>"
                           data-schools="<?php echo $value['schools']; ?>"
                           data-leas="<?php echo $value['leas']; ?>"
                           data-rleas="<?php echo $value['rleas']; ?>"
                           data-provider="<?php echo $value['provider']; ?>"
                           data-participants="<?php echo $value['participants']; ?>"
                           data-date="<?php echo $value['date']; ?>"
                           data-description="<?php echo htmlspecialchars($value['description']); ?>"
                        >
                            Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="edit icon" />
                        </a>
                    </td>


                    <td width="8%" align="middle">
                        <a href="" class="trainingDeleteLink" data-id="<?php echo $value['id']; ?>">Delete <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/remove_icon.png" alt="edit icon"/></a>
                    </td>
                <?php else: ?>

                    <td colspan="">

                    </td>

                <?php endif; ?>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div id="delete_training-dialog" title="Delete Training">
        <p style="margin-top:20px;">Are you sure you want to delete this training?</p>
    </div>

    <div id="update-training-dialog" title="Update Training">
        <?php $this->load->view('forms/update_training'); ?>
    </div>

    <?php
}
?>
<script>
    $(document).ready(function(){

        var selectedId;

        $("tr#updateOtherTopic").hide();

        $(document).on('change', '#updateTxtTopic', function(e){
            if($(this).val()=='Other related emergency management topic'){
                $("#updateTxtOtherTopic").attr('required', true);
                $("tr#updateOtherTopic").show();
            }else{
                $("#updateTxtOtherTopic").attr('required', false);
                $("tr#updateOtherTopic").hide();
            }
        });

        //Delete Exercise Dialog
        var deleteTrainingDialog = $( "#delete_training-dialog" ).dialog({
            autoOpen: false,
            modal: true,
            resizable:  false,
            buttons: {
                "Yes": function(){
                    var form_data = {
                        ajax:       '1',
                        id:    selectedId
                    };
                    $.ajax({
                        url: "<?php echo base_url('training/delete'); ?>",
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

        $('.trainingDeleteLink').click(function(){
            selectedId = $(this).attr('data-id');
            deleteTrainingDialog.dialog('open');
            return false;

        });


        $('.trainingEditLink').click(function(){

            selectedId = $(this).attr('id');

            $('#updateTxtName').val('');
            $('#updateTxtTopic').val('Developing high-quality EOPs');
            $('#updateTxtFormat').val('');
            $('#updateTxtDate').val('');
            $('#updateTxtLocation').val('');
            $('#updateTxtParticipants').val('');
            $('#updateTxtScore').val('');
            $("input:checkbox[name='updateCheckPersonnel[]']").attr('checked',false);
            $("#updateTxtDescription").val('');
            $("#updateTxtSchools").val('');
            $("#updateProvidedBy").val('school-provided');
            $("#updateTxtLEAs").val('');
            $("#updateTxtRLEAs").val('');


            $('#updateid').val(selectedId);
            $('#updateTxtName').val($(this).attr        ('data-name'));
            $('#updateTxtTopic').val($(this).attr       ('data-topic'));
            $('#updateTxtFormat').val($(this).attr      ('data-format'));
            $('#updateTxtDate').val($(this).attr        ('data-date'));
            $('#updateTxtLocation').val($(this).attr    ('data-location'));
            $('#updateTxtParticipants').val($(this).attr('data-participants'));
            $('#updateTxtScore').val($(this).attr       ('data-score'));
            //$("input:checkbox[name='updateCheckPersonnel[]']").attr('checked',false);
            $("#updateTxtDescription").val($(this).attr ('data-description'));
            $("#updateTxtSchools").val($(this).attr     ('data-schools'));

            $("#updateTxtLEAs").val($(this).attr        ('data-leas'));
            $("#updateTxtRLEAs").val($(this).attr       ('data-rleas'));

            var personnel = $(this).attr('data-personnel').split(",");
            $.each(personnel, function(index, value){
                $("input:checkbox[value='"+ value +"']").prop("checked", true);
            } );

            <?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && !$school_loaded): ?>

            $("input[name='updateProvidedBy']").val('district-provided');
            $("input[name='updateProvidedBy']").val($(this).attr('data-provider'));
            $("input[name='updateTxtSchools']").attr('required', true);

            if($("input[name='updateProvidedBy']").val()=='district-provided'){
                $("#update_chk_providedBy").prop("checked", true);
                $("tr.update_district-provided").show();
            }else{
                $("#update_chk_providedBy").prop("checked", false);
            }
            <?php endif; ?>

            <?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && $school_loaded): ?>
                $("tr.update_district-provided").hide();
                $("input[name='updateProvidedBy']").val('school-provided');
                $("input[name='updateProvidedBy']").val($(this).attr     ('data-provider'));
                $("input[name='updateTxtSchools']").attr('required', false);

                if($("input[name='updateProvidedBy']").val()=='district-provided'){
                    $("#update_chk_providedBy").prop("checked", true);
                    $("tr.update_district-provided").show();
                }else{
                    $("#update_chk_providedBy").prop("checked", false);
                }
            <?php endif; ?>

            $("#update_chk_providedBy").click(function(){
                if($(this).prop("checked")==true){
                    $("tr.update_district-provided").show();
                    $("input[name='updateProvidedBy']").val('district-provided');
                    $("input[name='updateTxtSchools']").attr('required', true);
                }else if($(this).prop("checked")==false){
                    $("tr.update_district-provided").hide();
                    $("input[name='updateProvidedBy']").val('school-provided');
                    $("input[name='updateTxtSchools']").attr('required', false);
                }
            });


            $("#update-training-dialog").dialog('open');
            return false;
        });


        $("#update-training-dialog").dialog({
            resizable:      false,
            buttons: {
                "Save": function(){

                    $("#updateTrainingForm").submit();

                    $(this).dialog('close');
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            },
            minHeight:      300,
            minWidth:       600,
            modal:          true,
            autoOpen:       false,
            show:           {
                effect:     'scale',
                duration: 300
            }
        });

    });

</script>
