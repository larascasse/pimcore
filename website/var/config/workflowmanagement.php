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
                "objectLayout" => 3,
                "elementPublished" => FALSE
            ],
            [
                "name" => "contents_to_review",
                "label" => "Contents ready to review"
            ],
            [
                "name" => "contents_validated",
                "label" => "Content ready to publish",
                "objectLayout" => 0
            ],
            [
                "name" => "content_published",
                "label" => "content_published",
                "objectLayout" => 0
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
                "name" => "content_published",
                "label" => "content_published",
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
            ]
        ],
        "transitionDefinitions" => [
            "globalActions" => [

            ],
            "new" => [
                "validActions" => [
                    "contentsupdated" => NULL,
                    "contents_ready" => NULL,
                    "process" => NULL,
                    "reject" => NULL,
                    "image_missing" => NULL,
                    "content_published" => NULL
                ]
            ],
            "contents_validated" => [
                "validActions" => [
                    "contentsupdated" => NULL,
                    "contents_ready" => NULL,
                    "process" => NULL,
                    "content_published" => NULL
                ]
            ],
            "update_picture" => [
                "validActions" => [
                    "contents_ready" => NULL,
                    "content_published" => NULL
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
        "modificationDate" => 1519640720
    ]
];
