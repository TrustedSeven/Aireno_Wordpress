

function wnw_set_google_autocomplete(){
	jQuery(gaaf_fields).each(function(){
											  
		var autocomplete= new google.maps.places.Autocomplete(
		/** @type {HTMLInputElement} */(this),
		{ types: ['geocode'] });
		// When the user selects an address from the dropdown,
		// populate the address fields in the form.

		this.googleAutoCompleteObject = autocomplete;
	});
}
jQuery(window).load(function(){
	wnw_set_google_autocomplete();
});