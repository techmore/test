<?php
/**
 *  Form that manages user profile updates/edits
 */

echo form_open('user/update', array('class'=>'update_user_form', 'id'=>'update_user_form'));

?>
<style type="text/css">
    fieldset label{ display: inline-block; min-width: 120px;}
    fieldset p{ margin:10px 0px;}

</style>

<fieldset>
    <input type="hidden" name="user_id_update" id="user_id_update" value="">
    <input type="hidden" name="role_id_update" id="role_id_update" value="">
    <!--<legend>Personal Information</legend>-->
    <p>
        <span class="required">*</span>
        <label for="first_name_update">First Name:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'first_name_update',
            'id'        =>  'first_name_update',
            'required'  =>  'required',
            'minlength'  =>  '3',
            'size'      =>   '30'
        );
        echo form_input($inputAttributes);
        ?>

    </p>
    <p>
        <span class="required">*</span>
        <label for="last_name_update">Last Name:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'last_name_update',
            'id'        =>  'last_name_update',
            'required'  =>  'required',
            'minlength'  =>  '3',
            'size'      =>   '30'
        );
        echo form_input($inputAttributes);
        ?>
    </p>
    <p>
        <span class="required">*</span>
        <label for="email_update">Email:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'email_update',
            'id'        =>  'email_update',
            'required'  =>  'required',
            'minlength' =>  '3',
            'type'      =>  'email',
            'size'      =>  '36'
        );
        echo form_input($inputAttributes);
        ?>
    </p>
    <p>
        <span class="required">*</span>
        <label for="username_update">User ID:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'username_update',
            'id'        =>  'username_update',
            'required'  =>  'required',
            'minlength' =>  '2',
            'size'      =>  '30'
        );
        echo form_input($inputAttributes);
        ?>
    </p>
    <p>
        <span>&nbsp;</span>
        <label for="phone_update">Phone Number:</label>
        <?php
        $inputAttributes = array(
            'name'      =>  'phone_update',
            'id'        =>  'phone_update',
            'size'      =>  18
        );
        echo form_input($inputAttributes);
        ?>
    </p>

    <p>
        <span>&nbsp;</span>
        <label for="slctuserrole_update">User Role:</label>
        <?php
        $options = array();
        //$options['empty'] = '--Select--';
        foreach($roles as $rowIndex => $row){
            $options[$row['role_id']] = $row['title'];
        }

        $otherAttributes = 'id="slctuserrole_update"  style=""';
        reset($options);
        $first_key = key($options);
        echo form_dropdown('slctuserrole_update', $options, "$first_key", $otherAttributes);
        ?>
    </p>
    <?php if($role['level']<=2):  // Super and State admin should edit user districts ?>
        <p id="districtInputHolder">
            <span>&nbsp;</span>
            <label for="sltdistrict_update">School District:</label>
            <?php
            $options = array();
            $options['Null'] = '--Select--';
            foreach($districts as $rowIndex => $row){
                $options[$row['id']] = $row['name'];
            }

            $otherAttributes = 'id="sltdistrict_update" style=""';
            reset($options);
            $first_key = key($options);
            echo form_dropdown('sltdistrict_update', $options, "$first_key", $otherAttributes);
            ?>
        </p>
    <?php endif; ?>

    <?php if($role['level']==3): // District admin should default to current district id ?>
        <p id="districtInputHolder">
            
            <input type="hidden" name="sltdistrict_update" id="sltdistrict_update" value="<?php echo($this->session->userdata('district_id')); ?>">
        </p>
    <?php endif; ?>

    <?php if($role['level']<=3)://Only Super admin, state admin and district admin should change user's school ?>
    <p id="SchoolInputHolder">
        <span>&nbsp;</span>
        <label for="sltschool_update">School:</label>
        <?php
        $options = array();
        $options[''] = '--Select--';
        foreach($schools as $rowIndex => $row){
            $options[$row['id']] = $row['name'];
        }

        $otherAttributes = 'id="sltschool_update" style=""';
        reset($options);
        $first_key = key($options);
        echo form_dropdown('sltschool_update', $options, "$first_key", $otherAttributes);
        ?>
    </p>

    <?php endif; ?>

    <p id="viewonlyInputHolder">
        <span>&nbsp;</span>
        <label for="user_access_permission_update">View Only:</label>
        <?php
        $options = array(
            'y'      => 'Yes',
            'n'      =>  'No'
        );

        $otherAttributes = 'id="user_access_permission_update" style=""';
        echo form_dropdown('user_access_permission_update', $options, 'y', $otherAttributes);
        ?>

    </p>
</fieldset>


<?php echo(form_close()); ?>

<script>
    $(document).ready(function(){
        $("#slctuserrole_update").change(function(){
            $('#sltdistrict_update').removeClass('error');
            $('#sltschool_update').removeClass('error');

            if($(this).val()==3){
                $("#districtInputHolder").show();
                $("#SchoolInputHolder").hide();

                $("#sltdistrict_update > option[value='']").remove();
                $('#sltdistrict_update option').eq(1).before($("<option></option>").val("").text("None"));


                $('#sltschool_update').attr('required', false);
                <?php if($role['level']!=4): ?>
                    $('#sltschool_update').rules('remove', 'required');
                <?php endif; ?>
            }
            else if($(this).val()==4 || $(this).val()==5){
                $("#districtInputHolder").show();
                $("#SchoolInputHolder").show();

                $("#sltdistrict_update > option[value='']").remove();
                $('#sltdistrict_update option').eq(1).before($("<option></option>").val("").text("None"));


                $('#sltschool_update').attr('required', true);
                <?php if($role['level']!=4): ?>
                    $('#sltschool_update').rules('add', 'required');
                <?php endif; ?>

                <?php if($role['level']==3): ?>
                    get_schools_in_district(<?php echo($adminDistrict); ?>);
                <?php else: ?>
                    get_schools_in_district($('#sltdistrict_update').val());
                <?php endif; ?>
            }
            else if($(this).val()==1 || $(this).val()==2){
                $("#districtInputHolder").hide();
                $("#SchoolInputHolder").hide();

                $('#sltschool_update').attr('required', false);
                $('#sltschool_update').rules('remove', 'required');
            }

            if($(this).val() == 5){
                $('#viewonlyInputHolder').show();
            }else{
                $('#viewonlyInputHolder').hide();
            }
        });


        $("#sltdistrict_update").change(function(){
            var district_id = $(this).val();
            get_schools_in_district(district_id);
        });






        function get_schools_in_district(district_id){
            //  alert(this.value);
            var form_data = {
                ajax:           '1',
                district_id:    (district_id != 'Null') ? district_id : -1
            };


            $.ajax({
                url: "<?php echo base_url('school/get_schools_in_district'); ?>",
                type: 'POST',
                data: form_data,
                success: function (response) {
                    var schools = JSON.parse(response);
                    var schoolElement = $("#sltschool_update");
                    schoolElement.empty(); // remove the old options

                    schoolElement.append($("<option></option>")
                        .attr("value", "")
                        .text("--Select--"));

                    $.each(schools, function (key, value) {
                        schoolElement.append($("<option></option>")
                            .attr("value", value.id)
                            .text(value.name));
                    });
                }
            });
        }
    });
</script>