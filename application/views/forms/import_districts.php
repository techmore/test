<?php
/**
 *  Import District Form
 *
 * Displays form for importing CSV file for batch processing user profiles
 *
 */
?>

    <h1> Import School District Profiles</h1>
<?php
echo form_open_multipart('district/import/preview', array('class'=>'district_upload_csv_form', 'id'=>'district_upload_csv_form'));

?>
    <div id="errorDiv"></div>
    <table border="0" width="100%" cellpadding="2">
        <tr>
            <td>
                <a href="<?php echo base_url(); ?>assets/import_templates/districts.csv" download><input type="button" value="Download CSV" style="border: 1px solid #ddd;" /></a>
            </td>
        </tr>
        <tr>
            <td>

                <!--<input  type='file' id="csvInp" name="csvInp" accept="text/csv, .csv, .CSV" required/>-->
                <label class="custom-file-upload">
                    <input  type='file' id="csvInp" name="csvInp" accept="text/csv, .csv, .CSV" required style="/*display:none;*/"/>
                    <div class="ic-cloud-upload-48px"> </div>&nbsp; Import District Profiles
                </label>
            </td>

        </tr>

    </table>
<?php
echo form_close();
?>