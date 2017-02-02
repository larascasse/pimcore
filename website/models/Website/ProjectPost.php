<?php
namespace Website;
use Pimcore\Model\Object;
use Pimcore;


// define a custom class,  for example:
class ProjectPost extends Object\ProjectPost {

	private  $_imageAssets;

	public function getImagesAssets() {

		if(!$this->_imageAssets)
			$this->_imageAssets = \Website\Tool\AssetHelper::getAssetArray($this->getImages());;
		//print_r($this->getImages());
		return $this->_imageAssets;
		
	} 

	public function test() {
		echo "klmkmlklmkm";
		
	} 


	public function getPosterImage() {
		$imagesArray = $this->getImagesAssets();

            if(is_array($imagesArray->assets) && count($imagesArray->assets)>0) {
                 $posterImage = $imagesArray->assets[0]->getThumbnail("content");
                 return $imagesArray->assets[0]->getThumbnail("content");

            }
            return null;
    }

    public function getMeta() {
    	return \Website\Tool\Text::cutStringRespectingWhitespace($this->getDescription(), 160);
    }

    public function getMageUrl() {
    	return $this->o_path.$this->o_key.".html";
    }

    public function getShortArray() {
    	 $itemData= array();
         $itemData["id"] = $this->getId();
         $itemData["modificationDate"] = $this->o_modificationDate;
         $itemData["key"] = $this->o_key;
         $itemData["path"] = $this->o_path;
         $itemData["meta"] = $this->getMeta();

         $itemData["mage_identifier"] = $this->getMageUrl();

         $itemData["name"] = $this->getName();
         $itemData["content"] = $this->getContent();
         $itemData["description"] = $this->getDescription();
         $itemData["posterImage"] = $this->getPosterImage()?$this->getPosterImage()->getHTML():"";

         return $itemData;
    }

	public function getContent() {
		//$this->disableLayout();
		//$this->
		$view = new \Pimcore\View();
		$view->addScriptPath(PIMCORE_WEBSITE_PATH . '/views/scripts');
		$view->article = $this;
		$html = $view->render('project-post/detail.php');
		return $html;
	}



}



