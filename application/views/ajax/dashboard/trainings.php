<?php

$loggedin_role = $this->session->userdata['role']['level'];

$number_school_hosted   = 0;
$number_district_hosted = 0;
$participants = 0;
$scoreTotal = 0;
$number_leas = 0;
$number_rleas = 0;
$school_loaded = (isset($this->session->userdata['loaded_school']['id']) && null != $this->session->userdata['loaded_school']['id']) ? true : false;
$logged_in_role_level = $this->session->userdata['role']['level'];

foreach($trainingData as $key => $value){

    if($value['provider']=='district-provided') {
        $number_district_hosted++;
    }


    if($value['provider']=='school-provided') {
        $number_school_hosted++;
    }


    if($value['provider']=='state-provided'){
        $number_leas += intval($value['leas']);
        $number_rleas += intval($value['rleas']);
    }

    $participants += $value['participants'];

    $scoreTotal += floatval($value['score']);

}

//echo($scoreTotal/count($trainingData));

$avgScore = ($scoreTotal / count($trainingData));
?>


<table  class="teamresult" style="width:auto;">
    <thead>
    <tr>
        <th>Number of Trainings</th>
        <th>Number of Participants</th>
        <th>Average Overall Evaluation Score</th>

        <?php if($loggedin_role <= DISTRICT_ADMIN_LEVEL): ?>
            <th>Number of Schools</th>
            <?php if($loggedin_role <= STATE_ADMIN_LEVEL): ?>
                <th>Number of Districts</th>
                <th>Number of LEAs</th>
                <th>Number of Rural LEAs</th>
            <?php endif; ?>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo(count($trainingData)); ?></td>
        <td><?php echo($participants); ?></td>
        <td><?php echo(round($avgScore, 1)); ?></td>

        <?php if($loggedin_role <= DISTRICT_ADMIN_LEVEL): ?>
            <td><?php echo( ($number_school_hosted>0) ? $number_school_hosted:''); ?></td>
            <?php if($loggedin_role <= STATE_ADMIN_LEVEL): ?>
                <td><?php echo( ($number_district_hosted>0) ? $number_district_hosted:''); ?></td>
                <td><?php echo( ($number_leas>0) ? $number_leas:''); ?></td>
                <td><?php echo( ($number_rleas>0) ? $number_rleas:''); ?></td>
            <?php endif; ?>
        <?php endif; ?>
    </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<table  class="teamresult" width="100%">
    <thead>
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Topic</th>
        <th scope="col">Date</th>
        <th scope="col">Location</th>
        <th scope="col">Number of <br/> Participants</th>
        <?php if(!$school_loaded && $logged_in_role_level==DISTRICT_ADMIN_LEVEL): ?>
            <th>Number of <br/> Schools </th>
        <?php endif; ?>
        <?php if(!$school_loaded && $logged_in_role_level==STATE_ADMIN_LEVEL): ?>
            <th>Number of <br/> LEAs </th>
            <th>Number of <br/> Rural LEAs </th>
        <?php endif; ?>
        <th scope="col">Evaluation <br/>Score</th>
        <th scope="col">Attachment</th>

    </tr>
    </thead>
    <tbody>
    <?php if(isset($trainingData) && is_array($trainingData) && count($trainingData)>0): ?>
        <?php foreach ($trainingData as $key => $value): ?>
            <?php
            $file_name='';
            $link = '';
            $fileData = json_decode($value['file'], true);
            if($fileData && is_array($fileData) && count($fileData)>0){
                $file_name = $fileData['file_name'];
                $link = base_url() . 'uploads/attachments/' . $file_name;
            }
            ?>
            <tr>
                <td scope="col"><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><?php echo $value['name']; ?></div></td>
                <td scope="col"><?php echo $value['topic']; ?></td>
                <td scope="col"><?php echo $value['date']; ?></td>
                <td scope="col"><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><?php echo $value['location']; ?></div></td>
                <td scope="col"><div><?php echo $value['participants']; ?></div></td>
                <?php if(!$school_loaded && $logged_in_role_level==DISTRICT_ADMIN_LEVEL): ?>
                    <td scope="col">
                        <div>
                            <?php $_output = ($value['provider']=='district-provided') ? $value['schools'] : '<em style="color:#9e9e9e;">school-provided</em>'; ?>
                            <?php echo($_output); ?>
                        </div>
                    </td>
                <?php endif; ?>
                <?php if(!$school_loaded && $logged_in_role_level==STATE_ADMIN_LEVEL): ?>
                    <td><div><?php echo $value['leas']; ?></td>
                    <td><div><?php echo $value['rleas']; ?></td>
                <?php endif; ?>
                <td scope="col"><div><?php echo $value['score']; ?></div></td>

                <td scope="col">
                    <?php if($link): ?>
                        <a href="<?php echo $link; ?>" target="_blank" title="Download attachment" class="link-icon"> Download </a>
                    <?php endif; ?>
                </td>

            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

