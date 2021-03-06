<?php

use Pimcore\Logger;

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

          $teinte = $this->getParam("teinte");
          $withChildren = $this->getParam("withChildren");
          $configurable = $this->getParam("configurable");
          $queueMode = $this->getParam("queueMode");
          $create = $this->getParam("create");

          if($teinte) {
            
            $product = Object_Teinte::getById($this->getParam("id"));
             if(!$product instanceof Object_Teinte) {
              $this->_helper->json->sendJson($this->response = array("message"=>"Teinte inconnue"));
             return;
            }
          }
          else {

            $product = Object_Product::getById($this->getParam("id"));
             if(!$product instanceof Object_Product) {
              $this->_helper->json->sendJson($this->response = array("message"=>"Produit inconnu"));
             return;
            }


          }


          //$url = "https://www.laparqueterienouvelle.fr/LPN/get_a_product_magmi.php";
     	  
          //DEV
          $url = "http://shopdev.laparqueterienouvelle.fr/LPN/get_a_product_magmi.php";


            
            $content = "";


              // Pour le workflow management,
            // On va mettre à jour tous le produits mpour dire qu'ils ont été synchronisés.
            //TODO : on ne gere pas les erreur ...
            $products = [$product];


            if($withChildren && !$teinte) {
              //On va chercher tous les enfants
                $list = new Pimcore\Model\Object\Product\Listing();
                $list->setCondition("o_path LIKE '" . $product->getRealFullPath() . "/%'");
                //$productIds[] = "o_path LIKE '" . $relatedProduct->getRealFullPath() . "/%'";
                $childrens = $list->load();

                foreach ($childrens as $simpleProduct) {
                    if(strlen($simpleProduct->getSku())>0)
                      $products[] = $simpleProduct;
                }
            }



  	    	  $params = array();

  	    	  $params["time"] = time();

  	    	  if($withChildren || $teinte) {
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

            if($teinte)
              $params["teinte"] = 1;

       
            $params["queueMode"] = $queueMode;

        
            //si plus de XXX prodiots, pour empecher le timeout
            if(!$teinte && ($queueMode || count($products) > 30)) {
              $content .= "***** QUEUE MODE ****** ";
      
              $returnValueContainer = new \Pimcore\Model\Tool\Admin\EventDataContainer(array());


               //On fait un SQL direct pour aller plus vite, surtout pour le batch
              $tryQuickMode = true;

              \Pimcore::getEventManager()->trigger('lpn.azure.postUpdate',$products,[
                    "returnValueContainer" => $returnValueContainer,
                    "tryQuickMode" => $tryQuickMode
                ]);

               $workflowReturn = $returnValueContainer->getData();

               //print_r($workflowReturn);

              if(is_array($workflowReturn) && isset($workflowReturn["message"])) {
                  //echo "T".$workflowReturn["message"]."\n";
                  $content .= $workflowReturn["message"];
                }
                else {
                  //print_r($workflowReturn);
                }

            }
            else {
              $content = \Pimcore\Tool::getHttpData($url,$params);


                if(!$teinte) {
                     /*Logger::debug("Start wrokflow upfate",$products);
                    echo "Start wrokflow upfate".count($products).$products[2]->getMage_name();
                    die;*/
                    $returnValueContainer = new \Pimcore\Model\Tool\Admin\EventDataContainer(array());

                    \Pimcore::getEventManager()->trigger('lpn.magento.postSynchro',$products,[
                          "returnValueContainer" => $returnValueContainer
                      ]);

                   

                    if(is_array($workflowReturn) && isset($workflowReturn["message"])) {
                      $content .= $workflowReturn["message"];
                    }
                }

            }


           
  	    	
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

    public function publishCategoryAction() {


        $this->disableLayout();

          $this->disableViewAutoRender();

          $key =  $this->getParam("key");


          $url = 'http://shopdev.laparqueterienouvelle.fr/LPN/get_all_categories.php';
          $params = array();
          $params["time"] = time();

        if($key && strlen($key)>0)
          $params["key"] = $key;
        



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


    public function publishTaxonomiesAction() {


    	  $this->disableLayout();

       	  $this->disableViewAutoRender();

       	  $key =  $this->getParam("key");


       	  $url = 'http://shopdev.laparqueterienouvelle.fr/LPN/sync_pim_taxonomies.php';
       	  $params = array();
		      $params["time"] = time();

        if($key && strlen($key)>0)
		      $params["key"] = $key;
        



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
