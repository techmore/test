<?php
/**
 *
 *
 *
 *
 */
$controlStatus = ($action=='view') ? "disabled" : "";
if($action=='add'){
    //Do nothing right now
}else{
    $child1=array();

    foreach($entities as $entity_key=>$entity){
        foreach($entity['children'] as $child_key=>$child){
            switch($child['name']){
                case '8.1':
                    $child1 = $child;
                    break;
            }
        }
    }
}
?>
<table border="0" width="100%">
    <tr>
        <td><p>The Administration, Finance, and Logistics section covers general support requirements and the availability of services and support for all types of emergencies, as well as general policies for managing resources. It should identify and reference policies and procedures that exist outside the plan. This section should:</p>
            <ul>
                <ul>
                    <li>Identify administrative controls (e.g., budget and acquisition policies and procedures) and requirements that will be used to provide resource and expenditure accountability;</li>
                    <li>Briefly describe how the school will maintain accurate logs of key activities;</li>
                    <li>Briefly describe how vital records (e.g., student records) will be preserved (details may be contained in a Continuity of Operations functional annex); and</li>
                    <li>Identify general policies for keeping financial records, tracking resource needs, tracking the source and use of resources, acquiring ownership of resources, and compensating the owners of private property used by the school.</li><br />
                </ul>
            </ul></td>
    </tr>
    <tr>
        <td><strong>In the field below, please cut and paste, write out or upload the Administration, Finance, and Logistics section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td><textarea aria-label="administration" name="adminField" id="adminField" style="width: 100%"   <?php echo($controlStatus); ?>  rows="11">
                <?php echo(isset($child1['fields'][0]['body'])? $child1['fields'][0]['body']: ''); ?>
            </textarea>            </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div align="left">
                <?php if($action != 'view'): ?>
                    <?php if($action=='add'): ?>
                        <input aria-label="save" type="button" value="Save" id="btnsaveform8"/>
                        <?php else: ?>
                        <input aria-label="update" type="button" value="Update" id="btnsaveform8"/>
                    <?php endif; ?>
                <?php endif; ?>

                <input aria-label="cancel" type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>" id="cancelBtn8"/>
            </div></td>
    </tr>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">


$(document).ready(function(){

    $( 'textarea' ).ckeditor();

    $("#btnsaveform8").click(function(){

        var formData = {
            ajax:               '1',
            action:             '<?php echo $action; ?>',
            entityId:           '<?php echo(isset($entityId)? $entityId : null); ?>',
            adminFieldId:     '<?php echo(isset($child1['fields'][0]['id'])? $child1['fields'][0]['id'] : null); ?>',
            adminField:       $("#adminField").val()

        };
        $.ajax({
            url:    '<?php echo(base_url('plan/manageForm8')); ?>',
            data:   formData,
            type:   'POST',
            success: function(response){
                try{
                    //alert(response);
                    location.reload();

                }catch(err){
                    alert('Problem loading controls ' + err);
                }
            }

        });

        $("#form8Div").html('');
        return false;
    });

    $("#cancelBtn8").click(function(){
        $("#form8Div").html('');
        return false;
    });

    });
</script>