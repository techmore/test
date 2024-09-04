<?php
/**
 * ajax view, lists team members in a table form
 * variable returned by controller: $memberData
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

if(isset($memberData) && is_array($memberData) && count($memberData)>0) {
    ?>
    <div id="export_list_button">
        <a href="<?php echo(base_url('report/export/members'));?>" target="_blank"><input type="button" value="Export List" style="border: 1px solid #ddd;" /></a>
    </div>
    <table class="teamresult" width="100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Title</th>
            <th>Organization</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Stakeholder Category</th>
            <th colspan="2">
                <form action="<?php echo(base_url('report/export/members'));?>"><input type="submit" value="Export List" style="border: 1px solid #ddd;" /></form>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($memberData as $key => $value): ?>
            <tr>
                <td><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><?php echo $value['name']; ?></div></td>
                <td><?php echo $value['title']; ?></td>
                <td><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><?php echo $value['organization']; ?></div></td>
                <td><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><a href="mailto:<?php echo $value['email']; ?>"><?php echo $value['email']; ?></a></div></td>
                <td><?php echo $value['phone']; ?></td>
                <td><?php echo str_replace(",", "<br />", $value['interest']); ?></td>
                <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                    <td width="8%" align="middle">
                        <a href="" class="teamEditLink"
                           id="<?php echo $value['id']; ?>"
                           data-name="<?php echo $value['name']; ?>"
                           data-title="<?php echo $value['title']; ?>"
                           data-organization="<?php echo $value['organization']; ?>"
                           data-email="<?php echo $value['email']; ?>"
                           data-phone="<?php echo $value['phone']; ?>"
                           data-interest="<?php echo $value['interest']; ?>"
                            >
                            Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="Edit Icon"/>
                        </a>
                    </td>

                    <td width="8%" align="middle">
                        <a href="" class="teamDeleteLink" data-id="<?php echo $value['id']; ?>">Delete <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/remove_icon.png" alt="Delete Icon"/></a>
                    </td>
                <?php else: ?>

                    <td colspan="">

                    </td>

                <?php endif; ?>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div id="delete_team-member-dialog" title="Delete Team Member">
        <p style="margin-top:20px;">Are you sure you want to delete this team member?</p>
    </div>

    <div id="update-team-dialog" title="Update Team Member Information">
        <?php $this->load->view('forms/update_team'); ?>
    </div>

<?php
}
?>
<script>
    $(document).ready(function(){

        var selectedId;

        //Delete Member dialog
        var deleteTeamMemberDialog = $( "#delete_team-member-dialog" ).dialog({
            autoOpen: false,
            modal: true,
            resizable:  false,
            width: '40%',
            dialogClass:    'eopDialog',
            buttons: {
                "Yes": function(){
                    var form_data = {
                        ajax:       '1',
                        id:    selectedId
                    };
                    $.ajax({
                        url: "<?php echo base_url('team/delete'); ?>",
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

        $('.teamDeleteLink').click(function(){
             selectedId = $(this).attr('data-id');
            deleteTeamMemberDialog.dialog('open');
            return false;

        });

        $('.teamEditLink').click(function(){

            selectedId = $(this).attr('id');

            $('#updateid').val('');
            $('#updatetxtname').val('');
            $('#updatetxttitle').val('');
            $('#updatetxtorganization').val('');
            $('#updatetxtemail').val('');
            $('#updatetxtphone').val('');
            //$("input:checkbox[name='updateinterests[]']").attr('checked',false);



            $('#updateid').val(selectedId);
            $('#updatetxtname')         .val($(this).attr('data-name'));
            $('#updatetxttitle')        .val($(this).attr('data-title'));
            $('#updatetxtorganization') .val($(this).attr('data-organization'));
            $('#updatetxtemail')        .val($(this).attr('data-email'));
            $('#updatetxtphone')        .val($(this).attr('data-phone'));
            $('.updateinterestChkBox').attr("checked", false);


            var b = $(this).attr('data-interest');
            var arr = b.split(",");

            for(var i=0; i<arr.length; i++) {
                $("input:checkbox[value='" + arr[i].trim() +"']").prop("checked", true);
            }

            $("#update-team-dialog").dialog('open');
            return false;
        });


        $("#update-team-dialog").dialog({
            resizable:      false,
            width: '50%',
            dialogClass:    'eopDialog',
            buttons: {
                "Save": function(){

                    $("#updateTeamForm").submit();

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