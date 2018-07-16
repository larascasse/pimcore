<?php

http://pimcore.florent.local/plugin/LpnPlugin/import-from-azure?ean=12121212

class LpnPlugin_IndexController extends Pimcore_Controller_Action {
    
    public function indexAction () {

        // reachable via http://pimcore.florent.local/plugin/LpnPlugin/index/index
       // $pimpampoum = new \LpnPlugin\Model\PimPamPoum();
		//$pimpampoum->setValue("type","test");
		//$vote->setUsername('foobar!'.mt_rand(1, 999));
		//$pimpampoum->save();

		//$this->view->message = "OK !!";
		 return $this->_helper->json("OK");

    }

    //http://pimcore.florent.local/plugin/LpnPlugin/index/export-print-labels
    //http://pim.laparqueterienouvelle.fr/plugin/LpnPlugin/index/export-print-labels

    public function exportPrintLabelsAction() {
    	ini_set('memory_limit', '1024M');
        ini_set("max_execution_time", "-1");
        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $conditionFilters = array(
		    "o_path LIKE '/catalogue/_product_base__/01massif/tmp%'",
		    "ean IS NOT NULL"
		);


		$list = new Pimcore\Model\Object\Product\Listing();
		$list->setUnpublished(true);
		$list->setCondition(implode(" AND ", $conditionFilters));
		//$list->setOrder("ASC");
		//$list->setOrderKey("o_id");


		$list->load();

		$objects = array();
		 //echo "objects in list ".count($list->getObjects())."\n";
		//Logger::debug("objects in list:" . count($list->getObjects()));
		$header = $fieldsToExport=array("code","ean","pimonly_print_label","colisage","name_scienergie","name_scienergie_court","epaisseur","largeur","longueurs","weight");

		$rows=array();

		$row=array();
		foreach ($fieldsToExport as $field) {
		    $row[] = $field;          
		}
		$rows[] = $row;

		foreach ($list->getObjects() as $object) {


		    //echo "update ".$object->getName()."\n";
		    //COPIE DE SCIERGNER COURT
		    //$value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));

		    if(!($object instanceof Object_Product))
		        continue;

		    //$inheritance = Object_Abstract::doGetInheritedValues(); 
		    //Object_Abstract::setGetInheritedValues(false); 
		    
		  
		    $scienergieCourt = $object->name_scienergie_court;
		    $scienergie = $object->name_scienergie;
		    $article = $object->code;
		    $parent = $object->getParent();

		    
		   

		    if(strlen($object->getEan())>0) {

		        $row=array();
		       foreach ($fieldsToExport as $field) {
		         
		           $fieldDefinition = $object->getClass()->getFieldDefinition($field);
		           if ($fieldDefinition) {
		                $row[] = $fieldDefinition->getForCsvExport($object);
		            }
		       }
		      // $row[] = 'https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
		    
		        $rows[] = $row;
		        //echo implode(";", $row)."\n";

		        
		    }
		    
		    
		     Object_Abstract::setGetInheritedValues($inheritance); 


		}


            
     
        $this->toCSV($header,$rows,"export");
        die;


    }

      public  function toCSV($header, $data, $filename) {
        $sep  = "\t";
        $eol  = "\n";
        $csv  =  count($header) ? '"'. implode('"'.$sep.'"', $header).'"'.$eol : '';
        foreach($data as $line) {
          $csv .= '"'. implode('"'.$sep.'"', $line).'"'.$eol;
        }
        $encoded_csv = mb_convert_encoding($csv, 'UTF-16LE', 'UTF-8');
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.$filename.'.csv"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: '. strlen($encoded_csv));
        echo chr(255) . chr(254) . $encoded_csv;
        exit;
      }

}
