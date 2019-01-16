<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX&libraries=geometry"></script>
<!-- https://maps.googleapis.com/maps/api/js -->
<!-- AIzaSyDgzNrN0i8WNwm3bOiWFeXt_bQFy4Vr5Vs -->
<!-- &callback=initMap -->
   <script type="text/javascript">
   var markers = [
    
       //      {
       //         "title": 'Alibaug',
       //         "lat": '18.641400',
       //         "lng": '72.872200',
       //         "description": 'Alibaug is a coastal town and a municipal council in Raigad District in the Konkan region of Maharashtra, India.'
       //     }
    
       // ,
    
            {
               "title": 'Mumbai',
               "lat": '6.492988333333333',
               "lng": '3.599058333333333',
               "description": 'Mumbai formerly Bombay, is the capital city of the Indian state of Maharashtra.'
           }
    
       ,
    
            {
               "title": 'Pune',
               "lat": '6.4531',
               "lng": '3.3958',
               "description": 'Pune is the seventh largest metropolis in India, the second largest in the state of Maharashtra after Mumbai.'
           }
    
   ];

   var styles = [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#ebe3cd"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#523735"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#f5f1e6"
      }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#c9b2a6"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#dcd2be"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#ae9e90"
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dfd2ae"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dfd2ae"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#93817c"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#a5b076"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#447530"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#f5f1e6"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#fdfcf8"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#f8c967"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#e9bc62"
      }
    ]
  },
  {
    "featureType": "road.highway.controlled_access",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#e98d58"
      }
    ]
  },
  {
    "featureType": "road.highway.controlled_access",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#db8555"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#806b63"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dfd2ae"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#8f7d77"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#ebe3cd"
      }
    ]
  },
  {
    "featureType": "transit.station",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dfd2ae"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#b9d3c2"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#92998d"
      }
    ]
  }
];

   </script>
   <script type="text/javascript">

    var EventBus = {};

    (function($eb){

      var listeners = {};

       $eb.Subscribe = function(subject,cb){
          if (!listeners[subject]){
             listeners[subject] = [];
          }
          listeners[subject].push(cb);
       };

       $eb.Notify = function(subject,message){
          if (listeners[subject]){
            listeners[subject].forEach(function(v,k){
              v(message);
            });
          }
       };

    })(EventBus);

    var geo = {};
    
    geo.map = null;
    geo.path = null;
    geo.service = null;
    geo.infoWindow = null;
    geo.poly = null;
    geo.markers = [];
    geo.geocoder = null;
    geo.bounds = null;

    

    ///InitMap
    EventBus.Subscribe('InitMap',function(config){
           var mapOptions = {
               center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
               zoom: 8,
               mapTypeId: google.maps.MapTypeId.ROADMAP,
               styles:styles
           };
           
           geo.path = new google.maps.MVCArray();
           geo.service = new google.maps.DirectionsService();
 
           geo.infoWindow = new google.maps.InfoWindow();
           geo.map = new google.maps.Map(document.getElementById(config.mapId), mapOptions);
           geo.poly = new google.maps.Polyline({ map: geo.map, strokeColor: '#443b31' }); //#FF8200
           geo.geocoder = new google.maps.Geocoder();
           
           geo.bounds = new google.maps.LatLngBounds();

    });

    //Alias InitMap (ClearMap) 
    EventBus.Subscribe('ClearMap',function(config){
       EventBus.Notify('InitMap',config);
    });


    ////AddMarkers
    EventBus.Subscribe('AddMarkers',function(config){
       
          EventBus.Notify('MapRemoveMarkers');  

           var lat_lng = [];


            function pinSymbol(color) {
                return {
                    path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
                    fillColor: color,
                    fillOpacity: 1,
                    strokeColor: '#FFF',
                    strokeWeight: 2,
                    scale: 1,
               };
            }

            function pinTaxiSymbol(color){
                return {
                    path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
                    fillColor: color,
                    fillOpacity: 1,
                    strokeColor: '#00FF00',
                    strokeWeight: 2,
                    scale: 1,
               };
            }

// var marker = new GMarker(map.getCenter(), {icon: newIcon});

           for (i = 0; i < config.markers.length; i++) {
               var data = config.markers[i]
               var myLatlng = new google.maps.LatLng(data.lat, data.lng);
               lat_lng.push(myLatlng);
               var marker = new google.maps.Marker({
                   position: myLatlng,
                   map: geo.map,
                   title: data.title,
                   icon: pinSymbol("#000")
               });

               geo.markers.push(marker); //cache marker

               // pinSymbol("#FFF")

               (function (marker, data) {
                   google.maps.event.addListener(marker, "click", function (e) {
                       geo.infoWindow.setContent(data.description);
                       geo.infoWindow.open(geo.map, marker);
                   });
               })(marker, data);
           }
    });


    ///DrawPath
    EventBus.Subscribe('DrawPath',function(config){

           var lat_lng = [];
           geo.path.clear(); //clear the path first.

           for (i = 0; i < config.markers.length; i++) {
               var data = config.markers[i]
               var myLatlng = new google.maps.LatLng(data.lat, data.lng);
               lat_lng.push(myLatlng);

           }

           for (var i = 0; i < lat_lng.length; i++) {
               if ((i + 1) < lat_lng.length) {
                   var src = lat_lng[i];
                   var des = lat_lng[i + 1];
                   geo.path.push(src);
                   geo.poly.setPath(geo.path);
                   geo.service.route({
                       origin: src,
                       destination: des,
                       travelMode: google.maps.DirectionsTravelMode.DRIVING
                   }, function (result, status) {
                       if (status == google.maps.DirectionsStatus.OK) {
                           for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                               geo.path.push(result.routes[0].overview_path[i]);
                           }
                       }
                   });
               }
           }

    });


    EventBus.Subscribe('ZoomMap',function(config){
      geo.map.setZoom(config.zoom);
    });

    EventBus.Subscribe('ZoomArroundMarkers',function(config){
      for (var i = 0; i < geo.markers.length; i++) {
       geo.bounds.extend(geo.markers[i].getPosition());
      }
      geo.map.fitBounds(geo.bounds);    

// map.fitBounds(bounds);
      var zoom = geo.map.getZoom();
      geo.map.setZoom(zoom > 6 ? 6 : zoom);

    });

    EventBus.Subscribe('MapComputeDistance',function(config){
      var latLngA = new google.maps.LatLng(config.locationA.lat, config.locationA.lng);
      var latLngB = new google.maps.LatLng(config.locationB.lat, config.locationB.lng);
      var result = (google.maps.geometry.spherical.computeDistanceBetween(latLngA, latLngB) / 1000).toFixed(2);

      console.log('Returns the distance in (KM).');

      EventBus.Notify('MapGetDistance',result);
    });

    EventBus.Subscribe('MapDrawRadiusRange',function(config){

      var marker = new google.maps.Marker({
        map: geo.map,
        position: new google.maps.LatLng(config.lat, config.lng),
        title: 'Some location'
      });

      geo.markers.push(marker); //cache marker

      // Add circle overlay and bind to marker
      var circle = new google.maps.Circle({
        map: geo.map,
        radius: (config.radius * 1000),    // 16093 => 10 miles in metres
        fillColor: '#b8bef0' //'#AA0000'
      });

      circle.bindTo('center', marker, 'position');

    });

    EventBus.Subscribe('MapRemoveMarkers',function(){
      //geo.markers.push(marker); //cache marker
      geo.markers.forEach(function(v,k){
        v.setMap(null);
      });
      geo.markers = [];

    });

    EventBus.Subscribe('MapRemovePolyLines',function(){
      geo.poly.setMap(null);
    });


    EventBus.Subscribe('MapGetAddressFromLatLng',function(config){ //lat,lng
 
       config.lat = +config.lat;
       config.lng = +config.lng;

       geo.geocoder.geocode({'location': config}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              EventBus.Notify('OnMapGetAddressFromLatLng',{
                address:results[0].formatted_address
              });
              console.log(results[0].formatted_address);
              // map.setZoom(11);
              // var marker = new google.maps.Marker({
              //   position: latlng,
              //   map: map
              // });
              // infowindow.setContent(results[0].formatted_address);
              // infowindow.open(map, marker);
            } else {

              EventBus.Notify('OnMapGetAddressFromLatLng',{
                address:'No results found'
              });  

              // window.alert('No results found');
            }
          } else {
              
              EventBus.Notify('OnMapGetAddressFromLatLng',{
                address:'Geocoder failed due to: ' + status
              });                          

            // window.alert('Geocoder failed due to: ' + status);
          }
        });

    });

    EventBus.Subscribe('MapGetLatLngFromPlaceId',function(config){

       config.tag = config.tag || 'tag';
       config.data = config.data || {};

        geo.geocoder.geocode({'placeId': config.placeId}, function(results, status) {

            if (status !== 'OK') {
              window.alert('Geocoder failed due to: ' + status);
              return;
            }

            // console.log(results[0].geometry.location);
            var result = {
              lat:results[0].geometry.location.lat(),
              lng:results[0].geometry.location.lng(),
              tag:config.tag,
              data:config.data
            } 

            console.log(result);

            EventBus.Notify('MapGottenLatLng',result);
            
        });           

    });

    EventBus.Subscribe('MapSearchPlaces',function(config){ //searchText,tag => raise event MapPlaceQueried
      config.tag = config.tag || 'tag';

      EventBus.Notify('AjaxStart',{});
      EventBus.Notify('MapClearDistance');

       jQuery.ajax({
        url:'http://r2soft.com.ng/map_get_place.php?searchText=' + config.searchText,
        type:'get',
        success:function(response){
         var json = JSON.parse(response);
         console.log(json);
         EventBus.Notify('AjaxStop',{});

         EventBus.Notify('MapPlaceQueried',{data:json,tag:config.tag});
        }
       });


    });

    EventBus.Subscribe('MapPlaceQueried',function(config){
      
      var list = [];
      var $obj = jQuery('#predictions-list');
      $obj.show();

      config.data.predictions.forEach(function(v,k){
        
        list.push('<div class="predictions-list-item" style="cursor:pointer;padding: 2px;border-bottom: 1px solid #ddd;padding-bottom: 4px;margin-bottom: 4px;" data-place-id="' + v.place_id + '">' + v.description + '</div>');

      });

      $obj.html(list.join(''));

      EventBus.Notify('MapBindToQueriedPlaces',{el:$obj,tag:config.tag});


    });

    EventBus.Subscribe('MapClearPlaces',function(config){
      var $obj = jQuery('#predictions-list');
      $obj.html('');
      $obj.hide();
    });


    EventBus.Subscribe('MapBindToQueriedPlaces',function(config){
       config.el.find('[data-place-id]').each(function(){
        
         var place_id = $(this).data('place-id');
         var label = $(this).html();

         if (config.tag == 'pickup'){

          $(this).on('click',function(){
             EventBus.Notify('MapPushToPickup',{placeId:place_id,label:label});   
             EventBus.Notify('MapClearPlaces',{});         
          });           

         }else if (config.tag == 'dropoff'){

          $(this).on('click',function(){
            EventBus.Notify('MapPushToDropOff',{placeId:place_id,label:label});            
            EventBus.Notify('MapClearPlaces',{});         
          });

         }

       });
    });


    EventBus.Subscribe('MapPushToPickup',function(config){
      var $el = jQuery('#pickup');
      $el.val(config.label);
      EventBus.Notify('MapGetLatLngFromPlaceId',{
        tag:'pickup',
        placeId:config.placeId,
        data:config
      });
    });

    EventBus.Subscribe('MapPushToDropOff',function(config){
      var $el = jQuery('#dropoff');
      $el.val(config.label);
      EventBus.Notify('MapGetLatLngFromPlaceId',{
        tag:'dropoff',
        placeId:config.placeId,
        data:config
      });      
    });


    EventBus.Subscribe('MapInitInputs',function(config){
 
         //dropoff
         jQuery(config.dropoff).on('keyup',function(){
          var vl = $(this).val();
          EventBus.Notify('MapSearchPlaces',{searchText:vl,tag:'dropoff'});
         });


         //pickup
         jQuery(config.pickup).on('keyup',function(){
          var vl = $(this).val();
          EventBus.Notify('MapSearchPlaces',{searchText:vl,tag:'pickup'});
         });


    });


    EventBus.Subscribe('AjaxStart',function(){
      jQuery('#ajax-status').show();
    });

    EventBus.Subscribe('AjaxStop',function(){
      jQuery('#ajax-status').hide();
    });


  EventBus.Subscribe('MapGetDistance',function(distanceKM){
    var $el = jQuery('#measured_distance');
    $el.show();//
    $el.html('Total Distance Coverred (KM) : ' + distanceKM);

          EventBus.Notify('StorageSave',{
            key:'LocationMeasuredDistance',
            data:{
              distance:distanceKM
            }
          })

  });

    EventBus.Subscribe('MapClearDistance',function(){
       var $el = jQuery('#measured_distance');
       $el.html('');  
       $el.hide();
    });

    EventBus.Subscribe('StorageSave',function(config){
       localStorage.setItem(config.key,JSON.stringify(config.data));
    });

    EventBus.Subscribe('StorageGet',function(config){
       var obj = localStorage.getItem(config.key); //,JSON.stringify(config.data));
       obj = JSON.parse(obj);
       EventBus.Notify('OnStorageGet' + config.key,{data:obj});
    });


    (function($markers){

      EventBus.Subscribe('MapGottenLatLng',function(config){ //
        $markers[config.tag] = {
          lat:config.lat,
          lng:config.lng,
          description:config.data.label
        };

        console.log($markers , 'Markers collator.');

        if ($markers.pickup && $markers.dropoff){

          EventBus.Notify('StorageSave',{
            key:'LocationSettings',
            data:$markers
          })
          
          EventBus.Notify('InitMap',{
            mapId:"dvMap"
          });

          var markers_ = [{
              lat:$markers.pickup.lat,
              lng:$markers.pickup.lng,
              description:$markers.pickup.description
            },{
              lat:$markers.dropoff.lat,
              lng:$markers.dropoff.lng,
              description:$markers.dropoff.description
            }];   

        // EventBus.Notify('ZoomMap',{
        //   zoom:15
        // });   





          EventBus.Notify('AddMarkers',{
            markers:markers_
          });

          EventBus.Notify('DrawPath',{
            markers:markers_
          });


        EventBus.Notify('ZoomArroundMarkers',{});    


        EventBus.Notify('MapComputeDistance',{
          locationA:{
            lat:$markers.dropoff.lat,
            lng:$markers.dropoff.lng
          },
          locationB:{
            lat:$markers.pickup.lat,
            lng:$markers.pickup.lng
          }
        });

        //measured_distance       



        }

      });

    })({});


    EventBus.Subscribe('OnStorageGetLocationSettings',function(config){
      console.log(config);
    });






 
       window.onload = function () {

        EventBus.Notify('InitMap',{
          mapId:"dvMap"
        });

        EventBus.Notify('AddMarkers',{
          markers:markers
        });

        EventBus.Notify('DrawPath',{
          markers:markers
        });

        EventBus.Notify('ZoomMap',{
          zoom:10
        });


        EventBus.Subscribe('MapGetDistance',function(result){
          console.log(result);
        });

        EventBus.Notify('MapComputeDistance',{
          locationA:{
            lat:markers[0]['lat'],
            lng:markers[0]['lng']
          },
          locationB:{
            lat:markers[1]['lat'],
            lng:markers[1]['lng']
          }
        });


        EventBus.Notify('MapDrawRadiusRange',{
          lat:markers[1]['lat'],
          lng:markers[1]['lng'],
          radius:11
        });


        EventBus.Notify('MapInitInputs',{
          pickup:'#pickup',
          dropoff:'#dropoff'
        });


       }
   </script>
   <div id="dvMap" style="width: 100%; height: 500px;">
   </div>



<style type="text/css">
  .predictions-list-item:hover{
    background-color: #329832;
    color: #fff;
  }  


  @media(max-width: 768px){

     .handle-mobile{
      width: 80% !important;
     }

  }
</style>



<div class="handle-mobile" style="position: absolute;top: 12%;margin-left: 11px;background-color: rgba(0,0,0,0.2);padding: 11px;width: 30%;">

  <input type="text" id="pickup" name="search" placeholder="PICKUP LOCATION" style="display: inline-block;padding: 9px;border: 1px solid #777;width: 90%;">


  <input type="text" id="dropoff" name="search" placeholder="DROPOFF LOCATION" style="display: inline-block;padding: 9px;border: 1px solid #777;width: 80%;margin-top: 11px;">

   <span style="
    background-color: #000;
    padding: 7px;
    display: inline-block;
    position: relative;
    top: 2px;
">
<svg viewBox="0 0 64 64" width="16px" height="16px" class=" _style_26XEsq" data-reactid="401" style="
    color: #fff;
    fill: currentColor;
"><path fill-rule="evenodd" clip-rule="evenodd" d="M59.9270592,31.9847012L60,32.061058L43.7665291,49.1333275l-3.2469215-3.5932007 L51.3236885,34H4v-4h47.3943481L40.5196075,18.4069672l3.2469215-3.4938126L60,31.946312L59.9270592,31.9847012z" data-reactid="402"></path></svg>     
   </span>

   <div id="ajax-status" style="display: none;">
     <img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/35771931234507.564a1d2403b3a.gif" style="height: 21px;">
   </div>
   
   <div id="predictions-list" style="
    padding: 5px;
    background-color: #fff;
    margin-top: 6px;
    border: 1px solid #777;
    display: none;
"></div>

   <div id="measured_distance" style="background-color: rgb(0, 0, 0); color: rgb(255, 255, 255); margin-top: 3px; padding: 3px;">Total Distance Coverred (KM) : 22.92</div>


</div>



</body>
</html>
