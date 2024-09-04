<?php
/**
 * ajax view uploaded files
 * 
 */
//print_r($fileData);
?>

<?php if(isset($fileData) && count($fileData)>0): ?>
    <?php if((isset($fileData['main']['file_name']) || isset($fileData['cover']['file_name']) ) && (!empty($fileData['main']) || !empty($fileData['cover']))): ?>
        <table class="filedl">
            <tr>
                <th style="width:30%;">File Name</th>
                <th style="width:22%;">Type</th>
                <th style="width:34%;">Upload Date</th>
                <th style="width:14%;">Download</th>
                <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                    <th width="8%"></th>
                <?php endif; ?>
            </tr>
            <?php foreach($fileData as $key => $fileInfo): ?>

                <?php if(is_array($fileInfo) && count($fileInfo)>0): ?>
                    <?php if(isset($fileInfo['file_name']) && !empty($fileInfo['file_name']) && is_file($fileInfo['full_path'])): ?>
                        <tr>
                            <td><a href="<?php echo(base_url("/uploads/")."/".$fileInfo['file_name']);?>" target="_blank"><?php echo($fileInfo['file_name']);?></a></td>
                            <td><?php echo(($key=='cover') ? 'Cover Page': 'Basic Plan'); ?></td>
                            <td><?php echo(date("F d Y H:i:s", filemtime($fileInfo['full_path'])));?></td>
                            <td><a href="<?php echo(base_url("/uploads/")."/".$fileInfo['file_name']);?>" target="_blank" title="Download file">Download</a></a></td>
                            <?php if($this->session->userdata['role']['read_only']=='n'): ?>
                                <td><a href="<?php echo(base_url("/report/remove/".$key)); ?>" title="Remove file" id="<?php echo($key); ?>FileDelete">Delete</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
<?php endif; ?>

<script>
    $(document).on('click', '#mainFileDelete', function(){
        if(confirm("Are you sure you want to remove this file permanently?")){
            return true;
        }else{
            return false;
        }
    });

    $(document).on('click', '#coverFileDelete', function(){
        if(confirm("Are you sure you want to remove this file permanently?")){
            return true;
        }else{
            return false;
        }
    });

</script>