<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Determine a Regular Schedule of Meetings</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step1_4"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>School  emergency management planning is an ongoing effort that is reinforced through  regularly scheduled planning meetings. Establishing a flexible but regular  schedule of meeting times will facilitate greater collaboration, coordination,  and communication among team members, and will help solidify crucial  relationships.</p>
    <p>Often,  planning teams that are creating new school EOPs will have to meet frequently initially.  Once the EOP is in place, teams will still need regular meetings to revise and  maintain the plan. Planning teams typically continue to meet often&mdash;at least  once a month&mdash;to discuss plan modifications, plan and review trainings and drills,  and conduct inventories of supplies.</p>
    <p>Please  click on the EOP ASSIST <a href="<?php echo(base_url('calendar')); ?>" target="_blank">Calendar</a> to schedule  planning meetings and set up reminders and notifications to support your team&rsquo;s  planning process. </p>
</div><!-- /col-half --><!-- /col-half -->
<?php endif; ?>

<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Determine a Regular Schedule of Meetings</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step1_4"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>School emergency management planning is an ongoing effort that is reinforced through regularly scheduled planning meetings. Establishing a flexible but regular schedule of meeting times will facilitate greater collaboration, coordination, and communication among team members, and will help solidify crucial relationships.</p>
    
    <p>You play an important role in setting districtwide expectations and requirements for holding regular but flexible planning meetings in each school. Consider the time required to develop the school EOP. Also consider the frequency of school core planning team meetings during the school EOP development process, as well as after the process is complete. Often, when planning teams are creating new school EOPs, they will meet frequently. Once the EOP is in place, teams will still need regular meetings to revise and maintain the plan. Planning teams typically continue to meet often—at least once a month—to discuss plan modifications, plan and review trainings and drills, and conduct inventories of supplies.</p>
    <p>Please click on the EOP ASSIST&nbsp;<a href="<?php echo(base_url('calendar')); ?>" target="_blank">Calendar</a> to schedule planning meetings for your schools and set up reminders and notifications to support your school core planning teams&rsquo; planning process. </p>
</div><!-- /col-half --><!-- /col-half -->

<?php endif; ?>

<script type='text/javascript'>
    $(document).ready(function() {


        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step2/1')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step1/3')); ?>"); //Previous
    });

</script>
