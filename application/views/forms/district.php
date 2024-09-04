<?php
/**
 *  District Management Form
 *
 * Displays form for adding and editing schools.
 *
 */
?>

<h1>Create New District</h1>
<?php
    echo form_open('district/add', array('class'=>'district_form', 'id'=>'district_form'));
?>
    <div id="errorDiv"></div>
    <table border="1" width="100%" rules="all" >
        <tr>
            <td width="15%"><span class="required">*</span> District&nbsp;&nbsp;Name:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'district_name',
                    'id'        =>  'district_name',
                    'required'  =>  'required',
                    'minlength'  =>  '3',
                    'size'      =>   '70'
                );
                echo form_input($inputAttributes);
                ?>

            </td>
        </tr>
        <tr>
            <td> Screen&nbsp;&nbsp;Name:</td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'screen_name',
                    'id'        =>  'screen_name',
                    'size'      =>  '70'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>

        <tr>
            <td colspan="2" align="left">
                <?php
                $attributes = array(
                    'name'  =>  'district_form_submit',
                    'value' =>  'Create New District',
                    'id'    =>  'district_form_submit',
                    'style' =>  ''
                );
                ?>
                <?php echo form_submit($attributes); ?>

                <?php echo form_reset(array(
                    'name'=>'school_form_reset',
                    'value' => 'Cancel',
                    'id' => 'school_form_reset')); ?>

            </td>
        </tr>
    </table>
<?php
echo form_close();
?>