<?php

use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

class ContentController extends Action
{
    public function defaultAction() {
        $this->enableLayout();
    }

    public function portalAction() {
        $this->enableLayout();
    }

    public function thumbnailsAction() {
        $this->enableLayout();
    }

    public function websiteTranslationsAction() {
        $this->enableLayout();
    }

    public function editableRoundupAction() {
        $this->enableLayout();
    }

    public function simpleFormAction() {
        $this->enableLayout();

        $success = false;

        // getting parameters is very easy ... just call $this->getParam("yorParamKey"); regardless if's POST or GET
        if($this->getParam("firstname") && $this->getParam("lastname") && $this->getParam("email")) {
            $success = true;

            // of course you can store the data here into an object, or send a mail, ... do whatever you want or need
            // ...
            // ...
        }

        // do some validation & assign the parameters to the view
        foreach (["firstname", "lastname", "email"] as $key) {
            if($this->getParam($key)) {
                $this->view->$key = htmlentities(strip_tags($this->getParam($key)));
            }
        }

        // assign the status to the view
        $this->view->success = $success;
    }

    public function galleryRenderletAction() {
        if($this->getParam("id") && $this->getParam("type") == "asset") {
            $this->view->asset = Asset::getById($this->getParam("id"));
        }
    }

     public function linkEshopRenderletAction() {
         $this->view->editmode=$this->getParam("editmode");
         $this->view->previewmode=$this->getParam("previewmode");
         $this->view->btn_title=$this->getParam("btn_title");

        if($this->getParam("id") && $this->getParam("type") == "object") {
            $object= Object::getById($this->getParam("id"));
            if($object instanceOf Object\Category) {
                $this->view->category = Object\Category::getById($this->getParam("id"));
            }
            if($object instanceOf Object\Teinte) {
                $this->view->teinte = Object\Teinte::getById($this->getParam("id"));
            }
            if($object instanceOf Object\Product) {
                $this->view->product = Object\Product::getById($this->getParam("id"));
            }
            if($object instanceOf Object\projectPost) {
                $this->view->projectPost = Object\projectPost::getById($this->getParam("id"));

            }
            if($object instanceOf Object\blogPost) {
                $this->view->blogPost = Object\blogPost::getById($this->getParam("id"));
            }
            else {
                $this->view->empty=true;
            }

            
        }
        else if($this->getParam("id") && $this->getParam('type') == 'document') {
            $document = Document::getById($this->getParam('id'));
            $this->view->document = $document;
            
        }
    }


}
