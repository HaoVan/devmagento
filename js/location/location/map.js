var geocoder;
var map;
var markers = [];
function initialize() {
    geocoder = new google.maps.Geocoder();
    var lat = parseFloat(jQuery("#location_x").val());
    var lng = parseFloat(jQuery("#location_y").val());
    var latlng = new google.maps.LatLng(lat, lng);
    var mapOptions = {
        zoom: 14,
        center: latlng,
        mapTypeControl: true,
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
        navigationControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    addMarker(latlng);
    google.maps.event.addListener(map, 'click', function(event) {

        addMarker(event.latLng);
    });
}





jQuery(document).ready(function(){
    google.maps.event.addDomListener(window, 'load', initialize);
    AddressChange();


    jQuery("#location_x, #location_y").change(function(){
        LocationChange();
    });

});
function LocationChange(){
        var lat = parseFloat(jQuery("#location_x").val());
        var lng = parseFloat(jQuery("#location_y").val());
        var latlng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({'latLng': latlng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    map.setCenter(results[0].geometry.location);
                    addMarker(latlng);
                } else {
                    alert('No results found');
                }
            } else {
                alert('Geocoder failed due to: ' + status);
            }
        });

}

function AddressChange(){
    jQuery("#restaurant_address").change(function(){
        geocoder.geocode( { 'address': jQuery(this).val()}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                addMarker(results[0].geometry.location);
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    })
}
function addMarker(location) {
    if (!(location != undefined && !isNaN(location.lb) && !isNaN(location.mb))){
        location = new google.maps.LatLng(21.04279, 105.818914);
        map.setCenter(location);
    }
    deleteMarkers();
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
    markers.push(marker);
    jQuery("#location_x").val(location.lb);
    jQuery("#location_y").val(location.mb);
}
function deleteMarkers() {
    clearMarkers();
    markers = [];
}
function clearMarkers() {
    setAllMap(null);
}
function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}