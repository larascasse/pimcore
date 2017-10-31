<?php
//TODO
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
 
    /*protected function convert ($httpSource, $config = array()) {
 
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
    }*/

    public static function convert($httpSource,$pdfFile=null) {
        
           

             $web2printConfig = \Pimcore\Config::getWeb2PrintConfig();

             if (empty($wkhtmltopdfBin)) {
                $wkhtmltopdfBin = $web2printConfig->wkhtmltopdfBin;
            } else {
                $wkhtmltopdfBin = $wkhtmltopdfBin;
            }

            if (empty($options)) {
                if ($web2printConfig->wkhtml2pdfOptions) {
                    $options = $web2printConfig->wkhtml2pdfOptions->toArray();
                }
            }

            if(!$pdfFile)
             $tmpPdfFile = $pdfFile?$pdfFile:PIMCORE_SYSTEM_TEMP_DIRECTORY . "/" . uniqid() . ".pdf";

            $localOptions= [
                //"--debug-javascript" => 1,
                "--load-error-handling" => "ignore",
                //"-s" => "",
                "--page-width" => 60,
                //"--page-height" => 50,
                "--page-height" => 100,
                "--margin-bottom" => 0,
                "--margin-top" => 0,
                "--margin-left" => 0,
                "--margin-right" => 0,
                //"--javascript-delay" =>2000
            ];
           
            $optionConfig = array();
            
            $options=" ";
            if(is_array($localOptions)) {
                foreach ($localOptions as $argument => $value) {
                    // there is no value only the option
                    if(is_numeric($argument)) {
                        $optionConfig[] = $value;
                    } else {
                        $optionConfig[] = $argument . " " . $value;
                    }
                }
     
                $options .= implode(" ", $optionConfig);
            }
    

            if($web2printConfig->wkhtmltopdfBin) {
                $wkhtmltopdfBinary = $web2printConfig->wkhtmltopdfBin;
            }

            $cmd = $wkhtmltopdfBinary.$options." " . $httpSource . " " . $tmpPdfFile;
            system( $cmd, $retVal);

              if ($retVal != 0 && $retVal != 1) {
                    echo "wkhtmltopdf reported error (" . $retVal . ")";
                    die;
                    throw new \Exception("wkhtmltopdf reported error (" . $retVal . "): \n" . $output . "\ncommand was:" . $cmd);
                }
        
 
            $pdfContent = @file_get_contents($tmpPdfFile);
            if(strlen($pdfContent)==0) {
                //throw new \Exception("Error reading" . $tmpPdfFile);
            }
            //echo $pdfContent;
 
             // re move temps
            if(!$pdfFile)
             @unlink($tmpPdfFile);
            
            return $pdfContent;

    }
 
}

