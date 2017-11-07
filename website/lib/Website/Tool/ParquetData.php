<?php

namespace Website\Tool;



//PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/urldef.php';
//require_once PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/LPNEntities.php';
//require_once PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/functions.php';


//\Website\Tool\ParquetData::getMasseVolumiqueByEssence(self::getImages());;
class ParquetData
{
    

    public static function isFeuillu($essence) {

      $feuillusArray = [
        'AUL','BOU','CER','CHA','CHAT','CHE','ERA','FRE','HET','MER','NOY','ORM','PEU','TIL'
      ];
     
     return in_array($essence, $feuillusArray);
   }



    /* http://biomee.canalblog.com/archives/2008/01/25/7698209.html */
    public static function getMasseVolumiqueByEssence($essence) {
     
     switch ($essence) {
        case 'CHE':
        case 'FRE':
          return 680;
          break;

        case 'HET':
          return 680;
          break;
          
        case 'EPI':
        case 'SAP':
          return 460;
          break;

        case 'PIN':
          return 450;
          break;

        case 'AUL':
          return 530;
          break;

        case 'CHA':
          return 620;
          break;

        case 'ACA':
          return 660;
          break;

        case 'PEU':
        case 'BOU':
          return 660;
          break;

        case 'MEL':
          return 580;
          break;

        case 'BAM':
          return 680;
          break;

        case 'MER':
          return 830;
          break;

        default:
          # code...
          break;
      }
   }

    public static function getMasseVolumiqueBySupport($support) {
      
      switch ($support) {
          case 'HDF':
            return 820;
            break;

           case 'MDF':
            return 730;
            break;

          case 'cp':
            return 780;
            break;
          
          case 'Latté': //Epicea
            return 500;
            break;

          case 'Multiplis Bouleau': //Epicea
            return 700;
            break;

          case 'Multiplis Epicéa': //Epicea
            return 460;
            break;
          
          default:
            //return $support;
            break;
        }

    }




    public static function getConductiviteThermiqueByEssence($essence) {
      $masseVolumique = self::getMasseVolumiqueByEssence($essence);
       $isFeuillu = self::isFeuillu($essence);
      return self::getConductiviteThermiqueByMasseVolumique($masseVolumique,$isFeuillu);
    }





    public static function getConductiviteThermiqueBySupport($support) {

      $masseVolumique = self::getMasseVolumiqueBySupport($support);
      $isFeuillu = false;

      return self::getConductiviteThermiqueByMasseVolumique($masseVolumique,$isFeuillu);
    

  }


  /*
. Cette correspondance entre masse volumique et capacités isolantes a été établie en termes normatifs, dans le texte NF EN 14342, comme suit :
Conductivité thermique du bois (λ en w / m. K)
ρ = 300 kg/m3 => λ = 0,09
ρ = 500 kg/m3 => λ = 0,13
ρ = 700 kg/m3 => λ = 0,17
ρ = 1000 kg/m3 => λ = 0,24
*/
  public static function getConductiviteThermiqueByMasseVolumique($masseVolumique,$isFeuillu) {
    
    if($isFeuillu) {
        
        if($masseVolumique>1000)
          return 0.29;
        elseif($masseVolumique>850)
          return 0.23;
        elseif($masseVolumique>650)
          return 0.18;
        elseif($masseVolumique>500)
          return 0.15;
        elseif($masseVolumique<=230)
          return 0.13;
    }
    else {

      if($masseVolumique>700)
          return 0.23;
        elseif($masseVolumique>600)
          return 0.18;
        elseif($masseVolumique>500)
          return 0.15;
        elseif($masseVolumique<=500)
          return 0.13;
    }
    
  }

  public static function getUpecByClasseUtilisation($cu,$pieceHumide) {
    $UP = "";
    switch ($cu) {
      case '21':
        # code...
        $UP =  "U₂P₂";
        break;
      case '22':
        # code...
        $UP =  "U₂sP₂";
        break;
      case '23':
        # code...
        $UP =  "U₂sP₃";
        break;
      case '31':
        # code...
        $UP =  "U₃P₂";
        break;
      case '32':
        # code...
        $UP =  "U₃P₃";
        break;
      case '33':
        # code...
        $UP =  "U₃sP₃";
        break;
      
      default:
        # code...
        break;
    }
    if(strlen($UP)>0) {
      
      if($pieceHumide)
        $UP .="E₂C₁";
      else
        $UP .="E₁C₁";
    }

    return $UP;
  }

/*
        http://www.pointp.fr/les-normes-et-classements-du-parquet-sol-stratifie-ou-pvc-XA933
        Les classes d’utilisation qui concernent le parquet sont à prendre en compte pour placer votre parquet dans la pièce adéquate. La norme européenne EN 685 définit des classes d’utilisation pour les revêtements de sol en fonction des zones de pose du revêtement et de l’intensité de l’usage.
    
        Dureté
        Classe A : Aulne, Epicéa, Pin sylvestre, Sapin.
        Classe B : Bouleau, Bossé, Châtaigner, Mélèze, Merisier, Noyer, Pin maritime, Sipo, Teck.
        Classe C : Acacia, Afrormosia, Charme, Chêne, Erable, Eucalyptus, Frêne, Hêtre Iroko, Makoré, Mansonia, Moabi, Movingui, Mutenye, Orme, Padouk, Zébrano.
        Classe D : Amarante, Angélique, Cabreuva, Doussié, Ebène, Ipé, Jatoba, Merbau, Wengé, Palissandre,
*/
  public static function getDureteByEssence($essence) {
    switch ($essence) {

      case 'AUL':
      case 'EPI':
      case 'PIN':
      case 'SAP':
      case 'DGL':
        return "A";
        break;


      case 'BOU':
      case 'BOS':
      case 'CHA':
      case 'MEL':
      case 'MER':
      case 'NOY':
      case 'PIN':
      case 'SIP':
      case 'TEC':
        return "B";
        break;



      case 'CHE':
      case 'ACA':
      case 'AFR':
      case 'CHA':
      case 'ERA':
      case 'EUC':
      case 'FRE':
      case 'HET':
      case 'IRO':
      case 'MAK':
      case 'MAN':
      case 'MOA':
      case 'MOV':
      case 'MUT':
      case 'ORM':
      case 'PAD':
      case 'ZEB':
        return "C";
        break;


      case 'AMA':
      case 'ANG':
      case 'CAB':
      case 'DOU':
      case 'EPE':
      case 'IPE':
      case 'JAT':
      case 'MER':
      case 'WEN':
      case 'PAL':
        return "B";
        break;
      
      default:
        "";
        break;
    }

  }
    
}