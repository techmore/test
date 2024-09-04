<?php
/**
 *  State Access Management View
 *
 * This is the main district management view for managing and registering users, schools and districts.
 *
 * Added to EOP Assist 4.0
 * 2016 © United States Department of Education
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

    <p>In order to protect the security of school EOPs, users are automatically logged out. The duration of time that
        all users’ sessions remains idle or inactive before being automatically logged out may be adjusted by the
        Super Administrator only. Please note that security standards recommend setting 60 minutes as the maximum amount
        of time to elapse before timing out.</p>

    <p>Length of time in minutes:  <strong>[ <?php echo ($currentTimeout<=0) ? 'Never': $currentTimeout; ?> ]</strong> <a href="<?php echo base_url(); ?>timeout/edit" id="updateTimeoutLink"><input value="Edit" style="border: 1px solid #ddd;" type="button"></a></p>


</div>

<div id="update-timeout-dialog" title="Adjust Session Time-Out Duration">
    <?php
    include("forms/update_timeout.php");
    ?>
</div>

<script language="JavaScript">
    $(document).ready(function(){
        $("#update-timeout-dialog").dialog({
            resizable:      false,
            minHeight:      200,
            minWidth:       500,
            modal:          true,
            autoOpen:       false,
            buttons: {
                "Save": function(){

                    $("#updateTimeoutForm").submit();

                    $(this).dialog('close');
                },
                Cancel: function() {
                    $('#updatetxttime').val( <?php echo ($currentTimeout<=0) ? 'Never': $currentTimeout; ?> );
                    $( this ).dialog( "close" );
                }
            },
            show: {
                effect:     'scale',
                duration: 300
            },
            close: function(){
                $('#updatetxttime').val( <?php echo ($currentTimeout<=0) ? 'Never': $currentTimeout; ?> );
            }

        });

        $("#updateTimeoutForm").validate({
            rules: {
                updatetxttime: {
                    required: true,
                    number: true,
                    greaterThan: 5,
                    lessThan: 1440
                }
            }

        });

        $(document).on('click', '#updateTimeoutLink', function(e){
            e.preventDefault();
            $("#update-timeout-dialog").dialog('open');

            return false;
        });

        $.validator.addMethod("greaterThan", function(value, element, param) {
                    var i = parseFloat(value);
                    var j = parseFloat(param);
                    return (i >= j) ? true : false;
                },
                "The minimum amount of time allowed is 5 minutes. Please select a time duration greater or equal to 5 minutes."
            );

        $.validator.addMethod("lessThan", function(value, element, param){
                    var k = parseFloat(value);
                    var l = parseFloat(param);
                    return (k <= l) ? true : false;
                },
                "The maximum amount of time allowed is 1440 minutes. Please select a time duration less or equal to 1440 minutes.");
    });
</script>