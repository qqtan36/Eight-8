<!DOCTYPE html>
<?php 
include 'company.php';
session_start();
//echo $_SESSION["location"];
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>InstaJob</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/cover.css" rel="stylesheet">
        <style>
            #map {
                height: 100%;
                width: 100%;
            }
        </style>

    </head>

</html>
<body>

    <div id="map" style="color:#000">

        <script>
            function initMap(){
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 8,
                    center: {lat: 33.951935, lng: -83.357567}
                });
                var geocoder = new google.maps.Geocoder();
                $(document).ready(function(){
                    var bounds = new google.maps.LatLngBounds();
                    var markers = new Array();
                    // geocodeAddress(geocoder, map);
                    <?php
                    for($x=0; $x< count($_SESSION["companies"]); $x++){
                        //echo var_export($value->getName());   
                    ?>
                    $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address=<?php echo $_SESSION["companies"][$x]->getName() ." ".$_SESSION["location"]?>&components=country:US', null, function (data) {
                        var contentString = "";
                        var p = data.results[0].geometry.location;

                        var latlng = new google.maps.LatLng(p.lat, p.lng);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                                // content string for window stuff
                                contentString = contentString+'<img src="'+'<?php echo $_SESSION["companies"][$x]->getLogo(); ?>'+'" height="50" width="50">'+'<?php echo $_SESSION["companies"][$x]->getName(); ?>'+'<br>'+'<b>Company Rating: </b>'+'<?php echo $_SESSION["companies"][$x]->getOverall();?>'
								+'<b>Pros: </b>'+'<?php echo $_SESSION["companies"][$x]->getPros();?>'+'<b>Cons: </b>'+'<?php echo $_SESSION["companies"][$x]->getCons();?>'+'<b>Website: </b>'+'<a href="http://'+'<?php echo $_SESSION["companies"][$x]->getWebsite(); ?>'+'" style="color:blue">'+'<?php echo $_SESSION["companies"][$x]->getWebsite();?>'+'</a>';
                                //info window stuff
                                var infowindow = new google.maps.InfoWindow({
                                    content: contentString
                                });
                                google.maps.event.addListener(marker, 'click', function() {
                                    infowindow.open(map,marker);
                                });
                        markers.push(marker);
                        //bounds.extend(marker.getPosition());
                             for(var i = 0; i <markers.length; i++ ){
                        bounds.extend(markers[i].getPosition());
                        map.setCenter(bounds.getCenter());

                        map.fitBounds(bounds);
                    }
                    });
                   
                    <?php 
                    }
                    ?>
                    
                    

                });
            }
        </script>    


    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9A2a6sTMO8RS1RcE4yHEsSr24I1FKcD8&callback=initMap" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</body>
