<?php

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

    


}
