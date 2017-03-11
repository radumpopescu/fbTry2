$( ".user-choice a" ).click(function(el) {
    var userId = $(el.target).data('id');
    document.cookie = "user="+userId;
    location.reload();
});