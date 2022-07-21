$(document).ready(function(){
    var timer=setTimeout(cacher,3000);
    $('#messageFlash').click(function(){
        clearTimeout(timer);
        $(this).hide(3000);
    });

    $("#close").click(function(){
        $('#erreur').hide();
    });
});
function cacher(){
    $('#messageFlash').hide(3000);
}