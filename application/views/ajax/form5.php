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
                case '5.1':
                    $child1 = $child;
            }
        }
    }
}
?>
<table border="0" width="100%">
    <tr>
        <td colspan="2"><p>The Direction,  Control, and Coordination section describes the   framework for all direction,  control, and coordination activities in   the plan. More specifically, this  section should explain the following:</p>
            <ul>
                <ul>
                    <li><a href="#"  class="bt" title="The Incident Command System (ICS) defines the command structure used in an emergency.">The ICS structure;</a></li>
                    <li>The relationship between the school EOP and  the district, or the broader community&rsquo;s emergency management system; and</li>
                    <li>Who has control of the equipment, resources,  and supplies needed to support the school EOP.</li><br />
                </ul>
            </ul></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste, write out or upload the Direction, Control, and Coordination section of    your school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2">
            <textarea aria-label="direction" name="directionField" id="directionField"   <?php echo($controlStatus); ?> style="width: 100%" rows="11">
                <?php echo(isset($child1['fields'][0]['body'])? $child1['fields'][0]['body']: ''); ?>
            </textarea>            </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div align="left">
                <?php if($action != 'view'): ?>
                    <?php if($action=='add'): ?>
                        <input aria-label="save" type="button" value="Save" id="btnsaveform5"/>
                        <?php else: ?>
                        <input aria-label="update" type="button" value="Update" id="btnsaveform5"/>
                    <?php endif; ?>
                <?php endif; ?>

                <input aria-label="cancel" type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>" id="cancelBtn5"/>
            </div></td>
    </tr>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">


$(document).ready(function(){

    $( 'textarea' ).ckeditor();

    $("#btnsaveform5").click(function(){

        var formData = {
            ajax:               '1',
            action:             '<?php echo $action; ?>',
            entityId:           '<?php echo(isset($entityId)? $entityId : null); ?>',
            directionFieldId:     '<?php echo(isset($child1['fields'][0]['id'])? $child1['fields'][0]['id'] : null); ?>',
            directionField:       $("#directionField").val()

        };
        $.ajax({
            url:    '<?php echo(base_url('plan/manageForm5')); ?>',
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

        $("#form5Div").html('');
        return false;
    });

    $("#cancelBtn5").click(function(){
        $("#form5Div").html('');
        return false;
    });

    });
</script>