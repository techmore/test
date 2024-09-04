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
                case '3.1':
                    $child1 = $child;
                    break;
            }
        }
    }
}
?>
<table border="0" width="100%">
    <tr>
        <td colspan="2">
            <table width="90%" border="0">
                <tbody>
                <tr>
                    <td><p>The Concept of Operations (CONOPS) section explains in broad terms the school administrator&rsquo;s intent regarding an operation. This section is designed to provide an overall picture of how the school will work to protect students, staff members, and visitors, and should:</p>
                        <ul>
                            <ul>
                                <li>Identify those with authority to activate the plan (e.g., school administrators);</li>
                                <li>Describe the process by which the school coordinates with all appropriate agencies, boards, or divisions within the jurisdiction;</li>
                                <li>Describe how plans take into account the architectural, programmatic, and communication rights of individuals with disabilities and other access and functional needs;</li>
                                <li>Identify other response and support agency plans that directly support the implementation of this plan (e.g., city or county EOP, school EOPs from schools co-located on the grounds);</li>
                                <li>Explain that the primary purpose of actions taken before an emergency is to prevent, protect from, and mitigate the impact of an emergency on life or property;</li>
                                <li>Explain that the primary purpose of actions taken during an emergency is to respond to the emergency and minimize its impact on life or property; and</li>
                                <li>Explain that the primary purpose of actions taken after an emergency is to recover from its impact on life or property.</li><br />
                            </ul>
                        </ul></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2"><strong>In the field below, please cut and paste, write out or upload the CONOPS section of your school EOP.</strong></td>
    </tr>
    <tr>
        <td colspan="2"><textarea aria-label="concept" name="conceptField" id="conceptField"   <?php echo($controlStatus); ?> style="width: 100%" rows="11"><?php echo(isset($child1['fields'][0]['body'])? $child1['fields'][0]['body']: ''); ?></textarea>            </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <div align="left">
                <?php if($action != 'view'): ?>
                    <?php if($action=='add'): ?>
                        <input aria-label="save" type="button" value="Save" id="btnsaveform3"/>
                        <?php else: ?>
                        <input aria-label="update" type="button" value="Update" id="btnsaveform3"/>
                    <?php endif; ?>
                <?php endif; ?>

                <input aria-label="cancel" type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>" id="cancelBtn3"/>
            </div></td>
    </tr>
</table>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">


$(document).ready(function(){

    $( 'textarea' ).ckeditor();

    $("#btnsaveform3").click(function(){

        var formData = {
            ajax:               '1',
            action:             '<?php echo $action; ?>',
            entityId:           '<?php echo(isset($entityId)? $entityId : null); ?>',
            conceptFieldId:     '<?php echo(isset($child1['fields'][0]['id'])? $child1['fields'][0]['id'] : null); ?>',
            conceptField:       $("#conceptField").val()
        };
        $.ajax({
            url:    '<?php echo(base_url('plan/manageForm3')); ?>',
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

        $("#form3Div").html('');
        return false;
    });

    $("#cancelBtn3").click(function(){
        $("#form3Div").html('');
        return false;
    });

    });
</script>