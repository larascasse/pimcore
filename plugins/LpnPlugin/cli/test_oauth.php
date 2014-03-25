<?php

function getAuthenticationHeaderWrap(){
        // Password
     
        
        // Construct the body for the STS request
        $authenticationRequestBody = 
                    'wrap_name='.'OBDAzure'
                    .'&'.'wrap_password='.urlencode('7R64w4V2CG2XKic149R0HDyKWS8G2fn2PA2rpW1tEAQ=')
                    .'&'.'wrap_scope='.urlencode('http://obdazureservicecloud.cloudapp.net/AcsObdService/'

                    );
        
        //Using curl to post the information to STS and get back the authentication response    
        $ch = curl_init();
        // set url 
        $stsUrl = 'https://acsobdazure.accesscontrol.windows.net/WRAPv0.9/';        
        curl_setopt($ch, CURLOPT_URL, $stsUrl); 
        // Get the response back as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // Mark as Post request
        curl_setopt($ch, CURLOPT_POST, 1);
        // Set the parameters for the request
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $authenticationRequestBody);
        
        // By default, HTTPS does not work with curl.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_PROXY, 'florent.local:8888');


        // read the output from the post request
        $output = curl_exec($ch);         
        // close curl resource to free up system resources
        curl_close($ch);      
    
        parse_str($output, $tokenOutput);
        //print_r($tokenOutput);
        return $tokenOutput["wrap_access_token"];
    }
    echo getAuthenticationHeaderWrap();
    exit;
