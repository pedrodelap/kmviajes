<?php

class CallApi{
    
   /* $response = httpPost("http://mywebsite.com/update.php",
	    array("first_name"=>"Bob","last_name"=>"Dillon")
    );*/

//using php curl (sudo apt-get install php-curl) 
function httpPost($url, $data){
    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
}

?>