<?php 

/** 
* Generated at: 2019-05-02T12:08:30+02:00
* Inheritance: yes
* Variants: no
* Changed by: florent (6)
* IP: 172.31.4.114


Fields Summary: 
- name [input]
- description [textarea]
- image [image]
- hexacolor [input]
- products_relation [nonownerobjects]
- teinte_type [select]
- product_type [select]
- product_ids_flat [textarea]
- configurableFields [input]
- mage_mediagallery [textarea]
- mage_tags [input]
- associatedArticles [objects]
*/ 


return Pimcore\Model\Object\ClassDefinition::__set_state(array(
   'name' => 'teinte',
   'description' => '',
   'creationDate' => 0,
   'modificationDate' => 1556791710,
   'userOwner' => 6,
   'userModification' => 6,
   'parentClass' => '',
   'useTraits' => '',
   'allowInherit' => true,
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
         'name' => 'Layout',
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
          Pimcore\Model\Object\ClassDefinition\Data\Input::__set_state(array(
             'fieldtype' => 'input',
             'width' => NULL,
             'queryColumnType' => 'varchar',
             'columnType' => 'varchar',
             'columnLength' => 255,
             'phpdocType' => 'string',
             'regex' => '',
             'name' => 'name',
             'title' => 'Nom',
             'tooltip' => '',
             'mandatory' => true,
             'noteditable' => false,
             'index' => true,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'datatype' => 'data',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => true,
             'visibleSearch' => true,
          )),
          1 => 
          Pimcore\Model\Object\ClassDefinition\Data\Textarea::__set_state(array(
             'fieldtype' => 'textarea',
             'width' => '',
             'height' => '',
             'queryColumnType' => 'longtext',
             'columnType' => 'longtext',
             'phpdocType' => 'string',
             'name' => 'description',
             'title' => 'Description',
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
          2 => 
          Pimcore\Model\Object\ClassDefinition\Data\Image::__set_state(array(
             'fieldtype' => 'image',
             'width' => '',
             'height' => '',
             'uploadPath' => '',
             'queryColumnType' => 'int(11)',
             'columnType' => 'int(11)',
             'phpdocType' => '\\Pimcore\\Model\\Asset\\Image',
             'name' => 'image',
             'title' => 'Image',
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
          3 => 
          Pimcore\Model\Object\ClassDefinition\Data\Input::__set_state(array(
             'fieldtype' => 'input',
             'width' => NULL,
             'queryColumnType' => 'varchar',
             'columnType' => 'varchar',
             'columnLength' => 255,
             'phpdocType' => 'string',
             'regex' => '',
             'name' => 'hexacolor',
             'title' => 'Couleur Hexa (avec #)',
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
          4 => 
          Pimcore\Model\Object\ClassDefinition\Data\Nonownerobjects::__set_state(array(
             'ownerClassName' => 'product',
             'ownerClassId' => NULL,
             'ownerFieldName' => 'pimonly_teinte_rel',
             'lazyLoading' => true,
             'fieldtype' => 'nonownerobjects',
             'width' => '',
             'height' => '',
             'maxItems' => '',
             'queryColumnType' => 'text',
             'phpdocType' => 'array',
             'relationType' => true,
             'classes' => NULL,
             'pathFormatterClass' => NULL,
             'name' => 'products_relation',
             'title' => 'products_relation',
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
             'visibleGridView' => false,
             'visibleSearch' => false,
          )),
          5 => 
          Pimcore\Model\Object\ClassDefinition\Data\Select::__set_state(array(
             'fieldtype' => 'select',
             'options' => 
            array (
              0 => 
              array (
                'key' => 'Teinté',
                'value' => 'teinte_classique',
              ),
              1 => 
              array (
                'key' => 'Teinte réactive',
                'value' => 'teinte_reactive',
              ),
              2 => 
              array (
                'key' => 'Peint',
                'value' => 'peint',
              ),
            ),
             'width' => 300,
             'defaultValue' => '',
             'queryColumnType' => 'varchar(190)',
             'columnType' => 'varchar(190)',
             'phpdocType' => 'string',
             'name' => 'teinte_type',
             'title' => 'Type de teinte',
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
          6 => 
          Pimcore\Model\Object\ClassDefinition\Data\Select::__set_state(array(
             'fieldtype' => 'select',
             'options' => 
            array (
              0 => 
              array (
                'key' => 'Parquet',
                'value' => 'parquet',
              ),
              1 => 
              array (
                'key' => 'Terrasse',
                'value' => 'terrasse',
              ),
              2 => 
              array (
                'key' => 'Sol Plaqué',
                'value' => 'sol-plaque',
              ),
              3 => 
              array (
                'key' => 'Sol Stratifié',
                'value' => 'sol-stratifie',
              ),
              4 => 
              array (
                'key' => 'Sol Vinyl',
                'value' => 'sol-vinyl',
              ),
              5 => 
              array (
                'key' => 'Sol vinyle rigide',
                'value' => 'sol-vinyl-rigide',
              ),
              6 => 
              array (
                'key' => 'Bardage',
                'value' => 'bardage',
              ),
              7 => 
              array (
                'key' => 'Bardage intérieur',
                'value' => 'bardage-interieur',
              ),
              8 => 
              array (
                'key' => 'Bardage extérieur',
                'value' => ' bardage-exterieur',
              ),
              9 => 
              array (
                'key' => 'Bardage vieux bois',
                'value' => 'bardage-vieux-bois',
              ),
              10 => 
              array (
                'key' => 'Accessoire',
                'value' => 'accessoire',
              ),
              11 => 
              array (
                'key' => 'Agencement',
                'value' => 'agencement',
              ),
              12 => 
              array (
                'key' => 'Table',
                'value' => 'table',
              ),
            ),
             'width' => 300,
             'defaultValue' => '',
             'queryColumnType' => 'varchar(190)',
             'columnType' => 'varchar(190)',
             'phpdocType' => 'string',
             'name' => 'product_type',
             'title' => 'Type de produit',
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
          7 => 
          Pimcore\Model\Object\ClassDefinition\Data\Textarea::__set_state(array(
             'fieldtype' => 'textarea',
             'width' => '',
             'height' => '',
             'queryColumnType' => 'longtext',
             'columnType' => 'longtext',
             'phpdocType' => 'string',
             'name' => 'product_ids_flat',
             'title' => 'product_ids_flat',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => true,
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
          8 => 
          Pimcore\Model\Object\ClassDefinition\Data\Input::__set_state(array(
             'fieldtype' => 'input',
             'width' => 800,
             'queryColumnType' => 'varchar',
             'columnType' => 'varchar',
             'columnLength' => 190,
             'phpdocType' => 'string',
             'regex' => '',
             'name' => 'configurableFields',
             'title' => 'configurableFields',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => true,
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
          9 => 
          Pimcore\Model\Object\ClassDefinition\Data\Textarea::__set_state(array(
             'fieldtype' => 'textarea',
             'width' => '',
             'height' => '',
             'queryColumnType' => 'longtext',
             'columnType' => 'longtext',
             'phpdocType' => 'string',
             'name' => 'mage_mediagallery',
             'title' => 'mage_mediagallery',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => true,
             'index' => false,
             'locked' => false,
             'style' => 'width:100%;height:300px',
             'permissions' => NULL,
             'datatype' => 'data',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
          )),
          10 => 
          Pimcore\Model\Object\ClassDefinition\Data\Input::__set_state(array(
             'fieldtype' => 'input',
             'width' => NULL,
             'queryColumnType' => 'varchar',
             'columnType' => 'varchar',
             'columnLength' => 190,
             'phpdocType' => 'string',
             'regex' => '',
             'name' => 'mage_tags',
             'title' => 'mage_tags',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => true,
             'index' => false,
             'locked' => false,
             'style' => 'width:100%',
             'permissions' => NULL,
             'datatype' => 'data',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
          )),
          11 => 
          Pimcore\Model\Object\ClassDefinition\Data\Objects::__set_state(array(
             'fieldtype' => 'objects',
             'width' => '',
             'height' => '',
             'maxItems' => '',
             'queryColumnType' => 'text',
             'phpdocType' => 'array',
             'relationType' => true,
             'lazyLoading' => false,
             'classes' => 
            array (
              0 => 
              array (
                'classes' => 'article',
              ),
            ),
             'pathFormatterClass' => '',
             'name' => 'associatedArticles',
             'title' => 'Articles associés',
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
   'previewUrl' => '/teinte/%o_id',
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
