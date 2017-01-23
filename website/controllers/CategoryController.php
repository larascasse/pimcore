<?php 

use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

class CategoryController extends Action
{
    public function indexAction() {
         $this->enableLayout();

        // get a list of news objects and order them by date
        $list = new Object_Category_List();
        //$list->setCondition(implode(" AND ", $conditionFilters));

        //$catalogList->setOrderKey("date");
        $list->setOrder("ASC");
        $list->load();

        $paginator = Zend_Paginator::factory($list);
        $paginator->setCurrentPageNumber( $this->_getParam('page') );
        $paginator->setItemCountPerPage(40);

       
        $this->view->categories = $paginator;


    }

    public function detailAction() {
        $this->enableLayout();
        echo $this->getParam("id");
        $definition = Object_Class::getByName("Category")->getFieldDefinitions();
        
        

        // "id" is the named parameters in "Static Routes"
        $category = Object_Category::getById($this->getParam("id"));

        if(!$category instanceof Object_Category || !$category->isPublished()) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("invalid request");
        }

        $this->view->category = $category;
        $this->view->attributes = $definition;
    }

     public function categoryProductRenderletAction() {
       // echo "klklmklmkml".$this->getParam("id").$this->getParam("type");
        if($this->getParam("id") && $this->getParam("type") == "object") {
            $this->view->category = Object_Category::getById($this->getParam("id"));
        }
    }


}

?>