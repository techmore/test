<?php
echo form_open_multipart('exercise/update', array('class'=>'updateExerciseForm', 'id'=>'updateExerciseForm'));
?>
<input type="hidden" id="updateid" name="updateid"/>
    <fieldset>

        <table>
            <tr>
                <td class="txtb">Title:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtname',
                        'id'        =>  'updatetxtname',
                        'required'  =>  'required',
                        'minlength'  =>  '3',
                        'size'      =>   '50',
                        'aria-label'=>      'Title'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb">Type of Emergency Exercise:</td>
                <td>

                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxttype',
                        'id'        =>  'updatetxttype',
                        'required'  =>  'required',
                        'aria-label'=>  'Type of Emergency Exercise',
                        'options'   =>  array(
                            'Drill'                 =>  'Drill',
                            'Tabletop Exercise'     =>  'Tabletop Exercise',
                            'Functional Exercise'   =>  'Functional Exercise',
                            'Full-Scale Exercise'   =>  'Full-Scale Exercise',
                            'Other Exercise'        =>  'Other Exercise'
                        )
                    );
                    echo form_dropdown($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb">Location:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtlocation',
                        'id'        =>  'updatetxtlocation',
                        'minlength'  =>  '3',
                        'size'      =>   '50',
                        'aria-label'=> 'Location'
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
                        'name'      =>  'updatetxtdate',
                        'id'        =>  'updatetxtdate',
                        'minlength' =>  '3',
                        'aria-label'=> 'Date'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb">Contact:</td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtcontact',
                        'id'        =>  'updatetxtcontact',
                        'size'      =>  '50',
                        'aria-label'=> 'Contact'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb">Host:</td>
                <td>
                    <?php

                    $inputAttributes = array(
                        'name'      =>  'updateTxtHost',
                        'id'        =>  'updateTxtHost',
                        'required'  =>  'required',
                        'aria-label'=> 'Host',
                        'options'   =>  array(
                            'district'              =>  'District',
                            'school'                =>  'School',
                            'state'                 =>  'State'
                        )
                    );
                    echo form_dropdown($inputAttributes);
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
                        'name'      =>  'updatetxtdescription',
                        'id'        =>  'updatetxtdescription',
                        'cols'      =>  '50',
                        'rows'      =>  '6',
                        'aria-label'=> 'Description'
                    );
                    echo form_textarea($inputAttributes);
                    ?>
                </td>
            </tr>

            <tr>
                <td class="txtb"><input type="checkbox" name="checkbox_replace" id="checkbox_replace" value="no" /> <label for="checkbox_replace">Replace Attachment: </label></td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatefileupload',
                        'id'        =>  'updatefileupload',
                        'disabled'  =>  'disabled',
                        'aria-label'=> 'Replace Attachment'
                    );
                    echo form_upload($inputAttributes);
                    ?>
                </td>
            </tr>

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
        $( "#updatetxtdate" ).datepicker();
        $("#updateExerciseForm").validate();
    });

    $(document).on('click', '#checkbox_replace', function(e){

       if($('#checkbox_replace').is(":checked")){
           $('#updatefileupload').prop('disabled', false);
           $('#checkbox_replace').val('yes');
       }else{
           $('#updatefileupload').prop('disabled', true);
           $('#checkbox_replace').val('no');
       }
    });

</script>