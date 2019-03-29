 <style type="text/css">

div#hd {
    text-align: center;
    border-bottom: 2px solid black;
}
div#hd h1 {
    margin-bottom: 0;
    font-size: 1.5em;
}
div#ft {
    border-top: 2px solid black;
}
div#ft p {
    width: 500px;
    margin: 1em auto;
}
p#builtby {
    font-size: 0.8em;
    text-align: right;
    color: #666;
}
div#bd {
    position: relative;
}
div#gmap {
    width: 100%;
    height: 400px; /* If you change this don't forget to change the crosshair position to match */
}
div#crosshair {
    position: absolute;
    top: 192px;
    height: 19px;
    width: 19px;
    left: 50%;
    margin-left: -8px;
    display: block;
    background-position: center center;
    background-repeat: no-repeat;
}
</style>
<script src="http://www.google.com/jsapi?key=AIzaSyCEpYCT485k5-L35fgK7lTPYP4taoEH1XM" type="text/javascript">
</script>
<script type="text/javascript">
google.load('maps', '2'); // Load version 2 of the Maps API


function updateLatLonFields(lat, lon) {
document.getElementById("latitude").value=lat;
document.getElementById("longitude").value=lon;
    document.getElementById("latlon").innerHTML = lat + ', ' + lon;
    document.getElementById("wkt").innerHTML = 'POINT('+lon+' '+lat +')';
}

function getOSMMapType() {
    // Usage: map.addMapType(getOSMMapType());
    var copyright = new GCopyrightCollection(
        '<a href="http://www.openstreetmap.org/">OpenStreetMap</a>'
    );
    copyright.addCopyright(
        new GCopyright(1, new GLatLngBounds(
            new GLatLng(-90, -180),
            new GLatLng(90, 180)
        ), 0, ' ')
    );
    var tileLayer = new GTileLayer(copyright, 1, 18, {
        tileUrlTemplate: 'http://tile.openstreetmap.org/{Z}/{X}/{Y}.png', 
        isPng: false
    });
    var mapType = new GMapType(
        [tileLayer], G_NORMAL_MAP.getProjection(), 'OSM'
    );
    return mapType;
}

function showMap() {
    window.gmap = new google.maps.Map2(document.getElementById('gmap'));
    gmap.addControl(new google.maps.LargeMapControl());
    gmap.addControl(new google.maps.MapTypeControl());
    gmap.addMapType(getOSMMapType());    
    gmap.enableContinuousZoom();
    gmap.enableScrollWheelZoom();
    
    var timer = null;
    
    google.maps.Event.addListener(gmap, "move", function() {
        var center = gmap.getCenter();
        updateLatLonFields(center.lat(), center.lng());
        
      
      
       
        
    });
    google.maps.Event.addListener(gmap, "zoomend", function(oldZoom, newZoom) {
        document.getElementById("zoom").innerHTML = newZoom;
    });
    google.maps.Event.addDomListener(document.getElementById('crosshair'),
        'dblclick', function() {
            gmap.zoomIn();
        }
    );
    
    // Default view of the world
 var defaultlat=document.getElementById("googlelat").value;
 var defaultlng=document.getElementById("googlelng").value;
	
    gmap.setCenter(
        new google.maps.LatLng(defaultlat, defaultlng), 13
    );
    
    /* If we have a best-guess for the user's location based on their IP, 
       show a "zoom to my location" link */
    if (google.loader.ClientLocation) {
        var link = document.createElement('a');
        link.onclick = function() {
            gmap.setCenter(
                new google.maps.LatLng(
                    google.loader.ClientLocation.latitude,
                    google.loader.ClientLocation.longitude
                ), 8
            );
            return false;
        }
      
        var form = document.getElementById('geocodeForm');
        var p = form.getElementsByTagName('p')[0];
        p.appendChild(link);
    }
    
    // Set up Geocoder
    window.geocoder = new google.maps.ClientGeocoder();
    
    // If query string was provided, geocode it
  /*  var bits = window.location.href.split('?');
    if (bits[1]) {
        var location = decodeURI(bits[1]);
        document.getElementById('geocodeInput').value = location;
        geocode(location);
    }*/
   // alert('');
    // Set up the form
    var geocodeForm = document.getElementById('Reload');
    geocodeForm.onclick = function() {
	//var county =  'united state of america';//document.getElementsByName('rental_location').value;
	var city =  document.getElementsByName('city').value;
	//var county =  '';
	//var city = '';

	//alert(county);
	var AddresS =  document.getElementById('address').value;
	var StatE =  document.getElementById('state').value;	
	var postCode =  document.getElementById('post_code').value;	
		

	
	var newaddress = city +','+ AddresS +','+StatE+','+postCode;
	//var newaddress = addre + ',' + city + '-' + zipcode + ',' +state + ',' + country + ',' + Continent;
	document.getElementById('geocodeInput').value=newaddress;
    geocode(document.getElementById('geocodeInput').value);
    return false;
    }
}

var accuracyToZoomLevel = [
    1,  // 0 - Unknown location
    5,  // 1 - Country
    6,  // 2 - Region (state, province, prefecture, etc.)
    8,  // 3 - Sub-region (county, municipality, etc.)
    11, // 4 - Town (city, village)
    13, // 5 - Post code (zip code)
    15, // 6 - Street
    16, // 7 - Intersection
    17, // 8 - Address
    17  // 9 - Premise
];

function geocodeComplete(result) {

    if (result.Status.code != 200) {
        alert('Could not geocode "' + result.name + '"');
        return;
    }
    var placemark = result.Placemark[0]; // Only use first result
    var accuracy = placemark.AddressDetails.Accuracy;
    var zoomLevel = accuracyToZoomLevel[accuracy] || 1;
	//var	zoomLevel = 'auto'; // custom zoom level
    var lon = placemark.Point.coordinates[0];
    var lat = placemark.Point.coordinates[1];
    gmap.setCenter(new google.maps.LatLng(lat, lon), zoomLevel);
}

function geocode() {
	//var county =  'united states of america';//document.getElementById('rental_location').value;
	var city =  document.getElementById('city').value;
//	var county =  '';
//	var city = '';

	//alert(county);
	var AddresS =  document.getElementById('address').value;
	var StatE =  document.getElementById('state').value;	
	var postCode =  document.getElementById('post_code').value;	
	
	var location = city +','+ AddresS +','+StatE+','+postCode;
    geocoder.getLocations(location, geocodeComplete);
	
}

google.setOnLoadCallback(showMap);
</script>
<script type="text/javascript">
  //  var marker=null;

    function initialize()
    {
		
        var secheltLoc = new google.maps.LatLng(13.0817317, 80.1847167);
        var myMapOptions = {
            zoom:15, center:secheltLoc, mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var theMap = new google.maps.Map(document.getElementById("gmap"), myMapOptions);
        marker = new google.maps.Marker({
            map:theMap,
            draggable:true,
            position:new google.maps.LatLng(13.0817317, 80.1847167),
            visible:true
        });
    }
    function getLatLong()
    {
        alert(marker.position);
    }

	
function Addressfunction()
{
var addre = document.getElementById('address').value;
    var city =  document.getElementById('city').value;
	var state = document.getElementById('hidState').value;
	var zipcode = document.getElementById('zipcode').value;
	var country = document.getElementById('hidCountry').value;
	var Continent = document.getElementById('hidContinent').value;
	var newaddress = addre + ',' + city + '-' + zipcode + ',' +state + ',' + country + ',' + Continent;
	document.getElementById("div_mapinfo").innerHTML = "<div class='tipsy-inner'>Address location will be suggested on following address</br></br><strong>"+newaddress+"</strong></div><div class='tipsy-arrow'></div>";
}
</script>
