<?php

class Navigation_Navigation {

    public $structure = array();
    public $maxDeath = "";
    private $currentDeath = 0;
    private $doctype = array();
    private $local = null;
    public $params = null;
    public $name = "";
    public $cache = false;

    public function __construct() {
        $this->getDoctypes();
    }

    private function getDoctypes() {

        $list = new Document_DocType_List();

        $list->setCondition("type = 'page'");
        $list->setOrderKey(array("priority", "name"));
        $list->setOrder(array("desc", "ASC"));
        $list->load();


        $docTypes = array();
        foreach ($list->getDocTypes() as $type) {
            $docTypes[$type->id] = $type;
        }
        $this->doctype = $docTypes;
    }

    /**
     *
     * @param string $name
     * @param string $local
     * @param array $params
     * @return Navigation_Navnode 
     */
    public function getNavnode($name, $local=null, $params=null, $cache=false,$cacheKey="") {
        if ($name != -1) {


            $this->local = $local;
            $this->cache = $cache;
            $cacheKey = "Navigation_Plugin_" . $name . $cacheKey . "_" . $local;

            if($this->cache == true && $cacheContent = Pimcore_Model_Cache::load($cacheKey)){

                return $cacheContent;

            }

            $table = new Sitemap_Sitemap();
            $this->name = $name;
            $id = $table->getIdByName($name);
            if (is_array($params)) {
                $this->params = $params;
            }

            if (is_numeric($id) == true) {

                if (file_exists(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml")) {
                    $config = new Zend_Config_Xml(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml", null, true);


                    $navnode = $this->buildNav($config);
                    $tags = array("output");
                    if($cache == true){
                        Pimcore_Model_Cache::save($navnode, $cacheKey,$tags);
                    }

                    return $navnode;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {//preview
            if (file_exists(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_preview.xml")) {
                $config = new Zend_Config_Xml(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_preview.xml", null, true);

                $navnode = $this->buildNav($config);
                
                return $navnode;
            } else {
                return false;
            }
        }
    }

    /**
     * @param string $name
     * @param string $local
     * @param array $params
     * @return Zend_Navigation
     */
    public function getNavigation($name, $local=null, $params=null, $cache=false, $cacheKey="") {

        $navnode = $this->getNavnode($name, $local, $params, $cache, $cacheKey);

        if ($navnode instanceof Navigation_Navnode) {
            $menu = new Zend_Navigation($navnode->getNode());
            
            return $menu;
        }
        return false;
    }

    private function buildNav($config) {

        $this->maxDeath = $config->max_death;
        $return = array();
        $navNode = new Navigation_Navnode($this->cache);
        $navNode->setIsOnlyChild();

        if ($config->menuDefinitions->childs && !($config->menuDefinitions->childs->name)) {
            foreach ($config->menuDefinitions->childs as $child) {
                $navNode->addNode($this->recursiveBuild($child));
            }
        } elseif ($config->menuDefinitions->childs->name) {
            $navNode->addNode($this->recursiveBuild($config->menuDefinitions->childs));
        }

        return $navNode;
    }

    private function treateParams($node) {
        if (is_array($this->params[$node->name])) {
            foreach ($this->params[$node->name] as $k => $v) {
                if ($node->$k) {
                    $node->$k = $v;
                }
            }
        }
    }

    private function recursiveBuild($node, $currentRule=false) {

        if (is_array($this->params) && array_key_exists($node->name, $this->params)) {
            $this->treateParams($node);
        }

        if (is_numeric($this->maxDeath) == true && $this->currentDeath > $this->maxDeath) {
            return false;
        }
        $this->currentDeath++;
        if ($node->isRule == true && $currentRule == false) {
            return false;
        }

        switch ($node->fieldtype) {
            case "document":
                $navNode = $this->buildDoc($node);
                break;
            case "docfolder":
                $navNode = $this->buildDoc($node);
                break;
            case "object":
                $navNode = $this->buildObject($node);
                break;
            case "objectfolder":
                $navNode = $this->buildObject($node);
                break;
            default:
                $navNode = new Navigation_Navnode($this->cache);
                $navNode->setIsOnlyChild();
                break;
        }

        if ($node->childs) {

            if (!($node->childs->name)) {
                foreach ($node->childs as $child) {
                    $navNode->addNode($this->recursiveBuild($child));
                }
            } else {
                $navNode->addNode($this->recursiveBuild($node->childs));
            }
        }

        $this->currentDeath--;
        return $navNode;
    }

    private function checkRules($child, $rules) {

        if (is_array($rules) && count($rules) > 0) {
            $type = "";
            $id = 0;
            if ($child instanceof Document_Page) {
                $type = "document";
                $id = $child->getId();
            }
            if ($child instanceof Document_Folder) {
                $type = "docfolder";
                $id = $child->getId();
            }
            if ($child instanceof Object_Concrete) {
                $type = "object";
                $id = $child->getId();
            }
            if ($child instanceof Object_Folder) {
                $type = "objectfolder";
                $id = $child->getId();
            }
            if ($type != "") {
                foreach ($rules as $rule) {
                    if ($rule->fieldtype == "doctype" && $type == "document") {

                        $controller = $child->getController();
                        $action = $child->getAction();

                        if ($this->doctype[$rule->doctype]->controller == $controller && $this->doctype[$rule->doctype]->action == $action) {

                            $docrule = new Zend_Config(array(), true);
                            $docrule = $docrule->merge($rule);
                            $docrule->Document = $child->getId();
                            $docrule->fieldtype = "document";
                            return $this->recursiveBuild($docrule, true);
                        }
                    } elseif ($rule->fieldtype == $type) {

                        switch ($type) {
                            case "document" :
                                if ($rule->Document == $id) {
                                    return $this->recursiveBuild($rule, true);
                                }
                                break;
                            case "docfolder" :
                                if ($rule->docfolder == $id) {
                                    return $this->recursiveBuild($rule, true);
                                }
                                break;
                            case "object" :
                                if ($rule->object == $id) {
                                    return $this->recursiveBuild($rule, true);
                                }
                                break;
                            case "objectfolder":
                                if ($rule->objectfolder == $id) {
                                    return $this->recursiveBuild($rule, true);
                                }
                                break;
                            default;
                                return false;
                                break;
                        }
                    }
                }
            }
        }
        return false;
    }

    private function recursiveDocTree($confNode, $childs, $death, $rules) {
        //check global death
        if (is_numeric($this->maxDeath) == true && $this->currentDeath > $this->maxDeath) {
            return false;
        }
        $this->currentDeath++;

        //check local death
        if (is_numeric($confNode->ch_death) && $death > $confNode->ch_death) {
            return false;
        }

        $navNode = new Navigation_Navnode($this->cache);
        $navNode->setIsOnlyChild();


        foreach ($childs as $child) {
            $exclude = false;
            if ($confNode->ch_property != "") {
                $exclude = $child->getProperty($confNode->ch_property);
            }

            $tempNode = new Navigation_Navnode($this->cache);

            $Rule = $this->checkRules($child, $rules);

            if ($Rule instanceof Navigation_Navnode) {
                $tempNode = $Rule;
            }


            if ($Rule == false && $exclude != true && (($child instanceof Document_Folder) == true || $child->isPublished() == true)) {

                if ($child instanceof Document_Page) {
                    $tempNode = $this->buildChildDoc($confNode, $child);
                    if ($child->hasChilds() == true && ($tempNode instanceof Navigation_Navnode)) {
                        $tempNode->addNode($this->recursiveDocTree($confNode, $child->getChilds(), $death + 1, $rules));
                    }
                }
                if ($child instanceof Document_Link) {


                    if ($confNode->ch_labelselect == "property") {
                        $tempNode->setLabel($child->getProperty($confNode->ch_proplabel));
                    } elseif ($confNode->ch_labelselect == "name") {
                        $tempNode->setLabel($child->getName());
                    } else {
                        $tempNode->setLabel($child->getKey());
                    }

                    $tempNode->setUri($child->getHref());
                }
                if ($child instanceof Document_Folder) {
                    if ($confNode->ch_folder != "1") {


                        if ($confNode->ch_labelselect == "property") {
                            $tempNode->setLabel($child->getProperty($confNode->ch_proplabel));
                        } else {
                            $tempNode->setLabel($child->getKey());
                        }

                        if ($child->hasChilds() == true) {
                            $tempNode->addNode($this->recursiveDocTree($confNode, $child->getChilds(), $death + 1, $rules));
                        }
                    }
                }
            }
            if ($tempNode instanceof Navigation_Navnode) {
                $navNode->addNode($tempNode);
            }
        }

        $this->currentDeath--;
        return $navNode;
    }

    private function recursiveObjTree($confNode, $childs, $routes, $death, $rules) {

        if (is_numeric($this->maxDeath) == true && $this->currentDeath > $this->maxDeath) {
            return false;
        }
        $this->currentDeath++;

        //check local death
        if (is_numeric($confNode->ch_death) && $death > $confNode->ch_death) {
            return false;
        }

        $navNode = new Navigation_Navnode($this->cache);
        $navNode->setIsOnlyChild();


        foreach ($childs as $child) {
            $exclude = false;
            if ($confNode->ch_property != "") {
                $exclude = $child->getProperty($confNode->ch_property);
            }
            $tempNode = new Navigation_Navnode($this->cache);

            $Rule = $this->checkRules($child, $rules);

            if ($Rule instanceof Navigation_Navnode) {
                $tempNode = $Rule;
            }

            if ($Rule == false && $exclude != true && (($child instanceof Object_Folder) == true || $child->isPublished() == true)) {

                if ($child instanceof Object_Concrete) {
                    $tempNode = $this->buildChildObj($confNode, $child, $routes);
                    if ($child->hasChilds() == true && ($tempNode instanceof Navigation_Navnode)) {
                        $oChilds = $this->getObjChilds($child, $confNode->ch_orderkey, $confNode->ch_ordersens);
                        $tempNode->addNode($this->recursiveObjTree($confNode, $oChilds, $routes, $death + 1, $rules));
                    }
                }

                if ($child instanceof Object_Folder) {
                    if ($confNode->ch_folder != "1") {

                        $tempNode->setLabel($child->getKey());

                        if ($child->hasChilds() == true) {
                            $oChilds = $this->getObjChilds($child, $confNode->ch_orderkey, $confNode->ch_ordersens);
                            $tempNode->addNode($this->recursiveObjTree($confNode, $oChilds, $routes, $death + 1, $rules));
                        }
                    }
                }
            }
            if ($tempNode instanceof Navigation_Navnode) {
                $navNode->addNode($tempNode);
            }
        }

        $this->currentDeath--;
        return $navNode;
    }

    private function buildDoc($node) {
        $navNode = new Navigation_Navnode($this->cache);

        if ($node->fieldtype == "document") {
            $doc = Document_Page::getById($node->Document);
            $isFolder = false;
        } elseif ($node->fieldtype == "docfolder") {
            $doc = Document_Folder::getById($node->docfolder);
            $isFolder = true;
        }
        if ($doc == null) {
            return $navNode;
        }


        if ($node->onlychild == false) {
            switch ($node->labelType) {
                case "property":
                    $navNode->setLabel($doc->getProperty($node->proplabel));
                    break;
                case "name":
                    $navNode->setLabel($doc->getName());
                    break;
                case "title":
                    $navNode->setLabel($doc->getTitle());
                    break;
                case "label" :
                    $navNode->setLabel($node->label);
                    break;
                case "key" :
                    $navNode->setLabel($doc->getKey());
                    break;
                case "field" :
                    $navNode->setLabel($doc->elements[$node->fieldlabel]->text);
                    break;
                default:
                    break;
            }

            if ($navNode->label == "") {
                $navNode->setLabel($doc->getKey());
            }

            switch ($node->linkType) {
                case "doc":
                    $navNode->setUri($doc->getFullPath());
                    break;
                case "nolink":
                    $navNode->setUri("");
                    break;
                case "child":
                    $navNode->setFirstChildUri();
                    break;
                case "custom":
                    $navNode->setUri($node->customlink);
                    break;
                default:
                    break;
            }

            switch ($node->cssType) {
                case "nocss":
                    $navNode->setClass("");
                    break;
                case "define":
                    $navNode->setClass($node->css_define);
                    break;
                case "property":
                    $navNode->setClass($doc->getProperty($node->css_property));
                    break;
                default:
                    break;
            }
            //sitemap
            $navNode->setModifDate($doc->getModificationDate());
            $navNode->setFrequency($node->sm_def_freq);
            if ($node->sm_prop_freq != "") {
                $freq = $doc->getProperty($node->sm_prop_freq);
                if ($freq != false) {
                    $navNode->setFrequency($freq);
                }
            }
            $navNode->setPriority($node->sm_def_priority);
            if ($node->sm_prop_priority != "") {
                $prio = $doc->getProperty($node->sm_prop_priority);
                if ($freq != false) {
                    $navNode->setPriority($prio);
                }
            }
        } else {
            $navNode->setIsOnlyChild();
        }

        if ($isFolder == true || $node->allowchild == true) {
            if ($doc->hasChilds() == true) {
                $rules = $this->getRules($node);
                $navNode->addNode($this->recursiveDocTree($node, $doc->getChilds(), 0, $rules));
            }
        }
        return $navNode;
    }

    private function buildChildDoc($confNode, $doc) {
        $navNode = new Navigation_Navnode($this->cache);
        /* @var $doc Document_Page */

        $controller = $doc->getController();
        $action = $doc->getAction();


        $notAlloweds = preg_split("#,#", $confNode->ch_doctype);
        foreach ($notAlloweds as $notAllowed) {
            if ($this->doctype[$notAllowed]->controller == $controller && $this->doctype[$notAllowed]->action == $action) {
                return false;
            }
        }

        if ($doc->getProperty("navigation_exclude")) {
            return false;
        }


        switch ($confNode->ch_labelselect) {
            case "property":
                $navNode->setLabel($doc->getProperty($confNode->ch_proplabel));
                break;
            case "name":
                $navNode->setLabel($doc->getName());
                break;
            case "title":
                $navNode->setLabel($doc->getTitle());
                break;
            case "key":
                $navNode->setLabel($doc->getKey());
                break;
            case "field":
                $navNode->setLabel($doc->elements[$confNode->ch_fieldlabel]->text);
                break;
            default:
                break;
        }

        if ($navNode->label == "") {
            $navNode->setLabel($doc->getKey());
        }

        $navNode->setUri($doc->getFullPath());

        switch ($confNode->ch_cssType) {
            case "nocss":
                $navNode->setClass("");
                break;
            case "define":
                $navNode->setClass($confNode->ch_css_define);
                break;
            case "property":
                $navNode->setClass($doc->getProperty($confNode->ch_css_property));
                break;
            default:
                break;
        }

        $navNode->setModifDate($doc->getModificationDate());
        $navNode->setFrequency($confNode->sm_def_freq);
        if ($confNode->sm_prop_freq != "") {
            $freq = $doc->getProperty($confNode->sm_prop_freq);
            if ($freq != false) {
                $navNode->setFrequency($freq);
            }
        }
        $navNode->setPriority($confNode->sm_def_priority);
        if ($confNode->sm_prop_priority != "") {
            $prio = $doc->getProperty($confNode->sm_prop_priority);
            if ($freq != false) {
                $navNode->setPriority($prio);
            }
        }

        return $navNode;
    }

    private function buildObject($node) {
        $navNode = new Navigation_Navnode($this->cache);

        if ($node->fieldtype == "object") {
            $obj = Object_Abstract::getById($node->object);
            $isFolder = false;
        } elseif ($node->fieldtype == "objectfolder") {
            $obj = Object_Folder::getById($node->objectfolder);
            $isFolder = true;
        }
        if ($obj == null) {
            return $navNode;
        }



        if ($node->onlychild == false) {

            switch ($node->labelType) {
                case "property":
                    $navNode->setLabel($obj->getProperty($node->proplabel));
                    break;
                case "field":
                    $meth = "get" . $node->fieldlabel;
                    $navNode->setLabel($obj->$meth($this->local));
                    break;
                case "label" :
                    $navNode->setLabel($node->label);
                    break;
                case "key" :
                    $navNode->setLabel($obj->getKey());
                    break;
                default:
                    break;
            }

            if ($navNode->label == "") {
                $navNode->setLabel($obj->getKey());
            }

            switch ($node->linkType) {
                case "route":
                    $routeName = $node->routeselect;
                    $route = Staticroute::getByName($routeName);
                    $strVar = $route->getVariables();
                    $urlVar = array();
                    if ($strVar != "") {
                        $variables = preg_split("#,#", $strVar);
                        foreach ($variables as $variable) {
                            $key = $routeName . "_" . $variable;
                            if ($node->$key->active == "1") {
                                if ($node->$key->const != "1") {
                                    $urlVar[$variable] = $node->$key->variable;
                                } else {
                                    $meth = "get" . $node->$key->variable;
                                    $urlVar[$variable] = $obj->$meth($this->local);
                                }
                            }
                        }
                    }
                    $navNode->setUri($route->assemble($urlVar));

                    break;
                case "nolink":
                    $navNode->setUri("");
                    break;
                case "custom":
                    $navNode->setUri($node->customlink);
                    break;
                case "child":
                    $navNode->setFirstChildUri();
                    break;
                default:
                    break;
            }

            switch ($node->cssType) {
                case "nocss":
                    $navNode->setClass("");
                    break;
                case "define":
                    $navNode->setClass($node->css_define);
                    break;
                case "property":
                    $navNode->setClass($obj->getProperty($node->css_property));
                    break;
                default:
                    break;
            }

            $navNode->setModifDate($obj->getModificationDate());
            $navNode->setFrequency($node->sm_def_freq);
            if ($node->sm_prop_freq != "") {
                $freq = $obj->getProperty($node->sm_prop_freq);
                if ($freq != false) {
                    $navNode->setFrequency($freq);
                }
            }
            $navNode->setPriority($node->sm_def_priority);
            if ($node->sm_prop_priority != "") {
                $prio = $obj->getProperty($node->sm_prop_priority);
                if ($freq != false) {
                    $navNode->setPriority($prio);
                }
            }
        } else {
            $navNode->setIsOnlyChild();
        }

        $objectFields = $this->getObjectfield($node);
        if (count($objectFields) > 0) {
            $navNode->addNode($this->buildObjectField($obj, $objectFields));
        }

        if ($node->allowchild == true || $isFolder == true) {


            if ($obj->hasChilds() == true) {
                $rules = $this->getRules($node);
                $routes = $this->getRoutes($node);
                $oChilds = $this->getObjChilds($obj, $node->ch_orderkey, $node->ch_ordersens);
                $navNode->addNode($this->recursiveObjTree($node, $oChilds, $routes, 0, $rules));
            }
        }

        return $navNode;
    }

    private function getObjChilds($obj, $key, $sens="asc") {

        if ($key == "" || $key == null) {
            $key = "o_key";
        }
        if ($sens == "" || $sens == null) {
            $sens = "asc";
        }
        $list = new Object_List();
        $list->setCondition("o_parentId = '" . $obj->getO_id() . "'");
        $childs = $list->load();
        $type = null;
        $nb = 0;
        foreach ($childs as $child) {
            $ttype = $child->getClassName();
            if ($type != $ttype) {
                $nb++;
                $type = $ttype;
            }
        }
        if ($nb == 1) {
            $classlist = "Object_" . ucfirst($type) . "_List";
            $list = new $classlist();
            $list->setCondition("o_parentId = '" . $obj->getO_id() . "'");
            $list->setOrderKey($key); //important the default one is o_key
            $list->setOrder($sens);
        } else {
            $list = new Object_List();
            $list->setCondition("o_parentId = '" . $obj->getO_id() . "'");
            $list->setOrderKey($key); //important the default one is o_key

        }

        $childs = $list->load();




        return $childs;
    }

    private function getRoute($child) {
        $return = array();
        if ($child->fieldtype == "routemap") {
            $routeName = $child->routeselect;
            $return[$child->classe]["route"] = $routeName;
            $return[$child->classe]["labeltype"] = $child->labelType;
            switch ($child->labelType) {
                case "property":
                    $return[$child->classe]["label"] = $child->proplabel;
                    break;
                case "field":
                    $return[$child->classe]["label"] = $child->fieldlabel;
                    break;
                case "label":
                    $return[$child->classe]["label"] = $child->label;
                    break;
                default:
                    $return[$child->classe]["label"] = "";
                    break;
            }
            $route = Staticroute::getByName($routeName);
            $strVar = $route->getVariables();
            $urlVar = array();
            if ($strVar != "") {
                $variables = preg_split("#,#", $strVar);
                $tempArr = array();
                foreach ($variables as $variable) {
                    $key = $routeName . "_" . $variable;
                    $tempArr["key"] = $variable;
                    $tempArr["value"] = $child->$key->variable;
                    $tempArr["const"] = $child->$key->const;
                    $tempArr["active"] = $child->$key->active;
                    $return[$child->classe]["var"][] = $tempArr;
                }
            }

            $objectfields = $this->getObjectfield($child);
            if (count($objectfields) > 0) {
                $return[$child->classe]["objectfields"] = $objectfields;
            }

            return $return;
        } else {
            return null;
        }
    }

    private function getObjectfield($node) {

        $objectfields = array();
        //get object fields
        if ($node->childs) {
            if ($node->childs->name) {
                if ($node->childs->fieldtype == "objectfield") {
                    array_push($objectfields, $node->childs);
                }
            } else {
                foreach ($node->childs as $elem) {
                    if ($elem->fieldtype == "objectfield") {
                        array_push($objectfields, $elem);
                    }
                }
            }
        }
        return $objectfields;
///////////////////
    }

    private function getRoutes($node) {
        $return = array();
        if ($node->childs) {
            if ($node->childs->name) {
                $ret = $this->getRoute($node->childs);
                if ($ret != null) {
                    $return = array_merge($return, $ret);
                }
            } else {
                foreach ($node->childs as $child) {
                    $ret = $this->getRoute($child);
                    if ($ret != null) {
                        $return = array_merge($return, $ret);
                    }
                }
            }
        }

        return $return;
    }

    private function getRules($node) {
        $return = array();
        if ($node->childs) {
            if ($node->childs->name) {
                $ret = $this->getRule($node->childs);
                if ($ret != null) {
                    $return[] = $ret;
                }
            } else {
                foreach ($node->childs as $child) {
                    $ret = $this->getRule($child);
                    if ($ret != null) {
                        $return[] = $ret;
                    }
                }
            }
        }

        return $return;
    }

    private function getRule($child) {
        if ($child->isRule == true) {
            return $child;
        } else {
            return null;
        }
    }

    private function buildObjectField($object, $objectFields) {

        $this->currentDeath++;

        $navNode = new Navigation_Navnode($this->cache);
        $navNode->isOnlyChild = true;



        foreach ($objectFields as $objectfield) {

            $routes = $this->getRoutes($objectfield);
            $rules = $this->getRules($objectfield);

            $navNodeField = new Navigation_Navnode($this->cache);
            $navNodeField->isOnlyChild = true;

            $fieldname = $objectfield->objectfield;
            $meth = "get" . $fieldname;
            $childs = $object->$meth($this->local);

            if (!is_array($childs)) {
                $childs = array($childs);
            }


            foreach ($childs as $child) {
                if ($child instanceof Object_Abstract) {
                    $navNodeField->addNode($this->recursiveObjTree($objectfield, array($child), $routes, 0, $rules));
                }
                if ($child instanceof Document_Page) {
                    $navNodeField->addNode($this->recursiveDocTree($objectfield, array($child), 0, $rules));
                }
            }
            $navNode->addNode($navNodeField);
        }

        $this->currentDeath--;

        return $navNode;
    }

    private function buildChildObj($confNode, $obj, $routes) {/* @var $obj Object_Concrete */
        $navNode = new Navigation_Navnode($this->cache);

        $classe = $obj->getO_className();


        if (array_key_exists($classe, $routes)) {
            switch ($routes[$classe]["labeltype"]) {
                case "property":
                    $navNode->setLabel($obj->getProperty($routes[$classe]["label"]));
                    break;
                case "field":
                    $meth = "get" . $routes[$classe]["label"];
                    $navNode->setLabel($obj->$meth($this->local));
                    break;
                case "label":
                    $navNode->setLabel($routes[$classe]["label"]);
                    break;
                case "key":
                    $navNode->setLabel($obj->getKey());
                    break;
                default:
                    break;
            }
            if ($navNode->label == "") {
                $navNode->setLabel($obj->getKey());
            }



            $routeName = $routes[$classe]["route"];
            $route = Staticroute::getByName($routeName);

            $urlVar = array();

            foreach ($routes[$classe]["var"] as $var) {
                if ($var["active"] == "1") {
                    if ($var["const"] != "1") {
                        $urlVar[$var["key"]] = $var["value"];
                    } else {
                        $meth = "get" . $var["value"];
                        $val = $obj->$meth($this->local);
                        if ($val == false) {
                            $val = $obj->getValueFromParent($meth($this->local));
                        }
                        $urlVar[$var["key"]] = $val;
                    }
                }
            }

            $navNode->setUri($route->assemble($urlVar));

            switch ($confNode->ch_cssType) {
                case "nocss":
                    $navNode->setClass("");
                    break;
                case "define":
                    $navNode->setClass($confNode->ch_css_define);
                    break;
                case "property":
                    $navNode->setClass($obj->getProperty($confNode->ch_css_property));
                    break;
                default:
                    $navNode->setClass($this->name . "_" . $classe);
                    break;
                    break;
            }

            $navNode->setModifDate($obj->getModificationDate());

            $navNode->setFrequency($confNode->sm_def_freq);
            if ($confNode->sm_prop_freq != "") {
                $freq = $obj->getProperty($confNode->sm_prop_freq);
                if ($freq != false) {
                    $navNode->setFrequency($freq);
                }
            }
            $navNode->setPriority($confNode->sm_def_priority);
            if ($confNode->sm_prop_priority != "") {
                $prio = $obj->getProperty($confNode->sm_prop_priority);
                if ($freq != false) {
                    $navNode->setPriority($prio);
                }
            }
            if ($routes[$classe]["objectfields"]) {
                $navNode->addNode($this->buildObjectField($obj, $routes[$classe]["objectfields"]));
            }
        }
        return $navNode;
    }

}

?>
