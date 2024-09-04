<?php
    echo form_open('/login', array('class'=>'finished_form', 'id'=>'finished_form'));
?>
    <h3 class="title">Finalize Installation</h3>
<?php if(isset($error)): ?>
    <h3 class='error'><?php echo ($error); ?></h3>
<?php endif; ?>

<p>
    The configuration and installation process is now complete. Please log in to EOP ASSIST using your newly created Super Administrator login credentials.
</p>

    <p>
        <?php
        $attributes = array(
            'name'  =>  'finished_form_submit',
            'value' =>  'Login',
            'class' =>  'signin_submit',
            'id'    =>  'finished_form_submit',
            'style' =>  ''
        );
        ?>
        <?php echo form_submit($attributes); ?>
    </p>

<?php
    echo form_close();
?>