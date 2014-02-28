<?php


class Tools_Geo
{

    public static function geocode($address, $try = 0)
    {

        if (is_array($address)) {
            $address = $address["street"] . ", " . $address["zip"] . " " . $address["city"] . ", " . $address["country"];
        }

        $key = Zend_Registry::get("pimcore_config_system")->services->googlemaps->apikey;

        $url = "http://maps.google.com/maps/geo?key=$key&output=xml&oe=utf-8&q=" . urlencode($address);

        Logger::info("Geocode : " . $address . "\n" . $url);

        $client = new Zend_Http_Client($url, array(
            'maxredirects' => 2,
            'timeout' => 3));
        try {
            $response = $client->request();

            $xml = $response->getBody();
            try {
                $myxml = simplexml_load_string($xml);

                $code = $myxml->Response->Status->code;

                if ($code == 200) {
                    $coords = $myxml->Response->Placemark->Point->coordinates;
                    $coords = preg_split("/,/i", $coords);

                    $geopos = new Object_Data_Geopoint($coords[0], $coords[1]);

                    return $geopos;

                }
                else {
                    if (($code == 602)) {
                        if ($try == 0) {
                            $address = trim(str_replace(array("-"), array(" "), $address));
                            return self::geocode($address, 1);
                        }
                        if ($try == 1) {
                            $address = trim(substr($address, strpos($address, ",") + 1));
                            return self::geocode($address, 2);
                        }
                    }
                    Logger::warn("Code ($code)");
                    return false;
                }
            }
            catch (Exception $e) {
                Logger::err("Ungültige XML \n " . $xml);
                return false;
            }
        }
        catch (Exception $e) {
            Logger::err($e);
            return false;
        }
    }

    /**
     * @static
     * @param Object_Data_Geopoint $geopos
     * @param integer $radius
     * @param  string $objectfield
     * @return string
     */
    public static function radius_condition($geopos, $radius, $objectfield)
    {
        if ($geopos instanceof Object_Data_Geopoint) {
            if (intval($radius) < 1) {
                $radius = 6378137;
            }

            $centerlat = $geopos->getLatitude();
            $centerlng = $geopos->getLongitude();

            $condition = "
        (
          (
            ACOS(
              SIN(" . $objectfield . "__latitude / 180 * PI()) * SIN($centerlat / 180 * PI()) +
              COS(" . $objectfield . "__latitude / 180 * PI()) * COS($centerlat / 180 * PI()) *
              COS(
                ($centerlng / 180 * PI()) -
                (" . $objectfield . "__longitude / 180 * PI())
              )
            ) * 6378388.2
          ) <= " . $radius . "
        )";
            return $condition;
        }
        else {
            return false;
        }
    }

    /**
     * @static
     * @param Object_Data_Geopoint $geopos
     * @param  string $objectfield
     * @return string
     */
    public static function radius_sort($geopos, $objectfield)
    {

        if ($geopos instanceof Object_Data_Geopoint) {

            $centerlat = $geopos->getLatitude();
            $centerlng = $geopos->getLongitude();

            $sortstatement = "
        (
          SELECT (
            ACOS(
              SIN(" . $objectfield . "__latitude / 180 * PI()) * SIN($centerlat / 180 * PI()) +
              COS(" . $objectfield . "__latitude / 180 * PI()) * COS($centerlat / 180 * PI()) *
              COS(
                ($centerlng / 180 * PI()) -
                (" . $objectfield . "__longitude / 180 * PI())
              )
            ) * 6378388.2
          )
        )";
            return $sortstatement;
        }
        else {
            return false;
        }
    }

    public static function distance($secondpoint, $firstpoint)
    {
        $distance = acos(
            sin($firstpoint->getLatitude() / 180 * pi()) * sin($secondpoint->getLatitude() / 180 * pi()) +
                    cos($firstpoint->getLatitude() / 180 * pi()) * cos($secondpoint->getLatitude() / 180 * pi()) *
                            cos(
                                ($firstpoint->getLongitude() / 180 * pi()) -
                                        ($secondpoint->getLongitude() / 180 * pi())
                            )
        ) * 6378388.2;
        return $distance;
    }

}

?>
