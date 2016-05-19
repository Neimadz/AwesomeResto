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
    var keyword = $("#header_keyword").val();

    console.log(keyword);
    $.ajax({
        type: "GET",
        url: "inc/header-form.php",
        data: "keyword=" + keyword,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                submitMSG(text);
            }
        },
        error : function() {
            console.log('Ca va pas!');
        }
    });
}

function formSuccess(){
    $("#header_search")[0].reset();
    submitMSG("Groot!");
}

function submitMSG(msg){
    $("#wrapper").text(""); // to clear div
    $("#wrapper").append(msg);
}


// CONTACT FORM
