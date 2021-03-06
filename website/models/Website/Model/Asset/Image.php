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
                     $existingProductList = Object\Product::getByEan($ean,['unpublished' => true]);

                     if($existingProductList->count()>=1) {
                      $existingProducts = $existingProductList->getObjects();
                      foreach ($existingProducts as $existingProduct) {
                        if($existingProduct->ean == $sku) {
                           $product   = $existingProduct;
                          break;
                        }
                      }
                    }


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

        $str = "";
        if($realisation_description = $this->getProperty("realisation_description")) {
               $str  .= $realisation_description;
        }

        if($product = $this->getRelatedProduct()) {

            if(strlen($product->getShort_description())>2)
                $str =  $product->getShort_description();

            //Ajout prix
            $price = $product->getPrice_4();
            $priceTTC = 0;

            $priceStr = "";
            if($price > 0 ) {
                $price = floatval($price);
                $priceStr = " | Prix: ";
                $priceStr .= number_format($price,2);
                $priceStr .= "€ HT/".strtolower($product->getUnite());
                $priceStr .= " - ";
                $priceStr .= number_format($price*1.2,2);
                $priceStr .= "€ TTC/".strtolower($product->getUnite());
                $str .= $priceStr;
            }
            
        }
        

        return $str;
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