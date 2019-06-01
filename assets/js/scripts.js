function validate_email(email) {

    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}

function show_message(text, classstyle = 'alert alert-danger') {
    $("#errorMessage").attr('class', classstyle).hide('fast').html(text).show('fast');
}