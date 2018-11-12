<?php

ini_set('display_errors', 1);
//error_reporting(E_ALL);



use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

class TaxonomyController extends Action
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

    


    //http://pimcore.florent.local/?action=get-all-taxonomys&controller=lpn
    public function getAllAction() {
      

       /* $listing = new \Pimcore\Model\Article\Listing(); 

        $key =  $this->getParam("key");
       // $listing->setCondition("parentId = 230");
        $listing->setCondition('o_path LIKE \'/taxonomys/%\'');
*/

        $this->disableLayout();

        $this->disableViewAutoRender();

        $conditionFilters = array(//"limit" => $items,
            "order" => "DESC",
            "orderKey" => "o_creationdate",
            'unpublished' => true,

        );
        $conditionFilters[] =array('o_path LIKE \'/taxonomies/%\'');


         $key =trim ($this->getParam("key")) ;

       if (strlen($this->getParam("key"))>0) {
           
            $conditionFilters[] = array("o_key LIKE '" . $this->getParam("key") . "'");
        }
        
        $listing = Object\Taxonomy::getList($conditionFilters);
      
        $taxonomys=array();
   
     
        foreach($listing as $taxonomy) {
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
                if($taxonomy instanceOf Website_Taxonomy) {


                    if(strlen($key)>0 && $key != $taxonomy->getKey() ) {
                       continue;
                    }
                    //print_r($taxonomy);
                    $taxonomys[] = $taxonomy->getShortArray();
                }
            }
            catch (Exception $e){
                echo $e->getMessage();
            }
            
        }

       $this->response = $taxonomys;
       $this->_helper->json->sendJson($this->response);
    }



   

    public function log($error,$error_type='') {
        echo $message;
    }


}
