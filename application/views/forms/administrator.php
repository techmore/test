<?php
/**
 * Created by PhpStorm.
 * User: godfreymajwega
 * Date: 6/26/19
 * Time: 6:12 PM
 */

echo form_open('administrator/update', array('class'=>'updateAdministratorForm', 'id'=>'updateAdministratorForm'));
?>
<style type="text/css">
    fieldset p{ margin:10px 0px;}
</style>

<fieldset id="updateadministratorform">
    <input type="hidden" id="updateid" name="updateid"/>
    <p>
        <label for="name">  Name </label><br/>

        <?php
        $inputAttributes = array(
            'name'      =>  'name',
            'id'        =>  'name',
            'required'  =>  'required',
            'size'      =>   '40',
            'value'     =>  $program_administrator['contact_name']
        );
        echo form_input($inputAttributes);
        ?>
    </p>
    <p>
        <label for="title"> Title </label><br/>

        <?php
        $inputAttributes = array(
            'name'      =>  'title',
            'id'        =>  'title',
            'required'  =>  'required',
            'size'      =>   '40',
            'value'     =>  $program_administrator['contact_title']
        );
        echo form_input($inputAttributes);
        ?>
    </p>
    <p>
        <label for="agency"> Agency </label><br/>

        <?php
        $inputAttributes = array(
            'name'      =>  'agency',
            'id'        =>  'agency',
            'required'  =>  'required',
            'size'      =>   '40',
            'value'     =>  $program_administrator['contact_agency']
        );
        echo form_input($inputAttributes);
        ?>
    </p>

    <p>
        <label for="phone"> Phone </label><br/>

        <?php
        $inputAttributes = array(
            'name'      =>  'phone',
            'id'        =>  'phone',
            'required'  =>  'required',
            'maxlength' =>  '10',
            'size'      =>   '40',
            'value'     =>  $program_administrator['contact_phone']
        );
        echo form_input($inputAttributes);
        ?>
    </p>
    <p>
        <label for="email"> Email </label><br/>

        <?php
        $inputAttributes = array(
            'name'      =>  'email',
            'id'        =>  'email',
            'required'  =>  'required',
            'size'      =>   '40',
            'value'     =>  $program_administrator['contact_email']
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
<?php echo form_submit($attributes); ?>


<?php
echo form_close();
?>
