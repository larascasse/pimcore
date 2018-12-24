<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/01massif/tmp/mm-ad

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
\Pimcore\Model\Version::disable();

$conditionFilters = array(
    "(o_path LIKE '/catalogue/_product_base__/01massif/tmp%' OR o_path LIKE '/catalogue/_product_base__/05contreco/tmp/%')",
    "ean IS NULL",
    "code IS NOT NULL",
);


$list = new Pimcore\Model\Object\Product\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));
//$list->setOrder("ASC");
//$list->setOrderKey("o_id");

$list->setOrder("DESC");
$list->setOrderKey("o_id");


$list->load();

$objects = array();
 echo "objects in list ".count($list->getObjects())."\n";
//Logger::debug("objects in list:" . count($list->getObjects()));

foreach ($list->getObjects() as $object) {
	$article = $object->getCode();

	if (strlen($object->getChanfreins())==0 && strlen($object->getCode())>0) {
		if(stristr($article, "G2")) {
			$object->setChanfreins(2);
		}
		else if(stristr($article, "G4")) {
			$object->setChanfreins(4);

		}
		else if(stristr($article, "G0")) {
			$object->setChanfreins(0);

		}
		$object->save();
		echo "\Code:".$object->getCode()." - ".$object->getMage_name(). ' CHANFREINS UPDATED)';
	}
	
    

    
    
}
\Pimcore\Model\Version::enable();
?>