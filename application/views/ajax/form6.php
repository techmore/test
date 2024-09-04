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
                case '6.1':
                    $child1 = $child;
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
                    <td><p>The Information Collection, Analysis, and Dissemination section addresses the role of information in the successful implementation of the activities that occur before, during, and after an emergency. This section should identify the type of information that will be helpful in the successful implementation of the activities that occur before, during, and after an emergency, such as the following:</p>
                        <ul>
                            <ul>
                                <li>Before and during: weather reports, law enforcement alerts, National Oceanic and Atmospheric Administration radio alerts, crime reports; and</li>
                                <li>After: mental health agencies&rsquo; websites and hotlines, and emergency management and relief agencies&rsquo; websites and hotlines assisting in all aspects of recovery.</li>
                            </ul>
                        </ul><br />
                        <p>For each of the identified types of information, this section should address the following questions:</p>
                        <ul>
                            <ul>
                                <li>What is the source of the information?</li>
                                <li>Who analyzes and uses the information?</li>
                                <li>How is the information collected and shared?</li>
                                <li>What is the format for providing the information to those who will use it?</li>
                                <li>When should the information be collected and shared?</li><br />
                            </ul>
                        </ul></td>
                </tr>
                </tbody>
            </table></td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste, write out or upload the Information Collection, Analysis, and Dissemination section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2">
            <textarea aria-label="information" name="infoField" id="infoField" style="width: 100%"   <?php echo($controlStatus); ?>  rows="11">
                <?php echo(isset($child1['fields'][0]['body'])? $child1['fields'][0]['body']: ''); ?>
            </textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div align="left">
                <?php if($action != 'view'): ?>
                    <?php if($action=='add'): ?>
                        <input aria-label="save" type="button" value="Save" id="btnsaveform6"/>
                        <?php else: ?>
                        <input aria-label="update" type="button" value="Update" id="btnsaveform6"/>
                    <?php endif; ?>
                <?php endif; ?>

                <input aria-label="cancel" type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>" id="cancelBtn6"/>
            </div></td>
    </tr>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">


$(document).ready(function(){

    $( 'textarea' ).ckeditor();

    $("#btnsaveform6").click(function(){

        var formData = {
            ajax:               '1',
            action:             '<?php echo $action; ?>',
            entityId:           '<?php echo(isset($entityId)? $entityId : null); ?>',
            infoFieldId:     '<?php echo(isset($child1['fields'][0]['id'])? $child1['fields'][0]['id'] : null); ?>',
            infoField:       $("#infoField").val()

        };
        $.ajax({
            url:    '<?php echo(base_url('plan/manageForm6')); ?>',
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

        $("#form6Div").html('');
        return false;
    });

    $("#cancelBtn6").click(function(){
        $("#form6Div").html('');
        return false;
    });

    });
</script>