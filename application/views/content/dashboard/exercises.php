<?php
$loggedin_role = $this->session->userdata['role']['level'];
?>
<h1 style="margin:10px 0px">Exercises</h1>
<form name="exerciseSearch" class="searchForm" method="post" action="<?php echo(base_url('report/search/exercises#tabs-4'));?>">
    <input type="hidden" name="ajax" value="1" />
    <table  style="width:auto; margin: 10px;">
        <?php if($loggedin_role <= DISTRICT_ADMIN_LEVEL): ?>
            <tr>
                <td><label for="txtHost">Host:</label></td>
                <td>
                    <?php
                    if($loggedin_role == DISTRICT_ADMIN_LEVEL){
                        $options = array(
                            ''                      =>  '-- All --',
                            'district'              =>  'District',
                            'school'                =>  'School'
                        );
                    }elseif($loggedin_role <= STATE_ADMIN_LEVEL){
                        $options = array(
                            ''                      =>  '-- All --',
                            'state'                 =>  'State',
                            'district'              =>  'District',
                            'school'                =>  'School'
                        );
                    }

                    $inputAttributes = array(
                        'name'      =>  'txtHost',
                        'id'        =>  'txtHost',
                        'options'   =>  $options,
                        'selected'  =>  '',
                        'class'     =>  'filter_by_host'
                    );
                    echo form_dropdown($inputAttributes);
                    ?>
                </td>
            </tr>

            <?php if($loggedin_role <= STATE_ADMIN_LEVEL): ?>
                <tr class="selectDistrictRow">
                    <td>District:</td>
                    <td>
                        <select class="filter_by_district" id="exerciseSelectDistrict" name="filter_by_district"></select>
                    </td>
                </tr>
            <?php endif; ?>

            <tr class="selectSchoolRow">
                <td>School:</td>
                <td>
                    <select class="filter_by_school" id="exerciseSelectSchool" name="filter_by_school"></select>
                </td>
            </tr>

        <?php endif; ?>
        <tr>
            <td class="txtb"> <label for="txttype">Type:</label></td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txttype',
                    'id'        =>  'txttype',
                    'options'   =>  array(
                        ''                      => '-- All --',
                        'Drill'                 =>  'Drill',
                        'Tabletop Exercise'     => 'Tabletop Exercise',
                        'Functional Exercise'   =>  'Functional Exercise',
                        'Full-Scale Exercise'   =>  'Full-Scale Exercise',
                        'Other Exercise'        =>  'Other Exercise'
                    ),
                    'selected'  =>  ''
                );
                echo form_dropdown($inputAttributes);
                ?>
            </td>
        </tr>
        <tr>
            <td><label>Date Range:</label></td>
            <td>

                <label for="txtDateExerciseFrom"> From:</label>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txtDateExerciseFrom',
                    'id'        =>  'txtDateExerciseFrom',
                    'class'     =>  'dateInput'
                );
                echo form_input($inputAttributes);
                ?>
                &nbsp;  <label for="txtDateExerciseTo"> To:</label> &nbsp;

                <?php
                $inputAttributes = array(
                    'name'      =>  'txtDateExerciseTo',
                    'id'        =>  'txtDateExerciseTo',
                    'class'     =>  'dateInput'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>
    </table>
    <p>
        <input type="submit" value="Search" style="border: 1px solid #ddd;" />
        <input type="reset" value="Reset" style="border: 1px solid #ddd; margin: auto 10px;" />
        <a href="<?php echo(base_url('report/export/exercises/search'));?>" class="export_btn"><input type="button" value="Export List" style="border: 1px solid #ddd;" /></a>
    </p>
</form>

<div id="exercise_search_results_container" class="container"></div>