<?php
/**
 *  User Management Form
 *
 * Displays form for importing CSV file for batch processing user profiles
 *
 */
?>

<h1>Import User Profiles</h1>
<?php
    echo form_open_multipart('user/import/preview', array('class'=>'user_upload_csv_form', 'id'=>'user_upload_csv_form'));

?>
    <div id="errorDiv"></div>
    <table border="0" width="100%" cellpadding="2">
        <tr>
            <td>

                <a href="<?php echo base_url(); ?>assets/import_templates/users.csv" download><input type="button" value="Download CSV" style="border: 1px solid #ddd;" /></a>
            </td>
        </tr>
        <tr>
            <td>
                
                <!--<input  type='file' id="csvInp" name="csvInp" accept="text/csv, .csv, .CSV" required style="/*display:none;*/"/>-->
                <!--<input type="button" value="Choose File" id="btnChooseFile"/> -->

                <label class="custom-file-upload">
                    <input  type='file' id="csvInp" name="csvInp" accept="text/csv, .csv, .CSV" required style="/*display:none;*/"/>
                    <div class="ic-cloud-upload-48px"> </div>&nbsp; Import User Profiles
                </label>
            </td>

        </tr>

        <tr>
            <td colspan="2" align="left">
                <?php
                $attributes = array(
                    'name'  =>  'user_form_submit',
                    'value' =>  'Import',
                    'id'    =>  'user_form_submit',
                    'style' =>  ''
                );
                ?>
                <?php //echo form_submit($attributes); ?>
                <?php //echo form_reset(array('name'=>'user_form_reset', 'value' => 'Cancel', 'id' => 'user_form_reset')); ?>

            </td>
        </tr>
    </table>
<?php
echo form_close();
?>