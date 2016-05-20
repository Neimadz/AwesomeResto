// starting form treatment
$("#update_infos").on("submit", function (event) {
/*    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        submitProfil("Vous avez changé le profil du restaurant?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitNewInfos();
    }*/

    event.preventDefault();
    submitNewInfo();
});

// ajax query
function submitNewInfo(){
    // get data
    var img1 = $("#img1").val();
    var img2 = $("#img2").val();
    var img3 = $("#img3").val();
    var adress = $("#adress").val();

    $.ajax({
        type: "POST",
        url: "inc/update_infos_treat.php",
        data: "&img1=" + img1 + "&img2=" + img2 + "&img3=" + img3 + "&adress=" + adress,
        success : function(text){
            console.log(text);
            if (text == "changeprofil"){
                $("#new_infos")[0].reset();
                submitProfil("Message sent");

            } else {
                submitProfil(text);
            }
        },
        error : function() {
            console.log('try again');
        }
    });
}

function submitProfil(msg){
    $("#infosUpdate").text(""); // to clear div
    $("#infosUpdate").append(msg);
}