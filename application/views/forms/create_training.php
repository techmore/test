<link rel="stylesheet" href="<?php echo base_url();?>assets/css/forms.css" />

<?php
echo form_open_multipart('training/add', array('class'=>'newTrainingForm', 'id'=>'newTrainingForm'));
//echo form_hidden('ajax', '1');
$school_loaded = (isset($this->session->userdata['loaded_school']['id']) && null != $this->session->userdata['loaded_school']['id']) ? true : false;
?>

<fieldset>

    <table class="tmform">

        <tr>
            <td colspan="2">
                <?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
	
		<p>Keep a record of trainings that your district has conducted. Add each training separately. Type the name or title of the training and add the accompanying details into the corresponding fields. To document the training as a district-provided training initiative, select the appropriate box. Click Save to record information for each emergency exercise, and repeat this process as many times as necessary to add all emergency exercises conducted into EOP ASSIST.</p>
<p>If you wish to modify existing information, click Edit for the chosen training. A prepopulated field will appear with previously saved information. After editing the available field, click Save. Likewise, to remove a training from the list, click Delete. You will be asked to confirm this deletion. Click Yes to confirm or Cancel if you clicked Delete in error.</p>
		<?php else: ?>
				<p>Keep a record of trainings that your team has conducted. Add each training separately. Type the name or title of the training and add the accompanying details into the corresponding fields. Click Save to record information for each emergency exercise, and repeat this process as many times as necessary to add all emergency exercises conducted into EOP ASSIST.</p>
<p>If you team wish to modify existing information, click Edit for the chosen training. A prepopulated field will appear with previously saved information. After editing the available field, click Save. Likewise, to remove a training from the list, click Delete. You will be asked to confirm this deletion. Click Yes to confirm or Cancel if you clicked Delete in error. </p>
	<?php endif; ?>
            </td>
        </tr>
        <tr>
            <td class="txtb"><span class="required" aria-required="true">*</span> Title:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txtName',
                    'id'        =>  'txtName',
                    'minlength'  =>  '3',
                    'size'      =>   '70',
                    'required'  =>  'required',
                    'aria-label'=> 'Title'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>
        <tr>
            <td class="txtb"><span class="required" aria-required="true">*</span> <label for="txtTopic">Topic:</label></td>
            <td>
                <?php


                $topicOptions = array(
                    'Developing high-quality EOPs'                                                =>  'Developing high-quality EOPs',
                    'Developing and enhancing memoranda of understanding with community partners' => 'Developing and enhancing memoranda of understanding with community partners',
                    'Supporting the implementation of the National Incident Management System'    =>  'Supporting the implementation of the National Incident Management System',
                    'Access and functional needs'                                                 =>  'Access and functional needs');
                if($custom_topics && count($custom_topics)){
                    foreach($custom_topics as $topic){
                        $topicOptions[$topic['topic']] = $topic['topic'];
                    }
                }

                ksort($topicOptions, SORT_STRING);
                $topicOptions['Other related emergency management topic'] = 'Other related emergency management topic';


                $inputAttributes = array(
                    'name'      =>  'txtTopic',
                    'id'        =>  'txtTopic',
                    'required'  =>  'required',
                    'options'   => $topicOptions,
                    'selected'  =>  'Developing high-quality EOPs',
                    'aria-label'=>'Topic'
                );
                echo form_dropdown($inputAttributes);
                ?>
            </td>
        </tr>

        <tr id="otherTopic">
            <td class="txtb"> </td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'          =>  'txtOtherTopic',
                    'id'            =>  'txtOtherTopic',
                    'placeholder'   =>  'Add custom topic'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>

        <tr>
            <td class="txtb">Format:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txtFormat',
                    'id'        =>  'txtFormat',
                    'aria-label'=>'Format'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>

        <tr>
            <td class="txtb">Date:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txtDate',
                    'id'        =>  'txtDate',
                    'aria-label'=>'Date'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>

        <tr>
            <td class="txtb">Location:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txtLocation',
                    'id'        =>  'txtLocation',
                    'minlength' =>  '3',
                    'size'      =>  '70',
                    'aria-label'=>  'Location'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>

        <tr>
            <td class="txtb"><span class="required" aria-required="true">*</span> Number of participants:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txtParticipants',
                    'id'        =>  'txtParticipants',
                    'minlength' =>  '1',
                    'size'      =>  '20',
                    'type'      =>  'number',
                    'value'     =>  0,
                    'aria-label'=>'Number of participants'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>


        <tr>
            <td class="txtb">Key Personnel in Attendance:</td>
            <td>
                <?php

                $personnel_options= array('Executive leaders', 'General personnel', 'Critical personnel/ command staff', 'Leadership/ incident managers');

                foreach ($personnel_options as $key=>$personnel){
                    $data = array(
                                        'name'      =>  'checkPersonnel[]',
                                        'id'        =>  'chk_personnel_'.$key,
                                        'value'     =>  "$personnel",
                                        'checked'   => false,
                                        'style'     => '',
                                        'aria-label'=> $personnel
                                    );
                    echo form_checkbox($data);
                    echo form_label($personnel, 'chk_personnel_'.$key);
                    echo(($key<count($personnel_options)-1) ? '<br />': '');
                }
                ?>
            </td>
        </tr>


        <tr>
            <td class="txtb">Evaluation Score:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txtScore',
                    'id'        =>  'txtScore',
                    'minlength' =>  '1',
                    'size'      =>  '20',
                    'aria-label'=>'Evaluation Score'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>


        <tr>
            <td class="txtb" >Description:</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txtDescription',
                    'id'        =>  'txtDescription',
                    'cols'      =>  '50',
                    'rows'      =>  '6',
                    'aria-label'=> 'Description'
                );
                echo form_textarea($inputAttributes);
                ?>
            </td>
        </tr>

        <tr>
            <td class="txtb">Attachment:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'fileupload',
                    'id'        =>  'fileupload',
                    'aria-label'=> 'Attachment'
                );
                echo form_upload($inputAttributes);
                ?>
            </td>
        </tr>


        <?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && $school_loaded){ ?>
            <tr>
                <td class="txtb"></td>
                <td>
                    <?php echo form_checkbox(array('name'=>'chk_providedBy', 'id'=>'chk_providedBy', 'value'=>'district-provided', 'checked'=>false)); ?>
                    <?php echo form_label('This is a district-provided training initiative.', 'chk_providedBy'); ?>
                    <?php echo form_hidden('providedBy', ''); ?>
                </td>
            </tr>
    
            <tr class="district-provided">
                <td class="txtb"><span class="required" aria-required="true">*</span> Number of Schools:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'txtSchools',
                        'id'        =>  'txtSchools',
                        'minlength' =>  '1',
                        'size'      =>  '20',
                        'value'     =>  '0',
                        'type'      =>  'number',
                        'aria-label'=> 'Number of Schools'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
        <?php }elseif($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && !$school_loaded){ ?>
            <tr>
                <td class="txtb"></td>
                <td>
                    <?php echo form_checkbox(array('name'=>'chk_providedBy', 'id'=>'chk_providedBy', 'value'=>'district-provided', 'disabled'=>'disabled', 'checked'=>true)); ?>
                    <?php echo form_label('This is a district-provided training initiative.', 'chk_providedBy'); ?>
                    <?php echo form_hidden('providedBy', 'district-provided'); ?>
                </td>
            </tr>
            <tr class="district-provided">
                <td class="txtb"><span class="required" aria-required="true">*</span> Number of Schools:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'txtSchools',
                        'id'        =>  'txtSchools',
                        'minlength' =>  '1',
                        'size'      =>  '20',
                        'value'     =>  '0',
                        'type'      =>  'number',
                        'aria-label'=> 'Number of Schools'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
        <?php }else{ ?>
            <tr>
                <td></td>
                <td><?php echo form_hidden('providedBy', 'school-provided'); ?></td>
            </tr>

        <?php } ?>

        <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL): ?>
            <tr>
                <td class="txtb">Number of LEAs Trained:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'txtLEAs',
                        'id'        =>  'txtLEAs',
                        'minlength' =>  '1',
                        'size'      =>  '20',
                        'type'      =>  'number',
                        'value'     =>  0,
                        'aria-label'=>'Number of LEAs Trained'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
    
            <tr>
                <td class="txtb"> Number of Rural LEAs Trained:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'txtRLEAs',
                        'id'        =>  'txtRLEAs',
                        'minlength' =>  '1',
                        'size'      =>  '20',
                        'type'      =>  'number',
                        'value'     =>  0,
                        'aria-label'=> 'Number of Rural LEAs Trained'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
        <?php endif; ?>
            

        <tr>
            <td colspan="2" align="right">&nbsp;</td>
        </tr>
        <tr>
            <td align="left">
            </td>
            <td  align="left">
                <?php
                $attributes = array(
                    'name'  =>  'btnsave',
                    'value' =>  'Save',
                    'id'    =>  'btnsave',
                    'style' =>  ''
                );
                ?>
                <?php echo form_submit($attributes); ?>

                <input name="btncancel" value="Reset"  id="btncancel" style="" type="reset" >

            </td>
        </tr>
    </table>
</fieldset>
<?php
echo form_close();
?>
