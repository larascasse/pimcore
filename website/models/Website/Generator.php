<?php
namespace Website;
 
use Pimcore\Model\Object\Concrete;
 
class Generator
{
    /**
     * @param $object Concrete
     * @param $context \Pimcore\Model\Object\Data\CalculatedValue
     * @return string
     */
    public static function compute($object, $context) {
        $product = $object;
     

        if ($context->getFieldname() == "classe_utilisation") {
           return $product->getClasseUtilisation();

        }

/*
LA DURETÉ DE BRINELL :

Il est primordial de bien connaître la dureté du bois qui compose votre parquet. Cette donnée vous permettra de choisir celui-ci en fonction de l'environnement de la pièce à parqueter.

La dureté Brinell se calcule en mesurant de la profondeur de l’empreinte laissée dans le bois par une bille en matériau dur (en général de l'acier). Plus le nombre est élevé plus le bois est résistant et dur.

DURETÉ DES PRINCIPALES ESSENCES DE PARQUET (DURETÉ DE BRINELL) :

Sapin : 1.5
Pin : 2.0
Châtaignier : 2.3
Merisier : 3.0
Chêne : 3.4
Frêne : 3.5
Iroko : 3.5
Teck : 3.5
Afrormosia : 3.7
Padouk : 3.8
Doussié : 4.0
Angélique : 4.0
Moabi - Kempas : 4.0
Mutenye : 4.0
Merbau : 4.1
Wengé : 4.2
Jatoba : 4.4
Erable Canadien : 4.8
Ipé - Bata : 5.9 
*/
        elseif ($context->getFieldname() == "durete_brinell") {

            //$language = $context->getPosition();

            $coucheUsure = $object->getEpaisseur();
            return "21 TODO";
        } else {
            \Logger::error("unknown field");
        }
    }
} 

?>