<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<!--to be replaced when the next button is clicked-->
<div id="topcontain">
    <div id="titlearea">
        <h1>Form a Common Framework and Define and Assign Roles and Responsibilities</h1>

    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step1_3"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>After  the planning team has been formed, the team members should form a common  framework by taking time to learn each other&rsquo;s vocabulary, command structure,  and culture. Organizational differences may affect the expectations of different  members of the planning team, so it is important to acknowledge these  differences at the start of a collaborative process. For example, schools often  operate according to an academic calendar and daily schedule that differ from a  typical business or government calendar and daily schedule. Establishing a  common understanding about different planning team members&rsquo; availability and  schedules will help to facilitate effective planning and collaboration.</p>
    <p>By  establishing a common framework, team members will also be able to communicate  more effectively with one another. One common framework that is particularly  effective in the context of school emergency management is the <a href="https://rems.ed.gov/K12NIMSImplementation.aspx" target="_blank"> National Incident Management System (NIMS)</a>. Developed by  the U.S. Department of Homeland Security, NIMS is a standardized approach used  by Federal, State, and local agencies&mdash;including K-12 schools&mdash;for responding to  emergencies. One important component of NIMS is the Incident Command System  (ICS), which clearly defines the command structure used in an emergency. School  personnel need to be trained in NIMS and their role in Incident Command in  order to more effectively work with the responders in their communities. Using  the framework of NIMS beginning in the EOP planning process will not only help  members of the planning team communicate with one another, but will also help  the team develop high-quality plans that can be clearly understood by  responders who are not members of the planning team. </p>
    <p>In  addition to forming a common framework, your planning team should take time to  define and assign roles and responsibilities for each person involved in the  development and refinement of the plan. This will help to facilitate greater  coordination among team members.</p>
</div><!-- /col-half --><!-- /col-half -->
<?php endif; ?>

<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>

<!--to be replaced when the next button is clicked-->
<div id="topcontain">
    <div id="titlearea">
        <h1>Develop a Common Framework and Define and Assign Roles and Responsibilities</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step1_3"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
  <p>After the planning team has been formed, the team members should develop a common framework by taking time to learn one another’s vocabulary, command structure, and culture. Organizational differences may affect the expectations of planning team members, so it is important to acknowledge these differences at the start of a collaborative process. For example, schools often operate according to an academic calendar and daily schedule that may differ from a typical business, state government calendar, and even the school district calendar and daily schedule. Establishing a common understanding about team members’ availability and schedules will help to facilitate effective planning and collaboration.</p>
	
    <p>By establishing a common framework, team members will also be able to communicate more effectively. One common framework that is particularly effective in the context of school emergency management is the&nbsp;<a href="https://rems.ed.gov/K12NIMSImplementation.aspx" target="_blank">National Incident Management System (NIMS)</a>. Developed by the U.S. Department of Homeland Security, NIMS is a standardized approach used by Federal, State, and local agencies—including K-12 schools—for responding to emergencies. One important component of NIMS is the Incident Command System (ICS), which clearly defines the command structure used in an emergency. School personnel need to be trained in NIMS and their role in Incident Command to help them effectively work with the responders in their communities. Using the framework of NIMS at the beginning of the EOP planning process will help members of the planning team communicate with one another, and it will help the team develop high-quality plans that can be clearly understood by responders who are not members of the planning team.</p>
    
    <p>In  addition to forming a common framework, your planning team should take time to  define and assign roles and responsibilities for each person involved in the  development and refinement of the plan. This will help to facilitate greater  coordination among team members.</p>
    <p>When developing policies and procedures to inform the common framework, consider the extent to which your district should train each school planning team on the six-step planning process, NIMS, and ICS, as well as a common set of terms and definitions.</p>
    <p>In addition to forming a common framework, planning teams should take time to define and assign roles and responsibilities for each person involved in the development and refinement of plans. This will help to facilitate greater coordination among team members.</p>
    <p>To assist school planning teams with this, you should develop relevant policies and procedures. Consider who will chair the school core planning team and who from the district will serve on the school core planning team. What are the key roles and responsibilities of school core planning teams, to what degree will the district train members on these roles and responsibilities, and how will school core planning teams assign and document roles and responsibilities? Who will be accountable for managing the operations and outcomes of the school core planning team?</p>
</div><!-- /col-half --><!-- /col-half -->

<?php endif; ?>

<script type='text/javascript'>
    $(document).ready(function() {


        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step1/4')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step1/2')); ?>"); //Previous
    });

</script>





