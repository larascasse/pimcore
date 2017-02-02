<?php

namespace Website\Tool;
use Pimcore\Model;
use Website\Model\Asset\Image;
class AssetHelper
{
    


    public static function getImagesArray($imagesOrFolders, $includeProductThumb=false) {
       
        $return = array();

        

        //print_r( $imagesOrFolders);
        $count=count($imagesOrFolders);
        $assetsArray=array();

        $i=0;
       

        


        //$count=count($assetsArray);
        if($count>0) {
           
            for ($i=0; $i < $count; $i++) { 
                $assets=Asset\Folder::getById($imagesOrFolders[$i]->id)->getChilds();

                 $arrayImages = array();
                 $arrayThumbs = array();
                 if(count($assets)>0 && $assets[0] instanceof Asset\Image) {
                    
                    $urlImage = $assets[0]->getThumbnail("magento_realisation")->getPath();
                 
                    foreach ($assets as $asset) {
                        if($asset instanceof Asset\Image) {
                            $arrayImages[] = $asset->getThumbnail("magento_realisation")->getPath();
                            
                            if($includeProductThumb) {
                                $arrayThumbs[] = $asset->getThumbnail("galleryThumbnail")->getPath();
                            }
                        }
                    }
                    
                    $returnArray  = (object) array("base"=>$urlImage,"images"=>$arrayImages);

                    if($includeProductThumb) {
                
                        $returnArray->thumb = $arrayThumbs;
                    }

                    if($includeProductName) {
                        //echo $assets[0]->getId()."/";

                        $product = _getProductFromAsset($assets[0]);
                        $returnArray->name = $product?$product->getName():"";
                        $returnArray->sku = $product?$product->getSku():"";
                    }

                    $return[] = $returnArray;


                 }
                 
                
                

            }
            
        }
        return $return;
        //return Zend_Json::encode($return);
    }




    public static function getAssetArray($imagesOrFolders,$recursive=true) {
       
        $return = array();


        //echo ( $imagesOrFolders);
        $count=count($imagesOrFolders);
        $assetsArray=array();
        $baseAsset="";

        $i=0;


        //$count=count($assetsArray);
        if($count>0) {
           
            for ($i=0; $i < $count; $i++) { 
               
                $assetGroup = $imagesOrFolders[$i];//Model\Asset::getById($imagesOrFolders[$i]->id);
                if($assetGroup instanceof \Pimcore\Model\Asset\Folder) {

                    $assets=$assetGroup->getChilds();

                    if(count($assets)>0) {
                        $baseAsset =  $assets[0];
                     
                        foreach ($assets as $asset) {
                            if($asset instanceof \Pimcore\Model\Asset\Image) {
                               $assetsArray[] = $asset;
                            }
                            else if($asset instanceof \Pimcore\Model\Asset\Folder && $recursive) {
                                $assetsRecusrive = AssetHelper::getAssetArray(array($asset),true)->assets;
                                //echo count($assetsRecusrive)."<br />";
                                if(is_array($assetsRecusrive))
                                    $assetsArray = array_merge($assetsArray,$assetsRecusrive);

                            } 
                        }
                    } 

                }
                else if($assetGroup instanceof \Pimcore\Model\Asset\Image) {
                        $assetsArray[] = $assetGroup;
                }
                else {
                    // print_r($imagesOrFolders[$i]);
                }
                
                   

                    

                    /*if($includeProductName) {
                        //echo $assets[0]->getId()."/";

                        $product = _getProductFromAsset($assets[0]);
                        $returnArray->name = $product?$product->getName():"";
                        $returnArray->sku = $product?$product->getSku():"";
                    }*/



                 
                 
                
                

            }
            
        }
         $returnArray  = (object) array("base"=>$baseAsset,"assets"=>$assetsArray);
        return $returnArray;
        //return Zend_Json::encode($return);
    }


    public static   function _getProductFromAsset($asset) {
        //echo $asset->getId().'/';

        //Ca marche,mais en fait prendre le produit courant marche bien ..
        //Commenter la ligne ci dessous pour avec un prodiot référencé dans l'asset ou les dépenances
        //A voir si c'est onction en full, on ne la met pas dans la classe Website_Asset, ou dans un helper
        return $this;


        if($asset instanceof Asset\Asset) {

            //D'abord on regarde si un produit n'st pas associé comme medtata
            $product = $asset->getProperty("product");
            if(!$product) {
                $ean = $asset->getMetadata("product");

                 $list = Object_Product::getList(array(
                    'limit' => 1,
                    'condition' => 'ean = \''.$ean.'\''
                    ));

                $product = $list->current();
                if(!$product) {
                    $list = Object_Product::getList(array(
                    'limit' => 1,
                    'condition' => 'code = \''.$ean.'\''
                    ));
                    $product = $list->current();
                }
            }
            if($product) {
                return $product;
            }

            //A partie de la on regarde dans les dépendances

            $dependencies = $asset->getDependencies()->getRequiredBy();


            //echo count($dependencies);

            //si âs de depdance, on prend le folter au dessus
        

            if(count($dependencies)) {

                foreach ($dependencies as $dependencie) {
                    //print_r($dependencie);



                    if(is_array($dependencie) && count($dependencie)>0 && is_array($dependencie[0])) {


                        $product = Object_Abstract::getById($dependencie[0]['id']);
                        if($product instanceof Object_Product)
                            return $product;
                        
                    }
                    else if(is_array($dependencie) && count($dependencie)>0 && $dependencie['type']  == 'object') {
                

                        $product = Object_Abstract::getById($dependencie['id']);
                        if($product instanceof Object_Product)
                            return $product;
                        
                    }
                    else if(is_int($dependencie)) {
            
                        $product = Object_Abstract::getById($dependencie);
                        if($product instanceof Object_Product && $product->getId()>0)
                            return $product;
                    }
                }
            }
            //OK, pas de depenance, on regarde le folder du dessus
            if(($folder = Asset::getById($asset->getParentId())) instanceof Asset_Folder) {
                return _getProductFromAsset($folder);
            }

        }
        //die;
        return;

    }
}