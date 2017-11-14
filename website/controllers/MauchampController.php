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

        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->view->layout()->setLayout("layout-mauchamp");

        //POST from sceinergie
        $xml = $this->getParam('xml');

        if(isset($xml))
            $data = $xml;
        else
            //$xml = $data = \Website\Tool\MauchampHelper::getDebugClient();
            $data = \Website\Tool\MauchampHelper::getDebugOrder();
        
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

        //ORDER
        else {
            $order = \Website\Tool\MauchampHelper::parseOrder($data);
            $this->view->products = $order["products"];
            $this->view->missingProducts = $order["missingProducts"];
            $this->view->transport = $order["transport"];
            $this->view->orderDetail = $order["orderDetail"];
            $this->view->xmlOrder = $data;

        }
        
    }

    public function mauchampSendmailAction() {
        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

      
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
             //$this->params["message"] = "Merci pour votre visite !";
             //$emailDocument = Document::getById(345);

             //$mail->setDocument($emailDocument);
             //$mail->setParams($this->getAllParams());

             $mail->setBodyText($this->getParam("message"));

            $mail->clearRecipients();

            $mail->addTo("florent@lesmecaniques.net",'FLorent text');
            $mail->setSubject("Votre sélection La Parqueterie Nouvelle");

            $mail->clearFrom();
            $mail->setFrom("contact@lp-nouvelle.fr");

           
            try {
               // echo "try generate";
                 //Generate PDF
                /* V1 
                $httpsource = implode(" ", $ftUrls);
                $contentPdfPath = $pdfFile?$pdfFile:PIMCORE_SYSTEM_TEMP_DIRECTORY . "/" . uniqid() . ".pdf";
                $pdfContent = $pdfContent = \Website\Tool\Wkhtmltopdf::convert($httpsource,$contentPdfPath);
                */
                /* V2 */
                $coverHtmlData = \Pimcore\Tool::getHttpData(
                        Pimcore\Tool::getHostUrl()."/?controller=mauchamp&action=cover-for-piece-commerciale",null,["xml"=>$this->getParam('xml')]);
                $pdfContent = \Website\Tool\Wkhtmltopdf::fromString($coverHtmlData);


            }
            catch (Exception $e) {
                 echo json_encode(array("message"=> $e->getMessage()));
                 die;
            }


            if(strlen($pdfContent)>0) {
                $at = $mail->createAttachment($pdfContent);
                $at->type = "application/pdf";
                $at->filename = "viste_lpn.pdf";
                $at->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
            }

            $addCover = false;
            if($addCOver) {
                try {

                    
                    //Creation de la cover : 
                    $coverPath = \Pimcore\Tool::getHttpData(
                        Pimcore\Tool::getHostUrl()."/?controller=mauchamp&action=cover-for-piece-commerciale-pdf",null,["xml"=>$this->getParam('xml'),'createfile'=>true]);

                    /*
                    $pdf2show = new Zend_Pdf();
 // $pdfContent
is the generated one
 $pdf1 = Zend_Pdf::parse($pdfContent, 1); 
 //
cloning the page (a must do)
 $template = clone $pdf1->pages[0]; 
 //
Creating the first page of the merged PDF with the previous content
 $page1 =
new Zend_Pdf_Page($template); 
 // Adding this page to the final PDF

$pdf2show->pages[] = $page1; 
 // Loading the statif PDF
 $pdf2 =
Zend_Pdf::load('urlToYourPDF.pdf'); 
 // cloning the page (a must do)

$template2 = clone $pdf2->pages[0]; 
 // Creating the second page of the
merged PDF with the previous content
 $page2 = new
Zend_Pdf_Page($template2);
 // Adding this page to the final PDF 

$pdf2show->pages[] = $page2; 
 sendToWebBrowser('title',
$pdf2show->render());
*/


                    // LOAD PDF DOCUMENTS
                    $pdf1 = Zend_Pdf::load($coverPath);
                    $pdf2 = Zend_Pdf::load($contentPdfPath);
                    // WE WILL MERGE OUR TWO PDF FILES INTO A NEW ZEND_PDF OBJECT
                    $pdfMerged = new Zend_Pdf();

                    // ADD ALL PAGES FROM THE FIRST PDF TO OUR NEW DOCUMENT
                    foreach($pdf1->pages as $page){
                      $clonedPage = clone $page;
                      $pdfMerged->pages[] = $clonedPage;
                    }
                    // ADD ALL PAGES FROM THE SECOND PDF TO OUR NEW DOCUMENT
                    foreach($pdf2->pages as $page){
                      $clonedPage = clone $page;
                      $pdfMerged->pages[] = $clonedPage;
                    }
                    unset($clonedPage);

                    // SEND THE MERGED PDF DOCUMENT TO BROWSER
                    //header('Content-type: application/pdf');
                    //echo $pdfMerged->render();

                    //save to a file
                    $final = $pdfFile?$pdfFile:PIMCORE_SYSTEM_TEMP_DIRECTORY . "/" . uniqid() . ".pdf";
                    $pdfMerged->save($final);   
                }
                catch (Exception $e) {
                    echo $e->getMessage();exit;
                 }
            }


            $mail->send();
         }
          catch (Exception $e) {
                // something went wrong: eg. limit exceeded, wrong configuration, ...
                Logger::err($e);
                //echo $e->getMessage();
                echo json_encode(array("message"=> $e->getMessage()));
                exit;
         }

         echo json_encode(array("message"=> "mail envoyé"));
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

        $this->view->products = $order["products"];
        $this->view->missingProducts = $order["missingProducts"];
        $this->view->transport = $order["transport"];
        $this->view->orderDetail = $order["orderDetail"];
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




         $fileContent = \Pimcore\Tool::getHttpData(Pimcore\Tool::getHostUrl()."/?controller=mauchamp&action=cover-for-piece-commerciale",null,["xml"=>$data]);


         //$filepath = $tmpPdfFile = PIMCORE_SYSTEM_TEMP_DIRECTORY . "/" . uniqid() . ".pdf";
         $pdfContent = \Website\Tool\Wkhtmltopdf::fromString($fileContent);
        
        $filename = "laparqueterrienouvelle.pdf";

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
