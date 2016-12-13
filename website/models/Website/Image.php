<?php



class Image extends Asset_Image {
	public function toto()  {
		echo "TOTO";
	}
	//NOT WORKING, not extended
	public function getRelatedProduct() {
		$image  = $this;
       
        $ean="";
        $name="";
        $sku = "";

        $image->toto();
  	
  		 $product = $image->getProperty("product");

  		//On check d'abord les dependancies
        if(!$product) {
           
            $dependencies = $image->getDependencies();
            
            $requiredBy = $dependencies->requiredBy;
            if (is_array($requiredBy)) {
           
                foreach ($requiredBy as $key => $value) {
                    if($value['type']=="object");
                    $element = Object_Abstract::getById($value['id']);
                    if($element instanceof Object_Product) {
                        $product = $element;
            
                    }
                }
            }
            
            /* $ean = $image->getMetadata("product");
             if($ean) {
                 if(!$product) {
                 	$product = Object_Product::getByEan($ean)->objects[0];
                }

                if(!$product) {
                   $product = Object_Product::getByCode($ean)->objects[0];
                }
             }*/
           
        }
        
        if($product) {

            $ean=$product->getEan()?$product->getEan():$product->getCode();
        }

       

        if($product) {
            $name=$product->getName();
            $sku=$ean;

        }
        $productObject =(object) array (
                "name"=>$name,
                "sku" => $sku
                );
        return $productObject;

	}
}