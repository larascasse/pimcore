<?php

namespace Website\Tool;
class Wkhtmltopdf {
 
    public function fromUrl ($url, $config = array()) {
        return self::convert($url, $config);
    }
 
    public function fromString ($string, $config = array()) {
 
        $tmpHtmlFile = PIMCORE_TEMPORARY_DIRECTORY . "/" . uniqid() . ".htm";
        file_put_contents($tmpHtmlFile, $string);
        $httpSource = $_SERVER["HTTP_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . str_replace($_SERVER["DOCUMENT_ROOT"],"",$tmpHtmlFile);
 
        $pdfContent = self::convert($httpSource, $config);
 
        @unlink($tmpHtmlFile);
 
        return $pdfContent;
    }
 
    protected function convert ($httpSource, $config = array()) {
 
        $tmpPdfFile = PIMCORE_SYSTEM_TEMP_DIRECTORY . "/" . uniqid() . ".pdf";
        $options = " ";
        $optionConfig = array();
 
        if(is_array($config["options"])) {
            foreach ($config["options"] as $argument => $value) {
                // there is no value only the option
                if(is_numeric($argument)) {
                    $optionConfig[] = $value;
                } else {
                    $optionConfig[] = $argument . " " . $value;
                }
            }
 
            $options .= implode(" ", $optionConfig);
        }
 
        $wkhtmltopdfBinary = "/usr/bin/wkhtmltopdf";
        if($config["bin"]) {
            $wkhtmltopdfBinary = $config["bin"];
        }
 
        exec($wkhtmltopdfBinary.$options." " . $httpSource . " " . $tmpPdfFile);
 
        $pdfContent = file_get_contents($tmpPdfFile);
 
        // remove temps
        @unlink($tmpPdfFile);
 
        return $pdfContent;
    }
 
}

