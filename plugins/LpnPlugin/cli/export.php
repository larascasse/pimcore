<?php

include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

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

$filename= dirname(__FILE__) . "/../config/".$importerConfig->export->exportFileEan;
try {
    //do the import job
        echo "\nstart export simple\n";

    $importer = new LpnPlugin_Exporter($importerConfig,$overwrite);
    $importer->init();
    $importer->exportAction($filename);
    echo "\ndone with export simple\n";
    
} catch (Exception $e) {
    p_r($e);
}


$filename= dirname(__FILE__) . "/../config/".$importerConfig->export->exportFileConfigurables;
try {
    //do the import job
    echo "\nstart export configurables\n";
    $importer = new LpnPlugin_Exporter($importerConfig,$overwrite);
    $importer->init();
    $importer->exportAction($filename,$configurable=true);
    echo "\ndone with export\n";
    
} catch (Exception $e) {
    p_r($e);
}

//TODO export visibility
