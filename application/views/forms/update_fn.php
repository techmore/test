<?php
/**
 * Update function FORM
 *
 * Update Functions Form
 * For updating custom added functions
 */

$text_for_state_required_checkbox =<<<EOF
This function is required for all schools in the state to address in their EOPs. By selecting this box, this 
function will appear in all school EOPs.
EOF;

$text_for_district_required_checkbox =<<<EOF
This function is required for all schools in the district to address in their EOPs. By selecting this box, this 
function will appear in all school EOPs.
EOF;
?>
    <?php
    if($this->session->userdata['role']['read_only']=='n') {
        echo form_open('plan/update/entity/fn', array('class' => 'updatefnManagementForm'));
        echo form_hidden('id', '');

        ?>
        <fieldset class="fn">

            <table class="">

                <tr>
                    <td colspan="2">
                        <?php
                        $labelAttributes = array(
                            'id' => 'label_updatetxtfn'
                        );
                        echo form_label('Function Name:','updatetxtfn');

                        $inputAttributes = array(
                            'name' => 'updatetxtfn',
                            'class' => 'updatetxtfn',
                            'required' => 'required',
                            'minlength' => '3',
                            'size' => '50'
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
                                'name'      =>  'checkbox_update_fn_mandate',
                                'class'     =>  'checkbox_update_fn_mandate',
                            );
                            //If district admin and no school is selected, disable this checkbox
                            if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && ( !$this->session->userdata('loaded_school') || empty($this->session->userdata['loaded_school']['id'])) ){
                                $checkboxAttributes['disabled'] = 'disabled';
                            }
                            $checkbox_value = ($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL) ? 'state' : 'district';
                            $checkbox_label = ($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL) ? $text_for_state_required_checkbox : $text_for_district_required_checkbox;
                            echo form_checkbox($checkboxAttributes, $checkbox_value);

                            $labelAttributes = array(
                                'id' => 'label_update_fn_mandate'
                            );
                            echo form_label($checkbox_label,'checkbox_update_fn_mandate');
                            ?>
                        </td>
                    </tr>
                <?php endif; ?>



            </table>
        </fieldset>
        <?php
    }
    echo form_close();
    ?>
