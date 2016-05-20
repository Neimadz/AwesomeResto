// TABS IN ADMIN.PHP - NO AJAX STUFF
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show');
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

/**************************
AJAX DELETE USER
***************************/

$('.remove-user').on('click', function(e) {
    e.preventDefault();
    var thisId = $(this).attr('data-id');
    var liToHide = $(this).parent().attr('id');

    $.ajax({
        type: "POST",
        url: "inc/remove_user.php",
        data: "&id=" + thisId, // we compose $_POSt VARIABLE here
        success : function(text){
            showRecipeAdded(text);
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
AJAX ADD USER
***************************/
$('#add-user').on('submit', function(e) {
    e.preventDefault();
    var inputData = $( this ).serialize();
    console.log(inputData);
    $.ajax({
        type: "POST",
        url: "inc/list_users_treat.php",
        data: inputData, // we compose $_POSt VARIABLE here
        success : function(text){
            showRecipeAdded(text);
            $('#removedUserMsg').text("");
            $('#removedUserMsg').append(text);
            setTimeout(function(){
                $('#removedUserMsg').text("");
            }, 10000);
        },
        error : function() {
            console.log('Ca va pas!');
        }
    });
});
