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



Pimcore_Model_Cache::disable();
\Pimcore\Model\Version::disable();

$conditionFilters = array(
    "o_path LIKE '/teintes/teintes/_import%'",
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
         o_path LIKE '/catalogue/_product_base__/05contreco/tmp/%'
        OR o_path LIKE '/catalogue/_product_base__/01massif/tmp/%'
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
    $productsCheck[]=array("name"=>$product->getMage_name(),"product"=>$product);
}

$productToSave = array();
foreach ($list->getObjects() as $teinte) {


    //echo "update ".$object->getName()."\n";
    //COPIE DE SCIERGNER COURT
    //$value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));

    if(!($teinte instanceof Object_Teinte))
        continue;
    
    $teinteName = $teinte->getName();

    echo "\n\nTEST : ".$teinteName."\n";
   

   // print_r($conditionFilters);

    //Object_Abstract::setGetInheritedValues(true);

   

   // $db = \Pimcore\Db::get();
    //$fieldsArray = $db->fetchCol("SELECT oo_id FROM `object_query_5` where ");

    foreach ($productsCheck as $productCheck) {
        //echo "TEST : ".$teinteName." - ".$product->getName()."\n";
        if(stripos($productCheck["name"]," ".$teinteName." ")>0) {
            $product = $productCheck["product"];
            echo "".$teinteName." - ".$productCheck["name"]."\n";
            $product->setPimonly_teinte_rel(array($teinte));
            //$productCheck["toSave"] = "yes";
            //$product->save();
            $productToSave[$product->getId()] = $product;
        }


    }

    $teinte->setPublished(true);
    $teinte->save();

}
foreach ($productToSave as $product) {
    $product->save();
    echo "Saved ".$product->getName()." ".$product->getId()."\n";
}
\Pimcore\Model\Version::enable();
?>