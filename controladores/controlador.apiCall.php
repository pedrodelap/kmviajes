<?php

    class CallApi{
        
    /* $response = httpPost("http://mywebsite.com/update.php",
            array("first_name"=>"Bob","last_name"=>"Dillon")
        );*/

        //using php curl (sudo apt-get install php-curl) 
        public static function httpPost2($url,$data){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\r\n    \"language\": \"es\",\r\n    \"command\": \"SUBMIT_TRANSACTION\",\r\n    \"merchant\": {\r\n        \"apiKey\": \"4Vj8eK4rloUd272L48hsrarnUA\",\r\n        \"apiLogin\": \"pRRXKOl8ikMmt9u\"\r\n    },\r\n    \"transaction\": {\r\n        \"order\": {\r\n            \"accountId\": \"512323\",\r\n            \"referenceCode\": \"4bbe12f750b81661b08cddec42dad6\",\r\n            \"description\": \"Class aptent taciti sociosqu ad litora torquent per conubia nostra\",\r\n            \"language\": \"es\",\r\n            \"signature\": \"05dbe5ec629237f44d6942f6d9b0996e\",\r\n            \"additionalValues\": {\r\n                \"TX_VALUE\": {\r\n                    \"value\": \"1600\",\r\n                    \"currency\": \"USD\"\r\n                }\r\n            },\r\n            \"buyer\": {\r\n                \"dniNumber\": \"8888888\",\r\n                \"emailAddress\": \"CORREO@GMAIL.COM\",\r\n                \"fullName\": \"Ricardo Rodriguez\",\r\n                \"shippingAddress\": {\r\n                    \"country\": \"PE\",\r\n                    \"phone\": \"99999999\"\r\n                },\r\n                \"dniType\": \"DNI\",\r\n                \"contactPhone\": \"99999999\"\r\n            },\r\n            \"shippingAddress\": {\r\n                \"country\": \"PE\",\r\n                \"phone\": \"99999999\"\r\n            }\r\n        },\r\n        \"payer\": {\r\n            \"dniNumber\": \"8888888\",\r\n            \"emailAddress\": \"CORREO@GMAIL.COM\",\r\n            \"fullName\": \"Ricardo Rodriguez\",\r\n            \"dniType\": \"DNI\",\r\n            \"billingAddress\": {\r\n                \"country\": \"PE\",\r\n                \"phone\": \"99999999\"\r\n            },\r\n            \"contactPhone\": \"99999999\",\r\n            \"merchantPayerId\": \"275\"\r\n        },\r\n        \"creditCard\": {\r\n            \"number\": \"4111111111111111\",\r\n            \"securityCode\": \"147\",\r\n            \"expirationDate\": \"2020\\/12\",\r\n            \"name\": \"Ricardo Rodriguez\",\r\n            \"processWithoutCvv2\": false\r\n        },\r\n        \"extraParameters\": {\r\n            \"INSTALLMENTS_NUMBER\": 0\r\n        },\r\n        \"type\": \"AUTHORIZATION_AND_CAPTURE\",\r\n        \"paymentMethod\": \"VISA\",\r\n        \"paymentCountry\": \"PE\"\r\n    },\r\n    \"test\": true\r\n}",
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            echo $response;
        }
        public static function  httpPost($url, $data){


            $curl = curl_init($url);
           
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($curl, CURLOPT_HTTP_VERSION , "CURL_HTTP_VERSION_1_1" );
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);    
        
            
            $data = curl_exec($curl);
            curl_close($curl);

            $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $data);
            $xml = new \SimpleXMLElement($data);
            $array = json_decode(json_encode((array)$xml), TRUE);
            //print_r($array);
            return $array;
        }
    }
?>


<?php
/*


*/