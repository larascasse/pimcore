<?php


include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);


Pimcore_Model_Cache::disable();


        $conditionFilters = array("o_path LIKE '" . '/catalogue/_product_base__/20strat/ap000mebj0000bf' . "/%'");
        $conditionFilters = array("o_path LIKE '" . '/catalogue/_product_base__/20strat/ap000mebj0240bf' . "/%'");
        $conditionFilters = array("o_path LIKE '" . '/catalogue/_product_base__/20strat/ap000mebs1000bf' . "/%'");
        $conditionFilters = array("o_path LIKE '" . '/catalogue/_product_base__/20strat/ap000mepsb000bf' . "/%'");
        $conditionFilters = array("o_path LIKE '" . '/catalogue/_product_base__/20strat/ap000mepsh000bf' . "/%'");
        $conditionFilters = array("o_path LIKE '" . '/catalogue/_product_base__/20strat/ap000meqro000bf' . "/%'");
        $conditionFilters = array("o_path LIKE '" . '/catalogue/_product_base__/20strat/ap000mesco000bf' . "/%'");


        $list = new Object_Product_List();
        $list->setCondition(implode(" OR ", $conditionFilters));
        $list->setOrder("ASC");
        $list->setOrderKey("o_id");

 
        $list->load();

        $objects = array();
        Logger::debug("objects in list:" . count($list->getObjects()));
        foreach ($list->getObjects() as $object) {

            //COPIE DE SCIERGNER COURT
            $value  = $object->getValueForFieldName('name_scienergie_court');
            $object->setValue('name',NULL);
            $object->setValue('configurable_free_1',null);
            $object->setValue('pimonly_name_suffixe',$value);
            $object->save();
        }

?>