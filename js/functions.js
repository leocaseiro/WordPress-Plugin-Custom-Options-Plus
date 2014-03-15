
jQuery(document).ready( function() {
	jQuery("#label").stringToSlug({
		setEvents: 'keyup keydown blur',
		getPut: '#name',
		space: '_'
	});
});