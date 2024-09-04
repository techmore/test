<?php
/**
 * Main Menu Embedded into most pages for navigation
 */
?>
<div id="menu_row">

    <div class="menu-container">
        <div id="menudiv">

            <img src="<?php echo base_url();?>assets/img/eopassistlogo.png" alt="EOP Assist Logo" title="EOP Assist" />
            <!--
            <ul>
                <li class="sb-toggle-left">MENU</li>
            </ul>
            -->

        </div>


        <div id="rightcontain">
            <div id="listdiv" style="padding-botton: 5px;">
                <ul class="ld">
                    <?php if($this->session->userdata['role']['level']<= DISTRICT_ADMIN_LEVEL):  ?>
                        <?php if($this->session->userdata['role']['level']!= STATE_ADMIN_LEVEL):  ?>
                            <li>
                            <span id="subDistrictSelectionDiv">
                                <label for="slctsubdistrictselection"><a href="#">School:</a>  </label>
                                        <select name="slctsubdistrictselection" id="slctsubdistrictselection" style="width:25%">
                                            <option value="" selected="selected">--Select--</option>
                                        </select>
                            </span>
                            </li>
                        <?php endif; ?>
                    <?php elseif($this->session->userdata['role']['level']>DISTRICT_ADMIN_LEVEL):  ?>
                        <!--<li>
                        <span><?php /*echo($this->session->userdata['loaded_school']['name']); */?></span>
                    </li>-->
                    <?php else: ?>

                    <?php endif; ?>
                    <li><a class="menuItem" href="<?php echo base_url(); ?>home" >Home</a></li>
                    <li><a class="menuItem <?=($page=='account') ? 'live':''?>"  href="<?php echo base_url(); ?>user/profile" >My Account</a></li>
                    <li><a class="menuItem <?=($page=='calendar') ? 'live':''?>"  href="<?php echo base_url(); ?>calendar">Calendar</a></li>
                    <li><a class="menuItem <?=(in_array($page, $planning_process_pages)) ? 'live':''?>"  href="<?php echo base_url(); ?>plan">Planning Process</a></li>
                    <li><a class="menuItem <?=($page=='myeop') ? 'live':''?>"  href="<?php echo base_url(); ?>report" id="reportManagementLink">My EOP</a></li>
                    <!--<li><a class="menuItem"  href="<?php echo base_url(); ?>files" id="filesLink">Files</a></li>-->
                    <?php if($this->session->userdata['role']['level']<SCHOOL_USER_LEVEL):  ?>
                        <li><a class="menuItem <?=($page=='users') ? 'live':''?>"  href="<?php echo base_url(); ?>user" id="userManagementLink">Management</a></li>
                    <?php endif; ?>
                    <li><a class="menuItem"  href="<?php echo base_url(); ?>login/signout" id="logoutLink">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

</div>