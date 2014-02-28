<?php

class Texttemplates_Service {

    public static function createTextTemplateRelation($templateName, $variables, $object, $fieldname, $doSave = false) {
        $templateName = html_entity_decode($templateName, ENT_NOQUOTES, 'UTF-8');

        $templateRelation = new Texttemplates_TextTemplateRelation();
        $templateRelation->setName($templateName);

        $templateRelation->setTargetType("object");
        $templateRelation->setTargetId($object->getId());
        $templateRelation->setTargetFieldname($fieldname);

        $variables = self::parseVariables($variables);
        $variables = json_encode($variables);

        $templateRelation->setVariables($variables);
        if($doSave) {
            $templateRelation->save();
        }

        return $templateRelation;
    }

    public static function findTemplate($templateName, $variables, $object, $fieldname) {
        $templateName = html_entity_decode($templateName, ENT_NOQUOTES, 'UTF-8');

        $language = $variables['language'];
        if(empty($language)) {
            $language = Texttemplates_Plugin::getDefaultLanguage();
            Logger::info("Template $templateName in object " . $object->getId() . " fieldname $fieldname has no language defined. Using default language $language.");
        }
        $template = Texttemplates_TextTemplate::getByNameLanguage($templateName, $language);

        if(!empty($template)) {
            return $template;
        } else {
            Logger::warn("Template $templateName for language $language does not exist.");
            return null;
        }
    }

    public static function removeOldTextTemplateRelations($object, $fieldname) {
        $templateRelations = new Texttemplates_TextTemplateRelation_List();
        $db = Pimcore_Resource::get();
        $templateRelations->setCondition("targetType = " . $db->quote("object") . " AND targetId = " . $db->quote($object->getId()) .
            " AND targetFieldname = " . $db->quote($fieldname));

        foreach($templateRelations->getTextTemplateRelations() as $r) {
            $r->delete();
        }
    }

    private static function parseVariables($variables) {
        if(!empty($variables)) {
            $parsedVariables = array();
            foreach($variables as $v) {
                $parsedVariables[$v[1]] = $v[2];
            }
            return $parsedVariables;
        } else {
            return null;
        }
    }


    public static function getAllTextTemplates($text, $exclude = array()) {
        $matches = array();
        preg_match_all( '/@{([^}@]+)}@/', $text, $matches, PREG_SET_ORDER);

        //to prevent infinity loop
        if(!empty($matches) && !empty($exclude)) {
            $result = array();
            foreach($matches as $m) {
                $def = self::getTextTemplateDefinition($m[1]);
                if(!in_array($def->textTemplateName, $exclude)) {
                    $result[] = $m;
                }
            }
            return $result;
        } else {
            return $matches;
        }

    }



    public static function getAllVariables($text) {
        $matches = array();
        preg_match_all( '/\#{([^}\#]+)}\#/', $text, $matches, PREG_SET_ORDER);
        return $matches;
    }

    public static function getTextTemplateDefinition($defText) {
        $def = new stdClass();

        $textTemplateName = explode(" ", $defText);
        $def->textTemplateName = $textTemplateName[0];

        $str = str_replace($def->textTemplateName, '', $defText);
        $str = str_replace("&quot;", '"', trim($str));

        $variables = array();
        preg_match_all('/([^= ]+)="([^=]+)"/', $str, $variables, PREG_SET_ORDER);

        $def->variables = $variables;
        return $def;
    }


    public static function compileTextTemplates($object, $dataRaw, $fieldname) {
        $hasTemplates = true;
        $visited = array();
        if($dataRaw instanceof Object_Data_TemplateWysiwyg) {
            $dataRaw = $dataRaw->getRawText();
        }
        $data = $dataRaw;

        while($hasTemplates) {
            $templates = self::getAllTextTemplates($dataRaw, array_values($visited));

            if(empty($templates)) {
                $hasTemplates = false;
            } else {
                foreach($templates as $t) {
                    $def = self::getTextTemplateDefinition($t[1]);
                    if(!array_key_exists($def->textTemplateName, $visited)) {
                        $variables = self::parseVariables($def->variables);
                        $template = Texttemplates_Service::findTemplate($def->textTemplateName, $variables, $object, $fieldname);

                        if(!empty($template)) {
                            $templateText = self::compileVariables($template->getText(), $variables, $object);
                            $data = str_replace($t[0], $templateText, $data);
                        }
                        $visited[$def->textTemplateName] = true;
                    }
                }
            }
        }

        $data = self::compileVariables($data, array(), $object);

        if(empty($data)) {
            return null;
        } else {
            $dataObject = new Object_Data_TemplateWysiwyg($dataRaw, $data);
            return $dataObject;
        }
    }


    public static function compileVariables($data, $variables, $object) {
        $backupGetInheritedValues = Object_Abstract::getGetInheritedValues();
        Object_Abstract::setGetInheritedValues(true);

        $variablePlaceholders = self::getAllVariables($data);

        if(!empty($variablePlaceholders)) {
            foreach($variablePlaceholders as $vp) {


                if(!empty($variables[$vp[1]])) {
                    /* first check, if variables are defined within variables array, which is given at texttemplate inclusion */
                    $value = $variables[$vp[1]];
                    $data = str_replace($vp[0], $value, $data);
                } else {
                    /* check for variables within object attributes */

                    $nameParts = explode("~", $vp[1]);
                    $value = $object;

                    if(count($nameParts) > 1) {
                        if(count($nameParts) == 2) {
                            $fds = $object->getClass()->getFieldDefinitions();
                            foreach($fds as $key => $fd) {
                                if($fd instanceof Object_Class_Data_Objectbricks) {
                                    $tempGetter = "get" . ucfirst($key);
                                    if($object->$tempGetter()) {
                                        $brickContainer = $object->$tempGetter();

                                        $brickGetter = "get" . ucfirst($nameParts[0]);
                                        if(method_exists($brickContainer, $brickGetter)) {
                                            $brick = $brickContainer->$brickGetter();

                                            $fieldGetter = "get" . ucfirst($nameParts[1]);

                                            if(!empty($brick) && method_exists($brick, $fieldGetter)) {
                                                $value = $brick->$fieldGetter();
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            foreach($nameParts as $np) {
                                $getter = "get" . ucfirst($np);
                                if(!empty($value)) {
                                    if(method_exists($value, $getter)) {
                                        $value = $value->$getter();
                                    } else {
                                        $value = null;
                                    }
                                }
                            }
                        }
                    } else {
                        $fieldGetter = "get" . ucfirst($vp[1]);
                        if(method_exists($object, $fieldGetter)) {
                            $value = $value->$fieldGetter();
                        } else {

                            $fds = $object->getClass()->getFieldDefinitions();
                            foreach($fds as $key => $fd) {
                                if($fd instanceof Object_Class_Data_Objectbricks) {
                                    $tempGetter = "get" . ucfirst($key);

                                    if($object->$tempGetter()) {
                                        $brickGetters = $object->$tempGetter()->getBrickGetters();
                                        foreach($brickGetters as $brickGetter) {
                                            $brick = $object->$tempGetter()->$brickGetter();
                                            if(!empty($brick) && method_exists($brick, $fieldGetter)) {
                                                $value = $brick->$fieldGetter();
                                            }

                                            //if value has been found, break
                                            if(!empty($value) && $value != $object ) {
                                                break 2;
                                            }

                                        }
                                    }
                                }


                            }
                        }
                    }
                    if(!empty($value) && $value != $object) {

                        if(is_array($value)) {
                            $value = implode(", ", $value);
                        }
                        if(is_numeric($value)) {
                            try {
                                $locale = Zend_Registry::get("Zend_Locale");
                            } catch(Exception $e) {}

                            if($locale) {
                                $value = Zend_Locale_Format::toNumber($value, array('locale' => $locale));
                            }
                        }

                        $data = str_replace($vp[0], $value, $data);
                    }
                }
            }
        }

        Object_Abstract::setGetInheritedValues($backupGetInheritedValues);

        return $data;
    }
}
