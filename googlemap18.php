<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="js/gmap3.min.js" type="text/javascript"></script>
 <script type="text/javascript">
          $(function(){
        var latval = $("#lat").val();
	   var lngval = $("#lng").val();
	   var descval = $("#name").val();
	   var img = '<div style="margin:5px 0 0 0;"><div style="width:140px;height:110px;float:left;"></div><div style="float:right;">Lat:'+latval+'Long:'+lngval+'</div></div>';
     $('#test').gmap3(
          { action:'init',
            options:{
              center:[latval,lngval],
              zoom: 15
            }
          },
          { action: 'addMarkers',
            markers:[
              {lat:latval, lng:lngval, data:img}
            ],
            marker:{
              options:{
                draggable: false
              },
              events:{
                mouseover: function(marker, event, data){
                  var map = $(this).gmap3('get'),
                      infowindow = $(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.open(map, marker);
                    infowindow.setContent(data);
                  } else {
                    $(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});
                  }
                },
                mouseclick: function(){
                  var infowindow = $(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.close();
                  }
                }
              }
            }
          }
        );
      });
      $(function(){
        $('#test-ok').click(function(){
          var address = $('#test-address').val();
		  var addr = address;
          if ( !addr || !addr.length ) return;
          $("#test").gmap3({
            action:   'getlatlng',
            address:  addr,
			zoom:15,
            callback: function(results){
              if ( !results ) return;
              $(this).gmap3({
                action:'addMarker',
                latLng:results[0].geometry.location,
                map:{
                  center: true
                }
              });
			  $("#lat").val(results[0].geometry.location.lat());
			  $("#lng").val(results[0].geometry.location.lng());
            }
          });
        });
        
		$('#test-address').keyup(function(){
           var address = $('#test-address').val();
		  var addr = address;          if ( !addr || !addr.length ) return;
          $("#test").gmap3({
            action:   'getlatlng',
            address:  addr,
			zoom:15,
            callback: function(results){
              if ( !results ) return;
              $(this).gmap3({
                action:'addMarker',
                latLng:results[0].geometry.location,
                map:{
                  center: true
                }
			  }); 
			  $("#lat").val(results[0].geometry.location.lat());
			  $("#lng").val(results[0].geometry.location.lng());
            }
          });
       
		});
		
        $('#test-address').keypress(function(e){
          if (e.keyCode == 13){
            $('#test-ok').click();
          }
        });
      });

    </script> 

   <style>
  
      #ctrl{
        width: 370px;
        height: 200px;
        margin:0 auto;
      }
      .gmap3{
        border: 1px dashed #C0C0C0;
        width: 370px;
        height: 200px;
      }
    </style>





		