
$(function(){
	let subMenusWidth = $('#content').width();
	let menuHeight = subMenusWidth * 0.216667 / 16 * 9;
	let marginBottom = subMenusWidth * 0.033333;
	$('#sub-menus').css({
		'padding-top': marginBottom
	});
	$('#sub-menus li').css({
		'height': menuHeight,
		'margin-bottom': marginBottom
	});
	$('.images a').css({
		'margin-bottom': marginBottom
	});
});

$(function(){
	$(window).resize(function() {
	  location.reload();
	});
});