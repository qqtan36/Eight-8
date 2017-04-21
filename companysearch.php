<?php 
    session_start();

    //get all the form variables
    $title = $_GET["title"];
    $location = $_GET["location"];
    $radius = $_GET["radius"];
    $position = $_GET["position"];

    //store location and radius into session variables bc the google map needs them to function
    $_SESSION['location'] = $location;
    $_SESSION['radius'] = $radius;

    //api url
    $service_url = 'http://api.glassdoor.com/api/api.htm?t.p=143255&t.k=feruwLf5Ofc&userip=127.0.0.1&useragent=Chrome/57.0.2987.133&format=json&v=1&action=employers&city=athens&state=georgia';
    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    if ($curl_response === false) {
        $info = curl_getinfo($curl);
        curl_close($curl);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    }
    curl_close($curl);

    //decodes json response to an array
    $decoded = json_decode($curl_response);
    if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
        die('error occured: ' . $decoded->response->errormessage);
    }
   // echo $_SESSION['location'];

   // var_export($decoded->response);
   // echo $decoded->response;
    header("Location: map.php");
?>