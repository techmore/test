/**
 *
 * Standard Javascript on all the pages
 *
 */



function pingServer(){

    if(lastEvent.name == 'pageload')
        return;

    var currentTime = Math.round(new Date().getTime()/1000); // In seconds
    var timeDiff = currentTime - lastEvent.time;

    /*console.log("last event:" + lastEvent.name +" -- "+ lastEvent.time);
    console.log("Time Diff:" + (currentTime - lastEvent.time));*/
    //Ping Server only if the time from the last event is lesser than the timeout period
    if(timeDiff <= sess_expiration){
        ping(baseURL);
    }else{
        logout();
    }
}

function sessionExpirationAlert(){

    if(!atLoginScreen()) {
        var currentTime = Math.round(new Date().getTime() / 1000); // In seconds
        var timeDiff = 0;
        if(lastEvent.name == 'pageload'){
            timeDiff = currentTime - initialTime;
        }else{
            timeDiff = currentTime - lastEvent.time;
        }
        /*console.log("Time diff:" + timeDiff);
        console.log("last event:" + lastEvent.time);
        console.log("Initial Time: "+initialTime);*/

        if (timeDiff <= sess_expiration && timeDiff > (sess_expiration - promptDuration)) {

            var msg = 'Your session is about to expire. Would you like to continue your work in EOP ASSIST?';

            if (!sessionAlert) {
                sessionAlert = true;
                if(lastEvent.name == 'pageload'){
                    lastEvent.name = 'prompt';
                    lastEvent.time = initialTime;
                }
                $.prompt(msg, {
                    /*title: "Session Expiration Alert!",*/
                    buttons: {"Continue Session": true, "Log Out": false},
                    close: function (e, v, m, f) {
                        if (v) {
                            ping(baseURL);
                        } else {
                            logout();
                        }
                        sessionAlert = false;
                    }
                });
            }
        }
    }
}

function ping(baseURL){

    if(!atLoginScreen()){
        showLoadingWheel = false;
        var form_data = {
            ajax:           '1'
        };
        $.ajax({
            url: baseURL+"app/ping",
            type: "POST",
            data: form_data,
            success: function(response) {
                var data = JSON.parse(response);
                if(data.ping == false){
                    logout();
                }else{
                    if(lastEvent.name=='ping'){
                        //do nothing
                    }else{
                        resetLastEvent('ping');
                    }

                    $("#ping-data").html("<p>" + data.ping + "</p>");
                }
            }
        });
    }
}

/**
 * Function checks if we are at the login screen
 */
function atLoginScreen(){

    var regexp = /login/gi;
    var pathname = $(location).attr('pathname');

    if(pathname.match(regexp)){
        return true;
    }else{
        return false;
    }
}

function logout(){
    var logout_link = $("#logoutLink").attr('href');
    var data = {
        ajax: '1',
        logout: '1'
    };
    $.ajax({
        url: logout_link,
        data: data,
        type: 'POST',
        success: function (response) {
            window.location = 'login';
        },
        error: function (error) {
            var d = JSON.stringify(error);
            alert(d);
        }
    });
}

$(document).bind("click keyup dblclick contextmenu scroll", function(event){
    //Log last event
    resetLastEvent(event.type);
});

function resetLastEvent(eventName){
    lastEvent.name = eventName;

    if(eventName == 'ping'){
        //Do nothing here
    }else{
        lastEvent.time= Math.round(new Date().getTime()/1000); // In seconds;
    }
}

$(document).ready(function() {

    /**
     * Logout link click prompts user with dialog to confirm option before logging them out
     */
    $('#logoutLink').click(function () {
        var txt = 'Are you sure you want to log out?';

        $.prompt(txt, {
            buttons: {"Log Out": true, Cancel: false},
            close: function (e, v, m, f) {

                if (v) {
                    logout();
                }
                else {
                }
            }
        });
        return false;
    });
});


/** Set a Cookie **/
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/** Read Cookie **/
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}