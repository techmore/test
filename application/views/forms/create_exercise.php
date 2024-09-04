<link rel="stylesheet" href="<?php echo base_url();?>assets/css/forms.css" />

    <?php
    echo form_open_multipart('exercise/add', array('class'=>'newExerciseForm', 'id'=>'newExerciseForm'));
    //echo form_hidden('ajax', '1');
    ?>

        <fieldset>

            <table class="tmform">

                <tr>
                    <td colspan="2">
						<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
						<p>Keep a record of emergency exercises that your district has conducted. Add each emergency exercise separately. Type the name or title of the emergency exercise and add the accompanying details into the corresponding fields. To document the event as a district-led exercise, select the appropriate box. Click Save to record information for each emergency exercise, and repeat this process as many times as necessary to add all emergency exercises conducted into EOP ASSIST.</p>
<p>If you wish to modify existing information, click Edit for the chosen event. A prepopulated field will appear with previously saved information. After editing the available field, click Save. Likewise, to remove an emergency exercise from the list, click Delete. You will be asked to confirm this deletion. Click Yes to confirm or Cancel if you clicked Delete in error.</p>
						<?php else: ?>
                        <p> Please use the form below to record emergency exercises that your school has conducted. You will add each emergency exercise separately. Type the name or title of the emergency exercise and accompanying details into the corresponding fields, and check the appropriate box designating the type of emergency exercise. You may check only one box for each emergency exercise. Click the Save button to record information for each emergency exercise, and then repeat this process as many times as necessary to add all emergency exercises conducted into EOP ASSIST. </p>
                        <p>If your team has already recorded emergency exercises and wishes to modify the information, please click the Edit button for the respective emergency exercise. A prepopulated field will appear with previously saved information. After editing the available field, click the Save button. Likewise, if your team would like to remove an emergency exercise from the list, click the Delete button. You will be asked to confirm this deletion. Click Yes to confirm or Cancel if you clicked the Delete button in error.</p>
						<?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtb"><label for="txtname">Title:</label> </td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtname',
                            'id'        =>  'txtname',
                            'minlength'  =>  '3',
                            'size'      =>   '70',
                            'required'  =>  'required'
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtb"><label for="txttype">Type of Emergency Exercise:</label></td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txttype',
                            'id'        =>  'txttype',
                            'required'  =>  'required',
                            'options'   =>  array(
                                'Drill'                 =>  'Drill',
                                'Tabletop Exercise'     => 'Tabletop Exercise',
                                'Functional Exercise'   =>  'Functional Exercise',
                                'Full-Scale Exercise'   =>  'Full-Scale Exercise',
                                'Other Exercise'        =>  'Other Exercise'
                            ),
                            'selected'  =>  'Drill'
                        );
                        echo form_dropdown($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtb"><label for="txtDate">Date:</label></td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtDate',
                            'id'        =>  'txtDate',
                            'aria-label'=>  'Date'
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtb"><label for="txtlocation">Location:</label> </td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtlocation',
                            'id'        =>  'txtlocation',
                            'minlength' =>  '3',
                            'size'      =>  '70',
                            'aria-label'=>  'Location'
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtb"><label for="txtcontact">Contact:</label> </td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtcontact',
                            'id'        =>  'txtcontact',
                            'size'      =>  '70',
                            'aria-label'=>  'Contact'
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>

                <tr>
                    <td class="txtb"><label for="txtHost">Host:</label></td>
                    <td>
                        <?php
                        $_selected = ($this->session->userdata['role']['level']<=STATE_ADMIN_LEVEL) ? 'State' : (($this->session->userdata['role']['level']==DISTRICT_ADMIN_LEVEL) ? 'District' : 'School');
                        $inputAttributes = array(
                            'name'      =>  'txtHost',
                            'id'        =>  'txtHost',
                            'required'  =>  'required',
                            'aria-label'=>  'Host',
                            'options'   =>  array(
                                'district'              =>  'District',
                                'school'                =>  'School',
                                'state'                 =>  'State'
                            ),
                            'selected'  =>  $_selected
                        );
                        echo form_dropdown($inputAttributes);
                        ?>
                    </td>
                </tr>

                <tr>
                    <td class="txtb" ><label for="txtdescription">Description:</label> </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'          =>  'txtdescription',
                            'id'            =>  'txtdescription',
                            'cols'          =>  '50',
                            'rows'          =>  '6',
                            'aria-label'    =>  'Description'
                        );
                        echo form_textarea($inputAttributes);
                        ?>
                    </td>
                </tr>

                <tr>
                    <td class="txtb"><label for="fileupload">Attachment:</label></td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'          =>  'fileupload',
                            'id'            =>  'fileupload',
                            'aria-label'    =>  'Attachment'
                        );
                        echo form_upload($inputAttributes);
                        ?>
                    </td>
                </tr>

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
