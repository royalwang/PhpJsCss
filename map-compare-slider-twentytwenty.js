(function($){
  // iframe google map comparision slider
  $.fn.twentytwenty = function(options) {
    var options = $.extend({default_offset_pct: 0.5, orientation: 'horizontal'}, options);
    return this.each(function() {

      var sliderPct = options.default_offset_pct;
      var container = $(this);
      var sliderOrientation = options.orientation;
      var beforeDirection = (sliderOrientation === 'vertical') ? 'down' : 'left';
      var afterDirection = (sliderOrientation === 'vertical') ? 'up' : 'right';
      
      
      container.wrap("<div class='twentytwenty-wrapper twentytwenty-" + sliderOrientation + "'></div>");
      container.append("<div class='twentytwenty-overlay'></div>");
      var beforeImg = container.find("iframe:first");
      var afterImg = container.find("iframe:last");
      container.append("<div class='twentytwenty-handle'></div>");
      var slider = container.find(".twentytwenty-handle");
      slider.append("<span class='twentytwenty-" + beforeDirection + "-arrow'></span>");
      slider.append("<span class='twentytwenty-" + afterDirection + "-arrow'></span>");
      container.addClass("twentytwenty-container");
      beforeImg.addClass("twentytwenty-before");
      afterImg.addClass("twentytwenty-after");
      
      var overlay = container.find(".twentytwenty-overlay");
      overlay.append("<div class='twentytwenty-before-label'></div>");
      overlay.append("<div class='twentytwenty-after-label'></div>");

      var calcOffset = function(dimensionPct) {
        var w = beforeImg.width();
        var h = beforeImg.height();
        return {
          w: w+"px",
          h: h+"px",
          cw: (dimensionPct*w)+"px",
          ch: (dimensionPct*h)+"px"
        };
      };

      var adjustContainer = function(offset) {
      	if (sliderOrientation === 'vertical') {
      	  beforeImg.css("clip", "rect(0,"+offset.w+","+offset.ch+",0)");
      	}
      	else {
          beforeImg.css("clip", "rect(0,"+offset.cw+","+offset.h+",0)");
    	}
        container.css("height", offset.h);
      };

      var adjustSlider = function(pct) {
        var offset = calcOffset(pct);
        slider.css((sliderOrientation==="vertical") ? "top" : "left", (sliderOrientation==="vertical") ? offset.ch : offset.cw);
        adjustContainer(offset);
      }

      $(window).on("resize.twentytwenty", function(e) {
        adjustSlider(sliderPct);
      });

      var offsetX = 0;
      var imgWidth = 0;
      
      slider.on("movestart", function(e) {
        if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && sliderOrientation !== 'vertical') {
          e.preventDefault();
        }
        else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && sliderOrientation === 'vertical') {
          e.preventDefault();
        }
        container.addClass("active");
        offsetX = container.offset().left;
        offsetY = container.offset().top;
        imgWidth = beforeImg.width(); 
        imgHeight = beforeImg.height();          
      });

      slider.on("moveend", function(e) {
        container.removeClass("active");
      });

      slider.on("move", function(e) {
        if (container.hasClass("active")) {
          sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
          if (sliderPct < 0) {
            sliderPct = 0;
          }
          if (sliderPct > 1) {
            sliderPct = 1;
          }
          adjustSlider(sliderPct);
        }
      });

      container.find("iframe").on("mousedown", function(event) {
        event.preventDefault();
      });

      $(window).trigger("resize.twentytwenty");
    });
  };

})(jQuery);


// index.html 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>twentytwenty</title>
  <link href="css/foundation.css" rel="stylesheet" type="text/css" />
  <link href="css/twentytwenty.css" rel="stylesheet" type="text/css" />
</head>
  <body>
      <div class="twentytwenty-container" style="overflow: hidden; width: 90%; margin: 0 auto;">
          <iframe src="map1.html" style="position: fixed; height: 100%; width: 90%; border: none"></iframe>
          <iframe src="map2.html" style="position: fixed; height: 100%; width: 90%; border: none"></iframe>
      </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="js/jquery.event.move.js"></script>
    <script src="js/jquery.twentytwenty.js"></script>
    <script>
    $(window).load(function(){
      $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.7});
      $(".twentytwenty-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.3, orientation: 'vertical'});
    });
    </script>
  </body>
</html>

// map1.html
<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            /* Set a size for our map container, the Google Map will take up 100% of this container */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
          }

            #map {
                 height: 100%;
            }
        </style>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
        
        <script type="text/javascript">
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);
        
            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    // How zoomed in you want the map to start at (always required)
                    zoom: 13,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(52.231778, 21.006162), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"geometry","stylers":[{"visibility":"off"},{"color":"#d6bc68"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#e7cd79"},{"weight":0.1}]},{"featureType":"landscape.natural.landcover","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#d6bc68"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"on"},{"color":"#d6bc68"}]},{"featureType":"poi.attraction","elementType":"geometry","stylers":[{"visibility":"off"},{"color":"#cfb665"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"color":"#e9d9a6"},{"visibility":"on"}]},{"featureType":"poi.government","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#e9d9a6"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"},{"weight":1},{"color":"#e9d9a6"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#e9d9a6"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#d6bc68"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"color":"#cfb665"},{"visibility":"off"}]},{"featureType":"transit.line","elementType":"all","stylers":[{"color":"#d6bc68"},{"visibility":"on"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"visibility":"off"},{"color":"#d6bc68"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#282828"}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(52.231778, 21.006162),
                    map: map,
                    title: 'Snazzy!'
                });
            }
        </script>
    </head>
    <body>
        <div id="map"></div>
    </body>
</html>


//map2.html
<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            /* Set a size for our map container, the Google Map will take up 100% of this container */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
          }

            #map {
                 height: 100%;
            }
        </style>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
        
        <script type="text/javascript">
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);
        
            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    mapTypeId: google.maps.MapTypeId.SATELLITE,
                    // How zoomed in you want the map to start at (always required)
                    zoom: 15,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(52.231778, 21.006162), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"featureType":"administrative.locality","elementType":"all","stylers":[{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"administrative.locality","elementType":"labels.text","stylers":[{"weight":"1"},{"saturation":"-100"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text","stylers":[{"saturation":"-100"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":100},{"visibility":"simplified"},{"color":"#f6f6f6"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#00ffa0"},{"lightness":"45"},{"saturation":"-100"},{"gamma":"1"}]},{"featureType":"road","elementType":"labels","stylers":[{"lightness":"41"},{"saturation":"-100"},{"gamma":"1"},{"hue":"#00ffa0"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"saturation":-93},{"lightness":-2},{"visibility":"on"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"saturation":-90},{"lightness":-8},{"visibility":"on"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":10},{"lightness":69},{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"saturation":-78},{"lightness":67},{"visibility":"on"},{"hue":"#0089ff"}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(52.231778, 21.006162),
                    map: map,
                    title: 'Snazzy!'
                });
            }
        </script>
    </head>
    <body>
        <div id="map"></div>
    </body>
</html>
