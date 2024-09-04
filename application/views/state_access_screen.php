<?php
/**
 *  State Access Management View
 *
 * This is the main district management view for managing and registering users, schools and districts.
 *
 * 2015 © United States Department of Education
 */
//echo $stateWideStateAccess;
//print_r( $districtWideStateAccess);
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

<?php if((null == $this->session->flashdata('success')) && (null == $this->session->flashdata('error')) ): ?>
    <div id="errorDiv">
    </div>
<?php endif; ?>

<?php 
// Include the admin menu
include('embeds/admin_menu.php');

?>

<div>
    <table width="100%" class="adminTable">
        <tr>
            <td></td>
            <td>Status</td>
            <td>Action</td>
        </tr>
        <tr>

            <?php if($role['level']==2 || $role['level']==1): //State or Super admin administrator ?>
                <td>State Access to School EOPs</td>
                <td>
                    <span id="state_access_icon" class="<?php echo (($stateWideStateAccess=='write' || $stateWideStateAccess=='read')? 'approved_button':'revoked_button'); ?>"></span>
                    <span id="access-label"><?php echo (($stateWideStateAccess=='write' || $stateWideStateAccess=='read')? 'Enabled':'Disabled'); ?></span>
                </td>
                <td>
                    <div id="" class="approval-holder">
                        <?php if($stateWideStateAccess == 'write' || $stateWideStateAccess == 'read'): ?>
                            <button value="" class="btn-revoke"><em class="leftImage revoke"></em>Disable</button>
                            <script>
                                $(document).ready(function(){
                                    $(".status").html('enabled');
                                });
                            </script>
                        <?php endif; ?>
                        <?php if($stateWideStateAccess == 'deny'): ?>
                         <button value="" class="btn-approve"><em class="leftImage approve"></em>Enable</button>
                            <script>
                                $(document).ready(function(){
                                    $(".status").html('disabled');
                                });
                            </script>
                        <?php endif; ?>

                    </div>
                </td>
            <?php endif; ?>


            <?php if($role['level']==3): //District administrator ?>
                <td>State Access to My District's School EOPs</td>
                <td>
                    <span id="state_access_icon" class="<?php echo (($districtWideStateAccess=='write' || $districtWideStateAccess=='read')? 'approved_button':'revoked_button'); ?>"></span>
                    <span id="access-label"><?php echo (($districtWideStateAccess=='write' || $districtWideStateAccess=='read')? 'Enabled':'Disabled'); ?></span>
                </td>
                <td>
                    <div id="" class="approval-holder">
                        <?php if($districtWideStateAccess == 'write' || $districtWideStateAccess == 'read'): ?>
                            <button value="" class="btn-revoke"><em class="leftImage revoke"></em>Disable</button>
                            <script>
                                $(document).ready(function(){
                                    $(".status").html('enabled');
                                });
                            </script>
                        <?php endif; ?>
                        <?php if($districtWideStateAccess == 'deny'): ?>
                         <button value="" class="btn-approve"><em class="leftImage approve"></em>Enable</button>
                            <script>
                                $(document).ready(function(){
                                    $(".status").html('disabled');
                                });
                            </script>
                        <?php endif; ?>

                    </div>
                </td>
            <?php endif; ?>


            <?php if($role['level']==4): //School administrator ?>
                <td>State Access to My School EOP</td>
                <td>
                    <span id="state_access_icon" class="<?php echo (($schoolWideStateAccess=='write' || $schoolWideStateAccess=='read')? 'approved_button':'revoked_button'); ?>"></span>
                    <span id="access-label"><?php echo (($schoolWideStateAccess=='write' || $schoolWideStateAccess=='read')? 'Enabled':'Disabled'); ?></span>
                </td>
                <td>
                    <div id="" class="approval-holder">
                        <?php if($schoolWideStateAccess == 'write' || $schoolWideStateAccess == 'read'): ?>
                            <button value="" class="btn-revoke"><em class="leftImage revoke"></em>Disable</button>
                            <script>
                                $(document).ready(function(){
                                    $(".status").html('disabled');
                                });
                            </script>
                        <?php endif; ?>
                        <?php if($schoolWideStateAccess == 'deny'): ?>
                         <button value="" class="btn-approve"><em class="leftImage approve"></em>Enable</button>
                            <script>
                                $(document).ready(function(){
                                    $(".status").html('disabled');
                                });
                            </script>
                        <?php endif; ?>

                    </div>
                </td>
            <?php endif; ?>

        </tr>
    </table>
</div>

<?php if($role['level']==4): //School administrator ?>
<div style="margin:20px auto; width:500px; font-weight: bold; font-size:12px;">
    <p><em>State Administrator access to your school EOP is currently <span class="status"></span>.</em></p>
</div>
<?php endif; ?>

<?php if($role['level']==3): //District administrator ?>
    <div style="margin:20px auto; width:500px; font-weight: bold; font-size:12px;">
        <p><em>State Administrator access to school EOPs in your district is currently <span class="status"></span>.</em></p>
    </div>
<?php endif; ?>

<?php if($role['level']==2): //State Admins ?>
    <div style="margin:20px auto; width:500px; font-weight: bold; font-size:12px;">
        <p><em>State Administrator access to school EOPs in your state is currently <span class="status"></span>.</em></p>
    </div>
<?php endif; ?>

<?php if($role['level']==1): //State Admins ?>
    <div style="margin:20px auto; width:500px; font-weight: bold; font-size:12px;">
        <p><em>State Administrator access to your school EOPs is currently <span class="status"></span>.</em></p>
    </div>
<?php endif; ?>






<script language="JavaScript" type="text/javascript">
    

    $(document).ready(function(){

        $(document).on("click", '.btn-approve', function(event){
            var form_data = {
                ajax                    : '1'
            };
            $.ajax({
                <?php if($role['level']==3): //District administrator ?>
                    url: "<?php echo base_url('access/grant_districtwide_access'); ?>",
                <?php elseif($role['level']==4): //School Administrator ?>
                    url: "<?php echo base_url('access/grant_schoolwide_access'); ?>",
                <?php else: // State Administrator and other roles with access to this screen ?>
                    url: "<?php echo base_url('access/grant_statewide_access'); ?>",
                <?php endif; ?>
                
                type: 'POST',
                data: form_data,
                success: function(response) {
                    if(response == 1){
                       $('#access-label').html('Enabled');
                       $('#state_access_icon').removeClass('revoked_button');
                       $('#state_access_icon').addClass('approved_button');
                        var btnString = "<button value='' class='btn-revoke'><em class='leftImage revoke'></em>Disable</button>";
                        $('.approval-holder').html(btnString);
                        $('.status').html('enabled');
                        $("#errorDiv").html("" +
                            "<div class='notify notify-green'>" +
                            "<span class='symbol icon-tick'></span>&nbsp;&nbsp;" +
                            <?php if($role['level']<=3): //District administrator ?>
                                "State Administrator access to school EOPs enabled successfully!" +
                                <?php else: ?>
                                "State Administrator access to school EOP enabled successfully!" +
                            <?php endif; ?>
                            "</div>"
                        );
                    }
                    else{
                        alert('Operation failed, Please refresh page and try again!')
                    }
                }
            });

            $('#update-district-dialog').dialog("close");
            return false;
        });

        $(document).on("click", '.btn-revoke', function(event){
            var form_data = {
                ajax                    : '1'
            };
            $.ajax({
                <?php if($role['level']==3): //District administrator ?>
                   url: "<?php echo base_url('access/revoke_districtwide_access'); ?>",
                <?php elseif($role['level']==4): //School Administrator ?>
                    url: "<?php echo base_url('access/revoke_schoolwide_access'); ?>",
                <?php else: // State Administrator and other roles with access to this screen ?>
                    url: "<?php echo base_url('access/revoke_statewide_access'); ?>",
                <?php endif; ?>
                
                type: 'POST',
                data: form_data,
                success: function(response) {
                    if(response == 1){
                        $('#access-label').html('Disabled');
                        $('#state_access_icon').removeClass('approved_button');
                        $('#state_access_icon').addClass('revoked_button');
                        var btnString = "<button value='' class='btn-approve'><em class='leftImage approve'></em>Enable</button>";
                        $('.approval-holder').html(btnString);
                        $('.status').html('disabled');
                        $("#errorDiv").html("" +
                                            "<div class='notify notify-green'>" +
                                            "<span class='symbol icon-tick'></span>&nbsp;&nbsp;"+
                                            <?php if($role['level']<=3): //District administrator ?>
                                                "State Administrator access to school EOPs disabled successfully!" +
                                                <?php else: ?>
                                                "State Administrator access to school EOP disabled successfully!" +
                                            <?php endif; ?>
                                            "</div>"
                        );
                    }
                    else{
                        alert('Operation failed, Please refresh page and try again!')
                    }
                }
            });

            $('#update-district-dialog').dialog("close");
            return false;
        });




    });
</script>