<?php
/**
 * th FORM
 *
 * Thread and Hazard Form
 * For creating a new Threat and Hazard
 */
$text_for_state_required_checkbox =<<<EOF
This threat or hazard is required for all schools in the state to address in their EOPs. By selecting this box, this 
threat or hazard will appear in all school EOPs.
EOF;

$text_for_district_required_checkbox =<<<EOF
This threat or hazard is a part of the district’s master list of threats and hazards for all schools. Selecting this box will cause this threat or hazard to appear in all school EOPs.
EOF;

$_title=($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL)? "Identify Threats and Hazards":"Create Threats and Hazards";
?>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/forms.css" />

    <h1><?php echo($_title); ?></h1>
    <!-- <a href="#.php" id="hideTeamManagementFormLinkId"></a> -->

<?php
if($this->session->userdata['role']['read_only']=='n') {
    echo form_open('plan/add/entity/th', array('class' => 'thManagementForm', 'id' => 'thManagementForm'));
    ?>
    <fieldset class="th">

        <table class="thform">
            <tr>
                <td colspan="2">
					<?php if($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL){?>
                    <p>Please use the form below to record threats and hazards generated from the data sources listed above and any other relevant data sources. You will need to add each threat and hazard separately. Type the name of the threat or hazard in the designated field and then click the Save button to record that threat or hazard in the table below. Repeat this process as many times as necessary to add all threats and hazards.</p>
                    <p>If your team has already recorded threats and hazards and wishes to modify the information, please click the Edit button for the respective threat or hazard. A pre-populated field will appear with previously saved information. After editing the available field, click the Save button. Repeat this process, as needed.</p>
					<?php }else {?> 
					<p>Use the form below to record threats and hazards generated from the data sources listed above and all other relevant data sources. You will need to add each threat and hazard separately. Type the name of the threat or hazard in the designated field. To add the threat or hazard to the customized school list, leave the box unchecked and then click Save. To add the threat or hazard to the district master list, select the box below and then click Save. Repeat this process as many times as necessary to add all threats and hazards.</p>
To modify existing information about threats and hazards and wishes, click Edit for the chosen threat or hazard. A pre-populated field will appear with previously saved information. After editing the available field, click Save. Repeat this process as needed.</p>
					<?php } ?>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
                    $inputAttributes = array(
                        'name' => 'txtth',
                        'id' => 'txtth',
                        'required' => 'required',
                        'minlength' => '3',
                        'size' => '70',
                        'aria-label' => 'New Threat or Hazard Name'
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
                            'name'      =>  'checkbox_th_mandate',
                            'id'        =>  'checkbox_th_mandate'
                        );
                        $checkbox_value = ($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL) ? 'state' : 'district';
                        $checkbox_label = ($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL) ? $text_for_state_required_checkbox : $text_for_district_required_checkbox;
                        echo form_checkbox($checkboxAttributes, $checkbox_value);
    
                        $labelAttributes = array(
                            'id' => 'label_th_mandate'
                        );
                        echo form_label($checkbox_label,'checkbox_th_mandate');
                        ?>
                    </td>
                </tr>
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
                        'id' => 'btnreset',
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