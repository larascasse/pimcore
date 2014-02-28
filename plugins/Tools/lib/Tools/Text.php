<?php

class Tools_Text
{

    public static function getStringAsOneLine($string)
    {
        $string = str_replace("\r\n", " ", $string);
        $string = str_replace("\n", " ", $string);
        $string = str_replace("\r", " ", $string);
        $string = str_replace("\t", "", $string);
        $string = preg_replace('#[ ]+#', ' ', $string);
        return $string;
    }

    public static function cutStringRespectingWhitespace($string, $length)
    {
        if ($length < strlen($string)) {
            $text = substr($string, 0, $length);
            if (false !== ($length = strrpos($text, ' '))) {
                $text = substr($text, 0, $length);
            }
            $string = $text . "...";
        }
        return $string;
    }

    public static function getMetaDescription($string, $length = 150)
    {
        $string = self::getStringAsOneLine(strip_tags(html_entity_decode(strip_tags($string), ENT_QUOTES, 'UTF-8')));

        if ($length < strlen($string)) {
            $text = substr($string, 0, $length);
            if (false !== ($length = strrpos($text, ' '))) {
                $text = substr($text, 0, $length);
            }
            $string = $text;
        }
        return trim($string);
    }

    public static function toUrl($text)
    {

        $text = Pimcore_Tool_Transliteration::toASCII($text);

        $search = array('\'', '"', '/', '-', '+', '.', ',', '(', ')', ' ', '&', 'ä', 'ö', 'ü', 'Ä', 'Ö', 'Ü', 'ß', 'É', 'é', 'È', 'è', 'Ê', 'ê', 'E', 'e', 'Ë', 'ë',
                        'À', 'à', 'Á', 'á', 'Å', 'å', 'a', 'Â', 'â', 'Ã', 'ã', 'ª', 'Æ', 'æ', 'C', 'c', 'Ç', 'ç', 'C', 'c', 'Í', 'í', 'Ì', 'ì', 'Î', 'î', 'Ï', 'ï',
                        'Ó', 'ó', 'Ò', 'ò', 'Ô', 'ô', 'º', 'Õ', 'õ', 'Œ', 'O', 'o', 'Ø', 'ø', 'Ú', 'ú', 'Ù', 'ù', 'Û', 'û', 'U', 'u', 'U', 'u', 'Š', 'š', 'S', 's',
                        'Ž', 'ž', 'Z', 'z', 'Z', 'z', 'L', 'l', 'N', 'n', 'Ñ', 'ñ', '¡', '¿', 'Ÿ', 'ÿ', "_", ":");
        $replace = array('', '', '', '-', '', '', '-', '', '', '-', '', 'ae', 'oe', 'ue', 'Ae', 'Oe', 'Ue', 'ss', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e',
                         'A', 'a', 'A', 'a', 'A', 'a', 'a', 'A', 'a', 'A', 'a', 'a', 'AE', 'ae', 'C', 'c', 'C', 'c', 'C', 'c', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i',
                         'O', 'o', 'O', 'o', 'O', 'o', 'o', 'O', 'o', 'OE', 'O', 'o', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'S', 's', 'S', 's',
                         'Z', 'z', 'Z', 'z', 'Z', 'z', 'L', 'l', 'N', 'n', 'N', 'n', '', '', 'Y', 'y', "-", "-");

        $value = urlencode(str_replace($search, $replace, $text));

        return $value;
    }

    public static function htmlentities($text)
    {
        return htmlentities($text, ENT_COMPAT, "UTF-8");
    }

    public static function removeSearchParameters($link)
    {
        $link = str_replace("?pimcore_outputfilters_disabled=1&", "?", $link);
        $link = str_replace("?pimcore_outputfilters_disabled=1", "", $link);
        $link = str_replace("&pimcore_outputfilters_disabled=1", "", $link);
        return $link;
    }

    public static function HtmlLawed($text, $config = array(), $allowedtags = "<p><br><br /><strong><li><ol><ul><b><i><a><table><tr><td>")
    {
        include_once (dirname(__FILE__) . "/include/HtmLawed.php");

        $defaultconfig = array(
            'comment' => 1,
            'style_pass' => 0,
            'safe' => 1,
            'clean_ms_char' => 0,
            'comment' => 1,
            'css_expression' => 0,
            'deny_attribute' => 0,
            'elements' => 'p, br,  strong, li, ol, ul, b, i, table, tr, td, a',
            'deny_attribute' => '*',
            "tidy" => 1,
            "keep_bad" => 6,
            "balance" => 1,
            'valid_xhtml' => 0
        );

        foreach ($defaultconfig as $key => $value) {
            if (!isset($config[$key])) {
                $config[$key] = $value;
            }
        }

        $text = htmLawed($text, $config);

        if ($allowedtags !== true) {
            $text = str_replace(array("\n", "\""), array(" ", ""), strip_tags($text, $allowedtags));
        }


        return $text;
    }

    public static function toParams($array, $html = true)
    {
        $return = "";
        foreach ($array as $key => $value) {
            $return .= ($html ? "&amp;" : "&") . $key . "=" . $value;
        }
        if ($html) {
            $return = substr($return, 5);
        }
        else {
            $return = substr($return, 1);
        }
        return $return;
    }
}
