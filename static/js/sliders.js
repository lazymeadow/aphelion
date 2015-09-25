
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
		centerPadding: '0px',
		focusOnSelect: true,
		variableWidth: true,
		adaptiveHeight: true,
		swipe: true,
		asNavFor: '.slider-for'
	});
	$('.slider-for > p').hide();
});

$(function() {
	$('.gallery-bar').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		dots: false,
		vertical: true,
		focusOnSelect: true,
		arrows: true,
		prevArrow: '<img src="static/images/up.png"/>',
		nextArrow: '<img src="static/images/down.png"/>',
		asNavFor: ('.gallery')
	});
	$('.gallery').slick({
		arrows: false,
		fade: false
	});
	$('.slick-slide > img').css("display", "inline");
});
