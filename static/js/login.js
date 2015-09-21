

$(function () {
	$(".subheader").append("<h2><a href="#!" class="login">login</a></h2>");


	//login lightbox
	$(".login").click(function() {
		$(".overlay").show();
	});
	$(".close").click(function() {
		$(".overlay").hide();
	});
});
