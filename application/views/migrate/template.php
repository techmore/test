<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <?php $this->load->view('embeds/disclaimer'); ?>
        
        <!-- **** Load JS and CSS Libraries ****** -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/modernizr.custom.15150.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/accordion.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.form.js" ></script>


        <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/jquery-impromptu.css" rel="stylesheet" media="all" type="text/css"  />

        <!-- **** Load App specific JS and CSS ****** -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slidebars.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tooltip.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/print.css" media="print" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/front_cool.css" media="screen, projection" type="text/css"/>

        <script type="text/javascript" src='<?php echo base_url(); ?>assets/js/standard.js'></script>


        <title>EOP Assist <?php echo isset($page_title)?': '.$page_title :'Data Migration';?></title>

        <script language="JavaScript" type="text/javascript">
            $(document).ready(function(){

                $('#loading').hide();

            })
                .ajaxStart(function(){
                    $('#loading').show();
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
                        <p class="logotxt" style="text-align: center; font-size: 20px; width:90%">EOP ASSIST - <?php echo($page_title);?></p>
                    </div>
                    <div class="content" id='introOneContent'>
                        <?= $contents ?>
                    </div>
                </div>
                <div id="footer">
                    <div id="logo">
                        <img src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png" class="logo" />
                        <p class="DOEcr">2017 &copy; United States Department of Education</p>
                    </div>
                </div>
            </div>


    </body>

</html>