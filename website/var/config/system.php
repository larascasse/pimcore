<?php 

return [
    "general" => [
        "timezone" => "Europe/Berlin",
        "domain" => "",
        "redirect_to_maindomain" => "",
        "language" => "fr",
        "validLanguages" => "en,fr_FR",
        "fallbackLanguages" => [
            "en" => "",
            "fr_FR" => ""
        ],
        "defaultLanguage" => "fr_FR",
        "theme" => "",
        "contactemail" => "florent@lesmecaniques.net",
        "extjs6" => "1",
        "loginscreencustomimage" => "",
        "disableusagestatistics" => "1",
        "debug" => "",
        "debug_ip" => "",
        "http_auth" => [
            "username" => "",
            "password" => ""
        ],
        "custom_php_logfile" => "1",
        "environment" => "",
        "debugloglevel" => "error",
        "disable_whoops" => "",
        "debug_admin_translations" => "",
        "devmode" => "",
        "logrecipient" => "",
        "viewSuffix" => "",
        "instanceIdentifier" => "",
        "show_cookie_notice" => "",
        "path_variable" => "/opt/bitnami/common:/opt/bitnami/php/bin"
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
            "days" => "",
            "steps" => "1"
        ],
        "default_controller" => "default",
        "default_action" => "default",
        "error_pages" => [
            "default" => "/error"
        ],
        "createredirectwhenmoved" => "1",
        "allowtrailingslash" => "no",
        "allowcapitals" => "no",
        "generatepreview" => "1",
        "wkhtmltoimage" => "/home/bitnami/wkhtmltopdf/wkhtmltopdf/static-build/trusty-amd64/app/bin/wkhtmltoimage",
        "wkhtmltopdf" => "/home/bitnami/wkhtmltopdf/wkhtmltopdf/static-build/trusty-amd64/app/bin/wkhtmltopdf"
    ],
    "objects" => [
        "versions" => [
            "days" => "",
            "steps" => "1"
        ]
    ],
    "assets" => [
        "webdav" => [
            "hostname" => "pim.webdav.laparqueterienouvelle.fr"
        ],
        "versions" => [
            "days" => "",
            "steps" => "1"
        ],
        "icc_rgb_profile" => "",
        "icc_cmyk_profile" => "",
        "hide_edit_image" => "1"
    ],
    "services" => [
        "translate" => [
            "apikey" => ""
        ],
        "google" => [
            "client_id" => "",
            "email" => "",
            "simpleapikey" => "",
            "browserapikey" => ""
        ]
    ],
    "cache" => [
        "enabled" => "1",
        "lifetime" => "",
        "excludePatterns" => "",
        "excludeCookie" => ""
    ],
    "outputfilters" => [
        "less" => "",
        "lesscpath" => ""
    ],
    "webservice" => [
        "enabled" => "1"
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
            "send_log_summary" => "",
            "filter_priority" => "",
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
                "username" => "",
                "password" => ""
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
                "ssl" => ""
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
        "method" => "",
        "smtp" => [
            "host" => "",
            "port" => "",
            "ssl" => "",
            "name" => "",
            "auth" => [
                "method" => "",
                "username" => "",
                "password" => ""
            ]
        ],
        "usespecific" => ""
    ],
    "flags" => [
        "useZendDate" => TRUE
    ]
];
