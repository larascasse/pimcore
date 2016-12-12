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

$cloudFrontPrefix = "//media.laparqueterienouvelle.fr";

if (!\Pimcore::inAdmin() /*&& !\Pimcore\Tool::isFrontentRequestByAdmin() */) {
    \Pimcore::getEventManager()->attach([
        "frontend.path.asset.image.thumbnail",
        "frontend.path.asset.document.image-thumbnail",
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
 
            $path = str_replace(PIMCORE_DOCUMENT_ROOT, "", $fileSystemPath);
            if($fileModTime) {
                $path = "/cache-buster-" . $fileModTime . $path; // add a cache-buster
            }
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

$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('Website');
