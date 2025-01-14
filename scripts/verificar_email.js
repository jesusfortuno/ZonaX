$(document).ready(function() {
    $("#email").on("blur", function() {
        const email = $(this).val();
        $.ajax({
            url: "controller/verificar_email.php",
            method: "POST",
            data: { email },
            success: function(response) {
                if (response.exists) {
                    $("#email_error").text("Este correo electrónico ya está en uso.");
                } else {
                    $("#email_error").text("");
                }
            }
        });
    });
});