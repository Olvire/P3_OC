$(function() {
	// Adminstration page effects
	$('#admin-1').click(function() {
		$('.admin-new-article').fadeToggle();
	});

	$('#admin-2').click(function() {
		$('.admin-articles').fadeToggle();
	});

	$('#admin-3').click(function() {
		$('.admin-danger-zone').fadeToggle();
	});

	$('.comments-container').click(function() {
		$('.comments').fadeToggle();
	});

});