<?php
$school_loaded = (isset($this->session->userdata['loaded_school']['id']) && null != $this->session->userdata['loaded_school']['id']) ? true : false;
?>
<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Add/Edit Trainings"; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Train Stakeholders on the Plan</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step6_2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>


<div class="col-half left">
    <p>The  first step in implementing the school EOP is to train everyone involved in the  plan on his or her roles and responsibilities before, during, and after an  emergency. Your planning team should consider conducting the following  activities when training stakeholders on the plan.</p>
    <p><strong>Hold a meeting</strong>. At  least once a year, hold a meeting to educate all parties on the plan. </p>
    <p><strong>Visit evacuation sites</strong>.  Show involved parties not only where evacuation sites are located, but also  where specific areas&mdash;such as reunification areas, media areas, and triage areas&mdash;will  be located.</p>
    <p><strong>Give involved parties appropriate and  relevant literature on the plan, policies, and procedures</strong>. It  may also be helpful to provide all parties with <a href="#" class="bt" title="Your school planning team should consider preparing translated versions of these reference guides to support individuals with limited English proficiency.">quick reference guides on key courses of action.</a></p>
    <p><strong>Post key information throughout the  buildings</strong>. It is important that students and staff members are  familiar with and have easy access to information such as evacuation routes and  shelter-in-place procedures and locations. Communicate key information to individuals  with disabilities and other access and functional needs by distributing the  materials in an accessible format.</p>
    <p><strong>Familiarize students and staff with  community partners</strong>. Bring community partners (e.g., law  enforcement officers, fire officials, and EMS personnel) to the school to talk  about the plan in order to help students and staff members feel more  comfortable working with these partners.</p>
    <p><strong>Train staff members on the skills  necessary to fulfill their roles</strong>. Staff members will be  assigned specific roles in the plan and in support of ICS that require special  skills and training, such as first aid, threat assessment, and provision of  personal assistance services for individuals with disabilities and other access  and functional needs. Substitute teachers must also be trained on their roles  in the plan.</p>
</div>

<?php endif; ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Train and Inform Stakeholders"; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Train and Inform Stakeholders</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step6_2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>


<div class="col-half left">
    <p>The first task in implementing the school EOP is to train everyone involved in the plan on their roles and responsibilities before, during, and after an emergency. You play an important role in helping to coordinate training on school EOPs by using the approved training programs included in the Basic Plan section of each district school&rsquo;s EOP. </p>
<p>When developing policies and procedures to support and strengthen schools&rsquo; training programs, consider relevant train-the-trainer guidance or training activities, particular areas for training specific stakeholders, diverse publication languages and formats for the school EOPs, and specific training certifications, if necessary.</p>
<p>Planning teams should consider conducting the following activities when training stakeholders on the plan.</p>
	<ul>
<ul>
  <li><strong>Hold a meeting</strong><strong>.</strong> At least once a year, hold a meeting to educate all parties on the plan.</li>
  <li><strong>Visit evacuation sites</strong><strong>.</strong> Show involved parties where evacuation sites are located, and also where specific areas—such as reunification areas, media areas, and triage areas—will be located.</li>
  <li><strong>Give involved parties appropriate and relevant literature on the plan, policies, and procedures</strong><strong>.</strong> It may also be helpful to provide all parties with&nbsp;<a href="#" class="bt" title="Planning teams should consider preparing translated versions of these reference guides to support individuals with limited English proficiency.">quick reference guides on key courses of action</a>. </li>
  <li><strong>Post key information throughout the buildings</strong><strong>.</strong> Students and staff members should be familiar with and have easy access to information such as evacuation routes and shelter-in-place procedures and locations. Communicate key information to individuals with disabilities and other access and functional needs by distributing the materials in accessible formats.</li>
  <li><strong>Familiarize students and staff with community partners</strong><strong>.</strong> Bring community partners (e.g., law enforcement officers, fire officials, and EMS personnel) to the school to talk about the plan to help students and staff members feel more comfortable working with these partners.</li>
</ul>
		</ul>
<p><strong>Train staff members on the skills necessary to fulfill their roles</strong><strong>. </strong>Staff members will be assigned specific roles in the plan and in support of ICS that require special skills and training, such as first aid, threat assessment, and provision of personal assistance services for individuals with disabilities and other access and functional needs. Substitute teachers must also be trained on their roles in the plan.</p>
</div>
<?php endif; ?>

<div class="col-half left">
    <?php
    if((null != $this->session->flashdata('success'))):
        ?>
        <div id="errorDiv">
            <div class="notify notify-green">
                <span class="symbol icon-tick"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('success'));?>
            </div>
        </div>

    <?php endif; ?>
    <?php
    if((null != $this->session->flashdata('error'))):
        ?>
        <div id="errorDiv">
            <div class="notify notify-red">
                <span class="symbol icon-error"></span>&nbsp;&nbsp;  <?php echo($this->session->flashdata('error'));?>
            </div>
        </div>

    <?php endif; ?>


</div>

<div class="col-half left">

    <h1> <?php echo($_title); ?></h1>
	
	
    <div id="newDetailDiv" >
        <?php $this->load->view("forms/create_training.php"); ?>
    </div>

    <div id="subDetailDiv"></div>
</div>

<style>

    #newTrainingForm input[type='text'],#newTrainingForm input[type='number'], #newTrainingForm select, #newTrainingForm textarea{
        min-width: 470px;
        width: 50%;
    }
</style>



<script type='text/javascript'>

    $(document).ready(function() {

        $( "#txtDate" ).datepicker();

        loadTrainings();

        $("tr#otherTopic").hide();

        $(document).on('change', '#txtTopic', function(e){
            if($(this).val()=='Other related emergency management topic'){
                $("#txtOtherTopic").attr('required', true);
                $("tr#otherTopic").show();
            }else{
                $("#txtOtherTopic").attr('required', false);
                $("tr#otherTopic").hide();
            }
        });

        <?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && !$school_loaded): ?>

            $("input[name='providedBy']").val('district-provided');
            $("input[name='txtSchools']").attr('required', true);
        <?php endif; ?>

        <?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && $school_loaded): ?>
        $("tr.district-provided").hide();
        $("tr.update_district-provided").hide();
        $("input[name='providedBy']").val('school-provided');
        $("input[name='txtSchools']").attr('required', false);
        <?php endif; ?>

        $("#chk_providedBy").click(function(){
            if($(this).prop("checked")==true){
                $("tr.district-provided").show();
                $("input[name='providedBy']").val('district-provided');
                $("input[name='txtSchools']").attr('required', true);
            }else if($(this).prop("checked")==false){
                $("tr.district-provided").hide();
                $("input[name='providedBy']").val('school-provided');
                $("input[name='txtSchools']").attr('required', false);
            }
        });



        function loadTrainings(){

            var formData = {
                ajax    :   '1',
                param   :   'all'
            };

            $.ajax({
                url: '<?php echo(base_url('training/show')); ?>',
                data: formData,
                type:'POST',
                success:function(response){

                    $('#subDetailDiv').html(response);
                },
                error:function(error){
                    //alert(error);
                }
            });
        }

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step6/3')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step6/1')); ?>"); //Previous

    }); // End $(document).ready function


</script>
