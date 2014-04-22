<?php

include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");
ini_set("auto_detect_line_endings", "1");
//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);

//some command line options for my importer
try {
    $opts = new Zend_Console_Getopt(array(
                'force|f' => "force update of all objects"
    ));
    $opts->parse();
} catch (Zend_Console_Getopt_Exception $e) {
    echo $e->getUsageMessage();
    exit;
}
$overwrite = $opts->getOption('force');

$importerConfig = new Zend_Config_Xml(dirname(__FILE__) . "/../config/import.xml");



$filenameArticles= dirname(__FILE__) . "/../config/".$importerConfig->import->importFileArticles;


try {
    //do the import job
    $importer = new LpnPlugin_Importer($importerConfig,$overwrite);
    $importer->init();
    $importer->importGetFileInfoAction($filenameArticles);
    $importer->importProcessAction();
    echo "\ndone with import\n";
    
} catch (Exception $e) {
    p_r($e);
}

