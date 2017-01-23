<?php

use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;


class CatalogController extends Action
{
    public function indexAction() {
        $this->enableLayout();

        // get a list of news objects and order them by date
        $catalogList = new Object_Catalog_List();
        $catalogList->setOrderKey("date");
        $catalogList->setOrder("DESC");
        $catalogList->load();

        $paginator = Zend_Paginator::factory($catalogList);
        $paginator->setCurrentPageNumber( $this->_getParam('page') );
        $paginator->setItemCountPerPage(5);

        $this->view->catalog = $paginator;
    }

    public function detailAction() {
        $this->enableLayout();

        // "id" is the named parameters in "Static Routes"
        $catalog = Object_News::getById($this->getParam("id"));

        if(!$catalog instanceof Object_Catalog || !$catalog->isPublished()) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("invalid request");
        }

        $this->view->catalog = $catalog;
    }

}
