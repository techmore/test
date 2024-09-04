<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Calendar Helper functions
 *
 *
 */
if ( ! function_exists('list_time')) {
	function list_time($selected, $startDate = "", $endDate = "", $interval = 15) {

        $timestamp = strtotime ( $selected );

        $arr = array ();
        $t = array ();

        $arr [0] = date ( 'c', $timestamp );
        $t [0] = date ( 'h:i A', $timestamp );

        for($i = 1; $i < 96; $i ++) {
            $timestamp = strtotime ( '+'.$interval .' minutes', $timestamp );
            $arr [$i] = date ( 'c', $timestamp );
            $t [$i] = date ( 'h:i A', $timestamp );
        }

        $startListType = ($startDate != "") ? "start-ed" : "startTime";
        $endListType = ($endDate != "") ? "end-ed" : "endTime";
        $ctrl1 = make_list_box ( $arr, $t, $startDate, $startListType );
        $ctrl2 = make_list_box ( $arr, $t, $endDate, $endListType );

        return $ctrl1 ."".$ctrl2;
	}
}

if( ! function_exists('make_list_box')){
    function make_list_box($arr, $t, $selectedDate, $list_type){

        $html_str = "";
        $script = "";
        $label = "";



        if ($list_type == 'start-ed') {
            $dst = date('I', strtotime($selectedDate));

            if($dst ==1){
                date_default_timezone_set('America/Chicago');
            }
            else if($dst==0){
                date_default_timezone_set('America/New_York');
            }
            echo "<tr><td colspan='2'><label><span>Date: </span><span id='selectedDate-ed'>" . date ( 'm/d/Y', strtotime ( $selectedDate ) ) . "</span></label></td></tr>";
        }
        if ($list_type == 'start-ed' || $list_type == 'startTime') {
            $label = "Start Time";
        } else if ($list_type == 'end-ed' || $list_type == 'endTime') {
            $label = "End Time";
        }

        if ($list_type == "startTime" || $list_type == "start-ed") {
            $script .= <<<EOF
		<script>
			$('#startTime').change(function(){
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

				$('#start-ed').change(function(){
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
		</script>
EOF;
        }

        //$html_str .= $script;

        $html_str .= "<tr><td><label for='$list_type'>$label</label></td>";

        $html_str .= "<td><select id='$list_type' class='text ui-widget-content ui-corner-all' name='$list_type'>";
        foreach ( $arr as $key => $value ) {
            $item_selected = "";
            if ($value == $selectedDate) {
                $item_selected = "selected='selected'";
            }
            $html_str .= "<option $item_selected value='" . $value . "'>" . $t [$key] . "</option>";
        }
        $html_str .= "</select></td></tr>";

        return $html_str;

    }
}

if(!function_exists('convertToCalendarEvent')){
    function convertToCalendarEvent($time){

        $timestamp = strtotime($time);

        return date ( 'c', $timestamp );
    }
}
