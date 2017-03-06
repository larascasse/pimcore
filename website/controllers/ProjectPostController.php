<?php
use Pimcore\Model\Object\ProjectPost;
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;


class ProjectPostController extends Action
{
    public function indexAction() {
        $this->enableLayout();
        $this->setLayout("layout-produit");

        // get a list of news objects and order them by date
        $blogList = new Object_ProjectPost_List();
        //$blogList->setOrderKey("date");
        //$blogList->setOrder("DESC");

        $conditions = [];

        if($this->getParam("category")) {
            $conditions[] = "categories LIKE " . $blogList->quote("%," . (int) $this->getParam("category") . ",%");
        }

        if($this->getParam("archive")) {
            //$conditions[] = "DATE_FORMAT(FROM_UNIXTIME(date), '%Y-%c') = " . $blogList->quote($this->getParam("archive"));
        }

        if(!empty($conditions)) {
            $blogList->setCondition(implode(" AND ", $conditions));
        }

        $paginator = Zend_Paginator::factory($blogList);
        $paginator->setCurrentPageNumber( $this->getParam('page') );
        $paginator->setItemCountPerPage(100);

        $this->view->articles = $paginator;

        // get all categories
        $categories = Object_ProjectCategory::getList(); // this is an alternative way to get an object list
        $this->view->categories = $categories;

        // archive information, we have to do this in pure SQL
       /* $db = Pimcore_Resource::get();
        $ranges = $db->fetchCol("SELECT DATE_FORMAT(FROM_UNIXTIME(date), '%Y-%c') as ranges FROM object_5 GROUP BY DATE_FORMAT(FROM_UNIXTIME(date), '%b-%Y') ORDER BY ranges ASC");
        $this->view->archiveRanges = $ranges;*/
    }

    public function detailAction() {
        $this->enableLayout();
        $this->setLayout("layout-produit");
        // "id" is the named parameters in "Static Routes"
        //V1$article = Object_ProjectPost::getById($this->getParam("id"));
        $article = Object_ProjectPost::getByPath("/projets/".$this->getParam("key"));

        if(!$article instanceof Object_ProjectPost || !$article->isPublished()) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("invalid request UNPUBLISHED!!");
        }

        $this->view->article = $article;
    }

    


    public function getAllAction() {

        $this->disableLayout();

        $this->disableViewAutoRender();

        $list = Object\ProjectPost::getList([
            //"limit" => $items,
            //"order" => "DESC",
            //"orderKey" => "date"
        ]);

        $fields =   array();

        foreach ($list as $item) {
            $fields[] = $item->getShortArray();
        }
        
       $this->response = $fields;

        $this->_helper->json->sendJson($this->response);
    }



   
}
