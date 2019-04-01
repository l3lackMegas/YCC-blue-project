<div id="homeArea">
	<span class="homeTitle">กรอกจุดหมายของคุณ</span>
	<p>ตำแหน่งของคุณ</p>
	<div class="input"><i class="fas fa-map-marker-alt"></i><input id="origin-input" type = "text" name = "startPoint" value = "" maxlength = "100" /><br></div>
	<p>จุดหมายปลายทาง</p> 
	<div class="input"><i class="fas fa-map-marked-alt"></i><input id="destination-input" type = "text" name = "endPoint" value = "" maxlength = "100" /><br></div>
	<div id="mapArea" style="display: none;"></div>
	<script>
         var infowindow;
      function initMap() {
        var map = new google.maps.Map(document.getElementById('mapArea'), {
          mapTypeControl: false,
          center: {lat: 13.7197244, lng: 100.77853735},
          zoom: 18
        });

        new AutocompleteDirectionsHandler(map);
      }

       /**
        * @constructor
       */
      function AutocompleteDirectionsHandler(map) {
        this.map = map;
        this.originPlaceId = null;
        this.destinationPlaceId = null;
        this.travelMode = 'TRANSIT';
        var originInput = document.getElementById('origin-input');
        var destinationInput = document.getElementById('destination-input');
        var modeSelector = document.getElementById('mode-selector');
        this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer;
        this.directionsDisplay.setMap(map);

        var originAutocomplete = new google.maps.places.Autocomplete(
            originInput, {placeIdOnly: false});
        var destinationAutocomplete = new google.maps.places.Autocomplete(
            destinationInput, {placeIdOnly: false});

        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

        // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
        // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(destinationInput);
        // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);

      }

      // Sets a listener on a radio button to change the filter type on Places

var sss = 0;
		var locatS = "", locatD = "";
      AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);
        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();
          if (!place.place_id) {
            //window.alert("Please select an option from the dropdown list.");
            return;
          }
          if (mode === 'ORIG') {
            me.originPlaceId = place.place_id;
			  locatS = document.getElementById('origin-input').value;
			  sss++;
          } else {
            me.destinationPlaceId = place.place_id;
			  locatD = document.getElementById('destination-input').value;
			  sss++;
          }
          me.route();
			if(sss == 2) {
				$('#container').css('animation', 'fadeOutLeft .5s forwards');
					setTimeout(function() {
						loadComponent('https://ycc.wasumi.site/selectS' ,'#container', function() {
						$('#container').css('animation', 'fadeInRight .5s forwards');
					});
				}, 500);
			}
			
        });

      };

      AutocompleteDirectionsHandler.prototype.route = function() {
        if (!this.originPlaceId || !this.destinationPlaceId) {
          return;
        }
        var me = this;

        // alert(this.originPlaceId);
        

        this.directionsService.route({
          origin: {'placeId': this.originPlaceId},
          destination: {'placeId': this.destinationPlaceId},
          travelMode: this.travelMode
        }, function(response, status) {
          if (status === 'OK') {
            me.directionsDisplay.setDirections(response);

            
            console.log(response.routes[0].legs[0].start_location.lat());
            console.log(response.routes[0].legs[0].start_location.lng());

            console.log(response.routes[0].legs[0].end_location.lat());
            console.log(response.routes[0].legs[0].end_location.lng());
            
          } else {
            //window.alert('Directions request failed due to ' + status);
          }
        });
      };

      </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlo1seeglVpbmgN57PvzI49ifO0igq3AA&libraries=places&callback=initMap"
        async defer></script>
</div>