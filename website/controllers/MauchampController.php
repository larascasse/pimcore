<?php

ini_set('display_errors', 1);
//error_reporting(E_ALL);



use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

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

        $this->view->layout()->setLayout("layout-mauchamp");

        //POST from sceinergie
        $xml = $this->getParam('xml');

        if(isset($xml))
            $data = $xml;
        else
             $xml = $data = \Website\Tool\MauchampHelper::getDebugClient();
            //$data = \Website\Tool\MauchampHelper::getDebugOrder();
        
        if(\Website\Tool\MauchampHelper::isClientRequest($data)) {
            $client = \Website\Tool\MauchampHelper::parseClient($data);
            //print_r($client);
            try {
                $this->view->client = $client;
                $this->view->xmlClient = $xml;
                $this->renderScript('mauchamp/mauchamp-client.php');
                
            }
            catch (Exception $e) {
                //echo "klmklmklkm".$e->getMessage();
            }
            //die;
        }
        else {
            $order = \Website\Tool\MauchampHelper::parseOrder($data);
            $this->view->products = $order["products"];
            $this->view->missingProducts = $order["missingProducts"];
            $this->view->transport = $order["transport"];
        }
        
    }

    public function mauchampSendmailAction() {
        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
      
         header('Content-Type: application/json');

          $ftUrls = array();

          if (is_array($this->getParam('ft'))) {
            foreach ($this->getParam('ft') as $key => $sku) {
                
                $existingProductList = Object\Product::getByEan($sku);
                if($existingProductList->count()>=1) 
                       $product = $existingProductList->current();

                if($product) {
                    $ftUrls[] = Pimcore\Tool::getHostUrl().'/pdf/'.$product->getId();
                }
            }
         }

        
  

        

         try {

             $mail = new Pimcore_Mail();
             $mail->setIgnoreDebugMode(true);
             $this->params["message"] = "Merci pour votre visite !";
             $emailDocument = Document::getById(345);

             $mail->setDocument($emailDocument);
             $mail->setParams($this->getAllParams());

            $mail->clearRecipients();

            $mail->addTo("florent@lesmecaniques.net",'FLorent text');
            $mail->setSubject("Votre sélection La Parqueterie Nouvelle");

            $mail->clearFrom();
            $mail->setFrom("contact@lp-nouvelle.fr");

           
            try {
                 //Generate PDF
                $httpsource = implode(" ", $ftUrls);
                $pdfContent = $pdfContent = \Website\Tool\Wkhtmltopdf::convert($httpsource);
            }
            catch (Exception $e) {
                //echo $e->getMessage().$httpsource;exit;
            }


            if(strlen($pdfContent)>0) {
                $at = $mail->createAttachment($pdfContent);
                $at->type = "application/pdf";
                $at->filename = "viste_lpn.pdf";
                $at->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
            }


            $mail->send();
         }
          catch (Exception $e) {
                // something went wrong: eg. limit exceeded, wrong configuration, ...
                Logger::err($e);
                echo $e->getMessage();exit;
                }

         echo json_encode(array($httpsource,$ftUrls));
      

         
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
        
        $xml = $order = \Website\Tool\MauchampHelper::loadAzureOrder($codecommande);
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

    public function log($error,$error_type='') {
        echo $message;
    }


   

    


}
