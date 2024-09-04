<?php
$school_loaded = (isset($this->session->userdata['loaded_school']['id']) && null != $this->session->userdata['loaded_school']['id']) ? true : false;
echo form_open_multipart('training/update', array('class'=>'updateTrainingForm', 'id'=>'updateTrainingForm'));
?>
<input type="hidden" id="updateid" name="updateid"/>
<fieldset>

    <table>
        <tr>
            <td class="txtb"><span class="required" aria-required="true">*</span> Title:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'updateTxtName',
                    'id'        =>  'updateTxtName',
                    'minlength'  =>  '3',
                    'size'      =>   '70',
                    'required'  =>  'required',
                    'aria-label'=>'Title'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>
        <tr>
            <td class="txtb"><span class="required" aria-required="true">*</span> Topic:</td>
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
                    'name'      =>  'updateTxtTopic',
                    'id'        =>  'updateTxtTopic',
                    'required'  =>  'required',
                    'options'   =>  $topicOptions,
                    'selected'  =>  'Developing high-quality EOPs',
                    'aria-label'=>'Topic'
                );
                echo form_dropdown($inputAttributes);
                ?>
            </td>
        </tr>

        <tr id="updateOtherTopic">
            <td class="txtb"> </td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'          =>  'updateTxtOtherTopic',
                    'id'            =>  'updateTxtOtherTopic',
                    'placeholder'   =>  'Add custom topic',
                    'size'      =>  '70',
                    'aria-label'=>'Other Topic'
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
                    'name'      =>  'updateTxtFormat',
                    'id'        =>  'updateTxtFormat',
                    'size'      =>  '70',
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
                    'name'      =>  'updateTxtDate',
                    'id'        =>  'updateTxtDate',
                    'size'      =>  '70',
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
                    'name'      =>  'updateTxtLocation',
                    'id'        =>  'updateTxtLocation',
                    'minlength' =>  '3',
                    'size'      =>  '70',
                    'aria-label'=>'Location'
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
                    'name'      =>  'updateTxtParticipants',
                    'id'        =>  'updateTxtParticipants',
                    'minlength' =>  '1',
                    'size'      =>  '20',
                    'type'      =>  'number',
                    'required'  =>  'required',
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
                        'name'      =>  'updateCheckPersonnel[]',
                        'id'        =>  'update_chk_personnel_'.$key,
                        'value'     =>  "$personnel",
                        'checked'   => false,
                        'style'     => '',
                        'aria-label'=>  $personnel
                    );
                    echo form_checkbox($data);
                    echo form_label($personnel, 'update_chk_personnel_'.$key);
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
                    'name'      =>  'updateTxtScore',
                    'id'        =>  'updateTxtScore',
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
                    'name'      =>  'updateTxtDescription',
                    'id'        =>  'updateTxtDescription',
                    'cols'      =>  '50',
                    'rows'      =>  '6',
                    'aria-label'=>'Description'
                );
                echo form_textarea($inputAttributes);
                ?>
            </td>
        </tr>

        <tr>
            <td class="txtb">
                <input type="checkbox" name="checkbox_replace" id="checkbox_replace" value="no" /> <label for="checkbox_replace">Replace Attachment: </label>
            </td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'updateFileupload',
                    'id'        =>  'updateFileupload',
                    'aria-label'=>'Replace Attachment'
                );
                echo form_upload($inputAttributes);
                ?>
            </td>
        </tr>


        <?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && $school_loaded){ ?>
            <tr>
                <td class="txtb"></td>
                <td>
                    <?php echo form_checkbox(array('name'=>'update_chk_providedBy', 'id'=>'update_chk_providedBy', 'value'=>'district-provided', 'checked'=>false)); ?>
                    <?php echo form_label('This is a district-provided training initiative.', 'update_chk_providedBy'); ?>
                    <?php echo form_hidden('updateProvidedBy', ''); ?>
                </td>
            </tr>

            <tr class="update_district-provided">
                <td class="txtb"><span class="required" aria-required="true">*</span> Number of Schools:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updateTxtSchools',
                        'id'        =>  'updateTxtSchools',
                        'minlength' =>  '1',
                        'size'      =>  '20',
                        'value'     =>  '0',
                        'type'      =>  'number',
                        'aria-label'=>'Number of Schools'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
        <?php }elseif($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && !$school_loaded){ ?>
            <tr>
                <td class="txtb"></td>
                <td>
                    <?php echo form_checkbox(array('name'=>'update_chk_providedBy', 'id'=>'update_chk_providedBy', 'value'=>'district-provided', 'checked'=>true, 'disabled'=>'disabled')); ?>
                    <?php echo form_label('This is a district-provided training initiative.', 'update_chk_providedBy'); ?>
                    <?php echo form_hidden('updateProvidedBy', 'district-provided'); ?>
                </td>
            </tr>

            <tr class="update_district-provided">
                <td class="txtb"><span class="required" aria-required="true">*</span> Number of Schools:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updateTxtSchools',
                        'id'        =>  'updateTxtSchools',
                        'minlength' =>  '1',
                        'size'      =>  '20',
                        'value'     =>  '0',
                        'type'      =>  'number',
                        'aria-label'=>'Number of Schools'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
        <?php }else{ ?>
            <tr>
                <td></td>
                <td><?php echo form_hidden('updateProvidedBy', 'school-provided'); ?></td>
            </tr>

        <?php } ?>

        <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL): ?>
            <tr>
                <td class="txtb">Number of LEAs Trained:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updateTxtLEAs',
                        'id'        =>  'updateTxtLEAs',
                        'minlength' =>  '1',
                        'size'      =>  '20',
                        'value'     =>  '0',
                        'type'      =>  'number',
                        'aria-label'=>'Number of LEAs Trained'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>

            <tr>
                <td class="txtb">Number of Rural LEAs Trained:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updateTxtRLEAs',
                        'id'        =>  'updateTxtRLEAs',
                        'minlength' =>  '1',
                        'size'      =>  '20',
                        'value'     =>  '0',
                        'type'      =>  'number',
                        'aria-label'=>'Number of Rural LEAs Trained'
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
            <td colspan="2" align="left">


            </td>
        </tr>
    </table>
</fieldset>
<?php
echo form_close();
?>
<script>
    $(document).ready(function(){
        $( "#updateTxtdate" ).datepicker();
        $("#updateTrainingForm").validate();
    });

    $(document).on('click', '#checkbox_replace', function(e){

        if($('#checkbox_replace').is(":checked")){
            $('#updateFileupload').prop('disabled', false);
            $('#checkbox_replace').val('yes');
        }else{
            $('#updateFileupload').prop('disabled', true);
            $('#checkbox_replace').val('no');
        }
    });

</script>