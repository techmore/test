<?php
    echo form_open('app/install', array('class'=>'hosting_level_form', 'id'=>'hosting_level_form'));
?>
    <h3 class="title">Choose Hosting Level</h3>
    <p>
        <?php
            $data = array(
                'name'        => 'pref_hosting_level',
                'id'          => 'state-radio',
                'value'       => 'state',
                'checked'     => FALSE,
                'style'       => ''
            );
            echo form_radio($data);
        ?>
        <label for="state-radio" class="inputlabel">State/Regional Level</label>
        <br>
        <label for="state-radio">Please select this option if you are a state agency or regional education agency installing EOP ASSIST and hosting it for schools and school districts in your state or region.</label>
    </p>

    <p>
        <?php
            $data = array(
                'name'        => 'pref_hosting_level',
                'id'          => 'district-radio',
                'value'       => 'district',
                'checked'     => TRUE,
                'style'       => ''
            );
        echo form_radio($data);
        ?>
        <label for="district-radio" class="inputlabel">Local Level</label>
        <br />
        <label for="district-radio">Please select this option if you are a school or school district installing EOP ASSIST and hosting it for your local education agency.</label>
    </p>

    <p>
        <?php
        $attributes = array(
            'name'  =>  'hosting_level_submit',
            'value' =>  'Save and Continue',
            'class' =>  'signin_submit',
            'id'    =>  'hosting_level_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
    </p>

<?php
    echo form_close();
?>