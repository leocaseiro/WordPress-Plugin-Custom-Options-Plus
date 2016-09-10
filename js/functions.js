jQuery( document ).ready(function( $ ) {
	if ( '' === $( '#name' ).val() ) {
		$( '#label' ).stringToSlug({
			setEvents: 'keyup keydown blur',
			getPut: '#name',
			space: '_'
		});
	}
});
