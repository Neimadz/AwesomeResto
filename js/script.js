// owl carousel in header
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    autoplay: true,
    nav:true,
    navText: ["<span class='glyphicon glyphicon-menu-left'></span>","<span class='glyphicon glyphicon-menu-right'></span>"],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});


// treat header search form
// starting form treatment
$("#header_search").on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        showMsg("Vous avez rempli le formulaire correctement?");
    } else {
        // everything looks good!
        event.preventDefault();
        sendForm();
    }
});

// ajax query
function sendForm(){
    // get data
    var keyword = $("#header_keyword").val();
    var url = window.location.href;
    console.log(url);

    console.log(keyword);
    $.ajax({
        type: "GET",
        url: "inc/header-form.php",
        data: "keyword=" + keyword,
        success : function(text){
            if (text == "success"){
                formSuccessful();
            } else {
                showMsg(text);
            }
        },
        error : function() {
            console.log('Ca va pas!');
        }
    });
}

function formSuccessful(){
    $("#header_search")[0].reset();
    showMsg("Groot!");
}

function showMsg(msg){
    $("#wrapper").text(""); // to clear div
    $("#wrapper").append(msg);
}


// CONTACT FORM



/**************************************/
//Page 2 loader LAZYLOAD

/*$("img.lazy").lazyload({
    event : "scroll",
    effect : "fadeIn",
    threshold : 200
});*/
/*************************************/
