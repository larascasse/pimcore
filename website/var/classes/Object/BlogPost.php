<?php 

/** 
* Generated at: 2017-04-18T15:27:04+02:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 172.31.30.232


Fields Summary: 
- localizedfields [localizedfields]
-- title [input]
-- accroche [textarea]
-- excerpt [textarea]
- posterImage [image]
- content [fieldcollections]
- relatedProducts [objects]
- date [date]
- categories [objects]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\BlogPost\Listing getByLocalizedfields ($field, $value, $locale = null, $limit = 0) 
* @method \Pimcore\Model\Object\BlogPost\Listing getByPosterImage ($value, $limit = 0) 
* @method \Pimcore\Model\Object\BlogPost\Listing getByContent ($value, $limit = 0) 
* @method \Pimcore\Model\Object\BlogPost\Listing getByRelatedProducts ($value, $limit = 0) 
* @method \Pimcore\Model\Object\BlogPost\Listing getByDate ($value, $limit = 0) 
* @method \Pimcore\Model\Object\BlogPost\Listing getByCategories ($value, $limit = 0) 
*/

class BlogPost extends Concrete {

public $o_classId = 14;
public $o_className = "blogPost";
public $localizedfields;
public $posterImage;
public $content;
public $relatedProducts;
public $date;
public $categories;


/**
* @param array $values
* @return \Pimcore\Model\Object\BlogPost
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get localizedfields - 
* @return \Pimcore\Model\Object\Localizedfield
*/
public function getLocalizedfields () {
	$preValue = $this->preGetValue("localizedfields"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("localizedfields")->preGetData($this);
	return $data;
}

/**
* Get title - Titre
* @return string
*/
public function getTitle ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("title", $language);
	$preValue = $this->preGetValue("title"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Get accroche - accroche
* @return string
*/
public function getAccroche ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("accroche", $language);
	$preValue = $this->preGetValue("accroche"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Get excerpt - Resumé
* @return string
*/
public function getExcerpt ($language = null) {
	$data = $this->getLocalizedfields()->getLocalizedValue("excerpt", $language);
	$preValue = $this->preGetValue("excerpt"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	 return $data;
}

/**
* Set localizedfields - 
* @param \Pimcore\Model\Object\Localizedfield $localizedfields
* @return \Pimcore\Model\Object\BlogPost
*/
public function setLocalizedfields ($localizedfields) {
	$this->localizedfields = $localizedfields;
	return $this;
}

/**
* Set title - Titre
* @param string $title
* @return \Pimcore\Model\Object\BlogPost
*/
public function setTitle ($title, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("title", $title, $language);
	return $this;
}

/**
* Set accroche - accroche
* @param string $accroche
* @return \Pimcore\Model\Object\BlogPost
*/
public function setAccroche ($accroche, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("accroche", $accroche, $language);
	return $this;
}

/**
* Set excerpt - Resumé
* @param string $excerpt
* @return \Pimcore\Model\Object\BlogPost
*/
public function setExcerpt ($excerpt, $language = null) {
	$this->getLocalizedfields()->setLocalizedValue("excerpt", $excerpt, $language);
	return $this;
}

/**
* Get posterImage - Image d'intro
* @return \Pimcore\Model\Asset\Image
*/
public function getPosterImage () {
	$preValue = $this->preGetValue("posterImage"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->posterImage;
	return $data;
}

/**
* Set posterImage - Image d'intro
* @param \Pimcore\Model\Asset\Image $posterImage
* @return \Pimcore\Model\Object\BlogPost
*/
public function setPosterImage ($posterImage) {
	$this->posterImage = $posterImage;
	return $this;
}

/**
* @return \Pimcore\Model\Object\Fieldcollection
*/
public function getContent () {
	$preValue = $this->preGetValue("content"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { return $preValue;}
	$data = $this->getClass()->getFieldDefinition("content")->preGetData($this);
	 return $data;
}

/**
* Set content - Contenu
* @param \Pimcore\Model\Object\Fieldcollection $content
* @return \Pimcore\Model\Object\BlogPost
*/
public function setContent ($content) {
	$this->content = $this->getClass()->getFieldDefinition("content")->preSetData($this, $content);
	return $this;
}

/**
* Get relatedProducts - relatedProducts
* @return \Pimcore\Model\Object\product[]
*/
public function getRelatedProducts () {
	$preValue = $this->preGetValue("relatedProducts"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("relatedProducts")->preGetData($this);
	return $data;
}

/**
* Set relatedProducts - relatedProducts
* @param \Pimcore\Model\Object\product[] $relatedProducts
* @return \Pimcore\Model\Object\BlogPost
*/
public function setRelatedProducts ($relatedProducts) {
	$this->relatedProducts = $this->getClass()->getFieldDefinition("relatedProducts")->preSetData($this, $relatedProducts);
	return $this;
}

/**
* Get date - Date
* @return \Carbon\Carbon
*/
public function getDate () {
	$preValue = $this->preGetValue("date"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->date;
	return $data;
}

/**
* Set date - Date
* @param \Carbon\Carbon $date
* @return \Pimcore\Model\Object\BlogPost
*/
public function setDate ($date) {
	$this->date = $date;
	return $this;
}

/**
* Get categories - categories
* @return \Pimcore\Model\Object\blogCategory[]
*/
public function getCategories () {
	$preValue = $this->preGetValue("categories"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("categories")->preGetData($this);
	return $data;
}

/**
* Set categories - categories
* @param \Pimcore\Model\Object\blogCategory[] $categories
* @return \Pimcore\Model\Object\BlogPost
*/
public function setCategories ($categories) {
	$this->categories = $this->getClass()->getFieldDefinition("categories")->preSetData($this, $categories);
	return $this;
}

protected static $_relationFields = array (
  'relatedProducts' => 
  array (
    'type' => 'objects',
  ),
  'categories' => 
  array (
    'type' => 'objects',
  ),
);

public $lazyLoadedFields = array (
  0 => 'content',
  1 => 'relatedProducts',
  2 => 'categories',
);

}

