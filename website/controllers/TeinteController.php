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
        $teinteList = new Object_Teinte_List();
        $conditionFilters = array("lENGTH(code)>0","ean is NULL");
     

        $teinteList->setCondition(implode(" AND ", $conditionFilters));

        //$catalogList->setOrderKey("date");
        $teinteList->setOrder("ASC");
        $teinteList->load();

        $paginator = Zend_Paginator::factory($teinteList);
        $paginator->setCurrentPageNumber( $this->_getParam('page') );
        $paginator->setItemCountPerPage(40);

        $this->view->teintes = $paginator;
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

        $list = new Object_Teinte_List();
        $conditionFilters = array(
            "o_path LIKE '/teintes/teintes/_import_%' OR o_path LIKE '/teintes/teintes/bambou%' OR o_path LIKE '/teintes/teintes/placage%' OR o_path LIKE '/teintes/teintes/stratifie%'");

        $list->setCondition(implode(" AND ", $conditionFilters));

        //$catalogList->setOrderKey("date");
        $list->setOrder("ASC");
        $list->setUnpublished(true);
        $list->load();
        


        $this->view->teintes = $list->getObjects();

    }

    //http://pimcore.florent.local/?controller=teinte&action=get-short-ajax&ean=615340927
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

   

        $teinteId = $this->getParam("id");

        $teinteIds = explode(",", $teinteId);

        $teintes = [];

        
        if(count($teinteIds) > 0) {
            //S'il yn a bcp dr'IDS, on chunk la grosse requette pouir éviter le timeout
            $idsGrouped = array_chunk($teinteIds, 50); // array

            foreach ($idsGrouped as $group) {
                 $teintes = array_merge($this->getTeinteShortByIds($group),$teintes);
                 
            }
           
        }
      

        header('Content-Type: application/json');
        echo json_encode($teintes);
        die;

    }

    public function getTeinteShortByIds($teinteIds = array()) {
        // get a list of news objects and order them by date
        $teinteList = new Object_Teinte_List();
        //$conditionFilters[] = array("lENGTH(code)>0","ean is NULL");

     

        $conditionFilters = array(
                "lENGTH(name)>0",
                //"(ean = '".$teinteEan."' OR oo_id = '".$teinteId."')",
               // "(ean IN (".$teinteEan.") OR oo_id = '".$teinteId."')",

            );

        $teinteIds2 = [];
        if(count($teinteIds) > 0) {
            foreach ($teinteIds as $key => $value) {
                if(strlen(trim($value)) > 0)
                    $teinteIds2[] = "'".$value."'";
            }
            if(count($teinteIds2)> 0) {
                $conditionFilters[] = "(oo_id IN (".implode(",", $teinteIds2)."))";
            }
        }
        else {
            return [];
        }

        $condition = "(".implode(" AND ", $conditionFilters).")";

        print_r($condition);
        die;

        $teinteList->setCondition($condition);
   
         

        $teinteList->load();

        $teintes=array();
         //Object_Abstract::setGetInheritedValues(true); 
        foreach ($teinteList as $teinte) {
           $teintes[] = $teinte->getShortArray();

        }
        return $teintes;

    }

    


}
