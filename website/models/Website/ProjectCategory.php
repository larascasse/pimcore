<?php
namespace Website;

use Pimcore\Model\Object;
//use Pimcore\Model\Object\ProjectPost;
use Pimcore;


// define a custom class,  for example:
class ProjectCategory extends Object\ProjectCategory {

	private  $_imageAssets;

	



    public function getMeta() {
    	return \Website\Tool\Text::cutStringRespectingWhitespace("Réalisations - ".$this->getName(), 160);
    }

    public function getMageUrl() {
    	//return "projet/".$this->o_key;
    	return ltrim("projets/category/".$this->o_key,"/");
    }

    public function getShortArray() {


    
    	 $itemData= array();
         $itemData["id"] = $this->getId();
         $itemData["modificationDate"] = $this->o_modificationDate;
         $itemData["key"] = $this->o_key;
         $itemData["path"] = $this->o_path;
         $itemData["meta"] = $this->getMeta();

         $itemData["mage_identifier"] = $this->getMageUrl();

         $itemData["name"] = "Réalisations - ".$this->getName();
         $itemData["content"] = $this->getContent();
         //$itemData["description"] = $this->getDescription();
         //$itemData["posterImage"] = $this->getPosterImage()?$this->getPosterImage()->getThumbnail("content")->getHTML():"";
         //$itemData["sku"] = ($product=$this->getRelatedProduct())?$product->getSku():"";

         return $itemData;
    }

	public function getContent() {
		//$this->disableLayout();
		//$this->


		$view = new \Pimcore\View();
		$view->addScriptPath(PIMCORE_WEBSITE_PATH . '/views/scripts');
		$view->category = $this;

          $projectList = new ProjectPost\Listing();

        

          $conditions = [];

 
          $conditions[] = "category LIKE " . $projectList->quote("%,object|" . (int)  $this -> getId() . ",%");
        
        if(!empty($conditions)) {
            $projectList->setCondition(implode(" AND ", $conditions));
        }


        //$paginator = Zend_Paginator::factory($projectList);
        //$paginator->setCurrentPageNumber(0);
        //$paginator->setItemCountPerPage(100);

        $view->projects = $projectList->load();
        $view->projectsCount = $projectList->count();





        // get all categories
        $categories = ProjectCategory::getList(); // this is an alternative way to get an object list
        $view->categories = $categories;


		$html = $view->render('project-category/detail.php');

		return $html;
	}



}



