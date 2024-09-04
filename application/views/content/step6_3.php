<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Add/Edit Emergency Exercises"; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Exercise the Plan</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step6_3"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>


<div class="col-half left">
    <p>The more a plan is practiced and stakeholders are trained on the plan, the more effectively they will be able to act before, during, and after an emergency to lessen the impact on life and property. Exercises provide opportunities to practice with community partners (e.g., first responders, local emergency management personnel), as well as to identify gaps and weaknesses in the plan. The exercises below require increasing amounts of planning, time, and resources. Ideally, schools will create an exercise program, building from a tabletop exercise up to a more advanced exercise, like a functional exercise.</p>



        <div class="accordion">
            <div class="accordion-toggle">
                <ul>
                    <li><a href="#">Tabletop exercises</a></li>
                </ul>
            </div>
            <div class="accordion-content default">
                <blockquote>
                    <p>Tabletop exercises are small-group discussions that walk through a scenario and the courses of action a school will need to take before, during, and after an emergency to lessen the impact on the school community. This activity helps assess the plan and resources, and facilitates an understanding of emergency management and planning concepts.</p>
                </blockquote>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-toggle">
                <ul>
                    <li><a href="#">Drills</a></li>
                </ul>
            </div>
            <div class="accordion-content default">
                <blockquote>
                    <p>During drills, school personnel and community partners (e.g., first responders, local emergency management staff) use the actual school grounds and buildings to practice responding to a scenario.</p>
                </blockquote>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-toggle">
                <ul>
                    <li><a href="#">Functional exercises</a></li>
                </ul>
            </div>
            <div class="accordion-content default">
                <blockquote>
                    <p>Functional exercises are similar to drills but involve multiple partners; some may be conducted school districtwide. Participants react to realistic simulated events (e.g., a bomb threat,  an intruder with a gun in a classroom) and implement the plan and procedures using the ICS.</p>
                </blockquote>
            </div>
        </div>


        <div class="accordion">
            <div class="accordion-toggle">
                <ul>
                    <li><a href="#">Full-scale exercises</a></li>
                </ul>
            </div>
            <div class="accordion-content default">
                <blockquote>
                    <p>These exercises are the most time-consuming activity in the exercise continuum and are multiagency, multijurisdictional efforts in which all resources are deployed. This type of exercise tests collaboration among the agencies and participants, public information systems, communications systems, and equipment. An Emergency Operations Center is established by either law enforcement or fire services, and the ICS is activated.</p>
                </blockquote>
                </li>
            </div>
        </div>
    <br />
    <p>Before making a decision about how many and which types of exercises to implement, a school should consider the costs and benefits of each, as well as any state or local requirements.
    </p>
    </p>
    <p>To  effectively execute an exercise:</p>
    <ul class="indented-40">

            <li>Include community partners such as <a href="#" class="bt" title="Law enforcement officers, EMS practitioners, and fire department personnel.">first responders</a>  and  local emergency management staff;</li>
            <li>Communicate information about the exercise in  advance to avoid confusion and concern;</li>
            <li>Exercise under different and nonideal conditions (e.g., times of day, weather conditions, points in the academic calendar, absence of key personnel, and various school events);</li>
            <li>Be consistent with <a href="http://rems.ed.gov/docs/Glossary%20of%20Key%20Terms%208.8.2014.pdf" target="_blank">common  emergency management terminology</a>;</li>
            <li>Debrief and develop an after-action report that  evaluates results, identifies gaps or shortfalls, and documents lessons  learned; and</li>
            <li>Discuss how the school EOP and procedures  will be modified, if needed, and specify who has the responsibility for  modifying the plan.</li>

    </ul>
    <p>&nbsp;</p>
</div><!-- /col-half --><!-- /col-half -->

<?php endif; ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Exercise the Plan"; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Exercise the Plan</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step6_3"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>


<div class="col-half left">
    <p>The more often a plan is practiced and stakeholders become familiar with it, the more effectively they will be able to act before, during, and after an emergency to lessen the impact on life and property. Exercises provide opportunities to practice with community partners (e.g., first responders, local emergency management personnel) and to identify gaps and weaknesses in the plan. The exercises below require increasing amounts of planning, time, and resources. Ideally, in Step 5, you will work with your schools to create an exercise program that builds from a tabletop exercise up to a more advanced exercise, like a functional exercise.</p>



        <div class="accordion">
            <div class="accordion-toggle">
                <ul>
                    <li><a href="#">Tabletop exercises</a></li>
                </ul>
            </div>
            <div class="accordion-content default">
                <blockquote>
                    <p>Tabletop exercises are small-group discussions that walk through a scenario and the courses of action a school will need to take before, during, and after an emergency to lessen the impact on the school community. This activity helps participants assess the plan and resources, and facilitates an understanding of emergency management and planning concepts.</p>
                </blockquote>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-toggle">
                <ul>
                    <li><a href="#">Drills</a></li>
                </ul>
            </div>
            <div class="accordion-content default">
                <blockquote>
                    <p>During drills, school personnel and community partners (e.g., first responders, local emergency management staff) use the actual school grounds and buildings to practice responding to a scenario.</p>
                </blockquote>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-toggle">
                <ul>
                    <li><a href="#">Functional exercises</a></li>
                </ul>
            </div>
            <div class="accordion-content default">
                <blockquote>
                    <p>Functional exercises are similar to drills but involve multiple partners; some may be conducted districtwide. Participants react to realistic simulated events (e.g., a bomb threat, an intruder with a gun in a classroom) and implement the plan and procedures using the ICS.</p>
                </blockquote>
            </div>
        </div>


        <div class="accordion">
            <div class="accordion-toggle">
                <ul>
                    <li><a href="#">Full-scale exercises</a></li>
                </ul>
            </div>
            <div class="accordion-content default">
                <blockquote>
                    <p>These exercises are the most time-consuming in the exercise continuum, and are multiagency, multijurisdictional efforts in which all resources are deployed. This type of exercise tests collaboration among the agencies and participants, public information systems, communications systems, and equipment. An Emergency Operations Center is established by either law enforcement or fire services, and the ICS is activated.</p>
                </blockquote>
                </li>
            </div>
        </div>
    <br />
    <p>When developing policies and procedures for conducting exercises at schools, consider the types of training/guidance you will provide to schools, minimum requirements for when and how trainings occur, and requirements for trainings on special skills. Also consider how the plan provides for the whole school community during exercises, how exercises will be evaluated and the related criteria, and the extent of requirements for or recommendations on how frequently community meetings should be held. Furthermore, consider the extent to which you will share lessons learned from exercises and emergency events with other schools and how schools might anticipate, respond to, and mitigate any adverse impacts of an exercise on students.
    </p>
    </p>
    <p>To support the effective execution of an exercise, work with school core planning teams to do these things:</p>
    <ul class="indented-40">

            <li>Include community partners such as <a href="#" class="bt" title="Law enforcement officers, EMS practitioners, and fire department personnel.">first responders</a>  and  local emergency management staff;</li>
            <li>Communicate information about the exercise in  advance to avoid confusion and concern;</li>
            <li>Exercise under different and nonideal conditions (e.g., times of day, weather conditions, points in the academic calendar, absence of key personnel, and various school events);</li>
            <li>Ensure consistency with  <a href="http://rems.ed.gov/docs/Glossary%20of%20Key%20Terms%208.8.2014.pdf" target="_blank">common  emergency management terminology</a>;</li>
            <li>Debrief and develop an after-action report that evaluates results, identifies gaps or shortfalls, and documents lessons learned; and</li>
            <li>Discuss how the school EOP and procedures will be modified, if needed, and specify who has responsibility to modify the plan.</li>

    </ul>
    <p>&nbsp;</p>
</div><!-- /col-half --><!-- /col-half -->
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
        <?php $this->load->view("forms/create_exercise.php"); ?>
    </div>

    <div id="subDetailDiv"></div>
</div>


<style>

    #newExerciseForm input[type='text'], #newExerciseForm select, #newExerciseForm textarea{
        min-width: 470px;
        width: 50%;
    }
</style>
<script type='text/javascript'>

    $(document).ready(function() {
        
        $( "#txtDate" ).datepicker();

        loadExercises();

        

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step6/4')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step6/2')); ?>"); //Previous

    }); // End $(document).ready function


    $(document).on('click', '#btnnew', function(e){
        $("#newDetailDiv").show();
        $('html, body').animate({scrollTop: $("#newDetailDiv").offset().top}, 'slow');
    });

    $(document).on('click', '#btncancel', function(){
        $("#newExerciseForm").trigger('reset');
        //$("#newDetailDiv").hide();
    });


    $('.accordion').find('.accordion-toggle').click(function(){
        //Expand or collapse this panel
        $(this).next().slideToggle('fast');
        //Hide the other panels
        $(".accordion-content").not($(this).next()).slideUp('fast');
    });



    function loadExercises(){

        var formData = {
            ajax    :   '1',
            param   :   'all'
        };

        $.ajax({
            url: '<?php echo(base_url('exercise/show')); ?>',
            data: formData,
            type:'POST',
            success:function(response){

                $('#subDetailDiv').html(response);

                $(".thName").each(function(index, element){
                    thNames.push($(this).text());
                });

            },
            error:function(error){
                //alert(error);
            }
        });
    }

</script>
