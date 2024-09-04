<?php
$content_file_to_load = $page."_". $step . ".php";

if($this->session->userdata['role']['level'] <= DISTRICT_ADMIN_LEVEL ){
    if($this->session->userdata('loaded_school') && !empty($this->session->userdata['loaded_school']['id'])){
        //Do nothing
    }else{

        if($this->session->userdata['role']['level'] == SUPER_ADMIN_LEVEL ) {
            ?>


            <script>
                $(document).ready(function () {
                    $("a:not(.menuItem)").on('click', function () {
                        return false;
                    });
                });
            </script>

            <div id="select_school_dialog" title="Select School">
                <p style="margin-top:20px;">

                    <select id="sltschool_dialog" name="sltschool_dialog" required="required"></select>
                </p>
            </div>
        <?php
        }
        ?>
<?php
    }
}



include("content/".$content_file_to_load);