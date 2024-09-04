<?php
/**
 *  Batch User import preview page
 *
 * Created by PhpStorm.
 * User: godfreymajwega
 * Date: 6/24/19
 * Time: 2:59 PM
 */
if(isset($csvData) && is_array($csvData) && count($csvData)>0):
    echo form_open('district/import/save', array('class'=>'district_import_form', 'id'=>'district_import_form'));
    ?>
    <h1> Preview of Imported School District Profiles</h1>
    <table  width="99%" rules="rows" id="preview_table" class="display dataTable">
        <thead>
        <tr>
            <th>School District Name </th>
            <th>Screen Name</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($csvData as $dataKey=>$value): ?>
            <?php if($dataKey>0): ?>
                <tr>
                    <td><input type="text" name="district_name[]"  class="import_district_name"   value="<?php echo($value[0]); ?>" required /></td>
                    <td><input type="text" name="screen_name[]"   class="import_screen_name"    value="<?php echo($value[1]); ?>" /></td>
                </tr>

            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>

        <tfoot>
        <tr>
            <td colspan="2" align="left">
                <?php
                $attributes = array(
                    'name'  =>  'district_form_submit',
                    'value' =>  'Save',
                    'id'    =>  'district_form_submit',
                    'style' =>  ''
                );
                ?>
                <?php echo form_submit($attributes); ?>
                <?php echo form_reset(array(
                    'name'      =>'district_form_reset',
                    'value'     => 'Cancel',
                    'id'        => 'district_form_reset')); ?>
            </td>
        </tr>
        </tfoot>
    </table>
    <?php  echo form_close(); ?>
<?php endif; ?>