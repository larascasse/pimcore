<?php


class LpnMageSync_FrontController extends \Pimcore\Controller\Action
{
    public function indexAction()
    {

        // reachable via http://your.domain/plugin/LpnMageSync/index/index
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

    //http://pimcore.florent.local/plugin/LpnMageSync/index/create-magento-client/email/florent@lesmecaniques.net
    public function createMagentoClientAction() {
    	$this->disableLayout();
		$this->disableViewAutoRender();
		
    	$xml = $this->getParam("xmlclient");

        $data = \Website\Tool\MagentoHelper::createMagentoCustomer($xml);

    	$response = $this->getResponse();
        $response->setHeader('Content-Type', 'application/json', true);
        $response->setBody($data);
        $response->sendResponse();
        exit;
    	 

    }


}
