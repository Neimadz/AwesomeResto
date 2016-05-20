// tabs in admin.php
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show');
});

$('#myTabsEdit a').click(function (e) {
  e.preventDefault()
  $(this).tab('show');
});

// AJAX FOR READING MESSAGES
$('.ajax-read-msg').on('submit', function(event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        showMsgReaded("Ça va pas...");
    } else {
        // everything looks good!
        event.preventDefault();
        var selectedDiv = $(this).parent().attr('class');
        var idToPass = parseInt($(this).find(".ajax-read-msg-id").val());
        readMsg(selectedDiv, idToPass);
    }
});

// ajax query
function readMsg(div, id){
    // get data
    var msg = id;
    var divToHide = div;

    $.ajax({
        type: "GET",
        url: "inc/read_messages_treat.php",
        data: "msg=" + msg, // we compose $_GET VARIABLE here
        success : function(text){
            if (text == "success"){
                showMsgReaded("Le message a été marqué comme lu!");
                $('.'+div).css('display', 'none');
            } else {
                showMsgReaded(text);
            }
        },
        error : function() {
            console.log('Ca va pas!');
        }
    });
}

function showMsgReaded(msg){
    $("#msgRead").text(""); // to clear div
    $("#msgRead").append(msg);
    setTimeout(function() { // to hide any message
        $("#msgRead").text("");
    }, 3000);
}
