<?php 

/** 
* Generated at: 2017-02-02T14:45:28+01:00
* IP: 172.31.30.232


Fields Summary: 
 - content [textarea]
*/ 

namespace Pimcore\Model\Object\Fieldcollection\Data;

use Pimcore\Model\Object;

class Text extends Object\Fieldcollection\Data\AbstractData  {

public $type = "text";
public $content;


/**
* Get content - content
* @return string
*/
public function getContent () {
	$data = $this->content;
	 return $data;
}

/**
* Set content - content
* @param string $content
* @return \Pimcore\Model\Object\Text
*/
public function setContent ($content) {
	$this->content = $content;
	return $this;
}

}

