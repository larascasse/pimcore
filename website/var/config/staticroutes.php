<?php 

return [
    1 => [
        "name" => "news",
        "pattern" => "/(.*)_n([\\d]+)/",
        "reverse" => "%prefix/%text_n%id",
        "module" => "",
        "controller" => "news",
        "action" => "detail",
        "variables" => "text,id",
        "defaults" => "",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 0,
        "modificationDate" => 0,
        "id" => 1
    ],
    2 => [
        "name" => "produits",
        "pattern" => "/\\/produits\\/(.*)_([\\d]+)/",
        "reverse" => "/produits/%text_%id",
        "module" => NULL,
        "controller" => "product",
        "action" => "detail",
        "variables" => "text,id",
        "defaults" => "",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 0,
        "modificationDate" => 0,
        "id" => 2
    ],
    3 => [
        "name" => "dyn-prefix",
        "pattern" => "/\\/(products)\\/(list|detail|index)/",
        "reverse" => "/%con/%act",
        "module" => "",
        "controller" => "product",
        "action" => "%act",
        "variables" => "con,act",
        "defaults" => NULL,
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 0,
        "modificationDate" => 0,
        "id" => 3
    ],
    4 => [
        "name" => "din-simple",
        "pattern" => "/\\/dyn_([a-z]+)\\/([a-z]/)/",
        "reverse" => "/dyn_%controller%action",
        "module" => "",
        "controller" => "advanced",
        "action" => "/%con%act",
        "variables" => "controller,action",
        "defaults" => "",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 0,
        "modificationDate" => 0,
        "id" => 4
    ],
    5 => [
        "name" => "products-by-choix",
        "pattern" => "/\\/produits\\/choix_(.*)/",
        "reverse" => "/produits/choix_%choix",
        "module" => "",
        "controller" => "product",
        "action" => "detail-by-choix",
        "variables" => "choix",
        "defaults" => "CHE",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 0,
        "modificationDate" => 0,
        "id" => 5
    ],
    6 => [
        "name" => "categories",
        "pattern" => "/\\/category\\/(.*)_([\\d]+)/",
        "reverse" => "/category/%text_%id",
        "module" => "",
        "controller" => "category",
        "action" => "detail",
        "variables" => "text,id",
        "defaults" => "",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 0,
        "modificationDate" => 0,
        "id" => 6
    ],
    7 => [
        "name" => "autocomplete",
        "pattern" => "/\\/ajax\\/(.*)\\/(.*)/",
        "reverse" => "/ajax/%actionname/%query",
        "module" => "",
        "controller" => "product",
        "action" => "router",
        "variables" => "actionname,query",
        "defaults" => "",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 0,
        "modificationDate" => 0,
        "id" => 7
    ],
    8 => [
        "name" => "id",
        "pattern" => "/\\/id\\/([\\d]+)/",
        "reverse" => "/id/%id",
        "module" => NULL,
        "controller" => "product",
        "action" => "detail-intra",
        "variables" => "id",
        "defaults" => "",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 1444209775,
        "modificationDate" => 1444250368,
        "id" => 8
    ],
    9 => [
        "name" => "ean",
        "pattern" => "/\\/ean\\/(.*)/",
        "reverse" => "/ean/%ean",
        "module" => "",
        "controller" => "product",
        "action" => "detail-by-ean",
        "variables" => "ean",
        "defaults" => "",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 1462356913,
        "modificationDate" => 1462357002,
        "id" => 9
    ],
    10 => [
        "id" => 10,
        "name" => "journal",
        "pattern" => "/\\/journal\\/(.*)_n([\\d]+)/",
        "reverse" => "/journal/%text_n%id",
        "module" => NULL,
        "controller" => "blog-post",
        "action" => "detail",
        "variables" => "text,id",
        "defaults" => "",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 1485361673,
        "modificationDate" => 1487860017
    ],
    11 => [
        "id" => 11,
        "name" => "projet_V1",
        "pattern" => "/\\/projet\\/(.*)_n([\\d]+)/",
        "reverse" => "/projet/%text_n%id",
        "module" => "",
        "controller" => "project-post",
        "action" => "detail",
        "variables" => "text,id",
        "defaults" => "",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 1485941492,
        "modificationDate" => 1487944316
    ],
    12 => [
        "id" => 12,
        "name" => "projects-all",
        "pattern" => "/\\/projects\\/all/",
        "reverse" => "/projects/all",
        "module" => "",
        "controller" => "project-post",
        "action" => "get-all",
        "variables" => "",
        "defaults" => NULL,
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 1486034789,
        "modificationDate" => 1487865515
    ],
    13 => [
        "id" => 13,
        "name" => "pages-all",
        "pattern" => "/\\/pages\\/all/",
        "reverse" => "/pages/all",
        "module" => "",
        "controller" => "lpn",
        "action" => "get-all-pages",
        "variables" => "",
        "defaults" => "",
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 1486379635,
        "modificationDate" => 1487848244
    ],
    14 => [
        "id" => 14,
        "name" => "blocks-all",
        "pattern" => "/\\/blocks\\/all/",
        "reverse" => "/blocks/all",
        "module" => "",
        "controller" => "lpn",
        "action" => "get-all-cms-blocks",
        "variables" => "",
        "defaults" => NULL,
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 1487847903,
        "modificationDate" => 1487848428
    ],
    15 => [
        "id" => 15,
        "name" => "projet",
        "pattern" => "/\\/projet\\/(.*)/",
        "reverse" => "/projet/%key",
        "module" => NULL,
        "controller" => "project-post",
        "action" => "detail",
        "variables" => "key",
        "defaults" => NULL,
        "siteId" => NULL,
        "priority" => 1,
        "creationDate" => 1487944315,
        "modificationDate" => 1487952031
    ],
    16 => [
        "id" => 16,
        "name" => "project-category",
        "pattern" => "/\\/projets\\/category\\/(.*)/",
        "reverse" => "/projets/category/%key",
        "module" => NULL,
        "controller" => "project-category",
        "action" => "detail",
        "variables" => "key",
        "defaults" => NULL,
        "siteId" => NULL,
        "priority" => 0,
        "creationDate" => 1490618748,
        "modificationDate" => 1490619605
    ],
    17 => [
        "id" => 17,
        "name" => "project-category-all",
        "pattern" => "/\\/projects\\/category\\/all/",
        "reverse" => "/projects/category/all",
        "module" => "",
        "controller" => "project-category",
        "action" => "get-all",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => NULL,
        "priority" => 0,
        "creationDate" => 1490619582,
        "modificationDate" => 1490619741
    ]
];
