<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: godfreymajwega
 * Date: 1/31/17
 * Time: 12:32 PM
 */

if((null != $this->session->flashdata('success'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-green">
            <span class="symbol icon-tick"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('success'));?>
        </div>
    </div>

<?php endif; ?>

<?php
if((null != $this->session->flashdata('error'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-red">
            <span class="symbol icon-error"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('error'));?>
        </div>
    </div>

<?php endif; ?>





<div id="progress_dialog" title="Database Update Progress">
    <p style="margin-top:20px;" id="actionLabel"> Action</p>
    <div style="border:1px solid #ccc; width:80%; height:20px; overflow:auto; background:#eee; display: block; margin: 10px auto;">
        <div id="overallprogressor" style="background:#07c; width:0%; height:100%; text-align: center; color:#eee;"></div>
    </div>
</div>


<div id="topcontain">
    <div id="titlearea">
        <h1 id="currentPageTag">Please wait while the system updates your database for EOP ASSIST <?php echo(VERSION); ?></h1>
        <h1>Please wait while the system updates your database for EOP ASSIST <?php echo(VERSION); ?></h1>
        <h3></h3>
    </div>
</div>

<div class="col-half left" style="text-align:center; margin-top:15%;">

        <h1 style="color:red">Incompatible EOP ASSIST Database version detected!</h1>

</div>


<script type="text/javascript">

    var documentWidth = $(document).width();
    var dialogWith = (0.5 * documentWidth);
    var leftPos = (documentWidth-dialogWith)/2;
    var total = 0;
    var url = "<?php echo(base_url('update/run'));?>";



    function updateProgress(){
        if(total <=100){
            $("#overallprogressor").html(total+ '%');
            $("#overallprogressor").width(total+'%');
            total++;

        }

    }

    $(window).resize(function() {
        $("#progress_dialog").dialog("option", "position", {my: "center", at: "center", of: window});
        $("#progress_dialog").dialog("option", "width", (0.5 * $(document).width()));
    });

    $(document).ready(function(){

        //Prompt the user to select a school from the list

        var progressDialog = $("#progress_dialog").dialog({
            autoOpen: true,
            modal: true,
            width: dialogWith,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });


       try{

           var moreCalls = true;
           var countCalls = 1;

           if (window.XMLHttpRequest) {
               // code for IE7+, Firefox, Chrome, Opera, Safari
               var xmlhttp = new XMLHttpRequest();
           } else {
               // code for IE6, IE5
               var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
           }

           xmlhttp.previous_text = '';
           xmlhttp.onerror = function() { log_message("[XHR] Fatal Error."); };

           xmlhttp.onreadystatechange = function() {
               try
               {
                   if(xmlhttp.readyState < 4){
                       log_message("Loading...");
                    }

                   if (xmlhttp.readyState ==3)
                   {
                       
                       new_response = xmlhttp.responseText.substring(xmlhttp.previous_text.length);
                       var result = JSON.parse( new_response );
                       log_message(result.message);
                       moreCalls = result.more;

                       //update the progressbar
                       $("#overallprogressor").html(result.progress+ '%');
                       $("#overallprogressor").width(result.progress+'%');

                   }

                   if(xmlhttp.readyState ==4){
                       if(moreCalls){
                           countCalls++;
                           xmlhttp.open("POST", url+"/"+countCalls, true);
                           xmlhttp.send();
                       }else{

                           xmlhttp.abort();
                           alert("Congratulations! Database has been updated successfully.");
                           $("#progressDialog").dialog('close');
                           window.location.href="<?php echo(base_url('login/signout')); ?>";
                       }

                   }
               }
               catch (e)
               {
                   log_message("<b>[XHR] Exception: " + e + "</b>");
               }
           };

           xmlhttp.open("POST", url+"/"+countCalls, true);
           xmlhttp.send();


       }catch(e){
           log_message("[XHR] Exception: "+ e);
       }


    });

    function log_message(message)
    {
       $("#actionLabel").html( message );
    }

</script>
