<?php 

/** 
* Generated at: 2017-10-13T10:18:47+02:00
* IP: 172.31.30.232


Fields Summary: 
 - classe_durete [calculatedValue]
 - classe_utilisation [calculatedValue]
*/ 


return Pimcore\Model\Object\Objectbrick\Definition::__set_state(array(
   'classDefinitions' => 
  array (
    0 => 
    array (
      'classname' => 5,
      'fieldname' => 'normes',
    ),
  ),
   'key' => 'techAttributeSol',
   'parentClass' => '',
   'layoutDefinitions' => 
  Pimcore\Model\Object\ClassDefinition\Layout\Panel::__set_state(array(
     'fieldtype' => 'panel',
     'labelWidth' => 100,
     'layout' => NULL,
     'name' => NULL,
     'type' => NULL,
     'region' => NULL,
     'title' => NULL,
     'width' => NULL,
     'height' => NULL,
     'collapsible' => NULL,
     'collapsed' => NULL,
     'bodyStyle' => NULL,
     'datatype' => 'layout',
     'permissions' => NULL,
     'childs' => 
    array (
      0 => 
      Pimcore\Model\Object\ClassDefinition\Layout\Panel::__set_state(array(
         'fieldtype' => 'panel',
         'labelWidth' => 100,
         'layout' => NULL,
         'name' => 'layout',
         'type' => NULL,
         'region' => NULL,
         'title' => '',
         'width' => NULL,
         'height' => NULL,
         'collapsible' => false,
         'collapsed' => false,
         'bodyStyle' => '',
         'datatype' => 'layout',
         'permissions' => NULL,
         'childs' => 
        array (
          0 => 
          Pimcore\Model\Object\ClassDefinition\Data\CalculatedValue::__set_state(array(
             'fieldtype' => 'calculatedValue',
             'width' => 0,
             'calculatorClass' => '\\Website\\Generator',
             'queryColumnType' => 'varchar',
             'columnLength' => 190,
             'phpdocType' => '\\Pimcore\\Model\\Object\\Data\\CalculatedValue',
             'name' => 'classe_durete',
             'title' => 'classe_durete',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => NULL,
             'style' => '',
             'permissions' => NULL,
             'datatype' => 'data',
             'columnType' => NULL,
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
          )),
          1 => 
          Pimcore\Model\Object\ClassDefinition\Data\CalculatedValue::__set_state(array(
             'fieldtype' => 'calculatedValue',
             'width' => 0,
             'calculatorClass' => '\\Website\\Generator',
             'queryColumnType' => 'varchar',
             'columnLength' => 190,
             'phpdocType' => '\\Pimcore\\Model\\Object\\Data\\CalculatedValue',
             'name' => 'classe_utilisation',
             'title' => 'classe_utilisation',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => NULL,
             'style' => '',
             'permissions' => NULL,
             'datatype' => 'data',
             'columnType' => NULL,
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
          )),
        ),
         'locked' => NULL,
      )),
    ),
     'locked' => NULL,
  )),
   'dao' => NULL,
));
