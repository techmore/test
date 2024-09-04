<?php
/**
 * AJAX loaded view for Step3/3 Develop Goals for Threats and Hazards
 *
 */
$controlStatus = ($action=='view') ? "disabled" : "";
?>


<style>

    #loading_overlay{
        background-color:rgba(0,0,0, .3);
        width: 100%;
        height: 100%;
        display:block;
        position:absolute;
        z-index:10;
        left:0px;
        top:0px;
    }

    #loading_overlay img{
        opacity: .4;
        margin: auto auto;
        display: block;
        position:relative;
        top:40%;
        width:50px;
    }

    table.editUpdate,
    table.editUpdate tr td,
    table.editOne,
    table.editOne tr td,
    table.editTwo,
    table.editTwo tr td{
        background: none;
    }
    table.editOne, table.editTwo, table.editThree{
        border-bottom:none;
    }

    table td.goal_title{
        font-size: 1.5em;
        color: #FFF;
        padding-left: 40px;
        background-color: #085373 !important;
    }
    table td.schoolTable{
        background-color: #5A5A5A !important;
    }
    table td.districtTable{
        background-color: #015D65 !important;
    }
    table td.stateTable{
        background-color: #085373 !important;
    }

    textarea{ display:none; }
</style>
<!--
************************************************************************************************************************
*************************************** STEP4_3 COURSES OF ACTION CONTROLS    ******************************************
************************************************************************************************************************
-->

<div id="loading_overlay">
    <img src="<?=base_url(); ?>assets/img/loading.gif" >
</div>

<h2>Threat or Hazard: <em><?=$threats_and_hazards[0]['title']?></em></h2>

<?php foreach($threats_and_hazards as  $thEntities): ?>
    <?php foreach($thEntities['children'] as $thChild): ?>
        <?php if($thChild['type']=='g1' || $thChild['type']=='g2' || $thChild['type']=='g3'):?>
            <table class="editOne">
                <tr>
                    <td class="goal_title <?=$thEntities['mandate']?>Table" colspan="2"><?php echo($thChild['type_title']); ?></td>
                </tr>
                <tr>
                    <td class="txtb" ></td>
                    <td>
                        <?php foreach($thChild['fields'] as $field): ?>
                           <?php echo($field['body']); ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <?php
                        $fnValue="";
                    foreach($thChild['children'] as $key => $grandChild){
                        if($grandChild['type']=="fn"){
                            $fnValue = $grandChild['name'];
                        }
                    }
                ?>
                        <tr>
                            <td class="txtnorm">Function:</td>
                            <td>
                                <?php echo($fnValue); ?>
                            </td>
                        </tr>


                <?php foreach($thChild['children'] as $key => $grandChild): ?>
                    <?php if($grandChild['type']=="obj"): // Get only grandchildren of type obj ?>
                        <tr>
                            <td class="txtnorm">Objective:</td>
                            <td>
                                <?php foreach($grandChild['fields'] as $field): ?>
                                    <?php echo($field['body']); ?>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <?php
                        $fnValue="";
                        foreach($grandChild['children'] as $key => $greatGrandChild){
                            if($greatGrandChild['type']=="fn"){
                                $fnValue = $greatGrandChild['name'];
                            }
                        }
                        ?>
                        <tr>
                            <td class="txtnorm">Function:</td>
                            <td>
                                <?php echo($fnValue);?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php foreach($thChild['children'] as $key => $grandChild): ?>
                    <?php if($grandChild['type']=="ca"): // Get only grandchildren of type ca (Course of Action) ?>

                        <tr>
                            <td class="txtb">Courses of Action:</td>
                            <td>
                                <?php foreach($grandChild['fields'] as $field): ?>
                                    <textarea
                                        aria-label="course of action"
                                        name="txt<?php    echo($thChild['type']);?>ca"
                                        id="txt<?php  echo($thChild['type']);?>ca"
                                        <?php echo($controlStatus); ?>
                                        data-field-id="<?php echo($field['id']);?>"
                                        data-goal-id="<?php echo($thChild['id']); ?>"
                                        rows="11" style="width:100%">
                                                <?php echo($field['body']); ?>
                                            </textarea>
                                <?php endforeach; ?>
                            </td>
                        </tr>

                    <?php endif; ?>
                <?php endforeach; ?>



            </table>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<table class="editUpdate">
    <tbody>
        <tr>
            <td align="right" colspan="2">
                <div align="left">
                    <input type="hidden" id="entity_identifier" value="<?php echo($entity_id);?>" />
                    <input type="hidden" id="action_identifier" value="<?php echo($action);?>" />

                    <?php if($action !="view"): ?>
                        <?php if($action=='add'): ?>
                        <!--<input id="saveBtn" type="button" value="Save" />-->
                        <?php else: ?>
                           <!-- <input id="updateBtn" type="button" value="Update"/>-->
                        <?php endif; ?>
                    <?php endif; ?>

                    <!--<input id="cancelBtn" type="button" value="<?php /*echo(($action=='view')? 'Close': 'Cancel'); */?>"/>-->
                </div>
            </td>
        </tr>
    </tbody>
</table>



<script type="text/javascript">
    $( document ).ready( function() {

        setTimeout(function(){
            $('textarea').ckeditor();
            $("#loading_overlay").hide();
        }, 800);

    });
</script>