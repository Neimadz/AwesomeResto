// starting form treatment
$("#contact-form").on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        submitMSG("Vous avez rempli le formulaire correctement?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});

// ajax query
function submitForm(){
    // get data
    var name = $("#name").val();
    var email = $("#email").val();
    var message = $("#message").val();

    $.ajax({
        type: "POST",
        url: "inc/traitement_form_contact.php",
        data: "&name=" + name + "&email=" + email + "&message=" + message,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                submitMSG(text);
            }
        },
        error : function() {
            console.log('try again');
        }
    });
}

function formSuccess(){
    $("#contact-form")[0].reset();
    submitMSG("Message sent");
}

function submitMSG(msg){
    $("#msgSubmit").text(""); // to clear div
    $("#msgSubmit").append(msg);
}