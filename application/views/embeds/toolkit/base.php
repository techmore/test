<?php
/**
 * Created by PhpStorm.
 * User: godfreymajwega
 * Date: 8/4/21
 * Time: 6:50 PM
 */

include_once 'resources.php';

?>

<h1>Resource Toolkit </h1>
<div class="toolkit-container">
    <div id="toolkit2">
        <?php

            if($page && $step){

                include('toolkit_'. $page . '_' . $step . '.php');

            }

        ?>
    </div>
</div>
