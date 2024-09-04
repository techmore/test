<?php
/**
 *  Administrator Contact Management View
 *
 *
 *
 * Added to EOP Assist 5.0
 * 2019 © United States Department of Education
 */
?>

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
?>

<div>

    <p> The Program Administrator is responsible for resetting passwords for all users who access this installed version of EOP ASSIST and his/her contact information below will appear on the Login page. This person should have management capabilities and be a representative of the agency that has installed the software application. This person can, but does not have to, be different than the Super Administrator.</p>

</div>

<div >
    <?php
    include("forms/administrator.php");
    ?>
</div>

<script language="JavaScript">
    $(document).ready(function(){


        $("#updateAdministratorForm").validate({
            
        });


    });
</script>