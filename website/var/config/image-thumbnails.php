<?php 

return [
    "content" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "870"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 95,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "content"
    ],
    "exampleCombined1" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "275"
                ]
            ],
            [
                "method" => "roundCorners",
                "arguments" => [
                    "width" => "10",
                    "height" => "10"
                ]
            ],
            [
                "method" => "rotate",
                "arguments" => [
                    "angle" => "10"
                ]
            ],
            [
                "method" => "addOverlay",
                "arguments" => [
                    "path" => "/website/static/img/logo-overlay.png",
                    "x" => "10",
                    "y" => "10",
                    "origin" => "bottom-right",
                    "alpha" => "100",
                    "composite" => "COMPOSITE_DEFAULT"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleCombined1"
    ],
    "exampleCombined2" => [
        "items" => [
            [
                "method" => "frame",
                "arguments" => [
                    "width" => "275",
                    "height" => "150"
                ]
            ],
            [
                "method" => "grayscale",
                "arguments" => ""
            ],
            [
                "method" => "setBackgroundColor",
                "arguments" => [
                    "color" => "#ff6600"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleCombined2"
    ],
    "exampleContain" => [
        "items" => [
            [
                "method" => "contain",
                "arguments" => [
                    "width" => "275",
                    "height" => "150"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleContain"
    ],
    "exampleCorners" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "275",
                    "height" => "150",
                    "positioning" => "center",
                    "doNotScaleUp" => "1"
                ]
            ],
            [
                "method" => "addOverlay",
                "arguments" => [
                    "path" => "/website/static/img/logo-overlay.png",
                    "x" => "10",
                    "y" => "10",
                    "origin" => "top-left",
                    "alpha" => "100",
                    "composite" => "COMPOSITE_DEFAULT"
                ]
            ],
            [
                "method" => "roundCorners",
                "arguments" => [
                    "width" => "10",
                    "height" => "10"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleCorners"
    ],
    "exampleCover" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "275",
                    "height" => "150",
                    "positioning" => "center",
                    "doNotScaleUp" => "1"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleCover"
    ],
    "exampleFrame" => [
        "items" => [
            [
                "method" => "frame",
                "arguments" => [
                    "width" => "275",
                    "height" => "150"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleFrame"
    ],
    "exampleGrayscale" => [
        "items" => [
            [
                "method" => "frame",
                "arguments" => [
                    "width" => "275",
                    "height" => "150"
                ]
            ],
            [
                "method" => "grayscale",
                "arguments" => ""
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleGrayscale"
    ],
    "exampleMask" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "275",
                    "height" => "150",
                    "positioning" => "center",
                    "doNotScaleUp" => "1"
                ]
            ],
            [
                "method" => "applyMask",
                "arguments" => [
                    "path" => "/website/static/img/mask-example.png"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleMask"
    ],
    "exampleOverlay" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "275",
                    "height" => "150",
                    "positioning" => "centerleft",
                    "doNotScaleUp" => "1"
                ]
            ],
            [
                "method" => "addOverlay",
                "arguments" => [
                    "path" => "/website/static/img/logo-overlay.png",
                    "x" => "10",
                    "y" => "10",
                    "origin" => "top-left",
                    "alpha" => "75",
                    "composite" => "COMPOSITE_DEFAULT"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleOverlay"
    ],
    "exampleResize" => [
        "items" => [
            [
                "method" => "resize",
                "arguments" => [
                    "width" => "275",
                    "height" => "150"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleResize"
    ],
    "exampleRotate" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "275"
                ]
            ],
            [
                "method" => "rotate",
                "arguments" => [
                    "angle" => "5"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleRotate"
    ],
    "exampleScaleHeight" => [
        "items" => [
            [
                "method" => "scaleByHeight",
                "arguments" => [
                    "height" => "150"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleScaleHeight"
    ],
    "exampleScaleWidth" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "275"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleScaleWidth"
    ],
    "exampleSepia" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "275"
                ]
            ],
            [
                "method" => "sepia",
                "arguments" => ""
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "exampleSepia"
    ],
    "featurerette" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "512",
                    "height" => "260",
                    "positioning" => "center",
                    "doNotScaleUp" => "1"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 85,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "featurerette"
    ],
    "galleryCarousel" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "1140",
                    "height" => "400",
                    "positioning" => "center",
                    "doNotScaleUp" => "1"
                ]
            ]
        ],
        "medias" => [
            "940w" => [
                [
                    "method" => "cover",
                    "arguments" => [
                        "width" => "940",
                        "height" => "350",
                        "positioning" => "center"
                    ]
                ]
            ],
            "720w" => [
                [
                    "method" => "cover",
                    "arguments" => [
                        "width" => "720",
                        "height" => "300",
                        "positioning" => "center"
                    ]
                ]
            ],
            "320w" => [
                [
                    "method" => "cover",
                    "arguments" => [
                        "width" => "320",
                        "height" => "100",
                        "positioning" => "center"
                    ]
                ]
            ]
        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "galleryCarousel"
    ],
    "galleryCarouselPreview" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "100",
                    "height" => "54",
                    "positioning" => "center",
                    "doNotScaleUp" => "1"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "galleryCarouselPreview"
    ],
    "galleryLightbox" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "900"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 75,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "galleryLightbox"
    ],
    "galleryThumbnail" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "260",
                    "height" => "180",
                    "positioning" => "center",
                    "doNotScaleUp" => "1"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "galleryThumbnail"
    ],
    "magento_base" => [
        "items" => [
            [
                "method" => "scaleByHeight",
                "arguments" => [
                    "height" => "1000"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "magento_base"
    ],
    "magento_header" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "1400"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => "",
        "id" => "magento_header"
    ],
    "magento_origine" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "1400"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 80,
        "highResolution" => 0,
        "filenameSuffix" => "",
        "id" => "magento_origine"
    ],
    "magento_realisation" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => 1400,
                    "height" => 1000,
                    "positioning" => "bottomcenter",
                    "doNotScaleUp" => TRUE
                ]
            ]
        ],
        "medias" => [
            "320w" => [
                [
                    "method" => "cover",
                    "arguments" => [
                        "width" => 350,
                        "height" => 250,
                        "positioning" => "bottomcenter",
                        "doNotScaleUp" => TRUE
                    ]
                ]
            ],
            "640w" => [
                [
                    "method" => "cover",
                    "arguments" => [
                        "width" => 700,
                        "height" => 500,
                        "positioning" => "bottomcenter",
                        "doNotScaleUp" => TRUE
                    ]
                ]
            ],
            "1024w" => [
                [
                    "method" => "cover",
                    "arguments" => [
                        "width" => 1050,
                        "height" => 750,
                        "positioning" => "bottomcenter",
                        "doNotScaleUp" => TRUE
                    ]
                ]
            ],
            "1920w" => [
                [
                    "method" => "cover",
                    "arguments" => [
                        "width" => 2100,
                        "height" => 1500,
                        "positioning" => "bottomcenter",
                        "doNotScaleUp" => TRUE
                    ]
                ]
            ]
        ],
        "name" => "magento_realisation",
        "description" => "",
        "format" => "JPEG",
        "quality" => 80,
        "highResolution" => 0,
        "preserveColor" => FALSE,
        "preserveMetaData" => FALSE,
        "modificationDate" => 1483528945,
        "creationDate" => 1483528764,
        "id" => "magento_realisation"
    ],
    "magento_selection" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => 620
                ]
            ]
        ],
        "medias" => [
            "320w" => [
                [
                    "method" => "scaleByWidth",
                    "arguments" => [
                        "width" => 320
                    ]
                ]
            ]
        ],
        "name" => "magento_selection",
        "description" => "",
        "format" => "JPEG",
        "quality" => 80,
        "highResolution" => 0,
        "preserveColor" => FALSE,
        "preserveMetaData" => FALSE,
        "modificationDate" => 1483528611,
        "creationDate" => 1483526813,
        "id" => "magento_selection"
    ],
    "magento_small" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "1400",
                    "height" => "1000",
                    "positioning" => "bottomcenter",
                    "doNotScaleUp" => "1"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 80,
        "highResolution" => 0,
        "filenameSuffix" => "",
        "id" => "magento_small"
    ],
    "magento_thumbnail" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "500"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 80,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "magento_thumbnail"
    ],
    "newsList" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "80",
                    "height" => "80",
                    "positioning" => "center",
                    "doNotScaleUp" => "1"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "newsList"
    ],
    "portalCarousel" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "1500"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => "",
        "id" => "portalCarousel"
    ],
    "productCarousel" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "1400",
                    "height" => "1000",
                    "positioning" => "bottomcenter",
                    "doNotScaleUp" => "1"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => "",
        "id" => "productCarousel"
    ],
    "productCategory" => [
        "items" => [
            [
                "method" => "setBackgroundColor",
                "arguments" => [
                    "color" => "#FFFFFF"
                ]
            ],
            [
                "method" => "contain",
                "arguments" => [
                    "width" => "275",
                    "height" => "150"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "productCategory"
    ],
    "product_large" => [
        "items" => [
            [
                "method" => "scaleByWidth",
                "arguments" => [
                    "width" => "1024"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "JPEG",
        "quality" => 90,
        "highResolution" => 0,
        "filenameSuffix" => NULL,
        "id" => "product_large"
    ],
    "standardTeaser" => [
        "items" => [
            [
                "method" => "cover",
                "arguments" => [
                    "width" => "275",
                    "height" => "150",
                    "positioning" => "center",
                    "doNotScaleUp" => "1"
                ]
            ]
        ],
        "medias" => [

        ],
        "description" => "",
        "format" => "SOURCE",
        "quality" => 90,
        "highResolution" => 2,
        "filenameSuffix" => NULL,
        "id" => "standardTeaser"
    ]
];
