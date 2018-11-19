<?php

namespace Website\Tool;
use Pimcore\Model;
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;
use Website\Model\Asset\Image;
class ProductHelper
{
    


    public static function getConfigurableAttributesFromProductIds($childrenSkus=array()) {

        //Pour les teintes, dans le cas ou il n'y a qu'un seur configurable
       
    
        $childConfigurableFields = array();
        $configurableFields =array("configurable_free_1","volume","subtype","finitionString","hauteur","profil","fixation","color","epaisseur","largeur","longueur","conditionnement","epaisseur_txt","largeur_txt","longueur_txt","mage_section","quantity_min_txt","configurable_free_2","choixString","traitement_surfaceString","motifString","supportString");

        
        $retrievableAttributes = [];
        foreach ($configurableFields as $key => $value) {
            $retrievableAttributes [] = $value."_not_configurable";
            
        }
        $retrievableAttributes [] = "mage_use_section_as_configurable";

        $latestChild = null;

        $ignoreFields = array();

        $fields = \Pimcore\Model\Object\ClassDefinition::getByName("Product")->getFieldDefinitions();

        
        $unpublishedStatus = Model\Object\AbstractObject::doHideUnpublished();
        Model\Object\AbstractObject::setHideUnpublished(false);

        $inheritance = Model\Object\AbstractObject::getGetInheritedValues();
        Model\Object\AbstractObject::setGetInheritedValues(true);

        //on va recherche le type de produit pour gérer 
        // le configurable par defaut si un seul produit configurable
        $product_type = "";




        foreach ($childrenSkus as $childId) {

            $childProduct = \Pimcore\Model\Object::getById($childId);

            //print_r($childProduct);

            
       
           

            if($childProduct instanceof Object_Product)
                continue;


             if($product_type == "")
                $product_type =  $childProduct->getProduct_type();


             $child = array();
             $childAllValues = array();

            foreach ($fields as $field) {
                
                //MPB recusrion
                if(in_array($field->name, $retrievableAttributes))
                    

                    $value = $field->getForCsvExport($childProduct);
                    $childAllValues[$field->name] = $value;
                
                    //On devrait virer les obsoletes
                    if(in_array($field->name,$configurableFields)) {
                      //echo $field->name."-".$field->getForCsvExport($childProduct)."\n";
                      $child[$field->name] = $value;
                    }
                }
            }

           
            

            foreach ($fields as $field) {
                


                if(in_array($field->name,$configurableFields)) {
                    
                    $key =  $field->name;
                    $value =  $child[$key];
                
                   //echo $key." ".$value."\n\n";


                    if(
                        (isset($childAllValues[$key.'_not_configurable']) && $childAllValues[$key.'_not_configurable']) 
                        || $value=="" ) {
                        $ignoreFields[] = $key;
                        continue;
                    }


                    //pour les dimmesnios, on prends la valeur du TXT s'il exite
                    else if($key == "longueur_txt" && isset($childAllValues['longueur_not_configurable']) && $childAllValues['longueur_not_configurable']) {
                        $ignoreFields[] = "longueur_txt";
                        continue;
                    }
                    else if($key == "epaisseur_txt" && isset($childAllValues['epaisseur_not_configurable']) && $childAllValues['epaisseur_not_configurable']) {
                        $ignoreFields[] = "epaisseur_txt";
                        continue;
                    }
                    else if($key == "largeur_txt" && isset($childAllValues['largeur_not_configurable']) && $childAllValues['largeur_not_configurable']) {
                        $ignoreFields[] = "largeur_txt";
                        continue;
                    }


                    if($key=="longueur" && isset($childAllValues['longueur_txt']) && strlen(trim($childAllValues['longueur_txt']))>0) {
                        continue;
                    }
                    else if($key=="largeur" && isset($childAllValues['largeur_txt']) && strlen(trim($childAllValues['largeur_txt']))>0) {

                        continue;
                    }
                    else if($key=="epaisseur" && isset($childAllValues['epaisseur_txt']) && strlen(trim($childAllValues['epaisseur_txt']))>0) {
                        continue;
                    }

                    if($key=="mage_section" && (!isset($childAllValues['mage_use_section_as_configurable']) ||  !$childAllValues['mage_use_section_as_configurable'])) {
                        continue;
                    }

                    //TODO MELANGE DE LONGEUR FIXE ET LONGEURU S PANBACHES + LARGEUR

                    if($key == "traitement_surfaceString") {
                       //   echo "traitement_surface : ".$value."<br />";
                    } 

                    
                    if($key == "subtype") {
                         // echo "subtype : ".$child[$key]."\n";
                    }

                    //TODO PB SUR http://magento.florent.local/LPN/get_a_product_magmi.php?path=/teintes/teintes/_import_/ex/&teinte&create&showDebug=1
                    
                    //echo $key." ".$value." ".$latestChild[$key]."\n\n";

                    $mustRegisterAttributeName = $latestChild 
                                            && in_array($key, $configurableFields) 
                                            && !in_array($key, $ignoreFields)
                                            &&  isset($child[$key]) 
                                            && ($child[$key] != $latestChild[$key]);

                    //echo $key." = ".$child[$key]." : ".$mustRegisterAttributeName." : ".in_array($key, $configurableFields)."<br />";
                    /** OK? on calcul si le précedent produit n'a pas une valeur différente 
                    pour le champ choisit */
                    if($mustRegisterAttributeName) {
                        //Mage::log("add".$key,null,"import_products_pim.log"); 
                        /*if(!in_array($key, $childConfigurableFields) && count($childConfigurableFields)<2) {
                            $childConfigurableFields[]=$key;
                        }*/

                        //TEST : ON IMPORT PLUS DE 2 CONFIGURABLES
                        if(!in_array($key, $childConfigurableFields)) {
                            $childConfigurableFields[]=$key;
                        }
                    }


                }
                

            }
            $latestChild = $child;
           

        }

        Model\Object\AbstractObject::setHideUnpublished($unpublishedStatus);
        Model\Object\AbstractObject::setGetInheritedValues($inheritance);

        if(in_array("longueur_txt", $childConfigurableFields)) {
            $childConfigurableFields = array_diff($childConfigurableFields, array('longueur'));
        }
        if(in_array("largeur_txt", $childConfigurableFields)) {
            $childConfigurableFields = array_diff($childConfigurableFields, array('largeur'));
        }
        if(in_array("epaisseur_txt", $childConfigurableFields)) {
            $childConfigurableFields = array_diff($childConfigurableFields, array('epaisseur'));
        }

        if(in_array("mage_section", $childConfigurableFields)) {
            $childConfigurableFields = array_diff($childConfigurableFields, array('epaisseur','largeur','epaisseur_txt','largeur_txt'));
        }

        //On ordonne suivant le tableau suivant :
        $order = array('motifString','subtype','configurable_free_1','profil','fixation','choixString','finitionString','supportString','traitement_surfaceString','epaisseur','epaisseur_txt','largeur','largeur_txt','longueur','longueur_txt');



        //on eneleve les elements non configurables
        $configurableFields = array_diff( $configurableFields, $ignoreFields);
       
        $childConfigurableFields = array_merge(
            array_intersect($order, $childConfigurableFields), 
            array_diff($childConfigurableFields, $order)
        );



        $attributesLabel = implode(",", $childConfigurableFields);
        $attributesLabel =str_replace("mage_section","section",$attributesLabel);
        $attributesLabel =str_replace("traitement_surfaceString","traitement_surface",$attributesLabel);
        $attributesLabel =str_replace("choixString","choix_txt",$attributesLabel);
        $attributesLabel =str_replace("motifString","motif",$attributesLabel);
        $attributesLabel =str_replace("supportString","motif",$attributesLabel);
        $attributesLabel =str_replace("finitionString","finition",$attributesLabel);

        //On ne prends plus la largeur mais la largeur.TXT
        //if($p["subtype"] == "teinte") {

        $attributesLabel =str_replace("largeur","largeur_txt",$attributesLabel);
        $attributesLabel =str_replace("epaisseur","epaisseur_txt",$attributesLabel);
        $attributesLabel =str_replace("longueur","longueur_txt",$attributesLabel);
        $attributesLabel =str_replace("_txt_txt","_txt",$attributesLabel);

        //Gesion du mono sku
        if(count($childrenSkus) == 1 && $attributesLabel=="") {
            switch ($product_type) {
                case 'sol-stratifie':
                case 'sol-plaque':
                    //Collection
                    $attributesLabel = "configurable_free_1";
                    break;
                case 'terrasse':
                    $attributesLabel = "fixation";
                    break;
                default:
                    $attributesLabel = "choix_txt";
                    break;
            }
            
        }


        return $attributesLabel;
    }

    

}