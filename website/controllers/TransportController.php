<?php

use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

class TransportController extends Action
{
      /**
     * The output encoder (e.g. json)
     * @var
     */
    private $encoder;

    public function init()
    {
        parent::init();

        // do something on initialization //-> see Zend Framework

        // in our case we enable the layout engine (Zend_Layout) for all actions
        $this->enableLayout();
        $this->encoder = new Webservice\JsonEncoder();
    }

    public function preDispatch()
    {
        parent::preDispatch();

        // do something before the action is called //-> see Zend Framework
    }

    public function postDispatch()
    {
        parent::postDispatch();

        // do something after the action is called //-> see Zend Framework
    }

    public function indexAction()
    {
        $list = new Transport\Listing();
       // $list->setCondition("parentId = ? AND type IN ('link','page')", [$this->document->getId()]);
        //$newsList->setOrderKey("pickingDate");
        //$newsList->setOrder("DESC");

        $list->load();

        $this->view->transports = $list;
    }

    //http://pimcore.florent.local/transport/detail?id=12415
    public function detailAction()
    {
        $this->enableLayout();
        
        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");

        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->view->layout()->setLayout("layout-mauchamp");

        // "id" is the named parameters in "Static Routes"
       // echo $this->getParam("id");
       if($this->getParam("code")) {

            $objectList = Object\Transport::getByCodePiece($this->getParam("code"),['unpublished' => true]);
            
            if($objectList->count()==1) {
                $object = $objectList->current();
            }


            //DEBUG
            if (!$object instanceof Object\Transport) {

                $xmlOrder = Website\Tool\MauchampHelper::getDebugFacture();
                
                $object = Website\Tool\MauchampHelper::buildTransportObjectFromOrderXml($xmlOrder);

            }
        }
        else if($this->getParam("id"))
            $object = Object\Transport::getByCodePiece($this->getParam("id"),['unpublished' => true]);
        else
            $object = null;

       // print_r($object );
        if (!$object instanceof Object\Transport) {
            // this will trigger a 404 error response
            //throw new \Zend_Controller_Router_Exception("invalid request");
            echo "error...";
            $object = new Object\Transport;
            $this->view->create = true;
        }
        $this->view->create = false;
        $this->view->transport = $object;
    }

    public function updateAction() {
         $this->disableViewAutoRender();
         $pk = $this->getParam("pk");

         //Mise à jour des petis champs

        if(isset($pk) && $pk == 0) {
            $this->encoder->encode(["success" => false, "msg" => "Pas d'ID".$this->getParam("pk")]);
            return;
        }


         $object = Object\Transport::getById($this->getParam("pk"),['unpublished' => true]);
       // print_r($object );
        if (!$object instanceof Object\Transport) {
           // $this->encoder->encode(["success" => false, "msg" => "Pas de transport crée"]);

            //On essae de crée
            $object = new Object\Transport();
            $params = $this->getAllParams();
            foreach ($params as $key => $value) {
                if($key != "action" && $key !="controller") {
                    $object->setValue($key,$value);
                }


            }

            $object->setKey(time());
            $object->setParentId(12414);
      
            
            try {
                $object->save();
            }
           catch (\Exception $e) {
                   $this->encoder->encode(["success" => false, "msg" => $e,"transport"=>$object]);

               }
            
            $this->encoder->encode(["success" => true, "msg" => "Création effectuée","transport"=>$object]);
        }
        else {
            $object->setValue($this->getParam("name"),$this->getParam("value"));
            $object->save();
            $this->encoder->encode(["success" => true, "msg" => "mise à jour effectuée","transport"=>$object]);
        }


          //$this->getResponse()->setHttpResponseCode(403);
          //$this->encoder->encode(["success" => true, "msg" => "mise à jour effectuée"]);
    }


    
    //https://pimcore.com/docs/4.6.x/Development_Documentation/Extending_Pimcore/Hook_into_the_Startup_Process.html
    /*public function transportFormAction()
    {
        $success = false;

        // getting parameters is very easy ... just call $this->getParam("yorParamKey"); regardless if's POST or GET
        if ($this->getParam("firstname") && $this->getParam("lastname") && $this->getParam("email") && $this->getParam("terms")) {
            $success = true;

            // for this example the class "person" and "inquiry" is used
            // first we create a person, then we create an inquiry object and link them together

            // check for an existing person with this name
            $person = Object\Person::getByEmail($this->getParam("email"), 1);

            if (!$person) {
                // if there isn't an existing, ... create one
                $filename = \Pimcore\File::getValidFilename($this->getParam("email"));

                // first we need to create a new object, and fill some system-related information
                $person = new Object\Person();
                $person->setParent(Object::getByPath("/crm/inquiries")); // we store all objects in /crm
                $person->setKey($filename); // the filename of the object
                $person->setPublished(true); // yep, it should be published :)

                // of course this needs some validation here in production...
                $person->setGender($this->getParam("gender"));
                $person->setFirstname($this->getParam("firstname"));
                $person->setLastname($this->getParam("lastname"));
                $person->setEmail($this->getParam("email"));
                $person->setDateRegister(new \DateTime());
                $person->save();
            }

            // now we create the inquiry object and link the person in it
            $inquiryFilename = \Pimcore\File::getValidFilename(date("Y-m-d") . "~" . $person->getEmail());
            $inquiry = new Object\Inquiry();
            $inquiry->setParent(Object::getByPath("/inquiries")); // we store all objects in /inquiries
            $inquiry->setKey($inquiryFilename); // the filename of the object
            $inquiry->setPublished(true); // yep, it should be published :)

            // now we fill in the data
            $inquiry->setMessage($this->getParam("message"));
            $inquiry->setPerson($person);
            $inquiry->setDate(new \DateTime());
            $inquiry->setTerms((bool) $this->getParam("terms"));
            $inquiry->save();
        } elseif ($this->getRequest()->isPost()) {
            $this->view->error = true;
        }

        // do some validation & assign the parameters to the view
        foreach (["firstname", "lastname", "email", "message", "terms"] as $key) {
            if ($this->getParam($key)) {
                $this->view->$key = htmlentities(strip_tags($this->getParam($key)));
            }
        }

        // assign the status to the view
        $this->view->success = $success;
    }*/

    
}