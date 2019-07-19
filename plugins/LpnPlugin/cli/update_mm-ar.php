<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/01massif/tmp/mm-ar/mm-ar-finis

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
    "o_path LIKE '/catalogue/_product_base__/01massif/tmp/mm-ar/mm-ar-finis%'",
    "ean IS NOT NULL"
);


$list = new Pimcore\Model\Object\Product\Listing();
$list->setUnpublished(true);
$list->setCondition(implode(" AND ", $conditionFilters));
//$list->setOrder("ASC");
//$list->setOrderKey("o_id");

$list->setOrder("DESC");
$list->setOrderKey("code");


$list->load();

$objects = array();
 echo "objects in list ".count($list->getObjects())."\n";
//Logger::debug("objects in list:" . count($list->getObjects()));

 $previousParent = null;

$listObject = $list->getObjects();
$total = count($listObject);
$idx=0;
foreach ($listObject as $object) {
    $idx++;

    //echo "update ".$object->getName()."\n";
    //COPIE DE SCIERGNER COURT
    //$value  = ucfirst(strtolower($object->getValueForFieldName('name_scienergie_court')));
    $parent = $object->getParent();
    if(!($object instanceof Object_Product))
        continue;

    if(isset($previousParent) && $previousParent->getId() == $parent->getId()) {
        $sameParentAsPrevious = true;
    }
    else {
         $sameParentAsPrevious = false;
    }
    $previousParent = $parent;

    $scienergieCourt = $object->name_scienergie_court;
    $scienergie = $object->getName_scienergie();
    $code = $article  = $object->getCode();
    $famille = $object->getFamille();
    $equivalence = $object->getPimonly_equivalence_auto();
    
    $inheritance = Object_Abstract::doGetInheritedValues(); 
    Object_Abstract::setGetInheritedValues(false); 


    
    $ean  = $object->ean;
    
    $famille = $object->getFamille();
    $epaisseur = $object->getEpaisseur();
    $largeur = $object->getLargeur();
    $longueur = $object->getLongueur();
    $qualite = $object->getQualite();
    

    $isPointDeHongrie = stripos($article, "MHCHE") === 0;
    $isbatonRompu = stripos($article, "MBCHE") === 0;

    $isThermo = stripos($scienergie, "THERMO")>0;
    $isBrut = $object->isParquetBrut() && !$isThermo ;
    $isChene = $object->getEssence()=="CHE";
    $isDalle = stripos($scienergie, "VERSAILLES")>0;;


    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    echo "\n$article ?";

    switch ($epaisseur) {
         case 20:
         case 22:
            
        
            $object->setEpaisseurUsure('7 mm');
            $object->setPose(array('aclouer','acoller'));

            break;

        case 15:
            
        
            $object->setEpaisseurUsure('7 mm');
            $object->setPose(array('acoller'));

            break;

         
        
        default:
            # code...
            break;
    }

    

    $suffixeEan = "";
    $longueur_txt = "";


    
    if($isBrut) {

        $longueur_txt = 'Longueurs panachées de 400 à 2000 mm';
        $suffixeEan = $object->getEpaisseur()."x".$object->getLargeur();
        $suffixeEan.="x400-2000";
          
    }
    else if(!$isPointDeHongrie && !$isbatonRompu) {

        $suffixeEan .= $object->getEpaisseur();

        //USEZ DEFORME
        if(stristr($equivalence, "bohème")) {
             $parent->setValue('epaisseur_txt','');
             $object->setValue('epaisseur_txt','');
             $object->setValue('largeur_txt','');

             $longueur_txt = 'Longueurs panachées de 500 à 1500 mm';
             $suffixeEan .= 'x500-1500';

        }

        //USEZ DEFORME
        elseif(stristr($scienergie, "DEFORME")) {
            $suffixeEan = '20-23';
            $parent->setValue('epaisseur_txt','');
            $object->setValue('epaisseur_txt','Epaisseur variable de 20 à 23 mm');

            if(stristr($scienergie, "INTENSE")) {

                switch ($largeur) {
                    case 340:
                        $object->setValue('largeur_txt','Largeurs panachées : 140/180/220 mm');
                        $suffixeEan .= 'x140-220';

                        $longueur_txt = 'Longueurs panachées de 1800 à 2700 mm';
                        $suffixeEan .= 'x1800-2700';


                        break;
                    
                    case 760:
                        $object->setValue('largeur_txt','Largeurs panachées 220/260/300 mm');
                        $suffixeEan .= 'x220-300';

                        $longueur_txt = 'Longueurs panachées de 1800 à 3000 mm';
                        $suffixeEan .= 'x1800-3000';

                        break;
                }
                

            }
            //Wax/Sonar
            else {
                $object->setValue('largeur_txt','Largeurs panachées : 140/180/220 mm');
                $suffixeEan .= 'x140-220';

                $longueur_txt = 'Longueurs panachées de 1800 à 2700 mm';
                $suffixeEan .= 'x1800-2700';
            }
        }

        //USEE BROSS2
        else if(stristr($article, "MMCHEUB")) {

             $suffixeEan = '20-23';
            $parent->setValue('epaisseur_txt','');
            $object->setValue('epaisseur_txt','Epaisseur variable de 20 à 23 mm');


             if(stripos($scienergieCourt, 'xl')) {
                $object->setValue('largeur_txt','Largeurs panachées 220/260/300 mm');
                $suffixeEan .= 'x220-300';
                
                $longueur_txt = 'Longueurs panachées de 2000 à 3000 mm';
                $suffixeEan .= 'x2000-3000';
             }
             else {
                $object->setValue('largeur_txt','Largeurs panachées 140/180/220 mm');
                $suffixeEan .= 'x140-220';
                
                $longueur_txt = 'Longueurs panachées de 1800 à 2700 mm';
                $suffixeEan .= 'x1800-2700';
             }

        }

        else {
            switch ($epaisseur) {
                case '15':
                    $object->setValue('largeur_txt','Largeurs panachées : 120/140/160/180/200 mm');
                    $suffixeEan .= 'x120-200';
                    
                    $longueur_txt = 'Longueurs panachées de 1800 à 2700 mm';
                    $suffixeEan .= 'x1800-2700';

                    break;

                case '20':
                   
                    $object->setValue('largeur_txt','Largeurs panachées : 140/180/220 mm');
                    $suffixeEan .= 'x140-220';

                    $longueur_txt = 'Longueurs panachées de 1800 à 2700 mm';
                    $suffixeEan .= 'x1800-2700';

                    break;
          
            }

        }

        
        
       

        if($isDalle) {
            switch ($object->getLargeur()) {
                case '700':
                     $object->setValue('largeur_txt','');
                     $suffixeEan = $object->getEpaisseur().'x700x700';
                break;

                case '1020':
                     $object->setValue('largeur_txt','');
                     $suffixeEan = $object->getEpaisseur().'x1020x1020';
                break;
            }

            
        }
       


    }

    else if($isPointDeHongrie) {

        $suffixeEan .= $object->getEpaisseur().'x'.$object->getLargeur()."x".$object->getLongueur()." 45°";
    } 

    else if($isbatonRompu) {

        $suffixeEan .= $object->getEpaisseur().'x'.$object->getLargeur()."x".$object->getLongueur();
    }

    
     $object->setEpaisseurUsure('7 mm');


    //SURFACE
    $parentSuffixeEan = "";



    if($isDalle) {
        $parent->setTraitement_surface(("vieilli"));
        //$parentSuffixeEan .= " rives abîmées";
        $parent->setValue('chanfreins','rives abîmées');
        $parent->setMotif('dalle-versaille');
        $parent->setTypeLame('dalle');
        $parent->setValue('fixation',['double-rainure']);

        //gere le conos
        $parent->setValue('finition','prepatine');

        //SONAR
        if(stristr($scienergie, "SONAR")) {
            $parent->setValue('finition','pre-huile');
            $parent->setTraitement_surface(("vieilli-use-deforme"));
        }

    }

    //USEE BROSS2
    else if(stristr($article, "MMCHEUB")) {
         $parent->setTraitement_surface('use-brosse');
         $parentSuffixeEan .="usé brossé";

         $parent->setValue('fixation',['rainurelanguette-2cotes-fausses-languettes']);
         $object->setValue('chanfreins','rives abîmées'); 


    }
    else if(stristr($article, "MHCHE") && !$isBrut) {
        $parent->setMotif('pth');
        $parent->setAngle('45°');
        $parentSuffixeEan .=" Point de Hongrie";
        $parent->setValue('');
        $longueur_txt = 'Longueur pointe à pointe : '."650"." mm";
        $parent->setValue('fixation',['rainurelanguette']);
    }

    elseif(stristr($article, "MBCHE") && !$isBrut) {
        $parent->setMotif('baton rompu');
        $parentSuffixeEan .=" Bâton rompu";
        $parent->setValue('fixation',['rainurelanguette']);
    }


     //TODO
    if(stristr($scienergie, "TRES ACCENTU")) {
        
        $parent->setValue('traitement_surface',"vieilli tres accentue");
        $parentSuffixeEan .= " vieilli très accentué";
        $object->setValue('chanfreins','rives abîmées'); 
    }
    
    else if( (stristr($article, "MMCHERA") || stristr($article, "MBCHERA") || stristr($article, "MHCHERA")) && !$isBrut) {
        //vieilli-use-deforme


        if(stristr($scienergie, "DEFORME")) {

            if(stristr($scienergie, "INTENSE")) {
                $object->setTraitement_surface(("use-deforme-brosse-intense"));
                $parentSuffixeEan .= " brossé intense usé déformé";

            }
            else {
                $object->setTraitement_surface(("vieilli-use-deforme"));
                $parentSuffixeEan .= " vieilli usé déformé";
            }
            $parent->setValue('chanfreins','rives abîmées'); 
        }
        else {
            $parent->setTraitement_surface(("vieilli"));
            $parentSuffixeEan .= " vieilli";
            $parent->setValue('chanfreins','rives abîmées'); 
        }

    }

    elseif(stristr($article, "MMCHEG2") && !$isBrut) {
        $parent->setValue('chanfreins','2');

    }

    if(stristr($article, "MDCHEPP") && !$isBrut) {
        $parent->setValue('chanfreins','rives abîmées'); 

    }

    $object->setValue('longueur_txt',$longueur_txt); 
    $object->setValue("pimonly_name_suffixe",$suffixeEan);
    


    //HUILE
    if(stripos($scienergie, "PP") >0) {
         $parent->setValue('finition',"brut");
    }
    if(stristr($scienergie, "PRE HUILE AQUA")) {
        $parent->setValue('finition',"pre-huile-aqua");
        $parentSuffixeEan .= " pré-huilé aqua";
    } 
    else if(stristr($scienergie, "HUILE AQUA")) {
        $parent->setValue('finition',"huile-aqua");
        $parentSuffixeEan .= " huile aqua";
    }
    else if(stristr($scienergie, "PRE HUIL")) {
        $parent->setValue('finition',"pre-huile");
        $parentSuffixeEan .= " pré-huilé";
    }
    else if(stristr($scienergie, "HUILE CIRE") ) {
        $parent->setValue('finition',"huile-cire");
        $parentSuffixeEan .= " huile cire";      
    }


    $parent->setValue("pimonly_name_suffixe",trim($parentSuffixeEan));



    //if($object->getChauffantBasseTemperature()==0) {
        if(stripos($object->getCalculatedChauffantBasseTemperature(),"oui") === 0) {
            $object->setChauffantBasseTemperature("1");
        }
        else {
            $object->setChauffantBasseTemperature("0");
        }

        if(stripos($object->getCalculatedSolRaffraichissant(),"oui") === 0) {
            $object->setSolRaffraichissant("1");
            
        }
        else {
            $object->setSolRaffraichissant("0");
        }

        if(stripos($object->getCalculatedChauffantRadiantElectrique(),"oui") === 0) {
            $object->setChauffantRadiantElectrique("1");   
        }  
        else {
         $object->setChauffantRadiantElectrique("0");   
        }
          


    
    //$parent->setValue('pimonly_name_suffixe',$parent->getChoixString());

       
    
      
        
    

    
    if($isDalle) {
        $parent->setValue('name',str_replace('Parquet chêne massif ','Parquet Versailles en chêne massif ',$parent->getParent()->getName()));
    }
    else {
        //$parent->setValue('name',null);
    }
    
    if(!$sameParentAsPrevious) 
        $parent->save();

    $object->setPublished(true);
    $object->save();

    echo "\nEan ($idx/$total):".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>