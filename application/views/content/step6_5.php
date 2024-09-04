<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<?php $_title =""; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Thank You for Using EOP ASSIST</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step6_5"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->

</div>


<div class="col-half left">
    <p>Your  planning team has just completed the six-step planning process for developing a  high-quality school EOP. Your team deserves congratulations for the important  strides you have taken to improve emergency management at your school! </p>
    <p>Although  completing the six-step planning process is a significant milestone, it does  not mean that your work is done. High-quality school emergency planning is a  continuous, cyclical process, and completing Step 6 starts the planning cycle  over again. Because your planning team used EOP ASSIST to build your school  EOP, your team can expect a smooth and efficient updating process. Instead of  reentering all of your plan information, your team can easily navigate to the  specific steps or plan sections that need updating. After making updates into  the designated fields in the EOP ASSIST Planning Process, your team can export  the updated plan using the <a href="<?php echo base_url(); ?>report" id="reportManagementLink1">My EOP</a> feature.</p>
    <p>Remember,  a high-quality plan is one that continually evolves to meet the needs of the  school and the surrounding community. </p>
    <p>Thank  you for using EOP ASSIST.</p>

    <!--<p style="margin-left:auto; margin-right:auto;"><a href="http://rems.ed.gov" target="_blank"><img src="<?php /*echo base_url(); */?>assets/img/REMS-TA-Center-logo.png" alt="" width="400" height="141"/></a></p>-->



</div>


<?php endif; ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Exercise the Plan"; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Thank You for Using EOP ASSIST</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step6_5"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->

</div>


<div class="col-half left">
    <p>Your planning team has just completed the six-step planning process for helping the schools in your district develop high-quality school EOPs. Your team deserves congratulations for taking important steps to improve emergency management in your district! </p>
    <p>Although completing the six-step planning process is a significant milestone, it does not mean that your work is done. High-quality school emergency planning is a continuous, cyclical process, and completing Step 6 restarts the planning cycle. Because your planning team used EOP ASSIST to help build the framework schools should refer to when creating their individual school EOPs, your team can expect a smooth and efficient updating process. Instead of reentering all your information, your team can easily navigate to the specific steps or plan sections that need to be updated. After making updates into the designated fields in the EOP ASSIST Planning Process, your team can export the updated framework using the  <a href="<?php echo base_url(); ?>report" id="reportManagementLink2">My EOP</a> feature.</p>
    <p>Remember, a high-quality plan is one that continually evolves to meet the needs of every school in your district as they engage in the process of developing their own school EOPs. </p>
    <p>Thank  you for using EOP ASSIST.</p>

    <!--<p style="margin-left:auto; margin-right:auto;"><a href="http://rems.ed.gov" target="_blank"><img src="<?php /*echo base_url(); */?>assets/img/REMS-TA-Center-logo.png" alt="" width="400" height="141"/></a></p>-->



</div>

<?php endif; ?>

<script type='text/javascript'>

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('home/step/1')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step6/4')); ?>"); //Previous

    }); // End $(document).ready function


    $('.accordion').find('.accordion-toggle').click(function(){
        //Expand or collapse this panel
        $(this).next().slideToggle('fast');
        //Hide the other panels
        $(".accordion-content").not($(this).next()).slideUp('fast');
    });

</script>
