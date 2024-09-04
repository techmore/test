<?php
/**
 * ajax view, lists exercises in a table form
 * variable returned by controller: $exerciseData
 */

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

if(isset($exerciseData) && is_array($exerciseData) && count($exerciseData)>0) {
    ?>
    <div id="export_list_button">
        <a href="<?php echo(base_url('report/export/exercises'));?>" target="_blank"><input type="button" value="Export" style="border: 1px solid #ddd;" /></a>
    </div>
    <table id="teamListTable" class="teamresult" width="100%">
        <thead>
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Location</th>
            <th>Contact</th>
            <th>Date</th>
            <th>Date</th>
            <th>Description</th>
            <th>Attachment</th>
            <th colspan="2">
                <form action="<?php echo(base_url('report/export/exercises'));?>" target="_blank"><input type="button" value="Export List" style="border: 1px solid #ddd;" /></form>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($exerciseData as $key => $value): ?>
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
                <td><?php echo $value['type']; ?></td>
                <td><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><?php echo $value['location']; ?></div></td>
                <td><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><?php echo $value['contact']; ?></div></td>
                <td><?php echo $value['date']; ?></td>
                <td><?php echo $value['description']; ?></td>
                <td>
                    <?php if($link): ?>
                        <a href="<?php echo $link; ?>" target="_blank" title="Download attachment" class="link-icon"> Download </a>
                    <?php endif; ?>
                </td>
                <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                    <td width="8%" align="middle">
                        <a href="" class="exerciseEditLink"
                           id="<?php echo $value['id']; ?>"
                           data-name="<?php echo $value['name']; ?>"
                           data-type="<?php echo $value['type']; ?>"
                           data-location="<?php echo $value['location']; ?>"
                           data-contact="<?php echo $value['contact']; ?>"
                           data-date="<?php echo $value['date']; ?>"
                           data-host="<?php echo $value['host']; ?>"
                           data-description="<?php echo htmlspecialchars($value['description']); ?>"
                            >
                            Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="Edit Icon"/>
                        </a>
                    </td>

                    <td width="8%" align="middle">
                        <a href="" class="exerciseDeleteLink" data-id="<?php echo $value['id']; ?>">Delete <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/remove_icon.png" alt="Delete Icon"/></a>
                    </td>
                <?php else: ?>

                    <td colspan="">

                    </td>

                <?php endif; ?>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div id="delete_exercise-dialog" title="Delete Exercise/Drill">
        <p style="margin-top:20px;">Are you sure you want to delete this exercise/drill?</p>
    </div>

    <div id="update-exercise-dialog" title="Update Exercise/Drill">
        <?php $this->load->view('forms/update_exercise'); ?>
    </div>

<?php
}
?>
<script>
    $(document).ready(function(){

        var selectedId;

        //Delete Exercise Dialog
        var deleteExerciseDialog = $( "#delete_exercise-dialog" ).dialog({
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
                        url: "<?php echo base_url('exercise/delete'); ?>",
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

        $('.exerciseDeleteLink').click(function(){
            selectedId = $(this).attr('data-id');
            deleteExerciseDialog.dialog('open');
            return false;

        });


        $('.exerciseEditLink').click(function(){

            selectedId = $(this).attr('id');

            $('#updateid').val('');
            $('#updatetxtname').val('');
            $('#updatetxttype').val('');
            $('#updatetxtlocation').val('');
            $('#updatetxtdate').val('');
            $('#updatetxtcontact').val('');
            $('#updatetxtdescription').val('');
            $('#updateTxtHost').val('');
            //$("input:checkbox[name='updateinterests[]']").attr('checked',false);



            $('#updateid')              .val(selectedId);
            $('#updatetxtname')         .val($(this).attr('data-name'));
            $('#updatetxttype')         .val($(this).attr('data-type'));
            $('#updatetxtlocation')     .val($(this).attr('data-location'));
            $('#updatetxtdate')         .val($(this).attr('data-date'));
            $('#updatetxtcontact')      .val($(this).attr('data-contact'));
            $('#updatetxtdescription')  .val($(this).attr('data-description'));
            $('#updateTxtHost')         .val($(this).attr('data-host'));


            $("#update-exercise-dialog").dialog('open');
            return false;
        });


        $("#update-exercise-dialog").dialog({
            resizable:      false,
            buttons: {
                "Save": function(){

                    $("#updateExerciseForm").submit();

                    $(this).dialog('close');
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            },
            minHeight:      300,
            minWidth:       500,
            modal:          true,
            autoOpen:       false,
            show:           {
                effect:     'scale',
                duration: 300
            }
        });

    });

</script>
