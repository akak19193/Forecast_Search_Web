<?php 
	
    header('Access-Control-Allow-Origin: *');
	$address = $_GET['address'];
	$city = $_GET['city'];
	$state = $_GET['state'];
	$degree = $_GET['degree'];
	$units = "us";

	if ($degree == "Celsius"){$units = "si";}
	//echo $address, $city, $state, $degree, $units;

	$para = "https://maps.googleapis.com/maps/api/geocode/xml?address=".$address.",".$city.",".$state."&key=AIzaSyAdZ2-nl1m-cAz-3HtnhR7cyOUaa5bn4TA";
    $para = str_replace(' ','+',$para);
    $file_contents1 = file_get_contents($para);
    $xml = simplexml_load_string($file_contents1);
    $lat = $xml->result->geometry->location->lat;
    $lng = $xml->result->geometry->location->lng;                      
    
    $para = "https://api.forecast.io/forecast/18406cabe666fd04d13dc8aff3611131/".$lat.",".$lng."?units=".$units."&exclude=flags";
    //https://api.forecast.io/forecast/18406cabe666fd04d13dc8aff3611131/34.027699,-118.290479?units=us&exclude=flags
    $file_contents2 = file_get_contents($para);
    $file_contents2 = utf8_encode($file_contents2);

    echo $file_contents2;


    
?>