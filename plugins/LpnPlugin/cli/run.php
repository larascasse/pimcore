<?php

include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);


Pimcore_Model_Cache::disable();


if (version_compare(PHP_VERSION, '5.4.0', "<")) {
    echo "<b>Pimcore requires at least PHP 5.4.<br />Your version is" . PHP_VERSION . ".<br />Please upgrade your PHP installation before resuming the pimcore update!</b>";
    exit;
}

