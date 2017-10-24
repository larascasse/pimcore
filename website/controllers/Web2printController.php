<?php

use Website\Controller\Action;
use Config;

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
    	$id = $this->getParam("id");
    	//$id=8706;
    	if($id>0) {

    		 $product = Object_Product::getById($this->getParam("id"));

	        if(!$product instanceof Object_Product || !$product->isPublished()) {
	            
	           
	            throw new \Zend_Controller_Router_Exception("invalid request");
	        }
	        //$httpSource = $product->getDefinition()->getPreviewUrl();

	        $httpSource = "http://pimcore.florent.local/id/".$id;

	         $front = Zend_Controller_Front::getInstance();

	         $web2printConfig = \Pimcore\Config::getWeb2PrintConfig();

	         if (empty($wkhtmltopdfBin)) {
	            $this->wkhtmltopdfBin = $web2printConfig->wkhtmltopdfBin;
	        } else {
	            $this->wkhtmltopdfBin = $wkhtmltopdfBin;
	        }

	        if (empty($options)) {
	            if ($web2printConfig->wkhtml2pdfOptions) {
	                $options = $web2printConfig->wkhtml2pdfOptions->toArray();
	            }
	        }

	        

	       // print_r($options);




	         $tmpPdfFile = PIMCORE_SYSTEM_TEMP_DIRECTORY . "/" . uniqid() . ".pdf";

	        $localOptions= [
	        	"--debug-javascript" => 1,
	        	"--load-error-handling" => "ignore"
	        ];
	       
	        $optionConfig = array();
	        
 			$options=" ";
	        if(is_array($localOptions)) {
	            foreach ($localOptions as $argument => $value) {
	                // there is no value only the option
	                if(is_numeric($argument)) {
	                    $optionConfig[] = $value;
	                } else {
	                    $optionConfig[] = $argument . " " . $value;
	                }
	            }
	 
	            $options .= implode(" ", $optionConfig);
	        }
 	

	        if($web2printConfig->wkhtmltopdfBin) {
	            $wkhtmltopdfBinary = $web2printConfig->wkhtmltopdfBin;
	        }

 
        	system($wkhtmltopdfBinary.$options." " . $httpSource . " " . $tmpPdfFile);

        	echo $wkhtmltopdfBinary.$options." " . escapeshellarg($httpSource) . " " . escapeshellarg($tmpPdfFile);


	    
 
        	$pdfContent = file_get_contents($tmpPdfFile);
 
       			 // remove temps
       		 //@unlink($tmpPdfFile);

       		$headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename=" . ' . $this->filename . '";"',
                'Cache-Control' => 'private'
            ];

        
            die;

       

 
       		// return $pdfContent;

       		 return new Response($pdfContent, 200, $headers);
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