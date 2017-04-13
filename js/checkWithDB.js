$(document).ready(function() {
    $('#email').blur(function(event) {
        input_email = $('#email').val();
        $.ajax({
            url: '../db/checkemail.php',
            type: 'POST',
            data: {input_email: input_email}
        })
        .done(function(response) {
            console.log("success");
            console.log(response);
        })
        .fail(function() {
            console.log("error");
        });

    });

    $('#username').blur(function(event) {
        input_username = $('#username').val();
        $.ajax({
            url: '../db/checkusername.php',
            type: 'POST',
            data: {input_username: input_username}
        })
        .done(function(response) {
            console.log("success");
            console.log(response);
        })
        .fail(function() {
            console.log("error");
        });

    });
});
