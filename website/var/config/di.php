<?php

return [
    'Pimcore\Model\Object\Product' => DI\object('Website_Product'),
    'Pimcore\Model\Object\Product\List' => DI\object('Website_Product_List'),
    'Pimcore\Model\Object\Teinte' => DI\object('Website_Teinte'),
    'Pimcore\Model\Object\Teinte\List' => DI\object('Website_Teinte_List'),
    'Pimcore\Model\Asset\Image' => DI\object('Website\Model\Asset\Image'),
    'Pimcore\Model\Object\ProjectPost' => DI\object('Website\ProjectPost'),
    'Pimcore\Model\Object\ProjectCategory' => DI\object('Website\ProjectCategory'),
    'Pimcore\Model\Object\ProjectPost\Listing' => DI\object('Website\ProjectPost\Listing'),
    //'Pimcore\Model\Asset\Image' => DI\object('Website_Image'),
];
