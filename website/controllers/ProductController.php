<?php
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;



ini_set('display_errors', 1);
        error_reporting(E_ALL);

        //require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/urldef.php';
        //require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/LPNEntities.php';
        //require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/functions.php';


class ProductController extends Action
{
    
    public $response;

    public function init()
    {
        parent::init();
        
        //Set the response array
        $this->response = array(
            'msg' => 'Processing request...'
        );
    }


    public function indexAction() {
        $this->enableLayout();

        // get a list of news objects and order them by date
        $productList = new Object_Product_List();
        $conditionFilters = array("lENGTH(code)>0","ean is NULL");
        $productList->setCondition(implode(" AND ", $conditionFilters));

        //$catalogList->setOrderKey("date");
        $productList->setOrder("ASC");
        $productList->load();

        $paginator = Zend_Paginator::factory($productList);
        $paginator->setCurrentPageNumber( $this->_getParam('page') );
        $paginator->setItemCountPerPage(40);

        $this->view->products = $paginator;
    }


    public function detailAction() {

        $this->enableLayout();
        $this->setLayout("layout-lpn");

		$definition = Object_Class::getByName("Product")->getFieldDefinitions();
		
		

        // "id" is the named parameters in "Static Routes"
        $product = Object_Product::getById($this->getParam("id"));
        


        if(!$product instanceof Object_Product || !$product->isPublished()) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("invalid request");
        }

        $this->view->product = $product;
		//$this->view->attributes = $definition;

    }

    public function detailByEanAction() {

        $this->enableLayout();
        $this->setLayout("layout-produit");

        $definition = Object_Class::getByName("Product")->getFieldDefinitions();
        
        

        

        $productList = new Object_Product_List();
        $conditionFilters = array("ean = '" . $this->getParam("ean") . "' OR code = '" . $this->getParam("ean") . "'");

  

        //$catalogList->setOrderKey("date");
        $productList    ->setCondition(implode(" AND ", $conditionFilters))
                        ->setOrder("ASC")
                        ->getItems(0, 1);

        if($productList->count()>0) {
            // "id" is the named parameters in "Static Routes"
            $product = Object_Product::getById($productList->current()->getId());
        }

        


        if(!$product instanceof Object_Product || !$product->isPublished()) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("invalid request");
        }

        $this->view->product = $product;
        //$this->view->attributes = $definition;

    }


    public function detailIntraAction() {

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        

        $this->enableLayout();
        $this->view->layout()->setLayout("layout-ft");

        $definition = Object_Class::getByName("Product")->getFieldDefinitions();
        
        

        // "id" is the named parameters in "Static Routes"
        Object_Abstract::setHideUnpublished(false);
        $product = Object_Product::getById($this->getParam("id"));
        Object_Abstract::setHideUnpublished(true);
        


        if(!$product instanceof Object_Product) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("invalid request");
        }

        $this->view->product = $product;
        //$this->view->attributes = $definition;

    }

     public function detailFtAction() {

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");


        $this->enableLayout();
        $this->setLayout("layout-ft");
        $definition = Object_Class::getByName("Product")->getFieldDefinitions();
        

        // "id" is the named parameters in "Static Routes"
        try {
            Object_Abstract::setHideUnpublished(false);
            $product = Object_Product::getById($this->getParam("id"));
            Object_Abstract::setHideUnpublished(true);
        }
        catch (\Exception $e) {
           
        }
        
        


        if(!$product instanceof Object_Product) {
            // this will trigger a 404 error response
          
            throw new \Exception("product " . $this->getParam("id") . " doesn't exist.");
        }

        $this->view->product = $product;
        //$this->view->attributes = $definition;

    }

    //Fiche Produit
    public function detailFpAction() {

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->enableLayout();
        $this->view->layout()->setLayout("layout-ft");


        $definition = Object_Class::getByName("Product")->getFieldDefinitions();
        
        

        // "id" is the named parameters in "Static Routes"
        Object_Abstract::setHideUnpublished(false);
        $product = Object_Product::getById($this->getParam("id"));
        Object_Abstract::setHideUnpublished(true);
        


        if(!$product instanceof Object_Product) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("Product " . $this->getParam("id") . " doesn't exist.");
        }

        $this->view->product = $product;
        //$this->view->attributes = $definition;

    }

     //Fiche Produit
    public function detailPhotosAction() {

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");


        $this->enableLayout();
        $this->view->layout()->setLayout("layout-ft");

        $definition = Object_Class::getByName("Product")->getFieldDefinitions();
        
        

        // "id" is the named parameters in "Static Routes"
        $product = Object_Product::getById($this->getParam("id"));
        


        if(!$product instanceof Object_Product) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("Product " . $this->getParam("id") . " doesn't exist.");
        }

        $this->view->product = $product;
        //$this->view->attributes = $definition;

    }




    public function detailByChoixAction() {
        $this->enableLayout();

        // get a list of news objects and order them by date
        $productList = new Object_Product_List();

        
        $conditionFilters = array("choix LIKE '" . $this->getParam("choix") . "%'");

       

        $productList->setCondition(implode(" AND ", $conditionFilters));



        //$productList->setOrderKey("o_id");
        $productList->setOrder("DESC");
        $productList->load();



        $paginator = Zend_Paginator::factory($productList);
        $paginator->setCurrentPageNumber( $this->_getParam('page') );
        $paginator->setItemCountPerPage(20);


        $this->view->products = $paginator;


    }


    /**
     * Incoming request handler
     */
    public function routerAction()
    {
        try
        {
            $action = $this->_getParam("actionname") . 'Ajax';

            //Make sure the request is post and the requested method exist
            if(!method_exists($this, $action))
            {
                $this->_errorMsg('An application error has occured');
            }            
            
            //Call the requested method
            $this->response['msg'] = $this->$action($this->getParam("query"));
        }
        catch(Exception $e)
        {
            $this->response['msg']    = $e->getMessage();
            $this->response['errors'] = 1;
        }
        $this->_helper->json->sendJson($this->response);
    }


    public function autocompleteListAjax($query) {
        // get a list of news objects and order them by date
        $productList = new Object_Product_List();
        //$conditionFilters[] = array("lENGTH(code)>0","ean is NULL");

        $conditionFilters = array(
                "LOWER(name) LIKE LOWER('%" . $query . "%')",
                "lENGTH(code)>0",
                "(ean is NULL or lENGTH(ean)=0)"

            );


        $condition = "(".implode(" AND ", $conditionFilters).")";

        $condition .= " OR ean LIKE '" . $query . "%'";
        $productList->setCondition($condition);
        $productList->setLimit(15);




        $productList->load();
        $products=array();
        foreach ($productList as $product) {
            $router = Staticroute::getByName('id');
            $detailLink=$router->assemble(array('id' => $product->getId()));
             

            $name = trim(substr($product->getName(),0,150));
            //$name = $this->highlightWords($name,array($this->getParam("query")));
            //$name = htmlspecialchars($name);
            //$desc = strlen($product->getShort_description())>0?$product->getShort_description():"";
            $desc = $product->getCode()." ".$product->getDimensionsString();
            $products[]= array("id"=>$product->getId(),"name"=>$name,"code"=>$product->getCode(),"short"=>$desc,"link"=>$detailLink);

            

        }
        $this->response = $products;
        $this->_helper->json->sendJson($this->response);
    }

    public function highlightWords($string, $words)
 {
    foreach ( $words as $word )
    {
        $string = str_ireplace($word, '<span class="highlight_word">'.$word.'</span>', $string);
    }
    /*** return the highlighted string ***/
    return $string;
 }


    /**
     * Thrown an error and halt the process
     * 
     * @param string $msg 
     */
    protected function _errorMsg($msg)
    {
        throw new Exception($msg);
    }



    public function productArticleRenderletAction() {
       // echo "klklmklmkml".$this->getParam("id").$this->getParam("type");
        if($this->getParam("id") && $this->getParam("type") == "object") {
            $this->view->products = Object_Product::getById($this->getParam("id"));
        }
    }

    //http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp

    //http://pimcore.florent.local/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmppa/cc-pa/fbcheg4bicmnepa

    public function clean($str) {
        $str = str_replace("<br />", " - ", $str);
        $str = str_replace("\n", " - ", $str);
        $str = str_replace("\r", "", $str);
        $str = str_replace("\t", "", $str);
        $str = strip_tags($str);
        $str = trim($str);

        return $str;

    }

    //http://pim.laparqueterienouvelle.fr/?controller=product&action=export-product-tech&path=/catalogue/_product_base__/05contreco/tmp/cc-zp
    public function exportProductTechAction() {
        $this->disableLayout();
        $this->disableViewAutoRender();
        Object_Abstract::setHideUnpublished(false);


        $list = Object_Product::getList(array(
                'condition' => 'o_path LIKE \''.$this->getParam("path").'%\' AND ean IS NOT NULL',
                'unpublished' => true,
                'orderKey' => 'name',
        ));


       
        $childs = $list;
        $products = array();
       
        foreach($childs as $product){
           
            //OK on a toutes les categories parentes
            $products[] = $product;

            //On recupere la liste des produits par categories
            //On assigne les categories au produit
            //On fait un export des produits avec la liste des categories !

        }
        
       
        $idx = 0;
        $header=array();
        
        $rows = array();

        //On récupere toutes les entetes d'abord
        $header['actif'] = "Actif Web";
        $header['famille'] = "Famille";
        $header['ean'] = "EAN";
        $header['name'] = "Name";
        $header['url'] = "Url";
        $header['longueur_scienergie'] = "Longueur Scienergie";


        foreach ($products as $product) {

            if(strlen($product->ean)==0) {
                continue;
             }

            $caracteristiques =  $product->getCharacteristicsArray();


            foreach ($caracteristiques as $key => $value) {
                if(!is_array($value) || !isset($value["label"]) || isset($header[$key]))
                    continue; 

                try {
                    if(is_array($value) && isset($value["do_not_export"]) && $value["do_not_export"]) {
                        continue;
                    }
                     if(is_array($value) && isset($value["isOther"]) && $value["isOther"]) {
                        continue;
                    }
                    $header[$key] = ucfirst(trim($value["label"]));
                }
                catch (Exception $e) {

                }
            }
           


            $idx ++;
        }
        $header['image_1'] = "Image 1";
        $header['image_2'] = "Image 2";
        $header['image_3'] = "Image Z1";
        $header['image_4'] = "Image Z2";
        $header['image_texture'] = "Image Face";
        
        $idx = 0;
        foreach ($products as $product) {
             $row=array();
             

             if(strlen($product->ean)==0) {
                continue;
             }

             $caracteristiques =  $product->getCharacteristicsArray();

             $row[] = $product->getActif_web();
             $row[] = $product->getCode();
             $row[] = $product->getEan()."-";
             $row[] = $product->getMage_short_name(3000);;
             $row[] = 'https://pim.laparqueterienouvelle.fr/id/'.$product->getId();
             $row[] = $product->getLongueur();

             foreach ($header as $key => $title) {

                    if($key=='famille' || $key=='name' || $key=='url' || $key=='actif' || $key=='image_1' || $key=='image_2' || $key=='image_3' || $key=='image_4' || $key=='image_texture' || $key=='longueur_scienergie' || $key=='ean')
                        continue;

                    if(!isset($caracteristiques[$key])) {
                        $row[] = "";
                        continue;
                    }

                    

                    $value = $caracteristiques[$key];
                    //if(!isset($value["label"]))
                    //  continue; 
                    
                    
                    $content = $description = "";

                    if(isset($value["content"]) && strlen(trim($value["content"]))>0) {
                        $content = $this->clean($value["content"]);
                    }
                    if($key=="EAN")
                        $content .=" -";
                    $row[] = ucfirst($content);
                    
            }

            $row[] = ($product->getImage_1() && (string)$product->getImage_1()->getFilename() != "lpn-1l-pantone.gif") ?(string)$product->getImage_1()->getFilename():"";
            $row[] = ($product->getImage_2() && (string)$product->getImage_2()->getFilename() != "lpn-1l-pantone.gif")?(string)$product->getImage_2()->getFilename():"";
            $row[] = ($product->getImage_3() && (string)$product->getImage_3()->getFilename() != "lpn-1l-pantone.gif")?(string)$product->getImage_3()->getFilename():"";
            $row[] = ($product->getImage_4() && (string)$product->getImage_4()->getFilename() != "lpn-1l-pantone.gif")?(string)$product->getImage_4()->getFilename():"";
            $row[] = ($product->getImage_texture() && (string)$product->getImage_texture()->getFilename() != "lpn-1l-pantone.gif")?(string)$product->getImage_texture()->getFilename():"";
            
            $rows[]  = $row;
            $idx ++;
        }
       Object_Abstract::setHideUnpublished(true);


        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=export.csv');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        //echo "\xEF\xBB\xBF"; // UTF-8 BOM
        /*$disclosure="\t";
        $out = fopen('php://output', 'w');
        fputs($out, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
        fputcsv($out, $header,$disclosure);
        foreach ($rows as $row) {
            fputcsv($out,$row,$disclosure);
        }
        fclose($out);
        */
        $this->toCSV($header,$rows,"export");
        exit;

    }

    public  function toCSV($header, $data, $filename) {
        $sep  = "\t";
        $eol  = "\n";
        $csv  =  count($header) ? '"'. implode('"'.$sep.'"', $header).'"'.$eol : '';
        foreach($data as $line) {
          $csv .= '"'. implode('"'.$sep.'"', $line).'"'.$eol;
        }
        $encoded_csv = mb_convert_encoding($csv, 'UTF-16LE', 'UTF-8');
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.$filename.'.csv"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: '. strlen($encoded_csv));
        echo chr(255) . chr(254) . $encoded_csv;
        exit;
      }



    //http://pimcore.florent.local/ajax/jsonProductList/4416
    public function jsonProductListAjax($categoryId) {
        //$this->enableLayout();
        
        $categoryPath = Object_Category::getById($categoryId)->getFullPath();
        $list = Object_Category::getList(array(
                'limit' => 10,
                'condition' => 'o_path LIKE \''.$categoryPath.'%\''
      ));

       
        $childs = $list;
        $categories = array();
        foreach($childs as $child){
            //OK on a toutes les categories parentes
            $categories[] = $child->getFullPath();

            //On recupere la liste des produits par categories
            //On assigne les categories au produit
            //On fait un export des produits avec la liste des categories !

        }



        $this->response = $categories;
        $this->_helper->json->sendJson($this->response);
    }

    // http://pimcore.florent.local/ajax/jsonProductImages/3196
    public function jsonProductImagesAjax($productId) {
        $product  = Object_Product::getById($productId);
        $this->response =  $product->getMage_realisationsJson($includeProductImage=true,$includeProductName=true,$includeTumb=true);
        $this->response = Zend_Json::decode($this->response);
        $this->_helper->json->sendJson($this->response);
    }

    // http://pimcore.florent.local/ajax/jsonProductImages/3196
    public function jsonProductImagesByEanAjax($ean) {
        $list = Object_Product::getList(array(
                    'limit' => 1,
                    'condition' => 'ean = \''.$ean.'\''
                    ));

        $product = $list->current();
        //print_r($product);
        if(!$product) {

            $list = Object_Product::getList(array(
            'limit' => 1,
            'condition' => 'code = \''.$ean.'\''
            ));
            $product = $list->current();
        }
        if($product){

            $this->jsonProductImagesAjax($product->getId());
        }
    }

    // http://pimcore.florent.local/ajax/jsonProductStockByEan/6303002861800
    public function jsonProductStockByEanAjax($ean) {
        
        try {
            $svc = new LPNEntities(LPN_SERVICE_URL); 
            $query = getQuery($svc,"ean-stock",$ean,0,false); 
            $response = $query->Execute();
            do
                {
                if($nextProductToken != null)  {            
                    $response = $svc->Execute($nextProductToken);
                }
                 $stockResponse=array();
                 $stockResponse["total_dispo"] = 0;
                 $stockResponse["total_commande"] = 0;
                 $stockResponse["dispo"] =false;

                



                 $stockResponse["data"] = array();

                 foreach($response->Result as $Stock)
                    {

                        $qty = $nombre = $Stock->Nombre;


                        $colisage = floatval(str_replace(",",".",$Stock->CATALOGUE_EAN[0]->Colisage))
                        ;

                        if($colisage && $colisage>0 && $colisage!=1)
                            $qty = $nombre * $colisage; 


                        if(!isset($stockResponse["product"]))
                            $stockResponse["product"] = $Stock->CATALOGUE_EAN[0];
                        
                        $p = array();
        
                        //$stockResponse["data"][$Stock->Code_Depot] = array();
                        $stockResponse["data"][$Stock->Code_Depot] = $qty;
                        $stockResponse["data"][$Stock->Code_Depot."-nombre"] = $nombre;
                        $stockResponse["data"][$Stock->Code_Depot."-colisage"] = $colisage;

                      if(stristr($Stock->Code_Depot, "C")!==false) {
                         $stockResponse["total_commande"] += -$qty;
                      }
                      else {
                        $stockResponse["total_dispo"] += $qty;
                      }

                     

                }
                $stockResponse["dispo"] = $stockResponse["total_dispo"] >0;

                $this->response =  $stockResponse;
                $this->_helper->json->sendJson($this->response);
            }
            while(($nextProductToken = $response->GetContinuation()) != null);

        }
        catch(DataServiceRequestException $ex)
        {
                echo 'Error: while running the query ' . $ex->Response->getQuery();
                echo "<br/>";
                echo $ex->Response->getError();        
        }
        catch (ODataServiceException $e)
        {
            print_r($e);
             echo "Error:" . $e->getError() . "<br>" . "Detailed Error:" . $e->getDetailedError();
        }
        catch (InternalError $e)
        {
            print_r($e);
             echo "Error:" . $e->getError() . "<br>" . "Detailed Error:" . $e->getDetailedError();
        }
        if($product){

            $this->jsonProductImagesAjax($product->getId());
        }
    }

    public function printDepotLabelAction() {
        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->enableLayout();
        $this->setLayout("layout-mauchamp-etiquette");

        $definition = Object_Class::getByName("Product")->getFieldDefinitions();

        

        // "id" is the named parameters in "Static Routes"
        $productId = $this->getParam("id");
        $productEan = $this->getParam("ean");

        $this->view->format =  $this->getParam("format");


        //Commande
        if(stripos($productEan,"c")===0) {
             $order = \Website\Tool\MauchampHelper::loadAzureOrder($productEan);
             //print_r($order);
             //die;
             if(isset($order))
                $this->view->order = $order;
            else {
                $this->view->ean = $productEan;
               $this->view->message = array('danger','Commande '.$productEan.' inconnue');
            }

        }
        else if (stripos($productEan,"f")===0) {
            
            $order = \Website\Tool\MauchampHelper::loadAzureInvoice($productEan);
             //print_r($order);
             //die;
             if(isset($order)) {
                $order->Code_Commande = $order->Code_Piece;
                $order->Reference_Client = $order->Reference_Client_Lies;
                $order->Adresse_Facturation_Raison_Sociale = $order->Adresse_Facturation_Nom;

                $this->view->order = $order;
            }
            else {
                $this->view->ean = $productEan;
               $this->view->message = array('danger','Facture '.$productEan.' inconnue');
            }
        }




        else if(isset($productId) && strlen($productId)>0) {
            $product = Object_Product::getById($this->getParam("id"));
             if(!$product instanceof Object_Product) {


                echo "Produit inexistant";
                die;
                // this will trigger a 404 error response
                //throw new \Zend_Controller_Router_Exception("invalid request");
            }
            $this->view->product = $product;
        }


        else if(isset($productEan)  && strlen($productEan)>0 ) {
             Object\AbstractObject::setHideUnpublished(false);
             $existingProductList = Object_Product::getByEan($productEan,['unpublished' => true]);

             if($existingProductList->count()>=1) {
              $existingProducts = $existingProductList->getObjects();
              foreach ($existingProducts as $existingProduct) {
                if($existingProduct->ean == $sku) {
                  $product   = $existingProduct;
                  break;
                }
              }
            }


             
             if(!$product instanceof Object_Product) {

                //On va chercher dans AZURE
                //echo "loadAzureProduct".$productEan;
                $productValues = \Website\Tool\MauchampHelper::loadAzureProduct($productEan);
                
                
                if(!is_array($productValues)) {

                    // this will trigger a 404 error response
                //throw new \Zend_Controller_Router_Exception("invalid request");
                    $this->view->ean = $productEan;
                    $this->view->message = array('danger','EAN '.$productEan.' Inconnu');
                }
                else {
                    $product = new Website_Product();
                    $product->setValues($productValues); 
                    $this->view->product = $product;
                }


                
            }
            else {
                //echo "load Pim Product".$productEan;
                $this->view->product = $product;
            }
        }
        //$this->view->attributes = $definition;

    }

    //http://pimcore.florent.local/?controller=product&action=get-short-ajax&id=1
    public function getShortAjaxAction() {
        ini_set('max_execution_time', 3600);
        ini_set('max_input_time', 3600);
        ini_set("max_execution_time", 3600);
        set_time_limit(3600);

        ini_set('mysql.connect_timeout', 300);
        ini_set('mysql.default_socket_timeout',300);

        @ini_set("memory_limit", "2024M");

         $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->disableLayout();
        $this->disableViewAutoRender();
        Object_Abstract::setHideUnpublished(false);

   

        $productId = $this->getParam("id");
        $productEan = $this->getParam("ean");


        $productIds = explode(",", $productId);
        $productEans = explode(",", $productEan);

        $products = [];
        if(count($productIds) > 0) {
            //S'il yn a bcp dr'IDS, on chunk la grosse requette pouir éviter le timeout
            $idsGrouped = array_chunk($productIds, 50); // array

            foreach ($idsGrouped as $group) {
                 $products = array_merge($this->getProductShortByIds($group),$products);
                 
            }
           
        }
        else  if(count($productEans) > 0) {
              //S'il yn a bcp dr'IDS, on chunk la grosse requette pouir éviter le timeout
            $idsGrouped = array_chunk($productEans, 50); // array

            foreach ($idsGrouped as $group) {
                 $products = array_merge($this->getProductShortByIds(null,$group),$products);
                 
            }
        }
        
       
        // $products["condtion"] = $condition 

        header('Content-Type: application/json');
        echo json_encode($products);
        die;

       // $this->response = $products;
       // $this->_helper->json->sendJson($this->response);
    }

    public function getProductShortByIds($productIds = array()) {
        // get a list of news objects and order them by date
        $productList = new Object_Product_List();
        //$conditionFilters[] = array("lENGTH(code)>0","ean is NULL");
    

        $conditionFilters = array(
                "lENGTH(code)>0",
                //"(ean = '".$productEan."' OR oo_id = '".$productId."')",
               // "(ean IN (".$productEan.") OR oo_id = '".$productId."')",

            );

        $productIds2 = [];
        if(count($productIds) > 0) {
            foreach ($productIds as $key => $value) {
                if(strlen(trim($value)) > 0)
                    $productIds2[] = "'".$value."'";
            }
            if(count($productIds2)> 0) {
                $conditionFilters[] = "(oo_id IN (".implode(",", $productIds2).") OR ean IN (".implode(",", $productIds2)."))";
            }
        }
         else {
            return [];
        }



        $condition = "(".implode(" AND ", $conditionFilters).")";

      
        $productList->setCondition($condition);
        $productList->load();
        $products=array();
         //Object_Abstract::setGetInheritedValues(true); 
        foreach ($productList as $product) {
           $products[] = $product->getShortArray();

        }
        return $products;

    }

    



}
