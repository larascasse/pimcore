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
    
  

/*
   [codePiece] =&gt; FCA789789XXX
    [clientName] =&gt; Berenger
    [clientPhone] =&gt; 0661845372
    [clientAddress] =&gt; 5 rue de Provence
    [clientZip] =&gt; 75009
    [clientCity] =&gt; Paris
    [depot] =&gt; lpn75020qs
    [vendor] =&gt; MRsqdqsdqSqs
    [price] =&gt; 50
    [carrierName] =&gt; LABOULLE!!!qsdsqdqsd
    [quoteNumber] =&gt; 1212121212888
    [trackingNumber] =&gt; qsdqsdsqdqsdq
    [shippingDate] =&gt; Pimcore\Date Object
    [reglement] =&gt; PAYEqsd
    */
    public static function buildTransportObjectFromOrderXml($xmlOrder) {
 
      $order = \Website\Tool\MauchampHelper::parseOrder($xmlOrder);


      $products = $order["allProducts"];
      $orderDetail = $order["orderDetail"];

      $transportRowXml = $order["transport"][0];

      $transport =  $object = new Object\Transport;

      $transport->setValue('codePiece',$orderDetail["Code_Commande"]);

      //FACTURATION
      $transport->setValue('clientName',$orderDetail["Adresse_Facturation_Nom"]);

      //adresse
      $adresse = $orderDetail["Adresse_Facturation_Adr1"];
      if(trim($orderDetail["Adresse_Facturation_Adr2"]) != "")
        $adresse .= " / ".$orderDetail["Adresse_Facturation_Adr2"];
      $transport->setValue('clientAddress',$adresse);

      $transport->setValue('clientZip',$orderDetail["Adresse_Facturation_CP"]);
      $transport->setValue('clientCity',$orderDetail["Adresse_Facturation_Ville"]);
      
      if(strlen($orderDetail["Adresse_Facturation_Portable"])>5)
        $transport->setValue('clientPhone',$orderDetail["Adresse_Facturation_Portable"]);

      else if(strlen($orderDetail["Adresse_Facturation_Telephone"])>5)
        $transport->setValue('clientPhone',$orderDetail["Adresse_Facturation_Telephone"]);

      $transport->setValue('clientEmail',$orderDetail["Adresse_Facturation_Email"]);



      //SHIPPING
      if(strlen($orderDetail["Adresse_Livraison_Adr1"])>0) {

            //adresse
          $adresse = $orderDetail["Adresse_Livraison_Adr1"];
          if(trim($orderDetail["Adresse_Livraison_Adr2"]) != "")
            $adresse .= " / ".$orderDetail["Adresse_Livraison_Adr2"];
          $transport->setValue('shippingAddress',$adresse);

          $transport->setValue('shippingZip',$orderDetail["Adresse_Livraison_CP"]);
          $transport->setValue('shippingCity',$orderDetail["Adresse_Livraison_Ville"]);

      }
      else {
         
          $transport->setValue('shippingtName',$orderDetail["Adresse_Facturation_Nom"]);
          
          //adresse
          $adresse = $orderDetail["Adresse_Facturation_Adr1"];
          if(trim($orderDetail["Adresse_Facturation_Adr2"]) != "")
            $adresse .= " / ".$orderDetail["Adresse_Facturation_Adr2"];
          $transport->setValue('shippingAddress',$adresse);

          $transport->setValue('shippingZip',$orderDetail["Adresse_Facturation_CP"]);
          $transport->setValue('shippingCity',$orderDetail["Adresse_Facturation_Ville"]);

      }


      if(strlen($orderDetail["Adresse_Livraison_Portable"])>5) 
        $transport->setValue('shippingPhone',$orderDetail["Adresse_Livraison_Portable"]);

      else if(strlen($orderDetail["Adresse_Livraison_Telephone"])>5)
        $transport->setValue('shippingPhone',$orderDetail["Adresse_Livraison_Telephone"]);

      else if(strlen($orderDetail["Adresse_Facturation_Portable"])>5)
        $transport->setValue('shippingPhone',$orderDetail["Adresse_Facturation_Portable"]);

      else {
        $transport->setValue('shippingPhone',$orderDetail["Adresse_Facturation_Telephone"]);
      }

      if(strlen($orderDetail["Adresse_Livraison_Email"])>5)
        $transport->setValue('shippingEmail',$orderDetail["Adresse_Livraison_Email"]);
      else {
        $transport->setValue('shippingEmail',$orderDetail["Adresse_Facturation_Email"]);
      }


      //OTHER
      if(strlen($orderDetail["Code_Depot"])>0)
        $transport->setValue('depot',$orderDetail["Code_Depot"]);
      elseif ($orderDetail["Site"] == 75020) {
        $transport->setValue('depot',"PARIS");
      }
      else {
        $transport->setValue('depot',"CARRIERES");
      }
      
      $transport->setValue('vendor',$orderDetail["Representant2_Nom"]);
      
      $transport->setValue('carrierName',$transportRowXml->Code_Article);

      $transport->setValue('price',$transportRowXml->Prix_HT);
      $transport->setValue('reglement',$orderDetail["Reglement"]);
      


       return $transport;
  
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

      if(!isset($client->Nom_Contact) || !is_string($client->Nom_Contact) || strlen($client->Nom_Contact) == 0) {
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
      $rawProducts = array();


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
          'Code_Depot' => (string)$xml->Code_Depot,
          
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
        $shippingAmountHT = 0;
        if( $lines ) {
            $itemsCount = 0;
            
            for($i=0; $i<$lines->count(); $i++){


                
                $p = $lines[$i];
                $rawProducts[] = $p;

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
                            $existingProductList = Object\Product::getByEan($sku,['unpublished' => true]);

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
         	"rawProducts"=> $rawProducts,
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
    catch (Exception $e) {

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
    catch (Exception $e) {

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

    $sites["95870"] = $sites["78420"] = array (
        "name" => "La Parqueterie Nouvelle - Bezons",
        "address1" => "25 rue Salvador Allendé",
        "address2" => "",
        "zipcode" => "95870",
        "city" => "Bezons",
        "phone" => "01 34 11 11 35"
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
        else if(stristr($product->getFamille(),'revplaca')) {
          $words["sol plaqué"] = true;
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
        else if(stristr($product->getFamille(),'revplaca')) {
          $words["sol plaqué"] = true;
          //$words["parquet"] = true;
        }
  
      }

      $sortedWords = array_replace(array_flip(array("parquet","terrasse","bardage","table","vinyl","sol plaqué","stratifié","accessoires")), $words);

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



    public static function getDebugOrder() {
      $data = <<<EOT
<?xml version="1.0" encoding="utf-8"?><Scienergie_PieceCommerciale xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><Type_Piece>Commande</Type_Piece><Code_Commande>CCA182861</Code_Commande><Code_Commande_Web /><Code_Client>MLBCONCEPT</Code_Client><Date_Livraison>2019-01-04T00:00:00</Date_Livraison><Date_Confirmation>2019-01-04T00:00:00</Date_Confirmation><Date_Expedition>2019-01-04T00:00:00</Date_Expedition><Acompte>5000.000</Acompte><Remise>0.000</Remise><Type_Remise>%</Type_Remise><TotalHT>28026.44</TotalHT><TotalTTC>33631.730</TotalTTC><Site>95870</Site><Remarque><![CDATA[RAPPEL  POUR TOUS LES CLIENTS EN COMPTE IL EST IMPORTANT DE NOTER QUE TOUTES LES COMMANDES SPECIALES SERONT FACTUREES DANS LE MOIS DE RECEPTION DANS NOS ENTREPOTS ET PRELEVEES SELON LES MODALITES DE REGLEMENT SIGNEES PAR VOS SOINS]]></Remarque><Mode_livraison /><Moyen_Paiement /><Reference_Client><![CDATA[]]></Reference_Client><Etat>1</Etat><Reglement>PAYE</Reglement><Indice_Code_Prix>3</Indice_Code_Prix><Representant>CT</Representant><Representant_Email><![CDATA[cedric@lp-nouvelle.fr]]></Representant_Email><Representant_Nom><![CDATA[CEDRIC]]></Representant_Nom><Representant_Prenom><![CDATA[TAVERNON]]></Representant_Prenom><Representant_Portable>0631335665</Representant_Portable><Representant_Tel>0631335665</Representant_Tel><Representant2>CT</Representant2><Representant2_Email><![CDATA[cedric@lp-nouvelle.fr]]></Representant2_Email><Representant2_Nom><![CDATA[CEDRIC]]></Representant2_Nom><Representant2_Prenom><![CDATA[TAVERNON]]></Representant2_Prenom><Representant2_Portable>0631335665</Representant2_Portable><Representant2_Tel>0631335665</Representant2_Tel><Adresse_Facturation_Ville>MONTFORT L AMAURY</Adresse_Facturation_Ville><Adresse_Facturation_Nom><![CDATA[MLB CONCEPT]]></Adresse_Facturation_Nom><Adresse_Facturation_Code_Pays>FR</Adresse_Facturation_Code_Pays><Adresse_Facturation_Fax>01 34 86 94 75</Adresse_Facturation_Fax><Adresse_Facturation_Raison_Sociale><![CDATA[MLB CONCEPT]]></Adresse_Facturation_Raison_Sociale><Adresse_Facturation_CP>78490</Adresse_Facturation_CP><Adresse_Facturation_Adr1 /><Adresse_Facturation_Adr2>10 rue de sancé</Adresse_Facturation_Adr2><Adresse_Facturation_Adr3 /><Adresse_Facturation_Telephone>01 34 86 99 98</Adresse_Facturation_Telephone><Adresse_Facturation_Portable /><Adresse_Facturation_Email><![CDATA[carole@mlbconcept.fr]]></Adresse_Facturation_Email><Adresse_Livraison_Ville /><Adresse_Livraison_Telephone /><Adresse_Livraison_Portable /><Adresse_Livraison_Nom><![CDATA[]]></Adresse_Livraison_Nom><Adresse_Livraison_Code_Pays /><Adresse_Livraison_Fax /><Adresse_Livraison_Raison_Sociale><![CDATA[]]></Adresse_Livraison_Raison_Sociale><Adresse_Livraison_CP /><Adresse_Livraison_Adr1 /><Adresse_Livraison_Adr2 /><Adresse_Livraison_Adr3 /><Adresse_Livraison_Email><![CDATA[]]></Adresse_Livraison_Email><Lignes><Ligne><Ordre>4</Ordre><Code_Article>MPCHEG0BDBBR0AM</Code_Article><Code_EAN_Article>112210490001</Code_EAN_Article><Nombre>132.000</Nombre><Quantite_Unite>271.656</Quantite_Unite><Prix_HT>99.00000</Prix_HT><Pourc_Remise>0.00</Pourc_Remise><Taux_TVA>20.00</Taux_TVA><Observation><![CDATA[]]></Observation><Designation><![CDATA[PARQUET MASSIF PAVE EN BOIS DE BOUT CHENE BRUT - (Attention necessite un controle rigoureux de la temperature et de l' hygrometrie pour ne pas risquer une variation dimensionnelle du bois)
]]></Designation></Ligne><Ligne><Ordre>5</Ordre><Code_Article>AJ00000PDBJCRAM</Code_Article><Code_EAN_Article>JCR5</Code_EAN_Article><Nombre>15.000</Nombre><Quantite_Unite>15.000</Quantite_Unite><Prix_HT>35.50000</Prix_HT><Pourc_Remise>0.00</Pourc_Remise><Taux_TVA>20.00</Taux_TVA><Observation><![CDATA[]]></Observation><Designation><![CDATA[ACCESSOIRE JOINT DE COMPRESSION ROSE POUR PAVE EN BOIS DE BOUT POSE FLOTTANTE OU COLLEE]]></Designation></Ligne><Ligne><Ordre>6</Ordre><Code_Article>CC00000PU0000SI</Code_Article><Code_EAN_Article>7612894763287</Code_EAN_Article><Nombre>150.000</Nombre><Quantite_Unite>150.000</Quantite_Unite><Prix_HT>4.00000</Prix_HT><Pourc_Remise>0.00</Pourc_Remise><Taux_TVA>20.00</Taux_TVA><Observation><![CDATA[]]></Observation><Designation><![CDATA[COLLE CORDON MONOCOMPOSANTE POLYURETHANE ADHEFLEX SIKA ECO SANS EMANATION DE COV]]></Designation></Ligne></Lignes></Scienergie_PieceCommerciale>

EOT;
    return $data;
    }


  public static function getDebugOrder2() {
      $data = <<<EOT
<?xml version="1.0" encoding="utf-8"?><Scienergie_PieceCommerciale xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><Type_Piece>Devis</Type_Piece><Code_Commande>CP180698XXX</Code_Commande><Code_Commande_Web /><Date_Livraison>2018-04-12T00:00:00 02:00</Date_Livraison><Date_Confirmation xsi:nil="true" /><Date_Expedition>2018-04-12T00:00:00</Date_Expedition><Acompte>0.000</Acompte><Remise>0.000</Remise><Type_Remise>%</Type_Remise><TotalHT>11085.21</TotalHT><TotalTTC>13302.250</TotalTTC><Site>78420</Site><Remarque><![CDATA[]]></Remarque><Mode_livraison /><Moyen_Paiement /><Reference_Client><![CDATA[Projet Douglas Monaco - PRO]]></Reference_Client><Etat>31</Etat><Reglement>PAYE</Reglement><Representant>DR</Representant><Representant_Email><![CDATA[damien@lp-nouvelle.fr]]></Representant_Email><Representant_Nom><![CDATA[Romeo]]></Representant_Nom><Representant_Prenom><![CDATA[Damien]]></Representant_Prenom><Representant_Portable>0608248865</Representant_Portable><Representant_Tel>0608248865</Representant_Tel><Representant2>DR</Representant2><Representant2_Email><![CDATA[damien@lp-nouvelle.fr]]></Representant2_Email><Representant2_Nom><![CDATA[Romeo]]></Representant2_Nom><Representant2_Prenom><![CDATA[Damien]]></Representant2_Prenom><Representant2_Portable>0608248865</Representant2_Portable><Representant2_Tel>0608248865</Representant2_Tel><Adresse_Facturation_Ville>MONACO</Adresse_Facturation_Ville><Adresse_Facturation_Nom><![CDATA[ETB  MONACO]]></Adresse_Facturation_Nom><Adresse_Facturation_Code_Pays>FR</Adresse_Facturation_Code_Pays><Adresse_Facturation_Fax /><Adresse_Facturation_Raison_Sociale><![CDATA[ETB  MONACO]]></Adresse_Facturation_Raison_Sociale><Adresse_Facturation_CP>98000</Adresse_Facturation_CP><Adresse_Facturation_Adr1 /><Adresse_Facturation_Telephone /><Adresse_Facturation_Email><![CDATA[etb@monaco.mc]]></Adresse_Facturation_Email><Adresse_Livraison_Ville>MONACO</Adresse_Livraison_Ville><Adresse_Livraison_Nom><![CDATA[ETB  MONACO]]></Adresse_Livraison_Nom><Adresse_Livraison_Code_Pays>FR</Adresse_Livraison_Code_Pays><Adresse_Livraison_Fax /><Adresse_Livraison_Raison_Sociale><![CDATA[ETB  MONACO]]></Adresse_Livraison_Raison_Sociale><Adresse_Livraison_CP>98000</Adresse_Livraison_CP><Adresse_Livraison_Adr1 /><Adresse_Livraison_Adr2>12 CHEMIN DE LA TURBIE</Adresse_Livraison_Adr2><Adresse_Livraison_Email><![CDATA[etb@monaco.mc]]></Adresse_Livraison_Email><Lignes><Ligne><Ordre>3</Ordre><Code_Article>FVDGLG2SELBR0PN</Code_Article><Code_EAN_Article>0001212502000</Code_EAN_Article><Nombre>85.000</Nombre><Quantite_Unite>85.000</Quantite_Unite><Prix_HT>109.41000</Prix_HT><Pourc_Remise>0.00</Pourc_Remise><Taux_TVA>20.00</Taux_TVA><Observation><![CDATA[]]></Observation><Designation><![CDATA[PARQUET CONTRECOLLE MONOLAME DOUGLAS G2 SELECT BRUT - FSC - LONGUEURS VARIABLES DE 2000MM A 5000MM. EPAISSEUR 21MM*LARGEUR 250MM* EPAISSEUR PAREMENT 5MM.]]></Designation></Ligne><Ligne><Ordre>5</Ordre><Code_Article>AF00000PCUWRBFL</Code_Article><Code_EAN_Article>5708055003124</Code_EAN_Article><Nombre>5.000</Nombre><Quantite_Unite>5.000</Quantite_Unite><Prix_HT>34.96000</Prix_HT><Pourc_Remise>0.00</Pourc_Remise><Taux_TVA>20.00</Taux_TVA><Observation><![CDATA[]]></Observation><Designation><![CDATA[ACCESSOIRE FINITION PRE-COUCHE ANTI-UV POUR TERRASSE ET AVANT HUILAGE POUR LE PARQUET DOUGLAS  ( CONSO 20M2 PAR BIDON )]]></Designation></Ligne><Ligne><Ordre>6</Ordre><Code_Article>AF00000HDONATFL</Code_Article><Code_EAN_Article>5708055015080</Code_EAN_Article><Nombre>3.000</Nombre><Quantite_Unite>3.000</Quantite_Unite><Prix_HT>129.28000</Prix_HT><Pourc_Remise>0.00</Pourc_Remise><Taux_TVA>20.00</Taux_TVA><Observation><![CDATA[]]></Observation><Designation><![CDATA[ACCESSOIRE FINITION HUILE NATURELLE DIAMOND OIL POUR DOUGLAS - SANS COV (APPLICATION EN UNE COUCHE A LA MONOBROSSE) - CONSOMMATION 25m²/L]]></Designation></Ligne><Ligne><Ordre>7</Ordre><Code_Article>AF00000SAVBL0FL</Code_Article><Code_EAN_Article>5708055003759</Code_EAN_Article><Nombre>1.000</Nombre><Quantite_Unite>1.000</Quantite_Unite><Prix_HT>22.72000</Prix_HT><Pourc_Remise>0.00</Pourc_Remise><Taux_TVA>20.00</Taux_TVA><Observation><![CDATA[]]></Observation><Designation><![CDATA[ACCESSOIRE FINITION ENTRETIEN SAVON BLANC POUR DOUGLAS
]]></Designation></Ligne><Ligne><Ordre>9</Ordre><Code_Article>TRANSPORT</Code_Article><Code_EAN_Article /><Nombre>1.000</Nombre><Quantite_Unite>1.000</Quantite_Unite><Prix_HT>1200.00000</Prix_HT><Pourc_Remise>0.00</Pourc_Remise><Taux_TVA>20.00</Taux_TVA><Observation><![CDATA[]]></Observation><Designation><![CDATA[TRANSPORT EN DIRECT USINE - CLIENT DE 85m2 DE PARQUET DOUGLAS - LARGEUR 250MM- LONGUEURS VARIABLES 2000MM A 5000MM.]]></Designation></Ligne></Lignes></Scienergie_PieceCommerciale>

EOT;
    return $data;
    }


    public static function getDebugFacture() {
      $data = <<<EOT
<?xml version="1.0" encoding="utf-8"?>
<Scienergie_PieceCommerciale xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
    <Type_Piece>Commande</Type_Piece>
    <Code_Commande>CP180698</Code_Commande>
    <Code_Commande_Web />
    <Date_Livraison>2018-04-20T00:00:00</Date_Livraison>
    <Date_Confirmation>2018-04-20T00:00:00</Date_Confirmation>
    <Date_Expedition>2018-04-20T00:00:00</Date_Expedition>
    <Acompte>901.780</Acompte>
    <Remise>0.000</Remise>
    <Type_Remise>%</Type_Remise>
    <TotalHT>1502.97</TotalHT>
    <TotalTTC>1803.560</TotalTTC>
    <Site>75020</Site>
    <Remarque><![CDATA[]]></Remarque>
    <Mode_livraison />
    <Moyen_Paiement />
    <Reference_Client><![CDATA[]]></Reference_Client>
    <Etat>1</Etat>
    <Reglement>PAYE</Reglement>
    <Representant />
    <Representant_Email><![CDATA[]]></Representant_Email>
    <Representant_Nom><![CDATA[]]></Representant_Nom>
    <Representant_Prenom><![CDATA[]]></Representant_Prenom>
    <Representant2>SL</Representant2>
    <Representant2_Email><![CDATA[sophie@lp-nouvelle.fr]]></Representant2_Email>
    <Representant2_Nom><![CDATA[Lancereau]]></Representant2_Nom>
    <Representant2_Prenom><![CDATA[Sophie]]></Representant2_Prenom>
    <Representant2_Portable />
    <Representant2_Tel>0140305555</Representant2_Tel>
    <Adresse_Facturation_Ville>PARIS</Adresse_Facturation_Ville>
    <Adresse_Facturation_Nom><![CDATA[GREENDECOR]]></Adresse_Facturation_Nom>
    <Adresse_Facturation_Code_Pays>FR</Adresse_Facturation_Code_Pays>
    <Adresse_Facturation_Fax>01 53 02 95 60</Adresse_Facturation_Fax>
    <Adresse_Facturation_Raison_Sociale><![CDATA[GREENDECOR]]></Adresse_Facturation_Raison_Sociale>
    <Adresse_Facturation_CP>75012</Adresse_Facturation_CP>
    <Adresse_Facturation_Adr1 />
    <Adresse_Facturation_Telephone>01 53 02 95 65</Adresse_Facturation_Telephone>
    <Adresse_Facturation_Email><![CDATA[dchmielewski@green-decor.fr]]></Adresse_Facturation_Email>
    <Adresse_Livraison_Ville>PARIS</Adresse_Livraison_Ville>
    <Adresse_Livraison_Nom><![CDATA[]]></Adresse_Livraison_Nom>
    <Adresse_Livraison_Fax />
    <Adresse_Livraison_Raison_Sociale><![CDATA[]]></Adresse_Livraison_Raison_Sociale>
    <Adresse_Livraison_CP>75011</Adresse_Livraison_CP>
    <Adresse_Livraison_Adr1>11 RUE DES COMMINES</Adresse_Livraison_Adr1>
    <Adresse_Livraison_Adr2 />
    <Adresse_Livraison_Email><![CDATA[]]></Adresse_Livraison_Email>
    <Lignes>
        <Ligne>
            <Ordre>4</Ordre>
            <Code_Article>TMBCOFI000GISSV</Code_Article>
            <Code_EAN_Article>3760102972120</Code_EAN_Article>
            <Nombre>25.000</Nombre>
            <Quantite_Unite>13.800</Quantite_Unite>
            <Prix_HT>61.35000</Prix_HT>
            <Pourc_Remise>0.00</Pourc_Remise>
            <Taux_TVA>20.00</Taux_TVA>
            <Observation><![CDATA[]]></Observation>
            <Designation><![CDATA[TERRASSE MONOLAME BOIS COMPOSITE TEINTE GRIS IROISE PROFIL STRUCTURE FIXATION INVISIBLE  - PEFC - (Longueur fixe: 4000mm)]]></Designation>
        </Ligne>
        <Ligne>
            <Ordre>5</Ordre>
            <Code_Article>TMBCOFI000GISSV</Code_Article>
            <Code_EAN_Article>3760102975480</Code_EAN_Article>
            <Nombre>2.000</Nombre>
            <Quantite_Unite>1.440</Quantite_Unite>
            <Prix_HT>61.33000</Prix_HT>
            <Pourc_Remise>0.00</Pourc_Remise>
            <Taux_TVA>20.00</Taux_TVA>
            <Observation><![CDATA[]]></Observation>
            <Designation><![CDATA[TERRASSE MONOLAME BOIS COMPOSITE TEINTE GRIS IROISE PROFIL STRUCTURE FIXATION INVISIBLE  - PEFC - (Longueur fixe: 4000mm)]]></Designation>
        </Ligne>
        <Ligne>
            <Ordre>7</Ordre>
            <Code_Article>TABAN00LBELCCSF</Code_Article>
            <Code_EAN_Article>940652823000</Code_EAN_Article>
            <Nombre>14.000</Nombre>
            <Quantite_Unite>42.000</Quantite_Unite>
            <Prix_HT>5.28000</Prix_HT>
            <Pourc_Remise>0.00</Pourc_Remise>
            <Taux_TVA>20.00</Taux_TVA>
            <Observation><![CDATA[]]></Observation>
            <Designation><![CDATA[TERRASSE ACCESSOIRE LAMBOURDE BANKIRAI - MERBAU LAMELLE COLLE - COLLAGE D4 S4S- RABOTE 4  FACES (CONSO 3ML/M2)]]></Designation>
        </Ligne>
        <Ligne>
            <Ordre>9</Ordre>
            <Code_Article>TABCO00VICGIRSV</Code_Article>
            <Code_EAN_Article>3760102977422</Code_EAN_Article>
            <Nombre>3.000</Nombre>
            <Quantite_Unite>3.000</Quantite_Unite>
            <Prix_HT>22.72000</Prix_HT>
            <Pourc_Remise>0.00</Pourc_Remise>
            <Taux_TVA>20.00</Taux_TVA>
            <Observation><![CDATA[]]></Observation>
            <Designation><![CDATA[TERRASSE ACCESSOIRE VIS COMPOSITE GRIS IROISE / GRIS CLAIR (Boite de 150)]]></Designation>
        </Ligne>
        <Ligne>
            <Ordre>10</Ordre>
            <Code_Article>TABCO00CLS000SV</Code_Article>
            <Code_EAN_Article>3760102970058</Code_EAN_Article>
            <Nombre>7.000</Nombre>
            <Quantite_Unite>7.000</Quantite_Unite>
            <Prix_HT>17.09000</Prix_HT>
            <Pourc_Remise>0.00</Pourc_Remise>
            <Taux_TVA>20.00</Taux_TVA>
            <Observation><![CDATA[]]></Observation>
            <Designation><![CDATA[TERRASSE ACCESSOIRE CLIP COMPOSITE SIMPLE ET VIS INOX  ( CONSO 18/M2 )]]></Designation>
        </Ligne>
        <Ligne>
            <Ordre>11</Ordre>
            <Code_Article>TABCO00CDF000SV</Code_Article>
            <Code_EAN_Article>3760102970171</Code_EAN_Article>
            <Nombre>1.000</Nombre>
            <Quantite_Unite>1.000</Quantite_Unite>
            <Prix_HT>8.47000</Prix_HT>
            <Pourc_Remise>0.00</Pourc_Remise>
            <Taux_TVA>20.00</Taux_TVA>
            <Observation><![CDATA[]]></Observation>
            <Designation><![CDATA[TERRASSE ACCESSOIRE CLIP COMPOSITE DEBUT ET FIN  ET VIS INOX BOITE DE 10.]]></Designation>
        </Ligne>
        <Ligne>
            <Ordre>13</Ordre>
            <Code_Article>TRPRPLABOULLE</Code_Article>
            <Code_EAN_Article />
            <Nombre>1.000</Nombre>
            <Quantite_Unite>1.000</Quantite_Unite>
            <Prix_HT>150.00000</Prix_HT>
            <Pourc_Remise>0.00</Pourc_Remise>
            <Taux_TVA>20.00</Taux_TVA>
            <Observation><![CDATA[]]></Observation>
            <Designation><![CDATA[TRANSPORT  PAR SEVENT COURSES EXPRESS  PARIS / REGION PARISIENNE  -      AU BAS DU CAMION      -       SANS MANUTENTION    ]]></Designation>
        </Ligne>
    </Lignes>
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




    
}