<?php
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;


class DefaultController extends Action {

	public function defaultAction () {

	}

    public function layout() {
        $this->enableLayout();
    }
}
