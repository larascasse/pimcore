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



$conditionFilters = array(
    "o_path LIKE '/catalogue/_product_base__/05contreco/tmp/cc-zp%'",
    "ean IS NOT NULL"
);


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

$inheritance = Object_Abstract::doGetInheritedValues(); 
Object_Abstract::setGetInheritedValues(false); 


//Logger::debug("objects in list:" . count($list->getObjects()));
$savedParent = array();

foreach ($list->getObjects() as $object) {
    //print_r($savedParent);

    //echo "update ".$object->getName()."\n";
    //COPIE DE SCIERGNER COURT
    //$value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));

    if(!($object instanceof Object_Product))
        continue;
    
  


    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->name_scienergie;
    $code = $article = $object->code;
    $ean  = $object->ean;

       if(!in_array($object->getCode(),$savedParent)) {
             $parent = $object->getParent();

        }
        else {
             $parent = false;
        }
   


   

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

    $save = true;
  
    //epaisseur

    if(strlen($object->getEan())>0) {
        $object->setFixation(array('rainurelanguette'));

        $longueur_txt = "";

        $object->setChauffantBasseTemperature("1");
        $object->setSolRaffraichissant("0");
        $object->setChauffantRadiantElectrique("1");

        

        $isPointDeHongrie = stripos($article, "FHCHE") === 0;
        $isbatonRompu = stripos($article, "FBCHE") === 0;

        $isMotif = stristr($code,"xzp")  || stristr($code,"zzp") || stristr($code,"vzp") || $isPointDeHongrie || $isbatonRompu;

        $isStock = stristr($scienergie, "chanvre") ||stristr($scienergie, "lin") || stristr($scienergie, "chesterfield") || stristr($scienergie, "Terre");

        $longueur = $object->getLongueur();

        switch ($object->getEpaisseur()) {

             case '10':
                $object->setValue('support','Mulitplis');
                if($object->getLargeur() == 160) {

                }
                $object->setEpaisseurUsure('4 mm');
               
               // $object->setValue('longueur_txt',"Longueurs variables de 1100 à 2200 mm, présence de demi-lames de début");
                 break;

             case '11':
                $object->setValue('support','Latté');
                if($object->getLargeur() == 160) {

                }
                $object->setEpaisseurUsure('4 mm');
               
               // $object->setValue('longueur_txt',"Longueurs variables de 1100 à 2200 mm, présence de demi-lames de début");
                 break;

            case '12':
                $object->setValue('support','cp');
                if($object->getLargeur() == 160) {

                }
                $object->setEpaisseurUsure('3.2 mm');
                if(!$isMotif) {

                    $longueur_txt = "Longueurs variables de 1100 à 2200 mm, présence de demi-lames de début";
                    $longueur = "1100-2200";
                }
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

                if($object->getLongueur() == 1860) {
                     $object->setValue('longueur_txt',"");
                    $longueur = "1860";
                }
                else if(!$isMotif) {
                    $object->setValue('longueur_txt',"Longueurs variables de 1100 à 2200 mm");
                    $longueur = "1100-2200";
                }


                if($object->getLargeur()==92) {
                    $object->setFixation(array('rainurelanguette-2cotes-fausses-languettes'));
                }
                break;

              case '16':
                $object->setValue('support','Latté');
                //$object->setPimonly_resistance_thermique(0.119);
                $object->setEpaisseurUsure('5 mm');

                if(!$isMotif) {
                    $object->setValue('longueur_txt',"Longueurs variables de 2000 à 3000 mm");
                    $longueur = "2000-3000";
                }

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


       



      
        if($parent) {

             $parentSuffixeEan = "";


              //MULTI
            if($isbatonRompu || $isPointDeHongrie) {
                echo "MULTI";
                if(stristr($scienergie, "vernis aqua")) {
                     $parent->setValue('finition',"Verni aqua");
                     $parentSuffixeEan.= "vernis aqua";
                }
                else if(stripos($ean,"614")===0 || stripos($ean,"214")===0) {
                    $parentSuffixeEan.= "huile cire ou vernis aqua";
                    $parent->setValue('finition',"huile-cire-ou-vernis-aqua");
                    
                }
                else {
                    $parent->setValue('finition',"huile-cire");

                    $parentSuffixeEan.= "huile cire";
                }
            }
            else {

                 if(stristr($scienergie, "vernis aqua ultra mat")) {
                        $parent->setValue('finition',"Verni aqua ultra mat");
                         $parentSuffixeEan.= "vernis aqua ultra-mat";
                    }
                    else if(stristr($scienergie, "HUILE AQUA")) {
                        $parent->setValue('finition',"huile-aqua");
                        $parentSuffixeEan.= "huile aqua";
                    }
                    else if(stristr($scienergie, "VERNIS AQUA")) {
                        $parent->setValue('finition',"Verni aqua");
                         $parentSuffixeEan.= "vernis aqua";

                    }
                    else if(stristr($scienergie, "HUILE CIRE")) {
                        $parent->setValue('finition',"huile-cire");
                         $parentSuffixeEan.= "huile cire";
                    } 

            }

           
            


             


            //SURFACE
            if($isPointDeHongrie && !$isBrut) {
                $parent->setMotif(' pth');
                $parent->setAngle('45°');
                $parentSuffixeEan .=" Point de Hongrie 45°";
                $parent->setValue('longueur_txt','Longueur pointe à talon '.$longueur." mm");



            }
            elseif($isbatonRompu&& !$isBrut) {
                $parent->setMotif(' baton rompu');
                $parentSuffixeEan .=" Bâton rompu ";
            }

            $parentSuffixeEan .= " ".$object->getChoixString();
        }


        

        //melange de choix dans Scienergie.. on passe par l'EAN
        //$suffixe.=" ".$object->getChoixString();
        
       
        //echo "\n set suffixe ".trim($suffixe)."\n";
       

        if(stristr($scienergie, "SCRAPPE")) {
            //$parent->setValue('traitement_surface',"rives scrapees");
            //$parent->setValue('pimonly_name_suffixe',"huile cire");

        }

        $suffixeEan = "";
         if($isPointDeHongrie) {

            $suffixeEan = $object->getEpaisseur().'x'.$object->getLargeur()."x".$object->getLongueur()." (PàT)";
        } 

        else if($isbatonRompu) {

            $suffixeEan = $object->getEpaisseur().'x'.$object->getLargeur()."x".$object->getLongueur();
        }
        else {

            if(stristr($object->getEan(), "614401") || stristr($object->getEan(), "214401")) {
                $object->setValue('largeur_txt',"Largeurs panachées 71/148/182 mm");
                $suffixeEan .= $object->getEpaisseur()."x71/148/182x".$longueur;
            } 
            else if(stristr($object->getEan(), "215429")) {
                $object->setValue('largeur_txt',"Largeurs panachées 92/148/189 mm");
                $suffixeEan .= $object->getEpaisseur()."x92/148/189x".$longueur;
            }
            else if(stristr($object->getEan(), "21557")) {
                $object->setValue('largeur_txt',"Largeurs panachées 148/189/240 mm");
                
                $suffixeEan .= $object->getEpaisseur()."x148/189/240x".$longueur;
            }
            //148/182/210
            else if(stristr($object->getEan(), "214540") || stristr($object->getEan(), "614540")) {
                $object->setValue('largeur_txt',"Largeurs panachées 148/182/210 mm");
                
                $suffixeEan .= $object->getEpaisseur()."x148/182/210x".$longueur;
            }
             else if(stristr($object->getEan(), "6193302500756")) {
              
                 $suffixeEan .= $object->getEpaisseur()."x400-2500";
            }
            
            else {
                $suffixeEan .= $object->getEpaisseur()."x".$object->getLargeur()."x".$longueur;
            }

            if($object->getLongueur() == 1860) {
                $object->setValue('longueur_txt',"Longueur: ".$object->getLongueur()." mm, présence de demi-lames de début");
                //$object->setValue("pimonly_name_suffixe",$object->pimonly_dimensions);
            }
        }

        
        $object->setValue("pimonly_name_suffixe",trim($suffixeEan));

       

        if($isStock) {
            $object->setValue('chanfreins',"2");
        }
        else if ($object->getChoix() == 'ELC') {
            $object->setValue('chanfreins',"2 ou rives abîmées ou en U");
        }
        else {
            $object->setValue('chanfreins',"2 ou rives abîmées");
        }

        if($parent) {
           if(strlen($parent->name)>0 && !$isMotif) {
                $parent->setValue('name',null);
                
            } 

            $parent->setValue('pimonly_name_suffixe',trim($parentSuffixeEan));

           $parent->setValue('chanfreins',"");

            echo "save ".$parent->getCode()."\n";
            $savedParent[] = $parent->getCode();
            $parent->save();
        }
       

        $object->save();
        

        echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
        
    }
    else {
        echo "\nArticle:".$object->getCode()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    }
   // continue;

   
    

    

    

}
Object_Abstract::setGetInheritedValues($inheritance); 
\Pimcore\Model\Version::enable();
?>