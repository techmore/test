<style>
    .content p{
        margin: 1em;
        width:95%;
        font-size: 12px;
        color: #444444;
    }
</style>
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
if((null != $this->session->flashdata('error'))):
    ?>
    <div id="errorDiv">
        <div class="notify notify-red">
            <span class="symbol icon-error"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('error'));?>
        </div>
    </div>

<?php endif; ?>

<div class=" boxed-group" style="text-align:center; margin-top:20px;">
    <div id="results-dialog" title="Migration Progress indicator!">
        <p>Overall Progress</p>

        <div style="border:1px solid #ccc; width:80%; height:20px; overflow:auto; background:#eee; display: block; margin: 10px auto;">
            <div id="overallprogressor" style="background:#07c; width:0%; height:100%;"></div>
        </div>

        <p>Progress</p>

        <div style="border:1px solid #ccc; width:80%; height:20px; overflow:auto; background:#eee; display: block; margin: 10px auto;">
            <div id="progressor" style="background:#07c; width:0%; height:100%;"></div>
        </div>

        <div style="display:block;border:1px solid #000; padding:10px; width:80%; height:auto; overflow:auto; background:#eee; margin: 10px auto;" id="divProgress"></div>
    </div>

    <h3 id="pane-title">EOP ASSIST 1.0 Database Information</h3>
    <div class="boxed-group-inner clearfix" style="padding: 10px;">

        <div class="left" style="width:35%; text-align: left;">


            <p>EOP ASSIST uses a database system that allows large amounts of data to be stored and retrieved in a fast and efficient manner.
            </p>

            <p>EOP ASSIST's database structure has been changed in order to provide new useful features that were not part of the previous version. This migration module will automatically migrate your data from the old database system into a new database system that is usable by EOP ASSIST 2.0. it only requires that your old database be available.<br><br>Please check your database details and enter them here.
            </p>
        </div>
        <div class="right" style="width:60%; text-align: left;">

            <?php  echo form_open('migrate/run', array('class'=>'database_form', 'id'=>'database_form'));  ?>
            <input type="hidden" name="form_name" value="database_form">
            <p>
                <span class="required">*</span>
                <label for="district_name_update">Database Type</label>
                <br>
                <?php
                $inputAttributes = array(
                    'name'      =>  'database_type',
                    'id'        =>  'database_type',
                    'required'  =>  'required',
                    'minlength'  =>  '3',
                    'size'      =>   '65%',
                    'value'     =>   'MySQL',
                    'disabled' =>   'disabled'
                );
                echo form_input($inputAttributes)

                ?>
            </p>

            <p>
                <span class="required">*</span>
                <label for="screen_name_update">Database Host</label>
                <br />
                <?php
                $inputAttributes = array(
                    'name'      =>  'database_host',
                    'id'        =>  'database_host',
                    'value'     =>  'localhost',
                    'required'  =>  'required',
                    'minlength'  =>  '3',
                    'size'      =>   '65%'
                );
                echo form_input($inputAttributes);
                ?>
            </p>
            <p>
                <span class="required">*</span>
                <label for="screen_name_update">Database Name</label>
                <br />
                <?php
                $inputAttributes = array(
                    'name'      =>  'database_name',
                    'id'        =>  'database_name',
                    'required'  =>  'required',
                    'value'     =>  '',
                    'minlength'  =>  '3',
                    'size'      =>   '65%'
                );
                echo form_input($inputAttributes);
                ?>
            </p>

            <p>
                <span class="required">*</span>
                <label for="screen_name_update">Database Username</label>
                <br />
                <?php
                $inputAttributes = array(
                    'name'      =>  'database_user_name',
                    'id'        =>  'database_user_name',
                    'required'  =>  'required',
                    'value'     =>  '',
                    'minlength'  =>  '3',
                    'size'      =>   '65%'
                );
                echo form_input($inputAttributes);
                ?>
            </p>

            <p>
                <span class="required">*</span>
                <label for="screen_name_update">Database Password</label>
                <br />
                <?php
                $inputAttributes = array(
                    'name'      =>  'database_password',
                    'id'        =>  'database_password',
                    'required'  =>  'required',
                    'value'     =>  '',
                    'minlength'  =>  '3',
                    'size'      =>   '65%'
                );
                echo form_password($inputAttributes);
                ?>
            </p>
            <p>
                <?php
                $attributes = array(
                    'name'  =>  'btnsave',
                    'value' =>  'Migrate',
                    'id'    =>  'btnsave',
                    'style' =>  ''
                );
                ?>
                <?php echo form_submit($attributes); ?>

                <?php
                $attributes = array(
                    'name'  =>  'btnreset',
                    'value' =>  'Reset',
                    'id'    =>  'btnreset',
                    'style' =>  ''
                );
                ?>
                <?php echo form_reset($attributes); ?>
            </p>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script language="JavaScript" type="text/javascript">

    $(document).ready(function(){


        $("#database_form").validate({
            submitHandler:AJAXPost
        });

        var wWidth = $(window).width();
        var dWidth = wWidth * 0.8; //this will make the dialog 80% of the window size

        var wHeight = $(window).height();
        var dHeight = wHeight * 0.6; //this will make the dialog 80% of the window size

        $("#results-dialog").dialog({
            resizable:      false,
            minHeight:      300,
            minWidth:       500,
            width:          dWidth,
            height:         dHeight,
            modal:          true,
            autoOpen:       false,
            close: function( event, ui ) {
                $("#divProgress").html("");
            },
            show:           {
                effect:     'scale',
                duration: 300
            }
        });

    });

    function AJAXPost() {

        if(confirm('Warning! This operation cannot be undone, and please don\'t close the dialog window before the migration completes. Click OK to continue ?')){
            $("#results-dialog").dialog('open');

            var elem   = document.getElementById("database_form").elements;
            var url    = document.getElementById("database_form").action;
            var params = "";
            var value;

            for (var i = 0; i < elem.length; i++) {
                if (elem[i].tagName == "SELECT") {
                    value = elem[i].options[elem[i].selectedIndex].value;
                } else {
                    value = elem[i].value;
                }
                params += elem[i].name + "=" + encodeURIComponent(value) + "&";
            }

            try {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    var xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.previous_text = '';
                xmlhttp.onerror = function() { log_message("[XHR] Fatal Error."); };

                xmlhttp.onreadystatechange = function()
                {
                    try
                    {
                        /*if(xmlhttp.readyState < 4){
                         document.getElementById('divProgress').innerHTML="Loading<br>";
                         }*/
                        if (xmlhttp.readyState > 2)
                        {
                            var new_response = xmlhttp.responseText.substring(xmlhttp.previous_text.length);
                            var result = JSON.parse( new_response );
                            log_message(result.message);

                            //update the progressbar
                            document.getElementById('progressor').style.width = result.progress + "%";
                            document.getElementById('overallprogressor').style.width = result.overall_progress + "%";
                            if(result.overall_progress >=100){

                                alert("Congratulations! Data migration process completed successfully");
                                $("#results-dialog").dialog('close');
                                window.location.href="<?php echo(base_url('home')); ?>";

                            }
                            xmlhttp.previous_text = xmlhttp.responseText;
                        }
                    }
                    catch (e)
                    {
                        //log_message("<b>[XHR] Exception: " + e + "</b>");
                    }


                };

                xmlhttp.open("POST", url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.setRequestHeader("Content-length", params.length);
                xmlhttp.setRequestHeader("Connection", "close");
                xmlhttp.send(params);

            }
            catch (e)
            {
                log_message("<b>[XHR] Exception: " + e + "</b>");
            }
        }

    }



    function doClear()
    {
        document.getElementById("divProgress").innerHTML = "";
    }

    function log_message(message)
    {
        document.getElementById("divProgress").innerHTML += message + '<br />';
    }

</script>


