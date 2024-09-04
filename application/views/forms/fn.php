<?php
/**
 * fn FORM
 *
 * Create New Functions Form
 * For creating a new Function
 */

$text_for_state_required_checkbox =<<<EOF
This function is required for all schools in the state to address in their EOPs. By selecting this box, this 
function will appear in all school EOPs.
EOF;

$text_for_district_required_checkbox =<<<EOF
This function is part of the district’s master list of cross-cutting functions for all schools. Selecting this box will make the function appear in all school EOPs.
EOF;
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/forms.css" />

<!-- <input type="button" role="button" id="btnAddFunction" value="Add Functions"/> -->
<div id="addFunctionContainer">
<?php
if($this->session->userdata['role']['read_only']=='n') {
echo form_open('plan/add/entity/fn', array('class' => 'fnManagementForm', 'id' => 'fnManagementForm'));
?>
    <fieldset class="fn">

        <table class="fnform">
            <tr>
                <td colspan="2">
					
					<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
					<p>Record functions that were not generated while developing goals and objectives for threats and hazards. Add each function separately. Type the name of the function in the designated field and then click Save to record that function in the table below. To add the function to the district master list, select the box below. Repeat this process as many times as necessary to add all functions</p>
                    
					<?php else: ?>
					<p>Please use the form below to record functions that were not generated while developing goals and objectives for threats and hazards. You will need to add each function separately. Type the name of the function in the designated field and then click the Save button to record that function in the table below. Repeat this process as many times as necessary to add all functions.
                    </p>
					<?php endif; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
                    $inputAttributes = array(
                        'name' => 'txtfn',
                        'id' => 'txtfn',
                        'required' => 'required',
                        'minlength' => '3',
                        'size' => '70',
                        'aria-label' => "Function Name"
                    );
                    echo form_input($inputAttributes);
                    ?>
                </td>
            </tr>
            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL || $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
                <tr>
                    <td align="left" colspan="2">
                        <?php
                        $checkboxAttributes = array(
                            'name'      =>  'checkbox_fn_mandate',
                            'id'        =>  'checkbox_fn_mandate'
                        );
                        $checkbox_value = ($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL) ? 'state' : 'district';
                        $checkbox_label = ($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL) ? $text_for_state_required_checkbox : $text_for_district_required_checkbox;
                        echo form_checkbox($checkboxAttributes, $checkbox_value);

                        $labelAttributes = array(
                            'id' => 'label_fn_mandate'
                        );
                        echo form_label($checkbox_label,'checkbox_fn_mandate');
                        ?>
                    </td>
                </tr>
                <?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && ( !$this->session->userdata('loaded_school') || empty($this->session->userdata['loaded_school']['id'])) ): ?>

                    <script type="text/javascript">
                        $(document).on('submit', '#fnManagementForm', function(e){
                            if($("#checkbox_fn_mandate").is(':checked')){

                                return true;
                            }else{
                                alert("Please select the appropriate school in the School dropdown menu in the Navigation bar.");
                                return false;
                            }
                        });

                    </script>
                <?php endif; ?>
            <?php endif; ?>
            <tr>
                <td align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
            </tr>
            <tr>

                <td align="left">
                    <?php
                    $attributes = array(
                        'name' => 'btnsave',
                        'value' => 'Save',
                        'id' => 'btnsave',
                        'style' => ''
                    );
                    ?>
                    <?php echo form_submit($attributes); ?>

                    <?php
                    $attributes = array(
                        'name' => 'btnreset',
                        'value' => 'Reset',
                        'id' => 'btnfnreset',
                        'style' => ''
                    );
                    ?>
                    <?php echo form_reset($attributes); ?>
                </td>
                <td align="left">&nbsp;</td>
            </tr>

        </table>
    </fieldset>
    <?php
}
echo form_close();
?>
</div>

