<h1 style="margin:10px 0px">EOPs</h1>
<table border="0" width="100%" class=" display" id="myEOPReportTbl" >
    <thead>
    <tr style="background:#eee; font-weight: bold;">
        <th scope="col">Date</th>
        <?php if($role_level<=3): ?>
            <th scope="col">School</th>
        <?php endif; ?>
        <?php if($role_level<2): ?>
            <th scope="col">District</th>
        <?php endif; ?>
        <th scope="col">Basic Plan Source</th>
        <th scope="col">School EOP</th>
    </tr>
    </thead>

    <?php foreach($schoolsData as $key => $school):

        $EOP_type="internal";
        if(!empty($school[0]['preferences'])){
            $preferenceObj = json_decode($school[0]['preferences']);
            if(!empty($preferenceObj->main))
                $EOP_type = $preferenceObj->main->basic_plan_source;
        }
        ?>
        <tr>
            <td><?php echo(date_format(date_create($school[0]['last_modified']), 'm/d/Y g:i a')); ?></td>
            <?php if($role_level<=3): ?>
                <td><?php echo($school[0]['name']); ?></td>
            <?php endif; ?>
            <?php if($role_level<2): ?>
                <td><?php echo($school[0]['district']); ?></td>
            <?php endif; ?>
            <td>
                <?php echo($EOP_type=='internal')? "Internal": "External / Uploaded"; ?>
            </td>
            <td>
                <a href="<?php echo base_url(); ?>report/make/<?php echo($school[0]['id']); ?>">Download</a>
            </td>
        </tr>
    <?php endforeach; ?>

    <tfoot>
    <tr style="background:#eee; font-weight: bold;">
        <th>Date</th>
        <?php if($role_level<=3): ?>
            <th>School</th>
        <?php endif; ?>
        <?php if($role_level<2): ?>
            <th>District</th>
        <?php endif; ?>
        <th>Basic Plan Source</th>
        <th>School EOP</th>
    </tr>
    </tfoot>
</table>
<p>&nbsp;</p>