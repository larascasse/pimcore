<?php 


return Pimcore\Model\Object\Fieldcollection\Definition::__set_state(array(
   'key' => 'ProductFieldCollection',
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
         'layout' => '',
         'name' => 'Layout',
         'type' => NULL,
         'region' => '',
         'title' => '',
         'width' => '',
         'height' => '',
         'collapsible' => false,
         'collapsed' => false,
         'bodyStyle' => '',
         'datatype' => 'layout',
         'permissions' => NULL,
         'childs' => 
        array (
          0 => 
          Pimcore\Model\Object\ClassDefinition\Data\StructuredTable::__set_state(array(
             'fieldtype' => 'structuredTable',
             'width' => '',
             'height' => '',
             'labelWidth' => '',
             'labelFirstCell' => '',
             'cols' => 
            array (
              0 => 
              array (
                'position' => 1,
                'key' => 'public',
                'label' => 'Prix public',
                'type' => 'number',
                'width' => '',
              ),
              1 => 
              array (
                'position' => 2,
                'key' => 'negoce',
                'label' => 'Prix Négoce',
                'type' => 'number',
                'width' => '',
              ),
              2 => 
              array (
                'position' => 3,
                'key' => 'poseur',
                'label' => 'Prix Poseur',
                'type' => 'number',
                'width' => '',
              ),
              3 => 
              array (
                'position' => 4,
                'key' => 'pro',
                'label' => 'Prix pro',
                'type' => 'number',
                'width' => '',
              ),
            ),
             'rows' => 
            array (
              0 => 
              array (
                'position' => 1,
                'key' => 'pricerow',
                'label' => 'Prix HT',
              ),
            ),
             'queryColumnType' => NULL,
             'columnType' => NULL,
             'phpdocType' => 'array',
             'name' => 'prix',
             'title' => 'Prix',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'datatype' => 'data',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
          )),
        ),
         'locked' => false,
      )),
    ),
     'locked' => NULL,
  )),
   'dao' => NULL,
));
