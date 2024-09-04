<?php
$loggedin_role = $this->session->userdata['role']['level'];
?>
<h1 style="margin:10px 0px">Trainings</h1>
<form name="trainingSearch" class="searchForm" method="post" action="<?php echo(base_url('report/search/trainings#tabs-3'));?>">
    <input type="hidden" name="ajax" value="1" />
    <table  style="width:auto; margin: 10px;">
        <?php if($loggedin_role <= DISTRICT_ADMIN_LEVEL): ?>
            <tr>
                <td><label for="txtProvider">Provider:</label></td>
                <td>
                    <?php
                    if($loggedin_role == DISTRICT_ADMIN_LEVEL){
                        $options = array(
                            ''                      =>  'Any',
                            'district-provided'              =>  'District',
                            'school-provided'                =>  'School'
                        );
                    }elseif($loggedin_role <= STATE_ADMIN_LEVEL){
                        $options = array(
                            ''                      =>  'Any',
                            'state-provided'                 =>  'State',
                            'district-provided'              =>  'District',
                            'school-provided'                =>  'School'
                        );
                    }

                    $inputAttributes = array(
                        'name'      =>  'txtProvider',
                        'id'        =>  'txtProvider',
                        'options'   =>  $options,
                        'selected'  =>  '',
                        'class'     =>  'filter_by_host',
                        'aria-label'=>'Provider'
                    );
                    echo form_dropdown($inputAttributes);
                    ?>
                </td>
            </tr>

            <?php if($loggedin_role <= STATE_ADMIN_LEVEL): ?>
                <tr class="selectDistrictRow">
                    <td><label for="trainingSelectDistrict"> District:</label></td>
                    <td>
                        <select class="filter_by_district" id="trainingSelectDistrict" name="filter_by_district"></select>
                    </td>
                </tr>
            <?php endif; ?>

            <tr class="selectSchoolRow">
                <td><label for="trainingSelectSchool"> School:</label></td>
                <td>
                    <select class="filter_by_school" id="trainingSelectSchool" name="filter_by_school"></select>
                </td>
            </tr>

        <?php endif; ?>
        <tr>
            <td class="txtb"><label for="txtTopic"> Topic:</label></td>
            <td>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txtTopic',
                    'id'        =>  'txtTopic',

                    'options'   =>  array(
                        ''                                              => '-- All --',
                        'Developing high-quality EOPs'                 =>  'Developing high-quality EOPs',
                        'Developing and enhancing memoranda of understanding with community partners'     => 'Developing and enhancing memoranda of understanding with community partners',
                        'Supporting the implementation of the National Incident Management System'   =>  'Supporting the implementation of the National Incident Management System',
                        'Access and functional needs'   =>  'Access and functional needs',
                        'Other related emergency management topic [ability to add custom information)'        =>  'Other related emergency management topic [ability to add custom information)'
                    ),
                    'selected'  =>  ''
                );
                echo form_dropdown($inputAttributes);
                ?>
            </td>
        </tr>
        <tr>
            <td><label> Date Range:</label></td>
            <td>
                <label for="txtDateTrainingFrom"> From:</label>
                <?php
                $inputAttributes = array(
                    'name'      =>  'txtDateTrainingFrom',
                    'id'        =>  'txtDateTrainingFrom',
                    'class'     =>  'dateInput'
                );
                echo form_input($inputAttributes);
                ?>
                &nbsp; <label for="txtDateTrainingTo"> To:</label> &nbsp;

                <?php
                $inputAttributes = array(
                    'name'      =>  'txtDateTrainingTo',
                    'id'        =>  'txtDateTrainingTo',
                    'class'     =>  'dateInput'
                );
                echo form_input($inputAttributes);
                ?>
            </td>
        </tr>
    </table>
    <p>
        <input type="submit" value="Search" style="border: 1px solid #ddd; margin: auto 10px;" />
        <input type="reset" value="Reset" style="border: 1px solid #ddd; margin: auto 10px;" />
        <a href="<?php echo(base_url('report/export/trainings/search'));?>" class="export_btn"><input type="button" value="Export List" style="border: 1px solid #ddd; margin: auto 10px;" /></a>
    </p>
</form>

<div id="training_search_results_container" class="container"></div>