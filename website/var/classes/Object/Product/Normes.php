<?php 

namespace Pimcore\Model\Object\Product;

class Normes extends \Pimcore\Model\Object\Objectbrick {



protected $brickGetters = array('techAttributeSol','techDopParquet','techDopParquetFinition','techMarquageCE');


public $techAttributeSol = null;

/**
* @return \Pimcore\Model\Object\Objectbrick\Data\techAttributeSol
*/
public function getTechAttributeSol() { 
	if(!$this->techAttributeSol && \Pimcore\Model\Object\AbstractObject::doGetInheritedValues($this->getObject())) { 
		$brick = $this->getObject()->getValueFromParent("normes");
		if(!empty($brick)) {
			return $this->getObject()->getValueFromParent("normes")->getTechAttributeSol(); 
		}
	}
   return $this->techAttributeSol; 
}

/**
* @param \Pimcore\Model\Object\Objectbrick\Data\techAttributeSol $techAttributeSol
* @return void
*/
public function setTechAttributeSol ($techAttributeSol) {
	$this->techAttributeSol = $techAttributeSol;
	return $this;;
}

public $techDopParquet = null;

/**
* @return \Pimcore\Model\Object\Objectbrick\Data\techDopParquet
*/
public function getTechDopParquet() { 
	if(!$this->techDopParquet && \Pimcore\Model\Object\AbstractObject::doGetInheritedValues($this->getObject())) { 
		$brick = $this->getObject()->getValueFromParent("normes");
		if(!empty($brick)) {
			return $this->getObject()->getValueFromParent("normes")->getTechDopParquet(); 
		}
	}
   return $this->techDopParquet; 
}

/**
* @param \Pimcore\Model\Object\Objectbrick\Data\techDopParquet $techDopParquet
* @return void
*/
public function setTechDopParquet ($techDopParquet) {
	$this->techDopParquet = $techDopParquet;
	return $this;;
}

public $techDopParquetFinition = null;

/**
* @return \Pimcore\Model\Object\Objectbrick\Data\techDopParquetFinition
*/
public function getTechDopParquetFinition() { 
	if(!$this->techDopParquetFinition && \Pimcore\Model\Object\AbstractObject::doGetInheritedValues($this->getObject())) { 
		$brick = $this->getObject()->getValueFromParent("normes");
		if(!empty($brick)) {
			return $this->getObject()->getValueFromParent("normes")->getTechDopParquetFinition(); 
		}
	}
   return $this->techDopParquetFinition; 
}

/**
* @param \Pimcore\Model\Object\Objectbrick\Data\techDopParquetFinition $techDopParquetFinition
* @return void
*/
public function setTechDopParquetFinition ($techDopParquetFinition) {
	$this->techDopParquetFinition = $techDopParquetFinition;
	return $this;;
}

public $techMarquageCE = null;

/**
* @return \Pimcore\Model\Object\Objectbrick\Data\techMarquageCE
*/
public function getTechMarquageCE() { 
	if(!$this->techMarquageCE && \Pimcore\Model\Object\AbstractObject::doGetInheritedValues($this->getObject())) { 
		$brick = $this->getObject()->getValueFromParent("normes");
		if(!empty($brick)) {
			return $this->getObject()->getValueFromParent("normes")->getTechMarquageCE(); 
		}
	}
   return $this->techMarquageCE; 
}

/**
* @param \Pimcore\Model\Object\Objectbrick\Data\techMarquageCE $techMarquageCE
* @return void
*/
public function setTechMarquageCE ($techMarquageCE) {
	$this->techMarquageCE = $techMarquageCE;
	return $this;;
}

}

