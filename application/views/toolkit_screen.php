<?php
/**
 * Created by PhpStorm.
 * User: vkothale
 * Date: 10/24/2016
 * Time: 10:52 AM
 */
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


<?php
// Include the admin menu
include('embeds/admin_menu.php');
$this->load->view("forms/resource.php");
?>
<hr/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/forms.css" />

<?php if(is_array($resources) && count($resources)>0): ?>
    <div class="col-half left">

        <div>
            <table class="results">
                <thead>
                    <tr>
                        <th scope="col" style="width:25%">Resource Name</th>
                        <th scope="col" style="width:25%">URL or File Name</th>
                        <th scope="col" style="width:30%">Page(s)</th>
                        <th scope="col" style="width:10%">Section</th>
                        <th scope="col" style="width:10%">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($resources as $key=>$resource): ?>
                        <tr>
                            <td valign="middle" style="vertical-align: middle;"><?php echo($resource['name']); ?></td>
                            <td valign="middle" style="vertical-align: middle;"><?php echo($resource['url']); ?></td>
                            <td>
                                <?php if( is_array($resource['pages']) && count($resource['pages'])>0): ?>
                                        <ul class="page_list">
                                        <?php foreach ($resource['pages'] as $loopKey =>$resourcePage): ?>
                                            <li><?php echo($resourcePage['title']); ?></li>
                                        <?php endforeach; ?>
                                        </ul>
                                <?php endif ?>
                            </td>
                            <td valign="middle" style="vertical-align: middle;"><?php echo($resource['section']); ?></td>
                            <td valign="middle" style="vertical-align: middle;">
                                <a href="#" title="Edit" id="<?php echo $resource['id'];?>" class="editFieldsLink">Edit <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/edit_icon.png" alt="Edit Icon"/></a> &nbsp; | &nbsp;
                                <a class="userDeleteLink" title="Delete" id="<?php echo($resource['id']); ?>" href="/toolkit">Delete <img class="editIcon" src="<?php echo(base_url()); ?>assets/img/remove_icon.png" alt="Delete Icon"/></a>
                            </td>
                        </tr>
                        <tr style="display: none;">
                           <td colspan="5"></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="fieldsContainer" id="container-<?php echo $resource['id'];?>"></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>
<?php endif; ?>
<div id="subDetailDiv1"></div>
<div id="delete_resource-dialog" title="Delete Resource">
    <p style="margin-top:20px;">Are you sure you want to permanently delete this resource? </p>
</div>

<style>
    table.results th{
        text-transform: none;
    }
</style>

<script type='text/javascript'>
    $(document).ready(function(){

        $("#resourceManagementForm").trigger('reset');

        $("#resourceManagementForm").validate({
            rules:{
                txtURL:{
                    required: true,
                    url: true
                }
            }
        });

        $("#resourceManagementFormUpdate").validate({
            rules:{
                txtURL:{
                    required: true,
                    url: true
                }
            }
        });
        
        

        //Enable the Add button
        $('#btnAddResource').prop('disabled', false);

        $(document).on('click', '#btnAddResource', function(e){

            $('#addResourceContainer').slideToggle("slow", function(){
                $('#btnAddResource').prop('disabled', true);
                $('#btnResourceReset').click(function(e){
                    $('#addResourceContainer').hide();
                    $('#btnAddResource').prop('disabled', false);
                });
            });

        });


        $(".editFieldsLink").click(function(){

            selectedId = $(this).attr('id');

            $(".fieldsContainer").html('');

            var divContainer = $("#container-"+selectedId);


            var formData = {
                ajax:   '1',
                id:     selectedId,
                action: 'edit'

            };
            $.ajax({
                url:    '<?php echo(base_url('toolkit/loadResourceCtls')); ?>',
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

            $(divContainer).html('');
            return false;
        });


        $(document).on('click','#cancelBtn', function(){
            selectedId = $('#entity_identifier').val();
            $("#container-"+selectedId).html('');
            return false;
        });


        /**
         * Delete User Profile Information
         *
         */
        $('.userDeleteLink').click(function(){
            selectedId = $(this).attr('id');
            deleteResourceDialog.dialog('open');
            return false;

        });
        var deleteResourceDialog = $( "#delete_resource-dialog" ).dialog({
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
                        url: "<?php echo base_url('toolkit/delete'); ?>",
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

        $(document).on('change', '#userfile', function(e){
            var fullPath = e.target.value;

            if (fullPath) {
                var baseURL = "<?php echo base_url('uploads'); ?>";
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename = fullPath.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
                //Sanitize the file name
                filename = filename.replace(/[^a-z0-9.]/gi, '_');
                $("#txtURL").val(baseURL+'/'+filename).attr('readonly', true);

            }

        });

        $(document).on('change', '#userfileupdate', function(e){
            var fullPath = e.target.value;

            if (fullPath) {
                var baseURL = "<?php echo base_url('uploads'); ?>";
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename = fullPath.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
                //Sanitize the file name
                filename = filename.replace(/[^a-z0-9.]/gi, '_');
                $("#txtURLUpdate").val(baseURL+'/'+filename).attr('readonly', true);

            }

        });

        $(document).on('click', '#select-all, #select-allupdate', function(e){
            $("input[type='checkbox'].interestChkBox").prop('checked', true);
        });
        $(document).on('click', '#deselect-all, #deselect-allupdate', function(e){
            $("input[type='checkbox'].interestChkBox").prop('checked', false);
        });



    });//end document.ready function
</script>
<style>
    table.pages_display td {
        font-size: 12px;
    }
</style>

