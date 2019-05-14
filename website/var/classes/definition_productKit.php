<?php 

/** 
* Generated at: 2019-05-14T10:52:43+02:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 172.31.30.184


Fields Summary: 
- ean [input]
- block [block]
-- title [input]
-- option_type [select]
-- option_required [checkbox]
-- associatedProducts [objectsMetadata]
*/ 


return Pimcore\Model\Object\ClassDefinition::__set_state(array(
   'name' => 'productKit',
   'description' => '',
   'creationDate' => 1395913971,
   'modificationDate' => 1557823963,
   'userOwner' => 6,
   'userModification' => 6,
   'parentClass' => '',
   'useTraits' => '',
   'allowInherit' => false,
   'allowVariants' => false,
   'showVariants' => false,
   'layoutDefinitions' => 
  Pimcore\Model\Object\ClassDefinition\Layout\Panel::__set_state(array(
     'fieldtype' => 'panel',
     'labelWidth' => 100,
     'layout' => NULL,
     'name' => 'pimcore_root',
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
         'name' => 'Mise en page',
         'type' => NULL,
         'region' => NULL,
         'title' => NULL,
         'width' => NULL,
         'height' => NULL,
         'collapsible' => false,
         'collapsed' => NULL,
         'bodyStyle' => NULL,
         'datatype' => 'layout',
         'permissions' => NULL,
         'childs' => 
        array (
          0 => 
          Pimcore\Model\Object\ClassDefinition\Data\Input::__set_state(array(
             'fieldtype' => 'input',
             'width' => NULL,
             'queryColumnType' => 'varchar',
             'columnType' => 'varchar',
             'columnLength' => 255,
             'phpdocType' => 'string',
             'regex' => '',
             'name' => 'ean',
             'title' => 'Ean',
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
          1 => 
          Pimcore\Model\Object\ClassDefinition\Data\Block::__set_state(array(
             'fieldtype' => 'block',
             'disallowAddRemove' => NULL,
             'disallowReorder' => NULL,
             'collapsible' => false,
             'collapsed' => false,
             'queryColumnType' => 'longtext',
             'columnType' => 'longtext',
             'phpdocType' => '\\Pimcore\\Model\\Object\\Data\\Block',
             'childs' => 
            array (
              0 => 
              Pimcore\Model\Object\ClassDefinition\Data\Input::__set_state(array(
                 'fieldtype' => 'input',
                 'width' => NULL,
                 'queryColumnType' => 'varchar',
                 'columnType' => 'varchar',
                 'columnLength' => 190,
                 'phpdocType' => 'string',
                 'regex' => '',
                 'name' => 'title',
                 'title' => 'Titre',
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
              1 => 
              Pimcore\Model\Object\ClassDefinition\Data\Select::__set_state(array(
                 'fieldtype' => 'select',
                 'options' => 
                array (
                  0 => 
                  array (
                    'key' => 'radio',
                    'value' => 'radio',
                  ),
                  1 => 
                  array (
                    'key' => 'select',
                    'value' => 'select',
                  ),
                  2 => 
                  array (
                    'key' => 'checkbox',
                    'value' => 'checkbox',
                  ),
                  3 => 
                  array (
                    'key' => 'multi',
                    'value' => 'multi',
                  ),
                ),
                 'width' => '',
                 'defaultValue' => '',
                 'queryColumnType' => 'varchar(190)',
                 'columnType' => 'varchar(190)',
                 'phpdocType' => 'string',
                 'name' => 'option_type',
                 'title' => 'Type d\'option',
                 'tooltip' => 'The input type to be used on the option. One of select, radio, checkbox or multi',
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
              2 => 
              Pimcore\Model\Object\ClassDefinition\Data\Checkbox::__set_state(array(
                 'fieldtype' => 'checkbox',
                 'defaultValue' => 0,
                 'queryColumnType' => 'tinyint(1)',
                 'columnType' => 'tinyint(1)',
                 'phpdocType' => 'boolean',
                 'name' => 'option_required',
                 'title' => 'Obligatoire',
                 'tooltip' => 'Optional. Whether the user must do a selection on the option. Defaults to 1.',
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
              3 => 
              Pimcore\Model\Object\ClassDefinition\Data\ObjectsMetadata::__set_state(array(
                 'allowedClassId' => 5,
                 'visibleFields' => 'code,ean,name_scienergie',
                 'columns' => 
                array (
                  0 => 
                  array (
                    'position' => 1,
                    'key' => 'selection_qty',
                    'label' => 'Quantité',
                    'type' => 'number',
                    'value' => '1',
                    'width' => '',
                    'id' => 'extModel836-1',
                  ),
                  1 => 
                  array (
                    'type' => 'bool',
                    'position' => 2,
                    'key' => 'selection_can_change_qty',
                    'id' => 'extModel2543-1',
                    'value' => '1',
                    'label' => 'User can change the quantity',
                  ),
                  2 => 
                  array (
                    'type' => 'number',
                    'position' => 3,
                    'key' => 'is_default',
                    'id' => 'extModel2543-2',
                    'label' => 'Par défaut',
                  ),
                ),
                 'fieldtype' => 'objectsMetadata',
                 'phpdocType' => '\\Pimcore\\Model\\Object\\Data\\ObjectMetadata[]',
                 'width' => '',
                 'height' => '',
                 'maxItems' => '',
                 'queryColumnType' => 'text',
                 'relationType' => true,
                 'lazyLoading' => false,
                 'classes' => 
                array (
                ),
                 'pathFormatterClass' => '',
                 'name' => 'associatedProducts',
                 'title' => 'Produits',
                 'tooltip' => '',
                 'mandatory' => false,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => false,
                 'style' => '',
                 'permissions' => NULL,
                 'datatype' => 'data',
                 'columnType' => NULL,
                 'invisible' => false,
                 'visibleGridView' => true,
                 'visibleSearch' => false,
                 'columnKeys' => 
                array (
                  0 => 'selection_qty',
                  1 => 'selection_can_change_qty',
                  2 => 'is_default',
                ),
              )),
            ),
             'layout' => NULL,
             'referencedFields' => 
            array (
            ),
             'name' => 'block',
             'title' => 'block',
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
   'icon' => '',
   'previewUrl' => '',
   'group' => '',
   'propertyVisibility' => 
  array (
    'grid' => 
    array (
      'id' => true,
      'path' => true,
      'published' => true,
      'modificationDate' => true,
      'creationDate' => true,
    ),
    'search' => 
    array (
      'id' => true,
      'path' => true,
      'published' => true,
      'modificationDate' => true,
      'creationDate' => true,
    ),
  ),
   'dao' => NULL,
));
