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
    echo form_open('user/import/save', array('class'=>'user_import_form', 'id'=>'user_import_form'));
?>
    <h1> Preview of Imported User Profiles</h1>
    <p>Please assign a user role, school district, and school to each user profile.</p>
<table  width="99%" rules="rows" id="preview_table" class="display dataTable">
    <thead>
        <tr>
            <th>First Name </th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Password</th>
            <?php if($role['level'] <= SCHOOL_ADMIN_LEVEL): ?>
            <th>
                User Role
                <br/>
                <?php

                $options = array();
                $options[''] = '--Select--';
                foreach($roles as $rowIndex => $row){
                    if($role['level']<=$row['level'])
                        $options[$row['role_id']] = $row['title'];
                }

                $otherAttributes = 'id="global_role" class="global_role"';
                reset($options);
                $first_key = key($options);
                echo form_dropdown('global_role', $options, "$first_key", $otherAttributes);
                ?>
            </th>
            <?php endif; ?>
            <?php if($role['level'] < DISTRICT_ADMIN_LEVEL): ?>
            <th>
                School District
                <br/>
                <?php
                $options = array();
                $options['Null'] = '--Select--';
                $options['']    =   'None';
                foreach($districts as $rowIndex => $row){
                    $options[$row['id']] = $row['name'];
                }
                $otherAttributes = 'id="global_district" class="global_district"';
                reset($options);
                $first_key = key($options);
                echo form_dropdown('global_district', $options, "$first_key", $otherAttributes);
                ?>
            </th>
            <?php endif; ?>

            <?php if($role['level'] < SCHOOL_ADMIN_LEVEL): ?>
            <th>
                School
                <br/>
                <?php
                $options = array();
                $options['Null'] = '--Select--';


                $otherAttributes = 'id="global_school" class="global_school" ';
                reset($options);
                $first_key = key($options);
                echo form_dropdown('global_school', $options, "$first_key", $otherAttributes);
                ?>
            </th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($csvData as $dataKey=>$value): ?>
            <?php if($dataKey>0): ?>
                <tr>
                    <td><input type="text" name="first_name[]"  class="import_first_name"   value="<?php echo($value[0]); ?>" required /></td>
                    <td><input type="text" name="last_name[]"   class="import_last_name"    value="<?php echo($value[1]); ?>" required /></td>
                    <td><input type="text" name="email[]"       class="import_email"        value="<?php echo($value[2]); ?>" required /></td>
                    <td><input type="text" name="phone[]"       class="import_phone"        value="<?php echo($value[3]); ?>" required /></td>
                    <td>
                        <input type="text" name="password[]"    class="import_password"     value="<?php echo($value[4]); ?>" required />
                        <?php

                            if($role['level'] == DISTRICT_ADMIN_LEVEL){
                                echo form_hidden('sltdistrict[]', $this->session->userdata['loaded_district']['id']);
                            }elseif(isset($this->session->userdata['loaded_school']) ){
                                echo form_hidden('sltdistrict[]', $this->session->userdata['loaded_school']['district_id']);
                            }

                        if($role['level'] >= SCHOOL_ADMIN_LEVEL){
                            echo form_hidden('sltschool[]', $this->session->userdata['loaded_school']['id']);
                        }

                        ?>
                        <script type="text/javascript">
                            var toggleNone = false;
                            $(document).on('change','#sltdistrict<?php echo($dataKey); ?>', function(){

                                //  if not state or district administrator role, update the school drop down
                                if($('select#slctuserrole<?php echo($dataKey); ?>').val()>3){
                                    var form_data = {
                                        ajax:           '1',
                                        district_id:    (this.value != 'Null') ? this.value : -1
                                    };


                                    $.ajax({
                                        url: "<?php echo base_url('school/get_schools_in_district'); ?>",
                                        type: 'POST',
                                        data: form_data,
                                        success: function (response) {
                                            var schools = JSON.parse(response);
                                            var schoolElement = $("#sltschool<?php echo($dataKey); ?>");
                                            var hiddenSchoolElement = $("#hidden_sltschool<?php echo($dataKey); ?>");
                                            schoolElement.attr('disabled', false);
                                            hiddenSchoolElement.attr('disabled', true);
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

                            $('select#slctuserrole<?php echo($dataKey); ?>').on('change', function() {

                                $('#sltdistrict<?php echo($dataKey); ?>').val('Null');
                                $('#sltschool<?php echo($dataKey); ?>').val('Null');

                                if(this.value == 3){ // District Admin selected

                                    $('#sltschool<?php echo($dataKey); ?>').val('Null').attr('disabled', true);
                                    $('#hidden_sltschool<?php echo($dataKey); ?>').val('Null').attr('disabled', false);

                                    <?php if($role['level']!=3): ?>
                                    $('#sltdistrict<?php echo($dataKey); ?> option[value=""]').each(function(){
                                        $(this).remove();
                                    });
                                    toggleNone = true;


                                    $('#sltdistrict<?php echo($dataKey); ?>').attr("required", "required");
                                    <?php endif; ?>
                                }
                                else if(this.value==2){ // State Admin selected

                                    $('#sltdistrict<?php echo($dataKey); ?>').val('Null').attr('disabled', true);
                                    $('#hidden_sltdistrict<?php echo($dataKey); ?>').val('Null').attr('disabled', false);

                                    $('#sltschool<?php echo($dataKey); ?>').val('Null').attr('disabled', true);
                                    $('#hidden_sltschool<?php echo($dataKey); ?>').val('Null').attr('disabled', false);
                                }
                                else if(this.value == 4){ //School admin selected

                                    <?php if($role['level']!=3): ?>
                                    $('#sltdistrict<?php echo($dataKey); ?>').attr("required", false);
                                    $('#sltdistrict<?php echo($dataKey); ?>').attr("disabled", false);
                                    $('#hidden_sltdistrict<?php echo($dataKey); ?>').attr("disabled", true);

                                    if(toggleNone == true){
                                        /*$('#sltdistrict').prepend($("<option></option>")
                                         .attr("value","")
                                         .text("None"));*/
                                        $("<option></option>")
                                            .val('')
                                            .html("None")
                                            .insertAfter($('#sltdistrict<?php echo($dataKey); ?>').children().first());
                                        toggleNone = false;
                                    }
                                    $('#sltdistrict<?php echo($dataKey); ?>').val('Null');
                                    $('#sltschool<?php echo($dataKey); ?>').empty();
                                    $('#sltschool<?php echo($dataKey); ?>').append($("<option></option>")
                                        .attr("value", "")
                                        .text("--Select--"));

                                    <?php else: ?>
                                    getDistrictSchools<?php echo($dataKey); ?>();
                                    <?php endif; ?>
                                }else if(this.value == 5){ //School User selected

                                    //if user is being added by district or school admin, remove the district
                                    <?php if($role['level']>=3): ?>
                                    $('#sltdistrict<?php echo($dataKey); ?>').val('Null');
                                    $('#sltdistrict<?php echo($dataKey); ?>').attr("required", false);
                                    $('#sltdistrict<?php echo($dataKey); ?>').attr("disabled", false);
                                    $('#hidden_sltdistrict<?php echo($dataKey); ?>').attr("disabled", true);

                                    getDistrictSchools<?php echo($dataKey); ?>();
                                    if(toggleNone == true){
                                        /*$('#sltdistrict').prepend($("<option></option>")
                                         .attr("value", "")
                                         .text("None"));*/
                                        $("<option></option>")
                                            .val('')
                                            .html("None")
                                            .insertAfter($('#sltdistrict<?php echo($dataKey); ?>').children().first());
                                        toggleNone = false;
                                    }
                                    $('#sltdistrict<?php echo($dataKey); ?>').val('Null');
                                    <?php else: ?> // Else show the district for State and Super admins
                                    $('#sltdistrict<?php echo($dataKey); ?>').attr("required", true);

                                    $('#sltschool<?php echo($dataKey); ?>').attr('disabled', false);
                                    $('#hidden_sltschool<?php echo($dataKey); ?>').attr('disabled', true);

                                    $('#sltschool<?php echo($dataKey); ?>').empty();
                                    $('#sltschool<?php echo($dataKey); ?>').append($("<option></option>")
                                        .attr("value", "")
                                        .text("--Select--"));

                                    <?php endif; ?>
                                }

                            });
                            function getDistrictSchools<?php echo($dataKey); ?>(){

                                var form_data = {
                                    ajax:           '1'
                                    <?php echo((isset($adminDistrict) && !empty($adminDistrict))? ", district_id:".$adminDistrict."" : "");?>
                                };


                                $.ajax({
                                    url: "<?php echo base_url('school/get_schools_in_district'); ?>",
                                    type: 'POST',
                                    data: form_data,
                                    success: function (response) {
                                        var schools = JSON.parse(response);
                                        var schoolElement = $("#sltschool<?php echo($dataKey); ?>");
                                        var hiddenSchoolElement = $("#hidden_sltschool<?php echo($dataKey); ?>");
                                        schoolElement.attr('disabled', false);
                                        hiddenSchoolElement.attr('disabled', true);
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
                        </script>

                    </td>
                    <?php if($role['level'] <= SCHOOL_ADMIN_LEVEL): ?>
                    <td>
                        <?php
                            $options = array();
                            $options[''] = '--Select--';
                            foreach ($roles as $rowIndex => $row) {
                                if ($role['level'] <= $row['level'])
                                    $options[$row['role_id']] = $row['title'];
                            }

                            $otherAttributes = 'id="slctuserrole' . $dataKey . '" class="slctuserrole" style="" required="required"';
                            reset($options);
                            $first_key = key($options);
                            echo form_dropdown('slctuserrole[]', $options, "$first_key", $otherAttributes);

                        ?>
                    </td>
                    <?php endif; ?>

                    <?php if($role['level'] < DISTRICT_ADMIN_LEVEL): ?>
                    <td>
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
                    </td>
                    <?php endif; ?>

                    <?php if($role['level'] < SCHOOL_ADMIN_LEVEL): ?>
                    <td>


                        <?php
                        $options = array();
                        $options['Null'] = '--Select--';
                        /*foreach($schools as $rowIndex => $row){
                            $options[$row['id']] = $row['name'];
                        }*/

                        $otherAttributes = 'id="sltschool'.$dataKey.'" class="sltschool" required="required" style=""';
                        reset($options);
                        $first_key = key($options);
                        echo form_dropdown('sltschool[]', $options, "$first_key", $otherAttributes);
                        ?>
                        <input type="hidden" class="hidden_sltschool" id="hidden_sltschool<?php echo($dataKey); ?>" name="sltschool[]" value="Null" disabled />
                    </td>
                    <?php endif; ?>

                </tr>

            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>

</table>
    <p>
        <?php
        $attributes = array(
            'name'  =>  'user_form_submit',
            'value' =>  'Save',
            'id'    =>  'user_form_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
        <?php echo form_reset(array(
            'name'      =>'user_form_reset',
            'value'     => 'Cancel',
            'id'        => 'user_form_reset')); ?>
    </p>
    <?php  echo form_close(); ?>
    <script type="text/javascript">

        $("#global_school").on('change', function(e){
            $(".sltschool").val(this.value);
        });

        $("#global_district").on('change', function(e){

            $(".sltdistrict").val(this.value);

            //  if not state or district administrator role, update the school drop down
            if($('select.slctuserrole').val()>3){
                var form_data = {
                    ajax:           '1',
                    district_id:    (this.value != 'Null') ? this.value : -1
                };


                $.ajax({
                    url: "<?php echo base_url('school/get_schools_in_district'); ?>",
                    type: 'POST',
                    data: form_data,
                    success: function (response) {
                        var schools = JSON.parse(response);
                        var schoolElement = $(".sltschool");
                        var hiddenSchoolElement = $(".hidden_sltschool");
                        schoolElement.attr('disabled', false);
                        hiddenSchoolElement.attr('disabled', true);
                        schoolElement.empty(); // remove the old options

                        var globalElement = $("#global_school");
                        globalElement.append($("<option></option>")
                            .attr("value", "")
                            .text("--Select--"));

                        $.each(schools, function (key, value) {
                            globalElement.append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.name));
                        });

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
        $("#global_role").on('change', function(e){
            $('.sltdistrict').val('Null');
            $('.sltschool').val('Null');

            $('.slctuserrole').val(this.value);

            if(this.value ==3){ //District Administrator selected
                $("#global_district").attr('disabled', false);
                $("#global_school").attr('disabled', true);

                $('.sltschool').val('Null').attr('disabled', true);
                $('.hidden_sltschool').val('Null').attr('disabled', false);

                <?php if($role['level']!=3): ?>
                $('.sltdistrict option[value=""]').each(function(){
                    $(this).remove();
                });

                toggleNone = true;
                $('.sltdistrict').attr("disabled", false);
                $('.hidden_sltdistrict').attr("disabled", true);
                $('.sltdistrict').attr("required", "required");
                <?php endif; ?>
            }else if(this.value==2){ //State Admin selected
                $("#global_district").attr('disabled', true);
                $("#global_school").attr('disabled', true);

                $('.sltdistrict').val('Null').attr('disabled', true);
                $('.hidden_sltdistrict').val('Null').attr('disabled', false);

                $('.sltschool').val('Null').attr('disabled', true);
                $('.hidden_sltschool').val('Null').attr('disabled', false);
            }else if(this.value == 4){ // School Admin is selected
                $("#global_district").attr('disabled', false);
                $("#global_school").attr('disabled', false);

                <?php if($role['level']!=3): ?>
                $('.sltdistrict').attr("required", false);
                $('.sltdistrict').attr("disabled", false);
                $('.hidden_sltdistrict').attr("disabled", true);

                $('.sltschool').attr('disabled', false);
                $('.hidden_sltschool').attr('disabled', true);

                if(toggleNone == true){

                    $("<option></option>")
                        .val('')
                        .html("None")
                        .insertAfter($('.sltdistrict').children().first());
                    toggleNone = false;
                }
                $('.sltdistrict').val('Null');
                $('.sltschool').empty();
                $('.sltschool').append($("<option></option>")
                    .attr("value", "")
                    .text("--Select--"));

                <?php else: ?>
                $('.sltdistrict').attr("disabled", false);
                $('.hidden_sltdistrict').attr("disabled", true);

                $('.sltschool').attr('disabled', false);
                $('.hidden_sltschool').attr('disabled', true);
                getDistrictSchoolsGlobal();
                <?php endif; ?>
            }else if(this.value == 5){ // School user selected

                $("#global_district").attr('disabled', false);
                $("#global_school").attr('disabled', false);

                //if user is being added by district or school admin, remove the district
                <?php if($role['level']>=3): ?>
                $('.sltdistrict').val('Null');
                $('.sltdistrict').attr("required", false);
                $('.sltdistrict').attr("disabled", false);
                $('.hidden_sltdistrict').attr("disabled", true);

                getDistrictSchoolsGlobal();
                if(toggleNone == true){

                    $("<option></option>")
                        .val('')
                        .html("None")
                        .insertAfter($('.sltdistrict').children().first());
                    toggleNone = false;
                }
                $('.sltdistrict').val('Null');
                <?php else: ?> // Else show the district for State and Super admins
                $('.sltdistrict').attr("disabled", false);
                $('.hidden_sltdistrict').attr("disabled", true);
                $('.sltdistrict').attr("required", true);

                $('.sltschool').attr('disabled', false);
                $('.hidden_sltschool').attr('disabled', true);

                $('.sltschool').empty();
                $('.sltschool').append($("<option></option>")
                    .attr("value", "")
                    .text("--Select--"));

                <?php endif; ?>

            }
        });

        function getDistrictSchoolsGlobal(){

            var form_data = {
                ajax:           '1'
                <?php echo((isset($adminDistrict) && !empty($adminDistrict))? ", district_id:".$adminDistrict."" : "");?>
            };


            $.ajax({
                url: "<?php echo base_url('school/get_schools_in_district'); ?>",
                type: 'POST',
                data: form_data,
                success: function (response) {
                    var schools = JSON.parse(response);
                    var schoolElement = $(".sltschool");
                    var hiddenSchoolElement = $(".hidden_sltschool");
                    schoolElement.attr('disabled', false);
                    hiddenSchoolElement.attr('disabled', true);
                    schoolElement.empty(); // remove the old options



                    schoolElement.append($("<option></option>")
                        .attr("value", "")
                        .text("--Select--"));

                    $("#global_school").append($("<option>")
                        .attr("value", "")
                        .text("--Select--"));

                    $.each(schools, function (key, value) {
                        schoolElement.append($("<option></option>")
                            .attr("value", value.id)
                            .text(value.name));

                        $("#global_school").append($("<option>")
                            .attr("value", value.id)
                            .text(value.name));
                    });
                }
            });
        }
    </script>
<?php endif; ?>