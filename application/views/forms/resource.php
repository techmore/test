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
?>

<?php if($this->session->userdata['role']['read_only']=='n'): ?>
    <input type="button" role="button" id="btnAddResource" value="Add Resource"/>
    <div id="addResourceContainer" style="display: none;">
        <?php echo form_open_multipart('toolkit/add', array('class'=>'resourceManagementForm', 'id'=>'resourceManagementForm')); ?>

        <fieldset>

            <table class="tmform">

                <tr>
                    <td colspan="2">
                        <p>Please use the form below to add resources to toolkit.</p>

                    </td>
                </tr>
                <tr>
                    <td class="txtb" style="width:15%;"><span class="required">*</span>Name:</td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtname',
                            'id'        =>  'txtname',
                            'required'  =>  'required',
                            'minlength'  =>  '3',
                            'size'      =>   '70'
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>
                    <?php //todo add upload of files ?>
                    <td class="txtb"><span class="required">*</span>Resource Link</td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtURL',
                            'id'        =>  'txtURL',
                            'required'  =>  'required',
                            'minlength'  =>  '3',
                            'size'      =>   '70'
                        );
                        echo form_input($inputAttributes);
                        ?>

                                <input type="file" name="userfile" id="userfile" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-doc, .doc, .docx, .pdf" />
                        <p style="font-size: 11px; font-style: italic;">Enter the full URL path of the resource for example: [http://www.domain.com/resource.pdf] or upload a file. </p>
                    </td>
                </tr>

                <tr>
                    <td class="txtb"><span class="required">*</span>Section:</td>
                    <td>
                        <?php
                        $options = array();
                        $options[''] = '--Select--';
                        $options['Guidance']    =   'Guidance';
                        $options['Resources']    =   'Resources';
                        $options['Examples']    =   'Examples';
                        $otherAttributes = 'id="slctsection" required style=""';
                        reset($options);
                        $first_key = key($options);
                        echo form_dropdown('slctsection', $options, "$first_key", $otherAttributes);
                        ?>
                    </td>
                </tr>

                <?php /*if($role['level'] < STATE_ADMIN_LEVEL): */?><!--
                    <tr >
                        <td class="txtb"><span class="required">*</span> Shared:</td>
                        <td>
                            <input type="hidden" name="sharedDistrictId" id="sharedDistrictId" value=""/>
                            <?php
/*                            $options = array();
                            $options[''] = '--Select--';
                            $options['state']    =   'State';
                            $options['district']    =   'District';
                            $otherAttributes = 'id="slctshared" required style=""';
                            reset($options);
                            $first_key = key($options);
                            echo form_dropdown('slctshared', $options, "$first_key", $otherAttributes);
                            */?>
                        </td>
                    </tr>
                --><?php /*endif; */?>

                <tr>
                    <td class="txtb">Page(s) Applicable:</td>
                    <td><input type="button" value="Select All" id="select-all" /> <input type="button" value="Deselect All" id="deselect-all" />  </td>
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
                                            'name'      => 'pages[]',
                                            'value'     =>  $homePage['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkbox'.$homePage['id'],
                                            'class'     =>  'interestChkBox'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkbox<?php echo($homePage['id']); ?>"><?php echo($homePage['title']); ?></label>
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
                                            'name'      => 'pages[]',
                                            'value'     =>  $step1Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkbox'.$step1Page['id'],
                                            'class'     =>  'interestChkBox'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkbox<?php echo($step1Page['id']); ?>"><?php echo($step1Page['title']); ?></label>
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
                                            'name'      => 'pages[]',
                                            'value'     =>  $step2Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkbox'.$step2Page['id'],
                                            'class'     =>  'interestChkBox'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkbox<?php echo($step2Page['id']); ?>"><?php echo($step2Page['title']); ?></label>
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
                                            'name'      => 'pages[]',
                                            'value'     =>  $step3Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkbox'.$step3Page['id'],
                                            'class'     =>  'interestChkBox'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkbox<?php echo($step3Page['id']); ?>"><?php echo($step3Page['title']); ?></label>
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
                                            'name'      => 'pages[]',
                                            'value'     =>  $step4Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkbox'.$step4Page['id'],
                                            'class'     =>  'interestChkBox'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkbox<?php echo($step4Page['id']); ?>"><?php echo($step4Page['title']); ?></label>
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
                                            'name'      => 'pages[]',
                                            'value'     =>  $step5Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkbox'.$step5Page['id'],
                                            'class'     =>  'interestChkBox'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkbox<?php echo($step5Page['id']); ?>"><?php echo($step5Page['title']); ?></label>
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
                                            'name'      => 'pages[]',
                                            'value'     =>  $step6Page['id'],
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkbox'.$step6Page['id'],
                                            'class'     =>  'interestChkBox'
                                        );
                                        echo form_checkbox($inputAttributes);
                                        ?>
                                        <label for="checkbox<?php echo($step6Page['id']); ?>"><?php echo($step6Page['title']); ?></label>
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
                            'id' => 'btnResourceReset',
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
<?php endif; ?>
