
$(document).ready(function() {


    /**
     * JQuery form validation
     */
    jQuery.validator.setDefaults({
        //debug: true,
        //success: "valid"
    });

    $("#login_form").validate({
        rules: {
            username: "required",
            password: "required"
        }
    });

    /*$('#password').keyup(function()
    {
        alert(passwordStrength($('#password').val()));
    })  */


    $('#forgotUserIdLink').click(function() {
        $.ajax({
            type: 'GET',
            data: null,
            url: 'ShowEmailEntryFormForgotUserId.php',
            success: function(data) {
                setMessage(data);
            }
        });
        return false;
    });

    $('#forgotPasswordLink').click(function() {
        $('#forgotPasswordDiv').html("");
        $.ajax({
            type: 'GET',
            data: null,
            url: 'ShowUserIdEmailEntryForm.php',
            success: function(data) {
                setMessage(data);
            }
        });
        return false;
    });

    $('#signupLink').click(function() {
        $('#requestNewAccessDiv').html("");
        $.ajax({
            type: 'GET',
            data: null,
            url: 'showcreateuserformsignup.php',
            success: function(data) {
                setMessage(data);
            }
        });
        return false;
    });

    $('#username').click(function() {
        clearMessage();
    });

    $('#password').click(function() {
        clearMessage();
    });

    var msgObj = document.getElementById('messageToUser');
    if (msgObj) {
      if (msgObj.value.trim().length > 0) {
        setInfoMessage(msgObj.value.trim());
      }
    }

    $('#username').focus();
});

function setInfoMessage(text) {
  htmlStr = '<div class="info" style="min-height:40px;vertical-align:middle;">\n<p style="margin-left:40px;text-align:center;font-size:12px;padding-left:auto;padding-right:auto;padding-top:auto;padding-bottom:auto;">';
  htmlStr += text;
  htmlStr += '</p></div>';
  setMessage(htmlStr);
}

  function setMessage(text) {
  $('#extraContent').html(text);
}

function clearMessage() {
  $('#extraContent').html("");
}

function isLoginFormBlank() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    if (username === "" || password === "") {
      setInfoMessage('User ID and Password are required to sign in.');
      return false;
    } else {
      clearMessage();
      disablePage('Validating credentials...');
      return true;
    }
}

function enableResetPassword() {
    document.getElementById('errorDiv').innerHTML = "";
    document.getElementById('resetMyPass').disabled = false;
}

function resetThePasswordOfThisUser(userKey, newPassword, confirmPassword) {
    if (newPassword === "" || confirmPassword === "") {
        document.getElementById('errorDiv').innerHTML = "Enter password and confirmation password.";
        document.getElementById('resetMyPass').disabled = true;
        document.getElementById('new_password').focus();
        return;
    }
    if (newPassword === confirmPassword && newPassword !== "") {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById('forgotPasswordDiv').innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "ResetUserPassword.php?userKey=" + userKey + "&newPassword=" + newPassword, true);
        xmlhttp.send();
    } else {
        document.getElementById('errorDiv').innerHTML = "Sorry! new and confirmation password must be identical!";
        document.getElementById('resetMyPass').disabled = true;
        document.getElementById('new_password').focus();
    }
}

function passwordStrength(password) {
    var desc = new Array();
    desc[0] = "Very Weak";
    desc[1] = "Weak";
    desc[2] = "Better";
    desc[3] = "Medium";
    desc[4] = "Strong";
    desc[5] = "Strongest";

    var score = 0;

    //if password bigger than 6 give 1 point
    if (password.length > 6)
        score++;

    //if password has both lower and uppercase characters give 1 point
    if ((password.match(/[a-z]/)) && (password.match(/[A-Z]/)))
        score++;

    //if password has at least one number give 1 point
    if (password.match(/\d+/))
        score++;

    //if password has at least one special caracther give 1 point
    if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))
        score++;

    //if password bigger than 12 give another 1 point
    if (password.length > 12)
        score++;

    document.getElementById("passwordDescription").innerHTML = desc[score];
    document.getElementById("passwordStrength").className = "strength" + score;
}




