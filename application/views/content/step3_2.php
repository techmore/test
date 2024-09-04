<?php

$stateEntities      = array();
$districtEntities   = array();
$schoolEntities     = array();

// Break the entities into groups depending on mandate
foreach($page_vars['entities'] as $key=>$entity){
    if($entity['mandate']=='state'){
        array_push($stateEntities, $entity);
    }elseif($entity['mandate']=='district'){
        array_push($districtEntities, $entity);
    }else{
        array_push($schoolEntities, $entity);
    }
}

$groupedEntities = array(
    'state'     => $stateEntities,
    'district'  => $districtEntities,
    'school'    => $schoolEntities
);

?>
<?php if($this->session->userdata['role']['level'] != DISTRICT_ADMIN_LEVEL): ?>
<?php $_title="Select Threats and Hazards to Address in the School EOP"; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Select Threats and Hazards to Address in the School EOP</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Your  team&rsquo;s first task is to review the prioritized list of threats and hazards from  Step 2 and to select the threats and hazards that your planning team chooses to  address in the school EOP. These selected threats and hazards will be carried  forward in the remaining steps of the planning process. </p>

    <p>The table below contains a summary of the threats and hazards that your planning team identified, assessed for risk, and prioritized in Step 2. Please review this content carefully to determine which threats and hazards your team will address in your school EOP. If your team needs to make any adjustments to the threats and hazards included in this table, those adjustments should be made in Step 2. Once your team has decided which threats and hazards will be addressed in the plan, you should place a checkmark in the indicated space for each selected threat and hazard.</p>
</div><!-- /col-half --><!-- /col-half -->

<?php endif; ?>

<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
<?php $_title ="Select Threats and Hazards to Address in School EOPs"; ?>
<div id="topcontain">
    <div id="titlearea">
        <h1>Select Threats and Hazards to Address in School EOPs</h1>
        
    </div>
    <!--<div id="resourcearea">
        <ul>
            <li class="sb-toggle-right" id="step3_2"><img src="<?php /*echo base_url(); */?>assets/img/resource_icon.png" alt="Resource Toolkit" /> Resource Toolkit</li>
        </ul>
    </div>-->
</div>
<div class="col-half left">
    <p>Your team’s first task is to review the prioritized list of threats and hazards from Step 2 and to select the threats and hazards that the school planning team may choose to address in the school EOP. These selected threats and hazards will be carried forward in the remaining steps of the planning process. </p>

    <p>When developing policies and procedures for this task, you should consider how to train school core planning teams on the process for selecting threats and hazards; applicable State or local requirements; the extent to which particular threats and hazards may be mandatory for inclusion in all school EOPs and the district’s guidelines for prioritizing all threats and hazards by their level of risk; and the training and technical assistance your district will provide schools on the process for doing so.</p>
</div><!-- /col-half --><!-- /col-half -->
<?php endif; ?>

<div class="col-half left">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/forms.css" />
     <h1><?php echo($_title); ?></h1>
	
	<?php if($this->session->userdata['role']['level']==DISTRICT_ADMIN_LEVEL): ?>
	<table class="thform">
		<tr>
		<td><p>The table below contains a summary of the threats and hazards that your district core planning team and school core planning team identified, assessed for risk, and prioritized in Step 2. </p>
<p>Review this content carefully to determine which threats and hazards each school will address in its school EOP. If you need to make any adjustments to the threats and hazards included in this table, those adjustments should be made in Step 2. Once your team has decided which threats and hazards will be addressed in the plan, place a checkmark in the indicated space for each selected threat and hazard.</p></td>
		</tr>
		</table>
	<p>&nbsp;</p>
		<?php endif; ?>

    <div id="selectCheckBoxDiv">
        <?php foreach($groupedEntities as $groupName => $entityGroup): ?>
            <?php if($entityGroup && count($entityGroup)>0): ?>
                <hr class="<?=($groupName=='state')? 'stateHR' : (($groupName=='district')? 'districtHR' : 'schoolHR')?>" />
                <?php if($groupName=='state') : ?>      <h2 id="stateTableTitle">   State Master List of Threats and Hazards</h2> <?php endif; ?>
                <?php if($groupName=='district') : ?>   <h2 id="districtTableTitle">School District Master List of Threats and Hazards</h2> <?php endif; ?>
                <?php if($groupName=='school') : ?>     <h2 id="schoolTableTitle">  School Customized List of Threats and Hazards</h2> <?php endif; ?>
                <table class="results threats-hazards <?=($groupName=='state')? 'stateTable' : (($groupName=='district')? 'districtTable' : 'schoolTable')?>">
                    <tr>
                        <th scope="col">Threats and Hazards</th>
                        <th scope="col">
                            <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL):?>
                                Applicable to
                            <?php else: ?>
                                Created by
                            <?php endif; ?>
                        </th>
                        <th scope="col">Address in the School EOP</th>
                    </tr>
                    <?php foreach($entityGroup as $key=>$value): ?>
                        <tr>
                            <td><?php echo $value['name']; ?></td>
                            <td>
                                <?php if($this->session->userdata['role']['level'] == STATE_ADMIN_LEVEL){
                                    echo (($value['mandate']=='state') ? 'All School EOPs in State' : 'Only Sample School EOP for State Team');
                                }else{
                                    echo("<span style='text-transform: capitalize'>".$value['mandate']."</span>");
                                }
                                ?>
                            </td>
                            <td align="center">
                                <?php

                                        $attr = ($value['description'] == 'live' ) ? "checked='checked'": "";

                                if($value['mandate'] == 'state' && $this->session->userdata['role']['level'] > STATE_ADMIN_LEVEL){
                                    ?>
                                        <input aria-label="address in school EOP" type="checkbox" disabled="disabled" <?php echo(($this->session->userdata['role']['read_only']=='n')? '':'disabled="disabled"'); ?> class="checkBoxSelection" <?php echo $attr; ?> name="<?php echo $value['id'];?>" id="<?php echo $value['id'];?>" value="<?php echo $value['id']; ?>"/>
                                        <?php


                                }elseif($value['mandate'] == 'district' && $this->session->userdata['role']['level'] > DISTRICT_ADMIN_LEVEL){

                                        ?>
                                        <input aria-label="address in school EOP" type="checkbox"  disabled="disabled" <?php echo(($this->session->userdata['role']['read_only']=='n')? '':'disabled="disabled"'); ?> class="checkBoxSelection" <?php echo $attr; ?> name="<?php echo $value['id'];?>" id="<?php echo $value['id'];?>" value="<?php echo $value['id']; ?>"/>
                                        <?php

                                }else{
                                    ?>
                                        <input aria-label="address in school EOP" type="checkbox"  <?php echo(($this->session->userdata['role']['read_only']=='n')? '':'disabled="disabled"'); ?> class="checkBoxSelection" <?php echo $attr; ?> name="<?php echo $value['id'];?>" id="<?php echo $value['id'];?>" value="<?php echo $value['id']; ?>"/>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function() {

        $("a#rightArrowButton").attr("href", "<?php echo(base_url('plan/step3/3')); ?>"); //Next

        $("a#leftArrowButton").attr("href", "<?php echo(base_url('plan/step3/1')); ?>"); //Previous

        $("#rightArrowButton").click(function(){

            var data = $.map($("input:checkbox.checkBoxSelection:checked"), function(value, index) {
                return [$(value).val()];
            });

            setSelectedThs(data);
            //return false;
        });

        $(".checkBoxSelection").change(function(){
            var value = null;
            var THid = $(this).val();

            if($(this).is(":checked")){
                value = 1;
            }
            else{
                value = 0;
            }

            updateSelectedTh(THid, value);
        });

        function updateSelectedTh(id, value){
            var formData = {
                'ajax'  :       '1',
                'THid' :       id,
                'value':    value
            }

            $.ajax({
                url: '<?php echo(base_url('plan/updateSelectedTH')); ?>',
                data: formData,
                type:'POST',
                async: false, // Prevents page from navigating to other page before ajax call completes
                success:function(response){
                    try{
                        var res = JSON.parse(response);
                        if(res.set==true){
                            //alert(response);
                        }
                        else{
                            alert("No Threats and Hazards Selected");
                        }
                    }
                    catch(err){
                        //alert("Remote Server error! " + err.message);
                    }
                }
            });
        }

        function setSelectedThs(data){

            var formData = {
                'ajax'  :       '1',
                'THids' :       data
            }

            $.ajax({
                url: '<?php echo(base_url('plan/setSelectedTHs')); ?>',
                data: formData,
                type:'POST',
                async: false, // Prevents page from navigating to other page before ajax call completes
                success:function(response){
                    try{
                        var res = JSON.parse(response);
                         if(res.set==true){
                             //alert(response);
                         }
                         else{
                            alert("No Threats and Hazards Selected");
                         }
                    }
                    catch(err){
                        //alert("Remote Server error! " + err.message);
                    }
                }
            });
        }


    }); // End $(document).ready function

</script>
