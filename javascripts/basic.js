$(document).ready(function(){
	var newHeight = $(document).height() - $(".head").height() + "px";
    $(".sidebar").css("height", newHeight);
	$(window).resize(function() {
        var newHeight = $(document).height() - $(".head").height() + "px";
    	$(".sidebar").css("height", newHeight);
    });
    $('.folder').click(function() {
        $('.sidebar, .content').toggleClass('mini');
    });
});