<?php 

/** 
* Generated at: 2016-09-27T12:52:53+02:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 92.154.6.232


Fields Summary: 
- teinte [href]
- objettest [objects]
- multimetadata [multihrefMetadata]
- objmetadata [objectsMetadata]
- multihref [multihref]
*/ 


return Pimcore\Model\Object\ClassDefinition::__set_state(array(
   'name' => 'test',
   'description' => '',
   'creationDate' => 0,
   'modificationDate' => 1474973573,
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
          Pimcore\Model\Object\ClassDefinition\Data\Href::__set_state(array(
             'fieldtype' => 'href',
             'width' => '',
             'assetUploadPath' => '',
             'relationType' => true,
             'queryColumnType' => 
            array (
              'id' => 'int(11)',
              'type' => 'enum(\'document\',\'asset\',\'object\')',
            ),
             'phpdocType' => '\\Pimcore\\Model\\Document\\Page | \\Pimcore\\Model\\Document\\Snippet | \\Pimcore\\Model\\Document | \\Pimcore\\Model\\Asset | \\Pimcore\\Model\\Object\\AbstractObject',
             'objectsAllowed' => true,
             'assetsAllowed' => false,
             'assetTypes' => 
            array (
            ),
             'documentsAllowed' => false,
             'documentTypes' => 
            array (
            ),
             'lazyLoading' => true,
             'classes' => 
            array (
              0 => 
              array (
                'classes' => 'taxonomy',
              ),
            ),
             'name' => 'teinte',
             'title' => 'teinte',
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
          1 => 
          Pimcore\Model\Object\ClassDefinition\Data\Objects::__set_state(array(
             'fieldtype' => 'objects',
             'width' => '',
             'height' => '',
             'maxItems' => '',
             'queryColumnType' => 'text',
             'phpdocType' => 'array',
             'relationType' => true,
             'lazyLoading' => true,
             'classes' => 
            array (
              0 => 
              array (
                'classes' => 'teinte',
              ),
            ),
             'name' => 'objettest',
             'title' => 'objettest',
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
          2 => 
          Pimcore\Model\Object\ClassDefinition\Data\MultihrefMetadata::__set_state(array(
             'columns' => 
            array (
              0 => 
              array (
                'type' => 'text',
                'position' => 1,
                'key' => 'k1',
                'id' => 'extModel14172-1',
                'label' => 'sdsd',
              ),
              1 => 
              array (
                'type' => 'text',
                'position' => 2,
                'key' => 'k2',
                'id' => 'extModel14172-2',
                'label' => 'k2',
              ),
            ),
             'fieldtype' => 'multihrefMetadata',
             'phpdocType' => '\\Pimcore\\Model\\Object\\Data\\ElemenentMetadata[]',
             'width' => '',
             'height' => '',
             'maxItems' => '',
             'assetUploadPath' => '',
             'queryColumnType' => 'text',
             'relationType' => true,
             'objectsAllowed' => true,
             'assetsAllowed' => false,
             'assetTypes' => 
            array (
              0 => 
              array (
                'assetTypes' => '',
              ),
            ),
             'documentsAllowed' => false,
             'documentTypes' => 
            array (
              0 => 
              array (
                'documentTypes' => '',
              ),
            ),
             'lazyLoading' => true,
             'classes' => 
            array (
              0 => 
              array (
                'classes' => 'taxonomy',
              ),
            ),
             'name' => 'multimetadata',
             'title' => 'multimetadata',
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
             'columnKeys' => 
            array (
              0 => 'k1',
              1 => 'k2',
            ),
          )),
          3 => 
          Pimcore\Model\Object\ClassDefinition\Data\ObjectsMetadata::__set_state(array(
             'allowedClassId' => 5,
             'visibleFields' => 'id,ean,name',
             'columns' => 
            array (
              0 => 
              array (
                'type' => 'text',
                'position' => 1,
                'key' => 'k1',
                'id' => 'extModel15527-1',
                'label' => 'aaa',
              ),
              1 => 
              array (
                'type' => 'text',
                'position' => 2,
                'key' => 'k2',
                'id' => 'extModel15527-2',
                'label' => 'bbb',
              ),
            ),
             'fieldtype' => 'objectsMetadata',
             'phpdocType' => '\\Pimcore\\Model\\Object\\Data\\ObjectMetadata[]',
             'width' => '',
             'height' => '',
             'maxItems' => '',
             'queryColumnType' => 'text',
             'relationType' => true,
             'lazyLoading' => true,
             'classes' => 
            array (
            ),
             'name' => 'objmetadata',
             'title' => 'objmetadata',
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
             'columnKeys' => 
            array (
              0 => 'k1',
              1 => 'k2',
            ),
          )),
          4 => 
          Pimcore\Model\Object\ClassDefinition\Data\Multihref::__set_state(array(
             'fieldtype' => 'multihref',
             'width' => '',
             'height' => '',
             'maxItems' => '',
             'assetUploadPath' => '',
             'queryColumnType' => 'text',
             'phpdocType' => 'array',
             'relationType' => true,
             'objectsAllowed' => true,
             'assetsAllowed' => false,
             'assetTypes' => 
            array (
              0 => 
              array (
                'assetTypes' => '',
              ),
            ),
             'documentsAllowed' => false,
             'documentTypes' => 
            array (
              0 => 
              array (
                'documentTypes' => '',
              ),
            ),
             'lazyLoading' => true,
             'classes' => 
            array (
              0 => 
              array (
                'classes' => 'product',
              ),
            ),
             'name' => 'multihref',
             'title' => 'multihref',
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
