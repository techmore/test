<?php

//If its district admin and there's a school loaded in session object
 if($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL && $this->session->userdata('loaded_school') && !empty($this->session->userdata['loaded_school']['id'])){
     ?>

     <script type="text/javascript">
         $(document).ready(function() {
             //Load list of eligible schools that fall under the user's district
             $.ajax({
                 url: "<?php echo base_url('school/get_schools_in_my_district'); ?>",
                 type: 'POST',
                 data: {ajax: '1', user_id:<?php echo ($this->session->userdata('user_id')); ?>},
                 success: function (response) {
                     var schools = JSON.parse(response);
                     var pageSchoolElement = $("#slctsubdistrictselection");
                     pageSchoolElement.empty();

                     pageSchoolElement.append($("<option></option>")
                         .attr("value", '')
                         .attr("selected", 'selected')
                         .text("--Select--"));

                     $.each(schools, function (key, value) {
                         pageSchoolElement.append($("<option></option>")
                             .attr("value", value.id)
                             .text(value.name));
                     });
                     pageSchoolElement.val(<?php echo($this->session->userdata['loaded_school']['id']); ?>);
                 }
             });
         });

         $(document).on('change','#slctsubdistrictselection', function(){

             if(this.value){

                 var form_data = {
                     ajax:       '1',
                     school_id:  this.value
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
             }else{

                 var form_data={ ajax:  '1'  };

                 $.ajax({
                     url: "<?php echo base_url('school/detach_from_session');?>",
                     type: 'POST',
                     data: form_data,
                     success: function(response){
                         var ret = JSON.parse(response);
                         if(ret.unloaded){
                             $("#slctsubdistrictselection").val('');
                             location.reload();
                         }else{
                             alert("Error Unloading School!");
                         }
                     }
                 });
             }

         });
     </script>
<?php
 }elseif($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL){
     ?>
     <script type="text/javascript">
         $(document).ready(function(){
             //Load list of eligible schools that fall under the user's district

             $.ajax({
                 url: "<?php echo base_url('school/get_schools_in_my_district'); ?>",
                 type: 'POST',
                 data: {ajax: '1', user_id:<?php echo ($this->session->userdata('user_id')); ?>},
                 success: function(response){
                     var schools = JSON.parse(response);
                     var dialogSchoolElement = $("#sltschool_dialog");
                     var pageSchoolElement = $("#slctsubdistrictselection");
                     dialogSchoolElement.empty(); // remove the old options
                     pageSchoolElement.empty();

                     pageSchoolElement.append($("<option></option>")
                         .attr("value", '')
                         .attr("selected", 'selected')
                         .text("--Select--"));

                     dialogSchoolElement.append($("<option></option>")
                         .attr("value", '')
                         .attr("selected", 'selected')
                         .text("--Select--"));

                     $.each(schools, function(key, value){
                         dialogSchoolElement.append($("<option></option>")
                             .attr("value", value.id)
                             .text(value.name));

                         pageSchoolElement.append($("<option></option>")
                             .attr("value", value.id)
                             .text(value.name));
                     });
                 }
             });


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


         });

         $(document).on('change','#slctsubdistrictselection', function(){

             var form_data = {
                 ajax:       '1',
                 school_id:  this.value
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
         });

     </script>
<?php
 } elseif($this->session->userdata['role']['level']< STATE_ADMIN_LEVEL && $this->session->userdata('loaded_school') && !empty($this->session->userdata['loaded_school']['id'])){
     ?>
     <script type="text/javascript">
         $(document).ready(function() {
             //Load list of eligible schools that fall under the user's district
             $.ajax({
                 url: "<?php echo base_url('school/get_schools'); ?>",
                 type: 'POST',
                 data: {ajax: '1', user_id:<?php echo ($this->session->userdata('user_id')); ?>},
                 success: function (response) {
                     var schools = JSON.parse(response);
                     var pageSchoolElement = $("#slctsubdistrictselection");
                     pageSchoolElement.empty();

                     pageSchoolElement.append($("<option></option>")
                         .attr("value", '')
                         .attr("selected", 'selected')
                         .text("--Select--"));

                     $.each(schools, function (key, value) {
                         pageSchoolElement.append($("<option></option>")
                             .attr("value", value.id)
                             .text(value.name));
                     });
                     pageSchoolElement.val(<?php echo($this->session->userdata['loaded_school']['id']); ?>);
                 }
             });
         });

         $(document).on('change','#slctsubdistrictselection', function(){

             var form_data = {
                 ajax:       '1',
                 school_id:  this.value
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
         });
     </script>
     <?php
 }elseif( $this->session->userdata['role']['level'] < STATE_ADMIN_LEVEL){
?>
     <script type="text/javascript">
         $(document).ready(function(){
             //Load list of all schools

             $.ajax({
                 url: "<?php echo base_url('school/get_schools'); ?>",
                 type: 'POST',
                 data: {ajax: '1', user_id:<?php echo ($this->session->userdata('user_id')); ?>},
                 success: function(response){
                     var schools = JSON.parse(response);
                     var dialogSchoolElement = $("#sltschool_dialog");
                     var pageSchoolElement = $("#slctsubdistrictselection");
                     dialogSchoolElement.empty(); // remove the old options
                     pageSchoolElement.empty();

                     pageSchoolElement.append($("<option></option>")
                         .attr("value", '')
                         .attr("selected", 'selected')
                         .text("--Select--"));

                     dialogSchoolElement.append($("<option></option>")
                         .attr("value", '')
                         .attr("selected", 'selected')
                         .text("--Select--"));

                     $.each(schools, function(key, value){
                         dialogSchoolElement.append($("<option></option>")
                             .attr("value", value.id)
                             .text(value.name));

                         pageSchoolElement.append($("<option></option>")
                             .attr("value", value.id)
                             .text(value.name));
                     });
                 }
             });


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
         });


         $(document).on('change','#slctsubdistrictselection', function(){

             var form_data = {
                 ajax:       '1',
                 school_id:  this.value
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
         });

     </script>
<?php
 }
?>