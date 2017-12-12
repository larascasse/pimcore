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
     
        $pimcoreConsole = (defined('PIMCORE_CONSOLE') && true === PIMCORE_CONSOLE) || (defined('LPN_IMPORT') && true === LPN_IMPORT);
        if($pimcoreConsole)
            return;

        if ($context->getFieldname() == "classe_utilisation") {
          
           return $product->getCalculatedClasseUtilisation();

        }
        elseif ($context->getFieldname() == "classe_upec") {
         /*
         Classe d'usage         Classement UPEC
21  U₂P₂
22  U₂sP₂
23  U2sP₃
31  U₃P₂
32  U₃P₃
33  U₃₅P₃

-   U : usage. Ce critère détermine la résistance à l’usure du parquet due au piétinement et à la marche. L’indice U va de 2 à 4 selon son usage. Il est de 2 pour les locaux privatifs à trafic normal, 2S lorsque le trafic est important, 3 pour les locaux collectifs à trafic normal et 4 pour un fort trafic.

-   P : poinçonnement par le mobilier statique ou mobile, mais aussi par la chute d’objets. Ses indices 2, 3 et 4 correspondent respectivement aux locaux à mobilier mobile en usage normal, aux locaux sans restriction de trafic ni de mobilier et aux locaux soumis à différents types de charges fixes ou mobiles.

-   E : la tenue à l’eau. L’indice E va de 1 à 3. L’indice 1 concerne les locaux secs à l’entretien occasionnel humide, le 2 est destiné aux locaux humides et le dernier indice est réservé aux locaux humides en permanence avec entretien à grandes eaux.

-   C : la résistance aux agents chimiques. L’indice de ce critère va de 0 à 3, correspondant respectivement à une utilisation exceptionnelle et fréquente de produits ménagers.

Dans une maison individuelle ou un appartement, il est plus judicieux de choisir un parquet U2sP2E2C1. En effet, il est conseillé de prendre en compte la fréquence de piétinement avec un indice d’usure assez élevé. La salle de bain est à considérer comme une pièce humide, d’où l’indice 2.

Dans le cas de sanitaires publics, il est préférable de choisir un parquet U4P3E3C2. En effet, les exigences prévues pour ce cas sont plus importantes que celles d’une habitation individuelle.


*/
   
           return $product->getClasseUpec(); 

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
        elseif ($context->getFieldname() == "classe_durete") {

            //$language = $context->getPosition();

            $coucheUsure = $object->getEpaisseur();
            return $product->getDurete();
        }


    
        elseif ($context->getFieldname() == "masse_volumique") {

            //$language = $context->getPosition();

           
            return $product->getMasseVolumique();
        }  

        elseif ($context->getFieldname() == "resistance_thermique") {

            //$language = $context->getPosition();

           
            return $product->getResistanceThermique();
        }   
        elseif ($context->getFieldname() == "conductivite_thermique_total") {

            //$language = $context->getPosition();

           
            return $product->getConductiviteThermiqueTotal();
        }   
        elseif ($context->getFieldname() == "degagement_formaldehyde") {

            //$language = $context->getPosition();

           
            return $product->getDegagementFormaldehyde();
        } 
        elseif ($context->getFieldname() == "condition_mise_en_oeuvre") {

            //$language = $context->getPosition();

           
            return $product->getConditionMiseEnOeuvre();
        } 
        elseif ($context->getFieldname() == "classe_reaction_feu_eu") {

            //$language = $context->getPosition();

           
            return $product->getClasseReactionFeuEu();
        }  
        elseif ($context->getFieldname() == "classe_reaction_feu_fr") {

            /*
            Sont classés M3 :

les parquets massifs d’une épaisseur ≥ 6 mm s’ils sont collés ;
les parquets massifs non résineux d’une épaisseur ≥ 14 mm ;
les parquets massifs résineux d’une épaisseur ≥ 18 mm ;
les parquets contrecollés d'une épaisseur ≥ 18 mm.

Sont classés M4 :
Tous les autres parquets.
*/
            return $product->getClasseReactionFeuFr();
        } 
         elseif ($context->getFieldname() == "coefficient_retractabilite") {

            return $product->getCoefficientRetractabilite();
        } 
        elseif ($context->getFieldname() == "durabilite_ecologique") {

            return $product->getDurabiliteEcologique();
        } 


        else {
            \Logger::error("unknown field : ".$context->getFieldname());
        }
    }
} 

?>