
$(function () {
	$('.slider-for, .slider-nav').show();
	$('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: false,
		adaptiveHeight: true,
		draggable: false
	});
	$('.slider-nav').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		dots: false,
		centerMode: true,
		focusOnSelect: true,
		swipe: true,
		variableWidth: true,
		asNavFor: '.slider-for'
	});
	$('.slider-for > p').hide();
});

$(function() {
	$('.art-nav').slick({
		slidesToShow: 3,
		fade: false,
		dots: false,
		slidesToScroll: 1,
		centerMode: true,
		asNavFor: '.art-gallery'
	});
	$('.art-gallery').slick({
		arrows: false,
		fade: false
	});
	$('.slick-slide > img').css("display", "inline");
});
