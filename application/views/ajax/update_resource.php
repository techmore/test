<?php

/**
 * resource FORM
 *
 * Create New Toolkit Resource Form
 * For creating a new Toolkit Resource
 */

//Divide into Home and Planning Process pages
$homePages       =   array();
$step1Pages      =   array();
$step2Pages      =   array();
$step3Pages      =   array();
$step4Pages      =   array();
$step5Pages      =   array();
$step6Pages      =   array();
$pageIDs = array();

foreach($pages as $key=>$pageValue){
    $step = strstr($pageValue['name'], '_', true);

    if($pageValue['name']=='home')
        array_push($homePages, $pageValue);

    switch($step){
        case 'step':
            array_push($homePages, $pageValue);
            break;
        case 'step1':
            array_push($step1Pages, $pageValue);
            break;
        case 'step2':
            array_push($step2Pages, $pageValue);
            break;
        case 'step3':
            array_push($step3Pages, $pageValue);
            break;
        case 'step4':
            array_push($step4Pages, $pageValue);
            break;
        case 'step5':
            array_push($step5Pages, $pageValue);
            break;
        case 'step6':
            array_push($step6Pages, $pageValue);
            break;
    }
}

if(count($resource['pages']) >0){
    foreach ($resource['pages'] as $value){
        array_push($pageIDs, $value['id']);
    }
}

?>

    <div id="addResourceContainer">
        <?php echo form_open_multipart('toolkit/update', array('class'=>'resourceManagementFormUpdate', 'id'=>'resourceManagementFormUpdate')); ?>

        <input type="hidden" name="updateid" id="updateid" value="<?php echo($resource['id']);?>" />

        <fieldset>

            <table class="tmform">

                <tr>
                    <td colspan="2">
                        <p>Please use the form below to update the selected toolkit resource.</p>

                    </td>
                </tr>
                <tr>
                    <td class="txtb" style="width:15%;"><span class="required">*</span>Name:</td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtnameupdate',
                            'id'        =>  'txtnameupdate',
                            'required'  =>  'required',
                            'minlength'  =>  '3',
                            'size'      =>   '70',
                            'value'     =>    $resource['name'],
                            'aria-label' => "name"
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>

                    <td class="txtb"><span class="required">*</span>URL:</td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtURLUpdate',
                            'id'        =>  'txtURLUpdate',
                            'required'  =>  'required',
                            'minlength'  =>  '3',
                            'size'      =>   '70',
                            'value'     =>  $resource['url'],
                            'aria-labe' => "URL"
                        );
                        echo form_input($inputAttributes);
                        ?>

                        <input type="file" name="userfileupdate" id="userfileupdate" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-doc, .doc, .docx, .pdf" />
                        <p style="font-size: 11px; font-style: italic;">Enter the full URL path of the resource for example: [http://www.domain.com/resource.pdf] or upload a file. </p>
                    </td>
                </tr>

                <tr >
                    <td class="txtb"><span class="required">*</span> Section:</td>
                    <td>
                        <?php
                        $options = array();
                        $options[''] = '--Select--';
                        $options['Guidance']    =   'Guidance';
                        $options['Resources']    =   'Resources';
                        $options['Examples']    =   'Examples';
                        $otherAttributes = 'id="slctsectionupdate" aria-label="section" required style=""';
                        reset($options);
                        echo form_dropdown('slctsectionupdate', $options, $options[$resource['section']], $otherAttributes);
                        ?>
                    </td>
                </tr>

                <tr>
                    <td class="txtb">Page(s) Applicable:</td>
                    <td><input type="button" value="Select All" id="select-allupdate" /> <input type="button" value="Deselect All" id="deselect-allupdate" /> </td>
                </tr>

                <tr>
                    <td colspan="2"><hr/></td>
                </tr>
                <tr>

                    <td colspan="2">
                        <table class="sctable pages_display">
                            <tr>
                                <td colspan="5"><span><strong>HOME</strong></span></td>
                            </tr>
                            <tr>
                                <?php
                                $blanks = (5 - count($homePages));
                                ?>

                                <?php foreach($homePages as $key=>$homePage): ?>
                                    <td>
                                        <?php
                                        $inputAttributes = array(
                                            'name'      => 'pagesupdate[]',
                                            'value'     =>  $homePage['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkboxupdate'.$homePage['id'],
                                            'class'     =>  'interestChkBox',
                                            'checked'   =>  in_array($homePage['id'], $pageIDs),
                                            'aria-label'=> 'home'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkboxupdate<?php echo($homePage['id']); ?>"><?php echo($homePage['title']); ?></label>
                                    </td>
                                <?php endforeach; ?>
                                <?php for($i=0; $i<$blanks; $i++): ?>
                                    <td></td>
                                <?php endfor; ?>
                            </tr>

                            <tr>
                                <td colspan="5"><hr/></td>
                            </tr>
                            <tr>
                                <td colspan="5"><span><strong>STEP 1</strong></span></td>
                            </tr>
                            <tr>
                                <?php
                                $blanks = (5 - count($step1Pages));
                                ?>

                                <?php foreach($step1Pages as $key=>$step1Page): ?>
                                    <td>
                                        <?php
                                        $inputAttributes = array(
                                            'name'      => 'pagesupdate[]',
                                            'value'     =>  $step1Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkboxupdate'.$step1Page['id'],
                                            'class'     =>  'interestChkBox',
                                            'checked'   =>  in_array($step1Page['id'], $pageIDs),
                                            'aria-label'=> 'step 1'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkboxupdate<?php echo($step1Page['id']); ?>"><?php echo($step1Page['title']); ?></label>
                                    </td>
                                <?php endforeach; ?>
                                <?php for($i=0; $i<$blanks; $i++): ?>
                                    <td></td>
                                <?php endfor; ?>
                            </tr>

                            <tr>
                                <td colspan="5"><hr/></td>
                            </tr>
                            <tr>
                                <td colspan="5"><span><strong>STEP 2</strong></span></td>
                            </tr>
                            <tr>
                                <?php
                                $blanks = (5 - count($step2Pages));
                                ?>

                                <?php foreach($step2Pages as $key=>$step2Page): ?>
                                    <td>
                                        <?php
                                        $inputAttributes = array(
                                            'name'      => 'pagesupdate[]',
                                            'value'     =>  $step2Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkboxupdate'.$step2Page['id'],
                                            'class'     =>  'interestChkBox',
                                            'checked'   =>  in_array($step2Page['id'], $pageIDs),
                                            'aria-label'=> 'step 2'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkboxupdate<?php echo($step2Page['id']); ?>"><?php echo($step2Page['title']); ?></label>
                                    </td>
                                <?php endforeach; ?>
                                <?php for($i=0; $i<$blanks; $i++): ?>
                                    <td></td>
                                <?php endfor; ?>
                            </tr>

                            <tr>
                                <td colspan="5"><hr/></td>
                            </tr>

                            <tr>
                                <td colspan="5"><span><strong>STEP 3</strong></span></td>
                            </tr>
                            <tr>
                                <?php
                                $blanks = (5 - count($step3Pages));
                                ?>

                                <?php foreach($step3Pages as $key=>$step3Page): ?>
                                    <td>
                                        <?php
                                        $inputAttributes = array(
                                            'name'      => 'pagesupdate[]',
                                            'value'     =>  $step3Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkboxupdate'.$step3Page['id'],
                                            'class'     =>  'interestChkBox',
                                            'checked'   =>  in_array($step3Page['id'], $pageIDs),
                                            'aria-label'=> 'step 3'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkboxupdate<?php echo($step3Page['id']); ?>"><?php echo($step3Page['title']); ?></label>
                                    </td>
                                <?php endforeach; ?>
                                <?php for($i=0; $i<$blanks; $i++): ?>
                                    <td></td>
                                <?php endfor; ?>
                            </tr>

                            <tr>
                                <td colspan="5"><hr/></td>
                            </tr>

                            <tr>
                                <td colspan="5"><span><strong>STEP 4</strong></span></td>
                            </tr>
                            <tr>
                                <?php
                                $blanks = (5 - count($step4Pages));
                                ?>

                                <?php foreach($step4Pages as $key=>$step4Page): ?>
                                    <td>
                                        <?php
                                        $inputAttributes = array(
                                            'name'      => 'pagesupdate[]',
                                            'value'     =>  $step4Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkboxupdate'.$step4Page['id'],
                                            'class'     =>  'interestChkBox',
                                            'checked'   =>  in_array($step4Page['id'], $pageIDs),
                                            'aria-label'=> 'step 4'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkboxupdate<?php echo($step4Page['id']); ?>"><?php echo($step4Page['title']); ?></label>
                                    </td>
                                <?php endforeach; ?>
                                <?php for($i=0; $i<$blanks; $i++): ?>
                                    <td></td>
                                <?php endfor; ?>
                            </tr>

                            <tr>
                                <td colspan="5"><hr/></td>
                            </tr>

                            <tr>
                                <td colspan="5"><span><strong>STEP 5</strong></span></td>
                            </tr>
                            <tr>
                                <?php
                                $blanks = (5 - count($step5Pages));
                                ?>

                                <?php foreach($step5Pages as $key=>$step5Page): ?>
                                    <td>
                                        <?php
                                        $inputAttributes = array(
                                            'name'      => 'pagesupdate[]',
                                            'value'     =>  $step5Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkboxupdate'.$step5Page['id'],
                                            'class'     =>  'interestChkBox',
                                            'checked'   =>  in_array($step5Page['id'], $pageIDs),
                                            'aria-label'=> 'step 5'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkboxupdate<?php echo($step5Page['id']); ?>"><?php echo($step5Page['title']); ?></label>
                                    </td>
                                <?php endforeach; ?>
                                <?php for($i=0; $i<$blanks; $i++): ?>
                                    <td></td>
                                <?php endfor; ?>
                            </tr>

                            <tr>
                                <td colspan="5"><hr/></td>
                            </tr>

                            <tr>
                                <td colspan="5"><span><strong>STEP 6</strong></span></td>
                            </tr>
                            <tr>
                                <?php
                                $blanks = (5 - count($step6Pages));
                                ?>

                                <?php foreach($step6Pages as $key=>$step6Page): ?>
                                    <td>
                                        <?php
                                        $inputAttributes = array(
                                            'name'      => 'pagesupdate[]',
                                            'value'     =>  $step6Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkboxupdate'.$step6Page['id'],
                                            'class'     =>  'interestChkBox',
                                            'checked'   =>  in_array($step6Page['id'], $pageIDs),
                                            'aria-label'=> 'step 6'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkboxupdate<?php echo($step6Page['id']); ?>"><?php echo($step6Page['title']); ?></label>
                                    </td>
                                <?php endforeach; ?>
                                <?php for($i=0; $i<$blanks; $i++): ?>
                                    <td></td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td colspan="5"><hr/></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td  align="left" colspan="5">
                        <input type="hidden" id="entity_identifier" value="<?php echo($resource['id']);?>" />
                        <?php
                        $attributes = array(
                            'name'  =>  'btnsave',
                            'value' =>  'Save',
                            'id'    =>  'btnsave',
                            'style' =>  ''
                        );
                        ?>
                        <?php echo form_submit($attributes); ?>

                        <?php
                        $attributes = array(
                            'name' => 'btnreset',
                            'value' => 'Cancel',
                            'id' => 'cancelBtn',
                            'style' => ''
                        );
                        ?>
                        <?php echo form_reset($attributes); ?>

                    </td>

                </tr>
            </table>
        </fieldset>
        <?php
        echo form_close();
        ?>
    </div>
