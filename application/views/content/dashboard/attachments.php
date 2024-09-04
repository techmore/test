<h1 style="margin:10px 0px">Attachments</h1>
<?php if($files): ?>



<table border="0" width="100%" class=" display" id="filesTable" >
    <thead>
    <tr style="background:#eee; font-weight: bold;">
        <th scope="col">Date</th>
        <th scope="col">File Title</th>
        <th scope="col">File Name</th>
        <th scope="col">School</th>
        <th scope="col" style="width:10%">Attachments</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach($files as $key=>$file): ?>
        <?php
        $file_data = json_decode($file['data'], true);
        ?>

        <tr>
            <td><?php echo(date_format(date_create($file['created']), 'm/d/Y g:i a')); ?></td>
            <td><?php echo($file['name']); ?></td>
            <td><?php echo($file_data['file_name']); ?></td>
            <td><?php echo($file['school']); ?></td>
            <td>
                <a href="<?php echo(base_url() . 'uploads/files/'. $file_data['file_name']); ?>" download>Download</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr style="background:#eee; font-weight: bold;">
        <th>Date</th>
        <th>File Title</th>
        <th>File Name</th>
        <th>School</th>
        <th style="width:10%">Attachments</th>
    </tr>
    </tfoot>

</table>
<?php endif; ?>