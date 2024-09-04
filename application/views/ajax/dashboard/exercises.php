<?php
$loggedin_role = $this->session->userdata['role']['level'];

$number_school_hosted   = 0;
$number_district_hosted = 0;

foreach($exerciseData as $key => $value){

    if($value['host']=='district')
        $number_district_hosted++;


    if($value['host']=='school')
        $number_school_hosted++;
}
?>



<table  class="teamresult" style="width:auto;">
    <thead>
    <tr>
        <th>Number of Exercises</th>

        <?php if($loggedin_role <= DISTRICT_ADMIN_LEVEL): ?>
            <th>Number of Schools</th>
            <?php if($loggedin_role <= STATE_ADMIN_LEVEL): ?>
                <th>Number of Districts</th>
            <?php endif; ?>
        <?php endif; ?>
    </tr>

    </thead>
    <tbody>
    <tr>
        <td><?php echo(count($exerciseData)); ?></td>
        <?php if($loggedin_role <= DISTRICT_ADMIN_LEVEL): ?>
            <td><?php echo(($number_school_hosted>0) ? $number_school_hosted : ''); ?></td>
            <?php if($loggedin_role <= STATE_ADMIN_LEVEL): ?>
                <td><?php echo(($number_district_hosted>0) ? $number_district_hosted : ''); ?></td>
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
        <th scope="col">Type</th>
        <th scope="col">Location</th>
        <th scope="col">Contact</th>
        <th scope="col">Date</th>
        <th scope="col">Attachment</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($exerciseData) && is_array($exerciseData) && count($exerciseData)>0): ?>
        <?php foreach ($exerciseData as $key => $value): ?>
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
                <td scope="col"><?php echo $value['type']; ?></td>
                <td scope="col"><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><?php echo $value['location']; ?></div></td>
                <td scope="col"><div style="word-wrap: break-word; nowrap:wrap; max-width:120px"><?php echo $value['contact']; ?></div></td>
                <td scope="col"><?php echo $value['date']; ?></td>

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