<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<?php $_title =""; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Overview of Step 6: Plan Implementation and Maintenance</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step6_1"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>


<div class="col-half left">
    <p>Now  that your planning team has an approved EOP, Step 6 will prompt your team to  implement the plan by training stakeholders; conducting drills and exercises;  and reviewing, revising, and maintaining the plan. Through the process of reviewing  and revising the plan, Step 6 closes the loop in the six-step planning process  by prompting the planning team to begin the process again.</p>
    <p><strong>Train Stakeholders on the Plan</strong></p>
    <p>The  first step in implementing the school EOP is to train everyone involved in the  plan on his or her roles and responsibilities before, during, and after an  emergency. </p>
    <p><strong>Exercise the Plan</strong></p>
    <p>Next,  your planning team will need to exercise the plan. Drills and exercises will  help stakeholders practice their roles and responsibilities before, during, and  after an emergency, and provide important information to the planning team  regarding the effectiveness of the plan. </p>
    <p><strong>Review, Revise, and Maintain the Plan</strong></p>
    <p>Once  a plan has been implemented, the planning team will need to update the plan  regularly, either in part or in whole. </p>
    <p><strong>Closing the Loop in the Planning Process</strong></p>
    <p>Step  6 closes the loop in the six-step planning process and starts the planning  cycle over again. A high-quality plan is one that continually evolves to meet  the needs of the school and the surrounding community. </p>
    <p><strong>Outcome of Step 6</strong></p>
    <p>At  the conclusion of Step 6, your plan will be implemented and the planning cycle  will begin again.</p>
</div>


<?php endif; ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title =""; ?>

<div id="topcontain">
    <div id="titlearea">
        <h1>Overview of Step 6: Help Schools Implement and Maintain Plans</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step6_1"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>


<div class="col-half left">
    <p>Step 6 will prompt your team to help schools implement plans by training and informing stakeholders; conducting drills and exercises; and reviewing, revising, and maintaining the plans. Through the process of reviewing and revising, Step 6 closes the loop in the six-step planning process by prompting planning teams to begin the process again.</p>
    <p><strong>Train and Inform Stakeholders</strong> <br>
  The first task in implementing the school EOP is to train everyone involved in the plan on their roles and responsibilities before, during, and after an emergency. You play an important role in helping to coordinate training on school EOPs by using the approved training programs included in the Basic Plan section of each school EOP in the district. </p>
<p><strong>Exercise the Plan</strong> <br>
  Next, school planning teams will need to exercise the plan. Drills and exercises will help stakeholders practice their roles and responsibilities before, during, and after an emergency, and provide important information to the planning team regarding the effectiveness of the plan. Your role is to establish policies and procedures for conducting exercises at schools, help coordinate complex exercises and drills, encourage schools to exercise the plan under different and nonideal conditions, and work with schools to develop an exercise schedule and evaluate and improve exercises.</p>
<p><strong>Review, Revise, and Maintain the Plan</strong> <br>
  Once a plan has been implemented, the school core planning team will need to update the plan regularly, either in part or in whole. You will ensure that schools review, revise, and maintain their school EOPs according to, at a minimum, the district&rsquo;s approved cycle.</p>
<p><strong>Closing the Loop in the Planning Process</strong> <br>
  Step 6 closes the loop in the six-step planning process and starts the planning cycle over again. A high-quality plan is one that continually evolves to meet the needs of the school and the surrounding community.</p>
<p><strong>Outcome of Step 6</strong> <br>
  At the conclusion of Step 6, the school EOP will be implemented and the planning cycle will begin again.</p>
</div>

<?php endif; ?>

<script type='text/javascript'>

    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step6/2')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step5/5')); ?>"); //Previous

    }); // End $(document).ready function


</script>
