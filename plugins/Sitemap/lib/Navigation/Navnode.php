<?php

/*
 *
 * 
 */

/**
 * Description of Treenav
 *
 * @author Alexandre Delattre
 */
class Navigation_Navnode {

    public $label = "";
    public $uri = "";
    public $pages = array();
    public $active = false;
    public $isOnlyChild = false;
    public $qteChild = 0;
    public $firstChildUri = false;
    public $class = "";
    public $modifDate = "";
    public $priority = "";
    public $frequency = "";
    public $cache = false;
    public $title = "";

    public function __construct($cache=false) {
        $this->cache = $cache;
    }

    public function addNode($node) {
        if ($node instanceof Navigation_Navnode) {
            $data = $node->getNode();
            if ($data != false) {
                if ($node->isOnlyChild == true && $node->qteChild > 0) {
                    $this->pages = array_merge($this->pages, $data);
                    $this->qteChild += $node->qteChild;
                } else {
                    $this->pages[] = $data;
                    $this->qteChild++;
                }
                //if the URI is like the first child
                if ($this->qteChild > 0 && $this->firstChildUri == true) {
                    $this->setUri($this->pages[0]["uri"]);
                }
            }
        }
    }

    public function setPriority($priority) {
        if (is_numeric($priority)) {
            $this->priority = $priority;
        }
    }

    public function getPriority() {
        return $this->priority;
    }

    public function setFrequency($freq) {
        $available = array('always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never');
        if (in_array($freq, $available) == true) {
            $this->frequency = $freq;
        }
    }

    public function getFrequency() {
        return $this->frequency;
    }

    public function setClass($class) {
        if (is_string($class)) {
            $this->class = $class;
        }
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getClass() {
        return $this->class;
    }

    public function setFirstChildUri($bool=true) {
        if ($bool == true) {
            $this->firstChildUri = true;

            if ($this->qteChild > 0 && $this->firstChildUri == true) {
                $this->setUri($this->pages[0]["uri"]);
            }
        } else {
            $this->firstChildUri = false;
            $this->setUri("");
        }
    }

    public function getPages() {
        return $this->pages;
    }

    public function setLabel($label) {
        if (is_string($label) && $label != "") {
            $this->label = $label;
        }
    }

    public function getLabel() {
        return $this->label;
    }

    private function TxtUrl($texte) {

        $accents2 = array("à", "â", "ç", "é", "è", "ê", "ë", "î", "ï", "ô", "û", "’", "`", " ");
        $corrige2 = array("a", "a", "c", "e", "e", "e", "e", "i", "i", "o", "u", "", "", "%20");

        $texte = str_replace($accents2, $corrige2, $texte);

        return strtolower($texte);
    }

    public function setUri($uri) {
        if (is_string($uri)) {
            $this->uri = $this->TxtUrl($uri);
        }

        $arrUri = preg_split("#\?#", $_SERVER["REQUEST_URI"]);
        if ($this->uri == $arrUri[0] && $this->cache == false) {
            $this->setActive();
        } else {
            $this->setInactive();
        }
    }

    public function setModifDate($timestamp) {
        $date = new Zend_Date();
        $date->setTimestamp($timestamp);
        $this->modifDate = $date->get(zend_date::W3C);
    }

    public function getModifDate() {
        return $this->modifDate;
    }

    public function getUri() {
        return $this->uri;
    }

    public function setActive() {
        $this->active = true;
    }

    public function setInactive() {
        $this->active = false;
    }

    public function getActive() {
        return $this->active;
    }

    public function getNode() {
        if ($this->isOnlyChild == true && $this->qteChild > 0) {
            return $this->pages;
        } elseif ($this->isOnlyChild == false && ($this->label != "" || $this->uri != "")) {
            return $this->toArray();
        } else {
            return false;
        }
    }

    public function toArray() {
        $ret = array();
        if ($this->label == "") {
            $this->label = "no label";
        }
        $ret["label"] = $this->label;
        if ($this->title == "") {
            $ret["title"] = "";
        } else {
            $ret["title"] = $this->title;
        }
        $ret["uri"] = $this->uri;

        $ret["active"] = $this->active;

        $ret["class"] = $this->class;
        $ret["lastmod"] = $this->modifDate;
        $ret["changefreq"] = $this->frequency;
        $ret["priority"] = $this->priority;

        if ($this->qteChild > 0) {
            $ret["pages"] = $this->pages;
        }

        return $ret;
    }

    public function setIsOnlyChild() {
        $this->isOnlyChild = true;
    }

    public function getIsOnlyChild() {
        return $this->isOnlyChild;
    }

}

?>
