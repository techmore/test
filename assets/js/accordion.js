// JavaScript Document

<!--  Script for rows  -->

        $(document).ready(function(){
            $("#slidecontent ul.reveal").hide();
			$("#slidecontent2 ul.reveal").hide();
            $("#slidecontent div:first-child").show();
			$("#slidecontent2 div:first-child").show();
            
            $("h3.clicker").click(function(){
                $(this).next("ul.reveal").slideToggle("slow");
            });
        });
