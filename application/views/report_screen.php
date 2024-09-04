<?php
//print_r($page_vars['schools_with_data']);
$schoolsData = (count($page_vars['schools_with_data'])>0)? $page_vars['schools_with_data']: array();
$role_level = $this->session->userdata['role']['level'];
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">EOPs</a></li>
        <li><a href="#tabs-2">Attachments</a></li>
        <li><a href="#tabs-3">Trainings</a></li>
        <li><a href="#tabs-4">Exercises</a></li>
    </ul>

    <div id="tabs-1" aria-label="EOPs">
        <?php include("content/dashboard/eops.php"); ?>
    </div>

    <div id="tabs-2" aria-label="Attachments">
        <?php include("content/dashboard/attachments.php"); ?>
    </div>

    <div id="tabs-3" aria-label="Trainings">
        <?php include("content/dashboard/trainings.php"); ?>
    </div>

    <div id="tabs-4" aria-label="Exercises">
        <?php include("content/dashboard/exercises.php"); ?>
    </div>
</div>


<style>
    .boxed-group{
        margin:0px;
    }
    .boxed-group h3{
        border-radius:5px;
    }
    #filesTable_wrapper{
        margin: 10px;
    }

    ul.ui-widget-header{
        background: #eee;
        border: none;
    }
    #tabs .ui-state-active a:link,#tabs .ui-state-active a:visited {
        /*color:#85962A;*/
        color: #000000;
    }
#tabs ul li.ui-state-focus{ border:none;}
#tabs .ui-state-focus a:link, #tabs .ui-state-focus a:visited{ border:none;}
</style>

<script language="javascript">
    $(document).ready(function(){

        $( "#tabs" ).tabs();
        $( ".dateInput" ).datepicker();

        loadTrainings();
        loadExercises();

        $(document).on('submit', 'form.searchForm', function(e){

            //alert(JSON.stringify($(this).serialize()));
            //alert($(this).attr('name'));
            var form_name = $(this).attr('name');
            var url = (form_name=='trainingSearch') ? '<?php echo(base_url('report/search/trainings')); ?>' : '<?php echo(base_url('report/search/exercises')); ?>';
            var container = (form_name=='trainingSearch') ? $('#training_search_results_container') : $('#exercise_search_results_container');

            $.ajax({
                url: url,
                data: $(this).serialize(),
                type:'POST',
                success:function(response){

                    container.html(response);

                },
                error:function(error){
                    //alert(error);
                }
            });

            e.preventDefault();
            return false;

        });

        $(document).on('click', 'a.export_btn', function(e){

            var url = $(this).attr('href');
            var form = $(this).closest('form');
            var old_url = form.attr('action');

            form.attr('action', url);
            form.attr('class', 'exportForm');

            form.submit();

            form.attr('action', old_url);
            form.attr('class', 'searchForm');

            e.preventDefault();
            return false;
        });

        $(document).on('reset', 'form.searchForm', function(e){
            $('.selectDistrictRow').hide();
            $('.selectSchoolRow').hide();
            $('.filter_by_school').val('');
            $('.filter_by_district').val('');
        });

        $('#filesTable').DataTable({
            paging: true,
            searching: true,
            pageLength: 50,
            columnDefs:[
                {orderable: false, targets:[4]}
            ]
        });

        $("#arrow_nav").hide();

        <?php if($this->session->userdata['role']['role_id']< STATE_ADMIN_LEVEL): ?>
            $('#myEOPReportTbl').DataTable({
                "order" : [[0, "desc"]],
                "bFilter": false, // For the search text box
                "bInfo": true, // For the "Showing 1 to 10 of x entries" text at the bottom
                "columnDefs": [
                    {"orderable": false, "targets": [3,4] }
                ],
                "pageLength": 25
            });


        <?php else: ?>
            <?php if($this->session->userdata['role']['role_id']<= DISTRICT_ADMIN_LEVEL): ?>
                $('#myEOPReportTbl').DataTable({
                    "paging": true,
                    "order" : [[0, "desc"]],
                    "bFilter": false, // For the search text box
                    "bInfo": true, // For the "Showing 1 to 10 of x entries" text at the bottom
                    "columnDefs": [
                        {"orderable": false, "targets": [2,3] }
                    ],
                    "pageLength": 25
                });

                <?php if($this->session->userdata['role']['role_id']== DISTRICT_ADMIN_LEVEL): ?>
                    var form_data = {
                        ajax:           '1',
                        user_id:    '<?php echo($this->session->userdata['user_id']); ?>'
                    };


                    $.ajax({
                        url: "<?php echo base_url('school/get_schools_in_my_district'); ?>",
                        type: 'POST',
                        data: form_data,
                        success: function (response) {
                            var schools = JSON.parse(response);
                            var schoolElement = $(".filter_by_school");
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
                <?php endif; ?>

                <?php if($this->session->userdata['role']['role_id']== STATE_ADMIN_LEVEL): ?>
                    var form_data = {
                        ajax:           '1'
                    };


                    $.ajax({
                        url: "<?php echo base_url('school/get_schools'); ?>",
                        type: 'POST',
                        data: form_data,
                        success: function (response) {
                            var schools = JSON.parse(response);
                            var schoolElement = $(".filter_by_school");
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
                <?php endif; ?>

                    $.ajax({
                        url: "<?php echo base_url('district/get_districts'); ?>",
                        type: 'POST',
                        data: {ajax: '1'},
                        success: function (response) {
                            var districts = JSON.parse(response);
                            var districtElement = $(".filter_by_district");
                            districtElement.empty(); // remove the old options

                            districtElement.append($("<option></option>")
                                .attr("value", "")
                                .text("--Select--"));

                            $.each(districts, function (key, value) {
                                districtElement.append($("<option></option>")
                                    .attr("value", value.id)
                                    .text(value.name));
                            });
                        }
                    });

                    // Change School list according to district selected
                    $(document).on('change','.filter_by_host', function(){

                        //alert(this.value);
                        if(this.value=='district' || this.value=='district-provided'){
                            $('.selectDistrictRow').show();
                            $('.selectSchoolRow').hide();
                            $('.filter_by_school').val('');
                        }else if(this.value=='school' || this.value=='school-provided'){
                            $('.selectSchoolRow').show();
                            $('.selectDistrictRow').hide();
                            $('.filter_by_district').val('');
                        }else{
                            $('.selectDistrictRow').hide();
                            $('.selectSchoolRow').hide();
                            $('.filter_by_school').val('');
                            $('.filter_by_district').val('');
                        }

                    });

                    $(document).on('change','.filter_by_district', function(){
                        //alert(this.value);
                        if(this.value!=''){
                            $('.selectSchoolRow').show();
                            var district_id = this.value;
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
                                 var schoolElement = $(".filter_by_school");
                                 schoolElement.empty(); // remove the old options
                                 schoolElement.append($("<option></option>").attr("value", "").text("--Select--"));
                                 $.each(schools, function (key, value) {
                                     schoolElement.append($("<option></option>").attr("value", value.id).text(value.name));
                                 });
                             }
                            });
                        }else{
                            $('.selectSchoolRow').hide();
                            $('.filter_by_school').val('');
                        }

                    });


            <?php else: ?>
            $('#myEOPReportTbl').DataTable({
                "order" : [[0, "desc"]],
                "bFilter": false, // For the search text box
                "bInfo": true, // For the "Showing 1 to 10 of x entries" text at the bottom
                "columnDefs": [
                    {"orderable": false, "targets": [2] }
                ],
                "pageLength": 25
            });
            <?php endif; ?>
        <?php endif; ?>

    });

    function loadExercises(){

        var formData = {
            ajax    :   '1'
        };

        $.ajax({
            url: '<?php echo(base_url('report/search/exercises/all')); ?>',
            data: formData,
            type:'POST',
            success:function(response){

                $('#exercise_search_results_container').html(response);

            },
            error:function(error){
                //alert(error);
            }
        });
    }

    function loadTrainings(){

        var formData = {
            ajax    :   '1'
        };

        $.ajax({
            url: '<?php echo(base_url('report/search/trainings/all')); ?>',
            data: formData,
            type:'POST',
            success:function(response){

                $('#training_search_results_container').html(response);

            },
            error:function(error){
                //alert(error);
            }
        });
    }
</script>

<style>

    .selectSchoolRow{
        display: none;
    }

    .selectDistrictRow{
        display: none;
    }
    /*------------------------
Team List Result
------------------------*/
    #subDetailDiv table.teamresult tr td {
        padding: 8px;
    }

    table.teamresult{
        width: 100%;
        border-collapse: collapse;
        border: none;
    }


    table.teamresult th, table.teamresult td { /*--border for all cell sides --*/
        border: 1px solid #ffffff;
        vertical-align: text-top;
        padding: 8px;
    }

    table.teamresult th {
        height: 35px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background-color: #0172B8;
        color: #FFF;
        text-align: center;
        vertical-align: middle;
    }

    table.teamresult tr.even {
        background-color: #eee;
    }

    table.teamresult tr:nth-child(odd) {
        background: #D9EAF4;
    }

    table.teamresult td a,
    table.teamresult td a:visited{
        color:blue !important;
    }
</style>