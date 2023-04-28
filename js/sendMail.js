

function sendEmail() {
    var name = $("#name");
    var email = $("#email");
    var phoneNumber = $("#phoneNumber");
    var subject = $("#subject");
    var body = $("#body");

    if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(body)) {
        $.ajax({
            url: 'mailerPlugin/sendEmail.php',
            method: 'POST',
            dataType: 'json',
            data: {
                name: name.val(),
                email: email.val(),
                phoneNumber: phoneNumber.val(),
                body: body.val(),
                subject: subject.val()
            }, success: function (response) {
                 $('#contact-us-form-input')[0].reset();
                 $('#messageContainer').modal('show');
            }
        });
    }
}

function isNotEmpty(caller) {
    if (caller.val() == "") {
        caller.css('border', '1px solid red');
        return false;
    } else
        caller.css('border', '');

    return true;
}

function hidePopUp()
{
  $('#messageContainer').modal('hide');
}
