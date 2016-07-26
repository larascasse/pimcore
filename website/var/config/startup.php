<?php

if( !isset($_SERVER['PHP_AUTH_USER']) )
{
    if (isset($_SERVER['HTTP_AUTHORIZATION']) && (strlen($_SERVER['HTTP_AUTHORIZATION']) > 0)){
        list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
        if( strlen($_SERVER['PHP_AUTH_USER']) == 0 || strlen($_SERVER['PHP_AUTH_PW']) == 0 )
        {
            unset($_SERVER['PHP_AUTH_USER']);
            unset($_SERVER['PHP_AUTH_PW']);
        }
    }
}

$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('Website');
