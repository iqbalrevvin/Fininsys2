<!DOCTYPE html>
<html>
  <head>
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
       /* Set the size of the div element that contains the map */
      	#map-canvas {
	        height: 400px;  /* The height is 400 pixels */
	        width: 100%;  /* The width is the width of the web page */
	   	}
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <div class="container">
			<div class="col-sm-4">
				<h1>Add Vendor</h1>
				<form action="{{ route('maps.add') }}" method="post">
					@csrf
					<div class="form-group">
						<label for="">Title</label>
						<input type="text" class="form-control input-sm" name="title">
					</div>
					<div class="form-group">
						<label for="">Map</label>
						<input type="text" id="searchmap">
						<div id="map-canvas"></div>
					</div>
					<div class="form-group">
						<label for="">Lat</label>
						<input type="text" class="form-control input-sm" name="lat" id="lat"></input>
					</div>
					<div class="form-group">
						<label for="">Lng</label>
						<input type="text" class="form-control input-sm" name="lng" id="lng"></input>
					</div>
					<button type="submit" class="btn btn-sm btn-success">Save</button>
				</form>
			</div>
		</div>
    <script>
    	var map;
		function initMap() {
  			map = new google.maps.Map(document.getElementById('map-canvas'),
            	{
            		center: new google.maps.LatLng(-0.479605238488001, 111.10447093749997), 
                    zoom: 6
            	}
            );

            var marker = new google.maps.Marker({
            	position: {
            		lat : -3.356108,
            		lng: 109.566385
            	},
            	map :map,
            	draggable: true
            });

            var searcBox = new google.maps.places.SearchBox(document.getElementById('searchmap'))
            google.maps.event.addListener(marker,'position_changed', function(){
            	var lat = marker.getPosition().lat();
            	var lng = marker.getPosition().lng();

            	$('#lat').val(lat);
            	$('#lng').val(lng);
            })
		}
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW_u3PHV3bRsMPlcR3ikqH9NFRfeccLQ8&callback=initMap&region=ID&libraries=places"
        type="text/javascript"></script> 
  </body>
</html>

