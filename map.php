<!DOCTYPE html>
<?php 
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

        <title>Term Project</title>

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

    <div id="map">

        <script>
            function initMap(){
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 8,
                    center: {lat: 33.951935, lng: -83.357567}
                });
                var geocoder = new google.maps.Geocoder();

                $(document).ready(function(){
                    geocodeAddress(geocoder, map);

                });



                function geocodeAddress(geocoder, resultsMap) {
                    var address = '<?php echo $_SESSION['location']; ?>';


                    geocoder.geocode({'address': address}, function(results, status) {
                        if (status === 'OK') {

                            <?php foreach($_SESSION["companies"] as &$value){
                                                       
                            ?>
                                resultsMap.setCenter(results[0].geometry.location);
                                var marker = new google.maps.Marker({
                                    //	icon:'marker.png',
                                    map: resultsMap,
                                    position: results[0].geometry.location
                                });

                                latitude = results[0].geometry.location.lat();
                                longitude = results[0].geometry.location.lng();
                                var radius = '<?php echo $_SESSION['radius']; ?>';
                                // content string for window stuff
                                var contentString = "";
                                //info window stuff
                                var infowindow = new google.maps.InfoWindow({
                                    content: contentString
                                });
                                google.maps.event.addListener(marker, 'mouseover', function() {
                                    infowindow.open(map,marker);
                                });
                            <?php 
                                }
                            ?>
                            //                        
                            //ajax call
                            //                            $.ajax({
                            //								type: "GET",       //Get method
                            //                               // dataType: 'json',   //response return type
                            //                                url: 'search.php', //the file the call goes to
                            //                                data:{              //the variables passed through
                            //                                    keyword: keyword,
                            //                                    latitude: latitude,
                            //                                    longitude: longitude,
                            //                                    radius: radius,
                            //                                    max: max
                            //                                },
                            //                                
                            //                                success: function(data){  //what to do when the method call succeeds
                            //								 //alert(data); //returns the data pass in an alert (for testing)
                            //                                  //  $("#results").html(data);
                            //                                    console.log(data);
                            //                                    
                            //                                    //content string for window stuff
                            //                                    var contentString = data;
                            //                                    //info window stuff
                            //                                    var infowindow = new google.maps.InfoWindow({
                            //                                        content: contentString
                            //                                    });
                            //                                    google.maps.event.addListener(marker, 'mouseover', function() {
                            //                                        infowindow.open(map,marker);
                            //                                    });
                            //                                },
                            //                                error: function( xhr, status, errorThrown ) {  //what to do when the method call fails
                            //                                    alert( "Sorry, there was a problem!" );
                            //                                    console.log( "Error: " + errorThrown );
                            //                                    console.log( "Status: " + status );
                            //                                    console.dir( xhr );
                            //                              }
                            //                        });
                        } else {
                            alert('Geocode was not successful for the following reason: ' + status);
                        }

                    });
                }
            }
        </script>    


    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9A2a6sTMO8RS1RcE4yHEsSr24I1FKcD8&callback=initMap" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</body>