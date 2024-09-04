<?php
/**
 * Page footer embedded on all the app pages
 */
$planPages = array('home', 'step1', 'step2', 'step3', 'step4', 'step5', 'step6');
?>
<div id="logo">
    <img src="<?php echo base_url(); ?>assets/img/DOElogo.png" class="logo" alt="U.S. Department Of Education Logo"/>
    <img src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png" class="logo" alt="REMS TA Center Logo"/>
    <p class="DOEcr"><?php echo(date('Y')); ?> &copy; U.S. Department of Education</p>
</div>

<?php /*
<?php if(in_array($page, $planPages)): ?>
    <?php if($this->session->userdata('loaded_school') || $this->session->userdata['role']['level'] <= DISTRICT_ADMIN_LEVEL): ?>
    <div id="arrow_nav">
        <div id="left_arrow"><a href="#" id="leftArrowButton"><img src="<?php echo base_url(); ?>assets/img/arrow_left.png" id='leftArrowButton'/></a></div>
        <div id="right_arrow"><a href="#" id="rightArrowButton"><img src="<?php echo base_url(); ?>assets/img/arrow_right.png" id='rightArrowButton'/></a></div>
    </div>
    <?php endif; ?>
<?php endif; ?>
 */
 ?>