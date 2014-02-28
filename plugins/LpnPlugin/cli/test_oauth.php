<?php

function getAuthenticationHeader2(){
        // Password
     
        
        // Construct the body for the STS request
        $authenticationRequestBody = 
                    'grant_type=client_credentials' 
                    .'&client_id='.'OBDAzure'
                    .'&'.'client_secret='.urlencode('7R64w4V2CG2XKic149R0HDyKWS8G2fn2PA2rpW1tEAQ=')
                    .'&'.'scope='.urlencode('http://obdazureservicecloud.cloudapp.net/AcsObdService/')

                    ;
        
        //Using curl to post the information to STS and get back the authentication response    
        $ch = curl_init();
        // set url 
        $stsUrl = 'https://acsobdazure.accesscontrol.windows.net/v2/OAuth2-13';        
        curl_setopt($ch, CURLOPT_URL, $stsUrl); 
        // Get the response back as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // Mark as Post request
        curl_setopt($ch, CURLOPT_POST, 1);
        // Set the parameters for the request
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $authenticationRequestBody);
        
        // By default, HTTPS does not work with curl.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // read the output from the post request
        $output = curl_exec($ch);   

       // print_r($output);

        // close curl resource to free up system resources
        curl_close($ch);      
        // decode the response from sts using json decoder
        $tokenOutput = json_decode($output);
        print_r($tokenOutput);
        
        return 'Authorization:' . $tokenOutput->token_type.' '.$tokenOutput->access_token;
    }


function getAuthenticationHeader(){
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

        // read the output from the post request
        $output = curl_exec($ch);         
        // close curl resource to free up system resources
        curl_close($ch);      
        // decode the response from sts using json decoder
        $tokenOutput = json_decode($output);
        print_r($tokenOutput);
        print_r($output);
        return 'Authorization:' . $tokenOutput->{'token_type'}.' '.$tokenOutput->{'access_token'};
    }
    echo getAuthenticationHeader2();
    exit;
/**
 * Example of retrieving an authentication token of the Dropbox service
 *
 * PHP version 5.4
 *
 * @author     Flávio Heleno <flaviohbatista@gmail.com>
 * @copyright  Copyright (c) 2012 The authors
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 */

use OAuth\OAuth2\Service\Dropbox;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

$servicesCredentials = array(
    'lpn_test' => array(
        'key'       => '',
        'secret'    => '',
    ),
    'lpn_prod' => array(
        'key'       => '',
        'secret'    => '',
    )
);

define ("ENVIRONNEMENT","lpn_test");

/** @var $serviceFactory \OAuth\ServiceFactory An OAuth service factory. */
$serviceFactory = new \OAuth\ServiceFactory();


// Session storage
$storage = new Session();

// Setup the credentials for the requests
$credentials = new Credentials(
    $servicesCredentials[ENVIRONNEMENT]['key'],
    $servicesCredentials[ENVIRONNEMENT]['secret'],
    $currentUri->getAbsoluteUri()
);

// Instantiate the Dropbox service using the credentials, http client and storage mechanism for the token
/** @var $dropboxService Dropbox */
$lpnService = $serviceFactory->createService(ENVIRONNEMENT, $credentials, $storage, array());

if (!empty($_GET['code'])) {
    // This was a callback request from Dropbox, get the token
    $token = $lpnService->requestAccessToken($_GET['code']);

    // Send a request with it
    $result = json_decode($lpnService->request('/account/info'), true);

    // Show some of the resultant data
    echo 'Your unique Dropbox user id is: ' . $result['uid'] . ' and your name is ' . $result['display_name'];

} elseif (!empty($_GET['go']) && $_GET['go'] === 'go') {
    $url = $lpnService->getAuthorizationUri();
    header('Location: ' . $url);
} else {
    $url = $currentUri->getRelativeUri() . '?go=go';
    echo "<a href='$url'>Login with Azure!".ENVIRONNEMENT."</a>";
}
