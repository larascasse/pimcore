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
        $configurableFields =array("volume",/*"choix",*/"subtype","finitionString","hauteur","profil","fixation","color","epaisseur","largeur","longueur","conditionnement","epaisseur_txt","largeur_txt","longueur_txt","mage_section","quantity_min_txt","configurable_free_1","configurable_free_2","choixString","traitement_surfaceString","motifString","supportString");
        $latestChild = null;

        $ignoreFields = array();

        $fields = \Pimcore\Model\Object\ClassDefinition::getByName("Product")->getFieldDefinitions();

        foreach ($childrenSkus as $childId) {
            $childProduct = \Pimcore\Model\Object::getById($childId);
           

            if($childProduct instanceof Object_Product)
                continue;

             $child = array();

            foreach ($fields as $field) {
                //echo $field->name."\n";
                //On devrait virer les obsoletes
                if(in_array($field->name,$configurableFields)) {
                  $child[$field->name] = $field->getForCsvExport($childProduct);
                }
            }

            
            

            foreach ($fields as $field) {
               // echo $field->name;
                if(in_array($field->name,$configurableFields)) {
                    $key =  $field->name;
                    $value =  $child[$key];


                    if(
                        (isset($child[$key.'_not_configurable']) && $child[$key.'_not_configurable']) 
                        || $value=="" ) {
                        $ignoreFields[] = $key;
                        continue;
                    }


                    //pour les dimmesnios, on prends la valeur du TXT s'il exite
                    else if($key=="longueur_txt" && isset($child['longueur_not_configurable']) && $child['longueur_not_configurable']) {
                        continue;
                    }
                    else if($key=="epaisseur_txt" && isset($child['epaisseur_not_configurable']) && $child['epaisseur_not_configurable']) {
                        continue;
                    }
                    else if($key=="largeur_txt" && isset($child['largeur_not_configurable']) && $child['largeur_not_configurable']) {
                        continue;
                    }


                    if($key=="longueur" && isset($child['longueur_txt']) && strlen(trim($child['longueur_txt']))>0) {
                        continue;
                    }
                    else if($key=="largeur" && isset($child['largeur_txt']) && strlen(trim($child['largeur_txt']))>0) {

                        continue;
                    }
                    else if($key=="epaisseur" && isset($child['epaisseur']) && strlen(trim($child['epaisseur_txt']))>0) {
                        continue;
                    }

                    if($key=="mage_section" && (!isset($child['mage_use_section_as_configurable']) ||  !$child['mage_use_section_as_configurable'])) {
                        continue;
                    }

                    //TODO MELANGE DE LONGEUR FIXE ET LONGEURU S PANBACHES + LARGEUR

                    if($key == "traitement_surfaceString") {
                       //   echo "traitement_surface : ".$value."<br />";
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
        $order = array('subtype','motifString','fixation','choixString','finitionString','supportString','traitement_surfaceString','epaisseur','epaisseur_txt','largeur','largeur_txt','longueur','longueur_txt','subtype');



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
            $attributesLabel = "choix_txt";
        }


        return $attributesLabel;
    }

    

}