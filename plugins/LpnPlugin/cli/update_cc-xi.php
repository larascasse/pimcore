<?php


include(dirname(__FILE__) . "/../../../pimcore/cli/startup.php");

//this is optional, memory limit could be increased further (pimcore default is 1024M)
ini_set('memory_limit', '1024M');
ini_set("max_execution_time", "-1");

//execute in admin mode
define("PIMCORE_ADMIN", true);
Pimcore::setAdminMode();
Object_Abstract::setHideUnpublished(false);
Object_Abstract::setGetInheritedValues(false);


Pimcore_Model_Cache::disable();
\Pimcore\Model\Version::disable();

$conditionFilters = array("
       o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-xi%'

    ");


$list = new Pimcore\Model\Object\Product\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));
//$list->setOrder("ASC");
//$list->setOrderKey("o_id");

$list->setOrder("DESC");
$list->setOrderKey("o_id");


$list->load();

$objects = array();
 echo "objects in list ".count($list->getObjects())."\n";
//Logger::debug("objects in list:" . count($list->getObjects()));

foreach ($list->getObjects() as $object) {


    //echo "update ".$object->getName()."\n";
    //COPIE DE SCIERGNER COURT
    //$value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));

    if(!($object instanceof Object_Product))
        continue;
    
    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 


    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->name_scienergie;
    $article = $object->code;
    $parent = $object->getParent();

    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    /*if(stristr($scienergieCourt, "hd")) {
        $object->setSupport('HDF');
         $save=true;
    }
    else if(stristr($scienergieCourt, "cp")) {*/
        //$object->setSupport('cp');
        //$save=true;
    //}

   

    //Usée brosssé
    /*
    Brossé,brosse
Brossé accentué, brosse accentue
Brut,brut
Brut de sciage, brut de sciage
Vieilli rives abimées, vieilli
Usé,use
*/
    echo "\n$article ?";


    //largeur
    if(strlen($object->getEan())>0) {
        /*switch ($object->getLargeur()) {
            case '540':
                //$object->setValue('largeur_txt','Largeurs panachées : 160/180/200 mm');
                break;
            case '600':
                //$object->setValue('largeur_txt','Largeurs panachées : 180/200/220 mm');
                break;
            default:
                # code...
                break;
        }*/
        //pimonly_section
        //$object->setValue("pimonly_name_suffixe",$object->getChoixString()." ".$object->getPimonly_section());
        $object->setValue("pimonly_name_suffixe",$object->getEpaisseur().'x'.$object->getLargeur()."x1000-2400");
        $object->setValue('traitement_surface',"brosse");
    }
    else {

        if(stristr($article, "G2")) {
            $object->setChanfreins(2);
        }
        else if(stristr($article, "G4")) {
            $object->setChanfreins(4);

        }
        else if(stristr($article, "G0")) {
            $object->setChanfreins(0);

        }
    }
    //CONTEMPORAIN
    if(stristr($scienergieCourt, "smat")) {
         //$object->setTraitement_surface(("vieilli use brosse rives abimees"));


        

         //EAN
         if(strlen($object->getEan())>0) {
            //$object->setValue("pimonly_name_suffixe",$object->pimonly_dimensions);


         }
         //Article
         else  {
            $object->setValue("finition","vernis-semi-mat");
            $object->setValue("pimonly_name_suffixe",$object->getChoixString()." "."brossé vernis semi-mat");
           // $parent->save();
            
         }
         
         $save=true;
    } 
    elseif(stristr($article, "vbm") || stristr($article, "bic")) {
         //$object->setTraitement_surface(("vieilli use brosse rives abimees"));


        

         //EAN
         if(strlen($object->getEan())>0) {
            //$object->setValue("pimonly_name_suffixe",$object->pimonly_dimensions);


         }
         //Article
         else  {
            $object->setValue("finition","Verni mat");
            $object->setValue("pimonly_name_suffixe",$object->getChoixString()." "."vernis mat");
           // $parent->save();
            
         }
         
         $save=true;
    }

    //vieilli
    else if(stristr($article, "vbs")) {
         


         if(strlen($object->getEan())>0) {

         }
         else {
            $object->setValue("finition","Verni satiné");
            $object->setValue("pimonly_name_suffixe",$object->getChoixString()." "."vernis satiné");
           // $parent->save();
         }


        
    }




    
    //$object->setValue('origine_bois','France');
   // $object->setValue('country_of_manufacture','Belgique');

    /*if($object->getEpaisseur()==16) {
         $object->setEpaisseurUsure('4.5 mm');
         $object->setChanfreins('0 ou 2');
        $object->setValue('longueur_txt','Longueurs panachées de 800 à 2500 mm (70% > 1500mm)');

        $save=true;
    }
    else if($object->getEpaisseur()==19) {
        $object->setEpaisseurUsure('5.5 mm');
        $object->setChanfreins('2');
        $save=true;
    }
    else if($object->getEpaisseur()==22) {
        $object->setEpaisseurUsure('7 mm');
        $object->setChanfreins('0 ou 2');
        $object->setValue('longueur_txt','Longueurs panachées de 800 à 2500 mm (70% > 1500mm)');
        $save=true;
    }
   */

    if(strlen($object->getEan())>0) {
       

        /* $parent = $object->getParent();
        //On force le titre si plusiqueurs matieres
        if(stristr($parent->getChoixString()," ou ")) {
            $object->setValue("pimonly_name_suffixe",$object->getChoixString()." "."support ".strtoupper($object->getSupport('cp'))." ".$object->pimonly_dimensions);
            $parent->setValue('pimonly_name_suffixe',null);

        }  
        else {
            $object->setValue("pimonly_name_suffixe","support ".strtoupper($object->getSupport('cp'))." ".$object->pimonly_dimensions);
            $parent->setValue('pimonly_name_suffixe',$parent->getChoixString());
        }*/

        
        $save=true;

       
        if(strlen($parent->name)>0) {
            $parent->setValue('name',null);
            
        } 
        $parent->save();
        

        echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        
    }
    else {
        echo "\nArticle:".$object->getCode()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    }
   // continue;

   
    if($save)
        $object->save();


    continue;
    $values = array();
    $objectToSave = Object::getById($object->getId());
    foreach ($fieldsToClean as $key => $fieldName) {
        # code...
        
        

        $value = $object->getValueForFieldName($fieldName);
        if(!($object->getParent() instanceof Website_Product)) {
            $parentValue = $object->getParent()->getParent()->getValueForFieldName($fieldName);
         
        }
        else {
            $parentValue = $object->getParent()->getValueForFieldName($fieldName);
        }

        

        if(($value == $parentValue || $value=="Terrasses en bois par La Parqueterie Nouvelle") && strlen($value)>0 ) {
            echo "--> nullify $fieldName : ".$object->getSku()."  -----    $value <-> $parentValue\n";
            
            
            $values[$fieldName]=null;
            


            //$objectToSave->setPublished(true);
            
        }
   
    }

    if(count( $values)>0) {
        $objectToSave->setValues($values);
        //print_r($values);

        echo "\n";
        $objectToSave->save();
    }
    
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>