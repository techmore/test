<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <?php $this->load->view('embeds/disclaimer'); ?>

        <title><?php echo($title); ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/install_cool.css" media="screen, projection" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cpstyle.css" type="text/css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>

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

    <div id="container">
            <h1 class="logotxt"><?php echo($title);?></h1>
            <fieldset id="signin_menu">


                <p class="logintxttop">Thank you for using the U.S. Department of Education’s and its Readiness and Emergency Management for Schools (REMS) Technical Assistance (TA) Center’s free and Web-accessible software application for public and nonpublic schools to create and update high-quality school emergency operations plans (EOPs). Supporting resources for using EOP ASSIST can be found on the <a href="https://rems.ed.gov/EOPASSIST.aspx" target="_blank" title="REMS TA Center Website"> REMS TA Center Website</a><br /><br />For more information about or to receive technical support using EOP ASSIST, please contact the REMS TA Center at <a href="mailto:info@remstacenter.org" title="info@remstacenter.org">info@remstacenter.org</a> or via our toll-free telephone number, 1-855-781-REMS [7367]. Our hours of operation are Monday through Friday, 9:00 a.m. to 5:00 p.m., Eastern Time.
                </p>
                <?php echo( $contents ); ?>
           
              <div style="clear:both"></div>
                <p class="logintxtbtm">The U.S. Department of Education contracted for final products and deliverables that were developed under the GS-00F-115CA contract with Synergy Enterprises, Inc., and the contract stipulates that the U.S. Department of Education is the sole owner of EOP ASSIST.<br/><br/>
                    EOP ASSIST is being made available to the public pursuant to the following conditions.   The U.S. Department of Education is making the software available to the public and grants the public the worldwide, non-exclusive, royalty-free right to use and distribute the software created pursuant to the GS-00F-115CA contract, for only non-commercial and educational purposes.  This license does not include the right to modify the code of the software tool or create derivative works therefrom.  If you have any questions regarding whether a proposed use is allowable under this license, or want to request a particular use, please contact the REMS TA Center at 1-855-781-REMS [7367] or <a href="mailto:info@remstacenter.org"> info@remstacenter.org</a>.<br><br>
                    THE U.S. DEPARTMENT OF EDUCATION IS PROVIDING THE SOFTWARE AS IT IS, AND MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND CONCERNING THE WORK—EXPRESS, IMPLIED, STATUTORY OR OTHERWISE, INCLUDING WITHOUT LIMITATION WARRANTIES OF TITLE, MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, OR THE PRESENCE OR ABSENCE OF LATENT OR OTHER DEFECTS, ACCURACY, OR THE PRESENCE OR ABSENCE OF ERRORS, WHETHER OR NOT DISCOVERABLE, ALL TO THE GREATEST EXTENT PERMISSIBLE UNDER FEDERAL LAW.<br><br>


                    <a href="http://www.ed.gov/" target="_blank" title="Department of Education"><img class="DOEDlogo" src="<?php echo base_url(); ?>assets/img/DOElogo.png"></a>
                    <a href="http://rems.ed.gov/" target="_blank" title="Readiness and Emergency Management for Schools"><img class="REMSlogo" src="<?php echo base_url(); ?>assets/img/REMS-TA-Center.png"></a>
                </p>
                
            </fieldset>
            <p class="DOEcr"><?php echo(date('Y')); ?> &copy; U.S. Department of Education</p>
        </div>

    </body>

</html>