<?php

ini_set('display_errors', 1);
//error_reporting(E_ALL);



use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;

use Website\Tool;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;




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
        else {

            if($this->getParam('debug')) {
               //$xml = $data = \Website\Tool\MauchampHelper::getDebugClient();
              $data = Website\Tool\MauchampHelper::getDebugOrder();
            }
            else {
              $data = false;
            }
            
           
        }
            
        if($data) {
          if(\Website\Tool\MauchampHelper::isClientRequest($data)) {
            
            $client = \Website\Tool\MauchampHelper::parseClient($data);

            

            //On remplace au cas ou, s'il ny a pas d'email de contact...
            $xmlClient = simplexml_load_string($xml);

            if(strlen($client->Email_Contact)>0)
              $xmlClient->Email_Contact = $client->Email_Contact;
            
            if(strlen($client->Nom_Contact)>0)
              $xmlClient->Nom_Contact = $client->Nom_Contact;
            //print_r($client);
            try {
                $this->view->client = $client;
                $this->view->xmlClient = $xmlClient;
                $this->renderScript('mauchamp/mauchamp-client.php');
                
            }
            catch (Exception $e) {
                //echo "klmklmklkm".$e->getMessage();
               $this->view->error = "Erreur render script";
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

               if($this->getParam('transport')) {

                   $transportList = Object\Transport::getByCodePiece($order["orderDetail"]["Code_Commande"],['unpublished' => true]);
                  

                  if($transportList->count()>0) {

                      $transport = $transportList->current();
                  }
                  else {

                    $transport = \Website\Tool\MauchampHelper::buildTransportObjectFromOrderXml($data);
                  }
                  
                  if (!$transport instanceof Object\Transport) {
                      // this will trigger a 404 error response
                      //throw new \Zend_Controller_Router_Exception("invalid request");
                      echo "error.....";
                   
                      $transport = new Object\Transport;
                  }



                  if($transport->getId()) {
                     $this->view->notes = \Website\Tool\TransportHelper::getNotesForTransport($transport);
                  }
                  $this->view->transport = $transport;

               }

          }
        }
        else {
          $this->view->error = "Erreur 01";
        }
      
        
    }

    //Send PIMPIAMPOUM via EMAIL
    public function mauchampSendmailAction() {
        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $order = \Website\Tool\MauchampHelper::parseOrder($this->getParam('xml'));


        if($this->getParam('sendmail')=="true") {
           $to_email = $this->getParam("to-email");

           $allEmails = explode(";",$to_email);

           $validator = new EmailValidator();
           $valid = true;
           if(is_array($allEmails ))  {
              foreach ($allEmails as $email) {
                 $isEmailValid = $validator->isValid($email, new RFCValidation());
                 if(!$isEmailValid) {
                    header('Content-Type: application/json');
                    echo json_encode(array("message"=>  "Adresse email invalide !!!!". $email));
                    die;
                 }
               }
           }

        }
       

        $ftUrls = array();

          $ftIncludedSkus = array();
          if (is_array($this->getParam('ft'))) {
            foreach ($this->getParam('ft') as $key => $sku) {
                
                $existingProductList = Object\Product::getByEan($sku,['unpublished' => true]);
                if($existingProductList->count()>=1) {
                    
                    $product = $existingProductList->current();
                    $ftUrls[] = Pimcore\Tool::getHostUrl().'/pdf/'.$product->getId();
                    $ftIncludedSkus[] = $sku;
                }
            }
         }

          $photosIncludedSkus = array();
          if (is_array($this->getParam('photos'))) {
            foreach ($this->getParam('photos') as $key => $sku) {
                $existingProductList = Object\Product::getByEan($sku,['unpublished' => true]);
                if($existingProductList->count()>=1) {
                  $product = $existingProductList->current();
                  $photosIncludedSkus[] = $sku;

                }
                
            }
         }

         $poseIncludedSkus = array();
          if (is_array($this->getParam('pose'))) {
            foreach ($this->getParam('pose') as $key => $sku) {
                $existingProductList = Object\Product::getByEan($sku,['unpublished' => true]);
                if($existingProductList->count()>=1) {

                  $product = $existingProductList->current();
                  $poseIncludedSkus[] = $sku;

                }
                
            }
         }

        
        $pdfFileUrl = "";
        
        try {

          try {
                
                /* V2 */
                $coverHtmlData = \Pimcore\Tool::getHttpData(
                        Pimcore\Tool::getHostUrl()."/?controller=mauchamp&action=cover-for-piece-commerciale",null,[
                          "xml"=>$this->getParam('xml'),
                          "ftIncludedSkus" => $ftIncludedSkus,
                          "poseIncludedSkus" => $poseIncludedSkus,
                          "photosIncludedSkus" => $photosIncludedSkus,


                        ]);

                $pdfFileName = $order["orderDetail"]["Code_Commande"]."-". uniqid() . ".pdf";
                $pdfFile = PIMCORE_TEMPORARY_DIRECTORY . "/" .$pdfFileName;
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


                         
                         if(in_array($product->getSku(),$ftIncludedSkus) 
                            && $product->getFiche_technique_lpn()
                            || ($product->isAccessoire() && $product->getFiche_technique_orginale())

                          ) {


                            if($product->getFiche_technique_lpn()) {
                              $pdfpath = $product->getFiche_technique_lpn()->getFileSystemPath();
                            }
                            else if($product->isAccessoire() && $product->getFiche_technique_orginale()) {
                              $pdfpath = $product->getFiche_technique_orginale()->getFileSystemPath();
                            }
                            
                            try {


                              $pdf = Zend_Pdf::load($pdfpath); 
                              foreach($pdf->pages as $page){

                                $clonedPage = clone $page;
                                $pdfMerged->pages[] = $clonedPage;
                              }
                              unset($clonedPage);
                            }
                             catch (Exception $e) {
                                 Logger::err($e);
                                  echo json_encode(array("message"=> $e->getMessage(),"message3"=>"Zend_Pdf::load(".$pdfpath.")"));
                                 die;
                            }
                         }
                     }
                }

                 //OK, on a des PDF statiques, on insere avant le PDF Dynalmique
                 if(count($pdfMerged->pages)>0) {

                    try {

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
                     catch (Exception $e) {
                          Logger::err($e);
                          echo json_encode(array("message"=> $e->getMessage(),"message2"=>"error rendering Zend"));
                         die;
                    }

                 }

            }
            catch (Exception $e) {
                 Logger::err($e);
                 echo json_encode(array("message"=> $e->getMessage()));
                 die;
            }

            if($this->getParam('sendmail')=="true") {

                $mail = new Pimcore_Mail();
                $mail->setIgnoreDebugMode(true);

                $mail->setBodyText($this->getParam("message"));

                $mail->clearRecipients();

                //$mail->addTo("florent@lesmecaniques.net",'Florent text');
                $allEmails = explode(";",$this->getParam("to-email"));
                $mail->addTo($allEmails);

                $mail->addBcc("florent@lesmecaniques.net");

                $isEmailValid = $validator->isValid($this->getParam("from-email"), new RFCValidation());
                if($isEmailValid) {
                  $mail->setReplyTo($this->getParam("from-email"));
                  $mail->addCc($this->getParam("from-email"));
                }
               

                $mail->setSubject($this->getParam("subject"));

                $mail->clearFrom();
                $mail->setFrom("contact@lp-nouvelle.fr","La Parqueterie Nouvelle");

                if(strlen($pdfContent)>0) {
                    $at = $mail->createAttachment($pdfContent);
                    $at->type = "application/pdf";
                    $at->filename = "detail-".$order["orderDetail"]["Type_Piece"]."-".$order["orderDetail"]["Code_Commande"]."-laparqueterienouvelle.pdf";
                    $at->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
                }
                $mail->send();

                // reachable via http://your.domain/plugin/LpnPlugin/index/index
                $pimpampoum = new \LpnPlugin\Model\PimPamPoum();
                $pimpampoum->setValue("type","pimpampoum-".$order["orderDetail"]["Type_Piece"]);
                $pimpampoum->setXml($this->getParam('xml'));
                $pimpampoum->setToEmail($this->getParam("to-email"));
                $pimpampoum->setFromEmail($this->getParam("from-email"));
                $pimpampoum->setCodePiece($order["orderDetail"]["Code_Commande"]);
                $pimpampoum->setDate(time());
                //$pimpampoum->setCodeClient($order["orderDetail"]["Code_Client"]);
                $pimpampoum->setFile($pdfFileName);

                //$vote->setUsername('foobar!'.mt_rand(1, 999));
                $pimpampoum->save();

                $this->view->message = "OK !!";

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

        //print_r($this->getParam('ftIncludedSkus'));
        //print_r($this->getParam('poseIncludedSkus'));
        //print_r($this->getParam('photosIncludedSkus'));
        //die;

        
        $this->view->products = $order["products"];

        $this->view->missingProducts = $order["missingProducts"];
        $this->view->transport = $order["transport"];
        $this->view->orderDetail = $order["orderDetail"];
        $this->view->coverTitle = $coverTitle;
        $this->view->xmlOrder = $xml;
        
        $this->view->ftIncludedSkus = is_array($this->getParam('ftIncludedSkus'))?$this->getParam('ftIncludedSkus'):array();
        $this->view->poseIncludedSkus = is_array($this->getParam('poseIncludedSkus'))?$this->getParam('poseIncludedSkus'):array();
        $this->view->photosIncludedSkus = is_array($this->getParam('photosIncludedSkus'))?$this->getParam('photosIncludedSkus'):array();



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
             $fileContent = \Pimcore\Tool::getHttpData(Pimcore\Tool::getHostUrl()."/?controller=mauchamp&action=cover-for-piece-commerciale",null,[
              "xml"=>$data,
              "ftIncludedSkus" => $this->getParam('ftIncludedSkus'),
              "poseIncludedSkus" => $this->getParam('poseIncludedSkus'),
              "photosIncludedSkus" => $this->getParam('photosIncludedSkus'),
            ]);


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
