<?php

namespace Pimcore\Model\Document\Tag\Area;
use Pimcore\Model\Document;

/**
 * Class Iframe
 * @package Pimcore\Model\Document\Tag\Area
 */
class LpnIncBlock extends Document\Tag\Area\AbstractArea
{
    /**
     * reuired
    */
    public function action () {
        //$myVar = $this->getParam("myParam");
        //...
        //$this->view->myVar = $myVar;
    }

    // OPTINAL METHODS
    /**
     * optional 
     * Executed after a brick is rendered
     */
    public function postRenderAction(){
        //...
    }

    /**
     * optional 
     * Returns a custom html wrapper element (return an empty string if you don't want a wrapper element)
     */
    public function getBrickHtmlTagOpen($brick){
        return "";//'<span class="customWrapperDiv">';
    }

    /**
     * optional 
     */
    public function getBrickHtmlTagClose($brick){
        return "";//'</span>';
    }
}