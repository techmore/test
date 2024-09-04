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
    $child2=array();
    $child3=array();
    $child4=array();

    foreach($entities as $entity_key=>$entity){
        foreach($entity['children'] as $child_key=>$child){
            switch($child['name']){
                case '2.1':
                    $child1 = $child;
                    break;
                case '2.2':
                    $child2 = $child;
                    break;
                case '2.3':
                    $child3 = $child;
                    break;
                case '2.4':
                    $child4 = $child;
                    break;
            }
        }
    }
}
?>
<table border="0" width="100%">
    <tr>
        <td colspan="2"><p><u><p>2.1 Purpose</p></u>
                The purpose sets the foundation for the rest of the school EOP. The basic plan&rsquo;s purpose is a general statement of what the school EOP is meant to do. The statement should be supported by a brief synopsis of the basic plan and annexes.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste, write out or upload the Purpose section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2"><textarea aria-label="purpose" name="purposeField" id="purposeField"  <?php echo($controlStatus); ?> style="width: 100%" rows="11"><?php echo(isset($child1['fields'][0]['body'])? $child1['fields'][0]['body']: ''); ?></textarea>            </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><p><u>2.2 Scope</u></p>
            <p>
                The EOP should explicitly state the scope of emergency and disaster response and the entities (e.g., departments, agencies, private sector, citizens) and geographic areas to which the plan applies.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste, write out or upload the Scope section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2"><textarea aria-label="scope" name="scopeField" id="scopeField"  <?php echo($controlStatus); ?>  style="width: 100%" rows="11"><?php echo(isset($child2['fields'][0]['body'])? $child2['fields'][0]['body']: ''); ?></textarea>            </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><p><u>2.3 Situation Overview</u></p>
            <p>
                The situation section explains why a school EOP is necessary and provides a general discussion of the threats and hazards that pose a risk to the school&#8212;and would result in a need to use this plan&#8212;as well as the dependencies on parties outside the school for critical resources.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste, write out or upload the Situation Overview section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2"><textarea aria-label="situation" name="situationField" id="situationField"  <?php echo($controlStatus); ?>  style="width: 100%" rows="11"><?php echo(isset($child3['fields'][0]['body'])? $child3['fields'][0]['body']: ''); ?></textarea>            </td>
    </tr>
    <tr>
        <td colspan="2"><p><u>2.4. Planning Assumptions</u></p>
            <p>The Planning Assumptions section identifies what the planning team assumes to be facts for planning purposes in order to make it possible to execute the EOP. During operations, the assumptions indicate areas where adjustments to the plan have to be made as the facts of the incident become known. The aassumptions also provide the opportunity to communicate the intent of senior officials regarding emergency operations priorities.</p></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste, write out or upload the Planning Assumptions section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2">
            <textarea aria-label="assumption" name="assumptionsField" id="assumptionsField"  <?php echo($controlStatus); ?>  style="width: 100%" rows="11"><?php echo(isset($child4['fields'][0]['body'])? $child4['fields'][0]['body']: ''); ?></textarea>            </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div align="left">
                <?php if($action != 'view'): ?>
                    <?php if($action=='add'): ?>
                        <input aria-label="Save" type="button" value="Save" id="btnsaveform2"/>
                        <?php else: ?>
                        <input aria-label="Update" type="button" value="Update" id="btnsaveform2"/>
                    <?php endif; ?>
                <?php endif; ?>

                <input aria-label="Cancel" type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>" id="cancelBtn2"/>
            </div>
        </td>
    </tr>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">


$(document).ready(function(){

    $( 'textarea' ).ckeditor();

    $("#btnsaveform2").click(function(){

        var formData = {
            ajax:               '1',
            action:             '<?php echo $action; ?>',
            entityId:           '<?php echo(isset($entityId)? $entityId : null); ?>',
            purposeFieldId:     '<?php echo(isset($child1['fields'][0]['id'])? $child1['fields'][0]['id'] : null); ?>',
            purposeField:       $("#purposeField").val(),
            scopeFieldId:       '<?php echo(isset( $child2['fields'][0]['id'])?  $child2['fields'][0]['id']: null); ?>',
            scopeField:         $("#scopeField").val(),
            situationFieldId:   '<?php echo(isset( $child3['fields'][0]['id'])?  $child3['fields'][0]['id']: null); ?>',
            situationField:     $("#situationField").val(),
            assumptionsFieldId: '<?php echo(isset($child4['fields'][0]['id'])? $child4['fields'][0]['id']: null); ?>',
            assumptionsField:   $("#assumptionsField").val()

        };
        $.ajax({
            url:    '<?php echo(base_url('plan/manageForm2')); ?>',
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

        $("#form2Div").html('');
        return false;
    });

    $("#cancelBtn2").click(function(){
        $("#form2Div").html('');
        return false;
    });

    });
</script>