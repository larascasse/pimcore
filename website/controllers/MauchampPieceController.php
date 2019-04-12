<?php
use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;



//ini_set('display_errors', 1);
//error_reporting(E_ALL);

        //require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/urldef.php';
        //require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/LPNEntities.php';
        //require_once dirname(__FILE__).'/../../plugins/LpnPlugin/odata/lpnservices/functions.php';


class MauchampPieceController extends Action
{
    
    public $response;

    public function init()
    {
        parent::init();
        
        //Set the response array
        /*$this->response = array(
            'msg' => 'Processing request...'
        );*/
    }


    public function indexAction() {
        $this->enableLayout();

        // get a list of news objects and order them by date
        $mauchampPieceList = new Object_MauchampPiece_List();
        //$conditionFilters = array("lENGTH(code)>0","ean is NULL");
     

       // $mauchampPieceList->setCondition(implode(" AND ", $conditionFilters));

        //$catalogList->setOrderKey("date");
        $mauchampPieceList->setOrder("ASC");
        $mauchampPieceList->load();

        $paginator = Zend_Paginator::factory($mauchampPieceList);
        $paginator->setCurrentPageNumber( $this->_getParam('page') );
        $paginator->setItemCountPerPage(40);

        $this->view->mauchampPieces = $paginator;
    }


    public function detailAction() {

        $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");

        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->enableLayout();
        $this->setLayout("layout-mauchamp");


		$definition = Object_Class::getByName("MauchampPiece")->getFieldDefinitions();
		
		

        // "id" is the named parameters in "Static Routes"
        $mauchampPiece = Object_MauchampPiece::getById($this->getParam("id"));
        


        if(!$mauchampPiece instanceof Object_MauchampPiece /*|| !$product->isPublished()*/) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("invalid request");
        }

        $this->view->mauchampPiece = $mauchampPiece;
        //$this->view->products = $mauchampPiece->getProductsArticle();

        $list = new Object_MauchampPiece_List();
        $conditionFilters = array(
            "o_path LIKE '/mauchamp/pieces%'");

        $list->setCondition(implode(" AND ", $conditionFilters));

        //$catalogList->setOrderKey("date");
        $list->setOrder("ASC");
        $list->setUnpublished(true);
        $list->load();
        


        $this->view->mauchampPieces = $list->getObjects();

    }

    //http://pimcore.florent.local/?controller=mauchampPiece&action=get-short-ajax
    public function getShortAjaxAction() {
        ini_set('max_execution_time', 3600);
        ini_set('max_input_time', 3600);
        ini_set("max_execution_time", 3600);
        set_time_limit(3600);

        ini_set('mysql.connect_timeout', 300);
        ini_set('mysql.default_socket_timeout',300);

        @ini_set("memory_limit", "2024M");

         $front = \Zend_Controller_Front::getInstance();
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Cache");
        $front->unregisterPlugin("Pimcore\\Controller\\Plugin\\Targeting");

        $this->disableLayout();
        $this->disableViewAutoRender();
        Object_Abstract::setHideUnpublished(false);


        $list = new Object_MauchampPiece_List();
        $conditionFilters = array(
            "o_path LIKE '/mauchamp/pieces%'",
            "Type_Piece = 'Commande'"
        );


        /*
        controller  mauchampPiece
        action  get-short-ajax
        descending  false
        page    1
        rowsPerPage 5
        sortBy  Code_Piece
        totalItems  0
        */




        $list->setCondition(implode(" AND ", $conditionFilters));

        $list->setOrderKey("DatePiece");
        $list->setOrder("desc");
        $list->setUnpublished(true);

                $list->setLimit(10);

        $list->load();
        


        $mauchampPiecesList = $list->getObjects();

        $mauchampPieces = [];

        foreach ($mauchampPiecesList as $mauchampPiece) {
            $mauchampPieces[] = $mauchampPiece->getShortArray();
        }


      

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($mauchampPieces);
        die;

    }

    public function getMauchampPieceShortByIds($mauchampPieceIds = array()) {
        // get a list of news objects and order them by date
        $mauchampPieceList = new Object_MauchampPiece_List();
        //$conditionFilters[] = array("lENGTH(code)>0","ean is NULL");

     

        $conditionFilters = array(
                "lENGTH(Code_Piece)>0",
                //"(ean = '".$mauchampPieceEan."' OR oo_id = '".$mauchampPieceId."')",
               // "(ean IN (".$mauchampPieceEan.") OR oo_id = '".$mauchampPieceId."')",

            );

        $mauchampPieceIds2 = [];
        if(count($mauchampPieceIds) > 0) {
            foreach ($mauchampPieceIds as $key => $value) {
                if(strlen(trim($value)) > 0)
                    $mauchampPieceIds2[] = "'".$value."'";
            }
            if(count($mauchampPieceIds2)> 0) {
                $conditionFilters[] = "(oo_id IN (".implode(",", $mauchampPieceIds2)."))";
            }
        }
        else {
            return [];
        }

        $condition = "(".implode(" AND ", $conditionFilters).")";

        $mauchampPieceList->setCondition($condition);
   
         

        $mauchampPieceList->load();

        $mauchampPieces=array();
         //Object_Abstract::setGetInheritedValues(true); 
        foreach ($mauchampPieceList as $mauchampPiece) {
            //echo "jlkjlkjkl";
            //continue;
           $mauchampPieces[] = $mauchampPiece->getShortArray();

        }
        return $mauchampPieces;

    }



    public function updateAction() {
         $this->disableViewAutoRender();

         $pk = $this->getParam("id");
          //Mise à jour des petis champs

        if(empty($pk) || $pk == 0) {

            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            echo json_encode(["success" => false, "msg" => "Pas d'ID".$pk]);
            die;
        }


        
            $action = $this->getParam("run");
            $fields = @json_decode($this->getParam("fields"),JSON_OBJECT_AS_ARRAY);
            
            if($action) {
                switch ($action) {
                    case 'update_livraison':
                        $message  = $this->_saveLivraison($pk,$fields);
                        break;

                     case 'update_preparation':
                        $message  = $this->_savePreparation($pk,$fields);
                        break;

                     case 'update_sortie':
                        $message  = $this->_saveSortie($pk,$fields);
                        break;
                    
                    default:

                        $messages=[];
                        foreach ($fields as $name => $value) {
                             $messages[] =  $this->_updateField($pk,$name,$value)['msg'];
                        }
                        $message = ["success" => false, "msg" => implode('\\n', $messages)];
                        break;
                }
            }
            else {
                $message =  $this->_updateField($pk,$this->getParam("name"),$this->getParam("value"));
            }
         
        $object = Object\MauchampPiece::getById($pk,['unpublished' => true]);
        $message["order"] = $object->getShortArray();

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($message);
        die;

    }


    protected function _updateField($pieceId,$field=null,$value=null) {
        
        //echo "_updateField"." ".$field." DD ".$value;
  

         $pk = $pieceId;


         if(empty($field)) {

            
            return ["success" => false, "msg" => "Pas de champ ".$pk];
         
        }


         //Object_MauchampPiece
         
         $object = Object\MauchampPiece::getById($pk,['unpublished' => true]);


       // print_r($object );
        if (!$object instanceof Object\MauchampPiece) {
            return ["success" => false, "msg" => "Pièce inconnue ".$pk];
    
        }
        else {
            $oldValue = $object->getValueForFieldName($field);

            /*if(
                $field == "Date_Livraison_Pim"
                || $field == "Date_Preparation_Pim"
                || $field == "Date_Sortie_Pim"



            ) {
               
                $date = DateTime::createFromFormat($this->dateFormat,$value);
                $value = new \Pimcore\Date();
                $value = $date->setTimestamp($date->getTimestamp());
            }*/


            if($oldValue == $value) {
                return ["success" => true, "msg" => "Pas de chgt"];
            }
            


            $object->setValue($field,$value);
            $object->save();

            //print_r($object);

            $note = new Pimcore\Model\Element\Note();
            $note->setElement($object);
            $note->setDate(time());
            $note->setType("Mise à jour");
            $note->setTitle($field. " de <i>".$oldValue."</i> vers <i>".$value."</i>");
            $note->save();

            return ["success" => true, "msg" => "Mise à jour effectuée"];
        }
    }


    protected function _saveSortie($pieceId) {
       

         $pk = $pieceId;


         return ["success" => true, "msg" => "Sortie OK ".$pk];
        
    }

    protected function _savePreparation($pieceId,$fields) {
       

         $pk = $pieceId;



         $messages=[];
        foreach ($fields as $field) {
             foreach ($field as $key => $value) {
                  $message  =  $this->_updateField($pk,$key,$value)['msg'];
                  $messages[] = $message;
             }
            
        }


         return ["success" => true, "msg" => implode("\n", $messages)];
        
    }

    protected function _saveLivraison($pieceId) {
       

         $pk = $pieceId;


         return ["success" => true, "msg" => "Livraison ".$pk];
        
    }




    


}
