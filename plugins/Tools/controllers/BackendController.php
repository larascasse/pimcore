<?php


class Tools_BackendController extends Pimcore_Controller_Action_Admin
{


    public function init()
    {
        parent::init();

        /**
         * Enable Layout
         */
        Zend_Layout::startMvc();
        $layout = Zend_Layout::getMvcInstance();
        $layout->setViewSuffix("php");

    }

    public function imageAction()
    {

    }

    public function overviewAction()
    {

    }

}

?>
