<?php

//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp/cc-zp
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
       o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-zp%'

    ");


$list = new Pimcore\Model\Object\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));
//$list->setOrder("ASC");
//$list->setOrderKey("o_id");


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
    $code = $article = $object->code;
    $ean  = $object->ean;
    $parent = $object->getParent();

    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    /*if(stristr($scienergieCourt, "hd")) {
        $object->setSupport('HDF');
         $save=true;
    }
    else if(stristr($scienergieCourt, "cp")) {*/
        //$object->setSupport('cp');
        $save=true;
    //}

   

    //Usée brosssé
    /*
    Brossé,brosse
Brossé accentué, brosse accentue
Brut,brut
Brut de sciage, brut de sciage
Vieilli rives abimées, vieilli rives abimees
Usé,use
*/
    echo "\n$article ?";

    $save = true;
    //epaisseur

    if(strlen($object->getEan())>0) {
        $object->setFixation(array('rainurelanguette4cotes'));

        $longueur_txt = "";

        $object->setChauffantBasseTemperature("1");
        $object->setSolRaffraichissant("0");
        $object->setChauffantRadiantElectrique("1");

        $isMotif = stristr($code,"xzp")  || stristr($code,"zzp");



        switch ($object->getEpaisseur()) {
            case '12':
                $object->setValue('support','cp');
                if($object->getLargeur() == 160) {

                }
                $object->setEpaisseurUsure('3.2 mm');
                if(!$isMotif)
                 $longueur_txt = "Longueurs variables de 1100 à 2200 mm, présence de demi-lames de début";
               // $object->setValue('longueur_txt',"Longueurs variables de 1100 à 2200 mm, présence de demi-lames de début");
                 break;

            case '14':
                $object->setValue('support','Latté');
                $object->setEpaisseurUsure('3.6 mm');
                if($object->getLargeur()==71) {
                    $object->setFixation(array('rainurelanguette-2cotes-fausses-languettes'));
                }
                break;
            case '15':
                $object->setValue('support','Latté');
                //$object->setPimonly_resistance_thermique(0.119);
                $object->setEpaisseurUsure('4 mm');

                if(!$isMotif)
                    $object->setValue('longueur_txt',"Longueurs variables de 1100 à 2200 mm");

                if($object->getLargeur()==92) {
                    $object->setFixation(array('rainurelanguette-2cotes-fausses-languettes'));
                }
                break;
            case '21':
                $object->setValue('support','cp peuplier');
                $object->setEpaisseurUsure('6 mm');
                break;

            //INDUS
            case '19':
                $longueur_txt = "Longueurs variables de 400 à 2500 mm";
                break;
            default:
                # code...
                break;
        }

        /*if(strlen($longueur_txt)==0 && $object->getLongueur()==1860) {
             $longueur_txt =  "Longueur : 1860 mm, présence de demi-lames de début";
        }
        */
        //if(strlen($longueur_txt)>0) {
             $object->setValue('longueur_txt',$longueur_txt);
        //}


        $suffixe = "";
        if(stristr($scienergie, "HUILE AQUA")) {
            $parent->setValue('finition',"huile-aqua");
            $suffixe.= "huile aqua";
        }
        if(stristr($scienergie, "VERNIS AQUA") && !stristr($code,"xzp")  && !stristr($code,"zzp")) {
            $parent->setValue('finition',"Verni aqua");
             $suffixe.= "vernis aqua";

        }
        else if(stristr($scienergie, "HUILE CIRE") && !stristr($code,"xzp")  && !stristr($code,"zzp")) {
            $parent->setValue('finition',"huile-cire");
             $suffixe.= "huile cire";
        }


        //MULTI
        if(stristr($code,"xzp")  || stristr($code,"zzp")) {
            echo "MULTI";
            if(stripos($ean,"614")===0 || stripos($ean,"214")===0) {
                $suffixe.= "huile cire ou vernis aqua";
                $parent->setValue('finition',"huile-cire-ou-vernis-aqua");
                
            }
            else {
                $parent->setValue('finition',"huile-cire");

                $suffixe.= "huile cire";
            }
        }

        //melange de choix dans Scienergie.. on passe par l'EAN
        //$suffixe.=" ".$object->getChoixString();
        
        $parent->setValue('pimonly_name_suffixe',trim($suffixe));
        //echo "\n set suffixe ".trim($suffixe)."\n";
       

        if(stristr($scienergie, "SCRAPPE")) {
            //$parent->setValue('traitement_surface',"rives scrapees");
            //$parent->setValue('pimonly_name_suffixe',"huile cire");

        }

         if(stristr($object->getEan(), "614401")) {
            $object->setValue('largeur_txt',"Largeurs panachées 71/148/182 mm");
            $object->setValue("pimonly_name_suffixe",$object->getChoixString()." "."Ep. ".$object->getEpaisseur().", larg. 71/148/182, long.".$object->getLongueur());
        } 
        else if(stristr($object->getEan(), "215429")) {
            $object->setValue('largeur_txt',"Largeurs panachées 92/148/189 mm");
             $object->setValue("pimonly_name_suffixe",$object->getChoixString()." "."Ep. ".$object->getEpaisseur().", larg. 92/148/189, long.".$object->getLongueur());
        }
        else if(stristr($object->getEan(), "21557")) {
            $object->setValue('largeur_txt',"Largeurs panachées 148/189/240 mm");
             $object->setValue("pimonly_name_suffixe",$object->getChoixString()." "."Ep. ".$object->getEpaisseur().", larg. 148/189/240, long.".$object->getLongueur());
        }
         else if(stristr($object->getEan(), "6193302500756")) {
          
             $object->setValue("pimonly_name_suffixe",$object->getChoixString()." "."Ep. ".$object->getEpaisseur().", long. 400 à 2500 mm");
        }
        
        else {
            $object->setValue("pimonly_name_suffixe",$object->getChoixString()." ".$object->pimonly_dimensions);
        }

        if($object->getLongueur() == 1860) {
            $object->setValue('longueur_txt',"Longueur: ".$object->getLongueur()." mm, présence de demi-lames de début");
            //$object->setValue("pimonly_name_suffixe",$object->pimonly_dimensions);
        }

    }





   
    //CONTEMPORAIN
    if(stristr($article, "FMCHEG2")) {
       
         
         $save=true;
    }

    

    


    
   

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

       
        if(strlen($parent->name)>0 && !stristr($code,"zzp")  && !stristr($code,"xzp")) {
            $parent->setValue('name',null);
            
        } 
        $parent->setValue('chanfreins',"2 ou rives abîmées");
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