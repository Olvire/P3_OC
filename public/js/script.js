$(function() {
	// Permet de faire apparaître la textarea pour répondre aux commentaires.
	$('.repondre-commentaire').on('click', function() {
		$(this).siblings('.comment-footer').fadeToggle();
	});
});