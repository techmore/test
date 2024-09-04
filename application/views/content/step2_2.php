<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Develop a Comprehensive List of Possible Threats and Hazards Using a Variety of Data Sources</h1>
        
    </div>
   <!-- <div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step2_2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Your  team&rsquo;s first task is to develop a comprehensive list of threats and hazards by  consulting a variety of data sources. Different data sources that may provide  information on threats and hazards in your school and community are as follows:</p>

        <ul>
            <li><strong>Data  from school and district assessments.</strong> Your school and/or district  should regularly conduct assessments to learn information about safety and  security in your school. The data generated from each of the following types of  assessments may provide critical information about threats and hazards in your  school community. Click on each assessment below to learn about these different  types of assessments. </li>
        </ul>


       


            <div class="accordion">
                <div class="accordion-toggle">
                    <ul class="indented-70">

                                <li><a href="#">Site Assessment</a></li>

                    </ul>
                </div>
                <div class="accordion-content default">
                    <blockquote>
                        <blockquote>
                            <blockquote>
                                <p><strong>Description:</strong> A site assessment examines the safety, accessibility, and emergency preparedness of the school’s buildings and grounds. This assessment includes, but is not limited to, the following: a review of building access and egress control measures, visibility around the exterior of the building, structural integrity of the building, compliance with applicable architectural standards for individuals with disabilities and other access and functional needs, and emergency vehicle access.</p>
                                <p><strong>Purpose:</strong> To increase understanding of the potential impact of threats and hazards on the school buildings and grounds; the risks and vulnerabilities of the school buildings and grounds; and which facilities are physically accessible to students, staff, parents, volunteer workers, and emergency response personnel with disabilities (and thus are in compliance with the law).</p>
                            </blockquote>
                        </blockquote>
                    </blockquote>
                </div>
            </div>

            <div class="accordion">
                <div class="accordion-toggle">
                    <ul class="indented-70">

                                <li><a href="#">Culture and Climate Assessment </a></li>

                    </ul>
                </div>
                <div class="accordion-content default">
                    <blockquote>
                        <blockquote>
                            <blockquote>
                                <p><strong>Description:</strong> In schools with positive climates, students are more likely to feel connected to adults and their peers. This fosters a nurturing environment where students are more likely to succeed, feel safe, and report threats. A school culture and climate assessment evaluates student and staff connectedness to the school as well as problem behaviors. For example, this assessment may reveal a high number of bullying incidents, indicating a need to implement an anti-bullying program. If a student survey is used to assess culture and climate, student privacy must be protected. A range of school personnel can assist in the assessment of culture and school climate, including school counselors and mental health staff.</p>
                                <p><strong>Purpose:</strong> To gain knowledge of students’ and staff members’ perceptions of their safety and of problem behaviors that need to be addressed to improve school climate.</p>
                            </blockquote>
                        </blockquote>
                    </blockquote>
                </div>
            </div>


            <div class="accordion">
                <div class="accordion-toggle">
                    <ul class="indented-70">

                                <li><a href="#">School Threat Assessment</a></li>

                    </ul>
                </div>
                <div class="accordion-content default">
                    <blockquote>
                        <blockquote>
                            <blockquote>
                                <p><strong>Description:</strong> A school threat assessment analyzes communication and behaviors to determine whether or not a student, staff member, or other person may pose a threat. These assessments must be based on fact; must comply with applicable privacy, civil rights, and other applicable laws; and are often conducted by multidisciplinary threat assessment teams. While a planning team may include the creation of a threat assessment team in its plan, the assessment team is a separate entity from the planning team and meets on its own regular schedule.</p>
                                <p><strong>Purpose:</strong> To identify students, staff, or other persons who may pose a threat--before the threat develops into an incident--and to refer those individuals for services, if appropriate.</p>
                            </blockquote>
                        </blockquote>
                    </blockquote>
                </div>
            </div>

            <div class="accordion">
                <div class="accordion-toggle">
                    <ul class="indented-70">

                                <li><a href="#">Capacity Assessment </a></li>

                    </ul>
                </div>
                <div class="accordion-content default">
                    <blockquote>
                        <blockquote>
                            <blockquote>
                                <p><strong>Description:</strong> The planning team needs to know what resources will be at its disposal. A capacity assessment examines the capabilities of students and staff as well as the services and material resources of community partners. This assessment is used to identify people in the building with applicable skills (e.g., first aid certification, search and rescue training, counseling and mental health expertise, ability to assist individuals with disabilities and others with access and functional needs). Equipment and supplies should also be inventoried. The inventory should include an evaluation of equipment and supplies uniquely for individuals with disabilities, such as evacuation chairs, the availability of sign language interpreters and technology used for effective communication, accessible transportation, and consumable medical supplies and durable medical equipment that may be necessary during a shelter-in-place or evacuation.</p>
                                <p><strong>Purpose:</strong> To have an increased understanding of the resources available. Information about staff capabilities will help planners assign roles and responsibilities in the plan. </p>
                            </blockquote>
                        </blockquote>
                    </blockquote>
                </div>
            </div>



        <ul>
            <li><strong>Information  from local, State, and Federal partners.</strong> Your planning team should  reach out to <a href="#" class="bt" title="Examples of local and county agencies include: emergency management offices, fire and police departments, local organizations and community groups (e.g., local chapter of the American Red Cross, Community Emergency Response Team), and utility companies.">local</a>, <a href="#" class="bt" title="Examples of State agencies include: Department of Education (SEA), Department of Homeland Security and/or Emergency Management, Fire Marshal, Department of Health, and State Police.">State</a>,  and <a href="#" class="bt" title="Examples of Federal agencies include: U.S. Department of Homeland Security and FEMA; U.S. Department of Justice and FBI; U.S. Department of Education; U.S. Department of Health and Human Services; the National Oceanic and Atmospheric Administration (NOAA); and U.S. Geological Survey.">Federal</a>  agencies for information about historical threats and hazards faced by the  surrounding community. </li>
        </ul>

        <ul>
            <li><strong>Information  from the school community.</strong> Your planning team should reach out to  the broader school community to identify any additional threats and hazards  that the school and surrounding community have faced in the past or may face in  the future.</li>
        </ul>




</div><!-- /col-half --><!-- /col-half -->

<?php endif; ?>

<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Identify Threats and Hazards</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step2_2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Your team&rsquo;s first task is to develop a districtwide master list of threats and hazards. To identify the universe of hazards and threats that may face any school in the district, your planning team should reach out to&nbsp;<a href="#" class="bt" title="Examples of local and county agencies include: emergency management offices, fire and police departments, local organizations and community groups (e.g., local chapter of the American Red Cross, Community Emergency Response Team), and utility companies.">local</a>,&nbsp;<a class="bt" href="#" title="Examples of State agencies include: Department of Education (SEA), Department of Homeland Security and/or Emergency Management, Fire Marshal, Department of Health, and State Police.">State</a>, and&nbsp;<a class="bt" href="#" title="Examples of Federal agencies include: U.S. Department of Homeland Security and FEMA; U.S. Department of Justice and FBI; U.S. Department of Education; U.S. Department of Health and Human Services; the National Oceanic and Atmospheric Administration (NOAA)">Federal</a> agencies for historical information and forecasts. You may choose to designate certain threats and hazards as mandatory for inclusion in every school EOP, drawing from weather patterns, unique geographical vulnerabilities, and State and local mandates.</p>
    <p>When developing policies and procedures for identifying hazards and threats, consider what type of training the district will provide to schools, how the district will identify the universe of threats and hazards, the extent to which the district will require certain hazards and threats to be addressed in EOPs, how regularly the district will update its districtwide master list, how regularly schools will update their customized lists, and how the district and/or schools will identify new and emerging hazards and threats over time.</p>
	<p>
After you have established a master list of threats and hazards facing all schools in your district, work with each school to develop a site-specific list of threats and hazards based on individual school-level assessments. Designate a representative from your district to participate in school assessments, which should be conducted regularly to glean information about safety and security at each school. The data generated from the following types of assessments may provide critical information about threats and hazards in a school community. Click on each assessment below to learn about these different types of assessments.
    
       </p>

        <ul>


            <div class="accordion">
                <div class="accordion-toggle">
                    <ul class="indented-70">

                                <li><a href="#">Site Assessment</a></li>

                    </ul>
                </div>
                <div class="accordion-content default">
                    <blockquote>
                        <blockquote>
                            <blockquote>
                                <p><strong>Description:</strong> A site assessment examines the safety, accessibility, and emergency preparedness of the school&rsquo;s buildings and grounds. This assessment includes, but is not limited to, the following: a review of building access and egress control measures, visibility around the exterior of the building, structural integrity of the building, compliance with applicable architectural standards for individuals with disabilities and other access and functional needs, and emergency vehicle access.</p>
                                <p><strong>Purpose:</strong> To increase understanding of the potential impacts of threats and hazards on the school buildings and grounds; the risks and vulnerabilities of the school buildings and grounds; and which facilities are physically accessible to students, staff, parents, volunteer workers, and emergency response personnel with disabilities (and thus comply with the law).</p>
                            </blockquote>
                        </blockquote>
                    </blockquote>
                </div>
            </div>

            <div class="accordion">
                <div class="accordion-toggle">
                    <ul class="indented-70">

                                <li><a href="#">Culture and Climate Assessment </a></li>

                    </ul>
                </div>
                <div class="accordion-content default">
                    <blockquote>
                        <blockquote>
                            <blockquote>
                                <p><strong>Description:</strong> In schools with positive climates, students are more likely to feel connected to adults and their peers. In a nurturing environment, students are more likely to succeed, feel safe, and report threats. A school culture and climate assessment evaluates student and staff connectedness to the school as well as problem behaviors. For example, this assessment may reveal a high number of bullying incidents, indicating a need to implement an antibullying program. If a student survey is used to assess culture and climate, student privacy must be protected. A range of school personnel can assist in the assessment of culture and school climate, including school counselors and mental health staff.</p>
                                <p><strong>Purpose:</strong> To gain knowledge of students’ and staff members’ perceptions of their safety and of problem behaviors that need to be addressed to improve school climate.</p>
                            </blockquote>
                        </blockquote>
                    </blockquote>
                </div>
            </div>


            <div class="accordion">
                <div class="accordion-toggle">
                    <ul class="indented-70">

                                <li><a href="#">School Threat Assessment</a></li>

                    </ul>
                </div>
                <div class="accordion-content default">
                    <blockquote>
                        <blockquote>
                            <blockquote>
                                <p><strong>Description:</strong> A school threat assessment analyzes communication and behaviors to determine whether a student, staff member, or other person may pose a threat. These assessments must be based on fact; must comply with applicable privacy, civil rights, and other applicable laws; and are often conducted by multidisciplinary threat assessment teams. While a planning team may include the creation of a threat assessment team in its plan, the assessment team is a separate entity from the planning team and meets on its own regular schedule.</p>
                                <p><strong>Purpose:</strong> To identify students, staff members, or other persons who may pose a threat—before the threat develops into an incident—and to refer those individuals for services, if appropriate.</p>
                            </blockquote>
                        </blockquote>
                    </blockquote>
                </div>
            </div>

            <div class="accordion">
                <div class="accordion-toggle">
                    <ul class="indented-70">

                                <li><a href="#">Capacity Assessment </a></li>
                            
                    </ul>
                </div>
                <div class="accordion-content default">
                    <blockquote>
                        <blockquote>
                            <blockquote>
                                <p><strong>Description:</strong> The planning team needs to know what resources will be at its disposal. A capacity assessment examines the capabilities of students and staff as well as the services and material resources of community partners. This assessment is used to identify people in the building with applicable skills (e.g., first aid certification, search and rescue training, counseling and mental health expertise, ability to assist individuals with disabilities and others with access and functional needs). Equipment and supplies should also be inventoried. The inventory should include an evaluation of equipment and supplies uniquely for individuals with disabilities, such as evacuation chairs, the availability of sign language interpreters and technology used for effective communication, accessible transportation, and consumable medical supplies and durable medical equipment that may be necessary during a shelter-in-place or evacuation.</p>
                                <p><strong>Purpose:</strong> To have an increased understanding of the resources available. Information about staff capabilities will help planners assign roles and responsibilities in the plan. </p>
                            </blockquote>
                        </blockquote>
                    </blockquote>
                </div>
            </div>

        </ul>
  </ul>

<p>To help schools perform effective and meaningful assessments, your district should confirm which assessments are required or optional and determine which assessment tool(s) schools should use. Document this information in the district’s policies and procedures for performing assessments, and state which assessments require the involvement of district personnel, the frequency at which they will be conducted, how schools will conduct assessments, which community partners will participate, how assessment data will be used, and the types of training required</p>

</div><!-- /col-half --><!-- /col-half -->
<?php endif; ?>

<div class="col-half left">
    <div style="display: none;" id="dynamic-message">

    </div>
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
    <?php
    $this->load->view("forms/th.php");
    ?>

    <!--<hr style="border-top: dotted 1px; color: #A5A5A5" />-->

    <div id="subDetailDiv"></div>

</div>

<script type='text/javascript'>
    $(document).ready(function() {

        var thNames = [""];

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step2/3')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step2/1')); ?>"); //Previous
        

        $('.accordion').find('.accordion-toggle').click(function(){
            //Expand or collapse this panel
            $(this).next().slideToggle('fast');
            //Hide the other panels
            $(".accordion-content").not($(this).next()).slideUp('fast');
        });


        // Threat and Hazard Management Functionality

        //Load list of available threats and hazards
        loadThreatsAndHazards();

        function submit_thManagementForm(){

            <?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL && ( !$this->session->userdata('loaded_school') || empty($this->session->userdata['loaded_school']['id'])) ): ?>


                if($("#checkbox_th_mandate").is(':checked')){
                    // DO NOTHING
                }else{
                    alert("Please select the appropriate school in the School dropdown menu in the Navigation bar.");
                    return false;
                }

            <?php endif; ?>

            var formData ={
                ajax        :       '1',
                thname      :       $('#txtth').val()
                <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL || $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
                , thmandate   :       $('#checkbox_th_mandate').is(":checked") ? $('#checkbox_th_mandate').val() : 'school'
                <?php endif; ?>
            };

            $.ajax({
                url: '<?php echo(base_url('plan/add/entity/th')); ?>',
                data: formData,
                type:'POST',
                success:function(response){

                    try {
                        var res = JSON.parse(response);
                        if (res.saved == true) {

                            $("#dynamic-message").html("<div id='errorDiv'> <div class='notify notify-green'> <span class='symbol icon-tick'></span>&nbsp;&nbsp;  Data was saved successfully! </div> </div>").show();

                            clearFormInputFields(); // Clear form data from the fields
                            loadThreatsAndHazards();
                        }
                        else {
                            alert("Error creating Threat and Hazard, check your network connection and try again!");
                        }
                    }catch(err){
                        alert('Error: '+err);
                    }
                },
                error:function(error){
                    alert(error);
                }
            });

            return false;
        }

        $("#thManagementForm").validate({
            submitHandler: submit_thManagementForm,
            rules: {
                txtth:{
                    notIn: function(){ return thNames; }
                }
            }
        });

        $.validator.addMethod("notIn", function(value, element, params) {
                return ! (params.indexOf(value) > -1);
            }, "A Thread or hazard with this name already exists."
        );


        function loadThreatsAndHazards(){

            var formData = {
                ajax    :   '1',
                param   :   'all'
            };

            $.ajax({
                url: '<?php echo(base_url('plan/showTh')); ?>',
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

        function clearFormInputFields(){
            $('#txtth').val('');
            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL || $this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
                $('#checkbox_th_mandate').attr('checked', false);
            <?php endif; ?>
        }

        $("#btnreset").click(function(){
            $("#txtth").removeClass('error');
            $("#txtth-error").remove();
        });

    }); // End $(document).ready function

</script>
