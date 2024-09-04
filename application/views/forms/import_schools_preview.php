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
    echo form_open('school/import/save', array('class'=>'school_import_form', 'id'=>'school_import_form'));
    ?>
    <h1> Preview of Imported School Profiles</h1>
    <table  width="99%" rules="rows" id="preview_table" class="display dataTable">
        <thead>
        <tr>
            <th>School Name </th>
            <th>Screen Name</th>


            <th>
                <?php if($role['create_district']=='y'): ?>
                School District
                <br/>
                <?php
                $options = array();
                $options['Null'] = '--Select--';
                $options['']    =   'None';
                foreach($districts as $rowIndex => $row){
                    $options[$row['id']] = $row['name'];
                }
                $otherAttributes = 'id="global_district" class="global_district" required="required" style=""';
                reset($options);
                $first_key = key($options);
                echo form_dropdown('global_district', $options, "$first_key", $otherAttributes);
                ?>
                <?php endif; ?>
            </th>

        </tr>
        </thead>
        <tbody>
        <?php foreach($csvData as $dataKey=>$value): ?>
            <?php if($dataKey>0): ?>
                <tr>
                    <td><input type="text" name="school_name[]"  class="import_school_name"   value="<?php echo($value[0]); ?>" required /></td>
                    <td><input type="text" name="screen_name[]"   class="import_screen_name"    value="<?php echo($value[1]); ?>" /></td>


                    <td>
                        <?php if($role['create_district']=='y'): ?>
                            <?php
                            $options = array();
                            $options['Null'] = '--Select--';
                            $options['']    =   'None';
                            foreach($districts as $rowIndex => $row){
                                $options[$row['id']] = $row['name'];
                            }
                            $otherAttributes = 'id="sltdistrict'.$dataKey.'" class="sltdistrict" required="required" style=""';
                            reset($options);
                            $first_key = key($options);
                            echo form_dropdown('sltdistrict[]', $options, "$first_key", $otherAttributes);
                            ?>
                            <input type="hidden" class="hidden_sltdistrict" id="hidden_sltdistrict<?php echo($dataKey); ?>" name="sltdistrict[]" value="Null" disabled />
                        <?php endif; ?>
                    </td>

                </tr>

            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>

        <tfoot>
        <tr>
            <td colspan="3" align="left">
                <?php
                $attributes = array(
                    'name'  =>  'school_form_submit',
                    'value' =>  'Save',
                    'id'    =>  'school_form_submit',
                    'style' =>  ''
                );
                ?>
                <?php echo form_submit($attributes); ?>
                <?php echo form_reset(array(
                    'name'      =>'school_form_reset',
                    'value'     => 'Cancel',
                    'id'        => 'school_form_reset')); ?>

            </td>
        </tr>
        </tfoot>
    </table>
    <?php  echo form_close(); ?>
    <script type="text/javascript">


        $("#global_district").on('change', function(e){
            $(".sltdistrict").val(this.value);
        });


    </script>
<?php endif; ?>