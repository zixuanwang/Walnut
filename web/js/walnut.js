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

$(function() {
	$('#atextsearch').click(function() {
		$("#imgtextsearch").attr('src', "/image/keywords_selected.png");
		$("#imglinksearch").attr('src', "/image/pic link_unselected.png");
		$("#imguploadsearch").attr('src', "/image/from local_unselected.png");
		$("#atextsearch").tab('show');
	});
	$('#alinksearch').click(function() {
		$("#imglinksearch").attr('src', "/image/pic link_selected.png");
		$("#imgtextsearch").attr('src', "/image/keywords_unselected.png");
		$("#imguploadsearch").attr('src', "/image/from local_unselected.png");
		$("#alinksearch").tab('show');
	});
	$('#auploadsearch').click(function() {
		$("#imguploadsearch").attr('src', "/image/from local_selected.png");
		$("#imglinksearch").attr('src', "/image/pic link_unselected.png");
		$("#imgtextsearch").attr('src', "/image/keywords_unselected.png");
		$("#auploadsearch").tab('show');
	});
});