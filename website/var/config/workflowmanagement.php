<?php 

return [
    1 => [
        "id" => 1,
        "name" => "Product Workflow",
        "states" => [
            [
                "name" => "open",
                "label" => "Ouvert",
                "color" => "#FF0000"
            ],
            [
                "name" => "processing",
                "label" => "En cours",
                "color" => "#0000FF"
            ],
            [
                "name" => "done",
                "label" => "Terminé",
                "color" => "#00FF00"
            ],
            [
                "name" => "needs_magento_sync",
                "label" => "needs_magento_sync STATE",
                "color" => "#00FFFF"
            ]
        ],
        "statuses" => [
            [
                "name" => "new",
                "label" => "Nouveau"
            ],
            [
                "name" => "update_contents",
                "label" => "Mise à jour"
            ],
            [
                "name" => "rejected",
                "label" => "Rejeté"
            ],
            [
                "name" => "update_picture",
                "label" => "Mise à jour des images",
                "objectLayout" => NULL,
                "elementPublished" => TRUE
            ],
            [
                "name" => "contents_to_review",
                "label" => "Contents ready to review"
            ],
            [
                "name" => "contents_validated",
                "label" => "Content ready to publish",
                "objectLayout" => NULL
            ],
            [
                "name" => "content_published",
                "label" => "content_published",
                "objectLayout" => NULL
            ],
            [
                "name" => "content_needs_magento_sync",
                "label" => "content_needs_magento_sync STATUS"
            ],
            [
                "name" => "content_obsolete",
                "label" => "content_obsolete STATUS"
            ]
        ],
        "actions" => [
            [
                "name" => "reject",
                "label" => "Reject the product",
                "transitionTo" => [

                ],
                "notes" => [
                    "required" => FALSE,
                    "title" => "",
                    "type" => ""
                ],
                "additionalFields" => [

                ],
                "users" => [

                ],
                "notificationUsers" => [

                ],
                "events" => [

                ]
            ],
            [
                "name" => "process",
                "label" => "Start processing the product",
                "transitionTo" => [
                    "processing" => [
                        "update_contents"
                    ]
                ],
                "notes" => [
                    "required" => FALSE,
                    "title" => "",
                    "type" => ""
                ],
                "additionalFields" => [

                ],
                "users" => [

                ],
                "notificationUsers" => [

                ],
                "events" => [

                ]
            ],
            [
                "name" => "contentsupdated",
                "label" => "Contents uptodate",
                "transitionTo" => [
                    "processing" => [
                        "contents_to_review"
                    ]
                ],
                "notes" => [
                    "required" => FALSE,
                    "title" => "",
                    "type" => ""
                ],
                "additionalFields" => [

                ],
                "users" => [

                ],
                "notificationUsers" => [

                ],
                "events" => [

                ]
            ],
            [
                "name" => "contents_ready",
                "label" => "Contents are ready to publish",
                "transitionTo" => [
                    "processing" => [
                        "contents_validated"
                    ]
                ],
                "notes" => [
                    "required" => FALSE,
                    "title" => "",
                    "type" => ""
                ],
                "additionalFields" => [

                ],
                "users" => [

                ],
                "notificationUsers" => [

                ],
                "events" => [

                ]
            ],
            [
                "name" => "image_missing",
                "label" => "Manque les images",
                "transitionTo" => [
                    "processing" => [
                        "update_picture"
                    ]
                ],
                "notes" => [
                    "required" => FALSE,
                    "title" => "",
                    "type" => ""
                ],
                "additionalFields" => [

                ],
                "users" => [

                ],
                "notificationUsers" => [

                ],
                "events" => [

                ]
            ],
            [
                "name" => "set_content_published",
                "label" => "set_content_published",
                "transitionTo" => [
                    "done" => [
                        "content_published"
                    ]
                ],
                "notes" => [
                    "required" => FALSE,
                    "title" => "",
                    "type" => ""
                ],
                "additionalFields" => [

                ],
                "users" => [

                ],
                "notificationUsers" => [

                ],
                "events" => [

                ]
            ],
            [
                "name" => "settomagentosync",
                "label" => "Need Sync Action",
                "transitionTo" => [
                    "needs_magento_sync" => [
                        "content_needs_magento_sync"
                    ]
                ],
                "notes" => [
                    "required" => FALSE,
                    "title" => "",
                    "type" => ""
                ],
                "additionalFields" => [

                ],
                "users" => [

                ],
                "notificationUsers" => [

                ],
                "events" => [

                ]
            ],
            [
                "name" => "syncmagento",
                "label" => "Sync to magento",
                "transitionTo" => [
                    "done" => [
                        "content_published"
                    ]
                ],
                "notes" => [
                    "required" => FALSE,
                    "title" => "",
                    "type" => ""
                ],
                "additionalFields" => [

                ],
                "users" => [

                ],
                "notificationUsers" => [

                ],
                "events" => [

                ]
            ],
            [
                "name" => "settomagentosync_new",
                "label" => "NEW - Need Sync Action",
                "transitionTo" => [
                    "needs_magento_sync" => [
                        "new"
                    ]
                ],
                "notes" => [
                    "required" => FALSE,
                    "title" => "",
                    "type" => ""
                ],
                "additionalFields" => [

                ],
                "users" => [

                ],
                "notificationUsers" => [

                ],
                "events" => [

                ]
            ],
            [
                "name" => "set_to_obsolete",
                "label" => "set_to_obsolete ACTION",
                "transitionTo" => [
                    "done" => [
                        "content_obsolete"
                    ]
                ],
                "notes" => [
                    "required" => FALSE,
                    "title" => "",
                    "type" => ""
                ],
                "additionalFields" => [

                ],
                "users" => [

                ],
                "notificationUsers" => [

                ],
                "events" => [

                ]
            ]
        ],
        "transitionDefinitions" => [
            "globalActions" => [

            ],
            "new" => [
                "validActions" => [
                    "syncmagento" => NULL,
                    "set_content_published" => NULL,
                    "settomagentosync" => NULL,
                    "contents_ready" => NULL,
                    "contentsupdated" => NULL,
                    "process" => NULL,
                    "settomagentosync_new" => NULL,
                    "reject" => NULL,
                    "image_missing" => NULL,
                    "set_to_obsolete" => NULL
                ]
            ],
            "contents_validated" => [
                "validActions" => [
                    "syncmagento" => NULL,
                    "set_content_published" => NULL,
                    "settomagentosync" => NULL,
                    "contents_ready" => NULL,
                    "contentsupdated" => NULL,
                    "process" => NULL,
                    "settomagentosync_new" => NULL,
                    "set_to_obsolete" => NULL,
                    "image_missing" => NULL
                ]
            ],
            "update_picture" => [
                "validActions" => [
                    "syncmagento" => NULL,
                    "settomagentosync" => NULL,
                    "contents_ready" => NULL,
                    "set_to_obsolete" => NULL,
                    "settomagentosync_new" => NULL
                ]
            ],
            "content_needs_magento_sync" => [
                "validActions" => [
                    "syncmagento" => NULL,
                    "settomagentosync_new" => NULL,
                    "set_content_published" => NULL,
                    "set_to_obsolete" => NULL
                ]
            ],
            "content_published" => [
                "validActions" => [
                    "syncmagento" => NULL,
                    "settomagentosync_new" => NULL,
                    "set_content_published" => NULL,
                    "settomagentosync" => NULL,
                    "contents_ready" => NULL,
                    "contentsupdated" => NULL,
                    "process" => NULL,
                    "reject" => NULL,
                    "image_missing" => NULL,
                    "set_to_obsolete" => NULL
                ]
            ],
            "content_obsolete" => [
                "validActions" => [
                    "reject" => NULL,
                    "process" => NULL,
                    "contents_ready" => NULL,
                    "contentsupdated" => NULL,
                    "image_missing" => NULL,
                    "set_content_published" => NULL,
                    "settomagentosync" => NULL,
                    "syncmagento" => NULL,
                    "settomagentosync_new" => NULL
                ]
            ]
        ],
        "defaultState" => "open",
        "defaultStatus" => "new",
        "allowUnpublished" => TRUE,
        "workflowSubject" => [
            "types" => [
                "object"
            ],
            "classes" => [
                5
            ],
            "assetTypes" => [

            ],
            "documentTypes" => [

            ]
        ],
        "enabled" => TRUE,
        "creationDate" => 1517845984,
        "modificationDate" => 1553681345
    ]
];
