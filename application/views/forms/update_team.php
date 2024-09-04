<?php
echo form_open('team/update', array('class'=>'updateTeamForm', 'id'=>'updateTeamForm'));
?>
<input type="hidden" id="updateid" name="updateid"/>
    <fieldset>

        <table>
            <tr>
                <td class="txtb"><label for="updatetxtname">Name:</label></td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtname',
                        'id'        =>  'updatetxtname',
                        'required'  =>  'required',
                        'minlength'  =>  '3',
                        'size'      =>   '50'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb"><label for="updatetxttitle">Title:</label></td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxttitle',
                        'id'        =>  'updatetxttitle',
                        'required'  =>  'required',
                        'minlength'  =>  '3',
                        'size'      =>   '50'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb"><label for="updatetxtorganization">Organization:</label></td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtorganization',
                        'id'        =>  'updatetxtorganization',
                        'required'  =>  'required',
                        'minlength'  =>  '3',
                        'size'      =>   '50'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb"><label for="updatetxtemail">Email:</label></td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtemail',
                        'id'        =>  'updatetxtemail',
                        'required'  =>  'required',
                        'minlength' =>  '3',
                        'type'      =>  'email',
                        'size'      =>  '50'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb"><label for="updatetxtphone">Phone:</label></td>
                <td>
                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtphone',
                        'id'        =>  'updatetxtphone',
                        'size'      =>  '50',
                        'type'      =>  'tel'
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtb">Stakeholder Category:</td>
                <td>
                    <table class="sctable">
                        <tr>
                            <td>
                                <?php
                                    $inputAttributes = array(
                                        'name'      =>  'updateinterests[]',
                                        'value'     =>  'School District/LEA',
                                        'checked'   =>  FALSE,
                                        'id'        =>  'ucheckbox1',
                                        'class'     =>  'updateinterestChkBox'
                                    );
                                echo form_checkbox($inputAttributes);
                                ?>
                                <label for="ucheckbox1">School District/LEA</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'updateinterests[]',
                                    'value'     =>  'School Community',
                                    'checked'   =>  FALSE,
                                    'id'        =>  'ucheckbox2',
                                    'class'     =>  'updateinterestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                <label for="ucheckbox2">School Community</label>
                            </td>
                        </tr>
                        <tr>
                        <td>
                            <?php
                            $inputAttributes = array(
                                'name'      =>  'updateinterests[]',
                                'value'     =>  'Diverse Interests of Whole School Community',
                                'checked'   =>  FALSE,
                                'id'        =>  'ucheckbox3',
                                'class'     =>  'updateinterestChkBox'
                            );
                            echo form_checkbox($inputAttributes);
                            ?>
                            <label for="ucheckbox3"> Diverse Interests of Whole School Community</label>
                        </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'updateinterests[]',
                                    'value'     =>  'Local Community Partner',
                                    'checked'   =>  FALSE,
                                    'id'        =>  'ucheckbox4',
                                    'class'     =>  'updateinterestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                <label for="ucheckbox4"> Local Community Partner</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'updateinterests[]',
                                    'value'     =>  'State Department of Education/SEA',
                                    'checked'   =>  FALSE,
                                    'id'        =>  'ucheckbox5',
                                    'class'     =>  'updateinterestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                <label for="ucheckbox5"> State Department of Education/SEA</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'updateinterests[]',
                                    'value'     =>  'State Community Partner',
                                    'checked'   =>  FALSE,
                                    'id'        =>  'ucheckbox6',
                                    'class'     =>  'updateinterestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                <label for="ucheckbox6"> State Community Partner</label>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'updateinterests[]',
                                    'value'     =>  'Additional Partner',
                                    'checked'   =>  FALSE,
                                    'id'        =>  'ucheckbox7',
                                    'class'     =>  'updateinterestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                <label for="ucheckbox7"> Additional Partner</label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" align="left">
                   <!-- <?php
/*                    $attributes = array(
                        'name'  =>  'updatebtnsave',
                        'value' =>  'Save',
                        'id'    =>  'updatebtnsave',
                        'style' =>  ''
                    );
                    */?>
                    --><?php /*echo form_submit($attributes); */?>


                </td>
            </tr>
        </table>
    </fieldset>
<?php
echo form_close();
?>
<script>
    $(document).ready(function(){

        $("#updateTeamForm").validate({
            rules: {
                updatetxtphone:{
                    phoneUS2: true
                }
            }
        });
    });

</script>