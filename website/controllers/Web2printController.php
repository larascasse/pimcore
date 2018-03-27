<?php

use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

class Web2printController extends Action
{
    public function defaultAction()
    {
    	$this->view->title = $this->getParam("title"); 
    }

    public function containerAction()
    {
        $document = $this->getParam("document");
        $allChildren = $document->getAllChildren();

        $this->view->allChildren = $allChildren;
    }


    public function getProductPreviewPdfAction() {

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");

        
    	$id = $this->getParam("id");
    	//$id=8706;

    	if($id>0) {

    		 $product = Object_Product::getById($this->getParam("id"));

	        if(!$product instanceof Object_Product/*|| !$product->isPublished()*/) {
	            
	           
	            //throw new \Zend_Controller_Router_Exception("invalid request");
	            echo "wrong id";
	            die;
	        }
	        //$httpSource = $product->getDefinition()->getPreviewUrl();

	        $httpSource = Pimcore\Tool::getHostUrl()."/id/".$id;//."?t=".$time();

         
	        $pdfContent = \Website\Tool\Wkhtmltopdf::convert($httpSource);

        	$filename = "lpn-ft-".$product->getMage_short_name(3000)."_".$id.".pdf";
	           
            $filename = \Pimcore\File::getValidFilename($filename);


       		$headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
                'Cache-Control' => 'private'
            ];

            foreach ($headers as $key => $value) {
            	 $this->getResponse()->setHeader($key,$value);
            	 Header($key.":".$value);
            }
           

       		 echo $pdfContent;
       		 exit;




	        /*file_put_contents(PIMCORE_TEMPORARY_DIRECTORY . "/pdf-reactor-input.html", $html);
        $html = preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $html);
        if(!$_GET['html']) {
            $result = $this->doCreatePDF8($html);
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename=" . ' . $this->filename . '";"',
                'Cache-Control' => 'private'
            ];
            return new Response($result, 200, $headers);
        } else {
            return new Response($html);
        }*/


    	}
    }


    public function getProductPhotoPdfAction() {

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");

        
        $id = $this->getParam("id");
        //$id=8706;

        if($id>0) {

             $product = Object_Product::getById($this->getParam("id"));

            if(!$product instanceof Object_Product || !$product->isPublished()) {
                
               
                //throw new \Zend_Controller_Router_Exception("invalid request");
                echo "wrong id";
                die;
            }
            //$httpSource = $product->getDefinition()->getPreviewUrl();

            $httpSource = Pimcore\Tool::getHostUrl()."?controller=product&action=detail-photos&id=".$id;//."?t=".$time();
            //echo  $httpSource;
            //die;
            $pdfContent = \Website\Tool\Wkhtmltopdf::convert($httpSource);

            $filename = "lpn-photos-".$product->getMage_short_name(3000)."_".$id.".pdf";
            $filename = \Pimcore\File::getValidFilename($filename);
        


            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
                'Cache-Control' => 'private'
            ];

            foreach ($headers as $key => $value) {
                 $this->getResponse()->setHeader($key,$value);
                 Header($key.":".$value);
            }
           

             echo $pdfContent;
             exit;




            /*file_put_contents(PIMCORE_TEMPORARY_DIRECTORY . "/pdf-reactor-input.html", $html);
        $html = preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $html);
        if(!$_GET['html']) {
            $result = $this->doCreatePDF8($html);
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename=" . ' . $this->filename . '";"',
                'Cache-Control' => 'private'
            ];
            return new Response($result, 200, $headers);
        } else {
            return new Response($html);
        }*/


        }
    }
}