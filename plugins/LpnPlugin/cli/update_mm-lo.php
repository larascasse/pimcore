<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/01massif/tmp/mm-ad

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
    "o_path LIKE '/catalogue/_product_base__/01massif/tmp/mm-lo%'",
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
    $article = $object->getCode();
    $parent = $object->getParent();
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
    $isIpe = $object->getEssence()=="IPE";


    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    echo "\n$article ?";

    switch ($epaisseur) {
         case 19:
         case 22:
            
        
            $object->setEpaisseurUsure('9 mm');
            $object->setPose(array('aclouer','acoller'));

            break;

        case 14:
        case 15:
            
        
            $object->setEpaisseurUsure('6 mm');
            $object->setPose(array('acoller'));

            break;


        case 17 :
            
            $object->setEpaisseurUsure('7 mm');
            $object->setPose(array('acoller'));

            break;

         
        
        default:
            # code...
            break;
    }

    

    $suffixeEan = "";
    $longueur_txt = "";
    
    //BRUT
    if($isBrut) {
        
        $suffixeEan .= $object->getEpaisseur()."x".$object->getlargeur();

        if($epaisseur == 14) {

            switch ($object->getLargeur()) {
                case '90':
                    $longueur_txt = 'Longueurs panachées de 350 à 1200 mm';
                    $suffixeEan .= 'x350-1200';
                    break;

                //IPE
                case '120':
                    
                    if ($isIpe) {
                        $longueur_txt = '1200 mm';
                        $suffixeEan .= '1200';
                    }

                    //Merbau
                    else {
                        $longueur_txt = 'Longueurs panachées de 600 à 1800 mm';
                        $suffixeEan .= 'x600-1800';
                    }
                 
                    break;

                //MERBAU
                case '140':
                    $longueur_txt = 'Longueurs panachées de 600 à 2200 mm';
                    $suffixeEan .= 'x600-2200';
                    break;
               
            }

        }

        else  if($epaisseur == 15) {

            switch ($object->getLargeur()) {
                //PALISSANDRE, AFRORMOSIA
                case '120':
                    $longueur_txt = 'Longueurs panachées de 450 à 1200 mm';
                    $suffixeEan .= 'x450-1200';
                    break;
                   
                //IPE
                case '125':
                    $longueur_txt = 'Longueurs panachées de 400 à 1600 mm';
                    $suffixeEan .= 'x400-1600';
                    break;
                   
            }

        }


        //EURCALYPTUS
        else  if($epaisseur == 17) {

            switch ($object->getLargeur()) {
                
                case '75':
                    $longueur_txt = 'Longueurs panachées de 500 à 2400 mm';
                    $suffixeEan .= 'x500-2400';
                    break;
                   
            }

        }


        else if($epaisseur == 19) {
           
            switch ($object->getLargeur()) {
                
                case '90':
                case '100':
                case '110':
                case '120':
                case '140':
                    
                    $longueur_txt = 'Longueurs panachées de 500 à 2400 mm';
                    $suffixeEan .= 'x500-2400';
                    break;
                   
                //IPE
                case '130':

                    if($isIpe) {
                        $longueur_txt = 'Longueurs panachées de 400 à 1600 mm';
                        $suffixeEan .= 'x400-1600';
                    }
                    else {
                        $longueur_txt = 'Longueurs panachées de 500 à 2400 mm';
                        $suffixeEan .= 'x500-2400';
                    }
                    
                    break;

                   
                }

        }


        //MERBAU
        else  if($epaisseur == 20) {

            switch ($object->getLargeur()) {
                
                //MERBAU
                case '120':
                    $longueur_txt = 'Longueurs panachées de 600 à 2200 mm';
                    $suffixeEan .= 'x600-2200';
                    break;
                case '140':
                case '190':
                    $longueur_txt = 'Longueurs panachées de 1000 à 1800 mm';
                    $suffixeEan .= 'x1000-1800';
                    break;
                   
            }

        }


        //EURCALYPTUS / MERISIER
        else  if($epaisseur == 21) {

            switch ($object->getLargeur()) {
                
                /// MERISIER
                case '80':
                    $longueur_txt = 'Longueurs panachées de 500 à 2400 mm';
                    $suffixeEan .= 'x500-2400';
                    break;

                case '95':
                    $longueur_txt = 'Longueurs panachées de 800 à 2500 mm';
                    $suffixeEan .= 'x800-2500';
                    break;

                   
            }

        }

        //WENGE
        else  if($epaisseur == 22) {
            switch ($object->getLargeur()) {


                case '180':
                    
                    $longueur_txt = 'Longueurs panachées de 1900 à 2500 mm';
                    $suffixeEan .= 'x1900-2500';
                    break;
                   
            } 

        }
        
            
    }


    //FINIS
    else {

        $suffixeEan .= $object->getEpaisseur()."x".$object->getlargeur();
        
        if($epaisseur == 14) {
            switch ($object->getLargeur()) {
             case '90':
                $longueur_txt = 'Longueurs panachées de 350 à 1200 mm';
                $suffixeEan .= 'x350-1200';
                break;
               
            }

        }

        else  if($epaisseur == 15) {
            switch ($object->getLargeur()) {


               //IPE
                case '125':
                    $longueur_txt = 'Longueurs panachées de 400 à 1600 mm';
                    $suffixeEan .= 'x400-1600';
                break;
                   
                
            }
        }

        else if($epaisseur == 19) {
           
            switch ($object->getLargeur()) {

                //NOYER? MERISIER? MERBAU
                case '90':
                case '100':
                case '115':
                case '110':
                case '120':
                case '135':
        
                case '140':
                    
                    $longueur_txt = 'Longueurs panachées de 500 à 2400 mm';
                    $suffixeEan .= 'x500-2400';
                    break;
                   
      
                case '130':

                    if($isIpe) {
                        $longueur_txt = 'Longueurs panachées de 400 à 1600 mm';
                        $suffixeEan .= 'x400-1600';
                    }
                    else {
                         $longueur_txt = 'Longueurs panachées de 500 à 2400 mm';
                        $suffixeEan .= 'x500-2400';
                    }
                    
                    break;
                   
            }

        }

    }

    
    if($isPointDeHongrie) {

        $suffixeEan = $object->getEpaisseur().'x'.$object->getLargeur()."x".$object->getLongueur()." 45°";
    } 

    else if($isbatonRompu) {

        $suffixeEan = $object->getEpaisseur().'x'.$object->getLargeur()."x".$object->getLongueur();
    }

    $object->setValue('longueur_txt',$longueur_txt); 
    $object->setValue("pimonly_name_suffixe",$suffixeEan);


    //SURFACE
    $parentSuffixeEan = $object->getChoixString();

    if(stristr($article, "MHCHE") && !$isBrut) {
        $parent->setMotif('pth');
        $parent->setAngle('45°');
        $parentSuffixeEan .=" Point de Hongrie";
        $parent->setValue('longueur_txt','Longueur pointe à pointe '."600"." mm");



    }
    elseif(stristr($article, "MBCHE") && !$isBrut) {
        $parent->setMotif('baton rompu');
        $parentSuffixeEan .=" Bâton rompu";
    }


     //TODO
    if(stristr($scienergie, "TRES ACCENTU")) {
        
        $parent->setValue('traitement_surface',"vieilli tres accentue");
        $parentSuffixeEan .= " vieilli très accentué";
        $object->setValue('chanfreins','rives abîmées'); 
        //$object->setChoix('ELV');
    }
    else if( (stristr($article, "MMIPERA") || stristr($article, "MBCHERA") || stristr($article, "MHCHERA")) && !$isBrut) {

        $parent->setTraitement_surface(("vieilli rives abimees"));
        $parentSuffixeEan .= " vieilli rives abîmées";
        $parent->setValue('chanfreins','rives abîmées');
        //$object->setChoix('ELV');
  
    }
    
    if(stristr($article, "G2")) {
        $parent->setValue('chanfreins','2');
        $parentSuffixeEan .= " G02";

    }
    elseif(stristr($article, "G4")) {
        $parent->setValue('chanfreins','4');
        $parentSuffixeEan .= " G04";

    }
    elseif(stristr($article, "G0")) {
        $parent->setValue('chanfreins','0');
        $parentSuffixeEan .= " G0";

    }
    


    //HUILE
    if(stripos($scienergie, "PP") >0) {
         $parent->setValue('finition',"");
    }
    if(stristr($scienergie, "HUILE AQUA")) {
        $parent->setValue('finition',"huile-aqua");
        $parentSuffixeEan .= " huile aqua";
    }
    else if(stristr($scienergie, "HUILE CIRE")) {
        $parent->setValue('finition',"huile-cire");
        $parentSuffixeEan .= " huile cire";      
    }
    else if(stristr($scienergie, "HUILE")) {
        $parent->setValue('finition',"huile");
        $parentSuffixeEan .= " huilé";      
    }
    else if(stristr($scienergie, "satine")) {
        $parent->setValue('finition',"Verni satiné");
        $parentSuffixeEan .= " vernis satiné";      
    }
    else if(stristr($scienergie, " brut")) {
        //$parent->setValue('finition',"Verni satiné");
        $parentSuffixeEan .= " Brut";      
    }


    $parent->setValue("pimonly_name_suffixe",trim($parentSuffixeEan));


    $object->setSolRaffraichissant("0");
    $object->setChauffantBasseTemperature("0");
    $object->setChauffantRadiantElectrique("0"); 

    //if($object->getChauffantBasseTemperature()==0) {
       /* if(stripos($object->getCalculatedChauffantBasseTemperature(),"oui") === 0) {
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
         */ 


    
    //$parent->setValue('pimonly_name_suffixe',$parent->getChoixString());

       
    
      
        
    

    
    
    $parent->setValue('name',null);
    $parent->save();

    $object->setPublished(true);
    $object->save();

    echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>