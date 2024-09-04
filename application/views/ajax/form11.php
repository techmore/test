<?php
/**
 *
 *
 *
 *
 */
$controlStatus = ($action=='view') ? "disabled" : "";
$children=array();

if($action=='add'){
    //Do nothing right now
}else{


    foreach($entities as $entity_key=>$entity){
        foreach($entity['children'] as $child_key=>$child){
            switch($child['title']){
                case 'Step 5 Photo':
                    $children[] = $child;
                    break;
            }
        }
    }
}

//Sort the image entities by weight
for($i=0; $i<count($children); $i++){
    for($j=$i; $j<count($children); $j++){
        if($children[$i]['weight']>$children[$j]['weight']){
            $tmp_child = $children[$j];
            $children[$j] = $children[$i];
            $children[$i] = $tmp_child;
        }
    }
}

?>
<form enctype="multipart/form-data" method="post" action="<?php echo(base_url('plan/manageForm11')); ?>" id="newImagesForm">
    <input aria-label="action" type="hidden" name="action" value="<?php echo($action); ?>" />
    <input aria-label="entity id" type="hidden" name="entityId" value="<?php echo(isset($entityId)? $entityId : null); ?>" />
<table border="0" width="100%">
    <tbody>
    <tr>
        <td>
            <p>Upload images that you would like to include in the Basic Plan section of your EOP. Please note that only .jpg and .png files can be uploaded.</p>
        </td>
    </tr>
    <tr>
        <td>
            <input aria-label="images" style="display:none;" type='file' id="imgInp" accept="image/*, .jpg, .png, .gif, .jpeg" multiple name="images[]"/>
            <input aria-label="add image" type="button" value="Add Image File" id="btnAddImageFile"/>

            <hr style="border-top: 1px solid #CCC; border-bottom:0px;"/>

            <table id="newImagesTable" style="width:100%;"><tbody></tbody></table>
        </td>

    </tr>

    <tr class="saveBtnrow">
        <td><p>&nbsp;<hr style="border-top: 1px solid #CCC; border-bottom:0px;"/></p></td>
    </tr>
    <tr class="saveBtnrow">
        <td colspan="2" align="right">
            <div align="left">
                <?php if($action != 'view'): ?>
                    <?php if($action=='add'): ?>
                        <input type="button" value="Upload" id="btnsaveform11"/>
                        <?php else: ?>
                        <input type="button" value="Upload" id="btnsaveform11"/>
                    <?php endif; ?>
                <?php endif; ?>

                <input type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>" id="cancelBtn11"/>
            </div>
        </td>
    </tr>
    </tbody>
</table>
</form>

<?php if(isset($children) && count($children)>0): ?>
<table border="0" width="100%" id="editImagesTable">
    <?php foreach($children as $key => $child): ?>
        <tr>
            <td>
                <?php
                $file_info = json_decode($child['fields'][2]['body'], true);
                 $file_path = base_url() . 'uploads/step5/' . $file_info['file_name'];
                ?>
                <img src="<?php echo($file_path); ?>" class="imgPreview" />
            </td>
            <td>
                <input type="text" placeholder="Title" class="imgTitle" id="title_<?php echo($child['fields'][0]['entity_id']); ?>" value="<?php echo($child['fields'][0]['body']); ?>" data-field-id="<?php echo($child['fields'][0]['id']); ?>" /> <br />
                <span>Description</span> <br />
                <textarea  rows="6" placeholder="Description" class="imgDescription" id="description_<?php echo($child['fields'][0]['entity_id']); ?>" data-field-id="<?php echo($child['fields'][1]['id']); ?>"><?php echo($child['fields'][1]['body']); ?></textarea>
                <br/>
                <input type="button" value="Save" class="imgSaveButton"     data-field-id="<?php echo($child['fields'][0]['entity_id']); ?>" data-parent-id="<?php echo($child['parent']); ?>"/>
                <input type="button" value="Delete" class="imgDeleteButton" data-field-id="<?php echo($child['fields'][0]['entity_id']); ?>" data-parent-id="<?php echo($child['parent']); ?>" data-full-path="<?php echo($file_info['full_path']); ?>"/>
            </td>

        </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<table>
    <tr>
        <td >
            <input type="button" value="Close" id="closeBtn11"/>
        </td>
    </tr>
</table>

<script type="text/javascript">


$(document).ready(function(){

    $(".imgSaveButton").on('click', function(e){
        var entity_id               = $(this).attr('data-field-id');
        var parent_id               = $(this).attr('data-parent-id');
        var title                   = $("#title_"+entity_id).val();
        var description             = $("#description_"+entity_id).val();
        var title_field_id          = $("#title_"+entity_id).attr('data-field-id');
        var description_field_id    = $("#description_"+entity_id).attr('data-field-id');

        var formData = {
            ajax:                   '1',
            action:                 'save',
            entity_id:              entity_id,
            parent_id:              parent_id,
            title:                  title,
            title_field_id:         title_field_id,
            description:            description,
            description_field_id:   description_field_id
        };

        $.ajax({
            url:    '<?php echo(base_url('plan/manageForm11')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    $("#form11Div").html(response);
                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });
        return false;

    });

    $(".imgDeleteButton").on('click', function(e){
        var entity_id               = $(this).attr('data-field-id');
        var parent_id               = $(this).attr('data-parent-id');
        var file_path               = $(this).attr('data-full-path');

        var result = confirm("This will permanently delete this item. Do you wish to continue?");

        if(result == true){
            var formData = {
                ajax:                   '1',
                action:                 'delete',
                entity_id:              entity_id,
                parent_id:              parent_id,
                file_path:              file_path
            };

            $.ajax({
                url:    '<?php echo(base_url('plan/manageForm11')); ?>',
                data:   formData,
                type:   'POST',
                success: function(response){
                    try{
                        $("#form11Div").html(response);
                    }catch(err){
                        alert('Problem loading controls ' + err);
                    }
                }

            });
            return false;
        }
    });

    function readURL(input) {
        var readers = [];

        if (input.files && input.files[0]) {

            for(var i=0; i<input.files.length; i++){
                readers[i] = new FileReader();

                readers[i].onload = function(e) {
                    $("#newImagesTable").find('tbody')
                        .append($('<tr>')
                            .append($('<td>')
                                .append($('<img>')
                                    .attr('src', e.target.result)
                                    .addClass('imgPreview')
                                    .text('Image cell')
                                )
                            )
                            .append($('<td>')
                                .append($('<input>')
                                    .attr('placeholder', 'Title')
                                    .attr('type', 'text')
                                    .attr('name', 'title[]')
                                    .attr('class', 'imgTitle')
                                )
                                .append('<br />')
                                .append($('<span>')
                                    .text('Description')
                                )
                                .append('<br />')
                                .append($('<textarea>')
                                    .attr('name', 'description[]')
                                    .attr('cols', '60')
                                    .attr('rows', '6')
                                    .attr('placeholder', 'Description')
                                    .attr('class', 'imgDescription')
                                )
                                .append($('<input>')
                                    .attr('name', 'weight[]')
                                    .attr('type', 'hidden')
                                    .attr('value', $('.imgPreview').length+1)
                                )
                            )
                            .append($('<td>'))
                        );
                };

                readers[i].readAsDataURL(input.files[i]);
            }

            $(".saveBtnrow").show();
        }else{
            $(".saveBtnrow").hide();
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });

    $("#btnAddImageFile").click(function(){
        $("#imgInp").trigger('click');
    });

    $("#btnsaveform11").click(function(){
       $("#newImagesForm").submit();
    });

    $("#cancelBtn11").click(function(){
        $("#newImagesForm")[0].reset();
        $("#newImagesTable tbody").empty();
        $(".saveBtnrow").hide();
        return false;
    });

    $("#closeBtn11").click(function(){
        $("#form11Div").html('');
        return false;
    });

    });
</script>

<style>
    img.imgPreview{
        max-height:300px;
        max-width: 400px;
    }
    input.imgTitle, textarea.imgDescription{
        width: 60%;
        padding:4px;
        margin-bottom:8px;
    }
    #newImagesTable tr:nth-child(even) td, #editImagesTable tr:nth-child(even) td{
        background-color: #F3F3F3;
    }
    #newImagesTable td, #editImagesTable td{
        width:50%;
    }

    .saveBtnrow{
        display: none;
    }

</style>