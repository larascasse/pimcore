<?php
use Pimcore\Model\Object\ProjectPost;
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;


class ProjectCategoryController extends Action
{
   

    public function detailAction() {
        $this->enableLayout();
        $this->setLayout("layout-produit");
        // "id" is the named parameters in "Static Routes"
        //V1$article = Object_ProjectPost::getById($this->getParam("id"));
        $category = Object_ProjectCategory::getByPath("/projets/categories/".$this->getParam("key"));
        $this->view->$category = $category;

        // get a list of news objects and order them by date
        $projectList = new Object_ProjectPost_List();
        //$blogList->setOrderKey("date");
        //$blogList->setOrder("DESC");

        $conditions = [];

        if($this->getParam("key")) {
            $conditions[] = "category LIKE " . $projectList->quote("%,object|" . (int)  $category -> getId() . ",%");
        }
        if(!empty($conditions)) {
            $projectList->setCondition(implode(" AND ", $conditions));
        }


        $paginator = Zend_Paginator::factory($projectList);
        $paginator->setCurrentPageNumber(0);
        $paginator->setItemCountPerPage(100);

        $this->view->projects = $paginator;
        $this->view->projectsCount = $paginator->getCurrentItemCount();


        $categories = Object_ProjectCategory::getList(); // this is an alternative way to get an object list
        $this->view->categories = $categories;





        if(!$category instanceof Object_ProjectCategory || !$category->isPublished()) {
            // this will trigger a 404 error response
            //throw new \Zend_Controller_Router_Exception("invalid request UNPUBLISHED!!");
        }

        $this->view->category = $category;
    }

    


    public function getAllAction() {

        $this->disableLayout();

        $this->disableViewAutoRender();

        $list = Object\ProjectCategory::getList([
            //"limit" => $items,
            //"order" => "DESC",
            //"orderKey" => "date"
        ]);

        $fields =   array();

        
        foreach ($list as $item) {
            //print_r($item->getShortArray());
         // die;
            $fields[] = $item->getShortArray();
        }
        
       $this->response = $fields;

        $this->_helper->json->sendJson($this->response);
    }



   
}
