<?php

if($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL && $this->session->userdata('loaded_school')){

    $content_file_to_load = "home_". $step . ".php";
    include("content/".$content_file_to_load);

}elseif($this->session->userdata['role']['level']== DISTRICT_ADMIN_LEVEL){

    $content_file_to_load = "home_". $step . ".php";
    include("content/".$content_file_to_load);

    ?>

<!--
    <div class="col-half" style="text-align:center; margin-top:15%;">
        <h1 style="color:red">No school is selected. Please select a school.</h1>
    </div>


    <div id="select_school_dialog" title="Select School">
        <p style="margin-top:20px;">

            <select id="sltschool_dialog" name="sltschool_dialog" required="required"></select>
        </p>
    </div>
-->
<?php
}elseif($this->session->userdata['role']['level'] < DISTRICT_ADMIN_LEVEL && $this->session->userdata('loaded_school')){

    $content_file_to_load = "home_". $step . ".php";
    include("content/".$content_file_to_load);
    
}elseif($this->session->userdata['role']['level']< DISTRICT_ADMIN_LEVEL){

    $content_file_to_load = "home_". $step . ".php";
    include("content/".$content_file_to_load);
    ?>

    <?php if($this->session->userdata['role']['level'] == SUPER_ADMIN_LEVEL): ?>
    <div id="select_school_dialog" title="Select School">
        <p style="margin-top:20px;">

            <select id="sltschool_dialog" name="sltschool_dialog"></select>
        </p>
    </div>
    <?php endif;

}elseif($this->session->userdata['role']['level'] > DISTRICT_ADMIN_LEVEL && $this->session->userdata['loaded_school']){

    $content_file_to_load = "home_". $step . ".php";
    include("content/".$content_file_to_load);
}


?>
