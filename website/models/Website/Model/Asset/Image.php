<?php

namespace Website\Model\Asset;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;

class Image extends Asset\Image {
	

    /*public function __construct () {
        echo "lmklmklmklmklklklmklmsmdsqmdqs=dnqsdnq";
    }*/
    protected  $_product;


    public function toto () {
        echo "TOTO";
    }


	public function getRelatedProduct() {

        if(!isset($this->_product)) {

    		$image  = $this;
           
            $ean="";
            $name="";
            $sku = "";

            //$image->toto();
      	
      		 $product = $image->getProperty("product");

             
        
             if(!$product) {
            
               
                $dependencies = $image->getDependencies();
                
                $requiredBy = $dependencies->requiredBy;
                if (is_array($requiredBy)) {
                
                    foreach ($requiredBy as $key => $value) {
                        if($value['type']=="object") {

                            $element = Object\AbstractObject::getById($value['id']);
                            if($element && $element instanceof Object\Product) {
                                $product = $element;
                    
                            }
                        }
                        
                    }
                }
                
                 $ean = $image->getMetadata("product");
                 if($ean) {
                     if(!$product) {
                     $product = Object\Product::getByEan($ean)->objects[0];
                    }

                    if(!$product) {
                       $product = Object\Product::getByCode($ean)->objects[0];
                    }
                 }
               
            }

            $this->_product = $product;

            //TOD
            //s'il n'y a pas de dependance, on regarde dans le dossier supérieur
            /*if(!$product) {
                $folder = Asset\Folder::getById($image->getParentId());
                
                if($folder instanceof Asset\Folder) {

                    $productParentObject = real_product_from_image($folder);
                    if(strlen($productParentObject->sku)>0)
                        return $productParentObject;
                }
            }
            */

            

        }
            

        return  $this->_product;

	}

    public function getRelatedTitle($full=false) {
        if($realisation_title = $this->getProperty("realisation_title")) {
               return $realisation_title;
        }
        else if(($product = $this->getRelatedProduct()) && $full) {
            return $product->getMage_Name();
        }
        else if($product = $this->getRelatedProduct()) {
            return $product->getSubtype()." ".$product->getShort_name();
        }
        else {
            return "";
        }
    }

     public function getRelatedDescription() {
        if($realisation_description = $this->getProperty("realisation_description")) {
               return $realisation_description;
        }
        else if($product = $this->getRelatedProduct()) {
            return $product->getShort_description();
        }
        else {
            return "";
        }
    }

     public function getRelatedChoix() {
        if($product = $this->getRelatedProduct()) {
            return $product->getChoix();
        }
        else {
            return "";
        }
    }
    public function getRelatedChoixString() {
        if($product = $this->getRelatedProduct()) {
            return $product->getChoixString();
        }
        else {
            return "";
        }
    }
    

    
}