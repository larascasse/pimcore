<?php

if( !isset($_SERVER['PHP_AUTH_USER']) )
{
    if (isset($_SERVER['HTTP_AUTHORIZATION']) && (strlen($_SERVER['HTTP_AUTHORIZATION']) > 0)){
        list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
        if( strlen($_SERVER['PHP_AUTH_USER']) == 0 || strlen($_SERVER['PHP_AUTH_PW']) == 0 )
        {
            unset($_SERVER['PHP_AUTH_USER']);
            unset($_SERVER['PHP_AUTH_PW']);
        }
    }
}

//$s3AssetUrlPrefix = "//media.laparqueterienouvelle.fr";

$cloudFrontPrefix = "https://media.laparqueterienouvelle.fr";

if (isset($_SERVER["HTTP_HOST"]) && $_SERVER["HTTP_HOST"]=="pimcore.florent.local") {
    $cloudFrontPrefix = "//pimcore.florent.local";

}


if (!defined("LPN_ASSET_PREFIX")) {
	define("LPN_ASSET_PREFIX", $cloudFrontPrefix);
}


if (!\Pimcore::inAdmin() || \Pimcore\Tool::isFrontentRequestByAdmin()  ) {
    \Pimcore::getEventManager()->attach([
        "frontend.path.asset.image.thumbnail",
        "frontend.path.asset.document.image-thumbnail",
        //"frontend.path.asset.video.image-thumbnail",
        //"frontend.path.asset.video.thumbnail",
    ],
        function ($event) use ($cloudFrontPrefix) {
            // rewrite the path for the frontend
            $fileSystemPath = $event->getParam("filesystemPath");
            $target = $event->getTarget();
            $fileModTime = null;
            if($target instanceof \Pimcore\Model\Asset) {
                $fileModTime = $target->getModificationDate();
            } elseif (method_exists($target, "getAsset") && $target->getAsset()) {
                $fileModTime = $target->getAsset()->getModificationDate();
            } elseif (file_exists($fileSystemPath)) {
                $fileModTime = filemtime($fileSystemPath);
            }
            //Newcache 

            $path = str_replace(PIMCORE_DOCUMENT_ROOT, "", $fileSystemPath);
            if($fileModTime) {
                //$fileModTime .="v2";
                $path = "/cache-buster-" . $fileModTime . $path; // add a cache-buster
            }
            $path = $cloudFrontPrefix . $path;
 
            return $path;
        });

    \Pimcore::getEventManager()->attach([
        //"frontend.path.asset.image.thumbnail",
        //"frontend.path.asset.document.image-thumbnail",
        "frontend.path.asset.video.image-thumbnail",
        "frontend.path.asset.video.thumbnail",
    ],
        function ($event) use ($cloudFrontPrefix) {
            // rewrite the path for the frontend
            $fileSystemPath = $event->getParam("filesystemPath");
            $target = $event->getTarget();
            $fileModTime = null;
            if($target instanceof \Pimcore\Model\Asset) {
                $fileModTime = $target->getModificationDate();
            } elseif (method_exists($target, "getAsset") && $target->getAsset()) {
                $fileModTime = $target->getAsset()->getModificationDate();
            } elseif (file_exists($fileSystemPath)) {
                $fileModTime = filemtime($fileSystemPath);
            }
            //Newcache 

            $path = str_replace(PIMCORE_DOCUMENT_ROOT, "", $fileSystemPath);
            /*if($fileModTime) {
                //$fileModTime .="v2";
                $path = "/cache-buster-" . $fileModTime . $path; // add a cache-buster
            }*/
            $path = $cloudFrontPrefix . $path;
 
            return $path;
        });


 
    \Pimcore::getEventManager()->attach("frontend.path.asset", function ($event) use ($cloudFrontPrefix) {
        $asset = $event->getTarget();
        $path = $asset->getRealFullPath();
        $path = "/cache-buster-" . $asset->getModificationDate() . $path; // add a cache-buster
        $path = $cloudFrontPrefix . $path;
 
        return $path;
    });
}

//Pas de caracteres speciaux, V4.0
\Pimcore::getEventManager()->attach("system.service.preGetValidKey", function (\Zend_EventManager_Event $event) {
    $key = $event->getParam("key");
    $key = \Pimcore\File::getValidFilename($key);
    return $key;
});



$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('Website');
