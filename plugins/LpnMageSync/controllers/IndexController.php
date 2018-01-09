<?php


class LpnMageSync_IndexController extends \Pimcore\Controller\Action\Admin
{
    public function indexAction()
    {

        // reachable via http://your.domain/plugin/LpnMageSync/index/index
    }


    //http://pimcore.florent.local/plugin/LpnMageSync/index/publish-to-Magento
    public function publishToMagentoAction() {


    	  $this->disableLayout();

       	  $this->disableViewAutoRender();

       	  $product = Object_Product::getById($this->getParam("id"));

       	  $withChildren = $this->getParam("withChildren");
       	  $configurable = $this->getParam("configurable");

       	  $create = $this->getParam("create");

       	  if(!$product instanceof Object_Product) {
       	  	 $this->response = array("message"=>"Produit inconnu");
       	  }
       	  
       	  else {
       	  	  $url = "https://www.laparqueterienouvelle.fr/LPN/get_a_product_magmi.php";
	    	  $params = array();

	    	  $params["time"] = time();

	    	  if($withChildren) {
	    	  	$params["path"] = $product->getFullPath();

	    	  	if($configurable)
	    	  		$params["configurable"] = 1;
	    	  	//else if($simple)
	    	  	//	$params["simple"] = 1;
	    	  	
	    	  }
	    	  else if(strlen($product->getEan())>0) {
	    	  	$params["ean"] = $product->getEan();
	    	  }
	    	  else if(strlen($product->getCode())>0) {
	    	  	$params["code"] = $product->getCode();
	    	  }

	    	  if($create) {
	    	  	$params["create"] = 1;
	    	  }
	    	
	    	  $content = \Pimcore\Tool::getHttpData($url,$params);
	    	
	    	  $this->response = array(
	    	  	"success" => "true", 
	    	  	"content"=>$content,
	    	  	"message"=>$content,
	    	  	"url" => $url,
	    	  	//"params" =>implode(",",array_keys($params)),
	    	  	"params" =>serialize($params)

	    	  );

	          

       	  }
       	  $this->_helper->json->sendJson($this->response);
       	  	
    	 
    }

    //http://pimcore.florent.local/plugin/LpnMageSync/index/load-magento-client/email/florent@lesmecaniques.net
    public function loadMagentoClientAction() {
    	 $this->disableLayout();
		$this->disableViewAutoRender();

    	$email = $this->getParam("email");

    	 
    	$customer = \Website\Tool\MagentoHelper::loadMagentoCustomer($email);
    	 $this->response = array(
	    	  	"success" => "true", 
	    	  	"customer"=>$customer

	    	  );

    	$this->_helper->json->sendJson($this->response);
    }

    //http://pimcore.florent.local/plugin/LpnMageSync/index/load-magento-client/email/florent@lesmecaniques.net
    public function createMagentoClientAction() {
    	$this->disableLayout();
		$this->disableViewAutoRender();
		
    	$xml = $this->getParam("xml");

    	$data = Pimcore\Tool::getHttpData('http://magento.florent.local/LPN/create_customer.php',null,["xml"=>$xml]);

    	$response = $this->getResponse();
        $response->setHeader('Content-Type', 'application/json', true);
        $response->setBody($data);
        $response->sendResponse();
        exit;
    	 

    }


}
