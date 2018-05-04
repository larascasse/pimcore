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
    private $dateFormat = "d/m/Y";

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
        $this->view->layout()->setLayout("layout-mauchamp");


        $list = new Object\Transport\Listing();
        $list->setUnpublished(true);
        //$list->setCondition(implode(" AND ", $conditionFilters));

        $list->load();




        $paginator = Zend_Paginator::factory($list);
        $paginator->setCurrentPageNumber( $this->_getParam('page') );
        $paginator->setItemCountPerPage(40);

        $this->view->transports = $paginator;


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
            
            if($objectList->count()>0) {
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

        /* NOTES */
 
        if($object->getId()) {
           $this->view->notes = $this->getNotesForTransport($object);
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

                if($key == "shippingDate") {
                    //$value = DateTime::createFromFormat($this->dateFormat,$value);
                    //$value = new \Pimcore\Date($value,$this->dateFormat);;

                    $date = DateTime::createFromFormat($this->dateFormat,$value);
                    $value = new \Pimcore\Date();
                    $value = $date->setTimestamp($date->getTimestamp());


                }
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
            
            $note = new Pimcore\Model\Element\Note();
            $note->setElement($object);
            $note->setDate(time());
            $note->setType("Création");
            $note->setTitle("Création transport");
             
            // you can add as much additional data to notes & events as you want
            /*$note->addData("myText", "text", "Some Text");
            $note->addData("myObject", "object", Object_Abstract::getById(7));
            $note->addData("myDocument", "document", Document::getById(18));
            $note->addData("myAsset", "asset", Asset::getById(20));
            */
            $note->save();

            $this->encoder->encode(["success" => true, "msg" => "Création effectuée","transport"=>\Website\Tool\TransportHelper::getJsonReadyForTransport($object),"notes"=>array($note)]);
        }
        else {
            $oldValue = $object->getValueForFieldName($this->getParam("name"));

            $value = $this->getParam("value");
            
            if($this->getParam("name") == "shippingDate") {
               
                $date = DateTime::createFromFormat($this->dateFormat,$this->getParam("value"));
                $value = new \Pimcore\Date();
                $value = $date->setTimestamp($date->getTimestamp());
            }


            $object->setValue($this->getParam("name"),$value);
            $object->save();

            //print_r($object);

            $note = new Pimcore\Model\Element\Note();
            $note->setElement($object);
            $note->setDate(time());
            $note->setType("Mise à jour");
            $note->setTitle($this->getParam("name"). " de <i>".$oldValue."</i> vers <i>".$this->getParam("value")."</i>");

            $note->save();

           $this->encoder->encode(["success" => true, "msg" => "mise à jour effectuée","transport"=>\Website\Tool\TransportHelper::getJsonReadyForTransport($object),"notes"=>$this->getNotesForTransport($object)]);
        }


          //$this->getResponse()->setHttpResponseCode(403);
          //$this->encoder->encode(["success" => true, "msg" => "mise à jour effectuée"]);
    }

    public function getNotesForTransport($transport) {
        $list = new Element\Note\Listing();
        $list->setOrderKey(["date"]);
        $list->setOrder(["DESC", "DESC"]);
        $conditions = array();
        $conditions[] = "(cid = " . $list->quote($transport->getId()). ")";
        $list->setCondition(implode(" AND ", $conditions));
        $list->load();
        $notes = [];
        foreach ($list->getNotes() as $note) {
            $note->dateString = date("d/m/Y h:i",$note->getDate());
            $notes[] = $note;
        }
        return $notes;
    }

     public function getJsonReadyForTransport($transport) {
        $transport->shippingDate = is_object($transport->getShippingDate()) ? $transport->getShippingDate()->getTimestamp():null;
        return $transport;
    }



    //http://pimcore.florent.local/transport/order-expedition/
    public function orderExpeditionAction() {
        
        $this->disableBrowserCache();
        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->view->layout()->setLayout("layout-ft");


        //POST from sceinergie
        $transportId = $this->getParam('id'); 
        //$xml = $this->getParam('xml');


        
        if(isset($xml))
            $data = $xml;
        else
            //$xml = $data = \Website\Tool\MauchampHelper::getDebugClient();
            $data = \Website\Tool\MauchampHelper::getDebugOrder2();
        

        $order = \Website\Tool\MauchampHelper::parseOrder($data);

        //On va chercher le transport
        $codePiece = $order["orderDetail"]["Code_Commande"];
         $objectList = Object\Transport::getByCodePiece($codePiece,['unpublished' => true]);
            
            if($objectList->count()>0) {
                $transport = $objectList->current();
            }

       // die;

        

        
        $this->view->rawProducts = $order["rawProducts"];
        $this->view->transport = $transport;
        $this->view->orderDetail = $order["orderDetail"];
        //$this->view->xmlOrder = $xml;
        


        


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