<?php
/**
 * AJAX loaded view for Step3/3 Develop Goals for Threats and Hazards
 *
 */
$controlStatus = ($action=='view') ? "disabled" : "";
?>
<style>
    *[contenteditable="true"]
    {
        padding: 10px;
    }
    div.goalData, div.g1Obj, div.g2Obj, div.g3Obj{

    }

    /* Style a bit the inline editables. */
    .cke_editable.cke_editable_inline
    {
        cursor: pointer;
    }

    /* Once an editable element gets focused, the "cke_focus" class is
       added to it, so we can style it differently. */
    .cke_editable.cke_editable_inline.cke_focus
    {
        box-shadow: inset 0px 0px 20px 3px #ddd, inset 0 0 1px #000;
        outline: none;
        background: #eee;
        cursor: text;
    }

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
*************************************** STEP3_3 GOALS AND OBJECTIVES CONTROLS ******************************************
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
                            <textarea
                                aria-label="Goal"
                                name="txt<?php echo($thChild['type']);?>"
                                id="txt<?php echo($thChild['type']);?>"
                                <?php echo($controlStatus); ?>
                                data-id="<?php echo($thChild['id']);?>"
                                data-field-id="<?php echo($field['id']);?>"
                                style="width:100%"
                                rows="4"><?php echo($field['body']); ?></textarea>
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
                                <select
                                    aria-label="Function"
                                    name="slct<?php echo($thChild['type']);?>fn"
                                    id="slct<?php echo($thChild['type']);?>fn"
                                    <?php echo($controlStatus); ?>
                                    style="width: 65%"
                                    class="fnDropDown">
                                    <option value="" selected="selected">--Select--</option>
                                    <?php foreach($functions as $key=>$value): ?>
                                        <option value="<?php echo($value['id']);?>" <?php echo(($value['name'] == $fnValue)? "selected='selected'": "");?> >
                                            <?php echo($value['name']);?>
                                        </option>
                                    <?php endforeach; ?>
                                    <option value="">Other</option>
                                </select>

                            </td>
                        </tr>


                <?php foreach($thChild['children'] as $key => $grandChild): ?>
                    <?php if($grandChild['type']=="obj"): // Get only grandchildren of type obj ?>
                        <tr id="objRow<?php echo($thChild['type'].''.$key); ?>">
                            <td class="txnorm">Objective:</td>
                            <td>
                                <?php foreach($grandChild['fields'] as $field): ?>
                                    <textarea
                                        aria-label="Objective"
                                        name="txt<?php  echo($thChild['type']);?>obj<?php echo($key);?>"
                                        id="txt<?php    echo($thChild['type']);?>obj<?php echo($key);?>"
                                        step="3/3"
                                        <?php echo($controlStatus); ?>
                                        class="<?php    echo($thChild['type']);?>Obj"
                                        data-id="<?php echo($grandChild['id']);?>"
                                        data-field-id="<?php echo($field['id']);?>"
                                        item-index = "<?php echo($key);?>"
                                        canRemove = <?php echo(($key==0)? "no": "yes"); ?>
                                        ent-type = "<?php echo($thChild['type']); ?>"
                                        style="width:100%" rows="4"><?php echo($field['body']); ?></textarea>
                                <?php endforeach; ?>
                            </td>
                        </tr>

                        <?php
                        $fnValue="";
                        foreach($grandChild['children'] as $greatGrandChild){
                            if($greatGrandChild['type']=="fn"){
                                $fnValue = $greatGrandChild['name'];
                            }
                        }
                        ?>
                        <tr id="functionRow<?php echo($thChild['type'].''.$key); ?>">
                            <td class="txtnorm">Function:</td>
                            <td>
                                <select
                                    aria-label="Function"
                                    name="slct<?php echo($thChild['type']);?>fn<?php echo($key);?>"
                                    id="slct<?php echo($thChild['type']);?>fn<?php echo($key);?>"
                                    <?php echo($controlStatus); ?>
                                    <?php echo($controlStatus); ?>
                                    style="width: 65%"
                                    class="<?php    echo($thChild['type']);?>fn">
                                    <option value="" selected="selected">--Select--</option>
                                    <?php foreach($functions as $key=>$value): ?>
                                        <option value="<?php echo($value['id']);?>" <?php echo(($value['name'] == $fnValue)? "selected='selected'": "");?>>
                                            <?php echo($value['name']);?>
                                        </option>
                                    <?php endforeach; ?>
                                    <option value="">Other</option>
                                </select>

                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if(isset($showActions) && $showActions==true): ?>
                        <?php if($grandChild['type']=="ca"): // Get only grandchildren of type ca (Course of Action) ?>

                                <tr>
                                    <td class="txtb">
                                        Courses of Action:</td>
                                    <td>
                                        <?php foreach($grandChild['fields'] as $field): ?>
                                            <textarea
                                                aria-label="Course of action"
                                                name="txt<?php    echo($thChild['type']);?>ca"
                                                id="txt<?php  echo($thChild['type']);?>ca"
                                                <?php echo($controlStatus); ?>
                                                data-field-id="<?php echo($field['id']);?>"
                                                rows="11" style="width:100%">
                                                <?php echo($field['body']); ?>
                                            </textarea>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>

                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if($action != 'view'): ?>

                    <tr id="addMore<?php echo($thChild['type']);?>ObjFnRow">
                        <td>&nbsp;</td>
                        <td colspan="2" align="right">
                            <a href="" id="addMore<?php echo($thChild['type']);?>ObjFnLink"> Add More +</a> &nbsp;
                            <a href="" id="remove<?php echo($thChild['type']);?>ThRowLink"> Remove - </a>
                        </td>
                    </tr>
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
                        <!-- <input id="saveBtn" type="button" value="<?php echo(($action=='edit')? 'Update': 'Save');?>"/> -->
                    <?php endif; ?>
                    <!-- <input id="cancelBtn" type="button" value="<?php echo(($action=='view')? 'Close': 'Cancel'); ?>"/> -->
                </div>
            </td>
        </tr>
    </tbody>
</table>




<script type="text/javascript">
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
                    var wdth = $("#g<?php echo($i);?>Item"+g<?php echo($i);?>Items+"").width();
                    var editor = CKEDITOR.replace("g<?php echo($i);?>Item"+g<?php echo($i);?>Items+"");
                    editor.on( 'change', function( evt ) {
                        editor.updateElement();
                    });

                }else{

                    g<?php echo($i);?>Items ++;
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items-1)+"Fn").after(mkObjectiveCtl(<?php echo($i);?>, g<?php echo($i);?>Items));
                    var wdth = $("#g<?php echo($i);?>Item"+g<?php echo($i);?>Items+"").width();
                    var editor1 = CKEDITOR.replace("g<?php echo($i);?>Item"+g<?php echo($i);?>Items+"");
                    editor1.on( 'change', function( evt ) {
                        editor1.updateElement();
                    });
                }
                return false;
            });

            $("#removeg<?php echo($i);?>ThRowLink").click(function(){

                if(g<?php echo($i);?>Items > 0){

                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items)+"ObjRow").remove();
                    $("#g<?php echo($i);?>Item"+(g<?php echo($i);?>Items)+"Fn").remove();

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
        data+="<tr id='g"+goal+"Item"+items+"ObjRow'>";
        data+="<td class='txnorm'>Objective:</td>";
        data+="<td>";
        data+="<textarea aria-label='Goal' name='g"+goal+"Item"+items+"' id='g"+goal+"Item"+items+"' class='g" + goal + "ObjNew'  style='width:100%' rows='4'></textarea>";
        data+="</td></tr>";
        data+="<tr id='g"+goal+"Item"+items+"Fn'>  <td class='txtnorm'>Function:</td>";
        data+="<td>  <select aria-label='Function'  style='width: 65%' class='g"+goal+"fnNew'>";
        data+="<option value='' selected='selected'>--Select--</option>";
        <?php foreach($functions as $key=>$value): ?>
            data+="<option value='<?php echo($value['id']);?>'><?php echo($value['name']);?></option>";
        <?php endforeach; ?>
        data+="<option value='other'>Other</option>";
        data+="</select>";
        data+="</td> </tr>";

        return data;
    }
</script>
