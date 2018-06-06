<?php

use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;

use Website\Tool;



class LpnPlugin_AdminController extends \Pimcore\Controller\Action\Admin {
    
    public function getaddressbookAction() {
        $addresses = array();

        $addresses[] = array(
            'name'        => 'Bob Dole',
            'phoneNumber' => '1234567890',
            'address'     => '123 Fake Street'
        );

        $addresses[] = array(
            'name'        => 'Joe Smith',
            'phoneNumber' => '0987654321',
            'address'     => '45 Newington Heights'
        );

        
    }

    /*
http://pimcore.florent.local/plugin/LpnPlugin/admin/import-from-azure?ean=12121212
http://pimcore.florent.local/plugin/LpnPlugin/admin/import-from-azure?ean=315189712
http://pimcore.florent.local/plugin/LpnPlugin/admin/import-from-azure?ean=12121212http://pimcore.florent.local/plugin/LpnPlugin/admin/import-from-azure?endswith
*/

    public function importFromAzureAction() {

        ini_set('memory_limit', '1024M');
        ini_set("max_execution_time", "-1");

        //execute in admin mode
        define("PIMCORE_ADMIN", true);
        define("LPN_IMPORT", true);

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        //POST from sceinergie
        $xml = $this->getParam('xml');

        $svc = new LPNEntities(LPN_SERVICE_URL);    


        $famille = $this->getParam("famille")?$this->getParam("famille"):"10TERRASSE,41TABLE,40BARDAGES,01MASSIF,05CONTRECO,45ACCESSOI,50FINITION,25ISOLANTS,15COLLE,30BETON,20STRAT,97LOTS";

        $forceCreateNonActifWeb=false;

        if(($this->getParam("ean"))) {
          $query = getQuery($svc,"ean",$this->getParam("ean"),0,false);
          $forceCreateNonActifWeb=true;
        }
        else if(($this->getParam("endswith"))) {
          $query = getQuery($svc,"ean-by-endscode",array("famille"=>$famille,"code"=>$this->getParam("endswith")),0,false);
          $forceCreateNonActifWeb=($this->getParam("nonactif"))?true:false;
        }
        else if(($this->getParam("startswith"))) {
          $query = getQuery($svc,"ean-by-startscode",array("famille"=>$famille,"code"=>$this->getParam("startswith")),0,false);
          $forceCreateNonActifWeb=($this->getParam("nonactif"))?true:false;
        }
        else if(($this->getParam("startsendswith"))) {
          $query = getQuery($svc,"ean-by-endsstartscode",array("famille"=>$famille,"code"=>$this->getParam("startsendswith")),0,false);
          $forceCreateNonActifWeb=($this->getParam("nonactif"))?true:false;
        }
        else {
          $query = getQuery($svc,"ean-by-famille",$famille,0,false);
        }

        $result = array("status"=>false, "message"=>array());

        try {

            $starttime = getTime();
            $response = $query->Execute();
            $totaltime = getEndTime($starttime);

            $importer = new LpnPlugin_Importer();
            $importer->init();
            do  {
               
                if($nextProductToken != null) {            
                    $response = $svc->Execute($nextProductToken);
                }
                //var_dump($response);
                foreach($response->Result as $Product) {
                    $p = \Website\Tool\MauchampHelper::convertAzureProductToPimcoreArray($Product);
                   // var_dump($Product);
                 //   var_dump($p);
                  //  die;
                    $returnMessage = $importer->importProduct($p,$forceCreateNonActifWeb);

                    if(is_array($returnMessage)) {
                        $result["status"] = true;
                        $result["message"][] = $returnMessage;
                    }
                  
                    //$importer->clearInheritedValues($p);
                  
                }
            
            }
            
            while(($nextProductToken = $response->GetContinuation()) != null);
            
            
            
        } 
        catch (Exception $e) {
            //return $this->_helper->json(array('ERROR' => $e->getMessage()));
            //print_r($e);
            $result["message"][] = $e;
            
            die;
        }
        return $this->_helper->json($result);
    }

}