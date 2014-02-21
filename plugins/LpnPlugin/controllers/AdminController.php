<?php

class LpnPlugin_AdminController extends Pimcore_Controller_Action_Admin {
    public function getaddressbookAction() {
        $addresses = array();

        $addresses[] = array(
            'name'        => 'Bob Dole',
            'phoneNumber' => '1234567890',
            'address'     => '123 Fake Street'
        );

        $addresses[] = array(
            'name'        => 'Joe Smith',
            'phoneNumber' => '0987654321',
            'address'     => '45 Newington Heights'
        );

        return $this->_helper->json(array('addresses' => $addresses));
    }
}