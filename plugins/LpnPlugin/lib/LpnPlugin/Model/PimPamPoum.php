<?php

namespace LpnPlugin\Model;

use Pimcore\Model\AbstractModel;

/*

DROP TABLE IF EXISTS `lpn_pimpampoum`;
CREATE TABLE IF NOT EXISTS `lpn_pimpampoum` (
`id` INT NOT NULL AUTO_INCREMENT,
`type` varchar(100) DEFAULT NULL ,
`xml` longtext,
`codeClient` varchar(20) DEFAULT NULL ,
`codePiece` varchar(20) DEFAULT NULL ,
`toEmail` varchar(100) DEFAULT NULL ,
`fromEmail` varchar(100) DEFAULT NULL ,
`file` varchar(255) DEFAULT NULL ,
`date` INT NULL ,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `users_permission_definitions` (`key`)
VALUES ('lpn_permission_settings');

*/
 
class PimPamPoum extends AbstractModel {
 
    /**
     * @var int
     */
    public $id;
 
    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $xml;

    /**
     * @var string
     */
    public $codeClient;

    /**
     * @var string
     */
    public $codePiece;

    /**
     * @var string
     */
    public $fromEmail;

    /**
     * @var string
     */
    public $toEmail;

    /**
     * @var string
     */
    public $file;

 
    /**
     * @var date
     */
    public $date;
 
    /**
     * get score by id
     *
     * @param $id
     * @return null|Website_Model_PimPamPoum
     */
    public static function getById($id) {
        try {
            $obj = new self;
            $obj->getDao()->getById($id);
            return $obj;
        }
        catch (\Exception $ex) {
            \Logger::warn("PimPamPoum with id $id not found");
        }
 
        return null;
    }
     /**
     * @param $id
     */
    public function setId($id) {
        $this->id = $id;
    }
 
    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

     /**
     * @param $value
     */
    public function setType($value) {
        $this->type = $value;
    }
 
    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

     /**
     * @param $value
     */
    public function setXml($value) {
        $this->xml = $value;
    }
 
    /**
     * @return string
     */
    public function getXml() {
        return $this->xml;
    }
    
    /**
     * @param $value
     */
    public function setCodeClient($value) {
        $this->codeClient = $value;
    }
 
    /**
     * @return string
     */
    public function getCodeClient() {
        return $this->codeClient;
    }

     /**
     * @param $value
     */
    public function setCodePiece($value) {
        $this->codePiece = $value;
    }
 
    /**
     * @return string
     */
    public function getCodePiece() {
        return $this->codePiece;
    }

     /**
     * @param $value
     */
    public function setFromEmail($value) {
        $this->fromEmail = $value;
    }
 
    /**
     * @return string
     */
    public function getFromEmail() {
        return $this->fromEmail;
    }

    /**
     * @param $value
     */
    public function setToEmail($value) {
        $this->toEmail = $value;
    }
 
    /**
     * @return string
     */
    public function getToEmail() {
        return $this->toEmail;
    }

    /**
     * @param $value
     */
    public function setFile($value) {
        $this->file = $value;
    }
 
    /**
     * @return string
     */
    public function getFile() {
        return $this->file;
    }

     /**
     * @param $value
     */
    public function setDate($value) {
        $this->date = $value;
    }
 
    /**
     * @return string
     */
    public function getDate() {
        return $this->date;
    }
 
    

}

?>