<?php
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;



//ini_set('display_errors', 1);
//error_reporting(E_ALL);

        //require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/urldef.php';
        //require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/LPNEntities.php';
        //require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/functions.php';


class TeinteController extends Action
{
    
    public $response;

    public function init()
    {
        parent::init();
        
        //Set the response array
        /*$this->response = array(
            'msg' => 'Processing request...'
        );*/
    }


    public function indexAction() {
        $this->enableLayout();

        // get a list of news objects and order them by date
        $productList = new Object_Teinte_List();
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

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");

        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->enableLayout();
        $this->setLayout("layout-mauchamp");


		$definition = Object_Class::getByName("Teinte")->getFieldDefinitions();
		
		

        // "id" is the named parameters in "Static Routes"
        $teinte = Object_Teinte::getById($this->getParam("id"));
        


        if(!$teinte instanceof Object_Teinte /*|| !$product->isPublished()*/) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("invalid request");
        }

        $this->view->teinte = $teinte;
        $this->view->products = $teinte->getProductsArticle();
		//$this->view->attributes = $definition;

    }

    


}
