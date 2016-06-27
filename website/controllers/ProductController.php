<?php

ini_set('display_errors', 1);
        error_reporting(E_ALL);

        require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/urldef.php';
        require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/LPNEntities.php';
        require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/functions.php';


class ProductController extends Website_Controller_Action
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

        $this->enableLayout();
        $this->setLayout("layout-produit");

        $definition = Object_Class::getByName("Product")->getFieldDefinitions();
        
        

        // "id" is the named parameters in "Static Routes"
        $product = Object_Product::getById($this->getParam("id"));
        


        if(!$product instanceof Object_Product) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("invalid request");
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


                        $colisage = $Stock->CATALOGUE_EAN[0]->Colisage;

                        if($colisage && $colisage>0 && $colisage!=1)
                            $$qty = $nombre * $colisage; 


                        if(!isset($stockResponse["product"]))
                            $stockResponse["product"] = $Stock->CATALOGUE_EAN[0];
                        
                        $p = array();
        
                        //$stockResponse["data"][$Stock->Code_Depot] = array();
                        $stockResponse["data"][$Stock->Code_Depot] = $$qty;
                        $stockResponse["data"][$Stock->Code_Depot."-nombre"] = $nombre;

                      if(stristr($Stock->Code_Depot, "C")!==false) {
                         $stockResponse["total_commande"] += -$qty;
                      }
                      else {
                        $stockResponse["total_dispo"] += $$qty;
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

    



}
