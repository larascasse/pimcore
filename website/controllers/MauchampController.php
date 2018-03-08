<?php

ini_set('display_errors', 1);
//error_reporting(E_ALL);



use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;

use Website\Tool
;



class MauchampController extends Action
{
    public function init() {
        parent::init();

        // do something on initialization //-> see Zend Framework

        // in our case we enable the layout engine (Zend_Layout) for all actions
        $this->enableLayout();
    }

    
   
    public function mauchampAction() {

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");

        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->view->layout()->setLayout("layout-mauchamp");

        //POST from sceinergie
        $xml = $this->getParam('xml');

        if(isset($xml))
            $data = $xml;
        else
            //$xml = $data = \Website\Tool\MauchampHelper::getDebugClient();
            $data = Website\Tool\MauchampHelper::getDebugOrder();
        
        if(\Website\Tool\MauchampHelper::isClientRequest($data)) {
            $client = \Website\Tool\MauchampHelper::parseClient($data);

            $xmlClient = $xml;

            //On remplace au cas ou, s'il ny a pas d'email de contact...
            $xmlClient->Email_Contact = $xml->Email_Contact;
            $xmlClient->Nom_Contact = $xml->Nom_Contact;
            //print_r($client);
            try {
                $this->view->client = $client;
                $this->view->xmlClient = simplexml_load_string($xml);
                $this->renderScript('mauchamp/mauchamp-client.php');
                
            }
            catch (Exception $e) {
                //echo "klmklmklkm".$e->getMessage();
            }
            //die;
        }

        //ORDER
        else {
            $order = \Website\Tool\MauchampHelper::parseOrder($data);
            $this->view->products = $order["products"];
            $this->view->missingProducts = $order["missingProducts"];
            $this->view->transport = $order["transport"];
            $this->view->orderDetail = $order["orderDetail"];
            $this->view->xmlOrder = $data;
            $this->view->xmlClient = \Website\Tool\MauchampHelper::buildXmlClientFromOrder($data);//Website\Tool\MagentoHelper::buildXmlClientFromOrder($data);

        }
        
    }

    public function mauchampSendmailAction() {
        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $order = \Website\Tool\MauchampHelper::parseOrder($this->getParam('xml'));

      
        

          $ftUrls = array();

          $ftIncludedSkus = array();
         

          if (is_array($this->getParam('ft'))) {
            foreach ($this->getParam('ft') as $key => $sku) {

                $ftIncludedSkus[] = $sku;
                
                $existingProductList = Object\Product::getByEan($sku);
                if($existingProductList->count()>=1) 
                       $product = $existingProductList->current();

                if($product) {
                    $ftUrls[] = Pimcore\Tool::getHostUrl().'/pdf/'.$product->getId();
                }
            }
         }

          $photosIncludedSkus = array();
          if (is_array($this->getParam('photos'))) {
            foreach ($this->getParam('photos') as $key => $sku) {
                $photosIncludedSkus[] = $sku;
            }
         }

        
        $pdfFileUrl = "";
  

    

         try {


           
            try {
                
                /* V2 */
                $coverHtmlData = \Pimcore\Tool::getHttpData(
                        Pimcore\Tool::getHostUrl()."/?controller=mauchamp&action=cover-for-piece-commerciale",null,["xml"=>$this->getParam('xml')]);

                $pdfFile = PIMCORE_TEMPORARY_DIRECTORY . "/" .$order["orderDetail"]["Code_Commande"]."-". uniqid() . ".pdf";
                $pdfFileUrl = \Pimcore\Tool::getHostUrl() . str_replace($_SERVER["DOCUMENT_ROOT"],"",$pdfFile);

                $debugOnlyStatique = false;

                if(!$debugOnlyStatique) {
                     $pdfContent = \Website\Tool\Wkhtmltopdf::fromString($coverHtmlData,$pdfFile);

                 }


                /*** AJOUT DES FT DYN **/

                //on ajoute les fihes rtechniques si elle ne sont pas dynbamqieusw
                 
                 $pdfMerged = new Zend_Pdf();
                 $this->products = $order["products"];
                 if(count($this->products)>0) {
                     foreach ($this->products as $product) {
                         
                         if($product->getFiche_technique_lpn()) {
                            $pdfpath = $product->getFiche_technique_lpn()->getFileSystemPath();
                            
                            $pdf = Zend_Pdf::load($pdfpath); 
                            foreach($pdf->pages as $page){

                              $clonedPage = clone $page;
                              $pdfMerged->pages[] = $clonedPage;
                            }
                            unset($clonedPage);
                         }
                     }
                }

                 //OK, on a des PDF statiques, on insere avant le PDF Dynalmique
                 if(count($pdfMerged->pages)>0) {

                    //On charge le PDF dynamique ;
                    if(isset($pdfContent)) {
                        $pdfDyn = Zend_Pdf::parse($pdfContent); 
                        $reversedPages = array_reverse($pdfDyn->pages);
                        foreach($reversedPages as $page){
                          $clonedPage = clone $page;
                          array_unshift($pdfMerged->pages,$clonedPage);
                          //$pdfMerged->pages[] = $clonedPage;
                        }
                    }
                    if(isset($clonedPage))
                        unset($clonedPage);

                    $pdfContent = $pdfMerged->render();
                    file_put_contents($pdfFile, $pdfContent);
                 }


            


            }
            catch (Exception $e) {
                 echo json_encode(array("message"=> $e->getMessage()));
                 die;
            }

            if($this->getParam('sendmail')=="true") {

                $mail = new Pimcore_Mail();
                $mail->setIgnoreDebugMode(true);

                $mail->setBodyText($this->getParam("message"));

                $mail->clearRecipients();

                $mail->addTo("florent@lesmecaniques.net",'FLorent text');
                $mail->addBcc("florent@lesmecaniques.net");

                $mail->setReplyTo($this->getParam("from-email"));

                $mail->setSubject($this->getParam("subject"));

                $mail->clearFrom();
                $mail->setFrom("eshop@lp-nouvelle.fr","La Parqueterie Nouvelle");

                if(strlen($pdfContent)>0) {
                    $at = $mail->createAttachment($pdfContent);
                    $at->type = "application/pdf";
                    $at->filename = "visite-laparqueterienouvelle-".$order["orderDetail"]["Type_Piece"]."-".$order["orderDetail"]["Code_Commande"].".pdf";
                    $at->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
                }
                $mail->send();

            }

            
         }
          catch (Exception $e) {
                // something went wrong: eg. limit exceeded, wrong configuration, ...
                Logger::err($e);
                //echo $e->getMessage();
                echo json_encode(array("message"=> $e->getMessage()));
                exit;
         }

         header('Content-Type: application/json');
         echo json_encode(array("message"=>  $this->getParam('sendmail')=="true"?"Mail envoyé, chouette !":"Pdf crée.. Top!","pdfFileUrl"=>$pdfFileUrl));
         die;
      

         
    }


    public function mauchampTestAction() {

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");


        //"CCA172694"
        $this->view->layout()->setLayout("layout-mauchamp");
        $codecommande = $this->getParam('codecommande');
        if(!isset($codecommande)) {
            $this->view->codecommande="";
            return;
        }

        $this->view->codecommande=$codecommande;
        
        $xml = $order = \Website\Tool\MauchampHelper::loadAzureOrderXml($codecommande);
        if(isset($xml)) {
            $this->view->xml =  $xml;
        }


    }

    public function mauchampClientTestAction() {

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");


        //"CCA172694"
        $this->view->layout()->setLayout("layout-mauchamp");
        $codeclient = $this->getParam('codeclient');
        if(!isset($codeclient)) {
            $this->view->codeclient="";
            return;
        }

        $this->view->codeclient=$codeclient;
        
        $xml = $order = \Website\Tool\MauchampHelper::loadAzureClient($codeclient);
        if(isset($xml)) {
            $this->view->xml =  $xml;
        }


    }

     //Fiche Produit
    public function coverForPieceCommercialeAction() {
        
        $this->disableBrowserCache();
        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->view->layout()->setLayout("layout-ft");


        //POST from sceinergie
        $xml = $this->getParam('xml');
        
        if(isset($xml))
            $data = $xml;
        else
            //$xml = $data = \Website\Tool\MauchampHelper::getDebugClient();
            $data = \Website\Tool\MauchampHelper::getDebugOrder();
        
        
        $order = \Website\Tool\MauchampHelper::parseOrder($data);

        $coverTitle = \Website\Tool\MauchampHelper::getCoverTitle($order["products"],$order["missingProducts"]);


        //on vire les produits dupliqués
        //Deha fait dan le paerse order !!
        /*$uniqueProducts = array();
        if(is_array($order["products"])) {
          foreach ($order["products"] as $product) {
            $uniqueProducts[$product->getEan()] = $product;
          }
        }*/

        
        $this->view->products = $order["products"];

        $this->view->missingProducts = $order["missingProducts"];
        $this->view->transport = $order["transport"];
        $this->view->orderDetail = $order["orderDetail"];
        $this->view->coverTitle = $coverTitle;
        $this->view->xmlOrder = $xml;

        $this->renderScript('mauchamp/book-commande.php');


    }






     //Fiche Produit
    public function coverForPieceCommercialePdfAction() {
        //$this->coverForPieceCommercialeAction();
        //return;
        
        $this->disableBrowserCache();
        $this->disableViewAutoRender();

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");
        

        $this->view->layout()->setLayout("layout-ft");
      

        //POST from sceinergie
        $xml = $this->getParam('xml');
        
        if(isset($xml))
            $data = $xml;
        else
            //$xml = $data = \Website\Tool\MauchampHelper::getDebugClient();
            $data = \Website\Tool\MauchampHelper::getDebugOrder();

        

        $debugOnlyStatique = false;

        if(!$debugOnlyStatique) {
             $fileContent = \Pimcore\Tool::getHttpData(Pimcore\Tool::getHostUrl()."/?controller=mauchamp&action=cover-for-piece-commerciale",null,["xml"=>$data]);


             //$filepath = $tmpPdfFile = PIMCORE_SYSTEM_TEMP_DIRECTORY . "/" . uniqid() . ".pdf";
             $pdfContent = \Website\Tool\Wkhtmltopdf::fromString($fileContent);

         }

         //OK, on ajoute les fihes rtechniques si elle ne sont pas dynbamqieusw
         $order = \Website\Tool\MauchampHelper::parseOrder($data);        
         $this->products = $order["products"];

         $existingPaths = array();
        
         $pdfMerged = new Zend_Pdf();
         foreach ($this->products as $product) {
             
             if($product->getFiche_technique_lpn()) {
                $pdfpath = $product->getFiche_technique_lpn()->getFileSystemPath();

                //On check qu'on en a pas deja fait une...
                if(!in_array($pdfpath,$existingPaths)) {

                    $existingPath[] = $pdfpath;

                    $pdf = Zend_Pdf::load($pdfpath); 
                    foreach($pdf->pages as $page){

                      $clonedPage = clone $page;
                      $pdfMerged->pages[] = $clonedPage;
                    }
                    unset($clonedPage);

                }

               
               
             }
         }

         if(count($pdfMerged->pages)>0) {

            //On charge le PDF dynamique ;
            if(isset($pdfContent)) {
                $pdfDyn = Zend_Pdf::parse($pdfContent); 
                $reversedPages = array_reverse($pdfDyn->pages);
                foreach($reversedPages as $page){
                  $clonedPage = clone $page;
                  array_unshift($pdfMerged->pages,$clonedPage);
                  //$pdfMerged->pages[] = $clonedPage;
                }
            }
            if(isset($clonedPage))
                unset($clonedPage);

            $pdfContent = $pdfMerged->render();
         }
         

        
        $filename = "laparqueterienouvelle.pdf";

         $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename=" . ' . $filename . '";"',
                'Cache-Control' => 'private'
            ];

            foreach ($headers as $key => $value) {
                 $this->getResponse()->setHeader($key,$value);
                 Header($key.":".$value);
            }
           

             echo $pdfContent;
             exit;


     
      

    }


    public function log($error,$error_type='') {
        echo $message;
    }


    


   

    


}
