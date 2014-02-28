<?php
/**
 * Image Tools
 */

class Tools_Image extends Asset_Image_Thumbnail_Processor
{
    public static function ImageFromUrl($path, $config)
    {

        if (is_string($config)) {
            try {
                $config = Asset_Image_Thumbnail_Config::getByName($config);
            } catch (Exception $e) {
                throw new Exception("Tools Exception: thumbnail definition : " . $config . " does not exist");
            }
        }

        $format = strtolower($config->getFormat());

        // simple detection for source type if SOURCE is selected
        if ($format == "source") {
            $typeMapping = array(
                "gif"  => "gif",
                "jpeg" => "jpeg",
                "jpg"  => "jpeg",
                "png"  => "png"
            );

            $fileExt = Pimcore_File::getFileExtension($path);
            if ($typeMapping[$fileExt]) {
                $format = $typeMapping[$fileExt];
            } else {
                // use PNG if source doesn't have a valid mapping
                $format = "png";
            }
        }

        $filename = "toolsimage_" . md5($path) . "__" . $config->getName() . "." . $format;

        $fsPath = PIMCORE_TEMPORARY_DIRECTORY . "/" . $filename;

        // check for existing and still valid thumbnail

        if (!PIMCORE_DEBUG and is_file($fsPath) and filemtime($fsPath) > (time() - 3600)) {
            return str_replace(PIMCORE_DOCUMENT_ROOT, "", $fsPath);
        }

        // transform image
        $image = Asset_Image::getImageTransformInstance();

        $extern = false;

        if (preg_match("/http:\/\//i", $path)) {
            $extern = true;
            try {
                $client = new Zend_Http_Client($path, array(
                    "timeout" => 1,
                ));

                $imagecontent = $client->request()->getBody();

                $path = PIMCORE_TEMPORARY_DIRECTORY . "/ext_" . $filename;

                file_put_contents($path, $imagecontent);


            } catch (Exception $e) {
                Logger::warn("Tools_Image: Error for " . $path . " " . $e->getMessage());

                return "/pimcore/static/img/image-not-supported.png";
            }
        }


        if (!$image->load($path)) {
            Logger::warn("Tools_Image: Loading Error for " . $path);

            return "/pimcore/static/img/image-not-supported.png";
        }

        $transformations = $config->getItems();
        if (is_array($transformations) && count($transformations) > 0) {
            foreach ($transformations as $transformation) {
                if (!empty($transformation)) {
                    $arguments = array();
                    $mapping = self::$argumentMapping[$transformation["method"]];

                    if (is_array($transformation["arguments"])) {
                        foreach ($transformation["arguments"] as $key => $value) {
                            $position = array_search($key, $mapping);
                            if ($position !== false) {
                                $arguments[$position] = $value;
                            }
                        }
                    }

                    ksort($arguments);
                    if (count($mapping) == count($arguments)) {
                        call_user_func_array(array($image, $transformation["method"]), $arguments);
                    } else {
                        $message = "Image Transform failed: cannot call method `" . $transformation["method"] . "´ with arguments `" . implode(",", $arguments) . "´ because there are too few arguments";
                        Logger::error($message);
                    }
                }
            }
        }

        $image->save($fsPath, $format, $config->getQuality());

        $path = str_replace(PIMCORE_DOCUMENT_ROOT, "", $fsPath);

        if ($extern) {
            unlink(PIMCORE_TEMPORARY_DIRECTORY . "/ext_" . $filename);
        }

        return $path;

    }
}
