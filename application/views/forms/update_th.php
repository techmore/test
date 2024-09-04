<?php
$text_for_state_required_checkbox =<<<EOF
This threat or hazard is required for all schools in the state to address in their EOPs. By selecting this box, this 
threat or hazard will appear in all school EOPs.
EOF;

$text_for_district_required_checkbox =<<<EOF
This threat or hazard is required for all schools in the district to address in their EOPs. By selecting this box, this 
threat or hazard will appear in all school EOPs.
EOF;

echo form_open('plan/update/entity/th', array('class'=>'updateThForm', 'id'=>'updateThForm'));
?>
    <style type="text/css">
        fieldset p{ margin:10px 0px;}
    </style>
    <fieldset id="updatethform">
        <input type="hidden" id="updateid" name="updateid"/>
            <p>
                <label for="updatetxtname"> Name: </label>

                    <?php
                    $inputAttributes = array(
                        'name'      =>  'updatetxtname',
                        'id'        =>  'updatetxtname',
                        'required'  =>  'required',
                        'minlength'  =>  '3',
                        'size'      =>   '80'
                    );
                    echo form_input($inputAttributes);
                    ?>
            </p>

        <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL || $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
            <p>

                    <?php
                    $checkboxAttributes = array(
                        'name'      =>  'updatecheckbox_th_mandate',
                        'id'        =>  'updatecheckbox_th_mandate'
                    );
                    $checkbox_value = ($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL) ? 'state' : 'district';
                    $checkbox_label = ($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL) ? $text_for_state_required_checkbox : $text_for_district_required_checkbox;
                    echo form_checkbox($checkboxAttributes, $checkbox_value);

                    $labelAttributes = array(
                        'id' => 'updatelabel_th_mandate'
                    );
                    echo form_label($checkbox_label,'updatecheckbox_th_mandate', $checkbox_value)
                    ?>
            </p>
        <?php endif; ?>
    </fieldset>

        <?php
        $attributes = array(
            'name'  =>  'updatebtnsave',
            'value' =>  'Save',
            'id'    =>  'updatebtnsave',
            'style' =>  ''
        );
        ?>


<?php //echo form_submit($attributes); ?>

<?php
echo form_close();
?>