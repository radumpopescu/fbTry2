$( ".user-choice a" ).click(function(el) {
    var userId = $(el.target).data('id');
    document.cookie = "user="+userId;
    location.reload();
});

$( "#post-button" ).click(function(el) {
    var data = {
        "content": $("#postText").val()
    }
    $.ajax({
        type: "POST",
        url: "/?page=post",
        data: data,
        success: function(){
            location.reload();
        }
    });
});


$("#search-term").keyup(function(el) {
    var term = $("#search-term").val();
    search(term);
});

function search(term){
    var data = {
        "page": "search",
        "search": term
    }
    $.ajax({
        type: "GET",
        url: "/",
        data: data,
        success: function(data){
            $("#the-posts").html(data);
        }
    });
}

