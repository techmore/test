<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <?php $this->load->view('embeds/disclaimer'); ?>

    <!-- **** Load JS and CSS Libraries ****** -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/modernizr.custom.15150.js" ></script>


    <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">

    <!-- **** Load App specific JS and CSS ****** -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/print.css" media="print" type="text/css" />


    <title>EOP ASSIST<?php echo isset($page_title)?': '.$page_title :'Database Updates';?></title>

    <script language="JavaScript" type="text/javascript">

        // Global context variables
        var showLoadingWheel = true;

        $(document).ready(function(){

            $('#loading').hide();

        })
            .ajaxStart(function(){

                if(showLoadingWheel){
                    $('#loading').show();
                }
                showLoadingWheel = true;
            })
            .ajaxStop(function(){
                $('#loading').hide();
            });

    </script>

</head>

<body>
    <div id='loading'><img alt="loading" src="<?php echo base_url(); ?>assets/img/loading.gif"><span>Loading...</span></div>


    <div id="sb-site">
        <div id="dtool" class="5dcontain">
            <div id="menu_row">
                <h1 class="logotxt" style="text-align: center; color:#FFF; padding-top:12px;font-size: 20px; width:90%">EOP ASSIST 5.0 - <?php echo($page_title);?></h1>
            </div>
            <div id="step_row">
                <div id="step_title" style="width:auto; padding:0px 10px 0px 10px; height: auto;">
                    <h2><?php echo(isset($step_title)? $step_title: 'Installing Required Updates'); ?></h2>
                </div>
            </div>
            <div class="content" id='introOneContent'>
                <?= $contents ?>
            </div>
        </div>
        <div id="footer">
            <div id="logo">
                <img src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png" class="logo" />
                <p class="DOEcr"><?php echo(date('Y')); ?> &copy; United States Department of Education</p>
            </div>
        </div>
    </div>

</body>

</html>