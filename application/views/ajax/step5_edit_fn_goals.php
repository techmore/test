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
*************************************** STEP5_3 EDIT FUNCTIONAL ANNEXES CONTROLS **************************
************************************************************************************************************************
-->

<div id="loading_overlay">
    <img src="<?=base_url(); ?>assets/img/loading.gif" >
</div>

<h2>Function: <em><?=$functions[0]['title']?></em></h2>

<?php foreach($functions as  $fnEntities): ?>
    <?php foreach($fnEntities['children'] as $fnChild): ?>
        <?php if($fnChild['type']=='g1' || $fnChild['type']=='g2' || $fnChild['type']=='g3'):?>
            <table class="editOne">

                <tr>
                    <td class="goal_title <?=$fnEntities['mandate']?>Table" colspan="2"><?php echo($fnChild['type_title']); ?></td>
                </tr>
                <tr>
                    <td class="txtb" ></td>
                    <td>
                        <?php foreach($fnChild['fields'] as $field): ?>
                            <textarea
                                aria-label="goal"
                                name="txt<?php echo($fnChild['type']);?>"
                                id="txt<?php echo($fnChild['type']);?>"
                                <?php echo($controlStatus); ?>
                                data-id="<?php echo($fnChild['id']);?>"
                                data-field-id="<?php echo($field['id']);?>"
                                style="width:100%"
                                rows="4"><?php echo($field['body']); ?></textarea>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <?php foreach($fnChild['children'] as $key => $grandChild): ?>
                    <?php if($grandChild['type']=="obj"): // Get only grandchildren of type obj ?>
                        <tr  id="objRow<?php echo($fnChild['type'].''.$key);?>">
                            <td class="txnorm">Objective:</td>
                            <td>
                                <?php foreach($grandChild['fields'] as $field): ?>
                                    <textarea
                                        aria-label="objective"
                                        name="txt<?php  echo($fnChild['type']);?>obj<?php echo($key);?>"
                                        id="txt<?php    echo($fnChild['type']);?>obj<?php echo($key);?>"
                                        step="5/3"
                                        <?php echo($controlStatus); ?>
                                        class="<?php    echo($fnChild['type']);?>Obj"
                                        data-id="<?php echo($grandChild['id']);?>"
                                        data-field-id="<?php echo($field['id']);?>"
                                        item-index = "<?php echo($key);?>"
                                        canRemove = <?php echo(($key==0)? "no": "yes"); ?>
                                        ent-type = "<?php echo($fnChild['type']); ?>"
                                        style="width:100%" rows="4"><?php echo($field['body']); ?></textarea>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if(isset($showActions) && $showActions==true): ?>
                    <?php foreach($fnChild['children'] as $key => $grandChild): ?>
                        <?php if($grandChild['type']=="ca"): // Get only grandchildren of type ca (Course of Action) ?>

                            <tr>
                                <td class="txtb">Courses of Action:</td>
                                <td>
                                    <?php foreach($grandChild['fields'] as $field): ?>
                                        <textarea
                                            aria-label="course of action"
                                            name="txt<?php    echo($fnChild['type']);?>ca"
                                            id="txt<?php  echo($fnChild['type']);?>ca"
                                            <?php echo($controlStatus); ?>
                                            data-field-id="<?php echo($field['id']);?>"
                                            data-goal-id="<?php echo($fnChild['id']); ?>"
                                            rows="11" style="width:100%">
                                                        <?php echo($field['body']); ?>
                                            </textarea>
                                    <?php endforeach; ?>
                                </td>
                            </tr>

                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

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
                        <input id="updateBtn" type="button" value="Update"/>
                    <?php endif; ?>

                    <input id="cancelBtn" type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>"/>
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
