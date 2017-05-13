// var geocoder = new google.maps.Geocoder();
// var address = ' ,France';
// var geocoder_results = null;
// var list_group = null;
function initAutocomplete(){
	var country = 'fr';
	var setGeocoderData = function(data){

		data.address_components.some(function(item){
			jQuery('[data-location="' + item.types[0] + '"]').val(item.long_name);
		});

		jQuery('[data-location="lat"]').val(data.geometry.location.lat());
		jQuery('[data-location="lng"]').val(data.geometry.location.lng());

	}

	var options = country == null ? {} : {componentRestrictions: {country: country}};

	var input = document.querySelector('[data-location="formattedAddress"]');

	var autocomplete = new google.maps.places.Autocomplete(input, options);

	if (autocomplete) {

		google.maps.event.addListener(autocomplete, 'place_changed', function() {
		   setGeocoderData(autocomplete.getPlace())
		});

	}
}
