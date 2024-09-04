<div class="adminMenu">
    <ul>
        <?php if($role['level'] < SCHOOL_USER_LEVEL): ?>
            <li>
                <a href="<?php echo base_url(); ?>user">User Management </a> &nbsp;&nbsp; | &nbsp;&nbsp;

            </li>
            <?php if($role['level']< SCHOOL_ADMIN_LEVEL): ?>
                <li>
                    <a href="<?php echo base_url(); ?>school">School Management</a> &nbsp;&nbsp; | &nbsp;&nbsp;

                </li>
                <li>
                    <a href="<?php echo base_url(); ?>district">School District Management</a> &nbsp;&nbsp;|&nbsp;&nbsp;

                </li>
            <?php endif; ?>
            <?php if(($this->session->userdata('host_level')) && $this->session->userdata('host_level')=='state'): ?>
                <li>
                    <a href="<?php echo base_url(); ?>access">State Access</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                </li>
            <?php endif; ?>

            <?php if($role['level'] == SUPER_ADMIN_LEVEL): ?>
                <li>
                    <a href="<?php echo base_url(); ?>timeout">Time-Out</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>administrator">Program Administrator</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                </li>
            <?php endif; ?>

            <?php if($role['level'] <= DISTRICT_ADMIN_LEVEL): ?>

                <li>
                    <a href="<?php echo base_url(); ?>toolkit">Resource Toolkit</a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
    <br style="clear: both;"/>
</div>