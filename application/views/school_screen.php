<?php
/**
 *  User Management View
 *
 * This is the main user management view for managing and registering users, schools and districts.
 *
 * 2015 © United States Department of Education
 */

//print_r($role);
//echo $this->session->userdata('host_state');

//print_r($schools);
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

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



<?php 
// Include the admin menu
include('embeds/admin_menu.php');

if(isset($viewform)){
    include('forms/school.php');
}else if(isset($viewImport) && $viewImport){
    include('forms/import_schools.php');
}else if(isset($viewPreview) && $viewPreview){
    include('forms/import_schools_preview.php');
}
?>

<?php if( !isset($viewImport)  && !isset($viewPreview)): ?>
<div style="margin:10px 5px 20px 0px;">
    <form style="float:left;" action="<?php echo base_url(); ?>school/add"><input type="submit" value="Create New School" style="border: 1px solid #ddd;" /></form>
    <form style="float:left;" action="<?php echo base_url(); ?>school/import"><input type="submit" value="Import Schools" style="border: 1px solid #ddd;" /></form>
    <br style="clear: both"/>
</div>

<div style="overflow: auto;">
    <!-- Hidden field used to store selected user id -->
    <input type="hidden" id="selectedSchoolId" value="" />
    <table id="schoolManagementTbl" border="1" rules="rows" class="display" cellspacing="0" width="99%" style="display: block; font-size:13px;">

        <thead>
            <tr>
                <th scope="col">School Name</th>
                <th scope="col">School Screen Name</th>
                 <?php 
                    if($role['create_district']=='y'){
                        echo (" <th scope='col'>School District</th>");
                        echo("<th scope='col'>School District Screen Name</th>");
                    }
                ?>
                <th scope="col">EOP</th>
                <th scope="col">Modify School</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($schools as $key=>$value): ?>
            <tr>
                <td>
                    <?php echo $value['name']; ?>
                </td>
                <td>
                    <?php echo $value['screen_name']; ?>
                </td>
                 <?php if($role['create_district']=='y'): ?>
                    <td>
                         <?php echo $value['district'] ?>
                    </td>
                     <td>
                         <?php echo($value['district_screen_name']); ?>
                     </td>
                <?php endif; ?>

                <?php 
                    if($role['level']==2){
                        $viewEOP = false;

                        if($stateEOPAccess=='write' || $stateEOPAccess=='read'){ //Check state access at the state level
                            $dpermission = NULL;
                            foreach($districts as $dkey=>$dvalue){
                                if($value['district_id'] == $dvalue['id']){
                                    $dpermission = $dvalue['state_permission'];
                                    break;
                                }
                            }


                            if(null!=$dpermission && $dpermission=='write'){ //Check state access at the district level

                                if(isset($value['state_permission']) && $value['state_permission']=='write'){ //Check state access at the school level
                                    $viewEOP = true;
                                }else{
                                    $viewEOP = false;
                                }

                            }
                            elseif(null==$dpermission && $value['state_permission']=='write'){
                                $viewEOP = true;
                            }


                        }

                        if($viewEOP){
                            if($value['has_data']) {
                                echo "<td><a href=" . base_url() . "report/make/" . $value['id'] . ">View</a></td>";
                            }else{
                                echo("<td><span class='grey'>No Data</span></td>");
                            }
                        }
                        else{
                            echo "<td style='color:#BABABA;'><em>Not shared</em></td>";
                        }
                    }else{
                        if($value['has_data']) {
                            echo "<td><a href=".base_url()."report/make/".$value['id'].">View</a></td>";
                        }else{
                            echo("<td><span class='grey'>No Data</span></td>");
                        }
                    }
                ?>



                <td>
                    <a class="modifySchoolProfileLink"
                       param1="<?php echo($value['name']); ?>"
                       param2="<?php echo($value['screen_name']); ?>"
                       data-id="<?php echo($value['id']); ?>" href="/school">
                        Edit
                    </a>
                    <?php if($this->session->userdata['role']['level'] == SUPER_ADMIN_LEVEL): ?>
                    &nbsp;|&nbsp; <a class="schoolDeleteLink" data-id="<?php echo($value['id']); ?>" href="/school">Delete</a>
                    <?php endif; ?>
                </td>
                
            </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <td>School Name</td>
                <td>School Screen Name</td>
                 <?php 
                    if($role['create_district']=='y'){
                        echo (" <td>School District</td>");
                        echo (" <td>School District Screen Name</td>");
                    }
                ?>
                <td>EOP</td>
                <td>Modify School</td>
            </tr>
        </tfoot>

    </table>
</div>
<?php endif; ?>


<div id="update-school-dialog" title="Update School">
    <?php
        include("forms/update_school.php");
    ?>
</div>
<div id="delete_school-member-dialog" title="Delete School">
    <p style="margin-top:20px;"><strong>Are you sure you want to delete this school? </strong> <br /><br />Please note that all EOP information associated with this school will also be deleted.</p>
</div>

<script language="JavaScript" type="text/javascript">
    

    $(document).ready(function(){

        $('#schoolManagementTbl').DataTable({
            "bFilter": true, // For the search text box
            "bInfo": true // For the "Showing 1 to 10 of x entries" text at the bottom
        });

        $('#preview_table').DataTable({
            paging: false,
            searching: false
        });


        /**
         * Form Validation
         *
         */

        $("#school_form").validate({
        });

        $("#update_school_form").validate({

            submitHandler: submit_update_school_form
        });



        /**
         *
         * Update School Profile functionality
         */
            $(document).on('click', '.modifySchoolProfileLink', function(){
                var id = $(this).attr('data-id');
                var name = $(this).attr('param1');
                var screen_name = $(this).attr('param2');


                $('#school_name_update').val(name);
                $('#screen_name_update').val(screen_name);
                $('#school_id_update').val(id);

                //Open the update user dialog form
                $("#update-school-dialog").dialog('open');
                return false;
            });

            $("#update-school-dialog").dialog({
                resizable:      false,
                minHeight:      200,
                minWidth:       500,
                modal:          true,
                autoOpen:       false,
                show:           {
                    effect:     'scale',
                    duration: 300
                },
                buttons: {
                    "Update": function(){
                        $("#update_school_form").submit();
                    },
                    Cancel: function() {
                        $("#update_school_form")[0].reset();
                        $( this ).dialog( "close" );
                    }
                }
            });

            function submit_update_school_form(){

                var form_data = {
                    school_id               : $('#school_id_update').val(),
                    school_name             : $('#school_name_update').val(),
                    screen_name             : $('#screen_name_update').val(),
                    ajax                    : '1'
                };
                $.ajax({
                    url: "<?php echo base_url('school/update'); ?>",
                    type: 'POST',
                    data: form_data,
                    success: function(response) {
                        location.reload();
                    }
                });

                $('#update-school-dialog').dialog("close");
                return false;
            }

        /**
         * Delete School Profile Information
         *
         */
        $(document).on('click', '.schoolDeleteLink', function(e){
            selectedId = $(this).attr('data-id');
            deleteSchoolMemberDialog.dialog('open');
            return false;
        });


        var deleteSchoolMemberDialog = $( "#delete_school-member-dialog" ).dialog({
            autoOpen: false,
            modal: true,
            resizable:  false,
            buttons: {
                "Delete": function(){
                    var form_data = {
                        ajax:       '1',
                        id:    selectedId
                    };
                    $.ajax({
                        url: "<?php echo base_url('school/delete'); ?>",
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

        $("#school_form").on('reset', function(e){
            window.location = "<?php echo(base_url()); ?>school";
        });

        $("#school_upload_csv_form").on('reset', function(e){
            window.location = "<?php echo(base_url()); ?>school";
        });
        $("#school_import_form").on('reset', function(e){
            window.location = "<?php echo(base_url()); ?>school";
        });

        $("#csvInp").change(function(){
            //$("#user_upload_csv_form").trigger('submit');
            $("#school_upload_csv_form").submit();
        });

    });
</script>


<style>
    input.import_school_name, input.import_screen_name{
        width: 100%;
        padding: 10px;
        margin: 0px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }

    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        position: relative;
        display: inline-block;
        color: #fff;
        background: #112E51;
        border: none;
        cursor: pointer;
        padding: 6px 12px;
        font-weight: bold;
        font-size: .9em;
        outline: none !important;
    }

    .ic-cloud-upload-48px {
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMAAAADACAQAAAD41aSMAAAF4UlEQVR4AezBMQEAAADCIPuntsUuYAAAAAAAAAAAAAAAAJ2zd7evVdZxHMd/x7k5LDfZXOjUwqCCPQkrF96EIrpkbTkzUTRTy0PRSnrSg+iJkU8qFW/qgYIiZaBTH4hC3nUjmkrerE2lQhubE7LmPC5NO9u83jHGcK3jPGc71/W9ftf1fX//g8/ryRiH60cOE4nyEZvZz1ka+JMbtNNKjMv8ymm+YRMfMI9i8jC2nMHvl8EzvMdu6kmlOrZSyVgyFKDvl89r7OY6/ekGO5lPjgKkdkOIcpA20lWcr3mdBxUgmRvLBm7gRn/xGUUK0NuVchS3+46ZCvD/i1DBKbzqJCUK0P2KOY7Xfc8EDApAIV/gINNXFIQdIEoLkl1lUXgBHuYAfugQY8IIMIcW/FKMinABZLIWv7WSgWEBGMEx/NgPjAwDQBEN+LVLFAUdYAox/Fwz44MMUEEcv3eLsqACvEgrNtTG7CAClBPHluKUBA1gCnFs6m8mBAmgiBi2FePJoAAMpx4bu0RBEACyOIGtfUuG/QBrsbmVtgO8jO3NtRngEVqwveuMtBfgAEFor60ASwlKC20EKOQ6Qekaw+0D+JIgtdU2gHE4BCmHsXYBHCVoHbQBYCjjWcLH7MOrlrMcryrxL0A+L7Gec3jdcgzGM4IzfgTI502O4ADIzO8pwTQ/AUQoYw+tAHLze0yw1y8AmSzmPIDs/J4TODwuDzCAKI0gP78IwefSAJOpBj/ML0RwkwfkAB6iCvwxvyDBXCmAcv7wy/yiBLskAAazAfwyvzDBbYZ4DTCaGh/NL0+wwFuAcfzuq/nlCbZ7CTCbWz6bX57gincA82j34fzyBE94AzDHgvllCKJeAMyizY75BQi2ug/wLLdtmV+AoIVtfEIlLzDCHYBRVv7lI/NHaQNVvM3odAIM5rSt8wsQdHWS9xmdHoBN9s8vQgDt7GRyfwHK7Z9fkADgFNP7DjCMK/bPL04AB3mqbwBVwZxfgOAOn5KdKsDU4M4vQAC/MD4VgAFUB3t+AYI23k0eYHHw5xcggC1kJwMwiMvBn1+I4Bi59wdYEvz5BQlOkXc/gNrgzy9KUEtBbwDTgz+/OMFxsu8NsCd080sQVBFJDJAn/RvP0BCsSAywNJzzCxA4TE0EcCis8wsQXCavJ8Aw2sM7vwDB9p4As8M9vwDB1P8CrA33/AIEtWR0Bzij83tO8NZdgBzu6PyeE1wiswtgos4vQvBqF8Ai/J3p5/m1s10AKxRAqMmdANsUQKgNnQAnFECoZjIxhp8VQKxSjKFRAcRajTHEFECsMxhDqwKIdYehCiBbiaFZAQR7x9CgAIKtN5xTAMH2GY4rgGBnDTsUQLB6/WecbFcNCxVAsLihGNEUIAdHAcRqkv1dtALUGQxrFECsGoNhpgKItd9gyKVdAYRaZ+i4IwogVKWh495QAKGmdX33/x8FEMgh39B5OxRAoGqMofPKFECgVXcBIpxHJP1ZSte9ogAeFyO7O0AGvymAp23s+bGOqAJ42nM9AQZSqwCedYFITwDDJBw0b4om/mTZFjQvaiQrMUAB13A/bdm9P1s5C7fTLpB9bwDDOtxNm4HpDSCLk2gePQNkSHSPchV30poZldzn62/iRlp5sg84zKAVLd2tSuUJkwU4aOnsMJmpAHQQtKKlq1pyU3/G6nluoqWjegr79pBbMU1o/Z//sb4/ZTiGH+lPWi2F/XvMM4s19DXtMLnpeM62gma0VHNYSWa6HnQexmYckk9rpjzdT5pPpIbk0nYxyo1H/QeylIv0nnaRGW486t91GSzgPInTGllGNsZNgI6LUMp2bqN17wJRstx51D/x5RLlMO1oMTYyiYgLb8oncTmUsZqfcAhfDtWsopRBLryonfIN4Wnm8yHbOEoNdTQRJ2jFaaKOGvazjkqmkd//52z1BE8nUIB/26ODIQAAAIBB/taT2LMLIQEIEIAAAQgQgICBAAQIQIAABAhAgAAECECAAAQIQIAABAhAgAAC+4kfT5TbxhQAAAAASUVORK5CYII=);
        width: 20px;
        height: 18px;
        float:left;
        background-size:20px 18px;
        background-repeat:no-repeat;
    }
</style>