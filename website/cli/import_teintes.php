<?php
include("../../pimcore/cli/startup.php");


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
$filename = dirname(__FILE__) . "/teintes.csv";


try {
    //do the import job
    $importer = new LpnPlugin_Importer(null,$overwrite);
    $importer->init();
    $importer->importGetFileInfoAction($filename);
    $importer->importEanProcessAction();
    echo "\ndone with import\n";
    
} catch (Exception $e) {
    p_r($e);
}
