<?php
//TODO
namespace Website\Tool;
class Wkhtmltopdf {
 
    public static function fromUrl ($url, $config = array()) {
        return self::convert($url, $config);
    }
 
    public static function fromString ($string, $pdfFile=null) {
 
        $tmpHtmlFile = PIMCORE_TEMPORARY_DIRECTORY . "/" . uniqid() . ".htm";
        file_put_contents($tmpHtmlFile, $string);
        $httpSource = \Pimcore\Tool::getHostUrl() . str_replace($_SERVER["DOCUMENT_ROOT"],"",$tmpHtmlFile);
        //echo $httpSource."||||||".$string."//////////////";
       // die;
        $pdfContent = self::convert($httpSource,$pdfFile);
 
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

    public static function convert($httpSource,$pdfFile=null,$postArray=null) {
        
           

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

            $tmpPdfFile = $pdfFile?$pdfFile:PIMCORE_SYSTEM_TEMP_DIRECTORY . "/" . uniqid() . ".pdf";

            $localOptions= [
                //"--debug-javascript" => 1,
                "--load-error-handling" => "ignore",
                "--dpi" => 300,
               // "--disable-smart-shrinking" => "",
                //"-s" => "",
                //"--page-width" => 60,
                //"--page-height" => 50,
                //"--page-height" => 100,
                "--margin-bottom" => 15,
                "--margin-top" => 15,
                "--margin-left" => 15,
                "--margin-right" => 15,
                "--javascript-delay" => 10,
                //"--default-header" => "toto",
                //"--no-header-line" => 1,
                "--footer-html" => \Pimcore\Tool::getHostUrl()."/website/views/layouts/inc_footer_pdf.html",
                "--title" => $pdfFile,
                //"--footer-title" => "title toto"
                //"--javascript-delay" =>2000
            ];

            if(is_array($postArray)) {
                $b = array();
                foreach ($postArray as $key => $value) {
                    $b[] = '--post '.$key." '".str_replace(array("\n","\t"),array("",""),$value)."'";
                    # code...
                }
                //print_r($postArray);
                $localOptions[implode(" ", $b)] = "";
            }
           
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

        $cmd = $wkhtmltopdfBinary.$options." '" . $httpSource . "' '" . $tmpPdfFile."'";
        echo $cmd; die;
            system( $cmd, $retVal);

              if ($retVal != 0 && $retVal != 1) {
                    echo "Lpn wkhtmltopdf reported error (" . $retVal . ")". "\ncommand was:" . $cmd;
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

