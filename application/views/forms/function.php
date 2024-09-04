<?php
echo form_open('', array('class'=>'newFnForm', 'id'=>'newFnForm'));
?>
    <style type="text/css">
        fieldset p{ margin:10px 0px;}
    </style>
    <fieldset id="newfnform">
        <input type="hidden" id="fnid" name="fnid"/>

        <legend>&nbsp;</legend>
        <p>
            <label for="txtfn"> Function:</label>

            <?php
            $inputAttributes = array(
                'name'      =>  'txtfn',
                'id'        =>  'txtfn',
                'required'  =>  'required',
                'minlength'  =>  '3',
                'size'      =>   '50'
            );
            echo form_input($inputAttributes);
            ?>
        </p>
    </fieldset>
<?php
echo form_close();
?>