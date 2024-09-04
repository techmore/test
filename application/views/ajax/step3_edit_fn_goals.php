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
        background-color: #5a5a5a !important;
    }
    table td.districtTable{
        background-color: #015D65 !important;
    }
    table td.stateTable{
        background-color: #085373 !important;
    }

    textarea {
        display:none;
    }

</style>

<!--
************************************************************************************************************************
*************************************** STEP3_4 EDIT FUNCTIONAL GOALS AND OBJECTIVES CONTROLS **************************
************************************************************************************************************************
-->
<div id="loading_overlay"></div>

<h2>Function: <em><?=$functions[0]['title']?></em></h2>

<?php foreach($functions as  $fnEntities): ?>
    <?php foreach($fnEntities['children'] as $fnChild): ?>
        <?php if($fnChild['type']=='g1' || $fnChild['type']=='g2' || $fnChild['type']=='g3'):?>
            <table class="editOne">
                <tr>
                    <td class="goal_title <?=$fnEntities['mandate']?>Table" colspan="2"><?php echo($fnChild['type_title']); ?></td>
                </tr>
                <tr>
                    <td class="txtb"></td>
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
                            <td class="txtnorm">Objective</td>
                            <td>
                                <?php foreach($grandChild['fields'] as $field): ?>
                                    <textarea
                                        aria-label="objective"
                                        name="txt<?php  echo($fnChild['type']);?>obj<?php echo($key);?>"
                                        id="txt<?php    echo($fnChild['type']);?>obj<?php echo($key);?>"
                                        step="3/4"
                                        <?php echo($controlStatus); ?>
                                        class="<?php    echo($fnChild['type']);?>Obj"
                                        data-id="<?php echo($grandChild['id']);?>"
                                        data-field-id="<?php echo($field['id']);?>"
                                        item-index = "<?php echo($key);?>"
                                        canRemove = <?php echo(($key==0)? "no": "yes"); ?>
                                        ent-type = "<?php echo($fnChild['type']); ?>"
                                        style="width:100%"
                                        rows="4"><?php echo($field['body']); ?></textarea>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if($action != 'view'): ?>
                    <tr id="addMore<?php echo($fnChild['type']);?>ObjFnRow" style=" border-top: 2px solid #DDD;">
                        <td colspan="2" align="right">
                            <a href="" id="addMore<?php echo($fnChild['type']);?>ObjFnLink">[Add More]</a> |
                            <a href="" id="remove<?php echo($fnChild['type']);?>ThRowLink">[Remove]</a>
                        </td>
                    </tr>
                <?php endif; ?>

            </table>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<?php if(isset($showActions) && $showActions==true): ?>
    <table  class="editOne">
        <tr>
            <td class="txtb">
                Courses of Action:</td>
            <td>
            <textarea
                aria-label="course of action"
                name="fn_action_txt"
                id="fn_action_txt"
                <?php echo($controlStatus); ?>
                data-field-id="<?php echo(isset($functions[0]['fields'][0]['id'])? $functions[0]['fields'][0]['id']:'0' );?>"
                rows="11" style="width:100%">
                <?php echo(isset($functions[0]['fields'][0]['body'])? $functions[0]['fields'][0]['body']:'' );?>
            </textarea>
            </td>
        </tr>
    </table>
<?php endif; ?>

<table class="editUpdate">
    <tbody>
        <tr>
            <td align="right" colspan="2">
                <div align="left">
                    <input type="hidden" id="entity_identifier" value="<?php echo($entity_id);?>" />
                    <input type="hidden" id="action_identifier" value="<?php echo($action);?>" />
                    <?php if($action !="view"): ?>
                        <!--<input id="updateBtn" type="button" value="Update"/>-->
                    <?php endif; ?>
                    <!--<input id="cancelBtn" type="button" value="<?php /*echo(($action=='view')? 'Close': 'Cancel'); */?>"/>-->
                </div>
            </td>
        </tr>
    </tbody>
</table>



<script>
    var g1Items= 0, g2Items= 0, g3Items=0;
    var g1Elements = [], g2Elements = [], g3Elements = [];

    <?php for($i=1; $i<=3; $i++): ?>

        var g<?php echo($i);?>ObjData = $.map($(".g<?php echo($i);?>Obj"), function(value, index) {
            return [$(value).val()];
        });

        g<?php echo($i);?>Items = 0;/*g<?php echo($i);?>ObjData.length - 1;*/


    <?php endfor; ?>


    $(document).ready(function(){

        //Add More and Remove controls
        <?php for($i=1; $i<=3; $i++): ?>
            $("#addMoreg<?php echo($i);?>ObjFnLink").click(function(){

                if(g<?php echo($i);?>Items == 0){
                    g<?php echo($i);?>Items ++;
                    $("#addMoreg<?php echo($i);?>ObjFnRow").after(mkObjectiveCtl(<?php echo($i);?>, g<?php echo($i);?>Items));
                    var editor = CKEDITOR.replace("g<?php echo($i);?>Item"+g<?php echo($i);?>Items+"");
                    editor.on( 'change', function( evt ) {
                        editor.updateElement();
                    });

                }else{

                    g<?php echo($i);?>Items ++;
                    g<?php echo($i);?>Items ++;
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items-1)+"Row").after(mkObjectiveCtl(<?php echo($i);?>, g<?php echo($i);?>Items));
                    var editor1 = CKEDITOR.replace("g<?php echo($i);?>Item"+g<?php echo($i);?>Items+"");
                    editor1.on( 'change', function( evt ) {
                        editor.updateElement();
                    });
                }
                return false;
            });

            $("#removeg<?php echo($i);?>ThRowLink").click(function(){

                if(g<?php echo($i);?>Items > 0){
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items)+"Row").remove();
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items)).remove();

                    g<?php echo($i);?>Items --;
                }
                return false;
            });
        <?php endfor; ?>

        setTimeout(function(){
            $('textarea').ckeditor();
            $("#loading_overlay").hide();
        }, 800);


    });



    function mkObjectiveCtl( goal, items ){
        var data="";
        data+="<tr id='g"+goal+"Item"+items+"Row'>";
        data+="<td class='txnorm'>Objective</td>";
        data+="<td>";
        data+="<textarea name='g"+goal+"Item"+items+"' id='g"+goal+"Item"+items+"' class='g" + goal + "ObjNew'  style='width:100%' rows='4'></textarea>";
        data+="</td></tr>";

        return data;
    }
</script>
