//Initialize google map for contact setion with your location.
// add script first
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

function initializeMap() {

    var lat = '44.8164056'; //Set your latitude.
    var lon = '20.46090424'; //Set your longitude.

    var centerLon = lon - 0.0105;
    var myOptions = {
        scrollwheel: false,
        draggable: false,
        disableDefaultUI: true,
        center: new google.maps.LatLng(lat, centerLon),
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    //Bind map to elemet with id map-canvas
    var map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);
    var marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(lat, lon),

    });

    var infowindow = new google.maps.InfoWindow({
        content: "Your content goes here!"
    });

    google.maps.event.addListener(marker, 'click', function () {
        infowindow.open(map, marker);
    });

    infowindow.open(map, marker);
}
