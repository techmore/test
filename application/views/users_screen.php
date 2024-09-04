<?php
/**
 *  User Management View
 *
 * This is the main user management view for managing and registering users, schools and districts.
 *
 * 2015 © United States Department of Education
 */

//print_r($role);

?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

<?php
    if((null != $this->session->flashdata('error'))):
?>
    <div id="errorDiv">
        <div class="notify notify-red">
            <span class="symbol icon-error"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('error'));?>
        </div>
    </div>

<?php endif; ?>

<?php
if((null != $this->session->flashdata('success'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-green">
            <span class="symbol icon-tick"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('success'));?>
        </div>
    </div>

<?php endif; ?>



<?php 

// Include the admin menu
include('embeds/admin_menu.php');

if(isset($viewform)){
    include('forms/user.php');
}else if(isset($viewImport) && $viewImport){
    include('forms/import_users.php');
}else if(isset($viewPreview) && $viewPreview){
    include('forms/import_users_preview.php');
}

?>

<?php if( !isset($viewImport)  && !isset($viewPreview)): ?>
<?php if($role['level']<5): ?>
    <div style="margin:10px 5px 20px 0px;">
        <form style="float:left;" action="<?php echo base_url(); ?>user/add"><input type="submit" value="Create New User" style="border: 1px solid #ddd;" /></form>
        <form style="float:left;" action="<?php echo base_url(); ?>user/import"><input type="submit" value="Import Users" style="border: 1px solid #ddd;" /></form>
        <form style="float:left;" action="<?php echo(base_url('report/export/users'));?>"><input type="button" value="Export List of Users" style="border: 1px solid #ddd;" /></form>
        <br style="clear: both;"/>
    </div>
<?php endif; ?>
<div style="overflow: auto;">
    <!-- Hidden field used to store selected user id -->
    <input type="hidden" id="selectedUserId" value="" />
    <table id="userManagementTbl" border="1" rules="rows" class="display" cellspacing="0" width="99%" style="display: block; font-size:13px;">

        <thead>
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">User&nbsp;ID</th>
                <th scope="col">Status</th>
                <th scope="col">User Role</th>
                <th scope="col">School</th>
                <?php 
                    if($role['create_district']=='y'){
                        echo (" <th>School District</th>");
                    }
                ?>
               
                <th>View Only</th>
                <th>Password</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp; Modify User &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($users as $key=>$value): ?>
            <tr>
                <td>
                    <?php echo $value['first_name']." ".$value['last_name']; ?>
                </td>
                <td>
                    <?php echo $value['email']; ?>
                </td>
                <td>
                    <?php echo $value['username']; ?>
                </td>
                <td>
                    <span style="text-transform: capitalize;"><?php echo $value['status']; ?></span>
                </td>
                <td>
                    <?php echo $value['role']; ?>
                </td>
                <td>
                    <?php echo $value['school'] ?>
                </td>
                <?php if($role['create_district']=='y'): ?>
                    <td>
                         <?php echo $value['district'] ?>
                    </td>
                <?php endif; ?>
                <td style="word-wrap: break-word; nowrap:wrap; max-width:80px">
                     <?php echo (($value['read_only']=='n')? 'No':'Yes'); ?>
                </td>
                <td>
                    <a class="resetUserPasswordLink"
                       param1="<?php echo($value['first_name']); ?>"
                       param2="<?php echo($value['last_name']); ?>"
                       param3="<?php echo($value['username']); ?>"
                       data-id="<?php echo($value['user_id']); ?>" href="/user">
                        Reset
                    </a>
                </td>
                <td>
                    <a class="modifyUserProfileLink"
                       param1="<?php echo($value['first_name']); ?>"
                       param2="<?php echo($value['last_name']); ?>"
                       param3="<?php echo($value['email']); ?>"
                       param4="<?php echo($value['username']); ?>"
                       param5="<?php echo($value['phone']); ?>"
                       param6="<?php echo($value['role_id']); ?>"
                       param7="<?php echo($value['district_id']); ?>"
                       param8="<?php echo($value['school_id']); ?>"
                       param9="<?php echo($value['read_only']); ?>"
                       data-id="<?php echo($value['user_id']); ?>" href="<?php echo(base_url('user')); ?>">
                        Edit
                    </a>

                    <?php if($value['status'] == 'active' && $value['user_id'] != $this->session->userdata('user_id')): ?>
                        &nbsp;|&nbsp; <a class="blockUserLink" data-id="<?php echo($value['user_id']); ?>" href="/user"> Block </a>
                    <?php elseif($value['status'] == 'blocked' || !isset($value['status'])): ?>
                        &nbsp;|&nbsp; <a class="unblockUserLink" data-id="<?php echo($value['user_id']); ?>" href="/user"> Activate </a>
                    <?php endif; ?>

                    <?php if($this->session->userdata['role']['level'] <= SCHOOL_ADMIN_LEVEL):
                        if($value['user_id'] != $this->session->userdata('user_id')): ?>
                            &nbsp;|&nbsp; <a class="userDeleteLink" data-id="<?php echo($value['user_id']); ?>" href="/user">Delete</a>
                        <?php endif; ?>
                    <?php endif; ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <td>Full Name</td>
                <td>Email</td>
                <td>User ID</td>
                <td>Status</td>
                <td>User Role</td>
                <td>School</td>
                 <?php 
                    if($role['create_district']=='y'){
                        echo (" <td>School District</td>");
                    }
                ?>
                <td>View Only</td>
                <td>Password</td>
                <td>Modify User</td>
            </tr>
        </tfoot>

    </table>
</div>
<?php endif; ?>

<div id="reset-pwd-dialog" title="Reset Password">
    <?php
        include("forms/password_reset.php");
    ?>
</div>

<div id="update-user-dialog" title="Update User">
    <?php
        include("forms/update_user.php");
    ?>
</div>

<div id="delete_user-member-dialog" title="Delete User">
    <p style="margin-top:20px;"><strong>Are you sure you want to delete this user? </strong> <br /><br />Please note that this user will not be notified through EOP ASSIST that their account has been deleted.</p>
</div>

<div id="block-user-dialog" title="Block User">
    <p style="margin-top:20px;">Are you sure you want to block this user?</p>
</div>
<div id="unblock-user-dialog" title="Block User">
    <p style="margin-top:20px;">Are you sure you want to activate this user?</p>
</div>



<script language="JavaScript" type="text/javascript">


    $(document).ready(function(){


        var selectedDistrict = $('#sltdistrict').val();
        var toggleNone = false;
        var appendedRole = false;
        var appendedValue = null;


        var form_data = {
            ajax:           '1',
            district_id:    (selectedDistrict != 'Null' && selectedDistrict) ? selectedDistrict : -1
        };
        $.ajax({
            url: "<?php echo base_url('school/get_schools_in_district'); ?>",
            type: 'POST',
            data: form_data,
            success: function (response) {
                var schools = JSON.parse(response);
                var schoolElement = $("#sltschool");
                schoolElement.empty(); // remove the old options
                schoolElement.append($("<option></option>")
                    .attr("value", "Null")
                    .text("--Select--"));

                $.each(schools, function (key, value) {
                    schoolElement.append($("<option></option>")
                        .attr("value", value.id)
                        .text(value.name));
                });
            }
        });

        if(selectedDistrict=='Null' || (typeof selectedDistrict == 'undefined')){
            $('#sltschool').empty();
            $('#sltschool').append($("<option></option>")
                .attr("value", "")
                .text("--Select--"));

        }



        $('#userManagementTbl').DataTable({
            "bFilter": true, // For the search text box
            "bInfo": true // For the "Showing 1 to 10 of x entries" text at the bottom
        });

        $('#preview_table').DataTable({
            paging: false,
            searching: false
            //info: false
        });


        /**
         * Form Validation
         *
         */

        /** Remove School User if State Admin is logged in */
        <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL): ?>
                $("#slctuserrole option[value='5']").remove();
        <?php endif; ?>

        $("#user_form").validate({
            rules: {
                phone:{
                    phoneUS2: true
                },
                <?php if($role['level'] < 4 ): ?>
                sltdistrict:{
                    required: true
                },
                sltschool:{
                    required:true
                },
                <?php endif; ?>
            slctuserrole:{
                required: true
            },
            user_password: "required",
            user_password_conf: {
                equalTo: "#user_password"
            },
            username:{
                required: true,
                minlength:3,
                remote:{
                    url: "<?php echo(base_url('user/checkusername')); ?>",
                    type: "POST",
                    data:{
                        username: function(){
                            var user = $("#username").val();
                            return user;
                        },
                        ajax: '1'
                    }

                }
            },
            email:{
                remote:{
                    url: "<?php echo(base_url('user/checkuseremail')); ?>",
                    type: "POST",
                    data:{
                        email: function(){
                            return $("#email").val();
                        },
                        ajax: '1'
                    }

                }
            }
        },
        messages:{
            username:{
                remote: "Username has already been used!"
            },
            email:{
                remote: "Email has already been used!"
            }
        }
    });

    $("#pwd_form").validate({
        rules: {
            user_password_reset: "required",
            user_password_conf_reset: {
                equalTo: "#user_password_reset"
            }
        },
        submitHandler: submit_pwd_form
    });

    $("#update_user_form").validate({
        rules: {
            phone_update:{
                phoneUS2: true
            }
        },
        submitHandler: submit_update_user_form
    });


        $(document).on('submit', '#user_form', function(){

            if($('#districtRow').css("display") != "none"){

                var selectedDistrict = $('#sltdistrict').val();

                if(selectedDistrict == "Null" || selectedDistrict == "-1" || selectedDistrict == -1){
                    $('#sltdistrict').addClass("error");
                    $('#sltdistrict').focus();
                    return false;
                }
            }

        });


    /**
     * Reset Password functionality
     */
    $(document).on('click', '.resetUserPasswordLink', function(){

        var id = $(this).attr('data-id');
        var first_name = $(this).attr('param1');
        var last_name = $(this).attr('param2');
        var user_name = $(this).attr('param3');

        $('#first_name').html(first_name);
        $('#last_name').html(last_name);
        $('#user_name').html(user_name);
        $('#user_id_reset').val(id);

        //Open the reset password dialog form
        $("#reset-pwd-dialog").dialog('open');
        return false;
    });

    $("#reset-pwd-dialog").dialog({
        resizable:      false,
        minHeight:      300,
        minWidth:       500,
        modal:          true,
        autoOpen:       false,
        show:           {
            effect:     'scale',
            duration: 300
        },
        buttons: {
            "Reset Password": function(){
                $("#pwd_form").submit();
            },
            Cancel: function() {
                $("#pwd_form")[0].reset();
                $( this ).dialog( "close" );
            }
        }
    });

    function submit_pwd_form(){

        // TO use encodeURIComponent() only when we use a concocted string but as for now the formdata ensures
        // that jquery takes care of the encoding
        var form_data = {
            user_id               : $('#user_id_reset').val(),
            new_password              : $('#user_password_reset').val(),
            ajax                    : '1'
        };

        $.ajax({
            url: "<?php echo base_url('user/resetpwd'); ?>",
            type: 'POST',
            data: form_data,
            success: function(response) {
                location.reload();
            }
        });

        $('#reset-pwd-dialog').dialog("close");
        return false;

    }

        /**
         * Delete User Profile Information
         *
         */
        $(document).on('click', '.userDeleteLink', function(e){
            selectedId = $(this).attr('data-id');
            deleteUserMemberDialog.dialog('open');
            return false;
        });
       
        var deleteUserMemberDialog = $( "#delete_user-member-dialog" ).dialog({
            autoOpen: false,
            modal: true,
            resizable:  false,
            buttons: {
                "Delete": function(){
                    var form_data = {
                        ajax:       '1',
                        id:    selectedId
                    };
                    $.ajax({
                        url: "<?php echo base_url('user/delete'); ?>",
                        type: 'POST',
                        data: form_data,
                        success: function(response){
                            var res = JSON.parse(response);
                            if(res.deleted==true){
                                //alert('deleted');
                                location.reload();
                            }
                            else{
                                location.reload();
                                //alert('delete failed');
                            }
                        }
                    });

                    $(this).dialog('close');
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            },
            show:           {
                effect:     'scale',
                duration: 300
            }
        });

    /**
     *
     * Update User Profile functionality
     */

    //We use delegation here because of the jquery table pager
    $(document).on('click', '.modifyUserProfileLink', function(){
            var id = $(this).attr('data-id');
            var first_name = $(this).attr('param1');
            var last_name = $(this).attr('param2');
            var email = $(this).attr('param3');
            var user_name = $(this).attr('param4');
            var phone = $(this).attr('param5');
            var role = $(this).attr('param6');
            var district = $(this).attr('param7');
            var school = $(this).attr('param8');
            var access = $(this).attr('param9');

            $('#first_name_update').val(first_name);
            $('#last_name_update').val(last_name);
            $('#email_update').val(email);
            $('#username_update').val(user_name);
            $('#phone_update').val(phone);

            get_schools_in_district(district, school);


            if(role==<?php echo($role['role_id']); ?>){
                    if($("#slctuserrole_update option[value='"+role+"']").length >0){ // Check if the value exists

                    }else{ // If it doesn't exist, add one

                        $('#slctuserrole_update').append($("<option></option>").attr("value", role).text("<?php echo($role['role']); ?>"));
                        appendedRole = true;
                        appendedValue = role;
                    }

                //Lock admins from editing fellow admin's roles by uncommenting here
                    //$('#slctuserrole_update').attr("disabled", true);

                }else{
                    $('#slctuserrole_update').attr("disabled", false);
                    if(appendedRole){
                        $("#slctuserrole_update option[value='"+appendedValue+"']").remove();
                        appendedRole = false;
                        appendedValue=null;
                    }
                }

                $('#slctuserrole_update').val(role);
                if(role == 1){
                    $('#SchoolInputHolder').hide();
                }
                else if(role >= 2){

                    <?php if($role['level'] == DISTRICT_ADMIN_LEVEL || $role['level'] <= STATE_ADMIN_LEVEL): ?> // If logged in as a district or state admin, show the school to enable school changes
                        if(role >3){
                            $('#SchoolInputHolder').show();
                            $('#sltschool_update').val(school);
                        }else{
                            $('#SchoolInputHolder').hide();
                        }
                    <?php endif; ?>
                    <?php if($role['level']>3): ?>
                        $('#SchoolInputHolder').hide();
                    <?php endif; ?>
                }
                else{
                    $('#SchoolInputHolder').show();
                }


                <?php if($role['level']<2): ?>
                $('#sltdistrict_update').val(district);
                $('#sltschool_update').val(school);

                <?php endif; ?>

                if(role <3 ){
                    $("#sltdistrict_update option[value='']").remove();
                    $('#districtInputHolder').hide();
                    $('#sltdistrict_update').attr("required", false);
                }
                else{

                    $("#sltdistrict_update option[value='']").remove();
                    if(role !=3){
                        $("<option></option>")
                            .val('')
                            .html("None")
                            .insertAfter($('#sltdistrict_update').children().first());
                    }

                    $('#districtInputHolder').show();
                    $('#sltdistrict_update').val(district);
                }
                $('#user_access_permission_update').val(access);
                $('#user_id_update').val(id);

                if(role !=5){
                    $('#viewonlyInputHolder').hide();
                }else{
                    $('#viewonlyInputHolder').show();
                }
                    if(role <=2 ){
                        $('#districtInputHolder').hide();
                    }

                //Open the update user dialog form
                $("#update-user-dialog").dialog('open');
                return false;
            });



            $("#update-user-dialog").dialog({
                resizable:      false,
                minHeight:      300,
                minWidth:       500,
                modal:          true,
                autoOpen:       false,
                show:           {
                    effect:     'scale',
                    duration: 300
                },
                buttons: {
                    "Update": function(){

                        if($('#districtInputHolder').css('display') != 'none'){
                            var selectedDistrict = $('#sltdistrict_update').val();

                            if(selectedDistrict == "Null" || selectedDistrict == "-1" || selectedDistrict == -1){
                                $('#sltdistrict_update').addClass("error");
                                $('#sltdistrict_update').focus();
                                return false;
                            }else{
                                $("#update_user_form").submit();
                            }
                        }else{
                            $("#update_user_form").submit();
                        }
                    },
                    Cancel: function() {
                        $("#update_user_form")[0].reset();
                        $( this ).dialog( "close" );
                    }
                }
            });

            function submit_update_user_form(){
                var form_data = {
                    user_id                 : $('#user_id_update').val(),
                    first_name              : $('#first_name_update').val(),
                    last_name               : $('#last_name_update').val(),
                    email                   : $('#email_update').val(),
                    username                : $('#username_update').val(),
                    phone                   : $('#phone_update').val(),
                    role_id                 : ($('#role_id_update').val()== "<?php echo($role['role_id']); ?>") ? $('#role_id_update').val() :  $('#slctuserrole_update').val(),
                    <?php if($role['level']<3): ?>
                        school_id               : $('#sltschool_update').val(),
                        district_id             : $('#sltdistrict_update').val(),
                    <?php endif; ?>
                    <?php if($role['level']==3): ?>
                        school_id               : $('#sltschool_update').val(),
                        district_id             : $('#sltdistrict_update').val(),
                    <?php endif; ?>
                    access                  : $('#user_access_permission_update').val(),
                    ajax                    : '1'
                };

                $.ajax({
                    url: "<?php echo base_url('user/update'); ?>",
                    type: 'POST',
                    data: form_data,
                    success: function(response) {
                        location.reload();
                    }
                });

                $('#update-user-dialog').dialog("close");
                return false;
            }

        // Change School list according to district selected
        $(document).on('change','#sltdistrict', function(){

          //  alert(this.value);
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
                    var schoolElement = $("#sltschool");
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

        });

        function getDistrictSchools(){

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
                    var schoolElement = $("#sltschool");
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

            /**
            * Block User functionality
            */
            $(document).on('click', '.blockUserLink', function(){

                var id = $(this).attr('data-id');
                $('#selectedUserId').val(id);
                blockUserDialog.dialog('open');
                return false;
            });
            /**
             * Unblock User functionality
             * */
             $(document).on('click', '.unblockUserLink', function(){

                var id = $(this).attr('id');
                $('#selectedUserId').val(id);
                unblockUserDialog.dialog('open');
                return false;

            });

            function getSelectedId(){
                return selectedUserId;
            }

            var blockUserDialog = $( "#block-user-dialog" ).dialog({
             autoOpen: false,
             modal: true,
             buttons: {
                 "Yes": function(){
                    var form_data = {
                        ajax:       '1',
                        user_id:    $('#selectedUserId').val()
                    };
                    $.ajax({
                        url: "<?php echo base_url('user/block'); ?>",
                        type: 'POST',
                        data: form_data,
                        success: function(response){
                            location.reload();
                        }
                    });
                 },
                 Cancel: function() {
                     $( this ).dialog( "close" );
                     }
                 }
             });

            var unblockUserDialog = $( "#unblock-user-dialog" ).dialog({
             autoOpen: false,
             modal: true,
             buttons: {
                 "Ok": function(){

                    var form_data = {
                        ajax:       '1',
                        user_id:    $('#selectedUserId').val()
                    };
                    $.ajax({
                        url: "<?php echo base_url('user/unblock'); ?>",
                        type: 'POST',
                        data: form_data,
                        success: function(response){
                            location.reload();
                        }
                    });
                 },
                 Cancel: function() {
                     $( this ).dialog( "close" );
                     }
                 }
             });

            /***
            * Load District dropdown when district admin is selected
            */
            if($('select#slctuserrole').val() == 3){
                $('#viewonlyRow').css('display', 'none');
                $('#districtRow').css('display', 'table-row');
                $('#schoolRow').css('display', 'none');
                $('#sltschool').val(null);
                $('#sltdistrict option[value=""]').each(function(){
                    $(this).remove();
                });
                toggleNone = true;
                $('#sltdistrict').rules("add", "required");
                $('#districtRow span').addClass("required");
            }
            if($('select#slctuserrole').val() == 2){
                $('#viewonlyRow').css('display', 'none');
                $('#schoolRow').css('display', 'none');
                $('#districtRow').css('display', 'none');
                $('#sltschool').val('Null');
                $('#sltdistrict').val('Null');
            }
            if($('select#slctuserrole').val() == 4){
                $('#viewonlyRow').css('display', 'none');
                $('#schoolRow').css('display', 'table-row');
                $('#districtRow').css('display', 'table-row');
                $('#sltdistrict').attr("required", false);
                $('#sltdistrict').rules("remove", "required");
                $('#districtRow span').addClass("required");
            }
            if($('select#slctuserrole').val() == 5){ // if School user
                $('#viewonlyRow').css('display', 'table-row');
                $('#schoolRow').css('display', 'table-row');


                <?php if($role['level']>=3): ?>// if logged in as District or School admin, remove the district
                    $('#sltdistrict').val(null);
                    $('#sltdistrict').attr("required", false);
                    $('#sltdistrict').rules("remove", "required");
                <?php else: ?>//Else show the district as optional for State and Super admins
                    $('#districtRow').css('display', 'table-row');
                    $('#sltdistrict').attr("required", false);
                    $('#sltdistrict').rules("remove", "required");
                <?php endif; ?>
            }

            $('select#slctuserrole').on('change', function() {
                $('#viewonlyRow').css('display', 'none');

                if(this.value == 3){ // District Admin selected

                    $('#schoolRow').css('display', 'none');
                    $('#sltschool').val('Null');
                    <?php if($role['level']!=3): ?>
                        $('#sltdistrict option[value=""]').each(function(){
                            $(this).remove();
                        });
                        toggleNone = true;


                        $('#districtRow').css('display', 'table-row');
                        $('#sltdistrict').rules("add", "required");
                        $('#districtRow span').addClass("required");
                    <?php endif; ?>
                }
                else if(this.value==2){ // State Admin selected
                    $('#districtRow').css('display', 'none');
                    $('#schoolRow').css('display', 'none');
                    $('#sltdistrict').val('Null');
                    $('#sltschool').val('Null');
                }
                else if(this.value == 4){ //School admin selected
                    $('#schoolRow').css('display', 'table-row');

                    <?php if($role['level']!=3): ?>
                        $('#districtRow').css('display', 'table-row');
                        $('#sltdistrict').attr("required", false);
                        $('#sltdistrict').rules("remove", "required");
                        if(toggleNone == true){
                            /*$('#sltdistrict').prepend($("<option></option>")
                                .attr("value","")
                                .text("None"));*/
                            $("<option></option>")
                                .val('')
                                .html("None")
                                .insertAfter($('#sltdistrict').children().first());
                            toggleNone = false;
                        }
                        $('#sltdistrict').val('Null');
                        $('#districtRow span').addClass("required");
                        $('#sltschool').empty();
                        $('#sltschool').append($("<option></option>")
                            .attr("value", "")
                            .text("--Select--"));

                    <?php else: ?>
                        getDistrictSchools();
                    <?php endif; ?>
                }else if(this.value == 5){ //School User selected
                    $('#viewonlyRow').css('display', 'table-row');
                    $('#schoolRow').css('display', 'table-row');

                    //if user is being added by district or school admin, remove the district
                    <?php if($role['level']>=3): ?>
                    $('#districtRow').css('display', 'none');
                    $('#sltdistrict').val(null);
                    $('#sltdistrict').attr("required", false);
                    $('#sltdistrict').rules("remove", "required");
                    getDistrictSchools();
                    if(toggleNone == true){
                        /*$('#sltdistrict').prepend($("<option></option>")
                            .attr("value", "")
                            .text("None"));*/
                        $("<option></option>")
                            .val('')
                            .html("None")
                            .insertAfter($('#sltdistrict').children().first());
                        toggleNone = false;
                    }
                    $('#sltdistrict').val('Null');
                    <?php else: ?> // Else show the district for State and Super admins
                    $('#districtRow').css('display', 'table-row');
                    $('#sltdistrict').attr("required", true);

                    $('#sltschool').empty();
                    $('#sltschool').append($("<option></option>")
                        .attr("value", "")
                        .text("--Select--"));

                    <?php endif; ?>
                }



            });


        function get_schools_in_district(district_id, school){

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

                    if(school =='') {
                        schoolElement.append($("<option></option>")
                            .attr("value", "")
                            .attr("selected", "selected")
                            .text("--Select--"));
                    }else{
                        schoolElement.append($("<option></option>")
                            .attr("value", "")
                            .text("--Select--"));
                    }

                    $.each(schools, function (key, value) {
                        if(school == value.id){
                            schoolElement.append($("<option></option>")
                                .attr("value", value.id)
                                .attr("selected", "selected")
                                .text(value.name));
                        }else{
                            schoolElement.append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.name));
                        }

                    });
                }
            });
        }

        $("#user_form").on('reset', function(e){
            window.location = "<?php echo(base_url()); ?>user";
        });

        $("#user_upload_csv_form").on('reset', function(e){
            window.location = "<?php echo(base_url()); ?>user";
        });
        $("#user_import_form").on('reset', function(e){
            window.location = "<?php echo(base_url()); ?>user";
        });

        /*$("#btnChooseFile").click(function(){
            $("#csvInp").trigger('click');
        });*/

        $("#csvInp").change(function(){
            //$("#user_upload_csv_form").trigger('submit');
            $("#user_upload_csv_form").submit();
        });

    });
</script>

<style>
    input.import_first_name, input.import_last_name, input.import_email, input.import_phone, input.import_password{
        width: 100%;
        padding: 10px;
        margin: 0px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }

    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        position: relative;
        display: inline-block;
        color: #fff;
        background: #112E51;
        border: none;
        cursor: pointer;
        padding: 6px 12px;
        font-weight: bold;
        font-size: .9em;
        outline: none !important;
    }

    .ic-cloud-upload-48px {
        background-image: url(data:image/png;base64,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);
        width: 20px;
        height: 18px;
        float:left;
        background-size:20px 18px;
        background-repeat:no-repeat;
    }
</style>