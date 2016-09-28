<?php 

return [
    "general" => [
        "timezone" => "Europe/Berlin",
        "path_variable" => "/opt/bitnami/common:/opt/bitnami/php/bin",
        "domain" => "",
        "redirect_to_maindomain" => FALSE,
        "language" => "fr",
        "validLanguages" => "en,fr_FR",
        "fallbackLanguages" => [
            "en" => "",
            "fr_FR" => "en"
        ],
        "defaultLanguage" => "en",
        "extjs6" => "1",
        "loginscreencustomimage" => "",
        "disableusagestatistics" => TRUE,
        "debug" => FALSE,
        "debug_ip" => "",
        "http_auth" => [
            "username" => "",
            "password" => ""
        ],
        "custom_php_logfile" => TRUE,
        "debugloglevel" => "error",
        "disable_whoops" => FALSE,
        "debug_admin_translations" => FALSE,
        "devmode" => FALSE,
        "logrecipient" => NULL,
        "viewSuffix" => "",
        "instanceIdentifier" => "",
        "show_cookie_notice" => FALSE
    ],
    "database" => [
        "adapter" => "Mysqli",
        "params" => [
            "host" => "",
            "username" => "bn_pimcore",
            "password" => "a733a78457",
            "dbname" => "pimcore_lpn",
            "port" => "",
            "unix_socket" => "/opt/bitnami/mysql/tmp/mysql.sock"
        ]
    ],
    "documents" => [
        "versions" => [
            "days" => NULL,
            "steps" => 1
        ],
        "default_controller" => "default",
        "default_action" => "default",
        "error_pages" => [
            "default" => "/error"
        ],
        "createredirectwhenmoved" => TRUE,
        "allowtrailingslash" => "no",
        "allowcapitals" => "no",
        "generatepreview" => TRUE
    ],
    "objects" => [
        "versions" => [
            "days" => NULL,
            "steps" => 1
        ]
    ],
    "assets" => [
        "versions" => [
            "days" => NULL,
            "steps" => 1
        ],
        "icc_rgb_profile" => "",
        "icc_cmyk_profile" => "",
        "hide_edit_image" => TRUE,
        "disable_tree_preview" => FALSE
    ],
    "services" => [
        "google" => [
            "client_id" => "",
            "email" => "",
            "simpleapikey" => "",
            "browserapikey" => ""
        ]
    ],
    "cache" => [
        "enabled" => TRUE,
        "lifetime" => NULL,
        "excludePatterns" => "",
        "excludeCookie" => ""
    ],
    "outputfilters" => [
        "less" => FALSE,
        "lesscpath" => ""
    ],
    "webservice" => [
        "enabled" => TRUE
    ],
    "httpclient" => [
        "adapter" => "Zend_Http_Client_Adapter_Socket",
        "proxy_host" => "",
        "proxy_port" => "",
        "proxy_user" => "",
        "proxy_pass" => ""
    ],
    "applicationlog" => [
        "mail_notification" => [
            "send_log_summary" => FALSE,
            "filter_priority" => NULL,
            "mail_receiver" => ""
        ],
        "archive_treshold" => "30",
        "archive_alternative_database" => ""
    ],
    "email" => [
        "sender" => [
            "name" => "La Parqueterie Nouvelle",
            "email" => "florent@lesmecaniques.net"
        ],
        "return" => [
            "name" => "La Parqueterie Nouvelle",
            "email" => "florent@lesmecaniques.net"
        ],
        "method" => "sendmail",
        "smtp" => [
            "host" => "",
            "port" => "",
            "ssl" => "",
            "name" => "",
            "auth" => [
                "method" => "",
                "username" => ""
            ]
        ],
        "debug" => [
            "emailaddresses" => "florent@lesmecaniques.net"
        ],
        "bounce" => [
            "type" => "",
            "maildir" => "",
            "mbox" => "",
            "imap" => [
                "host" => "",
                "port" => "",
                "username" => "",
                "password" => "",
                "ssl" => FALSE
            ]
        ]
    ],
    "newsletter" => [
        "sender" => [
            "name" => "",
            "email" => ""
        ],
        "return" => [
            "name" => "",
            "email" => ""
        ],
        "method" => NULL,
        "smtp" => [
            "host" => "",
            "port" => "",
            "ssl" => "",
            "name" => "",
            "auth" => [
                "method" => "",
                "username" => ""
            ]
        ],
        "usespecific" => FALSE
    ],
    "flags" => [
        "useZendDate" => TRUE
    ]
];
