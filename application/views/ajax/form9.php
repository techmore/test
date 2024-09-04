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
                case '9.1':
                    $child1 = $child;
                    break;
            }
        }
    }
}
?>
<table border="0" width="100%">
    <tr>
        <td colspan="2"><p>The Plan Development and Maintenance section describes the overall approach to planning and the assignment of plan development and maintenance responsibilities. This section:</p>
            <ul>
                <ul>
                    <li>Describes the planning process, participants in that process, and how development and revision of different sections of the school EOP (basic plan and annexes) are coordinated before an emergency;</li>
                    <li>Assigns responsibility for the overall planning and coordination to a specific position or person; and</li>
                    <li>Provides for a regular cycle of training, evaluating, reviewing, and updating the school EOP.</li>
                </ul>
            </ul><br />
            <p>The planning team may want to consider including a review timeline in this section of the plan.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste, write out or upload the Plan Development and Maintenance section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2"><textarea  aria-label="Plan" name="planField" id="planField" style="width: 100%"   <?php echo($controlStatus); ?> rows="11">
                <?php echo(isset($child1['fields'][0]['body'])? $child1['fields'][0]['body']: ''); ?>
            </textarea>            </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div align="left">
                <?php if($action != 'view'): ?>
                    <?php if($action=='add'): ?>
                        <input aria-label="save" type="button" value="Save" id="btnsaveform9"/>
                        <?php else: ?>
                        <input aria-label="update" type="button" value="Update" id="btnsaveform9"/>
                    <?php endif; ?>
                <?php endif; ?>

                <input aria-label="cancel" type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>" id="cancelBtn9"/>
            </div></td>
    </tr>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">


$(document).ready(function(){

    $( 'textarea' ).ckeditor();

    $("#btnsaveform9").click(function(){

        var formData = {
            ajax:               '1',
            action:             '<?php echo $action; ?>',
            entityId:           '<?php echo(isset($entityId)? $entityId : null); ?>',
            planFieldId:     '<?php echo(isset($child1['fields'][0]['id'])? $child1['fields'][0]['id'] : null); ?>',
            planField:       $("#planField").val()

        };
        $.ajax({
            url:    '<?php echo(base_url('plan/manageForm9')); ?>',
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

        $("#form9Div").html('');
        return false;
    });

    $("#cancelBtn9").click(function(){
        $("#form9Div").html('');
        return false;
    });

    });
</script>