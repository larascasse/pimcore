<?php

namespace Website;

use Pimcore\Model\Asset;
use Pimcore\Model\Element\ElementInterface;
use Pimcore\Model\Object\BlogArticle;
use Pimcore\Model\Object\ClassDefinition\Data;
use Pimcore\Model\Object\Concrete;
use Pimcore\Model\Object\News;
use Pimcore\Model\Object;

class TheFormatter
{
    /**
     * @param $result array containing the nice path info. Modify it or leave it as it is. Pass it out afterwards!
     * @param ElementInterface $source the source object
     * @param $targets list of nodes describing the target elements
     * @param $params optional parameters. may contain additional context information in the future. to be defined.
     * @return mixed list of display names.
     */
    public static function formatPath($result, ElementInterface $source, $targets, $params) {
        
        /** @var  $fd Data */
        $fd = $params["fd"];
        $context = $params["context"];

        foreach ($targets as $key => $item) {
            
            $newPath = $item["path"];// .  " - " . time();
            
            if ($context["language"]) {
                $newPath .= " " . $context["language"];
            }


            /* OBJECT */
            if ($item["type"] == "object") {
                $targetObject = Concrete::getById($item["id"]);
                if ($targetObject instanceof Object\News) {
                    $newPath = $targetObject->getTitle() . " - " . $targetObject->getShortText();
                }
                if ($targetObject instanceof Object\Product) {
                    $newPath = $targetObject->getName() ." - ". $targetObject->getSku();
                    $asset = $targetObject->getImage_1();
                    //$newPath = '<img src="' . $asset . '" style="width: 25px; height: 18px;" />'.$newPath;
                }
                else if ($targetObject instanceof Object\BlogPost) {
                    $newPath = $targetObject->getTitle();
                }
            } 

            /* ASSET */
            elseif ($item["type"] == "asset") {
                $asset = Asset::getById($item["id"]);
                if ($asset) {
                    $title = $asset->getMetadata("title");


                    if (!$title) {
                        $title = $newPath;
                    }
                    if ($fd instanceof Data\Multihref) {

                        $thumbnail = TheFormatter::getThumbnailOfAsset($asset);

                        if($thumbnail) {
                            $newPath = '<img src="' . $thumbnail->getPath() . '" style="width: 30px; height: 20px;" />' . $title; 
                        }
                        
                        /*if ($asset instanceof Asset\Folder) {
                            $children=$asset->getChildren();
                            if(is_array($children) && count($children)) {

                                foreach ($children as $child) {
                                    # code...
                                         if ($child instanceof Asset\Image) {
                                        $newPath = '<img src="' . $child->getThumbnail('galleryThumbnail')->getPath() . '" style="width: 35px; height: 28px;" />' . $title;
                                        break;
                                    }
                                }
                               
                            }
                      

                            
                        }
                        else {
                           $newPath = '<img src="' . $asset->getThumbnail('galleryThumbnail')->getPath() . '" style="width: 35px; height: 28px;" />' . $title; 
                        }*/
                        
                    } else {
                        $newPath = $title;
                    }
                }
            }
                
            // don't forget to use the same key, otherwise the matching doesn't work
            $result[$key]= $newPath;
        }
        return $result;
    }

    public static function getThumbnailOfAsset($asset) {

        if ($asset instanceof Asset\Folder) {

            $children=$asset->getChildren();
            if(is_array($children)) {

                foreach ($children as $child) {
                    # code...
                    if ($child instanceof Asset\Image) {

                        return $child->getThumbnail('galleryThumbnail');
                        break;
                    }
                    else {
                       
                        return TheFormatter::getThumbnailOfAsset($child);
                        break;
                    }
                }
               
            }
      

            
        }
        elseif($asset) {

           return $asset->getThumbnail('galleryThumbnail');
        }
    }
}