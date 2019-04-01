<style>
	#mapContain {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 100%;
		min-height: 300px;
	}
	
	#mapContain P {
		margin: 0;
		font-size: 30px;
		text-align: center;
		color: black;
	}
</style>
<div id="mapContain" onclick="goEnd()">
	<div id="mapArea" style="width: 100%; height: 300px;"></div>
	<div style="width: 80%; margin: 0 auto;">
		<h2 style="
		    text-align: center;
    color: white;
    font-size: 50px;
    font-weight: 100;
    margin: 10px 0 20px 0;
	">อีก 20 นาที ถึงที่หมาย</h2>
	<p>จุดเริ่มต้น</p>
	<div class="input"><i class="fas fa-map-marker-alt"></i><input id="origin-input" type = "text" name = "startPoint" value = "" maxlength = "100" /><br></div>
	<p>จุดหมายปลายทาง</p> 
	<div class="input"><i class="fas fa-map-marked-alt"></i><input id="destination-input" type = "text" name = "endPoint" value = "" maxlength = "100" /><br></div>
	</div>
	
	<script>
		$('#origin-input').val(locatS);
			$('#destination-input').val(locatD);
	</script>
	
</div>
<div style="display: none;">
	<input id="origin-input" type = "text" name = "startPoint" value = "สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง ถนน ฉลองกรุง แขวง ลาดกระบัง เขต ลาดกระบัง กรุงเทพมหานคร ประเทศไทย" maxlength = "100" />
	<input id="destination-input" type = "text" name = "endPoint" value = "ป้ายรถประจำทาง สนามบินสุวรรณภูมิ 1 หนองปรือ บางพลี สมุทรปราการ ประเทศไทย" maxlength = "100" />
</div>
<script>
	function goEnd() {
		$('#container').css('animation', 'zoomOutIn .5s forwards');
					setTimeout(function() {
						loadComponent('https://ycc.wasumi.site/nfc2' ,'#container', function() {
							$('#container').css('animation', 'zoomIn 1s forwards');
						});
					}, 500);
	}
	
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

        /*var originAutocomplete = new google.maps.places.Autocomplete(
            originInput, {placeIdOnly: false});
        var destinationAutocomplete = new google.maps.places.Autocomplete(
            destinationInput, {placeIdOnly: false}); */
		
		  //calculateAndDisplayRoute(directionsService, directionsDisplay);
        //this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        //this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

        // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
        // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(destinationInput);
        // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);

      }
	
	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    directionsService.route({
        origin: "",
        destination: directionsDisplay,
        travelMode: google.maps.TravelMode.TRANSIT
    }, function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

      // Sets a listener on a radio button to change the filter type on Places


      AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);
        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();
          if (!place.place_id) {
            window.alert("Please select an option from the dropdown list.");
            return;
          }
          if (mode === 'ORIG') {
            me.originPlaceId = place.place_id;
          } else {
            me.destinationPlaceId = place.place_id;
          }
          me.route();
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
            window.alert('Directions request failed due to ' + status);
          }
        });
      };

      </script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlo1seeglVpbmgN57PvzI49ifO0igq3AA&libraries=places&callback=initMap&origin=&destination=13.7242725,100.7196503"
        async defer></script>