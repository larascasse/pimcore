<?php


include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);
$userId = 6;
\Zend_Registry::set("pimcore_admin_user", User::getById($userId));
Pimcore::setAdminMode();
Object_Abstract::setHideUnpublished(false);
Object_Abstract::setGetInheritedValues(false);


Pimcore_Model_Cache::disable();


$db = \Pimcore\Db::get();
$sql = "SELECT cid,ean FROM element_workflow_state LEFT JOIN object_5 ON element_workflow_state.cid = object_5.oo_id WHERE state = 'needs_magento_sync'";
$results = $db->fetchAll($sql);

$eans = [];
$cids = [];

$i=0;
foreach ($results as $result) {
 
  if(strlen($result['ean'])>0) {
    //echo $result['ean']."\n";
    $eans[] = $result['ean'];
    $cids[] = $result['cid'];
    if($i++>300)
      break;
  }
}

echo count($eans)." à synchroniser\n";
if(count($eans)>0) {
   $url = "http://lpn.local/LPN/get_a_product_magmi.php";
   $params = ["ean"=>implode(",", $eans)];
   //print_r($params);
    $content = \Pimcore\Tool::getHttpData($url,null,$params);
    
}

$products = [];
foreach ($cids as $productId) {

  $product = Object_Product::getById($productId);
 // echo (get_class($product));
  if($product instanceof Website_Product) 
    $products[] = $product;
}
if(count($products)>0) {
    $returnValueContainer = new \Pimcore\Model\Tool\Admin\EventDataContainer(object2array($page));
    \Pimcore::getEventManager()->trigger('lpn.magento.postSynchro',$products,[
          "returnValueContainer" => $returnValueContainer
      ]);

    $workflowReturn = $returnValueContainer->getData();

    if(is_array($workflowReturn) && isset($workflowReturn["message"])) {
      $content += $workflowReturn["message"];
    }
}



echo $content;
echo "END\n";
?>