<?php

ini_set('display_errors', 1);
//error_reporting(E_ALL);
require_once PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/urldef.php';
require_once PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/LPNEntities.php';
require_once PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/functions.php';


use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

class LpnController extends Action
{
    public function init() {
        parent::init();

        // do something on initialization //-> see Zend Framework

        // in our case we enable the layout engine (Zend_Layout) for all actions
        $this->enableLayout();
    }

    public function defaultAction() {
        $this->view->layout()->setLayout("layout-lpn");
        $this->enableLayout();
    }

    public function blankAction() {
        $this->view->layout()->setLayout("layout_blank");
        $this->enableLayout();
    }

    public function magentoAction() {
        $this->view->layout()->setLayout("layout_magento");
        $this->enableLayout();
    }

    public function magentov2Action() {
        $this->view->layout()->setLayout("layout-lpnv2");
        $this->enableLayout();
    }

     public function algoliaAction() {
        $this->view->layout()->setLayout("layout-algolia");
        $this->enableLayout();
    }

    public function getAllPagesAction() {
        $this->view->layout()->setLayout("layout-empty");
         $this->disableLayout();

        $this->disableViewAutoRender();

        $listing = new \Pimcore\Model\Document\Listing(); 
        $listing->setCondition("parentId = 236");
        $pages=array();
        foreach($listing as $doc) {
            //echo $doc->getContent();
            try {
                /*
                [id] => 6559
    [modificationDate] => 1485954241
    [key] => parquet
    [path] => /projets/
    [meta] => 
    [mage_identifier] => /projets/parquet.html
    [name] => 
    [content]
    [posterImage]
    [description]
    */
                if($doc instanceOf Document\Page) {
                    $page = array (
                        "content" => Document\Service::render($doc),
                        "description" => $doc->getDescription(),
                        "id"            => $doc->getId(),
                        "name"            => $doc->getName(),
                        "key"            => $doc->getKey(),
                        "url"            => $doc->getPrettyUrl(),
                        "title"            => $doc->getTitle(),
                    );
                     $pages[] = $page;
                }
            }
            catch (Exception $e){
                echo $e->getMessage();
            }
            
        }
       $this->response = $pages;
        $this->_helper->json->sendJson($this->response);
    }


    public function getAllCmsBlocksAction() {
        $this->view->layout()->setLayout("layout-empty");
         $this->disableLayout();

        $this->disableViewAutoRender();

        $listing = new \Pimcore\Model\Document\Listing(); 
       // $listing->setCondition("parentId = 230");
        $listing->setCondition('path LIKE \'/cms-block/%\'');
        $pages=array();
        foreach($listing as $doc) {
            //echo $doc->getContent();
            try {
                /*
                [id] => 6559
    [modificationDate] => 1485954241
    [key] => parquet
    [path] => /projets/
    [meta] => 
    [mage_identifier] => /projets/parquet.html
    [name] => 
    [content]
    [posterImage]
    [description]
    */
                if($doc instanceOf Document\Page) {
                    $page = array (
                        "content" => Document\Service::render($doc),
                        "description" => $doc->getDescription(),
                        "id"            => $doc->getId(),
                        "name"            => $doc->getName(),
                        "key"            => $doc->getKey(),
                        "url"            => $doc->getPrettyUrl(),
                        "title"            => $doc->getTitle(),
                    );
                     $pages[] = $page;
                }
            }
            catch (Exception $e){
                echo $e->getMessage();
            }
            
        }
       $this->response = $pages;
        $this->_helper->json->sendJson($this->response);
    }




    public function contactFormAction() {
        $success = false;

        // getting parameters is very easy ... just call $this->getParam("yorParamKey"); regardless if's POST or GET
        if($this->getParam("firstname") && $this->getParam("lastname") && $this->getParam("email")) {
            $success = true;

            $mail = new Pimcore_Mail();
            $mail->setIgnoreDebugMode(true);

            // To is used from the email document, but can also be set manually here (same for subject, CC, BCC, ...)
            //$mail->addTo("bernhard.rusch@pimcore.org");

            $emailDocument = $this->document->getProperty("email");
            if(!$emailDocument) {
                $emailDocument = Document::getById(38);
            }

            $mail->setDocument($emailDocument);
            $mail->setParams($this->getAllParams());
            $mail->send();
        }

        // do some validation & assign the parameters to the view
        foreach (array("firstname", "lastname", "email") as $key) {
            if($this->getParam($key)) {
                $this->view->$key = htmlentities(strip_tags($this->getParam($key)));
            }
        }

        // assign the status to the view
        $this->view->success = $success;
    }


    public function objectFormAction() {

        $success = false;

        // getting parameters is very easy ... just call $this->getParam("yorParamKey"); regardless if's POST or GET
        if($this->getParam("firstname") && $this->getParam("lastname") && $this->getParam("email") ) {
            $success = true;

            // for this example the class "person" and "inquiry" is used
            // first we create a person, then we create an inquiry object and link them together

            // check for an existing person with this name
            $person = Object_Person::getByEmail($this->getParam("email"),1);

            if(!$person) {
                // if there isn't an existing, ... create one
                $filename = Pimcore_File::getValidFilename($this->getParam("email"));

                // first we need to create a new object, and fill some system-related information
                $person = new Object_Person();
                $person->setParent(Object_Abstract::getByPath("/crm")); // we store all objects in /crm
                $person->setKey($filename); // the filename of the object
                $person->setPublished(true); // yep, it should be published :)

                // of course this needs some validation here in production...
                $person->setGender($this->getParam("gender"));
                $person->setFirstname($this->getParam("firstname"));
                $person->setLastname($this->getParam("lastname"));
                $person->setEmail($this->getParam("email"));
                $person->setDateRegister(Zend_Date::now());
                $person->save();
            }




            // now we create the inquiry object and link the person in it
            $categoryKey = Pimcore_File::getValidFilename(Zend_Date::now()->get(Zend_Date::DATETIME_MEDIUM) . "~" . $person->getEmail());
            $category = new Object_Category();
            $category->setParent(Object_Abstract::getByPath("/client-page")); // we store all objects in /inquiries
            $category->setKey($categoryKey); // the filename of the object
            $category->setPublished(true); // yep, it should be published :)

            //echo $this->getParam("ean");
            $eans = explode("\n",$this->getParam("ean"));
            $myMultihrefElements = array();
            foreach($eans as $ean) {
                $ean = trim($ean);
                $product = Object_Product::getByEan($ean,1);
            
            ;
               // print_r($products);
                if($product) {
                    $myMultihrefElements[] = $product;
                }

            }

           $category->setProducts($myMultihrefElements);
            
             

            // now we fill in the data
            //$category->setMessage($this->getParam("message"));
            $category->setPerson($person);


            $category->setDate(Zend_Date::now());
           // $inquiry->setTerms((bool) $this->getParam("terms"));
            

            $category->save();


            //Document

                // if there isn't an existing, ... create one
                $documentKey = $categoryKey;




                // first we need to create a new object, and fill some system-related information
                $document = new Document_Page();
                $document->setParent(Document_Page::getByPath("/clients-page")); // we store all objects in /crm
                $document->setKey($documentKey); // the filename of the object
                $document->setPublished(true); // yep, it should be published :)
                $document->setName($this->getParam("firstname")." ".$this->getParam("lastname")); // yep, it should be published :)
                $document->setTitle($this->getParam("firstname")." ".$this->getParam("lastname")); // yep, it should be published :)




                $document->setUserOwner(1);
                $document->setUserModification(1);
                $document->setCreationDate(time());

                $document->setProperty("leftNavHide","bool",true);



                // of course this needs some validation here in production...
                $document->setController("lpn");
                $document->setAction("default");



                try {
                    $document->save();
                }
               catch (Exception $e) {
                // something went wrong: eg. limit exceeded, wrong configuration, ...
                Logger::err($e);
                echo $e->getMessage();exit;
                }
                
   

                $string='{
  "headTitle": {
    "data": "",
    "type": "input"
  },
  "headDescription": {
    "data": "",
    "type": "input"
  },
  "headline": {
    "data": "Votre sélection de produits La Parqueterie Nouvelle",
    "type": "input"
  },
  "content": {
    "data": [
      {
        "key": "1",
        "type": "category-product"
      }
    ],
    "type": "areablock"
  },
  "headlinecontent1": {
    "data": "Bonjour '.$this->getParam("gender").' '.$this->getParam("firstname").' '.$this->getParam("lastname").'",
    "type": "input"
  },
  "leadcontent1": {
    "data": '.Zend_Json::encode("<p>".$this->getParam("message")."</p>").',
    "type": "wysiwyg"
  },
  "categoriescontent1": {
    "data": {
      "id": '.$category->getId().',
      "type": "object",
      "subtype": "object",
      "controller": "category",
      "action": "category-product-renderlet",
      "height": 100,
      "name": "pimcore_editable_categoriescontent1_editable",
      "border": false,
      "bodyStyle": "min-height: 40px;",
      "pimcore_parentDocument": '.$document->getId().'
    },
    "type": "renderlet"
  }
}';            

                ; 
               
               try {
                    $data = Zend_Json::decode($string);
                }
               catch (Exception $e) {
                // something went wrong: eg. limit exceeded, wrong configuration, ...
                Logger::err($e);
                echo $e->getMessage();
                echo $string;
                exit;
                }

               

                

                foreach ($data as $name => $value) {
                    $data = $value["data"];
                    $type = $value["type"];
                    $document->setRawElement($name, $type, $data);
                 }

                

                 try {
                    $document->save();
                }
               catch (Exception $e) {
                // something went wrong: eg. limit exceeded, wrong configuration, ...
                Logger::err($e);
                    echo $e->getMessage();exit;
                }

                $this->view->documentUrl = $document->getFullPath();

                try {
                 $mail = new Pimcore_Mail();
                 $mail->setIgnoreDebugMode(true);
                 //$this-addParam("message","Merci pour votre visite !");

                 $this->params["message"] = "Merci pour votre visite !";
                 // To is used from the email document, but can also be set manually here (same for subject, CC, BCC, ...)
                 //$mail->addTo("bernhard.rusch@pimcore.org");

                //$emailDocument = $this->document->getProperty("email");
                //if(!$emailDocument) {
                    $emailDocument = Document::getById(38);
                //}

                    /*
                    $optionalParams = array('foo' => 'bar', 'hum'=>'bug');
$useLayout = true;
$content = Document_Service::render(Document::getById(2), $optionalParams, $useLayout);
echo $content;
*/

                $mail->setDocument($document);
                $mail->setParams($this->getAllParams());

                $mail->clearRecipients();

                $mail->addTo($this->getParam("email"),$this->getParam("firstname").' '.$this->getParam("lastname"));
                $mail->setSubject("Votre sélection La Parqueterie Nouvelle");

                $mail->clearFrom();
                $mail->setFrom("florent@lesmecaniques.net");

               
                $mail->send();

           

                }
               catch (Exception $e) {
                // something went wrong: eg. limit exceeded, wrong configuration, ...
                Logger::err($e);
                echo $e->getMessage();exit;
                }




                //$areaBlock = Document_Tag_AreaBlock::factory("areablock", "1", $document->getId());
                //$document->setElement($name, $areaBlock);

                //$document->setElements(array)

           // }

           

        } else if ($this->getRequest()->isPost()) {
            $this->view->error = true;
        }

        // do some validation & assign the parameters to the view
        foreach (array("firstname", "lastname", "email", "message","ean") as $key) {
            if($this->getParam($key)) {
                $this->view->$key = htmlentities(strip_tags($this->getParam($key)));
            }
        }

        // assign the status to the view
        $this->view->success = $success;
    }

    public function apiAction ()
{
    $sku = $this->_getParam('sku');
    if (!$sku) {
        throw new Zend_Controller_Router_Exception('Missing "sku" parameter from request.');
    }
    $products = Object_MagentoBaseProduct::getBySku($sku);
    $product = $products->current();
    if (!$product) {
        throw new Zend_Controller_Router_Exception('Unable to find the product object based on the provided "sku" value.');
    }
            $images = array();
            if ($product->getBase()) {
                $images['base'] =  array(
                    'filename' => $product->getImage_1()->getFilename(),
                    'path' => $product->getImage_1()->getPath(),
                    'src' => $product->getImage_1()->getThumbnail('magento_base'),
                    'mimetype' => $product->getImage_1()->getMimetype(),
                );
            }
            if ($product->getThumbnail()) {
                $images['thumbnail'] =  array(
                    'filename' => $product->getImage_2()->getFilename(),
                    'path' => $product->getImage_2()->getPath(),
                    'src' => $product->getImage_2()->getThumbnail('magento_thumbnail'),
                    'mimetype' => $product->getImage_2()->getMimetype(),
                );
            }
            if ($product->getSmall()) {
                $images['small'] =  array(
                    'filename' => $product->getImage_3()->getFilename(),
                    'path' => $product->getImage_3()->getPath(),
                    'src' => $product->getImage_3()->getThumbnail('magento_small'),
                    'mimetype' => $product->getImage_3()->getMimetype(),
                );
            }
            $galleryImages = @$product->getGallery()->getItems();
            if ($galleryImages) {
                foreach ($galleryImages as $imgObj) {
                    $image = $imgObj->getImage();
                    $images['gallery'][] = array(
                        'filename' => $image->getFilename(),
                        'path' => $image->getPath(),
                        'src' => $image->getThumbnail('magento_small'),
                        'mimetype' => $image->getMimetype(),
                    );
                    unset($image);
                }
            }
            /* image url is like: http://pimcore.loc/website/var/assets/{path}{filename} */
            $response = array(
                'sku' => $sku,
                'images' => $images,
            );
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

    public function searchAction () {
        
        $this->enableLayout();
        $this->view->layout()->setLayout("layout-search");
        /*if ($this->getParam("q")) {
            try {
                $page = $this->getParam('page');
                if (empty($page)) {
                    $page = 1;
                }
                $perPage = 10;

                $result = Pimcore_Google_Cse::search($this->getParam("q"), (($page - 1) * $perPage), null, [
                    "cx" => "002859715628130885299:baocppu9mii"
                ], $this->getParam("facet"));

                $paginator = Zend_Paginator::factory($result);
                $paginator->setCurrentPageNumber($page);
                $paginator->setItemCountPerPage($perPage);
                $this->view->paginator = $paginator;
                $this->view->result = $result;
            } catch (Exception $e) {
                // something went wrong: eg. limit exceeded, wrong configuration, ...
                Logger::err($e);
                echo $e->getMessage();exit;
            }
        }*/
    }

    public function mauchampAction() {

        $this->view->layout()->setLayout("layout-mauchamp");

         //$svc = $svc = new LPNEntities(LPN_SERVICE_URL);
        //$query = getQuery($svc,"order",$this->getParam("code_commande"));
        //$response = $query->Execute();


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
        $xml = $this->getParam('xml');
        if(isset($xml))
            $data = $xml;
        
        
        
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

                $tauxTVA = floatval($this->convertFloat($p->Taux_TVA));
                $tauxTVA = $tauxTVA<1?$tauxTVA*100:$tauxTVA;
                $ratioTVA = 1+($tauxTVA/100);
                
                if(strpos($p->Code_Article, 'TR')===0) {
                
                    $price = floatval($this->convertFloat($p->Prix_HT));
                    $shippingAmountHT += $price;
                    if($price>0) {
                        $transport = $p;
                    }
                    $transportRows[] = $p;
                    
                }
                else {      
                    $itemsCount++;      
                    //Quand revient de Azure, prendre Qté unité !! et pas NNombre
                    $qty = floatval($this->convertFloat($p->Quantite_Unite));

                    $price = floatval($this->convertFloat($p->Prix_HT));
                    $rowTotal = $price*$qty;
                    
                    $productTypeId  = 'simple';
                    $productName    = $p->Code_EAN_Article;
                    $productSku     = $p->Code_EAN_Article;
                    
                    if(strlen($p->Designation)>1 && strlen($p->Code_EAN_Article)<1){
                        
                        $productName = $p->Designation;
                    }
                
                    
                    

                    //Ligne avec article    
                    else if(strlen($p->Code_EAN_Article)>1) {

                        $qty = floatval($this->convertFloat($p->Quantite_Unite));

                        $price = floatval($this->convertFloat($p->Prix_HT));
                        $rowTotal = $price*$qty;


                        try {
                        
                            $sku = trim($p->Code_EAN_Article);             
                            $existingProductList = Object_Product::getByEan($sku);
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
            $this->view->products = $products;
            $this->view->missingProducts = $missingProducts;
            $this->view->transport = $transportRows;
    }


    public function mauchampTestAction() {
        //"CCA172694"
        $this->view->layout()->setLayout("layout-mauchamp");
        $codecommande = $this->getParam('codecommande');
        if(!isset($codecommande)) {
            $this->view->codecommande="";
            return;
        }

        $this->view->codecommande=$codecommande;
        $svc = $svc = new LPNEntities(LPN_SERVICE_URL);
        $query = getQuery($svc,"order",$codecommande);//$this->getParam("code_commande"));
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
                          "Remise"              => $this->convertFloat($orderAzure->Remise),
                          "TypeRemise"          => $orderAzure->Type_Remise,   //toujours montant de remise, pas de %

                          "TotalHT"             => $this->convertFloat($orderAzure->TotalHT),
                          "TotalTTC"            => $this->convertFloat($orderAzure->TotalTTC),

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


                $xml = new SimpleXMLElement('<Scienergie_PieceCommerciale xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"/>');

                
  
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
      
        if(isset($xml)) {
            $this->view->xml =  $xml;
        }


    }

    public function log($error,$error_type='') {
        echo $message;
    }


    public function convertFloat($price) {
    //$this->_formatStr('%.2F'
    if($price>0) {
      $price = str_replace(",", ".", $price);
      $price = floatval($price);
    }
    return $price;
  }

    


}
