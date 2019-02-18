<?php 

use Website\Controller\Action;
use Website\Model;
use Pimcore\Model\Document;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

class CategoryController extends Action
{
    public function indexAction() {
         $this->enableLayout();

        // get a list of news objects and order them by date
        $list = new Object_Category_List();
        //$list->setCondition(implode(" AND ", $conditionFilters));

        //$catalogList->setOrderKey("date");
        $list->setOrder("ASC");
        $list->load();

        $paginator = Zend_Paginator::factory($list);
        $paginator->setCurrentPageNumber( $this->_getParam('page') );
        $paginator->setItemCountPerPage(40);

       
        $this->view->categories = $paginator;


    }

    public function detailAction() {
        $this->enableLayout();
        echo $this->getParam("id");
        $definition = Object_Class::getByName("Category")->getFieldDefinitions();
        
        

        // "id" is the named parameters in "Static Routes"
        $category = Object_Category::getById($this->getParam("id"));

        if(!$category instanceof Object_Category || !$category->isPublished()) {
            // this will trigger a 404 error response
            throw new \Zend_Controller_Router_Exception("invalid request");
        }

        $this->view->category = $category;
        $this->view->attributes = $definition;
    }

     public function categoryProductRenderletAction() {
       // echo "klklmklmkml".$this->getParam("id").$this->getParam("type");
        if($this->getParam("id") && $this->getParam("type") == "object") {
            $this->view->category = Object_Category::getById($this->getParam("id"));
        }
    }


    //http://pimcore.florent.local/?action=get-all&controller=category
    public function getAllAction() {
      

       /* $listing = new \Pimcore\Model\Article\Listing(); 

        $key =  $this->getParam("key");
       // $listing->setCondition("parentId = 230");
        $listing->setCondition('o_path LIKE \'/categories/%\'');
*/

        $this->disableLayout();

        $this->disableViewAutoRender();


        $conditionFilters =array('o_path LIKE \'/categories/%\'');


        $key =trim ($this->getParam("key")) ;

       if (strlen($this->getParam("key"))>0) {
           
            $conditionFilters[] = "o_key = '" . $this->getParam("key") . "'";
        }
        


        $condition = implode(" AND ", $conditionFilters);

        //print_r($condition);

        $listing = Website_Category::getList([
            "condition" => $condition,
            //"limit" => $limit,
            //"offset" => $start,
            //"orderKey" => "o_creationdate",
            //"order" => "desc",
            //"unpublished" => true,
        ]);

      
        $categories=array();
   
      
        foreach($listing as $category) {
            //echo $doc->getContent();
           // echo (get_class($category))." ".$category->getKey()." ".$category->getPath()."<br />\n";
           
            try {
                /*
                [id] => 6559
    [modificationDate] => 1485954241
    [key] => parquet
    [path] => /projets/
    [meta] => 
    [mage_identifier] => /projets/parquet.html
    [name] => 
    [content]
    [posterImage]
    [description]
    */
                if($category instanceOf Website_Category) {


                    if(strlen($key)>0 && $key != $category->getKey() ) {
                       //continue;
                    }
                    //print_r($category);
                    $categories[] = $category->getShortArray();
                }
            }
            catch (Exception $e){
                echo $e->getMessage();
            }
            
        }

       $this->response = $categories;
       $this->_helper->json->sendJson($this->response);
    }



}

?>