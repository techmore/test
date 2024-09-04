<?php
$planning_process_pages = array(
    'home', 'step1', 'step2', 'step3', 'step4', 'step5', 'step6'
);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">



        <link rel="apple-touch-icon" sizes="120x120"    href="<?php echo base_url(); ?>assets/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/img/favicon-16x16.png">
        <link rel="manifest"                            href="<?php echo base_url(); ?>assets/img/site.webmanifest">
        <link rel="mask-icon"                           href="<?php echo base_url(); ?>assets/img/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">



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
        <?php if(isset($page) && $page=='login'): ?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/front_cool.css" media="screen, projection" type="text/css"/>
            <link href="<?php echo base_url(); ?>assets/css/google_materials_icons.css" rel="stylesheet" />
            <script type="text/javascript" src='<?php echo base_url(); ?>assets/js/login.js'></script>
        <?php endif; ?>
        <script type="text/javascript" src='<?php echo base_url(); ?>assets/js/standard.js'></script>

        <?php if(isset($page) && $page=="calendar"): ?>
            <link href='<?php echo base_url(); ?>assets/css/calendar/fullcalendar.css' rel='stylesheet' />
            <link href='<?php echo base_url(); ?>assets/css/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
            <link  href='<?php echo base_url(); ?>assets/css/calendar/jquery-ui.css' rel='stylesheet' media="screen">

            <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/calendar/moment.min.js" ></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/calendar/fullcalendar.js" ></script>
        <?php endif; ?>



        <title>EOP ASSIST<?php echo isset($page_title)?': '.$page_title :'';?></title>

        <script language="JavaScript" type="text/javascript">

            // Global context variables
            var showLoadingWheel = true;
            var initialTime = Math.round(new Date().getTime()/1000); // In seconds
            var lastEvent = {name:'pageload', time:initialTime};
            var sess_expiration = <?php echo($this->config->item('sess_expiration')); ?>;
            //todo Make the promptDuration a fraction or factor of the session timeout
            var promptDuration = 30; // Seconds
            var sessionAlert = false;
            var baseURL = "<?php echo base_url(); ?>";


            $(function(){
               $(document).tooltip({
                   track:false
               });
            });

            $(document).ready(function(){

                $('#loading').hide();
                <?php if($this->config->item('sess_expiration') > 0 ): ?>
                    setInterval(pingServer, (5 * 1000), lastEvent, sess_expiration, baseURL); //Call ping function every after 5 seconds
                    setInterval(sessionExpirationAlert, (1 * 1000), lastEvent, sess_expiration, promptDuration, sessionAlert, baseURL, initialTime); // Check if session is about to expire every 1 second
                <?php endif; ?>

                var seletedToolkit = parseInt(getCookie('activeToolkit'));
                if(isNaN(seletedToolkit)){
                    seletedToolkit = false;
                }



                $("#toolkit2").accordion({
                                            icons:{'header':'ui-icon-carat-1-e', 'activeHeader':'ui-icon-carat-1-s'},
                                            heightStyle: 'content',
                                            collapsible:true,
                                            active:seletedToolkit,
                                            activate: function(event, ui){
                                                //console.log($("#toolkit2").accordion('option', 'active'));
                                                seletedToolkit = $("#toolkit2").accordion('option', 'active');
                                                setCookie('activeToolkit', seletedToolkit, 1);
                                            }
                });

                <?php
                    $nav_options = "heightStyle:'content', icons: {'header':'ui-icon-carat-1-e', 'activeHeader':'ui-icon-carat-1-s'}";
                    switch($page){
                        case 'home':
                            echo("$(\"#left_nav\").accordion({active:0, $nav_options});");
                            break;
                        case 'step1':
                            echo("$(\"#left_nav\").accordion({active:1, $nav_options});");
                            break;
                        case 'step2':
                            echo("$(\"#left_nav\").accordion({active:2, $nav_options});");
                            break;
                        case 'step3':
                            echo("$(\"#left_nav\").accordion({active:3, $nav_options});");
                            break;
                        case 'step4':
                            echo("$(\"#left_nav\").accordion({active:4, $nav_options});");
                            break;
                        case 'step5':
                            echo("$(\"#left_nav\").accordion({active:5, $nav_options});");
                            break;
                        case 'step6':
                            echo("$(\"#left_nav\").accordion({active:6, $nav_options});");
                            break;

                    }
                ?>

                // This is done to make the accordion keyboard (tab) accessible.
                $(".ui-accordion-header")
                    .attr("tabindex", 0);
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

    <?php if(isset($page) && $page=='login') {

        echo( $contents );

    }
    else{ ?>
            <div id="sb-site">
                <div id="dtool" class="5dcontain">
                    <nav aria-label="primary">
                        <?php include('embeds/main_menu.php'); ?>
                    </nav>

                    <header>
                        <?php include('embeds/sub_menu.php'); ?>
                    </header>


                    <?php if(in_array($page, $planning_process_pages)): ?>
                        <main>
                            <div class="content planning_process" id='introOneContent'>
                                <div class="row">
                                    <nav aria-label="secondary">
                                        <?php include('embeds/left_nav.php'); ?>
                                    </nav>

                                    <div class="col-middle">
                                        <?= $contents ?>
                                    </div>

                                    <div class="col-right">
                                        <aside>
                                            <?php include('embeds/toolkit/base.php'); ?>
                                        </aside>
                                    </div>

                                </div>
                            </div>
                        </main>


                        <?php else: ?>
                            <main>
                                <div class="content" id='introOneContent'>
                                    <?= $contents ?>
                                </div>
                            </main>
                    <?php endif; ?>

                </div>
                <footer>
                    <div id="footer">
                        <?php include('embeds/footer.php'); ?>
                    </div>
                </footer>
            </div>

        <?php include('embeds/sidebar.php'); ?>
        <!-- Load Dynamic javascript -->
        <?php include('embeds/dynamic_js.php'); ?>

            <!-- Import Final JS Scripts and CSS -->
            <script src="<?php echo base_url(); ?>assets/js/slidebars.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/js/jquery-impromptu.js" type="text/javascript"></script>
        <?php }
?>
        <div id="ping-data" style="display: none;"></div>

    </body>

</html>