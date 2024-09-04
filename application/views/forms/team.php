<?php
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/forms.css" />
<?php if($this->session->userdata['role']['read_only']=='n'): ?>
<?php if($this->session->userdata['role']['level'] == DISTRICT_ADMIN_LEVEL): ?>
    <h1>Form a School Core Planning Team</h1>
<?php else: ?>
<h1>Create New Team Member</h1>
<?php endif; ?>

    <!-- <a href="#.php" id="hideTeamManagementFormLinkId"></a> -->

    <?php
    echo form_open('team/add', array('class'=>'teamManagementForm', 'id'=>'teamManagementForm'));
    ?>

        <fieldset>

            <table class="tmform">

                <tr>
					<?php if($this->session->userdata['role']['level']!= DISTRICT_ADMIN_LEVEL){ ?>
                    <td colspan="2">
                        <p>Please  use the form below to identify members of your school&rsquo;s   collaborative planning  team as well as the stakeholder category or   categories which they represent. If  your school&rsquo;s planning team does   not include sufficient representation from  various stakeholder groups   in the community (that may be involved in an  emergency before, during,   or after an incident), the core planning team may  want to consider   adding additional members to the collaborative planning team. </p>
                        <p>You will need to add  each team member one by one into   the form below. To add a team member into EOP  ASSIST, please type that person&rsquo;s name and contact information into the corresponding  fields and   then check the appropriate boxes designating the stakeholder categories that the team member represents. You may check more than one   box for  each team member. Click the Save button to record information for each   team member, and  then repeat this process as many times as necessary to   add all members of the  planning team into EOP ASSIST.</p>

                    </td>
					<?php }else{?>
					<td colspan="2">
                        <p>Use the form below to identify members of each school&rsquo;s collaborative planning team and the stakeholder categories they represent. If planning teams do not include sufficient representation from various community stakeholder groups (ones that may be involved in an emergency before, during, or after an incident), you may want to add members to the team.</p>
<p>You will need to add each team member into EOP ASSIST using the form below. Type each person&rsquo;s name and contact information into the corresponding fields and then check the appropriate boxes to designate the stakeholder categories the people represent. You may check more than one box for each team member. Click Save to record the information, then repeat the process as many times as necessary to add all members of the planning team.</p>
<p>If you wish to modify information about a planning team member, click Edit for the chosen team member in the table below. Pre-populated fields will appear with previously saved information. After editing the fields with new information, click Save. To remove a team member from the list, click Delete. You will be asked to confirm this deletion. Click Yes to confirm or Cancel if you pressed Delete in error. <strong>Deleting team members from this table does not affect users&rsquo; access to EOP ASSIST.</strong></p>

                    </td>
					<?php } ?>
                </tr>
                <tr>
                    <td class="txtb"><label for="txtname">Name:</label></td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtname',
                            'id'        =>  'txtname',
                            'required'  =>  'required',
                            'minlength'  =>  '3',
                            'size'      =>   '70'
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtb"><label for="txttitle">Title:</label></td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txttitle',
                            'id'        =>  'txttitle',
                            'required'  =>  'required',
                            'minlength'  =>  '3',
                            'size'      =>   '70'
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtb"><label for="txtorganization">Organization:</label></td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtorganization',
                            'id'        =>  'txtorganization',
                            'required'  =>  'required',
                            'minlength'  =>  '3',
                            'size'      =>   '70'
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtb"><label for="txtemail">Email:</label></td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtemail',
                            'id'        =>  'txtemail',
                            'required'  =>  'required',
                            'minlength' =>  '3',
                            'type'      =>  'email',
                            'size'      =>  '70'
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtb"><label for="txtphone">Phone:</label></td>
                    <td>
                        <?php
                        $inputAttributes = array(
                            'name'      =>  'txtphone',
                            'id'        =>  'txtphone',
                            'size'      =>  '70',
                            'type'      =>  'tel'
                        );
                        echo form_input($inputAttributes);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtb">Stakeholder Category:</td>
                    <td>
                        <table class="sctable">
                            <tr>
                                <td>
                                    <?php
                                        $inputAttributes = array(
                                            'name'      =>  'interests[]',
                                            'value'     =>  'School District/LEA',
                                            'checked'   =>  FALSE,
                                            'id'        =>  'checkbox1',
                                            'class'     =>  'interestChkBox'
                                        );
                                    echo form_checkbox($inputAttributes);
                                    ?>
                                    <label for="checkbox1">School District/LEA</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $inputAttributes = array(
                                        'name'      =>  'interests[]',
                                        'value'     =>  'School Community',
                                        'checked'   =>  FALSE,
                                        'id'        =>  'checkbox2',
                                        'class'     =>  'interestChkBox'
                                    );
                                    echo form_checkbox($inputAttributes);
                                    ?>
                                    <label for="checkbox2">School Community</label>
                                </td>
                            </tr>
                            <tr>
                            <td>
                                <?php
                                $inputAttributes = array(
                                    'name'      =>  'interests[]',
                                    'value'     =>  'Diverse Interests of Whole School Community',
                                    'checked'   =>  FALSE,
                                    'id'        =>  'checkbox3',
                                    'class'     =>  'interestChkBox'
                                );
                                echo form_checkbox($inputAttributes);
                                ?>
                                <label for="checkbox3"> Diverse Interests of Whole School Community</label>
                            </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $inputAttributes = array(
                                        'name'      =>  'interests[]',
                                        'value'     =>  'Local Community Partner',
                                        'checked'   =>  FALSE,
                                        'id'        =>  'checkbox4',
                                        'class'     =>  'interestChkBox'
                                    );
                                    echo form_checkbox($inputAttributes);
                                    ?>
                                   <label for="checkbox4"> Local Community Partner</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $inputAttributes = array(
                                        'name'      =>  'interests[]',
                                        'value'     =>  'State Department of Education/SEA',
                                        'checked'   =>  FALSE,
                                        'id'        =>  'checkbox5',
                                        'class'     =>  'interestChkBox'
                                    );
                                    echo form_checkbox($inputAttributes);
                                    ?>
                                    <label for="checkbox5"> State Department of Education/SEA</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $inputAttributes = array(
                                        'name'      =>  'interests[]',
                                        'value'     =>  'State Community Partner',
                                        'checked'   =>  FALSE,
                                        'id'        =>  'checkbox6',
                                        'class'     =>  'interestChkBox'
                                    );
                                    echo form_checkbox($inputAttributes);
                                    ?>
                                    <label for="checkbox6"> State Community Partner</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $inputAttributes = array(
                                        'name'      =>  'interests[]',
                                        'value'     =>  'Additional Partner',
                                        'checked'   =>  FALSE,
                                        'id'        =>  'checkbox7',
                                        'class'     =>  'interestChkBox'
                                    );
                                    echo form_checkbox($inputAttributes);
                                    ?>
                                    <label for="checkbox7"> Additional Partner</label>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left">
                    </td>
                    <td  align="left">
                        <?php
                        $attributes = array(
                            'name'  =>  'btnsave',
                            'value' =>  'Save',
                            'id'    =>  'btnsave',
                            'style' =>  ''
                        );
                        ?>
                        <?php echo form_submit($attributes); ?>

                        <input name="btncancel" value="Reset"  id="btncancel" style="" type="reset" >

                    </td>
                </tr>
            </table>
        </fieldset>
    <?php
    echo form_close();
    ?>

<?php endif; ?>
