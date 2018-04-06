<?php


class LpnPlugin_IndexController extends Pimcore_Controller_Action_Admin {
    
    public function indexAction () {

        // reachable via http://your.domain/plugin/LpnPlugin/index/index
        $pimpampoum = new \LpnPlugin\Model\PimPamPoum();
		$pimpampoum->setValue("type","test");
		//$vote->setUsername('foobar!'.mt_rand(1, 999));
		$pimpampoum->save();

		$this->view->message = "OK !!";

    }
}
