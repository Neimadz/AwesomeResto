// TABS IN ADMIN.PHP - NO AJAX STUFF
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show');
});

function checkUserList() {
    $.ajax({
        type: "POST",
        url: "inc/show_user.php",
        // data: inputData, // we compose $_POSt VARIABLE here
        success : function(text){
            $('#user-container').text("");
            $('#user-container').append(text);
        },
        error : function() {
            console.log('Ca va pas!');
        }
    });
}

$(document).ready(function() {
    checkUserList();
});

/**************************
AJAX SHOW USER
***************************/

$('#add-user').on('submit', function(e) {
    e.preventDefault();

    checkUserList();
    // add user to the db
    var inputData = $( this ).serialize();
    $.ajax({
        type: "POST",
        url: "inc/list_users_treat.php",
        data: inputData, // we compose $_POSt VARIABLE here
        success : function(text){
            // showRecipeAdded(text);
            $('#addedUserMsg').text("");
            $('#addedUserMsg').append(text);
            setTimeout(function(){
                $('#addedUserMsg').text("");
            }, 7000);
            checkUserList();
        },
        error : function() {
            console.log('Ca va pas!');
        }
    });
});

/**************************
AJAX DELETE USER
***************************/
$('body').on('click', '.remove-user', function(e) {
    console.log('click');
    e.preventDefault();
    var thisId = $(this).attr('data-id');
    var liToHide = $(this).parent().attr('id');
    console.log(thisId);

    $.ajax({
        type: "POST",
        url: "inc/remove_user.php",
        data: "&id=" + thisId, // we compose $_POSt VARIABLE here
        success : function(text){
            showRecipeAdded(text);
            console.log(text);
            $('#removedUserMsg').text("");
            $('#removedUserMsg').append(text);
            $('#'+liToHide).fadeOut();
            setTimeout(function(){
                $('#removedUserMsg').text("");
            }, 2000);
        },
        error : function() {
            console.log('Ca va pas!');
        }
    });
});



/**************************
AJAX FOR ADD RECIPES
***************************/
$('#add-recipe-form').on('submit', function(event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        showRecipeAdded("Ça va pas...");
    } else {
        // everything looks good!
        event.preventDefault();
        ajaxAddRecipe();
    }
});
// ajax query
function ajaxAddRecipe(){
    // get data
    var newRole = $('#add-role').val();
    var newTitle = $('#add-title').val();
    var newContent = $('#add-content').val();
    var newLink = $('#add-link').val();
    var newIngredients = $('#add-ingredients').val();

    $.ajax({
        type: "POST",
        url: "inc/add_recipe_treat.php",
        data: "role=" + newRole + '&title=' + newTitle + '&content=' + newContent + '&ingredients=' + newIngredients + '&link=' + newLink, // we compose $_POSt VARIABLE here
        success : function(text){
            showRecipeAdded(text);
            $("#add-recipe-form")[0].reset();
            console.log(text);
        },
        error : function() {
            console.log('Ca va pas!');
        }
    });
}

function showRecipeAdded(msg){
    $("#add-recipe-msg").text(""); // to clear div
    $("#add-recipe-msg").append(msg);
    setTimeout(function() { // to hide any message
        $("#add-recipe-msg").text("");
    }, 5000);
}



/**************************
AJAX FOR READING MESSAGES
***************************/
$('.mark-as-read').on('click', function(event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        showMsgReaded("Ça va pas...");
    } else {
        // everything looks good!
        event.preventDefault();
        var selectedDiv = $(this).parent().attr('id');
        var msgId = parseInt($(this).attr('data-message-id'));

        $.ajax({
            type: "GET",
            url: "inc/read_messages_treat.php",
            data: "msg=" + msgId, // we compose $_GET VARIABLE here
            success : function(text){
                if (text == "success"){
                    showMsgReaded("Le message a été marqué comme lu!");
                    $('#'+selectedDiv).removeClass('msg-not-read').addClass('msg-read');
                } else {
                    showMsgReaded(text);
                }
            },
            error : function() {
                console.log('Ca va pas!');
            }
        });
        showMsgNotification();
    }
});


function showMsgReaded(msg){
    $("#msgRead").text(""); // to clear div
    $("#msgRead").append(msg);
    setTimeout(function() { // to hide any message
        $("#msgRead").text("");
    }, 3000);
}

function showMsgNotification() {
    if ($('#msg-container').has('.msg-not-read').length > 0) {
        console.log('Shown');
        $('#msg-bell').css('display', 'inline-block');
    }
    else {
        $('#msg-bell').css('display', 'none');
        $('#msgRead').text("Vous n'avez aucun message");
        console.log('Hidden');
    }
    console.log('Hello');
    console.log($('#msg-container').find('div.admin-msg.msg-shown'));
}

showMsgNotification();

$('.mark-as-read').on('click', function(){
    $(this).fadeOut();
})
