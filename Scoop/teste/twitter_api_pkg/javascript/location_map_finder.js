//PHP Twitter User Timeline & Search Plugin Version 1.0
//Created by: Danny Pajevic
//Mail: support@democode.net
//Copyright: Danny Pajevic
/*LICENSE CERTIFICATE : Envato Marketplace Item
==============================================
/this is protected under copyrights as defined in the standard terms and conditions on the Envato Marketplaces.

For any queries related to this document or license please contact Envato Support via http://support.envato.com/index.php?/Live/Tickets/Submit

Envato Pty. Ltd. (ABN 11 119 159 741)
PO Box 21177, Little Lonsdale Street, VIC 8011, Australia img
*/
function changeSort() {
	if(document.getElementById("result_type").selectedIndex != 1){
document.getElementById("result_type").selectedIndex = 1;
	}
}

function $_GET(name) {
var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

function initialize() {
	
var focusLat = '';
var focusLon = '';

if($_GET('lat') && $_GET('lat').match(/\-?[0-9]+[\.]{0,1}[0-9]*/) && $_GET('lon') && $_GET('lon').match(/\-?[0-9]+[\.]{0,1}[0-9]*/)){
focusLat = $_GET('lat');
focusLon = $_GET('lon');
}else{
focusLat = '40.758895';	
focusLon = '-73.985131';
}
	
var markersShown = [];

  var map = new google.maps.Map(document.getElementById('map_canvas'), {
    zoom: 2,
    center: new google.maps.LatLng(focusLat, focusLon),
    mapTypeId: google.maps.MapTypeId.SATELLITE
  });
  
  //show the marker if there is a search happening
  if($_GET('lat') && $_GET('lon')){
   for (i = 0; i<markersShown.length; i++){
    markersShown[i].setMap(null);
}
														   													   
    marker = new google.maps.Marker({position: new google.maps.LatLng(focusLat, focusLon), map: map});
	
	markersShown.push(marker);
  }
  //end

  // Create the search box and link it to the UI element.
  var input = document.getElementById('target');
  var searchBox = new google.maps.places.SearchBox(input);

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };
	  
	  	if(document.getElementById("result_type").selectedIndex != 1){
document.getElementById("result_type").selectedIndex = 1;
	}
	  
	document.getElementById('lat').value = place.geometry.location.lat().toFixed(6);
	document.getElementById('lon').value = place.geometry.location.lng().toFixed(6);
	
	  for (i = 0; i<markersShown.length; i++){
    markersShown[i].setMap(null);
}
														   													   
    marker = new google.maps.Marker({position: place.geometry.location, map: map});
	
	markersShown.push(marker);

      bounds.extend(place.geometry.location);
	  
	   
    }
	
    map.fitBounds(bounds);
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
        
  google.maps.event.addListener(map, 'click', function(event) {
													   
  for (i = 0; i<markersShown.length; i++){
    markersShown[i].setMap(null);
}
														   													   
    marker = new google.maps.Marker({position: event.latLng, map: map});
	
	markersShown.push(marker);
	
		if(document.getElementById("result_type").selectedIndex != 1){
document.getElementById("result_type").selectedIndex = 1;
	}
 	
	document.getElementById('lat').value = event.latLng.lat().toFixed(6);
	document.getElementById('lon').value = event.latLng.lng().toFixed(6);

});
  
}

google.maps.event.addDomListener(window, 'load', initialize);
