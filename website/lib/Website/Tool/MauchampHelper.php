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
   <Code_Commande />
   <Code_Commande_Web>200000905</Code_Commande_Web>
   <Code_Client>DIVERS15</Code_Client>
   <Email_Client>florent@lesmecaniques.net</Email_Client>
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
   <Adresse_Facturation_Raison_Sociale />
   <Adresse_Facturation_Nom>Bérenger</Adresse_Facturation_Nom>
   <Adresse_Facturation_Prenom>Florent</Adresse_Facturation_Prenom>
   <Adresse_Facturation_Email>florent@lesmecaniques.net</Adresse_Facturation_Email>
   <Adresse_Facturation_Ville>909090</Adresse_Facturation_Ville>
   <Adresse_Facturation_CP>90909</Adresse_Facturation_CP>
   <Adresse_Facturation_Code_Pays>FR</Adresse_Facturation_Code_Pays>
   <Adresse_Facturation_Adr1>2323</Adresse_Facturation_Adr1>
   <Adresse_Facturation_Telephone>9090</Adresse_Facturation_Telephone>
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
         <Ordre>6</Ordre>
         <Code_EAN_Article />
         <Code_Article></Code_Article>
         <Nombre></Nombre>
         <Quantite_Unite></Quantite_Unite>
         <Prix_HT>0.0000</Prix_HT>
         <Pourc_Remise>0</Pourc_Remise>
         <Taux_TVA>20</Taux_TVA>
         <Designation>TEST OBSERVATION</Designation>
      </Ligne>


   </Lignes>
   <To_Magento>array (
  'entity_id' =&gt; '70',
  'parent_id' =&gt; '70',
  'base_shipping_amount' =&gt; '0.0000',
  'shipping_amount' =&gt; '0.0000',
  'base_amount_ordered' =&gt; '1099.5700',
  'amount_ordered' =&gt; '1099.5700',
  'additional_data' =&gt; 'a:2:{s:10:"payable_to";s:23:"La Parqueterie Nouvelle";s:15:"mailing_address";s:94:"La Parqueterie Nouvelle &#xD;
33 rue des Entrepreneurs&#xD;
ZI des Amandiers&#xD;
78420 Carrières / Seine";}',
  'cc_exp_month' =&gt; '0',
  'cc_ss_start_year' =&gt; '0',
  'method' =&gt; 'checkmo',
  'cc_ss_start_month' =&gt; '0',
  'cc_exp_year' =&gt; '0',
  'additional_information' =&gt; 
  array (
  ),
  'method_instance (Mage_Payment_Model_Method_Checkmo)' =&gt; 
  array (
    'info_instance (Mage_Sales_Model_Order_Payment)' =&gt; '*** RECURSION ***',
  ),
)</To_Magento>
   <Acompte />
</Scienergie_PieceCommerciale>

EOT;
		return $data;
    }


    public static function getDebugClient() {
      $data = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<ClientXML_Azure xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
   <Code_Client>TEST_LPN</Code_Client>
   <Nom>NOM TEST_LPN</Nom>
   <Indice_Code_Prix>4</Indice_Code_Prix>
   <Code_Client_Web />
   <Email_Contact>florentContact@lesmecaniques.net</Email_Contact>
   <ADRESSES_Livraisons>
      <ADRESSE_Azure>
         <Nom>EVLINAMA</Nom>
         <Adr1>RUE CARNOT</Adr1>
         <Email>florentAzure1@lesmecaniques.net</Email>
         <Cp>13210</Cp>
         <Ville>SAINT-REMY DE PROVENCE</Ville>
         <Pays>FR</Pays>
      </ADRESSE_Azure>

       <ADRESSE_Azure>
         <Nom>BIBI 2</Nom>
         <Adr1>RUE CARNOT 2</Adr1>
         <Email>florentAzure@lesmecaniques.net</Email>
         <Cp>13210  2</Cp>
         <Ville>SAINT-REMY DE PROVENCE  2</Ville>
         <Pays>FR</Pays>
      </ADRESSE_Azure>


   </ADRESSES_Livraisons>

   <ADRESSES_CLients>
      <ADRESSE_Azure>
         <Nom>EVLINAMA</Nom>
         <Adr1>RUE CARNOT</Adr1>
         <Cp>13210</Cp>
         <Ville>SAINT-REMY DE PROVENCE</Ville>
         <Pays>FR</Pays>
        <Email>florentCLlient@lesmecaniques.net</Email>

      </ADRESSE_Azure>
   </ADRESSES_CLients>
</ClientXML_Azure>

EOT;
    return $data;
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



      if(!isset($client->Email_Contact)) {
          foreach ($emails as $key => $email) {
            if(\Pimcore\Mail::isValidEmailAddress($email)) {
              $client->Email_Contact = $email;
              break;
            }
        }
      }

      if(!isset($client->Nom_Contact)) {
          foreach ($noms as $key => $noms) {
            if(strlen(trim($nom))>0) {
              $client->Nom_Contact = $nom;
              break;
            }
        }
      }
      

  




      return $client;

    }


    public static function parseOrder($data) {
    	$xml = simplexml_load_string($data);
     
        $lines = $xml->Lignes[0]->Ligne;

        if($lines->count()<1){
            
           //TODO ERROR
        }


        $transportRows = array();
        $rowTotal = 0;
        $products = array();
        $missingProducts = array();

        $lines = $xml->Lignes[0]->Ligne;

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
                    
                    if(strlen($p->Designation)>1 && strlen($p->Code_EAN_Article)<1){
                        
                        $productName = $p->Designation;
                    }
                
                    
                    

                    //Ligne avec article    
                    else if(strlen($p->Code_EAN_Article)>1) {

                        $qty = floatval(self::convertFloat($p->Quantite_Unite));

                        $price = floatval(self::convertFloat($p->Prix_HT));
                        $rowTotal = $price*$qty;


                        try {
                        
                            $sku = trim($p->Code_EAN_Article);             
                            $existingProductList = Object\Product::getByEan($sku);
                            //print_r($parent);
                            if($existingProductList->count()==1) {
                                $_product = $existingProductList->current();
                                 //echo "EAN existe ".$_product->getFullPath()."\n";
                                 
                            }
                            else {
                                //echo "n'existe pas\n";
                                $missingProducts[] = ["name"=>$productName,"sku"=>$sku]; 
                            }           
                            
                            //Si produit existe
                            if(isset($_product)){
                                 $products[] = $_product;                       
                            }

                            //Sinon
                            else {

                                $productName    = strlen($p->Designation)>1?$p->Designation:$productName;  
                                $missingProducts[] = ["name"=>$productName,"sku"=>$sku];                  

                            }           
                        }
                        catch (Exception $ex) {
                                
                            //TODO LOG
                        }

                        
                        

                    }
                    
                }
            }
         return array(
         	"products"=> $products,
         	"missingProducts"=> $missingProducts,
         	"transport"=> $transportRows,
         );
    }

     public static function convertFloat($price) {
    //self::_formatStr('%.2F'
    if($price>0) {
      $price = str_replace(",", ".", $price);
      $price = floatval($price);
    }
    return $price;
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



                  $xml = new SimpleXMLElement('<Scienergie_PieceCommerciale xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"/>');
    
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

    
}