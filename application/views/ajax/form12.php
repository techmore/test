<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>


<div id="file-upload-dialog" title="File Upload">
    <form enctype="multipart/form-data" method="post" id="upload_form" action="<?php echo(base_url('/files/uploadFromStep5')); ?>">
        <input aria-label="action" type="hidden" name="action" value="<?php echo($action); ?>" />
        <p>&nbsp;</p>
        <p>
            <input aria-label="user file" type="file" name="userfile[]" id="userfile" multiple accept="image/*, application/msword,application/vnd.ms-excel, application/excel, application/vnd.openxmlformats-officedocument.wordprocessingml.document, , .png, .gif, .jpeg, .doc, .docx, .xls, .xlsx, .pdf, .ppt, .pptx, .txt" required/>
        </p>
        <table id="newFilesTable" width="100%"><tbody></tbody></table>

    </form>
</div>

<div id="deleteFileDialog" title="Delete File">
    <p style="margin-top:20px">
        This action will permanently delete this file.
    </p>
    <p>
        <strong>Do you wish to continue?</strong>

    </p>
</div>

<div class="boxed-group">

    <button id="upload_button" class="btn">Upload File</button>

    <table style="width:100%" id="filesTable" class="display" >
        <thead>
        <tr>
            <th style="width:5%">#</th>
            <th style="width:35%">File Title</th>
            <th style="width:40%">File Name</th>
            <th style="width:10%"> Date</th>
            <th style="width:10%"> Actions &nbsp;</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($files as $key=>$file): ?>
            <?php
            $file_data = json_decode($file['data'], true);
            ?>

            <tr>
                <td><?php echo($key+1); ?></td>
                <td><?php echo($file['name']); ?></td>
                <td><?php echo($file_data['file_name']); ?></td>
                <td><?php echo(date_format(date_create($file['created']), 'm/d/Y g:i a')); ?></td>
                <td>
                    <a href="<?php echo(base_url() . 'uploads/files/'. $file_data['file_name']); ?>" download><i class="">Download</i></a> |
                    <a data-id="<?php echo($file['id']); ?>" href="#" class="btnDelete"><i class="">Delete</i> </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<table>
    <tr>
        <td >
            <input type="button" value="Close" id="closeBtn12"/>
        </td>
    </tr>
</table>

<style>
    .boxed-group{
        margin:0px;
    }
    .boxed-group h3{
        border-radius:5px;
    }
    #filesTable_wrapper{
        margin: 10px;
    }
    #deleteFileDialog p{
        line-height: 28px;
    }
    #filesTable th{
        color: black;
    }
</style>
<script type="text/javascript">

    $(document).ready(function(){
        var selectedId = 0;

        $("#upload_button").on('click', function(){
            $("#file-upload-dialog").dialog("open");
        });

        $('#filesTable').DataTable({
            paging: true,
            searching: true,
            pageLength: 50
        });

        $("#file-upload-dialog").dialog({
            resizable:      false,
            minHeight:      300,
            minWidth:       500,
            modal:          true,
            autoOpen:       false,
            show:           {
                effect:     'scale',
                duration: 300
            },
            buttons: {
                "Upload File": function(){
                    $("#upload_form").submit();
                },
                Cancel: function() {
                    $("#upload_form")[0].reset();
                    $("#newFilesTable tbody").empty();
                    $( this ).dialog( "close" );
                }
            }
        });

        function readData(input) {
            var readers = [];

            if (input.files && input.files[0]) {

                for(var i=0; i<input.files.length; i++){
                    readers[i] = new FileReader();

                    readers[i].onload = function(e) {
                        $("#newFilesTable").find('tbody')
                            .append($('<tr>')
                                .append($('<td>')
                                    .append($('<label>')
                                        .addClass('filePreview')
                                        .text(e.target.fileName)
                                    )
                                    .append($('<br/>'))
                                    .append($('<input>')
                                        .attr('placeholder', 'Title')
                                        .attr('type', 'text')
                                        .attr('name', 'title[]')
                                        .attr('class', 'imgTitle')
                                        .attr('style', 'width:98%')
                                        .attr('required', 'required')
                                        .attr('maxlength', '255')
                                    )
                                )
                                .append($('<td>')

                                )
                            );
                    };
                    readers[i].fileName = input.files[i].name;
                    readers[i].readAsBinaryString(input.files[i]);
                }
            }
        }

        $("#userfile").change(function() {
            readData(this);
        });

        $("#upload_form").validate({
        });

        $(".btnDelete").on('click', function(e){
            selectedId = $(this).attr('data-id');
            deleteFileDialog.dialog('open');
            return false;
        });

        var deleteFileDialog = $( "#deleteFileDialog" ).dialog({
            autoOpen: false,
            modal: true,
            resizable:  false,
            buttons: {
                "Delete": function(){
                    $(this).dialog('close');
                    
                    var divContainer = $("#form12Div");
                    divContainer.html('');

                    var formData = {
                        ajax:       '1',
                        action:     '<?php echo($action); ?>'
                    };

                    $.ajax({
                        url:    '<?php echo(base_url()); ?>files/deleteFromPlanScreen/' + selectedId,
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
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                    return false;
                }
            },
            show:           {
                effect:     'scale',
                duration: 300
            }
        });

        $("#closeBtn12").click(function(){
            $("#form12Div").html('');
            return false;
        });

    });


</script>

