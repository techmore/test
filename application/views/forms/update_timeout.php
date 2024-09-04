<?php
echo form_open('timeout/update', array('class'=>'updateTimeoutForm', 'id'=>'updateTimeoutForm'));
?>
    <style type="text/css">
        fieldset p{ margin:10px 0px;}
    </style>
    <fieldset id="updatetimeoutform">
        <input type="hidden" id="updateid" name="updateid"/>
        <p>
            <label for="updatetxttime"> Length of time in minutes: </label>

            <?php
            $inputAttributes = array(
                'name'      =>  'updatetxttime',
                'id'        =>  'updatetxttime',
                'required'  =>  'required',
                'maxlength' =>  '10',
                'size'      =>   '20',
                'value'     =>  $currentTimeout
            );
            echo form_input($inputAttributes);
            ?>
        </p>
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
