<?php
/**
 *  Import School Form
 *
 * Displays form for importing CSV file for batch processing user profiles
 *
 */
?>

    <h1> Import School Profiles</h1>
<?php
echo form_open_multipart('school/import/preview', array('class'=>'school_upload_csv_form', 'id'=>'school_upload_csv_form'));

?>
    <div id="errorDiv"></div>
    <table border="0" width="100%" cellpadding="2">
        <tr>
            <td>
                <a href="<?php echo base_url(); ?>assets/import_templates/schools.csv" download><input type="button" value="Download Template" style="border: 1px solid #ddd;" /></a>
            </td>
        </tr>
        <tr>
            <td>

                <input  type='file' id="csvInp" name="csvInp" accept="text/csv, .csv, .CSV" required/>
            </td>

        </tr>

        <tr>
            <td colspan="2" align="left">
                <?php
                $attributes = array(
                    'name'  =>  'school_form_submit',
                    'value' =>  'Import',
                    'id'    =>  'school_form_submit',
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