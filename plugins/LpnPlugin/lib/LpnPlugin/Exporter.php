 <?php

 class LpnPlugin_Exporter {
    
    private  $config;
    private  $overwrite;
    private  $csvFile;

    private $parentId = 1514;

    function LpnPlugin_Exporter($importerConfig,$overwrite) {
        //echo "ok";
        $this->config = $importerConfig;
        $this->overwrite = $overwrite;
        //echo $this->config->export->folderId;
    }

    function init() {
        echo "\Exporter Init\n";
    }

    function getParam($param) {
        switch ($param) {
            case 'folderId':
                return  $this->config->export->folderId;
                break;

            case 'classId':
                return  $this->config->export->classId;
                break;
            
            default:
                # code...
                break;
        }

    }
    public function exportAction($file,$exportConfigurable=false) {

        $folder = Object_Abstract::getById($this->getParam("folderId"));
        $class = Object_Class::getById($this->getParam("classId"));

        $className = $class->getName();

        $listClass = "Object_" . ucfirst($className) . "_List";


        if(!empty($folder)) {
            $conditionFilters = array("o_path LIKE '" . $folder->getFullPath() . "%'");
        } else {
            $conditionFilters = array();
        }
        if ($this->getParam("filter")) {
            $conditionFilters[] = Object_Service::getFilterCondition($this->getParam("filter"), $class);
        }
        if ($this->getParam("condition")) {
            $conditionFilters[] = "(" . $this->getParam("condition") . ")";
        }

        $list = new $listClass();
        $list->setCondition(implode(" AND ", $conditionFilters));
        $list->setOrder("ASC");
        $list->setOrderKey("o_id");

        if($this->getParam("objecttype")) {
            $list->setObjectTypes(array($this->getParam("objecttype")));
        }

        $list->load();

        $objects = array();
        Logger::debug("objects in list:" . count($list->getObjects()));
        foreach ($list->getObjects() as $object) {

            if ($object instanceof Object_Concrete) {
                $o = $this->csvObjectData($object);

                //on n'enleve que les produits avec SKU (produits simples)
                if($exportConfigurable) {
                    $childrens = $object->getChilds();
                    $simples_skus=array();

                    if(count($childrens)>1) {
                        

                        $subObject = array();

                        foreach ($childrens as $subProduct) {
                            $subProductConfigurableData = $this->csvObjectDataForConfigurables($subProduct);
                            $subProductData = $this->csvObjectData($subProduct);

                            if(strlen($o["sku"])==0) {

                                $simples_skus[] = $subProductConfigurableData["sku"];
                                $configurable_attributes =array();
                                foreach ($subProductConfigurableData as $subkey => $subValue) {
                                    if(    $subkey!="sku" 
                                        && $subkey!="name"
                                        && $subkey!="price") {
                                        $configurable_attributes[] = $subkey;
                                    }
                                }
                                
                            }
                            
                        }
                        if(count($configurable_attributes)==0) {
                            continue;
                        }
                        $subObject["sku"] = $o["code"];
                        $subObject["simples_skus"] = implode(",",$simples_skus);
                        $subObject["configurable_attributes"] = implode(",",$configurable_attributes);
                        $subObject["name"] = $subProductData["name"];
                        $subObject["price"] = $subProductData["price"];
                        $subObject["description"] = $subProductData["description"];
                        $subObject["short_description"] = $subProductData["short_description"];

                        $subObject["attribute_set"]="Default";
                        $subObject["store"]="";
                        $subObject["type"]="configurable";
                        $subObject["root_category"]="Catalogue";
                        $subObject["product_websites"]="base";
                        $subObject["weight"]="10";
                        //$o["price"]=10;
                        $subObject["status"]="Enabled";
                        $subObject["visibility"]="Catalog, Search";
                        $subObject["tax_class_id"] = "4";

                        $objects[] = $subObject;
                    }

                    
                }
                //on ne garde que les produits avec SKU
                else {
                    if(strlen($o["sku"])>0)
                        $objects[] = $o;
                }
                
            }
        }
        //create csv
        if(!empty($objects)) {
            $columns = array_keys($objects[0]);
            foreach ($columns as $key => $value) {
                $columns[$key] = '"' . $value . '"';
                
            }
            $csv = implode(";", $columns) . "\r\n";
            foreach ($objects as $o) {
                foreach ($o as $key => $value) {

                    //clean value of evil stuff such as " and linebreaks
                    if (is_string($value)) {
                        $value = strip_tags($value);
                        $value = str_replace('"', '', $value);
                        $value = str_replace("\r", "", $value);
                        $value = str_replace("\n", "", $value);

                        $o[$key] = '"' . $value . '"';

                    }
                }
                $csv .= implode(";", $o) . "\r\n";
            }

        }

        file_put_contents($file, $csv);


       // header("Content-type: text/csv");
        //header("Content-Disposition: attachment; filename=\"export.csv\"");
        echo "Export OK : ".$file;
        //exit;
    }


    /**
     * Flattens object data to an array with key=>value where
     * value is simply a string representation of the value (for objects, hrefs and assets the full path is used)
     *
     * @param Object_Abstract $object
     * @return array
     */

    //        //sku,_store,_attribute_set,_type,_store,_root_category,_product_websites,country_of_manufacture,description,meta_description,meta_keyword,meta_title,minimal_price,name,price,short_description,updated_at,url_path,visibility,weight,qty,min_qty,use_config_min_qty,is_qty_decimal,backorders,use_config_backorders,min_sale_qty,use_config_min_sale_qty,max_sale_qty,use_config_max_sale_qty,is_in_stock,notify_stock_qty,use_config_notify_stock_qty,manage_stock,use_config_manage_stock,stock_status_changed_auto,use_config_qty_increments,qty_increments,use_config_enable_qty_inc,enable_qty_increments,is_decimal_divided,_links_related_sku,_links_related_position,_links_crosssell_sku,_links_crosssell_position,_links_upsell_sku,_links_upsell_position,_associated_sku,_associated_default_qty,_associated_position,_tier_price_website,_tier_price_customer_group,_tier_price_qty,_tier_price_price,_group_price_website,_group_price_customer_group,_group_price_price,_media_attribute_id,_media_image,_media_lable,_media_position,_media_is_disabled

    protected function csvObjectData($object) {

        $o = array();
        foreach ($object->getClass()->getFieldDefinitions() as $key => $value) {
           //exclude remote owner fields
            
             switch ($key) {
                case 'ean':
                    # code...
                    $key="sku";
                    break;
                case 'country':
                    # code...
                    $key="country_of_manufacture";
                    break;
                case 'short_description':
                    break;
                case 'description':
                case 'name':
                case 'price':
                case 'code':
                case 'largeur':
                case 'longueur':
                case 'epaisseur':
                case 'choix':
                    
                    break;
                case 'country':
                    # code...
                    $key="country_of_manufacture";
                    break;
                
                default:
                    //On ne prends pas les autres données
                    continue(2);
                    break;
            }
            if (!($value instanceof Object_Class_Data_Relations_Abstract and $value->isRemoteOwner())) {
                $o[$key] = $value->getForCsvExport($object);
            }
            

        }

        //Visibiliy
        $parent = $object->getParent();
        $visibility = "Catalog, Search";
        if(count($parent->getChilds())>1) {
            $visibility = "Search";
        }

        $o["attribute_set"]="Default";
        $o["store"]="\"\"";
        $o["type"]="simple";
        $o["root_category"]="Catalogue";
        $o["product_websites"]="base";
        $o["weight"]="10";
        //$o["price"]=10;
        $o["status"]="Enabled";
        $o["visibility"]= $visibility;
        $o["tax_class_id"] = "Shipping";
       

        //$o["id (system)"] = $object->getId();
        //$o["key (system)"] = $object->getKey();
        //$o["fullpath (system)"] = $object->getFullPath();
        //$o["published (system)"] = $object->isPublished();

        return $o;
    }

    //        //sku,_store,_attribute_set,_type,_store,_root_category,_product_websites,country_of_manufacture,description,meta_description,meta_keyword,meta_title,minimal_price,name,price,short_description,updated_at,url_path,visibility,weight,qty,min_qty,use_config_min_qty,is_qty_decimal,backorders,use_config_backorders,min_sale_qty,use_config_min_sale_qty,max_sale_qty,use_config_max_sale_qty,is_in_stock,notify_stock_qty,use_config_notify_stock_qty,manage_stock,use_config_manage_stock,stock_status_changed_auto,use_config_qty_increments,qty_increments,use_config_enable_qty_inc,enable_qty_increments,is_decimal_divided,_links_related_sku,_links_related_position,_links_crosssell_sku,_links_crosssell_position,_links_upsell_sku,_links_upsell_position,_associated_sku,_associated_default_qty,_associated_position,_tier_price_website,_tier_price_customer_group,_tier_price_qty,_tier_price_price,_group_price_website,_group_price_customer_group,_group_price_price,_media_attribute_id,_media_image,_media_lable,_media_position,_media_is_disabled

    protected function csvObjectDataForConfigurables($object) {

        $o = array();
        $keyMapping ="";
        foreach ($object->getClass()->getFieldDefinitions() as $key => $value) {
           //exclude remote owner fields
            
             switch ($key) {
                case 'ean':
                    # code...
                    $keyMapping="sku";
                    break;
                case 'code':
                case 'famille':
                    # code...
                    continue(2);
                    break;
                
                default:
                    $keyMapping = $key;
                    break;
            }
            if (!($value instanceof Object_Class_Data_Relations_Abstract and $value->isRemoteOwner()) && !($value instanceof Object_Localizedfield)) {
                $selfValue = trim($object->$key);
                //echo $key ."/".$selfValue."\n";
                $getter = "get".ucfirst($key);
                if(method_exists($value, $getter)) { // for Object_Concrete, Object_Fieldcollection_Data_Abstract, Object_Objectbrick_Data_Abstract
                     $rawInheritedValue = $value->$getter();
                } 
                if(!is_array($rawInheritedValue) 
                    && !($rawInheritedValue instanceof Object_Data_StructuredTable)
                    && !($rawInheritedValue instanceof Object_Objectbrick)
                    && !($rawInheritedValue instanceof Object_Localizedfield)
                    && !($rawInheritedValue instanceof Object_Data_Link)
                    && !($rawInheritedValue instanceof Asset_Image)
                    && !($rawInheritedValue instanceof Asset)
                    && !($rawInheritedValue instanceof Element_Interface)
                    && !($rawInheritedValue instanceof Object_Data_Hotspotimage)
                    && !($rawInheritedValue instanceof Object_Data_Geopoint)
                    && !($rawInheritedValue instanceof Object_Data_Geobounds)
                    && !($rawInheritedValue instanceof Object_Fieldcollection)
                    && !($rawInheritedValue instanceof Zend_Date)
                    && !($rawInheritedValue instanceof Object_Data_Hotspotimage)

                    

                ) 
                {
                    if(strlen($selfValue)>0 && $selfValue>0) {
                        $o[$keyMapping] = $selfValue;
                     } 
                }
                
                
            }


            

        }
        return $o;
    }

 }