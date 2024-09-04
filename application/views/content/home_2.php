<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
    <!--to be replaced when the next button is clicked-->
    <div id="topcontain">
        <div id="titlearea">
            <h1>How Teams Can Use EOP ASSIST</h1>

        </div>
        <!--<div id="resourcearea">
            <ul>
                <li class="sb-toggle-right" id="intro2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
            </ul>
        </div>-->
    </div>
    <div class="col-half left">
        <p>As lessons learned from experience indicate that operational planning is best performed by a team, Federal guidance recommends that schools assemble collaborative planning teams to work through the process of developing school EOPs. To encourage collaboration among team members, EOP ASSIST has been designed to allow multiple members from a team to use the tool. Suggestions for how teams might use the tool are outlined below. </p>
        <p><strong>Suggestions for using EOP ASSIST as a team</strong>:</p>
        <ul class="indented-70" >
            
                    <li>Assemble a preliminary planning team.</li>
                    <li>Review EOP ASSIST as a team to understand the nature of this tool.</li>
                    <li>Decide how your team will use EOP ASSIST. Because EOP ASSIST allows multiple users to input plan information for each school site, your team will need to decide how to record your plan information into the tool. Will your team select one person to record plan information, or will multiple people record plan information?</li>
                    <li>Coordinate your team&rsquo;s efforts in using EOP ASSIST. If your team decides that multiple people will input information into EOP ASSIST, then your team should identify roles and responsibilities for each person on the team who is using the tool. Additionally, multiple users should coordinate their efforts so that one user does not accidentally change another user&rsquo;s work.</li>

        </ul>
    </div><!-- /col-half --><!-- /col-half -->
    <!--end to be replaced content-->
<?php endif; ?>

<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<!--to be replaced when the next button is clicked-->
    <div id="topcontain">
        <div id="titlearea">
            <h1>How Teams Can Use EOP ASSIST</h1>

        </div>
        <!--<div id="resourcearea">
            <ul>
                <li class="sb-toggle-right" id="intro2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
            </ul>
        </div>-->
    </div>
    <div class="col-half left">
        <p>Lessons learned from experience indicate that operational planning is best performed by a team, and Federal guidance recommends that schools assemble collaborative planning teams to work through the process of developing school EOPs. Furthermore, it is recommended that districts assemble core planning teams to facilitate the development of school EOPs. Your responsibilities in this process include coordinating with schools and community partners, providing planning parameters for use by your schools, and supporting your schools at each step in the school EOP development process. </p>
        <p>To encourage collaboration among team members, EOP ASSIST has been designed to allow multiple members from a team to use the tool. Suggestions for how teams might use the tool are outlined below.</p>
        <p><strong>Suggestions for using EOP ASSIST as a team</strong>:</p>
        <ul class="indented-70" >

                    <li>Assemble a core planning team at the district level.</li>
                    <li>Review EOP ASSIST as a team to understand the nature of this tool.</li>
                    <li>Decide how your team will use EOP ASSIST. Because EOP ASSIST allows multiple users to input plan information, your team will need to decide how to record your plan information into the tool
					<ul>
						<li>Will your team select one person to record plan information, or will multiple people record plan information?</li>
						<li>For steps that require the creation of “master lists” (e.g., of the universe of threats and hazards that may impact all schools in your district), who will be responsible for updating the list and notifying schools of any newly identified threats and hazards?</li>
					</ul>
					</li>
                    <li>Coordinate your team's efforts in using EOP ASSIST. If your team decides that multiple people will input information into EOP ASSIST, then your team should identify roles and responsibilities for each person on the team who is using the tool. Additionally, multiple users should coordinate their efforts so that one user does not accidentally change another user’s work.</li>
                    <li>Determine how schools in your district will begin using EOP ASSIST. Again, it is important for district core planning teams to conduct their work <em>before </em>school core planning teams.</li>

        </ul>
    </div><!-- /col-half --><!-- /col-half -->
    <!--end to be replaced content-->
<?php endif; ?>

<script type='text/javascript'>
    $(document).ready(function(){

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('home/step/3')); ?>");

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('home/step/1')); ?>");

    });
</script>