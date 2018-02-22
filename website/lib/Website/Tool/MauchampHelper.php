<?php

namespace Website\Tool;

use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use LpnPlugin;


//PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/urldef.php';
//require_once PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/LPNEntities.php';
//require_once PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/functions.php';


//\Website\Tool\MauchampHelper::getAssetArray(self::getImages());;
class MauchampHelper
{
    
    public static function getDebugOrder() {
    	$data = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<Scienergie_PieceCommerciale xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
   <Type_Piece>Commande</Type_Piece>
   <Code_Commande>CCAKLMLMLM</Code_Commande>
   <Code_Commande_Web>200000905</Code_Commande_Web>
   <Code_Client>AZERTY3</Code_Client>
   <Email_Client>florent.berenger+test6crea@gmail.com</Email_Client>
   <Reference_Client>WEB/2/florent@lesmecaniques.net</Reference_Client>
   <Date>2015-01-22 13:34:46</Date>
   <DateLivraison>2015-01-22 13:34:46</DateLivraison>
    <DateConfirmation>2015-01-22 13:34:46</DateConfirmation>

   <DateExpedition>2015-01-10 13:34:46</DateExpedition>
   <Remise>0,00</Remise>
   <TypeRemise>FORFAIT</TypeRemise>
   <TotalHT>916,31</TotalHT>
   <TotalTTC>1099,57</TotalTTC>
   <Site>78420</Site>
   <Remarque />
   <Etat>0</Etat>
   <Mode_livraison>pickupatstore_1</Mode_livraison>
   <Moyen_Paiement>checkmo</Moyen_Paiement>
   <Code_Depot>LPN78420</Code_Depot>
   <Adresse_Facturation_Raison_Sociale>LES MECANIQUES</Adresse_Facturation_Raison_Sociale>
   <Adresse_Facturation_Nom>Bérenger</Adresse_Facturation_Nom>
   <Adresse_Facturation_Prenom>Florent</Adresse_Facturation_Prenom>
   <Adresse_Facturation_Email>florent@lesmecaniques.net</Adresse_Facturation_Email>
   <Adresse_Facturation_Ville>Paris</Adresse_Facturation_Ville>
   <Adresse_Facturation_CP>75009</Adresse_Facturation_CP>
   <Adresse_Facturation_Code_Pays>FR</Adresse_Facturation_Code_Pays>
   <Adresse_Facturation_Adr1>5 rue de Provence</Adresse_Facturation_Adr1>
   <Adresse_Facturation_Telephone>0140506050</Adresse_Facturation_Telephone>
   <Adresse_Facturation_Portable>0661845373</Adresse_Facturation_Portable>
   <Adresse_Facturation_Fax />
   <Adresse_Livraison_Raison_Sociale />
   <Adresse_Livraison_Nom>Bérenger</Adresse_Livraison_Nom>
   <Adresse_Livraison_Prenom>Florent</Adresse_Livraison_Prenom>
   <Adresse_Livraison_Email>florent@lesmecaniques.net</Adresse_Livraison_Email>
   <Adresse_Livraison_Ville>909090</Adresse_Livraison_Ville>
   <Adresse_Livraison_CP>90909</Adresse_Livraison_CP>
   <Adresse_Livraison_Code_Pays>FR</Adresse_Livraison_Code_Pays>
   <Adresse_Livraison_Adr1>2323</Adresse_Livraison_Adr1>
   <Adresse_Livraison_Telephone>9090</Adresse_Livraison_Telephone>
   <Adresse_Livraison_Fax />

   <Representant>CT</Representant>
   <Representant_Email>cedrictavernon@obd.fr</Representant_Email> 
   
   <Representant2>CT</Representant2>
   <Representant2_Email>cedrictavernon@obd.fr</Representant2_Email>
   <Representant2_Nom>Tavernon</Representant2_Nom>
   <Representant2_Prenom>Cédric</Representant2_Prenom>
   <Representant2_Tel>01.XXX</Representant2_Tel>
   <Representant2_Portable>06.XXX</Representant2_Portable>

   <Lignes>
      <Ligne>
         <Ordre>1</Ordre>
         <Code_EAN_Article>6101501940708</Code_EAN_Article>
         <Nombre>1.0000</Nombre>
         <Quantite_Unite>1.0000</Quantite_Unite>
         <Prix_HT>408.87</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation>Largeur: laTES, Longeur: LTEST</Observation>
         <Designation>XXXPlateau De Table Ostende à Partir De Vieux Fond De Wagon Chêne Rabote 2mm Brut - (longueur Max 2700mm )</Designation>
      </Ligne>
      <Ligne>
         <Ordre>2</Ordre>
         <Code_EAN_Article>7612894751772</Code_EAN_Article>
         <Nombre>2.0000</Nombre>
         <Quantite_Unite>2.0000</Quantite_Unite>
         <Prix_HT>195,20</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation />
         <Designation>Sika</Designation>
      </Ligne>
      <Ligne>
         <Ordre>3</Ordre>
         <Code_EAN_Article>0000000000823</Code_EAN_Article>
         <Nombre>2.0000</Nombre>
         <Quantite_Unite>2.0000</Quantite_Unite>
         <Prix_HT>50,05</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation />
         <Designation>Plus Value Peinture Noir Ou Blanc Pour Pied De Table</Designation>
      </Ligne>
      <Ligne>
         <Ordre>4</Ordre>
         <Code_EAN_Article>0000000000817</Code_EAN_Article>
         <Nombre>1.0000</Nombre>
         <Quantite_Unite>1.0000</Quantite_Unite>
         <Prix_HT>16,94</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation />
         <Designation>Plus Value Finition Huile Invisible Ecologique Ou Savon De Marseille Pour Plateau De Table</Designation>
      </Ligne>
       <Ligne>
         <Ordre>5</Ordre>
         <Code_EAN_Article>KKKKKK</Code_EAN_Article>
         <Nombre>1.0000</Nombre>
         <Quantite_Unite>1.0000</Quantite_Unite>
         <Prix_HT>16,94</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation />
         <Designation>Test Produit manquant</Designation>
      </Ligne>


      <Ligne>
         <Ordre>6</Ordre>
         <Code_EAN_Article />
         <Code_Article>TRANSPORT</Code_Article>
         <Nombre>1</Nombre>
         <Quantite_Unite>1.0000</Quantite_Unite>
         <Prix_HT>0.0000</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation>Retrait en dépôt - LPN Paris  [ 141 rue de Bagnolet, 3 rue Pelleport, Paris ]</Observation>
         <Designation>Retrait en dépôt - LPN Paris  [ 141 rue de Bagnolet, 3 rue Pelleport, Paris ]</Designation>
      </Ligne>
      <Ligne>
         <Ordre>7</Ordre>
         <Code_EAN_Article />
         <Code_Article></Code_Article>
         <Nombre></Nombre>
         <Quantite_Unite></Quantite_Unite>
         <Prix_HT>0.0000</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Designation>TEST OBSERVATION</Designation>
      </Ligne>

      <Ligne>
         <Ordre>8</Ordre>
         <Code_EAN_Article>7612894751772</Code_EAN_Article>
         <Nombre>2.0000</Nombre>
         <Quantite_Unite>2.0000</Quantite_Unite>
         <Prix_HT>195,20</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation />
         <Designation>Sika</Designation>
      </Ligne>


      <Ligne>
         <Ordre>9</Ordre>
         <Code_EAN_Article>6303002894200</Code_EAN_Article>
         <Nombre>2.0000</Nombre>
         <Quantite_Unite>2.0000</Quantite_Unite>
         <Prix_HT>195,20</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation />
         <Designation>Bardage</Designation>
      </Ligne>

       <Ligne>
         <Ordre>10</Ordre>
         <Code_EAN_Article>6101501940708</Code_EAN_Article>
         <Nombre>1.0000</Nombre>
         <Quantite_Unite>1.0000</Quantite_Unite>
         <Prix_HT>408.87</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation>Largeur: laTES, Longeur: LTEST</Observation>
         <Designation>XXXPlateau De Table Ostende à Partir De Vieux Fond De Wagon Chêne Rabote 2mm Brut - (longueur Max 2700mm )</Designation>
      </Ligne>

      <Ligne>
         <Ordre>11</Ordre>
         <Code_EAN_Article>103000503062</Code_EAN_Article>
         <Nombre>1.0000</Nombre>
         <Quantite_Unite>1.0000</Quantite_Unite>
         <Prix_HT>408.87</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation>Largeur: laTES, Longeur: LTEST</Observation>
         <Designation>XXXPlateau De Table Ostende à Partir De Vieux Fond De Wagon Chêne Rabote 2mm Brut - (longueur Max 2700mm )</Designation>
      </Ligne>

      <Ligne>
         <Ordre>12</Ordre>
         <Code_EAN_Article>3524830049147</Code_EAN_Article>
         <Nombre>1.0000</Nombre>
         <Quantite_Unite>1.0000</Quantite_Unite>
         <Prix_HT>408.87</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation>Largeur: laTES, Longeur: LTEST</Observation>
         <Designation>TEST PHOTO NE MARCHE PAS</Designation>
      </Ligne>

      <Ligne>
         <Ordre>13</Ordre>
         <Code_EAN_Article>7612894751772</Code_EAN_Article>
         <Nombre>2.0000</Nombre>
         <Quantite_Unite>2.0000</Quantite_Unite>
         <Prix_HT>195,20</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Observation />
         <Designation>Sika II</Designation>
      </Ligne>



   </Lignes>
   
   <Acompte />
</Scienergie_PieceCommerciale>

EOT;
		return $data;
    }


    public static function getDebugClient() {
      $data = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<ClientXML_Azure xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
   <Code_Client>PIRES</Code_Client>
   <Nom>PIRES MANUEL</Nom>
   <Nom_Contact>mme PIRES AU BOULOT</Nom_Contact>
   <Prenom_Contact />
   <Email_Contact />
   <Indice_Code_Prix>3</Indice_Code_Prix>
   <Code_Client_Web />
   <ADRESSES_Livraisons>
      <ADRESSE_Azure>
         <Nom>PIRES SAS</Nom>
         <Adr2>21 RUE DES MOULINS</Adr2>
         <Cp>78290</Cp>
         <Ville>CROISSY SUR SEINE</Ville>
         <Telephone>01 39 18 21 46</Telephone>
         <Portable>06.08.73.03.73</Portable>
         <Pays>FR</Pays>
         <Email>ets.pires@club-internet.fr</Email>
      </ADRESSE_Azure>
   </ADRESSES_Livraisons>
   <ADRESSES_CLients>
      <ADRESSE_Azure>
         <Nom>PIRES SAS</Nom>
         <Adr2>21 RUE DES MOULINS</Adr2>
         <Cp>78290</Cp>
         <Ville>CROISSY SUR SEINE</Ville>
         <Telephone>01 39 18 21 46</Telephone>
         <Portable>06.08.73.03.73</Portable>
         <Pays>FR</Pays>
         <Email>ets.pires@club-internet.fr</Email>
      </ADRESSE_Azure>
   </ADRESSES_CLients>
</ClientXML_Azure>
EOT;
    return $data;
    }



    public static function buildXmlClientFromOrder($xmlOrder) {
      $xml = simplexml_load_string($xmlOrder);

       $adresse = [
          'Nom' => (string)$xml->Adresse_Facturation_Raison_Sociale,
          'Adr1' => (string)$xml->Adresse_Facturation_Adr1,
          'Adr2' => (string)$xml->Adresse_Facturation_Adr2,
          'Cp' => (string)$xml->Adresse_Facturation_CP,
          'Ville' => (string)$xml->Adresse_Facturation_Ville,
          'Telephone' => (string)$xml->Adresse_Facturation_Telephone,
          'Portable' => (string)$xml->Adresse_Facturation_Portable,
          'Pays' => (string)$$xml->Adresse_Facturation_Code_Pays,
          'Email' => (string)$xml->Adresse_Facturation_Email,


        ]
        ;


        $codeClient = strpos((string)$xml->Code_Client,"DIVERS")!==false?"":(string)$xml->Code_Client;
       $client = [
          'Code_Client' => $codeClient,
          'Nom' => (string)$xml->Adresse_Facturation_Raison_Sociale,
          'Nom_Contact' => (string)$xml->Adresse_Facturation_Nom,
          'Prenom_Contact' => (string)$xml->Adresse_Facturation_Prenom,
          'Email_Contact' => (string)$xml->Email_Client,
          'Indice_Code_Prix' => "4",
          
        ];

       $xmlClient = new \SimpleXMLElement('<ClientXML_Azure xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"/>');
    
      $callback =  function ($v, $k) use (&$xmlClient, &$callback) {

              if (is_array($v)) {
                  array_walk_recursive($v, $callback);
              }
              $xmlClient->addChild($k);
              $xmlClient->$k=$v;
          };
        
      array_walk_recursive($client, $callback);

       $ADRESSES_CLients = $xmlClient->addChild('ADRESSES_CLients');
       $ADRESSE_Azure = $ADRESSES_CLients->addChild('ADRESSE_Azure');
                  
        foreach ($adresse as $k => $v){
            $ADRESSE_Azure->addChild($k);
            $ADRESSE_Azure->$k=$v;
        }



      // return $xmlClient->asXML();
       return $xmlClient;
  
    }



    public static function isClientRequest($data) {
      return strstr($data, "ClientXML_Azure");
    }





    public static function parseClient($data) {
      $xml = simplexml_load_string($data);
      
      $client = json_decode(json_encode($xml, TRUE));

      unset ($client->ADRESSES_Livraisons);
      unset ($client->ADRESSES_CLients);
      
      
      $emails = array($xml->Email_Contact);
      $adresses = array();
      $noms = array();
      
     //On met toutes les adresses dans una array, et on stock le nom et l'email ai cas ou il ,n'y a pas de contgact
        $adressesClient = $xml->ADRESSES_CLients->ADRESSE_Azure;
       if(isset($adressesClient) && $adressesClient->count()>0) {

        for($i=0; $i<$adressesClient->count(); $i++){
           $adresse = json_decode(json_encode($adressesClient[$i]), TRUE);
           $adresse["Type"] = "billing";
           $adresses[] = $adresse;
           $emails[] = $adresse["Email"];
           $noms[] = $adresse["Nom"];

        }
      }

      $adressesLivraison = $xml->ADRESSES_Livraisons->ADRESSE_Azure;
      if(isset($adressesLivraison) && $adressesLivraison->count()>0) {

        for($i=0; $i<$adressesLivraison->count(); $i++){
           $adresse = json_decode(json_encode($adressesLivraison[$i]), TRUE);
            $adresse["Type"] = "shipping";
           $adresses[] = $adresse;
           $emails[] = $adresse["Email"];
           //PAS DE NIOM POUR LES LIVRAISON
            $noms[] = $adresse["Nom"];

        }
      }

      $client->Adresses = $adresses;



      if(!isset($client->Email_Contact) || !is_string($client->Email_Contact) || !\Pimcore\Mail::isValidEmailAddress($client->Email_Contact)) {
          foreach ($emails as $key => $email) {
            if(\Pimcore\Mail::isValidEmailAddress($email)) {
              $xml->Email_Contact = $client->Email_Contact = $email;
              break;
            }
        }
      }

      if(!isset($client->Nom_Contact) || !is_string($client->Nom_Contact)) {
          foreach ($noms as $key => $noms) {
            if(strlen(trim($nom))>0) {
              $xml->Nom_Contact = $client->Nom_Contact = $nom;
              break;
            }
        }
      }
      

  




      return $client;

    }


    public static function parseOrder($data) {
      $transportRows = array();
      $rowTotal = 0;
      $products = array();
      $allProducts = array();
      $missingProducts = array();



      libxml_use_internal_errors(true);
    	$xml = simplexml_load_string($data);
      if ($xml === false) {
        echo "Oh non!!! Erreur lors du chargement des données<br /><br /><br />";
         echo '<textarea  cols="100" rows="20" name="xml" style="font-size:10px; color:#CCCCCC">'.$data."</textarea>";
          
          foreach(libxml_get_errors() as $error) {
              echo "<br />", $error->message;
          }
          
          
      }

      else {


     
        $lines = $xml->Lignes[0]->Ligne;

        if($lines && $lines->count()<1){
            

        }
 //TODO ERROR
          
        /*
        <Representant>CT</Representant><Representant_Email>cedrictavernon@obd.fr</Representant_Email>
        */

        $orderDetail = [
          'Type_Piece' => (string)$xml->Type_Piece,
          'Code_Commande' => (string)$xml->Code_Commande,
          'Code_Commande_Web' => (string)$xml->Code_Commande_Web,
          'Date' => (string)$xml->Date,
          'Date_Livraison' => (string)$xml->Date_Livraison,
          'Date_Confirmation' => (string)$xml->Date_Confirmation,
          'Date_Confirmation' => (string)$xml->Date_Confirmation,
          'Email_Client' => (string)$xml->Email_Client,
          'Acompte' => (string)$xml->Acompte,
          'Remise' => (string)$xml->Remise,
          'Type_Remise' => (string)$xml->Type_Remise,
          'TotalHT' => (string)$xml->TotalHT,
          'TotalTTC' => (string)$xml->TotalTTC,
          'Site' => (string)$xml->Site,
          'Remarque' => (string)$xml->Remarque,
          'Mode_livraison' => (string)$xml->Mode_livraison,
          'Moyen_Paiement' => (string)$xml->Moyen_Paiement,
          'Reference_Client' => (string)$xml->Reference_Client,
          'Etat' => (string)$xml->Etat,
          'Reglement' => (string)$xml->Reglement,
          
          'Representant' => (string)$xml->Representant,
          'Representant_Email' => (string)$xml->Representant_Email,
          'Representant_Nom' => (string)$xml->Representant_Nom,
          'Representant_Prenom' => (string)$xml->Representant_Prenom,
          'Representant_Tel' => (string)$xml->Representant_Tel,
          'Representant_Portable' => (string)$xml->Representant_Portable,

          'Representant2' => (string)$xml->Representant2,
          'Representant2_Email' => (string)$xml->Representant2_Email,
          'Representant2_Nom' => (string)$xml->Representant2_Nom,
          'Representant2_Prenom' => (string)$xml->Representant2_Prenom,
          'Representant2_Tel' => (string)$xml->Representant2_Tel,
          'Representant2_Portable' => (string)$xml->Representant2_Portable,


          "Adresse_Facturation_Raison_Sociale"  =>  (string)$xml->Adresse_Facturation_Raison_Sociale,  
          "Adresse_Facturation_Nom"         =>  (string)$xml->Adresse_Facturation_Nom, //
          "Adresse_Facturation_Prenom"      =>  (string)$xml->Adresse_Facturation_Prenom, 
          "Adresse_Facturation_Email"       =>  (string)$xml->Adresse_Facturation_Email,              
          "Adresse_Facturation_Ville"       =>  (string)$xml->Adresse_Facturation_Ville, 
          "Adresse_Facturation_CP"        =>  (string)$xml->Adresse_Facturation_CP, 
          "Adresse_Facturation_Code_Pays"     =>  (string)$xml->Adresse_Facturation_Code_Pays, 
          "Adresse_Facturation_Adr1"        =>  (string)$xml->Adresse_Facturation_Adr1, 
          "Adresse_Facturation_Telephone"     =>  (string)$xml->Adresse_Facturation_Telephone, 

          "Adresse_Facturation_Portable"     =>  (string)$xml->Adresse_Facturation_Portable, 

          "Adresse_Facturation_Fax"         =>  (string)$xml->Adresse_Facturation_Fax, 
            
          "Adresse_Livraison_Raison_Sociale"  =>  (string)$xml->Adresse_Livraison_Raison_Sociale,  
          "Adresse_Livraison_Nom"         =>  (string)$xml->Adresse_Livraison_Nom, //,"TEST3333",//$xml->XXXX,
          "Adresse_Livraison_Prenom"      =>  (string)$xml->Adresse_Livraison_Prenom, 
          "Adresse_Livraison_Email"       =>  (string)$xml->Adresse_Livraison_Email,              
          "Adresse_Livraison_Ville"       =>  (string)$xml->Adresse_Livraison_Ville, 
          "Adresse_Livraison_CP"        =>  (string)$xml->Adresse_Livraison_CP, 
          "Adresse_Livraison_Code_Pays"     =>  (string)$xml->Adresse_Livraison_Code_Pays, 
          "Adresse_Livraison_Adr1"        =>  (string)$xml->Adresse_Livraison_Adr1, 
          "Adresse_Livraison_Telephone"     =>  (string)$xml->Adresse_Livraison_Telephone, 
          "Adresse_Livraison_Portable"     =>  (string)$xml->Adresse_Livraison_Portable, 
          "Adresse_Livraison_Fax"         =>  (string)$xml->Adresse_Livraison_Fax, 

        ];

       

        $lines = $xml->Lignes[0]->Ligne;

        if( $lines ) {
            $itemsCount = 0;
            
            for($i=0; $i<$lines->count(); $i++){
                
                $p = $lines[$i];

                $tauxTVA = floatval(self::convertFloat($p->Taux_TVA));
                $tauxTVA = $tauxTVA<1?$tauxTVA*100:$tauxTVA;
                $ratioTVA = 1+($tauxTVA/100);
                
                if(strpos($p->Code_Article, 'TR')===0) {
                
                    $price = floatval(self::convertFloat($p->Prix_HT));
                    $shippingAmountHT += $price;
                    if($price>0) {
                        $transport = $p;
                    }
                    $transportRows[] = $p;
                    
                }
                else {      
                    $itemsCount++;      
                    //Quand revient de Azure, prendre Qté unité !! et pas NNombre
                    $qty = floatval(self::convertFloat($p->Quantite_Unite));

                    $price = floatval(self::convertFloat($p->Prix_HT));
                    $rowTotal = $price*$qty;
                    
                    $productTypeId  = 'simple';
                    $productName    = $p->Code_EAN_Article;
                    $productSku     = $p->Code_EAN_Article;


                    
                    if(strlen($p->Designation)>1){
                        
                        $productName = $p->Designation;
                    }
                
                  
                    

                    //Ligne avec article    
                    if(strlen($p->Code_EAN_Article)>1) {

                        $qty = floatval(self::convertFloat($p->Quantite_Unite));

                        $price = floatval(self::convertFloat($p->Prix_HT));
                        $rowTotal = $price*$qty;


                        try {
                            $_product = null;

                            $sku = trim($p->Code_EAN_Article);             
                            $existingProductList = Object\Product::getByEan($sku);

                            //print_r($parent);
                            if($existingProductList->count()==1) {
                                $_product = $existingProductList->current();
                                 //echo "EAN existe ".$_product->getFullPath()."<br />\n";
                                 
                            }
                              
                            else {
                                //echo "EAN existe PAS ".$sku."<br />\n";
                            }
                              
                            //Si produit existe
                            if(isset($_product)){
                                 $products[$_product->ean] = $_product; 

                            }

                            //Sinon
                            else {
                              
                                $productName    = strlen($p->Designation)>1?$p->Designation:$productName; 
                                $missingProduct = new Object\Product(); 
                                $missingProduct->name = $productName;
                                $missingProduct->ean = $sku;
                               /* $missingProduct = Object\Product::create(array(
                                   // "o_parentId" => $parentId,
                                    "o_creationDate" => time(),
                                   // "o_userOwner" => $userId,
                                   // "o_userModification" => $userId,
                                   // "o_key" => strtolower($data[$mapping["famille"]]),
                                    "name" => $productName,
                                    "ean" => $sku
                                    
                                ));*/
                                $missingProducts[] =  $missingProduct; 

                               // print_r( $missingProduct);
                                              

                            }           
                        }
                        catch (Exception $ex) {
                                
                            //TODO LOG
                        }

                        
                        

                    }

                    
                }
            }

        }

            

          if(strlen($orderDetail["Email_Client"])==0 && strlen($orderDetail["Adresse_Facturation_Email"])>0) {
            $orderDetail["Email_Client"] = $orderDetail["Adresse_Facturation_Email"];
          }

          if(strlen($orderDetail["Email_Client"])==0 && strlen($orderDetail["Adresse_Facturation_Livraison"])>0) {
            $orderDetail["Email_Client"] = $orderDetail["Adresse_Facturation_Email"];
          }


       
          $allProducts = array_merge($products,$missingProducts);
         return array(
          "orderDetail" => $orderDetail,
          "products"=> $products,
         	"allProducts"=> $allProducts,
         	"missingProducts"=> $missingProducts,
         	"transport"=> $transportRows,
         );

        }
    }

     public static function convertFloat($price) {
    //self::_formatStr('%.2F'
    if($price>0) {
      $price = str_replace(",", ".", $price);
      $price = floatval($price);
    }
    return $price;
  }

  public static function loadAzureInvoice($codecommande) {
        $svc = $svc = new \LPNEntities(LPN_SERVICE_URL);
        $query = getQuery($svc,"invoice",$codecommande);//self::getParam("code_commande"));
        $response = $query->Execute();
        $orders = array();
        
        try {
          do {
              if(isset($nextProductToken) && $nextProductToken != null) {            
                  $response = $svc->Execute($nextProductToken);


              }

              $index=0;
              foreach($response->Result as $orderAzure) {
                  return $orderAzure;
                
              }
           }
          while(($nextProductToken = $response->GetContinuation()) != null);

      }
      catch (Exception $e)
        {
  
             echo  "Error:" . $e->getError() . "<br>" . "Detailed Error:" . $e->getMessage(); 
        }

       return null;
  }


  public static function loadAzureOrder($codecommande) {
        $svc = $svc = new \LPNEntities(LPN_SERVICE_URL);
        $query = getQuery($svc,"order",$codecommande);//self::getParam("code_commande"));
        $response = $query->Execute();
        $orders = array();
        
        try {
          do {
              if(isset($nextProductToken) && $nextProductToken != null) {            
                  $response = $svc->Execute($nextProductToken);


              }

              $index=0;
              foreach($response->Result as $orderAzure) {
                  return $orderAzure;
                
              }
           }
          while(($nextProductToken = $response->GetContinuation()) != null);

      }
      catch (Exception $e)
        {
  
             echo  "Error:" . $e->getError() . "<br>" . "Detailed Error:" . $e->getMessage(); 
        }

       return null;
  }


  public static function loadAzureOrderXml($codecommande) {
  	    $svc = $svc = new \LPNEntities(LPN_SERVICE_URL);
        $query = getQuery($svc,"order",$codecommande);//self::getParam("code_commande"));
        $response = $query->Execute();
        $orders = array();
        
        try {
          do {
              if(isset($nextProductToken) && $nextProductToken != null) {            
                  $response = $svc->Execute($nextProductToken);


              }

              $index=0;
              foreach($response->Result as $orderAzure) {
                $debugData = false;
                $arrForXml = array(
                          "Type_Piece"          => "Commande",  //METTRE Dvis si cheque ou autre / Mettre Commande qu si retour de payment CB authorisé
                          "Code_Commande"       => $orderAzure->Code_Commande.($debugData?date('hms'):""),
                          "Code_Commande_Web"   => $orderAzure->Code_Commande_Web,
                          "Code_Client"         => $orderAzure->getCodeClient(),
                          "Email_Client"        => $orderAzure->CLIENT[0]->Email_Contact,
                          "Reference_Client"    => $orderAzure->Reference_Client,
                          "Date"                => $debugData?'2016-05-18T01:00:00':$orderAzure->Date,

                          "DateLivraison"       => $orderAzure->Date_Livraison,
                          "DateConfirmation"      => $orderAzure->Date_Confirmation,
                          "DateExpedition"      => $orderAzure->Date_Expedition,

                          "Acompte"             => $orderAzure->Acompte,
                          "Remise"              => self::convertFloat($orderAzure->Remise),
                          "TypeRemise"          => $orderAzure->Type_Remise,   //toujours montant de remise, pas de %

                          "TotalHT"             => self::convertFloat($orderAzure->TotalHT),
                          "TotalTTC"            => self::convertFloat($orderAzure->TotalTTC),

                          "Site"                => $orderAzure->Code_SITE,
                          "Code_Depot"          => $debugData?'LPN75':$orderAzure->Code_Depot,

                          "Remarque"            => $orderAzure->Remarque,
                          "Etat"                => $orderAzure->Etat,   //EtatCommande 0=> En cours, 1=> BLoquée, 2=> complete
                          "Mode_livraison"      => $orderAzure->Mode_livraison,
                          "Moyen_Paiement"      =>  $orderAzure->Moyen_Paiement,

                            
                          "Adresse_Facturation_Raison_Sociale"  =>  $orderAzure->Adresse_Facturation_Raison_Sociale, //,"TEST",//$orderAzure->XXXX, 
                          "Adresse_Facturation_Nom"         =>  $orderAzure->Adresse_Facturation_Nom, //,"TEST222",//$orderAzure->XXXX,
                          "Adresse_Facturation_Prenom"      =>  $orderAzure->Adresse_Facturation_Prenom, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Facturation_Email"       =>  $debugData?'florent.berenger+testnotification@gmail.com':$orderAzure->Adresse_Facturation_Email, //,"TEST",//$orderAzure->XXXX,             
                          "Adresse_Facturation_Ville"       =>  $orderAzure->Adresse_Facturation_Ville, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Facturation_CP"        =>  $orderAzure->Adresse_Facturation_CP, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Facturation_Code_Pays"     =>  $orderAzure->Adresse_Facturation_Code_Pays, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Facturation_Adr1"        =>  $orderAzure->Adresse_Facturation_Adr1, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Facturation_Telephone"     =>  $orderAzure->Adresse_Facturation_Telephone, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Facturation_Portable"     =>  $orderAzure->Adresse_Facturation_Portable, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Facturation_Fax"         =>  $orderAzure->Adresse_Facturation_Fax, //,"TEST",//$orderAzure->XXXX,
                            
                          "Adresse_Livraison_Raison_Sociale"  =>  $orderAzure->Adresse_Livraison_Raison_Sociale, //,"TEST",//$orderAzure->XXXX, 
                          "Adresse_Livraison_Nom"         =>  $orderAzure->Adresse_Livraison_Nom, //,"TEST3333",//$orderAzure->XXXX,
                          "Adresse_Livraison_Prenom"      =>  $orderAzure->Adresse_Livraison_Prenom, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Livraison_Email"       =>  $orderAzure->Adresse_Livraison_Email, //,"TEST",//$orderAzure->XXXX,             
                          "Adresse_Livraison_Ville"       =>  $orderAzure->Adresse_Livraison_Ville, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Livraison_CP"        =>  $orderAzure->Adresse_Livraison_CP, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Livraison_Code_Pays"     =>  $orderAzure->Adresse_Livraison_Code_Pays, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Livraison_Adr1"        =>  $orderAzure->Adresse_Livraison_Adr1, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Livraison_Telephone"     =>  $orderAzure->Adresse_Livraison_Telephone, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Livraison_Portable"     =>  $orderAzure->Adresse_Livraison_Portable, //,"TEST",//$orderAzure->XXXX,
                          "Adresse_Livraison_Fax"         =>  $orderAzure->Adresse_Livraison_Fax, //,"TEST",//$orderAzure->XXXX,
                          "Reglement"         =>  $orderAzure->Reglement, //,"TEST",//$orderAzure->XXXX,
                          "Devis_Lies"         =>  $orderAzure->Devis_Lies //,"TEST",//$orderAzure->XXXX,
                            
                              );    


                $xml = new \SimpleXMLElement('<Scienergie_PieceCommerciale xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"/>');

                
  
                $callback =  function ($v, $k) use (&$xml, &$callback) {

                        if (is_array($v)) {
                            array_walk_recursive($v, $callback);
                        }
                        
                        $xml->addChild($k);
                        $xml->$k = $v;
                    };
                    
                  array_walk_recursive($arrForXml, $callback);


                $lignes = $xml->addChild('Lignes');
                
                $inc = 1;
                $ordersUpdated = 0;
                foreach ($orderAzure->COMMANDE_DETAIL as $orderItemAzure) {
                 
                  $arr = array(
                              "Ordre"       => $orderItemAzure->Ordre,
                              "Code_Article"   => $orderItemAzure->Code_Article,
                              "Code_EAN_Article"  => $orderItemAzure->Code_EAN_Article,
                              "Nombre"      => $orderItemAzure->Nombre,
                              "Quantite_Unite"      => $orderItemAzure->QuantiteUnite,

                              "Prix_HT"     => number_format($orderItemAzure->Prix, 2,",",""),
                              "Pourc_Remise"    => $orderItemAzure->Discount,
                              "Taux_TVA"      => 20,//$orderItemAzure->Taux_TVA,
                              "Observation"     => $orderItemAzure->Observation,
                              "Designation"   => $orderItemAzure->Designation
                                );

                  $ligne = $lignes->addChild('Ligne');
                  
                  foreach ($arr as $k => $v){
                      $ligne->addChild($k);
                      $ligne->$k=$v;
                  }
                      
                  $inc++;
                }


                
                 $client = $xml->addChild('Client');

                 
                $arrClient = array(
                          "Type_Piece"            => "Client",  //METTRE Dvis si cheque ou autre / Mettre Commande qu si retour de payment CB authorisé
                          "Code_Client_Web"       => $orderAzure->CLIENT[0]->Code_Client_Web,
                          "Code_Client"           => $orderAzure->CLIENT[0]->Code_Client,
                          "Nom"                   => $orderAzure->CLIENT[0]->Nom,
                          "Nom_Contact"           => $orderAzure->CLIENT[0]->Nom_Contact,
                          "Prenom_Contact"        => $orderAzure->CLIENT[0]->Prenom_Contact,
                          "Email_Contact"         => $debugData?'florent.berenger+testnotification@gmail.com':$orderAzure->CLIENT[0]->Email_Contact,
                          "Indice_Code_Prix"      => $orderAzure->CLIENT[0]->Indice_Code_Prix,
                          "Suivi_Int"             => $orderAzure->CLIENT[0]->Suivi_Int,
                        
                ); 
             

                foreach ($arrClient as $k => $v){
                    $client->addChild($k);
                    $client->$k=$v;
                }
               
              
                
             }
           }
          while(($nextProductToken = $response->GetContinuation()) != null);

      }
      catch (Exception $e)
        {
  
             echo  "Error:" . $e->getError() . "<br>" . "Detailed Error:" . $e->getMessage(); 
        }

       return $xml;
  }




  public static function loadAzureClient($codeclient) {
    $svc = $svc = new \LPNEntities(LPN_SERVICE_URL);
        $query = getQuery($svc,"client",$codeclient);//self::getParam("code_commande"));
        $response = $query->Execute();
        $orders = array();
        
        try {
          do {
              if(isset($nextProductToken) && $nextProductToken != null) {            
                  $response = $svc->Execute($nextProductToken);


              }

              $index=0;
              foreach($response->Result as $orderAzure) {
                $debugData = false;

                 $arrForXml = array(
                            "Type_Piece"            => "Client",  //METTRE Dvis si cheque ou autre / Mettre Commande qu si retour de payment CB authorisé
                            "Code_Client_Web"       => $Customer->Code_Client_Web,
                            "Code_Client"           => $Customer->Code_Client,
                            "Nom"                   => $Customer->Nom,
                            "Nom_Contact"           => $Customer->Nom_Contact,
                            "Prenom_Contact"        => $Customer->Prenom_Contact,
                            "Email_Contact"         => $Customer->Email_Contact,
                            "Indice_Code_Prix"      => $Customer->Indice_Code_Prix,
                            "Suivi_Int"             => $Customer->Suivi_Int,
                          
                  );  
              
                $arrAdresseForXml = array(
                            "Adresse_Facturation_Raison_Sociale"  =>  $Customer->Nom, //,"TEST",//$orderAzure->XXXX, 
                            "Adresse_Facturation_Nom"         =>  $Customer->Nom->Adresse_Facturation_Nom, //,"TEST222",//$orderAzure->XXXX,
                            "Adresse_Facturation_Prenom"      =>  $Customer->Prenom_Contact, //,"TEST",//$orderAzure->XXXX,
                            "Adresse_Facturation_Email"       =>  $Adresse->Email, //,"TEST",//$orderAzure->XXXX,             
                            "Adresse_Facturation_Ville"       =>  $Adresse->Ville, //,"TEST",//$orderAzure->XXXX,
                            "Adresse_Facturation_CP"        =>  $Adresse->CP, //,"TEST",//$orderAzure->XXXX,
                            "Adresse_Facturation_Code_Pays"     =>  $Adresse->Pays, //,"TEST",//$orderAzure->XXXX,
                            "Adresse_Facturation_Adr1"        =>  $Adresse->Adr1, //,"TEST",//$orderAzure->XXXX,
                            "Adresse_Facturation_Telephone"     =>  $Adresse->Telephone, //,"TEST",//$orderAzure->XXXX,

                            "Adresse_Facturation_Portable"     =>  $Adresse->Portable, //,"TEST",//$orderAzure->XXXX,

                            "Adresse_Facturation_Fax"         =>  $Adresse->Fax //,"TEST",//$orderAzure->XXXX,
                  );

                   $arrForXml = array_merge($arrForXml,$arrAdresseForXml);


                 if(strlen($arrForXml["Adresse_Facturation_Email"]) > 4 && strlen($arrForXml['Email_Contact'])<4)
                  $arrForXml['Email_Contact'] = $arrForXml["Adresse_Facturation_Email"];

                if(strlen($arrForXml["Adresse_Facturation_Email"]) > 4 && strlen($arrForXml['Email_Contact'])<4)
                  $arrForXml['Email_Contact'] = $arrForXml["Adresse_Facturation_Email"];



                  $xml = new \SimpleXMLElement('<Scienergie_PieceCommerciale xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"/>');
    
                  $callback =  function ($v, $k) use (&$xml, &$callback) {

                          if (is_array($v)) {
                              array_walk_recursive($v, $callback);
                          }
                          $xml->addChild($k);
                          $xml->$k = $v;
                      };
                      
                  array_walk_recursive($arrForXml, $callback);

               
              
                
             }
           }
          while(($nextProductToken = $response->GetContinuation()) != null);

      }
      catch (Exception $e)
        {
  
             echo  "Error:" . $e->getError() . "<br>" . "Detailed Error:" . $e->getMessage(); 
        }

       return $xml;
  }

  public static function getSiteAdresse($site=null) {
    $sites = array();
    $sites["75020"] = array (
        "name" => "La Parqueterie Nouvelle - Paris",
        "address1" => "141, rue de Bagnolet",
        "address2" => "3 rue Pelleport",
        "zipcode" => "75020",
        "city" => "Paris",
        "phone" => "01 30 40 55 55"
    );

    $sites["78420"] = array (
        "name" => "La Parqueterie Nouvelle - Carrières - OBD",
        "address1" => "33 rue des Entrepreneurs",
        "address2" => "ZA des Amandiers",
        "zipcode" => "78420",
        "city" => "Paris",
        "phone" => "01 39 13 08 73"
    );

    $sites["78240"] = array (
        "name" => "La Parqueterie Nouvelle - Chambourcy",
        "address1" => "22 route de Mantes",
        "address2" => "",
        "zipcode" => "78240",
        "city" => "Chambourcy",
        "phone" => "01 30 06 09 22"
    );
    if(isset($site)) {
      if(array_key_exists($site, $sites))
          return $sites[$site];
    }
    return $sites;


  }

  public static function getFormatedAdress($site) {
    $site = self::getSiteAdresse($site);
    $str = $site['address1'];
    if(strlen($site["address2"]))
      $str .= ", ".$site['address2'];

    $str.= "\n".$site['zipcode']." ".$site['city'];
    return $str;

  }

  public static function getCoverTitle($products,$missingProducts=null,$orderDetail=null) {
      $words = array();



      foreach ($products as $product) {


        if($product->isAccessoire()) {
          //$words["parquet massif"] = true;
          $words["accessoires"] = true;
        }
        else  if($product->isParquetMassif()) {
          //$words["parquet massif"] = true;
          $words["parquet"] = true;
        }
        else if($product->isParquetContrecolle()) {
          //$words["parquet contrecolle"] = true;
          $words["parquet"] = true;
        }
        else if(stristr($product->getFamille(),'terrasse')) {
          $words["terrasse"] = true;
          //$words["parquet"] = true;
        }
        else if(stristr($product->getFamille(),'bardage')) {
          $words["bardage"] = true;
          //$words["parquet"] = true;
        }
        else if(stristr($product->getFamille(),'vinyl')) {
          $words["vinyl"] = true;
          //$words["parquet"] = true;
        }
        else if(stristr($product->getFamille(),'strat')) {
          $words["stratifié"] = true;
          //$words["parquet"] = true;
        }
        else if(stristr($product->getFamille(),'beton')) {
          $words["beton"] = true;
          //$words["parquet"] = true;
        }
        else if($product->isTable()) {
          $words["table"] = true;
        }
  
      }

      foreach ($missingProducts as $product) {
        
        if(stristr($product->name, "parquet") && stristr($product->name, "massif")) {
          //$words["parquet massif"] = true;
          $words["parquet"] = true;
        }
        else if(stristr($product->name, "parquet") && stristr($product->name, "contrecolle")) {
          //$words["parquet contrecolle"] = true;
          $words["parquet"] = true;
        }
        else if(stristr($product->name, "terrasse")) {
          $words["terrasse"] = true;
        }
        else if(stristr($product->name, "bardage")) {
          $words["bardage"] = true;
        }
        else if(stristr($product->name, "table ")) {
          $words["table"] = true;
        }
        else if(stristr($product->name, "vinyl ")) {
          $words["vinyl"] = true;
        }
        else if(stristr($product->name, "stratifi ")) {
          $words["stratifié"] = true;
        }
        else if(stristr($product->name, "accessoire")) {
          $words["accessoires"] = true;
        }
  
      }

      $sortedWords = array_replace(array_flip(array("parquet","terrasse","bardage","table","vinyl","stratifié","accessoires")), $words);

      $strArray=[];
      foreach ($sortedWords as $key => $value) {
        if($value===true)
          $strArray[] = ucfirst($key);
      }


      return implode("<br />", $strArray);
  }

  public static function loadAzureProduct($ean) {

      $svc = new \LPNEntities(LPN_SERVICE_URL);
      $query = getQuery($svc,"ean",$ean,0,false);

        $response = $query->Execute();
        $orders = array();
        
        try {
          do {
              if(isset($nextProductToken) && $nextProductToken != null) {            
                  $response = $svc->Execute($nextProductToken);


              }

              $index=0;
              foreach($response->Result as $productAzure) {
                   $productValues = \Website\Tool\MauchampHelper::convertAzureProductToPimcoreArray($productAzure);
                   
                   //$product->setValues($productValues);
                   return $productValues;
              }
          
          }
          while(($nextProductToken = $response->GetContinuation()) != null);

      }
      catch (Exception $e)
        {
  
             echo  "Error:" . $e->getError() . "<br>" . "Detailed Error:" . $e->getMessage(); 
        }
  }

  public static function convertAzureProductToPimcoreArray($Product) {
            $p = array();
           $data=array();
           //$mappingRaw = [[0,"Article","code"],[1,"Code_EAN_Article","ean"],[2,"Article Designation","name"],
           //[3,"Epaisseur","epaisseur"],[4,"Largeur","largeur"],[5,"Longueur","longueur"],[6,"nbrpp","nbrpp"],[7,"Choix","choix"],
           //[8,"Essence","essence"],[9,"Qualite","qualite"],[10,"Article Famille","famille"],[11,"name_scienergie_court","name_scienergie_court"]];
           $p["code"] = $Product->Code_Article;
           $p["ean"] = $Product->Code_EAN_Article;
           $p["name"] = $Product->Libelle_Article;
           $data[3]=$p["epaisseur"] = round($Product->Epaisseur);
           $data[4]=$p["largeur"] = round($Product->Largeur);
           $data[5]=$p["longueur"] = round($Product->Longueur);
           $data[6]=$p["nbrpp"] = isset($Product->Nbrpp)?$Product->Nbrpp:"";
           $data[7]=$p["choix"] = $Product->Code_Choix;
           $data[8]=$p["essence"] = $Product->Code_Essence;
           $data[9]=$p["qualite"] = $Product->Code_Qualite;
           $data[10]=$p["famille"] = $Product->Code_Famille;
           $data[11]=$p["name_scienergie_court"] = $Product->Libelle_Court_Ean;
            $data[12]=$p["published"] = $Product->Obsolete=="false" && $Product->Actif=="true";

           $p["actif_web"] = $Product->Actif=="true"?true:false;
           $p["obsolete"] = $Product->Obsolete=="true"?true:false;


            if($p['ean']=='3760102973141') {
              //var_dump($Product);
              //exit;

            }


            //print_r($Product);
            //exit;
            //var_dump($Product);
            //exit;
           // $data[12]=$p["published"] = $Product->Obsolete=="true"?false:true;
           // $p["unite"] = $Product->Unite;
            $p["colisage"] = $Product->getColisage();
            $p["unite"] = $Product->getUnite();
            $p["nbrpp"] = $Product->getNbrpp();

            //TODO : weight
            $p["weight"] = $Product->getWeightParQuantiteUnite();
            return $p;
  }

    
}