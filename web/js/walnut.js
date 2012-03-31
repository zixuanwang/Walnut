$(document).ready(function() {
	$(".find-similar").hide();
	$('.show-image').hover(function() {
		var fade = $('> .find-similar', this);
		fade.fadeIn(300);
	}, function() {
		var fade = $('> .find-similar', this);
		fade.fadeOut(300);
	});
});

$('.carousel').carousel({
	interval : 2000
});