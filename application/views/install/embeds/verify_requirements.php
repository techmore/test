<?php
    echo form_open('app/install', array('class'=>'verify_requirements_form', 'id'=>'verify_requirements_form'));
?>
    <h3 class="title">Verify System Requirements</h3>

<table>
    <thead>
    <tr>
        <th></th>
    </tr>
    </thead>

    <tbody>
        <tr>
            <td>
                <?php
                $php            =   $status['php'];
                $errors         =   isset($status['fatal_errs'])? $status['fatal_errs'] : array();
                $warnings       =   isset($status['warnings']) ? $status['warnings'] : array();
                $file_errors    =   isset($status['file_errs'])? $status['file_errs'] : array();

                ?>
                <h3>PHP Version: <?php echo($php['version']); ?></h3>
                <?php if($php['sufficient'] !=1): ?>
                    <div id="errorDiv">
                        <div class="notify notify-red">PHP 5.6.0 and higher is required to install EOP ASSIST.</div>
                    </div>
                <?php endif; ?>

                <div id="errorDiv">
                    <?php echo (count($errors)>0)? '<h3>Required</h3>': '<br/><h3>Required PHP Extensions and Libraries</h3><div id="errorDiv"><div class="notify notify-green"> All required libraries installed and loaded successfully</div></div>'; ?>
                    <?php foreach($errors as $error): ?>
                        <div class="notify notify-red"> <?php echo ("Required library <strong><em>".$error['library']."</em></strong> -- ".$error['message']); ?></div>
                    <?php endforeach; ?>
                </div>

                <div id="errorDiv">
                    <?php echo (count($file_errors)>0)? "<h3>Install requires write permissions on the following files</h3>": "<h3>File Permissions</h3> <div id='errorDiv'><div class='notify notify-green'> Write permissions of required files are set.<?php echo(posix_getpwuid(posix_geteuid())['name'].'sdsd');?></div></div>"; ?>
                    <?php foreach($file_errors as $error): ?>
                        <div class="notify notify-red"> <?php echo ("File permission error:  <strong><em>".$error['file']."</em></strong> -- ".$error['message']); ?></div>
                    <?php endforeach; ?>
                </div>

                <div id="errorDiv">
                    <h3>Warning</h3>
                    <?php foreach($warnings as $warning): ?>
                        <div class="notify notify-yellow"><?php echo ("<strong><em>".$warning['library']."</em></strong> -- ".$warning['message']); ?></div>
                    <?php endforeach; ?>
                </div>
            </td>
        </tr>
    </tbody>

    <tfoot>
    <tr>
        <th></th>
    </tr>
    </tfoot>
</table>

    <p>
        <?php
        $attributes = array(
            'name'  =>  'verify_requirements_submit',
            'value' =>  'Save and Continue',
            'class' =>  'signin_submit',
            'id'    =>  'verify_requirements_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
    </p>

<?php
    echo form_close();
?>