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

          if($configurable)
              $params["configurable"] = 1;
	    	
	    	  $content = \Pimcore\Tool::getHttpData($url,$params);

          // Pour le workflow management,
          // On va mettre à jour tous le produits mpour dire qu'ils ont été synchronisés.
          //TODO : on ne gere pas les erreur ...
          $products = [$product];


          if($withChildren) {
            //On va chercher tous les enfants
              $list = new Pimcore\Model\Object\Product\Listing();
              $list->setCondition("o_path LIKE '" . $product->getRealFullPath() . "/%'");
              //$productIds[] = "o_path LIKE '" . $relatedProduct->getRealFullPath() . "/%'";
              $childrens = $list->load();

              foreach ($childrens as $simpleProduct) {

                  $products[] = $simpleProduct;
              }
          }

          \Pimcore::getEventManager()->trigger('lpn.magento.postSynchro',$products);
	    	
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

        //http://pimcore.florent.local/plugin/LpnMageSync/index/publish-cms-block/key/XXXXXXX

    public function publishCmsBlockAction() {


    	  $this->disableLayout();

       	  $this->disableViewAutoRender();

       	  $key =  $this->getParam("key");
          $real =  $this->getParam("real");


       	  $url = 'https://www.laparqueterienouvelle.fr/LPN/sync_pim_document.php';
       	  $params = array();
		  $params["time"] = time();

        if($key && strlen($key)>0)
		      $params["key"] = $key;
        else if($real && strlen($real)>0)
          $params["real"] = $real;


	    	$content = \Pimcore\Tool::getHttpData($url,$params);
	    	
    	  $this->response = array(
    	  	"success" => "true", 
    	  	"content"=>$content,
    	  	"message"=>$content,
    	  	"url" => $url,
    	  	//"params" =>implode(",",array_keys($params)),
    	  	"params" =>serialize($params)

    	  );
       	  
        $this->_helper->json->sendJson($this->response);
       	  	
    	 
    }

 


}
