$(function () {
	$(".subheader").append("<h2><a href=\"#!\" class=\"login\">LOGIN</a></h2>");


	//login lightbox
	$(".login").click(function() {
		$(".overlay").show();
	});
	$(".close").click(function() {
		$(".overlay").hide();
	});

	//login validation
	
	$(".login").validate();


	$(".passwordchange").validate();

});

