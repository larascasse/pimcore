<?php


include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);
Pimcore::setAdminMode();
Object_Abstract::setHideUnpublished(false);
Object_Abstract::setGetInheritedValues(false);


Pimcore_Model_Cache::disable();


$db = \Pimcore\Db::get();
$sql = "SELECT o_id,ean FROM element_workflow_state LEFT JOIN object_5 ON element_workflow_state.cid = object_5.oo_id WHERE state != 'needs_magento_sync'";
$results = $db->fetchAll($sql);

foreach ($results as $result) {
  echo $result['ean']."\n";
}
?>