<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/01massif/tmp/mm-zp

include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);
Pimcore::setAdminMode();
Object_Abstract::setHideUnpublished(false);

define('PIMCORE_CONSOLE',true);

Pimcore_Model_Cache::disable();
\Pimcore\Model\Version::disable();

$conditionFilters = array(
    "o_path LIKE '/teintes/teintes/stratifie%'",
    //"ean IS NOT NULL"
);


$list = new Pimcore\Model\Object\Teinte\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));
//$list->setOrder("ASC");
//$list->setOrderKey("o_id");

//$list->setOrder("DESC");
//$list->setOrderKey("o_id");


$list->load();

$objects = array();
 echo "objects in list ".count($list->getObjects())."\n";
//Logger::debug("objects in list:" . count($list->getObjects()));


 $conditionFilters = array(
    "( 
            o_path LIKE '/catalogue/_product_base__/20strat%' 
            AND o_path NOT LIKE '/catalogue/_product_base__/20strat/2017%'
    )",
    "ean IS NULL",
    "code IS NOT NULL",
    //"LOWER(name) like '% ".strtolower($teinteName)." %'"
    );

$listProduct = new Pimcore\Model\Object\Product\Listing();
$listProduct->setUnpublished(true);
$listProduct->setCondition(implode(" AND ", $conditionFilters));
$products  = $listProduct->getObjects();
$productsCheck = array();

foreach ($products as $product) {
    $productsCheck[]=array("name"=>strtolower($product->getName()),"product"=>$product);
}

$productToSave = array();
$teinteMissed = array();
foreach ($list->getObjects() as $teinte) {


    //echo "update ".$object->getName()."\n";
    //COPIE DE SCIERGNER COURT
    //$value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));

    if(!($teinte instanceof Object_Teinte))
        continue;
    
    $teinteName = strtolower($teinte->getName());

    echo "\n\TEINTE : ".$teinteName."\n";
   

   // print_r($conditionFilters);

    //Object_Abstract::setGetInheritedValues(true);

   

   // $db = \Pimcore\Db::get();
    //$fieldsArray = $db->fetchCol("SELECT oo_id FROM `object_query_5` where ");

    $hasProduct = false;

    foreach ($productsCheck as $productCheck) {
        if (isset($forceTeinteName) && strlen($forceTeinteName)>0) {
            echo "TEST : ".$teinteName."----".$productCheck["name"]."--\n";
        }
        //
       // if(stripos($productCheck["name"]," ".$teinteName." ")>0) {
        if(strtolower($productCheck["name"]) == strtolower($teinteName)) {
            
            $product = $productCheck["product"];
            echo "".$teinteName." - ".$productCheck["name"]."\n";
            $product->setPimonly_teinte_rel(array($teinte));
            //$productCheck["toSave"] = "yes";
            //$product->save();
            $productToSave[$product->getId()] = $product;
            $hasProduct = true;
        }


    }

    if($hasProduct) {
        $teinte->setPublished(true);
        $teinte->save();
    }
    else {

        echo "NO PRODUCT FOR :  ".$teinteName."  --\n";
    }
   

}
foreach ($productToSave as $product) {
    $product->save();
    echo "Saved ".$product->getName()." ".$product->getId()."\n";
}
\Pimcore\Model\Version::enable();
?>