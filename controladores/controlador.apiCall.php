<?php

    class CallApi{
        
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


        function DownloadInvoice($url, $data, $filename) {

            $pathFile = $_SERVER['DOCUMENT_ROOT'].'/PDF/invoice/'.$filename.'.pdf';
            if(!file_exists($pathFile)){
                $CurlConnect = curl_init($url);
            
                curl_setopt($CurlConnect, CURLOPT_POST, true);
                curl_setopt($CurlConnect, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($CurlConnect, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($CurlConnect, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MDU4MDkzMDUsInVzZXJuYW1lIjoiS01WaWFqZXMiLCJjb21wYW55IjoiMjA2MDIwMDgyODMiLCJleHAiOjQ3NTk0MDkzMDV9.oSbpqdYrtlLHuscs9GnvqxQFwnBvdmkQkF9osX4tjUReWFSwNGMh4e5oM8OSe8Mxu-w5MkUyT-2rk9wwfMjXLxq7w7DK5_9G8QRaHWHp8WUepH-UtufSsGRs1IXImHU49k-YbydmNuT7To7NGIkJFTCZ4J9bPQsGNVaPtplPjvHwwMIZN_DoxgQQDZTGaZMM72wAxlRhJ3MGx82Re_xncJr8QeiLhE9EV4Phzrc103gVh-IWBMYQmFeR4c0eiLatdpbx8XFEUFhVBX5KbJD10SX9NDFcA1sgOGk0H9_tlMTmyGWJ4maTXrbKmxQbzmS0fr-SsepJBZPC5Y8XvbfzMRQC7EZ121Yy_gRWQCju7EX7a3q61TWspHDhmaQ6jTWFLKQwi_pXDti3xtAWh1XRAA7Hwz2RAoQgeK2gRkt92j5N5hvp-sIsnTQwQXwuiOgUl-VpsQVVtfQCh091eS55SevRIVFIYM_FldP30_g78p1qWoH-TxnSJrTTFZwjTgm6sFX6oTDfbZj3k1Ijlci6VdXiNiAPmABs0rxSqlb_164eMKV-UIKUkXoQF0GFs_NItghyzysPFAiMyS52W-njguQprlHnnK5ql0044hyASrp5PbogK2EwXRaMQwcXMYEKmB76pN5Z3nA6LudPd3eEi8Cu-Ug-qXXToyzwIX3gUUQ'));
                curl_setopt($CurlConnect, CURLOPT_HTTP_VERSION , "CURL_HTTP_VERSION_1_1" );
                curl_setopt($CurlConnect, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($CurlConnect, CURLOPT_SSL_VERIFYPEER, FALSE);  

                $Result = curl_exec($CurlConnect);
                
                file_put_contents($pathFile, $Result);
                echo $Result;
            }
            else{
                echo 'exist';
            }
        }


        public static function httpPostJson($url, $data){

            $curl = curl_init($url);
           
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization:Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MDU4MDkzMDUsInVzZXJuYW1lIjoiS01WaWFqZXMiLCJjb21wYW55IjoiMjA2MDIwMDgyODMiLCJleHAiOjQ3NTk0MDkzMDV9.oSbpqdYrtlLHuscs9GnvqxQFwnBvdmkQkF9osX4tjUReWFSwNGMh4e5oM8OSe8Mxu-w5MkUyT-2rk9wwfMjXLxq7w7DK5_9G8QRaHWHp8WUepH-UtufSsGRs1IXImHU49k-YbydmNuT7To7NGIkJFTCZ4J9bPQsGNVaPtplPjvHwwMIZN_DoxgQQDZTGaZMM72wAxlRhJ3MGx82Re_xncJr8QeiLhE9EV4Phzrc103gVh-IWBMYQmFeR4c0eiLatdpbx8XFEUFhVBX5KbJD10SX9NDFcA1sgOGk0H9_tlMTmyGWJ4maTXrbKmxQbzmS0fr-SsepJBZPC5Y8XvbfzMRQC7EZ121Yy_gRWQCju7EX7a3q61TWspHDhmaQ6jTWFLKQwi_pXDti3xtAWh1XRAA7Hwz2RAoQgeK2gRkt92j5N5hvp-sIsnTQwQXwuiOgUl-VpsQVVtfQCh091eS55SevRIVFIYM_FldP30_g78p1qWoH-TxnSJrTTFZwjTgm6sFX6oTDfbZj3k1Ijlci6VdXiNiAPmABs0rxSqlb_164eMKV-UIKUkXoQF0GFs_NItghyzysPFAiMyS52W-njguQprlHnnK5ql0044hyASrp5PbogK2EwXRaMQwcXMYEKmB76pN5Z3nA6LudPd3eEi8Cu-Ug-qXXToyzwIX3gUUQ'));     
            curl_setopt($curl, CURLOPT_HTTP_VERSION , "CURL_HTTP_VERSION_1_1" );
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);    
        
            
            $data = curl_exec($curl);
            curl_close($curl);

            echo $data;
            $json = file_get_contents("php://input");
            $array = json_decode($json, true);
            return $array;
        }
    }
?>