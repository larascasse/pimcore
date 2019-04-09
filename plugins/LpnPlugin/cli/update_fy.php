<?php
//http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/01massif/tmp/mm-zp

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
    "o_path LIKE '/catalogue/_product_base__/85vinylsol/01vinyl-rigide-fy%'",
   // "o_path NOT LIKE '/catalogue/_product_base__/85vinylsol/01vinyl-rigide-fy/accessoires-vr-fy%'",
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

    $isPointDeHongrie = stripos($article, "DP") === 0;
    $isbatonRompu = stripos($article, "DB") === 0;

    $isThermo = stripos($scienergie, "THERMO")>0;
    $isBrut = $object->isParquetBrut() && !$isThermo ;
    $isChene = $object->getEssence()=="CHE";


    //echo $scienergieCourt." ".$object->getEan()."\n";

    $save=true;

    echo "\n$article ?";

    //$object->setEpaisseurUsure('0.6 mm');
    //$object->setSupport('HDF');
    //$object->setFixation(array('click'))
    //$object->setPose(array('acoller','flottante'));

    switch ($epaisseur) {
         case 20:
            
        

            break;

         
        
        default:
            # code...
            break;
    }

    

  

   

    $teinteName = "";

    $teinteFlorify = [
        "001" => "Chêne Tinte Parisienne",
        "002" => "Chêne Galettes au Beurre",    
        "003" => "Chêne Withsundays",    
        "004" => "Chêne Laine",    
        "005" => "Chêne Brunette",    
        "006" => "Chêne Blush",    
        "007" => "Chêne Croissant",    
        "008" => "Chêne Alpaca",    
        "009" => "Chêne Granola",    
        "010" => "Chêne Cap Blanc Nez",    
        "011" => "Chêne Chanterelle",    
        "012" => "Chêne Ciel Flamand",    
        "013" => "Chêne Cap Gris Nez",    
        "014" => "Béton Sel de Mer",    
        "015" => "Béton Huître",    
        "016" => "Béton Caviar",    
        "017" => "Chêne Champagne",    
        "018" => "Chêne Cider",    
        "019" => "Chêne Cognac",    
        "021" => "Chêne Cohiba",    
        "022" => "Chêne Black Beauty",    
        "050" => "Chêne Crémant",    
        "051" => "Chêne Coconut",    
        "052" => "Chêne Husky",    
        "053" => "Chêne Stonehenge",    
        "054" => "Chêne Truffle",    
        "055" => "Chêne Apple Crumble",    
        "023" => "Verona",    
        "024" => "Terrazzo",
        "100" => "Chêne Seychelles XL",
        "101" => "Chêne Sabayon XL",
        "102" => "Chêne Teddy Bear XL"
    ];

    foreach($teinteFlorify as $code=>$name) {
        if(stristr($scienergieCourt, $code) !== FALSE ) {
            $teinteName = $name;
            break;
        }
    }

    $typeName   = "";
    $isLame     = false;

    if(stristr($article, "adcp")) {
            $typeName = "Profil d'adaptation pour vinyle rigide";
    }
    elseif(stristr($article, "excp")) {
            $typeName = "Profil d'extrémité pour vinyle rigide";
    }
    elseif(stristr($article, "spcp")) {
            $typeName = "Profil Strip à coller pour vinyle rigide";
    }
    
    elseif(stristr($article, "plcp")) {
            $typeName = "Plinthe composite pour vinyle rigide";
    }
    elseif(stristr($article, "trcp")) {
            $typeName = "Profil de transition pour vinyle rigide";
    }
    else {
            $typeName = "Vinyle rigide";
            $isLame = true;
    }

    //Usage
    $usage = "";
    if(stristr($article, "g4com")) {
            $usage = "passage commercial";
    }
    else if(stristr($article, "g4res")) {
            $usage = "passage résidentiel";
    }

    //chanfreins
    $chanfreins = "";
    if(stristr($scienergie, "G4")) {
        $chanfreins = "G4";
        $parent->setValue('chanfreins',4);
    }

    //Option COnfigurable
    if(!$isLame) {
        $object->setValue('configurable_free_1',$teinteName);
    }

    $parentName = str_replace("  ", " ", $typeName. " " . $teinteName ." ".$chanfreins." ".$usage);
    $parentShortName = str_replace("  ", " ", $typeName. " " . $teinteName);

    $parent->setValue("name",$parentName);
    $parent->setValue("short_name",$parentShortName);
   
    $suffixeEan = $object->pimonly_dimensions;;
    $object->setValue("pimonly_name_suffixe",$suffixeEan);



    $object->setValue("characteristics_others","");
    $object->setValue("characteristics_others_tech","");
    $object->setValue("characteristics_others_tech","");
    $object->setValue("country_of_manufacture","");
    $object->setValue("subtype","");
    $object->setValue("essence","VIR");
    $object->setValue("short_description","");
    $object->setValue("short_description_title","");
    $object->setValue("description","");
    $object->setValue("extra_content1","");
    $object->setValue("lesplus","");
    $object->setValue("remarque","");


    $parent->setValue("characteristics_others","");
    $parent->setValue("characteristics_others_tech","");
    $parent->setValue("characteristics_others_tech","");
    $parent->setValue("country_of_manufacture","");
    $parent->setValue("subtype","");
    $parent->setValue("subtype2","");
    $parent->setValue("essence","VIR");
    $parent->setValue("short_description","");
    $parent->setValue("short_description_title","");
    $parent->setValue("description","");
    $parent->setValue("extra_content1","");
    $parent->setValue("lesplus","");
    $parent->setValue("remarque","");



    $parent->save();


    $object->setPublished(true);
    $object->save();

    echo "\nEan:".$object->getEan()." - ".$object->getMage_name(). ' - https://pim.laparqueterienouvelle.fr'.$object->getPreviewUrl();
    

    Object_Abstract::setGetInheritedValues($inheritance); 

}
\Pimcore\Model\Version::enable();
?>