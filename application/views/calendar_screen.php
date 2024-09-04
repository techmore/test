<?php
/**
 * Created by PhpStorm.
 * User: GMajwega
 * Date: 5/14/15
 * Time: 3:38 PM
 */
echo $this->session->flashdata('error');
$controlStatus="";
if($this->session->userdata['role']['read_only']=='y'){
    $controlStatus = "disabled";
}
if($this->session->userdata['role']['level']==3){
    if(isset($this->session->userdata['loaded_school']['id']) && !empty($this->session->userdata['loaded_school']['id'])){

    }else {
        ?>
        <div id="select_school_dialog" title="Select School">
            <p style="margin-top:20px;">

                <select id="sltschool_dialog" name="sltschool_dialog" required="required"></select>
            </p>
        </div>
    <?php
    }
}
?>


<div id='calendar'></div>

<div id="dialog-form" title="New Event">
    <!--  <p class="validateTips">All form fields are required.</p> -->
    <form id="new-calendar-event-form">
       <!-- <fieldset class="calendar-fieldset">-->
            <table>
                <?php if($this->session->userdata['role']['level'] !=2): ?>
                <tr>
                    <td class="txtb">School: </td>
                    <td><span><?php echo(isset($this->session->userdata['loaded_school']['id'])? $this->session->userdata['loaded_school']['name'] :""); ?></span></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="2"><label><span>Date: </span><span id="selectedDate"></span></label></td>
                </tr>


                <tr>
                    <td><label for="title">Name / Title</label></td>
                    <td>
                        <input type="text" name="title" id="title" value="" class="text ui-widget-content ui-corner-all">
                    </td>
                </tr>

                <tr>
                    <td colspan="2"> <div id="lists-container"></div></td>
                </tr>

                <tr>
                    <td><label for="location">Location:</label></td>
                    <td><textarea rows="3" cols="25" name="location" id="location" class="text ui-widget-content ui-corner-all"></textarea></td>
                </tr>

                <tr>
                    <td><label for="body">Body:</label></td>
                    <td> <textarea rows="3" cols="25" name="body" id="body" class="text ui-widget-content ui-corner-all"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <!-- Allow form submission with keyboard without duplicating the dialog button -->
                        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                    </td>
                </tr>


            </table>
        <!--</fieldset>-->
    </form>
</div>



<div id="dialog-edit-form" title="Edit Event">
    <!--  <p class="validateTips">All form fields are required.</p> -->
    <form id="edit-calendar-event-form">
        <!--<fieldset class="calendar-fieldset">-->

            <table>

                <tr>
                    <td class="txtb">School: </td>
                    <td><span id="school"></span></td>
                </tr>
                <tr>
                    <td class="txtb"> <label for="title">Name / Title</label></td>
                    <td><input type="text" <?php echo($controlStatus); ?> name="title" id="title-ed" value="" class="text ui-widget-content ui-corner-all"></td>
                </tr>
                <tr>

                    <td colspan="2"> <div id="edit-lists-container"></div></td>
                </tr>
                <tr>
                    <td><label for="location">Location:</label></td>
                    <td>
                        <textarea rows="3" cols="25" <?php echo($controlStatus); ?> name="location" id="location-ed" class="text ui-widget-content ui-corner-all"></textarea>
                    </td>
                </tr>

                <tr>
                    <td><label for="body">Body:</label></td>
                    <td>
                        <textarea rows="3" cols="25" <?php echo($controlStatus); ?> name="body" id="body-ed" class="text ui-widget-content ui-corner-all"></textarea>
                    </td>
                </tr>
                <tr>
                    <td><!-- Allow form submission with keyboard without duplicating the dialog button -->
                        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px"></td>
                    <td></td>
                </tr>
            </table>

        <!--</fieldset>-->
    </form>
</div>


<script>

    $(document).ready(function() {
        var global_defaultDate = '<?php echo currentDate('Y-m-d');?>';
        var global_start, global_end;
        var dialog, editDialog, form,

            emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
            title = $( "#title" );

        var selectedEventId,
            selectedEventTitle,
            selectedEventStart,
            selectedEventEnd,
            selectedEventLocation,
            selectedEventBody,
            selectedEventSchool;
        //tips = $( ".validateTips" );

        function checkLength( o, n, min, max ) {
            if ( o.val().length > max || o.val().length < min ) {
                o.addClass( "ui-state-error" );
                updateTips( "Length of " + n + " must be between " +
                min + " and " + max + "." );
                return false;
            } else {
                return true;
            }
        }
        function checkRegexp( o, regexp, n ) {
            if ( !( regexp.test( o.val() ) ) ) {
                o.addClass( "ui-state-error" );
                updateTips( n );
                return false;
            } else {
                return true;
            }
        }

        //Prompt the user to select a school from the list
        var blockUserDialog = $("#select_school_dialog").dialog({
            autoOpen: true,
            modal: true,
            buttons: {
                "OK": function(){

                    var selectElement = $("#sltschool_dialog");
                    if(selectElement.val()==''){
                        selectElement.addClass('error');
                        selectElement.focus();
                        return false;
                    }

                    var form_data = {
                        ajax:       '1',
                        school_id:    selectElement.val()
                    };
                    $.ajax({
                        url: "<?php echo base_url('school/attach_to_session'); ?>",
                        type: 'POST',
                        data: form_data,
                        success: function(response){
                            var ret = JSON.parse(response);
                            if(ret.loaded){
                                $("#slctsubdistrictselection").val(ret.school_id);
                                location.reload();
                            }
                            else{
                                alert ("Error Loading School! Try selecting from the menu drop down.");
                            }
                        }
                    });

                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        dialog = $( "#dialog-form" ).dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                "Save": addEvent,
                Cancel: function() {
                    $( this ).dialog( "close" );
                }

            },
            show: {
                //effect: "blind",
                //duration: 1000
            },
            hide: {
                //effect: "explode",
                //duration: 1000
            }
        });


        editDialog = $( "#dialog-edit-form" ).dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                "Save": editEvent,
                "Delete": deleteEvent,
                <?php endif; ?>
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        function deleteEvent(){

            if(confirm("Are you sure you want to delete this even permanently?")){

                var dataString = "action=delete&id=" + selectedEventId;

                $.ajax({
                    url: '<?php echo(base_url("calendar/delete")) ?>',
                    data: {
                        ajax:   1,
                        id:     selectedEventId
                    },
                    type:'POST',
                    async: false, // Prevents page from navigating to other page before ajax call completes
                    success:function(response){
                        selectedEventId = null;
                        selectedEventTitle = null;
                        selectedEventStart = null;
                        selectedEventEnd = null
                        selectedEventLocation = null;
                        selectedEventBody = null;

                        $("#title-ed").val("");
                        $("#start-ed").val("");
                        $("#end-ed").val("");
                        $("#location-ed").val("");
                        $("#body-ed").val("");

                        editDialog.dialog( "close" );
                    },
                    error:function(error){
                        alert(error);
                    }
                });

                $("#calendar").fullCalendar( 'refetchEvents' );
            }
        }
        function editEvent(){
            var valid=true;

            var editId = selectedEventId;
            var editTitle = $("#title-ed");
            var editStart = $("#start-ed");
            var editEnd = $("#end-ed");
            var editBody = $("#body-ed");
            var editLocation = $("#location-ed");


            valid = valid && checkLength( editTitle, "Event Title", 0, 255 );
            //valid = valid && checkRegexp( editTitle, /^[0-9a-z]([0-9a-z_\s])+$/i, "Title may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );

            if(valid){

                $.ajax({
                    url: '<?php echo(base_url("calendar/update")) ?>',
                    data: {
                        ajax:       1,
                        id:         editId,
                        start:      editStart.val(),
                        end:        editEnd.val(),
                        title:      editTitle.val(),
                        body:       editBody.val(),
                        location:   editLocation.val()

                    },
                    type:'POST',
                    async: false, // Prevents page from navigating to other page before ajax call completes
                    success:function(response){

                        selectedEventId = null;
                        selectedEventTitle = null;
                        selectedEventStart = null;
                        selectedEventEnd = null
                        selectedEventLocation = null;
                        selectedEventBody = null;

                        $("#title-ed").val("");
                        $("#start-ed").val("");
                        $("#end-ed").val("");
                        $("#location-ed").val("");
                        $("#body-ed").val("");

                        editDialog.dialog( "close" );
                    },
                    error:function(error){
                        alert(error);
                    }
                });

            }
            $("#title-ed").val("");
            $("#start-ed").val("");
            $("#end-ed").val("");
            $("#location-ed").val("");
            $("#body-ed").val("");
            editDialog.dialog("close");

            $("#calendar").fullCalendar( 'refetchEvents' );
        }

        function addEvent() {
            var valid = true;

            var titleVal = $("#title").val();
            var startTime = $( "#startTime" );
            var endTime = $( "#endTime" );
            var body = $("#body");
            var location = $("#location");

            valid = valid && checkLength( $("#title"), "Event Title", 0, 255 );

            //valid = valid && checkRegexp( $("#title"), /^[ _0-9a-z]([ 0-9a-z_\s])+$/i, "Title may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
            //valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
            //valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
            if ( valid ) {
                var eventData;

                $.ajax({
                    url: '<?php echo(base_url("calendar/add")) ?>',
                    data: {
                        ajax: 1,
                        start: startTime.val(),
                        end: endTime.val(),
                        title: titleVal,
                        body: body.val(),
                        location: location.val()
                    },
                    type:'POST',
                    async: false, // Prevents page from navigating to other page before ajax call completes
                    success:function(response){
                        //$calendar.weekCalendar("removeUnsavedEvents");
                        //$calendar.weekCalendar("updateEvent", calEvent);
                        //alert(response);
                        $("#title").val("");
                        startTime.val("");
                        endTime.val("");
                        location.val("");
                        body.val("");

                        dialog.dialog( "close" );
                    },
                    error:function(error){
                        alert(error);
                    }
                });


                $("#title").val("");
                startTime.val("");
                endTime.val("");
                location.val("");
                body.val("");
                dialog.dialog( "close" );

                $("#calendar").fullCalendar( 'refetchEvents' );

            }
            return valid;
        }

        function pad(num, size) {
            var s = num+"";
            while (s.length < size) s = "0" + s;
            return s;
        }

        function populateStartEndLists(selectedDate){

            //var dataString="action=make_time_lists&selectedDate="+ $('#selectedDate').html();
            //alert($('#selectedDate').html());
            $.ajax({
                url: '<?php echo(base_url("calendar/makeTime")) ?>',
                data: {
                    ajax: 1,
                    selectedDate: $('#selectedDate').html()
                },
                type:'POST',
                success:function(response){
                    //alert(response);
                    $("#lists-container").html(response);
                },
                error:function(error){
                    alert(error);
                }
            });

        }

        function populateEditStartEndLists(eventStart, id){


            $.ajax({
                url: '<?php echo(base_url("calendar/listTime")) ?>',
                data: {
                    ajax    : 1,
                    event_id: id
                },
                type:'POST',
                success:function(response){
                    //alert(response);
                    $("#edit-lists-container").html(response);
                },
                error:function(error){
                    alert(error);
                }
            });
        }

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: global_defaultDate,
            timezone: "America/New_York",
            timeFormat: "h(:mm)A",
            selectable: true,
            selectHelper: true,
            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                select: function(start, end) {
                    //var title = prompt('Event Title:');
                    global_start = start;
                    global_end = end;

                    $("#selectedDate").html(start.format("L"));


                    populateStartEndLists();
                    <?php if($this->session->userdata['role']['level']!=3): ?>
                        dialog.dialog( "open" );
                    <?php else: ?>
                        <?php if(isset($this->session->userdata['loaded_school']['id']) && !empty($this->session->userdata['loaded_school']['id'])): ?>
                            dialog.dialog( "open" );
                        <?php else: ?>
                            blockUserDialog.dialog("open");
                        <?php endif; ?>
                    <?php endif; ?>


                    $('#calendar').fullCalendar('unselect');
                },
                editable: true,
            <?php else: ?>
                editable: false,
            <?php endif; ?>

            eventLimit: true, // allow "more" link when too many events

            events: {
                url: '<?php echo(base_url("calendar/read")) ?>',
                type: 'POST',
                async: false, // Prevents page from navigating to other page before ajax call completes
                data: {
                    ajax : 1
                },
                error: function() {
                    $('#script-warning').show();
                }
            },
            loading: function(bool) {
                $('#loading').toggle(bool);
            },

            dayClick: function(date, jsEvent, view) {

                //$( "#dialog" ).dialog( "open" );

                //alert('Clicked on: ' + date.format());

                //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                //alert('Current view: ' + view.name);

                // change the day's background color just for fun
                // $(this).css('background-color', 'red');

            },

            eventMouseover: function(calEvent, jsEvent, view){

                var eventTitle = calEvent.official;
                var eventSchool = calEvent.school;
                var eventStarts = calEvent.start;
                var eventEnds = calEvent.end;
                var eventLocation = calEvent.location;
                var eventBody = calEvent.body;

                if(eventEnds == null || eventEnds === "undefined"){
                    eventEnds = eventStarts;
                }

                <?php if($this->session->userdata['role']['level']<=2): ?>
                    if(!eventSchool){
                        eventSchool = 'State ';
                    }
                <?php endif; ?>

                var finalString = "Event: " + eventTitle + "\n";
                finalString += "School: " + eventSchool + "\n";
                if(eventStarts && eventStarts !== null && eventStarts !== "undefined"){
                    finalString += "Starts: " + eventStarts.format("L LT") + " \n";
                }else{
                    finalString += "Starts: (not set) \n";
                }

                if(eventEnds && eventEnds !== null && eventEnds !== "undefined"){
                    finalString += "Ends: " + eventEnds.format("L LT") + "\n";
                }else {
                    finalString += "Ends: (not set) \n";
                }


                finalString += "Location: " + eventLocation + " \n\n";
                finalString += eventBody;

                $(this).find(".fc-title").attr("title", finalString);


            },
            eventMouseout: function (calEvent, jsEvent, view){

            },

            eventFocus: function(calEvent, jsEvent, view){


            },


            eventClick: function(calEvent, jsEvent, view) {
                selectedEventId = calEvent.id;
                selectedEventTitle = calEvent.official;
                selectedEventStart = calEvent.start;
                selectedEventEnd = calEvent.end;
                selectedEventLocation = calEvent.location;
                selectedEventBody = calEvent.body;
                selectedEventSchool = calEvent.school;

                var startDate  = new Date(selectedEventStart);
                var endDate = new Date(selectedEventEnd);

                <?php if($this->session->userdata['role']['level']<=2): ?>
                if(!selectedEventSchool){
                    selectedEventSchool = 'State ';
                }
                <?php endif; ?>

                $("#title-ed").val(selectedEventTitle);
                $("span#school").html(selectedEventSchool);
                populateEditStartEndLists(selectedEventStart, selectedEventId);

                $("#location-ed").val(selectedEventLocation);
                $("#body-ed").val(selectedEventBody);
                editDialog.dialog( "open" );
            },

            eventDrop: function(event, delta, revertFunc){
                //alert(event.title + " was dropped on " + event.id);

               /*
               if(!confirm("Are you sure about this change?")){
                    revertFunc();
                }
                */

                    if(event.end == null){
                        event.end = event.start;
                    }

                    $.ajax({
                        url: '<?php echo(base_url("calendar/updateEventDate")) ?>',
                        data: {
                            ajax:       1,
                            id:         event.id,
                            start:      event.start.format(),
                            end:        event.end.format()
                        },
                        type:'POST',
                        async: false, // Prevents page from navigating to other page before ajax call completes
                        success:function(response){
                            //Do nothing
                        },
                        error:function(error){
                            alert(error);
                        }
                    });
            },

            eventResize: function(event, delta, revertFunc){

                $.ajax({
                    url: '<?php echo(base_url("calendar/updateEventDate")) ?>',
                    data: {
                        ajax:       1,
                        id:         event.id,
                        start:      event.start.format(),
                        end:        event.end.format()
                    },
                    type:'POST',
                    async: false, // Prevents page from navigating to other page before ajax call completes
                    success:function(response){
                        //Do nothing
                    },
                    error:function(error){
                        alert(error);
                    }
                });
            }

        });


        /**
         * From Raymond Will
         *
         */

        /*$("tbody").eq(1).attr("class","mainBody");
        $("tbody").eq(1).before("<thead class='calHead'><tr class='fc-scrollgrid-section fc-scrollgrid-section-header'><th class='fc-day-sun'>Sun</th><th class='fc-day-mon'>Mon</th><th class='fc-day-tue'>Tues</th><th class='fc-day-wed'>Wed</th><th class='fc-day-thu'>Thurs</th><th class='fc-day-fri'>Fri</th><th class='fc-day-sat'>Sat</th></tr></thead>");

        $('th.fc-day-sun').attr({'id': 'Sunday','scope': 'col','role': 'columnheader'});
        $('th.fc-day-mon').attr({'id': 'Monday','scope': 'col','role': 'columnheader'});
        $('th.fc-day-tue').attr({'id': 'Tuesday','scope': 'col','role': 'columnheader'});
        $('th.fc-day-wed').attr({'id': 'Wednesday','scope': 'col','role': 'columnheader'});
        $('th.fc-day-thu').attr({'id': 'Thursday','scope': 'col','role': 'columnheader'});
        $('th.fc-day-fri').attr({'id': 'Friday','scope': 'col','role': 'columnheader'});
        $('th.fc-day-sat').attr({'id': 'Saturday','scope': 'col','role': 'columnheader'});



        //$("div.fc-view table thead td.fc-widget-header div.fc-row.fc-widget-header").hide();
        //End Raymond additions
        */

        /**
         * Added by Godfrey
         *
         */

        $('td.fc-day-number').keypress(function(event){

            if(event.which ==13){

                var start = moment($(this).attr('data-date'));

                global_start = start;

                $("#selectedDate").html(start.format("L"));


                populateStartEndLists();
                <?php if($this->session->userdata['role']['level']!=3): ?>
                dialog.dialog( "open" );
                <?php else: ?>
                <?php if(isset($this->session->userdata['loaded_school']['id']) && !empty($this->session->userdata['loaded_school']['id'])): ?>
                dialog.dialog( "open" );
                <?php else: ?>
                blockUserDialog.dialog("open");
                <?php endif; ?>
                <?php endif; ?>


                $('#calendar').fullCalendar('unselect');

            }
        });
        form = dialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            addEvent();
        });

        formS = editDialog.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            editEvent();
        });

            $(document).on('change', '#startTime', function(){
			//$('#startTime').change(function(){
				var d = new Date($(this).val());
				$('#endTime option').each(function(){
					var e = new Date($(this).val());
					if(d > e){ //disable options with value less than selected time
						$(this).attr('disabled', true);
						}
						else{
							$(this).attr('disabled', false);
						}
					});
				});

            $(document).on('change', '#start-ed', function(){
				//$('#start-ed').change(function(){
				var d = new Date($(this).val());
				$('#end-ed option').each(function(){
					var e = new Date($(this).val());
					if(d>e){ //disable options with value less less than selected time
						$(this).attr('disabled', true);
						}
						else{
							$(this).attr('disabled', false);
						}
					});
				});

    });


</script>
<?php
// Date Utilities
//----------------------------------------------------------------------------------------------


// Parses a string into a DateTime object, optionally forced into the given timezone.
function parseDateTime($string, $timezone=null) {
    $date = new DateTime(
        $string,
        $timezone ? $timezone : new DateTimeZone('UTC')
    // Used only when the string is ambiguous.
    // Ignored if string has a timezone offset in it.
    );
    if ($timezone) {
        // If our timezone was ignored above, force it.
        $date->setTimezone($timezone);
    }
    return $date;
}


// Takes the year/month/date values of the given DateTime and converts them to a new DateTime,
// but in UTC.
function stripTime($datetime) {
    return new DateTime($datetime->format('Y-m-d'));
}
/**
 * Returns current date in either ISO8601 or Y-m-d formats
 * Default is ISO8601
 * @param unknown $format
 * @return string
 */
function currentDate($format='c'){
    if($format!='c'){
        if($format != 'Y-m-d'){
            return date($format);
        }
        else{
            return date('Y-m-d');
        }
    }
    else{
        return date('c');
    }
}

?>