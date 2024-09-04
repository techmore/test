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
                case '4.1':
                    $child1 = $child;
                    break;

            }
        }
    }
}
?>
<table border="0" width="100%">
    <tr>
        <td colspan="2"><table width="90%" border="0">
                <tbody>
                <tr>
                    <td><p>The Organization and Assignment of Responsibilities section provides an overview of the broad roles and responsibilities of school and district staff, families, guardians, and community partners (e.g., first responders, local emergency managers, and public and mental health personnel), and of organizational functions <em>during</em> all emergencies. It accomplishes the following:</p>
                        <ul>
                            <ul>
                                <li>Describes the broad roles and responsibilities of individuals that apply <em>during</em> all emergencies.
                                    <ul>
                                        <ul>
                                            <li>Individuals whom the planning team may wish to include in this section of the plan are principals and other school administrative leaders, teachers, support personnel (e.g., instructional aides, counselors, social workers, psychologists, nurses, maintenance staff, school resource officers [SROs], cafeteria workers, bus drivers), and parents and guardians.</li>
                                            <li>The planning team may also wish to include community-based organizations represented in the EOP.</li>
                                        </ul>
                                    </ul>
                                </li>
                                <li>Describes informal and formal agreements in place for the quick activation and sharing of resources during an emergency (e.g., evacuation locations to a nearby business&rsquo;s parking lot). Agreements may be between the school and response groups (e.g., fire department, police department), neighboring schools, organizations, and businesses.</li><br />
                            </ul>
                        </ul></td>
                </tr>
                </tbody>
            </table></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste, write out or upload the Organization and Assignment of Responsibilities section of your school EOP</strong>.</td>
    </tr>
    <tr>
        <td colspan="2"><textarea aria-label="Organization" name="orgField" id="orgField"   <?php echo($controlStatus); ?> style="width: 100%" rows="11"><?php echo(isset($child1['fields'][0]['body'])? $child1['fields'][0]['body']: ''); ?></textarea>            </td>
    </tr>

    <tr>
        <td colspan="2" align="right">
            <div align="left">
                <?php if($action != 'view'): ?>
                    <?php if($action=='add'): ?>
                        <input aria-label="save" type="button" value="Save" id="btnsaveform4"/>
                        <?php else: ?>
                        <input aria-label="update" type="button" value="Update" id="btnsaveform4"/>
                    <?php endif; ?>
                <?php endif; ?>

                <input aria-label="cancel" type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>" id="cancelBtn4"/>
            </div></td>
    </tr>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">


$(document).ready(function(){

    $( 'textarea' ).ckeditor();

    $("#btnsaveform4").click(function(){

        var formData = {
            ajax:               '1',
            action:             '<?php echo $action; ?>',
            entityId:           '<?php echo(isset($entityId)? $entityId : null); ?>',
            orgFieldId:     '<?php echo(isset($child1['fields'][0]['id'])? $child1['fields'][0]['id'] : null); ?>',
            orgField:       $("#orgField").val()

        };
        $.ajax({
            url:    '<?php echo(base_url('plan/manageForm4')); ?>',
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

        $("#form4Div").html('');
        return false;
    });

    $("#cancelBtn4").click(function(){
        $("#form4Div").html('');
        return false;
    });

    });
</script>